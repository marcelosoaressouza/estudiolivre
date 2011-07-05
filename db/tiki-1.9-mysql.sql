# $Rev$
# $Date: 2008/02/21 19:52:41 $
# $Author: lphuberdeau $
# $Name: REL-1-9-10-1 $
# phpMyAdmin MySQL-Dump
# version 2.5.1
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Jul 13, 2003 at 02:09 AM
# Server version: 4.0.13
# PHP Version: 4.2.3
# Database : tikiwiki
# --------------------------------------------------------

#
# Table structure for table galaxia_activities
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_activities;
CREATE TABLE galaxia_activities (
  activityId int(14) NOT NULL auto_increment,
  name varchar(80) default NULL,
  normalized_name varchar(80) default NULL,
  pId int(14) NOT NULL default '0',
  type enum('start','end','split','switch','join','activity','standalone') default NULL,
  isAutoRouted char(1) default NULL,
  flowNum int(10) default NULL,
  isInteractive char(1) default NULL,
  lastModif int(14) default NULL,
  description text,
  expirationTime int(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (activityId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table galaxia_activity_roles
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_activity_roles;
CREATE TABLE galaxia_activity_roles (
  activityId int(14) NOT NULL default '0',
  roleId int(14) NOT NULL default '0',
  PRIMARY KEY  (activityId,roleId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table galaxia_instance_activities
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_instance_activities;
CREATE TABLE galaxia_instance_activities (
  instanceId int(14) NOT NULL default '0',
  activityId int(14) NOT NULL default '0',
  started int(14) NOT NULL default '0',
  ended int(14) NOT NULL default '0',
  user varchar(40) default NULL,
  status enum('running','completed') default NULL,
  PRIMARY KEY  (instanceId,activityId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table galaxia_instance_comments
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_instance_comments;
CREATE TABLE galaxia_instance_comments (
  cId int(14) NOT NULL auto_increment,
  instanceId int(14) NOT NULL default '0',
  user varchar(40) default NULL,
  activityId int(14) default NULL,
  hash varchar(32) default NULL,
  title varchar(250) default NULL,
  comment text,
  activity varchar(80) default NULL,
  timestamp int(14) default NULL,
  PRIMARY KEY  (cId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table galaxia_instances
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_instances;
CREATE TABLE galaxia_instances (
  instanceId int(14) NOT NULL auto_increment,
  pId int(14) NOT NULL default '0',
  started int(14) default NULL,
  name varchar(200) NOT NULL default 'No Name',
  owner varchar(200) default NULL,
  nextActivity int(14) default NULL,
  nextUser varchar(200) default NULL,
  ended int(14) default NULL,
  status enum('active','exception','aborted','completed') default NULL,
  properties longblob,
  PRIMARY KEY  (instanceId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table galaxia_processes
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_processes;
CREATE TABLE galaxia_processes (
  pId int(14) NOT NULL auto_increment,
  name varchar(80) default NULL,
  isValid char(1) default NULL,
  isActive char(1) default NULL,
  version varchar(12) default NULL,
  description text,
  lastModif int(14) default NULL,
  normalized_name varchar(80) default NULL,
  PRIMARY KEY  (pId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table galaxia_roles
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_roles;
CREATE TABLE galaxia_roles (
  roleId int(14) NOT NULL auto_increment,
  pId int(14) NOT NULL default '0',
  lastModif int(14) default NULL,
  name varchar(80) default NULL,
  description text,
  PRIMARY KEY  (roleId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table galaxia_transitions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_transitions;
CREATE TABLE galaxia_transitions (
  pId int(14) NOT NULL default '0',
  actFromId int(14) NOT NULL default '0',
  actToId int(14) NOT NULL default '0',
  PRIMARY KEY  (actFromId,actToId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table galaxia_user_roles
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_user_roles;
CREATE TABLE galaxia_user_roles (
  pId int(14) NOT NULL default '0',
  roleId int(14) NOT NULL auto_increment,
  user varchar(40) NOT NULL default '',
  PRIMARY KEY  (roleId,user)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table galaxia_workitems
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS galaxia_workitems;
CREATE TABLE galaxia_workitems (
  itemId int(14) NOT NULL auto_increment,
  instanceId int(14) NOT NULL default '0',
  orderId int(14) NOT NULL default '0',
  activityId int(14) NOT NULL default '0',
  properties longblob,
  started int(14) default NULL,
  ended int(14) default NULL,
  user varchar(40) default NULL,
  PRIMARY KEY  (itemId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table messu_messages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:29 PM
#

DROP TABLE IF EXISTS messu_messages;
CREATE TABLE messu_messages (
  msgId int(14) NOT NULL auto_increment,
  user varchar(40) NOT NULL default '',
  user_from varchar(200) NOT NULL default '',
  user_to text,
  user_cc text,
  user_bcc text,
  subject varchar(255) default NULL,
  body text,
  hash varchar(32) default NULL,
  replyto_hash varchar(32) default NULL,
  date int(14) default NULL,
  isRead char(1) default NULL,
  isReplied char(1) default NULL,
  isFlagged char(1) default NULL,
  priority int(2) default NULL,
  PRIMARY KEY  (msgId),
  KEY userIsRead (user, isRead)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table messu_archive (same structure as messu_messages)
# desc: user may archive his messages to this table to speed up default msg handling
#
# Creation: Feb 26, 2005 at 03:00 PM
# Last update: Feb 26, 2005 at 03:00 PM
#

DROP TABLE IF EXISTS messu_archive;
CREATE TABLE messu_archive (
  msgId int(14) NOT NULL auto_increment,
  user varchar(40) NOT NULL default '',
  user_from varchar(40) NOT NULL default '',
  user_to text,
  user_cc text,
  user_bcc text,
  subject varchar(255) default NULL,
  body text,
  hash varchar(32) default NULL,
  replyto_hash varchar(32) default NULL,
  date int(14) default NULL,
  isRead char(1) default NULL,
  isReplied char(1) default NULL,
  isFlagged char(1) default NULL,
  priority int(2) default NULL,
  PRIMARY KEY  (msgId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table messu_sent (same structure as messu_messages)
# desc: user may archive his messages to this table to speed up default msg handling
#
# Creation: Feb 26, 2005 at 11:00 PM
# Last update: Feb 26, 2005 at 11:00 PM
#

DROP TABLE IF EXISTS messu_sent;
CREATE TABLE messu_sent (
  msgId int(14) NOT NULL auto_increment,
  user varchar(40) NOT NULL default '',
  user_from varchar(40) NOT NULL default '',
  user_to text,
  user_cc text,
  user_bcc text,
  subject varchar(255) default NULL,
  body text,
  hash varchar(32) default NULL,
  replyto_hash varchar(32) default NULL,
  date int(14) default NULL,
  isRead char(1) default NULL,
  isReplied char(1) default NULL,
  isFlagged char(1) default NULL,
  priority int(2) default NULL,
  PRIMARY KEY  (msgId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions(
  sesskey char(32) NOT NULL,
  expiry int(11) unsigned NOT NULL,
  expireref varchar(64),
  data text NOT NULL,
  PRIMARY KEY  (sesskey),
  KEY expiry (expiry)
) TYPE=MyISAM;

#
# Table structure for table tiki_actionlog
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 12:29 AM
#

DROP TABLE IF EXISTS tiki_actionlog;
CREATE TABLE tiki_actionlog (
  action varchar(255) NOT NULL default '',
  lastModif int(14) default NULL,
  pageName varchar(200) default NULL,
  user varchar(40) default NULL,
  ip varchar(15) default NULL,
  comment varchar(200) default NULL
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_articles
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:30 AM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_articles;
CREATE TABLE tiki_articles (
  articleId int(8) NOT NULL auto_increment,
  topline varchar(255) default NULL,
  title varchar(80) default NULL,
  subtitle varchar(255) default NULL,
  linkto varchar(255) default NULL,
  lang varchar(16) default NULL,
  state char(1) default 's',
  authorName varchar(60) default NULL,
  topicId int(14) default NULL,
  topicName varchar(40) default NULL,
  size int(12) default NULL,
  useImage char(1) default NULL,
  image_name varchar(80) default NULL,
  image_caption text default NULL,
  image_type varchar(80) default NULL,
  image_size int(14) default NULL,
  image_x int(4) default NULL,
  image_y int(4) default NULL,
  image_data longblob,
  publishDate int(14) default NULL,
  expireDate int(14) default NULL,
  created int(14) default NULL,
  heading text,
  body text,
  hash varchar(32) default NULL,
  author varchar(200) default NULL,
  nbreads int(14) default NULL,
  votes int(8) default NULL,
  points int(14) default NULL,
  type varchar(50) default NULL,
  rating decimal(3,2) default NULL,
  isfloat char(1) default NULL,
  PRIMARY KEY  (articleId),
  KEY title (title),
  KEY heading (heading(255)),
  KEY body (body(255)),
  KEY nbreads (nbreads),
  KEY author (author(32)),
  KEY topicId (topicId),
  KEY publishDate (publishDate),
  KEY expireDate (expireDate),
  KEY type (type),
  FULLTEXT KEY ft (title,heading,body)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

DROP TABLE IF EXISTS tiki_article_types;
CREATE TABLE tiki_article_types (
  type varchar(50) NOT NULL,
  use_ratings varchar(1) default NULL,
  show_pre_publ varchar(1) default NULL,
  show_post_expire varchar(1) default 'y',
  heading_only varchar(1) default NULL,
  allow_comments varchar(1) default 'y',
  show_image varchar(1) default 'y',
  show_avatar varchar(1) default NULL,
  show_author varchar(1) default 'y',
  show_pubdate varchar(1) default 'y',
  show_expdate varchar(1) default NULL,
  show_reads varchar(1) default 'y',
  show_size char(1) default 'n',
  show_topline char(1) default 'n',
  show_subtitle char(1) default 'n',
  show_linkto char(1) default 'n',
  show_image_caption char(1) default 'n',
  show_lang char(1) default 'n',
  creator_edit varchar(1) default NULL,
  comment_can_rate_article char(1) default NULL,
  PRIMARY KEY  (type),
  KEY show_pre_publ (show_pre_publ),
  KEY show_post_expire (show_post_expire)
) TYPE=MyISAM ;

INSERT IGNORE INTO tiki_article_types(type) VALUES ('Article');
INSERT IGNORE INTO tiki_article_types(type,use_ratings) VALUES ('Review','y');
INSERT IGNORE INTO tiki_article_types(type,show_post_expire) VALUES ('Event','n');
INSERT IGNORE INTO tiki_article_types(type,show_post_expire,heading_only,allow_comments) VALUES ('Classified','n','y','n');

#
# Table structure for table tiki_banners
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_banners;
CREATE TABLE tiki_banners (
  bannerId int(12) NOT NULL auto_increment,
  client varchar(200) NOT NULL default '',
  url varchar(255) default NULL,
  title varchar(255) default NULL,
  alt varchar(250) default NULL,
  which varchar(50) default NULL,
  imageData longblob,
  imageType varchar(200) default NULL,
  imageName varchar(100) default NULL,
  HTMLData text,
  fixedURLData varchar(255) default NULL,
  textData text,
  fromDate int(14) default NULL,
  toDate int(14) default NULL,
  useDates char(1) default NULL,
  mon char(1) default NULL,
  tue char(1) default NULL,
  wed char(1) default NULL,
  thu char(1) default NULL,
  fri char(1) default NULL,
  sat char(1) default NULL,
  sun char(1) default NULL,
  hourFrom varchar(4) default NULL,
  hourTo varchar(4) default NULL,
  created int(14) default NULL,
  maxImpressions int(8) default NULL,
  impressions int(8) default NULL,
  clicks int(8) default NULL,
  zone varchar(40) default NULL,
  PRIMARY KEY  (bannerId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_banning
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_banning;
CREATE TABLE tiki_banning (
  banId int(12) NOT NULL auto_increment,
  mode enum('user','ip') default NULL,
  title varchar(200) default NULL,
  ip1 char(3) default NULL,
  ip2 char(3) default NULL,
  ip3 char(3) default NULL,
  ip4 char(3) default NULL,
  user varchar(40) default NULL,
  date_from timestamp(14) NOT NULL,
  date_to timestamp(14) NOT NULL,
  use_dates char(1) default NULL,
  created int(14) default NULL,
  message text,
  PRIMARY KEY  (banId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_banning_sections
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_banning_sections;
CREATE TABLE tiki_banning_sections (
  banId int(12) NOT NULL default '0',
  section varchar(100) NOT NULL default '',
  PRIMARY KEY  (banId,section)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_blog_activity
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 04:52 PM
#

DROP TABLE IF EXISTS tiki_blog_activity;
CREATE TABLE tiki_blog_activity (
  blogId int(8) NOT NULL default '0',
  day int(14) NOT NULL default '0',
  posts int(8) default NULL,
  PRIMARY KEY  (blogId,day)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_blog_posts
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 04:52 PM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_blog_posts;
CREATE TABLE tiki_blog_posts (
  postId int(8) NOT NULL auto_increment,
  blogId int(8) NOT NULL default '0',
  data text,
  data_size int(11) unsigned NOT NULL default '0',
  created int(14) default NULL,
  user varchar(40) default NULL,
  trackbacks_to text,
  trackbacks_from text,
  title varchar(80) default NULL,
  priv varchar(1) default NULL,
  PRIMARY KEY  (postId),
  KEY data (data(255)),
  KEY blogId (blogId),
  KEY created (created),
  FULLTEXT KEY ft (data,title)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_blog_posts_images
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_blog_posts_images;
CREATE TABLE tiki_blog_posts_images (
  imgId int(14) NOT NULL auto_increment,
  postId int(14) NOT NULL default '0',
  filename varchar(80) default NULL,
  filetype varchar(80) default NULL,
  filesize int(14) default NULL,
  data longblob,
  PRIMARY KEY  (imgId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_blogs
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:07 AM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_blogs;
CREATE TABLE tiki_blogs (
  blogId int(8) NOT NULL auto_increment,
  created int(14) default NULL,
  lastModif int(14) default NULL,
  title varchar(200) default NULL,
  description text,
  user varchar(40) default NULL,
  public char(1) default NULL,
  posts int(8) default NULL,
  maxPosts int(8) default NULL,
  hits int(8) default NULL,
  activity decimal(4,2) default NULL,
  heading text,
  use_find char(1) default NULL,
  use_title char(1) default NULL,
  add_date char(1) default NULL,
  add_poster char(1) default NULL,
  allow_comments char(1) default NULL,
  show_avatar char(1) default NULL,
  PRIMARY KEY  (blogId),
  KEY title (title),
  KEY description (description(255)),
  KEY hits (hits),
  FULLTEXT KEY ft (title,description)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_calendar_categories
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:05 AM
#

DROP TABLE IF EXISTS tiki_calendar_categories;
CREATE TABLE tiki_calendar_categories (
  calcatId int(11) NOT NULL auto_increment,
  calendarId int(14) NOT NULL default '0',
  name varchar(255) NOT NULL default '',
  PRIMARY KEY  (calcatId),
  UNIQUE KEY catname (calendarId,name(16))
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_calendar_items
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:43 AM
#

DROP TABLE IF EXISTS tiki_calendar_items;
CREATE TABLE tiki_calendar_items (
  calitemId int(14) NOT NULL auto_increment,
  calendarId int(14) NOT NULL default '0',
  start int(14) NOT NULL default '0',
  end int(14) NOT NULL default '0',
  locationId int(14) default NULL,
  categoryId int(14) default NULL,
  nlId int(12) NOT NULL default '0',
  priority enum('1','2','3','4','5','6','7','8','9') NOT NULL default '1',
  status enum('0','1','2') NOT NULL default '0',
  url varchar(255) default NULL,
  lang char(16) NOT NULL default 'en',
  name varchar(255) NOT NULL default '',
  description blob,
  user varchar(40) default NULL,
  created int(14) NOT NULL default '0',
  lastmodif int(14) NOT NULL default '0',
  PRIMARY KEY  (calitemId),
  KEY calendarId (calendarId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_calendar_locations
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:05 AM
#

DROP TABLE IF EXISTS tiki_calendar_locations;
CREATE TABLE tiki_calendar_locations (
  callocId int(14) NOT NULL auto_increment,
  calendarId int(14) NOT NULL default '0',
  name varchar(255) NOT NULL default '',
  description blob,
  PRIMARY KEY  (callocId),
  UNIQUE KEY locname (calendarId,name(16))
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_calendar_roles
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_calendar_roles;
CREATE TABLE tiki_calendar_roles (
  calitemId int(14) NOT NULL default '0',
  username varchar(40) NOT NULL default '',
  role enum('0','1','2','3','6') NOT NULL default '0',
  PRIMARY KEY  (calitemId,username(16),role)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_calendars
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 05, 2003 at 02:03 PM
#

DROP TABLE IF EXISTS tiki_calendars;
CREATE TABLE tiki_calendars (
  calendarId int(14) NOT NULL auto_increment,
  name varchar(80) NOT NULL default '',
  description varchar(255) default NULL,
  user varchar(40) NOT NULL default '',
  customlocations enum('n','y') NOT NULL default 'n',
  customcategories enum('n','y') NOT NULL default 'n',
  customlanguages enum('n','y') NOT NULL default 'n',
  custompriorities enum('n','y') NOT NULL default 'n',
  customparticipants enum('n','y') NOT NULL default 'n',
  customsubscription enum('n','y') NOT NULL default 'n',
  created int(14) NOT NULL default '0',
  lastmodif int(14) NOT NULL default '0',
  personal enum ('n', 'y') NOT NULL default 'n',
  PRIMARY KEY  (calendarId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_categories
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 04, 2003 at 09:47 PM
#

DROP TABLE IF EXISTS tiki_categories;
CREATE TABLE tiki_categories (
  categId int(12) NOT NULL auto_increment,
  name varchar(100) default NULL,
  description varchar(250) default NULL,
  parentId int(12) default NULL,
  hits int(8) default NULL,
  PRIMARY KEY  (categId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_categorized_objects
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:09 AM
#

DROP TABLE IF EXISTS tiki_categorized_objects;
CREATE TABLE tiki_categorized_objects (
  catObjectId int(12) NOT NULL auto_increment,
  type varchar(50) default NULL,
  objId varchar(255) default NULL,
  description text,
  created int(14) default NULL,
  name varchar(200) default NULL,
  href varchar(200) default NULL,
  hits int(8) default NULL,
  PRIMARY KEY  (catObjectId),
  KEY(type, objId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_category_objects
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:09 AM
#

DROP TABLE IF EXISTS tiki_category_objects;
CREATE TABLE tiki_category_objects (
  catObjectId int(12) NOT NULL default '0',
  categId int(12) NOT NULL default '0',
  PRIMARY KEY  (catObjectId,categId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_category_sites
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 07, 2003 at 01:53 AM
#

DROP TABLE IF EXISTS tiki_object_ratings;
CREATE TABLE tiki_object_ratings (
  catObjectId int(12) NOT NULL default '0',
  pollId int(12) NOT NULL default '0',
  PRIMARY KEY  (catObjectId,pollId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_category_sites
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 07, 2003 at 01:53 AM
#

DROP TABLE IF EXISTS tiki_category_sites;
CREATE TABLE tiki_category_sites (
  categId int(10) NOT NULL default '0',
  siteId int(14) NOT NULL default '0',
  PRIMARY KEY  (categId,siteId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_chart_items
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_chart_items;
CREATE TABLE tiki_chart_items (
  itemId int(14) NOT NULL auto_increment,
  title varchar(250) default NULL,
  description text,
  chartId int(14) NOT NULL default '0',
  created int(14) default NULL,
  URL varchar(250) default NULL,
  votes int(14) default NULL,
  points int(14) default NULL,
  average decimal(4,2) default NULL,
  PRIMARY KEY  (itemId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_charts
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 06, 2003 at 08:14 AM
#

DROP TABLE IF EXISTS tiki_charts;
CREATE TABLE tiki_charts (
  chartId int(14) NOT NULL auto_increment,
  title varchar(250) default NULL,
  description text,
  hits int(14) default NULL,
  singleItemVotes char(1) default NULL,
  singleChartVotes char(1) default NULL,
  suggestions char(1) default NULL,
  autoValidate char(1) default NULL,
  topN int(6) default NULL,
  maxVoteValue int(4) default NULL,
  frequency int(14) default NULL,
  showAverage char(1) default NULL,
  isActive char(1) default NULL,
  showVotes char(1) default NULL,
  useCookies char(1) default NULL,
  lastChart int(14) default NULL,
  voteAgainAfter int(14) default NULL,
  created int(14) default NULL,
  PRIMARY KEY  (chartId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_charts_rankings
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_charts_rankings;
CREATE TABLE tiki_charts_rankings (
  chartId int(14) NOT NULL default '0',
  itemId int(14) NOT NULL default '0',
  position int(14) NOT NULL default '0',
  timestamp int(14) NOT NULL default '0',
  lastPosition int(14) NOT NULL default '0',
  period int(14) NOT NULL default '0',
  rvotes int(14) NOT NULL default '0',
  raverage decimal(4,2) NOT NULL default '0.00',
  PRIMARY KEY  (chartId,itemId,period)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_charts_votes
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_charts_votes;
CREATE TABLE tiki_charts_votes (
  user varchar(40) NOT NULL default '',
  itemId int(14) NOT NULL default '0',
  timestamp int(14) default NULL,
  chartId int(14) default NULL,
  PRIMARY KEY  (user,itemId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_chat_channels
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_chat_channels;
CREATE TABLE tiki_chat_channels (
  channelId int(8) NOT NULL auto_increment,
  name varchar(30) default NULL,
  description varchar(250) default NULL,
  max_users int(8) default NULL,
  mode char(1) default NULL,
  moderator varchar(200) default NULL,
  active char(1) default NULL,
  refresh int(6) default NULL,
  PRIMARY KEY  (channelId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_chat_messages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_chat_messages;
CREATE TABLE tiki_chat_messages (
  messageId int(8) NOT NULL auto_increment,
  channelId int(8) NOT NULL default '0',
  data varchar(255) default NULL,
  poster varchar(200) NOT NULL default 'anonymous',
  timestamp int(14) default NULL,
  PRIMARY KEY  (messageId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_chat_users
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_chat_users;
CREATE TABLE tiki_chat_users (
  nickname varchar(200) NOT NULL default '',
  channelId int(8) NOT NULL default '0',
  timestamp int(14) default NULL,
  PRIMARY KEY  (nickname,channelId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_comments
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 10:56 PM
# Last check: Jul 11, 2003 at 01:52 AM
#

DROP TABLE IF EXISTS tiki_comments;
CREATE TABLE tiki_comments (
  threadId int(14) NOT NULL auto_increment,
  object varchar(255) NOT NULL default '',
  objectType varchar(32) NOT NULL default '',
  parentId int(14) default NULL,
  userName varchar(40) default NULL,
  commentDate int(14) default NULL,
  hits int(8) default NULL,
  type char(1) default NULL,
  points decimal(8,2) default NULL,
  votes int(8) default NULL,
  average decimal(8,4) default NULL,
  title varchar(100) default NULL,
  data text,
  hash varchar(32) default NULL,
  user_ip varchar(15) default NULL,
  summary varchar(240) default NULL,
  smiley varchar(80) default NULL,
  message_id varchar(250) default NULL,
  in_reply_to varchar(250) default NULL,
  comment_rating tinyint(2) default NULL,  
  PRIMARY KEY  (threadId),
  KEY title (title),
  KEY data (data(255)),
  KEY hits (hits),
  KEY tc_pi (parentId),
  KEY objectType (object, objectType),
  KEY commentDate (commentDate),
  FULLTEXT KEY ft (title,data)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_content
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_content;
CREATE TABLE tiki_content (
  contentId int(8) NOT NULL auto_increment,
  description text,
  PRIMARY KEY  (contentId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_content_templates
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 12:37 AM
#

DROP TABLE IF EXISTS tiki_content_templates;
CREATE TABLE tiki_content_templates (
  templateId int(10) NOT NULL auto_increment,
  content longblob,
  name varchar(200) default NULL,
  created int(14) default NULL,
  PRIMARY KEY  (templateId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_content_templates_sections
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 12:37 AM
#

DROP TABLE IF EXISTS tiki_content_templates_sections;
CREATE TABLE tiki_content_templates_sections (
  templateId int(10) NOT NULL default '0',
  section varchar(250) NOT NULL default '',
  PRIMARY KEY  (templateId,section)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_cookies
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 10, 2003 at 04:00 AM
#

DROP TABLE IF EXISTS tiki_cookies;
CREATE TABLE tiki_cookies (
  cookieId int(10) NOT NULL auto_increment,
  cookie text,
  PRIMARY KEY  (cookieId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_copyrights
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_copyrights;
CREATE TABLE tiki_copyrights (
  copyrightId int(12) NOT NULL auto_increment,
  page varchar(200) default NULL,
  title varchar(200) default NULL,
  year int(11) default NULL,
  authors varchar(200) default NULL,
  copyright_order int(11) default NULL,
  userName varchar(40) default NULL,
  PRIMARY KEY  (copyrightId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_directory_categories
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:59 PM
#

DROP TABLE IF EXISTS tiki_directory_categories;
CREATE TABLE tiki_directory_categories (
  categId int(10) NOT NULL auto_increment,
  parent int(10) default NULL,
  name varchar(240) default NULL,
  description text,
  childrenType char(1) default NULL,
  sites int(10) default NULL,
  viewableChildren int(4) default NULL,
  allowSites char(1) default NULL,
  showCount char(1) default NULL,
  editorGroup varchar(200) default NULL,
  hits int(12) default NULL,
  PRIMARY KEY  (categId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_directory_search
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_directory_search;
CREATE TABLE tiki_directory_search (
  term varchar(250) NOT NULL default '',
  hits int(14) default NULL,
  PRIMARY KEY  (term)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_directory_sites
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:32 PM
#

DROP TABLE IF EXISTS tiki_directory_sites;
CREATE TABLE tiki_directory_sites (
  siteId int(14) NOT NULL auto_increment,
  name varchar(240) default NULL,
  description text,
  url varchar(255) default NULL,
  country varchar(255) default NULL,
  hits int(12) default NULL,
  isValid char(1) default NULL,
  created int(14) default NULL,
  lastModif int(14) default NULL,
  cache longblob,
  cache_timestamp int(14) default NULL,
  PRIMARY KEY  (siteId),
  FULLTEXT KEY ft (name,description)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_drawings
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 08, 2003 at 05:02 AM
#

DROP TABLE IF EXISTS tiki_drawings;
CREATE TABLE tiki_drawings (
  drawId int(12) NOT NULL auto_increment,
  version int(8) default NULL,
  name varchar(250) default NULL,
  filename_draw varchar(250) default NULL,
  filename_pad varchar(250) default NULL,
  timestamp int(14) default NULL,
  user varchar(40) default NULL,
  PRIMARY KEY  (drawId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_dsn
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_dsn;
CREATE TABLE tiki_dsn (
  dsnId int(12) NOT NULL auto_increment,
  name varchar(200) NOT NULL default '',
  dsn varchar(255) default NULL,
  PRIMARY KEY  (dsnId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------


DROP TABLE IF EXISTS tiki_dynamic_variables;
CREATE TABLE tiki_dynamic_variables (
  name varchar(40) NOT NULL,
  data text,
  PRIMARY KEY  (name)
);

#
# Table structure for table tiki_eph
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 06, 2003 at 08:23 AM
#

DROP TABLE IF EXISTS tiki_eph;
CREATE TABLE tiki_eph (
  ephId int(12) NOT NULL auto_increment,
  title varchar(250) default NULL,
  isFile char(1) default NULL,
  filename varchar(250) default NULL,
  filetype varchar(250) default NULL,
  filesize varchar(250) default NULL,
  data longblob,
  textdata longblob,
  publish int(14) default NULL,
  hits int(10) default NULL,
  PRIMARY KEY  (ephId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_extwiki
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_extwiki;
CREATE TABLE tiki_extwiki (
  extwikiId int(12) NOT NULL auto_increment,
  name varchar(200) NOT NULL default '',
  extwiki varchar(255) default NULL,
  PRIMARY KEY  (extwikiId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_faq_questions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_faq_questions;
CREATE TABLE tiki_faq_questions (
  questionId int(10) NOT NULL auto_increment,
  faqId int(10) default NULL,
  position int(4) default NULL,
  question text,
  answer text,
  PRIMARY KEY  (questionId),
  KEY faqId (faqId),
  KEY question (question(255)),
  KEY answer (answer(255)),
  FULLTEXT KEY ft (question,answer)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_faqs
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 09:09 PM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_faqs;
CREATE TABLE tiki_faqs (
  faqId int(10) NOT NULL auto_increment,
  title varchar(200) default NULL,
  description text,
  created int(14) default NULL,
  questions int(5) default NULL,
  hits int(8) default NULL,
  canSuggest char(1) default NULL,
  PRIMARY KEY  (faqId),
  KEY title (title),
  KEY description (description(255)),
  KEY hits (hits),
  FULLTEXT KEY ft (title,description)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_featured_links
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 11:08 PM
#

DROP TABLE IF EXISTS tiki_featured_links;
CREATE TABLE tiki_featured_links (
  url varchar(200) NOT NULL default '',
  title varchar(200) default NULL,
  description text,
  hits int(8) default NULL,
  position int(6) default NULL,
  type char(1) default NULL,
  PRIMARY KEY  (url)
) TYPE=MyISAM;
# --------------------------------------------------------
# Table structure for table tiki_file_galleries
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:13 AM
#

DROP TABLE IF EXISTS tiki_file_galleries;
CREATE TABLE tiki_file_galleries (
  galleryId int(14) NOT NULL auto_increment,
  name varchar(80) NOT NULL default '',
  description text,
  created int(14) default NULL,
  visible char(1) default NULL,
  lastModif int(14) default NULL,
  user varchar(40) default NULL,
  hits int(14) default NULL,
  votes int(8) default NULL,
  points decimal(8,2) default NULL,
  maxRows int(10) default NULL,
  public char(1) default NULL,
  show_id char(1) default NULL,
  show_icon char(1) default NULL,
  show_name char(1) default NULL,
  show_size char(1) default NULL,
  show_description char(1) default NULL,
  max_desc int(8) default NULL,
  show_created char(1) default NULL,
  show_dl char(1) default NULL,
  PRIMARY KEY  (galleryId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_files
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Nov 02, 2004 at 05:59 PM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_files;
CREATE TABLE tiki_files (
  fileId int(14) NOT NULL auto_increment,
  galleryId int(14) NOT NULL default '0',
  name varchar(200) NOT NULL default '',
  description text,
  created int(14) default NULL,
  filename varchar(80) default NULL,
  filesize int(14) default NULL,
  filetype varchar(250) default NULL,
  data longblob,
  user varchar(40) default NULL,
  downloads int(14) default NULL,
  votes int(8) default NULL,
  points decimal(8,2) default NULL,
  path varchar(255) default NULL,
  reference_url varchar(250) default NULL,
  is_reference char(1) default NULL,
  hash varchar(32) default NULL,
  search_data longtext,
  lastModif integer(14) DEFAULT NULL,
  lastModifUser varchar(200) DEFAULT NULL,
  PRIMARY KEY  (fileId),
  KEY name (name),
  KEY description (description(255)),
  KEY downloads (downloads),
  FULLTEXT KEY ft (name,description,search_data)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_forum_attachments
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_forum_attachments;
CREATE TABLE tiki_forum_attachments (
  attId int(14) NOT NULL auto_increment,
  threadId int(14) NOT NULL default '0',
  qId int(14) NOT NULL default '0',
  forumId int(14) default NULL,
  filename varchar(250) default NULL,
  filetype varchar(250) default NULL,
  filesize int(12) default NULL,
  data longblob,
  dir varchar(200) default NULL,
  created int(14) default NULL,
  path varchar(250) default NULL,
  PRIMARY KEY  (attId),
  KEY threadId (threadId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_forum_reads
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:17 PM
#

DROP TABLE IF EXISTS tiki_forum_reads;
CREATE TABLE tiki_forum_reads (
  user varchar(40) NOT NULL default '',
  threadId int(14) NOT NULL default '0',
  forumId int(14) default NULL,
  timestamp int(14) default NULL,
  PRIMARY KEY  (user,threadId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_forums
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 11:14 PM
#

DROP TABLE IF EXISTS tiki_forums;
CREATE TABLE tiki_forums (
  forumId int(8) NOT NULL auto_increment,
  name varchar(200) default NULL,
  description text,
  created int(14) default NULL,
  lastPost int(14) default NULL,
  threads int(8) default NULL,
  comments int(8) default NULL,
  controlFlood char(1) default NULL,
  floodInterval int(8) default NULL,
  moderator varchar(200) default NULL,
  hits int(8) default NULL,
  mail varchar(200) default NULL,
  useMail char(1) default NULL,
  section varchar(200) default NULL,
  usePruneUnreplied char(1) default NULL,
  pruneUnrepliedAge int(8) default NULL,
  usePruneOld char(1) default NULL,
  pruneMaxAge int(8) default NULL,
  topicsPerPage int(6) default NULL,
  topicOrdering varchar(100) default NULL,
  threadOrdering varchar(100) default NULL,
  att varchar(80) default NULL,
  att_store varchar(4) default NULL,
  att_store_dir varchar(250) default NULL,
  att_max_size int(12) default NULL,
  ui_level char(1) default NULL,
  forum_password varchar(32) default NULL,
  forum_use_password char(1) default NULL,
  moderator_group varchar(200) default NULL,
  approval_type varchar(20) default NULL,
  outbound_address varchar(250) default NULL,
  outbound_mails_for_inbound_mails char(1) default NULL,
  outbound_mails_reply_link char(1) default NULL,
  outbound_from varchar(250) default NULL,
  inbound_pop_server varchar(250) default NULL,
  inbound_pop_port int(4) default NULL,
  inbound_pop_user varchar(200) default NULL,
  inbound_pop_password varchar(80) default NULL,
  topic_smileys char(1) default NULL,
  ui_avatar char(1) default NULL,
  ui_flag char(1) default NULL,
  ui_posts char(1) default NULL,
  ui_email char(1) default NULL,
  ui_online char(1) default NULL,
  topic_summary char(1) default NULL,
  show_description char(1) default NULL,
  topics_list_replies char(1) default NULL,
  topics_list_reads char(1) default NULL,
  topics_list_pts char(1) default NULL,
  topics_list_lastpost char(1) default NULL,
  topics_list_author char(1) default NULL,
  vote_threads char(1) default NULL,
  forum_last_n int(2) default 0,
  PRIMARY KEY  (forumId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_forums_queue
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_forums_queue;
CREATE TABLE tiki_forums_queue (
  qId int(14) NOT NULL auto_increment,
  object varchar(32) default NULL,
  parentId int(14) default NULL,
  forumId int(14) default NULL,
  timestamp int(14) default NULL,
  user varchar(40) default NULL,
  title varchar(240) default NULL,
  data text,
  type varchar(60) default NULL,
  hash varchar(32) default NULL,
  topic_smiley varchar(80) default NULL,
  topic_title varchar(240) default NULL,
  summary varchar(240) default NULL,
  PRIMARY KEY  (qId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_forums_reported
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_forums_reported;
CREATE TABLE tiki_forums_reported (
  threadId int(12) NOT NULL default '0',
  forumId int(12) NOT NULL default '0',
  parentId int(12) NOT NULL default '0',
  user varchar(40) default NULL,
  timestamp int(14) default NULL,
  reason varchar(250) default NULL,
  PRIMARY KEY  (threadId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_galleries
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Sep 18, 2004 at 11:56 PM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_galleries;
CREATE TABLE tiki_galleries (
  galleryId int(14) NOT NULL auto_increment,
  name varchar(80) NOT NULL default '',
  description text,
  created int(14) default NULL,
  lastModif int(14) default NULL,
  visible char(1) default NULL,
  geographic char(1) default NULL,
  theme varchar(60) default NULL,
  user varchar(40) default NULL,
  hits int(14) default NULL,
  maxRows int(10) default NULL,
  rowImages int(10) default NULL,
  thumbSizeX int(10) default NULL,
  thumbSizeY int(10) default NULL,
  public char(1) default NULL,
  sortorder varchar(20) NOT NULL default 'created',
  sortdirection varchar(4) NOT NULL default 'desc',
  galleryimage varchar(20) NOT NULL default 'first',
  parentgallery int(14) NOT NULL default '-1',
  showname char(1) NOT NULL default 'y',
  showimageid char(1) NOT NULL default 'n',
  showdescription char(1) NOT NULL default 'n',
  showcreated char(1) NOT NULL default 'n',
  showuser char(1) NOT NULL default 'n',
  showhits char(1) NOT NULL default 'y',
  showxysize char(1) NOT NULL default 'y',
  showfilesize char(1) NOT NULL default 'n',
  showfilename char(1) NOT NULL default 'n',
  defaultscale varchar(10) NOT NULL DEFAULT 'o',
  PRIMARY KEY  (galleryId),
  KEY name (name),
  KEY description (description(255)),
  KEY hits (hits),
  KEY parentgallery (parentgallery),
  KEY visibleUser (visible, user),
  FULLTEXT KEY ft (name,description)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_galleries_scales
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_galleries_scales;
CREATE TABLE tiki_galleries_scales (
  galleryId int(14) NOT NULL default '0',
  scale int(11) NOT NULL default '0',
  PRIMARY KEY  (galleryId,scale)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_games
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 05, 2003 at 08:23 PM
#

DROP TABLE IF EXISTS tiki_games;
CREATE TABLE tiki_games (
  gameName varchar(200) NOT NULL default '',
  hits int(8) default NULL,
  votes int(8) default NULL,
  points int(8) default NULL,
  PRIMARY KEY  (gameName)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_group_inclusion
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 05, 2003 at 02:03 AM
#

DROP TABLE IF EXISTS tiki_group_inclusion;
CREATE TABLE tiki_group_inclusion (
  groupName varchar(255) NOT NULL default '',
  includeGroup varchar(255) NOT NULL default '',
  PRIMARY KEY  (groupName(30),includeGroup(30))
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_history
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Mar 30, 2005 at 10:21 PM
#

DROP TABLE IF EXISTS tiki_history;
CREATE TABLE tiki_history (
  pageName varchar(160) NOT NULL default '',
  version int(8) NOT NULL default '0',
  version_minor int(8) NOT NULL default '0',
  lastModif int(14) default NULL,
  description varchar(200) default NULL,
  user varchar(40) default NULL,
  ip varchar(15) default NULL,
  comment varchar(200) default NULL,
  data longblob,
  PRIMARY KEY  (pageName,version)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_hotwords
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 10, 2003 at 11:04 PM
#

DROP TABLE IF EXISTS tiki_hotwords;
CREATE TABLE tiki_hotwords (
  word varchar(40) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  PRIMARY KEY  (word)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_html_pages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_html_pages;
CREATE TABLE tiki_html_pages (
  pageName varchar(200) NOT NULL default '',
  content longblob,
  refresh int(10) default NULL,
  type char(1) default NULL,
  created int(14) default NULL,
  PRIMARY KEY  (pageName)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_html_pages_dynamic_zones
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_html_pages_dynamic_zones;
CREATE TABLE tiki_html_pages_dynamic_zones (
  pageName varchar(40) NOT NULL default '',
  zone varchar(80) NOT NULL default '',
  type char(2) default NULL,
  content text,
  PRIMARY KEY  (pageName,zone)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_images
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Sep 18, 2004 at 08:29 PM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_images;
CREATE TABLE tiki_images (
  imageId int(14) NOT NULL auto_increment,
  galleryId int(14) NOT NULL default '0',
  name varchar(200) NOT NULL default '',
  description text,
  lon float default NULL,
  lat float default NULL,
  created int(14) default NULL,
  user varchar(40) default NULL,
  hits int(14) default NULL,
  path varchar(255) default NULL,
  PRIMARY KEY  (imageId),
  KEY name (name),
  KEY description (description(255)),
  KEY hits (hits),
  KEY ti_gId (galleryId),
  KEY ti_cr (created),
  KEY ti_us (user),
  FULLTEXT KEY ft (name,description)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_images_data
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 12:49 PM
# Last check: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_images_data;
CREATE TABLE tiki_images_data (
  imageId int(14) NOT NULL default '0',
  xsize int(8) NOT NULL default '0',
  ysize int(8) NOT NULL default '0',
  type char(1) NOT NULL default '',
  filesize int(14) default NULL,
  filetype varchar(80) default NULL,
  filename varchar(80) default NULL,
  data longblob,
  etag varchar(32) default NULL,
  PRIMARY KEY  (imageId,xsize,ysize,type),
  KEY t_i_d_it (imageId,type)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_language
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_language;
CREATE TABLE tiki_language (
  source tinyblob NOT NULL,
  lang char(16) NOT NULL default '',
  tran tinyblob,
  PRIMARY KEY  (source(255),lang)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_languages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_languages;
CREATE TABLE tiki_languages (
  lang char(16) NOT NULL default '',
  language varchar(255) default NULL,
  PRIMARY KEY  (lang)
) TYPE=MyISAM;
# --------------------------------------------------------
INSERT INTO tiki_languages(lang, language) VALUES('en','English');
# --------------------------------------------------------

#
# Table structure for table tiki_link_cache
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 06:06 PM
#

DROP TABLE IF EXISTS tiki_link_cache;
CREATE TABLE tiki_link_cache (
  cacheId int(14) NOT NULL auto_increment,
  url varchar(250) default NULL,
  data longblob,
  refresh int(14) default NULL,
  PRIMARY KEY  (cacheId),
  KEY urlindex (url)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_links
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 11:39 PM
#

DROP TABLE IF EXISTS tiki_links;
CREATE TABLE tiki_links (
  fromPage varchar(160) NOT NULL default '',
  toPage varchar(160) NOT NULL default '',
  PRIMARY KEY  (fromPage,toPage),
  KEY toPage (toPage)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_live_support_events
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_live_support_events;
CREATE TABLE tiki_live_support_events (
  eventId int(14) NOT NULL auto_increment,
  reqId varchar(32) NOT NULL default '',
  type varchar(40) default NULL,
  seqId int(14) default NULL,
  senderId varchar(32) default NULL,
  data text,
  timestamp int(14) default NULL,
  PRIMARY KEY  (eventId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_live_support_message_comments
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_live_support_message_comments;
CREATE TABLE tiki_live_support_message_comments (
  cId int(12) NOT NULL auto_increment,
  msgId int(12) default NULL,
  data text,
  timestamp int(14) default NULL,
  PRIMARY KEY  (cId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_live_support_messages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_live_support_messages;
CREATE TABLE tiki_live_support_messages (
  msgId int(12) NOT NULL auto_increment,
  data text,
  timestamp int(14) default NULL,
  user varchar(40) default NULL,
  username varchar(200) default NULL,
  priority int(2) default NULL,
  status char(1) default NULL,
  assigned_to varchar(200) default NULL,
  resolution varchar(100) default NULL,
  title varchar(200) default NULL,
  module int(4) default NULL,
  email varchar(250) default NULL,
  PRIMARY KEY  (msgId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_live_support_modules
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_live_support_modules;
CREATE TABLE tiki_live_support_modules (
  modId int(4) NOT NULL auto_increment,
  name varchar(90) default NULL,
  PRIMARY KEY  (modId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------
INSERT INTO tiki_live_support_modules(name) VALUES('wiki');
INSERT INTO tiki_live_support_modules(name) VALUES('forums');
INSERT INTO tiki_live_support_modules(name) VALUES('image galleries');
INSERT INTO tiki_live_support_modules(name) VALUES('file galleries');
INSERT INTO tiki_live_support_modules(name) VALUES('directory');
INSERT INTO tiki_live_support_modules(name) VALUES('workflow');
INSERT INTO tiki_live_support_modules(name) VALUES('charts');
# --------------------------------------------------------

#
# Table structure for table tiki_live_support_operators
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_live_support_operators;
CREATE TABLE tiki_live_support_operators (
  user varchar(40) NOT NULL default '',
  accepted_requests int(10) default NULL,
  status varchar(20) default NULL,
  longest_chat int(10) default NULL,
  shortest_chat int(10) default NULL,
  average_chat int(10) default NULL,
  last_chat int(14) default NULL,
  time_online int(10) default NULL,
  votes int(10) default NULL,
  points int(10) default NULL,
  status_since int(14) default NULL,
  PRIMARY KEY  (user)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_live_support_requests
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_live_support_requests;
CREATE TABLE tiki_live_support_requests (
  reqId varchar(32) NOT NULL default '',
  user varchar(40) default NULL,
  tiki_user varchar(200) default NULL,
  email varchar(200) default NULL,
  operator varchar(200) default NULL,
  operator_id varchar(32) default NULL,
  user_id varchar(32) default NULL,
  reason text,
  req_timestamp int(14) default NULL,
  timestamp int(14) default NULL,
  status varchar(40) default NULL,
  resolution varchar(40) default NULL,
  chat_started int(14) default NULL,
  chat_ended int(14) default NULL,
  PRIMARY KEY  (reqId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_live_support_requests
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_logs;
CREATE TABLE tiki_logs (
  logId int(8) NOT NULL auto_increment,
  logtype varchar(20) NOT NULL,
  logmessage text NOT NULL,
  loguser varchar(40) NOT NULL,
  logip varchar(200) NOT NULL,
  logclient text NOT NULL,
  logtime int(14) NOT NULL,
  PRIMARY KEY  (logId),
  KEY logtype (logtype)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table tiki_mail_events
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 05:28 AM
#

DROP TABLE IF EXISTS tiki_mail_events;
CREATE TABLE tiki_mail_events (
  event varchar(200) default NULL,
  object varchar(200) default NULL,
  email varchar(200) default NULL
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_mailin_accounts
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jun 17, 2004 at 03:06 PM EST
#

DROP TABLE IF EXISTS tiki_mailin_accounts;
CREATE TABLE tiki_mailin_accounts (
  accountId int(12) NOT NULL auto_increment,
  user varchar(40) NOT NULL default '',
  account varchar(50) NOT NULL default '',
  pop varchar(255) default NULL,
  port int(4) default NULL,
  username varchar(100) default NULL,
  pass varchar(100) default NULL,
  active char(1) default NULL,
  type varchar(40) default NULL,
  smtp varchar(255) default NULL,
  useAuth char(1) default NULL,
  smtpPort int(4) default NULL,
  anonymous char(1) NOT NULL default 'y',
  attachments char(1) NOT NULL default 'n',
  article_topicId int(4) default NULL,
  article_type varchar(50) default NULL,
  discard_after varchar(255) default NULL,
  PRIMARY KEY  (accountId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_menu_languages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_menu_languages;
CREATE TABLE tiki_menu_languages (
  menuId int(8) NOT NULL auto_increment,
  language char(16) NOT NULL default '',
  PRIMARY KEY  (menuId,language)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_menu_options
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Nov 21, 2003 at 07:05 AM
#

DROP TABLE IF EXISTS tiki_menu_options;
CREATE TABLE tiki_menu_options (
  optionId int(8) NOT NULL auto_increment,
  menuId int(8) default NULL,
  type char(1) default NULL,
  name varchar(200) default NULL,
  url varchar(255) default NULL,
  position int(4) default NULL,
  section varchar(255) default NULL,
  perm varchar(255) default NULL,
  groupname varchar(255) default NULL,
  PRIMARY KEY  (optionId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Home','tiki-index.php',10,'','','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Chat','tiki-chat.php',15,'feature_chat','tiki_p_chat','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Contact us','tiki-contact.php',20,'feature_contact','','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Stats','tiki-stats.php',23,'feature_stats','tiki_p_view_stats','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Categories','tiki-browse_categories.php',25,'feature_categories','tiki_p_view_categories','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Games','tiki-list_games.php',30,'feature_games','tiki_p_play_games','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Calendar','tiki-calendar.php',35,'feature_calendar','tiki_p_view_calendar','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Users map','tiki-gmap_usermap.php',36,'feature_gmap','','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Mobile','tiki-mobile.php',37,'feature_mobile','','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','(debug)','javascript:toggle("debugconsole")',40,'feature_debug_console','tiki_p_admin','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','MyTiki','tiki-my_tiki.php',50,'','','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','MyTiki home','tiki-my_tiki.php',51,'','','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Preferences','tiki-user_preferences.php',55,'feature_userPreferences','','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Messages','messu-mailbox.php',60,'feature_messages','tiki_p_messages','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Tasks','tiki-user_tasks.php',65,'feature_tasks','tiki_p_tasks','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Bookmarks','tiki-user_bookmarks.php',70,'feature_user_bookmarks','tiki_p_create_bookmarks','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Modules','tiki-user_assigned_modules.php',75,'user_assigned_modules','tiki_p_configure_modules','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Newsreader','tiki-newsreader_servers.php',80,'feature_newsreader','tiki_p_newsreader','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Webmail','tiki-webmail.php',85,'feature_webmail','tiki_p_use_webmail','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Notepad','tiki-notepad_list.php',90,'feature_notepad','tiki_p_notepad','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','My files','tiki-userfiles.php',95,'feature_userfiles','tiki_p_userfiles','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','User menu','tiki-usermenu.php',100,'feature_usermenu','tiki_p_usermenu','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Mini calendar','tiki-minical.php',105,'feature_minical','tiki_p_minical','Registered');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','My watches','tiki-user_watches.php',110,'feature_user_watches','','Registered');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Workflow','tiki-g-user_processes.php',150,'feature_workflow','tiki_p_use_workflow','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin processes','tiki-g-admin_processes.php',155,'feature_workflow','tiki_p_admin_workflow','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Monitor processes','tiki-g-monitor_processes.php',160,'feature_workflow','tiki_p_admin_workflow','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Monitor activities','tiki-g-monitor_activities.php',165,'feature_workflow','tiki_p_admin_workflow','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Monitor instances','tiki-g-monitor_instances.php',170,'feature_workflow','tiki_p_admin_workflow','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','User processes','tiki-g-user_processes.php',175,'feature_workflow','tiki_p_use_workflow','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','User activities','tiki-g-user_activities.php',180,'feature_workflow','tiki_p_use_workflow','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','User instances','tiki-g-user_instances.php',185,'feature_workflow','tiki_p_use_workflow','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Community','tiki-list_users.php','187','feature_friends','tiki_p_list_users','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','User list','tiki-list_users.php','188','feature_friends','tiki_p_list_users','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Friendship Network','tiki-friends.php','189','feature_friends','','Registered');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Wiki','tiki-index.php',200,'feature_wiki','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Wiki Home','tiki-index.php',202,'feature_wiki','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Last Changes','tiki-lastchanges.php',205,'feature_wiki,feature_lastChanges','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Dump','dump/new.tar',210,'feature_wiki,feature_dump','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Rankings','tiki-wiki_rankings.php',215,'feature_wiki,feature_wiki_rankings','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List pages','tiki-listpages.php',220,'feature_wiki,feature_listPages','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Orphan pages','tiki-orphan_pages.php',225,'feature_wiki,feature_listPages','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Sandbox','tiki-editpage.php?page=sandbox',230,'feature_wiki,feature_sandbox','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Print','tiki-print_pages.php',235,'feature_wiki,feature_wiki_multiprint','tiki_p_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Send pages','tiki-send_objects.php',240,'feature_wiki,feature_comm','tiki_p_view,tiki_p_send_pages','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Received pages','tiki-received_pages.php',245,'feature_wiki,feature_comm','tiki_p_view,tiki_p_admin_received_pages','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Structures','tiki-admin_structures.php',250,'feature_wiki','tiki_p_edit_structures','');

# INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Homework','tiki-hw_student_assignments.php','280','feature_homework','tiki_p_hw_student','');
# INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Assignments','tiki-hw_teacher_assignments.php','282','feature_homework','tiki_p_hw_student','');
# INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Last Changes','tiki-hw_teacher_assignments.php','284','feature_homework','tiki_p_hw_student','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Image Galleries','tiki-galleries.php',300,'feature_galleries','tiki_p_view_image_gallery','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Galleries','tiki-galleries.php',305,'feature_galleries','tiki_p_view_image_gallery','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Rankings','tiki-galleries_rankings.php',310,'feature_galleries,feature_gal_rankings','tiki_p_view_image_gallery','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Upload image','tiki-upload_image.php',315,'feature_galleries','tiki_p_upload_images','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Directory batch','tiki-batch_upload.php',318,'feature_galleries,feature_gal_batch','tiki_p_batch_upload','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','System gallery','tiki-list_gallery.php?galleryId=0',320,'feature_galleries','tiki_p_admin_galleries','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Articles','tiki-view_articles.php',350,'feature_articles','tiki_p_read_article','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Articles home','tiki-view_articles.php',355,'feature_articles','tiki_p_read_article','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List articles','tiki-list_articles.php',360,'feature_articles','tiki_p_read_article','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Rankings','tiki-cms_rankings.php',365,'feature_articles,feature_cms_rankings','tiki_p_read_article','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Submit article','tiki-edit_submission.php',370,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_submit_article','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','View submissions','tiki-list_submissions.php',375,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_submit_article','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','View submissions','tiki-list_submissions.php',375,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_approve_submission','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','View submissions','tiki-list_submissions.php',375,'feature_articles,feature_submissions','tiki_p_read_article,tiki_p_remove_submission','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Edit article','tiki-edit_article.php',380,'feature_articles','tiki_p_read_article,tiki_p_edit_article','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Send articles','tiki-send_objects.php',385,'feature_articles,feature_comm','tiki_p_read_article,tiki_p_send_articles','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Received articles','tiki-received_articles.php',385,'feature_articles,feature_comm','tiki_p_read_article,tiki_p_admin_received_articles','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin topics','tiki-admin_topics.php',390,'feature_articles','tiki_p_read_article,tiki_p_admin_cms','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin types','tiki-article_types.php',395,'feature_articles','tiki_p_read_article,tiki_p_admin_cms','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Blogs','tiki-list_blogs.php',450,'feature_blogs','tiki_p_read_blog','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List blogs','tiki-list_blogs.php',455,'feature_blogs','tiki_p_read_blog','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Rankings','tiki-blog_rankings.php',460,'feature_blogs,feature_blog_rankings','tiki_p_read_blog','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Create/Edit blog','tiki-edit_blog.php',465,'feature_blogs','tiki_p_read_blog,tiki_p_create_blogs','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Post','tiki-blog_post.php',470,'feature_blogs','tiki_p_read_blog,tiki_p_blog_post','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin posts','tiki-list_posts.php',475,'feature_blogs','tiki_p_read_blog,tiki_p_blog_admin','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Forums','tiki-forums.php',500,'feature_forums','tiki_p_forum_read','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List forums','tiki-forums.php',505,'feature_forums','tiki_p_forum_read','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Rankings','tiki-forum_rankings.php',510,'feature_forums,feature_forum_rankings','tiki_p_forum_read','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin forums','tiki-admin_forums.php',515,'feature_forums','tiki_p_forum_read,tiki_p_admin_forum','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Directory','tiki-directory_browse.php',550,'feature_directory','tiki_p_view_directory','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Submit a new link','tiki-directory_add_site.php',555,'feature_directory','tiki_p_submit_link','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Browse directory','tiki-directory_browse.php',560,'feature_directory','tiki_p_view_directory','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin directory','tiki-directory_admin.php',565,'feature_directory','tiki_p_view_directory,tiki_p_admin_directory_cats','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin directory','tiki-directory_admin.php',565,'feature_directory','tiki_p_view_directory,tiki_p_admin_directory_sites','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin directory','tiki-directory_admin.php',565,'feature_directory','tiki_p_view_directory,tiki_p_validate_links','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','File Galleries','tiki-file_galleries.php',600,'feature_file_galleries','tiki_p_view_file_gallery','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List galleries','tiki-file_galleries.php',605,'feature_file_galleries','tiki_p_view_file_gallery','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Rankings','tiki-file_galleries_rankings.php',610,'feature_file_galleries,feature_file_galleries_rankings','tiki_p_view_file_gallery','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Upload file','tiki-upload_file.php',615,'feature_file_galleries','tiki_p_view_file_gallery,tiki_p_upload_files','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','FAQs','tiki-list_faqs.php',650,'feature_faqs','tiki_p_view_faqs','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List FAQs','tiki-list_faqs.php',665,'feature_faqs','tiki_p_view_faqs','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin FAQs','tiki-list_faqs.php',660,'feature_faqs','tiki_p_admin_faqs','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Maps','tiki-map.phtml',700,'feature_maps','tiki_p_map_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Mapfiles','tiki-map_edit.php',705,'feature_maps','tiki_p_map_view','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Layer management','tiki-map_upload.php',710,'feature_maps','tiki_p_map_edit','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Quizzes','tiki-list_quizzes.php',750,'feature_quizzes','tiki_p_take_quiz','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List quizzes','tiki-list_quizzes.php',755,'feature_quizzes','tiki_p_take_quiz','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Quiz stats','tiki-quiz_stats.php',760,'feature_quizzes','tiki_p_view_quiz_stats','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin quiz','tiki-edit_quiz.php',765,'feature_quizzes','tiki_p_admin_quizzes','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','TikiSheet','tiki-sheets.php',780,'feature_sheet','tiki_p_view_sheet','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Trackers','tiki-list_trackers.php',800,'feature_trackers','tiki_p_view_trackers','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List trackers','tiki-list_trackers.php',805,'feature_trackers','tiki_p_view_trackers','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin trackers','tiki-admin_trackers.php',810,'feature_trackers','tiki_p_admin_trackers','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Surveys','tiki-list_surveys.php',850,'feature_surveys','tiki_p_take_survey','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','List surveys','tiki-list_surveys.php',855,'feature_surveys','tiki_p_take_survey','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Stats','tiki-survey_stats.php',860,'feature_surveys','tiki_p_view_survey_stats','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin surveys','tiki-admin_surveys.php',865,'feature_surveys','tiki_p_admin_surveys','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Newsletters','tiki-newsletters.php',900,'feature_newsletters','tiki_p_subscribe_newsletters','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Newsletters','tiki-newsletters.php',900,'feature_newsletters','tiki_p_send_newsletters','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Newsletters','tiki-newsletters.php',900,'feature_newsletters','tiki_p_admin_newsletters','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Send newsletters','tiki-send_newsletters.php',905,'feature_newsletters','tiki_p_send_newsletters','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin newsletters','tiki-admin_newsletters.php',910,'feature_newsletters','tiki_p_admin_newsletters','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Ephemerides','tiki-eph.php',950,'feature_eph','tiki_p_view_eph','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin ephemerides','tiki-eph_admin.php',955,'feature_eph','tiki_p_eph_admin','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'s','Charts','tiki-charts.php',1000,'feature_charts','tiki_p_view_chart','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin charts','tiki-admin_charts.php',1005,'feature_charts','tiki_p_admin_charts','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_chat','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_categories','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_banners','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_templates','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_cookies','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_dynamic','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_mailin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_content_templates','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_edit_html_pages','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_view_referer_stats','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_drawings','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_admin_shoutbox','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','tiki_p_live_support_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'','user_is_operator','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'r','Admin','tiki-admin.php',1050,'feature_integrator','tiki_p_admin_integrator','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin home','tiki-admin.php',1051,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Live support','tiki-live_support_admin.php',1055,'feature_live_support','tiki_p_live_support_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Live support','tiki-live_support_admin.php',1055,'feature_live_support','user_is_operator','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Banning','tiki-admin_banning.php',1060,'feature_banning','tiki_p_admin_banning','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Calendar','tiki-admin_calendars.php',1065,'feature_calendar','tiki_p_admin_calendar','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Users','tiki-adminusers.php',1070,'','tiki_p_admin_users','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Groups','tiki-admingroups.php',1075,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Cache','tiki-list_cache.php',1080,'cachepages','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Modules','tiki-admin_modules.php',1085,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Links','tiki-admin_links.php',1090,'feature_featuredLinks','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Hotwords','tiki-admin_hotwords.php',1095,'feature_hotwords','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','RSS modules','tiki-admin_rssmodules.php',1100,'','tiki_p_admin_rssmodules','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Menus','tiki-admin_menus.php',1105,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Polls','tiki-admin_polls.php',1110,'feature_polls','tiki_p_admin_polls','');

# Hiding for fresh install in Tiki 1.9.8 until we fix or remove.
# INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Backups','tiki-backup.php',1115,'','tiki_p_admin','');

INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Mail notifications','tiki-admin_notifications.php',1120,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Search stats','tiki-search_stats.php',1125,'feature_search_stats','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Theme control','tiki-theme_control.php',1130,'feature_theme_control','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','QuickTags','tiki-admin_quicktags.php',1135,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Chat','tiki-admin_chat.php',1140,'feature_chat','tiki_p_admin_chat','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Categories','tiki-admin_categories.php',1145,'feature_categories','tiki_p_admin_categories','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Banners','tiki-list_banners.php',1150,'feature_banners','tiki_p_admin_banners','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Edit templates','tiki-edit_templates.php',1155,'feature_edit_templates','tiki_p_edit_templates','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Drawings','tiki-admin_drawings.php',1160,'feature_drawings','tiki_p_admin_drawings','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Dynamic content','tiki-list_contents.php',1165,'feature_dynamic_content','tiki_p_admin_dynamic','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Cookies','tiki-admin_cookies.php',1170,'','tiki_p_edit_cookies','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Mail-in','tiki-admin_mailin.php',1175,'feature_mailin','tiki_p_admin_mailin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Content templates','tiki-admin_content_templates.php',1180,'','tiki_p_edit_content_templates','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','HTML pages','tiki-admin_html_pages.php',1185,'feature_html_pages','tiki_p_edit_html_pages','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Shoutbox','tiki-shoutbox.php',1190,'feature_shoutbox','tiki_p_admin_shoutbox','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Shoutbox Words','tiki-admin_shoutbox_words.php',1191,'feature_shoutbox','tiki_p_admin_shoutbox','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Referer stats','tiki-referer_stats.php',1195,'feature_referer_stats','tiki_p_view_referer_stats','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Edit languages','tiki-edit_languages.php',1200,'lang_use_db','tiki_p_edit_languages','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Integrator','tiki-admin_integrator.php',1205,'feature_integrator','tiki_p_admin_integrator','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','phpinfo','tiki-phpinfo.php',1215,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','DSN','tiki-admin_dsn.php',1220,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','External wikis','tiki-admin_external_wikis.php',1225,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','System Admin','tiki-admin_system.php',1230,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Score','tiki-admin_score.php',1235,'feature_score','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Admin mods','tiki-mods.php',1240,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Tiki Logs','tiki-syslog.php',1245,'','tiki_p_admin','');
INSERT INTO tiki_menu_options (menuId,type,name,url,position,section,perm,groupname) VALUES (42,'o','Security Admin','tiki-admin_security.php',1250,'','tiki_p_admin','');
# --------------------------------------------------------

#
# Table structure for table tiki_menus
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_menus;
CREATE TABLE tiki_menus (
  menuId int(8) NOT NULL auto_increment,
  name varchar(200) NOT NULL default '',
  description text,
  type char(1) default NULL,
  PRIMARY KEY  (menuId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------
INSERT INTO tiki_menus (menuId,name,description,type) VALUES ('42','Application menu','Main extensive navigation menu','d');
# --------------------------------------------------------

#
# Table structure for table tiki_minical_events
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 09, 2003 at 04:06 AM
#

DROP TABLE IF EXISTS tiki_minical_events;
CREATE TABLE tiki_minical_events (
  user varchar(40) default NULL,
  eventId int(12) NOT NULL auto_increment,
  title varchar(250) default NULL,
  description text,
  start int(14) default NULL,
  end int(14) default NULL,
  security char(1) default NULL,
  duration int(3) default NULL,
  topicId int(12) default NULL,
  reminded char(1) default NULL,
  PRIMARY KEY  (eventId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_minical_topics
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_minical_topics;
CREATE TABLE tiki_minical_topics (
  user varchar(40) default NULL,
  topicId int(12) NOT NULL auto_increment,
  name varchar(250) default NULL,
  filename varchar(200) default NULL,
  filetype varchar(200) default NULL,
  filesize varchar(200) default NULL,
  data longblob,
  path varchar(250) default NULL,
  isIcon char(1) default NULL,
  PRIMARY KEY  (topicId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_modules
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 11:44 PM
#

DROP TABLE IF EXISTS tiki_modules;
CREATE TABLE tiki_modules (
  name varchar(200) NOT NULL default '',
  position char(1) default NULL,
  ord int(4) default NULL,
  type char(1) default NULL,
  title varchar(255) default NULL,
  cache_time int(14) default NULL,
  rows int(4) default NULL,
  params varchar(255) default NULL,
  groups text,
  PRIMARY KEY  (name),
  KEY positionType (position, type)
) TYPE=MyISAM;
# --------------------------------------------------------
INSERT INTO tiki_modules (name,position,ord,cache_time,groups) VALUES ('login_box','r',1,0,'a:2:{i:0;s:10:"Registered";i:1;s:9:"Anonymous";}');
INSERT INTO tiki_modules (name,position,ord,cache_time,params,groups) VALUES ('mnu_application_menu','l',1,0,'flip=y','a:2:{i:0;s:10:"Registered";i:1;s:9:"Anonymous";}');
INSERT INTO tiki_modules (name,position,ord,cache_time,groups) VALUES ('quick_edit','l',2,0,'a:1:{i:0;s:10:"Registered";}');
INSERT INTO tiki_modules (name,position,ord,cache_time,groups) VALUES ('assistant','l',10,0,'a:1:{i:0;s:6:"Admins";}');
INSERT INTO tiki_modules (name,position,ord,cache_time,groups) VALUES ('since_last_visit_new','r',40,0,'a:1:{i:0;s:6:"Admins";}');
# --------------------------------------------------------

#
# Table structure for table tiki_newsletter_subscriptions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_newsletter_subscriptions;
CREATE TABLE tiki_newsletter_subscriptions (
  nlId int(12) NOT NULL default '0',
  email varchar(255) NOT NULL default '',
  code varchar(32) default NULL,
  valid char(1) default NULL,
  subscribed int(14) default NULL,
  isUser char(1) NOT NULL default 'n',
  PRIMARY KEY  (nlId,email,isUser)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_newsletter_groups
#
# Creation: Jan 18, 2005
# Last update: Jan 18, 2005
#

DROP TABLE IF EXISTS tiki_newsletter_groups;
CREATE TABLE tiki_newsletter_groups (
  nlId int(12) NOT NULL default '0',
  groupName varchar(255) NOT NULL default '',
  code varchar(32) default NULL,
  PRIMARY KEY  (nlId,groupName)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_newsletters
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_newsletters;
CREATE TABLE tiki_newsletters (
  nlId int(12) NOT NULL auto_increment,
  name varchar(200) default NULL,
  description text,
  created int(14) default NULL,
  lastSent int(14) default NULL,
  editions int(10) default NULL,
  users int(10) default NULL,
  allowUserSub char(1) default 'y',
  allowAnySub char(1) default NULL,
  unsubMsg char(1) default 'y',
  validateAddr char(1) default 'y',
  frequency int(14) default NULL,
  PRIMARY KEY  (nlId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_newsreader_marks
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_newsreader_marks;
CREATE TABLE tiki_newsreader_marks (
  user varchar(40) NOT NULL default '',
  serverId int(12) NOT NULL default '0',
  groupName varchar(255) NOT NULL default '',
  timestamp int(14) NOT NULL default '0',
  PRIMARY KEY  (user,serverId,groupName(100))
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_newsreader_servers
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_newsreader_servers;
CREATE TABLE tiki_newsreader_servers (
  user varchar(40) NOT NULL default '',
  serverId int(12) NOT NULL auto_increment,
  server varchar(250) default NULL,
  port int(4) default NULL,
  username varchar(200) default NULL,
  password varchar(200) default NULL,
  PRIMARY KEY  (serverId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_page_footnotes
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 10:00 AM
# Last check: Jul 12, 2003 at 10:00 AM
#

DROP TABLE IF EXISTS tiki_page_footnotes;
CREATE TABLE tiki_page_footnotes (
  user varchar(40) NOT NULL default '',
  pageName varchar(250) NOT NULL default '',
  data text,
  PRIMARY KEY  (user,pageName(100))
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_pages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:52 AM
# Last check: Jul 12, 2003 at 10:01 AM
#

DROP TABLE IF EXISTS tiki_pages;
CREATE TABLE tiki_pages (
  page_id int(14) NOT NULL auto_increment,
  pageName varchar(160) NOT NULL default '',
  hits int(8) default NULL,
  data text,
  description varchar(200) default NULL,
  lastModif int(14) default NULL,
  comment varchar(200) default NULL,
  version int(8) NOT NULL default '0',
  user varchar(40) default NULL,
  ip varchar(15) default NULL,
  flag char(1) default NULL,
  points int(8) default NULL,
  votes int(8) default NULL,
  cache longtext,
  wiki_cache int(10) default NULL,
  cache_timestamp int(14) default NULL,
  pageRank decimal(4,3) default NULL,
  creator varchar(200) default NULL,
  page_size int(10) unsigned default '0',
  lang varchar(16) default NULL,
  lockedby varchar(200) default NULL,
  is_html tinyint(1) default 0,
  created int(14),
  PRIMARY KEY  (page_id),
  UNIQUE KEY pageName (pageName),
  KEY data (data(255)),
  KEY pageRank (pageRank),
  FULLTEXT KEY ft (pageName,description,data)
) TYPE=MyISAM AUTO_INCREMENT=1;
# --------------------------------------------------------

#
# Table structure for table tiki_pageviews
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:52 AM
#

DROP TABLE IF EXISTS tiki_pageviews;
CREATE TABLE tiki_pageviews (
  day int(14) NOT NULL default '0',
  pageviews int(14) default NULL,
  PRIMARY KEY  (day)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_poll_objects
#

DROP TABLE IF EXISTS tiki_poll_objects;
CREATE TABLE `tiki_poll_objects` (
  `catObjectId` int(11) NOT NULL default '0',
  `pollId` int(11) NOT NULL default '0',
  `title` varchar(255) default NULL,
  PRIMARY KEY  (`catObjectId`,`pollId`)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_poll_options
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 06, 2003 at 07:57 PM
#

DROP TABLE IF EXISTS tiki_poll_options;
CREATE TABLE tiki_poll_options (
  pollId int(8) NOT NULL default '0',
  optionId int(8) NOT NULL auto_increment,
  title varchar(200) default NULL,
  position int(4) NOT NULL default '0',
  votes int(8) default NULL,
  PRIMARY KEY  (optionId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_polls
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 06, 2003 at 07:57 PM
#

DROP TABLE IF EXISTS tiki_polls;
CREATE TABLE tiki_polls (
  pollId int(8) NOT NULL auto_increment,
  title varchar(200) default NULL,
  votes int(8) default NULL,
  active char(1) default NULL,
  publishDate int(14) default NULL,
  PRIMARY KEY  (pollId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_preferences
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 12:04 PM
#

DROP TABLE IF EXISTS tiki_preferences;
CREATE TABLE tiki_preferences (
  name varchar(40) NOT NULL default '',
  value text default NULL,
  PRIMARY KEY  (name)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_private_messages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_private_messages;
CREATE TABLE tiki_private_messages (
  messageId int(8) NOT NULL auto_increment,
  toNickname varchar(200) NOT NULL default '',
  data varchar(255) default NULL,
  poster varchar(200) NOT NULL default 'anonymous',
  timestamp int(14) default NULL,
  PRIMARY KEY  (messageId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_programmed_content
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_programmed_content;
CREATE TABLE tiki_programmed_content (
  pId int(8) NOT NULL auto_increment,
  contentId int(8) NOT NULL default '0',
  publishDate int(14) NOT NULL default '0',
  data text,
  PRIMARY KEY  (pId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_quiz_question_options
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_quiz_question_options;
CREATE TABLE tiki_quiz_question_options (
  optionId int(10) NOT NULL auto_increment,
  questionId int(10) default NULL,
  optionText text,
  points int(4) default NULL,
  PRIMARY KEY  (optionId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_quiz_questions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_quiz_questions;
CREATE TABLE tiki_quiz_questions (
  questionId int(10) NOT NULL auto_increment,
  quizId int(10) default NULL,
  question text,
  position int(4) default NULL,
  type char(1) default NULL,
  maxPoints int(4) default NULL,
  PRIMARY KEY  (questionId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_quiz_results
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_quiz_results;
CREATE TABLE tiki_quiz_results (
  resultId int(10) NOT NULL auto_increment,
  quizId int(10) default NULL,
  fromPoints int(4) default NULL,
  toPoints int(4) default NULL,
  answer text,
  PRIMARY KEY  (resultId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_quiz_stats
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_quiz_stats;
CREATE TABLE tiki_quiz_stats (
  quizId int(10) NOT NULL default '0',
  questionId int(10) NOT NULL default '0',
  optionId int(10) NOT NULL default '0',
  votes int(10) default NULL,
  PRIMARY KEY  (quizId,questionId,optionId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_quiz_stats_sum
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_quiz_stats_sum;
CREATE TABLE tiki_quiz_stats_sum (
  quizId int(10) NOT NULL default '0',
  quizName varchar(255) default NULL,
  timesTaken int(10) default NULL,
  avgpoints decimal(5,2) default NULL,
  avgavg decimal(5,2) default NULL,
  avgtime decimal(5,2) default NULL,
  PRIMARY KEY  (quizId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_quizzes
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: April 29, 2004
#

DROP TABLE IF EXISTS tiki_quizzes;
CREATE TABLE tiki_quizzes (
  quizId int(10) NOT NULL auto_increment,
  name varchar(255) default NULL,
  description text,
  canRepeat char(1) default NULL,
  storeResults char(1) default NULL,
  questionsPerPage int(4) default NULL,
  timeLimited char(1) default NULL,
  timeLimit int(14) default NULL,
  created int(14) default NULL,
  taken int(10) default NULL,
  immediateFeedback char(1) default NULL,
  showAnswers char(1) default NULL,
  shuffleQuestions char(1) default NULL,
  shuffleAnswers char(1) default NULL,
  publishDate int(14) default NULL,
  expireDate int(14) default NULL,
  bDeleted char(1) default NULL,
  nVersion int(4) NOT NULL,
  nAuthor int(4) default NULL,
  bOnline char(1) default NULL,
  bRandomQuestions char(1) default NULL,
  nRandomQuestions tinyint(4) default NULL,
  bLimitQuestionsPerPage char(1) default NULL,
  nLimitQuestionsPerPage tinyint(4) default NULL,
  bMultiSession char(1) default NULL,
  nCanRepeat tinyint(4) default NULL,
  sGradingMethod varchar(80) default NULL,
  sShowScore varchar(80) default NULL,
  sShowCorrectAnswers varchar(80) default NULL,
  sPublishStats varchar(80) default NULL,
  bAdditionalQuestions char(1) default NULL,
  bForum char(1) default NULL,
  sForum varchar(80) default NULL,
  sPrologue text,
  sData text,
  sEpilogue text,
  passingperct int(4) default 0,
  PRIMARY KEY  (quizId, nVersion)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_received_articles
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_received_articles;
CREATE TABLE tiki_received_articles (
  receivedArticleId int(14) NOT NULL auto_increment,
  receivedFromSite varchar(200) default NULL,
  receivedFromUser varchar(200) default NULL,
  receivedDate int(14) default NULL,
  title varchar(80) default NULL,
  authorName varchar(60) default NULL,
  size int(12) default NULL,
  useImage char(1) default NULL,
  image_name varchar(80) default NULL,
  image_type varchar(80) default NULL,
  image_size int(14) default NULL,
  image_x int(4) default NULL,
  image_y int(4) default NULL,
  image_data longblob,
  publishDate int(14) default NULL,
  expireDate int(14) default NULL,
  created int(14) default NULL,
  heading text,
  body longblob,
  hash varchar(32) default NULL,
  author varchar(200) default NULL,
  type varchar(50) default NULL,
  rating decimal(3,2) default NULL,
  PRIMARY KEY  (receivedArticleId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_received_pages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 09, 2003 at 03:56 AM
#

DROP TABLE IF EXISTS tiki_received_pages;
CREATE TABLE tiki_received_pages (
  receivedPageId int(14) NOT NULL auto_increment,
  pageName varchar(160) NOT NULL default '',
  data longblob,
  description varchar(200) default NULL,
  comment varchar(200) default NULL,
  receivedFromSite varchar(200) default NULL,
  receivedFromUser varchar(200) default NULL,
  receivedDate int(14) default NULL,
  PRIMARY KEY  (receivedPageId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_referer_stats
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:30 AM
#

DROP TABLE IF EXISTS tiki_referer_stats;
CREATE TABLE tiki_referer_stats (
  referer varchar(255) NOT NULL default '',
  hits int(10) default NULL,
  last int(14) default NULL,
  PRIMARY KEY  (referer)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_related_categories
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_related_categories;
CREATE TABLE tiki_related_categories (
  categId int(10) NOT NULL default '0',
  relatedTo int(10) NOT NULL default '0',
  PRIMARY KEY  (categId,relatedTo)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_rss_modules
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 10:19 AM
#

DROP TABLE IF EXISTS tiki_rss_modules;
CREATE TABLE tiki_rss_modules (
  rssId int(8) NOT NULL auto_increment,
  name varchar(30) NOT NULL default '',
  description text,
  url varchar(255) NOT NULL default '',
  refresh int(8) default NULL,
  lastUpdated int(14) default NULL,
  showTitle char(1) default 'n',
  showPubDate char(1) default 'n',
  content longblob,
  PRIMARY KEY  (rssId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_rss_feeds
#
# Creation: Oct 14, 2003 at 20:34 PM
# Last update: Oct 14, 2003 at 20:34 PM
#

DROP TABLE IF EXISTS tiki_rss_feeds;
CREATE TABLE tiki_rss_feeds (
  name varchar(30) NOT NULL default '',
  rssVer char(1) NOT NULL default '1',
  refresh int(8) default '300',
  lastUpdated int(14) default NULL,
  cache longblob,
  PRIMARY KEY  (name,rssVer)
) TYPE=MyISAM;
# --------------------------------------------------------

DROP TABLE IF EXISTS tiki_searchindex;
CREATE TABLE tiki_searchindex(
  searchword varchar(80) NOT NULL default '',
  location varchar(80) NOT NULL default '',
  page varchar(255) NOT NULL default '',
  count int(11) NOT NULL default '1',
  last_update int(11) NOT NULL default '0',
  PRIMARY KEY  (searchword,location,page(80)),
  KEY last_update (last_update)
) TYPE=MyISAM;

# LRU (last recently used) list for searching parts of words
DROP TABLE IF EXISTS tiki_searchsyllable;
CREATE TABLE tiki_searchsyllable(
  syllable varchar(80) NOT NULL default '',
  lastUsed int(11) NOT NULL default '0',
  lastUpdated int(11) NOT NULL default '0',
  PRIMARY KEY  (syllable),
  KEY lastUsed (lastUsed)
) TYPE=MyISAM;

# searchword caching table for search syllables
DROP TABLE IF EXISTS tiki_searchwords;
CREATE TABLE tiki_searchwords(
  syllable varchar(80) NOT NULL default '',
  searchword varchar(80) NOT NULL default '',
  PRIMARY KEY  (syllable,searchword)
) TYPE=MyISAM;

#
# Table structure for table tiki_search_stats
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 10:55 PM
#

DROP TABLE IF EXISTS tiki_search_stats;
CREATE TABLE tiki_search_stats (
  term varchar(50) NOT NULL default '',
  hits int(10) default NULL,
  PRIMARY KEY  (term)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_secdb
#
#

DROP TABLE IF EXISTS tiki_secdb;
CREATE TABLE tiki_secdb(
  md5_value varchar(32) NOT NULL,
  filename varchar(250) NOT NULL,
  tiki_version varchar(60) NOT NULL,
  severity int(4) NOT NULL default '0',
  PRIMARY KEY  (md5_value,filename(100),tiki_version),
  KEY sdb_fn (filename)
) TYPE=MyISAM;

#
# Table structure for table tiki_semaphores
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:52 AM
#

DROP TABLE IF EXISTS tiki_semaphores;
CREATE TABLE tiki_semaphores (
  semName varchar(250) NOT NULL default '',
  user varchar(40) default NULL,
  timestamp int(14) default NULL,
  PRIMARY KEY  (semName)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_sent_newsletters
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_sent_newsletters;
CREATE TABLE tiki_sent_newsletters (
  editionId int(12) NOT NULL auto_increment,
  nlId int(12) NOT NULL default '0',
  users int(10) default NULL,
  sent int(14) default NULL,
  subject varchar(200) default NULL,
  data longblob,
  PRIMARY KEY  (editionId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_sessions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:52 AM
#

DROP TABLE IF EXISTS tiki_sessions;
CREATE TABLE tiki_sessions (
  sessionId varchar(32) NOT NULL default '',
  user varchar(40) default NULL,
  timestamp int(14) default NULL,
  tikihost varchar(200) default NULL,
  PRIMARY KEY  (sessionId),
  KEY user (user),
  KEY timestamp (timestamp)
) TYPE=MyISAM;
# --------------------------------------------------------

# Tables for TikiSheet
DROP TABLE IF EXISTS tiki_sheet_layout;
CREATE TABLE tiki_sheet_layout (
  sheetId int(8) NOT NULL default '0',
  begin int(10) NOT NULL default '0',
  end int(10) default NULL,
  headerRow int(4) NOT NULL default '0',
  footerRow int(4) NOT NULL default '0',
  className varchar(64) default NULL,
  UNIQUE KEY sheetId (sheetId,begin)
) TYPE=MyISAM;

DROP TABLE IF EXISTS tiki_sheet_values;
CREATE TABLE tiki_sheet_values (
  sheetId int(8) NOT NULL default '0',
  begin int(10) NOT NULL default '0',
  end int(10) default NULL,
  rowIndex int(4) NOT NULL default '0',
  columnIndex int(4) NOT NULL default '0',
  value varchar(255) default NULL,
  calculation varchar(255) default NULL,
  width int(4) NOT NULL default '1',
  height int(4) NOT NULL default '1',
  format varchar(255) default NULL,
  UNIQUE KEY sheetId (sheetId,begin,rowIndex,columnIndex),
  KEY sheetId_2 (sheetId,rowIndex,columnIndex)
) TYPE=MyISAM;

DROP TABLE IF EXISTS tiki_sheets;
CREATE TABLE tiki_sheets (
  sheetId int(8) NOT NULL auto_increment,
  title varchar(200) NOT NULL default '',
  description text,
  author varchar(200) NOT NULL default '',
  PRIMARY KEY  (sheetId)
) TYPE=MyISAM;

#
# Table structure for table tiki_shoutbox
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:21 PM
#

DROP TABLE IF EXISTS tiki_shoutbox;
CREATE TABLE tiki_shoutbox (
  msgId int(10) NOT NULL auto_increment,
  message varchar(255) default NULL,
  timestamp int(14) default NULL,
  user varchar(40) default NULL,
  hash varchar(32) default NULL,
  PRIMARY KEY  (msgId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_shoutbox_words
#

DROP TABLE IF EXISTS tiki_shoutbox_words;
CREATE TABLE tiki_shoutbox_words (
  word VARCHAR( 40 ) NOT NULL ,
  qty INT DEFAULT '0' NOT NULL ,
  PRIMARY KEY  (word)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_structure_versions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_structure_versions;
CREATE TABLE tiki_structure_versions (
  structure_id int(14) NOT NULL auto_increment,
  version int(14) default NULL,
  PRIMARY KEY  (structure_id)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_structures
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_structures;
CREATE TABLE tiki_structures (
  page_ref_id int(14) NOT NULL auto_increment,
  structure_id int(14) NOT NULL,
  parent_id int(14) default NULL,
  page_id int(14) NOT NULL,
  page_version int(8) default NULL,
  page_alias varchar(240) NOT NULL default '',
  pos int(4) default NULL,
  PRIMARY KEY  (page_ref_id),
  KEY pidpaid (page_id,parent_id)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_submissions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 08, 2003 at 04:16 PM
#

DROP TABLE IF EXISTS tiki_submissions;
CREATE TABLE tiki_submissions (
  subId int(8) NOT NULL auto_increment,
  topline varchar(255) default NULL,
  title varchar(80) default NULL,
  subtitle varchar(255) default NULL,
  linkto varchar(255) default NULL,
  lang varchar(16) default NULL,
  authorName varchar(60) default NULL,
  topicId int(14) default NULL,
  topicName varchar(40) default NULL,
  size int(12) default NULL,
  useImage char(1) default NULL,
  image_name varchar(80) default NULL,
  image_caption text default NULL,
  image_type varchar(80) default NULL,
  image_size int(14) default NULL,
  image_x int(4) default NULL,
  image_y int(4) default NULL,
  image_data longblob,
  publishDate int(14) default NULL,
  expireDate int(14) default NULL,
  created int(14) default NULL,
  bibliographical_references text,
  resume text,
  heading text,
  body text,
  hash varchar(32) default NULL,
  author varchar(200) default NULL,
  nbreads int(14) default NULL,
  votes int(8) default NULL,
  points int(14) default NULL,
  type varchar(50) default NULL,
  rating decimal(3,2) default NULL,
  isfloat char(1) default NULL,
  PRIMARY KEY  (subId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_suggested_faq_questions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 08:52 PM
#

DROP TABLE IF EXISTS tiki_suggested_faq_questions;
CREATE TABLE tiki_suggested_faq_questions (
  sfqId int(10) NOT NULL auto_increment,
  faqId int(10) NOT NULL default '0',
  question text,
  answer text,
  created int(14) default NULL,
  user varchar(40) default NULL,
  PRIMARY KEY  (sfqId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_survey_question_options
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 12:55 AM
#

DROP TABLE IF EXISTS tiki_survey_question_options;
CREATE TABLE tiki_survey_question_options (
  optionId int(12) NOT NULL auto_increment,
  questionId int(12) NOT NULL default '0',
  qoption text,
  votes int(10) default NULL,
  PRIMARY KEY  (optionId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_survey_questions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 11:55 PM
#

DROP TABLE IF EXISTS tiki_survey_questions;
CREATE TABLE tiki_survey_questions (
  questionId int(12) NOT NULL auto_increment,
  surveyId int(12) NOT NULL default '0',
  question text,
  options text,
  type char(1) default NULL,
  position int(5) default NULL,
  votes int(10) default NULL,
  value int(10) default NULL,
  average decimal(4,2) default NULL,
  PRIMARY KEY  (questionId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_surveys
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:40 PM
#

DROP TABLE IF EXISTS tiki_surveys;
CREATE TABLE tiki_surveys (
  surveyId int(12) NOT NULL auto_increment,
  name varchar(200) default NULL,
  description text,
  taken int(10) default NULL,
  lastTaken int(14) default NULL,
  created int(14) default NULL,
  status char(1) default NULL,
  PRIMARY KEY  (surveyId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_tags
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 06, 2003 at 02:58 AM
#

DROP TABLE IF EXISTS tiki_tags;
CREATE TABLE tiki_tags (
  tagName varchar(80) NOT NULL default '',
  pageName varchar(160) NOT NULL default '',
  hits int(8) default NULL,
  description varchar(200) default NULL,
  data longblob,
  lastModif int(14) default NULL,
  comment varchar(200) default NULL,
  version int(8) NOT NULL default '0',
  user varchar(40) default NULL,
  ip varchar(15) default NULL,
  flag char(1) default NULL,
  PRIMARY KEY  (tagName,pageName)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_theme_control_categs
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_theme_control_categs;
CREATE TABLE tiki_theme_control_categs (
  categId int(12) NOT NULL default '0',
  theme varchar(250) NOT NULL default '',
  PRIMARY KEY  (categId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_theme_control_objects
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_theme_control_objects;
CREATE TABLE tiki_theme_control_objects (
  objId varchar(250) NOT NULL default '',
  type varchar(250) NOT NULL default '',
  name varchar(250) NOT NULL default '',
  theme varchar(250) NOT NULL default '',
  PRIMARY KEY  (objId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_theme_control_sections
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_theme_control_sections;
CREATE TABLE tiki_theme_control_sections (
  section varchar(250) NOT NULL default '',
  theme varchar(250) NOT NULL default '',
  PRIMARY KEY  (section)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_topics
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 04, 2003 at 10:10 PM
#

DROP TABLE IF EXISTS tiki_topics;
CREATE TABLE tiki_topics (
  topicId int(14) NOT NULL auto_increment,
  name varchar(40) default NULL,
  image_name varchar(80) default NULL,
  image_type varchar(80) default NULL,
  image_size int(14) default NULL,
  image_data longblob,
  active char(1) default NULL,
  created int(14) default NULL,
  PRIMARY KEY  (topicId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_tracker_fields
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 08, 2003 at 01:48 PM
#

DROP TABLE IF EXISTS tiki_tracker_fields;
CREATE TABLE tiki_tracker_fields (
  fieldId int(12) NOT NULL auto_increment,
  trackerId int(12) NOT NULL default '0',
  name varchar(255) default NULL,
  options text,
  type char(1) default NULL,
  isMain char(1) default NULL,
  isTblVisible char(1) default NULL,
  position int(4) default NULL,
  isSearchable char(1) NOT NULL default 'y',
  isPublic char(1) NOT NULL default 'n',
  isHidden char(1) NOT NULL default 'n',
  isMandatory char(1) NOT NULL default 'n',
  PRIMARY KEY  (fieldId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_tracker_item_attachments
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_tracker_item_attachments;
CREATE TABLE tiki_tracker_item_attachments (
  attId int(12) NOT NULL auto_increment,
  itemId int(12) NOT NULL default 0,
  filename varchar(80) default NULL,
  filetype varchar(80) default NULL,
  filesize int(14) default NULL,
  user varchar(40) default NULL,
  data longblob,
  path varchar(255) default NULL,
  downloads int(10) default NULL,
  created int(14) default NULL,
  comment varchar(250) default NULL,
  longdesc blob,
  version varchar(40) default NULL,
  PRIMARY KEY  (attId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_tracker_item_comments
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:12 AM
#

DROP TABLE IF EXISTS tiki_tracker_item_comments;
CREATE TABLE tiki_tracker_item_comments (
  commentId int(12) NOT NULL auto_increment,
  itemId int(12) NOT NULL default '0',
  user varchar(40) default NULL,
  data text,
  title varchar(200) default NULL,
  posted int(14) default NULL,
  PRIMARY KEY  (commentId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_tracker_item_fields
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:26 AM
#

DROP TABLE IF EXISTS tiki_tracker_item_fields;
CREATE TABLE tiki_tracker_item_fields (
  itemId int(12) NOT NULL default '0',
  fieldId int(12) NOT NULL default '0',
  value text,
  PRIMARY KEY  (itemId,fieldId),
  FULLTEXT KEY ft (value)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_tracker_items
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:26 AM
#

DROP TABLE IF EXISTS tiki_tracker_items;
CREATE TABLE tiki_tracker_items (
  itemId int(12) NOT NULL auto_increment,
  trackerId int(12) NOT NULL default '0',
  created int(14) default NULL,
  status char(1) default NULL,
  lastModif int(14) default NULL,
  PRIMARY KEY  (itemId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_tracker_options
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 08, 2003 at 01:48 PM
#

DROP TABLE IF EXISTS tiki_tracker_options;
CREATE TABLE tiki_tracker_options (
  trackerId int(12) NOT NULL default '0',
  name varchar(80) NOT NULL default '',
  value text default NULL,
  PRIMARY KEY  (trackerId,name(30))
) TYPE=MyISAM ;
# --------------------------------------------------------


#
# Table structure for table tiki_trackers
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:26 AM
#

DROP TABLE IF EXISTS tiki_trackers;
CREATE TABLE tiki_trackers (
  trackerId int(12) NOT NULL auto_increment,
  name varchar(255) default NULL,
  description text,
  created int(14) default NULL,
  lastModif int(14) default NULL,
  showCreated char(1) default NULL,
  showStatus char(1) default NULL,
  showLastModif char(1) default NULL,
  useComments char(1) default NULL,
  useAttachments char(1) default NULL,
  showAttachments char(1) default NULL,
  items int(10) default NULL,
  showComments char(1) default NULL,
  orderAttachments varchar(255) NOT NULL default 'filename,created,filesize,downloads,desc',
  PRIMARY KEY  (trackerId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_untranslated
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_untranslated;
CREATE TABLE tiki_untranslated (
  id int(14) NOT NULL auto_increment,
  source tinyblob NOT NULL,
  lang char(16) NOT NULL default '',
  PRIMARY KEY  (source(255),lang),
  UNIQUE KEY id (id),
  KEY id_2 (id)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_user_answers
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_user_answers;
CREATE TABLE tiki_user_answers (
  userResultId int(10) NOT NULL default '0',
  quizId int(10) NOT NULL default '0',
  questionId int(10) NOT NULL default '0',
  optionId int(10) NOT NULL default '0',
  PRIMARY KEY  (userResultId,quizId,questionId,optionId)
) TYPE=MyISAM;
# --------------------------------------------------------


#
# Table structure for table tiki_user_answers_uploads
#
# Creation: Jan 25, 2005 at 07:42 PM
# Last update: Jan 25, 2005 at 07:42 PM
#


DROP TABLE IF EXISTS tiki_user_answers_uploads;
CREATE TABLE tiki_user_answers_uploads (
  answerUploadId int(4) NOT NULL auto_increment,
  userResultId int(11) NOT NULL default '0',
  questionId int(11) NOT NULL default '0',
  filename varchar(255) NOT NULL default '',
  filetype varchar(64) NOT NULL default '',
  filesize varchar(255) NOT NULL default '',
  filecontent longblob NOT NULL,
  PRIMARY KEY  (answerUploadId)
) TYPE=MyISAM;


#
# Table structure for table tiki_user_assigned_modules
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:25 PM
#

DROP TABLE IF EXISTS tiki_user_assigned_modules;
CREATE TABLE tiki_user_assigned_modules (
  name varchar(200) NOT NULL default '',
  position char(1) default NULL,
  ord int(4) default NULL,
  type char(1) default NULL,
  user varchar(40) NOT NULL default '',
  PRIMARY KEY  (name,user)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_user_bookmarks_folders
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 08:35 AM
#

DROP TABLE IF EXISTS tiki_user_bookmarks_folders;
CREATE TABLE tiki_user_bookmarks_folders (
  folderId int(12) NOT NULL auto_increment,
  parentId int(12) default NULL,
  user varchar(40) NOT NULL default '',
  name varchar(30) default NULL,
  PRIMARY KEY  (user,folderId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_user_bookmarks_urls
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 08:36 AM
#

DROP TABLE IF EXISTS tiki_user_bookmarks_urls;
CREATE TABLE tiki_user_bookmarks_urls (
  urlId int(12) NOT NULL auto_increment,
  name varchar(30) default NULL,
  url varchar(250) default NULL,
  data longblob,
  lastUpdated int(14) default NULL,
  folderId int(12) NOT NULL default '0',
  user varchar(40) NOT NULL default '',
  PRIMARY KEY  (urlId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_user_mail_accounts
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_user_mail_accounts;
CREATE TABLE tiki_user_mail_accounts (
  accountId int(12) NOT NULL auto_increment,
  user varchar(40) NOT NULL default '',
  account varchar(50) NOT NULL default '',
  pop varchar(255) default NULL,
  current char(1) default NULL,
  port int(4) default NULL,
  username varchar(100) default NULL,
  pass varchar(100) default NULL,
  msgs int(4) default NULL,
  smtp varchar(255) default NULL,
  useAuth char(1) default NULL,
  smtpPort int(4) default NULL,
  PRIMARY KEY  (accountId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_user_menus
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 10:58 PM
#

DROP TABLE IF EXISTS tiki_user_menus;
CREATE TABLE tiki_user_menus (
  user varchar(40) NOT NULL default '',
  menuId int(12) NOT NULL auto_increment,
  url varchar(250) default NULL,
  name varchar(40) default NULL,
  position int(4) default NULL,
  mode char(1) default NULL,
  PRIMARY KEY  (menuId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_user_modules
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 05, 2003 at 03:16 AM
#

DROP TABLE IF EXISTS tiki_user_modules;
CREATE TABLE tiki_user_modules (
  name varchar(200) NOT NULL default '',
  title varchar(40) default NULL,
  data longblob,
  parse char(1) default NULL,
  PRIMARY KEY  (name)
) TYPE=MyISAM;
# --------------------------------------------------------
INSERT INTO tiki_user_modules (name, title, data, parse) VALUES ('mnu_application_menu', 'Menu', '{menu id=42}', 'n');

#
# Table structure for table tiki_user_notes
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:52 AM
#

DROP TABLE IF EXISTS tiki_user_notes;
CREATE TABLE tiki_user_notes (
  user varchar(40) NOT NULL default '',
  noteId int(12) NOT NULL auto_increment,
  created int(14) default NULL,
  name varchar(255) default NULL,
  lastModif int(14) default NULL,
  data text,
  size int(14) default NULL,
  parse_mode varchar(20) default NULL,
  PRIMARY KEY  (noteId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_user_postings
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:12 AM
#

DROP TABLE IF EXISTS tiki_user_postings;
CREATE TABLE tiki_user_postings (
  user varchar(40) NOT NULL default '',
  posts int(12) default NULL,
  last int(14) default NULL,
  first int(14) default NULL,
  level int(8) default NULL,
  PRIMARY KEY  (user)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_user_preferences
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:09 AM
#

DROP TABLE IF EXISTS tiki_user_preferences;
CREATE TABLE tiki_user_preferences (
  user varchar(40) NOT NULL default '',
  prefName varchar(40) NOT NULL default '',
  value varchar(250) default NULL,
  PRIMARY KEY  (user,prefName)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_user_quizzes
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_user_quizzes;
CREATE TABLE tiki_user_quizzes (
  user varchar(40) default NULL,
  quizId int(10) default NULL,
  timestamp int(14) default NULL,
  timeTaken int(14) default NULL,
  points int(12) default NULL,
  maxPoints int(12) default NULL,
  resultId int(10) default NULL,
  userResultId int(10) NOT NULL auto_increment,
  PRIMARY KEY  (userResultId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_user_taken_quizzes
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_user_taken_quizzes;
CREATE TABLE tiki_user_taken_quizzes (
  user varchar(40) NOT NULL default '',
  quizId varchar(255) NOT NULL default '',
  PRIMARY KEY  (user,quizId(100))
) TYPE=MyISAM;
# --------------------------------------------------------


#
# Table structure for table tiki_user_tasks_history
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jan 25, 2005 by sir-b & moresun
#
DROP TABLE IF EXISTS tiki_user_tasks_history;
CREATE TABLE tiki_user_tasks_history (
  belongs_to integer(14) NOT NULL,                   -- the fist task in a history it has the same id as the task id
  task_version integer(4) NOT NULL DEFAULT 0,        -- version number for the history it starts with 0
  title varchar(250) NOT NULL,                       -- title
  description text DEFAULT NULL,                     -- description
  start integer(14) DEFAULT NULL,                    -- date of the starting, if it is not set than there is not starting date
  end integer(14) DEFAULT NULL,                      -- date of the end, if it is not set than there is not dealine
  lasteditor varchar(200) NOT NULL,                  -- lasteditor: username of last editior
  lastchanges integer(14) NOT NULL,                  -- date of last changes
  priority integer(2) NOT NULL DEFAULT 3,                     -- priority
  completed integer(14) DEFAULT NULL,                -- date of the completation if it is null it is not yet completed
  deleted integer(14) DEFAULT NULL,                  -- date of the deleteation it it is null it is not deleted
  status char(1) DEFAULT NULL,                       -- null := waiting, 
                                                     -- o := open / in progress, 
                                                     -- c := completed -> (percentage = 100) 
  percentage int(4) DEFAULT NULL,
  accepted_creator char(1) DEFAULT NULL,             -- y - yes, n - no, null - waiting
  accepted_user char(1) DEFAULT NULL,                -- y - yes, n - no, null - waiting
  PRIMARY KEY (belongs_to, task_version)
) TYPE=MyISAM AUTO_INCREMENT=1 ;


#
# Table structure for table tiki_user_tasks
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jan 25, 2005 by sir-b & moresun
#
DROP TABLE IF EXISTS tiki_user_tasks;
CREATE TABLE tiki_user_tasks (
  taskId integer(14) NOT NULL auto_increment,        -- task id
  last_version integer(4) NOT NULL DEFAULT 0,        -- last version of the task starting with 0
  user varchar(40) NOT NULL DEFAULT '',              -- task user
  creator varchar(200) NOT NULL,                     -- username of creator
  public_for_group varchar(30) DEFAULT NULL,         -- this group can also view the task, if it is null it is not public
  rights_by_creator char(1) DEFAULT NULL,            -- null the user can delete the task, 
  created integer(14) NOT NULL,                      -- date of the creation
  status char(1) default NULL,
  priority int(2) default NULL,
  completed int(14) default NULL,
  percentage int(4) default NULL,
  PRIMARY KEY (taskId),
  UNIQUE(creator, created)
) TYPE=MyISAM AUTO_INCREMENT=1;

# --------------------------------------------------------

#
# Table structure for table tiki_user_votings
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 11:55 PM
#

DROP TABLE IF EXISTS tiki_user_votings;
CREATE TABLE tiki_user_votings (
  user varchar(40) NOT NULL default '',
  id varchar(255) NOT NULL default '',
  optionId int(10) NOT NULL default 0,
  PRIMARY KEY  (user,id(100))
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_user_watches
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 08:07 AM
#

DROP TABLE IF EXISTS tiki_user_watches;
CREATE TABLE tiki_user_watches (
  user varchar(40) NOT NULL default '',
  event varchar(40) NOT NULL default '',
  object varchar(200) NOT NULL default '',
  hash varchar(32) default NULL,
  title varchar(250) default NULL,
  type varchar(200) default NULL,
  url varchar(250) default NULL,
  email varchar(200) default NULL,
  PRIMARY KEY  (user,event,object(100))
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_userfiles
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_userfiles;
CREATE TABLE tiki_userfiles (
  user varchar(40) NOT NULL default '',
  fileId int(12) NOT NULL auto_increment,
  name varchar(200) default NULL,
  filename varchar(200) default NULL,
  filetype varchar(200) default NULL,
  filesize varchar(200) default NULL,
  data longblob,
  hits int(8) default NULL,
  isFile char(1) default NULL,
  path varchar(255) default NULL,
  created int(14) default NULL,
  PRIMARY KEY  (fileId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_userpoints
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 05:47 AM
#

DROP TABLE IF EXISTS tiki_userpoints;
CREATE TABLE tiki_userpoints (
  user varchar(40) default NULL,
  points decimal(8,2) default NULL,
  voted int(8) default NULL
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_users
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_users;
CREATE TABLE tiki_users (
  user varchar(40) NOT NULL default '',
  password varchar(40) default NULL,
  email varchar(200) default NULL,
  lastLogin int(14) default NULL,
  PRIMARY KEY  (user)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_webmail_contacts
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_webmail_contacts;
CREATE TABLE tiki_webmail_contacts (
  contactId int(12) NOT NULL auto_increment,
  firstName varchar(80) default NULL,
  lastName varchar(80) default NULL,
  email varchar(250) default NULL,
  nickname varchar(200) default NULL,
  user varchar(40) NOT NULL default '',
  PRIMARY KEY  (contactId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_webmail_messages
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_webmail_messages;
CREATE TABLE tiki_webmail_messages (
  accountId int(12) NOT NULL default '0',
  mailId varchar(255) NOT NULL default '',
  user varchar(40) NOT NULL default '',
  isRead char(1) default NULL,
  isReplied char(1) default NULL,
  isFlagged char(1) default NULL,
  PRIMARY KEY  (accountId,mailId)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table tiki_wiki_attachments
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_wiki_attachments;
CREATE TABLE tiki_wiki_attachments (
  attId int(12) NOT NULL auto_increment,
  page varchar(200) NOT NULL default '',
  filename varchar(80) default NULL,
  filetype varchar(80) default NULL,
  filesize int(14) default NULL,
  user varchar(40) default NULL,
  data longblob,
  path varchar(255) default NULL,
  downloads int(10) default NULL,
  created int(14) default NULL,
  comment varchar(250) default NULL,
  PRIMARY KEY  (attId)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------

#
# Table structure for table tiki_zones
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_zones;
CREATE TABLE tiki_zones (
  zone varchar(40) NOT NULL default '',
  PRIMARY KEY  (zone)
) TYPE=MyISAM;
# --------------------------------------------------------
#
# Table structure for table tiki_download
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Apr 15 2004 at 07:42 PM
#

DROP TABLE IF EXISTS tiki_download;
CREATE TABLE tiki_download (
  id int(11) NOT NULL auto_increment,
  object varchar(255) NOT NULL default '',
  userId int(8) NOT NULL default '0',
  type varchar(20) NOT NULL default '',
  date int(14) NOT NULL default '0',
  IP varchar(50) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY object (object,userId,type),
  KEY userId (userId),
  KEY type (type),
  KEY date (date)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table users_grouppermissions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 07:22 AM
#

DROP TABLE IF EXISTS users_grouppermissions;
CREATE TABLE users_grouppermissions (
  groupName varchar(255) NOT NULL default '',
  permName varchar(30) NOT NULL default '',
  value char(1) default '',
  PRIMARY KEY  (groupName(30),permName)
) TYPE=MyISAM;
# --------------------------------------------------------

insert into users_grouppermissions (groupName,permName) values('Anonymous','tiki_p_view');
insert into users_grouppermissions (groupName,permName) values('Anonymous','tiki_p_wiki_view_history');
insert into users_grouppermissions (groupName,permName) values('Anonymous','tiki_p_wiki_view_comments');

#
# Table structure for table users_groups
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 03, 2003 at 08:57 PM
#

DROP TABLE IF EXISTS users_groups;
CREATE TABLE users_groups (
  groupName varchar(255) NOT NULL default '',
  groupDesc varchar(255) default NULL,
  groupHome varchar(255),
  usersTrackerId int(11),
  groupTrackerId int(11),
  usersFieldId int(11),
  groupFieldId int(11),
  PRIMARY KEY  (groupName(30))
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table users_objectpermissions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 07:20 AM
#

DROP TABLE IF EXISTS users_objectpermissions;
CREATE TABLE users_objectpermissions (
  groupName varchar(255) NOT NULL default '',
  permName varchar(30) NOT NULL default '',
  objectType varchar(20) NOT NULL default '',
  objectId varchar(32) NOT NULL default '',
  PRIMARY KEY  (objectId, objectType, groupName(30),permName)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table users_permissions
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 11, 2003 at 07:22 AM
#

DROP TABLE IF EXISTS users_permissions;
CREATE TABLE users_permissions (
  permName varchar(30) NOT NULL default '',
  permDesc varchar(250) default NULL,
  level varchar(80) default NULL,
  type varchar(20) default NULL,
  PRIMARY KEY  (permName),
  KEY type (type)
) TYPE=MyISAM;
# --------------------------------------------------------
# 

INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_abort_instance', 'Can abort a process instance', 'editors', 'workflow');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_access_closed_site', 'Can access site when closed', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_add_events', 'Can add events in the calendar', 'registered', 'calendar');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin', 'Administrator, can manage users groups and permissions, Hotwords and all the weblog features', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_banners', 'Administrator, can admin banners', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_banning', 'Can ban users or ips', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_calendar', 'Can create/admin calendars', 'admin', 'calendar');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_categories', 'Can admin categories', 'editors', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_charts', 'Can admin charts', 'admin', 'charts');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_chat', 'Administrator, can create channels remove channels etc', 'editors', 'chat');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_cms', 'Can admin the cms', 'editors', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_directory', 'Can admin the directory', 'editors', 'directory');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_directory_cats', 'Can admin directory categories', 'editors', 'directory');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_directory_sites', 'Can admin directory sites', 'editors', 'directory');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_drawings', 'Can admin drawings', 'editors', 'drawings');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_dynamic', 'Can admin the dynamic content system', 'editors', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_faqs', 'Can admin faqs', 'editors', 'faqs');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_file_galleries', 'Can admin file galleries', 'editors', 'file galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_forum', 'Can admin forums', 'editors', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_galleries', 'Can admin Image Galleries', 'editors', 'image galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_games', 'Can admin games', 'editors', 'games');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_integrator', 'Can admin integrator repositories and rules', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_mailin', 'Can admin mail-in accounts', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_newsletters', 'Can admin newsletters', 'admin', 'newsletters');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_objects','Can edit object permissions', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_polls','Can admin polls', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_quizzes', 'Can admin quizzes', 'editors', 'quizzes');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_received_articles', 'Can admin received articles', 'editors', 'comm');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_received_pages', 'Can admin received pages', 'editors', 'comm');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_rssmodules','Can admin rss modules', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_sheet', 'Can admin sheet', 'admin', 'sheet');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_shoutbox', 'Can admin shoutbox (Edit/remove msgs)', 'editors', 'shoutbox');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_surveys', 'Can admin surveys', 'editors', 'surveys');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_trackers', 'Can admin trackers', 'editors', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_users', 'Can admin users', 'admin', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_wiki', 'Can admin the wiki', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_admin_workflow', 'Can admin workflow processes', 'admin', 'workflow');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_approve_submission', 'Can approve submissions', 'editors', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_attach_trackers', 'Can attach files to tracker items', 'registered', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_autoapprove_submission', 'Submited articles automatically approved', 'editors', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_autosubmit_link', 'Submited links are valid', 'editors', 'directory');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_autoval_chart_suggestio', 'Autovalidate suggestions', 'editors', 'charts');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_batch_upload_files', 'Can upload zip files with files', 'editors', 'file galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_batch_upload_image_dir', 'Can use Directory Batch Load', 'editors', 'image galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_batch_upload_images', 'Can upload zip files with images', 'editors', 'image galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_blog_admin', 'Can admin blogs', 'editors', 'blogs');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_blog_post', 'Can post to a blog', 'registered', 'blogs');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_broadcast', 'Can broadcast messages to groups', 'admin', 'messu');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_broadcast_all', 'Can broadcast messages to all user', 'admin', 'messu');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_cache_bookmarks', 'Can cache user bookmarks', 'admin', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_change_events', 'Can change events in the calendar', 'registered', 'calendar');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_chat', 'Can use the chat system', 'registered', 'chat');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_comment_tracker_items', 'Can insert comments for tracker items', 'basic', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_configure_modules', 'Can configure modules', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_create_blogs', 'Can create a blog', 'editors', 'blogs');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_create_bookmarks', 'Can create user bookmarks', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_create_css', 'Can create new css suffixed with -user', 'registered', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_create_file_galleries', 'Can create file galleries', 'editors', 'file galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_create_galleries', 'Can create image galleries', 'editors', 'image galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_create_tracker_items', 'Can create new items for trackers', 'registered', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_download_files', 'Can download files', 'basic', 'file galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit', 'Can edit pages', 'registered', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_article', 'Can edit articles', 'editors', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_comments', 'Can edit all comments', 'editors', 'comments');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_content_templates', 'Can edit content templates', 'editors', 'content templates');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_cookies', 'Can admin cookies', 'editors', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_copyrights', 'Can edit copyright notices', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_drawings', 'Can edit drawings', 'basic', 'drawings');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_dynvar', 'Can edit dynamic variables', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_html_pages', 'Can edit HTML pages', 'editors', 'html pages');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_languages', 'Can edit translations and create new languages', 'editors', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_sheet', 'Can create and edit sheets', 'editors', 'sheet');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_structures', 'Can create and edit structures', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_submission', 'Can edit submissions', 'editors', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_edit_templates', 'Can edit site templates', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_eph_admin', 'Can admin ephemerides', 'editors', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_exception_instance', 'Can declare an instance as exception', 'registered', 'workflow');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_forum_attach', 'Can attach to forum posts', 'registered', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_forum_autoapp', 'Auto approve forum posts', 'editors', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_forum_post', 'Can post in forums', 'registered', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_forum_post_topic', 'Can start threads in forums', 'registered', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_forum_read', 'Can read forums', 'basic', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_forum_vote', 'Can vote comments in forums', 'registered', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_forums_report', 'Can report msgs to moderator', 'registered', 'forums');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_list_users', 'Can list registered users', 'registered', 'community');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_live_support', 'Can use live support system', 'basic', 'support');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_live_support_admin', 'Admin live support system', 'admin', 'support');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_lock', 'Can lock pages', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_map_create', 'Can create new mapfile', 'admin', 'maps');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_map_delete', 'Can delete mapfiles', 'admin', 'maps');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_map_edit', 'Can edit mapfiles', 'editors', 'maps');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_map_view', 'Can view mapfiles', 'basic', 'maps');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_map_view_mapfiles', 'Can view contents of mapfiles', 'registered', 'maps');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_messages', 'Can use the messaging system', 'registered', 'messu');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_minical', 'Can use the mini event calendar', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_minor', 'Can save as minor edit', 'registered', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_modify_tracker_items', 'Can change tracker items', 'registered', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_newsreader', 'Can use the newsreader', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_notepad', 'Can use the notepad', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_play_games', 'Can play games', 'basic', 'games');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_post_comments', 'Can post new comments', 'registered', 'comments');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_post_shoutbox', 'Can post messages in shoutbox', 'basic', 'shoutbox');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_read_article', 'Can read articles', 'basic', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_read_blog', 'Can read blogs', 'basic', 'blogs');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_read_comments', 'Can read comments', 'basic', 'comments');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_remove', 'Can remove', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_remove_article', 'Can remove articles', 'editors', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_remove_comments', 'Can delete comments', 'editors', 'comments');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_remove_submission', 'Can remove submissions', 'editors', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_rename', 'Can rename pages', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_rollback', 'Can rollback pages', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_send_articles', 'Can send articles to other sites', 'editors', 'comm');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_send_instance', 'Can send instances after completion', 'registered', 'workflow');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_send_newsletters', 'Can send newsletters', 'editors', 'newsletters');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_send_pages', 'Can send pages to other sites', 'registered', 'comm');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_sendme_articles', 'Can send articles to this site', 'registered', 'comm');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_sendme_pages', 'Can send pages to this site', 'registered', 'comm');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_submit_article', 'Can submit articles', 'basic', 'cms');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_submit_link', 'Can submit sites to the directory', 'basic', 'directory');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_subscribe_email', 'Can subscribe any email to newsletters', 'editors', 'newsletters');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_subscribe_newsletters', 'Can subscribe to newsletters', 'basic', 'newsletters');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_suggest_chart_item', 'Can suggest items', 'basic', 'charts');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_suggest_faq', 'Can suggest faq questions', 'basic', 'faqs');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_take_quiz', 'Can take quizzes', 'basic', 'quizzes');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_take_survey', 'Can take surveys', 'basic', 'surveys');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_tasks', 'Can use tasks', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_tasks_admin', 'Can admin public tasks', 'admin', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_tasks_receive', 'Can  receive tasks from other users', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_tasks_send', 'Can send tasks to other users', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_topic_read', 'Can read a topic (Applies only to individual topic perms)', 'basic', 'topics');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_tracker_view_ratings', 'Can view rating result for tracker items', 'basic', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_tracker_vote_ratings', 'Can vote a rating for tracker items', 'registered', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_upload_files', 'Can upload files', 'registered', 'file galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_upload_images', 'Can upload images', 'registered', 'image galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_upload_picture', 'Can upload pictures to wiki pages', 'registered', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_use_HTML', 'Can use HTML in pages', 'editors', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_use_content_templates', 'Can use content templates', 'registered', 'content templates');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_use_webmail', 'Can use webmail', 'registered', 'webmail');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_use_workflow', 'Can execute workflow activities', 'registered', 'workflow');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_userfiles', 'Can upload personal files', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_usermenu', 'Can create items in personal menu', 'registered', 'user');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_validate_links', 'Can validate submited links', 'editors', 'directory');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view', 'Can view page/pages', 'basic', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_calendar', 'Can browse the calendar', 'basic', 'calendar');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_categories', 'Can browse categories', 'basic', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_chart', 'Can view charts', 'basic', 'charts');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_directory', 'Can use the directory', 'basic', 'directory');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_eph', 'Can view ephemerides', 'registered', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_faqs', 'Can view faqs', 'basic', 'faqs');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_file_gallery', 'Can view file galleries', 'basic', 'file galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_html_pages', 'Can view HTML pages', 'basic', 'html pages');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_image_gallery', 'Can view image galleries', 'basic', 'image galleries');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_integrator', 'Can view integrated repositories', 'basic', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_quiz_stats', 'Can view quiz stats', 'basic', 'quizzes');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_referer_stats', 'Can view referer stats', 'editors', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_sheet', 'Can view sheet', 'basic', 'sheet');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_sheet_history', 'Can view sheet history', 'admin', 'sheet');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_shoutbox', 'Can view shoutbox', 'basic', 'shoutbox');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_stats', 'Can view site stats', 'basic', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_survey_stats', 'Can view survey stats', 'basic', 'surveys');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_templates', 'Can view site templates', 'admin', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_tiki_calendar', 'Can view Tikiwiki tools calendar', 'basic', 'calendar');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_trackers', 'Can view trackers', 'basic', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_list_trackers', 'Can list trackers', 'basic', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_trackers_closed', 'Can view trackers closed items', 'registered', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_trackers_pending', 'Can view trackers pending items', 'editors', 'trackers');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_view_user_results', 'Can view user quiz results', 'editors', 'quizzes');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_vote_chart', 'Can vote', 'basic', 'charts');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_vote_comments', 'Can vote comments', 'registered', 'comments');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_vote_poll', 'Can vote polls', 'basic', 'tiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_admin_attachments', 'Can admin attachments to wiki pages', 'editors', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_admin_ratings', 'Can add and change ratings on wiki pages', 'admin', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_attach_files', 'Can attach files to wiki pages', 'registered', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_view_attachments', 'Can view wiki attachments and download', 'registered', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_view_comments', 'Can view wiki comments', 'basic', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_view_history', 'Can view wiki history', 'basic', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_view_ratings', 'Can view rating of wiki pages', 'basic', 'wiki');
INSERT INTO users_permissions (permName, permDesc, level, type) VALUES ('tiki_p_wiki_vote_ratings', 'Can participate to rating of wiki pages', 'registered', 'wiki');
# --------------------------------------------------------

#
# Table structure for table users_usergroups
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 12, 2003 at 09:31 PM
#

DROP TABLE IF EXISTS users_usergroups;
CREATE TABLE users_usergroups (
  userId int(8) NOT NULL default '0',
  groupName varchar(255) NOT NULL default '',
  PRIMARY KEY  (userId,groupName(30))
) TYPE=MyISAM;
# --------------------------------------------------------
INSERT INTO users_groups (groupName,groupDesc) VALUES ('Anonymous','Public users not logged');
INSERT INTO users_groups (groupName,groupDesc) VALUES ('Registered','Users logged into the system');
INSERT INTO users_groups (groupName,groupDesc) VALUES ('Admins','Administrator and accounts managers.');
# --------------------------------------------------------

#
# Table structure for table users_users
#
# Creation: Jul 03, 2003 at 07:42 PM
# Last update: Jul 13, 2003 at 01:07 AM
#

DROP TABLE IF EXISTS users_users;
CREATE TABLE users_users (
  userId int(8) NOT NULL auto_increment,
  email varchar(200) default NULL,
  login varchar(40) NOT NULL default '',
  password varchar(30) default '',
  provpass varchar(30) default NULL,
  default_group varchar(255),
  lastLogin int(14) default NULL,
  currentLogin int(14) default NULL,
  registrationDate int(14) default NULL,
  challenge varchar(32) default NULL,
  pass_due int(14) default NULL,
  hash varchar(32) default NULL,
  created int(14) default NULL,
  avatarName varchar(80) default NULL,
  avatarSize int(14) default NULL,
  avatarFileType varchar(250) default NULL,
  avatarData longblob,
  avatarLibName varchar(200) default NULL,
  avatarType char(1) default NULL,
  score int(11) NOT NULL default 0,
  valid varchar(32) default NULL,
  PRIMARY KEY  (userId),
  KEY score (score),
  KEY login (login)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
# --------------------------------------------------------
### Administrator account
INSERT INTO users_users(email,login,password,hash) VALUES ('','admin','admin',md5('adminadmin'));
UPDATE users_users set currentLogin=lastLogin, registrationDate=lastLogin;
INSERT INTO tiki_user_preferences (user,prefName,value) VALUES ('admin','realName','System Administrator');
INSERT INTO users_usergroups (userId, groupName) VALUES(1,'Admins');
INSERT INTO users_grouppermissions (groupName, permName) VALUES ('Admins','tiki_p_admin');
# --------------------------------------------------------
# please respect alpha order when you add new pref


INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('allowRegister','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('anonCanEdit','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_author','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_date','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_expire','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_img','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_reads','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_size','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_title','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_topic','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_type','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('art_list_visible','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('article_comments_default_ordering','points_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('article_comments_per_page','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_create_user_auth','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_create_user_tiki','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_imap_pop3_basedsn','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_adminpass','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_adminuser','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_basedn','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_groupattr','cn');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_groupdn','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_groupoc','groupOfUniqueNames');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_memberattr','uniqueMember');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_memberisdn','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_scope','sub');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_url','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_userattr','uid');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_userdn','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_ldap_useroc','inetOrgPerson');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_method','tiki');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_pear_host','localhost');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_pear_port','389');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_skip_admin','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('auth_type','LDAP');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('available_languages','a:0:{}');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('available_styles','a:0:{}');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_comments_default_ordering','points_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_comments_per_page','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_activity','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_created','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_description','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_lastmodif','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_order','created_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_posts','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_title','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_user','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_list_visits','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('blog_spellcheck','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('cacheimages','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('cachepages','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('calendar_sticky_popup','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('calendar_view_tab','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('change_language','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('change_password','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('change_theme','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('cms_bot_bar','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('cms_left_column','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('cms_right_column','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('cms_spellcheck','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('cms_top_bar','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('contact_anon','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('contact_user','admin');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('count_admin_pvs','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('default_map','pacific.map');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('default_wiki_diff_style', 'minsidediff');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('direct_pagination','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('directory_columns','3');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('directory_cool_sites','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('directory_links_per_page','20');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('directory_open_links','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('directory_validate_urls','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('display_timezone','EST');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('eponymousGroups','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('faq_comments_default_ordering','points_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('faq_comments_per_page','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_article_comments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_articles','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_autolinks','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_babelfish','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_babelfish_logo','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_backlinks','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_banners','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_banning','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_blog_comments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_blog_rankings','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_blogposts_comments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_blogposts_pings','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_blogs','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_bot_bar','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_bot_bar_debug','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_bot_bar_icons','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_calendar','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_categories','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_categoryobjects','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_categorypath','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_challenge','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_charts','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_chat','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_clear_passwords','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_cms_print','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_cms_rankings','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_cms_templates','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_comm','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_contact','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_custom_home','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_debug_console','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_debugger_console','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_detect_language','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_directory','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_drawings','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_dump','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_dynamic_content','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_edit_templates','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_editcss','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_eph','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_faq_comments','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_faqs','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_featuredLinks','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_file_galleries','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_file_galleries_comments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_file_galleries_rankings','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_forum_parse','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_forum_quickjump','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_forum_rankings','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_forum_topicd','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_forums','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_friends','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_gal_batch','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_gal_imgcache','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_gal_rankings','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_gal_slideshow','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_galleries','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_galleries','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_games','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_help','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_history','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_hotwords','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_hotwords_nw','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_html_pages','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_image_galleries_comments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_integrator','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_jscalendar','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_lastChanges','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_left_column','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_likePages','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_listPages','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_live_support','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_maps','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_menusfolderstyle','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_messages','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_minical','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_mobile', 'n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_modulecontrols', 'n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_multilingual', 'n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_newsletters','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_newsreader','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_notepad','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_obzip','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_page_title','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_phplayers','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_poll_anonymous','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_poll_comments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_polls','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_quizzes','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_ranking','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_referer_stats','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_right_column','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_sandbox','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_score','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_search','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_search_fulltext','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_search_stats','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_sheet','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_shoutbox','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_smileys','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_stats','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_submissions','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_surveys','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_tabs','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_tasks','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_theme_control','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_ticketlib','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_ticketlib2','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_top_bar','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_trackbackpings','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_trackers','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_userPreferences','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_userVersions','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_user_bookmarks','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_user_watches','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_user_watches_translations','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_userfiles','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_usermenu','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_view_tpl','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_warn_on_edit','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_webmail','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_allowhtml','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_attachments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_comments','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_description','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_discuss','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_export','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_footnotes','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_import_html', 'n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_import_page', 'n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_monosp','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_multiprint','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_notepad','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_open_as_structure','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_pdf','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_pictures','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_rankings','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_ratings','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_tables','new');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_templates','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_undo','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_userpage','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_userpage_prefix','UserPage');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wiki_usrlock','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wikiwords','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_workflow','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_wysiwyg','no');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('feature_xmlrpc','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_allow_duplicates','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_list_created','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_list_description','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_list_files','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_list_hits','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_list_lastmodif','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_list_name','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_list_user','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_match_regex','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_nmatch_regex','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_use_db','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('fgal_use_dir','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('file_galleries_comments_default_ordering','points_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('file_galleries_comments_per_page','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forgotPass','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forum_list_desc','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forum_list_lastpost','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forum_list_posts','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forum_list_ppd','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forum_list_topics','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forum_list_visits','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('forums_ordering','created_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_batch_dir','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_imgcache_dir','temp/cache');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_list_created','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_list_description','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_list_imgs','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_list_lastmodif','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_list_name','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_list_user','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_list_visits','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_match_regex','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_nmatch_regex','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_use_db','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_use_dir','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('gal_use_lib','gd');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('groupTracker','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('home_file_gallery','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('http_domain','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('http_port','80');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('http_prefix','/');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('https','auto');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('https_domain','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('https_login','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('https_login_required','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('https_port','443');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('https_prefix','/');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('image_galleries_comments_default_order','points_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('image_galleries_comments_per_page','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('keep_versions','1');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('lang_use_db','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('language','en');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('layout_section','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('limitedGoGroupHome','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('long_date_format','%A %d of %B, %Y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('long_time_format','%H:%M:%S %Z');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('mail_crlf','LF');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('map_path','/var/www/html/map/');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('maxArticles','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('maxRecords','25');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('maxVersions','0');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_articles','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_blog','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_blogs','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_directories','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_file_galleries','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_file_gallery','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_forum','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_forums','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_image_galleries','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_image_gallery','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_mapfiles','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_tracker','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('max_rss_wiki','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('min_pass_length','1');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('modallgroups','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('pass_chr_num','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('pass_due','1999');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('poll_comments_default_ordering','points_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('poll_comments_per_page','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('popupLinks','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('proxy_host','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('proxy_port','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('record_untranslated','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('registerPasscode','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rememberme','disabled');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('remembertime','7200');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rnd_num_reg','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_articles','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_blog','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_blogs','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_directories','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_file_galleries','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_file_gallery','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_forum','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_forums','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_image_galleries','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_image_gallery','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_mapfiles','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_tracker','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rss_wiki','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rssfeed_creator','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rssfeed_css','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rssfeed_default_version','2');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rssfeed_editor','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rssfeed_language','en-us');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rssfeed_publisher','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('rssfeed_webmaster','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('search_lru_length','100');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('search_lru_purge_rate','5');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('search_max_syllwords','100');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('search_min_wordlength','3');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('search_refresh_rate','5');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('search_syll_age','48');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('sender_email','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('short_date_format','%a %d of %b, %Y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('short_time_format','%H:%M %Z');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('shoutbox_autolink','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('siteTitle','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('slide_style','slidestyle.css');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('style','tikineat.css');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('system_os','unix');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('t_use_db','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('t_use_dir','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('tikiIndex','tiki-index.php');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('tmpDir','temp');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('trk_with_mirror_tables', 'n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('uf_use_db','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('uf_use_dir','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('urlIndex','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('useRegisterPasscode','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('useUrlIndex','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('use_proxy','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('userTracker','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('user_assigned_modules','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('user_list_order','score_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('userfiles_quota','30');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('validateEmail','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('validateRegistration','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('validateUsers','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('w_use_db','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('w_use_dir','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('warn_on_edit_time','2');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('webmail_max_attachment','1500000');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('webmail_view_html','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('webserverauth','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wikiHomePage','HomePage');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wikiLicensePage','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wikiSubmitNotice','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_bot_bar','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_cache','0');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_comments_default_ordering','points_desc');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_comments_per_page','10');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_creator_admin','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_feature_copyrights','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_forum','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_forum_id','');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_left_column','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_backlinks','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_comment','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_creator','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_hits','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_lastmodif','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_lastver','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_links','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_name','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_size','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_status','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_user','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_list_versions','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_page_regex','strict');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_right_column','y');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_spellcheck','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_top_bar','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_uses_slides','n');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('wiki_wikisyntax_in_html','full');

# default sizes for mailbox, read box and mail archive
# in messages per user and box (0=unlimited)
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('messu_mailbox_size','0');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('messu_archive_size','200');
INSERT IGNORE INTO tiki_preferences(name,value) VALUES ('messu_sent_size','200');

# Dynamic variables

#
# Table structure for table 'tiki_integrator_reps'
#
DROP TABLE IF EXISTS tiki_integrator_reps;
CREATE TABLE tiki_integrator_reps (
  repID int(11) NOT NULL auto_increment,
  name varchar(255) NOT NULL default '',
  path varchar(255) NOT NULL default '',
  start_page varchar(255) NOT NULL default '',
  css_file varchar(255) NOT NULL default '',
  visibility char(1) NOT NULL default 'y',
  cacheable char(1) NOT NULL default 'y',
  expiration int(11) NOT NULL default '0',
  description text NOT NULL,
  PRIMARY KEY  (repID)
) TYPE=MyISAM;

#
# Dumping data for table 'tiki_integrator_reps'
#
INSERT INTO tiki_integrator_reps VALUES ('1','Doxygened (1.3.4) Documentation','','index.html','doxygen.css','n','y','0','Use this repository as rule source for all your repositories based on doxygened docs. To setup yours just add new repository and copy rules from this repository :)');

#
# Table structure for table 'tiki_integrator_rules'
#
DROP TABLE IF EXISTS tiki_integrator_rules;
CREATE TABLE tiki_integrator_rules (
  ruleID int(11) NOT NULL auto_increment,
  repID int(11) NOT NULL default '0',
  ord int(2) unsigned NOT NULL default '0',
  srch blob NOT NULL,
  repl blob NOT NULL,
  type char(1) NOT NULL default 'n',
  casesense char(1) NOT NULL default 'y',
  rxmod varchar(20) NOT NULL default '',
  enabled char(1) NOT NULL default 'n',
  description text NOT NULL,
  PRIMARY KEY  (ruleID),
  KEY repID (repID)
) TYPE=MyISAM;

#
# Dumping data for table 'tiki_integrator_rules'
#
INSERT INTO tiki_integrator_rules VALUES ('1','1','1','.*<body[^>]*?>(.*?)</body.*','\1','y','n','i','y','Extract code between <BODY> tags');
INSERT INTO tiki_integrator_rules VALUES ('2','1','2','img src=(\"|\')(?!http://)','img src=\1{path}/','y','n','i','y','Fix images path');
INSERT INTO tiki_integrator_rules VALUES ('3','1','3','href=(\"|\')(?!(#|(http|ftp)://))','href=\1tiki-integrator.php?repID={repID}&file=','y','n','i','y','Relace internal links to integrator. Dont touch an external links.');

#
# Integrator permissions
#

#
# Table structures for table 'tiki_quicktags'
# 
DROP TABLE IF EXISTS tiki_quicktags;
CREATE TABLE tiki_quicktags (
  tagId int(4) unsigned NOT NULL auto_increment,
  taglabel varchar(255) default NULL,
  taginsert text,
  tagicon varchar(255) default NULL,
  tagcategory varchar(255) default NULL,
  PRIMARY KEY  (tagId),
  KEY tagcategory (tagcategory),
  KEY taglabel (taglabel)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('bold','__text__','images/ed_format_bold.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('italic','\'\'text\'\'','images/ed_format_italic.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('underline','===text===','images/ed_format_underline.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('table','||r1c1|r1c2||r2c1|r2c2||','images/insert_table.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('table new','||r1c1|r1c2\nr2c1|r2c2||','images/insert_table.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('external link','[http://example.com|text]','images/ed_link.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('wiki link','((text))','images/ed_copy.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('heading1','!text','images/ed_custom.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('title bar','-=text=-','images/fullscreen_maximize.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('box','^text^','images/ed_about.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('rss feed','{rss id= }','images/ico_link.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('dynamic content','{content id= }','images/book.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('tagline','{cookie}','images/footprint.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('hr','---','images/ed_hr.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('center text','::text::','images/ed_align_center.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('colored text','~~#FF0000:text~~','images/fontfamily.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('dynamic variable','%text%','images/book.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('image','{img src= width= height= align= desc= link= }','images/ed_image.gif','wiki');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New wms Metadata','METADATA\r\n		\"wms_name\" \"myname\"\r\n 	"wms_srs" "EPSG:4326"\r\n 	"wms_server_version" " "\r\n 	"wms_layers" "mylayers"\r\n 	"wms_request" "myrequest"\r\n 	"wms_format" " "\r\n 	"wms_time" " "\r\n END', 'img/icons/admin_metatags.png','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Class', 'CLASS\r\n EXPRESSION ()\r\n SYMBOL 0\r\n OUTLINECOLOR\r\n COLOR\r\n NAME "myclass" \r\nEND #end of class', 'img/icons/mini_triangle.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Projection','PROJECTION\r\n "init=epsg:4326"\r\nEND','images/ico_mode.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Query','#\r\n# Start of query definitions\r\n#\r\n QUERYMAP\r\n STATUS ON\r\n STYLE HILITE\r\nEND','img/icons/questions.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Scalebar','#\r\n# Start of scalebar\r\n#\r\nSCALEBAR\r\n IMAGECOLOR 255 255 255\r\n STYLE 1\r\n SIZE 400 2\r\n COLOR 0 0 0\r\n UNITS KILOMETERS\r\n INTERVALS 5\r\n STATUS ON\r\nEND','img/icons/desc_length.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Layer','LAYER\r\n NAME\r\n TYPE\r\n STATUS ON\r\n DATA "mydata"\r\nEND #end of layer', 'images/ed_copy.gif', 'maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Label','LABEL\r\n COLOR\r\n ANGLE\r\n FONT arial\r\n TYPE TRUETYPE\r\n POSITION\r\n PARTIALS TRUE\r\n SIZE 6\r\n BUFFER 0\r\n OUTLINECOLOR \r\nEND #end of label', 'img/icons/fontfamily.gif', 'maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Reference','#\r\n#start of reference\r\n#\r\n REFERENCE\r\n SIZE 120 60\r\n STATUS ON\r\n EXTENT -180 -90 182 88\r\n OUTLINECOLOR 255 0 0\r\n IMAGE "myimagedata"\r\n COLOR -1 -1 -1\r\nEND','images/ed_image.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Legend','#\r\n#start of Legend\r\n#\r\n LEGEND\r\n KEYSIZE 18 12\r\n POSTLABELCACHE TRUE\r\n STATUS ON\r\nEND','images/ed_about.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Web','#\r\n# Start of web interface definition\r\n#\r\nWEB\r\n TEMPLATE "myfile/url"\r\n MINSCALE 1000\r\n MAXSCALE 40000\r\n IMAGEPATH "myimagepath"\r\n IMAGEURL "mypath"\r\nEND','img/icons/ico_link.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Outputformat','OUTPUTFORMAT\r\n NAME\r\n DRIVER " "\r\n MIMETYPE "myimagetype"\r\n IMAGEMODE RGB\r\n EXTENSION "png"\r\nEND','img/icons/opera.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('New Mapfile','#\r\n# Start of mapfile\r\n#\r\nNAME MYMAPFLE\r\n STATUS ON\r\nSIZE \r\nEXTENT\r\nUNITS \r\nSHAPEPATH " "\r\nIMAGETYPE " "\r\nFONTSET " "\r\nIMAGECOLOR -1 -1 -1\r\n\r\n#remove this text and add objects here\r\n\r\nEND # end of mapfile','img/icons/global.gif','maps');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('bold', '__text__', 'images/ed_format_bold.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('italic', '\'\'text\'\'', 'images/ed_format_italic.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('underline', '===text===', 'images/ed_format_underline.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('external link', '[http://example.com|text|nocache]', 'images/ed_link.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('heading1', '!text', 'images/ed_custom.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('hr', '---', 'images/ed_hr.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('center text', '::text::', 'images/ed_align_center.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('colored text', '~~#FF0000:text~~', 'images/fontfamily.gif', 'newsletters');
INSERT INTO tiki_quicktags (taglabel, taginsert, tagicon, tagcategory) VALUES ('image', '{img src= width= height= align= desc= link= }', 'images/ed_image.gif', 'newsletters');

#translated objects table
DROP TABLE IF EXISTS tiki_translated_objects;
CREATE TABLE tiki_translated_objects (
  traId int(14) NOT NULL auto_increment,
  type varchar(50) NOT NULL,
  objId varchar(255) NOT NULL,
  lang varchar(16) default NULL,
  PRIMARY KEY (type, objId),
  KEY traId ( traId )
) TYPE=MyISAM AUTO_INCREMENT=1;


#
# Community tables begin
#

DROP TABLE IF EXISTS tiki_friends;
CREATE TABLE tiki_friends (
  user char(40) NOT NULL default '',
  friend char(40) NOT NULL default '',
  PRIMARY KEY  (user,friend)
) TYPE=MyISAM;

DROP TABLE IF EXISTS tiki_friendship_requests;
CREATE TABLE tiki_friendship_requests (
  userFrom char(40) NOT NULL default '',
  userTo char(40) NOT NULL default '',
  tstamp timestamp(14) NOT NULL,
  PRIMARY KEY  (userFrom,userTo)
) TYPE=MyISAM;

DROP TABLE IF EXISTS tiki_score;
CREATE TABLE tiki_score (
  event varchar(40) NOT NULL default '',
  score int(11) NOT NULL default '0',
  expiration int(11) NOT NULL default '0',
  PRIMARY KEY  (event)
) TYPE=MyISAM;


INSERT INTO tiki_score (event, score, expiration) VALUES ('login',1,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('login_remain',2,60);
INSERT INTO tiki_score (event, score, expiration) VALUES ('profile_fill',10,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('profile_see',2,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('profile_is_seen',1,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('friend_new',10,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('message_receive',1,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('message_send',2,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('article_read',2,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('article_comment',5,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('article_new',20,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('article_is_read',1,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('article_is_commented',2,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('fgallery_new',10,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('fgallery_new_file',10,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('fgallery_download',5,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('fgallery_is_downloaded',5,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('igallery_new',10,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('igallery_new_img',6,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('igallery_see_img',3,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('igallery_img_seen',1,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('blog_new',20,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('blog_post',5,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('blog_read',2,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('blog_comment',2,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('blog_is_read',3,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('blog_is_commented',3,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('wiki_new',10,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('wiki_edit',5,0);
INSERT INTO tiki_score (event, score, expiration) VALUES ('wiki_attach_file',3,0);

DROP TABLE IF EXISTS tiki_users_score;
CREATE TABLE tiki_users_score (
  user char(40) NOT NULL default '',
  event_id char(40) NOT NULL default '',
  expire int(14) NOT NULL default '0',
  tstamp timestamp(14) NOT NULL,
  PRIMARY KEY  (user,event_id),
  KEY user (user,event_id,expire)
) TYPE=MyISAM;


#
# Community tables end
#

#
# Table structure for table tiki_file_handlers
#
# Creation: Nov 02, 2004 at 05:59 PM
# Last update: Nov 02, 2004 at 05:59 PM
#

DROP TABLE IF EXISTS tiki_file_handlers;
CREATE TABLE tiki_file_handlers (
	mime_type varchar(64) default NULL,
	cmd varchar(238) default NULL
) TYPE=MyISAM;

#
# Table structure for table tiki_stats
#
# Creation: Aug 04, 2005 at 05:59 PM
# Last update: Aug 04, 2005 at 05:59 PM
#

DROP TABLE IF EXISTS `tiki_stats`;
CREATE TABLE `tiki_stats` (
  `object` varchar(255) NOT NULL default '',
  `type` varchar(20) NOT NULL default '',
  `day` int(14) NOT NULL default '0',
  `hits` int(14) NOT NULL default '0',
  PRIMARY KEY  (`object`,`type`,`day`)
) TYPE=MyISAM;

# --------------------------------------------------------
