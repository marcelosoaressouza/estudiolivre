-- $Rev$
-- $Date: 2008/02/21 19:52:41 $
-- $Author: lphuberdeau $
-- $Name: REL-1-9-10-1 $
-- phpMyAdmin MySQL-Dump
-- version 2.5.1
-- http://www.phpmyadmin.net/ (download page)
--
-- Host: localhost
-- Generation Time: Jul 13, 2003 at 02:09 AM
-- Server version: 4.0.13
-- PHP Version: 4.2.3
-- Database : tikiwiki
-- --------------------------------------------------------
--
-- Table structure for table galaxia_activities
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_activities";

CREATE SEQUENCE "galaxia_activities_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "galaxia_activities" (
  "activityId" number(14) NOT NULL,
  "name" varchar(80) default NULL,
  "normalized_name" varchar(80) default NULL,
  "pId" number(14) default '0' NOT NULL,
  "type" varchar(12) default NULL CHECK ("type" IN ('start','end','split','switch','join','activity','standalone')),
  "isAutoRouted" char(1) default NULL,
  "flowNum" number(10) default NULL,
  "isInteractive" char(1) default NULL,
  "lastModif" number(14) default NULL,
  "description" clob,
  "expirationTime" number(6) default '0' NOT NULL,
  PRIMARY KEY ("activityId")
)   ;

CREATE TRIGGER "galaxia_activities_trig" BEFORE INSERT ON "galaxia_activities" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "galaxia_activities_sequ".nextval into :NEW."activityId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table galaxia_activity_roles
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_activity_roles";

CREATE TABLE "galaxia_activity_roles" (
  "activityId" number(14) default '0' NOT NULL,
  "roleId" number(14) default '0' NOT NULL,
  PRIMARY KEY ("activityId","roleId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table galaxia_instance_activities
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_instance_activities";

CREATE TABLE "galaxia_instance_activities" (
  "instanceId" number(14) default '0' NOT NULL,
  "activityId" number(14) default '0' NOT NULL,
  "started" number(14) default '0' NOT NULL,
  "ended" number(14) default '0' NOT NULL,
  "user" varchar(40) default NULL,
  "status" varchar(11) default NULL CHECK ("status" IN ('running','completed')),
  PRIMARY KEY ("instanceId","activityId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table galaxia_instance_comments
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_instance_comments";

CREATE SEQUENCE "galaxia_instance_comments_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "galaxia_instance_comments" (
  "cId" number(14) NOT NULL,
  "instanceId" number(14) default '0' NOT NULL,
  "user" varchar(40) default NULL,
  "activityId" number(14) default NULL,
  "hash" varchar(32) default NULL,
  "title" varchar(250) default NULL,
  "comment" clob,
  "activity" varchar(80) default NULL,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("cId")
)   ;

CREATE TRIGGER "galaxia_instance_comments_trig" BEFORE INSERT ON "galaxia_instance_comments" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "galaxia_instance_comments_sequ".nextval into :NEW."cId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table galaxia_instances
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_instances";

CREATE SEQUENCE "galaxia_instances_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "galaxia_instances" (
  "instanceId" number(14) NOT NULL,
  "pId" number(14) default '0' NOT NULL,
  "started" number(14) default NULL,
  "name" varchar(200) default 'No Name' NOT NULL,
  "owner" varchar(200) default NULL,
  "nextActivity" number(14) default NULL,
  "nextUser" varchar(200) default NULL,
  "ended" number(14) default NULL,
  "status" varchar(11) default NULL CHECK ("status" IN ('active','exception','aborted','completed')),
  "properties" blob,
  PRIMARY KEY ("instanceId")
)   ;

CREATE TRIGGER "galaxia_instances_trig" BEFORE INSERT ON "galaxia_instances" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "galaxia_instances_sequ".nextval into :NEW."instanceId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table galaxia_processes
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_processes";

CREATE SEQUENCE "galaxia_processes_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "galaxia_processes" (
  "pId" number(14) NOT NULL,
  "name" varchar(80) default NULL,
  "isValid" char(1) default NULL,
  "isActive" char(1) default NULL,
  "version" varchar(12) default NULL,
  "description" clob,
  "lastModif" number(14) default NULL,
  "normalized_name" varchar(80) default NULL,
  PRIMARY KEY ("pId")
)   ;

CREATE TRIGGER "galaxia_processes_trig" BEFORE INSERT ON "galaxia_processes" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "galaxia_processes_sequ".nextval into :NEW."pId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table galaxia_roles
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_roles";

CREATE SEQUENCE "galaxia_roles_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "galaxia_roles" (
  "roleId" number(14) NOT NULL,
  "pId" number(14) default '0' NOT NULL,
  "lastModif" number(14) default NULL,
  "name" varchar(80) default NULL,
  "description" clob,
  PRIMARY KEY ("roleId")
)   ;

CREATE TRIGGER "galaxia_roles_trig" BEFORE INSERT ON "galaxia_roles" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "galaxia_roles_sequ".nextval into :NEW."roleId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table galaxia_transitions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_transitions";

CREATE TABLE "galaxia_transitions" (
  "pId" number(14) default '0' NOT NULL,
  "actFromId" number(14) default '0' NOT NULL,
  "actToId" number(14) default '0' NOT NULL,
  PRIMARY KEY ("actFromId","actToId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table galaxia_user_roles
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_user_roles";

CREATE SEQUENCE "galaxia_user_roles_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "galaxia_user_roles" (
  "pId" number(14) default '0' NOT NULL,
  "roleId" number(14) NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  PRIMARY KEY ("roleId","user")
)   ;

CREATE TRIGGER "galaxia_user_roles_trig" BEFORE INSERT ON "galaxia_user_roles" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "galaxia_user_roles_sequ".nextval into :NEW."roleId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table galaxia_workitems
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "galaxia_workitems";

CREATE SEQUENCE "galaxia_workitems_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "galaxia_workitems" (
  "itemId" number(14) NOT NULL,
  "instanceId" number(14) default '0' NOT NULL,
  "orderId" number(14) default '0' NOT NULL,
  "activityId" number(14) default '0' NOT NULL,
  "properties" blob,
  "started" number(14) default NULL,
  "ended" number(14) default NULL,
  "user" varchar(40) default NULL,
  PRIMARY KEY ("itemId")
)   ;

CREATE TRIGGER "galaxia_workitems_trig" BEFORE INSERT ON "galaxia_workitems" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "galaxia_workitems_sequ".nextval into :NEW."itemId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table messu_messages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:29 PM
--
DROP TABLE "messu_messages";

CREATE SEQUENCE "messu_messages_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "messu_messages" (
  "msgId" number(14) NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  "user_from" varchar(200) default '' NOT NULL,
  "user_to" clob,
  "user_cc" clob,
  "user_bcc" clob,
  "subject" varchar(255) default NULL,
  "body" clob,
  "hash" varchar(32) default NULL,
  "replyto_hash" varchar(32) default NULL,
  "date" number(14) default NULL,
  "isRead" char(1) default NULL,
  "isReplied" char(1) default NULL,
  "isFlagged" char(1) default NULL,
  "priority" number(2) default NULL,
  PRIMARY KEY ("msgId")
)   ;

CREATE TRIGGER "messu_messages_trig" BEFORE INSERT ON "messu_messages" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "messu_messages_sequ".nextval into :NEW."msgId" FROM DUAL;
END;
/
CREATE  INDEX "messu_messages_userIsRead" ON "messu_messages"("user" "isRead");
-- --------------------------------------------------------
--
-- Table structure for table messu_archive (same structure as messu_messages)
-- desc: user may archive his messages to this table to speed up default msg handling
--
-- Creation: Feb 26, 2005 at 03:00 PM
-- Last update: Feb 26, 2005 at 03:00 PM
--
DROP TABLE "messu_archive";

CREATE SEQUENCE "messu_archive_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "messu_archive" (
  "msgId" number(14) NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  "user_from" varchar(40) default '' NOT NULL,
  "user_to" clob,
  "user_cc" clob,
  "user_bcc" clob,
  "subject" varchar(255) default NULL,
  "body" clob,
  "hash" varchar(32) default NULL,
  "replyto_hash" varchar(32) default NULL,
  "date" number(14) default NULL,
  "isRead" char(1) default NULL,
  "isReplied" char(1) default NULL,
  "isFlagged" char(1) default NULL,
  "priority" number(2) default NULL,
  PRIMARY KEY ("msgId")
)   ;

CREATE TRIGGER "messu_archive_trig" BEFORE INSERT ON "messu_archive" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "messu_archive_sequ".nextval into :NEW."msgId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table messu_sent (same structure as messu_messages)
-- desc: user may archive his messages to this table to speed up default msg handling
--
-- Creation: Feb 26, 2005 at 11:00 PM
-- Last update: Feb 26, 2005 at 11:00 PM
--
DROP TABLE "messu_sent";

CREATE SEQUENCE "messu_sent_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "messu_sent" (
  "msgId" number(14) NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  "user_from" varchar(40) default '' NOT NULL,
  "user_to" clob,
  "user_cc" clob,
  "user_bcc" clob,
  "subject" varchar(255) default NULL,
  "body" clob,
  "hash" varchar(32) default NULL,
  "replyto_hash" varchar(32) default NULL,
  "date" number(14) default NULL,
  "isRead" char(1) default NULL,
  "isReplied" char(1) default NULL,
  "isFlagged" char(1) default NULL,
  "priority" number(2) default NULL,
  PRIMARY KEY ("msgId")
)   ;

CREATE TRIGGER "messu_sent_trig" BEFORE INSERT ON "messu_sent" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "messu_sent_sequ".nextval into :NEW."msgId" FROM DUAL;
END;
/
-- --------------------------------------------------------
DROP TABLE "sessions";

CREATE TABLE "sessions"(
  "sesskey" char(32) NOT NULL,
  "expiry" number(11) NOT NULL,
  "expireref" varchar(64),
  "data" clob NOT NULL,
  PRIMARY KEY ("sesskey")
) ;

CREATE  INDEX "sessions_expiry" ON "sessions"("expiry");

--
-- Table structure for table tiki_actionlog
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 12:29 AM
--
DROP TABLE "tiki_actionlog";

