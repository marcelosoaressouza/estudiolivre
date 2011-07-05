--
-- Table structure for table `textpublication`
--

DROP TABLE IF EXISTS `textpublication`;
CREATE TABLE `textpublication` (
  `id` int(11) NOT NULL,
  `typeOfText` varchar(255),
  `language` varchar(255),
  `pages` int(11),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
