-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 04:49 PM
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
-- Database: `project_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatboxes`
--

CREATE TABLE `chatboxes` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sender` enum('admin','user') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `message` text NOT NULL,
  `receiver_id` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatboxes`
--

INSERT INTO `chatboxes` (`id`, `user_id`, `sender`, `message`, `receiver_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'admin', 'kkk', 2, '2025-03-27 07:11:46', '2025-03-27 07:11:46'),
(2, 2, 'user', 'hi', 4, '2025-03-27 08:14:18', '2025-03-27 08:14:18'),
(3, 2, 'admin', 'how are you', 2, '2025-03-27 08:16:41', '2025-03-27 08:16:41'),
(4, 2, 'user', 'I am fine', 4, '2025-03-27 08:17:16', '2025-03-27 08:17:16'),
(9, 2, 'admin', 'hi', 2, '2025-03-28 02:30:51', '2025-03-28 02:30:51'),
(12, 2, 'user', 'ok', 4, '2025-03-28 03:30:59', '2025-03-28 03:30:59'),
(13, 2, 'user', 'Please check my todays work', 4, '2025-03-28 03:35:37', '2025-03-28 03:35:37'),
(14, 2, 'user', 'What\'s up?', 4, '2025-03-28 05:07:51', '2025-03-28 05:07:51'),
(16, 2, 'user', 'Hey admin', 4, '2025-03-28 05:15:04', '2025-03-28 05:15:04'),
(18, 2, 'admin', 'hi', 2, '2025-03-28 05:15:41', '2025-03-28 05:15:41'),
(20, 2, 'user', 'Hello', 4, '2025-03-28 08:38:28', '2025-03-28 08:38:28'),
(21, 2, 'admin', 'Hi', 2, '2025-03-28 08:39:04', '2025-03-28 08:39:04'),
(22, 2, 'user', 'ok', 4, '2025-03-28 09:04:57', '2025-03-28 09:04:57'),
(23, 8, 'user', 'Hello Admin. Please make my designation', 4, '2025-04-03 01:51:52', '2025-04-03 01:51:52'),
(24, 8, 'admin', 'Ok I will do this', 8, '2025-04-03 01:56:02', '2025-04-03 01:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(30) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1:active, 0:inactive	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Full Stack developer', '1', '2025-04-02 07:42:43', '2025-04-03 06:57:55'),
(5, 'Laravel Developer', '1', '2025-04-02 07:42:57', '2025-04-02 07:42:57'),
(6, 'Node js developer', '1', '2025-04-02 09:06:45', '2025-04-03 06:55:17'),
(7, 'Project Manager', '1', '2025-04-03 00:50:04', '2025-04-03 01:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(30) UNSIGNED NOT NULL,
  `team_leader_id` bigint(30) UNSIGNED NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_leader_id`, `team_name`, `created_at`, `updated_at`) VALUES
(6, 2, 'Team2', '2025-04-03 08:37:51', '2025-04-03 08:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(30) UNSIGNED NOT NULL,
  `team_id` bigint(30) UNSIGNED NOT NULL,
  `user_id` bigint(30) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 6, 6, '2025-04-03 08:37:51', '2025-04-03 08:37:51'),
(2, 6, 7, '2025-04-03 08:37:51', '2025-04-03 08:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(30) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `designation_id` bigint(30) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_team_leader` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `image`, `address`, `phone`, `gender`, `designation_id`, `remember_token`, `created_at`, `updated_at`, `is_team_leader`) VALUES
(2, 'Subhra Sanyal', 'user@user.com', '$2y$12$VSFdVwFPP1hkgOJbLBF07eTBGToUh/hIhIcTfBBkW2IkI8dhGv.za', 'user', 'uploads/profile_image/174350316047140.jpg', 'Sodepur, North 24 Pargana', '9435512587', 'male', 7, NULL, '2025-03-26 05:54:49', '2025-04-03 06:53:47', 1),
(4, 'Master Admin', 'admin@admin.com', '$2y$12$o6DlSEOrn7f7k3IigilZguaLtggJ1JJCIA1cFN2dpDzX5IcXjAcbG', 'admin', 'uploads/profile_image/174350330020699.jpg', 'Kolkata, India', '9999994577', 'Female', NULL, NULL, '2025-03-27 01:10:29', '2025-04-02 03:43:51', 0),
(6, 'Riya Das', 'riya@gmail.com', '$2y$12$PXymCAWaVEtTCPz4/FovsONw.1SeXdP03et004tCOmUL.NTtXjpNm', 'user', 'uploads/profile_image/174350306187321.jpg', 'Dhubulia, Nadia', '9412356410', 'female', 5, NULL, '2025-04-01 03:27:15', '2025-04-03 06:53:47', 0),
(7, 'Diana Dsouza', 'diana@gmail.com', '$2y$12$TQvNO5S8QfVHCMgNiuLLtuu5T/ksFRTVPvfb5yJZ7d8yZMJXJD7QC', 'user', 'uploads/profile_image/174349919315271.png', 'Krishnagar, Nadia', '9436512589', 'female', 4, NULL, '2025-04-01 03:49:53', '2025-04-03 00:50:32', 0),
(8, 'Test2name', 'test24@gmail.com', '$2y$12$LsBu9y9JmL6rEKBi7pVLDewDvqzHVSPYSM/PIDygVXPsfPcf8QNnq', 'user', 'uploads/profile_image/174358422376167.jpg', 'Kolkata,Saltlake', '9436512585', 'male', 6, NULL, '2025-04-02 03:27:04', '2025-04-03 06:27:08', 0),
(9, 'Jayeeta Barman', 'jayee@yahoo.com', '$2y$12$dSBhe9.RtWR6K6lH.xJidukO3xn8k8y5UIBVyNXJba6REd.i7Zrwe', 'user', 'uploads/profile_image/174368898863428.png', 'Balurghat', '9446512589', 'female', NULL, NULL, '2025-04-03 08:33:09', '2025-04-03 08:33:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatboxes`
--
ALTER TABLE `chatboxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_foreign_key_user_id` (`user_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_members_ibfk_1` (`team_id`),
  ADD KEY `team_members_ibfk_2` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `designation_foreign_k1` (`designation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatboxes`
--
ALTER TABLE `chatboxes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatboxes`
--
ALTER TABLE `chatboxes`
  ADD CONSTRAINT `user_foreign_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `designation_foreign_k1` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
