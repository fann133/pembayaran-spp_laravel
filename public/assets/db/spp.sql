-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 09:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gurus`
--

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id_guru`, `users_id`, `nip`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
('d4697cb2-266a-4c27-9a60-85410925e9f0', '4301fe0f-d039-43b8-89b7-f5a12377cbef', '12345678901', 'Budi Santoso', 'Laki-laki', 'Jakarta', '1980-05-15', 'Islam', 'HONOR', '4', '2025-03-20 22:46:18', '2025-03-21 22:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_19_024632_create_logins_table', 1),
(6, '2025_03_19_054523_create_sessions_table', 2),
(7, '2025_03_19_062503_create_siswas_table', 3),
(8, '2025_03_20_012538_update_users_table', 4),
(9, '2025_03_20_030008_add_status_to_siswas_table', 5),
(10, '2025_03_20_041015_update_status_enum_in_siswas_table', 6),
(11, '2025_03_20_041804_update_status_enum_remove_tidak_aktif', 7),
(14, '2025_03_20_042535_update_enum_status_on_siswas_table', 8),
(15, '2025_03_20_045420_update_status_column_on_siswas_table', 8),
(16, '2025_03_20_050815_update_status_column_on_siswas_table', 9),
(17, '2025_03_20_050831_update_status_column_on_siswas_table', 9),
(19, '2025_03_21_065117_add_bypass_column_to_users_table', 10),
(20, '2025_03_21_065835_modify_users_table', 11),
(21, '2025_03_21_070208_modify_users_table', 11),
(22, '2025_03_21_072817_create_gurus_table', 12),
(23, '2025_03_22_013414_add_users_id_to_siswas_table', 13),
(24, '2025_03_22_023010_add_jenis_kelamin__to_siswas_table', 14),
(25, '2025_03_22_031320_add_columns_to_gurus_table', 15),
(26, '2025_03_22_034723_update_users_id_foreign_key_on_siswas_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `id_siswa` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `nis` varchar(255) NOT NULL,
  `users_id` char(36) DEFAULT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `category` enum('atas','menengah','bawah') NOT NULL,
  `status` enum('AKTIF','LULUS','PINDAHAN','KELUAR') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswas`
--

INSERT INTO `siswas` (`id_siswa`, `nama`, `jenis_kelamin`, `nis`, `users_id`, `tempat_lahir`, `tanggal_lahir`, `kelas`, `category`, `status`, `created_at`, `updated_at`) VALUES
('3afe3e4b-5ca1-4f33-9caa-cbe0a38226fc', 'MUHAMAT IRFAN RIFAI2', 'Laki-laki', '2023100612', '110c907d-c4dd-4351-a99d-7960056b0117', 'Sorong1', '2025-02-28', '1223', 'atas', 'AKTIF', '2025-03-20 17:49:48', '2025-03-21 19:05:56'),
('9d22bce6-a545-40c3-a2c5-b29529a76871', 'Ahmad Fauzan', 'Laki-laki', '20231001', '89191045-f2f4-479c-a083-0444817e4db1', 'Jakarta', '2005-06-15', 'XII IPA 1', 'atas', 'AKTIF', '2025-03-18 21:32:41', '2025-03-21 19:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bypass` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_users` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role_id` enum('1','2','3','4','5') NOT NULL,
  `login_times` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `bypass`, `created_at`, `updated_at`, `id_users`, `username`, `role_id`, `login_times`) VALUES
('MUHAMAT IRFAN RIFAI2', '$2y$12$2acpEtS0QUzgT5xQRVD/Eec7ViRqbL6oTkXlSJySE7s3IcvsJHfIe', '2JbaFyZl', '2025-03-21 16:51:47', '2025-03-21 16:51:47', '110c907d-c4dd-4351-a99d-7960056b0117', '2023100612', '2', NULL),
('Budi Santoso', '$2y$12$JEKxf2P1IOxh2/LmpR5Qc.tzaFu/SEWiFGmdmmBCK1KrgxGSE54DG', 'asdfsa', '2025-03-21 22:13:35', '2025-03-21 22:49:34', '4301fe0f-d039-43b8-89b7-f5a12377cbef', '1234567890', '1', '2025-03-21 22:39:55'),
('Ahmad Fauzan', '$2y$12$jh0djChUyyKaORKGbsb4R.m3sCRtmCjHjzJ4QXF33z0W.m.c5Q.T2', 'vAjZ4otm', '2025-03-21 16:52:07', '2025-03-21 16:52:07', '89191045-f2f4-479c-a083-0444817e4db1', '20231001', '2', NULL),
('Administrator', '$2y$12$RXP.ZpY0sfnumX2u5qEVfeakWlgYiBDQ5.3s9FzCSoKO9mrDmk.Wq', 'password123', '2025-03-19 16:37:40', '2025-03-21 23:20:11', 'd78b44bb-58d7-4668-94b5-77f8a3fca965', 'admin', '1', '2025-03-21 23:20:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `gurus_nip_unique` (`nip`),
  ADD KEY `gurus_users_id_foreign` (`users_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`),
  ADD KEY `siswas_users_id_foreign` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gurus`
--
ALTER TABLE `gurus`
  ADD CONSTRAINT `gurus_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE SET NULL;

--
-- Constraints for table `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
