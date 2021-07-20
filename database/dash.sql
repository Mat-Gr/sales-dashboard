-- MariaDB dump 10.19  Distrib 10.5.11-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dash
-- ------------------------------------------------------
-- Server version	10.5.11-MariaDB-1:10.5.11+maria~focal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers`
(
    `id`         bigint(20) unsigned                     NOT NULL AUTO_INCREMENT,
    `first_name` varchar(255) COLLATE utf8mb4_unicode_ci      DEFAULT NULL,
    `last_name`  varchar(255) COLLATE utf8mb4_unicode_ci      DEFAULT NULL,
    `email`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp                               NULL DEFAULT NULL,
    `updated_at` timestamp                               NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `customers`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items`
(
    `id`         bigint(20) unsigned                     NOT NULL AUTO_INCREMENT,
    `order_id`   bigint(20) unsigned                     NOT NULL,
    `ean`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `quantity`   int(10) unsigned                        NOT NULL,
    `price`      bigint(20) unsigned                     NOT NULL,
    `created_at` timestamp                               NULL DEFAULT NULL,
    `updated_at` timestamp                               NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `order_items_order_id_foreign` (`order_id`),
    CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items`
    ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders`
(
    `id`           bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `customer_id`  bigint(20) unsigned NOT NULL,
    `country`      varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `device`       varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `purchased_at` timestamp           NULL                DEFAULT NULL,
    `created_at`   timestamp           NULL                DEFAULT NULL,
    `updated_at`   timestamp           NULL                DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `orders_customer_id_foreign` (`customer_id`),
    CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders`
    DISABLE KEYS */;
/*!40000 ALTER TABLE `orders`
    ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2021-07-20 19:45:06
