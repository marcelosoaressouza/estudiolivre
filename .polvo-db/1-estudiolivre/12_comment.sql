--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL auto_increment,
  `publicationId` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `comment` text,
  `date` int(11),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
