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
INSERT INTO `biaya` VALUES ('39a02fd1-71c9-489c-905a-4b2619b21732','SPP Bulanann','SPP','SPP-M',NULL,'10.000','AKTIF','Menengah','2025-03-27 23:35:50','2025-04-07 18:45:56'),('6a40b62f-1398-4952-80b2-9db27b668100','SPP Bulanan','SPP','11','asad','11','AKTIF','Atas','2025-03-26 02:21:52','2025-03-27 23:33:08'),('a38fbb3d-e257-4d88-8807-1a3172e32a5e','SPP Bulanan','SPP','SPP-B',NULL,'50000','AKTIF','Bawah','2025-04-02 03:07:45','2025-04-02 03:07:59'),('c6815c8f-cd20-48b5-8028-d6a24ae7416f','Baju','NON-SPP','BBK',NULL,'100000','AKTIF','Atas','2025-03-27 23:13:36','2025-03-27 23:33:54'),('f3fb8eff-8dec-4d33-ab6d-399344e92901','Seragam Olahraga','NON-SPP','SGRM',NULL,'150000','AKTIF','Atas','2025-04-06 21:14:07','2025-04-06 21:14:07');
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
INSERT INTO `gurus` VALUES ('6fec5469-0bf3-4253-a364-9ae1ae74d924','32001624-8543-4830-ade5-f91a82ddabd9','1112','NASI','Laki-laki','Sorong','2025-03-01','Islam','TETAP','3','2025-03-29 03:03:41','2025-04-07 18:44:19'),('8515110b-ae77-42a7-8cae-896590f402f7',NULL,'1432','MUHAMAT IRFAN RIFAI','Laki-laki','Sorong','2025-04-04','Islam','MAGANG','4','2025-03-23 17:47:33','2025-04-04 02:34:36');
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  UNIQUE KEY `kelas_kode_kelas_unique` (`kode_kelas`),
  UNIQUE KEY `kelas_pengampu_kelas_unique` (`pengampu_kelas`),
  CONSTRAINT `kelas_pengampu_kelas_foreign` FOREIGN KEY (`pengampu_kelas`) REFERENCES `gurus` (`id_guru`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` VALUES ('4c2b6d70-6c31-4a90-9324-82c3e6e436ef','IPA','MIPA',NULL,NULL,'2025-03-27 23:31:17','2025-04-07 18:44:29'),('a5dab855-17f7-44bd-a4d9-1ff602c090c8','TBSMS','TBSM',NULL,NULL,'2025-04-04 02:45:46','2025-04-04 02:45:46'),('ef7aa50e-0148-4da6-9a40-6a4f9c07f5e9','IPAS','MIPAS',NULL,'6fec5469-0bf3-4253-a364-9ae1ae74d924','2025-04-04 02:43:15','2025-04-04 02:43:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_03_19_024632_create_logins_table',1),(6,'2025_03_19_054523_create_sessions_table',2),(7,'2025_03_19_062503_create_siswas_table',3),(8,'2025_03_20_012538_update_users_table',4),(9,'2025_03_20_030008_add_status_to_siswas_table',5),(10,'2025_03_20_041015_update_status_enum_in_siswas_table',6),(11,'2025_03_20_041804_update_status_enum_remove_tidak_aktif',7),(14,'2025_03_20_042535_update_enum_status_on_siswas_table',8),(15,'2025_03_20_045420_update_status_column_on_siswas_table',8),(16,'2025_03_20_050815_update_status_column_on_siswas_table',9),(17,'2025_03_20_050831_update_status_column_on_siswas_table',9),(19,'2025_03_21_065117_add_bypass_column_to_users_table',10),(20,'2025_03_21_065835_modify_users_table',11),(21,'2025_03_21_070208_modify_users_table',11),(22,'2025_03_21_072817_create_gurus_table',12),(23,'2025_03_22_013414_add_users_id_to_siswas_table',13),(24,'2025_03_22_023010_add_jenis_kelamin__to_siswas_table',14),(25,'2025_03_22_031320_add_columns_to_gurus_table',15),(26,'2025_03_22_034723_update_users_id_foreign_key_on_siswas_table',16),(27,'2025_03_24_021702_create_kelas_table',17),(28,'2025_03_24_021732_add_id_kelas_to_siswas_table',17),(29,'2025_03_24_024239_add_pengampu_kelas_to_kelas_table',18),(30,'2025_03_24_025117_add_unique_pengampu_to_kelas',19),(31,'2025_03_24_043749_modify_kelas_column_on_siswas_table',20),(32,'2025_03_24_073105_create_biaya_table',21),(33,'2025_03_24_075433_update_status_column_in_biaya_table',22),(34,'2025_03_24_080203_update_biaya_table',23),(35,'2025_03_26_114515_create_tagihan_table',24),(36,'2025_03_27_120939_add_kelas_to_tagihan_table',25),(37,'2025_03_28_084300_add_tanggal_bayar_to_tagihan_table',26),(38,'2025_03_28_191729_remove_tanggal_bayar_from_tagihan_table',27),(39,'2025_03_28_195130_create_pembayaran_table',28),(40,'2025_03_28_195349_add_tanggal_bayar_to_pembayaran_table',29),(41,'2025_03_28_202122_add_bulan_to_pembayaran_table',30),(42,'2025_03_28_202716_add_id_users_to_pembayaran_table',31),(43,'2025_03_29_191754_add_kode_to_tagihan_and_pembayaran',32),(44,'2025_04_02_115928_change_category_column_type_in_siswas_table',33),(45,'2025_04_04_114034_remove_id_guru_from_kelas_table',34),(46,'2025_04_06_030403_create_settings_table',35),(48,'2025_04_07_120813_create_profil_sekolah_table',36),(49,'2025_04_07_133256_rename_id_to_id_settings_on_settings_table',36);
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
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran` (
  `id_pembayaran` char(36) NOT NULL,
  `id_users` char(36) DEFAULT NULL,
  `id_tagihan` char(36) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `id_siswa` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `nama_pembayaran` varchar(255) NOT NULL,
  `jenis` enum('SPP','NON-SPP') NOT NULL,
  `bulan` varchar(255) DEFAULT NULL,
  `jumlah_tagihan` decimal(10,2) NOT NULL,
  `dibayar` decimal(10,2) NOT NULL,
  `piutang` decimal(10,2) NOT NULL,
  `status` enum('LUNAS','BELUM LUNAS') NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `pembayaran_id_tagihan_foreign` (`id_tagihan`),
  KEY `pembayaran_id_siswa_foreign` (`id_siswa`),
  KEY `pembayaran_id_users_foreign` (`id_users`),
  CONSTRAINT `pembayaran_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id_siswa`) ON DELETE CASCADE,
  CONSTRAINT `pembayaran_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES ('0428ab66-fae2-4385-a255-5efdf8ebf975','d78b44bb-58d7-4668-94b5-77f8a3fca965','fb86d1f0-932a-4429-8878-c740ea97a5e6',NULL,'dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','145420121001','IPA','Baju','NON-SPP','-',100000.00,50000.00,50000.00,'BELUM LUNAS','2025-11-29','2025-03-29 03:55:08','2025-03-29 03:55:08'),('1b40a5bd-a5e1-4f4f-81c4-9e0977060211','d78b44bb-58d7-4668-94b5-77f8a3fca965','5386bfb1-8d5b-43b7-bdf5-208612542ef2','11','dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','145420121001','IPA','SPP Bulanan','SPP','Maret',11.00,11.00,0.00,'LUNAS','2025-04-29','2025-03-29 10:47:54','2025-03-29 10:47:54'),('4481fec5-8dbf-4e18-9f66-0c96ba9cea57','d78b44bb-58d7-4668-94b5-77f8a3fca965','ad29fbf4-b030-465d-b677-e93679d8d0f7',NULL,'e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','SPP Bulanan','SPP','Januari',10000.00,5000.00,5000.00,'BELUM LUNAS','2025-03-29','2025-03-29 10:23:50','2025-03-29 10:23:50'),('7e11f3fd-8fff-40e9-9452-ed8cea0612e5','d78b44bb-58d7-4668-94b5-77f8a3fca965','c3e44be9-9154-4624-a0ab-f35f70d8147a','BBK','e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','Baju','NON-SPP','null',100000.00,100000.00,0.00,'LUNAS','2025-03-30','2025-03-29 21:57:08','2025-03-29 21:57:08'),('9952192c-4f14-4895-814e-344d591f9b18','d78b44bb-58d7-4668-94b5-77f8a3fca965','fb86d1f0-932a-4429-8878-c740ea97a5e6',NULL,'dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','145420121001','IPA','Baju','NON-SPP','-',50000.00,50000.00,0.00,'LUNAS','2025-03-29','2025-03-29 03:55:27','2025-03-29 03:55:27'),('a7b168dc-f4b8-4fd7-b253-7dfc383595f2','d78b44bb-58d7-4668-94b5-77f8a3fca965','7e4878e5-e092-4895-9de8-7031c3cc6a04','BBK','3181ffa0-d536-400c-9bdd-1bace1f31e29','MariyaI','112211','IPA','Baju','NON-SPP','',100000.00,100000.00,0.00,'LUNAS','2025-04-05','2025-04-05 06:47:54','2025-04-05 06:47:54'),('a9fd703d-57f2-4448-a58c-e9e4375b43df','d78b44bb-58d7-4668-94b5-77f8a3fca965','534edef9-aed6-4b53-882d-23b30622e4b6','','e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','SPP Bulanan','SPP','Januari',10000.00,10000.00,0.00,'LUNAS','2025-04-02','2025-04-02 02:48:43','2025-04-02 02:48:43'),('b16730f9-fe29-4f2e-b6a0-00d3393f7325','d78b44bb-58d7-4668-94b5-77f8a3fca965','43980052-4d0f-4ad3-b53b-b10213bc6cdb','11','dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','145420121001','IPA','SPP Bulanan','SPP','Februari',11.00,11.00,0.00,'LUNAS','2025-03-30','2025-03-29 21:55:10','2025-03-29 21:55:10'),('c4ad3160-d9da-4ac2-91b5-c77abe2eba86','d78b44bb-58d7-4668-94b5-77f8a3fca965','1ffb02cd-c54f-4f00-bf40-54230c53c63f',NULL,'dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','145420121001','IPA','SPP Bulanan','SPP','Januari',11.00,11.00,0.00,'LUNAS','2025-03-29','2025-03-29 10:36:05','2025-03-29 10:36:05'),('cf9cd910-718a-4312-9b74-0aa4ba93ed6d','d78b44bb-58d7-4668-94b5-77f8a3fca965','ad29fbf4-b030-465d-b677-e93679d8d0f7',NULL,'e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','SPP Bulanan','SPP','Januari',5000.00,5000.00,0.00,'LUNAS','2025-03-29','2025-03-29 10:24:09','2025-03-29 10:24:09'),('f7c1154b-57f7-4554-af08-363fe8871045','d78b44bb-58d7-4668-94b5-77f8a3fca965','5ed59edd-9f62-45e2-9903-8cf90cd2c11e',NULL,'e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','SPP Bulanan','SPP','Januari',10000.00,10000.00,0.00,'LUNAS','2025-03-29','2025-03-29 10:36:28','2025-03-29 10:36:28');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
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
-- Table structure for table `profil_sekolah`
--

DROP TABLE IF EXISTS `profil_sekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profil_sekolah` (
  `id_profil` char(36) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `kepala_sekolah` varchar(255) NOT NULL,
  `npsn` varchar(255) DEFAULT NULL,
  `alamat_sekolah` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `tahun_pelajaran` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profil_sekolah`
--

LOCK TABLES `profil_sekolah` WRITE;
/*!40000 ALTER TABLE `profil_sekolah` DISABLE KEYS */;
INSERT INTO `profil_sekolah` VALUES ('e27a6e4c-39fd-403e-b5d0-fb7bbcdea006','MI khusas','Muhammad Irfan','12131','Walet jalan raya','irfanfann005@gmail.com','https://drive.google.com','6201201','2022/2012','logo3.png','2025-04-07 04:39:46','2025-04-07 04:42:18');
/*!40000 ALTER TABLE `profil_sekolah` ENABLE KEYS */;
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
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id_settings` char(36) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL DEFAULT 'INFAQKU',
  `ikon_sidebar` varchar(255) NOT NULL DEFAULT 'fa-dollar-sign',
  `warna_sidebar` varchar(255) NOT NULL DEFAULT 'bg-gradient-primary',
  `footer` varchar(255) NOT NULL DEFAULT 'Copyright © Pembayaran SPP',
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_settings`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('1a5d1d6b-13b5-11f0-807c-0a002700000b','SB ADMIN1','fas fa-sad-tear','bg-gradient-primary','Copyright © Pembayaran SPP 2025','assets/img/logo-login/logo.png','2025-04-06 04:01:22','2025-04-07 23:15:13');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
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
  `category` varchar(50) NOT NULL,
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
INSERT INTO `siswas` VALUES ('0644abb1-ad11-443f-94af-50a94f76c44a','MARIA','Laki-laki','14542011','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','e5b6411e-9820-4ac7-9a8b-fc959808a927','Sorong','2025-04-04','IPA','Atas','AKTIF','2025-04-02 03:39:49','2025-04-05 06:27:27'),('0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','Perempuan','923903','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-22','IPA','Atas','AKTIF','2025-04-05 17:30:50','2025-04-05 17:30:50'),('23b59d89-0d9a-4d3d-a57a-55bf9109abcf','YULI','Perempuan','525462','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-10','IPA','Atas','AKTIF','2025-04-05 17:30:04','2025-04-05 17:30:04'),('26cc54bc-393e-492b-a636-10bc349043c0','SAMSUL','Laki-laki','602422','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:29:19','2025-04-05 17:29:19'),('3181ffa0-d536-400c-9bdd-1bace1f31e29','MariyaI','Perempuan','112211','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','29eed6a1-29d1-4d66-9c06-ef5d8d8f42c5','Sorong','2025-04-05','IPA','Bawah','AKTIF','2025-04-02 03:14:18','2025-04-02 03:44:53'),('38805746-7c6b-4870-85c3-6719988d02d1','SAIFUL','Laki-laki','882557','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','096171fd-64a0-41fc-b918-827ba652d885','Sorong','2025-04-04','IPA','Bawah','AKTIF','2025-04-05 17:21:48','2025-04-05 17:23:22'),('491b4bf8-239e-4f64-af10-3039173714e2','YANTI','Perempuan','291547','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:27:08','2025-04-05 17:27:08'),('50526526-7ca9-43f1-8a9a-c2ba94c01c16','SITI','Perempuan','434511','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:26:20','2025-04-05 17:26:20'),('76cdd947-1c78-4537-84ea-316879c7fc4b','AGUSS','Laki-laki','342514','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','0ba2a38e-7306-4e72-ae81-85db528c3092','Sorong','2025-04-16','IPA','Atas','AKTIF','2025-04-05 17:32:11','2025-04-07 18:44:06'),('8f542e1d-1015-43af-a36a-f4ccc67e3260','Muhammad Rehan','Laki-laki','11426','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','c4ae7674-7fe5-4613-96bf-330648ce5069','Sorong','2003-04-02','IPA','Menengah','AKTIF','2025-04-05 06:35:37','2025-04-05 06:37:19'),('9fa24eec-d834-4e83-8938-f11bee7ae3b3','TAMAR','Laki-laki','751949','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-25','IPA','Atas','AKTIF','2025-04-05 17:25:28','2025-04-05 17:25:28'),('b9ac9783-e702-4991-a03c-1d6823f92537','YANTO','Laki-laki','885670','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:24:09','2025-04-05 17:24:09'),('c90f9421-5bb2-4cf9-9ab4-d5389e4b5980','EKO','Laki-laki','484506','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-16','IPA','Atas','AKTIF','2025-04-05 17:31:39','2025-04-05 17:31:39'),('dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','Perempuan','145420121001','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','07e5faee-9814-4cff-899a-4e25af651a01','Sorong','2025-03-01','IPA','Menengah','AKTIF','2025-03-23 04:20:35','2025-04-02 03:45:45'),('e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','Laki-laki','1','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','588899c5-d422-44c2-b37d-ec2a275886aa','Sorong','2025-03-01','IPA','Atas','AKTIF','2025-03-22 23:39:42','2025-04-02 03:45:58'),('f3f788fa-ee30-458e-b75e-57ede609718f','ASTUTIK','Perempuan','668270','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-12-31','IPA','Atas','AKTIF','2025-04-05 17:28:18','2025-04-05 17:28:18');
/*!40000 ALTER TABLE `siswas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagihan`
--

DROP TABLE IF EXISTS `tagihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagihan` (
  `id_tagihan` char(36) NOT NULL,
  `id_siswa` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` varchar(255) NOT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `id_biaya` char(36) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama_pembayaran` varchar(255) NOT NULL,
  `jenis` enum('SPP','NON-SPP') NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `bulan` varchar(255) DEFAULT NULL,
  `status` enum('BELUM DIBAYAR','SUDAH DIBAYAR') NOT NULL DEFAULT 'BELUM DIBAYAR',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `tagihan_id_siswa_foreign` (`id_siswa`),
  KEY `tagihan_id_biaya_foreign` (`id_biaya`),
  CONSTRAINT `tagihan_id_biaya_foreign` FOREIGN KEY (`id_biaya`) REFERENCES `biaya` (`id_biaya`) ON DELETE CASCADE,
  CONSTRAINT `tagihan_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswas` (`id_siswa`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagihan`
--

LOCK TABLES `tagihan` WRITE;
/*!40000 ALTER TABLE `tagihan` DISABLE KEYS */;
INSERT INTO `tagihan` VALUES ('b200fe02-0121-4e0f-af45-543900169122','23b59d89-0d9a-4d3d-a57a-55bf9109abcf','YULI','525462','IPA','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','11','Februari','BELUM DIBAYAR','2025-04-07 23:28:25','2025-04-07 23:28:25'),('de159f76-94fa-4797-8a0c-70651f098b4e','0644abb1-ad11-443f-94af-50a94f76c44a','MARIA','14542011','IPA','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','11','Januari','BELUM DIBAYAR','2025-04-07 23:28:16','2025-04-07 23:28:16');
/*!40000 ALTER TABLE `tagihan` ENABLE KEYS */;
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
INSERT INTO `users` VALUES ('MARIA GURETTY ALATUBIR','$2y$12$zDO1CTqV.fy5/u1xydkvdepNHNd77dbNii0kkiLCyZpMV7SaNmYam','15897','2025-03-23 04:20:46','2025-03-23 04:26:34','07e5faee-9814-4cff-899a-4e25af651a01','145420121001','2',NULL),('SAIFUL','$2y$12$gJ50g6Az.DNhZI5c76ix5.3Rae4QdJzgrvkj8zBnf69ONv9nhkE9K','30127','2025-04-05 17:23:22','2025-04-05 17:23:22','096171fd-64a0-41fc-b918-827ba652d885','882557','2',NULL),('AGUS','$2y$12$K8Avjd1VXUXYoCZa3MweXez7ukoJm6hAPF./4vxfLoaJxOgTQ.qqa','99574','2025-04-05 17:36:14','2025-04-06 21:35:20','0ba2a38e-7306-4e72-ae81-85db528c3092','342514','2',NULL),('Mariya','$2y$12$0Tn/HQ4jPVfqNUwtpHjxz./mXrxfj2WBiIYtJ1XllWqeGBiF.l622','44279','2025-04-02 03:14:45','2025-04-02 03:14:45','29eed6a1-29d1-4d66-9c06-ef5d8d8f42c5','112211','2',NULL),('NAS','$2y$12$YYCUwSK0y0l9Q5BxMRRMnebvePFI24hYvUaZ5Uts7g6xBQ3X9s.5i','59232','2025-03-29 03:03:50','2025-03-29 03:07:43','32001624-8543-4830-ade5-f91a82ddabd9','1112','3',NULL),('Muhamat Irfan','$2y$12$BOFaUnslDxDcQlRqxG1O.eRt/3kPutSGFxDvrE3RQlp1fLfJQuPlC','21141','2025-03-22 23:39:51','2025-03-23 05:06:13','588899c5-d422-44c2-b37d-ec2a275886aa','1','2',NULL),('Muhammad Rehan','$2y$12$.hII5noNlruWOm9rbrnGiuk0U.Nbgi0f9YagcqWQpu2u0NCvM3jwm','123456','2025-04-05 06:37:19','2025-04-05 06:49:33','c4ae7674-7fe5-4613-96bf-330648ce5069','11426','1',NULL),('Administrator','$2y$12$mnO44FollEr8vf7FEDyzOOFgGz.SPBKbVVtJSoALKYw9x1a3NQLuW','admin','2025-03-19 16:37:40','2025-03-23 17:08:54','d78b44bb-58d7-4668-94b5-77f8a3fca965','admin','1','2025-03-22 22:06:10'),('MARIA','$2y$12$fW44PFQ87W04/KATluGsseduM.4fd6PHd.l9oMsE6Srr7dZ72TJnm','111111','2025-04-05 06:27:27','2025-04-05 06:31:49','e5b6411e-9820-4ac7-9a8b-fc959808a927','14542011','2',NULL);
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

-- Dump completed on 2025-04-09 17:29:07
