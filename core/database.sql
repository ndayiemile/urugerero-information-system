-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2024 at 08:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";


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
(1, 'sampe activity', 'Katabaro', 'impossible', 'fs, sf', 'r, re', NULL, 'survey', '2024-01-17 22:00:00');

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
  `additionalInfo` varchar(500) DEFAULT NULL,
  `currentStatus` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `secondName` varchar(100) NOT NULL,
  `focusedCohort` int(11) NOT NULL DEFAULT 1,
  `accessLevel` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cohorts`
--
ALTER TABLE `cohorts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `honors`
--
ALTER TABLE `honors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intoreIdentities`
--
ALTER TABLE `intoreIdentities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `misconducts`
--
ALTER TABLE `misconducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsibilities`
--
ALTER TABLE `responsibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;