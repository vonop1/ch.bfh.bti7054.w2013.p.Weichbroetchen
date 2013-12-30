-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Dez 2013 um 10:00
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) COLLATE latin1_german1_ci NOT NULL,
  `Password` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `Firstname` varchar(200) COLLATE latin1_german1_ci NOT NULL,
  `Lastname` varchar(200) COLLATE latin1_german1_ci NOT NULL,
  `Street` varchar(200) COLLATE latin1_german1_ci NOT NULL,
  `StreetNo` varchar(5) COLLATE latin1_german1_ci NOT NULL,
  `ZIP` smallint(4) NOT NULL,
  `City` varchar(100) COLLATE latin1_german1_ci NOT NULL,
  `Phone` varchar(16) COLLATE latin1_german1_ci NOT NULL,
  `Email` varchar(200) COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
