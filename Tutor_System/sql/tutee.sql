-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 14, 2019 at 06:42 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--
CREATE DATABASE IF NOT EXISTS `tutee` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tutee`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`

DROP TABLE IF EXISTS `tutee`;
CREATE TABLE IF NOT EXISTS `tutee`(
   `tutee_id` varchar(24) NOT NULL,
   `contact_number` varchar(8) NOT NULL,
  `name` varchar(12) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password_hash` varchar(50) NOT NULL,
  PRIMARY KEY (`tutee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--


INSERT INTO `tutee` (`tutee_id`, `contact_number`, `name`, `gender`, `age`, `address`, `password_hash`) VALUES
('George@gmail.com', '89273749', 'amy','F', 17, 'Blk 109 Stamford Drive', 'asdfgh'),
('Francis@gmail.com', '92018818', 'jamy','F', 19, 'Blk 150 Real Stamford Drive', 'asdfgh'),
('Jose@gmail.com', '92028828', 'James','M', 17, '111 Tamford Drive', 'asdfgh'),
('Pam@gmail.com', '82726373', 'pam','F', 20, 'Blk 220 Bukit Drive', 'asdfgh'),
('Saran@gmail.com', '92001929', 'saran','M', 15, 'Goldhill Avenue', 'asdfgh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
