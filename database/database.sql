-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 22, 2024 at 08:46 AM
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
-- Database: `uiiDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `participant` text DEFAULT NULL,
  `stakeHolders` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pictures` varchar(1000) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `dueDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `participant`, `stakeHolders`, `location`, `description`, `pictures`, `category`, `dueDate`) VALUES
(1, 'day 1', 'Kamuhoza', '', '', '', NULL, 'survey', '2023-12-31 22:00:00'),
(2, 'day 1', 'Katabaro', '', '', '', NULL, 'survey', '2023-12-31 22:00:00'),
(3, 'day 1', 'Kimisagara', '', '', '', NULL, 'survey', '2023-12-31 22:00:00'),
(4, 'day 2', 'Kamuhoza', '', '', '', NULL, 'physical', '2024-01-01 22:00:00'),
(5, 'day 2', 'Katabaro', '', '', '', NULL, 'physical', '2024-01-01 22:00:00'),
(6, 'day 2', 'Kimisagara', '', '', '', NULL, 'physical', '2024-01-01 22:00:00'),
(7, 'day 3', 'Kamuhoza', '', '', '', NULL, 'training', '2024-01-02 22:00:00'),
(8, 'day 3', 'Katabaro', '', '', '', NULL, 'training', '2024-01-02 22:00:00'),
(9, 'day 3', 'Kimisagara', '', '', '', NULL, 'training', '2024-01-02 22:00:00'),
(10, 'day 4', 'Kamuhoza', '', '', '', NULL, 'mobilisation', '2024-01-03 22:00:00'),
(11, 'day 4', 'Katabaro', '', '', '', NULL, 'mobilisation', '2024-01-03 22:00:00'),
(12, 'day 4', 'Kimisagara', '', '', '', NULL, 'mobilisation', '2024-01-03 22:00:00'),
(13, 'day 5', 'sector', '', '', '', NULL, 'parade', '2024-01-04 22:00:00'),
(14, 'day 6', 'sector', '', '', '', NULL, 'parade', '2024-01-05 22:00:00'),
(15, 'day 7', 'sector', '', '', '', NULL, 'parade', '2024-01-06 22:00:00'),
(16, 'day 8', 'sector', '', '', '', NULL, 'parade', '2024-01-07 22:00:00'),
(17, 'day 9', 'Kimisagara', '', '', '', NULL, 'training', '2024-01-08 22:00:00'),
(18, 'day 10', 'Kamuhoza', '', '', '', NULL, 'training', '2024-01-09 22:00:00'),
(19, 'day 11', 'Kamuhoza', '', '', '', NULL, 'mobilisation', '2024-01-10 22:00:00'),
(20, 'day 21', 'sector', '', '', '', NULL, 'survey', '2024-01-20 22:00:00'),
(21, 'day 24', 'sector', '', '', '', NULL, 'physical', '2024-01-23 22:00:00'),
(22, 'Feb 1', 'Katabaro', 'you', '', '', NULL, 'training', '2024-01-31 22:00:00'),
(23, 'Day 31', 'Kamuhoza', 'DEO', 'Kimisagara, kwa makuza', 'twubatse amazu 5, imiyoboro n\'ibindi', NULL, 'mobilisation', '2024-02-04 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cohorts`
--

CREATE TABLE `cohorts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `startDate` datetime NOT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `goals` varchar(2000) NOT NULL,
  `additionalInfo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cohorts`
--

INSERT INTO `cohorts` (`id`, `name`, `startDate`, `endDate`, `goals`, `additionalInfo`) VALUES
(1, 'Inkomezabigwi ikiciro cya 11', '2023-09-25 14:40:51', '2023-12-18 12:40:51', 'Building 34 houses for poor families, building vegetable gardens for each village, repairing 25 bridges, joining military parade every three weeks', 'Graduates who will not be certified / attend Urugerero, will not be allowed to attend universities nor have any job before their acquire them');

-- --------------------------------------------------------

--
-- Table structure for table `honors`
--

CREATE TABLE `honors` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `participant` text NOT NULL,
  `description` varchar(500) NOT NULL,
  `dueDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `honors`
