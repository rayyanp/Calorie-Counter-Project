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
  `meal` varchar(120) DEFAULT NULL,
  `calorie_intake` int(5) DEFAULT NULL,
  `exercise` varchar(120) DEFAULT NULL,
  `calories_burnt` int(5) DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Table structure for table `mentors`
--

DROP TABLE IF EXISTS `mentors`;
CREATE TABLE `mentors` (
  `mentorid` int(5) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `pending` varchar(120) DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Join table linking a user's user id with their mentor id
--

DROP TABLE IF EXISTS `mentorLink`;
CREATE TABLE `mentorLink` (
  `mentorid` int(5) NOT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;



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
  `gender` varchar(6) DEFAULT NULL,
  `start_weight` int(3) DEFAULT NULL,
  `current_weight` int(3) DEFAULT NULL,
  `goal_weight` int(3) DEFAULT NULL,
  `height` int(3) DEFAULT NULL,
  `unit1` varchar(32) DEFAULT NULL,
  `unit2` varchar(32) DEFAULT NULL,
  `mentor1` int(3) DEFAULT NULL,
  `mentor2` int(3) DEFAULT NULL,
  `mentor3` int(3) DEFAULT NULL,
  `calorie_intake` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;


--
-- Dumping data for table `users`
--
INSERT INTO `users` (`uid`, `username`, `password`, `firstname`, `lastname`, `email`, `age`, `gender`, `start_weight`, `current_weight`,`goal_weight`,`height`,`unit1`,`unit2`,`mentor1`,`mentor2`,`mentor3`,`calorie_intake`) VALUES
(1, 'usertest', 'pass', 'Robert', 'Smith', 'user@example.com','21','Male', '90','82','75','6','kg','ft',NULL,NULL,NULL,NULL);

--
-- Dumping data for table `calories`
--
INSERT INTO `calories` (`cid`,`uid`, `food`, `meal`, `calorie_intake`, `exercise`, `calories_burnt`, `datetime`) VALUES
(1, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-01 10:09:07'),
(2, 1, 'Burger', 'Lunch', '743', NULL, NULL,'2022-04-01 10:09:07'),
(3, 1, 'Crisps', 'Snack', '343', NULL, NULL,'2022-04-01 10:09:07'),
(4, 1, 'Cottage Pie', 'Dinner', '843', NULL, NULL,'2022-04-01 10:09:07'),
(5, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-02 10:09:07'),
(6, 1, 'Pizza', 'Lunch', '1333', NULL, NULL,'2022-04-02 11:09:07'),
(7, 1, 'Biscuits', 'Snack', '263', NULL, NULL,'2022-04-02 10:09:07'),
(8, 1, 'Chicken Pie', 'Dinner', '643', NULL, NULL,'2022-04-02 10:09:07'),
(9, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-03 10:09:07'),
(10, 1, 'Pizza', 'Lunch', '1110', NULL, NULL,'2022-04-03 11:09:07'),
(11, 1, 'Biscuits', 'Snack', '263', NULL, NULL,'2022-04-03 10:09:07'),
(12, 1, 'Chicken Pie', 'Dinner', '643', NULL, NULL,'2022-04-03 10:09:07'),
(13, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-04 10:09:07'),
(14, 1, 'Tuna Sandwich', 'Lunch', '632', NULL, NULL,'2022-04-04 11:09:07'),
(15, 1, 'Chocolate', 'Snack', '263', NULL, NULL,'2022-04-04 10:09:07'),
(16, 1, 'Chicken Pie', 'Dinner', '1110', NULL, NULL,'2022-04-04 10:09:07'),
(17, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-05 10:09:07'),
(18, 1, 'Chicken Sandwich', 'Lunch', '682', NULL, NULL,'2022-04-05 11:09:07'),
(19, 1, 'Chocolate', 'Snack', '313', NULL, NULL,'2022-04-05 10:09:07'),
(20, 1, 'Sheppards Pie', 'Dinner', '1010', NULL, NULL,'2022-04-05 10:09:07'),
(21, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-06 10:09:07'),
(22, 1, 'Egg Sandwich', 'Lunch', '482', NULL, NULL,'2022-04-06 11:09:07'),
(23, 1, 'Brownie', 'Snack', '303', NULL, NULL,'2022-04-06 10:09:07'),
(24, 1, 'Cheese Burger', 'Dinner', '1220', NULL, NULL,'2022-04-06 10:09:07'),
(25, 1, 'Cereal', 'Breakfast', '250', NULL, NULL,'2022-04-07 10:09:07'),
(26, 1, 'Chicken Wrap', 'Lunch', '552', NULL, NULL,'2022-04-07 11:09:07'),
(27, 1, 'Chocolate', 'Snack', '313', NULL, NULL,'2022-04-07 10:09:07'),
(28, 1, 'Lamb Roast', 'Dinner', '1110', NULL, NULL,'2022-04-07 10:09:07'),
(29, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-08 10:09:07'),
(30, 1, 'Tacos', 'Lunch', '482', NULL, NULL,'2022-04-08 11:09:07'),
(31, 1, 'Chocolate', 'Snack', '212', NULL, NULL,'2022-04-08 10:09:07'),
(32, 1, 'Beef Burrito', 'Dinner', '1330', NULL, NULL,'2022-04-08 10:09:07'),
(33, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-09 10:09:07'),
(34, 1, 'Chicken Salad', 'Lunch', '382', NULL, NULL,'2022-04-09 11:09:07'),
(35, 1, 'Flapjack', 'Snack', '303', NULL, NULL,'2022-04-09 10:09:07'),
(36, 1, 'Pepporoni Pizza', 'Dinner', '1315', NULL, NULL,'2022-04-09 10:09:07'),
(37, 1, 'Cereal', 'Breakfast', '248', NULL, NULL,'2022-04-10 10:09:07'),
(38, 1, 'Egg Mayo Sandwich', 'Lunch', '552', NULL, NULL,'2022-04-10 11:09:07'),
(39, 1, 'Chocolate', 'Snack', '313', NULL, NULL,'2022-04-10 10:09:07'),
(40, 1, 'KFC Chicken', 'Dinner', '1200', NULL, NULL,'2022-04-10 10:09:07'),
(41, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-11 10:09:07'),
(42, 1, 'Chicken Sandwich', 'Lunch', '682', NULL, NULL,'2022-04-11 11:09:07'),
(43, 1, 'Crisps', 'Snack', '313', NULL, NULL,'2022-04-11 10:09:07'),
(44, 1, 'Vegatable Pie', 'Dinner', '1010', NULL, NULL,'2022-04-11 10:09:07'),
(45, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-12 10:09:07'),
(46, 1, 'Cheese Sandwich', 'Lunch', '552', NULL, NULL,'2022-04-12 11:09:07'),
(47, 1, 'Cake', 'Snack', '313', NULL, NULL,'2022-04-12 10:09:07'),
(48, 1, 'Tuna Pasta Melt', 'Dinner', '1150', NULL, NULL,'2022-04-12 10:09:07'),
(49, 1, 'Fruit Bowl', 'Breakfast', '243', NULL, NULL,'2022-04-13 10:09:07'),
(50, 1, 'Tuna Sweetcorn Sandwhich', 'Lunch', '532', NULL, NULL,'2022-04-13 11:09:07'),
(51, 1, 'Chocolate Cake', 'Snack', '313', NULL, NULL,'2022-04-13 10:09:07'),
(52, 1, 'Sheppards Pie', 'Dinner', '1010', NULL, NULL,'2022-04-13 10:09:07'),
(53, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-14 10:09:07'),
(54, 1, 'Burger', 'Lunch', '622', NULL, NULL,'2022-04-14 11:09:07'),
(55, 1, 'Chocolate', 'Snack', '313', NULL, NULL,'2022-04-14 10:09:07'),
(56, 1, 'Burger and Chips', 'Dinner', '1330', NULL, NULL,'2022-04-14 10:09:07'),
(57, 1, 'Museli', 'Breakfast', '323', NULL, NULL,'2022-04-15 10:09:07'),
(58, 1, 'Chicken Sandwich', 'Lunch', '642', NULL, NULL,'2022-04-15 11:09:07'),
(59, 1, 'Fudge', 'Snack', '213', NULL, NULL,'2022-04-15 10:09:07'),
(60, 1, 'Stir Fry', 'Dinner', '910', NULL, NULL,'2022-04-15 10:09:07'),
(61, 1, 'Cereal', 'Breakfast', '243', NULL, NULL,'2022-04-16 10:09:07'),
(62, 1, 'Cheese Sandwich', 'Lunch', '682', NULL, NULL,'2022-04-16 11:09:07'),
(63, 1, 'Crisps', 'Snack', '333', NULL, NULL,'2022-04-16 10:09:07'),
(64, 1, 'Chicken Noodles', 'Dinner', '1005', NULL, NULL,'2022-04-16 10:09:07'),
(65, 1, 'Museli', 'Breakfast', '223', NULL, NULL,'2022-04-17 10:09:07'),
(66, 1, 'Pasta', 'Lunch', '661', NULL, NULL,'2022-04-17 11:09:07'),
(67, 1, 'Biscuits', 'Snack', '313', NULL, NULL,'2022-04-17 10:09:07'),
(68, 1, 'Chicken', 'Dinner', '996', NULL, NULL,'2022-04-17 10:09:07'),
(69, 1, 'Yogurt', 'Breakfast', '250', NULL, NULL,'2022-04-18 10:09:07'),
(70, 1, 'Chicken Salad', 'Lunch', '550', NULL, NULL,'2022-04-18 11:09:07'),
(71, 1, 'Ice Cream', 'Snack', '350', NULL, NULL,'2022-04-18 10:09:07'),
(72, 1, 'Chicken and Chips', 'Dinner', '1050', NULL, NULL,'2022-04-18 10:09:07'),
(73, 1, 'Buttered Toast', 'Breakfast', '200', NULL, NULL,'2022-04-19 10:09:07'),
(74, 1, 'Chicken and Rice', 'Lunch', '575', NULL, NULL,'2022-04-19 11:09:07'),
(75, 1, 'Pastry', 'Snack', '350', NULL, NULL,'2022-04-19 10:09:07'),
(76, 1, 'Tacos', 'Dinner', '1075', NULL, NULL,'2022-04-19 10:09:07'),
(77, 1, 'Cereal', 'Breakfast', '250', NULL, NULL,'2022-04-20 10:09:07'),
(78, 1, 'Tuna Sandwhich', 'Lunch', '550', NULL, NULL,'2022-04-20 11:09:07'),
(79, 1, 'Choclate', 'Snack', '300', NULL, NULL,'2022-04-20 10:09:07'),
(80, 1, 'Mac and Cheese', 'Dinner', '1100', NULL, NULL,'2022-04-20 10:09:07'),
(81, 1, 'Museli', 'Breakfast', '260', NULL, NULL,'2022-04-21 10:09:07'),
(82, 1, 'Cheesy Fries', 'Lunch', '540', NULL, NULL,'2022-04-21 11:09:07'),
(83, 1, 'Churros', 'Snack', '320', NULL, NULL,'2022-04-21 10:09:07'),
(84, 1, 'Tuna Melt', 'Dinner', '1080', NULL, NULL,'2022-04-21 10:09:07'),
(85, 1, 'Yogurt', 'Breakfast', '240', NULL, NULL,'2022-04-22 10:09:07'),
(86, 1, 'Garlic Bread', 'Lunch', '560', NULL, NULL,'2022-04-22 11:09:07'),
(87, 1, 'Peanuts', 'Snack', '325', NULL, NULL,'2022-04-22 10:09:07'),
(88, 1, 'Chicken and Chips', 'Dinner', '1075', NULL, NULL,'2022-04-22 10:09:07'),
(89, 1, 'Yogurt', 'Breakfast', '250', NULL, NULL,'2022-04-23 10:09:07'),
(90, 1, 'Chicken Sandwhich', 'Lunch', '550', NULL, NULL,'2022-04-23 11:09:07'),
(91, 1, 'Strawberries and Cream', 'Snack', '350', NULL, NULL,'2022-04-23 10:09:07'),
(92, 1, 'Cheeseburger', 'Dinner', '1050', NULL, NULL,'2022-04-23 10:09:07'),
(93, 1, 'Museli', 'Breakfast', '250', NULL, NULL,'2022-04-24 10:09:07'),
(94, 1, 'Burrito', 'Lunch', '590', NULL, NULL,'2022-04-24 11:09:07'),
(95, 1, 'Crisps', 'Snack', '350', NULL, NULL,'2022-04-24 10:09:07'),
(96, 1, 'Quesadilla', 'Dinner', '1112', NULL, NULL,'2022-04-24 10:09:07'),
(97, 1, 'Cereal', 'Breakfast', '250', NULL, NULL,'2022-04-25 10:09:07'),
(98, 1, 'Tacos', 'Lunch', '550', NULL, NULL,'2022-04-25 11:09:07'),
(99, 1, 'Brownie', 'Snack', '350', NULL, NULL,'2022-04-25 10:09:07'),
(100, 1, 'Kebab', 'Dinner', '1050', NULL, NULL,'2022-04-25 10:09:07'),
(101, 1, 'Cereal', 'Breakfast', '220', NULL, NULL,'2022-04-26 10:09:07'),
(102, 1, 'Chicken Salad', 'Lunch', '400', NULL, NULL,'2022-04-26 11:09:07'),
(104, 1, 'Chicken and Chips', 'Dinner', '1050', NULL, NULL,'2022-04-26 10:09:07'),
(105, 1, 'Cereal', 'Breakfast', '250', NULL, NULL,'2022-04-27 10:09:07'),
(106, 1, 'Egg Mayo Sandwhich', 'Lunch', '550', NULL, NULL,'2022-04-27 11:09:07'),
(107, 1, 'Fudge', 'Snack', '350', NULL, NULL,'2022-04-27 10:09:07'),
(108, 1, 'Pizza', 'Dinner', '1200', NULL, NULL,'2022-04-27 10:09:07'),
(109, 1, 'Full English Breakfast', 'Breakfast', '850', NULL, NULL,'2022-04-28 10:09:07'),
(110, 1, 'Pasta Pot', 'Lunch', '600', NULL, NULL,'2022-04-28 11:09:07'),
(111, 1, 'Lasagna', 'Dinner', '864', NULL, NULL,'2022-04-28 10:09:07'),
(112, 1, 'Yogurt', 'Breakfast', '270', NULL, NULL,'2022-04-29 10:09:07'),
(113, 1, 'Ice Cream', 'Snack', '350', NULL, NULL,'2022-04-29 10:09:07'),
(114, 1, 'Pizza and Chips', 'Dinner', '1450', NULL, NULL,'2022-04-29 10:09:07'),
(115, 1, 'Cereal', 'Breakfast', '250', NULL, NULL,'2022-04-30 10:09:07'),
(116, 1, 'Chicken Sandwhich', 'Lunch', '550', NULL, NULL,'2022-04-30 11:09:07'),
(117, 1, 'Choclate', 'Snack', '350', NULL, NULL,'2022-04-30 10:09:07'),
(118, 1, 'Cheeseburger', 'Dinner', '1050', NULL, NULL,'2022-04-30 10:09:07'),
(119, 1, 'Cereal', 'Breakfast', '233', NULL, NULL,'2022-05-01 09:09:07'),
(120, 1, 'Pasta', 'Lunch', '539', NULL, NULL,'2022-05-01 12:29:03'),
(121, 1, 'Cheesecake', 'Snack', '376', NULL, NULL,'2022-05-01 15:19:27'),
(122, 1, 'Chicken Sizzler', 'Dinner', '815', NULL, NULL,'2022-05-01 19:45:00'),
(123, 1, 'Oatmeal', 'Breakfast', '223', NULL, NULL,'2022-05-02 09:05:57'),
(124, 1, 'Burrito', 'Lunch', '593', NULL, NULL,'2022-05-02 12:19:03'),
(125, 1, 'Crisps', 'Snack', '332', NULL, NULL,'2022-05-02 15:29:47'),
(126, 1, 'Chicken Roast', 'Dinner', '987', NULL, NULL,'2022-05-02 19:25:00');




--
-- Indexes for table `calories`
--
ALTER TABLE `calories`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`mentorid`),
  ADD KEY `uid` (`uid`);


--
-- Indexes for table `mentorLink`
--
ALTER TABLE `mentorLink`
  ADD PRIMARY KEY (`mentorid`),
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
-- AUTO_INCREMENT for table `mentors`
--
ALTER TABLE `mentors`
  MODIFY `mentorid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mentors`
--
ALTER TABLE `mentors`
  ADD CONSTRAINT `mentors_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
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
