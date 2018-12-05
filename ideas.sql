-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2018 at 10:25 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ideas`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Cat_ID` int(11) NOT NULL,
  `Cat_Name` varchar(50) NOT NULL,
  `Cat_Note` text NOT NULL,
  `Cat_isActive` tinyint(4) NOT NULL,
  `Cat_CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Cat_ID`, `Cat_Name`, `Cat_Note`, `Cat_isActive`, `Cat_CreatedAt`) VALUES
(1, 'CSE', 'Something Here', 1, '2018-02-07 11:03:42'),
(2, 'CSIT', 'Test Comment', 1, '2018-02-07 11:11:18'),
(3, 'EEE', 'Comment Here', 1, '2018-02-08 07:06:38'),
(4, 'CIVIL', 'Something Here11111111', 1, '2018-02-08 07:07:04'),
(5, 'BBA', 'Comment Here', 1, '2018-02-08 11:43:25'),
(6, 'rshit solutions', 'Test Comment', 1, '2018-02-08 11:48:26'),
(7, 'New store', 'fdasfadsf', 1, '2018-02-08 12:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Idea_ID` int(11) NOT NULL,
  `Comment_Text` text NOT NULL,
  `Comment_Type` tinyint(1) NOT NULL,
  `Comment_isActive` tinyint(1) NOT NULL,
  `Comment_createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `User_ID`, `Idea_ID`, `Comment_Text`, `Comment_Type`, `Comment_isActive`, `Comment_createdAt`) VALUES
(1, 1, 6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, '2018-02-11 16:35:19'),
(2, 1, 6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, '2018-02-11 16:35:46'),
(3, 1, 6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, '2018-02-11 16:38:46'),
(4, 1, 6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, '2018-02-11 16:39:15'),
(7, 1, 4, 'Good\r\n', 0, 1, '2018-02-11 17:14:48'),
(8, 1, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, '2018-02-11 17:14:59'),
(9, 4, 4, '@Admin\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', 0, 1, '2018-02-11 17:15:11'),
(10, 1, 11, 'Hi\r\n', 0, 1, '2018-02-12 13:10:47'),
(11, 1, 11, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 1, '2018-02-12 13:13:05'),
(16, 1, 10, 'Ho', 0, 1, '2018-02-13 17:11:28'),
(17, 1, 10, 'Hi', 0, 1, '2018-02-13 17:11:33'),
(25, 4, 3, 'hello\r\n', 0, 1, '2018-02-15 15:59:42'),
(26, 5, 3, 'adfsda', 0, 1, '2018-02-17 13:41:13'),
(28, 3, 3, 'gadsg1111111111111111', 0, 1, '2018-02-17 15:32:23'),
(31, 1, 14, 'good\r\n', 0, 1, '2018-02-18 14:25:35'),
(32, 1, 8, 'good', 0, 1, '2018-02-18 14:51:14'),
(36, 5, 11, 'gasdgdasg', 0, 1, '2018-03-12 16:05:27'),
(37, 3, 4, 'Hello', 0, 1, '2018-03-13 14:20:52'),
(38, 4, 4, 'Hello', 0, 1, '2018-03-13 16:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `Idea_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Idea_Title` varchar(255) NOT NULL,
  `Idea_Description` text NOT NULL,
  `Idea_File` varchar(255) NOT NULL,
  `Idea_postType` tinyint(1) NOT NULL,
  `Idea_availableDate` varchar(255) NOT NULL,
  `Idea_Views` int(6) NOT NULL,
  `Idea_isActivate` tinyint(1) NOT NULL,
  `Idea_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`Idea_ID`, `User_ID`, `Cat_ID`, `Idea_Title`, `Idea_Description`, `Idea_File`, `Idea_postType`, `Idea_availableDate`, `Idea_Views`, `Idea_isActivate`, `Idea_createdAt`) VALUES
