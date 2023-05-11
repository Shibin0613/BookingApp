-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 01:58 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodatie`
--

CREATE TABLE `accommodatie` (
  `id` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `minimumpersonen` int(2) NOT NULL,
  `maximumpersonen` int(2) NOT NULL,
  `gas` int(1) NOT NULL,
  `stroom` int(1) NOT NULL,
  `water` int(1) NOT NULL,
  `prijs` int(11) NOT NULL,
  `beschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `accommodatiecategorie`
--

CREATE TABLE `accommodatiecategorie` (
  `id` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `minimumpersonen` int(2) NOT NULL,
  `maximumpersonen` int(2) NOT NULL,
  `gas` int(1) NOT NULL,
  `stroom` int(1) NOT NULL,
  `water` int(1) NOT NULL,
  `prijs` int(11) NOT NULL,
  `beschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `foto` int(11) NOT NULL,
  `accomodatieid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reserveren`
--

CREATE TABLE `reserveren` (
  `id` int(11) NOT NULL,
  `accommodatie` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `huisnummer` int(3) NOT NULL,
  `postcode` varchar(7) NOT NULL,
  `datum` date NOT NULL,
  `dagen` int(2) NOT NULL,
  `personen` int(2) NOT NULL,
  `bedrag` int(11) NOT NULL,
  `betaald` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `wachtwoord` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodatie`
--
ALTER TABLE `accommodatie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie`);

--
-- Indexes for table `accommodatiecategorie`
--
ALTER TABLE `accommodatiecategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accomodatieid` (`accomodatieid`);

--
-- Indexes for table `reserveren`
--
ALTER TABLE `reserveren`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accomodatie` (`accommodatie`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodatie`
--
ALTER TABLE `accommodatie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accommodatiecategorie`
--
ALTER TABLE `accommodatiecategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserveren`
--
ALTER TABLE `reserveren`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accommodatie`
--
ALTER TABLE `accommodatie`
  ADD CONSTRAINT `categorie` FOREIGN KEY (`categorie`) REFERENCES `accommodatiecategorie` (`id`);

--
-- Constraints for table `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `accomodatieid` FOREIGN KEY (`accomodatieid`) REFERENCES `accommodatie` (`id`);

--
-- Constraints for table `reserveren`
--
ALTER TABLE `reserveren`
  ADD CONSTRAINT `accomodatie` FOREIGN KEY (`accommodatie`) REFERENCES `accommodatie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
