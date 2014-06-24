-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2014 at 04:26 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kgarira_latest`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery_image`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery_image` (
  `gallery_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_image` varchar(255) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY (`gallery_image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_gallery_image`
--

INSERT INTO `tbl_gallery_image` (`gallery_image_id`, `gallery_image`, `gallery_id`, `added_on`) VALUES
(1, '23689_101726549864686_100000820234824_44165_2922119_n.jpg', 1, '2014-06-24 15:27:01'),
(2, '24069_109677832402891_100000820234824_66880_4531912_n.jpg', 1, '2014-06-24 15:27:01'),
(4, '100817_103744.jpg', 1, '2014-06-24 15:27:02'),
(5, '12307936t.jpg', 1, '2014-06-24 15:27:02'),
(6, '14122010(014).jpg', 1, '2014-06-24 15:27:03'),
(7, '02032011076.jpg', 1, '2014-06-24 15:27:04'),
(8, '05062010038-001.jpg', 1, '2014-06-24 15:27:04'),
(9, 'abstract_uy6boeps.jpg', 2, '2014-06-24 15:27:49'),
(12, 'Always_Hope.jpg', 2, '2014-06-24 15:27:51'),
(17, 'Best_Friends.jpg', 2, '2014-06-24 15:27:53'),
(18, 'Best_Love_Story.jpg', 2, '2014-06-24 15:27:53'),
(19, 'Black_Wallpaper.jpg', 2, '2014-06-24 15:27:54'),
(20, 'bryan_adams.jpg', 2, '2014-06-24 15:27:54'),
(28, 'Without_You.jpg', 3, '2014-06-24 15:29:55'),
(29, 'work.jpg', 3, '2014-06-24 15:29:55'),
(30, 'You_couldnt.jpg', 3, '2014-06-24 15:29:55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
