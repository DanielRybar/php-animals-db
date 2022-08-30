-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 30. srp 2022, 14:55
-- Verze serveru: 10.4.24-MariaDB
-- Verze PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `animals`
--
CREATE DATABASE IF NOT EXISTS `animals` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `animals`;

-- --------------------------------------------------------

--
-- Struktura tabulky `animals`
--

CREATE TABLE `animals` (
  `PetID` int(11) NOT NULL,
  `Name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `Telephone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `Species` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `Gender` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `Agreement` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vyprázdnit tabulku před vkládáním `animals`
--

TRUNCATE TABLE `animals`;
--
-- Vypisuji data pro tabulku `animals`
--

INSERT INTO `animals` (`PetID`, `Name`, `Telephone`, `Species`, `Gender`, `Agreement`) VALUES
(1, 'Bak', '+420123456789', 'Pes', 'samec', b'1');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`PetID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `animals`
--
ALTER TABLE `animals`
  MODIFY `PetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
