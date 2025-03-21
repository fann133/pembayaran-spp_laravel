-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 09:31 AM
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
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id_guru`, `nip`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `created_at`, `updated_at`) VALUES
('d4697cb2-266a-4c27-9a60-85410925e9f0', '1234567890', 'Budi Santoso', 'Laki-laki', 'Jakarta', '1980-05-15', 'Islam', '2025-03-20 22:46:18', '2025-03-20 22:46:18');

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
(22, '2025_03_21_072817_create_gurus_table', 12);

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
  `nis` varchar(255) NOT NULL,
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

INSERT INTO `siswas` (`id_siswa`, `nama`, `nis`, `tempat_lahir`, `tanggal_lahir`, `kelas`, `category`, `status`, `created_at`, `updated_at`) VALUES
('3619936c-fb11-4562-94e7-e0182693f3af', 'Siti Aisyah', '20231002', 'Bandung', '2006-08-22', 'XI IPS 2', 'menengah', 'AKTIF', '2025-03-18 21:32:41', '2025-03-18 21:32:41'),
('3afe3e4b-5ca1-4f33-9caa-cbe0a38226fc', 'MUHAMAT IRFAN RIFAI2', '2023100612', 'Sorong1', '2025-02-28', '1223', 'atas', 'LULUS', '2025-03-20 17:49:48', '2025-03-20 21:15:29'),
('9d22bce6-a545-40c3-a2c5-b29529a76871', 'Ahmad Fauzan', '20231001', 'Jakarta', '2005-06-15', 'XII IPA 1', 'atas', 'AKTIF', '2025-03-18 21:32:41', '2025-03-18 21:32:41'),
('d8d0566e-4c6e-419d-a77a-27fa4a43da15', 'Bayu', '20231003', 'Banjar', '2025-03-01', 'MIPA 1', 'atas', 'AKTIF', '2025-03-19 22:56:00', '2025-03-19 22:56:00');

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
('Siti Aisyah', '$2y$12$CIxPsqTLFz2goh2YB342Qe7ppxHqwcR/vXTRmmK7d3dujsqMHh3lC', 'Y1HLRKcV', '2025-03-20 23:27:04', '2025-03-20 23:28:25', '289014ce-f296-466c-8b00-92519a9c7d01', '20231002', '2', '2025-03-20 23:28:25'),
('Budi Santoso', '$2y$12$cL22jSMYzKrpw/TlAFkKJO0m9RgB4jM9akyYiXdgb9qd7AwEzAiMS', 'Bv6sMl4n', '2025-03-20 23:27:21', '2025-03-20 23:27:21', '4c76df62-b2d6-4564-b939-4d956becf47c', '1234567890', '3', NULL),
('Bayu', '$2y$12$br71MBilvFz2xjkqLVdal.m2UoDHw90.28xgbRKwE6BdLzM9SOupq', '60058', '2025-03-20 23:31:17', '2025-03-20 23:31:17', '6ecf6918-c83e-45f1-bda1-3a654f8661e7', '20231003', '2', NULL),
('Administrator', '$2y$12$RXP.ZpY0sfnumX2u5qEVfeakWlgYiBDQ5.3s9FzCSoKO9mrDmk.Wq', 'password123', '2025-03-19 16:37:40', '2025-03-20 23:24:48', 'd78b44bb-58d7-4668-94b5-77f8a3fca965', 'admin', '1', '2025-03-20 23:24:48');

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
  ADD UNIQUE KEY `gurus_nip_unique` (`nip`);

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
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
