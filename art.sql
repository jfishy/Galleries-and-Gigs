-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2016 at 12:20 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `josh fish`
--

-- --------------------------------------------------------

--
-- Table structure for table `art`
--

CREATE TABLE IF NOT EXISTS `art` (
  `uname` varchar(20) NOT NULL,
  `artwork` varchar(100) NOT NULL,
  `pagepic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `art`
--

INSERT INTO `art` (`uname`, `artwork`, `pagepic`) VALUES
('lulu', 'Shona-Sculpture_reference.jpg', ''),
('lulu', 'download.jpg', ''),
('lulu', 'gold-kate-moss-sculpture-sold-for-900k__oPt.jpg', ''),
('luke', '19001294a602335879473fb125a57f16.jpg', ''),
('luke', 'darth-red-hong-yi-starwars-shadows-640x360.jpg', ''),
('luke', 'download1.jpg', ''),
('oscar', 'download3.jpg', ''),
('Sasha', 'tumblr_mdpex5t4Uc1rv7uqoo1_500.jpg', ''),
('Sasha', 'download2.jpg', 'show'),
('damn', '5613167d010bb86dad56130c7ce39634.jpg', 'show'),
('lulu', 'Bronze+Horse+Sculpture+by+John+Maisano.jpg', 'show'),
('luke', 'star-wars-sculptures-01.jpg', 'show'),
('oscar', 'landscape_paintings_1.jpg', 'show'),
('josh ', 'soc.jpg', ''),
('josh', 'tides.mp3', 'nah'),
('josh', '7_years_lukas_graham.mp3', 'show'),
('josh', 'one_dance.mp3', 'nah'),
('josh', 'Desert.jpg', 'nah');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
