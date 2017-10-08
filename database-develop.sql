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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (1,'la cafeteria de ARELY',6.20767130,-75.56391480,'2017-10-07 18:38:53'),(2,'Restaurante La Rue',6.20775040,-75.56394410,'2017-10-07 18:39:12'),(3,'La Rue Bistro Bar',6.20772840,-75.56386530,'2017-10-07 18:47:48'),(4,'Brasas Parrilla Bar (Llano Grande) En Viscaya El Poblado',6.20860830,-75.56346220,'2017-10-07 18:47:48'),(5,'Coffetech',6.20855100,-75.56373650,'2017-10-07 18:47:48'),(6,'harry''s deli snacks',6.20860830,-75.56346220,'2017-10-07 18:47:48'),(7,'Dolce Aroma Cafe',6.20833700,-75.56338840,'2017-10-07 18:47:48'),(8,'Jenos Pizza Vizcaya',6.20829250,-75.56315210,'2017-10-07 18:47:48'),(9,'Subway',6.20808800,-75.56333250,'2017-10-07 18:47:48'),(10,'Buñuelos San Lucas',6.20818140,-75.56326610,'2017-10-07 18:47:48'),(11,'Juan Valdez Cafe Vizcaya',6.20805970,-75.56326410,'2017-10-07 18:47:48');
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `site` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_site_idx` (`site`),
  CONSTRAINT `fk_user_site` FOREIGN KEY (`site`) REFERENCES `sites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2017-10-07 20:04:51
