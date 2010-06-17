-- MySQL dump 10.13  Distrib 5.1.45, for apple-darwin10.2.0 (i386)
--
-- Host: localhost    Database: lk
-- ------------------------------------------------------
-- Server version	5.1.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text,
  `title` text,
  `bold_title` text,
  `descr` text,
  `link` text,
  `years` text,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (3,'awards','National Medal of Science',NULL,NULL,'http://www.nsf.gov/od/nms/medal.jsp','2007',NULL),(4,'awards','Test of Time Award, ACM',NULL,NULL,NULL,'2006',NULL),(5,'awards','Communications and Computer Prize, NEC C&C',NULL,NULL,NULL,'2005',NULL),(6,'awards','National Academy of Engineering Charles Stark Draper Prize',NULL,NULL,'http://www.nae.edu/Awards/DraperPrize/PastWinners/page2001.aspx','2001',NULL),(7,'awards','The Okawa Prize',NULL,'for \"outstanding contributions to queueing theory and packet-switching theory, the foundation technology of the Internet.\"',NULL,'2001',NULL),(8,'awards','The IEEE Internet Award',NULL,NULL,NULL,'2000',NULL),(9,'awards','The INFORMS Presidents Award',NULL,NULL,NULL,'1999',NULL),(10,'awards','IEEE Harry M. Goode Award',NULL,NULL,NULL,'1996',NULL),(11,'awards','ACM SIGMA Xi Monie A. Ferst Award',NULL,NULL,NULL,'1996',NULL),(12,'awards','UCLA Faculty Research Lecturer',NULL,NULL,NULL,'1995',NULL);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-05-30  0:02:09
