<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/Attic/importerlib.php,v 1.1.4.2 2007/11/24 20:17:18 kerrnel22 Exp $
//
// Copyright (c)2002-2003
// Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of
// authors. Licensed under the GNU LESSER GENERAL PUBLIC LICENSE.
// See license.txt for details.

// This script may only be included! Die if called directly...
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

require_once('commentslib.php');

// A library to handle importing of forum posts from Tiki or from other forum
// software.  This library will re-use functions contained in the CommentsLib
// library, as those functions already directly access the forums.
class Importer extends Comments {
  // The types of forums are hard-coded into the library and displayed
  // in the template.  As support for more imports grows, add the type to
  // the below two arrays, in addition to writing the functions to
  // support them.
  var $fi_types    = array('TikiWiki');
  var $fi_prefixes = array('tiki_');

  // Constructor for the Importer library.
  function Importer($db) {
    if(!$db) {
      die("Invalid db object passed to importerlib constructor.");
    }

    $this->db = $db;
  }

  /*
   * Functions for the forums
   *
   * All functions that begin with "parse" are related to SQL file interaction.
   * Functions that begin with "get" are related to DB interactions.
   *
   */

// importSQLForum will import the forum data from the specified SQL file and
// the specified forum ID, and append it to the end of the data in the
// destination forum.  Datestamps will be retained.
  function importSQLForum($dbType, $dbPrefix, $sqlFile, $fF, $tF) {
    $fHash = array();
    $row = array();
    $hash = array();  // If part of a thread, this is the new parent threadId.

    // Select the table for the main forum information.
    if($dbType == 'TikiWiki') {
      $table = 'comments';
      $ftable = $dbPrefix . $table;
      $ftable2 = $dbPrefix . 'forums';
    }

    else {
      return -1;
    }

    // Parse the SQL file and grab all posts for the source forum.
    $fHash = $this->parseSQL($dbType, $dbPrefix, $table, $sqlFile, $fF);
    $fPosts = count($fHash);
    $fPosts2 = $fPosts;

    // In order to accommodate out of order posts and still keep integrity
    // with threads, if a record has a parent ID (meaning it is part of a
    // thread), then when looping through the array, stick it on the end
    // and continue with the next one.
    for($count = 0; $count < $fPosts2; $count++) {
      $row = array_shift($fHash);

      $pid = 0;

      if($row["parentId"] != 0 && !$hash[$row["parentId"]]) {
        array_push($fHash, $row);
        $fPosts2++;
        continue;
      }

      else if($row["parentId"] != 0) {
        $pid = $hash[$row["parentId"]];
      }

      if($dbType == 'TikiWiki') {
        $query = "insert into
                 `tiki_comments` (`objectType`, `object`, `commentDate`,
                 `userName`, `title`, `data`, `votes`, `points`, `hash`,
                 `parentId`, `average`, `hits`, `type`, `summary`, `user_ip`,
                 `message_id`, `in_reply_to`)
                 values ( 'forum', '$tF', " . $row["commentDate"] .
                 ", \"" . $row["userName"] . "\", \"" . $row["title"] .
                 "\", \"" . $row["data"] . "\", " .(int) $row["votes"] .
                 ", '" . $row["points"] . "', '" . $row["hash"] .
                 "', $pid, \"" . $row["average"] . "\", " .
                 (int) $row["hits"] . ", '" . $row["type"] . "', \"" .
                 $row["summary"] . "\", '" . $row["user_ip"] . "', \"" .
                 $row["message_id"] . "\", \"" . $row["in_reply_to"] . "\")";
        $result = $this->query($query);

        $abbb = $this->getOne("SELECT LAST_INSERT_ID() from $ftable");

        if(!$abbb) {
          $abbb = $this->getOne("SELECT max(tableId) from $ftable");
        }

        $hash[$row["threadId"]] = $abbb;
      }

      else {
        die("Only TikiWiki is supported at this time.\n");
      }
    }

    // Update forum counters.
    $query = "select count(*) from `tiki_comments` where `objectType` = 'forum' and `object` = ?";
    $tComments = $this->getOne($query, array((int) $tF));
    $query = "select count(*) from `tiki_comments` where `objectType` = 'forum' and `object` = ? and `parentId` = 0";
    $tThreads = $this->getOne($query, array((int) $tF));
    $query = "update `tiki_forums` set `comments` = ?, `threads` = ? where `forumId` = ?";
    $result = $this->query($query, array((int) $tComments, (int) $tThreads, (int) $tF));

    // Force an index refresh on comments table.
    include_once("lib/search/refresh-functions.php");
    refresh_index_forums();
    refresh_index_comments('');

    return $fPosts;
  }


// parseFields will take an entire record, as parsed out from an SQL file,
// and pull out full fields (either text-based with '' or numeric).  What is
// returned is an indexed array of the field data.
  function parseFields($record) {
    $fields = array();
    $moo = "\'";

    while($a = strpos($record, ",")) {
      // If field is a string...
      if(ereg("^'", substr($record, 0, $a))) {
        $offset = 1;

        while($b = strpos($record, "'", $offset)) {
          // If close quote is not escaped
          if(substr($record, $b - 1, 2) != $moo) {
            array_push($fields, substr($record, 1, $b - 1));
            $record = substr($record, $b + 2);
            break;
          }

          else {
            $offset = $b + 1;
          }
        }

        // Otherwise, it is numeric.
      }

      else {
        array_push($fields, substr($record, 0, $a));
        $record = substr($record, $a + 1);
      }
    }

    array_push($fields, $record);

    return $fields;
  }


// parseSQL parses the SQL source file, analysing the block of text
// for the specified table, pulling out field names, and all of the
// values from the associated insert actions.  Returns an array of
// associative arrays for each record and the fields within the record.
  function parseSQL($dbType, $dbPrefix, $table, $sqlFile, $fId) {

    $headings = array();
    $rec = array();
    $thash = array();

    $fH = fopen($sqlFile, 'r');

    $lookFor1 = "^CREATE TABLE `$dbPrefix" . "$table`";
    $lookFor2 = "^INSERT INTO `$dbPrefix" . "$table`";

    while($fL = fgets($fH)) {
      // If we find a create table block, parse the
      // entire block.
      if(ereg($lookFor1, $fL)) {
        $fL = fgets($fH);

        while(ereg("^  `", $fL)) {
          $a = substr($fL, 3);
          $b = strpos($a, "`");
          $c = substr($a, 0, $b);

          array_push($headings, $c);
          $fL = fgets($fH);
        }
      }

      // Now that we've parsed the create table block,
      // look for the insert block.
      if(ereg($lookFor2, $fL)) {
        while(ereg($lookFor2, $fL)) {
          $a = strpos($fL, "(");
          $b = strpos($fL, ");\n");
          $c = substr($fL, $a + 1, $b - $a - 1);

          // Do a rudimentary parsing of what generally would be
          // record boundaries, such that each element in $records
          // represents an SQL record or row.
          $records = split('\),\(', $c);

          if(count($records) < 1) {
            $records[0] = $c;
          }

          for($count = 0; $count < count($records); $count++) {
            // Each proper record should begin with a numeric value
            // (at least as far as the tables we will be using).
            // Check the following record from the current one to see
            // if it is a proper record.  If it is not, then it is
            // the continuation of the current one, so merge them into
            // the next record, and skip the current one.  Repeat
            // checking the next record until both the current one
            // and its follower are proper.
            while(isset($records[$count + 1]) && !ereg("^[0-9]", $records[$count + 1])) {
              $newrec = $records[$count] . '),(' . $records[$count + 1];
              $count++;
              $records[$count] = $newrec;
            }


            $fields = $this->parseFields($records[$count]);

            // This only supports TikiWiki at this time.  Any other
            // value that manages to get through will simply parse
            // all records without filter.
            if($dbType == 'TikiWiki') {
              // Ignore records that come back that are not
              // forum-related.
              if($fields[2] != "forum" && $table == 'comments') {
                // Do nothing... NEXT!
                continue;
                // If a source forum has been specified, ignore
                // records that are not for that specific forum.
              }

              else if($fId && $fields[1] != "$fId" && $table == 'comments') {
                // Do nothing... NEXT!
                continue;
              }

              else {
                for($z = 0; $z < count($fields); $z++) {
                  $rec[$headings[$z]] = $fields[$z];
                }

                array_push($thash, $rec);
              }
            }

          }

          $fL = fgets($fH);
        }
      }

    }

    return $thash;
  }


// parseForumList parses an SQL file and returns an array consisting of all
// the forum ID number and name pairs that exist in the SQL file.
  function parseForumList($dbType, $dbPrefix, $sqlFile) {
    $tHash = array();
    $fields = array();
    $forum = array();
    $forums = array();

    // Select the table for the main forum information.
    if($dbType == 'TikiWiki') {
      $table = 'forums';
    }

    else {
      return -1;
    }

    $tHash = $this->parseSQL($dbType, $dbPrefix, $table, $sqlFile, null);

    // We only need to key on the forum ID number and the forum name.
    while($fields = array_shift($tHash)) {
      if($dbType == 'TikiWiki') {
        $forum["id"] = $fields["forumId"];
        $forum["name"] = $fields["name"];
        $forum["comments"] = $fields["comments"];
        array_push($forums, $forum);
      }

      else {
        return -1;
      }
    }

    return $forums;
  }



}
?>
