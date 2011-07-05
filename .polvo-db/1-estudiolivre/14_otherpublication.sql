--
-- Table structure for table `otherpublication`
--

DROP TABLE IF EXISTS `otherpublication`;
CREATE TABLE `otherpublication` (
  `id` int(11) NOT NULL,
  `typeOfPublication` varchar(255),
  PRIMARY KEY  (`id`),
  KEY `typeOfPublication` (`typeOfPublication`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
