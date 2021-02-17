CREATE DATABASE `scheduler` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scheduler`;

-- --------------------------------------------------------

--
-- Table structure for table `carriers`
--

CREATE TABLE IF NOT EXISTS `carriers` (
  `code` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `suffix` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carriers`
--

INSERT INTO `carriers` (`code`, `description`, `suffix`) VALUES
('verizon', 'Verizon', 'vtext.com'),
('att', 'AT&T', 'mobile.att.net'),
('sprint', 'Sprint', 'messaging.sprintpcs.com');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `sub` varchar(100) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `next_run_on` date NOT NULL,
  `next_run_time` time NOT NULL,
  `timezone` varchar(20) DEFAULT NULL,
  `recur` varchar(10) NOT NULL,
  `sent` varchar(10) DEFAULT 'no',
  `next_run` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `last_sent_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;



-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE IF NOT EXISTS `timezone` (
  `timezone` varchar(6) NOT NULL,
  `code` varchar(4) NOT NULL,
  `description` varchar(30) NOT NULL,
  PRIMARY KEY (`timezone`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`timezone`, `code`, `description`) VALUES
('-5:00', 'EST', 'Eastern'),
('-6:00', 'CST', 'Central'),
('-7:00', 'MST', 'Mountain'),
('-8:00', 'PST', 'Pacific'),
('-9:00', 'AKST', 'Alaska'),
('-10:00', 'HST', 'Hawaii');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(10) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `carrier` varchar(30) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `tnow` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `count` int(11) NOT NULL DEFAULT '0',
  `lock` varchar(1) NOT NULL DEFAULT 'y',
  `type` varchar(1) NOT NULL DEFAULT 'u',
  `register_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timezone` varchar(13) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;


--