-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2017 at 04:59 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agencija_nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `naziv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `oglas_id` int(11) DEFAULT NULL,
  `tekst` varchar(200) DEFAULT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE `nekretnina` (
  `id` int(11) NOT NULL,
  `slika` blob,
  `grad` varchar(20) DEFAULT NULL,
  `ulica` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oglas`
--

CREATE TABLE `oglas` (
  `id` int(11) NOT NULL,
  `n_id` int(11) DEFAULT NULL,
  `opis` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('a1', 'B1'),
('User1', 'Pass1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`naziv`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_username` (`user_username`),
  ADD KEY `oglas_id` (`oglas_id`);

--
-- Indexes for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grad` (`grad`);

--
-- Indexes for table `oglas`
--
ALTER TABLE `oglas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `n_id` (`n_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oglas`
--
ALTER TABLE `oglas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`oglas_id`) REFERENCES `oglas` (`id`);

--
-- Constraints for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD CONSTRAINT `nekretnina_ibfk_1` FOREIGN KEY (`grad`) REFERENCES `grad` (`naziv`);

--
-- Constraints for table `oglas`
--
ALTER TABLE `oglas`
  ADD CONSTRAINT `oglas_ibfk_1` FOREIGN KEY (`n_id`) REFERENCES `nekretnina` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
