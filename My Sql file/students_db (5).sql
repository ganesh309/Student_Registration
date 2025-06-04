-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 07:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_details`
--

CREATE TABLE `academic_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `specialization_id` bigint(20) UNSIGNED NOT NULL,
  `roll_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_details`
--

INSERT INTO `academic_details` (`id`, `student_id`, `school_id`, `course_id`, `specialization_id`, `roll_no`, `created_at`, `updated_at`) VALUES
(14, 4, 1, 6, 21, '136', '2025-04-08 22:58:50', '2025-04-08 22:58:50'),
(15, 5, 15, 1, 1, '11', '2025-04-08 23:06:18', '2025-04-08 23:06:18'),
(16, 5, 5, 3, 9, '9', '2025-04-08 23:06:18', '2025-04-08 23:06:18'),
(17, 8, 6, 5, 17, '356', '2025-04-08 23:22:22', '2025-04-08 23:22:22'),
(18, 9, 14, 2, 4, '10', '2025-04-08 23:24:38', '2025-04-08 23:24:38'),
(19, 10, 14, 1, 1, '1', '2025-04-08 23:28:03', '2025-04-08 23:28:03'),
(20, 11, 13, 1, 1, '12', '2025-04-08 23:30:25', '2025-04-08 23:30:25'),
(21, 11, 2, 3, 9, '112', '2025-04-08 23:30:25', '2025-04-08 23:30:25'),
(22, 12, 4, 4, 12, '4', '2025-04-08 23:32:29', '2025-04-08 23:32:29'),
(23, 13, 4, 3, 8, '3', '2025-04-08 23:35:07', '2025-04-08 23:35:07'),
(24, 14, 13, 2, 4, '33', '2025-04-08 23:36:50', '2025-04-08 23:36:50'),
(25, 15, 13, 2, 2, '2', '2025-04-08 23:39:01', '2025-04-08 23:39:01'),
(26, 15, 4, 4, 12, '24', '2025-04-08 23:39:01', '2025-04-08 23:39:01'),
(27, 16, 6, 5, 16, '12', '2025-04-08 23:41:14', '2025-04-08 23:41:14'),
(28, 17, 13, 1, 1, '22', '2025-04-08 23:43:51', '2025-04-08 23:43:51'),
(29, 18, 15, 1, 1, '1', '2025-04-08 23:46:03', '2025-04-08 23:46:03'),
(30, 18, 13, 2, 3, '1', '2025-04-08 23:46:04', '2025-04-08 23:46:04'),
(31, 18, 7, 4, 12, '1123', '2025-04-08 23:46:04', '2025-04-08 23:46:04'),
(32, 19, 1, 5, 15, '33', '2025-04-08 23:48:02', '2025-04-08 23:48:02'),
(33, 20, 6, 6, 22, '1233', '2025-04-08 23:49:52', '2025-04-08 23:49:52'),
(34, 21, 5, 6, 21, '2345', '2025-04-08 23:52:35', '2025-04-08 23:52:35'),
(35, 22, 7, 3, 8, '2345', '2025-04-08 23:54:44', '2025-04-08 23:54:44'),
(36, 22, 5, 4, 12, '11', '2025-04-08 23:54:44', '2025-04-08 23:54:44'),
(37, 22, 3, 6, 21, '44', '2025-04-08 23:54:44', '2025-04-08 23:54:44'),
(38, 23, 3, 3, 9, '54', '2025-04-08 23:56:30', '2025-04-08 23:56:30'),
(39, 24, 1, 5, 18, '4', '2025-04-08 23:58:28', '2025-04-08 23:58:28'),
(40, 25, 4, 6, 22, '4', '2025-04-09 00:00:19', '2025-04-09 00:00:19'),
(41, 26, 3, 4, 14, '136', '2025-04-09 00:02:08', '2025-04-09 00:02:08'),
(42, 27, 7, 3, 10, '43', '2025-04-09 00:03:57', '2025-04-09 00:03:57'),
(44, 29, 9, 4, 13, '4', '2025-04-09 00:07:56', '2025-04-09 00:07:56'),
(45, 29, 2, 5, 17, '345', '2025-04-09 00:07:56', '2025-04-09 00:07:56'),
(46, 30, 8, 6, 23, '12333', '2025-04-09 00:09:55', '2025-04-09 00:09:55'),
(47, 31, 15, 1, 1, '31', '2025-04-09 04:33:47', '2025-04-09 04:33:47'),
(48, 32, 5, 4, 13, '3', '2025-04-09 04:35:38', '2025-04-09 04:35:38'),
(51, 33, 13, 2, 3, '46', '2025-04-09 04:38:33', '2025-04-09 04:38:33'),
(52, 33, 7, 3, 9, '12364', '2025-04-09 04:38:33', '2025-04-09 04:38:33'),
(53, 34, 15, 1, 1, '1', '2025-04-09 04:41:27', '2025-04-09 04:41:27'),
(54, 34, 15, 2, 4, '1', '2025-04-09 04:41:27', '2025-04-09 04:41:27'),
(55, 34, 2, 3, 10, '67', '2025-04-09 04:41:27', '2025-04-09 04:41:27'),
(56, 35, 5, 6, 20, '3', '2025-04-09 04:45:36', '2025-04-09 04:45:36'),
(57, 36, 2, 4, 13, '3456', '2025-04-09 04:47:23', '2025-04-09 04:47:23'),
(58, 37, 4, 5, 17, '434', '2025-04-09 04:49:34', '2025-04-09 04:49:34'),
(59, 38, 14, 2, 3, '12', '2025-04-09 04:51:52', '2025-04-09 04:51:52'),
(60, 38, 9, 3, 9, '12364', '2025-04-09 04:51:52', '2025-04-09 04:51:52'),
(61, 39, 2, 6, 21, 'R234', '2025-04-09 04:53:44', '2025-04-09 04:53:44'),
(62, 28, 15, 1, 1, '11', '2025-04-14 00:47:53', '2025-04-14 00:47:53'),
(69, 40, 5, 5, 17, '456', '2025-04-16 04:47:36', '2025-04-16 04:47:36'),
(70, 41, 8, 4, 11, '12345', '2025-04-24 22:53:52', '2025-04-24 22:53:52'),
(71, 42, 3, 2, 3, '10', '2025-04-27 23:35:11', '2025-04-27 23:35:11'),
(72, 43, 2, 3, 9, '4654', '2025-04-28 05:07:37', '2025-04-28 05:07:37'),
(73, 44, 7, 2, 2, '654', '2025-05-06 02:06:45', '2025-05-06 02:06:45'),
(78, 45, 1, 2, 3, '1', '2025-05-06 05:53:13', '2025-05-06 05:53:13'),
(79, 46, 8, 4, 12, '432', '2025-05-06 05:58:40', '2025-05-06 05:58:40'),
(80, 48, 5, 5, 15, '34567654', '2025-05-13 03:21:38', '2025-05-13 03:21:38'),
(95, 49, 3, 4, 13, '3456', '2025-05-13 04:24:45', '2025-05-13 04:24:45'),
(103, 50, 6, 4, 12, '4rtf', '2025-05-13 04:45:52', '2025-05-13 04:45:52'),
(104, 50, 1, 3, 9, '34rtg', '2025-05-13 04:45:52', '2025-05-13 04:45:52'),
(119, 51, 15, 2, 2, '1', '2025-05-13 05:59:06', '2025-05-13 05:59:06'),
(120, 51, 5, 3, 10, 'ttt4', '2025-05-13 05:59:06', '2025-05-13 05:59:06'),
(121, 52, 5, 3, 7, '234t', '2025-05-14 04:31:50', '2025-05-14 04:31:50'),
(122, 53, 7, 3, 8, '345tyh', '2025-05-19 23:53:40', '2025-05-19 23:53:40'),
(125, 55, 12, 1, 1, '12', '2025-05-22 03:36:30', '2025-05-22 03:36:30'),
(126, 55, 12, 2, 2, '56', '2025-05-22 03:36:30', '2025-05-22 03:36:30'),
(127, 56, 7, 1, 1, '1', '2025-06-01 23:41:25', '2025-06-01 23:41:25'),
(128, 56, 3, 2, 3, '423', '2025-06-01 23:41:25', '2025-06-01 23:41:25'),
(129, 59, 6, 3, 9, '1234', '2025-06-02 04:52:28', '2025-06-02 04:52:28'),
(130, 60, 8, 2, 4, '12', '2025-06-02 05:40:39', '2025-06-02 05:40:39'),
(136, 62, 12, 1, 1, '3', '2025-06-03 05:12:41', '2025-06-03 05:12:41'),
(137, 62, 12, 2, 2, '67', '2025-06-03 05:12:41', '2025-06-03 05:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` bigint(20) NOT NULL,
  `academic_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `academic_year`) VALUES
(1, '2021-2022'),
(2, '2022-2023'),
(3, '2023-2024'),
(4, '2024-2025'),
(5, '2025-2026');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `pin_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `student_id`, `country_id`, `state_id`, `district_id`, `pin_no`, `created_at`, `updated_at`) VALUES
(4, 4, 2, 6, 21, '460', '2025-04-08 22:55:49', '2025-04-08 22:55:49'),
(5, 5, 1, 3, 11, '845', '2025-04-08 23:05:46', '2025-04-08 23:05:46'),
(6, 8, 1, 5, 19, '751', '2025-04-08 23:22:02', '2025-04-08 23:22:02'),
(7, 9, 2, 6, 21, '742', '2025-04-08 23:24:18', '2025-04-08 23:24:18'),
(8, 10, 1, 4, 13, '294', '2025-04-08 23:27:43', '2025-04-08 23:27:43'),
(9, 11, 2, 6, 21, '130', '2025-04-08 23:29:52', '2025-04-08 23:29:52'),
(10, 12, 1, 2, 7, '418', '2025-04-08 23:32:14', '2025-04-08 23:32:14'),
(11, 13, 2, 6, 21, '196', '2025-04-08 23:34:53', '2025-04-08 23:34:53'),
(12, 14, 2, 6, 21, '225', '2025-04-08 23:36:38', '2025-04-08 23:36:38'),
(13, 15, 1, 1, 4, '496', '2025-04-08 23:38:24', '2025-04-08 23:38:24'),
(14, 16, 1, 2, 6, '619', '2025-04-08 23:40:38', '2025-04-08 23:40:38'),
(15, 17, 2, 6, 21, '844', '2025-04-08 23:43:39', '2025-04-08 23:43:39'),
(16, 18, 1, 3, 11, '184', '2025-04-08 23:45:25', '2025-04-08 23:45:25'),
(17, 19, 1, 4, 16, '253', '2025-04-08 23:47:48', '2025-04-08 23:47:48'),
(18, 20, 1, 1, 2, '853', '2025-04-08 23:49:35', '2025-04-08 23:49:35'),
(19, 21, 1, 1, 3, '397', '2025-04-08 23:52:24', '2025-04-08 23:52:24'),
(20, 22, 2, 6, 21, '250', '2025-04-08 23:54:03', '2025-04-08 23:54:03'),
(21, 23, 1, 2, 5, '287', '2025-04-08 23:56:20', '2025-04-08 23:56:20'),
(22, 24, 2, 6, 21, '774', '2025-04-08 23:58:16', '2025-04-08 23:58:16'),
(23, 25, 1, 2, 8, '835', '2025-04-09 00:00:08', '2025-04-09 00:00:08'),
(24, 26, 1, 2, 7, '694', '2025-04-09 00:01:54', '2025-04-09 00:01:54'),
(25, 27, 1, 5, 17, '252', '2025-04-09 00:03:38', '2025-04-09 00:03:38'),
(26, 28, 1, 1, 4, '42', '2025-04-09 00:05:46', '2025-04-09 00:05:46'),
(27, 29, 2, 6, 21, '458', '2025-04-09 00:07:32', '2025-04-09 00:07:32'),
(28, 30, 1, 4, 15, '676', '2025-04-09 00:09:41', '2025-04-09 00:09:41'),
(29, 31, 2, 6, 21, '37', '2025-04-09 04:33:28', '2025-04-09 04:33:28'),
(30, 32, 2, 6, 21, '464', '2025-04-09 04:35:23', '2025-04-09 04:35:23'),
(31, 33, 2, 6, 21, '111', '2025-04-09 04:37:19', '2025-04-09 04:37:19'),
(32, 34, 1, 1, 2, '263', '2025-04-09 04:40:04', '2025-04-09 04:40:04'),
(33, 35, 2, 6, 21, '35', '2025-04-09 04:45:15', '2025-04-09 04:45:15'),
(34, 36, 1, 4, 15, '237', '2025-04-09 04:47:12', '2025-04-09 04:47:12'),
(35, 37, 1, 1, 4, '343', '2025-04-09 04:49:09', '2025-04-09 04:49:09'),
(36, 38, 1, 2, 7, '826', '2025-04-09 04:51:30', '2025-04-09 04:51:30'),
(37, 39, 2, 6, 21, '808', '2025-04-09 04:53:28', '2025-04-09 04:53:28'),
(38, 40, 1, 4, 16, '946', '2025-04-16 03:39:09', '2025-04-16 03:39:09'),
(39, 41, 2, 6, 21, '540', '2025-04-24 22:50:49', '2025-04-24 22:50:49'),
(40, 42, 1, 2, 7, '52', '2025-04-27 22:53:57', '2025-04-27 22:53:57'),
(41, 43, 2, 6, 21, '980', '2025-04-28 05:07:11', '2025-04-28 05:07:11'),
(42, 44, 1, 1, 1, '338', '2025-05-06 02:05:03', '2025-05-06 02:05:03'),
(43, 45, 1, 2, 7, '594', '2025-05-06 04:25:37', '2025-05-06 04:25:37'),
(44, 46, 1, 2, 6, '1000', '2025-05-06 05:58:16', '2025-05-06 05:58:16'),
(45, 48, 2, 6, 21, '11', '2025-05-13 03:06:09', '2025-05-13 03:06:09'),
(46, 49, 1, 2, 7, '585', '2025-05-13 03:23:30', '2025-05-13 03:23:30'),
(47, 50, 1, 2, 7, '364', '2025-05-13 04:27:45', '2025-05-13 04:27:45'),
(48, 51, 2, 6, 21, '23', '2025-05-13 04:49:23', '2025-05-13 04:49:23'),
(49, 52, 1, 3, 11, '640', '2025-05-14 04:31:39', '2025-05-14 04:31:39'),
(50, 53, 2, 6, 21, '446', '2025-05-19 23:53:27', '2025-05-19 23:53:27'),
(52, 55, 1, 1, 1, '721601', '2025-05-22 03:36:00', '2025-05-22 03:36:00'),
(53, 56, 2, 6, 21, '349', '2025-06-01 23:41:04', '2025-06-01 23:41:04'),
(54, 59, 1, 3, 10, '915', '2025-06-02 04:52:17', '2025-06-02 04:52:17'),
(55, 60, 1, 2, 6, '250', '2025-06-02 05:40:32', '2025-06-02 05:40:32'),
(57, 62, 1, 1, 1, '721601', '2025-06-03 05:10:54', '2025-06-03 05:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `basic_information`
--

CREATE TABLE `basic_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `fathersname` varchar(255) NOT NULL,
  `mothersname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_information`
--

INSERT INTO `basic_information` (`id`, `student_id`, `fathersname`, `mothersname`, `date_of_birth`, `gender`, `created_at`, `updated_at`) VALUES
(4, 4, 'Joan Wynn', 'Sean Crosby', '2001-10-12', 'Male', '2025-04-08 22:55:49', '2025-04-08 22:55:49'),
(5, 5, 'Ivan Moran', 'Giacomo Gilbert', '1998-11-11', 'Female', '2025-04-08 23:05:46', '2025-04-08 23:05:46'),
(6, 8, 'Zia Garcia', 'Oren Washington', '2009-11-07', 'Male', '2025-04-08 23:22:02', '2025-04-08 23:22:02'),
(7, 9, 'Lara Sawyer', 'Knox Richards', '1972-10-23', 'Female', '2025-04-08 23:24:18', '2025-04-08 23:24:18'),
(8, 10, 'Adam Jefferson', 'Lunea Cash', '1988-12-14', 'Female', '2025-04-08 23:27:43', '2025-04-08 23:27:43'),
(9, 11, 'Nolan Solomon', 'Pandora Lyons', '1996-02-28', 'Male', '2025-04-08 23:29:52', '2025-04-08 23:29:52'),
(10, 12, 'Cameron Mendez', 'Dai Pugh', '2015-01-30', 'Male', '2025-04-08 23:32:14', '2025-04-08 23:32:14'),
(11, 13, 'Nola Moody', 'Yuli Flynn', '2014-03-21', 'Female', '2025-04-08 23:34:53', '2025-04-08 23:34:53'),
(12, 14, 'Jarrod Riley', 'Kristen Johns', '2021-06-10', 'Male', '2025-04-08 23:36:38', '2025-04-08 23:36:38'),
(13, 15, 'Ralph Santiago', 'Ariel Schneider', '1991-10-20', 'Female', '2025-04-08 23:38:24', '2025-04-08 23:38:24'),
(14, 16, 'Lacy Hurley', 'Silas Walters', '1995-10-26', 'Male', '2025-04-08 23:40:38', '2025-04-08 23:40:38'),
(15, 17, 'Ila Hogan', 'Peter Beach', '1973-07-04', 'Female', '2025-04-08 23:43:39', '2025-04-08 23:43:39'),
(16, 18, 'Nell Serrano', 'Doris Foster', '1989-12-17', 'Female', '2025-04-08 23:45:25', '2025-04-08 23:45:25'),
(17, 19, 'Kelsie Chambers', 'Elton Dillard', '1978-09-11', 'Female', '2025-04-08 23:47:48', '2025-04-08 23:47:48'),
(18, 20, 'Tanner Goodman', 'Mechelle Dotson', '1994-07-25', 'Male', '2025-04-08 23:49:35', '2025-04-08 23:49:35'),
(19, 21, 'Laith Howard', 'Mikayla Oneil', '2018-10-20', 'Female', '2025-04-08 23:52:24', '2025-04-08 23:52:24'),
(20, 22, 'Garrison Walton', 'Kamal Soto', '1990-01-18', 'Male', '2025-04-08 23:54:03', '2025-04-08 23:54:03'),
(21, 23, 'Kevin Larson', 'Hillary Gallegos', '1975-03-21', 'Male', '2025-04-08 23:56:20', '2025-04-08 23:56:20'),
(22, 24, 'Ethan Clayton', 'Sarah Burns', '1985-02-23', 'Female', '2025-04-08 23:58:16', '2025-04-08 23:58:16'),
(23, 25, 'Unity Patterson', 'Zia Lara', '2009-03-24', 'Female', '2025-04-09 00:00:08', '2025-04-09 00:00:08'),
(24, 26, 'Hillary Estes', 'Rae Fisher', '2008-07-03', 'Male', '2025-04-09 00:01:54', '2025-04-09 00:01:54'),
(25, 27, 'Jackson Whitehead', 'Quinn Holcomb', '2009-03-31', 'Male', '2025-04-09 00:03:38', '2025-04-09 00:03:38'),
(26, 28, 'Mufutau Rosario', 'Hakeem Flowers', '2006-06-01', 'Other', '2025-04-09 00:05:46', '2025-04-14 00:47:53'),
(27, 29, 'Chaney Kemp', 'Hope Miller', '2005-06-11', 'Female', '2025-04-09 00:07:32', '2025-04-09 00:07:32'),
(28, 30, 'Shaeleigh Mcdonald', 'Nerea Davis', '1981-02-15', 'Male', '2025-04-09 00:09:41', '2025-04-09 00:09:41'),
(29, 31, 'Trevor Flynn', 'Hedwig Beach', '1999-10-16', 'Female', '2025-04-09 04:33:28', '2025-04-09 04:33:28'),
(30, 32, 'Alexandra Hardin', 'Austin Holden', '2024-07-31', 'Female', '2025-04-09 04:35:23', '2025-04-09 04:35:23'),
(31, 33, 'Hector Berg', 'Ivor Fulton', '2024-11-15', 'Female', '2025-04-09 04:37:19', '2025-04-09 04:37:19'),
(32, 34, 'Evan Avery', 'Honorato Lyons', '1998-03-06', 'Male', '2025-04-09 04:40:04', '2025-04-09 04:40:04'),
(33, 35, 'Vera Crane', 'Clayton Schmidt', '2007-01-26', 'Male', '2025-04-09 04:45:15', '2025-04-09 04:45:15'),
(34, 36, 'Genevieve Weiss', 'Moses Ingram', '1993-09-25', 'Female', '2025-04-09 04:47:12', '2025-04-09 04:47:12'),
(35, 37, 'Jason Perry', 'Madison Guerrero', '2008-06-08', 'Male', '2025-04-09 04:49:09', '2025-04-09 04:49:09'),
(36, 38, 'Lewis Clay', 'Russell Joyce', '2005-04-27', 'Female', '2025-04-09 04:51:30', '2025-04-09 04:51:30'),
(37, 39, 'Igor Hoover', 'Violet Barr', '1998-08-07', 'Male', '2025-04-09 04:53:28', '2025-04-09 04:53:28'),
(38, 40, 'Holly Albert', 'Rahim Tate', '2020-05-05', 'Male', '2025-04-16 03:39:09', '2025-04-16 03:39:09'),
(39, 41, 'Harding Mcdaniel', 'Lareina Hogan', '1983-08-29', 'Female', '2025-04-24 22:50:49', '2025-04-24 22:50:49'),
(40, 42, 'Jane Kirk', 'Daquan Cross', '1980-08-08', 'Male', '2025-04-27 22:53:57', '2025-04-27 22:53:57'),
(41, 43, 'Halla Baird', 'Clark Henson', '2020-05-23', 'Male', '2025-04-28 05:07:11', '2025-04-28 05:07:11'),
(42, 44, 'Xena Mccormick', 'Isaiah Byers', '1973-05-27', 'Female', '2025-05-06 02:05:03', '2025-05-06 02:05:03'),
(43, 45, 'Jeanette Hartman', 'Noah Hampton', '1987-07-27', 'Male', '2025-05-06 04:25:37', '2025-05-06 04:25:37'),
(44, 46, 'Maryam Barnes', 'Hilary Burt', '2010-03-31', 'Other', '2025-05-06 05:58:16', '2025-05-06 05:58:16'),
(45, 48, 'Leigh Richardson', 'Savannah Vincent', '1979-01-08', 'Male', '2025-05-13 03:06:09', '2025-05-13 03:06:09'),
(46, 49, 'Rachel Cole', 'Isadora Hayden', '2024-02-02', 'Male', '2025-05-13 03:23:30', '2025-05-13 03:23:30'),
(47, 50, 'Caldwell Walsh', 'Samson Church', '1994-09-11', 'Female', '2025-05-13 04:27:45', '2025-05-13 04:27:45'),
(48, 51, 'Evelyn Turner', 'Ulla Craig', '1995-09-01', 'Female', '2025-05-13 04:49:23', '2025-05-13 04:49:23'),
(49, 52, 'Hasad Caldwell', 'Raja Wright', '1972-05-31', 'Other', '2025-05-14 04:31:39', '2025-05-14 04:31:39'),
(50, 53, 'Harrison Burris', 'Amelia Payne', '2000-09-15', 'Female', '2025-05-19 23:53:27', '2025-05-19 23:53:27'),
(52, 55, 'Pintu Pradhan', 'Anubha Pradhan', '2001-07-06', 'Male', '2025-05-22 03:36:00', '2025-05-22 03:36:00'),
(53, 56, 'Merritt Glass', 'Camden Villarreal', '2017-04-10', 'Female', '2025-06-01 23:41:04', '2025-06-01 23:41:04'),
(54, 59, 'Gage Ware', 'Fletcher Cannon', '1974-09-17', 'Female', '2025-06-02 04:52:17', '2025-06-02 04:52:17'),
(55, 60, 'Yolanda Sampson', 'Felix Robertson', '1973-12-08', 'Male', '2025-06-02 05:40:32', '2025-06-02 05:40:32'),
(57, 62, 'Subhash Ghorai', 'Sumitra Ghorai', '2002-10-11', 'Male', '2025-06-03 05:10:54', '2025-06-03 05:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'India', NULL, NULL),
(2, 'Bangladesh', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `created_at`, `updated_at`) VALUES
(1, 'Secondary', NULL, NULL),
(2, 'Higher Secondary', NULL, NULL),
(3, 'Diploma', NULL, NULL),
(4, 'B.Tech', NULL, NULL),
(5, 'M.Tech', NULL, NULL),
(6, 'MBA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `current_academic_details`
--

CREATE TABLE `current_academic_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `specialization_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `state_id`, `district_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'East Medinipur', NULL, NULL),
(2, 1, 'Kolkata', NULL, NULL),
(3, 1, 'South 24 pgs', NULL, NULL),
(4, 1, 'West Medinipur', NULL, NULL),
(5, 2, 'Patna', NULL, NULL),
(6, 2, 'Gaya', NULL, NULL),
(7, 2, 'Bhagalpur', NULL, NULL),
(8, 2, 'Muzaffarpur', NULL, NULL),
(9, 3, 'Bengaluru', NULL, NULL),
(10, 3, 'Mysuru', NULL, NULL),
(11, 3, 'Mangalore', NULL, NULL),
(12, 3, 'Hubli', NULL, NULL),
(13, 4, 'Mumbai', NULL, NULL),
(14, 4, 'Pune', NULL, NULL),
(15, 4, 'Nagpur', NULL, NULL),
(16, 4, 'Nashik', NULL, NULL),
(17, 5, 'Chennai', NULL, NULL),
(18, 5, 'Coimbatore', NULL, NULL),
(19, 5, 'Madurai', NULL, NULL),
(20, 5, 'Trichy', NULL, NULL),
(21, 6, 'Keraniganj', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees_details`
--

CREATE TABLE `fees_details` (
  `id` bigint(20) NOT NULL,
  `fees_structure_id` int(11) UNSIGNED NOT NULL,
  `fees_head_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_details`
--

INSERT INTO `fees_details` (`id`, `fees_structure_id`, `fees_head_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 30000.00, '2025-05-06 02:13:38', '2025-05-06 02:13:38'),
(2, 1, 4, 20000.00, '2025-05-06 02:13:38', '2025-05-06 02:13:38'),
(3, 1, 2, 5000.00, '2025-05-06 02:13:38', '2025-05-06 02:13:38'),
(4, 1, 3, 5000.00, '2025-05-06 02:13:38', '2025-05-06 02:13:38'),
(5, 1, 5, 7000.00, '2025-05-06 02:13:38', '2025-05-06 02:13:38'),
(6, 2, 1, 30000.00, '2025-05-06 02:15:10', '2025-05-06 02:15:10'),
(7, 2, 2, 5000.00, '2025-05-06 02:15:10', '2025-05-06 02:15:10'),
(8, 2, 5, 7000.00, '2025-05-06 02:15:10', '2025-05-06 02:15:10'),
(9, 2, 3, 5000.00, '2025-05-06 02:15:10', '2025-05-06 02:15:10'),
(10, 3, 1, 30000.00, '2025-05-06 02:15:52', '2025-05-06 02:15:52'),
(11, 3, 2, 5000.00, '2025-05-06 02:15:52', '2025-05-06 02:15:52'),
(12, 3, 3, 5000.00, '2025-05-06 02:15:52', '2025-05-06 02:15:52'),
(13, 3, 5, 7000.00, '2025-05-06 02:15:52', '2025-05-06 02:15:52'),
(14, 4, 1, 30000.00, '2025-05-06 02:16:35', '2025-05-06 02:16:35'),
(15, 4, 2, 5000.00, '2025-05-06 02:16:35', '2025-05-06 02:16:35'),
(16, 4, 3, 5000.00, '2025-05-06 02:16:35', '2025-05-06 02:16:35'),
(17, 4, 5, 7000.00, '2025-05-06 02:16:35', '2025-05-06 02:16:35'),
(18, 5, 1, 30000.00, '2025-05-06 02:17:37', '2025-05-06 02:17:37'),
(19, 5, 2, 5000.00, '2025-05-06 02:17:37', '2025-05-06 02:17:37'),
(20, 5, 3, 5000.00, '2025-05-06 02:17:37', '2025-05-06 02:17:37'),
(21, 5, 5, 7000.00, '2025-05-06 02:17:37', '2025-05-06 02:17:37'),
(22, 6, 1, 30000.00, '2025-05-06 02:18:11', '2025-05-06 02:18:11'),
(23, 6, 2, 5000.00, '2025-05-06 02:18:11', '2025-05-06 02:18:11'),
(24, 6, 3, 5000.00, '2025-05-06 02:18:11', '2025-05-06 02:18:11'),
(25, 6, 5, 7000.00, '2025-05-06 02:18:11', '2025-05-06 02:18:11'),
(26, 7, 1, 30000.00, '2025-05-06 02:18:55', '2025-05-06 02:18:55'),
(27, 7, 2, 5000.00, '2025-05-06 02:18:55', '2025-05-06 02:18:55'),
(28, 7, 3, 5000.00, '2025-05-06 02:18:55', '2025-05-06 02:18:55'),
(29, 7, 5, 7000.00, '2025-05-06 02:18:55', '2025-05-06 02:18:55'),
(30, 8, 1, 30000.00, '2025-05-06 02:19:24', '2025-05-06 02:19:24'),
(31, 8, 2, 5000.00, '2025-05-06 02:19:24', '2025-05-06 02:19:24'),
(32, 8, 3, 5000.00, '2025-05-06 02:19:24', '2025-05-06 02:19:24'),
(33, 8, 5, 7000.00, '2025-05-06 02:19:24', '2025-05-06 02:19:24'),
(34, 9, 4, 25000.00, '2025-05-06 03:32:03', '2025-05-06 03:32:03'),
(35, 9, 1, 35000.00, '2025-05-06 03:32:03', '2025-05-06 03:32:03'),
(36, 9, 2, 6000.00, '2025-05-06 03:32:03', '2025-05-06 03:32:03'),
(37, 9, 5, 8000.00, '2025-05-06 03:32:03', '2025-05-06 03:32:03'),
(38, 9, 6, 5000.00, '2025-05-06 03:32:03', '2025-05-06 03:32:03'),
(56, 10, 1, 35000.00, '2025-05-07 23:27:21', '2025-05-07 23:27:21'),
(57, 10, 2, 6000.00, '2025-05-07 23:27:21', '2025-05-07 23:27:21'),
(58, 10, 5, 9000.00, '2025-05-07 23:27:21', '2025-05-07 23:27:21'),
(66, 11, 1, 50000.00, '2025-05-13 05:44:05', '2025-05-13 05:44:05'),
(67, 11, 2, 5000.00, '2025-05-13 05:44:05', '2025-05-13 05:44:05'),
(68, 11, 3, 2000.00, '2025-05-13 05:44:05', '2025-05-13 05:44:05'),
(69, 12, 4, 20000.00, '2025-05-19 23:58:03', '2025-05-19 23:58:03'),
(70, 12, 1, 45000.00, '2025-05-19 23:58:03', '2025-05-19 23:58:03'),
(71, 12, 2, 15000.00, '2025-05-19 23:58:03', '2025-05-19 23:58:03'),
(72, 12, 3, 5000.00, '2025-05-19 23:58:03', '2025-05-19 23:58:03'),
(73, 13, 1, 45000.00, '2025-05-19 23:58:32', '2025-05-19 23:58:32'),
(74, 13, 2, 15000.00, '2025-05-19 23:58:32', '2025-05-19 23:58:32'),
(75, 13, 3, 5000.00, '2025-05-19 23:58:32', '2025-05-19 23:58:32'),
(76, 14, 1, 45000.00, '2025-05-19 23:59:05', '2025-05-19 23:59:05'),
(77, 14, 2, 15000.00, '2025-05-19 23:59:05', '2025-05-19 23:59:05'),
(78, 14, 3, 5000.00, '2025-05-19 23:59:05', '2025-05-19 23:59:05'),
(79, 15, 1, 45000.00, '2025-05-20 00:00:22', '2025-05-20 00:00:22'),
(80, 15, 2, 15000.00, '2025-05-20 00:00:22', '2025-05-20 00:00:22'),
(81, 15, 3, 5000.00, '2025-05-20 00:00:22', '2025-05-20 00:00:22'),
(82, 16, 1, 45000.00, '2025-05-20 00:01:13', '2025-05-20 00:01:13'),
(83, 16, 2, 15000.00, '2025-05-20 00:01:13', '2025-05-20 00:01:13'),
(84, 16, 3, 5000.00, '2025-05-20 00:01:13', '2025-05-20 00:01:13'),
(85, 17, 1, 45000.00, '2025-05-20 00:02:16', '2025-05-20 00:02:16'),
(86, 17, 2, 15000.00, '2025-05-20 00:02:16', '2025-05-20 00:02:16'),
(87, 17, 3, 5000.00, '2025-05-20 00:02:16', '2025-05-20 00:02:16'),
(88, 18, 1, 45000.00, '2025-05-20 00:02:55', '2025-05-20 00:02:55'),
(89, 18, 2, 15000.00, '2025-05-20 00:02:55', '2025-05-20 00:02:55'),
(90, 18, 3, 5000.00, '2025-05-20 00:02:55', '2025-05-20 00:02:55'),
(91, 19, 1, 45000.00, '2025-05-20 00:03:19', '2025-05-20 00:03:19'),
(92, 19, 2, 15000.00, '2025-05-20 00:03:19', '2025-05-20 00:03:19'),
(93, 19, 3, 5000.00, '2025-05-20 00:03:19', '2025-05-20 00:03:19'),
(94, 12, 1, 40000.00, '2025-06-03 04:54:51', '2025-06-03 04:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `fees_heads`
--

CREATE TABLE `fees_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_heads`
--

INSERT INTO `fees_heads` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tuition Fees', 'Core academic fee charged for instruction and course delivery.', '2025-05-06 01:43:56', '2025-05-06 01:43:56'),
(2, 'Library Fees', 'Charges for access to library resources, books, and journals.', '2025-05-06 02:01:40', '2025-05-06 02:01:40'),
(3, 'Exam Fees', 'Fees for conducting and evaluating academic examinations.', '2025-05-06 02:02:07', '2025-05-06 02:02:07'),
(4, 'Admission Fees', 'One-time fee collected during the admission process.', '2025-05-06 02:02:41', '2025-05-06 02:02:41'),
(5, 'Lab Fees', 'Charges for using laboratory equipment and facilities.', '2025-05-06 02:09:09', '2025-05-06 02:09:09'),
(6, 'Health Services Fees', 'Covers basic health checkups and medical assistance on campus.', '2025-05-06 02:09:34', '2025-05-06 02:09:34'),
(12, 'Late Fine', 'Charges for Payment delay', '2025-05-20 23:43:04', '2025-05-20 23:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `fees_payment_details`
--

CREATE TABLE `fees_payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `fees_payment_header_id` bigint(20) UNSIGNED NOT NULL,
  `fees_head_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_payment_header`
--

CREATE TABLE `fees_payment_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL DEFAULT current_timestamp(),
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_payment_schedules`
--

CREATE TABLE `fees_payment_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `extended_date` date DEFAULT NULL,
  `late_fine` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_payment_schedules`
--

INSERT INTO `fees_payment_schedules` (`id`, `fees_structure_id`, `start_date`, `end_date`, `extended_date`, `late_fine`, `description`, `created_at`, `updated_at`) VALUES
(10, 1, '2025-06-20', '2025-07-10', NULL, NULL, NULL, '2025-05-13 00:16:03', '2025-05-13 00:16:03'),
(11, 2, '2026-02-01', '2026-03-15', '2026-03-25', 7.00, 'Late fine will be effected after the End Date.', '2025-05-13 00:20:15', '2025-05-13 01:52:41'),
(12, 8, '2025-06-20', '2025-07-10', NULL, 25.00, NULL, '2025-05-13 00:21:19', '2025-05-19 04:26:06'),
(13, 4, '2026-01-01', '2026-02-20', NULL, 25.00, NULL, '2025-05-13 00:21:55', '2025-05-13 00:21:55'),
(14, 5, '2025-06-20', '2025-07-10', NULL, 20.00, NULL, '2025-05-13 00:22:49', '2025-05-13 00:22:49'),
(15, 6, '2025-06-20', '2025-07-10', NULL, 20.00, NULL, '2025-05-13 00:31:30', '2025-05-13 00:31:30'),
(16, 10, '2025-07-01', '2025-07-30', NULL, 7.00, NULL, '2025-05-19 03:28:39', '2025-05-19 04:37:39'),
(17, 9, '2025-05-19', '2025-05-29', NULL, 10.00, NULL, '2025-05-19 04:30:07', '2025-05-19 04:30:07'),
(18, 12, '2025-05-01', '2025-05-21', NULL, 9.00, NULL, '2025-05-20 00:05:05', '2025-05-21 01:20:13'),
(19, 13, '2025-05-01', '2025-05-10', NULL, 11.00, NULL, '2025-05-20 00:06:52', '2025-05-21 00:17:52'),
(20, 14, '2025-05-01', '2025-05-21', NULL, 12.00, NULL, '2025-05-20 00:08:04', '2025-05-22 03:21:42'),
(21, 15, '2026-01-01', '2026-01-20', NULL, NULL, NULL, '2025-05-22 03:23:24', '2025-05-22 03:23:24'),
(22, 16, '2026-06-30', '2026-07-30', NULL, NULL, NULL, '2025-06-03 04:56:24', '2025-06-03 04:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `fees_structure`
--

CREATE TABLE `fees_structure` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `structure_name` varchar(255) NOT NULL,
  `academic_id` bigint(20) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_structure`
--

INSERT INTO `fees_structure` (`id`, `structure_name`, `academic_id`, `course_id`, `semester_id`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 'B.tech 1st sem 2021-2022', 1, 4, 1, 67000.00, '2025-05-06 02:13:38', '2025-05-06 11:16:10'),
(2, 'B.tech 2nd sem 2021-2022', 1, 4, 2, 47000.00, '2025-05-06 02:15:10', '2025-05-07 06:58:44'),
(4, 'B.tech 4th sem 2021-2022', 1, 4, 4, 47000.00, '2025-05-06 02:16:35', '2025-05-07 06:58:44'),
(5, 'B.tech 5th sem 2021-2022', 1, 4, 5, 47000.00, '2025-05-06 02:17:37', '2025-05-07 06:58:44'),
(6, 'B.tech 6th sem 2021-2022', 1, 4, 6, 47000.00, '2025-05-06 02:18:11', '2025-05-07 06:58:44'),
(7, 'B.tech 7th sem 2021-2022', 1, 4, 7, 47000.00, '2025-05-06 02:18:55', '2025-05-07 06:58:44'),
(8, 'B.tech 8th sem 2021-2022', 1, 4, 8, 47000.00, '2025-05-06 02:19:24', '2025-05-07 06:58:44'),
(9, 'B.tech 1st sem 2022-2023', 2, 4, 1, 79000.00, '2025-05-06 03:32:03', '2025-05-07 06:58:44'),
(10, 'B.Tech 2nd sem 2022-2023', 2, 4, 2, 50000.00, '2025-05-07 02:16:53', '2025-05-07 23:27:21'),
(11, 'B.Tech 3rd sem 2021-2022', 1, 4, 3, 57000.00, '2025-05-13 00:17:25', '2025-05-13 05:44:05'),
(12, 'B.Tech 1st sem 2025-2026', 5, 4, 1, 40000.00, '2025-05-19 23:58:03', '2025-06-03 04:54:51'),
(13, 'B.Tech 2nd sem 2025-2026', 5, 4, 2, 65000.00, '2025-05-19 23:58:32', '2025-05-19 23:58:32'),
(14, 'B.Tech 3rd sem 2025-2026', 5, 4, 3, 65000.00, '2025-05-19 23:59:05', '2025-05-19 23:59:05'),
(15, 'B.Tech 4th sem 2025-2026', 5, 4, 4, 65000.00, '2025-05-20 00:00:22', '2025-05-20 00:00:22'),
(16, 'B.Tech 5th sem 2025-2026', 5, 4, 5, 65000.00, '2025-05-20 00:01:13', '2025-05-20 00:01:13'),
(17, 'B.Tech 6th sem 2025-2026', 5, 4, 6, 65000.00, '2025-05-20 00:02:16', '2025-05-20 00:02:16'),
(18, 'B.Tech 7th sem 2025-2026', 5, 4, 7, 65000.00, '2025-05-20 00:02:55', '2025-05-20 00:02:55'),
(19, 'B.Tech 8th sem 2025-2026', 5, 4, 8, 65000.00, '2025-05-20 00:03:19', '2025-05-20 00:03:19');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_01_30_155415_create_country_table', 1),
(3, '2025_01_30_155459_create_state_table', 1),
(4, '2025_01_30_155524_create_district_table', 1),
(5, '2025_02_18_070610_create_schools_table', 1),
(6, '2025_03_20_092150_create_course_table', 1),
(7, '2025_03_20_092156_create_specialization_table', 1),
(8, '2025_03_20_093636_create_students_table', 1),
(9, '2025_03_20_093719_create_basic_information_table', 1),
(10, '2025_03_20_093757_create_address_table', 1),
(11, '2025_03_20_093831_create_academic_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_table_id` bigint(20) UNSIGNED NOT NULL,
  `fees_head_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `payment_table_id`, `fees_head_id`, `amount`) VALUES
(59, 14, 4, 20000.00),
(60, 14, 1, 45000.00),
(61, 14, 2, 15000.00),
(62, 14, 3, 5000.00),
(63, 14, 12, 9.00),
(64, 15, 1, 45000.00),
(65, 15, 2, 15000.00),
(66, 15, 3, 5000.00),
(67, 15, 12, 132.00),
(68, 16, 1, 45000.00),
(69, 16, 2, 15000.00),
(70, 16, 3, 5000.00),
(71, 16, 12, 12.00),
(72, 17, 4, 20000.00),
(73, 17, 1, 45000.00),
(74, 17, 2, 15000.00),
(75, 17, 3, 5000.00),
(76, 17, 12, 108.00),
(77, 18, 1, 45000.00),
(78, 18, 2, 15000.00),
(79, 18, 3, 5000.00),
(80, 18, 12, 253.00),
(81, 19, 4, 20000.00),
(82, 19, 1, 45000.00),
(83, 19, 2, 15000.00),
(84, 19, 3, 5000.00),
(85, 19, 12, 108.00),
(86, 20, 1, 45000.00),
(87, 20, 2, 15000.00),
(88, 20, 3, 5000.00),
(89, 20, 12, 144.00),
(90, 21, 4, 20000.00),
(91, 21, 1, 45000.00),
(92, 21, 2, 15000.00),
(93, 21, 3, 5000.00),
(94, 21, 12, 108.00),
(95, 22, 4, 20000.00),
(96, 22, 1, 45000.00),
(97, 22, 2, 15000.00),
(98, 22, 3, 5000.00),
(99, 22, 1, 40000.00),
(100, 22, 12, 117.00);

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE `payment_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_receipt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_table`
--

INSERT INTO `payment_table` (`id`, `student_id`, `fees_structure_id`, `total_amount`, `payment_date`, `payment_receipt`) VALUES
(14, 55, 12, 85009.00, '2025-05-22', 'RECPT20250004'),
(15, 55, 13, 65132.00, '2025-05-22', 'RECPT20250005'),
(16, 55, 14, 65012.00, '2025-05-22', 'RECPT20250006'),
(17, 56, 12, 85108.00, '2025-06-02', 'RECPT20250007'),
(18, 59, 13, 65253.00, '2025-06-02', 'RECPT20250008'),
(19, 59, 12, 85108.00, '2025-06-02', 'RECPT20250009'),
(20, 59, 14, 65144.00, '2025-06-02', 'RECPT20250010'),
(21, 60, 12, 85108.00, '2025-06-02', 'RECPT20250011'),
(22, 62, 12, 40117.00, '2025-06-03', 'RECPT20250009');

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
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `created_at`, `updated_at`) VALUES
(1, 'Indian Institute of Technology Bombay', NULL, NULL),
(2, 'Indian Institute of Technology Delhi', NULL, NULL),
(3, 'Indian Institute of Technology Madras', NULL, NULL),
(4, 'Indian Institute of Technology Kanpur', NULL, NULL),
(5, 'Indian Institute of Technology Kharagpur', NULL, NULL),
(6, 'National Institute of Technology Trichy', NULL, NULL),
(7, 'Birla Institute of Technology and Science, Pilani', NULL, NULL),
(8, 'Indian Institute of Information Technology Hyderabad', NULL, NULL),
(9, 'Indian Institute of Technology Guwahati', NULL, NULL),
(10, 'Shiv Nadar University', NULL, NULL),
(11, 'The Neotia University', NULL, NULL),
(12, 'Mabarak Pur A.M.Sc. High School', NULL, NULL),
(13, 'Mahammad Pur Deshapran Vidhyapith', NULL, NULL),
(14, 'Mahanar Pur Bandhab High School', NULL, NULL),
(15, 'Bhagwan Pur High School', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_no`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th'),
(9, '9th'),
(10, '10th');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `specialization_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`id`, `course_id`, `specialization_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'None', NULL, NULL),
(2, 2, 'Science', NULL, NULL),
(3, 2, 'Computer Science', NULL, NULL),
(4, 2, 'Bio Science', NULL, NULL),
(5, 2, 'Arts', NULL, NULL),
(6, 2, 'Commerce', NULL, NULL),
(7, 3, 'Civil Engineering', NULL, NULL),
(8, 3, 'Mechanical Engineering', NULL, NULL),
(9, 3, 'Electrical Engineering', NULL, NULL),
(10, 3, 'Computer Science & Engineering', NULL, NULL),
(11, 4, 'CSE Cyber Security', NULL, NULL),
(12, 4, 'CSE Data Science', NULL, NULL),
(13, 4, 'CSE Aiml', NULL, NULL),
(14, 4, 'ECE', NULL, NULL),
(15, 5, 'Computer Science', NULL, NULL),
(16, 5, 'Mechanical Engineering', NULL, NULL),
(17, 5, 'Civil Engineering', NULL, NULL),
(18, 5, 'ECE', NULL, NULL),
(19, 6, 'Finance', NULL, NULL),
(20, 6, 'Marketing', NULL, NULL),
(21, 6, 'Entrepreneurship', NULL, NULL),
(22, 6, 'Business Analytics', NULL, NULL),
(23, 6, 'Information Technology', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `state_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'West Bengal', NULL, NULL),
(2, 1, 'Bihar', NULL, NULL),
(3, 1, 'Karnataka', NULL, NULL),
(4, 1, 'Maharashtra', NULL, NULL),
(5, 1, 'Tamil Nadu', NULL, NULL),
(6, 2, 'Dhaka', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registration_number` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `current_course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `current_specialization_id` bigint(20) UNSIGNED DEFAULT NULL,
  `academic_id` bigint(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `basic_information_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `registration_number`, `name`, `email`, `otp`, `phone_no`, `current_course_id`, `current_specialization_id`, `academic_id`, `image`, `signature`, `password`, `password_reset_token`, `created_at`, `updated_at`, `address_id`, `basic_information_id`) VALUES
(4, 'STU20250409C708', 'Madison Beck', 'kigewij326@noroasis.com', NULL, '9876543456', NULL, NULL, NULL, 'madison_beck_STU20250409C708.jpg', 'madison_beck_STU20250409C708.jpg', '88e7182304a2f6aea5147aa11ef1638a9aa573a7926074e50d203f79e4622b6a', NULL, '2025-04-08 22:53:48', '2025-04-08 22:59:29', 4, 4),
(5, 'STU2025040963D4', 'Ryan Nash', 'pomica8080@sotiella.com', NULL, '8765434567', NULL, NULL, NULL, 'ryan_nash_STU2025040963D4.jpg', 'ryan_nash_STU2025040963D4.jpg', '44f969e58837a45efc505c8d97f0fbe8aa06126e9b9022e0d5ab6f0300459a74', NULL, '2025-04-08 23:04:34', '2025-04-08 23:06:39', 5, 5),
(6, NULL, 'Kiara French', 'fare@mailinator.com', '168458', NULL, NULL, NULL, NULL, NULL, NULL, 'de0ae2ee25600a8f1c3f69ad405e18e91c9bc61eddc110a5bc4742b2ac2b789f', NULL, '2025-04-08 23:13:32', '2025-04-08 23:13:32', NULL, NULL),
(7, NULL, 'Sloane Moody', 'tewic@mailinator.com', '129796', NULL, NULL, NULL, NULL, NULL, NULL, '883f06ca2c075525bf7df6118b9b01d7479f197cbe5ff958edaea5328fa13f88', NULL, '2025-04-08 23:20:03', '2025-04-08 23:20:03', NULL, NULL),
(8, 'STU202504095B01', 'Jade Stanton', 'cabo@mailinator.com', NULL, '4567898765', NULL, NULL, NULL, 'jade_stanton_STU202504095B01.jpg', 'jade_stanton_STU202504095B01.jpg', 'f8300c71b0fc489cb92905e2befaba47a4bab13bc5325afe3a2c6c84bfbcae25', NULL, '2025-04-08 23:21:04', '2025-04-08 23:22:46', 6, 6),
(9, 'STU20250409D105', 'Callie Gonzalez', 'ciqude@mailinator.com', NULL, '4567654321', NULL, NULL, NULL, 'callie_gonzalez_STU20250409D105.jpg', 'callie_gonzalez_STU20250409D105.jpg', '8e9e661af0536ffd83f692cd376534506ebb6f748b3639a65cbccee8a701c20b', NULL, '2025-04-08 23:23:35', '2025-04-08 23:25:01', 7, 7),
(10, 'STU20250409C781', 'Echo Terrell', 'puzoxab@mailinator.com', NULL, '8976543456', NULL, NULL, NULL, 'echo_terrell_STU20250409C781.jpg', 'echo_terrell_STU20250409C781.jpg', '41e2a57b5fc5f5773e77c99a1daec565ff86b2b910137203de3a38c617beefda', NULL, '2025-04-08 23:26:42', '2025-04-08 23:28:28', 8, 8),
(11, 'STU202504099C13', 'Acton Dominguez', 'fosysyz@mailinator.com', NULL, '7865432345', NULL, NULL, NULL, 'acton_dominguez_STU202504099C13.jpg', 'acton_dominguez_STU202504099C13.jpg', '6100020993aa51633f4e0566ba35c09a85c398ecec47e4419416d7324b43110f', NULL, '2025-04-08 23:29:02', '2025-04-08 23:30:54', 9, 9),
(12, 'STU202504099E87', 'Kylee Dunn', 'divebapep@mailinator.com', NULL, '6754345789', NULL, NULL, NULL, 'kylee_dunn_STU202504099E87.jpg', 'kylee_dunn_STU202504099E87.jpg', '01d9b400501212639fc5c31de0b3b39d882e62985fef6cf5245f82b33fc4de88', NULL, '2025-04-08 23:31:22', '2025-04-08 23:32:45', 10, 10),
(13, 'STU202504095006', 'Adrienne Cruz', 'lepagawan@mailinator.com', NULL, '9876789878', NULL, NULL, NULL, 'adrienne_cruz_STU202504095006.jpg', 'adrienne_cruz_STU202504095006.jpg', 'df551b19907f5791ea747d44c60ae935b6fff65fa544d6d24ea98b9082f5f66d', NULL, '2025-04-08 23:33:43', '2025-04-08 23:35:27', 11, 11),
(14, 'STU20250409F9E0', 'Hilda Banks', 'gyhikoj@mailinator.com', NULL, '7655677656', NULL, NULL, NULL, 'hilda_banks_STU20250409F9E0.png', 'hilda_banks_STU20250409F9E0.jpg', '6c0254d79244cdf04d7f79c0ef9b915881989a0a0580097d66426157a0171a3d', NULL, '2025-04-08 23:35:55', '2025-04-08 23:37:08', 12, 12),
(15, 'STU20250409AA8C', 'Beatrice Mays', 'vufahadugo@mailinator.com', NULL, '8877676676', NULL, NULL, NULL, 'beatrice_mays_STU20250409AA8C.jpg', 'beatrice_mays_STU20250409AA8C.jpg', 'c54586426a535e66d4272ecad89f763413a14c90fb5f8efc36232e1545716e30', NULL, '2025-04-08 23:37:29', '2025-04-08 23:39:27', 13, 13),
(16, 'STU202504091760', 'Uriah Walters', 'wipyte@mailinator.com', NULL, '6777877645', NULL, NULL, NULL, 'uriah_walters_STU202504091760.jpg', 'uriah_walters_STU202504091760.jpg', '1dd6503867d647416297333d2fde16172e9610c68798aaf4b507100520e0ad21', NULL, '2025-04-08 23:39:49', '2025-04-08 23:41:30', 14, 14),
(17, 'STU20250409116F', 'Dana Roy', 'kacy@mailinator.com', NULL, '9876544456', NULL, NULL, NULL, 'dana_roy_STU20250409116F.jpg', 'dana_roy_STU20250409116F.jpg', '0d196b361d930eceb6a7cb5a08e84af0b1a3b6aa7e62c34801f4efdcb11984ef', NULL, '2025-04-08 23:42:46', '2025-04-08 23:44:12', 15, 15),
(18, 'STU20250409384C', 'Kylan Wiley', 'kugahudi@mailinator.com', NULL, '7866767687', NULL, NULL, NULL, 'kylan_wiley_STU20250409384C.jpg', 'kylan_wiley_STU20250409384C.jpg', '2c42cef6f558d625c421a03540ea13f8519abf08167f66fbf789ea1d5a9822f6', NULL, '2025-04-08 23:44:41', '2025-04-08 23:46:27', 16, 16),
(19, 'STU202504091E7A', 'Virginia Frank', 'rorevegi@mailinator.com', NULL, '9987899889', NULL, NULL, NULL, 'virginia_frank_STU202504091E7A.jpg', 'virginia_frank_STU202504091E7A.jpg', '10a9116fcecffbd43d1212b8b588126777ea2c95104cdf11407e148309d56253', NULL, '2025-04-08 23:47:04', '2025-04-08 23:48:27', 17, 17),
(20, 'STU202504093CB8', 'Gisela Jensen', 'nazyjyx@mailinator.com', NULL, '7898789009', NULL, NULL, NULL, 'gisela_jensen_STU202504093CB8.jpg', 'gisela_jensen_STU202504093CB8.jpg', 'a10c9159853c66af732df95b3991804065c81249efcc5e0ae5a4eaee1db4d283', NULL, '2025-04-08 23:48:49', '2025-04-08 23:51:04', 18, 18),
(21, 'STU20250409E621', 'Hamilton Mayer', 'hinab@mailinator.com', NULL, '7676567656', NULL, NULL, NULL, 'hamilton_mayer_STU20250409E621.jpg', 'hamilton_mayer_STU20250409E621.jpg', 'c627737c4fe7e3ce7b670e599e7d1add4e72d2185aff14a39ef4d570624a3db9', NULL, '2025-04-08 23:51:35', '2025-04-08 23:52:58', 19, 19),
(22, 'STU202504095C7B', 'Hadley Duke', 'fatonaveba@mailinator.com', NULL, '5677656787', NULL, NULL, NULL, 'hadley_duke_STU202504095C7B.jpg', 'hadley_duke_STU202504095C7B.jpg', 'a22f784a14c130977ee49570bf4d82c8f61ef08cd9c1818127d76a648cb43400', NULL, '2025-04-08 23:53:20', '2025-04-08 23:55:14', 20, 20),
(23, 'STU20250409F0BC', 'Rudyard Whitehead', 'mazikot@mailinator.com', NULL, '7754453343', NULL, NULL, NULL, 'rudyard_whitehead_STU20250409F0BC.jpg', 'rudyard_whitehead_STU20250409F0BC.jpg', '3219942900c87db518eeff493025a9378a976e145d89bbe7effee78238475787', NULL, '2025-04-08 23:55:35', '2025-04-08 23:56:56', 21, 21),
(24, 'STU202504090EDA', 'Lacota Fleming', 'gadibyce@mailinator.com', NULL, '9089098678', NULL, NULL, NULL, 'lacota_fleming_STU202504090EDA.jpg', 'lacota_fleming_STU202504090EDA.jpg', 'a85c7287fe0b7dbde761a44a5f2815efef00154efc38a21680de8482ad58b21b', NULL, '2025-04-08 23:57:29', '2025-04-08 23:58:49', 22, 22),
(25, 'STU202504096BBD', 'Nash Parsons', 'numu@mailinator.com', NULL, '6787678098', NULL, NULL, NULL, 'nash_parsons_STU202504096BBD.jpg', 'nash_parsons_STU202504096BBD.jpg', '2e322d2d1ba015e2bb7ec25a0671270fae52619d4749b53b96fa46ba906ac8e0', NULL, '2025-04-08 23:59:27', '2025-04-09 00:00:53', 23, 23),
(26, 'STU20250409B059', 'Tasha Perkins', 'fahada@mailinator.com', NULL, '6789098765', NULL, NULL, NULL, 'tasha_perkins_STU20250409B059.jpg', 'tasha_perkins_STU20250409B059.jpg', 'd394c06275b90315cef8c10228dbfdd4a02795f55cfb0e19bdc8c3bb589cb7ab', NULL, '2025-04-09 00:01:15', '2025-04-09 00:02:39', 24, 24),
(27, 'STU20250409B2CC', 'Ryan Fitzgerald', 'wolizevede@mailinator.com', NULL, '6787654309', NULL, NULL, NULL, 'ryan_fitzgerald_STU20250409B2CC.jpg', 'ryan_fitzgerald_STU20250409B2CC.jpg', '732c2c5a690baeda40d86f801c550d638c51cdc7349be0b508e6a6bccc24664f', NULL, '2025-04-09 00:02:55', '2025-04-09 00:04:41', 25, 25),
(28, 'STU202504091F3A', 'Tucker Welch', 'fozokaga@mailinator.com', NULL, '8976567809', NULL, NULL, NULL, 'tucker_welch_STU202504091F3A.jpg', 'tucker_welch_STU202504091F3A.jpg', '0733db430458d9c5ff36d22522e8b2f4e23f13f69f9676bf9d3040d9e88be864', NULL, '2025-04-09 00:04:58', '2025-04-09 00:06:21', 26, 26),
(29, 'STU202504096A9E', 'Olympia Justice', 'solesupica@mailinator.com', NULL, '6789878989', NULL, NULL, NULL, 'olympia_justice_STU202504096A9E.jpg', 'olympia_justice_STU202504096A9E.jpg', '051db366f6921e8e8f0d45b0982a2c16d8a3b08df79af8122c0030edd1901d7a', NULL, '2025-04-09 00:06:47', '2025-04-09 00:08:16', 27, 27),
(30, 'STU202504096F30', 'Walter Mcneil', 'wulitociqy@mailinator.com', NULL, '8767453210', NULL, NULL, NULL, 'walter_mcneil_STU202504096F30.jpg', 'walter_mcneil_STU202504096F30.jpg', 'daa73fffda50ea373f493fc4e31deae120c17f39f1c2bc515918ad165494957c', NULL, '2025-04-09 00:08:37', '2025-04-09 00:10:16', 28, 28),
(31, 'STU202504099EE9', 'Gil Howe', 'meno@mailinator.com', NULL, '4567890987', NULL, NULL, NULL, 'gil_howe_STU202504099EE9.jpg', 'gil_howe_STU202504099EE9.jpg', 'dd676a200771c176cd890c6871b7bd0bd65cb6aad5fd10eebc9f3af86137af3f', NULL, '2025-04-09 04:32:45', '2025-04-09 04:34:15', 29, 29),
(32, 'STU20250409B7DD', 'Christopher West', 'zupasex@mailinator.com', NULL, '4567654323', NULL, NULL, NULL, 'christopher_west_STU20250409B7DD.jpg', 'christopher_west_STU20250409B7DD.jpg', 'c8d0778778e9a65e51dceea3cea427ac136ce36da725563b62a07461b5af141d', NULL, '2025-04-09 04:34:39', '2025-04-09 04:36:05', 30, 30),
(33, 'STU20250409726C', 'Uma Bright', 'quqicyr@mailinator.com', NULL, '9876543456', NULL, NULL, NULL, 'uma_bright_STU20250409726C.jpg', 'uma_bright_STU20250409726C.jpg', 'f2c91ee212108328f0803ab7d672afad8e09dc050e231c18c559fe80bb02c7ac', NULL, '2025-04-09 04:36:34', '2025-04-09 04:38:52', 31, 31),
(34, 'STU20250409E023', 'Maite Harding', 'cojaxydu@mailinator.com', NULL, '7898754567', NULL, NULL, NULL, 'maite_harding_STU20250409E023.jpg', 'maite_harding_STU20250409E023.jpg', '53043c24c7bbfa82e93758d2ecce0ace8890c61bd91bb7e5a48777046929e197', NULL, '2025-04-09 04:39:13', '2025-04-09 04:41:58', 32, 32),
(35, 'STU202504090399', 'Forrest Pope', 'dirudobyv@mailinator.com', NULL, '6547654345', NULL, NULL, NULL, 'forrest_pope_STU202504090399.jpg', 'forrest_pope_STU202504090399.jpg', '1702ffa721d5c2b3621e92e592eb40a37ad9061e557aa29d76f0ab94a6ef17ce', NULL, '2025-04-09 04:44:17', '2025-04-09 04:45:53', 33, 33),
(36, 'STU202504094A91', 'Mallory Steele', 'lozomowyn@mailinator.com', NULL, '7890098909', NULL, NULL, NULL, 'mallory_steele_STU202504094A91.jpg', 'mallory_steele_STU202504094A91.jpg', '230361c6b3a358d771a1ccc119477f8f587053bca5a83ded8e418b51ad34ca4b', NULL, '2025-04-09 04:46:12', '2025-04-09 04:47:48', 34, 34),
(37, 'STU20250409F821', 'Ursula Stephens', 'hobo@mailinator.com', NULL, '7654321234', NULL, NULL, NULL, 'ursula_stephens_STU20250409F821.jpg', 'ursula_stephens_STU20250409F821.jpg', '37c292dd4a79e395ae4dc169e5c35d3f1016577026f5a9213aa481fd45eaef81', NULL, '2025-04-09 04:48:23', '2025-04-09 04:50:18', 35, 35),
(38, 'STU202504091A5D', 'Maisie Howe', 'nypyvyqix@mailinator.com', NULL, '6767675445', NULL, NULL, NULL, 'maisie_howe_STU202504091A5D.jpg', 'maisie_howe_STU202504091A5D.jpg', '1a74625cc362a962a3b89b0dd5efdeee63e36a391ac4928cce97a6bf2fca7064', NULL, '2025-04-09 04:50:48', '2025-04-09 04:52:18', 36, 36),
(39, 'STU20250409ACE3', 'Nash Francis', 'nireda@mailinator.com', NULL, '7687678798', NULL, NULL, NULL, 'nash_francis_STU20250409ACE3.jpg', 'nash_francis_STU20250409ACE3.jpg', '4acae02798390d1cd97f6c27610fb553fad38a1dfe4c0c24c1f6e393f7e3301c', NULL, '2025-04-09 04:52:42', '2025-04-09 04:54:12', 37, 37),
(40, 'STU20250416FD33', 'Aurora Delaney', 'nehaqyqab@mailinator.com', NULL, '7687564987', NULL, NULL, NULL, 'aurora_delaney_STU20250416FD33.jpg', 'aurora_delaney_STU20250416FD33.jpg', '611857d32308c99b4a96d5dad42d3f4b001f91636f372fa116f67a0a375cf2d9', NULL, '2025-04-16 03:20:13', '2025-04-16 03:40:28', 38, 38),
(41, 'STU2025042573FD', 'Violet Nash', 'vijyg@mailinator.com', NULL, '7654388776', NULL, NULL, NULL, 'violet_nash_STU2025042573FD.jpg', 'violet_nash_STU2025042573FD.jpg', 'acb33857708b46f624b7a195ea285f79fc316d8305cfddb3b4c1959de4b9a13d', NULL, '2025-04-24 22:49:19', '2025-04-24 22:55:53', 39, 39),
(42, 'STU202504284F91', 'Isabella Scott', 'nowewysep@mailinator.com', NULL, '8778677654', NULL, NULL, NULL, 'isabella_scott_STU202504284F91.jpg', 'isabella_scott_STU202504284F91.jpg', '6794b5d285e69259c3529911fc302aa20eaf85b8cdb90deb27c2f0cb53e6b8ab', NULL, '2025-04-27 22:52:56', '2025-04-27 23:35:47', 40, 40),
(43, 'STU2025042887E1', 'Shaine Gray', 'wixof@mailinator.com', NULL, '8888788778', NULL, NULL, NULL, 'shaine_gray_STU2025042887E1.jpg', 'shaine_gray_STU2025042887E1.jpg', 'd8faf3322787c87b3e4583e6664cf8f0356449a645caa2c63b785ee98408c535', NULL, '2025-04-28 04:56:55', '2025-04-28 05:08:01', 41, 41),
(44, 'STU20250506BD7F', 'Bernard Cook', 'gimexynet@mailinator.com', NULL, '6787678906', NULL, NULL, NULL, 'bernard_cook_STU20250506BD7F.jpg', 'bernard_cook_STU20250506BD7F.jpg', 'e028e849ea175e676bcb6dd4523458ba207eabc343d6834b2d4d696f4d400487', NULL, '2025-05-06 02:03:44', '2025-05-06 02:07:14', 42, 42),
(45, 'STU20250506D6F9', 'Moana Robertson', 'harel@mailinator.com', NULL, '4565456545', NULL, NULL, NULL, 'moana_robertson_STU20250506D6F9.jpg', 'moana_robertson_STU20250506D6F9.jpg', '38d61360aca1205dc28fc64687e8c2b69c964e2dc4248890e2e8d243717e8f4a', NULL, '2025-05-06 04:24:34', '2025-05-06 05:53:34', 43, 43),
(46, 'STU202505065084', 'Silas Middleton', 'qoti@mailinator.com', NULL, '6776677667', NULL, NULL, NULL, 'silas_middleton_STU202505065084.png', 'silas_middleton_STU202505065084.jpg', 'be797c0fd2d8a5eb23518bbf716782913c059ca435f83fc3e9aa59cba0f26c60', NULL, '2025-05-06 05:57:08', '2025-05-06 05:59:05', 44, 44),
(47, NULL, 'Patrick Bowers', 'lolequ@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42b25fa20a0002af88d00c2deed159c5026590203d92df630025f4e2280bafde', NULL, '2025-05-12 01:48:48', '2025-05-12 01:49:08', NULL, NULL),
(48, 'STU20250513786C', 'Kennan Frank', 'muwoh@mailinator.com', NULL, '8767545665', NULL, NULL, NULL, 'kennan_frank_STU20250513786C.jpg', 'kennan_frank_STU20250513786C.jpg', '8ee5c0916c57fbbe551de4713b3d78305de60e98274a53f75d49c6d99122a8fe', NULL, '2025-05-13 03:04:52', '2025-05-13 03:22:09', 45, 45),
(49, 'STU202505134CD1', 'Halla Hart', 'zarymig@mailinator.com', NULL, '3456543454', 5, 16, NULL, 'halla_hart_STU202505134CD1.jpg', 'halla_hart_STU202505134CD1.jpg', 'e09665d8b381d42ac49e25ffed1e478a30b7aa06f68f48d213d28e70c5c87517', NULL, '2025-05-13 03:22:48', '2025-05-13 04:25:36', 46, 46),
(50, 'STU2025051318B2', 'Noel Mclaughlin', 'hized@mailinator.com', NULL, '7776655656', 5, 16, NULL, 'noel_mclaughlin_STU2025051318B2.jpg', 'noel_mclaughlin_STU2025051318B2.jpg', '1eee430d69f94cc4966d45d961a07d8c565c5c1b145ad0cbc96eab0f928a9158', NULL, '2025-05-13 04:26:59', '2025-05-13 04:46:21', 47, 47),
(51, 'STU20250513B03E', 'Blair Myersh', 'higina@mailinator.com', NULL, '6556786565', 4, 13, NULL, 'blair_myers_STU20250513B03E.jpg', 'blair_myers_STU20250513B03E.jpg', '1120d11a7acdea74cdd5490600efebde0646c5edc27f031c87a808ecbe301a39', NULL, '2025-05-13 04:48:33', '2025-05-13 05:48:49', 48, 48),
(52, 'STU2025051440D5', 'Hillary Gibbs', 'cizaponer@mailinator.com', NULL, '8787677677', 4, 13, 2, 'hillary_gibbs_STU2025051440D5.jpg', 'hillary_gibbs_STU2025051440D5.jpg', 'f7dc0f5b331479db4a3b9659136ceaeae140b365528398f3b69c45727b5cee5b', NULL, '2025-05-14 04:30:58', '2025-05-14 04:32:19', 49, 49),
(53, 'STU20250520F1A7', 'Perry Rowe', 'nukigynule@mailinator.com', NULL, '7676788798', 4, 11, 5, 'perry_rowe_STU20250520F1A7.jpg', 'perry_rowe_STU20250520F1A7.jpg', '4b912d44bd3fb2b8371bed0b4a5e57dc22faff7e955816c1fe190ed284978772', NULL, '2025-05-19 23:52:26', '2025-05-19 23:54:21', 50, 50),
(55, 'STU202505228B2E', 'Sourav Pradhan', 'ganeshghorai42@gmail.com', '185971', '7047707091', 4, 11, 5, 'sourav_pradhan_STU202505228B2E.jpg', 'sourav_pradhan_STU202505228B2E.jpg', '76410d90e8add481bdae860506f0ad17b2e0868aafc3b88d3e061cd5f1a36f47', 'WXDDD9Pq4cqCbcnLPoqF8c1cGmjCyRlyzcHhLaBfMYq1xI574HAbnZaZXVNg', '2025-05-22 03:35:01', '2025-06-02 05:36:45', 52, 52),
(56, 'STU202506022131', 'Yardley Love', 'bahoqamive@mailinator.com', NULL, '6756654556', 4, 12, 5, 'yardley_love_STU202506022131.jpg', 'yardley_love_STU202506022131.jpg', '17354d83a034429bc3c65d44344d3b013f4e99e1300da7a3eaf1f6714fc9707e', NULL, '2025-06-01 23:36:14', '2025-06-01 23:41:56', 53, 53),
(57, NULL, 'Jenna Summers', 'donux@mailinator.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5703deccd9a8384069a3796c0823ef62929b2067fa90745cd09a5c11482919f0', NULL, '2025-06-02 04:49:43', '2025-06-02 04:50:13', NULL, NULL),
(58, NULL, 'Kylan Terrell', 'huzuxufe@mailinator.com', '321594', NULL, NULL, NULL, NULL, NULL, NULL, '9ebb9b783b8669ea3706acedd5a4aac1653c4eddb7d306ed1c54114743c8c52b', NULL, '2025-06-02 04:50:38', '2025-06-02 04:50:38', NULL, NULL),
(59, 'STU202506026946', 'Zenaida Branch', 'myvuqyxi@mailinator.com', NULL, '6556655665', 4, 14, 5, 'zenaida_branch_STU202506026946.jpg', 'zenaida_branch_STU202506026946.jpg', 'dc3c023e595a7d602db3cb14adbc274b5e0713e5c61e08336c7331de939adba5', NULL, '2025-06-02 04:51:22', '2025-06-02 04:52:57', 54, 54),
(60, 'STU202506029123', 'Gloria Zimmerman', 'tubiniwid@mailinator.com', NULL, '6556555565', 4, 12, 5, 'gloria_zimmerman_STU202506029123.png', 'gloria_zimmerman_STU202506029123.jpg', '1b4140f11a6e4d5ae194dc040a23a6cb160d0f944a4d2d48cafee88f484b6ae9', NULL, '2025-06-02 05:39:05', '2025-06-02 05:41:28', 55, 55),
(62, 'STU202506033A4A', 'Ganesh Ghorai', 'ganeshghorai444@gmail.com', NULL, '8967228774', 4, 11, 5, 'ganesh_ghorai_STU202506033A4A.jpg', 'ganesh_ghorai_STU202506033A4A.jpg', '76410d90e8add481bdae860506f0ad17b2e0868aafc3b88d3e061cd5f1a36f47', NULL, '2025-06-03 05:10:04', '2025-06-03 05:18:16', 57, 57);

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `fees_structure_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status` enum('paid','pending') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_details`
--
ALTER TABLE `academic_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_details_school_id_foreign` (`school_id`),
  ADD KEY `fk_student_id` (`student_id`);

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_country_id_foreign` (`country_id`),
  ADD KEY `address_state_id_foreign` (`state_id`),
  ADD KEY `address_district_id_foreign` (`district_id`),
  ADD KEY `address_student_id_foreign` (`student_id`);

--
-- Indexes for table `basic_information`
--
ALTER TABLE `basic_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basic_information_student_id_foreign` (`student_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_academic_details`
--
ALTER TABLE `current_academic_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `specialization_id` (`specialization_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_state_id_foreign` (`state_id`);

--
-- Indexes for table `fees_details`
--
ALTER TABLE `fees_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_head_id` (`fees_head_id`);

--
-- Indexes for table `fees_heads`
--
ALTER TABLE `fees_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_payment_details`
--
ALTER TABLE `fees_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_payment_header`
--
ALTER TABLE `fees_payment_header`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fees_structure_id` (`fees_structure_id`);

--
-- Indexes for table `fees_payment_schedules`
--
ALTER TABLE `fees_payment_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_structure_id` (`fees_structure_id`);

--
-- Indexes for table `fees_structure`
--
ALTER TABLE `fees_structure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `academic_course_semester` (`academic_id`,`course_id`,`semester_id`) USING BTREE,
  ADD KEY `course_id` (`course_id`),
  ADD KEY `fk_semester_id` (`semester_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_head_id` (`fees_head_id`),
  ADD KEY `payment_table_id` (`payment_table_id`);

--
-- Indexes for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_student` (`student_id`),
  ADD KEY `idx_fees_structure` (`fees_structure_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialization_course_id_foreign` (`course_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_country_id_foreign` (`country_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_registration_number_unique` (`registration_number`),
  ADD KEY `fk_students_address` (`address_id`),
  ADD KEY `fk_students_basic` (`basic_information_id`),
  ADD KEY `current_course_id` (`current_course_id`),
  ADD KEY `current_specialization_id` (`current_specialization_id`),
  ADD KEY `academic_id` (`academic_id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student` (`student_id`),
  ADD KEY `fk_fees_structure` (`fees_structure_id`),
  ADD KEY `fk_semester` (`semester_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_details`
--
ALTER TABLE `academic_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `basic_information`
--
ALTER TABLE `basic_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `current_academic_details`
--
ALTER TABLE `current_academic_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fees_details`
--
ALTER TABLE `fees_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `fees_heads`
--
ALTER TABLE `fees_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fees_payment_details`
--
ALTER TABLE `fees_payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_payment_header`
--
ALTER TABLE `fees_payment_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees_payment_schedules`
--
ALTER TABLE `fees_payment_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fees_structure`
--
ALTER TABLE `fees_structure`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `payment_table`
--
ALTER TABLE `payment_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_details`
--
ALTER TABLE `academic_details`
  ADD CONSTRAINT `academic_details_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `address_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `address_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `address_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`),
  ADD CONSTRAINT `address_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `basic_information`
--
ALTER TABLE `basic_information`
  ADD CONSTRAINT `basic_information_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `current_academic_details`
--
ALTER TABLE `current_academic_details`
  ADD CONSTRAINT `current_academic_details_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `current_academic_details_ibfk_2` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `current_academic_details_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);

--
-- Constraints for table `fees_details`
--
ALTER TABLE `fees_details`
  ADD CONSTRAINT `fees_details_ibfk_2` FOREIGN KEY (`fees_head_id`) REFERENCES `fees_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fees_payment_header`
--
ALTER TABLE `fees_payment_header`
  ADD CONSTRAINT `fees_payment_header_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_payment_header_ibfk_2` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees_payment_schedules`
--
ALTER TABLE `fees_payment_schedules`
  ADD CONSTRAINT `fees_payment_schedules_ibfk_1` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees_structure`
--
ALTER TABLE `fees_structure`
  ADD CONSTRAINT `fees_structure_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fees_structure_ibfk_3` FOREIGN KEY (`academic_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_semester_id` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`fees_head_id`) REFERENCES `fees_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_details_ibfk_2` FOREIGN KEY (`payment_table_id`) REFERENCES `payment_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD CONSTRAINT `fk_payment_fees_structure` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_payment_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specialization`
--
ALTER TABLE `specialization`
  ADD CONSTRAINT `specialization_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_address` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_students_basic` FOREIGN KEY (`basic_information_id`) REFERENCES `basic_information` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`current_course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`current_specialization_id`) REFERENCES `specialization` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`academic_id`) REFERENCES `academic_years` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD CONSTRAINT `fk_fees_structure` FOREIGN KEY (`fees_structure_id`) REFERENCES `fees_structure` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_semester` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
