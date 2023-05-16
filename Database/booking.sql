-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 mei 2023 om 15:25
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 8.1.2

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
-- Tabelstructuur voor tabel `accommodation`
--

CREATE TABLE `accommodation` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `minimpeople` int(2) NOT NULL,
  `maximpeople` int(2) NOT NULL,
  `gas` int(1) NOT NULL,
  `electricity` int(1) NOT NULL,
  `water` int(1) NOT NULL,
  `priceadults` int(11) NOT NULL,
  `pricekids` int(11) NOT NULL,
  `pricebaby` int(11) NOT NULL,
  `description` text NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden ge毛xporteerd voor tabel `accommodation`
--

INSERT INTO `accommodation` (`id`, `category`, `name`, `minimpeople`, `maximpeople`, `gas`, `electricity`, `water`, `priceadults`, `pricekids`, `pricebaby`, `description`, `createdate`) VALUES
(1, 1, 'mega grote tent beta', 2, 4, 1, 1, 1, 25, 15, 5, 'dit is een mega grote tent!', '2023-05-15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden ge毛xporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'test@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `accommodationid` int(11) NOT NULL,
  `guestid` int(2) NOT NULL,
  `createdate` date NOT NULL,
  `checkindate` date NOT NULL,
  `checkoutdate` date NOT NULL,
  `people` int(2) NOT NULL,
  `price` int(11) NOT NULL,
  `paid` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden ge毛xporteerd voor tabel `booking`
--

INSERT INTO `booking` (`id`, `accommodationid`, `guestid`, `createdate`, `checkindate`, `checkoutdate`, `people`, `price`, `paid`) VALUES
(1, 1, 1, '2023-05-15', '2023-05-15', '2023-05-22', 2, 25, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `minimpeople` int(2) NOT NULL,
  `maximpeople` int(2) NOT NULL,
  `gas` int(1) NOT NULL,
  `electricity` int(1) NOT NULL,
  `water` int(1) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden ge毛xporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `category`, `minimpeople`, `maximpeople`, `gas`, `electricity`, `water`, `price`, `description`) VALUES
(1, 'tent', 2, 4, 1, 1, 1, 25, 'deze tent is mega cool!');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `guests`
--

CREATE TABLE `guests` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `housenumber` int(100) NOT NULL,
  `postalcode` varchar(100) NOT NULL,
  `woonplaats` varchar(100) NOT NULL,
  `createdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden ge毛xporteerd voor tabel `guests`
--

INSERT INTO `guests` (`id`, `name`, `email`, `housenumber`, `postalcode`, `woonplaats`, `createdate`) VALUES
(1, 'tim', 'tim@gmail.com', 9, '8711GG', 'Workum', '2023-05-15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `photo` varchar(11) NOT NULL,
  `accommodationid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden ge毛xporteerd voor tabel `photo`
--

INSERT INTO `photo` (`id`, `photo`, `accommodationid`) VALUES
(1, 'photo.jpg', 1);

--
-- Indexen voor ge毛xporteerde tabellen
--

--
-- Indexen voor tabel `accommodation`
--
ALTER TABLE `accommodation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`category`);

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accomodatie` (`accommodationid`),
  ADD KEY `guest` (`guestid`);

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accomodatieid` (`accommodationid`);

--
-- AUTO_INCREMENT voor ge毛xporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor ge毛xporteerde tabellen
--

--
-- Beperkingen voor tabel `accommodation`
--
ALTER TABLE `accommodation`
  ADD CONSTRAINT `categorie` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Beperkingen voor tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `accomodation` FOREIGN KEY (`accommodationid`) REFERENCES `accommodation` (`id`),
  ADD CONSTRAINT `guest` FOREIGN KEY (`guestid`) REFERENCES `guests` (`id`);

--
-- Beperkingen voor tabel `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `accomodatieid` FOREIGN KEY (`accommodationid`) REFERENCES `accommodation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
