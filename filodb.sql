-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2019 at 06:12 PM
-- Server version: 5.5.62
-- PHP Version: 7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_ibrahih6_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Requests`
--

CREATE TABLE `Requests` (
  `requestID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `userName` varchar(255) NOT NULL,
  `itemID` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `dateRequested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Requests`
--

INSERT INTO `Requests` (`userName`, `itemID`, `reason`, `dateRequested`, `status`) VALUES
('husi', '1', 'lost', '2020-04-13 19:12:45', 'Pending'),
('husi', '2', 'lost', '2020-04-18 13:06:21', 'Approved'),
('husi', '3', 'lost', '2020-04-22 12:11:18', 'Denied');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `category` varchar(255) NOT NULL,
  `foundTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foundUser` varchar(255) NOT NULL,
  `foundPlace` varchar(255) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `photo` varchar NOT NULL,
  `description` varchar(255) NOT NULL,
  `availability` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 	
-- Dumping data for table `items`
--

INSERT INTO `items` (`category`, `foundTime`, `foundUser`, `foundPlace`, `colour`, `photo`, `description`, `availability`) VALUES
('pet', '2020-04-23 12:11:18', 'husi', 'Aston University', 'brown', 'browndog.png', 'German Shepherd', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `userType` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstName`, `lastName`, `userName`, `Password`, `userType`) VALUES
('Hus', 'Ibrahim', 'husi', 'filo', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

--
-- Indexes for table `requests`
--

ALTER TABLE `requests`
  ADD KEY `fk_userName` (`userName`);




--
-- Constraints for table `requests``
--

ALTER TABLE `requests`
  ADD CONSTRAINT `fk_itemID` FOREIGN KEY (`itemID`) REFERENCES `items` (`itemID`),
  ADD CONSTRAINT `fk_userName` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
