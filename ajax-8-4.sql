-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2019 at 11:56 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajax`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(9) UNSIGNED NOT NULL,
  `class` varchar(30) NOT NULL,
  `mid` int(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `mid`) VALUES
(1, 'First Year', 1),
(2, 'Second Year', 1),
(3, 'First Year', 2),
(4, 'Second Year', 2),
(5, 'Third Year', 2),
(6, 'Fourth Year', 2),
(7, 'No Classes Found', 3);

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `mid` int(9) UNSIGNED NOT NULL,
  `degree` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`mid`, `degree`) VALUES
(1, 'BCS'),
(2, 'MCS'),
(3, 'MPhil');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(9) UNSIGNED NOT NULL,
  `img` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `img`, `username`) VALUES
(1, 'uploads/logo1.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`) VALUES
(1, 'root', 'test@test.com'),
(2, 'root', 'test@test.com'),
(3, 'root', 'A@A.co'),
(4, 'root', 'A@A.co'),
(5, 'john', 'test@gmail.com'),
(6, 'john', 'test@gmail.com'),
(7, 'qwe', 'qwe@qe'),
(8, 'qwe', 'qwe@qe'),
(9, 'zxc', 'z@z'),
(10, 'zxc', 'z@z'),
(11, 'q', 'q@q'),
(12, 'q', 'q@q'),
(13, 'q', 'q@q'),
(14, 'q', 'q@q'),
(15, '', 'q@q'),
(16, 'q', 'q@q'),
(17, 'x', 'x@x'),
(18, 'x', 'x@x'),
(19, 'x', 'x@x'),
(20, 'e', 'e@e'),
(26, 'new', 'new@new'),
(27, 'fa', 'fa@fa'),
(28, 'a', 'A@A.co');

-- --------------------------------------------------------

--
-- Table structure for table `usersinfo`
--

CREATE TABLE `usersinfo` (
  `id` int(9) UNSIGNED NOT NULL,
  `userName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `img` blob,
  `imgpath` varchar(255) DEFAULT NULL,
  `isonline` varchar(30) DEFAULT NULL,
  `coverPic` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `personelinfo` varchar(900) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersinfo`
--

INSERT INTO `usersinfo` (`id`, `userName`, `email`, `phone`, `pass`, `img`, `imgpath`, `isonline`, `coverPic`, `profession`, `personelinfo`) VALUES
(139, 'John', 'john.tim@gmail.com', '13333555555', 'abc123', NULL, 'uploads/john.tim-22-1.png', 'true', 'uploads/john.tim-36-scissor-04.png', 'Mobile App Developer', NULL),
(140, 'Colin', 'colin@gmail.com', '9876543211', 'abc123', NULL, 'uploads/colin-601-5.png', 'false', 'uploads/colin-29-scissor-04.png', 'Web developer', 'lorem ipsim a'),
(141, 'James', 'james@gmail.com', '456789123', 'abc123', NULL, 'uploads/4.png', 'true', NULL, 'Enter your profession here.', '                      \n                    '),
(156, 'Saami', 'saamiibrahim@gmail.com', '1234567891', 'Saami1@', NULL, 'uploads/saamiibrahim-191-Screenshot (1).png', 'true', 'uploads/saamiibrahim-cover-27-Screenshot (4).png', 'Freelancer', '                      sadasd\n                    '),
(157, 'KeepOnline', 'keep@online.com', '12346654644554', 'aA1@', NULL, 'uploads/KeepOnline-download.png', 'true', NULL, NULL, NULL),
(158, 'Muslimhassan', 'muslim110@gmail.com', '03422167329', 'john123', NULL, 'uploads/Muslimhassan-d334b965-e735-4119-9b96-de6164240d78.jpg', 'true', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userswork`
--

CREATE TABLE `userswork` (
  `id` int(9) UNSIGNED NOT NULL,
  `useremail` varchar(225) NOT NULL,
  `org` varchar(225) NOT NULL,
  `designation` varchar(225) NOT NULL,
  `fromdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `todate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersinfo`
--
ALTER TABLE `usersinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userswork`
--
ALTER TABLE `userswork`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `mid` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `usersinfo`
--
ALTER TABLE `usersinfo`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `userswork`
--
ALTER TABLE `userswork`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
