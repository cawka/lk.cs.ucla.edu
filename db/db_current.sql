-- MySQL dump 10.11
--
-- Host: localhost    Database: cawka
-- ------------------------------------------------------
-- Server version	5.0.85

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
-- Table structure for table `bibwiki`
--

DROP TABLE IF EXISTS `bibwiki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bibwiki` (
  `id` int(11) NOT NULL auto_increment,
  `bibtex` text,
  `entry` text,
  `date` date default NULL,
  `pdf` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=355 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bibwiki`
--

LOCK TABLES `bibwiki` WRITE;
/*!40000 ALTER TABLE `bibwiki` DISABLE KEYS */;
INSERT INTO `bibwiki` VALUES (325,'article','@article{id,\nauthor={Alexander Afanasyev and Neil Tilley and Peter Reiher and Leonard Kleinrock},\ntitle={Host-to-host congestion control for {TCP}},\njournal={To appear in IEEE Communication Surveys and Tutorials},\nyear={2010},\nmonth={March},\ncomment={}}','2010-03-01','/data/files/Afanasyev/Host-to-host%20congestion%20control%20for%20TCP.pdf'),(326,'techreport','@techreport{id,\nauthor={Alexander Afanasyev and Neil Tilley and Brent Longstaff and Lixia Zhang},\ntitle={{BGP} Routing Table: Trends and Challenges},\ninstitution={UCLA Computer Science Department},\nyear={2009},\ntype={Technical Report},\ncomment={}}','2009-01-01','/data/files/Afanasyev/BGP%20Routing%20Table%20Trends%20and%20Challenges.pdf'),(329,'phdthesis','@phdthesis{id,\nauthor = {Alexander Afanasyev},\ndate-added = {2009-12-10 23:32:27 -0800},\ndate-modified = {2009-12-10 23:45:28 -0800},\nmonth = {June},\nschool = {Bauman Moscow State Technical University},\ntitle = {Distributed Multimedia Broadcasting System in the Data Transmission Networks},\ntype = {Master Thesis},\nyear = {2007},\n comment = {}}','2007-06-01',NULL),(333,'conference','@conference{id,\nauthor={Alexander Afanasyev},\ntitle={Hardware-Software Complex for Energy Equipment Vibrodiagnostics},\nbooktitle={Proceedings of Conference on Scientific Technologies and Intellectual Systems},\nyear={2005},\naddress={Moscow, Russia},\nmonth={April},\ncomment={}}','2005-04-01',NULL),(334,'conference','@conference{id,\naddress = {Moscow, Russia},\nauthor = {Alexander Afanasyev},\nbooktitle = {Proceedings of Conference on Scientific Technologies and Intellectual Systems},\ndate-added = {2009-12-10 23:39:39 -0800},\ndate-modified = {2009-12-11 00:07:46 -0800},\nmonth = {April},\nrating = {5},\ntitle = {Hardware-Software Complex for Multimedia Content Services in IP Networks},\nyear = {2005},\n comment = {}}','2005-04-01',NULL),(335,'conference','@conference{id,\naddress = {Yakutsk, Russia},\nauthor = {Alexander Afanasyev},\nbooktitle = {Proceeding of Conference on Informational Technologies in Science, Education, and Economics},\ndate-added = {2009-12-10 23:38:37 -0800},\ndate-modified = {2009-12-10 23:50:42 -0800},\nmonth = {February},\ntitle = {Developing Software-Hardware System for Multimedia Broadcasting in Educational Data Networks},\nyear = {2005},\n comment = {}}','2005-02-01',NULL),(336,'conference','@conference{id,\naddress = {Moscow, Russia},\nauthor = {Alexander Afanasyev},\nbooktitle = {Proceeding of the Federal Resulting Scientific and Technical Conference of Creative Russian Youth in Natural, Technical, Humanitarian Science},\ndate-added = {2009-12-10 23:38:09 -0800},\ndate-modified = {2009-12-10 23:51:51 -0800},\nmonth = {December},\ntitle = {Automatic Monitoring System for Big Power Systems},\nyear = {2003},\n comment = {}}','2003-12-01',NULL),(337,'conference','@conference{id,\naddress = {Moscow, Russia},\nauthor = {Knyazev, V. and Alexander Afanasyev},\nbooktitle = {Proceeding of Informatics and Control Systems in 21st Century Conference},\ndate-added = {2009-12-10 23:37:47 -0800},\ndate-modified = {2009-12-10 23:52:36 -0800},\nmonth = {April},\ntitle = {Computer Measurement Laboratory},\nyear = {2003},\n comment = {}}','2003-04-01',NULL),(338,'conference','@conference{id,\nauthor={Alexander Afanasyev},\ntitle={MSTU—Multifunctional Measuring System},\nbooktitle={Proceedings of Conference on Scientific Technologies and Intellectual Systems},\nyear={2003},\naddress={Moscow, Russia},\nmonth={April},\ncomment={}}','2003-04-01',NULL),(339,'misc','@misc{id,\ntitle={Creating a Hardware-Software System for Researches of Active Vibrodefence},\nhowpublished={in report of scientifically research work \"Development of mathematical models and Software and Technical Means for experimental Researches of Systems Active Vibrodefence\"},\nauthor={Alexander Afanasyev},\nyear={2002},\ncomment={}}','2002-01-01',NULL),(342,'techreport','@techreport{id,\nauthor={Alexander Afanasyev and SeungHoon Lee and Uichin Lee and Mario Gerla},\ntitle={Content Distribution in {VANETs} using Network Coding: Comparison of Generation Selection Mechanisms},\ninstitution={UCLA Computer Science Department},\nyear={2009},\ntype={Technical Report},\ncomment={}}','2009-01-01','/data/files/Afanasyev/Content%20Distribution%20in%20VANETs%20using%20Network.pdf'),(343,'conference','@conference{id,\nauthor={Alexander Afanasyev and Keith Mayoral and Zhenkai Zhu and Soon Young Oh},\ntitle={{DTCAST}: Delay and Disruption Tolerant Multicasting Protocol},\nbooktitle={Proceedings of Conference on Scientific Technologies and Intellectual Systems},\nyear={2009},\naddress={Moscow, Russia},\nmonth={April},\ncomment={}}','2009-04-01','/data/files/Afanasyev/DTCAST%20Delay%20and%20Disruption%20Tolerant%20Multicasting.pdf'),(345,'conference','@conference{id,\nauthor={Alexander Afanasyev},\ntitle={Multimedia Content Capturing Hardware For {IP} Broadcasting Uses Analysis},\nbooktitle={Proceedings of Conference on Scientific Technologies and Intellectual Systems},\nyear={2006},\naddress={Moscow, Russia},\nmonth={April},\ncomment={}}','2006-04-01',NULL),(346,'conference','@conference{id,\nauthor={Alexander Afanasyev},\ntitle={Software-Hardware System for Multimedia Broadcasting in Data Transmission Networks},\nbooktitle={Proceeding of Informational and Telecommunication Systems Competition (All-Russia competition of innovative projects of graduate students)},\nyear={2005},\naddress={Moscow, Russia},\nmonth={December},\ncomment={}}','2005-12-01',NULL),(347,'phdthesis','@phdthesis{id,\nauthor = {Alexander Afanasyev},\ndate-added = {2009-12-10 23:31:48 -0800},\ndate-modified = {2009-12-10 23:45:28 -0800},\nmonth = {July},\nschool = {Bauman Moscow State Technical University},\ntitle = {Researching of Methods and Development of Means of Multimedia Broadcasting in Data Transmission Networks},\ntype = {Bachelors Thesis},\nyear = {2005},\n comment = {}}','2005-07-01',NULL);
/*!40000 ALTER TABLE `bibwiki` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `name` text,
  `link` text,
  `display_order` int(11) default NULL,
  `width` text,
  `target` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (24,NULL,'About','/index.html',1,NULL,NULL),(25,NULL,'Profile','/profile.html',2,NULL,NULL),(26,NULL,'Awards','/awards.html',3,NULL,NULL),(27,NULL,'Publications','/bibwiki/',4,NULL,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `publ_begin` date default NULL,
  `publ_end` date default NULL,
  `top` tinyint(1) default NULL,
  `subject` text,
  `body` text,
  `image` text,
  PRIMARY KEY  (`id`),
  KEY `news_date` (`publ_begin`,`publ_end`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `set_id` int(11) NOT NULL auto_increment,
  `set_name` varchar(255) NOT NULL,
  `set_value` text,
  PRIMARY KEY  (`set_id`),
  UNIQUE KEY `settings_set_name_key` (`set_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (4,'theme','moderna'),(5,'index','/index.html');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_pages`
--

DROP TABLE IF EXISTS `static_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_pages` (
  `id` varchar(255) NOT NULL,
  `sp_title` text,
  `sp_meta` text,
  `sp_text` text,
  `sp_meta_descr` text,
  `sp_top_figure` text,
  `lastmodified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_pages`
--

LOCK TABLES `static_pages` WRITE;
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
INSERT INTO `static_pages` VALUES ('index','Alexander Afanasyev\'s Home Page',NULL,NULL,NULL,NULL,'2009-12-16 20:15:35');
/*!40000 ALTER TABLE `static_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `texts`
--

DROP TABLE IF EXISTS `texts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `texts` (
  `id` int(11) NOT NULL auto_increment,
  `text` text,
  `lastmodified` datetime default NULL,
  `page_id` varchar(255) default NULL,
  `page_block` int(11) default NULL COMMENT '0 - main block, 1 - menu block',
  PRIMARY KEY  (`id`),
  KEY `texts_page_id` (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `texts`
--

LOCK TABLES `texts` WRITE;
/*!40000 ALTER TABLE `texts` DISABLE KEYS */;
INSERT INTO `texts` VALUES (33,'<p>\n	I was born in a small town called Liepaya that is situated on the shore of the Baltic Sea in Latvia.</p>\n<p>\n	I received my B.Tech. (бакалавр технологий) and M.Tech. (магистр технологий) degrees in Computer Science from <a href=\"http://www.bmstu.ru/english/common.html\" target=\"_blank\">Bauman Moscow State Technical University</a> (Московский Государственный Технический Университет им.Н.Э.Баумана, факультет Информатика и Системы Управления, <a href=\"http://iu4.bmstu.ru/\" target=\"_blank\">кафедра ИУ4</a>), Moscow, Russia in 2005 and 2007, respectively.</p>\n<p>\n	Currently I&#39;m working towards my Ph.D. degree in <a href=\"http://www.cs.ucla.edu\" target=\"_blank\">Computer Science at the University of California, Los Angeles</a> in the <a href=\"http://www.lasr.cs.ucla.edu\" target=\"_blank\">Laboratory for Advanced System Research</a>, advised by Drs. <a href=\"http://www.lasr.cs.ucla.edu/reiher.new/index2.html\" target=\"_blank\">Peter Reiher</a> and <a href=\"http://www.lk.cs.ucla.edu\" target=\"_blank\">Leonard Kleinrock</a>. My research interests include network systems, network security, mobile systems, multimedia systems, and peer-to-peer environments.</p>\n',NULL,'index',0),(34,'<h5>\n	Alexander Afanasyev</h5>\n<p>\n	3564 Boelter Hall <br />\n	Computer Science Department <br />\n	University of California at Los Angeles (UCLA) <br />\n	Los Angeles, CA 90095</p>\n<p>\n	Email: <a href=\"http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\" onclick=\"window.open(\'http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\', \'\', \'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300\'); return false;\" title=\"Reveal this e-mail address\">my email address</a> <br />\n	Phone: +1-310-825-8899 <br />\n	Fax: +1-310-825-7578</p>\n',NULL,'index',1);
/*!40000 ALTER TABLE `texts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `texts_history`
--

DROP TABLE IF EXISTS `texts_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `texts_history` (
  `id` int(11) NOT NULL auto_increment,
  `text_id` int(11) default NULL,
  `modified` datetime default NULL,
  `text` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `texts_history`
--

LOCK TABLES `texts_history` WRITE;
/*!40000 ALTER TABLE `texts_history` DISABLE KEYS */;
INSERT INTO `texts_history` VALUES (24,34,'2009-12-16 20:11:53','<h1>\n	Alexander Afanasyev</h1>\n<p>\n	3564 Boelter Hall <br />\n	Computer Science Department <br />\n	University of California at Los Angeles (UCLA) <br />\n	Los Angeles, CA 90095</p>\n<p>\n	Email: <a href=\"http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\" onclick=\"window.open(\'http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\', \'\', \'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300\'); return false;\" title=\"Reveal this e-mail address\">my email address</a> <br />\n	Phone: +1-310-825-8899 <br />\n	Fax: +1-310-825-7578</p>\n'),(25,34,'2009-12-16 20:13:36','<h2>\n	Contacts</h2>\n<p>\n	3564 Boelter Hall <br />\n	Computer Science Department <br />\n	University of California at Los Angeles (UCLA) <br />\n	Los Angeles, CA 90095</p>\n<p>\n	Email: <a href=\"http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\" onclick=\"window.open(\'http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\', \'\', \'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300\'); return false;\" title=\"Reveal this e-mail address\">my email address</a> <br />\n	Phone: +1-310-825-8899 <br />\n	Fax: +1-310-825-7578</p>\n'),(26,34,'2009-12-16 20:15:35','<h5>\n	Contacts</h5>\n<p>\n	3564 Boelter Hall <br />\n	Computer Science Department <br />\n	University of California at Los Angeles (UCLA) <br />\n	Los Angeles, CA 90095</p>\n<p>\n	Email: <a href=\"http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\" onclick=\"window.open(\'http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=\', \'\', \'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300\'); return false;\" title=\"Reveal this e-mail address\">my email address</a> <br />\n	Phone: +1-310-825-8899 <br />\n	Fax: +1-310-825-7578</p>\n');
/*!40000 ALTER TABLE `texts_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (1,'Admin');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_rights`
--

DROP TABLE IF EXISTS `user_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL auto_increment,
  `controller_id` text,
  `allow_action` text,
  `user_group_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_rights`
--

LOCK TABLES `user_rights` WRITE;
/*!40000 ALTER TABLE `user_rights` DISABLE KEYS */;
INSERT INTO `user_rights` VALUES (1,'staticPages','show',NULL),(3,'publications','show',NULL),(4,'publications','index',NULL),(7,'login','index',NULL),(8,'login','login',NULL),(9,'login','logout',NULL),(10,'index','index',NULL),(11,'bibwiki','index',NULL),(12,'bibwiki','bibtex',NULL);
/*!40000 ALTER TABLE `user_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `u_login` varchar(255) default NULL,
  `u_passwd` text,
  `u_name` text,
  `u_lastlogin` datetime default NULL,
  `u_email` text,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `users_u_login_key` (`u_login`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','ZxyxPx8P','','0000-00-00 00:00:00','2009-12-16 18:19:49');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-12-16 21:14:48
