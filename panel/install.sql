CREATE TABLE `users` (
  `team` int(100) NOT NULL,
  `advanced` varchar(5) NOT NULL,
  `password` varchar(50) NOT NULL,
  `salt` varchar(3) NOT NULL,
  `member1` text NOT NULL,
  `member2` text NOT NULL,
  `member3` text NOT NULL,
  `school` varchar(100) NOT NULL,
  PRIMARY KEY (`team`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;