/***********************************************************************
 * This sql file will creates two table required for the game
 * the database used: 'your-db-name'
 *
 * it will create a [players] table with columns:
 *  - player_email [primary] (string)
 *  - player_wins (int)
 *  - players_losses (int)
 *  - play_date (date)
 *
 * the second table [wumpuses] with:
 *  - block_num [primary] (int)
 *  - row_num (int)
 *  - column_num (int)
 *
 ***********************************************************************/

-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2020 at 12:18 AM
-- Server version: 5.1.73
-- PHP Version: 5.5.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-04:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

-- Database: `your-db-name`

-- Table structure for table `players`

CREATE TABLE IF NOT EXISTS `players` (
  `player_email` varchar(30) NOT NULL,
  `player_wins` int(10) NOT NULL DEFAULT '0',
  `player_losses` int(10) NOT NULL DEFAULT '0',
  `play_date` date DEFAULT NULL,
  PRIMARY KEY (`player_email`)
) ENGINE=InnoDB;

-- Dumping data for table `players`

INSERT INTO `players` (`player_email`, `player_wins`, `player_losses`, `play_date`) VALUES
('alex@woohoo.en', 2, 6, '2020-10-12'),
('anna@yahoo.in', 5, 6, '2020-05-15'),
('email@example.com', 5, 0, '2020-10-22'),
('joe@hotmail.uk', 6, 3, '2020-07-30'),
('john@email.in', 7, 3, '2020-08-19'),
('marry@example.in', 5, 1, '2020-10-01'),
('matt@example.uk', 3, 0, '2020-01-01'),
('max@apple.inc', 6, 6, '2020-09-15'),
('mitulvaghmashi@gmail.com', 6, 1, '2020-10-22');

-- Table structure for table `wumpuses`

CREATE TABLE IF NOT EXISTS `wumpuses` (
  `block_num` int(10) NOT NULL,
  `row_num` int(10) NOT NULL,
  `column_num` int(10) NOT NULL,
  PRIMARY KEY (`block_num`)
) ENGINE=InnoDB;

-- Dumping data for table `wumpuses`

INSERT INTO `wumpuses` (`block_num`, `row_num`, `column_num`) VALUES
(1, -1, -1),
(2, -1, -1),
(3, -1, -1),
(4, -1, -1),
(5, -1, -1),
(6, -1, -1),
(7, 4, 4),
(8, -1, -1),
(9, -1, -1),
(10, -1, -1),
(11, 2, 1),
(12, 0, 0),
(13, -1, -1),
(14, -1, -1),
(15, -1, -1),
(16, -1, -1),
(17, -1, -1),
(18, 1, 0),
(19, 4, 3),
(20, -1, -1),
(21, -1, -1),
(22, -1, -1),
(23, -1, -1),
(24, -1, -1),
(25, -1, -1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
