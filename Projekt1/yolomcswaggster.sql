-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Apr 2013 um 13:54
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
-- Tabellenstruktur für Tabelle `bauauftraege`
--

CREATE TABLE IF NOT EXISTS `bauauftraege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stadtid` int(11) NOT NULL,
  `fertigum` int(11) NOT NULL,
  `typ` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forschauftraege`
--

CREATE TABLE IF NOT EXISTS `forschauftraege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stadtid` int(11) NOT NULL,
  `fertigum` int(11) NOT NULL,
  `typ` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forschung`
--

CREATE TABLE IF NOT EXISTS `forschung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `typ` int(11) NOT NULL,
  `stufe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Daten für Tabelle `gebaeude`
--

INSERT INTO `gebaeude` (`id`, `stadtid`, `typ`, `stufe`) VALUES
(16, 1, 104, 3),
(17, 1, 103, 1),
(18, 1, 102, 2),
(19, 2, 104, 1),
(20, 1, 101, 2),
(21, 1, 0, 3),
(22, 2, 0, 2),
(23, 1, 100, 3);

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
(1, 1, 'asd', 200000, 200000, 185385, 200000, 200000, 1366977249),
(2, 1, 'asdf', 0, 0, 0, 0, 150000, 1366977038);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `passwort` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `passwort`) VALUES
(1, 'asd', 'asd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
