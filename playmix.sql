-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2015 at 01:11 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `playmix`
--
CREATE DATABASE IF NOT EXISTS `playmix` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `playmix`;

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE IF NOT EXISTS `audio` (
  `audio_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned zerofill NOT NULL,
  `audio_title` varchar(30) NOT NULL,
  `audio_genre` varchar(20) NOT NULL,
  `audio_photo` varchar(256) DEFAULT 'default.png',
  `audio_file` varchar(256) NOT NULL,
  `audio_private` tinyint(1) NOT NULL,
  `audio_play_count` int(11) NOT NULL,
  `audio_date_added` date NOT NULL,
  `audio_status` enum('Okay','Removed') NOT NULL,
  PRIMARY KEY (`audio_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`audio_id`, `user_id`, `audio_title`, `audio_genre`, `audio_photo`, `audio_file`, `audio_private`, `audio_play_count`, `audio_date_added`, `audio_status`) VALUES
(0000000001, 00000000002, 'Desert Night', 'Electronica', 'default.png', 'Rufus - Desert Night.mp3', 0, 1, '2014-11-18', 'Okay'),
(0000000002, 00000000004, 'Macarena', 'Classical', 'default.png', '06_Sam_Smith_-_Stay_With_Me.mp3', 0, 0, '2014-11-19', 'Okay'),
(0000000003, 00000000012, 'Merry Chrishmasu', 'Metal', 'default.png', 'originalchristmassong.mp3', 0, 0, '2014-12-24', 'Okay'),
(0000000007, 00000000012, 'Paperman', 'Soundtrack', 'default.png', 'audio2.mp3', 0, 0, '2015-01-25', 'Okay'),
(0000000009, 00000000012, 'Sleep to Dream', 'Electronica', 'default.png', 'audio1.mp3', 0, 1, '2015-01-25', 'Okay'),
(0000000013, 00000000012, 'Find You (Kirfue Remix)', 'Rave', 'default.png', 'audio5.mp3', 0, 4, '2015-01-25', 'Okay'),
(0000000014, 00000000008, 'Words (Kirfue Remix)', 'Rock', 'default.png', 'audio3.mp3', 0, 1, '2015-01-25', 'Okay'),
(0000000022, 00000000001, 'All About That Bass', 'Pop', 'pp1.jpg', '01_Meghan_Trainor_-_All_About_That_Bass.mp3', 0, 1, '2015-01-20', 'Okay'),
(0000000024, 00000000005, 'Stay with me', 'Soul', 'pp.png', '06_Sam_Smith_-_Stay_With_Me.mp3', 0, 1, '2015-04-10', 'Okay'),
(0000000025, 00000000010, 'Almost Nine', 'Jazz', 'apic1.jpg', 'audio7.mp3', 0, 2, '2015-01-26', 'Okay'),
(0000000026, 00000000012, 'Surround You', 'Rock', 'default.png', 'audio8.mp3', 0, 0, '2015-01-30', 'Okay'),
(0000000027, 00000000013, 'Typical', 'Rock', 'default.png', 'audio9.mp3', 0, 1, '2015-01-30', 'Okay');

-- --------------------------------------------------------

--
-- Table structure for table `ban_list`
--

CREATE TABLE IF NOT EXISTS `ban_list` (
  `user_id` int(11) unsigned zerofill NOT NULL,
  `user_username` varchar(256) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delete_list`
--

CREATE TABLE IF NOT EXISTS `delete_list` (
  `audio_id` int(10) unsigned zerofill NOT NULL,
  `audio_title` varchar(256) NOT NULL,
  KEY `audio_id` (`audio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notif_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned zerofill NOT NULL,
  `notif_count` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notif_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `user_id`, `notif_count`) VALUES
(0000000001, 0000000012, 2),
(0000000002, 0000000013, 0),
(0000000003, 0000000001, 1),
(0000000004, 0000000002, 0),
(0000000005, 0000000004, 0),
(0000000006, 0000000005, 0),
(0000000007, 0000000008, 0),
(0000000008, 0000000009, 0),
(0000000009, 0000000010, 0),
(0000000010, 0000000011, 0),
(0000000011, 0000000014, 0),
(0000000012, 0000000015, 0),
(0000000013, 0000000016, 0),
(0000000014, 0000000017, 0),
(0000000015, 0000000018, 0),
(0000000016, 0000000019, 0);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `playlist_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `playlist_name` varchar(30) NOT NULL,
  `playlist_date_added` date NOT NULL,
  `user_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`playlist_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `playlist_name`, `playlist_date_added`, `user_id`) VALUES
(0000000020, 'whew', '2015-02-07', 0000000010),
(0000000021, 'sample', '2015-02-12', 0000000010),
(0000000023, 'asd', '2015-02-13', 0000000010),
(0000000025, 'plmss', '2015-02-13', 0000000010),
(0000000026, 'workwork', '2015-02-22', 0000000010),
(0000000027, 'sampole', '2015-02-22', 0000000010),
(0000000028, 'qweqwe', '2015-02-22', 0000000010);

-- --------------------------------------------------------

--
-- Table structure for table `sequence`
--

CREATE TABLE IF NOT EXISTS `sequence` (
  `seq_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `audio_id` int(10) unsigned zerofill NOT NULL,
  `playlist_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`seq_id`),
  KEY `audio_id` (`audio_id`),
  KEY `playlist_id` (`playlist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `sequence`
