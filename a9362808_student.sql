-- MySQL dump 10.13  Distrib 5.1.57, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: a9362808_student
-- ------------------------------------------------------
-- Server version	5.1.57
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `feedurl`
--

DROP TABLE IF EXISTS `feedurl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedurl` (
  `feed` text COLLATE latin1_general_ci NOT NULL,
  `recent` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`recent`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedurl`
--

LOCK TABLES `feedurl` WRITE;
/*!40000 ALTER TABLE `feedurl` DISABLE KEYS */;
INSERT INTO `feedurl` VALUES ('https://rtcamp.com/feed/',62),('omgubuntu.co.uk',70),('http://www.sissangli.com/feed/',57),('http://feeds.feedburner.com/ndtv/videos',67),('http://www.sciencemag.org/rss/current.xml',68),('http://feeds.hindustantimes.com/HT-India',66),('http://feeds.nbcnews.com/feeds/topstories',64),('http://feeds.bbci.co.uk/news/rss.xml?edition=int',63);
/*!40000 ALTER TABLE `feedurl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-04 13:59:15
