-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2013 at 01:18 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `msg_board`
--
CREATE DATABASE IF NOT EXISTS `msg_board` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `msg_board`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_date` datetime NOT NULL,
  `msg_title` varchar(50) NOT NULL,
  `msg_text` tinytext NOT NULL,
  `author` varchar(30) NOT NULL,
  `msg_category` varchar(50) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `msg_date`, `msg_title`, `msg_text`, `author`, `msg_category`) VALUES
(40, '2013-10-08 21:37:21', 'nnnnnnnnnnnnnnn', 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 'admin', '2'),
(44, '2013-10-08 22:02:26', 'jj', 'kj'';lmlkn;klnkjn', 'admin', '3'),
(43, '2013-10-08 21:49:59', 'jjj', 'jjjjj', 'admin', '1'),
(34, '2013-10-08 16:30:53', 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea c', 'admin', '4'),
(32, '2013-10-07 23:47:33', 'gbafu;cuoujcbzjb', 'khbsih;ocy;ayiuosgj,v', 'admin', '4'),
(29, '2013-10-07 23:46:36', 'hafgjha''sihooi', 'hnksjbhdkgihg', 'admin', '1'),
(30, '2013-10-07 23:46:49', 'jmkkbh/l', 'ihaf;cy''''''''''''bgjsk', 'admin', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'qwerty', 1),
(2, 'test1', 'test1', 0),
(8, 'test65', 'test65', 0),
(5, 'test1234', 'test1234', 0),
(18, 'nnnnnnnn', 'mmmmmmmmmmmm9', 0),
(17, 'dsssssssss', 'sssssssssssss2', 0),
(16, 'dssssss', 'sssssssss8', 0),
(15, 'ddddddddd', 'dddddddddddd3', 0),
(14, 'hhhhhhhh9', 'jjjjjjjjjjj9', 0),
(19, 'nnnnnn', 'bbbbbbbbbbbb7', 0),
(20, 'mysql_real_escape_string( aaaa', 'mysql_real_escape_string( aaaa', 0),
(21, 'aaaaa', 'nnnnnnnnnnnn7', 0),
(22, 'aaaaajjj', 'qqqqqqqq3', 0),
(23, 'bbbbbbbb', 'nnnnnnnnnnnnn9', 0),
(24, 'gggggvv', 'qqqqqq2', 0),
(25, 'gggbbbbq', 'qqqq2', 0),
(26, 'gggfff', 'qqqqqww32', 0),
(27, 'ccccccccc', 'ssssssss3', 0),
(28, 'cceeee', 'eeeee999', 0),
(29, 'zzzzzzzz', 'zzzzzzzzzz0', 0),
(30, 'sdsdsd', 'wewwee4', 0),
(31, 'k0k0k0k', 's4s4s4s', 0),
(32, 'bkbvkjhlzidh', 'ijhoifhog8', 0),
(33, 'testfuk', 'testfuk8', 0),
(34, 'cvcvcvcv', 'cvcvcv5', 0),
(35, 'test78', 'test78', 0),
(36, 'tralala', 'tralala8', 0),
(37, 'fyjuyfu', 'kjbk888', 0),
(38, 'testrole', 'testrole7', 0),
(39, 'testag', 'testag1', 0),
(40, 'testregge', 'testregg1', 0),
(41, 'uhuhu', 'uhuhu1', 0),
(42, 'test34', 'test34', 0),
(43, 'a234451a', 'cccccccccccc4', 0),
(44, 'jikjkl', 'kjjjjkm,,,l9', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
