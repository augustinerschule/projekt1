-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Apr 2013 um 15:27
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `yolomcswaggster`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gebaeude`
--

CREATE TABLE IF NOT EXISTS `gebaeude` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stadtid` int(11) NOT NULL,
  `typ` int(11) NOT NULL,
  `stufe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `gebaeude`
--

INSERT INTO `gebaeude` (`id`, `stadtid`, `typ`, `stufe`) VALUES
(1, 1, 100, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `staedte`
--

CREATE TABLE IF NOT EXISTS `staedte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `holz` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `nahrung` int(11) NOT NULL,
  `stein` int(11) NOT NULL,
  `einwohner` int(11) NOT NULL,
  `lastupdate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `staedte`
--

INSERT INTO `staedte` (`id`, `userid`, `name`, `holz`, `gold`, `nahrung`, `stein`, `einwohner`, `lastupdate`) VALUES
(1, 1, 'asd', 9825, 100, 100, 100, 10, 1366205217),
(2, 1, 'asdf', 20, 20, 20, 20, 20, 1366205215);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `passwort` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `passwort`) VALUES
(1, 'asd', 'asd'),
(2, 'asdasd', 'asd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