--

INSERT INTO `honors` (`id`, `title`, `participant`, `description`, `dueDate`) VALUES
(1, 'honor 1', 'Sector', 'wow', '2024-01-30 22:00:00'),
(2, 'Honor 2', 'Sector', 'honor 3', '2024-01-21 22:00:00'),
(3, 'Yazinduste kurusha abandi', 'Kamuhoza', 'Niwe wakunze kuzinduka', '2024-01-24 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `intoreIdentities`
--

CREATE TABLE `intoreIdentities` (
  `cohortId` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `nationalId` varchar(20) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `mother` varchar(50) NOT NULL,
  `father` varchar(50) NOT NULL,
  `martialStatus` varchar(15) NOT NULL,
  `height` varchar(10) NOT NULL,
  `mass` varchar(10) NOT NULL,
  `bmi` varchar(20) DEFAULT NULL,
  `pressure` varchar(20) DEFAULT NULL,
  `vaccination` varchar(100) DEFAULT NULL,
  `district` varchar(20) NOT NULL,
  `sector` varchar(20) NOT NULL,
  `cell` varchar(20) NOT NULL,
  `village` varchar(20) DEFAULT NULL,
  `firstTel` varchar(20) DEFAULT NULL,
  `secondTel` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `school` varchar(50) DEFAULT NULL,
  `combination` varchar(50) DEFAULT NULL,
  `additionalInfo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intoreIdentities`
--

INSERT INTO `intoreIdentities` (`cohortId`, `id`, `fullName`, `nationalId`, `gender`, `mother`, `father`, `martialStatus`, `height`, `mass`, `bmi`, `pressure`, `vaccination`, `district`, `sector`, `cell`, `village`, `firstTel`, `secondTel`, `email`, `school`, `combination`, `additionalInfo`) VALUES
(1, 1, 'a', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kamuhoza', 'Itetero', '', '', '', '', '', ''),
(1, 2, 'b', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kamuhoza', 'Itetero', '', '', '', '', '', ''),
(1, 3, 'c', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kamuhoza', 'Itetero', '', '', '', '', '', ''),
(1, 4, 'd', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kamuhoza', 'Itetero', '', '', '', '', '', ''),
(1, 5, 'e', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Katabaro', 'Itetero', '', '', '', '', '', ''),
(1, 6, 'f', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Katabaro', 'Itetero', '', '', '', '', '', ''),
(1, 7, 'g', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Katabaro', 'Itetero', '', '', '', '', '', ''),
(1, 8, 'h', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Katabaro', 'Itetero', '', '', '', '', '', ''),
(1, 9, 'i', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Katabaro', 'Itetero', '', '', '', '', '', ''),
(1, 10, 'j', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kimisagara', 'Itetero', '', '', '', '', '', ''),
(1, 11, 'k', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kimisagara', 'Itetero', '', '', '', '', '', ''),
(1, 12, 'l', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kimisagara', 'Itetero', '', '', '', '', '', ''),
(1, 13, 'm', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kimisagara', 'Itetero', '', '', '', '', '', ''),
(1, 14, 'n', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kimisagara', 'Itetero', '', '', '', '', '', ''),
(1, 15, 'o', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kimisagara', 'Itetero', '', '', '', '', '', ''),
(1, 16, 'p', '', 'sex', 'Nyina', 'se', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kimisagara', 'Isimbi', '', '', '', '', '', ''),
(1, 17, 'anotherOne', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Taba', 'sooko', '', '', '', '', '', ''),
(1, 18, 'selec', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Bushokoro', 'koba', '', '', '', '', '', ''),
(1, 19, 'You guys', '0789', 'se', 'nyina', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kamuhoza', 'Isimbi', '', '', '', '', '', ''),
(1, 20, 'god', '34', 'sex', 'nyina', 'se', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Busogo', 'Impamvu', '', '', '', '', '', ''),
(1, 21, 'indi ntore', '', '', '', '', '', '', '', '', '', '', 'Nyarugenge', 'Kimisagara', 'Kamuhoza', 'Isimbi', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `intoreRelations`
--

CREATE TABLE `intoreRelations` (
  `intoreId` int(11) NOT NULL,
  `entityName` varchar(50) NOT NULL,
  `entryId` int(11) NOT NULL,
  `dueDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intoreRelations`
--

INSERT INTO `intoreRelations` (`intoreId`, `entityName`, `entryId`, `dueDate`) VALUES
(1, 'activities', 10, '2024-01-19 12:59:26'),
(1, 'activities', 13, '2024-01-19 13:02:05'),
(1, 'activities', 18, '2024-01-19 18:53:11'),
(1, 'activities', 19, '2024-01-19 18:54:00'),
(1, 'activities', 20, '2024-01-21 04:03:46'),
(1, 'activities', 21, '2024-01-21 15:18:34'),
(1, 'activities', 23, '2024-01-22 07:39:16'),
(1, 'permissions', 5, '2024-01-21 14:06:41'),
(2, 'activities', 7, '2024-01-19 12:56:53'),
(2, 'activities', 10, '2024-01-19 12:59:26'),
(2, 'activities', 13, '2024-01-19 13:02:05'),
(2, 'activities', 18, '2024-01-19 18:53:11'),
(2, 'activities', 19, '2024-01-19 18:54:00'),
(2, 'activities', 21, '2024-01-21 15:18:34'),
(2, 'permissions', 5, '2024-01-21 14:06:41'),
(3, 'activities', 4, '2024-01-19 12:55:04'),
(3, 'activities', 7, '2024-01-19 12:56:53'),
(3, 'activities', 10, '2024-01-19 12:59:26'),
(3, 'activities', 13, '2024-01-19 13:02:05'),
(3, 'activities', 14, '2024-01-19 14:30:32'),
(3, 'activities', 19, '2024-01-19 18:54:00'),
(3, 'activities', 20, '2024-01-21 04:03:46'),
(3, 'activities', 21, '2024-01-21 15:18:34'),
(3, 'permissions', 4, '2024-01-21 12:48:18'),
(3, 'permissions', 5, '2024-01-21 14:06:41'),
(4, 'activities', 1, '2024-01-19 12:53:18'),
(4, 'activities', 4, '2024-01-19 12:55:04'),
(4, 'activities', 7, '2024-01-19 12:56:53'),
(4, 'activities', 10, '2024-01-19 12:59:26'),
(4, 'activities', 13, '2024-01-19 13:02:05'),
(4, 'activities', 14, '2024-01-19 14:30:31'),
(4, 'activities', 15, '2024-01-19 16:28:47'),
(4, 'activities', 19, '2024-01-19 18:54:00'),
(4, 'activities', 21, '2024-01-21 15:18:34'),
(4, 'activities', 23, '2024-01-22 07:39:16'),
(4, 'permissions', 2, '2024-01-20 14:11:35'),
(4, 'permissions', 4, '2024-01-21 12:48:18'),
(4, 'permissions', 5, '2024-01-21 14:06:41'),
(5, 'activities', 13, '2024-01-19 13:02:05'),
(5, 'activities', 20, '2024-01-21 04:03:46'),
(5, 'activities', 21, '2024-01-21 15:18:34'),
(5, 'permissions', 4, '2024-01-21 12:48:18'),
(6, 'activities', 11, '2024-01-19 13:00:12'),
(6, 'activities', 13, '2024-01-19 13:02:05'),
(6, 'activities', 21, '2024-01-21 15:18:34'),
(6, 'activities', 22, '2024-01-21 17:12:30'),
(7, 'activities', 8, '2024-01-19 12:57:47'),
(7, 'activities', 11, '2024-01-19 13:00:12'),
(7, 'activities', 13, '2024-01-19 13:02:05'),
(7, 'activities', 16, '2024-01-19 16:37:26'),
(7, 'activities', 20, '2024-01-21 04:03:46'),
(7, 'activities', 21, '2024-01-21 15:18:34'),
(8, 'activities', 5, '2024-01-19 12:55:28'),
(8, 'activities', 8, '2024-01-19 12:57:47'),
(8, 'activities', 11, '2024-01-19 13:00:12'),
(8, 'activities', 13, '2024-01-19 13:02:05'),
(8, 'activities', 14, '2024-01-19 14:30:31'),
(8, 'activities', 16, '2024-01-19 16:37:26'),
(8, 'activities', 21, '2024-01-21 15:18:34'),
(9, 'activities', 2, '2024-01-19 12:53:41'),
(9, 'activities', 5, '2024-01-19 12:55:28'),
(9, 'activities', 8, '2024-01-19 12:57:47'),
(9, 'activities', 11, '2024-01-19 13:00:12'),
(9, 'activities', 13, '2024-01-19 13:02:05'),
(9, 'activities', 14, '2024-01-19 14:30:31'),
(9, 'activities', 16, '2024-01-19 16:38:02'),
(9, 'activities', 20, '2024-01-21 04:03:46'),
(9, 'activities', 21, '2024-01-21 15:18:34'),
(9, 'activities', 22, '2024-01-21 17:12:30'),
(9, 'permissions', 1, '2024-01-20 14:10:19'),
(10, 'activities', 13, '2024-01-19 13:02:05'),
(10, 'activities', 17, '2024-01-19 16:42:17'),
(10, 'activities', 21, '2024-01-21 15:18:34'),
(10, 'permissions', 4, '2024-01-21 12:48:05'),
(11, 'activities', 13, '2024-01-19 13:02:04'),
(11, 'activities', 16, '2024-01-19 16:38:09'),
(11, 'activities', 17, '2024-01-19 16:42:17'),
(11, 'activities', 20, '2024-01-21 04:03:46'),
(11, 'activities', 21, '2024-01-21 15:18:33'),
(11, 'permissions', 4, '2024-01-21 12:48:05'),
(12, 'activities', 12, '2024-01-19 13:00:53'),
(12, 'activities', 13, '2024-01-19 13:02:04'),
(12, 'activities', 20, '2024-01-21 04:03:46'),
(12, 'activities', 21, '2024-01-21 15:18:33'),
(12, 'permissions', 4, '2024-01-21 12:48:05'),
(13, 'activities', 9, '2024-01-19 12:58:35'),
(13, 'activities', 12, '2024-01-19 13:00:53'),
(13, 'activities', 13, '2024-01-19 13:02:04'),
(13, 'activities', 21, '2024-01-21 15:18:33'),
(13, 'permissions', 4, '2024-01-21 12:48:05'),
(14, 'activities', 6, '2024-01-19 12:55:52'),
(14, 'activities', 9, '2024-01-19 12:58:35'),
(14, 'activities', 12, '2024-01-19 13:00:53'),
(14, 'activities', 13, '2024-01-19 13:02:04'),
(14, 'activities', 14, '2024-01-19 14:30:31'),
(14, 'activities', 20, '2024-01-21 04:03:46'),
(14, 'activities', 21, '2024-01-21 15:18:33'),
(15, 'activities', 3, '2024-01-19 12:54:03'),
(15, 'activities', 6, '2024-01-19 12:55:52'),
(15, 'activities', 9, '2024-01-19 12:58:35'),
(15, 'activities', 12, '2024-01-19 13:00:53'),
(15, 'activities', 13, '2024-01-19 13:02:04'),
(15, 'activities', 14, '2024-01-19 14:30:31'),
(15, 'activities', 17, '2024-01-19 16:42:17'),
(15, 'activities', 21, '2024-01-21 15:18:33'),
(15, 'honors', 1, '2024-01-20 11:23:36'),
(15, 'honors', 2, '2024-01-20 11:24:52'),
(15, 'misconducts', 1, '2024-01-20 11:26:06'),
(15, 'permissions', 1, '2024-01-20 14:10:19'),
(15, 'responsibilities', 1, '2024-01-20 08:49:24'),
(15, 'responsibilities', 2, '2024-01-20 08:50:30'),
(16, 'activities', 21, '2024-01-21 15:18:33'),
(17, 'activities', 20, '2024-01-21 04:03:46'),
(17, 'activities', 21, '2024-01-21 15:18:33'),
(18, 'activities', 20, '2024-01-21 04:03:46'),
(18, 'activities', 21, '2024-01-21 15:18:33'),
(19, 'activities', 23, '2024-01-22 07:39:34'),
(21, 'activities', 23, '2024-01-22 07:39:02'),
(21, 'honors', 3, '2024-01-22 07:35:03'),
(21, 'permissions', 6, '2024-01-22 07:32:53'),
(21, 'responsibilities', 3, '2024-01-22 07:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `misconducts`
--

CREATE TABLE `misconducts` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `participant` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `dueDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `misconducts`
--

INSERT INTO `misconducts` (`id`, `title`, `participant`, `description`, `dueDate`) VALUES
(1, 'misconduct1', 'Sector', 'oh no', '2024-02-06 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `participant` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `endDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `category`, `participant`, `description`, `startDate`, `endDate`) VALUES
(1, 'Sick', 'sector', '', '2024-01-02 22:00:00', '2024-01-04 22:00:00'),
(2, 'Studying', 'Kamuhoza', '', '2024-01-02 22:00:00', '2024-01-04 22:00:00'),
(3, 'Sick', 'sector', '', '2024-01-13 22:00:00', '2024-01-30 22:00:00'),
(4, 'Sick', 'sector', 'wow', '2024-01-17 22:00:00', '2024-01-24 22:00:00'),
(5, 'Employed', 'Kamuhoza', 'sds', '2024-01-18 22:00:00', '2024-01-23 22:00:00'),
(6, 'Studying', 'sector', 'at Gs Kimmi', '2024-01-13 22:00:00', '2024-02-09 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `responsibilities`
--

CREATE TABLE `responsibilities` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `participant` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `endDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibilities`
--

INSERT INTO `responsibilities` (`id`, `title`, `participant`, `description`, `startDate`, `endDate`) VALUES
(1, 'Intore Gitifu', 'Sector', 'she is so cool', '2023-12-31 22:00:00', '2024-01-05 22:00:00'),
(2, 'umuhuza ', 'Sector', 'next responsibilities', '2024-01-06 22:00:00', '2024-01-10 22:00:00'),
(3, 'Team B kamuhoza coordinator', 'Sector', 'assigned by Umutoza', '2024-01-06 22:00:00', '2024-01-25 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `userId` int(11) NOT NULL,
  `sectorName` varchar(50) NOT NULL,
  `cellsInSector` varchar(300) NOT NULL,
  `dataRecordingPeriod` varchar(300) NOT NULL,
  `DataAnalyticsPeriod` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `secondName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `focusedCohort` int(11) NOT NULL DEFAULT 1,
  `accessLevel` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `secondName`, `email`, `password`, `focusedCohort`, `accessLevel`) VALUES
(1, 'Bateta', 'Umutoza', 'abc@gmail.com', '3c536bdc7d1ba54a93a3d8ea42f667ae', 1, 1),
(2, 'Emile', 'Ndayishimiye', 'emile@gmail.com', 'b8937d6d6622095319bda5845ccfb0b3', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cohorts`
--
ALTER TABLE `cohorts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `honors`
--
ALTER TABLE `honors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intoreIdentities`
--
ALTER TABLE `intoreIdentities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intoreRelations`
--
ALTER TABLE `intoreRelations`
  ADD PRIMARY KEY (`intoreId`,`entityName`,`entryId`);

--
-- Indexes for table `misconducts`
--
ALTER TABLE `misconducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responsibilities`
--
ALTER TABLE `responsibilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `cohorts`
--
ALTER TABLE `cohorts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `honors`
--
ALTER TABLE `honors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `intoreIdentities`
--
ALTER TABLE `intoreIdentities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `misconducts`
--
ALTER TABLE `misconducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `responsibilities`
--
ALTER TABLE `responsibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;