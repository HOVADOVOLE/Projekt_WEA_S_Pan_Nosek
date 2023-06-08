-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 08. čen 2023, 09:31
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `api_bank_database`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `aktualne`
--

CREATE TABLE `aktualne` (
  `id` smallint(6) NOT NULL,
  `nazev_uctu` varchar(16) NOT NULL,
  `celkova_hodnota` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `historie`
--

CREATE TABLE `historie` (
  `id_akce` smallint(6) NOT NULL,
  `id_uctu` smallint(6) DEFAULT NULL,
  `hodnota_upravy` mediumint(9) NOT NULL,
  `cas_pridani` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `aktualne`
--
ALTER TABLE `aktualne`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `historie`
--
ALTER TABLE `historie`
  ADD PRIMARY KEY (`id_akce`),
  ADD KEY `id_uctu` (`id_uctu`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `aktualne`
--
ALTER TABLE `aktualne`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `historie`
--
ALTER TABLE `historie`
  MODIFY `id_akce` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `historie`
--
ALTER TABLE `historie`
  ADD CONSTRAINT `historie_ibfk_1` FOREIGN KEY (`id_uctu`) REFERENCES `aktualne` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
