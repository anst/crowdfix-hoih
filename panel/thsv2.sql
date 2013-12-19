SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `id` varchar(8) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `appeals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` int(4) NOT NULL,
  `problem` text NOT NULL,
  `pending` enum('Yes','No') NOT NULL,
  `message` text NOT NULL,
  `reply` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE `pizza` (
  `team` int(5) NOT NULL,
  `pepperoni` int(1) NOT NULL,
  `sausage` int(1) NOT NULL,
  `cheese` int(1) NOT NULL,
  `total` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `scoreboard` (
  `team` int(3) NOT NULL,
  `score` int(3) NOT NULL,
  `division` enum('Advanced','Novice') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `system` (
  `contest` enum('On','Off') NOT NULL,
  `ended` enum('Yes','No') NOT NULL,
  `scoreboard` enum('On','Off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `team` int(100) NOT NULL,
  `division` enum('Advanced','Novice') NOT NULL,
  `password` varchar(66) NOT NULL,
  `salt` varchar(3) NOT NULL,
  `member1` text NOT NULL,
  `member2` text NOT NULL,
  `member3` text NOT NULL,
  `school` varchar(100) NOT NULL,
  PRIMARY KEY (`team`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `written` (
  `name` varchar(35) NOT NULL,
  `school` varchar(128) NOT NULL,
  `score` int(3) NOT NULL,
  `division` enum('Advanced','Novice') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;