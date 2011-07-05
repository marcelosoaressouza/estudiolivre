--
-- Table structure for table `zipfile`
--

DROP TABLE IF EXISTS `zipfile`;
CREATE TABLE `zipfile` (
  `id` int(11) NOT NULL,
  `commandLine` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `commandLine` (`commandLine`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
