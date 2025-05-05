-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 01:49 PM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `Name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Region` int(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Barangay` varchar(200) NOT NULL,
  `Road` varchar(200) NOT NULL,
  `Incident` varchar(200) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Severity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`Name`, `Email`, `Region`, `City`, `Barangay`, `Road`, `Incident`, `Date`, `Description`, `Severity`) VALUES
('', '', 2, 'Mandaue', 'Tipolo', 'Elm Street', 'Fallen Trees', '0000-00-00', '', 'Bad'),
('Heart', 'heartdkho@gmail.com', 7, 'Mandaue', 'Subangdako', 'Ac Cortes st.', 'Accident', '2025-03-05', 'Pothole', 'Good'),
('Jithrix', 'Jithrix@gmail.com', 8, 'Manila', 'Osamis', 'Balen', 'Baug ulo', '2025-04-06', '', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobileno` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`first_name`, `last_name`, `username`, `password`, `mobileno`) VALUES
('Heart', 'Kho', 'heartk466', 'gwapako123', 9164446350),
('Jithrix', 'Bolambao', 'jithrix123', 'Jithrix123', 9074597513),
('Kaye', 'Hormillada', 'kaye123', 'kaye123', 9455210119);

-- --------------------------------------------------------

--
-- Table structure for table `login2`
--

CREATE TABLE `login2` (
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobileno` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login2`
--

INSERT INTO `login2` (`first_name`, `last_name`, `username`, `password`, `mobileno`) VALUES
('Heart', 'Kho', 'heartk466', 'gwapako123', 9164446350),
('Kaye', 'Hormillada', 'kaye123', 'kaye123', 9455210119);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(200) NOT NULL,
  `Region` int(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Barangay` varchar(200) NOT NULL,
  `Project` varchar(200) NOT NULL,
  `Road` varchar(200) NOT NULL,
  `Status` varchar(200) NOT NULL,
  `Percentage` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `Region`, `City`, `Barangay`, `Project`, `Road`, `Status`, `Percentage`) VALUES
(1, 7, 'Mandaue		', 'Subangdako', 'Pothole Repairs', 'M.L Quezon St.', 'Completed', 0),
(2, 7, 'Mandaue', 'Tipolo', 'Resurfacing', 'Lopez Jaena St.', 'Inprogress', 30),
(3, 1, 'La Union', 'San Fernando', 'Bridge Inspection', 'Marilag St.', 'Pending', 0),
(4, 2, 'Mandaue', 'Tipolo', 'Drainage Improvement', 'Elm Street', 'Ongoing', 10),
(5, 4, 'Mandaue', 'Tipolo', 'Lane Expansion', 'Parkway', 'Completed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `road`
--

CREATE TABLE `road` (
  `id` int(200) NOT NULL,
  `Region` int(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Barangay` varchar(200) NOT NULL,
  `Road` varchar(200) NOT NULL,
  `Km` int(200) NOT NULL,
  `Condition` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `road`
--

INSERT INTO `road` (`id`, `Region`, `City`, `Barangay`, `Road`, `Km`, `Condition`) VALUES
(1, 7, 'Mandaue', 'Subangdako', 'M.L Quezon St.', 5, 'Poor'),
(2, 7, 'Mandaue', 'Tipolo', 'Lopez Jaena St.', 8, 'Fair'),
(3, 1, 'La Union', 'San Fernando', 'Marilag St.', 12, 'Poor'),
(4, 2, 'Mandaue', 'Tipolo', 'Elm Street', 6, 'Good'),
(5, 4, 'Mandaue', 'Tipolo', 'Parkway', 10, 'Fair');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`first_name`);

--
-- Indexes for table `login2`
--
ALTER TABLE `login2`
  ADD PRIMARY KEY (`first_name`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `road`
--
ALTER TABLE `road`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
