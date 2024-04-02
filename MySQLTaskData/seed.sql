-- MySQL dump 10.13  Distrib 8.3.0, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `addresses_customer_id_foreign` (`customer_id`),
  CONSTRAINT `addresses_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (1,1,'Anfield Road 1','2024-04-02 16:11:43','2024-04-02 16:11:43'),(2,2,'Anfield Road 2','2024-04-02 16:11:43','2024-04-02 16:11:43'),(3,3,'Anfield Road 3','2024-04-02 16:11:43','2024-04-02 16:11:43'),(4,1,'Anfield Road 11','2024-04-02 16:11:43','2024-04-02 16:11:43'),(5,1,'Anfield Road 111','2024-04-02 16:11:43','2024-04-02 16:11:43'),(6,2,'Anfield Road 22','2024-04-02 16:11:43','2024-04-02 16:11:43');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_status_histories`
--

DROP TABLE IF EXISTS `application_status_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application_status_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `old_status` enum('NEW','PROCESSING','APPROVED','DECLINED','COMPLETED','CANCELLED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_status` enum('NEW','PROCESSING','APPROVED','DECLINED','COMPLETED','CANCELLED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `application_status_histories_application_id_foreign` (`application_id`),
  CONSTRAINT `application_status_histories_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_status_histories`
--

LOCK TABLES `application_status_histories` WRITE;
/*!40000 ALTER TABLE `application_status_histories` DISABLE KEYS */;
INSERT INTO `application_status_histories` VALUES (1,1,'NEW','PROCESSING','2024-04-02 16:11:43','2024-04-02 16:11:43'),(2,1,'PROCESSING','APPROVED','2024-04-02 16:11:43','2024-04-02 16:11:43'),(3,1,'APPROVED','COMPLETED','2024-04-02 16:11:43','2024-04-02 16:11:43'),(4,2,'NEW','DECLINED','2024-04-02 16:11:43','2024-04-02 16:11:43'),(5,3,'NEW','CANCELLED','2024-04-02 16:11:43','2024-04-02 16:11:43'),(6,7,'NEW','APPROVED','2024-04-02 16:11:43','2024-04-02 16:11:43');
/*!40000 ALTER TABLE `application_status_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `broker_id` bigint unsigned DEFAULT NULL,
  `credit_product_id` bigint unsigned NOT NULL,
  `loan_amount` decimal(8,2) unsigned NOT NULL,
  `monthly_payment` decimal(8,2) unsigned NOT NULL,
  `status` enum('NEW','PROCESSING','APPROVED','DECLINED','COMPLETED','CANCELLED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `applications_customer_id_foreign` (`customer_id`),
  KEY `applications_broker_id_foreign` (`broker_id`),
  KEY `applications_credit_product_id_foreign` (`credit_product_id`),
  CONSTRAINT `applications_broker_id_foreign` FOREIGN KEY (`broker_id`) REFERENCES `brokers` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `applications_credit_product_id_foreign` FOREIGN KEY (`credit_product_id`) REFERENCES `credit_products` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `applications_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,1,1,1,1200.00,600.00,'COMPLETED','2024-04-02 16:11:43','2024-04-02 16:11:43'),(2,2,2,2,2400.00,1000.00,'DECLINED','2024-04-02 16:11:43','2024-04-02 16:11:43'),(3,3,2,1,3600.00,1800.00,'CANCELLED','2024-04-02 16:11:43','2024-04-02 16:11:43'),(4,3,5,2,4800.00,2000.00,'NEW','2024-04-02 16:11:43','2024-04-02 16:11:43'),(5,1,5,1,6000.00,3000.00,'NEW','2024-04-02 16:11:43','2024-04-02 16:11:43'),(6,5,4,1,6000.00,3000.00,'NEW','2024-04-02 16:11:43','2024-04-02 16:11:43'),(7,5,NULL,2,60000.00,25000.00,'APPROVED','2024-04-02 16:11:43','2024-04-02 16:11:43');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brokers`
--

DROP TABLE IF EXISTS `brokers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brokers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brokers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brokers`
--

LOCK TABLES `brokers` WRITE;
/*!40000 ALTER TABLE `brokers` DISABLE KEYS */;
INSERT INTO `brokers` VALUES (1,'First Broker','first_broker@gmail.com','Abbey Road 1','[\"A\"]','2024-04-02 16:11:43','2024-04-02 16:11:43'),(2,'Second Broker','second_broker@gmail.com','Abbey Road 2','[\"A\",\"B\"]','2024-04-02 16:11:43','2024-04-02 16:11:43'),(3,'Third Broker','third_broker@gmail.com','Abbey Road 3','[\"A\",\"C\"]','2024-04-02 16:11:43','2024-04-02 16:11:43'),(4,'Fourth Broker','fourth_broker@gmail.com','Abbey Road 4','[\"D\"]','2024-04-02 16:11:43','2024-04-02 16:11:43'),(5,'Fifth Broker','fifth_broker@gmail.com','Abbey Road 5','[\"D\",\"C\"]','2024-04-02 16:11:43','2024-04-02 16:11:43');
/*!40000 ALTER TABLE `brokers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credit_products`
--

DROP TABLE IF EXISTS `credit_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credit_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_rate` decimal(8,2) unsigned NOT NULL,
  `term` int unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit_products`
--

LOCK TABLES `credit_products` WRITE;
/*!40000 ALTER TABLE `credit_products` DISABLE KEYS */;
INSERT INTO `credit_products` VALUES (1,'One Year Loan',6.00,12,'2024-04-02 16:11:43','2024-04-02 16:11:43'),(2,'Two Year Loan',5.00,24,'2024-04-02 16:11:43','2024-04-02 16:11:43');
/*!40000 ALTER TABLE `credit_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'First Nunez','2021-01-01','first@gmail.com','2024-04-02 16:11:43','2024-04-02 16:11:43'),(2,'Second Zinchenko','2022-02-02','second@gmail.com','2024-04-02 16:11:43','2024-04-02 16:11:43'),(3,'Third Holland','2023-03-03','third@gmail.com','2024-04-02 16:11:43','2024-04-02 16:11:43'),(4,'Fourth Martinez','2024-04-04','fourth@gmail.com','2024-04-02 16:11:43','2024-04-02 16:11:43'),(5,'Fifth Son','2025-05-05','fifth@gmail.com','2024-04-02 16:11:43','2024-04-02 16:11:43');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-02 16:16:01