(3, 4, 7, 'Deom post ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/85tutorial.pdf', 0, '1519455486', 66, 1, '2018-02-08 12:33:20'),
(4, 1, 2, 'New Product', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/22merchant.JPG', 0, '1519455486', 26, 1, '2018-02-11 08:05:16'),
(6, 1, 5, 'New Product', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '1519455486', 17, 1, '2018-02-11 08:07:11'),
(7, 1, 6, 'New Product', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 0, '1519455486', 10, 1, '2018-02-11 08:07:43'),
(8, 1, 3, 'Idea Title', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 1, '1519455486', 6, 1, '2018-02-11 08:08:27'),
(9, 1, 2, 'Idea Title', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '', 1, '1519455486', 4, 1, '2018-02-11 08:10:13'),
(10, 1, 2, 'Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'uploads/29boy.png', 0, '1519455486', 32, 1, '2018-02-11 08:16:13'),
(11, 1, 5, 'hello post', 'Nice', '', 1, '1519455486', 18, 1, '2018-02-11 08:16:25'),
(13, 5, 2, 'Deom post00000000001111111111', 'asdfasdf', '', 1, '1520509010', 3, 1, '2018-02-17 06:56:14'),
(14, 5, 2, 'New Product', 'fdafdsaf1111111111111111112', '', 1, '1520509018', 18, 1, '2018-02-17 06:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `like_unlike`
--

CREATE TABLE `like_unlike` (
  `LU_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Comment_ID` int(11) NOT NULL,
  `Idea_ID` int(11) NOT NULL,
  `LU_Type` int(2) NOT NULL,
  `LU_CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_unlike`
--

INSERT INTO `like_unlike` (`LU_ID`, `User_ID`, `Comment_ID`, `Idea_ID`, `LU_Type`, `LU_CreatedAt`) VALUES
(1, 4, 1, 2, 1, '2018-03-11 10:56:24'),
(2, 4, 19, 3, 1, '2018-03-11 10:56:28'),
(3, 4, 1, 4, 1, '2018-03-11 10:56:31'),
(4, 4, 1, 4, 1, '2018-03-11 10:44:26'),
(5, 4, 1, 6, 1, '2018-03-11 10:56:35'),
(17, 0, 1, 50, 1, '2018-02-26 11:03:05'),
(27, 0, 47, 47, 1, '2018-03-11 10:56:59'),
(28, 0, 50, 48, 1, '2018-03-11 10:57:02'),
(30, 0, 48, 4, 0, '2018-03-11 10:56:47'),
(40, 0, 4, 51, 1, '2018-02-26 11:10:38'),
(44, 0, 5, 10, 0, '2018-02-26 11:13:18'),
(45, 0, 5, 11, 0, '2018-02-26 11:13:21'),
(47, 0, 5, 11, 1, '2018-02-26 11:13:24'),
(51, 0, 3, 11, 0, '2018-02-26 11:17:14'),
(54, 0, 3, 10, 1, '2018-02-26 11:19:24'),
(57, 1, 30, 2, 0, '2018-03-11 11:03:16'),
(58, 1, 29, 2, 0, '2018-03-11 11:05:25'),
(59, 1, 27, 2, 1, '2018-03-11 11:06:40'),
(63, 1, 21, 2, 0, '2018-03-11 11:08:50'),
(64, 1, 27, 2, 0, '2018-03-11 11:08:52'),
(65, 1, 35, 2, 0, '2018-03-11 11:09:19'),
(66, 1, 35, 2, 1, '2018-03-11 11:09:21'),
(67, 1, 34, 2, 0, '2018-03-12 08:30:44'),
(70, 1, 28, 3, 0, '2018-03-12 09:37:39'),
(71, 1, 28, 3, 1, '2018-03-12 09:37:41'),
(73, 5, 11, 11, 1, '2018-03-12 10:05:14'),
(78, 5, 9, 4, 0, '2018-03-13 06:56:57'),
(79, 5, 9, 4, 1, '2018-03-13 06:56:59'),
(80, 3, 9, 4, 0, '2018-03-13 08:14:47'),
(81, 3, 7, 4, 0, '2018-03-13 08:14:50'),
(83, 4, 38, 4, 0, '2018-03-13 10:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `Rating_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Idea_ID` int(11) NOT NULL,
  `Rating_Action` varchar(30) NOT NULL,
  `Rating_CreatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`Rating_ID`, `User_ID`, `Idea_ID`, `Rating_Action`, `Rating_CreatedAt`) VALUES
(118, 1, 7, 'like', '2018-02-12 00:00:00'),
(122, 4, 10, 'like', '2018-02-03 00:00:00'),
(128, 1, 6, 'like', '0000-00-00 00:00:00'),
(129, 1, 10, 'like', '0000-00-00 00:00:00'),
(145, 4, 9, 'like', '0000-00-00 00:00:00'),
(148, 4, 6, 'like', '0000-00-00 00:00:00'),
(149, 5, 13, 'like', '0000-00-00 00:00:00'),
(151, 5, 8, 'like', '0000-00-00 00:00:00'),
(152, 5, 7, 'like', '0000-00-00 00:00:00'),
(154, 5, 9, 'like', '0000-00-00 00:00:00'),
(155, 5, 10, 'like', '0000-00-00 00:00:00'),
(157, 3, 14, 'like', '0000-00-00 00:00:00'),
(263, 1, 11, 'dislike', '2018-02-18 14:08:08'),
(264, 1, 11, 'like', '2018-02-18 14:08:08'),
(265, 1, 11, 'dislike', '2018-02-18 14:08:09'),
(266, 1, 11, 'like', '2018-02-18 14:08:10'),
(335, 1, 10, 'dislike', '2018-02-18 14:27:35'),
(336, 1, 10, 'like', '2018-02-18 14:27:36'),
(366, 1, 14, 'dislike', '2018-02-18 14:45:33'),
(367, 1, 14, 'like', '2018-02-18 14:45:34'),
(368, 1, 14, 'dislike', '2018-02-18 14:45:34'),
(369, 1, 14, 'like', '2018-02-18 14:45:35'),
(371, 5, 3, 'like', '2018-02-18 14:55:43'),
(372, 5, 3, 'dislike', '2018-02-18 14:55:44'),
(373, 1, 13, 'like', '2018-02-18 14:57:05'),
(374, 1, 13, 'dislike', '2018-02-18 14:57:05'),
(375, 3, 13, 'dislike', '2018-02-18 14:57:58'),
(376, 3, 13, 'like', '2018-02-18 14:57:59'),
(377, 3, 13, 'dislike', '2018-02-18 14:58:00'),
(388, 4, 9, 'dislike', '2018-02-18 15:27:35'),
(389, 4, 3, 'dislike', '2018-02-18 15:30:04'),
(390, 4, 3, 'like', '2018-02-18 15:30:06'),
(392, 3, 7, 'dislike', '2018-02-18 15:36:42'),
(407, 5, 11, 'dislike', '2018-03-12 16:04:40'),
(408, 5, 11, 'like', '2018-03-12 16:04:41'),
(409, 5, 11, 'dislike', '2018-03-12 16:04:41'),
(410, 5, 11, 'like', '2018-03-12 16:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `User_Username` varchar(20) NOT NULL,
  `User_Email` varchar(50) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Role` tinyint(1) NOT NULL,
  `User_isActive` tinyint(1) NOT NULL,
  `User_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_Username`, `User_Email`, `User_Password`, `User_Role`, `User_isActive`, `User_createdAt`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$qn1VoXA.kmL0OUvb32j9d.SPmB5bWzmgiF5vk3g45VcMskLgBvgN2', 1, 1, '2018-03-12 08:53:39'),
(3, 'manager', 'manager@gmail.com', '$2y$10$qn1VoXA.kmL0OUvb32j9d.SPmB5bWzmgiF5vk3g45VcMskLgBvgN2', 2, 1, '2018-03-13 10:16:54'),
(4, 'student', 'studefnt1@gmail.com', '$2y$10$wqjPsfJYtBc0DuVYAGtci.jnB6oz0RWYh619sds/O42op.hv74.iq', 4, 1, '2018-03-13 10:05:28'),
(5, 'coordinator', 'coordinator@gmail.com', '$2y$10$Xhy0qaRvku.O4a6fXyoGEeVlrW2RhZgdKFKBSkjHGa7SybORV50dS', 3, 1, '2018-02-18 09:35:44'),
(7, 'student1', 'admin@admin.com', '$2y$10$bGyb868X4mWFDLiDlZ4lJ..Hed0.7JSxfXqnAYUHeZwWI1fLURP8m', 4, 1, '2018-03-12 10:11:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Cat_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `user_id` (`User_ID`),
  ADD KEY `post_id` (`Idea_ID`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`Idea_ID`),
  ADD KEY `user_id` (`User_ID`),
  ADD KEY `cat_id` (`Cat_ID`);

--
-- Indexes for table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD PRIMARY KEY (`LU_ID`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD PRIMARY KEY (`Rating_ID`),
  ADD KEY `user_id` (`User_ID`),
  ADD KEY `post_id` (`Idea_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Cat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `Idea_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `like_unlike`
--
ALTER TABLE `like_unlike`
  MODIFY `LU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `rating_info`
--
ALTER TABLE `rating_info`
  MODIFY `Rating_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Idea_ID`) REFERENCES `ideas` (`Idea_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `ideas_ibfk_2` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`Cat_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD CONSTRAINT `rating_info_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `rating_info_ibfk_2` FOREIGN KEY (`Idea_ID`) REFERENCES `ideas` (`Idea_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
