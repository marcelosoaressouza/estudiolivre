--
-- Table structure for table `videofile`
--

DROP TABLE IF EXISTS `videofile`;
CREATE TABLE `videofile` (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `hasAudio` tinyint(1) NOT NULL DEFAULT 1,
  `hasColor` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY  (`id`),
  KEY `hasAudio` (`hasAudio`),
  KEY `hasColor` (`hasColor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
