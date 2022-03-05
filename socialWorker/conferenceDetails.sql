-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 14, 2020 at 06:20 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rar1`
--

-- --------------------------------------------------------

--
-- Table structure for table `conferenceDetails`
--

CREATE TABLE `conferenceDetails` (
  `cdid` int(11) NOT NULL,
  `ChildId` int(11) NOT NULL,
  `conNotes` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `submit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conferenceDetails`
--

INSERT INTO `conferenceDetails` (`cdid`, `ChildId`, `conNotes`, `date`, `submit`) VALUES
(1, 1, '   hey there                               ', '2020-03-12', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conferenceDetails`
--
ALTER TABLE `conferenceDetails`
  ADD PRIMARY KEY (`cdid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conferenceDetails`
--
ALTER TABLE `conferenceDetails`
  MODIFY `cdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
