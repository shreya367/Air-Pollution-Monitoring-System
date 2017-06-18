-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2017 at 12:44 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clarity`
--

-- --------------------------------------------------------

--
-- Table structure for table `gases`
--

CREATE TABLE `gases` (
  `id` int(11) NOT NULL,
  `CO` int(11) NOT NULL,
  `NO` int(11) NOT NULL,
  `NO2` int(11) NOT NULL,
  `O3` int(11) NOT NULL,
  `FineParticles` int(11) NOT NULL,
  `CourseParticles` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gases`
--

INSERT INTO `gases` (`id`, `CO`, `NO`, `NO2`, `O3`, `FineParticles`, `CourseParticles`, `lat`, `lng`, `type`) VALUES
(1, 83, 95, 24, 37, 12, 51, 23.815920, 86.439468, 'NLHC'),
(2, 20, 46, 68, 2, 6, 23, 23.814095, 86.440071, 'OAT'),
(3, 97, 19, 1, 47, 34, 27, 23.811882, 86.440819, 'CSEDEPT'),
(4, 33, 86, 31, 95, 85, 38, 23.814287, 86.442741, 'Director'),
(5, 36, 66, 23, 14, 4, 77, 23.814919, 86.442497, 'Library');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gases`
--
ALTER TABLE `gases`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gases`
--
ALTER TABLE `gases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
