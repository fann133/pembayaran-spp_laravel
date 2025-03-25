-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: spp
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `biaya`
--

DROP TABLE IF EXISTS `biaya`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `biaya` (
  `id_biaya` char(36) NOT NULL DEFAULT 'f7fc9693-c2bd-498a-b6ee-a9c994377a92',
  `nama` varchar(255) NOT NULL,
  `jenis` enum('SPP','NON-SPP') NOT NULL DEFAULT 'SPP',
  `kode` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `jumlah` varchar(50) NOT NULL,
  `status` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'AKTIF',
  `kategori` enum('Atas','Menengah','Bawah') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_biaya`),
  UNIQUE KEY `biaya_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `biaya`
--

LOCK TABLES `biaya` WRITE;
/*!40000 ALTER TABLE `biaya` DISABLE KEYS */;
/*!40000 ALTER TABLE `biaya` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gurus`
--

DROP TABLE IF EXISTS `gurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gurus` (
  `id_guru` char(36) NOT NULL,
  `users_id` char(36) DEFAULT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(255) NOT NULL,
  `status` enum('TETAP','HONOR','MAGANG') NOT NULL DEFAULT 'HONOR',
  `role_id` enum('3','4','5') NOT NULL DEFAULT '3',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_guru`),
  UNIQUE KEY `gurus_nip_unique` (`nip`),
  KEY `gurus_users_id_foreign` (`users_id`),
  CONSTRAINT `gurus_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gurus`
--

LOCK TABLES `gurus` WRITE;
/*!40000 ALTER TABLE `gurus` DISABLE KEYS */;
INSERT INTO `gurus` VALUES ('7952e19f-b98b-446a-aa7e-1154ec6c908a',NULL,'12','Zulkifli','Laki-laki','Sorong','2025-03-01','islam','TETAP','4','2025-03-23 17:47:49','2025-03-23 17:47:49'),('8515110b-ae77-42a7-8cae-896590f402f7',NULL,'123','MUHAMAT IRFAN RIFAI','Laki-laki','Sorong','2025-03-01','islam','TETAP','3','2025-03-23 17:47:33','2025-03-23 17:47:33');
/*!40000 ALTER TABLE `gurus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelas` (
  `id_kelas` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_kelas` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `pengampu_kelas` char(36) DEFAULT NULL,
  `id_guru` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  UNIQUE KEY `kelas_kode_kelas_unique` (`kode_kelas`),
  UNIQUE KEY `kelas_pengampu_kelas_unique` (`pengampu_kelas`),
  KEY `kelas_id_guru_foreign` (`id_guru`),
  CONSTRAINT `kelas_id_guru_foreign` FOREIGN KEY (`id_guru`) REFERENCES `gurus` (`id_guru`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `kelas_pengampu_kelas_foreign` FOREIGN KEY (`pengampu_kelas`) REFERENCES `gurus` (`id_guru`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_03_19_024632_create_logins_table',1),(6,'2025_03_19_054523_create_sessions_table',2),(7,'2025_03_19_062503_create_siswas_table',3),(8,'2025_03_20_012538_update_users_table',4),(9,'2025_03_20_030008_add_status_to_siswas_table',5),(10,'2025_03_20_041015_update_status_enum_in_siswas_table',6),(11,'2025_03_20_041804_update_status_enum_remove_tidak_aktif',7),(14,'2025_03_20_042535_update_enum_status_on_siswas_table',8),(15,'2025_03_20_045420_update_status_column_on_siswas_table',8),(16,'2025_03_20_050815_update_status_column_on_siswas_table',9),(17,'2025_03_20_050831_update_status_column_on_siswas_table',9),(19,'2025_03_21_065117_add_bypass_column_to_users_table',10),(20,'2025_03_21_065835_modify_users_table',11),(21,'2025_03_21_070208_modify_users_table',11),(22,'2025_03_21_072817_create_gurus_table',12),(23,'2025_03_22_013414_add_users_id_to_siswas_table',13),(24,'2025_03_22_023010_add_jenis_kelamin__to_siswas_table',14),(25,'2025_03_22_031320_add_columns_to_gurus_table',15),(26,'2025_03_22_034723_update_users_id_foreign_key_on_siswas_table',16),(27,'2025_03_24_021702_create_kelas_table',17),(28,'2025_03_24_021732_add_id_kelas_to_siswas_table',17),(29,'2025_03_24_024239_add_pengampu_kelas_to_kelas_table',18),(30,'2025_03_24_025117_add_unique_pengampu_to_kelas',19),(31,'2025_03_24_043749_modify_kelas_column_on_siswas_table',20),(32,'2025_03_24_073105_create_biaya_table',21),(33,'2025_03_24_075433_update_status_column_in_biaya_table',22),(34,'2025_03_24_080203_update_biaya_table',23);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswas`
--

DROP TABLE IF EXISTS `siswas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswas` (
  `id_siswa` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `nis` varchar(255) NOT NULL,
  `id_kelas` char(36) DEFAULT NULL,
  `users_id` char(36) DEFAULT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `category` enum('atas','menengah','bawah') NOT NULL,
  `status` enum('AKTIF','LULUS','PINDAHAN','KELUAR') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `siswas_nis_unique` (`nis`),
  KEY `siswas_users_id_foreign` (`users_id`),
  KEY `siswas_id_kelas_foreign` (`id_kelas`),
  CONSTRAINT `siswas_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `siswas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswas`
--

LOCK TABLES `siswas` WRITE;
/*!40000 ALTER TABLE `siswas` DISABLE KEYS */;
INSERT INTO `siswas` VALUES ('9d524576-f52e-44ba-910e-3d88ebb7b9c4','MUHAMAT IRFAN RIFAI','Laki-laki','20231004',NULL,'23cb2779-875b-4063-83c5-470fed61007c','Sorong','2025-03-01','LULUS','atas','LULUS','2025-03-23 19:41:08','2025-03-23 21:54:42'),('dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','Perempuan','145420121001',NULL,'07e5faee-9814-4cff-899a-4e25af651a01','Sorong','2025-03-01','3008d492-2e6b-4355-9a32-dc93313edbe4','atas','AKTIF','2025-03-23 04:20:35','2025-03-24 16:50:22'),('e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','Laki-laki','1',NULL,'588899c5-d422-44c2-b37d-ec2a275886aa','Sorong','2025-03-01',NULL,'atas','LULUS','2025-03-22 23:39:42','2025-03-23 21:34:15');
/*!40000 ALTER TABLE `siswas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bypass` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_users` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role_id` enum('1','2','3','4','5') NOT NULL,
  `login_times` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('MARIA GURETTY ALATUBIR','$2y$12$zDO1CTqV.fy5/u1xydkvdepNHNd77dbNii0kkiLCyZpMV7SaNmYam','15897','2025-03-23 04:20:46','2025-03-23 04:26:34','07e5faee-9814-4cff-899a-4e25af651a01','145420121001','2',NULL),('MUHAMAT IRFAN RIFAI','$2y$12$ifdlr1.P990upNHIsFby1uWvnHVDNOZzwFydx2DK4NKR4herwx96S','55181','2025-03-23 21:54:42','2025-03-23 21:54:42','23cb2779-875b-4063-83c5-470fed61007c','20231004','2',NULL),('Muhamat Irfan','$2y$12$BOFaUnslDxDcQlRqxG1O.eRt/3kPutSGFxDvrE3RQlp1fLfJQuPlC','21141','2025-03-22 23:39:51','2025-03-23 05:06:13','588899c5-d422-44c2-b37d-ec2a275886aa','1','2',NULL),('Administrator','$2y$12$mnO44FollEr8vf7FEDyzOOFgGz.SPBKbVVtJSoALKYw9x1a3NQLuW','admin','2025-03-19 16:37:40','2025-03-23 17:08:54','d78b44bb-58d7-4668-94b5-77f8a3fca965','admin','1','2025-03-22 22:06:10');
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

-- Dump completed on 2025-03-25 13:32:56
