-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2014 at 11:10 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pecswap`
--
CREATE DATABASE IF NOT EXISTS `pecswap` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pecswap`;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `ad_no` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `category` varchar(80) DEFAULT NULL,
  `picture` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ad_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_no`, `date`, `title`, `details`, `price`, `contact`, `posted_by`, `category`, `picture`) VALUES
(6, '2014-08-04 09:50:54', 'Lumia 1020', '6 months old mobile phone in a very good condition. 6 months warranty and all the accessories. 2 free case covers. ', 15000, '9592106970', 12103025, 'mobile_phones', '6.jpg'),
(7, '2014-08-04 09:59:27', 'Electric Kettle', 'good condition. best at this price', 500, '9592106970', 12103025, 'electrical_appliances', '7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_no` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `sid` varchar(12) DEFAULT NULL,
  `posted_on` int(11) DEFAULT NULL,
  `profile_pic` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`comment_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_no`, `date`, `comment`, `name`, `sid`, `posted_on`, `profile_pic`) VALUES
(1, '2014-08-03 23:26:35', 'hey', 'Gaurav Arora', '12103025', 1, 'default.jpg'),
(2, '2014-08-03 23:27:51', 'hi', 'Gaurav Arora', '12103025', 2, 'default.jpg'),
(3, '2014-08-03 23:28:09', 'hi', 'Gaurav Arora', '12103025', 2, 'default.jpg'),
(4, '2014-08-04 03:44:31', 'hi', 'Cannon', '12106003', 2, 'default.jpg'),
(5, '2014-08-04 03:45:14', 'hi cannon', 'Gaurav Arora', '12103025', 3, 'default.jpg'),
(6, '2014-08-04 09:26:40', 'how is everything going?', 'Cannon Kalra', '12106003', 3, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_no` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `sid` varchar(12) DEFAULT NULL,
  `profile_pic` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`status_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_no`, `date`, `status`, `name`, `sid`, `profile_pic`) VALUES
(1, '2014-08-03 23:13:51', 'hello', 'Gaurav Arora', '12103025', 'default.jpg'),
(2, '2014-08-03 23:27:44', 'hey', 'Gaurav Arora', '12103025', 'default.jpg'),
(3, '2014-08-04 03:44:47', 'Hi gaurav', 'Cannon', '12106003', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `sid` varchar(60) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `contact` varchar(12) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `profile_pic` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `sid`, `email`, `contact`, `password`, `profile_pic`) VALUES
(1, 'Gaurav Arora', '12103025', 'gaurav.arora.2793@gmail.com', '9592106970', '49c2398aae2e85db56ab1407c3ab1f7679e796f3', 'default.jpg'),
(2, 'Cannon Kalra', '12106003', 'gaurav.pec23@gmail.com', '9914433993', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'default.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
