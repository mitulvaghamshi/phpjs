-- phpMyAdmin SQL Dump
-- version 5.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `000821600`
-- Table structure for table `userdata`

CREATE TABLE `userdata` (
  `userId` varchar(30) NOT NULL REFERENCES `user` (`username`),
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `data` varchar(1000) NOT NULL,
  `likes` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL
) ENGINE=InnoDB;

COMMIT;
