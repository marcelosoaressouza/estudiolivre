--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE `publication` (
  `id` int(11) NOT NULL auto_increment,
  `actualClass` varchar(255) NOT NULL,
  `licenseId` int(11) NOT NULL,
  `collectionId` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `publishDate` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `mainFile` int(11) default NULL,
  `copyrightOwner` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `allFile` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user` (`user`),
  KEY `publishDate` (`publishDate`),
  KEY `author` (`author`),
  KEY `title` (`title`),
  FULLTEXT KEY `description` (`description`),
  KEY `rating` (`rating`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
