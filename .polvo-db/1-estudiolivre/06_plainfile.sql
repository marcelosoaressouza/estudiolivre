--
-- Table structure for table `plainfile`
--

DROP TABLE IF EXISTS `plainfile`;
CREATE TABLE `plainfile` (
  `id` int(11) NOT NULL,
  `typeOfFile` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `typeOfFile` (`typeOfFile`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
