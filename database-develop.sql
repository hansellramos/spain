-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: spain
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'admin','62ec65bac0a0db4d6f94611eb7ec5a02','User','Admin',1,'2017-10-09 10:35:40'),(2,'asd','62ec65bac0a0db4d6f94611eb7ec5a02','aaaaa','bbbb',0,'2017-10-09 15:23:45'),(3,'asd','62ec65bac0a0db4d6f94611eb7ec5a02','aaaaa','bbbb',0,'2017-10-09 15:25:06'),(4,'123','54a2ec5f4421fa24bfa9bf6461e649a2','789','012',1,'2017-10-09 17:31:52'),(5,'123','54a2ec5f4421fa24bfa9bf6461e649a2','789','012',1,'2017-10-09 17:32:40'),(6,'123','54a2ec5f4421fa24bfa9bf6461e649a2','789','012',1,'2017-10-09 17:33:09'),(7,'ppp','d4fbb7d8d5603db43ac2094f5955787c','ooo','ddd',0,'2017-10-09 17:33:38'),(8,'ddd','b176ad7e7753a1c24751490097ad292e','uuu','bbb',0,'2017-10-09 17:34:37'),(9,'ghjk','ac971e98272704a7fba6c273093c9490','yhj','gh',0,'2017-10-09 17:36:12'),(10,'tuyioipo','df1ac462402f6db34661dc2a00633cd1','hjh','vbn',0,'2017-10-09 17:59:18'),(11,'ghjkl','c5e4d3d2222aff6e69c9e02584d95751','fhgjh','uyio',0,'2017-10-09 17:59:40'),(12,'dfghjkfhvbj','3c5b5f6a4a672ff33ed7ca82ceb13e76','gfvhjbnklm','vfghjblkm',0,'2017-10-09 18:00:19'),(13,'jkaskd','53e0fded064384b0b3067a8f9e3d5d00','pmpk','pkm',0,'2017-10-09 18:00:41'),(14,'jhkl','c5e4d3d2222aff6e69c9e02584d95751','hgjk','hgjk',0,'2017-10-09 18:04:32');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (1,'la cafeteria de ARELY',6.20767130,-75.56391480,'2017-10-07 18:38:53'),(2,'Restaurante La Rue',6.20775040,-75.56394410,'2017-10-07 18:39:12'),(3,'La Rue Bistro Bar',6.20772840,-75.56386530,'2017-10-07 18:47:48'),(4,'Brasas Parrilla Bar (Llano Grande) En Viscaya El Poblado',6.20860830,-75.56346220,'2017-10-07 18:47:48'),(5,'Coffetech',6.20855100,-75.56373650,'2017-10-07 18:47:48'),(6,'harry\'s deli snacks',6.20860830,-75.56346220,'2017-10-07 18:47:48'),(7,'Dolce Aroma Cafe',6.20833700,-75.56338840,'2017-10-07 18:47:48'),(8,'Jenos Pizza Vizcaya',6.20829250,-75.56315210,'2017-10-07 18:47:48'),(9,'Subway',6.20808800,-75.56333250,'2017-10-07 18:47:48'),(10,'Buñuelos San Lucas',6.20818140,-75.56326610,'2017-10-07 18:47:48'),(11,'Juan Valdez Cafe Vizcaya',6.20805970,-75.56326410,'2017-10-07 18:47:48'),(12,'KDV',40.96575940,-5.66105850,'2017-10-08 01:15:24'),(13,'Gran Hotel Corona Sol',40.96894870,-5.67061040,'2017-10-10 00:49:59');
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracks`
--

DROP TABLE IF EXISTS `tracks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tracks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `entrance_site` varchar(200) NOT NULL,
  `entrance_datetime` datetime NOT NULL,
  `move_site` varchar(200) DEFAULT NULL,
  `move_datetime` datetime DEFAULT NULL,
  `exit_site` varchar(200) DEFAULT NULL,
  `exit_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracks`
--

LOCK TABLES `tracks` WRITE;
/*!40000 ALTER TABLE `tracks` DISABLE KEYS */;
INSERT INTO `tracks` VALUES (1,'hansel','ramos','1','2017-10-08 00:02:06',NULL,NULL,NULL,NULL),(2,'Mayha','ramos','2','2017-10-08 00:03:52',NULL,NULL,NULL,NULL),(4,'Uno','Dos','0','2017-10-08 20:15:28',NULL,NULL,NULL,NULL),(5,'tres','cuatro','0','2017-10-08 20:16:30',NULL,NULL,NULL,NULL),(6,'cinco','seis','0','2017-10-08 20:17:59',NULL,NULL,NULL,NULL),(7,'New','Site','la cafeteria de ARELY','2017-10-08 22:40:00',NULL,NULL,NULL,NULL),(8,'User','Admin','Juan Valdez Cafe Vizcaya','2017-10-09 13:06:43',NULL,NULL,'la cafeteria de ARELY','2017-10-09 22:46:06'),(9,'User','Admin','Juan Valdez Cafe Vizcaya','2017-10-09 17:45:41',NULL,NULL,'la cafeteria de ARELY','2017-10-09 22:46:00'),(10,'User','Admin','Juan Valdez Cafe Vizcaya','2017-10-09 17:53:40',NULL,NULL,'la cafeteria de ARELY','2017-10-09 22:45:26'),(11,'User','Admin','Subway','2017-10-09 17:54:03','la cafeteria de ARELY','2017-10-09 22:45:11','la cafeteria de ARELY','2017-10-09 22:45:17'),(12,'User','Admin','Buñuelos San Lucas','2017-10-09 17:54:57','la cafeteria de ARELY','2017-10-09 22:32:33','la cafeteria de ARELY','2017-10-09 22:45:02'),(13,'User','Admin','Juan Valdez Cafe Vizcaya','2017-10-09 17:57:34','Cafetería','2017-05-29 23:00:01','la cafeteria de ARELY','2017-10-09 22:44:55'),(14,'User','Admin','Juan Valdez Cafe Vizcaya','2017-10-09 18:04:53','la cafeteria de ARELY','2017-10-09 22:36:45','Restaurante La Rue','2017-10-09 22:37:04'),(15,'User','Admin','la cafeteria de ARELY','2017-10-09 22:46:27',NULL,NULL,'La Rue Bistro Bar','2017-10-09 22:46:34'),(16,'User','Admin','la cafeteria de ARELY','2017-10-10 00:38:18',NULL,NULL,'la cafeteria de ARELY','2017-10-10 00:38:32'),(17,'User','Admin','La Rue Bistro Bar','2017-10-10 00:38:40','la cafeteria de ARELY','2017-10-10 00:38:47','La Rue Bistro Bar','2017-10-10 00:38:55');
/*!40000 ALTER TABLE `tracks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-10  0:50:22
