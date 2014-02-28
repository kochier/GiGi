-- MySQL dump 10.13  Distrib 5.1.66, for debian-linux-gnu (x86_64)
--
-- Host: testhn.absurdity981.com    Database: 
-- ------------------------------------------------------
-- Server version	5.1.56-log

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
-- Current Database: `gigitest_absurdity981_map`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `gigitest_absurdity981_map` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `gigitest_absurdity981_map`;

--
-- Table structure for table `captchas`
--

DROP TABLE IF EXISTS `captchas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `captchas` (
  `Question` varchar(251) DEFAULT NULL,
  `Answer` varchar(251) DEFAULT NULL,
  `Number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Number`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `captchas`
--

LOCK TABLES `captchas` WRITE;
/*!40000 ALTER TABLE `captchas` DISABLE KEYS */;
INSERT INTO `captchas` (`Question`, `Answer`, `Number`) VALUES ('Type &quot;blue&quot; backwards.','eulb',4),('Type &quot;red&quot; backwards.','der',3);
/*!40000 ALTER TABLE `captchas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `Pname` varchar(31) DEFAULT NULL,
  `Comment` varchar(2501) DEFAULT NULL,
  `Url` varchar(100) DEFAULT NULL,
  `Created` varchar(30) DEFAULT NULL,
  `Number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Number`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_tags`
--

DROP TABLE IF EXISTS `image_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_tags` (
  `Tag` varchar(51) DEFAULT NULL,
  `Image_url` varchar(251) NOT NULL DEFAULT '',
  `Pending` int(3) NOT NULL,
  `Number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Number`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_tags`
--

LOCK TABLES `image_tags` WRITE;
/*!40000 ALTER TABLE `image_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `Title` varchar(100) DEFAULT NULL,
  `Src` varchar(100) NOT NULL DEFAULT '',
  `Url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Src`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map` (
  `Created` date DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Pathname` varchar(90) NOT NULL DEFAULT '',
  `Map` int(6) DEFAULT NULL,
  `Modified` int(11) DEFAULT NULL,
  `Child` int(6) DEFAULT NULL,
  `Parent` int(6) DEFAULT NULL,
  PRIMARY KEY (`Pathname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map`
--

LOCK TABLES `map` WRITE;
/*!40000 ALTER TABLE `map` DISABLE KEYS */;
INSERT INTO `map` (`Created`, `Name`, `Pathname`, `Map`, `Modified`, `Child`, `Parent`) VALUES ('2013-05-30','Sitemap Database Form','library/form.php',23,1373950118,0,0),('2013-05-28','Admin Index','library/index.php',23,1373949758,0,0),('2013-05-28','Database Upload (Big Dump)','library/bigdump.php',23,1373903651,0,0),('2013-05-30','Database Backup','library/backup.php',23,1373910298,0,0),('2013-05-28','Main','index.php',1,1373863033,2,0),('2013-05-30','Drafts','library/drafts.php',23,1373910327,24,0),('2013-05-30','Codes','library/codes.php',23,1373909489,0,0),('2013-05-30','Edit A Page','library/edit.php',23,1373949771,0,0),('2013-05-30','Upload An Image','library/adminimages.php',23,1373950024,0,0),('2013-05-30','Edit Image Database','library/editimage.php',23,1373949800,0,0),('2013-05-30','Edit Video Database','library/videoedit.php',23,1373949833,0,0),('2013-05-30','Upload A Video','library/adminvideo.php',23,1373950082,0,0),('2013-05-30','Manage Comments','library/comment.php',23,1373948631,0,0),('2013-05-30','Manage Catergories','library/categoryedit.php',23,1373949889,0,0),('2013-05-30','Manage Captcha','library/captcha.php',23,1373949861,0,0),('2013-05-30','Edit Stylesheet','library/editstyle.php',23,1373906581,0,0),('2013-05-30','404 Error: Page Not Found','404.php',22,1373910560,0,0),('2013-05-30','403 Error: Forbidden Page','403.php',22,1373910572,0,0),('2013-05-30','401 Error: Unauthorized','401.php',22,1373910597,0,0),('2013-05-30','Blog','blog.php',25,1373910458,18,2),('2013-05-30','2013','blog_2013.php',18,1375210395,30,25),('2013-05-30','2013','news_2013.php',19,1373949051,31,25),('2013-05-30','Self','self.php',2,1373910473,25,1),('2013-05-30','News','news.php',25,1373910466,19,2),('2013-05-30','Images','images.php',2,1373910496,40,1),('2013-05-30','Videos','videos.php',2,1373910447,50,1),('2013-05-30','About','about.php',25,1373910533,0,2),('2013-05-30','Contact','contact.php',25,1373910546,0,2),('2013-05-30','Sitemap','sitemap.php',25,1373910584,0,2),('2013-06-01','Random','rand_image_gallery.php',40,1373910484,41,2),('2013-06-01','Random','rand_video_gallery.php',50,1373910488,51,2),('2013-07-30','Log','library/log.php',23,1375210391,0,0),('2014-02-21','Manage Video Tags','library/manage_video_tags.php',23,NULL,0,0),('2014-02-21','Manage Image Tags','library/manage_image_tags.php',23,NULL,0,0),('2014-02-23','Search Video Tags','search_video_tags.php',25,NULL,0,2),('2014-02-23','Search Image Tags','search_image_tags.php',25,NULL,0,2);
/*!40000 ALTER TABLE `map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `Name` varchar(255) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Src` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Src`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_tags`
--

DROP TABLE IF EXISTS `video_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_tags` (
  `Tag` varchar(51) DEFAULT NULL,
  `Video_url` varchar(251) NOT NULL DEFAULT '',
  `Pending` int(3) NOT NULL,
  `Number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Number`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_tags`
--

LOCK TABLES `video_tags` WRITE;
/*!40000 ALTER TABLE `video_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-23  7:43:44
