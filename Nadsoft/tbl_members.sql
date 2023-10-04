-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 10:12 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nadsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `id` int NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Name` varchar(50) NOT NULL,
  `ParentId` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`id`, `CreatedDate`, `Name`, `ParentId`) VALUES
(1, '2023-10-04 23:14:34', 'add', 0),
(2, '2023-10-04 23:19:58', 'Vishal', 0),
(3, '2023-10-04 23:20:48', 'Yogesh', 2),
(4, '2023-10-04 23:21:27', 'Chetan', 0),
(5, '2023-10-04 23:25:06', 'Test', 1),
(6, '2023-10-04 23:29:09', 'Arun', 0),
(7, '2023-10-04 23:47:22', 'Chetan', 2),
(8, '2023-10-05 01:36:17', 'Saurabh', 6),
(9, '2023-10-05 01:36:29', 'Kunal', 3),
(10, '2023-10-05 01:36:49', 'Yashwant', 9),
(11, '2023-10-05 01:37:00', 'Test', 9),
(12, '2023-10-05 01:42:42', 'Test2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faster` (`ParentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
