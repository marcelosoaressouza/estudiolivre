--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(11) NOT NULL auto_increment,
  `publicationId` int(11) NOT NULL,
  `user` char(40) NOT NULL,
  `rating` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`,`publicationId`,`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
