-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Jan 2014 um 12:38
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
(8, 3, 'Extra Käse', 'extra cheese', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`prodId`, `text_de`, `Image`, `SelectList`, `CheckboxList`, `RadioList`, `text_en`, `prodCategorie`, `prize`) VALUES
(1, 'Hamburger', 'images/hamburger.jpg', 1, 3, NULL, 'Hamburger', 1, 5),
(2, 'Cheeseburger', 'images/cheeseburger.jpg', 1, 3, NULL, 'Chesseburger', 1, 6),
(3, 'Grüner Salat', 'images/salat.jpg', 2, NULL, NULL, 'Green salad', 2, 4),
(4, 'Cola', 'images/cola.jpg', NULL, NULL, 4, 'Cola', 3, 3.5),
(5, 'Pommes Frites', 'images/pommes.jpg', 1, NULL, NULL, 'Fries', 2, 4.5),
(6, 'Country Fries', 'images/country_fries.jpg', 1, NULL, NULL, 'Country fries', 2, 5),
(7, 'Fanta', 'images/fanta.jpg', NULL, NULL, 4, 'Fanta', 3, 3.5),
(8, 'Ice Tea', 'images/icetea.jpg', NULL, NULL, 4, 'Ice tea', 3, 3.5),
(9, 'Chickenburger', 'images/chickenburger.jpg', 1, 3, NULL, 'Chickenburger', 1, 6.5);

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
(3, 'Getränke', 'Drinks', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Firstname`, `Lastname`, `Street`, `StreetNo`, `ZIP`, `City`, `Phone`, `Email`) VALUES
(1, 'bohnp1', '$2y$10$HGkJ1SxgeAb4V7hmEI34hOv0ZXTddcrPwCzUzRNTCA5AeVLov.Af6', 'Pascal', 'Bohni', 'Altenweg', '1', 3714, 'Frutigen', '+41 79 576 60 09', 'pascal.bohni@gmail.com'),
(3, 'Hansi', '$2y$10$oSx0ciQUCFvJbxxaJEts2uU.aTrWmU9CUw97tu4c9kkva.aR4f6Ye', 'Pascal', 'von Ow', 'anderestrasse', '57', 3982, 'Thun', '+41 79 576 60 09', 'pascal.bohni@gmail.com'),
(4, 'Hansi6', '$2y$10$ILx1oNWQp92RxLtV2ajTuuV0p1WQv6TXSkmy7jWZymga81YuxY/vq', 'Pascal', 'von Ow', 'Altenweg', '34', 3456, 'Thun', '+41 79 576 60 09', 'pascal.bohni@gmail.com');

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
