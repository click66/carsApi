-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: carsApi
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.12.04.1

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
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(10) CHARACTER SET utf8 NOT NULL,
  `model_id` int(11) DEFAULT NULL,
  `colour` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_model_idx` (`model_id`),
  CONSTRAINT `car_model` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'CRE 8R',1,'Red',1991),(3,'M100 STT',NULL,'Silver',2002),(4,'C 3P0',NULL,'Gold',NULL),(5,'R2 D2',NULL,'Blue',NULL),(8,'HF04 TBF',1,'Silver',2015);
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `slogan` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'Abarth',NULL),(2,'Alfa Romeo','	La meccanica delle emozioni'),(3,'Aston Marton','Power, beauty and soul.'),(4,'Audi','Vorsprung Durch Technik'),(5,'Bentley',NULL),(6,'BMW','Sheer Driving Pleasure'),(7,'Chevrolet','Find New Roads'),(8,'Chrysler',NULL),(9,'Citroen','Créative Technologie'),(10,'Dacia',NULL),(11,'Dodge',NULL),(12,'PDS',NULL),(13,'FErrari',NULL),(14,'Fiat',NULL),(15,'Ford','Go Further'),(16,'Honda',NULL),(17,'Hyundai',NULL),(18,'Infiniti',NULL),(19,'Jaguar',NULL),(20,'Jeep',NULL),(21,'Kia',NULL),(22,'Lamborghini',NULL),(23,'Land Rover',NULL),(24,'Lexus',NULL),(25,'Lotus',NULL),(26,'Maserati',NULL),(27,'Mazda',NULL),(28,'McLaren',NULL),(29,'Mercedes',NULL),(30,'MG',NULL),(31,'MINI',NULL),(32,'Mitsubishi',NULL),(33,'Nissan',NULL),(34,'Perodua',NULL),(35,'Peugot',NULL),(36,'Porsche',NULL),(37,'Proton',NULL),(38,'Renault',NULL),(39,'Rolls-Royce',NULL),(40,'SEAT',NULL),(41,'Skoda',NULL),(42,'Smart',NULL),(43,'SsangYong',NULL),(44,'Subaru',NULL),(45,'Suzuki',NULL),(46,'Tesla',NULL),(47,'Toyota','Let\'s Go Places'),(48,'Vauxhall',NULL),(49,'Volkswagen',NULL),(50,'Volvo',NULL);
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,3,'Vanquish'),(2,4,'TT'),(3,15,'Focus');
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-22  0:19:15
