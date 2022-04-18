-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2022 at 01:25 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caloriecounter`
--
CREATE DATABASE IF NOT EXISTS `caloriecounter` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `caloriecounter`;

-- --------------------------------------------------------

--
-- Table structure for table `calories`
--

DROP TABLE IF EXISTS `calories`;
CREATE TABLE `calories` (
  `cid` int(5) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `food` varchar(120) DEFAULT NULL,
  `calorie_intake` int(5) DEFAULT NULL,
  `exercise` varchar(120) DEFAULT NULL,
  `calories_burnt` int(5) DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `postid` int(5) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `created` datetime NOT NULL,
  `content` varchar(800) DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;



--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `Username` varchar(32) DEFAULT NULL,
  `Password` varchar(64) DEFAULT NULL,
  `FirstName` varchar(64) DEFAULT NULL,
  `LastName` varchar(64) DEFAULT NULL,
  `Email` varchar(128) DEFAULT NULL,
  `Age` smallint(3) DEFAULT NULL,
  `StartWeight` int(3) DEFAULT NULL,
  `CurrentWeight` int(3) DEFAULT NULL,
  `GoalWeight` int(3) DEFAULT NULL,
  `Height` int(3) DEFAULT NULL,
  `Unit1` int(3) DEFAULT NULL,
  `Unit2` int(3) DEFAULT NULL,
  `Mentor1` int(3) DEFAULT NULL,
  `Mentor2` int(3) DEFAULT NULL,
  `Mentor3` int(3) DEFAULT NULL,
  `CalorieIntake` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;




--
-- Indexes for table `calories`
--
ALTER TABLE `calories`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calories`
--
ALTER TABLE `calories`
  MODIFY `cid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Constraints for table `calories`
--
ALTER TABLE `calories`
  ADD CONSTRAINT `calories_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
