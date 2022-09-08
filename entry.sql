-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2020 at 01:52 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spoiledeggs`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE `entry` (
  `eid` int(11) NOT NULL,
  `reviewtype` varchar(50) NOT NULL,
  `day_select` varchar(2) NOT NULL,
  `select_month` varchar(20) NOT NULL,
  `year` varchar(4) NOT NULL,
  `venue` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `createdOn` datetime NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`eid`, `reviewtype`, `day_select`, `select_month`, `year`, `venue`, `title`, `link`, `createdOn`, `like_count`, `dislike_count`) VALUES
(56, 'Fully Staged Opera Performance', '01', '08', '2020', 'GNO', 'Tosca', 'http://www.tch.gr/default.aspx?lang=el-GR&page=3&tcheid=2035', '2020-08-12 21:54:52', 1, 2),
(57, 'Fully Staged Opera Performance', '02', '08', '2020', 'TCH', 'Aida', 'http://www.tch.gr/default.aspx?lang=el-GR&page=3&tcheid=1772', '2020-08-12 21:57:51', 3, 4),
(58, 'Fully Staged Opera Performance', '03', '08', '2020', 'MMA', 'La Boheme', 'http://www.tch.gr/default.aspx?lang=el-GR&page=3&tcheid=2246', '2020-08-12 22:00:37', 10, 10),
(60, 'Fully Staged Opera Performance', '17', '08', '2020', 'TCH', 'LULU', '', '2020-08-17 00:44:02', 2, 0),
(62, 'Fully Staged Opera Performance', '17', '08', '2020', 'GNO', 'Manon', '', '2020-08-17 00:49:53', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `reviewtype` (`reviewtype`,`day_select`,`select_month`,`year`,`venue`,`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
