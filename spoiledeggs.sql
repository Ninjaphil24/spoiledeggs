-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 08:56 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `entryID` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userID`, `entryID`, `comment`, `createdOn`) VALUES
(28, 33, 56, 'Tosca Comment 1/8/2020.', '2020-08-12 21:55:50'),
(29, 33, 57, 'Aida Comment 2/8/2020.', '2020-08-12 21:58:37'),
(30, 33, 58, 'La Bohème  Comment 3/8/2020', '2020-08-12 22:01:17'),
(31, 33, 58, 'This is comment number 2 for Boheme', '2020-08-16 20:15:16'),
(32, 33, 58, 'Test for eid entry.', '2020-08-16 23:53:58'),
(33, 33, 60, 'I thought it was one of the best productions ever made.  They should do productions like this more often!!!', '2020-08-17 00:46:52'),
(34, 33, 60, 'I agree, it was really really good!!!', '2020-08-17 00:47:15'),
(35, 33, 62, 'Fantastic website!!!', '2020-08-17 00:50:20'),
(36, 41, 62, 'October Comment', '2020-10-15 00:15:57'),
(37, 43, 63, 'Test Comment 3.', '2020-10-15 00:24:22'),
(38, 43, 63, 'Test Comment 2.', '2020-10-15 00:24:38'),
(39, 43, 0, 'October Comment', '2020-10-15 00:29:54'),
(40, 43, 0, 'October Comment', '2020-10-15 00:30:53'),
(41, 44, 64, 'the tenor killed it.  And the soprano seemed to happy in the end.', '2020-10-15 18:55:46'),
(42, 44, 64, 'review # 2', '2020-10-15 18:56:13'),
(43, 45, 0, 'Test Comment 1.', '2020-12-24 10:45:27'),
(44, 47, 66, 'Test Comment 1.', '2021-02-03 08:56:04'),
(45, 0, 66, 'Test Comment 3.', '2021-02-03 10:45:28'),
(46, 0, 66, 'Test Comment 3.', '2021-02-03 10:45:48'),
(47, 47, 66, 'Test Comment 3.', '2021-02-03 11:44:51'),
(48, 48, 66, 'Test Comment 4.', '2021-02-21 22:44:50'),
(49, 48, 66, 'Test Comment 4.', '2021-02-21 22:46:03'),
(50, 48, 64, 'Test Comment 1.', '2021-02-21 22:50:59'),
(51, 48, 64, 'Test Comment 1.', '2021-02-21 22:51:26'),
(52, 48, 64, 'Why is this not working!!!', '2021-02-21 22:52:55'),
(53, 48, 63, 'Hello 123', '2021-02-21 22:53:37'),
(54, 0, 64, 'Test Comment 2.', '2021-02-22 01:38:32'),
(55, 48, 64, 'Test Comment 3.', '2021-02-22 01:40:56'),
(56, 48, 63, 'Test Comment 4.', '2021-02-22 01:56:27'),
(57, 48, 63, 'Test Comment 6.', '2021-02-22 01:57:06');

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
(62, 'Fully Staged Opera Performance', '17', '08', '2020', 'GNO', 'Manon', '', '2020-08-17 00:49:53', 2, 0),
(63, 'Fully Staged Opera Performance', '15', '10', '2020', 'GNO', 'La Boheme', '', '2020-10-15 00:24:12', 7, 6),
(64, 'Fully Staged Opera Performance', '15', '10', '2020', 'GNO', 'Manon', 'https://www.metopera.org/discover/synopses/manon/', '2020-10-15 18:54:38', 0, 17),
(66, 'Fully Staged Opera Performance', '03', '02', '2021', 'ABC', 'ABC', '', '2021-02-03 08:55:47', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `id` int(11) NOT NULL,
  `post` varchar(500) NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_dislike`
--

INSERT INTO `like_dislike` (`id`, `post`, `like_count`, `dislike_count`) VALUES
(1, 'Post1', 10, 5),
(2, 'Post2', 36, 19),
(3, 'Post3', 13, 11),
(4, 'Post4', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `type` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `isReply` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profileImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `email`, `password`, `profileImage`, `registerDate`) VALUES
(45, 'Philip', 'Modenos', 'mphilippos@hotmail.com', '$2y$10$hCMbIlGbLsK.2YE66Kb8MeYwCDP8XhQb27lh0o0odG4nA0SrUxdam', './profilepics/beard.png', '2020-12-24 10:41:36'),
(46, 'Philip', 'Modenos', 'two@one.one', '$2y$10$4q28vHUJcNiXHuV.sXx2AOgcBonF7m0sCCTABk6HNSyhHm1RXGM/.', './profilepics/beard.png', '2021-02-01 10:22:59'),
(47, 'Philip', 'Modenos', 'one@two.three', '$2y$10$m.PEVFIwphpBgEHtpH5HuumhUMwZu496HvlgEFfv9lZegpC4qe4km', './profilepics/beard.png', '2021-02-03 08:54:48'),
(48, 'Phil', 'Mod', 'gour@miaoulis.gr', '$2y$10$S7KUZX.JLqCbPvXiAVuNruHnPbI1dU6u.amBna3NiGkkeRsQvUoLW', './profilepics/beard.png', '2021-02-22 01:40:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `reviewtype` (`reviewtype`,`day_select`,`select_month`,`year`,`venue`,`title`);

--
-- Indexes for table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `like_dislike`
--
ALTER TABLE `like_dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
