-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2013 at 09:24 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crowdfix`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) COLLATE utf8_bin NOT NULL,
  `postid` bigint(20) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `userid`, `postid`, `content`, `date`) VALUES
(1, 'jonathan@jonathanzong.com', 1, 0x49206c696b65207468697320706f737421212121, '2013-05-18 17:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `google_users`
--

CREATE TABLE IF NOT EXISTS `google_users` (
  `google_id` decimal(21,0) NOT NULL,
  `google_name` varchar(60) NOT NULL,
  `google_email` varchar(60) NOT NULL,
  `google_link` varchar(60) NOT NULL,
  `google_picture_link` varchar(60) NOT NULL,
  PRIMARY KEY (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `google_users`
--

INSERT INTO `google_users` (`google_id`, `google_name`, `google_email`, `google_link`, `google_picture_link`) VALUES
(100075053105498825256, 'Jonathan Zong', 'jonathan.zong@gmail.com', 'https://plus.google.com/100075053105498825256', 'https://lh5.googleusercontent.com/-_6nfEyLXOfA/AAAAAAAAAAI/A');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `up` int(11) NOT NULL,
  `down` int(11) NOT NULL,
  `category` enum('Civic','Cycling','Economy','Environment','Gardens','Pets','Technology') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `userid`, `content`, `date`, `up`, `down`, `category`) VALUES
(1, 'jonathan@jonathanzong.com', 0x43757063616b6520697073756d206b6579206c696d65207069652063686f636f6c617465206d6f757373652063616b6520636f666665652073616e64776963686573, '2013-05-18 17:09:02', 5, 2, 'Technology'),
(2, 'lolol@lol.olollol', 0x6469766973696f6e206279207a65726f21, '2013-05-18 17:19:31', 2, 0, 'Civic');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
