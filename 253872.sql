-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 25, 2021 at 09:15 PM
-- Server version: 10.3.22-MariaDB-log
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `253872`
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
(60, 50, 72, 'A while back I was informed about the existence of this website.  I have many times been very suspicious of any sort of audition where you have to pay.  However, I was very happy to see that they attempted to follow through in full and provide a platform for the singers to perform in front of people.  Particular congratulations have to go to Cat Woodward and her husband Ben, who performed a very difficult piece.  It came through even within the confines of live streaming and in a small room that Cat would do exceptionally well in such repertoire.  Bravo to all!  I hope tht these blind auditions (as all initial stages of auditions should be) will lead these fine singers to something.  ', '2021-03-16 09:43:43'),
(61, 50, 73, 'Μία πολύ ωραία παράσταση του Βαφτιστικού σε αυτές τις δύσκολες εποχές.  Ιδιαίτερο μπράβο στους συντελεστές που φορούσαν και ωραία κοστουμια και έδωσαν ένα όμορφο αίσθημα παρόλο που η παράσταση ήταν χωρίς σκηνική δράση.  Η ορχήστρα είχε αρκετά καλό ήχο για το μέγεθος αν και σε κάποια σημεία υπήρχαν μικροαστάθειες από τα έγχορδα.  Αναφορά φυσικά πρέπει να γίνει για τους 4 πρωταγωνιστές Μίνα Πολυχρόνου (Βιβίκα), Μαρία Κατσούρα (Kική), Αντώνης Κορωναίος (Xαρμίδης), Νίκος Καραγκιαούρης (Ζαχαρούλης / Συνταγματάρχης) οι οποίοι έδωσαν όλο το κέφι στους ρόλους τους.  Η Μίνα Πολυχρόνου βρισκόταν σε πολύ καλή φόρμα και έδωσε μία πολύ ωραία ερμηνεία και στα σόλο και στα ντουέτα.  Η Μαρία Κατσούρα ήταν πολύ γλυκειά παρουσία και η φωνή της πάντα γεμάτη έδινε ένα ωραίο κοντράστ με την άλλη πρωταγωνίστρια ειδικά όταν τραγουδούσαν μαζί.  Ο Νικόλας Καραγκιαούρης έδωσε ιδιαίτερη σημασία, εκτός από το φωνητικό και στην υποκριτική του, μεταφέροντας τα συναισθήματα του έντονα με τις εκφράσεις του προσώπου του και το σώμα του.  Τέλος, μία πολύ καλή μέρα για τον Αντώνη Κορωναίο, ο οποίος εκτός των άλλων, ερμήνευσε την άρια \"Ψηλά στο μέτωπο\" χωρίς την ξεκούραση που προσφέρει η χορωδία στο ρεφρέν, τραγουδώντας έτσι μία άρια αρκετά δύσκολη στην πιο δύσκολη της μορφή άρτια και με πολύ τέχνη και τεχνική.  \r\nΑναφορά πρέπει να γίνει όμως και στους τεχνικούς της μαγνητοσκόπησης, οι οποίοι έκαναν πολύ καλή δουλειά και σε εικόνα και ήχο, δίνοντας μας μία αίσθηση κάποιες στιγμές ότι υπήρχε σκηνική δράση, χάρη στα εύστοχα close up των συντελεστών.\r\nΜπράβο σε ολους τους συντελεστές.  Εύχομαι τα καλύτερα!', '2021-03-18 16:09:35'),
(62, 50, 74, 'test', '2021-03-18 22:42:20'),
(63, 52, 72, 'David Blackburn created this NyIop auditions????????????????', '2021-03-19 08:03:38');

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
  `video` varchar(1000) NOT NULL,
  `createdOn` datetime NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`eid`, `reviewtype`, `day_select`, `select_month`, `year`, `venue`, `title`, `link`, `video`, `createdOn`, `like_count`, `dislike_count`) VALUES
