-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: db5001590164.hosting-data.io
-- Generation Time: Feb 08, 2021 at 12:11 AM
-- Server version: 5.7.32-log
-- PHP Version: 7.0.33-0+deb9u10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbs1324287`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventID` mediumint(8) UNSIGNED NOT NULL,
  `eventName` varchar(30) NOT NULL,
  `eventDate` date NOT NULL,
  `eventLocation` varchar(60) NOT NULL,
  `eventCanceled` varchar(10) NOT NULL,
  `eventStatus` varchar(30) NOT NULL,
  `spotsRemaining` mediumint(9) NOT NULL,
  `rsvp` date NOT NULL,
  `createdDate` date NOT NULL,
  `dateCancelled` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventName`, `eventDate`, `eventLocation`, `eventCanceled`, `eventStatus`, `spotsRemaining`, `rsvp`, `createdDate`, `dateCancelled`) VALUES
(1, 'Ben\'s Graduation ', '2021-02-10', 'College of Staten Island', 'Yes', 'New', 100, '2021-02-01', '2021-01-28', '2021-02-06'),
(2, 'Smith Wedding', '2021-02-18', '123 Forest Avenue', 'Yes', 'New', 25, '2021-02-09', '2021-01-04', '2021-02-06'),
(3, 'Job Fair', '2021-02-24', '1520 Manor Road', 'No', 'New', 10, '2021-02-17', '2021-02-01', '0000-00-00'),
(4, 'Comic Convention', '2021-02-18', 'Jacob K. Javits Convention Center', 'No', 'New', 150, '2021-02-08', '2021-01-05', '0000-00-00'),
(5, 'Avery\'s First Birthday', '2021-02-18', 'Tim\'s house', 'No', 'New', 15, '2021-02-08', '2021-02-06', '0000-00-00'),
(6, 'Marvel Watch Party', '2021-02-13', 'Regal', 'No', 'New', 20, '2021-02-08', '2021-02-06', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `rsvp`
--

CREATE TABLE `rsvp` (
  `rsvpId` mediumint(8) UNSIGNED NOT NULL,
  `userId` mediumint(8) UNSIGNED NOT NULL,
  `eventID` mediumint(8) UNSIGNED NOT NULL,
  `rsvpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rsvp`
--

INSERT INTO `rsvp` (`rsvpId`, `userId`, `eventID`, `rsvpDate`) VALUES
(1, 2, 5, '2021-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` mediumint(8) UNSIGNED NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNum` bigint(11) UNSIGNED NOT NULL,
  `pass` varchar(50) NOT NULL,
  `admin` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `email`, `phoneNum`, `pass`, `admin`) VALUES
(1, 'Benjamin', 'Lattanzio', 'me@me.com', 0, '0151620b927a79f7658d3efc4572e3566a92546d', ''),
(2, 'Joe', 'Smoe', 'smoe1@gmail.com', 0, '8be3c943b1609fffbfc51aad666d0a04adf83c9d', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `rsvp`
--
ALTER TABLE `rsvp`
  ADD PRIMARY KEY (`rsvpId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventID` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rsvp`
--
ALTER TABLE `rsvp`
  MODIFY `rsvpId` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rsvp`
--
ALTER TABLE `rsvp`
  ADD CONSTRAINT `userLink` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
