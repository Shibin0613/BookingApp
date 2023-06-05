-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 jun 2023 om 13:41
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
  `minimumPeople` int(2) NOT NULL,
  `maximumPeople` int(2) NOT NULL,
  `gas` tinyint(1) NOT NULL,
  `electricity` tinyint(1) NOT NULL,
  `water` tinyint(1) NOT NULL,
  `priceAdults` decimal(11,2) NOT NULL,
  `priceKids` decimal(11,2) NOT NULL,
  `priceBaby` decimal(11,2) NOT NULL,
  `description` text NOT NULL,
  `createDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accommodation`
--

INSERT INTO `accommodation` (`id`, `category`, `name`, `minimumPeople`, `maximumPeople`, `gas`, `electricity`, `water`, `priceAdults`, `priceKids`, `priceBaby`, `description`, `createDate`) VALUES
(1, 1, 'mega grote tent beta', 2, 4, 1, 1, 1, '25.00', '15.00', '5.00', 'dit is een mega grote tent!', '2023-05-15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`) VALUES
(1, 'test@gmail.com', '123456', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `accommodationId` int(11) NOT NULL,
  `guestId` int(2) NOT NULL,
  `createDate` date NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `people` int(2) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `booking`
--

INSERT INTO `booking` (`id`, `accommodationId`, `guestId`, `createDate`, `checkInDate`, `checkOutDate`, `people`, `price`, `paid`) VALUES
(1, 1, 1, '2023-05-15', '2023-05-15', '2023-05-22', 2, '25.00', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `minimumPeople` int(2) NOT NULL,
  `maximumPeople` int(2) NOT NULL,
  `gas` tinyint(1) NOT NULL,
  `electricity` tinyint(1) NOT NULL,
  `water` tinyint(1) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `category`, `minimumPeople`, `maximumPeople`, `gas`, `electricity`, `water`, `price`, `description`) VALUES
(1, 'Camperplek', 2, 4, 1, 1, 1, '25.00', 'deze tent is mega cool!'),
(2, 'pipowagen', 1, 2, 1, 1, 1, '40.00', 'en pipowagen hier kan je lekker slapen '),
(3, 'Kampeerplek', 1, 2, 1, 1, 1, '20.00', 'hoi'),
(4, 'Safaritent', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(5, 'Blokhut', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(6, 'Chalet', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(7, 'B&B kamer', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(8, 'Appartament', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(9, 'Studio', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(10, 'Groepaccommodatie', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(11, 'Bungalow', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(12, 'Hotelkamer', 1, 3, 1, 1, 1, '30.00', 'nvt'),
(13, 'Woonboot', 1, 3, 1, 1, 1, '30.00', 'nvt');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `guests`
--

CREATE TABLE `guests` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `houseNumber` int(100) NOT NULL,
  `postalCode` varchar(100) NOT NULL,
  `residence` varchar(100) NOT NULL,
  `createDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `guests`
--

INSERT INTO `guests` (`id`, `name`, `email`, `houseNumber`, `postalCode`, `residence`, `createDate`) VALUES
(1, 'tim', 'tim@gmail.com', 9, '8711GG', 'Workum', '2023-05-15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `photo` varchar(11) NOT NULL,
  `accommodationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `photo`
--

INSERT INTO `photo` (`id`, `photo`, `accommodationId`) VALUES
(1, 'photo.jpg', 1);

--
-- Indexen voor geëxporteerde tabellen
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
  ADD KEY `accomodatie` (`accommodationId`),
  ADD KEY `guest` (`guestId`);

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
  ADD KEY `accomodatieid` (`accommodationId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- Beperkingen voor geëxporteerde tabellen
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
  ADD CONSTRAINT `accomodation` FOREIGN KEY (`accommodationId`) REFERENCES `accommodation` (`id`),
  ADD CONSTRAINT `guest` FOREIGN KEY (`guestId`) REFERENCES `guests` (`id`);

--
-- Beperkingen voor tabel `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `accomodatieid` FOREIGN KEY (`accommodationId`) REFERENCES `accommodation` (`id`);
COMMIT;