--

INSERT INTO `sequence` (`seq_id`, `audio_id`, `playlist_id`) VALUES
(0000000087, 0000000024, 0000000020),
(0000000088, 0000000007, 0000000021),
(0000000089, 0000000014, 0000000021),
(0000000090, 0000000026, 0000000021),
(0000000091, 0000000022, 0000000020),
(0000000092, 0000000003, 0000000025),
(0000000093, 0000000013, 0000000000),
(0000000096, 0000000001, 0000000021),
(0000000097, 0000000025, 0000000020),
(0000000098, 0000000013, 0000000000),
(0000000099, 0000000013, 0000000026),
(0000000100, 0000000027, 0000000023);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `user_email` varchar(30) NOT NULL,
  `user_username` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_type` enum('Admin','Artist') NOT NULL,
  `user_status` enum('Okay','Banned') NOT NULL,
  `user_fname` varchar(30) DEFAULT NULL,
  `user_lname` varchar(30) DEFAULT NULL,
  `user_city` varchar(30) DEFAULT NULL,
  `user_country` varchar(30) DEFAULT NULL,
  `user_bio` varchar(256) DEFAULT NULL,
  `user_fb` varchar(256) DEFAULT NULL,
  `user_google` varchar(256) DEFAULT NULL,
  `user_twitter` varchar(256) DEFAULT NULL,
  `user_photo` varchar(256) DEFAULT '/uploads/pp/default.png',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_username`, `user_password`, `user_type`, `user_status`, `user_fname`, `user_lname`, `user_city`, `user_country`, `user_bio`, `user_fb`, `user_google`, `user_twitter`, `user_photo`) VALUES
(0000000001, 'mictest12345678910@gmail.com', 'Mike Test', 'dea714acfa53e311894125934c572d50', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000002, 'user@email.com', 'wilf', 'e709a667c75fa28224d0082fc26b6e32', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000004, 'pat@tan.com', 'patricio', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000005, 'jis@sung.com', 'jassuuu', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000008, 'asdfx@email.com', 'smokesomeweej', '912ec803b2ce49e4a541068d495ab570', 'Artist', 'Okay', 'Wilf', 'Chavois', 'Bordeaux', 'France', 'Omelette du Fromage. C''est la vie si vous plait.', 'http://www.facebook.com/weeeeeejrs', 'https://plus.google.com/113015128447426332701/posts', NULL, 'assets/img/profile/2.jpg'),
(0000000009, 'asdf3@email.com', 'asdfasdfasdf', '040b7cf4a55014e185813e0644502ea9', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000010, 'xanpatan@gmail.com', 'xanpat', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Okay', '', '', '', '', 'qweqweqweqwe', 'asdfasdff', 'asdfasdff', 'asdfasdff', '/uploads/pp/pp4.jpg'),
(0000000011, 'wilfredojrchavez@gmail.com', 'wolf', 'bf4397d8b4dc061e1b6d191a352e9134', 'Artist', 'Okay', 'Welj', 'Cheyveis', 'St. Petersburg', 'Russia', 'MENYA ZOVUT WELJ. NA KOLENI SOOKA.', NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000012, 'asdf@email.com', 'eufrik', '912ec803b2ce49e4a541068d495ab570', 'Admin', 'Okay', 'Weej', 'Chaives', 'Ontario', 'Canada', 'I like my beats fast and my bass down low because I''m all about that bass--no treble.', 'http://www.facebook.com/weeeeejrs', NULL, NULL, '/uploads/pp/pp1.png'),
(0000000013, 'eufr1k@gmail.com', 'kirfue', '24a255c2031766095bf69988e1d60a2f', 'Admin', 'Okay', 'Weej', 'Chaives', 'Bordeaux', 'France', 'DROP THE DATABASE\r\nBMMEWWWWPTBPBPTPPTPBPEWWWWPEWWWW\r\nWOPWOPWOPWOPW', 'https://www.facebook.com/weeeeejrs', NULL, NULL, '/uploads/pp/pp3.jpg'),
(0000000014, 'radmon@gmail.com', 'random', 'f0cd01e473260c949b2a2f6d4b2e0ebe', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000015, 'poi@gmail.com', 'poiqw', '1a892458c00ebc3c06642d2b06bce654', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000016, 'shan@gmail.com', 'shan', '3e119ab537d3c4cc0c31b9277bfd785e', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000017, 'j@gmail.com', 'joseph', '040b7cf4a55014e185813e0644502ea9', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000018, 'sampole@gmail.com', 'sampole', '645dcf318e233471923b7c201eec7011', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png'),
(0000000019, 'xasas@gmail.com', 'asdffff', 'efe6398127928f1b2e9ef3207fb82663', 'Admin', 'Okay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/uploads/pp/default.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
