-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2024 at 10:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `Author_ID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Birthdate` date DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  `Bibliography` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`Author_ID`, `FullName`, `Birthdate`, `Nationality`, `Bibliography`) VALUES
(2, 'aad', '2024-03-15', 'add', 'ad');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Book_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Genre` varchar(50) DEFAULT NULL,
  `Language` varchar(50) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `PublicationDate` date DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `AvailabilityStatus` enum('Available','Out of Stock') DEFAULT NULL,
  `Author_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_ID`, `Title`, `Genre`, `Language`, `ISBN`, `PublicationDate`, `Price`, `AvailabilityStatus`, `Author_ID`) VALUES
(1, '2', 'mayal', 'd', 'somali', '0000-00-00', 2024.00, '', 0),
(2, 'mayal', 'd', 'somali', 'ad', '2024-03-29', 33.00, 'Available', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `id` int(11) NOT NULL,
  `Book_ID` int(11) DEFAULT NULL,
  `Author_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`id`, `Book_ID`, `Author_ID`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL,
  `complete_name` varchar(30) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`Author_ID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_ID`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
