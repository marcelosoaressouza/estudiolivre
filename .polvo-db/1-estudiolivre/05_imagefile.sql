--
-- Table structure for table `imagefile`
--

DROP TABLE IF EXISTS `imagefile`;
CREATE TABLE `imagefile` (
  `id` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `dpi` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
