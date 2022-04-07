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
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postid`,`uid`, `title`, `created`, `content`, `image`) VALUES
(1, 1, 'How to reach your goal','2022-03-30 14:07:17','Try breaking down your goal into specific steps like this and track your progress. Just remember to adjust your plan if your results start to stall or if you are struggling to be consistent.', NULL),
(2, 2, 'A word from one of the mentors','2022-03-31 10:09:07','If you are not losing weight as quickly as you had hoped dont get discouraged. Remember, your goal needs to be attainable, so be willing to adjust and set new goals if the old ones arent working for you. Even a little bit of progress can benefit your overall health and well-being. Focus on small changes that add up over time.', NULL),
(3, 2, 'Advice on how to gain weight','2022-04-01 15:01:42','Increase your calorie intake: An athlete who wants to gain muscle weight should increase calories strategically. Eat plenty of high-calorie foods, such as protein-rich meats, healthy fats  and whole grains. Battling cancer or frailty due to aging? Eat anything you like. Cake, cookies, milkshakes, theyre all fair game. The goal is only to consume more calories.', NULL),
(4, 2, 'Advice on how to lose weight','2022-04-02 11:27:11','A good rule of thumb for healthy weight loss is a deficit of about 500 calories per day. That should put you on course to lose about 1 pound per week. This is based on a starting point of at least 1,200 to 1,500 calories a day for women and 1,500 to 1,800 calories a day for men.', NULL);



--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `age` smallint(3) DEFAULT NULL,
  `weight` int(3) DEFAULT NULL,
  `feet` int(2) DEFAULT NULL,
  `inches` int(2) DEFAULT NULL,
  `calorie_goal` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `firstname`, `lastname`, `email`, `age`, `weight`, `feet`, `inches`, `calorie_goal`) VALUES
(1, 'admin', 'admin1', NULL, NULL, 'admin@example.com',NULL, NULL, NULL, NULL, NULL),
(2, 'mentor', 'mentor1',NULL, NULL, 'mentor@example.com',NULL, NULL, NULL, NULL, NULL),
(3, 'supplier', 'supplier1',NULL, NULL, 'supplier@example.com',NULL, NULL, NULL, NULL, NULL),
(4, 'usertest', 'password', 'Mark', 'Thomas', 'mark.thomas@example.com', 45, 90, 6, 1, 2500);

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
