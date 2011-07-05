--
-- Table structure for table `license`
--

DROP TABLE IF EXISTS `license`;
CREATE TABLE `license` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(64) NOT NULL,
  `name` varchar(96) default NULL,
  `description` text,
  `imageName` varchar(150) default NULL,
  `humanReadableLink` varchar(150) default NULL,
  `answer` varchar(10) default NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `license`
--

/*!40000 ALTER TABLE `license` DISABLE KEYS */;
LOCK TABLES `license` WRITE;
INSERT INTO `license` VALUES (1,'Sampling','Sampling','','iLicSampling.png','http://creativecommons.org/licenses/sampling/1.0/br/',''),(2,'Sampling','Sampling Plus','Você pode samplear, mesclar ou transformar a obra para fins comerciais e não-comerciais. É permitido executar, exibir e distribuir cópias desta obra para fins não-comerciais.','iLicSamplingPlus.png','http://creativecommons.org/licenses/sampling+/1.0/br/','11'),(3,'Sampling','Sampling Plus Non-Comercial','Você pode samplear, mesclar, transformar, executar, exibir e distribuir cópias desta obra para fins não-comerciais.','iLicSamplingPlusNc.png','http://creativecommons.org/licenses/nc-sampling+/1.0/br/','01'),(4,'Atribution','Atribution','Você pode copiar, distribuir, exibir e executar, alterar, transformar ou utilizar esta obra para criar outra obra com base nesta, para fins comerciais e não-comerciais.','iLicBy.png','http://creativecommons.org/licenses/by/2.5/br/','101'),(5,'Atribution','Atribution Non-Comercial','Você pode copiar, distribuir, exibir e executar, alterar, transformar ou utilizar esta obra para criar outra obra com base nesta, para fins não-comerciais.','iLicByNc.png','http://creativecommons.org/licenses/by-nc/2.5/br/','001'),(6,'Atribution','Atribution Non-Comercial No Derivatives','Você pode copiar, distribuir, exibir e executar esta obra para fins não-comerciais, mas não pode alterá-la, transformá-la ou utilizá-la para criar outra obra com base nesta.','iLicByNcNd.png','http://creativecommons.org/licenses/by-nc-nd/2.5/br/','000'),(7,'Atribution','Atribution Non-Comercial Share-Alike','Você pode copiar, distribuir, exibir e executar, alterar, transformar ou utilizar esta obra para criar outra obra com base nesta, para fins não-comerciais, mas deverá publicá-la pela mesma licença.','iLicByNcSa.png','http://creativecommons.org/licenses/by-nc-sa/2.5/br/','002'),(8,'Atribution','Atribution No Derivatives','Você pode copiar, distribuir, exibir e executar esta obra para fins comerciais e não-comerciais, mas não pode alterá-la, transformá-la ou utilizá-la para criar outra obra com base nesta.','iLicByNd.png','http://creativecommons.org/licenses/by-nd/2.5/br/','100'),(9,'Atribution','Atribution Share-Alike','Você pode copiar, distribuir, exibir e executar, alterar, transformar ou utilizar esta obra para criar outra obra com base nesta, para fins comerciais e não-comerciais, mas deverá publicá-la pela mesma licença.','iLicBySa.png','http://creativecommons.org/licenses/by-sa/2.5/br/','102');
UNLOCK TABLES;
/*!40000 ALTER TABLE `license` ENABLE KEYS */;
