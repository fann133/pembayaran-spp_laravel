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
INSERT INTO `biaya` VALUES ('39a02fd1-71c9-489c-905a-4b2619b21732','SPP Bulanann','SPP','SPP-M',NULL,'10000','AKTIF','Menengah','2025-03-27 23:35:50','2025-04-09 17:58:48'),('6a40b62f-1398-4952-80b2-9db27b668100','SPP Bulanan','SPP','11','asad','10000','AKTIF','Atas','2025-03-26 02:21:52','2025-04-09 17:59:14'),('a38fbb3d-e257-4d88-8807-1a3172e32a5e','SPP Bulanan','SPP','SPP-B',NULL,'50000','AKTIF','Bawah','2025-04-02 03:07:45','2025-04-02 03:07:59'),('c6815c8f-cd20-48b5-8028-d6a24ae7416f','Baju','NON-SPP','BBK',NULL,'100000','AKTIF','Atas','2025-03-27 23:13:36','2025-03-27 23:33:54'),('f3fb8eff-8dec-4d33-ab6d-399344e92901','Seragam Olahraga','NON-SPP','SGRM',NULL,'150000','AKTIF','Atas','2025-04-06 21:14:07','2025-04-06 21:14:07');
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
INSERT INTO `gurus` VALUES ('6fec5469-0bf3-4253-a364-9ae1ae74d924','89edf248-74f6-4a57-8e7a-d160f1b499d5','1112','NASI','Laki-laki','Sorong','2025-03-01','Islam','TETAP','3','2025-03-29 03:03:41','2025-04-17 01:42:50'),('8515110b-ae77-42a7-8cae-896590f402f7',NULL,'1432','MUHAMAT IRFAN RIFAI','Laki-laki','Sorong','2025-04-04','Islam','MAGANG','4','2025-03-23 17:47:33','2025-04-04 02:34:36');
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
INSERT INTO `kelas` VALUES ('4c2b6d70-6c31-4a90-9324-82c3e6e436ef','IPA','MIPA',NULL,'6fec5469-0bf3-4253-a364-9ae1ae74d924','2025-03-27 23:31:17','2025-05-18 23:17:21'),('5f41c295-4786-401d-bed0-d3523dcde78e','TKJ','TKJ-2021',NULL,NULL,'2025-04-09 20:40:07','2025-04-09 20:40:07'),('a5dab855-17f7-44bd-a4d9-1ff602c090c8','TBSMS','TBSM',NULL,NULL,'2025-04-04 02:45:46','2025-04-04 02:45:46'),('ef7aa50e-0148-4da6-9a40-6a4f9c07f5e9','IPAS','MIPAS',NULL,NULL,'2025-04-04 02:43:15','2025-04-17 01:42:26');
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_03_19_024632_create_logins_table',1),(6,'2025_03_19_054523_create_sessions_table',2),(7,'2025_03_19_062503_create_siswas_table',3),(8,'2025_03_20_012538_update_users_table',4),(9,'2025_03_20_030008_add_status_to_siswas_table',5),(10,'2025_03_20_041015_update_status_enum_in_siswas_table',6),(11,'2025_03_20_041804_update_status_enum_remove_tidak_aktif',7),(14,'2025_03_20_042535_update_enum_status_on_siswas_table',8),(15,'2025_03_20_045420_update_status_column_on_siswas_table',8),(16,'2025_03_20_050815_update_status_column_on_siswas_table',9),(17,'2025_03_20_050831_update_status_column_on_siswas_table',9),(19,'2025_03_21_065117_add_bypass_column_to_users_table',10),(20,'2025_03_21_065835_modify_users_table',11),(21,'2025_03_21_070208_modify_users_table',11),(22,'2025_03_21_072817_create_gurus_table',12),(23,'2025_03_22_013414_add_users_id_to_siswas_table',13),(24,'2025_03_22_023010_add_jenis_kelamin__to_siswas_table',14),(25,'2025_03_22_031320_add_columns_to_gurus_table',15),(26,'2025_03_22_034723_update_users_id_foreign_key_on_siswas_table',16),(27,'2025_03_24_021702_create_kelas_table',17),(28,'2025_03_24_021732_add_id_kelas_to_siswas_table',17),(29,'2025_03_24_024239_add_pengampu_kelas_to_kelas_table',18),(30,'2025_03_24_025117_add_unique_pengampu_to_kelas',19),(31,'2025_03_24_043749_modify_kelas_column_on_siswas_table',20),(32,'2025_03_24_073105_create_biaya_table',21),(33,'2025_03_24_075433_update_status_column_in_biaya_table',22),(34,'2025_03_24_080203_update_biaya_table',23),(35,'2025_03_26_114515_create_tagihan_table',24),(36,'2025_03_27_120939_add_kelas_to_tagihan_table',25),(37,'2025_03_28_084300_add_tanggal_bayar_to_tagihan_table',26),(38,'2025_03_28_191729_remove_tanggal_bayar_from_tagihan_table',27),(39,'2025_03_28_195130_create_pembayaran_table',28),(40,'2025_03_28_195349_add_tanggal_bayar_to_pembayaran_table',29),(41,'2025_03_28_202122_add_bulan_to_pembayaran_table',30),(42,'2025_03_28_202716_add_id_users_to_pembayaran_table',31),(43,'2025_03_29_191754_add_kode_to_tagihan_and_pembayaran',32),(44,'2025_04_02_115928_change_category_column_type_in_siswas_table',33),(45,'2025_04_04_114034_remove_id_guru_from_kelas_table',34),(46,'2025_04_06_030403_create_settings_table',35),(48,'2025_04_07_120813_create_profil_sekolah_table',36),(49,'2025_04_07_133256_rename_id_to_id_settings_on_settings_table',36),(50,'2025_04_10_071425_add_tanggal_tagihan_to_tagihan_table',37),(51,'2025_04_13_205201_rename_warna_sidebar_to_tema_in_settings_table',38),(52,'2025_04_19_224346_add_ip_and_user_agent_to_users_table',39),(53,'2025_05_03_024356_add_gambar_column_to_users_table',40),(54,'2025_05_21_111458_add_columns_to_profil_sekolah_table',41),(55,'2025_05_27_104653_add_captcha_enabled_to_settings_table',42);
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
INSERT INTO `pembayaran` VALUES ('0a4a9903-7d42-4751-a6d6-ed34fbd12aa8','d78b44bb-58d7-4668-94b5-77f8a3fca965','64b9e560-91a5-4d7c-ab38-a9c3d201b53a','11','0644abb1-ad11-443f-94af-50a94f76c44a','MARIA','14542011','IPA','SPP Bulanan','SPP','April',9990.00,9990.00,0.00,'LUNAS','2025-05-11','2025-04-10 17:35:46','2025-04-10 17:35:46'),('262b8ce4-3dca-4414-a281-2bdf8b403ed1','89edf248-74f6-4a57-8e7a-d160f1b499d5','bd444236-76a3-4ae1-a736-cb36b76975d4','11','23b59d89-0d9a-4d3d-a57a-55bf9109abcf','YULI','525462','IPA','SPP Bulanan','SPP','April',10000.00,1000.00,9000.00,'BELUM LUNAS','2025-04-17','2025-04-17 03:10:18','2025-04-17 03:10:18'),('327bc283-1923-49e7-b683-b28e75071f7a','d78b44bb-58d7-4668-94b5-77f8a3fca965','7e5c664f-fbe3-418d-9e87-3581d2d03d81','11','0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','923903','TKJ','SPP Bulanan','SPP','Maret',9000.00,9000.00,0.00,'LUNAS','2025-04-17','2025-04-17 04:14:54','2025-04-17 04:14:54'),('41fe904c-e26c-4339-ac58-4578384d55a6','d78b44bb-58d7-4668-94b5-77f8a3fca965','64b9e560-91a5-4d7c-ab38-a9c3d201b53a','11','0644abb1-ad11-443f-94af-50a94f76c44a','MARIA','14542011','IPA','SPP Bulanan','SPP','April',10000.00,10.00,9990.00,'BELUM LUNAS','2025-04-11','2025-04-10 17:35:35','2025-04-10 17:35:35'),('482965d1-08a3-4b0e-9011-2d2cbc87c25a','d78b44bb-58d7-4668-94b5-77f8a3fca965','7e5c664f-fbe3-418d-9e87-3581d2d03d81','11','0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','923903','TKJ','SPP Bulanan','SPP','Maret',10000.00,1000.00,9000.00,'BELUM LUNAS','2025-04-17','2025-04-17 04:03:23','2025-04-17 04:03:23'),('649d97ca-1fa9-46fc-850f-978cdef6ab65','89edf248-74f6-4a57-8e7a-d160f1b499d5','bd444236-76a3-4ae1-a736-cb36b76975d4','11','23b59d89-0d9a-4d3d-a57a-55bf9109abcf','YULI','525462','IPA','SPP Bulanan','SPP','April',9000.00,9000.00,0.00,'LUNAS','2025-04-17','2025-04-17 03:10:47','2025-04-17 03:10:47'),('82d7ca81-6114-477f-8b67-e89dd95f7030','d78b44bb-58d7-4668-94b5-77f8a3fca965','e7b7bd17-c06a-4667-9d0f-6c12c56c6763','11','0644abb1-ad11-443f-94af-50a94f76c44a','MARIA','14542011','IPA','SPP Bulanan','SPP','Maret',10000.00,10000.00,0.00,'LUNAS','2025-05-26','2025-05-26 03:10:24','2025-05-26 03:10:24'),('b2897bc2-a257-4aee-ba74-ac783cd9c6e3','89edf248-74f6-4a57-8e7a-d160f1b499d5','cac314c4-bc62-45a6-9818-00415bbc9b23','11','e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','SPP Bulanan','SPP','Januari',10000.00,10000.00,0.00,'LUNAS','2025-04-17','2025-04-17 04:16:54','2025-04-17 04:16:54'),('be40c907-70b8-4590-bc07-3b6b7b6c0f09','d78b44bb-58d7-4668-94b5-77f8a3fca965','1ae28b41-c029-4e35-aaa1-5588800601c4','SGRM','3181ffa0-d536-400c-9bdd-1bace1f31e29','MariyaI','112211','IPA','Seragam Olahraga','NON-SPP','',150000.00,150000.00,0.00,'LUNAS','2026-04-12','2025-04-11 15:02:54','2025-04-11 15:02:54');
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
  `naungan` varchar(255) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `kepala_sekolah` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `npsn` varchar(255) DEFAULT NULL,
  `nsm` varchar(255) NOT NULL,
  `akreditasi` varchar(255) NOT NULL,
  `sk` varchar(255) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `tahun_pelajaran` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_naungan` varchar(255) NOT NULL,
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
INSERT INTO `profil_sekolah` VALUES ('e27a6e4c-39fd-403e-b5d0-fb7bbcdea006','PONDOK PESANTREN ROUDLOTUL KHUFFADZ','MI ROUDLOTUL KHUFFADZ','Muhammad Irfan','12345','60724564','111292010010','B','SK BAP-S/M : 045/BAP-SM/LL/XII/2013','Jl. Wortel Lorong Kakatua Kel. Malasom Distrik Aimas Kab.Sorong Papua Barat Daya','98418','irfanfann005@gmail.com','https://drive.google.com','0811486625','2022/2023','logo9.png','logo_naungan.png','2025-04-07 04:39:46','2025-05-31 21:40:08');
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
  `tema` varchar(255) NOT NULL DEFAULT 'bg-gradient-primary',
  `footer` varchar(255) NOT NULL DEFAULT 'Copyright © Pembayaran SPP',
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `captcha_enabled` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_settings`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('1a5d1d6b-13b5-11f0-807c-0a002700000b','SB ADMIN 2','fas fa-wallet','primary','Copyright © Pembayaran SPP 2025','assets/img/logo-login/logo.png','2025-04-06 04:01:22','2025-05-27 02:14:20',1);
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
INSERT INTO `siswas` VALUES ('0644abb1-ad11-443f-94af-50a94f76c44a','MARIA','Laki-laki','14542011','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','e5b6411e-9820-4ac7-9a8b-fc959808a927','Sorong','2025-04-04','IPA','Atas','AKTIF','2025-04-02 03:39:49','2025-04-05 06:27:27'),('0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','Perempuan','923903','5f41c295-4786-401d-bed0-d3523dcde78e','cedbdf3d-7ec0-49ea-a6cd-a14e1e38a3da','Sorong','2025-04-22','TKJ','Atas','AKTIF','2025-04-05 17:30:50','2025-04-14 01:55:37'),('23b59d89-0d9a-4d3d-a57a-55bf9109abcf','YULI','Perempuan','525462','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-10','IPA','Atas','AKTIF','2025-04-05 17:30:04','2025-04-05 17:30:04'),('26cc54bc-393e-492b-a636-10bc349043c0','SAMSUL','Laki-laki','602422','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:29:19','2025-04-05 17:29:19'),('3181ffa0-d536-400c-9bdd-1bace1f31e29','MariyaI','Perempuan','112211','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','29eed6a1-29d1-4d66-9c06-ef5d8d8f42c5','Sorong','2025-04-05','IPA','Bawah','AKTIF','2025-04-02 03:14:18','2025-04-02 03:44:53'),('38805746-7c6b-4870-85c3-6719988d02d1','SAIFUL','Laki-laki','882557','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','096171fd-64a0-41fc-b918-827ba652d885','Sorong','2025-04-04','IPA','Bawah','AKTIF','2025-04-05 17:21:48','2025-04-05 17:23:22'),('491b4bf8-239e-4f64-af10-3039173714e2','YANTI','Perempuan','291547','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:27:08','2025-04-05 17:27:08'),('50526526-7ca9-43f1-8a9a-c2ba94c01c16','SITI','Perempuan','434511','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:26:20','2025-04-05 17:26:20'),('76cdd947-1c78-4537-84ea-316879c7fc4b','AGUS','Laki-laki','342514','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','0ba2a38e-7306-4e72-ae81-85db528c3092','Sorong','0001-01-01','IPA','Atas','PINDAHAN','2025-04-05 17:32:11','2025-05-18 22:48:39'),('8f542e1d-1015-43af-a36a-f4ccc67e3260','Muhammad Rehan','Laki-laki','11426','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','c4ae7674-7fe5-4613-96bf-330648ce5069','Sorong','2003-04-02','IPA','Menengah','AKTIF','2025-04-05 06:35:37','2025-04-05 06:37:19'),('9fa24eec-d834-4e83-8938-f11bee7ae3b3','TAMAR','Laki-laki','751949','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-25','IPA','Atas','AKTIF','2025-04-05 17:25:28','2025-04-05 17:25:28'),('b9ac9783-e702-4991-a03c-1d6823f92537','YANTO','Laki-laki','885670','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-04-01','IPA','Atas','AKTIF','2025-04-05 17:24:09','2025-04-05 17:24:09'),('dca8e949-0fd8-4481-925a-12a6aac35d7d','MARIA GURETTY ALATUBIR','Perempuan','145420121001','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','07e5faee-9814-4cff-899a-4e25af651a01','Sorong','2025-03-01','IPA','Menengah','AKTIF','2025-03-23 04:20:35','2025-04-02 03:45:45'),('e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','Laki-laki','12345','4c2b6d70-6c31-4a90-9324-82c3e6e436ef','588899c5-d422-44c2-b37d-ec2a275886aa','Sorong','2025-03-01','IPA','Atas','AKTIF','2025-03-22 23:39:42','2025-05-23 13:16:33'),('f3f788fa-ee30-458e-b75e-57ede609718f','ASTUTIK','Perempuan','668270','4c2b6d70-6c31-4a90-9324-82c3e6e436ef',NULL,'Sorong','2025-12-31','IPA','Atas','AKTIF','2025-04-05 17:28:18','2025-04-05 17:28:18');
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
  `tanggal_tagihan` date DEFAULT NULL,
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
INSERT INTO `tagihan` VALUES ('1a497962-9b37-477a-9f83-ac34a9108198','0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','923903','TKJ','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','April','BELUM DIBAYAR','2025-04-11','2025-04-10 23:12:51','2025-04-10 23:12:51'),('4f9ec467-6918-4740-b045-fbf7a1e823d4','0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','923903','TKJ','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','Januari','BELUM DIBAYAR','2025-04-14','2025-04-14 01:54:49','2025-04-14 01:54:49'),('5fd6f4f1-8d53-46dc-8fc2-b6880ddff578','e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','f3fb8eff-8dec-4d33-ab6d-399344e92901','SGRM','Seragam Olahraga','NON-SPP','150000','','SUDAH DIBAYAR','2025-04-13','2025-04-13 12:02:48','2025-04-14 00:16:09'),('7e5c664f-fbe3-418d-9e87-3581d2d03d81','0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','923903','TKJ','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','Maret','SUDAH DIBAYAR','2025-04-14','2025-04-14 01:55:17','2025-04-17 04:14:54'),('87e26b56-e64d-418a-8272-d9c02283e1fc','e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','12345','IPA','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','Januari','BELUM DIBAYAR','2025-05-23','2025-05-23 13:24:53','2025-05-23 13:24:53'),('b32a8d88-9441-462f-9329-46c8dc1f2f24','0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','923903','TKJ','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','Mei','BELUM DIBAYAR','2025-05-11','2025-04-10 23:13:22','2025-04-10 23:13:22'),('ba80e031-daf9-4fac-b9ec-2479b44a555f','0f780594-937e-4cdd-8011-51a1173f66bb','YEYEN','923903','TKJ','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','Februari','BELUM DIBAYAR','2025-04-14','2025-04-14 01:54:58','2025-04-14 01:54:58'),('bd444236-76a3-4ae1-a736-cb36b76975d4','23b59d89-0d9a-4d3d-a57a-55bf9109abcf','YULI','525462','IPA','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','April','SUDAH DIBAYAR','2025-04-11','2025-04-10 23:17:03','2025-04-17 03:10:47'),('cac314c4-bc62-45a6-9818-00415bbc9b23','e0347d45-43dc-4414-9df9-ee0bd80a9c0b','Muhamat Irfan','1','IPA','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','Januari','SUDAH DIBAYAR','2025-04-12','2025-04-12 04:25:59','2025-04-17 04:16:54'),('e7b7bd17-c06a-4667-9d0f-6c12c56c6763','0644abb1-ad11-443f-94af-50a94f76c44a','MARIA','14542011','IPA','6a40b62f-1398-4952-80b2-9db27b668100','11','SPP Bulanan','SPP','10000','Maret','SUDAH DIBAYAR','2025-05-26','2025-05-26 03:10:14','2025-05-26 03:10:24');
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
  `gambar` varchar(255) DEFAULT NULL,
  `role_id` enum('1','2','3','4','5') NOT NULL,
  `login_times` timestamp NULL DEFAULT NULL,
  `last_ip` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('MARIA GURETTY ALATUBIR','$2y$12$Jx98vjuGjfNzPd9aW2jdcO9a0qiQhpH2P4kqjTJiia/ix59hFOrrW','15897','2025-03-23 04:20:46','2025-05-31 16:21:30','07e5faee-9814-4cff-899a-4e25af651a01','145420121001','maria-guretty-alatubir_145420121001-1746256368.jpeg','2','2025-05-02 21:17:43','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','2025-05-02 22:59:18'),('SAIFUL','$2y$12$gJ50g6Az.DNhZI5c76ix5.3Rae4QdJzgrvkj8zBnf69ONv9nhkE9K','30127','2025-04-05 17:23:22','2025-04-05 17:23:22','096171fd-64a0-41fc-b918-827ba652d885','882557',NULL,'2',NULL,NULL,NULL,NULL),('AGUS','$2y$12$K8Avjd1VXUXYoCZa3MweXez7ukoJm6hAPF./4vxfLoaJxOgTQ.qqa','99574','2025-04-05 17:36:14','2025-04-20 14:21:51','0ba2a38e-7306-4e72-ae81-85db528c3092','342514',NULL,'2','2025-04-20 14:19:48','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','2025-04-20 14:21:51'),('Mariya','$2y$12$0Tn/HQ4jPVfqNUwtpHjxz./mXrxfj2WBiIYtJ1XllWqeGBiF.l622','44279','2025-04-02 03:14:45','2025-04-02 03:14:45','29eed6a1-29d1-4d66-9c06-ef5d8d8f42c5','112211',NULL,'2',NULL,NULL,NULL,NULL),('NAS','$2y$12$HKIISe8eZ3Iz6THtIYFIReFo22IHONb1F7mP3mH/u.AxANSFSDCAe','admin1','2025-03-29 03:03:50','2025-04-19 14:15:00','32001624-8543-4830-ade5-f91a82ddabd9','2',NULL,'3','2025-04-19 14:14:27','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','2025-04-19 14:15:00'),('Muhamat Irfan','$2y$12$eN3QhES2tsMi1kOjqU36oeAKenwu79lWB99FQGVWeOSOVJ20BMZcW','21141','2025-03-22 23:39:51','2025-05-23 13:25:28','588899c5-d422-44c2-b37d-ec2a275886aa','12345',NULL,'2','2025-05-23 13:17:56','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','2025-05-23 13:25:28'),('NASI','$2y$12$iArXRaJcIItxOMS1YDZB9.917BzPv7IWny86N2OrqxIvBf4/xzZQy','61423','2025-04-17 01:42:50','2025-04-17 04:16:25','89edf248-74f6-4a57-8e7a-d160f1b499d5','1112',NULL,'3','2025-04-17 04:16:25',NULL,NULL,NULL),('Muhammad Rehan','$2y$12$.hII5noNlruWOm9rbrnGiuk0U.Nbgi0f9YagcqWQpu2u0NCvM3jwm','123456','2025-04-05 06:37:19','2025-04-05 06:49:33','c4ae7674-7fe5-4613-96bf-330648ce5069','11426',NULL,'1',NULL,NULL,NULL,NULL),('YEYEN','$2y$12$oyX11fx7kYy5.0ndVGj0H.Sc2/WJjPJhbERZvzXFgSnSMe1Wy03oK','31453','2025-04-14 01:55:37','2025-04-20 14:38:13','cedbdf3d-7ec0-49ea-a6cd-a14e1e38a3da','923903',NULL,'2','2025-04-20 14:38:13','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0','2025-04-20 14:38:13'),('Administrator','$2y$12$j6s8axxqEFFbew.79Ii2RumexXk57TkVMlwtUj5scbuXcfi65OeT6','admin','2025-03-19 16:37:40','2025-05-31 22:04:43','d78b44bb-58d7-4668-94b5-77f8a3fca965','admin',NULL,'1','2025-05-31 21:28:03','192.168.11.106','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-31 22:04:43'),('MARIA','$2y$12$fW44PFQ87W04/KATluGsseduM.4fd6PHd.l9oMsE6Srr7dZ72TJnm','111111','2025-04-05 06:27:27','2025-04-05 06:31:49','e5b6411e-9820-4ac7-9a8b-fc959808a927','14542011',NULL,'2',NULL,NULL,NULL,NULL);
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

-- Dump completed on 2025-06-01 16:05:07
