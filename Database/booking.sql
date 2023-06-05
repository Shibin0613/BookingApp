-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 jun 2023 om 13:43
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

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;
