-- MySQL dump 10.13  Distrib 5.6.21, for Win32 (x86)
--
-- Host: localhost    Database: bitnami_edx
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `instructores`
--

DROP TABLE IF EXISTS `instructores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `biografia` text NOT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `obras_imp` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructores`
--

LOCK TABLES `instructores` WRITE;
/*!40000 ALTER TABLE `instructores` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curso_instructor`
--

DROP TABLE IF EXISTS `curso_instructor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curso_instructor` (
  `instructor_id` int(11) NOT NULL,
  `ficha_curso_id` int(11) NOT NULL,
  KEY `instructor_id` (`instructor_id`),
  KEY `ficha_curso_id` (`ficha_curso_id`),
  CONSTRAINT `curso_instructor_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructores` (`id`),
  CONSTRAINT `curso_instructor_ibfk_2` FOREIGN KEY (`ficha_curso_id`) REFERENCES `ficha_curso` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso_instructor`
--

LOCK TABLES `curso_instructor` WRITE;
/*!40000 ALTER TABLE `curso_instructor` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso_instructor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ficha_curso`
--

DROP TABLE IF EXISTS `ficha_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ficha_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `descripcion_lar` text NOT NULL,
  `descripcion_cor` text NOT NULL,
  `resultados_esp` text NOT NULL,
  `temario` text NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_lan` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_emi` date NOT NULL,
  `duracion_sem` tinyint(4) NOT NULL,
  `esfuerzo_hr_sem` tinyint(4) NOT NULL,
  `requisitos` text NOT NULL,
  `lengua_cont` varchar(30) NOT NULL,
  `lengua_mult` varchar(30) NOT NULL,
  `lengua_trans` varchar(30) NOT NULL,
  `nivel_curso` varchar(30) NOT NULL,
  `tipo_constancia` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `categoria1` tinyint(4) DEFAULT NULL,
  `categoria2` tinyint(4) DEFAULT NULL,
  `categoria3` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ficha_curso`
--

LOCK TABLES `ficha_curso` WRITE;
/*!40000 ALTER TABLE `ficha_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `ficha_curso` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-20 13:43:33