CREATE TABLE "tiki_actionlog" (
  "action" varchar(255) default '' NOT NULL,
  "lastModif" number(14) default NULL,
  "pageName" varchar(200) default NULL,
  "user" varchar(40) default NULL,
  "ip" varchar(15) default NULL,
  "comment" varchar(200) default NULL
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_articles
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:30 AM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_articles";

CREATE SEQUENCE "tiki_articles_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_articles" (
  "articleId" number(8) NOT NULL,
  "topline" varchar(255) default NULL,
  "title" varchar(80) default NULL,
  "subtitle" varchar(255) default NULL,
  "linkto" varchar(255) default NULL,
  "lang" varchar(16) default NULL,
  "state" char(1) default 's',
  "authorName" varchar(60) default NULL,
  "topicId" number(14) default NULL,
  "topicName" varchar(40) default NULL,
  "size" number(12) default NULL,
  "useImage" char(1) default NULL,
  "image_name" varchar(80) default NULL,
  "image_caption" clob default NULL,
  "image_type" varchar(80) default NULL,
  "image_size" number(14) default NULL,
  "image_x" number(4) default NULL,
  "image_y" number(4) default NULL,
  "image_data" blob,
  "publishDate" number(14) default NULL,
  "expireDate" number(14) default NULL,
  "created" number(14) default NULL,
  "heading" clob,
  "body" clob,
  "hash" varchar(32) default NULL,
  "author" varchar(200) default NULL,
  "nbreads" number(14) default NULL,
  "votes" number(8) default NULL,
  "points" number(14) default NULL,
  "type" varchar(50) default NULL,
  "rating" decimal(3,2) default NULL,
  "isfloat" char(1) default NULL,
  PRIMARY KEY ("articleId")
)   ;

CREATE TRIGGER "tiki_articles_trig" BEFORE INSERT ON "tiki_articles" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_articles_sequ".nextval into :NEW."articleId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_articles_title" ON "tiki_articles"("title");
CREATE  INDEX "tiki_articles_heading" ON "tiki_articles"("heading");
CREATE  INDEX "tiki_articles_body" ON "tiki_articles"("body");
CREATE  INDEX "tiki_articles_nbreads" ON "tiki_articles"("nbreads");
CREATE  INDEX "tiki_articles_author" ON "tiki_articles"("author");
CREATE  INDEX "tiki_articles_topicId" ON "tiki_articles"("topicId");
CREATE  INDEX "tiki_articles_publishDate" ON "tiki_articles"("publishDate");
CREATE  INDEX "tiki_articles_expireDate" ON "tiki_articles"("expireDate");
CREATE  INDEX "tiki_articles_type" ON "tiki_articles"("type");
CREATE  INDEX "tiki_articles_ft" ON "tiki_articles"("title","heading","body");
-- --------------------------------------------------------
DROP TABLE "tiki_article_types";

CREATE TABLE "tiki_article_types" (
  "type" varchar(50) NOT NULL,
  "use_ratings" varchar(1) default NULL,
  "show_pre_publ" varchar(1) default NULL,
  "show_post_expire" varchar(1) default 'y',
  "heading_only" varchar(1) default NULL,
  "allow_comments" varchar(1) default 'y',
  "show_image" varchar(1) default 'y',
  "show_avatar" varchar(1) default NULL,
  "show_author" varchar(1) default 'y',
  "show_pubdate" varchar(1) default 'y',
  "show_expdate" varchar(1) default NULL,
  "show_reads" varchar(1) default 'y',
  "show_size" char(1) default 'n',
  "show_topline" char(1) default 'n',
  "show_subtitle" char(1) default 'n',
  "show_linkto" char(1) default 'n',
  "show_image_caption" char(1) default 'n',
  "show_lang" char(1) default 'n',
  "creator_edit" varchar(1) default NULL,
  "comment_can_rate_article" char(1) default NULL,
  PRIMARY KEY ("type")
)  ;

CREATE  INDEX "tiki_article_types_show_pre_publ" ON "tiki_article_types"("show_pre_publ");
CREATE  INDEX "tiki_article_types_show_post_expire" ON "tiki_article_types"("show_post_expire");

INSERT INTO "tiki_article_types" ("type") VALUES ('Article');

INSERT INTO "tiki_article_types" ("type","use_ratings") VALUES ('Review','y');

INSERT INTO "tiki_article_types" ("type","show_post_expire") VALUES ('Event','n');

INSERT INTO "tiki_article_types" ("type","show_post_expire","heading_only","allow_comments") VALUES ('Classified','n','y','n');


--
-- Table structure for table tiki_banners
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_banners";

CREATE SEQUENCE "tiki_banners_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_banners" (
  "bannerId" number(12) NOT NULL,
  "client" varchar(200) default '' NOT NULL,
  "url" varchar(255) default NULL,
  "title" varchar(255) default NULL,
  "alt" varchar(250) default NULL,
  "which" varchar(50) default NULL,
  "imageData" blob,
  "imageType" varchar(200) default NULL,
  "imageName" varchar(100) default NULL,
  "HTMLData" clob,
  "fixedURLData" varchar(255) default NULL,
  "textData" clob,
  "fromDate" number(14) default NULL,
  "toDate" number(14) default NULL,
  "useDates" char(1) default NULL,
  "mon" char(1) default NULL,
  "tue" char(1) default NULL,
  "wed" char(1) default NULL,
  "thu" char(1) default NULL,
  "fri" char(1) default NULL,
  "sat" char(1) default NULL,
  "sun" char(1) default NULL,
  "hourFrom" varchar(4) default NULL,
  "hourTo" varchar(4) default NULL,
  "created" number(14) default NULL,
  "maxImpressions" number(8) default NULL,
  "impressions" number(8) default NULL,
  "clicks" number(8) default NULL,
  "zone" varchar(40) default NULL,
  PRIMARY KEY ("bannerId")
)   ;

CREATE TRIGGER "tiki_banners_trig" BEFORE INSERT ON "tiki_banners" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_banners_sequ".nextval into :NEW."bannerId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_banning
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_banning";

CREATE SEQUENCE "tiki_banning_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_banning" (
  "banId" number(12) NOT NULL,
  "mode" varchar(6) default NULL CHECK ("mode" IN ('user','ip')),
  "title" varchar(200) default NULL,
  "ip1" char(3) default NULL,
  "ip2" char(3) default NULL,
  "ip3" char(3) default NULL,
  "ip4" char(3) default NULL,
  "user" varchar(40) default NULL,
  "date_from" timestamp(3) NOT NULL,
  "date_to" timestamp(3) NOT NULL,
  "use_dates" char(1) default NULL,
  "created" number(14) default NULL,
  "message" clob,
  PRIMARY KEY ("banId")
)   ;

CREATE TRIGGER "tiki_banning_trig" BEFORE INSERT ON "tiki_banning" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_banning_sequ".nextval into :NEW."banId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_banning_sections
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_banning_sections";

CREATE TABLE "tiki_banning_sections" (
  "banId" number(12) default '0' NOT NULL,
  "section" varchar(100) default '' NOT NULL,
  PRIMARY KEY ("banId","section")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_blog_activity
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 04:52 PM
--
DROP TABLE "tiki_blog_activity";

CREATE TABLE "tiki_blog_activity" (
  "blogId" number(8) default '0' NOT NULL,
  "day" number(14) default '0' NOT NULL,
  "posts" number(8) default NULL,
  PRIMARY KEY ("blogId","day")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_blog_posts
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 04:52 PM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_blog_posts";

CREATE SEQUENCE "tiki_blog_posts_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_blog_posts" (
  "postId" number(8) NOT NULL,
  "blogId" number(8) default '0' NOT NULL,
  "data" clob,
  "data_size" number(11) default '0' NOT NULL,
  "created" number(14) default NULL,
  "user" varchar(40) default NULL,
  "trackbacks_to" clob,
  "trackbacks_from" clob,
  "title" varchar(80) default NULL,
  "priv" varchar(1) default NULL,
  PRIMARY KEY ("postId")
)   ;

CREATE TRIGGER "tiki_blog_posts_trig" BEFORE INSERT ON "tiki_blog_posts" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_blog_posts_sequ".nextval into :NEW."postId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_blog_posts_data" ON "tiki_blog_posts"("data");
CREATE  INDEX "tiki_blog_posts_blogId" ON "tiki_blog_posts"("blogId");
CREATE  INDEX "tiki_blog_posts_created" ON "tiki_blog_posts"("created");
CREATE  INDEX "tiki_blog_posts_ft" ON "tiki_blog_posts"("data","title");
-- --------------------------------------------------------
--
-- Table structure for table tiki_blog_posts_images
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_blog_posts_images";

CREATE SEQUENCE "tiki_blog_posts_images_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_blog_posts_images" (
  "imgId" number(14) NOT NULL,
  "postId" number(14) default '0' NOT NULL,
  "filename" varchar(80) default NULL,
  "filetype" varchar(80) default NULL,
  "filesize" number(14) default NULL,
  "data" blob,
  PRIMARY KEY ("imgId")
)   ;

CREATE TRIGGER "tiki_blog_posts_images_trig" BEFORE INSERT ON "tiki_blog_posts_images" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_blog_posts_images_sequ".nextval into :NEW."imgId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_blogs
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:07 AM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_blogs";

CREATE SEQUENCE "tiki_blogs_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_blogs" (
  "blogId" number(8) NOT NULL,
  "created" number(14) default NULL,
  "lastModif" number(14) default NULL,
  "title" varchar(200) default NULL,
  "description" clob,
  "user" varchar(40) default NULL,
  "public" char(1) default NULL,
  "posts" number(8) default NULL,
  "maxPosts" number(8) default NULL,
  "hits" number(8) default NULL,
  "activity" decimal(4,2) default NULL,
  "heading" clob,
  "use_find" char(1) default NULL,
  "use_title" char(1) default NULL,
  "add_date" char(1) default NULL,
  "add_poster" char(1) default NULL,
  "allow_comments" char(1) default NULL,
  "show_avatar" char(1) default NULL,
  PRIMARY KEY ("blogId")
)   ;

CREATE TRIGGER "tiki_blogs_trig" BEFORE INSERT ON "tiki_blogs" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_blogs_sequ".nextval into :NEW."blogId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_blogs_title" ON "tiki_blogs"("title");
CREATE  INDEX "tiki_blogs_description" ON "tiki_blogs"("description");
CREATE  INDEX "tiki_blogs_hits" ON "tiki_blogs"("hits");
CREATE  INDEX "tiki_blogs_ft" ON "tiki_blogs"("title","description");
-- --------------------------------------------------------
--
-- Table structure for table tiki_calendar_categories
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:05 AM
--
DROP TABLE "tiki_calendar_categories";

CREATE SEQUENCE "tiki_calendar_categories_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_calendar_categories" (
  "calcatId" number(11) NOT NULL,
  "calendarId" number(14) default '0' NOT NULL,
  "name" varchar(255) default '' NOT NULL,
  PRIMARY KEY ("calcatId")
)   ;

CREATE TRIGGER "tiki_calendar_categories_trig" BEFORE INSERT ON "tiki_calendar_categories" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_calendar_categories_sequ".nextval into :NEW."calcatId" FROM DUAL;
END;
/
CREATE UNIQUE INDEX "tiki_calendar_categories_catname" ON "tiki_calendar_categories"("calendarId","name");
-- --------------------------------------------------------
--
-- Table structure for table tiki_calendar_items
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:43 AM
--
DROP TABLE "tiki_calendar_items";

CREATE SEQUENCE "tiki_calendar_items_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_calendar_items" (
  "calitemId" number(14) NOT NULL,
  "calendarId" number(14) default '0' NOT NULL,
  "start" number(14) default '0' NOT NULL,
  "end" number(14) default '0' NOT NULL,
  "locationId" number(14) default NULL,
  "categoryId" number(14) default NULL,
  "nlId" number(12) default '0' NOT NULL,
  "priority" varchar(3) default '1' NOT NULL CHECK ("priority" IN ('1','2','3','4','5','6','7','8','9')),
  "status" varchar(3) default '0' NOT NULL CHECK ("status" IN ('0','1','2')),
  "url" varchar(255) default NULL,
  "lang" char(16) default 'en' NOT NULL,
  "name" varchar(255) default '' NOT NULL,
  "description" blob,
  "user" varchar(40) default NULL,
  "created" number(14) default '0' NOT NULL,
  "lastmodif" number(14) default '0' NOT NULL,
  PRIMARY KEY ("calitemId")
)   ;

CREATE TRIGGER "tiki_calendar_items_trig" BEFORE INSERT ON "tiki_calendar_items" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_calendar_items_sequ".nextval into :NEW."calitemId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_calendar_items_calendarId" ON "tiki_calendar_items"("calendarId");
-- --------------------------------------------------------
--
-- Table structure for table tiki_calendar_locations
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:05 AM
--
DROP TABLE "tiki_calendar_locations";

CREATE SEQUENCE "tiki_calendar_locations_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_calendar_locations" (
  "callocId" number(14) NOT NULL,
  "calendarId" number(14) default '0' NOT NULL,
  "name" varchar(255) default '' NOT NULL,
  "description" blob,
  PRIMARY KEY ("callocId")
)   ;

CREATE TRIGGER "tiki_calendar_locations_trig" BEFORE INSERT ON "tiki_calendar_locations" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_calendar_locations_sequ".nextval into :NEW."callocId" FROM DUAL;
END;
/
CREATE UNIQUE INDEX "tiki_calendar_locations_locname" ON "tiki_calendar_locations"("calendarId","name");
-- --------------------------------------------------------
--
-- Table structure for table tiki_calendar_roles
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_calendar_roles";

CREATE TABLE "tiki_calendar_roles" (
  "calitemId" number(14) default '0' NOT NULL,
  "username" varchar(40) default '' NOT NULL,
  "role" varchar(3) default '0' NOT NULL CHECK ("role" IN ('0','1','2','3','6')),
  PRIMARY KEY ("calitemId","username","role")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_calendars
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 05, 2003 at 02:03 PM
--
DROP TABLE "tiki_calendars";

CREATE SEQUENCE "tiki_calendars_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_calendars" (
  "calendarId" number(14) NOT NULL,
  "name" varchar(80) default '' NOT NULL,
  "description" varchar(255) default NULL,
  "user" varchar(40) default '' NOT NULL,
  "customlocations" varchar(3) default 'n' NOT NULL CHECK ("customlocations" IN ('n','y')),
  "customcategories" varchar(3) default 'n' NOT NULL CHECK ("customcategories" IN ('n','y')),
  "customlanguages" varchar(3) default 'n' NOT NULL CHECK ("customlanguages" IN ('n','y')),
  "custompriorities" varchar(3) default 'n' NOT NULL CHECK ("custompriorities" IN ('n','y')),
  "customparticipants" varchar(3) default 'n' NOT NULL CHECK ("customparticipants" IN ('n','y')),
  "customsubscription" varchar(3) default 'n' NOT NULL CHECK ("customsubscription" IN ('n','y')),
  "created" number(14) default '0' NOT NULL,
  "lastmodif" number(14) default '0' NOT NULL,
  "personal" enum ('n', 'y') default 'n' NOT NULL,
  PRIMARY KEY ("calendarId")
)   ;

CREATE TRIGGER "tiki_calendars_trig" BEFORE INSERT ON "tiki_calendars" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_calendars_sequ".nextval into :NEW."calendarId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_categories
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 04, 2003 at 09:47 PM
--
DROP TABLE "tiki_categories";

CREATE SEQUENCE "tiki_categories_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_categories" (
  "categId" number(12) NOT NULL,
  "name" varchar(100) default NULL,
  "description" varchar(250) default NULL,
  "parentId" number(12) default NULL,
  "hits" number(8) default NULL,
  PRIMARY KEY ("categId")
)   ;

CREATE TRIGGER "tiki_categories_trig" BEFORE INSERT ON "tiki_categories" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_categories_sequ".nextval into :NEW."categId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_categorized_objects
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:09 AM
--
DROP TABLE "tiki_categorized_objects";

CREATE SEQUENCE "tiki_categorized_objects_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_categorized_objects" (
  "catObjectId" number(12) NOT NULL,
  "type" varchar(50) default NULL,
  "objId" varchar(255) default NULL,
  "description" clob,
  "created" number(14) default NULL,
  "name" varchar(200) default NULL,
  "href" varchar(200) default NULL,
  "hits" number(8) default NULL,
  PRIMARY KEY ("catObjectId")
  KEY(type, objId)
)   ;

CREATE TRIGGER "tiki_categorized_objects_trig" BEFORE INSERT ON "tiki_categorized_objects" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_categorized_objects_sequ".nextval into :NEW."catObjectId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_category_objects
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:09 AM
--
DROP TABLE "tiki_category_objects";

CREATE TABLE "tiki_category_objects" (
  "catObjectId" number(12) default '0' NOT NULL,
  "categId" number(12) default '0' NOT NULL,
  PRIMARY KEY ("catObjectId","categId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_category_sites
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 07, 2003 at 01:53 AM
--
DROP TABLE "tiki_object_ratings";

CREATE TABLE "tiki_object_ratings" (
  "catObjectId" number(12) default '0' NOT NULL,
  "pollId" number(12) default '0' NOT NULL,
  PRIMARY KEY ("catObjectId","pollId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_category_sites
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 07, 2003 at 01:53 AM
--
DROP TABLE "tiki_category_sites";

CREATE TABLE "tiki_category_sites" (
  "categId" number(10) default '0' NOT NULL,
  "siteId" number(14) default '0' NOT NULL,
  PRIMARY KEY ("categId","siteId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_chart_items
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_chart_items";

CREATE SEQUENCE "tiki_chart_items_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_chart_items" (
  "itemId" number(14) NOT NULL,
  "title" varchar(250) default NULL,
  "description" clob,
  "chartId" number(14) default '0' NOT NULL,
  "created" number(14) default NULL,
  "URL" varchar(250) default NULL,
  "votes" number(14) default NULL,
  "points" number(14) default NULL,
  "average" decimal(4,2) default NULL,
  PRIMARY KEY ("itemId")
)   ;

CREATE TRIGGER "tiki_chart_items_trig" BEFORE INSERT ON "tiki_chart_items" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_chart_items_sequ".nextval into :NEW."itemId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_charts
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 06, 2003 at 08:14 AM
--
DROP TABLE "tiki_charts";

CREATE SEQUENCE "tiki_charts_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_charts" (
  "chartId" number(14) NOT NULL,
  "title" varchar(250) default NULL,
  "description" clob,
  "hits" number(14) default NULL,
  "singleItemVotes" char(1) default NULL,
  "singleChartVotes" char(1) default NULL,
  "suggestions" char(1) default NULL,
  "autoValidate" char(1) default NULL,
  "topN" number(6) default NULL,
  "maxVoteValue" number(4) default NULL,
  "frequency" number(14) default NULL,
  "showAverage" char(1) default NULL,
  "isActive" char(1) default NULL,
  "showVotes" char(1) default NULL,
  "useCookies" char(1) default NULL,
  "lastChart" number(14) default NULL,
  "voteAgainAfter" number(14) default NULL,
  "created" number(14) default NULL,
  PRIMARY KEY ("chartId")
)   ;

CREATE TRIGGER "tiki_charts_trig" BEFORE INSERT ON "tiki_charts" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_charts_sequ".nextval into :NEW."chartId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_charts_rankings
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_charts_rankings";

CREATE TABLE "tiki_charts_rankings" (
  "chartId" number(14) default '0' NOT NULL,
  "itemId" number(14) default '0' NOT NULL,
  "position" number(14) default '0' NOT NULL,
  "timestamp" number(14) default '0' NOT NULL,
  "lastPosition" number(14) default '0' NOT NULL,
  "period" number(14) default '0' NOT NULL,
  "rvotes" number(14) default '0' NOT NULL,
  "raverage" decimal(4,2) default '0.00' NOT NULL,
  PRIMARY KEY ("chartId","itemId","period")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_charts_votes
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_charts_votes";

CREATE TABLE "tiki_charts_votes" (
  "user" varchar(40) default '' NOT NULL,
  "itemId" number(14) default '0' NOT NULL,
  "timestamp" number(14) default NULL,
  "chartId" number(14) default NULL,
  PRIMARY KEY ("user","itemId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_chat_channels
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_chat_channels";

CREATE SEQUENCE "tiki_chat_channels_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_chat_channels" (
  "channelId" number(8) NOT NULL,
  "name" varchar(30) default NULL,
  "description" varchar(250) default NULL,
  "max_users" number(8) default NULL,
  "mode" char(1) default NULL,
  "moderator" varchar(200) default NULL,
  "active" char(1) default NULL,
  "refresh" number(6) default NULL,
  PRIMARY KEY ("channelId")
)   ;

CREATE TRIGGER "tiki_chat_channels_trig" BEFORE INSERT ON "tiki_chat_channels" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_chat_channels_sequ".nextval into :NEW."channelId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_chat_messages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_chat_messages";

CREATE SEQUENCE "tiki_chat_messages_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_chat_messages" (
  "messageId" number(8) NOT NULL,
  "channelId" number(8) default '0' NOT NULL,
  "data" varchar(255) default NULL,
  "poster" varchar(200) default 'anonymous' NOT NULL,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("messageId")
)   ;

CREATE TRIGGER "tiki_chat_messages_trig" BEFORE INSERT ON "tiki_chat_messages" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_chat_messages_sequ".nextval into :NEW."messageId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_chat_users
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_chat_users";

CREATE TABLE "tiki_chat_users" (
  "nickname" varchar(200) default '' NOT NULL,
  "channelId" number(8) default '0' NOT NULL,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("nickname","channelId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_comments
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 10:56 PM
-- Last check: Jul 11, 2003 at 01:52 AM
--
DROP TABLE "tiki_comments";

CREATE SEQUENCE "tiki_comments_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_comments" (
  "threadId" number(14) NOT NULL,
  "object" varchar(255) default '' NOT NULL,
  "objectType" varchar(32) default '' NOT NULL,
  "parentId" number(14) default NULL,
  "userName" varchar(40) default NULL,
  "commentDate" number(14) default NULL,
  "hits" number(8) default NULL,
  "type" char(1) default NULL,
  "points" decimal(8,2) default NULL,
  "votes" number(8) default NULL,
  "average" decimal(8,4) default NULL,
  "title" varchar(100) default NULL,
  "data" clob,
  "hash" varchar(32) default NULL,
  "user_ip" varchar(15) default NULL,
  "summary" varchar(240) default NULL,
  "smiley" varchar(80) default NULL,
  "message_id" varchar(250) default NULL,
  "in_reply_to" varchar(250) default NULL,
  "comment_rating" number(2) default NULL,  
  PRIMARY KEY ("threadId")
)   ;

CREATE TRIGGER "tiki_comments_trig" BEFORE INSERT ON "tiki_comments" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_comments_sequ".nextval into :NEW."threadId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_comments_title" ON "tiki_comments"("title");
CREATE  INDEX "tiki_comments_data" ON "tiki_comments"("data");
CREATE  INDEX "tiki_comments_hits" ON "tiki_comments"("hits");
CREATE  INDEX "tiki_comments_tc_pi" ON "tiki_comments"("parentId");
CREATE  INDEX "tiki_comments_objectType" ON "tiki_comments"("object" "objectType");
CREATE  INDEX "tiki_comments_commentDate" ON "tiki_comments"("commentDate");
CREATE  INDEX "tiki_comments_ft" ON "tiki_comments"("title","data");
-- --------------------------------------------------------
--
-- Table structure for table tiki_content
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_content";

CREATE SEQUENCE "tiki_content_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_content" (
  "contentId" number(8) NOT NULL,
  "description" clob,
  PRIMARY KEY ("contentId")
)   ;

CREATE TRIGGER "tiki_content_trig" BEFORE INSERT ON "tiki_content" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_content_sequ".nextval into :NEW."contentId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_content_templates
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 12:37 AM
--
DROP TABLE "tiki_content_templates";

CREATE SEQUENCE "tiki_content_templates_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_content_templates" (
  "templateId" number(10) NOT NULL,
  "content" blob,
  "name" varchar(200) default NULL,
  "created" number(14) default NULL,
  PRIMARY KEY ("templateId")
)   ;

CREATE TRIGGER "tiki_content_templates_trig" BEFORE INSERT ON "tiki_content_templates" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_content_templates_sequ".nextval into :NEW."templateId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_content_templates_sections
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 12:37 AM
--
DROP TABLE "tiki_content_templates_sections";

CREATE TABLE "tiki_content_templates_sections" (
  "templateId" number(10) default '0' NOT NULL,
  "section" varchar(250) default '' NOT NULL,
  PRIMARY KEY ("templateId","section")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_cookies
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 10, 2003 at 04:00 AM
--
DROP TABLE "tiki_cookies";

CREATE SEQUENCE "tiki_cookies_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_cookies" (
  "cookieId" number(10) NOT NULL,
  "cookie" clob,
  PRIMARY KEY ("cookieId")
)   ;

CREATE TRIGGER "tiki_cookies_trig" BEFORE INSERT ON "tiki_cookies" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_cookies_sequ".nextval into :NEW."cookieId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_copyrights
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_copyrights";

CREATE SEQUENCE "tiki_copyrights_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_copyrights" (
  "copyrightId" number(12) NOT NULL,
  "page" varchar(200) default NULL,
  "title" varchar(200) default NULL,
  "year" number(11) default NULL,
  "authors" varchar(200) default NULL,
  "copyright_order" number(11) default NULL,
  "userName" varchar(40) default NULL,
  PRIMARY KEY ("copyrightId")
)   ;

CREATE TRIGGER "tiki_copyrights_trig" BEFORE INSERT ON "tiki_copyrights" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_copyrights_sequ".nextval into :NEW."copyrightId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_directory_categories
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:59 PM
--
DROP TABLE "tiki_directory_categories";

CREATE SEQUENCE "tiki_directory_categories_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_directory_categories" (
  "categId" number(10) NOT NULL,
  "parent" number(10) default NULL,
  "name" varchar(240) default NULL,
  "description" clob,
  "childrenType" char(1) default NULL,
  "sites" number(10) default NULL,
  "viewableChildren" number(4) default NULL,
  "allowSites" char(1) default NULL,
  "showCount" char(1) default NULL,
  "editorGroup" varchar(200) default NULL,
  "hits" number(12) default NULL,
  PRIMARY KEY ("categId")
)   ;

CREATE TRIGGER "tiki_directory_categories_trig" BEFORE INSERT ON "tiki_directory_categories" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_directory_categories_sequ".nextval into :NEW."categId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_directory_search
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_directory_search";

CREATE TABLE "tiki_directory_search" (
  "term" varchar(250) default '' NOT NULL,
  "hits" number(14) default NULL,
  PRIMARY KEY ("term")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_directory_sites
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:32 PM
--
DROP TABLE "tiki_directory_sites";

CREATE SEQUENCE "tiki_directory_sites_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_directory_sites" (
  "siteId" number(14) NOT NULL,
  "name" varchar(240) default NULL,
  "description" clob,
  "url" varchar(255) default NULL,
  "country" varchar(255) default NULL,
  "hits" number(12) default NULL,
  "isValid" char(1) default NULL,
  "created" number(14) default NULL,
  "lastModif" number(14) default NULL,
  "cache" blob,
  "cache_timestamp" number(14) default NULL,
  PRIMARY KEY ("siteId")
)   ;

CREATE TRIGGER "tiki_directory_sites_trig" BEFORE INSERT ON "tiki_directory_sites" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_directory_sites_sequ".nextval into :NEW."siteId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_directory_sites_ft" ON "tiki_directory_sites"("name","description");
-- --------------------------------------------------------
--
-- Table structure for table tiki_drawings
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 08, 2003 at 05:02 AM
--
DROP TABLE "tiki_drawings";

CREATE SEQUENCE "tiki_drawings_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_drawings" (
  "drawId" number(12) NOT NULL,
  "version" number(8) default NULL,
  "name" varchar(250) default NULL,
  "filename_draw" varchar(250) default NULL,
  "filename_pad" varchar(250) default NULL,
  "timestamp" number(14) default NULL,
  "user" varchar(40) default NULL,
  PRIMARY KEY ("drawId")
)   ;

CREATE TRIGGER "tiki_drawings_trig" BEFORE INSERT ON "tiki_drawings" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_drawings_sequ".nextval into :NEW."drawId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_dsn
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_dsn";

CREATE SEQUENCE "tiki_dsn_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_dsn" (
  "dsnId" number(12) NOT NULL,
  "name" varchar(200) default '' NOT NULL,
  "dsn" varchar(255) default NULL,
  PRIMARY KEY ("dsnId")
)   ;

CREATE TRIGGER "tiki_dsn_trig" BEFORE INSERT ON "tiki_dsn" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_dsn_sequ".nextval into :NEW."dsnId" FROM DUAL;
END;
/
-- --------------------------------------------------------
DROP TABLE "tiki_dynamic_variables";

CREATE TABLE "tiki_dynamic_variables" (
  "name" varchar(40) NOT NULL,
  "data" clob,
  PRIMARY KEY ("name")
);


--
-- Table structure for table tiki_eph
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 06, 2003 at 08:23 AM
--
DROP TABLE "tiki_eph";

CREATE SEQUENCE "tiki_eph_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_eph" (
  "ephId" number(12) NOT NULL,
  "title" varchar(250) default NULL,
  "isFile" char(1) default NULL,
  "filename" varchar(250) default NULL,
  "filetype" varchar(250) default NULL,
  "filesize" varchar(250) default NULL,
  "data" blob,
  "textdata" blob,
  "publish" number(14) default NULL,
  "hits" number(10) default NULL,
  PRIMARY KEY ("ephId")
)   ;

CREATE TRIGGER "tiki_eph_trig" BEFORE INSERT ON "tiki_eph" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_eph_sequ".nextval into :NEW."ephId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_extwiki
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_extwiki";

CREATE SEQUENCE "tiki_extwiki_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_extwiki" (
  "extwikiId" number(12) NOT NULL,
  "name" varchar(200) default '' NOT NULL,
  "extwiki" varchar(255) default NULL,
  PRIMARY KEY ("extwikiId")
)   ;

CREATE TRIGGER "tiki_extwiki_trig" BEFORE INSERT ON "tiki_extwiki" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_extwiki_sequ".nextval into :NEW."extwikiId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_faq_questions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_faq_questions";

CREATE SEQUENCE "tiki_faq_questions_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_faq_questions" (
  "questionId" number(10) NOT NULL,
  "faqId" number(10) default NULL,
  "position" number(4) default NULL,
  "question" clob,
  "answer" clob,
  PRIMARY KEY ("questionId")
)   ;

CREATE TRIGGER "tiki_faq_questions_trig" BEFORE INSERT ON "tiki_faq_questions" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_faq_questions_sequ".nextval into :NEW."questionId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_faq_questions_faqId" ON "tiki_faq_questions"("faqId");
CREATE  INDEX "tiki_faq_questions_question" ON "tiki_faq_questions"("question");
CREATE  INDEX "tiki_faq_questions_answer" ON "tiki_faq_questions"("answer");
CREATE  INDEX "tiki_faq_questions_ft" ON "tiki_faq_questions"("question","answer");
-- --------------------------------------------------------
--
-- Table structure for table tiki_faqs
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 09:09 PM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_faqs";

CREATE SEQUENCE "tiki_faqs_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_faqs" (
  "faqId" number(10) NOT NULL,
  "title" varchar(200) default NULL,
  "description" clob,
  "created" number(14) default NULL,
  "questions" number(5) default NULL,
  "hits" number(8) default NULL,
  "canSuggest" char(1) default NULL,
  PRIMARY KEY ("faqId")
)   ;

CREATE TRIGGER "tiki_faqs_trig" BEFORE INSERT ON "tiki_faqs" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_faqs_sequ".nextval into :NEW."faqId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_faqs_title" ON "tiki_faqs"("title");
CREATE  INDEX "tiki_faqs_description" ON "tiki_faqs"("description");
CREATE  INDEX "tiki_faqs_hits" ON "tiki_faqs"("hits");
CREATE  INDEX "tiki_faqs_ft" ON "tiki_faqs"("title","description");
-- --------------------------------------------------------
--
-- Table structure for table tiki_featured_links
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 11:08 PM
--
DROP TABLE "tiki_featured_links";

CREATE TABLE "tiki_featured_links" (
  "url" varchar(200) default '' NOT NULL,
  "title" varchar(200) default NULL,
  "description" clob,
  "hits" number(8) default NULL,
  "position" number(6) default NULL,
  "type" char(1) default NULL,
  PRIMARY KEY ("url")
) ;

-- --------------------------------------------------------
-- Table structure for table tiki_file_galleries
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:13 AM
--
DROP TABLE "tiki_file_galleries";

CREATE SEQUENCE "tiki_file_galleries_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_file_galleries" (
  "galleryId" number(14) NOT NULL,
  "name" varchar(80) default '' NOT NULL,
  "description" clob,
  "created" number(14) default NULL,
  "visible" char(1) default NULL,
  "lastModif" number(14) default NULL,
  "user" varchar(40) default NULL,
  "hits" number(14) default NULL,
  "votes" number(8) default NULL,
  "points" decimal(8,2) default NULL,
  "maxRows" number(10) default NULL,
  "public" char(1) default NULL,
  "show_id" char(1) default NULL,
  "show_icon" char(1) default NULL,
  "show_name" char(1) default NULL,
  "show_size" char(1) default NULL,
  "show_description" char(1) default NULL,
  "max_desc" number(8) default NULL,
  "show_created" char(1) default NULL,
  "show_dl" char(1) default NULL,
  PRIMARY KEY ("galleryId")
)   ;

CREATE TRIGGER "tiki_file_galleries_trig" BEFORE INSERT ON "tiki_file_galleries" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_file_galleries_sequ".nextval into :NEW."galleryId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_files
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Nov 02, 2004 at 05:59 PM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_files";

CREATE SEQUENCE "tiki_files_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_files" (
  "fileId" number(14) NOT NULL,
  "galleryId" number(14) default '0' NOT NULL,
  "name" varchar(200) default '' NOT NULL,
  "description" clob,
  "created" number(14) default NULL,
  "filename" varchar(80) default NULL,
  "filesize" number(14) default NULL,
  "filetype" varchar(250) default NULL,
  "data" blob,
  "user" varchar(40) default NULL,
  "downloads" number(14) default NULL,
  "votes" number(8) default NULL,
  "points" decimal(8,2) default NULL,
  "path" varchar(255) default NULL,
  "reference_url" varchar(250) default NULL,
  "is_reference" char(1) default NULL,
  "hash" varchar(32) default NULL,
  "search_data" longtext,
  "lastModif" integer(14) DEFAULT NULL,
  "lastModifUser" varchar(200) DEFAULT NULL,
  PRIMARY KEY ("fileId")
)   ;

CREATE TRIGGER "tiki_files_trig" BEFORE INSERT ON "tiki_files" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_files_sequ".nextval into :NEW."fileId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_files_name" ON "tiki_files"("name");
CREATE  INDEX "tiki_files_description" ON "tiki_files"("description");
CREATE  INDEX "tiki_files_downloads" ON "tiki_files"("downloads");
CREATE  INDEX "tiki_files_ft" ON "tiki_files"("name","description","search_data");
-- --------------------------------------------------------
--
-- Table structure for table tiki_forum_attachments
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_forum_attachments";

CREATE SEQUENCE "tiki_forum_attachments_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_forum_attachments" (
  "attId" number(14) NOT NULL,
  "threadId" number(14) default '0' NOT NULL,
  "qId" number(14) default '0' NOT NULL,
  "forumId" number(14) default NULL,
  "filename" varchar(250) default NULL,
  "filetype" varchar(250) default NULL,
  "filesize" number(12) default NULL,
  "data" blob,
  "dir" varchar(200) default NULL,
  "created" number(14) default NULL,
  "path" varchar(250) default NULL,
  PRIMARY KEY ("attId")
)   ;

CREATE TRIGGER "tiki_forum_attachments_trig" BEFORE INSERT ON "tiki_forum_attachments" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_forum_attachments_sequ".nextval into :NEW."attId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_forum_attachments_threadId" ON "tiki_forum_attachments"("threadId");
-- --------------------------------------------------------
--
-- Table structure for table tiki_forum_reads
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:17 PM
--
DROP TABLE "tiki_forum_reads";

CREATE TABLE "tiki_forum_reads" (
  "user" varchar(40) default '' NOT NULL,
  "threadId" number(14) default '0' NOT NULL,
  "forumId" number(14) default NULL,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("user","threadId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_forums
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 11:14 PM
--
DROP TABLE "tiki_forums";

CREATE SEQUENCE "tiki_forums_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_forums" (
  "forumId" number(8) NOT NULL,
  "name" varchar(200) default NULL,
  "description" clob,
  "created" number(14) default NULL,
  "lastPost" number(14) default NULL,
  "threads" number(8) default NULL,
  "comments" number(8) default NULL,
  "controlFlood" char(1) default NULL,
  "floodInterval" number(8) default NULL,
  "moderator" varchar(200) default NULL,
  "hits" number(8) default NULL,
  "mail" varchar(200) default NULL,
  "useMail" char(1) default NULL,
  "section" varchar(200) default NULL,
  "usePruneUnreplied" char(1) default NULL,
  "pruneUnrepliedAge" number(8) default NULL,
  "usePruneOld" char(1) default NULL,
  "pruneMaxAge" number(8) default NULL,
  "topicsPerPage" number(6) default NULL,
  "topicOrdering" varchar(100) default NULL,
  "threadOrdering" varchar(100) default NULL,
  "att" varchar(80) default NULL,
  "att_store" varchar(4) default NULL,
  "att_store_dir" varchar(250) default NULL,
  "att_max_size" number(12) default NULL,
  "ui_level" char(1) default NULL,
  "forum_password" varchar(32) default NULL,
  "forum_use_password" char(1) default NULL,
  "moderator_group" varchar(200) default NULL,
  "approval_type" varchar(20) default NULL,
  "outbound_address" varchar(250) default NULL,
  "outbound_mails_for_inbound_mails" char(1) default NULL,
  "outbound_mails_reply_link" char(1) default NULL,
  "outbound_from" varchar(250) default NULL,
  "inbound_pop_server" varchar(250) default NULL,
  "inbound_pop_port" number(4) default NULL,
  "inbound_pop_user" varchar(200) default NULL,
  "inbound_pop_password" varchar(80) default NULL,
  "topic_smileys" char(1) default NULL,
  "ui_avatar" char(1) default NULL,
  "ui_flag" char(1) default NULL,
  "ui_posts" char(1) default NULL,
  "ui_email" char(1) default NULL,
  "ui_online" char(1) default NULL,
  "topic_summary" char(1) default NULL,
  "show_description" char(1) default NULL,
  "topics_list_replies" char(1) default NULL,
  "topics_list_reads" char(1) default NULL,
  "topics_list_pts" char(1) default NULL,
  "topics_list_lastpost" char(1) default NULL,
  "topics_list_author" char(1) default NULL,
  "vote_threads" char(1) default NULL,
  "forum_last_n" number(2) default 0,
  PRIMARY KEY ("forumId")
)   ;

CREATE TRIGGER "tiki_forums_trig" BEFORE INSERT ON "tiki_forums" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_forums_sequ".nextval into :NEW."forumId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_forums_queue
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_forums_queue";

CREATE SEQUENCE "tiki_forums_queue_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_forums_queue" (
  "qId" number(14) NOT NULL,
  "object" varchar(32) default NULL,
  "parentId" number(14) default NULL,
  "forumId" number(14) default NULL,
  "timestamp" number(14) default NULL,
  "user" varchar(40) default NULL,
  "title" varchar(240) default NULL,
  "data" clob,
  "type" varchar(60) default NULL,
  "hash" varchar(32) default NULL,
  "topic_smiley" varchar(80) default NULL,
  "topic_title" varchar(240) default NULL,
  "summary" varchar(240) default NULL,
  PRIMARY KEY ("qId")
)   ;

CREATE TRIGGER "tiki_forums_queue_trig" BEFORE INSERT ON "tiki_forums_queue" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_forums_queue_sequ".nextval into :NEW."qId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_forums_reported
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_forums_reported";

CREATE TABLE "tiki_forums_reported" (
  "threadId" number(12) default '0' NOT NULL,
  "forumId" number(12) default '0' NOT NULL,
  "parentId" number(12) default '0' NOT NULL,
  "user" varchar(40) default NULL,
  "timestamp" number(14) default NULL,
  "reason" varchar(250) default NULL,
  PRIMARY KEY ("threadId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_galleries
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Sep 18, 2004 at 11:56 PM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_galleries";

CREATE SEQUENCE "tiki_galleries_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_galleries" (
  "galleryId" number(14) NOT NULL,
  "name" varchar(80) default '' NOT NULL,
  "description" clob,
  "created" number(14) default NULL,
  "lastModif" number(14) default NULL,
  "visible" char(1) default NULL,
  "geographic" char(1) default NULL,
  "theme" varchar(60) default NULL,
  "user" varchar(40) default NULL,
  "hits" number(14) default NULL,
  "maxRows" number(10) default NULL,
  "rowImages" number(10) default NULL,
  "thumbSizeX" number(10) default NULL,
  "thumbSizeY" number(10) default NULL,
  "public" char(1) default NULL,
  "sortorder" varchar(20) default 'created' NOT NULL,
  "sortdirection" varchar(4) default 'desc' NOT NULL,
  "galleryimage" varchar(20) default 'first' NOT NULL,
  "parentgallery" number(14) default '-1' NOT NULL,
  "showname" char(1) default 'y' NOT NULL,
  "showimageid" char(1) default 'n' NOT NULL,
  "showdescription" char(1) default 'n' NOT NULL,
  "showcreated" char(1) default 'n' NOT NULL,
  "showuser" char(1) default 'n' NOT NULL,
  "showhits" char(1) default 'y' NOT NULL,
  "showxysize" char(1) default 'y' NOT NULL,
  "showfilesize" char(1) default 'n' NOT NULL,
  "showfilename" char(1) default 'n' NOT NULL,
  "defaultscale" varchar(10) DEFAULT 'o' NOT NULL,
  PRIMARY KEY ("galleryId")
)   ;

CREATE TRIGGER "tiki_galleries_trig" BEFORE INSERT ON "tiki_galleries" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_galleries_sequ".nextval into :NEW."galleryId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_galleries_name" ON "tiki_galleries"("name");
CREATE  INDEX "tiki_galleries_description" ON "tiki_galleries"("description");
CREATE  INDEX "tiki_galleries_hits" ON "tiki_galleries"("hits");
CREATE  INDEX "tiki_galleries_parentgallery" ON "tiki_galleries"("parentgallery");
CREATE  INDEX "tiki_galleries_visibleUser" ON "tiki_galleries"("visible" "user");
CREATE  INDEX "tiki_galleries_ft" ON "tiki_galleries"("name","description");
-- --------------------------------------------------------
--
-- Table structure for table tiki_galleries_scales
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_galleries_scales";

CREATE TABLE "tiki_galleries_scales" (
  "galleryId" number(14) default '0' NOT NULL,
  "scale" number(11) default '0' NOT NULL,
  PRIMARY KEY ("galleryId","scale")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_games
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 05, 2003 at 08:23 PM
--
DROP TABLE "tiki_games";

CREATE TABLE "tiki_games" (
  "gameName" varchar(200) default '' NOT NULL,
  "hits" number(8) default NULL,
  "votes" number(8) default NULL,
  "points" number(8) default NULL,
  PRIMARY KEY ("gameName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_group_inclusion
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 05, 2003 at 02:03 AM
--
DROP TABLE "tiki_group_inclusion";

CREATE TABLE "tiki_group_inclusion" (
  "groupName" varchar(255) default '' NOT NULL,
  "includeGroup" varchar(255) default '' NOT NULL,
  PRIMARY KEY ("groupName","includeGroup")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_history
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Mar 30, 2005 at 10:21 PM
--
DROP TABLE "tiki_history";

CREATE TABLE "tiki_history" (
  "pageName" varchar(160) default '' NOT NULL,
  "version" number(8) default '0' NOT NULL,
  "version_minor" number(8) default '0' NOT NULL,
  "lastModif" number(14) default NULL,
  "description" varchar(200) default NULL,
  "user" varchar(40) default NULL,
  "ip" varchar(15) default NULL,
  "comment" varchar(200) default NULL,
  "data" blob,
  PRIMARY KEY ("pageName","version")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_hotwords
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 10, 2003 at 11:04 PM
--
DROP TABLE "tiki_hotwords";

CREATE TABLE "tiki_hotwords" (
  "word" varchar(40) default '' NOT NULL,
  "url" varchar(255) default '' NOT NULL,
  PRIMARY KEY ("word")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_html_pages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_html_pages";

CREATE TABLE "tiki_html_pages" (
  "pageName" varchar(200) default '' NOT NULL,
  "content" blob,
  "refresh" number(10) default NULL,
  "type" char(1) default NULL,
  "created" number(14) default NULL,
  PRIMARY KEY ("pageName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_html_pages_dynamic_zones
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_html_pages_dynamic_zones";

CREATE TABLE "tiki_html_pages_dynamic_zones" (
  "pageName" varchar(40) default '' NOT NULL,
  "zone" varchar(80) default '' NOT NULL,
  "type" char(2) default NULL,
  "content" clob,
  PRIMARY KEY ("pageName","zone")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_images
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Sep 18, 2004 at 08:29 PM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_images";

CREATE SEQUENCE "tiki_images_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_images" (
  "imageId" number(14) NOT NULL,
  "galleryId" number(14) default '0' NOT NULL,
  "name" varchar(200) default '' NOT NULL,
  "description" clob,
  "lon" float default NULL,
  "lat" float default NULL,
  "created" number(14) default NULL,
  "user" varchar(40) default NULL,
  "hits" number(14) default NULL,
  "path" varchar(255) default NULL,
  PRIMARY KEY ("imageId")
)   ;

CREATE TRIGGER "tiki_images_trig" BEFORE INSERT ON "tiki_images" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_images_sequ".nextval into :NEW."imageId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_images_name" ON "tiki_images"("name");
CREATE  INDEX "tiki_images_description" ON "tiki_images"("description");
CREATE  INDEX "tiki_images_hits" ON "tiki_images"("hits");
CREATE  INDEX "tiki_images_ti_gId" ON "tiki_images"("galleryId");
CREATE  INDEX "tiki_images_ti_cr" ON "tiki_images"("created");
CREATE  INDEX "tiki_images_ti_us" ON "tiki_images"("user");
CREATE  INDEX "tiki_images_ft" ON "tiki_images"("name","description");
-- --------------------------------------------------------
--
-- Table structure for table tiki_images_data
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 12:49 PM
-- Last check: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_images_data";

CREATE TABLE "tiki_images_data" (
  "imageId" number(14) default '0' NOT NULL,
  "xsize" number(8) default '0' NOT NULL,
  "ysize" number(8) default '0' NOT NULL,
  "type" char(1) default '' NOT NULL,
  "filesize" number(14) default NULL,
  "filetype" varchar(80) default NULL,
  "filename" varchar(80) default NULL,
  "data" blob,
  "etag" varchar(32) default NULL,
  PRIMARY KEY ("imageId","xsize","ysize","type")
) ;

CREATE  INDEX "tiki_images_data_t_i_d_it" ON "tiki_images_data"("imageId","type");
-- --------------------------------------------------------
--
-- Table structure for table tiki_language
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_language";

CREATE TABLE "tiki_language" (
  "source" blob NOT NULL,
  "lang" char(16) default '' NOT NULL,
  "tran" blob,
  PRIMARY KEY ("source","lang")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_languages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_languages";

CREATE TABLE "tiki_languages" (
  "lang" char(16) default '' NOT NULL,
  "language" varchar(255) default NULL,
  PRIMARY KEY ("lang")
) ;

-- --------------------------------------------------------
INSERT INTO tiki_languages(lang, language) VALUES('en','English');

-- --------------------------------------------------------
--
-- Table structure for table tiki_link_cache
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 06:06 PM
--
DROP TABLE "tiki_link_cache";

CREATE SEQUENCE "tiki_link_cache_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_link_cache" (
  "cacheId" number(14) NOT NULL,
  "url" varchar(250) default NULL,
  "data" blob,
  "refresh" number(14) default NULL,
  PRIMARY KEY ("cacheId")
)   ;

CREATE TRIGGER "tiki_link_cache_trig" BEFORE INSERT ON "tiki_link_cache" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_link_cache_sequ".nextval into :NEW."cacheId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_link_cache_urlindex" ON "tiki_link_cache"("url");
-- --------------------------------------------------------
--
-- Table structure for table tiki_links
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 11:39 PM
--
DROP TABLE "tiki_links";

CREATE TABLE "tiki_links" (
  "fromPage" varchar(160) default '' NOT NULL,
  "toPage" varchar(160) default '' NOT NULL,
  PRIMARY KEY ("fromPage","toPage")
) ;

CREATE  INDEX "tiki_links_toPage" ON "tiki_links"("toPage");
-- --------------------------------------------------------
--
-- Table structure for table tiki_live_support_events
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_live_support_events";

CREATE SEQUENCE "tiki_live_support_events_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_live_support_events" (
  "eventId" number(14) NOT NULL,
  "reqId" varchar(32) default '' NOT NULL,
  "type" varchar(40) default NULL,
  "seqId" number(14) default NULL,
  "senderId" varchar(32) default NULL,
  "data" clob,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("eventId")
)   ;

CREATE TRIGGER "tiki_live_support_events_trig" BEFORE INSERT ON "tiki_live_support_events" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_live_support_events_sequ".nextval into :NEW."eventId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_live_support_message_comments
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_live_support_message_comments";

CREATE SEQUENCE "tiki_live_support_message_comments_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_live_support_message_comments" (
  "cId" number(12) NOT NULL,
  "msgId" number(12) default NULL,
  "data" clob,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("cId")
)   ;

CREATE TRIGGER "tiki_live_support_message_comments_trig" BEFORE INSERT ON "tiki_live_support_message_comments" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_live_support_message_comments_sequ".nextval into :NEW."cId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_live_support_messages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_live_support_messages";

CREATE SEQUENCE "tiki_live_support_messages_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_live_support_messages" (
  "msgId" number(12) NOT NULL,
  "data" clob,
  "timestamp" number(14) default NULL,
  "user" varchar(40) default NULL,
  "username" varchar(200) default NULL,
  "priority" number(2) default NULL,
  "status" char(1) default NULL,
  "assigned_to" varchar(200) default NULL,
  "resolution" varchar(100) default NULL,
  "title" varchar(200) default NULL,
  "module" number(4) default NULL,
  "email" varchar(250) default NULL,
  PRIMARY KEY ("msgId")
)   ;

CREATE TRIGGER "tiki_live_support_messages_trig" BEFORE INSERT ON "tiki_live_support_messages" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_live_support_messages_sequ".nextval into :NEW."msgId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_live_support_modules
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_live_support_modules";

CREATE SEQUENCE "tiki_live_support_modules_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_live_support_modules" (
  "modId" number(4) NOT NULL,
  "name" varchar(90) default NULL,
  PRIMARY KEY ("modId")
)   ;

CREATE TRIGGER "tiki_live_support_modules_trig" BEFORE INSERT ON "tiki_live_support_modules" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_live_support_modules_sequ".nextval into :NEW."modId" FROM DUAL;
END;
/
-- --------------------------------------------------------
INSERT INTO tiki_live_support_modules(name) VALUES('wiki');

INSERT INTO tiki_live_support_modules(name) VALUES('forums');

INSERT INTO tiki_live_support_modules(name) VALUES('image galleries');

INSERT INTO tiki_live_support_modules(name) VALUES('file galleries');

INSERT INTO tiki_live_support_modules(name) VALUES('directory');

INSERT INTO tiki_live_support_modules(name) VALUES('workflow');

INSERT INTO tiki_live_support_modules(name) VALUES('charts');

-- --------------------------------------------------------
--
-- Table structure for table tiki_live_support_operators
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_live_support_operators";

CREATE TABLE "tiki_live_support_operators" (
  "user" varchar(40) default '' NOT NULL,
  "accepted_requests" number(10) default NULL,
  "status" varchar(20) default NULL,
  "longest_chat" number(10) default NULL,
  "shortest_chat" number(10) default NULL,
  "average_chat" number(10) default NULL,
  "last_chat" number(14) default NULL,
  "time_online" number(10) default NULL,
  "votes" number(10) default NULL,
  "points" number(10) default NULL,
  "status_since" number(14) default NULL,
  PRIMARY KEY ("user")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_live_support_requests
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_live_support_requests";

CREATE TABLE "tiki_live_support_requests" (
  "reqId" varchar(32) default '' NOT NULL,
  "user" varchar(40) default NULL,
  "tiki_user" varchar(200) default NULL,
  "email" varchar(200) default NULL,
  "operator" varchar(200) default NULL,
  "operator_id" varchar(32) default NULL,
  "user_id" varchar(32) default NULL,
  "reason" clob,
  "req_timestamp" number(14) default NULL,
  "timestamp" number(14) default NULL,
  "status" varchar(40) default NULL,
  "resolution" varchar(40) default NULL,
  "chat_started" number(14) default NULL,
  "chat_ended" number(14) default NULL,
  PRIMARY KEY ("reqId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_live_support_requests
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_logs";

CREATE SEQUENCE "tiki_logs_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_logs" (
  "logId" number(8) NOT NULL,
  "logtype" varchar(20) NOT NULL,
  "logmessage" clob NOT NULL,
  "loguser" varchar(40) NOT NULL,
  "logip" varchar(200) NOT NULL,
  "logclient" clob NOT NULL,
  "logtime" number(14) NOT NULL,
  PRIMARY KEY ("logId")
) ;

CREATE TRIGGER "tiki_logs_trig" BEFORE INSERT ON "tiki_logs" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_logs_sequ".nextval into :NEW."logId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_logs_logtype" ON "tiki_logs"("logtype");

-- --------------------------------------------------------
--
-- Table structure for table tiki_mail_events
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 05:28 AM
--
DROP TABLE "tiki_mail_events";

CREATE TABLE "tiki_mail_events" (
  "event" varchar(200) default NULL,
  "object" varchar(200) default NULL,
  "email" varchar(200) default NULL
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_mailin_accounts
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jun 17, 2004 at 03:06 PM EST
--
DROP TABLE "tiki_mailin_accounts";

CREATE SEQUENCE "tiki_mailin_accounts_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_mailin_accounts" (
  "accountId" number(12) NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  "account" varchar(50) default '' NOT NULL,
  "pop" varchar(255) default NULL,
  "port" number(4) default NULL,
  "username" varchar(100) default NULL,
  "pass" varchar(100) default NULL,
  "active" char(1) default NULL,
  "type" varchar(40) default NULL,
  "smtp" varchar(255) default NULL,
  "useAuth" char(1) default NULL,
  "smtpPort" number(4) default NULL,
  "anonymous" char(1) default 'y' NOT NULL,
  "attachments" char(1) default 'n' NOT NULL,
  "article_topicId" number(4) default NULL,
  "article_type" varchar(50) default NULL,
  "discard_after" varchar(255) default NULL,
  PRIMARY KEY ("accountId")
)   ;

CREATE TRIGGER "tiki_mailin_accounts_trig" BEFORE INSERT ON "tiki_mailin_accounts" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_mailin_accounts_sequ".nextval into :NEW."accountId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_menu_languages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_menu_languages";

CREATE SEQUENCE "tiki_menu_languages_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_menu_languages" (
  "menuId" number(8) NOT NULL,
  "language" char(16) default '' NOT NULL,
  PRIMARY KEY ("menuId","language")
)   ;

CREATE TRIGGER "tiki_menu_languages_trig" BEFORE INSERT ON "tiki_menu_languages" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_menu_languages_sequ".nextval into :NEW."menuId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_menu_options
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Nov 21, 2003 at 07:05 AM
--
DROP TABLE "tiki_menu_options";

CREATE SEQUENCE "tiki_menu_options_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_menu_options" (
  "optionId" number(8) NOT NULL,
  "menuId" number(8) default NULL,
  "type" char(1) default NULL,
  "name" varchar(200) default NULL,
  "url" varchar(255) default NULL,
  "position" number(4) default NULL,
  "section" varchar(255) default NULL,
  "perm" varchar(255) default NULL,
  "groupname" varchar(255) default NULL,
  PRIMARY KEY ("optionId")
)   ;

CREATE TRIGGER "tiki_menu_options_trig" BEFORE INSERT ON "tiki_menu_options" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_menu_options_sequ".nextval into :NEW."optionId" FROM DUAL;
END;
/
-- --------------------------------------------------------
INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Home','tiki-index.php',10,'','','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Chat','tiki-chat.php',15,'feature_chat','tiki_p_chat','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Contact us','tiki-contact.php',20,'feature_contact','','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Stats','tiki-stats.php',23,'feature_stats','tiki_p_view_stats','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Categories','tiki-browse_categories.php',25,'feature_categories','tiki_p_view_categories','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Games','tiki-list_games.php',30,'feature_games','tiki_p_play_games','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Calendar','tiki-calendar.php',35,'feature_calendar','tiki_p_view_calendar','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Users map','tiki-gmap_usermap.php',36,'feature_gmap','','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Mobile','tiki-mobile.php',37,'feature_mobile','','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','(debug)','javascript:toggle("debugconsole")',40,'feature_debug_console','tiki_p_admin','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','MyTiki','tiki-my_tiki.php',50,'','','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','MyTiki home','tiki-my_tiki.php',51,'','','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Preferences','tiki-user_preferences.php',55,'feature_userPreferences','','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Messages','messu-mailbox.php',60,'feature_messages','tiki_p_messages','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Tasks','tiki-user_tasks.php',65,'feature_tasks','tiki_p_tasks','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Bookmarks','tiki-user_bookmarks.php',70,'feature_user_bookmarks','tiki_p_create_bookmarks','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Modules','tiki-user_assigned_modules.php',75,'user_assigned_modules','tiki_p_configure_modules','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Newsreader','tiki-newsreader_servers.php',80,'feature_newsreader','tiki_p_newsreader','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Webmail','tiki-webmail.php',85,'feature_webmail','tiki_p_use_webmail','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Notepad','tiki-notepad_list.php',90,'feature_notepad','tiki_p_notepad','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','My files','tiki-userfiles.php',95,'feature_userfiles','tiki_p_userfiles','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','User menu','tiki-usermenu.php',100,'feature_usermenu','tiki_p_usermenu','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Mini calendar','tiki-minical.php',105,'feature_minical','tiki_p_minical','Registered');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','My watches','tiki-user_watches.php',110,'feature_user_watches','','Registered');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Workflow','tiki-g-user_processes.php',150,'feature_workflow','tiki_p_use_workflow','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin processes','tiki-g-admin_processes.php',155,'feature_workflow','tiki_p_admin_workflow','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Monitor processes','tiki-g-monitor_processes.php',160,'feature_workflow','tiki_p_admin_workflow','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Monitor activities','tiki-g-monitor_activities.php',165,'feature_workflow','tiki_p_admin_workflow','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Monitor instances','tiki-g-monitor_instances.php',170,'feature_workflow','tiki_p_admin_workflow','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','User processes','tiki-g-user_processes.php',175,'feature_workflow','tiki_p_use_workflow','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','User activities','tiki-g-user_activities.php',180,'feature_workflow','tiki_p_use_workflow','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','User instances','tiki-g-user_instances.php',185,'feature_workflow','tiki_p_use_workflow','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Community','tiki-list_users.php','187','feature_friends','tiki_p_list_users','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','User list','tiki-list_users.php','188','feature_friends','tiki_p_list_users','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Friendship Network','tiki-friends.php','189','feature_friends','','Registered');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Wiki','tiki-index.php',200,'feature_wiki','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Wiki Home','tiki-index.php',202,'feature_wiki','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Last Changes','tiki-lastchanges.php',205,'feature_wiki,feature_lastChanges','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Dump','dump/new.tar',210,'feature_wiki,feature_dump','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Rankings','tiki-wiki_rankings.php',215,'feature_wiki,feature_wiki_rankings','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List pages','tiki-listpages.php',220,'feature_wiki,feature_listPages','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Orphan pages','tiki-orphan_pages.php',225,'feature_wiki,feature_listPages','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Sandbox','tiki-editpage.php?page=sandbox',230,'feature_wiki,feature_sandbox','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Print','tiki-print_pages.php',235,'feature_wiki,feature_wiki_multiprint','tiki_p_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Send pages','tiki-send_objects.php',240,'feature_wiki,feature_comm','tiki_p_view,tiki_p_send_pages','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Received pages','tiki-received_pages.php',245,'feature_wiki,feature_comm','tiki_p_view,tiki_p_admin_received_pages','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Structures','tiki-admin_structures.php',250,'feature_wiki','tiki_p_edit_structures','');


-- INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Homework','tiki-hw_student_assignments.php','280','feature_homework','tiki_p_hw_student','');

-- INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Assignments','tiki-hw_teacher_assignments.php','282','feature_homework','tiki_p_hw_student','');

-- INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Last Changes','tiki-hw_teacher_assignments.php','284','feature_homework','tiki_p_hw_student','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Image Galleries','tiki-galleries.php',300,'feature_galleries','tiki_p_view_image_gallery','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Galleries','tiki-galleries.php',305,'feature_galleries','tiki_p_view_image_gallery','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Rankings','tiki-galleries_rankings.php',310,'feature_galleries,feature_gal_rankings','tiki_p_view_image_gallery','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Upload image','tiki-upload_image.php',315,'feature_galleries','tiki_p_upload_images','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Directory batch','tiki-batch_upload.php',318,'feature_galleries,feature_gal_batch','tiki_p_batch_upload','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','System gallery','tiki-list_gallery.php?galleryId=0',320,'feature_galleries','tiki_p_admin_galleries','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Articles','tiki-view_articles.php',350,'feature_articles','tiki_p_read_article','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Articles home','tiki-view_articles.php',355,'feature_articles','tiki_p_read_article','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List articles','tiki-list_articles.php',360,'feature_articles','tiki_p_read_article','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Rankings','tiki-cms_rankings.php',365,'feature_articles,feature_cms_rankings','tiki_p_read_article','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Submit article','tiki-edit_submission.php',370,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_submit_article','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','View submissions','tiki-list_submissions.php',375,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_submit_article','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','View submissions','tiki-list_submissions.php',375,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_approve_submission','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','View submissions','tiki-list_submissions.php',375,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_remove_submission','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Edit article','tiki-edit_article.php',380,'feature_articles','tiki_p_read_article,tiki_p_edit_article','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Send articles','tiki-send_objects.php',385,'feature_articles,feature_comm','tiki_p_read_article,tiki_p_send_articles','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Received articles','tiki-received_articles.php',385,'feature_articles,feature_comm','tiki_p_read_article,tiki_p_admin_received_articles','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin topics','tiki-admin_topics.php',390,'feature_articles','tiki_p_read_article,tiki_p_admin_cms','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin types','tiki-article_types.php',395,'feature_articles','tiki_p_read_article,tiki_p_admin_cms','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Blogs','tiki-list_blogs.php',450,'feature_blogs','tiki_p_read_blog','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List blogs','tiki-list_blogs.php',455,'feature_blogs','tiki_p_read_blog','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Rankings','tiki-blog_rankings.php',460,'feature_blogs,feature_blog_rankings','tiki_p_read_blog','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Create/Edit blog','tiki-edit_blog.php',465,'feature_blogs','tiki_p_read_blog,tiki_p_create_blogs','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Post','tiki-blog_post.php',470,'feature_blogs','tiki_p_read_blog,tiki_p_blog_post','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin posts','tiki-list_posts.php',475,'feature_blogs','tiki_p_read_blog,tiki_p_blog_admin','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Forums','tiki-forums.php',500,'feature_forums','tiki_p_forum_read','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List forums','tiki-forums.php',505,'feature_forums','tiki_p_forum_read','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Rankings','tiki-forum_rankings.php',510,'feature_forums,feature_forum_rankings','tiki_p_forum_read','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin forums','tiki-admin_forums.php',515,'feature_forums','tiki_p_forum_read,tiki_p_admin_forum','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Directory','tiki-directory_browse.php',550,'feature_directory','tiki_p_view_directory','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Submit a new link','tiki-directory_add_site.php',555,'feature_directory','tiki_p_submit_link','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Browse directory','tiki-directory_browse.php',560,'feature_directory','tiki_p_view_directory','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin directory','tiki-directory_admin.php',565,'feature_directory','tiki_p_view_directory,tiki_p_admin_directory_cats','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin directory','tiki-directory_admin.php',565,'feature_directory','tiki_p_view_directory,tiki_p_admin_directory_sites','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin directory','tiki-directory_admin.php',565,'feature_directory','tiki_p_view_directory,tiki_p_validate_links','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','File Galleries','tiki-file_galleries.php',600,'feature_file_galleries','tiki_p_view_file_gallery','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List galleries','tiki-file_galleries.php',605,'feature_file_galleries','tiki_p_view_file_gallery','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Rankings','tiki-file_galleries_rankings.php',610,'feature_file_galleries,feature_file_galleries_rankings','tiki_p_view_file_gallery','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Upload file','tiki-upload_file.php',615,'feature_file_galleries','tiki_p_view_file_gallery,tiki_p_upload_files','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','FAQs','tiki-list_faqs.php',650,'feature_faqs','tiki_p_view_faqs','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List FAQs','tiki-list_faqs.php',665,'feature_faqs','tiki_p_view_faqs','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin FAQs','tiki-list_faqs.php',660,'feature_faqs','tiki_p_admin_faqs','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Maps','tiki-map.phtml',700,'feature_maps','tiki_p_map_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Mapfiles','tiki-map_edit.php',705,'feature_maps','tiki_p_map_view','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Layer management','tiki-map_upload.php',710,'feature_maps','tiki_p_map_edit','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Quizzes','tiki-list_quizzes.php',750,'feature_quizzes','tiki_p_take_quiz','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List quizzes','tiki-list_quizzes.php',755,'feature_quizzes','tiki_p_take_quiz','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Quiz stats','tiki-quiz_stats.php',760,'feature_quizzes','tiki_p_view_quiz_stats','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin quiz','tiki-edit_quiz.php',765,'feature_quizzes','tiki_p_admin_quizzes','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','TikiSheet','tiki-sheets.php',780,'feature_sheet','tiki_p_view_sheet','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Trackers','tiki-list_trackers.php',800,'feature_trackers','tiki_p_view_trackers','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List trackers','tiki-list_trackers.php',805,'feature_trackers','tiki_p_view_trackers','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin trackers','tiki-admin_trackers.php',810,'feature_trackers','tiki_p_admin_trackers','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Surveys','tiki-list_surveys.php',850,'feature_surveys','tiki_p_take_survey','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','List surveys','tiki-list_surveys.php',855,'feature_surveys','tiki_p_take_survey','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Stats','tiki-survey_stats.php',860,'feature_surveys','tiki_p_view_survey_stats','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin surveys','tiki-admin_surveys.php',865,'feature_surveys','tiki_p_admin_surveys','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Newsletters','tiki-newsletters.php',900,'feature_newsletters','tiki_p_subscribe_newsletters','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Newsletters','tiki-newsletters.php',900,'feature_newsletters','tiki_p_send_newsletters','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Newsletters','tiki-newsletters.php',900,'feature_newsletters','tiki_p_admin_newsletters','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Send newsletters','tiki-send_newsletters.php',905,'feature_newsletters','tiki_p_send_newsletters','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin newsletters','tiki-admin_newsletters.php',910,'feature_newsletters','tiki_p_admin_newsletters','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Ephemerides','tiki-eph.php',950,'feature_eph','tiki_p_view_eph','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin ephemerides','tiki-eph_admin.php',955,'feature_eph','tiki_p_eph_admin','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'s','Charts','tiki-charts.php',1000,'feature_charts','tiki_p_view_chart','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin charts','tiki-admin_charts.php',1005,'feature_charts','tiki_p_admin_charts','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_chat','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_categories','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_banners','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_templates','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_cookies','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_dynamic','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_mailin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_content_templates','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_html_pages','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_view_referer_stats','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_drawings','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_shoutbox','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_live_support_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'','user_is_operator','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'r','Admin','tiki-admin.php',1050,'feature_integrator','tiki_p_admin_integrator','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin home','tiki-admin.php',1051,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Live support','tiki-live_support_admin.php',1055,'feature_live_support','tiki_p_live_support_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Live support','tiki-live_support_admin.php',1055,'feature_live_support','user_is_operator','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Banning','tiki-admin_banning.php',1060,'feature_banning','tiki_p_admin_banning','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Calendar','tiki-admin_calendars.php',1065,'feature_calendar','tiki_p_admin_calendar','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Users','tiki-adminusers.php',1070,'','tiki_p_admin_users','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Groups','tiki-admingroups.php',1075,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Cache','tiki-list_cache.php',1080,'cachepages','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Modules','tiki-admin_modules.php',1085,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Links','tiki-admin_links.php',1090,'feature_featuredLinks','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Hotwords','tiki-admin_hotwords.php',1095,'feature_hotwords','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','RSS modules','tiki-admin_rssmodules.php',1100,'','tiki_p_admin_rssmodules','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Menus','tiki-admin_menus.php',1105,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Polls','tiki-admin_polls.php',1110,'feature_polls','tiki_p_admin_polls','');


-- Hiding for fresh install in Tiki 1.9.8 until we fix or remove.
-- INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Backups','tiki-backup.php',1115,'','tiki_p_admin','');


INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Mail notifications','tiki-admin_notifications.php',1120,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Search stats','tiki-search_stats.php',1125,'feature_search_stats','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Theme control','tiki-theme_control.php',1130,'feature_theme_control','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','QuickTags','tiki-admin_quicktags.php',1135,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Chat','tiki-admin_chat.php',1140,'feature_chat','tiki_p_admin_chat','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Categories','tiki-admin_categories.php',1145,'feature_categories','tiki_p_admin_categories','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Banners','tiki-list_banners.php',1150,'feature_banners','tiki_p_admin_banners','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Edit templates','tiki-edit_templates.php',1155,'feature_edit_templates','tiki_p_edit_templates','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Drawings','tiki-admin_drawings.php',1160,'feature_drawings','tiki_p_admin_drawings','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Dynamic content','tiki-list_contents.php',1165,'feature_dynamic_content','tiki_p_admin_dynamic','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Cookies','tiki-admin_cookies.php',1170,'','tiki_p_edit_cookies','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Mail-in','tiki-admin_mailin.php',1175,'feature_mailin','tiki_p_admin_mailin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Content templates','tiki-admin_content_templates.php',1180,'','tiki_p_edit_content_templates','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','HTML pages','tiki-admin_html_pages.php',1185,'feature_html_pages','tiki_p_edit_html_pages','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Shoutbox','tiki-shoutbox.php',1190,'feature_shoutbox','tiki_p_admin_shoutbox','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Shoutbox Words','tiki-admin_shoutbox_words.php',1191,'feature_shoutbox','tiki_p_admin_shoutbox','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Referer stats','tiki-referer_stats.php',1195,'feature_referer_stats','tiki_p_view_referer_stats','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Edit languages','tiki-edit_languages.php',1200,'lang_use_db','tiki_p_edit_languages','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Integrator','tiki-admin_integrator.php',1205,'feature_integrator','tiki_p_admin_integrator','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','phpinfo','tiki-phpinfo.php',1215,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','DSN','tiki-admin_dsn.php',1220,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','External wikis','tiki-admin_external_wikis.php',1225,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','System Admin','tiki-admin_system.php',1230,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Score','tiki-admin_score.php',1235,'feature_score','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Admin mods','tiki-mods.php',1240,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Tiki Logs','tiki-syslog.php',1245,'','tiki_p_admin','');

INSERT INTO "tiki_menu_options" ("menuId","type","name","url","position","section","perm","groupname") VALUES (42,'o','Security Admin','tiki-admin_security.php',1250,'','tiki_p_admin','');

-- --------------------------------------------------------
--
-- Table structure for table tiki_menus
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_menus";

CREATE SEQUENCE "tiki_menus_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_menus" (
  "menuId" number(8) NOT NULL,
  "name" varchar(200) default '' NOT NULL,
  "description" clob,
  "type" char(1) default NULL,
  PRIMARY KEY ("menuId")
)   ;

CREATE TRIGGER "tiki_menus_trig" BEFORE INSERT ON "tiki_menus" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_menus_sequ".nextval into :NEW."menuId" FROM DUAL;
END;
/
-- --------------------------------------------------------
INSERT INTO "tiki_menus" ("menuId","name","description","type") VALUES ('42','Application menu','Main extensive navigation menu','d');

-- --------------------------------------------------------
--
-- Table structure for table tiki_minical_events
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 09, 2003 at 04:06 AM
--
DROP TABLE "tiki_minical_events";

CREATE SEQUENCE "tiki_minical_events_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_minical_events" (
  "user" varchar(40) default NULL,
  "eventId" number(12) NOT NULL,
  "title" varchar(250) default NULL,
  "description" clob,
  "start" number(14) default NULL,
  "end" number(14) default NULL,
  "security" char(1) default NULL,
  "duration" number(3) default NULL,
  "topicId" number(12) default NULL,
  "reminded" char(1) default NULL,
  PRIMARY KEY ("eventId")
)   ;

CREATE TRIGGER "tiki_minical_events_trig" BEFORE INSERT ON "tiki_minical_events" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_minical_events_sequ".nextval into :NEW."eventId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_minical_topics
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_minical_topics";

CREATE SEQUENCE "tiki_minical_topics_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_minical_topics" (
  "user" varchar(40) default NULL,
  "topicId" number(12) NOT NULL,
  "name" varchar(250) default NULL,
  "filename" varchar(200) default NULL,
  "filetype" varchar(200) default NULL,
  "filesize" varchar(200) default NULL,
  "data" blob,
  "path" varchar(250) default NULL,
  "isIcon" char(1) default NULL,
  PRIMARY KEY ("topicId")
)   ;

CREATE TRIGGER "tiki_minical_topics_trig" BEFORE INSERT ON "tiki_minical_topics" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_minical_topics_sequ".nextval into :NEW."topicId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_modules
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 11:44 PM
--
DROP TABLE "tiki_modules";

CREATE TABLE "tiki_modules" (
  "name" varchar(200) default '' NOT NULL,
  "position" char(1) default NULL,
  "ord" number(4) default NULL,
  "type" char(1) default NULL,
  "title" varchar(255) default NULL,
  "cache_time" number(14) default NULL,
  "rows" number(4) default NULL,
  "params" varchar(255) default NULL,
  "groups" clob,
  PRIMARY KEY ("name")
) ;

CREATE  INDEX "tiki_modules_positionType" ON "tiki_modules"("position" "type");
-- --------------------------------------------------------
INSERT INTO "tiki_modules" ("name","position","ord","cache_time","groups") VALUES ('login_box','r',1,0,'a:2:{i:0;s:10:"Registered";i:1;s:9:"Anonymous";}');

INSERT INTO "tiki_modules" ("name","position","ord","cache_time","params","groups") VALUES ('mnu_application_menu','l',1,0,'flip=y','a:2:{i:0;s:10:"Registered";i:1;s:9:"Anonymous";}');

INSERT INTO "tiki_modules" ("name","position","ord","cache_time","groups") VALUES ('quick_edit','l',2,0,'a:1:{i:0;s:10:"Registered";}');

INSERT INTO "tiki_modules" ("name","position","ord","cache_time","groups") VALUES ('assistant','l',10,0,'a:1:{i:0;s:6:"Admins";}');

INSERT INTO "tiki_modules" ("name","position","ord","cache_time","groups") VALUES ('since_last_visit_new','r',40,0,'a:1:{i:0;s:6:"Admins";}');

-- --------------------------------------------------------
--
-- Table structure for table tiki_newsletter_subscriptions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_newsletter_subscriptions";

CREATE TABLE "tiki_newsletter_subscriptions" (
  "nlId" number(12) default '0' NOT NULL,
  "email" varchar(255) default '' NOT NULL,
  "code" varchar(32) default NULL,
  "valid" char(1) default NULL,
  "subscribed" number(14) default NULL,
  "isUser" char(1) default 'n' NOT NULL,
  PRIMARY KEY ("nlId","email","isUser")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_newsletter_groups
--
-- Creation: Jan 18, 2005
-- Last update: Jan 18, 2005
--
DROP TABLE "tiki_newsletter_groups";

CREATE TABLE "tiki_newsletter_groups" (
  "nlId" number(12) default '0' NOT NULL,
  "groupName" varchar(255) default '' NOT NULL,
  "code" varchar(32) default NULL,
  PRIMARY KEY ("nlId","groupName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_newsletters
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_newsletters";

CREATE SEQUENCE "tiki_newsletters_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_newsletters" (
  "nlId" number(12) NOT NULL,
  "name" varchar(200) default NULL,
  "description" clob,
  "created" number(14) default NULL,
  "lastSent" number(14) default NULL,
  "editions" number(10) default NULL,
  "users" number(10) default NULL,
  "allowUserSub" char(1) default 'y',
  "allowAnySub" char(1) default NULL,
  "unsubMsg" char(1) default 'y',
  "validateAddr" char(1) default 'y',
  "frequency" number(14) default NULL,
  PRIMARY KEY ("nlId")
)   ;

CREATE TRIGGER "tiki_newsletters_trig" BEFORE INSERT ON "tiki_newsletters" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_newsletters_sequ".nextval into :NEW."nlId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_newsreader_marks
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_newsreader_marks";

CREATE TABLE "tiki_newsreader_marks" (
  "user" varchar(40) default '' NOT NULL,
  "serverId" number(12) default '0' NOT NULL,
  "groupName" varchar(255) default '' NOT NULL,
  "timestamp" number(14) default '0' NOT NULL,
  PRIMARY KEY ("user","serverId","groupName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_newsreader_servers
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_newsreader_servers";

CREATE SEQUENCE "tiki_newsreader_servers_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_newsreader_servers" (
  "user" varchar(40) default '' NOT NULL,
  "serverId" number(12) NOT NULL,
  "server" varchar(250) default NULL,
  "port" number(4) default NULL,
  "username" varchar(200) default NULL,
  "password" varchar(200) default NULL,
  PRIMARY KEY ("serverId")
)   ;

CREATE TRIGGER "tiki_newsreader_servers_trig" BEFORE INSERT ON "tiki_newsreader_servers" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_newsreader_servers_sequ".nextval into :NEW."serverId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_page_footnotes
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 10:00 AM
-- Last check: Jul 12, 2003 at 10:00 AM
--
DROP TABLE "tiki_page_footnotes";

CREATE TABLE "tiki_page_footnotes" (
  "user" varchar(40) default '' NOT NULL,
  "pageName" varchar(250) default '' NOT NULL,
  "data" clob,
  PRIMARY KEY ("user","pageName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_pages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:52 AM
-- Last check: Jul 12, 2003 at 10:01 AM
--
DROP TABLE "tiki_pages";

CREATE SEQUENCE "tiki_pages_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_pages" (
  "page_id" number(14) NOT NULL,
  "pageName" varchar(160) default '' NOT NULL,
  "hits" number(8) default NULL,
  "data" clob,
  "description" varchar(200) default NULL,
  "lastModif" number(14) default NULL,
  "comment" varchar(200) default NULL,
  "version" number(8) default '0' NOT NULL,
  "user" varchar(40) default NULL,
  "ip" varchar(15) default NULL,
  "flag" char(1) default NULL,
  "points" number(8) default NULL,
  "votes" number(8) default NULL,
  "cache" longtext,
  "wiki_cache" number(10) default NULL,
  "cache_timestamp" number(14) default NULL,
  "pageRank" decimal(4,3) default NULL,
  "creator" varchar(200) default NULL,
  "page_size" number(10) default '0',
  "lang" varchar(16) default NULL,
  "lockedby" varchar(200) default NULL,
  "is_html" number(1) default 0,
  "created" number(14),
  PRIMARY KEY ("page_id")
)  ;

CREATE TRIGGER "tiki_pages_trig" BEFORE INSERT ON "tiki_pages" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_pages_sequ".nextval into :NEW."page_id" FROM DUAL;
END;
/
CREATE  INDEX "tiki_pages_data" ON "tiki_pages"("data");
CREATE  INDEX "tiki_pages_pageRank" ON "tiki_pages"("pageRank");
CREATE  INDEX "tiki_pages_ft" ON "tiki_pages"("pageName","description","data");
CREATE UNIQUE INDEX "tiki_pages_pageName" ON "tiki_pages"("pageName");
-- --------------------------------------------------------
--
-- Table structure for table tiki_pageviews
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:52 AM
--
DROP TABLE "tiki_pageviews";

CREATE TABLE "tiki_pageviews" (
  "day" number(14) default '0' NOT NULL,
  "pageviews" number(14) default NULL,
  PRIMARY KEY ("day")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_poll_objects
--
DROP TABLE "tiki_poll_objects";

CREATE TABLE `tiki_poll_objects` (
  `catObjectId` number(11) default '0' NOT NULL,
  `pollId` number(11) default '0' NOT NULL,
  `title` varchar(255) default NULL,
  PRIMARY KEY ("`catObjectId`","`pollId`")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_poll_options
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 06, 2003 at 07:57 PM
--
DROP TABLE "tiki_poll_options";

CREATE SEQUENCE "tiki_poll_options_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_poll_options" (
  "pollId" number(8) default '0' NOT NULL,
  "optionId" number(8) NOT NULL,
  "title" varchar(200) default NULL,
  "position" number(4) default '0' NOT NULL,
  "votes" number(8) default NULL,
  PRIMARY KEY ("optionId")
)   ;

CREATE TRIGGER "tiki_poll_options_trig" BEFORE INSERT ON "tiki_poll_options" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_poll_options_sequ".nextval into :NEW."optionId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_polls
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 06, 2003 at 07:57 PM
--
DROP TABLE "tiki_polls";

CREATE SEQUENCE "tiki_polls_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_polls" (
  "pollId" number(8) NOT NULL,
  "title" varchar(200) default NULL,
  "votes" number(8) default NULL,
  "active" char(1) default NULL,
  "publishDate" number(14) default NULL,
  PRIMARY KEY ("pollId")
)   ;

CREATE TRIGGER "tiki_polls_trig" BEFORE INSERT ON "tiki_polls" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_polls_sequ".nextval into :NEW."pollId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_preferences
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 12:04 PM
--
DROP TABLE "tiki_preferences";

CREATE TABLE "tiki_preferences" (
  "name" varchar(40) default '' NOT NULL,
  "value" clob default NULL,
  PRIMARY KEY ("name")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_private_messages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_private_messages";

CREATE SEQUENCE "tiki_private_messages_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_private_messages" (
  "messageId" number(8) NOT NULL,
  "toNickname" varchar(200) default '' NOT NULL,
  "data" varchar(255) default NULL,
  "poster" varchar(200) default 'anonymous' NOT NULL,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("messageId")
)   ;

CREATE TRIGGER "tiki_private_messages_trig" BEFORE INSERT ON "tiki_private_messages" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_private_messages_sequ".nextval into :NEW."messageId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_programmed_content
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_programmed_content";

CREATE SEQUENCE "tiki_programmed_content_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_programmed_content" (
  "pId" number(8) NOT NULL,
  "contentId" number(8) default '0' NOT NULL,
  "publishDate" number(14) default '0' NOT NULL,
  "data" clob,
  PRIMARY KEY ("pId")
)   ;

CREATE TRIGGER "tiki_programmed_content_trig" BEFORE INSERT ON "tiki_programmed_content" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_programmed_content_sequ".nextval into :NEW."pId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_quiz_question_options
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_quiz_question_options";

CREATE SEQUENCE "tiki_quiz_question_options_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_quiz_question_options" (
  "optionId" number(10) NOT NULL,
  "questionId" number(10) default NULL,
  "optionText" clob,
  "points" number(4) default NULL,
  PRIMARY KEY ("optionId")
)   ;

CREATE TRIGGER "tiki_quiz_question_options_trig" BEFORE INSERT ON "tiki_quiz_question_options" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_quiz_question_options_sequ".nextval into :NEW."optionId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_quiz_questions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_quiz_questions";

CREATE SEQUENCE "tiki_quiz_questions_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_quiz_questions" (
  "questionId" number(10) NOT NULL,
  "quizId" number(10) default NULL,
  "question" clob,
  "position" number(4) default NULL,
  "type" char(1) default NULL,
  "maxPoints" number(4) default NULL,
  PRIMARY KEY ("questionId")
)   ;

CREATE TRIGGER "tiki_quiz_questions_trig" BEFORE INSERT ON "tiki_quiz_questions" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_quiz_questions_sequ".nextval into :NEW."questionId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_quiz_results
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_quiz_results";

CREATE SEQUENCE "tiki_quiz_results_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_quiz_results" (
  "resultId" number(10) NOT NULL,
  "quizId" number(10) default NULL,
  "fromPoints" number(4) default NULL,
  "toPoints" number(4) default NULL,
  "answer" clob,
  PRIMARY KEY ("resultId")
)   ;

CREATE TRIGGER "tiki_quiz_results_trig" BEFORE INSERT ON "tiki_quiz_results" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_quiz_results_sequ".nextval into :NEW."resultId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_quiz_stats
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_quiz_stats";

CREATE TABLE "tiki_quiz_stats" (
  "quizId" number(10) default '0' NOT NULL,
  "questionId" number(10) default '0' NOT NULL,
  "optionId" number(10) default '0' NOT NULL,
  "votes" number(10) default NULL,
  PRIMARY KEY ("quizId","questionId","optionId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_quiz_stats_sum
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_quiz_stats_sum";

CREATE TABLE "tiki_quiz_stats_sum" (
  "quizId" number(10) default '0' NOT NULL,
  "quizName" varchar(255) default NULL,
  "timesTaken" number(10) default NULL,
  "avgpoints" decimal(5,2) default NULL,
  "avgavg" decimal(5,2) default NULL,
  "avgtime" decimal(5,2) default NULL,
  PRIMARY KEY ("quizId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_quizzes
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: April 29, 2004
--
DROP TABLE "tiki_quizzes";

CREATE SEQUENCE "tiki_quizzes_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_quizzes" (
  "quizId" number(10) NOT NULL,
  "name" varchar(255) default NULL,
  "description" clob,
  "canRepeat" char(1) default NULL,
  "storeResults" char(1) default NULL,
  "questionsPerPage" number(4) default NULL,
  "timeLimited" char(1) default NULL,
  "timeLimit" number(14) default NULL,
  "created" number(14) default NULL,
  "taken" number(10) default NULL,
  "immediateFeedback" char(1) default NULL,
  "showAnswers" char(1) default NULL,
  "shuffleQuestions" char(1) default NULL,
  "shuffleAnswers" char(1) default NULL,
  "publishDate" number(14) default NULL,
  "expireDate" number(14) default NULL,
  "bDeleted" char(1) default NULL,
  "nVersion" number(4) NOT NULL,
  "nAuthor" number(4) default NULL,
  "bOnline" char(1) default NULL,
  "bRandomQuestions" char(1) default NULL,
  "nRandomQuestions" number(4) default NULL,
  "bLimitQuestionsPerPage" char(1) default NULL,
  "nLimitQuestionsPerPage" number(4) default NULL,
  "bMultiSession" char(1) default NULL,
  "nCanRepeat" number(4) default NULL,
  "sGradingMethod" varchar(80) default NULL,
  "sShowScore" varchar(80) default NULL,
  "sShowCorrectAnswers" varchar(80) default NULL,
  "sPublishStats" varchar(80) default NULL,
  "bAdditionalQuestions" char(1) default NULL,
  "bForum" char(1) default NULL,
  "sForum" varchar(80) default NULL,
  "sPrologue" clob,
  "sData" clob,
  "sEpilogue" clob,
  "passingperct" number(4) default 0,
  PRIMARY KEY ("quizId","nVersion")
)   ;

CREATE TRIGGER "tiki_quizzes_trig" BEFORE INSERT ON "tiki_quizzes" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_quizzes_sequ".nextval into :NEW."quizId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_received_articles
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_received_articles";

CREATE SEQUENCE "tiki_received_articles_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_received_articles" (
  "receivedArticleId" number(14) NOT NULL,
  "receivedFromSite" varchar(200) default NULL,
  "receivedFromUser" varchar(200) default NULL,
  "receivedDate" number(14) default NULL,
  "title" varchar(80) default NULL,
  "authorName" varchar(60) default NULL,
  "size" number(12) default NULL,
  "useImage" char(1) default NULL,
  "image_name" varchar(80) default NULL,
  "image_type" varchar(80) default NULL,
  "image_size" number(14) default NULL,
  "image_x" number(4) default NULL,
  "image_y" number(4) default NULL,
  "image_data" blob,
  "publishDate" number(14) default NULL,
  "expireDate" number(14) default NULL,
  "created" number(14) default NULL,
  "heading" clob,
  "body" blob,
  "hash" varchar(32) default NULL,
  "author" varchar(200) default NULL,
  "type" varchar(50) default NULL,
  "rating" decimal(3,2) default NULL,
  PRIMARY KEY ("receivedArticleId")
)   ;

CREATE TRIGGER "tiki_received_articles_trig" BEFORE INSERT ON "tiki_received_articles" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_received_articles_sequ".nextval into :NEW."receivedArticleId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_received_pages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 09, 2003 at 03:56 AM
--
DROP TABLE "tiki_received_pages";

CREATE SEQUENCE "tiki_received_pages_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_received_pages" (
  "receivedPageId" number(14) NOT NULL,
  "pageName" varchar(160) default '' NOT NULL,
  "data" blob,
  "description" varchar(200) default NULL,
  "comment" varchar(200) default NULL,
  "receivedFromSite" varchar(200) default NULL,
  "receivedFromUser" varchar(200) default NULL,
  "receivedDate" number(14) default NULL,
  PRIMARY KEY ("receivedPageId")
)   ;

CREATE TRIGGER "tiki_received_pages_trig" BEFORE INSERT ON "tiki_received_pages" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_received_pages_sequ".nextval into :NEW."receivedPageId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_referer_stats
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:30 AM
--
DROP TABLE "tiki_referer_stats";

CREATE TABLE "tiki_referer_stats" (
  "referer" varchar(255) default '' NOT NULL,
  "hits" number(10) default NULL,
  "last" number(14) default NULL,
  PRIMARY KEY ("referer")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_related_categories
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_related_categories";

CREATE TABLE "tiki_related_categories" (
  "categId" number(10) default '0' NOT NULL,
  "relatedTo" number(10) default '0' NOT NULL,
  PRIMARY KEY ("categId","relatedTo")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_rss_modules
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 10:19 AM
--
DROP TABLE "tiki_rss_modules";

CREATE SEQUENCE "tiki_rss_modules_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_rss_modules" (
  "rssId" number(8) NOT NULL,
  "name" varchar(30) default '' NOT NULL,
  "description" clob,
  "url" varchar(255) default '' NOT NULL,
  "refresh" number(8) default NULL,
  "lastUpdated" number(14) default NULL,
  "showTitle" char(1) default 'n',
  "showPubDate" char(1) default 'n',
  "content" blob,
  PRIMARY KEY ("rssId")
)   ;

CREATE TRIGGER "tiki_rss_modules_trig" BEFORE INSERT ON "tiki_rss_modules" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_rss_modules_sequ".nextval into :NEW."rssId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_rss_feeds
--
-- Creation: Oct 14, 2003 at 20:34 PM
-- Last update: Oct 14, 2003 at 20:34 PM
--
DROP TABLE "tiki_rss_feeds";

CREATE TABLE "tiki_rss_feeds" (
  "name" varchar(30) default '' NOT NULL,
  "rssVer" char(1) default '1' NOT NULL,
  "refresh" number(8) default '300',
  "lastUpdated" number(14) default NULL,
  "cache" blob,
  PRIMARY KEY ("name","rssVer")
) ;

-- --------------------------------------------------------
DROP TABLE "tiki_searchindex";

CREATE TABLE "tiki_searchindex"(
  "searchword" varchar(80) default '' NOT NULL,
  "location" varchar(80) default '' NOT NULL,
  "page" varchar(255) default '' NOT NULL,
  "count" number(11) default '1' NOT NULL,
  "last_update" number(11) default '0' NOT NULL,
  PRIMARY KEY ("searchword","location","page")
) ;

CREATE  INDEX "tiki_searchindex_last_update" ON "tiki_searchindex"("last_update");

-- LRU (last recently used) list for searching parts of words
DROP TABLE "tiki_searchsyllable";

CREATE TABLE "tiki_searchsyllable"(
  "syllable" varchar(80) default '' NOT NULL,
  "lastUsed" number(11) default '0' NOT NULL,
  "lastUpdated" number(11) default '0' NOT NULL,
  PRIMARY KEY ("syllable")
) ;

CREATE  INDEX "tiki_searchsyllable_lastUsed" ON "tiki_searchsyllable"("lastUsed");

-- searchword caching table for search syllables
DROP TABLE "tiki_searchwords";

CREATE TABLE "tiki_searchwords"(
  "syllable" varchar(80) default '' NOT NULL,
  "searchword" varchar(80) default '' NOT NULL,
  PRIMARY KEY ("syllable","searchword")
) ;


--
-- Table structure for table tiki_search_stats
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 10:55 PM
--
DROP TABLE "tiki_search_stats";

CREATE TABLE "tiki_search_stats" (
  "term" varchar(50) default '' NOT NULL,
  "hits" number(10) default NULL,
  PRIMARY KEY ("term")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_secdb
--
--
DROP TABLE "tiki_secdb";

CREATE TABLE "tiki_secdb"(
  "md5_value" varchar(32) NOT NULL,
  "filename" varchar(250) NOT NULL,
  "tiki_version" varchar(60) NOT NULL,
  "severity" number(4) default '0' NOT NULL,
  PRIMARY KEY ("md5_value","filename","tiki_version")
) ;

CREATE  INDEX "tiki_secdb_sdb_fn" ON "tiki_secdb"("filename");

--
-- Table structure for table tiki_semaphores
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:52 AM
--
DROP TABLE "tiki_semaphores";

CREATE TABLE "tiki_semaphores" (
  "semName" varchar(250) default '' NOT NULL,
  "user" varchar(40) default NULL,
  "timestamp" number(14) default NULL,
  PRIMARY KEY ("semName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_sent_newsletters
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_sent_newsletters";

CREATE SEQUENCE "tiki_sent_newsletters_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_sent_newsletters" (
  "editionId" number(12) NOT NULL,
  "nlId" number(12) default '0' NOT NULL,
  "users" number(10) default NULL,
  "sent" number(14) default NULL,
  "subject" varchar(200) default NULL,
  "data" blob,
  PRIMARY KEY ("editionId")
)   ;

CREATE TRIGGER "tiki_sent_newsletters_trig" BEFORE INSERT ON "tiki_sent_newsletters" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_sent_newsletters_sequ".nextval into :NEW."editionId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_sessions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:52 AM
--
DROP TABLE "tiki_sessions";

CREATE TABLE "tiki_sessions" (
  "sessionId" varchar(32) default '' NOT NULL,
  "user" varchar(40) default NULL,
  "timestamp" number(14) default NULL,
  "tikihost" varchar(200) default NULL,
  PRIMARY KEY ("sessionId")
) ;

CREATE  INDEX "tiki_sessions_user" ON "tiki_sessions"("user");
CREATE  INDEX "tiki_sessions_timestamp" ON "tiki_sessions"("timestamp");
-- --------------------------------------------------------
-- Tables for TikiSheet
DROP TABLE "tiki_sheet_layout";

CREATE TABLE "tiki_sheet_layout" (
  "sheetId" number(8) default '0' NOT NULL,
  "begin" number(10) default '0' NOT NULL,
  "end" number(10) default NULL,
  "headerRow" number(4) default '0' NOT NULL,
  "footerRow" number(4) default '0' NOT NULL,
  "className" varchar(64) default NULL
) ;

CREATE UNIQUE INDEX "tiki_sheet_layout_sheetId" ON "tiki_sheet_layout"("sheetId","begin");

DROP TABLE "tiki_sheet_values";

CREATE TABLE "tiki_sheet_values" (
  "sheetId" number(8) default '0' NOT NULL,
  "begin" number(10) default '0' NOT NULL,
  "end" number(10) default NULL,
  "rowIndex" number(4) default '0' NOT NULL,
  "columnIndex" number(4) default '0' NOT NULL,
  "value" varchar(255) default NULL,
  "calculation" varchar(255) default NULL,
  "width" number(4) default '1' NOT NULL,
  "height" number(4) default '1' NOT NULL,
  "format" varchar(255) default NULL
) ;

CREATE  INDEX "tiki_sheet_values_sheetId_2" ON "tiki_sheet_values"("sheetId","rowIndex","columnIndex");
CREATE UNIQUE INDEX "tiki_sheet_values_sheetId" ON "tiki_sheet_values"("sheetId","begin","rowIndex","columnIndex");

DROP TABLE "tiki_sheets";

CREATE SEQUENCE "tiki_sheets_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_sheets" (
  "sheetId" number(8) NOT NULL,
  "title" varchar(200) default '' NOT NULL,
  "description" clob,
  "author" varchar(200) default '' NOT NULL,
  PRIMARY KEY ("sheetId")
) ;

CREATE TRIGGER "tiki_sheets_trig" BEFORE INSERT ON "tiki_sheets" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_sheets_sequ".nextval into :NEW."sheetId" FROM DUAL;
END;
/

--
-- Table structure for table tiki_shoutbox
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:21 PM
--
DROP TABLE "tiki_shoutbox";

CREATE SEQUENCE "tiki_shoutbox_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_shoutbox" (
  "msgId" number(10) NOT NULL,
  "message" varchar(255) default NULL,
  "timestamp" number(14) default NULL,
  "user" varchar(40) default NULL,
  "hash" varchar(32) default NULL,
  PRIMARY KEY ("msgId")
)   ;

CREATE TRIGGER "tiki_shoutbox_trig" BEFORE INSERT ON "tiki_shoutbox" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_shoutbox_sequ".nextval into :NEW."msgId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_shoutbox_words
--
DROP TABLE "tiki_shoutbox_words";

CREATE TABLE "tiki_shoutbox_words" (
  "word" VARCHAR( 40 ) NOT NULL ,
  "qty" INT DEFAULT '0' NOT NULL ,
  PRIMARY KEY ("word")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_structure_versions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_structure_versions";

CREATE SEQUENCE "tiki_structure_versions_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_structure_versions" (
  "structure_id" number(14) NOT NULL,
  "version" number(14) default NULL,
  PRIMARY KEY ("structure_id")
)   ;

CREATE TRIGGER "tiki_structure_versions_trig" BEFORE INSERT ON "tiki_structure_versions" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_structure_versions_sequ".nextval into :NEW."structure_id" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_structures
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_structures";

CREATE SEQUENCE "tiki_structures_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_structures" (
  "page_ref_id" number(14) NOT NULL,
  "structure_id" number(14) NOT NULL,
  "parent_id" number(14) default NULL,
  "page_id" number(14) NOT NULL,
  "page_version" number(8) default NULL,
  "page_alias" varchar(240) default '' NOT NULL,
  "pos" number(4) default NULL,
  PRIMARY KEY ("page_ref_id")
)   ;

CREATE TRIGGER "tiki_structures_trig" BEFORE INSERT ON "tiki_structures" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_structures_sequ".nextval into :NEW."page_ref_id" FROM DUAL;
END;
/
CREATE  INDEX "tiki_structures_pidpaid" ON "tiki_structures"("page_id","parent_id");
-- --------------------------------------------------------
--
-- Table structure for table tiki_submissions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 08, 2003 at 04:16 PM
--
DROP TABLE "tiki_submissions";

CREATE SEQUENCE "tiki_submissions_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_submissions" (
  "subId" number(8) NOT NULL,
  "topline" varchar(255) default NULL,
  "title" varchar(80) default NULL,
  "subtitle" varchar(255) default NULL,
  "linkto" varchar(255) default NULL,
  "lang" varchar(16) default NULL,
  "authorName" varchar(60) default NULL,
  "topicId" number(14) default NULL,
  "topicName" varchar(40) default NULL,
  "size" number(12) default NULL,
  "useImage" char(1) default NULL,
  "image_name" varchar(80) default NULL,
  "image_caption" clob default NULL,
  "image_type" varchar(80) default NULL,
  "image_size" number(14) default NULL,
  "image_x" number(4) default NULL,
  "image_y" number(4) default NULL,
  "image_data" blob,
  "publishDate" number(14) default NULL,
  "expireDate" number(14) default NULL,
  "created" number(14) default NULL,
  "bibliographical_references" clob,
  "resume" clob,
  "heading" clob,
  "body" clob,
  "hash" varchar(32) default NULL,
  "author" varchar(200) default NULL,
  "nbreads" number(14) default NULL,
  "votes" number(8) default NULL,
  "points" number(14) default NULL,
  "type" varchar(50) default NULL,
  "rating" decimal(3,2) default NULL,
  "isfloat" char(1) default NULL,
  PRIMARY KEY ("subId")
)   ;

CREATE TRIGGER "tiki_submissions_trig" BEFORE INSERT ON "tiki_submissions" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_submissions_sequ".nextval into :NEW."subId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_suggested_faq_questions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 08:52 PM
--
DROP TABLE "tiki_suggested_faq_questions";

CREATE SEQUENCE "tiki_suggested_faq_questions_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_suggested_faq_questions" (
  "sfqId" number(10) NOT NULL,
  "faqId" number(10) default '0' NOT NULL,
  "question" clob,
  "answer" clob,
  "created" number(14) default NULL,
  "user" varchar(40) default NULL,
  PRIMARY KEY ("sfqId")
)   ;

CREATE TRIGGER "tiki_suggested_faq_questions_trig" BEFORE INSERT ON "tiki_suggested_faq_questions" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_suggested_faq_questions_sequ".nextval into :NEW."sfqId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_survey_question_options
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 12:55 AM
--
DROP TABLE "tiki_survey_question_options";

CREATE SEQUENCE "tiki_survey_question_options_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_survey_question_options" (
  "optionId" number(12) NOT NULL,
  "questionId" number(12) default '0' NOT NULL,
  "qoption" clob,
  "votes" number(10) default NULL,
  PRIMARY KEY ("optionId")
)   ;

CREATE TRIGGER "tiki_survey_question_options_trig" BEFORE INSERT ON "tiki_survey_question_options" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_survey_question_options_sequ".nextval into :NEW."optionId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_survey_questions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 11:55 PM
--
DROP TABLE "tiki_survey_questions";

CREATE SEQUENCE "tiki_survey_questions_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_survey_questions" (
  "questionId" number(12) NOT NULL,
  "surveyId" number(12) default '0' NOT NULL,
  "question" clob,
  "options" clob,
  "type" char(1) default NULL,
  "position" number(5) default NULL,
  "votes" number(10) default NULL,
  "value" number(10) default NULL,
  "average" decimal(4,2) default NULL,
  PRIMARY KEY ("questionId")
)   ;

CREATE TRIGGER "tiki_survey_questions_trig" BEFORE INSERT ON "tiki_survey_questions" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_survey_questions_sequ".nextval into :NEW."questionId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_surveys
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:40 PM
--
DROP TABLE "tiki_surveys";

CREATE SEQUENCE "tiki_surveys_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_surveys" (
  "surveyId" number(12) NOT NULL,
  "name" varchar(200) default NULL,
  "description" clob,
  "taken" number(10) default NULL,
  "lastTaken" number(14) default NULL,
  "created" number(14) default NULL,
  "status" char(1) default NULL,
  PRIMARY KEY ("surveyId")
)   ;

CREATE TRIGGER "tiki_surveys_trig" BEFORE INSERT ON "tiki_surveys" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_surveys_sequ".nextval into :NEW."surveyId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_tags
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 06, 2003 at 02:58 AM
--
DROP TABLE "tiki_tags";

CREATE TABLE "tiki_tags" (
  "tagName" varchar(80) default '' NOT NULL,
  "pageName" varchar(160) default '' NOT NULL,
  "hits" number(8) default NULL,
  "description" varchar(200) default NULL,
  "data" blob,
  "lastModif" number(14) default NULL,
  "comment" varchar(200) default NULL,
  "version" number(8) default '0' NOT NULL,
  "user" varchar(40) default NULL,
  "ip" varchar(15) default NULL,
  "flag" char(1) default NULL,
  PRIMARY KEY ("tagName","pageName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_theme_control_categs
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_theme_control_categs";

CREATE TABLE "tiki_theme_control_categs" (
  "categId" number(12) default '0' NOT NULL,
  "theme" varchar(250) default '' NOT NULL,
  PRIMARY KEY ("categId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_theme_control_objects
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_theme_control_objects";

CREATE TABLE "tiki_theme_control_objects" (
  "objId" varchar(250) default '' NOT NULL,
  "type" varchar(250) default '' NOT NULL,
  "name" varchar(250) default '' NOT NULL,
  "theme" varchar(250) default '' NOT NULL,
  PRIMARY KEY ("objId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_theme_control_sections
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_theme_control_sections";

CREATE TABLE "tiki_theme_control_sections" (
  "section" varchar(250) default '' NOT NULL,
  "theme" varchar(250) default '' NOT NULL,
  PRIMARY KEY ("section")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_topics
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 04, 2003 at 10:10 PM
--
DROP TABLE "tiki_topics";

CREATE SEQUENCE "tiki_topics_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_topics" (
  "topicId" number(14) NOT NULL,
  "name" varchar(40) default NULL,
  "image_name" varchar(80) default NULL,
  "image_type" varchar(80) default NULL,
  "image_size" number(14) default NULL,
  "image_data" blob,
  "active" char(1) default NULL,
  "created" number(14) default NULL,
  PRIMARY KEY ("topicId")
)   ;

CREATE TRIGGER "tiki_topics_trig" BEFORE INSERT ON "tiki_topics" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_topics_sequ".nextval into :NEW."topicId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_tracker_fields
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 08, 2003 at 01:48 PM
--
DROP TABLE "tiki_tracker_fields";

CREATE SEQUENCE "tiki_tracker_fields_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_tracker_fields" (
  "fieldId" number(12) NOT NULL,
  "trackerId" number(12) default '0' NOT NULL,
  "name" varchar(255) default NULL,
  "options" clob,
  "type" char(1) default NULL,
  "isMain" char(1) default NULL,
  "isTblVisible" char(1) default NULL,
  "position" number(4) default NULL,
  "isSearchable" char(1) default 'y' NOT NULL,
  "isPublic" char(1) default 'n' NOT NULL,
  "isHidden" char(1) default 'n' NOT NULL,
  "isMandatory" char(1) default 'n' NOT NULL,
  PRIMARY KEY ("fieldId")
)   ;

CREATE TRIGGER "tiki_tracker_fields_trig" BEFORE INSERT ON "tiki_tracker_fields" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_tracker_fields_sequ".nextval into :NEW."fieldId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_tracker_item_attachments
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_tracker_item_attachments";

CREATE SEQUENCE "tiki_tracker_item_attachments_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_tracker_item_attachments" (
  "attId" number(12) NOT NULL,
  "itemId" number(12) default 0 NOT NULL,
  "filename" varchar(80) default NULL,
  "filetype" varchar(80) default NULL,
  "filesize" number(14) default NULL,
  "user" varchar(40) default NULL,
  "data" blob,
  "path" varchar(255) default NULL,
  "downloads" number(10) default NULL,
  "created" number(14) default NULL,
  "comment" varchar(250) default NULL,
  "longdesc" blob,
  "version" varchar(40) default NULL,
  PRIMARY KEY ("attId")
)   ;

CREATE TRIGGER "tiki_tracker_item_attachments_trig" BEFORE INSERT ON "tiki_tracker_item_attachments" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_tracker_item_attachments_sequ".nextval into :NEW."attId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_tracker_item_comments
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:12 AM
--
DROP TABLE "tiki_tracker_item_comments";

CREATE SEQUENCE "tiki_tracker_item_comments_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_tracker_item_comments" (
  "commentId" number(12) NOT NULL,
  "itemId" number(12) default '0' NOT NULL,
  "user" varchar(40) default NULL,
  "data" clob,
  "title" varchar(200) default NULL,
  "posted" number(14) default NULL,
  PRIMARY KEY ("commentId")
)   ;

CREATE TRIGGER "tiki_tracker_item_comments_trig" BEFORE INSERT ON "tiki_tracker_item_comments" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_tracker_item_comments_sequ".nextval into :NEW."commentId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_tracker_item_fields
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:26 AM
--
DROP TABLE "tiki_tracker_item_fields";

CREATE TABLE "tiki_tracker_item_fields" (
  "itemId" number(12) default '0' NOT NULL,
  "fieldId" number(12) default '0' NOT NULL,
  "value" clob,
  PRIMARY KEY ("itemId","fieldId")
) ;

CREATE  INDEX "tiki_tracker_item_fields_ft" ON "tiki_tracker_item_fields"("value");
-- --------------------------------------------------------
--
-- Table structure for table tiki_tracker_items
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:26 AM
--
DROP TABLE "tiki_tracker_items";

CREATE SEQUENCE "tiki_tracker_items_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_tracker_items" (
  "itemId" number(12) NOT NULL,
  "trackerId" number(12) default '0' NOT NULL,
  "created" number(14) default NULL,
  "status" char(1) default NULL,
  "lastModif" number(14) default NULL,
  PRIMARY KEY ("itemId")
)   ;

CREATE TRIGGER "tiki_tracker_items_trig" BEFORE INSERT ON "tiki_tracker_items" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_tracker_items_sequ".nextval into :NEW."itemId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_tracker_options
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 08, 2003 at 01:48 PM
--
DROP TABLE "tiki_tracker_options";

CREATE TABLE "tiki_tracker_options" (
  "trackerId" number(12) default '0' NOT NULL,
  "name" varchar(80) default '' NOT NULL,
  "value" clob default NULL,
  PRIMARY KEY ("trackerId","name")
)  ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_trackers
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:26 AM
--
DROP TABLE "tiki_trackers";

CREATE SEQUENCE "tiki_trackers_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_trackers" (
  "trackerId" number(12) NOT NULL,
  "name" varchar(255) default NULL,
  "description" clob,
  "created" number(14) default NULL,
  "lastModif" number(14) default NULL,
  "showCreated" char(1) default NULL,
  "showStatus" char(1) default NULL,
  "showLastModif" char(1) default NULL,
  "useComments" char(1) default NULL,
  "useAttachments" char(1) default NULL,
  "showAttachments" char(1) default NULL,
  "items" number(10) default NULL,
  "showComments" char(1) default NULL,
  "orderAttachments" varchar(255) default 'filename,created,filesize,downloads,desc' NOT NULL,
  PRIMARY KEY ("trackerId")
)   ;

CREATE TRIGGER "tiki_trackers_trig" BEFORE INSERT ON "tiki_trackers" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_trackers_sequ".nextval into :NEW."trackerId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_untranslated
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_untranslated";

CREATE SEQUENCE "tiki_untranslated_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_untranslated" (
  "id" number(14) NOT NULL,
  "source" blob NOT NULL,
  "lang" char(16) default '' NOT NULL,
  PRIMARY KEY ("source","lang")
)   ;

CREATE TRIGGER "tiki_untranslated_trig" BEFORE INSERT ON "tiki_untranslated" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_untranslated_sequ".nextval into :NEW."id" FROM DUAL;
END;
/
CREATE  INDEX "tiki_untranslated_id_2" ON "tiki_untranslated"("id");
CREATE UNIQUE INDEX "tiki_untranslated_id" ON "tiki_untranslated"("id");
-- --------------------------------------------------------
--
-- Table structure for table tiki_user_answers
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_user_answers";

CREATE TABLE "tiki_user_answers" (
  "userResultId" number(10) default '0' NOT NULL,
  "quizId" number(10) default '0' NOT NULL,
  "questionId" number(10) default '0' NOT NULL,
  "optionId" number(10) default '0' NOT NULL,
  PRIMARY KEY ("userResultId","quizId","questionId","optionId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_user_answers_uploads
--
-- Creation: Jan 25, 2005 at 07:42 PM
-- Last update: Jan 25, 2005 at 07:42 PM
--
DROP TABLE "tiki_user_answers_uploads";

CREATE SEQUENCE "tiki_user_answers_uploads_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_user_answers_uploads" (
  "answerUploadId" number(4) NOT NULL,
  "userResultId" number(11) default '0' NOT NULL,
  "questionId" number(11) default '0' NOT NULL,
  "filename" varchar(255) default '' NOT NULL,
  "filetype" varchar(64) default '' NOT NULL,
  "filesize" varchar(255) default '' NOT NULL,
  "filecontent" blob NOT NULL,
  PRIMARY KEY ("answerUploadId")
) ;

CREATE TRIGGER "tiki_user_answers_uploads_trig" BEFORE INSERT ON "tiki_user_answers_uploads" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_user_answers_uploads_sequ".nextval into :NEW."answerUploadId" FROM DUAL;
END;
/

--
-- Table structure for table tiki_user_assigned_modules
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:25 PM
--
DROP TABLE "tiki_user_assigned_modules";

CREATE TABLE "tiki_user_assigned_modules" (
  "name" varchar(200) default '' NOT NULL,
  "position" char(1) default NULL,
  "ord" number(4) default NULL,
  "type" char(1) default NULL,
  "user" varchar(40) default '' NOT NULL,
  PRIMARY KEY ("name","user")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_user_bookmarks_folders
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 08:35 AM
--
DROP TABLE "tiki_user_bookmarks_folders";

CREATE SEQUENCE "tiki_user_bookmarks_folders_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_user_bookmarks_folders" (
  "folderId" number(12) NOT NULL,
  "parentId" number(12) default NULL,
  "user" varchar(40) default '' NOT NULL,
  "name" varchar(30) default NULL,
  PRIMARY KEY ("user","folderId")
)   ;

CREATE TRIGGER "tiki_user_bookmarks_folders_trig" BEFORE INSERT ON "tiki_user_bookmarks_folders" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_user_bookmarks_folders_sequ".nextval into :NEW."folderId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_user_bookmarks_urls
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 08:36 AM
--
DROP TABLE "tiki_user_bookmarks_urls";

CREATE SEQUENCE "tiki_user_bookmarks_urls_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_user_bookmarks_urls" (
  "urlId" number(12) NOT NULL,
  "name" varchar(30) default NULL,
  "url" varchar(250) default NULL,
  "data" blob,
  "lastUpdated" number(14) default NULL,
  "folderId" number(12) default '0' NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  PRIMARY KEY ("urlId")
)   ;

CREATE TRIGGER "tiki_user_bookmarks_urls_trig" BEFORE INSERT ON "tiki_user_bookmarks_urls" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_user_bookmarks_urls_sequ".nextval into :NEW."urlId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_user_mail_accounts
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_user_mail_accounts";

CREATE SEQUENCE "tiki_user_mail_accounts_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_user_mail_accounts" (
  "accountId" number(12) NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  "account" varchar(50) default '' NOT NULL,
  "pop" varchar(255) default NULL,
  "current" char(1) default NULL,
  "port" number(4) default NULL,
  "username" varchar(100) default NULL,
  "pass" varchar(100) default NULL,
  "msgs" number(4) default NULL,
  "smtp" varchar(255) default NULL,
  "useAuth" char(1) default NULL,
  "smtpPort" number(4) default NULL,
  PRIMARY KEY ("accountId")
)   ;

CREATE TRIGGER "tiki_user_mail_accounts_trig" BEFORE INSERT ON "tiki_user_mail_accounts" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_user_mail_accounts_sequ".nextval into :NEW."accountId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_user_menus
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 10:58 PM
--
DROP TABLE "tiki_user_menus";

CREATE SEQUENCE "tiki_user_menus_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_user_menus" (
  "user" varchar(40) default '' NOT NULL,
  "menuId" number(12) NOT NULL,
  "url" varchar(250) default NULL,
  "name" varchar(40) default NULL,
  "position" number(4) default NULL,
  "mode" char(1) default NULL,
  PRIMARY KEY ("menuId")
)   ;

CREATE TRIGGER "tiki_user_menus_trig" BEFORE INSERT ON "tiki_user_menus" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_user_menus_sequ".nextval into :NEW."menuId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_user_modules
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 05, 2003 at 03:16 AM
--
DROP TABLE "tiki_user_modules";

CREATE TABLE "tiki_user_modules" (
  "name" varchar(200) default '' NOT NULL,
  "title" varchar(40) default NULL,
  "data" blob,
  "parse" char(1) default NULL,
  PRIMARY KEY ("name")
) ;

-- --------------------------------------------------------
INSERT INTO "tiki_user_modules" ("name","title","data","parse") VALUES ('mnu_application_menu', 'Menu', '{menu id=42}', 'n');


--
-- Table structure for table tiki_user_notes
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:52 AM
--
DROP TABLE "tiki_user_notes";

CREATE SEQUENCE "tiki_user_notes_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_user_notes" (
  "user" varchar(40) default '' NOT NULL,
  "noteId" number(12) NOT NULL,
  "created" number(14) default NULL,
  "name" varchar(255) default NULL,
  "lastModif" number(14) default NULL,
  "data" clob,
  "size" number(14) default NULL,
  "parse_mode" varchar(20) default NULL,
  PRIMARY KEY ("noteId")
)   ;

CREATE TRIGGER "tiki_user_notes_trig" BEFORE INSERT ON "tiki_user_notes" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_user_notes_sequ".nextval into :NEW."noteId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_user_postings
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:12 AM
--
DROP TABLE "tiki_user_postings";

CREATE TABLE "tiki_user_postings" (
  "user" varchar(40) default '' NOT NULL,
  "posts" number(12) default NULL,
  "last" number(14) default NULL,
  "first" number(14) default NULL,
  "level" number(8) default NULL,
  PRIMARY KEY ("user")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_user_preferences
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:09 AM
--
DROP TABLE "tiki_user_preferences";

CREATE TABLE "tiki_user_preferences" (
  "user" varchar(40) default '' NOT NULL,
  "prefName" varchar(40) default '' NOT NULL,
  "value" varchar(250) default NULL,
  PRIMARY KEY ("user","prefName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_user_quizzes
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_user_quizzes";

CREATE SEQUENCE "tiki_user_quizzes_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_user_quizzes" (
  "user" varchar(40) default NULL,
  "quizId" number(10) default NULL,
  "timestamp" number(14) default NULL,
  "timeTaken" number(14) default NULL,
  "points" number(12) default NULL,
  "maxPoints" number(12) default NULL,
  "resultId" number(10) default NULL,
  "userResultId" number(10) NOT NULL,
  PRIMARY KEY ("userResultId")
)   ;

CREATE TRIGGER "tiki_user_quizzes_trig" BEFORE INSERT ON "tiki_user_quizzes" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_user_quizzes_sequ".nextval into :NEW."userResultId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_user_taken_quizzes
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_user_taken_quizzes";

CREATE TABLE "tiki_user_taken_quizzes" (
  "user" varchar(40) default '' NOT NULL,
  "quizId" varchar(255) default '' NOT NULL,
  PRIMARY KEY ("user","quizId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_user_tasks_history
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jan 25, 2005 by sir-b & moresun
--
DROP TABLE "tiki_user_tasks_history";

CREATE TABLE "tiki_user_tasks_history" (
  "belongs_to" integer(14) NOT NULL,                   -- the fist task in a history it has the same id as the task id
  "task_version" integer(4) DEFAULT 0 NOT NULL,        -- version number for the history it starts with 0
  "title" varchar(250) NOT NULL,                       -- title
  "description" clob DEFAULT NULL,                     -- description
  "start" integer(14) DEFAULT NULL,                    -- date of the starting, if it is not set than there is not starting date
  "end" integer(14) DEFAULT NULL,                      -- date of the end, if it is not set than there is not dealine
  "lasteditor" varchar(200) NOT NULL,                  -- lasteditor: username of last editior
  "lastchanges" integer(14) NOT NULL,                  -- date of last changes
  "priority" integer(2) DEFAULT 3 NOT NULL,                     -- priority
  "completed" integer(14) DEFAULT NULL,                -- date of the completation if it is null it is not yet completed
  "deleted" integer(14) DEFAULT NULL,                  -- date of the deleteation it it is null it is not deleted
  "status" char(1) DEFAULT NULL,                       -- null := waiting, 
                                                     -- o := open / in progress, 
                                                     -- c := completed -> (percentage = 100) 
  "percentage" number(4) DEFAULT NULL,
  "accepted_creator" char(1) DEFAULT NULL,             -- y - yes, n - no, null - waiting
  "accepted_user" char(1) DEFAULT NULL,                -- y - yes, n - no, null - waiting
  PRIMARY KEY (belongs_to, task_version)
)   ;


--
-- Table structure for table tiki_user_tasks
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jan 25, 2005 by sir-b & moresun
--
DROP TABLE "tiki_user_tasks";

CREATE TABLE "tiki_user_tasks" (
  "taskId" integer(14) NOT NULL auto_increment,        -- task id
  "last_version" integer(4) DEFAULT 0 NOT NULL,        -- last version of the task starting with 0
  "user" varchar(40) DEFAULT '' NOT NULL,              -- task user
  "creator" varchar(200) NOT NULL,                     -- username of creator
  "public_for_group" varchar(30) DEFAULT NULL,         -- this group can also view the task, if it is null it is not public
  "rights_by_creator" char(1) DEFAULT NULL,            -- null the user can delete the task, 
  "created" integer(14) NOT NULL,                      -- date of the creation
  "status" char(1) default NULL,
  "priority" number(2) default NULL,
  "completed" number(14) default NULL,
  "percentage" number(4) default NULL,
  PRIMARY KEY (taskId),
  UNIQUE(creator, created)
)  ;


-- --------------------------------------------------------
--
-- Table structure for table tiki_user_votings
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 11:55 PM
--
DROP TABLE "tiki_user_votings";

CREATE TABLE "tiki_user_votings" (
  "user" varchar(40) default '' NOT NULL,
  "id" varchar(255) default '' NOT NULL,
  "optionId" number(10) default 0 NOT NULL,
  PRIMARY KEY ("user","id")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_user_watches
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 08:07 AM
--
DROP TABLE "tiki_user_watches";

CREATE TABLE "tiki_user_watches" (
  "user" varchar(40) default '' NOT NULL,
  "event" varchar(40) default '' NOT NULL,
  "object" varchar(200) default '' NOT NULL,
  "hash" varchar(32) default NULL,
  "title" varchar(250) default NULL,
  "type" varchar(200) default NULL,
  "url" varchar(250) default NULL,
  "email" varchar(200) default NULL,
  PRIMARY KEY ("user","event","object")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_userfiles
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_userfiles";

CREATE SEQUENCE "tiki_userfiles_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_userfiles" (
  "user" varchar(40) default '' NOT NULL,
  "fileId" number(12) NOT NULL,
  "name" varchar(200) default NULL,
  "filename" varchar(200) default NULL,
  "filetype" varchar(200) default NULL,
  "filesize" varchar(200) default NULL,
  "data" blob,
  "hits" number(8) default NULL,
  "isFile" char(1) default NULL,
  "path" varchar(255) default NULL,
  "created" number(14) default NULL,
  PRIMARY KEY ("fileId")
)   ;

CREATE TRIGGER "tiki_userfiles_trig" BEFORE INSERT ON "tiki_userfiles" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_userfiles_sequ".nextval into :NEW."fileId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_userpoints
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 05:47 AM
--
DROP TABLE "tiki_userpoints";

CREATE TABLE "tiki_userpoints" (
  "user" varchar(40) default NULL,
  "points" decimal(8,2) default NULL,
  "voted" number(8) default NULL
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_users
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_users";

CREATE TABLE "tiki_users" (
  "user" varchar(40) default '' NOT NULL,
  "password" varchar(40) default NULL,
  "email" varchar(200) default NULL,
  "lastLogin" number(14) default NULL,
  PRIMARY KEY ("user")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_webmail_contacts
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_webmail_contacts";

CREATE SEQUENCE "tiki_webmail_contacts_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_webmail_contacts" (
  "contactId" number(12) NOT NULL,
  "firstName" varchar(80) default NULL,
  "lastName" varchar(80) default NULL,
  "email" varchar(250) default NULL,
  "nickname" varchar(200) default NULL,
  "user" varchar(40) default '' NOT NULL,
  PRIMARY KEY ("contactId")
)   ;

CREATE TRIGGER "tiki_webmail_contacts_trig" BEFORE INSERT ON "tiki_webmail_contacts" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_webmail_contacts_sequ".nextval into :NEW."contactId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_webmail_messages
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_webmail_messages";

CREATE TABLE "tiki_webmail_messages" (
  "accountId" number(12) default '0' NOT NULL,
  "mailId" varchar(255) default '' NOT NULL,
  "user" varchar(40) default '' NOT NULL,
  "isRead" char(1) default NULL,
  "isReplied" char(1) default NULL,
  "isFlagged" char(1) default NULL,
  PRIMARY KEY ("accountId","mailId")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_wiki_attachments
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_wiki_attachments";

CREATE SEQUENCE "tiki_wiki_attachments_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_wiki_attachments" (
  "attId" number(12) NOT NULL,
  "page" varchar(200) default '' NOT NULL,
  "filename" varchar(80) default NULL,
  "filetype" varchar(80) default NULL,
  "filesize" number(14) default NULL,
  "user" varchar(40) default NULL,
  "data" blob,
  "path" varchar(255) default NULL,
  "downloads" number(10) default NULL,
  "created" number(14) default NULL,
  "comment" varchar(250) default NULL,
  PRIMARY KEY ("attId")
)   ;

CREATE TRIGGER "tiki_wiki_attachments_trig" BEFORE INSERT ON "tiki_wiki_attachments" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_wiki_attachments_sequ".nextval into :NEW."attId" FROM DUAL;
END;
/
-- --------------------------------------------------------
--
-- Table structure for table tiki_zones
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 07:42 PM
--
DROP TABLE "tiki_zones";

CREATE TABLE "tiki_zones" (
  "zone" varchar(40) default '' NOT NULL,
  PRIMARY KEY ("zone")
) ;

-- --------------------------------------------------------
--
-- Table structure for table tiki_download
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Apr 15 2004 at 07:42 PM
--
DROP TABLE "tiki_download";

CREATE SEQUENCE "tiki_download_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_download" (
  "id" number(11) NOT NULL,
  "object" varchar(255) default '' NOT NULL,
  "userId" number(8) default '0' NOT NULL,
  "type" varchar(20) default '' NOT NULL,
  "date" number(14) default '0' NOT NULL,
  "IP" varchar(50) default '' NOT NULL,
  PRIMARY KEY ("id")
) ;

CREATE TRIGGER "tiki_download_trig" BEFORE INSERT ON "tiki_download" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_download_sequ".nextval into :NEW."id" FROM DUAL;
END;
/
CREATE  INDEX "tiki_download_object" ON "tiki_download"("object","userId","type");
CREATE  INDEX "tiki_download_userId" ON "tiki_download"("userId");
CREATE  INDEX "tiki_download_type" ON "tiki_download"("type");
CREATE  INDEX "tiki_download_date" ON "tiki_download"("date");
-- --------------------------------------------------------
--
-- Table structure for table users_grouppermissions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 07:22 AM
--
DROP TABLE "users_grouppermissions";

CREATE TABLE "users_grouppermissions" (
  "groupName" varchar(255) default '' NOT NULL,
  "permName" varchar(30) default '' NOT NULL,
  "value" char(1) default '',
  PRIMARY KEY ("groupName","permName")
) ;

-- --------------------------------------------------------
INSERT INTO "users_grouppermissions" ("groupName","permName") VALUES ('Anonymous','tiki_p_view');

INSERT INTO "users_grouppermissions" ("groupName","permName") VALUES ('Anonymous','tiki_p_wiki_view_history');

INSERT INTO "users_grouppermissions" ("groupName","permName") VALUES ('Anonymous','tiki_p_wiki_view_comments');


--
-- Table structure for table users_groups
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 03, 2003 at 08:57 PM
--
DROP TABLE "users_groups";

CREATE TABLE "users_groups" (
  "groupName" varchar(255) default '' NOT NULL,
  "groupDesc" varchar(255) default NULL,
  "groupHome" varchar(255),
  "usersTrackerId" number(11),
  "groupTrackerId" number(11),
  "usersFieldId" number(11),
  "groupFieldId" number(11),
  PRIMARY KEY ("groupName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table users_objectpermissions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 07:20 AM
--
DROP TABLE "users_objectpermissions";

CREATE TABLE "users_objectpermissions" (
  "groupName" varchar(255) default '' NOT NULL,
  "permName" varchar(30) default '' NOT NULL,
  "objectType" varchar(20) default '' NOT NULL,
  "objectId" varchar(32) default '' NOT NULL,
  PRIMARY KEY ("objectId","objectType","groupName","permName")
) ;

-- --------------------------------------------------------
--
-- Table structure for table users_permissions
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 11, 2003 at 07:22 AM
--
DROP TABLE "users_permissions";

CREATE TABLE "users_permissions" (
  "permName" varchar(30) default '' NOT NULL,
  "permDesc" varchar(250) default NULL,
  "level" varchar(80) default NULL,
  "type" varchar(20) default NULL,
  PRIMARY KEY ("permName")
) ;

CREATE  INDEX "users_permissions_type" ON "users_permissions"("type");
-- --------------------------------------------------------
-- 
INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_abort_instance', 'Can abort a process instance', 'editors', 'workflow');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_access_closed_site', 'Can access site when closed', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_add_events', 'Can add events in the calendar', 'registered', 'calendar');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin', 'Administrator, can manage users groups and permissions, Hotwords and all the weblog features', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_banners', 'Administrator, can admin banners', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_banning', 'Can ban users or ips', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_calendar', 'Can create/admin calendars', 'admin', 'calendar');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_categories', 'Can admin categories', 'editors', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_charts', 'Can admin charts', 'admin', 'charts');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_chat', 'Administrator, can create channels remove channels etc', 'editors', 'chat');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_cms', 'Can admin the cms', 'editors', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_directory', 'Can admin the directory', 'editors', 'directory');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_directory_cats', 'Can admin directory categories', 'editors', 'directory');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_directory_sites', 'Can admin directory sites', 'editors', 'directory');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_drawings', 'Can admin drawings', 'editors', 'drawings');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_dynamic', 'Can admin the dynamic content system', 'editors', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_faqs', 'Can admin faqs', 'editors', 'faqs');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_file_galleries', 'Can admin file galleries', 'editors', 'file galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_forum', 'Can admin forums', 'editors', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_galleries', 'Can admin Image Galleries', 'editors', 'image galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_games', 'Can admin games', 'editors', 'games');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_integrator', 'Can admin integrator repositories and rules', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_mailin', 'Can admin mail-in accounts', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_newsletters', 'Can admin newsletters', 'admin', 'newsletters');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_objects','Can edit object permissions', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_polls','Can admin polls', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_quizzes', 'Can admin quizzes', 'editors', 'quizzes');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_received_articles', 'Can admin received articles', 'editors', 'comm');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_received_pages', 'Can admin received pages', 'editors', 'comm');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_rssmodules','Can admin rss modules', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_sheet', 'Can admin sheet', 'admin', 'sheet');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_shoutbox', 'Can admin shoutbox (Edit/remove msgs)', 'editors', 'shoutbox');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_surveys', 'Can admin surveys', 'editors', 'surveys');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_trackers', 'Can admin trackers', 'editors', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_users', 'Can admin users', 'admin', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_wiki', 'Can admin the wiki', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_admin_workflow', 'Can admin workflow processes', 'admin', 'workflow');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_approve_submission', 'Can approve submissions', 'editors', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_attach_trackers', 'Can attach files to tracker items', 'registered', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_autoapprove_submission', 'Submited articles automatically approved', 'editors', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_autosubmit_link', 'Submited links are valid', 'editors', 'directory');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_autoval_chart_suggestio', 'Autovalidate suggestions', 'editors', 'charts');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_batch_upload_files', 'Can upload zip files with files', 'editors', 'file galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_batch_upload_image_dir', 'Can use Directory Batch Load', 'editors', 'image galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_batch_upload_images', 'Can upload zip files with images', 'editors', 'image galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_blog_admin', 'Can admin blogs', 'editors', 'blogs');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_blog_post', 'Can post to a blog', 'registered', 'blogs');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_broadcast', 'Can broadcast messages to groups', 'admin', 'messu');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_broadcast_all', 'Can broadcast messages to all user', 'admin', 'messu');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_cache_bookmarks', 'Can cache user bookmarks', 'admin', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_change_events', 'Can change events in the calendar', 'registered', 'calendar');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_chat', 'Can use the chat system', 'registered', 'chat');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_comment_tracker_items', 'Can insert comments for tracker items', 'basic', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_configure_modules', 'Can configure modules', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_create_blogs', 'Can create a blog', 'editors', 'blogs');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_create_bookmarks', 'Can create user bookmarks', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_create_css', 'Can create new css suffixed with -user', 'registered', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_create_file_galleries', 'Can create file galleries', 'editors', 'file galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_create_galleries', 'Can create image galleries', 'editors', 'image galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_create_tracker_items', 'Can create new items for trackers', 'registered', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_download_files', 'Can download files', 'basic', 'file galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit', 'Can edit pages', 'registered', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_article', 'Can edit articles', 'editors', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_comments', 'Can edit all comments', 'editors', 'comments');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_content_templates', 'Can edit content templates', 'editors', 'content templates');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_cookies', 'Can admin cookies', 'editors', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_copyrights', 'Can edit copyright notices', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_drawings', 'Can edit drawings', 'basic', 'drawings');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_dynvar', 'Can edit dynamic variables', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_html_pages', 'Can edit HTML pages', 'editors', 'html pages');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_languages', 'Can edit translations and create new languages', 'editors', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_sheet', 'Can create and edit sheets', 'editors', 'sheet');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_structures', 'Can create and edit structures', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_submission', 'Can edit submissions', 'editors', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_edit_templates', 'Can edit site templates', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_eph_admin', 'Can admin ephemerides', 'editors', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_exception_instance', 'Can declare an instance as exception', 'registered', 'workflow');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_forum_attach', 'Can attach to forum posts', 'registered', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_forum_autoapp', 'Auto approve forum posts', 'editors', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_forum_post', 'Can post in forums', 'registered', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_forum_post_topic', 'Can start threads in forums', 'registered', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_forum_read', 'Can read forums', 'basic', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_forum_vote', 'Can vote comments in forums', 'registered', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_forums_report', 'Can report msgs to moderator', 'registered', 'forums');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_list_users', 'Can list registered users', 'registered', 'community');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_live_support', 'Can use live support system', 'basic', 'support');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_live_support_admin', 'Admin live support system', 'admin', 'support');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_lock', 'Can lock pages', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_map_create', 'Can create new mapfile', 'admin', 'maps');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_map_delete', 'Can delete mapfiles', 'admin', 'maps');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_map_edit', 'Can edit mapfiles', 'editors', 'maps');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_map_view', 'Can view mapfiles', 'basic', 'maps');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_map_view_mapfiles', 'Can view contents of mapfiles', 'registered', 'maps');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_messages', 'Can use the messaging system', 'registered', 'messu');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_minical', 'Can use the mini event calendar', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_minor', 'Can save as minor edit', 'registered', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_modify_tracker_items', 'Can change tracker items', 'registered', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_newsreader', 'Can use the newsreader', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_notepad', 'Can use the notepad', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_play_games', 'Can play games', 'basic', 'games');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_post_comments', 'Can post new comments', 'registered', 'comments');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_post_shoutbox', 'Can post messages in shoutbox', 'basic', 'shoutbox');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_read_article', 'Can read articles', 'basic', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_read_blog', 'Can read blogs', 'basic', 'blogs');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_read_comments', 'Can read comments', 'basic', 'comments');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_remove', 'Can remove', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_remove_article', 'Can remove articles', 'editors', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_remove_comments', 'Can delete comments', 'editors', 'comments');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_remove_submission', 'Can remove submissions', 'editors', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_rename', 'Can rename pages', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_rollback', 'Can rollback pages', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_send_articles', 'Can send articles to other sites', 'editors', 'comm');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_send_instance', 'Can send instances after completion', 'registered', 'workflow');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_send_newsletters', 'Can send newsletters', 'editors', 'newsletters');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_send_pages', 'Can send pages to other sites', 'registered', 'comm');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_sendme_articles', 'Can send articles to this site', 'registered', 'comm');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_sendme_pages', 'Can send pages to this site', 'registered', 'comm');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_submit_article', 'Can submit articles', 'basic', 'cms');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_submit_link', 'Can submit sites to the directory', 'basic', 'directory');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_subscribe_email', 'Can subscribe any email to newsletters', 'editors', 'newsletters');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_subscribe_newsletters', 'Can subscribe to newsletters', 'basic', 'newsletters');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_suggest_chart_item', 'Can suggest items', 'basic', 'charts');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_suggest_faq', 'Can suggest faq questions', 'basic', 'faqs');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_take_quiz', 'Can take quizzes', 'basic', 'quizzes');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_take_survey', 'Can take surveys', 'basic', 'surveys');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_tasks', 'Can use tasks', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_tasks_admin', 'Can admin public tasks', 'admin', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_tasks_receive', 'Can  receive tasks from other users', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_tasks_send', 'Can send tasks to other users', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_topic_read', 'Can read a topic (Applies only to individual topic perms)', 'basic', 'topics');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_tracker_view_ratings', 'Can view rating result for tracker items', 'basic', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_tracker_vote_ratings', 'Can vote a rating for tracker items', 'registered', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_upload_files', 'Can upload files', 'registered', 'file galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_upload_images', 'Can upload images', 'registered', 'image galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_upload_picture', 'Can upload pictures to wiki pages', 'registered', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_use_HTML', 'Can use HTML in pages', 'editors', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_use_content_templates', 'Can use content templates', 'registered', 'content templates');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_use_webmail', 'Can use webmail', 'registered', 'webmail');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_use_workflow', 'Can execute workflow activities', 'registered', 'workflow');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_userfiles', 'Can upload personal files', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_usermenu', 'Can create items in personal menu', 'registered', 'user');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_validate_links', 'Can validate submited links', 'editors', 'directory');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view', 'Can view page/pages', 'basic', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_calendar', 'Can browse the calendar', 'basic', 'calendar');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_categories', 'Can browse categories', 'basic', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_chart', 'Can view charts', 'basic', 'charts');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_directory', 'Can use the directory', 'basic', 'directory');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_eph', 'Can view ephemerides', 'registered', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_faqs', 'Can view faqs', 'basic', 'faqs');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_file_gallery', 'Can view file galleries', 'basic', 'file galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_html_pages', 'Can view HTML pages', 'basic', 'html pages');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_image_gallery', 'Can view image galleries', 'basic', 'image galleries');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_integrator', 'Can view integrated repositories', 'basic', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_quiz_stats', 'Can view quiz stats', 'basic', 'quizzes');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_referer_stats', 'Can view referer stats', 'editors', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_sheet', 'Can view sheet', 'basic', 'sheet');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_sheet_history', 'Can view sheet history', 'admin', 'sheet');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_shoutbox', 'Can view shoutbox', 'basic', 'shoutbox');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_stats', 'Can view site stats', 'basic', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_survey_stats', 'Can view survey stats', 'basic', 'surveys');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_templates', 'Can view site templates', 'admin', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_tiki_calendar', 'Can view Tikiwiki tools calendar', 'basic', 'calendar');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_trackers', 'Can view trackers', 'basic', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_list_trackers', 'Can list trackers', 'basic', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_trackers_closed', 'Can view trackers closed items', 'registered', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_trackers_pending', 'Can view trackers pending items', 'editors', 'trackers');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_view_user_results', 'Can view user quiz results', 'editors', 'quizzes');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_vote_chart', 'Can vote', 'basic', 'charts');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_vote_comments', 'Can vote comments', 'registered', 'comments');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_vote_poll', 'Can vote polls', 'basic', 'tiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_admin_attachments', 'Can admin attachments to wiki pages', 'editors', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_admin_ratings', 'Can add and change ratings on wiki pages', 'admin', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_attach_files', 'Can attach files to wiki pages', 'registered', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_view_attachments', 'Can view wiki attachments and download', 'registered', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_view_comments', 'Can view wiki comments', 'basic', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_view_history', 'Can view wiki history', 'basic', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_view_ratings', 'Can view rating of wiki pages', 'basic', 'wiki');

INSERT INTO "users_permissions" ("permName","permDesc","level","type") VALUES ('tiki_p_wiki_vote_ratings', 'Can participate to rating of wiki pages', 'registered', 'wiki');

-- --------------------------------------------------------
--
-- Table structure for table users_usergroups
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 12, 2003 at 09:31 PM
--
DROP TABLE "users_usergroups";

CREATE TABLE "users_usergroups" (
  "userId" number(8) default '0' NOT NULL,
  "groupName" varchar(255) default '' NOT NULL,
  PRIMARY KEY ("userId","groupName")
) ;

-- --------------------------------------------------------
INSERT INTO "users_groups" ("groupName","groupDesc") VALUES ('Anonymous','Public users not logged');

INSERT INTO "users_groups" ("groupName","groupDesc") VALUES ('Registered','Users logged into the system');

INSERT INTO "users_groups" ("groupName","groupDesc") VALUES ('Admins','Administrator and accounts managers.');

-- --------------------------------------------------------
--
-- Table structure for table users_users
--
-- Creation: Jul 03, 2003 at 07:42 PM
-- Last update: Jul 13, 2003 at 01:07 AM
--
DROP TABLE "users_users";

CREATE SEQUENCE "users_users_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "users_users" (
  "userId" number(8) NOT NULL,
  "email" varchar(200) default NULL,
  "login" varchar(40) default '' NOT NULL,
  "password" varchar(30) default '',
  "provpass" varchar(30) default NULL,
  "default_group" varchar(255),
  "lastLogin" number(14) default NULL,
  "currentLogin" number(14) default NULL,
  "registrationDate" number(14) default NULL,
  "challenge" varchar(32) default NULL,
  "pass_due" number(14) default NULL,
  "hash" varchar(32) default NULL,
  "created" number(14) default NULL,
  "avatarName" varchar(80) default NULL,
  "avatarSize" number(14) default NULL,
  "avatarFileType" varchar(250) default NULL,
  "avatarData" blob,
  "avatarLibName" varchar(200) default NULL,
  "avatarType" char(1) default NULL,
  "score" number(11) default 0 NOT NULL,
  "valid" varchar(32) default NULL,
  PRIMARY KEY ("userId")
)   ;

CREATE TRIGGER "users_users_trig" BEFORE INSERT ON "users_users" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "users_users_sequ".nextval into :NEW."userId" FROM DUAL;
END;
/
CREATE  INDEX "users_users_score" ON "users_users"("score");
CREATE  INDEX "users_users_login" ON "users_users"("login");
-- --------------------------------------------------------
------ Administrator account
INSERT INTO "users_users" ("email","login","password","hash") VALUES ('','admin','admin','f6fdffe48c908deb0f4c3bd36c032e72');

UPDATE "users_users" SET "currentLogin"="lastLogin" "registrationDate"="lastLogin";

INSERT INTO "tiki_user_preferences" ("user","prefName","value") VALUES ('admin','realName','System Administrator');

INSERT INTO users_usergroups (userId, groupName) VALUES(1,'Admins');

INSERT INTO "users_grouppermissions" ("groupName","permName") VALUES ('Admins','tiki_p_admin');

-- --------------------------------------------------------
-- please respect alpha order when you add new pref
INSERT INTO "tiki_preferences" ("name","value") VALUES ('allowRegister','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('anonCanEdit','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_author','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_date','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_expire','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_img','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_reads','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_size','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_title','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_topic','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_type','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('art_list_visible','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('article_comments_default_ordering','points_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('article_comments_per_page','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_create_user_auth','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_create_user_tiki','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_imap_pop3_basedsn','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_adminpass','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_adminuser','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_basedn','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_groupattr','cn');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_groupdn','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_groupoc','groupOfUniqueNames');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_memberattr','uniqueMember');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_memberisdn','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_scope','sub');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_url','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_userattr','uid');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_userdn','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_ldap_useroc','inetOrgPerson');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_method','tiki');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_pear_host','localhost');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_pear_port','389');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_skip_admin','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('auth_type','LDAP');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('available_languages','a:0:{}');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('available_styles','a:0:{}');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_comments_default_ordering','points_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_comments_per_page','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_activity','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_created','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_description','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_lastmodif','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_order','created_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_posts','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_title','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_user','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_list_visits','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('blog_spellcheck','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('cacheimages','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('cachepages','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('calendar_sticky_popup','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('calendar_view_tab','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('change_language','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('change_password','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('change_theme','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('cms_bot_bar','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('cms_left_column','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('cms_right_column','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('cms_spellcheck','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('cms_top_bar','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('contact_anon','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('contact_user','admin');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('count_admin_pvs','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('default_map','pacific.map');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('default_wiki_diff_style', 'minsidediff');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('direct_pagination','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('directory_columns','3');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('directory_cool_sites','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('directory_links_per_page','20');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('directory_open_links','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('directory_validate_urls','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('display_timezone','EST');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('eponymousGroups','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('faq_comments_default_ordering','points_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('faq_comments_per_page','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_article_comments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_articles','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_autolinks','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_babelfish','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_babelfish_logo','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_backlinks','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_banners','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_banning','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_blog_comments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_blog_rankings','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_blogposts_comments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_blogposts_pings','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_blogs','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_bot_bar','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_bot_bar_debug','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_bot_bar_icons','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_calendar','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_categories','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_categoryobjects','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_categorypath','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_challenge','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_charts','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_chat','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_clear_passwords','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_cms_print','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_cms_rankings','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_cms_templates','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_comm','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_contact','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_custom_home','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_debug_console','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_debugger_console','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_detect_language','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_directory','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_drawings','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_dump','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_dynamic_content','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_edit_templates','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_editcss','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_eph','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_faq_comments','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_faqs','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_featuredLinks','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_file_galleries','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_file_galleries_comments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_file_galleries_rankings','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_forum_parse','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_forum_quickjump','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_forum_rankings','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_forum_topicd','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_forums','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_friends','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_gal_batch','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_gal_imgcache','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_gal_rankings','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_gal_slideshow','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_galleries','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_galleries','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_games','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_help','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_history','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_hotwords','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_hotwords_nw','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_html_pages','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_image_galleries_comments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_integrator','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_jscalendar','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_lastChanges','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_left_column','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_likePages','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_listPages','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_live_support','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_maps','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_menusfolderstyle','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_messages','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_minical','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_mobile', 'n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_modulecontrols', 'n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_multilingual', 'n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_newsletters','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_newsreader','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_notepad','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_obzip','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_page_title','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_phplayers','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_poll_anonymous','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_poll_comments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_polls','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_quizzes','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_ranking','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_referer_stats','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_right_column','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_sandbox','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_score','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_search','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_search_fulltext','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_search_stats','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_sheet','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_shoutbox','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_smileys','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_stats','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_submissions','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_surveys','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_tabs','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_tasks','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_theme_control','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_ticketlib','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_ticketlib2','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_top_bar','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_trackbackpings','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_trackers','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_userPreferences','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_userVersions','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_user_bookmarks','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_user_watches','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_user_watches_translations','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_userfiles','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_usermenu','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_view_tpl','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_warn_on_edit','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_webmail','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_allowhtml','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_attachments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_comments','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_description','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_discuss','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_export','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_footnotes','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_import_html', 'n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_import_page', 'n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_monosp','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_multiprint','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_notepad','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_open_as_structure','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_pdf','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_pictures','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_rankings','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_ratings','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_tables','new');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_templates','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_undo','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_userpage','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_userpage_prefix','UserPage');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wiki_usrlock','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wikiwords','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_workflow','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_wysiwyg','no');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('feature_xmlrpc','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_allow_duplicates','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_list_created','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_list_description','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_list_files','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_list_hits','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_list_lastmodif','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_list_name','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_list_user','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_match_regex','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_nmatch_regex','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_use_db','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('fgal_use_dir','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('file_galleries_comments_default_ordering','points_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('file_galleries_comments_per_page','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forgotPass','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forum_list_desc','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forum_list_lastpost','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forum_list_posts','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forum_list_ppd','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forum_list_topics','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forum_list_visits','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('forums_ordering','created_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_batch_dir','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_imgcache_dir','temp/cache');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_list_created','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_list_description','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_list_imgs','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_list_lastmodif','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_list_name','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_list_user','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_list_visits','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_match_regex','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_nmatch_regex','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_use_db','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_use_dir','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('gal_use_lib','gd');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('groupTracker','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('home_file_gallery','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('http_domain','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('http_port','80');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('http_prefix','/');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('https','auto');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('https_domain','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('https_login','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('https_login_required','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('https_port','443');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('https_prefix','/');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('image_galleries_comments_default_order','points_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('image_galleries_comments_per_page','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('keep_versions','1');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('lang_use_db','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('language','en');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('layout_section','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('limitedGoGroupHome','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('long_date_format','%A %d of %B, %Y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('long_time_format','%H:%M:%S %Z');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('mail_crlf','LF');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('map_path','/var/www/html/map/');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('maxArticles','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('maxRecords','25');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('maxVersions','0');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_articles','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_blog','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_blogs','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_directories','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_file_galleries','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_file_gallery','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_forum','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_forums','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_image_galleries','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_image_gallery','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_mapfiles','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_tracker','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('max_rss_wiki','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('min_pass_length','1');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('modallgroups','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('pass_chr_num','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('pass_due','1999');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('poll_comments_default_ordering','points_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('poll_comments_per_page','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('popupLinks','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('proxy_host','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('proxy_port','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('record_untranslated','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('registerPasscode','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rememberme','disabled');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('remembertime','7200');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rnd_num_reg','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_articles','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_blog','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_blogs','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_directories','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_file_galleries','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_file_gallery','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_forum','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_forums','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_image_galleries','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_image_gallery','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_mapfiles','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_tracker','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rss_wiki','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rssfeed_creator','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rssfeed_css','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rssfeed_default_version','2');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rssfeed_editor','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rssfeed_language','en-us');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rssfeed_publisher','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('rssfeed_webmaster','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('search_lru_length','100');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('search_lru_purge_rate','5');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('search_max_syllwords','100');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('search_min_wordlength','3');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('search_refresh_rate','5');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('search_syll_age','48');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('sender_email','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('short_date_format','%a %d of %b, %Y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('short_time_format','%H:%M %Z');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('shoutbox_autolink','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('siteTitle','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('slide_style','slidestyle.css');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('style','tikineat.css');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('system_os','unix');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('t_use_db','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('t_use_dir','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('tikiIndex','tiki-index.php');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('tmpDir','temp');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('trk_with_mirror_tables', 'n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('uf_use_db','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('uf_use_dir','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('urlIndex','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('useRegisterPasscode','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('useUrlIndex','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('use_proxy','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('userTracker','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('user_assigned_modules','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('user_list_order','score_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('userfiles_quota','30');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('validateEmail','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('validateRegistration','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('validateUsers','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('w_use_db','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('w_use_dir','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('warn_on_edit_time','2');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('webmail_max_attachment','1500000');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('webmail_view_html','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('webserverauth','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wikiHomePage','HomePage');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wikiLicensePage','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wikiSubmitNotice','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_bot_bar','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_cache','0');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_comments_default_ordering','points_desc');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_comments_per_page','10');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_creator_admin','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_feature_copyrights','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_forum','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_forum_id','');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_left_column','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_backlinks','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_comment','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_creator','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_hits','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_lastmodif','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_lastver','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_links','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_name','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_size','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_status','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_user','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_list_versions','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_page_regex','strict');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_right_column','y');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_spellcheck','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_top_bar','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_uses_slides','n');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('wiki_wikisyntax_in_html','full');


-- default sizes for mailbox, read box and mail archive
-- in messages per user and box (0=unlimited)
INSERT INTO "tiki_preferences" ("name","value") VALUES ('messu_mailbox_size','0');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('messu_archive_size','200');

INSERT INTO "tiki_preferences" ("name","value") VALUES ('messu_sent_size','200');


-- Dynamic variables
--
-- Table structure for table 'tiki_integrator_reps'
--
DROP TABLE "tiki_integrator_reps";

CREATE SEQUENCE "tiki_integrator_reps_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_integrator_reps" (
  "repID" number(11) NOT NULL,
  "name" varchar(255) default '' NOT NULL,
  "path" varchar(255) default '' NOT NULL,
  "start_page" varchar(255) default '' NOT NULL,
  "css_file" varchar(255) default '' NOT NULL,
  "visibility" char(1) default 'y' NOT NULL,
  "cacheable" char(1) default 'y' NOT NULL,
  "expiration" number(11) default '0' NOT NULL,
  "description" clob NOT NULL,
  PRIMARY KEY ("repID")
) ;

CREATE TRIGGER "tiki_integrator_reps_trig" BEFORE INSERT ON "tiki_integrator_reps" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_integrator_reps_sequ".nextval into :NEW."repID" FROM DUAL;
END;
/

--
-- Dumping data for table 'tiki_integrator_reps'
--
INSERT INTO tiki_integrator_reps VALUES ('1','Doxygened (1.3.4) Documentation','','index.html','doxygen.css','n','y','0','Use this repository as rule source for all your repositories based on doxygened docs. To setup yours just add new repository and copy rules from this repository :)');


--
-- Table structure for table 'tiki_integrator_rules'
--
DROP TABLE "tiki_integrator_rules";

CREATE SEQUENCE "tiki_integrator_rules_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_integrator_rules" (
  "ruleID" number(11) NOT NULL,
  "repID" number(11) default '0' NOT NULL,
  "ord" number(2) default '0' NOT NULL,
  "srch" blob NOT NULL,
  "repl" blob NOT NULL,
  "type" char(1) default 'n' NOT NULL,
  "casesense" char(1) default 'y' NOT NULL,
  "rxmod" varchar(20) default '' NOT NULL,
  "enabled" char(1) default 'n' NOT NULL,
  "description" clob NOT NULL,
  PRIMARY KEY ("ruleID")
) ;

CREATE TRIGGER "tiki_integrator_rules_trig" BEFORE INSERT ON "tiki_integrator_rules" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_integrator_rules_sequ".nextval into :NEW."ruleID" FROM DUAL;
END;
/
CREATE  INDEX "tiki_integrator_rules_repID" ON "tiki_integrator_rules"("repID");

--
-- Dumping data for table 'tiki_integrator_rules'
--
INSERT INTO tiki_integrator_rules VALUES ('1','1','1','.*<body[^>]*?>(.*?)</body.*','\1','y','n','i','y','Extract code between <BODY> tags');

INSERT INTO tiki_integrator_rules VALUES ('2','1','2','img src=(\"|\')(?!http://)','img src=\1{path}/','y','n','i','y','Fix images path');

INSERT INTO tiki_integrator_rules VALUES ('3','1','3','href=(\"|\')(?!(--|(http|ftp)://))','href=\1tiki-integrator.php?repID={repID}&file=','y','n','i','y','Relace internal links to integrator. Dont touch an external links.');


--
-- Integrator permissions
--
--
-- Table structures for table 'tiki_quicktags'
-- 
DROP TABLE "tiki_quicktags";

CREATE SEQUENCE "tiki_quicktags_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_quicktags" (
  "tagId" number(4) NOT NULL,
  "taglabel" varchar(255) default NULL,
  "taginsert" clob,
  "tagicon" varchar(255) default NULL,
  "tagcategory" varchar(255) default NULL,
  PRIMARY KEY ("tagId")
)   ;

CREATE TRIGGER "tiki_quicktags_trig" BEFORE INSERT ON "tiki_quicktags" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_quicktags_sequ".nextval into :NEW."tagId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_quicktags_tagcategory" ON "tiki_quicktags"("tagcategory");
CREATE  INDEX "tiki_quicktags_taglabel" ON "tiki_quicktags"("taglabel");

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('bold','__text__','images/ed_format_bold.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('italic','\'\'text\'\'','images/ed_format_italic.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('underline','===text===','images/ed_format_underline.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('table','||r1c1|r1c2||r2c1|r2c2||','images/insert_table.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('table new','||r1c1|r1c2\nr2c1|r2c2||','images/insert_table.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('external link','[http://example.com|text]','images/ed_link.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('wiki link','((text))','images/ed_copy.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('heading1','!text','images/ed_custom.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('title bar','-=text=-','images/fullscreen_maximize.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('box','^text^','images/ed_about.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('rss feed','{rss id= }','images/ico_link.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('dynamic content','{content id= }','images/book.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('tagline','{cookie}','images/footprint.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('hr','---','images/ed_hr.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('center text','::text::','images/ed_align_center.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('colored text','~~--FF0000:text~~','images/fontfamily.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('dynamic variable','%text%','images/book.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('image','{img src= width= height= align= desc= link= }','images/ed_image.gif','wiki');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New wms Metadata','METADATA\r\n		\"wms_name\" \"myname\"\r\n 	"wms_srs" "EPSG:4326"\r\n 	"wms_server_version" " "\r\n 	"wms_layers" "mylayers"\r\n 	"wms_request" "myrequest"\r\n 	"wms_format" " "\r\n 	"wms_time" " "\r\n END', 'img/icons/admin_metatags.png','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Class', 'CLASS\r\n EXPRESSION ()\r\n SYMBOL 0\r\n OUTLINECOLOR\r\n COLOR\r\n NAME "myclass" \r\nEND --end of class', 'img/icons/mini_triangle.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Projection','PROJECTION\r\n "init=epsg:4326"\r\nEND','images/ico_mode.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Query','--\r\n-- Start of query definitions\r\n--\r\n QUERYMAP\r\n STATUS ON\r\n STYLE HILITE\r\nEND','img/icons/questions.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Scalebar','--\r\n-- Start of scalebar\r\n--\r\nSCALEBAR\r\n IMAGECOLOR 255 255 255\r\n STYLE 1\r\n SIZE 400 2\r\n COLOR 0 0 0\r\n UNITS KILOMETERS\r\n INTERVALS 5\r\n STATUS ON\r\nEND','img/icons/desc_length.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Layer','LAYER\r\n NAME\r\n TYPE\r\n STATUS ON\r\n DATA "mydata"\r\nEND --end of layer', 'images/ed_copy.gif', 'maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Label','LABEL\r\n COLOR\r\n ANGLE\r\n FONT arial\r\n TYPE TRUETYPE\r\n POSITION\r\n PARTIALS TRUE\r\n SIZE 6\r\n BUFFER 0\r\n OUTLINECOLOR \r\nEND --end of label', 'img/icons/fontfamily.gif', 'maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Reference','--\r\n--start of reference\r\n--\r\n REFERENCE\r\n SIZE 120 60\r\n STATUS ON\r\n EXTENT -180 -90 182 88\r\n OUTLINECOLOR 255 0 0\r\n IMAGE "myimagedata"\r\n COLOR -1 -1 -1\r\nEND','images/ed_image.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Legend','--\r\n--start of Legend\r\n--\r\n LEGEND\r\n KEYSIZE 18 12\r\n POSTLABELCACHE TRUE\r\n STATUS ON\r\nEND','images/ed_about.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Web','--\r\n-- Start of web interface definition\r\n--\r\nWEB\r\n TEMPLATE "myfile/url"\r\n MINSCALE 1000\r\n MAXSCALE 40000\r\n IMAGEPATH "myimagepath"\r\n IMAGEURL "mypath"\r\nEND','img/icons/ico_link.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Outputformat','OUTPUTFORMAT\r\n NAME\r\n DRIVER " "\r\n MIMETYPE "myimagetype"\r\n IMAGEMODE RGB\r\n EXTENSION "png"\r\nEND','img/icons/opera.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('New Mapfile','--\r\n-- Start of mapfile\r\n--\r\nNAME MYMAPFLE\r\n STATUS ON\r\nSIZE \r\nEXTENT\r\nUNITS \r\nSHAPEPATH " "\r\nIMAGETYPE " "\r\nFONTSET " "\r\nIMAGECOLOR -1 -1 -1\r\n\r\n--remove this text and add objects here\r\n\r\nEND -- end of mapfile','img/icons/global.gif','maps');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('bold', '__text__', 'images/ed_format_bold.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('italic', '\'\'text\'\'', 'images/ed_format_italic.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('underline', '===text===', 'images/ed_format_underline.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('external link', '[http://example.com|text|nocache]', 'images/ed_link.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('heading1', '!text', 'images/ed_custom.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('hr', '---', 'images/ed_hr.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('center text', '::text::', 'images/ed_align_center.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('colored text', '~~--FF0000:text~~', 'images/fontfamily.gif', 'newsletters');

INSERT INTO "tiki_quicktags" ("taglabel","taginsert","tagicon","tagcategory") VALUES ('image', '{img src= width= height= align= desc= link= }', 'images/ed_image.gif', 'newsletters');


--translated objects table
DROP TABLE "tiki_translated_objects";

CREATE SEQUENCE "tiki_translated_objects_sequ" INCREMENT BY 1 START WITH 1;
CREATE TABLE "tiki_translated_objects" (
  "traId" number(14) NOT NULL,
  "type" varchar(50) NOT NULL,
  "objId" varchar(255) NOT NULL,
  "lang" varchar(16) default NULL,
  PRIMARY KEY (type, objId)
)  ;

CREATE TRIGGER "tiki_translated_objects_trig" BEFORE INSERT ON "tiki_translated_objects" REFERENCING NEW AS NEW OLD AS OLD FOR EACH ROW
BEGIN
SELECT "tiki_translated_objects_sequ".nextval into :NEW."traId" FROM DUAL;
END;
/
CREATE  INDEX "tiki_translated_objects_traId" ON "tiki_translated_objects"( "traId" );

--
-- Community tables begin
--
DROP TABLE "tiki_friends";

CREATE TABLE "tiki_friends" (
  "user" char(40) default '' NOT NULL,
  "friend" char(40) default '' NOT NULL,
  PRIMARY KEY ("user","friend")
) ;


DROP TABLE "tiki_friendship_requests";

CREATE TABLE "tiki_friendship_requests" (
  "userFrom" char(40) default '' NOT NULL,
  "userTo" char(40) default '' NOT NULL,
  "tstamp" timestamp(3) NOT NULL,
  PRIMARY KEY ("userFrom","userTo")
) ;


DROP TABLE "tiki_score";

CREATE TABLE "tiki_score" (
  "event" varchar(40) default '' NOT NULL,
  "score" number(11) default '0' NOT NULL,
  "expiration" number(11) default '0' NOT NULL,
  PRIMARY KEY ("event")
) ;


INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('login',1,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('login_remain',2,60);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('profile_fill',10,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('profile_see',2,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('profile_is_seen',1,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('friend_new',10,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('message_receive',1,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('message_send',2,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('article_read',2,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('article_comment',5,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('article_new',20,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('article_is_read',1,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('article_is_commented',2,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('fgallery_new',10,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('fgallery_new_file',10,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('fgallery_download',5,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('fgallery_is_downloaded',5,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('igallery_new',10,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('igallery_new_img',6,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('igallery_see_img',3,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('igallery_img_seen',1,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('blog_new',20,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('blog_post',5,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('blog_read',2,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('blog_comment',2,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('blog_is_read',3,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('blog_is_commented',3,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('wiki_new',10,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('wiki_edit',5,0);

INSERT INTO "tiki_score" ("event","score","expiration") VALUES ('wiki_attach_file',3,0);


DROP TABLE "tiki_users_score";

CREATE TABLE "tiki_users_score" (
  "user" char(40) default '' NOT NULL,
  "event_id" char(40) default '' NOT NULL,
  "expire" number(14) default '0' NOT NULL,
  "tstamp" timestamp(3) NOT NULL,
  PRIMARY KEY ("user","event_id")
) ;

CREATE  INDEX "tiki_users_score_user" ON "tiki_users_score"("user","event_id","expire");

--
-- Community tables end
--
--
-- Table structure for table tiki_file_handlers
--
-- Creation: Nov 02, 2004 at 05:59 PM
-- Last update: Nov 02, 2004 at 05:59 PM
--
DROP TABLE "tiki_file_handlers";

CREATE TABLE "tiki_file_handlers" (
  "mime_type" varchar(64) default NULL,
  "cmd" varchar(238) default NULL
) ;


--
-- Table structure for table tiki_stats
--
-- Creation: Aug 04, 2005 at 05:59 PM
-- Last update: Aug 04, 2005 at 05:59 PM
--
DROP TABLE `tiki_stats`;

CREATE TABLE `tiki_stats` (
  `object` varchar(255) default '' NOT NULL,
  `type` varchar(20) default '' NOT NULL,
  `day` number(14) default '0' NOT NULL,
  `hits` number(14) default '0' NOT NULL,
  PRIMARY KEY ("`object`","`type`","`day`")
) ;


-- --------------------------------------------------------
;

