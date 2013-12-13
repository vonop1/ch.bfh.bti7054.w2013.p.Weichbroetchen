-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Dez 2013 um 10:00
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
CREATE DATABASE IF NOT EXISTS `webshop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webshop`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `extension`
--

CREATE TABLE IF NOT EXISTS `extension` (
  `ExtId` int(11) NOT NULL AUTO_INCREMENT,
  `extensionCat` int(11) NOT NULL,
  `text_de` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `text_en` varchar(50) NOT NULL,
  PRIMARY KEY (`ExtId`),
  KEY `extensionCat` (`extensionCat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `extension`
--

INSERT INTO `extension` (`ExtId`, `extensionCat`, `text_de`, `text_en`) VALUES
(1, 1, 'Ketchup', 'ketchup'),
(2, 1, 'Senf', 'senf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `prodextension`
--

CREATE TABLE IF NOT EXISTS `prodextension` (
  `prodId` int(11) NOT NULL AUTO_INCREMENT,
  `radioExt` int(11) DEFAULT NULL,
  `CheckboxExt` int(11) DEFAULT NULL,
  `selectExt` int(11) DEFAULT NULL,
  PRIMARY KEY (`prodId`),
  KEY `radioExt` (`radioExt`),
  KEY `CheckboxExt` (`CheckboxExt`),
  KEY `selectExt` (`selectExt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `prodextension`
--

INSERT INTO `prodextension` (`prodId`, `radioExt`, `CheckboxExt`, `selectExt`) VALUES
(1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `prodId` int(11) NOT NULL AUTO_INCREMENT,
  `text_de` varchar(50) COLLATE utf8_bin NOT NULL,
  `Image` varchar(50) COLLATE utf8_bin NOT NULL,
  `SelectList` int(11) DEFAULT NULL,
  `CheckboxList` int(11) DEFAULT NULL,
  `RadioList` int(11) DEFAULT NULL,
  `text_en` varchar(50) COLLATE utf8_bin NOT NULL,
  `prodCategorie` int(11) NOT NULL,
  PRIMARY KEY (`prodId`),
  KEY `SelectList` (`SelectList`,`CheckboxList`,`RadioList`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`prodId`, `text_de`, `Image`, `SelectList`, `CheckboxList`, `RadioList`, `text_en`, `prodCategorie`) VALUES
(1, 'Hamburger', 'images/hamburger.jpg', NULL, NULL, NULL, 'Hamburger', 0),
(2, 'Cheeseburger', 'images/cheeseburger.jpg', NULL, NULL, NULL, 'chesseburger', 0);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `prodextension`
--
ALTER TABLE `prodextension`
  ADD CONSTRAINT `prodextension_ibfk_4` FOREIGN KEY (`selectExt`) REFERENCES `extension` (`extensionCat`),
  ADD CONSTRAINT `prodextension_ibfk_1` FOREIGN KEY (`prodId`) REFERENCES `product` (`prodId`),
  ADD CONSTRAINT `prodextension_ibfk_2` FOREIGN KEY (`radioExt`) REFERENCES `extension` (`extensionCat`),
  ADD CONSTRAINT `prodextension_ibfk_3` FOREIGN KEY (`CheckboxExt`) REFERENCES `extension` (`extensionCat`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
