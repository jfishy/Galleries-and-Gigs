-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2016 at 11:17 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `uname` varchar(20) NOT NULL,
  `message` varchar(200) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`uname`, `message`, `status`) VALUES
('luke', 'josh: I love your star wars theme!', 'new'),
('oscar', 'josh: How much for your painting', 'new'),
('damn', 'luke: Do you use water colors for your paintings?', 'new'),
('lulu', 'luke: How much for the first sculpture?', 'new'),
('josh', 'oscar: Do you do covers of songs as well?', 'new'),
('damn', 'oscar: hey do you want to collaborate?', 'new'),
('Sasha', 'lulu: is that nyan cat', 'new'),
('luke', 'Sasha: my favorite movie is star wars!', 'new'),
('josh', 'Sasha: cool tunes', 'new'),
('damn', 'Sasha: damn daniel', 'new');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
