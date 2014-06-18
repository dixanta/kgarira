-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2014 at 10:16 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kgarira`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artists`
--

CREATE TABLE IF NOT EXISTS `tbl_artists` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_name` varchar(50) NOT NULL,
  `artist_description` text NOT NULL,
  `artist_image` varchar(255) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `genre_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE IF NOT EXISTS `tbl_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) NOT NULL,
  `country_code` int(11) NOT NULL,
  `flag_image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE IF NOT EXISTS `tbl_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `promoter_id` int(11) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `event_start_date` datetime NOT NULL,
  `allow_ticket_sell` tinyint(4) NOT NULL,
  `event_description` text NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `event_end_date` datetime NOT NULL,
  `no_of_tickets` int(11) NOT NULL,
  `paid_tickets` int(11) NOT NULL,
  `ticket_amount` decimal(10,2) NOT NULL,
  `member_id` int(11) NOT NULL,
  `fb_event_id` int(11) NOT NULL,
  `is_fb_event` tinyint(1) NOT NULL,
  `is_guest_event` tinyint(1) NOT NULL,
  `slug_id` int(11) NOT NULL,
  `slug_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_artists`
--

CREATE TABLE IF NOT EXISTS `tbl_event_artists` (
  `event_artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`event_artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_types`
--

CREATE TABLE IF NOT EXISTS `tbl_event_types` (
  `event_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`event_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galleries`
--

CREATE TABLE IF NOT EXISTS `tbl_galleries` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `cover_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `gallery_title` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `slug_id` int(11) NOT NULL,
  `slug_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery_images`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery_images` (
  `gallery_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_image` varchar(255) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`gallery_image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genres`
--

CREATE TABLE IF NOT EXISTS `tbl_genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_google_ads`
--

CREATE TABLE IF NOT EXISTS `tbl_google_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `script` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest_lists`
--

CREATE TABLE IF NOT EXISTS `tbl_guest_lists` (
  `guest_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_first_name` varchar(255) NOT NULL,
  `guest_last_name` varchar(255) NOT NULL,
  `guest_email` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`guest_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletters`
--

CREATE TABLE IF NOT EXISTS `tbl_newsletters` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_name` varchar(255) NOT NULL,
  `newsletter_content` text NOT NULL,
  `posted_date` datetime NOT NULL,
  `sent_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscribers`
--

CREATE TABLE IF NOT EXISTS `tbl_subscribers` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriber_name` varchar(50) NOT NULL,
  `subscriber_email` varchar(255) NOT NULL,
  `is_unsubscribed` tinyint(4) NOT NULL,
  `added_date` datetime NOT NULL,
  `unsubscribed_date` datetime NOT NULL,
  PRIMARY KEY (`subscriber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE IF NOT EXISTS `tbl_tickets` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_image` varchar(255) NOT NULL,
  `ticket_number` int(10) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venues`
--

CREATE TABLE IF NOT EXISTS `tbl_venues` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(255) NOT NULL,
  `venue_type_id` int(11) NOT NULL,
  `venue_location` varchar(255) NOT NULL,
  `venue_city` varchar(255) NOT NULL,
  `venue_description` text NOT NULL,
  `venue_longitude` int(11) NOT NULL,
  `venue_latitude` int(11) NOT NULL,
  `cusine` varchar(255) NOT NULL,
  `venue_drink` varchar(255) NOT NULL,
  `venue_food` varchar(255) NOT NULL,
  `food_price_range` varchar(255) NOT NULL,
  `drink_price_range` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue_types`
--

CREATE TABLE IF NOT EXISTS `tbl_venue_types` (
  `venue_type_id` int(11) NOT NULL,
  `venue_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
