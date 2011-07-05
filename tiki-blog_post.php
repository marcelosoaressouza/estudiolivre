<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-blog_post.php,v 1.34.2.12 2007/03/02 12:23:21 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

include_once ('lib/blogs/bloglib.php');

if ($feature_blogs != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_blogs");

	$smarty->display("error.tpl");
	die;
}

// Now check permissions to access this page
if ((empty($_REQUEST['blogId']) && $tiki_p_blog_post != 'y') || (!empty($_REQUEST["blogId"]) && !$tikilib->user_has_perm_on_object($user, $_REQUEST['blogId'], 'blog', 'tiki_p_blog_post'))) {
	$smarty->assign('msg', tra("Permission denied you cannot post"));

	$smarty->display("error.tpl");
	die;
}

$smarty->assign('wysiwyg', 'n');

if (isset($_REQUEST['wysiwyg']) && $_REQUEST['wysiwyg'] == 'y') {
	$smarty->assign('wysiwyg', 'y');
}

if (isset($_REQUEST["blogId"])) {
	$blogId = $_REQUEST["blogId"];

	$blog_data = $tikilib->get_blog($_REQUEST["blogId"]);
} else {
	$blogId = 0;
}

$smarty->assign('blogId', $blogId);

if (isset($_REQUEST["postId"])) {
	$postId = $_REQUEST["postId"];
} else {
	$postId = 0;
}

$smarty->assign('postId', $postId);

$smarty->assign('data', '');
$smarty->assign('created', date("U"));

$blog_data = $bloglib->get_blog($blogId);
$smarty->assign_by_ref('blog_data', $blog_data);

