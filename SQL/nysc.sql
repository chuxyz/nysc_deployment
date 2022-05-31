-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2013 at 05:17 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nysc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `batch` char(2) NOT NULL,
  `checkNo` char(5) NOT NULL DEFAULT 'yes',
  `checkLetter` char(5) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `batch`, `checkNo`, `checkLetter`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3 ', 'A', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `callup`
--

CREATE TABLE IF NOT EXISTS `callup` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `surname` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `facultyName` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `gradYr` int(10) DEFAULT NULL,
  `callupId` varchar(255) NOT NULL DEFAULT '0',
  `postedTo` varchar(255) NOT NULL DEFAULT 'state',
  `batch` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='gradYr' AUTO_INCREMENT=48 ;

--
-- Dumping data for table `callup`
--

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `zoneName` varchar(255) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `region`
--

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `institution` char(255) NOT NULL,
  `schName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `institution`, `schName`) VALUES
(1, 'UNN', 'University of Nigeria, Nsukka'),
(2, 'ABSU', 'Abia State University, Uturu'),
(3, 'IMSU', 'Imo State University'),
(4, 'UNIBEN', 'University of Benin');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) NOT NULL,
  `zone` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state`, `zone`) VALUES
(1, 'Abia', 1),
(2, 'Adamawa', 3),
(3, 'Akwa Ibom', 1),
(4, 'Anambra', 1),
(5, 'Bauchi', 3),
(6, 'Bayelsa', 1),
(7, 'Benue', 3),
(8, 'Bornu', 3),
(9, 'Cross River', 1),
(10, 'Delta', 1),
(11, 'Ebonyi', 1),
(12, 'Edo', 2),
(13, 'Ekiti', 2),
(14, 'Enugu', 1),
(15, 'Gombe', 3),
(16, 'Imo', 1),
(17, 'Jigawa', 3),
(18, 'Kaduna', 3),
(19, 'Kano', 3),
(20, 'Katsina', 3),
(21, 'Kebbi', 3),
(22, 'Kogi', 3),
(23, 'Kwara', 2),
(24, 'Lagos', 2),
(25, 'Nasarawa', 3),
(26, 'Niger', 3),
(27, 'Ogun', 2),
(28, 'Ondo', 2),
(29, 'Osun', 2),
(30, 'Oyo', 2),
(31, 'Plateau', 3),
(32, 'Rivers', 1),
(33, 'Sokoto', 3),
(34, 'Taraba', 3),
(35, 'Yobe', 3),
(36, 'Zamfara', 3),
(37, 'Abuja', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
