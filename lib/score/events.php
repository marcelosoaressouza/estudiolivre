<?php
// $Header $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

// Each element of $events is an array with (dependent features, category, event name, translated description, default score, default expiration)
$events = array(
array("","General","login",tra("Login"),2,0), // tiki-login.php
//array("","General","login_remain",tra("Stay logged"),2,60),

array("","General","profile_see",tra("See other user's profile"),2,0), // tiki-user_information.php
array("","General","profile_is_seen",tra("Have your profile seen"),1,0), // tiki-user_information.php

array("feature_friends","General","friend_new",tra("Make friends"),10,0), // userslib.php
array("feature_messages","General","message_receive",tra("Receive message"),1,0), // messu-compose.php
array("feature_messages","General","message_send",tra("Send message"),2,0), // messu-compose.php

array("feature_articles","Articles","article_read",tra("Read an article"),2,0), // tikilib.php
array("feature_articles","Articles","article_new",tra("Publish an article"),20,0), 
array("feature_articles","Articles","article_is_read",tra("Have your article read"),1,0), // tikilib.php

array("feature_file_galleries","File galleries","fgallery_new",tra("Create new file gallery"),10,0),  // filegallib.php
array("feature_file_galleries","File galleries","fgallery_new_file",tra("Upload new file to gallery"),10,0),  // filegallib.php
array("feature_file_galleries","File galleries","fgallery_download",tra("Download other user's file"),5,0),  // tikilib.php
array("feature_file_galleries","File galleries","fgallery_is_downloaded",tra("Have your file downloaded"),5,0), // tikilib.php

array("feature_galleries","Image galleries","igallery_new",tra("Create a new image gallery"),10,0), // imagegallib.php
array("feature_galleries","Image galleries","igallery_new_img",tra("Upload new image to gallery"),6,0), // imagegallib.php
array("feature_galleries","Image galleries","igallery_see",tra("See other user's gallery"),4,0),  // imagegallib.php
array("feature_galleries","Image galleries","igallery_see_img",tra("See other user's image"),3,0), // imagegallib.php
array("feature_galleries","Image galleries","igallery_seen",tra("Have your gallery seen by other user"),2,0), // imagegallib.php
array("feature_galleries","Image galleries","igallery_img_seen",tra("Have your image seen"),1,0), // imagegallib.php

array("feature_blogs","Blogs","blog_new",tra("Create new blog"),20,0), // bloglib.php
array("feature_blogs","Blogs","blog_post",tra("Post in a blog"),5,0), // bloglib.php
array("feature_blogs","Blogs","blog_read",tra("Read other user's blog"),2,0), // tikilib.php
array("feature_blogs","Blogs","blog_is_read",tra("Have your blog read"),3,0), // tikilib.php

array("feature_wiki","Wiki","wiki_new",tra("Create a new wiki page"),10,0), // tikilib.php
array("feature_wiki","Wiki","wiki_edit",tra("Edit an existing page"),5,0), // tikilib.php
array("feature_wiki","Wiki","wiki_attach_file",tra("Attach file"),3,0) // wikilib.php
);
?>



