--
-- Table structure for table `imagepublication`
--

DROP TABLE IF EXISTS `imagepublication`;
CREATE TABLE `imagepublication` (
  `id` int(11) NOT NULL,
  `typeOfImage` varchar(255),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
