-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Jan 2014 um 09:21
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
CREATE DATABASE IF NOT EXISTS `webshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
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
  `prize` float DEFAULT NULL,
  PRIMARY KEY (`ExtId`),
  KEY `extensionCat` (`extensionCat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `extension`
--

INSERT INTO `extension` (`ExtId`, `extensionCat`, `text_de`, `text_en`, `prize`) VALUES
(1, 1, 'Ketchup', 'ketchup', NULL),
(2, 1, 'Senf', 'senf', NULL),
(3, 1, 'Barbacue', 'barbacue', NULL),
(4, 1, 'Weichbrötchen Spezial', 'Weichbrötchen special', NULL),
(5, 2, 'Französische Salatsauce', 'French dressing', NULL),
(6, 2, 'Italienische Salatsauce', 'Italian dressing', NULL),
(7, 3, 'Speck', 'bacon', 1.5),
(8, 3, 'Extra Käse', 'extra Cheese', 1),
(9, 4, '3 dl', '3 dl', NULL),
(10, 4, '4 dl', '4 dl', 0.5),
(11, 4, '5 dl', '5 dl', 1);

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
  `prize` float DEFAULT NULL,
  PRIMARY KEY (`prodId`),
  KEY `SelectList` (`SelectList`,`CheckboxList`,`RadioList`),
  KEY `RadioList` (`RadioList`),
  KEY `CheckboxList` (`CheckboxList`),
  KEY `prodCategorie` (`prodCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`prodId`, `text_de`, `Image`, `SelectList`, `CheckboxList`, `RadioList`, `text_en`, `prodCategorie`, `prize`) VALUES
(1, 'Hamburger', 'images/hamburger.jpg', 1, 3, NULL, 'Hamburger', 1, 5),
(2, 'Cheeseburger', 'images/cheeseburger.jpg', 1, 3, NULL, 'chesseburger', 1, 6),
(3, 'Grüner Salat', 'images/salat.jpg', 2, NULL, NULL, 'green salad', 2, 4),
(4, 'Cola', 'images/cola.jpg', NULL, NULL, 4, 'Cola', 3, 3.5),
(5, 'Pommes Frites', 'images/pommes.jpg', 1, NULL, NULL, 'fries', 2, 4.5),
(6, 'Country Fries', 'images/country_fries.jpg', 1, NULL, NULL, 'country fries', 2, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `productcategorie`
--

CREATE TABLE IF NOT EXISTS `productcategorie` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `text_de` varchar(50) COLLATE utf8_bin NOT NULL,
  `text_en` varchar(50) COLLATE utf8_bin NOT NULL,
  `defaultProd` int(11) NOT NULL,
  PRIMARY KEY (`catId`),
  KEY `defaultProd` (`defaultProd`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `productcategorie`
--

INSERT INTO `productcategorie` (`catId`, `text_de`, `text_en`, `defaultProd`) VALUES
(1, 'Burger', 'Burger', 1),
(2, 'Beilagen', 'Sides', 5),
(3, 'Getränke', 'drinks', 4);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SelectList`) REFERENCES `extension` (`extensionCat`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`CheckboxList`) REFERENCES `extension` (`extensionCat`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`RadioList`) REFERENCES `extension` (`extensionCat`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`prodCategorie`) REFERENCES `productcategorie` (`catId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
