CREATE DATABASE  IF NOT EXISTS `diat` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci */;
USE `diat`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: diat
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.22-MariaDB

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
-- Table structure for table `bitacoras`
--

DROP TABLE IF EXISTS `bitacoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacoras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacoras`
--

LOCK TABLES `bitacoras` WRITE;
/*!40000 ALTER TABLE `bitacoras` DISABLE KEYS */;
INSERT INTO `bitacoras` VALUES (1,'Creación de unidad Hospital General de Quetzaltenango',1,'2022-06-01 14:59:33','2022-06-01 14:59:33'),(2,'Actualización de permisos de usuario con IBM: 37732',1,'2022-06-01 15:11:54','2022-06-01 15:11:54'),(3,'Registro de solucitud de dietas. ',1,'2022-06-02 15:45:56','2022-06-02 15:45:56');
/*!40000 ALTER TABLE `bitacoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diet_request_details`
--

DROP TABLE IF EXISTS `diet_request_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diet_request_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `iddiet_request` int(11) NOT NULL,
  `iddiet` int(11) NOT NULL,
  `bed_number` int(11) DEFAULT NULL,
  `specify` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diet_request_details`
--

LOCK TABLES `diet_request_details` WRITE;
/*!40000 ALTER TABLE `diet_request_details` DISABLE KEYS */;
INSERT INTO `diet_request_details` VALUES (2,3,1,1,NULL,NULL,'2022-06-02 15:45:56','2022-06-02 15:45:56'),(3,3,17,NULL,'prueba de texto',NULL,'2022-06-02 15:45:56','2022-06-02 15:45:56');
/*!40000 ALTER TABLE `diet_request_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diet_requests`
--

DROP TABLE IF EXISTS `diet_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diet_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idjourney` int(11) NOT NULL,
  `idapplicant` int(11) NOT NULL,
  `idapplicant_service` int(11) NOT NULL,
  `total_diets` int(11) NOT NULL,
  `diets_served` int(11) NOT NULL,
  `iduser_served` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diet_requests`
--

LOCK TABLES `diet_requests` WRITE;
/*!40000 ALTER TABLE `diet_requests` DISABLE KEYS */;
INSERT INTO `diet_requests` VALUES (3,1,1,6,2,0,0,0,NULL,'2022-06-02 15:45:56','2022-06-02 15:45:56');
/*!40000 ALTER TABLE `diet_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diets`
--

DROP TABLE IF EXISTS `diets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npo` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diets`
--

LOCK TABLES `diets` WRITE;
/*!40000 ALTER TABLE `diets` DISABLE KEYS */;
INSERT INTO `diets` VALUES (1,'LIQUIDAS CLAROS',0,NULL,'2021-11-25 19:17:21','2021-11-25 19:17:21'),(2,'LIQUIDAS COMPLEMENTOS',0,NULL,'2021-11-25 19:17:25','2021-11-25 19:17:25'),(3,'BLANDA',0,NULL,'2021-11-25 19:17:30','2021-11-25 19:17:30'),(4,'PAPILLA (LICUADA/PURÉ)',0,NULL,'2021-11-25 19:17:35','2021-11-25 19:17:35'),(5,'PICADA',0,NULL,'2021-11-25 19:17:39','2021-11-25 19:17:39'),(6,'HIPOGRASA',0,NULL,'2021-11-25 19:17:43','2021-11-25 19:17:43'),(7,'HIPOSÓDICA',0,NULL,'2021-11-25 19:17:47','2021-11-25 19:17:47'),(8,'DIABETICA 1,500 CALORÍAS',0,NULL,'2021-11-25 19:17:52','2021-11-25 19:17:52'),(9,'DIABETICA 1,800 CALORÍAS',0,NULL,'2021-11-25 19:17:55','2021-11-25 19:17:55'),(10,'DIABETICA 2,000 CALORÍAS',0,NULL,'2021-11-25 19:18:00','2021-11-25 19:18:00'),(11,'DIABETICA 2,200 CALORÍAS',0,NULL,'2021-11-25 19:18:04','2021-11-25 19:18:04'),(12,'LIBRE',0,NULL,'2021-11-25 19:18:08','2021-11-25 19:18:08'),(13,'PEDIATRICAS 06 A 09 MESES (PAPILLA)',0,NULL,'2021-11-25 19:18:12','2021-11-25 19:18:12'),(14,'PEDIATRICAS 09 A 12 MESES (PICADA)',0,NULL,'2021-11-25 19:18:16','2021-11-25 19:18:16'),(15,'PEDIATRICAS 01 A 07 AÑOS (LIBRE)',0,NULL,'2021-11-25 19:18:20','2021-11-25 19:18:20'),(16,'DIETAS CALCULADAS POR NUTRICIÓN',0,NULL,'2021-11-25 19:18:26','2021-11-25 19:18:26'),(17,'OTRAS (ESPECIFICAR)',0,NULL,'2021-11-25 19:18:39','2021-11-25 19:18:39'),(18,'NPO',0,NULL,'2021-11-25 19:18:42','2021-11-25 19:18:42');
/*!40000 ALTER TABLE `diets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journeys`
--

DROP TABLE IF EXISTS `journeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journeys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journeys`
--

LOCK TABLES `journeys` WRITE;
/*!40000 ALTER TABLE `journeys` DISABLE KEYS */;
INSERT INTO `journeys` VALUES (1,'Desayuno','09:00:00','12:00:00',NULL,'2021-11-23 18:08:02','2021-11-23 18:08:02'),(2,'Almuerzo','14:00:00','16:00:00',NULL,'2021-11-23 18:14:48','2021-11-23 18:14:48'),(3,'Cena','18:00:00','19:00:00',NULL,'2021-11-23 18:15:11','2021-11-23 18:31:46');
/*!40000 ALTER TABLE `journeys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2021_01_21_172808_create_users_table',1),(2,'2021_01_22_015600_create_municipalities_table',1),(3,'2021_01_22_030940_create_units_table',1),(4,'2021_01_22_161101_create_services_table',1),(5,'2021_01_23_035513_create_bitacoras_table',1),(6,'2021_11_23_112413_create_journeys_table',1),(7,'2021_11_23_124337_create_diets_table',1),(8,'2021_11_24_101006_create_diet_requests_table',1),(9,'2021_11_24_120057_create_diet_request_details_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipalities`
--

DROP TABLE IF EXISTS `municipalities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipalities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipalities`
--

LOCK TABLES `municipalities` WRITE;
/*!40000 ALTER TABLE `municipalities` DISABLE KEYS */;
INSERT INTO `municipalities` VALUES (1,'0101','Guatemala','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'0102','Santa Catarina Pinula','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'0103','San José Pinula','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'0104','San José del Golfo','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'0105','Palencia','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'0106','Chinautla','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'0107','San Pedro Ayampuc','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'0108','Mixco','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,'0109','San Pedro Sacatepéquez','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'0110','San Juan Sacatepéquez','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'0111','San Raymundo','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'0112','Chuarrancho','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'0113','Fraijanes','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'0114','Amatitlán','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'0115','Villa Nueva','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'0116','Villa Canales','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'0117','Petapa','Guatemala','0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'0201','Guastatoya','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'0202','Morazán','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'0203','San Agustín Acasaguastlán','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,'0204','San Cristóbal Acasaguastlán','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'0205','El Jícaro','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'0206','Sansare','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,'0207','Sanarate','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,'0208','San Antonio la Paz','El Progreso','0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,'0301','Antigua Guatemala','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,'0302','Jocotenango','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'0303','Pastores','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,'0304','Sumpango','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,'0305','Santo Domingo Xenacoj','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,'0306','Santiago Sacatepéquez','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'0307','San Bartolomé Milpas Altas','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,'0308','San Lucas Sacatepéquez','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,'0309','Santa Lucía Milpas Altas','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,'0310','Magdalena Milpas Altas','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,'0311','Santa María de Jesús','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,'0312','Ciudad Vieja','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,'0313','San Miguel Dueñas','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,'0314','Alotenango','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,'0315','San Antonio Aguas Calientes','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,'0316','Santa Catarina Barahona','Sacatepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,'0401','Chimaltenango','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,'0402','San José Poaquil','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,'0403','San Martín Jilotepeque','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,'0404','Comalapa','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,'0405','Santa Apolonia','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,'0406','Tecpán Guatemala','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,'0407','Patzún','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,'0408','Pochuta','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,'0409','Patzicía','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,'0410','Santa Cruz Balanyá','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,'0411','Acatenango','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,'0412','Yepocapa','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,'0413','San Andrés Itzapa','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,'0414','Parramos','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,'0415','Zaragoza','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,'0416','El Tejar','Chimaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,'0501','Escuintla','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,'0502','Santa Lucía Cotzumalguapa','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,'0503','La Democracia','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,'0504','Siquinalá','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,'0505','Masagua','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,'0506','Tiquisate','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,'0507','La Gomera','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,'0508','Guanagazapa','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,'0509','San José','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,'0510','Iztapa','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,'0511','Palín','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,'0512','San Vicente Pacaya','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,'0513','Nueva Concepción','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,'0514','Sipacate','Escuintla','0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,'0601','Cuilapa','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,'0602','Barberena','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,'0603','Santa Rosa de Lima','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,'0604','Casillas','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,'0605','San Rafael las Flores','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,'0606','Oratorio','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,'0607','San Juan Tecuaco','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,'0608','Chiquimulilla','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,'0609','Taxisco','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,'0610','Santa María Ixhuatán','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,'0611','Guazacapán','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,'0612','Santa Cruz Naranjo','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,'0613','Pueblo Nuevo Viñas','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,'0614','Nueva Santa Rosa','Santa Rosa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(86,'0701','Sololá','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,'0702','San José Chacayá','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,'0703','Santa María Visitación','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,'0704','Santa Lucía Utatlán','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,'0705','Nahualá','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,'0706','Santa Catarina Ixtahuacán','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,'0707','Santa Clara la Laguna','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,'0708','Concepción','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(94,'0709','San Andrés Semetabaj','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(95,'0710','Panajachel','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(96,'0711','Santa Catarina Palopó','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(97,'0712','San Antonio Palopó','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(98,'0713','San Lucas Tolimán','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(99,'0714','Santa Cruz la Laguna','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(100,'0715','San Pablo la Laguna','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(101,'0716','San Marcos la Laguna','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(102,'0717','San Juan la Laguna','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(103,'0718','San Pedro la Laguna','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(104,'0719','Santiago Atitlán','Sololá','0000-00-00 00:00:00','0000-00-00 00:00:00'),(105,'0801','Totonicapán','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(106,'0802','San Cristóbal Totonicapán','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(107,'0803','San Francisco el Alto','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(108,'0804','San Andrés Xecul','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(109,'0805','Momostenango','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(110,'0806','Santa María Chiquimula','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(111,'0807','Santa Lucía la Reforma','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(112,'0808','San Bartolo','Totonicapán','0000-00-00 00:00:00','0000-00-00 00:00:00'),(113,'0901','Quetzaltenango','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(114,'0902','Salcajá','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(115,'0903','Olintepeque','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(116,'0904','San Carlos Sija','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(117,'0905','Sibilia','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(118,'0906','Cabricán','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(119,'0907','Cajolá','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(120,'0908','San Miguel Siguilá','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(121,'0909','Ostuncalco','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(122,'0910','San Mateo','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(123,'0911','Concepción Chiquirichapa','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(124,'0912','San Martín Sacatepéquez','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(125,'0913','Almolonga','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(126,'0914','Cantel','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(127,'0915','Huitán','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(128,'0916','Zunil','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(129,'0917','Colomba','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(130,'0918','San Francisco la Unión','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(131,'0919','El Palmar','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(132,'0920','Coatepeque','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(133,'0921','Génova','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(134,'0922','Flores Costa Cuca','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(135,'0923','La Esperanza','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(136,'0924','Palestina de los Altos','Quetzaltenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(137,'1001','Mazatenango','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(138,'1002','Cuyotenango','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(139,'1003','San Francisco Zapotitlán','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(140,'1004','San Bernardino','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(141,'1005','San José el Idolo','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(142,'1006','Santo Domingo Suchitepéquez','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(143,'1007','San Lorenzo','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(144,'1008','Samayac','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(145,'1009','San Pablo Jocopilas','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(146,'1010','San Antonio Suchitepéquez','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(147,'1011','San Miguel Panán','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(148,'1012','San Gabriel','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(149,'1013','Chicacao','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(150,'1014','Patulul','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(151,'1015','Santa Bárbara','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(152,'1016','San Juan Bautista','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(153,'1017','Santo Tomás la Unión','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(154,'1018','Zunilito','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(155,'1019','Pueblo Nuevo','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(156,'1020','Río Bravo','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(157,'1021','San José La Máquina','Suchitepéquez','0000-00-00 00:00:00','0000-00-00 00:00:00'),(158,'1101','Retalhuleu','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(159,'1102','San Sebastián','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(160,'1103','Santa Cruz Muluá','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(161,'1104','San Martín Zapotitlán','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(162,'1105','San Felipe','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(163,'1106','San Andrés Villa Seca','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(164,'1107','Champerico','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(165,'1108','Nuevo San Carlos','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(166,'1109','El Asintal','Retalhuleu','0000-00-00 00:00:00','0000-00-00 00:00:00'),(167,'1201','San Marcos','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(168,'1202','San Pedro Sacatepéquez','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(169,'1203','San Antonio Sacatepéquez','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(170,'1204','Comitancillo','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(171,'1205','San Miguel Ixtahuacán','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(172,'1206','Concepción Tutuapa','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(173,'1207','Tacaná','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(174,'1208','Sibinal','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(175,'1209','Tajumulco','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(176,'1210','Tejutla','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(177,'1211','San Rafael Pié de la Cuesta','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(178,'1212','Nuevo Progreso','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(179,'1213','El Tumbador','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(180,'1214','El Rodeo','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(181,'1215','Malacatán','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(182,'1216','Catarina','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(183,'1217','Ayutla','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(184,'1218','Ocós','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(185,'1219','San Pablo','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(186,'1220','El Quetzal','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(187,'1221','La Reforma','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(188,'1222','Pajapita','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(189,'1223','Ixchiguán','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(190,'1224','San José Ojetenán','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(191,'1225','San Cristóbal Cucho','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(192,'1226','Sipacapa','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(193,'1227','Esquipulas Palo Gordo','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(194,'1228','Río Blanco','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(195,'1229','San Lorenzo','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(196,'1230','La Blanca','San Marcos','0000-00-00 00:00:00','0000-00-00 00:00:00'),(197,'1301','Huehuetenango','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(198,'1302','Chiantla','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(199,'1303','Malacatancito','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(200,'1304','Cuilco','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(201,'1305','Nentón','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(202,'1306','San Pedro Necta','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(203,'1307','Jacaltenango','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(204,'1308','Soloma','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(205,'1309','Ixtahuacán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(206,'1310','Santa Bárbara','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(207,'1311','La Libertad','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(208,'1312','La Democracia','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(209,'1313','San Miguel Acatán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(210,'1314','San Rafael la Independencia','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(211,'1315','Todos Santos Cuchumatán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(212,'1316','San Juan Atitán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(213,'1317','Santa Eulalia','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(214,'1318','San Mateo Ixtatán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(215,'1319','Colotenango','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(216,'1320','San Sebastián Huehuetenango','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(217,'1321','Tectitán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(218,'1322','Concepción Huista','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(219,'1323','San Juan Ixcoy','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(220,'1324','San Antonio Huista','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(221,'1325','San Sebastián Coatán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(222,'1326','Barillas','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(223,'1327','Aguacatán','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(224,'1328','San Rafael Petzal','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(225,'1329','San Gaspar Ixchil','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(226,'1330','Santiago Chimaltenango','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(227,'1331','Santa Ana Huista','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(228,'1332','Unión Cantinil','Huehuetenango','0000-00-00 00:00:00','0000-00-00 00:00:00'),(229,'1401','Santa Cruz del Quiché','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(230,'1402','Chiché','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(231,'1403','Chinique','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(232,'1404','Zacualpa','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(233,'1405','Chajul','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(234,'1406','Chichicastenango','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(235,'1407','Patzité','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(236,'1408','San Antonio Ilotenango','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(237,'1409','San Pedro Jocopilas','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(238,'1410','Cunén','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(239,'1411','San Juan Cotzal','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(240,'1412','Joyabaj','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(241,'1413','Nebaj','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(242,'1414','San Andrés Sajcabajá','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(243,'1415','Uspantán','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(244,'1416','Sacapulas','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(245,'1417','San Bartolomé Jocotenango','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(246,'1418','Canillá','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(247,'1419','Chicamán','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(248,'1420','Ixcán','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(249,'1421','Pachalum','Quiché','0000-00-00 00:00:00','0000-00-00 00:00:00'),(250,'1501','Salamá','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(251,'1502','San Miguel Chicaj','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(252,'1503','Rabinal','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(253,'1504','Cubulco','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(254,'1505','Granados','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(255,'1506','El Chol','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(256,'1507','San Jerónimo','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(257,'1508','Purulhá','Baja Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(258,'1601','Cobán','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(259,'1602','Santa Cruz Verapaz','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(260,'1603','San Cristóbal Verapaz','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(261,'1604','Tactic','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(262,'1605','Tamahú','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(263,'1606','Tucurú','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(264,'1607','Panzós','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(265,'1608','Senahú','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(266,'1609','San Pedro Carchá','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(267,'1610','San Juan Chamelco','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(268,'1611','Lanquín','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(269,'1612','Cahabón','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(270,'1613','Chisec','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(271,'1614','Chahal','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(272,'1615','Fray Bartolomé de las Casas','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(273,'1616','Santa Catalina la Tinta','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(274,'1617','Raxruhá','Alta Verapaz','0000-00-00 00:00:00','0000-00-00 00:00:00'),(275,'1701','Flores','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(276,'1702','San José','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(277,'1703','San Benito','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(278,'1704','San Andrés','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(279,'1705','La Libertad','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(280,'1706','San Francisco','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(281,'1707','Santa Ana','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(282,'1708','Dolores','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(283,'1709','San Luis','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(284,'1710','Sayaxché','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(285,'1711','Melchor de Mencos','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(286,'1712','Poptún','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(287,'1713','Las Cruces','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(288,'1714','El Chal','Petén','0000-00-00 00:00:00','0000-00-00 00:00:00'),(289,'1801','Puerto Barrios','Izabal','0000-00-00 00:00:00','0000-00-00 00:00:00'),(290,'1802','Livingston','Izabal','0000-00-00 00:00:00','0000-00-00 00:00:00'),(291,'1803','El Estor','Izabal','0000-00-00 00:00:00','0000-00-00 00:00:00'),(292,'1804','Morales','Izabal','0000-00-00 00:00:00','0000-00-00 00:00:00'),(293,'1805','Los Amates','Izabal','0000-00-00 00:00:00','0000-00-00 00:00:00'),(294,'1901','Zacapa','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(295,'1902','Estanzuela','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(296,'1903','Río Hondo','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(297,'1904','Gualán','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(298,'1905','Teculután','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(299,'1906','Usumatlán','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(300,'1907','Cabañas','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(301,'1908','San Diego','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(302,'1909','La Unión','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(303,'1910','Huité','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(304,'1911','San Jorge','Zacapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(305,'2001','Chiquimula','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(306,'2002','San José La Arada','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(307,'2003','San Juan Ermita','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(308,'2004','Jocotán','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(309,'2005','Camotán','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(310,'2006','Olopa','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(311,'2007','Esquipulas','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(312,'2008','Concepción Las Minas','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(313,'2009','Quetzaltepeque','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(314,'2010','San Jacinto','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(315,'2011','Ipala','Chiquimula','0000-00-00 00:00:00','0000-00-00 00:00:00'),(316,'2101','Jalapa','Jalapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(317,'2102','San Pedro Pinula','Jalapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(318,'2103','San Luis Jilotepeque','Jalapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(319,'2104','San Manuel Chaparrón','Jalapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(320,'2105','San Carlos Alzatate','Jalapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(321,'2106','Monjas','Jalapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(322,'2107','Mataquescuintla','Jalapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(323,'2201','Jutiapa','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(324,'2202','El Progreso','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(325,'2203','Santa Catarina Mita','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(326,'2204','Agua Blanca','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(327,'2205','Asunción Mita','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(328,'2206','Yupiltepeque','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(329,'2207','Atescatempa','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(330,'2208','Jerez','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(331,'2209','El Adelanto','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(332,'2210','Zapotitlán','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(333,'2211','Comapa','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(334,'2212','Jalpatagua','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(335,'2213','Conguaco','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(336,'2214','Moyuta','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(337,'2215','Pasaco','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(338,'2216','San José Acatempa','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00'),(339,'2217','Quesada','Jutiapa','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `municipalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Hospitalización',0,0,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Consulta Externa',0,0,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Emergencia',0,0,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Servicio de Apoyo ',0,0,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Hosp - Covid 19',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'Hosp - Medi-interna hombres',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'Hosp - Medi-interna mujeres',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'Hosp - Sala de quemados',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,'Hosp - Cirugía hombres',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'Hosp - Cirugía mujeres',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'Hosp - Cirugía pediátrica',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'Hosp - Ginecología',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'Hosp - Alto riesgo-obstétrico',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'Hosp - Post parto',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'Hosp - Aislamiento ginecológico',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'Hosp - Pediatría general',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'Hosp - Neonatología alto riesgo',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'Hosp - Neonatología bajo riesgo',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'Hosp - Trauma-orto hombres',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'Hosp - Trauma-orto mujeres',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,'Hosp - Trauma-orto pediátrica',1,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'Cons - medicina gral',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'Cons - enfermedad común',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,'Cons -  recetas de apoyo',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,'Cons -  medicina interna',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,'Cons -  cardiología adultos',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,'Cons -  neumología adultos',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'Cons -  reumatologia adultos',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,'Cons -  neurología adultos',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,'Cons -  nefrolo-adultos',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,'Cons -  nefrolo-pediátrica',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'Cons -  derma-adultos',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,'Cons -  geriatría',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,'Cons -  evaluación preoperatoria',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,'Cons -  cirugía general',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,'Cons -  coloproctología',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,'Cons -  otorrinolaringología',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,'Cons -  obstetrícia',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,'Cons -  ginecología',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(40,'Cons -  neonatología',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,'Cons -  neumo-pediátrica',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,'Cons -  neuro-pediátrica',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,'Cons -  ciru-pediátrica',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,'Cons -  pediatría',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,'Cons -  alergo-pediátrica',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,'Cons -  trauma-orto general',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,'Cons -  cirugía de mano',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,'Cons -  cirugía oral y maxilofacial',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,'Cons -  oftalmología',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,'Cons -  psiquiatría',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,'Cons -  med física-rehabilitación',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,'Cons -  odonto-general',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,'Cons -  psicología',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,'Cons -  nutrición',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,'Vacunas',2,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,'Emer - general',3,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,'Emer - pediátrica',3,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,'Emer - ginecobstetricia',3,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,'Emer - trauma',3,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,'Emer - cirugía',3,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,'Emer - observación adultos',3,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,'Emer - Covid 19',3,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,'Servicio a unidades (externas)',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,'Hospital de día general',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,'Cuid intens pediátrico',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,'Cuid intens adultos',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,'Cuid intens neonatología',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,'Cuid intens Covid 19',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,'Cuid interm adultos',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,'Recuperación (labor y partos)',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,'Electrocardiograma',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,'Quirófano general',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,'Quirófano cesáreas',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,'Anestesia cirug-gral',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,'Laboratorio clínico',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,'Radiología',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,'Ultrasonido general',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,'Laboratorio patológico',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,'Farmacia',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,'Unidosis',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,'Labor y partos',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,'Nutrición y dietética',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,'Lactario',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,'Alimentación parenteral',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,'Mamografía',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(86,'Densitometría',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,'Fisioterapia',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,'Terapia respiratoria',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,'Banco de sangre',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,'Hemodiálisis intrahospitalaria',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,'Procedimientos generales',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,'Curaciones ',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,'Hipodérmia general',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(94,'Signos vitales',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(95,'Ropería y costurería',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(96,'Lavandería',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(97,'Trabajo social',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(98,'Docencia',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(99,'Central equipo general',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(100,'Mantenimiento',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(101,'Ambulancia',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(102,'Transporte',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(103,'Informática',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(104,'Dirección administración',4,1,1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'090301','Hospital General de Quetzaltenango',113,NULL,'2022-06-01 14:59:33','2022-06-01 14:59:33');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ibm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `idunit` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_ibm_unique` (`ibm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Daniel','Velasquez','37732','$2y$10$0zfZ2x2r4TwbTZ4CNTSQ6u/l8KUDBAw65WTg3EYgD/W/6l2T7ye3C','{\"dashboard\":\"true\",\"dashboard_small_stats\":\"true\",\"municipalities\":\"true\",\"units\":\"true\",\"unit_add\":\"true\",\"unit_edit\":\"true\",\"unit_delete\":\"true\",\"unit_search\":\"true\",\"diets\":\"true\",\"diet_add\":\"true\",\"diet_edit\":\"true\",\"diet_delete\":\"true\",\"serviceg_list\":\"true\",\"serviceg_add\":\"true\",\"serviceg_edit\":\"true\",\"service_list\":\"true\",\"service_add\":\"true\",\"service_edit\":\"true\",\"journeys\":\"true\",\"journey_add\":\"true\",\"journey_edit\":\"true\",\"journey_delete\":\"true\",\"diet_requests\":\"true\",\"diet_request_add\":\"true\",\"diet_request_view\":\"true\",\"diet_request_delete\":\"true\",\"reports\":\"true\",\"report_informatica\":\"true\",\"report_user\":\"true\",\"report_bitacora\":\"true\",\"bitacoras\":\"true\",\"user_list\":\"true\",\"user_add\":\"true\",\"user_edit\":\"true\",\"user_search\":\"true\",\"user_banned\":\"true\",\"user_delete\":\"true\",\"user_reset_password\":\"true\",\"user_permissions\":\"true\",\"user_info\":\"true\",\"user_change_password\":\"true\"}',0,NULL,1,'BQYeEE1tbAAFPvEmqsFKgVuOnPspw8wToO3uLTjbfzyheXBiN9rsGJZkjVpq',NULL,NULL,'2022-06-01 15:11:54');
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

-- Dump completed on 2022-06-13 15:31:11
