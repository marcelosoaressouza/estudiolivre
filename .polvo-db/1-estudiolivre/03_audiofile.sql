--
-- Table structure for table `audiofile`
--

DROP TABLE IF EXISTS `audiofile`;
CREATE TABLE `audiofile` (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `bpm` int(11) NOT NULL,
  `sampleRate` int(11) NOT NULL,
  `bitRate` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
