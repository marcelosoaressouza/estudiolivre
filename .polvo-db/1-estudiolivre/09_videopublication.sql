--
-- Table structure for table `videopublication`
--

DROP TABLE IF EXISTS `videopublication`;
CREATE TABLE `videopublication` (
  `id` int(11) NOT NULL,
  `language` varchar(255),
  `subtitled` tinyint(1),
  `subtitleLanguage` varchar(255),
  `details` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