if (isset($_REQUEST['remove_image'])) {
  $area = 'delblogpostimage';
  if ($feature_ticketlib2 != 'y' or (isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
		$bloglib->remove_post_image($_REQUEST['remove_image']);
  } else {
    key_get($area);
  }
}

// If the articleId is passed then get the article data
if (isset($_REQUEST["postId"]) && $_REQUEST["postId"] > 0) {
	// Check permission
	$data = $bloglib->get_post($_REQUEST["postId"]);
	
	// freetags
	$cat_type='blog post';
	$cat_objid = $_REQUEST["postId"];
	include_once ("freetag_list.php");
	
	// If the user owns the weblog then he can edit
	if ($user && $user == $blog_data["user"]) {
		$data["user"] = $user;
	}

	if ($data["user"] != $user || !$user) {
		if ($tiki_p_blog_admin != 'y' && !$tikilib->user_has_perm_on_object($user, $_REQUEST['blogId'], 'blog', 'tiki_p_blog_admin')) {
			$smarty->assign('msg', tra("Permission denied you cannot edit this post"));

			$smarty->display("error.tpl");
			die;
		}
	}

	if (empty($data["data"]))
		$data["data"] = '';

	$smarty->assign('data', htmldecode( $data["data"] ) );
	$smarty->assign('title', $data["title"]);
	$smarty->assign('trackbacks_to', $data["trackbacks_to"]);
	$smarty->assign('created', $data["created"]);
	$smarty->assign('parsed_data', $tikilib->parse_data($data["data"]));
}

if ($postId) {
	check_ticket('blog');
	if (isset($_FILES['userfile1']) && is_uploaded_file($_FILES['userfile1']['tmp_name'])) {
		$fp = fopen($_FILES['userfile1']['tmp_name'], "rb");

		$data = '';

		while (!feof($fp)) {
			$data .= fread($fp, 8192 * 16);
		}

		fclose ($fp);
		$size = $_FILES['userfile1']['size'];
		$name = $_FILES['userfile1']['name'];
		$type = $_FILES['userfile1']['type'];
		$bloglib->insert_post_image($postId, $name, $size, $type, $data);
	}

	$post_images = $bloglib->get_post_images($postId);
	$smarty->assign_by_ref('post_images', $post_images);
} else {
    // freetags - lista de sugestoes
    include_once ("freetag_list.php");
}	


$smarty->assign('preview', 'n');

if ($tiki_p_admin != 'y') {
    if ($tiki_p_use_HTML != 'y') {
	$_REQUEST["allowhtml"] = 'off';
    }
}

if(isset($_REQUEST["data"])) {

    if (($feature_wiki_allowhtml == 'y' and $tiki_p_use_HTML == 'y' 
		and isset($_REQUEST["allowhtml"]) && $_REQUEST["allowhtml"]=="on")) {
	$edit_data = $_REQUEST["data"];  
    } else {
	$edit_data = $_REQUEST["data"];
    }


} else {
    if (isset($data["data"])) {
	$edit_data = $data["data"];
    } else {
	$edit_data = '';
    }
}

if (isset($_REQUEST["preview"])) {
	$parsed_data = $tikilib->apply_postedit_handlers($edit_data);
	$parsed_data = $tikilib->parse_data($parsed_data);

	if ($blog_spellcheck == 'y') {
		if (isset($_REQUEST["spellcheck"]) && $_REQUEST["spellcheck"] == 'on') {
			$parsed_data = $tikilib->spellcheckreplace($edit_data, $parsed_data, $language, 'blogedit');

			$smarty->assign('spellcheck', 'y');
		} else {
			$smarty->assign('spellcheck', 'n');
		}
	}

	$smarty->assign('data', htmldecode( $edit_data ) );

	if (isset($_REQUEST["blogpriv"]) && $_REQUEST["blogpriv"] == 'on') {
	        $smarty->assign('blogpriv', 'y');  // remember priv setting whilst in preview mode
	} else {
		$smarty->assign('blogpriv', 'n');
	}
	$smarty->assign('trackbacks_to', explode(',', $_REQUEST['trackback']));
	$smarty->assign('title', isset($_REQUEST["title"]) ? $_REQUEST['title'] : '');
	$smarty->assign('parsed_data', $parsed_data);
	$smarty->assign('preview', 'y');
}


// remove images (permissions!)
if (isset($_REQUEST["save"]) || isset($_REQUEST['save_exit'])) {

	include_once ("lib/imagegals/imagegallib.php");
	$smarty->assign('individual', 'n');

	if ($userlib->object_has_one_permission($_REQUEST["blogId"], 'blog')) {
		$smarty->assign('individual', 'y');

		if ($tiki_p_admin != 'y') {
			// Now get all the permissions that are set for this type of permissions 'image gallery'
			$perms = $userlib->get_permissions(0, -1, 'permName_desc', '', 'blogs');

			foreach ($perms["data"] as $perm) {
				$permName = $perm["permName"];

				if ($userlib->object_has_permission($user, $_REQUEST["blogId"], 'blog', $permName)) {
					$$permName = 'y';

					$smarty->assign("$permName", 'y');
				} else {
					$$permName = 'n';

					$smarty->assign("$permName", 'n');
				}
			}
		}
	}

	if ($tiki_p_blog_admin == 'y') {
		$tiki_p_create_blogs = 'y';

		$smarty->assign('tiki_p_create_blogs', 'y');
		$tiki_p_blog_post = 'y';
		$smarty->assign('tiki_p_blog_post', 'y');
		$tiki_p_read_blog = 'y';
		$smarty->assign('tiki_p_read_blog', 'y');
	}

	if ($tiki_p_blog_post != 'y') {
		$smarty->assign('msg', tra("Permission denied you cannot post"));

		$smarty->display("error.tpl");
		die;
	}

	if ($_REQUEST["postId"] > 0) {
		$data = $bloglib->get_post($_REQUEST["postId"]);

		$blog_data = $tikilib->get_blog($data["blogId"]);

		if ($user && $user == $blog_data["user"]) {
			$data["user"] = $user;
		}

		if ($data["user"] != $user || !$user) {
			if ($tiki_p_blog_admin != 'y') {
				$smarty->assign('msg', tra("Permission denied you cannot edit this post"));

				$smarty->display("error.tpl");
				die;
			}
		}
	}

	$edit_data = $imagegallib->capture_images($edit_data);
	$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
	
	if ($_REQUEST["postId"] > 0) {
		$bloglib->update_post($_REQUEST["postId"], $_REQUEST["blogId"], $edit_data, $user, $title, $_REQUEST['trackback']);
		$postid = $_REQUEST["postId"];
	} else {
		$postid = $bloglib->blog_post($_REQUEST["blogId"], $edit_data, $user, $title, $_REQUEST['trackback']);

		$smarty->assign('postId', $postid);
	}

	// freetags
	$cat_type='blog post';
	$cat_objid = $postid;
	$cat_desc = $_REQUEST["data"];
	$cat_name = $_REQUEST["title"];
	$cat_href = "tiki-view_blog_post.php?blogId=". $_REQUEST["blogId"] . "&postId=" . $postid;
	include_once("freetag_list.php");
	include_once("freetag_apply.php");

	if (isset($_REQUEST['save_exit'])) {
		header ("location: tiki-view_blog.php?blogId=$blogId");

		die;
	}

	$parsed_data = $tikilib->apply_postedit_handlers($edit_data);
	$parsed_data = $tikilib->parse_data($parsed_data);

	$smarty->assign('data', htmldecode( $edit_data ) );

        if (isset($_REQUEST["blogpriv"]) && $_REQUEST["blogpriv"] == 'on') {
                $smarty->assign('blogpriv', 'y');  // remember priv setting whilst in preview mode
        } else {
                $smarty->assign('blogpriv', 'n');
        }
	$smarty->assign('title', isset($_REQUEST["title"]) ? $_REQUEST['title'] : '');
	$smarty->assign('trackbacks_to', explode(',', $_REQUEST['trackback']));
	$smarty->assign('parsed_data', $parsed_data);
}

if ($tiki_p_blog_admin == 'y') {
	$blogsd = $bloglib->list_blogs(0, -1, 'created_desc', '');

	$blogs = $blogsd['data'];
} else {
	$blogs = $bloglib->list_blogs_user_can_post($user, 1);
}

if (count($blogs) == 0) {
	$smarty->assign('msg', tra("You can't post in any blog maybe you have to create a blog first"));

	$smarty->display("error.tpl");
	die;
}

$sameurl_elements = array(
	'offset',
	'sort_mode',
	'where',
	'find',
	'blogId',
	'postId'
);

function htmldecode($string) {
   $string = strtr($string, array_flip(get_html_translation_table(HTML_ENTITIES)));
   $string = preg_replace("/&#([0-9]+);/me", "chr('\\1')", $string);
   return $string;
}

$smarty->assign_by_ref('blogs', $blogs);
$section = 'blogs';
include_once ('tiki-section_options.php');

include_once("textareasize.php");

include_once ('lib/quicktags/quicktagslib.php');
$quicktags = $quicktagslib->list_quicktags(0,-1,'taglabel_desc','','wiki');
$smarty->assign_by_ref('quicktags', $quicktags["data"]);

ask_ticket('blog');

require_once("el-tags_ajax.php");
if (isset($_REQUEST["freetag_string"])) {
    $smarty->assign_by_ref('taglist', $_REQUEST["freetag_string"]);
}

$useJs=$tikilib->get_user_preference($user,'user_useEditJs');
$smarty->assign('useJavascript',$useJs);

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the Index Template
$smarty->assign('mid', 'tiki-blog_post.tpl');
$smarty->assign('show_page_bar', 'n');
$smarty->display("tiki.tpl");

?>
