-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 05:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_organizer`
--

-- --------------------------------------------------------

--
-- Table structure for table `information_tbl`
--

CREATE TABLE `information_tbl` (
  `ID_NUM` int(11) NOT NULL,
  `FIRSTNAME` varchar(250) NOT NULL,
  `LASTNAME` varchar(250) NOT NULL,
  `ADDRESS` varchar(250) NOT NULL,
  `SEX` varchar(250) NOT NULL,
  `MOB_NUM` varchar(250) NOT NULL,
  `EMAIL` varchar(250) NOT NULL,
  `IMAGE` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `information_tbl`
--
ALTER TABLE `information_tbl`
  ADD PRIMARY KEY (`ID_NUM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `information_tbl`
--
ALTER TABLE `information_tbl`
  MODIFY `ID_NUM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