(72, 'Media(Youtube, Vimeo etc)', '13', '03', '2021', 'Youtube', 'The Anonymous Audition Project', 'https://www.nyiop.com/', 'https://youtu.be/bfpFmFhryBg', '2021-03-16 09:39:47', 35, 0),
(73, 'Concert Performance of Full Opera', '15', '03', '2021', 'Piraeus Theatre/National TV', 'Vaftistikos', 'https://www.ertflix.gr/synaulies/o-vaftistikos-opereta/?fbclid=IwAR1USNaa4nzZJxfiOv-Q9wiY_joDUfBeHCE90HwH8TOQLC3mp8SIwoh9lzY', 'https://www.ertflix.gr/synaulies/o-vaftistikos-opereta/?fbclid=IwAR1USNaa4nzZJxfiOv-Q9wiY_joDUfBeHCE90HwH8TOQLC3mp8SIwoh9lzY', '2021-03-18 15:59:31', 28, 0),
(75, 'CD', '11', '05', '2020', 'Richard Rittelmann‘s new CD', 'Clair Obscur', 'https://richard-rittelmann.com/clair-obscur/', 'https://youtu.be/N12SvPIps20', '2021-03-18 23:59:03', 14, 0);

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
(46, 'Philip', 'Modenos', 'two@one.one', '$2y$10$4q28vHUJcNiXHuV.sXx2AOgcBonF7m0sCCTABk6HNSyhHm1RXGM/.', './profilepics/beard.png', '2021-02-01 10:22:59'),
(47, 'Philip', 'Modenos', 'one@two.three', '$2y$10$m.PEVFIwphpBgEHtpH5HuumhUMwZu496HvlgEFfv9lZegpC4qe4km', './profilepics/beard.png', '2021-02-03 08:54:48'),
(48, 'Phil', 'Mod', 'gour@miaoulis.gr', '$2y$10$S7KUZX.JLqCbPvXiAVuNruHnPbI1dU6u.amBna3NiGkkeRsQvUoLW', './profilepics/beard.png', '2021-02-22 01:40:17'),
(50, 'Philip', 'Modenos', 'mphilippos@hotmail.com', '$2y$10$1NTLHRv2m/9sFK54ppsKd.ckOUB8YviNyluw47dK5pJfqBUm/EFYi', './profilepics/ModinosPic.jpg', '2021-03-15 23:00:36'),
(51, 'Richard', 'Rittelmann', 'richardtittelmann@gmail.com', '$2y$10$GY7o/Lx2bmV4H.Mc9KAGUuoiH4HFC7KCZ9OKWsOD.hvsU9zB69Lnu', './profilepics/beard.png', '2021-03-18 23:55:22'),
(52, 'Richard', 'Rittelmann', 'richardrittelmann@gmail.com', '$2y$10$Gk.bnQZYNZkigoiW.f1Kcu4c6Kit.FOUTRKyEP87GFFVfRHUJj0Wy', './profilepics/beard.png', '2021-03-19 08:01:35'),
(53, 'Katerina', 'Makri', 'catherine_fa_2000@yahoo.com', '$2y$10$bki/r2fVSXGKMgHJm5.BCOqnFRcpFBqBn0A98JIsxIE71iE/zzTsi', './profilepics/beard.png', '2021-04-12 01:40:42'),
(54, 'DUMORTIER', 'Frédéric', 'f-dumortier@hotmail.fr', '$2y$10$yt8ocvKsAXhZZH80ogO0muVjjOMjEPcRon5RQVHDC5.D4ZNLHJDmS', './profilepics/beard.png', '2021-05-01 19:45:47'),
(55, 'Kassandra', 'Dimopoulou', 'kassandradimopoulou@gmail.com', '$2y$10$wDQloFB5vNXcIlk1cpBPcOtTpyMdDv8vV.4R5AXT8rOS9ldW8k5qG', './profilepics/Screen Shot 2021-01-15 at 16.01.28.png', '2021-05-04 22:55:24'),
(56, 'Judith', 'Smith', 'jayland@ntlworld.com', '$2y$10$y/9Zu6WvhShpvPlE5rGY2urrX/lchm0XA/UTWlmSzlErelevlRFri', './profilepics/beard.png', '2021-05-21 21:36:55'),
(57, 'Evgenia', 'Karatza', 'euge1kara@yahoo.com', '$2y$10$4nNU9a76tSWxy0w1wZMS0emQkb3Q5JMtqVJCkHiDGu5lTTUB9JTFi', './profilepics/beard.png', '2021-05-24 16:20:32');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
