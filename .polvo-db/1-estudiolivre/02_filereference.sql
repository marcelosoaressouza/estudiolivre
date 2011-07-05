--
-- Table structure for table `filereference`
--

DROP TABLE IF EXISTS `filereference`;
CREATE TABLE `filereference` (
  `id` int(11) NOT NULL auto_increment,
  `actualClass` varchar(255) NOT NULL,
  `publicationId` int(11) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `credits` varchar(255) default NULL,
  `thumbnail` varchar(255) NOT NULL,
  `mimeType` varchar(50) NOT NULL,
  `size` int(40) NOT NULL,
  `downloads` int(11) NOT NULL,
  `streams` int(11) NOT NULL,
  PRIMARY KEY  (`id`,`publicationId`),
  KEY `fileName` (`fileName`),
  KEY `mimeType` (`mimeType`),
  KEY `size` (`size`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
