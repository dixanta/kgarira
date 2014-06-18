-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2014 at 10:21 AM
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
-- Table structure for table `be_acl_actions`
--

CREATE TABLE IF NOT EXISTS `be_acl_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(254) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_groups`
--

CREATE TABLE IF NOT EXISTS `be_acl_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL DEFAULT '0',
  `rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `be_acl_groups`
--

INSERT INTO `be_acl_groups` (`id`, `lft`, `rgt`, `name`, `link`) VALUES
(1, 1, 4, 'Member', NULL),
(2, 2, 3, 'Administrator', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_permissions`
--

CREATE TABLE IF NOT EXISTS `be_acl_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL DEFAULT '0',
  `aco_id` int(10) unsigned NOT NULL DEFAULT '0',
  `allow` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aro_id` (`aro_id`),
  KEY `aco_id` (`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `be_acl_permissions`
--

INSERT INTO `be_acl_permissions` (`id`, `aro_id`, `aco_id`, `allow`) VALUES
(1, 2, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_permission_actions`
--

CREATE TABLE IF NOT EXISTS `be_acl_permission_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `access_id` int(10) unsigned NOT NULL DEFAULT '0',
  `axo_id` int(10) unsigned NOT NULL DEFAULT '0',
  `allow` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_id` (`access_id`),
  KEY `axo_id` (`axo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_acl_resources`
--

CREATE TABLE IF NOT EXISTS `be_acl_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL DEFAULT '0',
  `rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `be_acl_resources`
--

INSERT INTO `be_acl_resources` (`id`, `lft`, `rgt`, `name`, `link`) VALUES
(1, 1, 22, 'Site', NULL),
(2, 2, 21, 'Control Panel', NULL),
(3, 3, 20, 'System', NULL),
(4, 14, 15, 'Members', NULL),
(5, 4, 13, 'Access Control', NULL),
(6, 16, 17, 'Settings', NULL),
(7, 18, 19, 'Utilities', NULL),
(8, 11, 12, 'Permissions', NULL),
(9, 9, 10, 'Groups', NULL),
(10, 7, 8, 'Resources', NULL),
(11, 5, 6, 'Actions', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_backups`
--

CREATE TABLE IF NOT EXISTS `be_backups` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  `backup_date` datetime NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_groups`
--

CREATE TABLE IF NOT EXISTS `be_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `be_groups`
--

INSERT INTO `be_groups` (`id`, `locked`, `disabled`) VALUES
(1, 1, 0),
(2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `be_preferences`
--

CREATE TABLE IF NOT EXISTS `be_preferences` (
  `name` varchar(254) NOT NULL,
  `value` text NOT NULL,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `be_preferences`
--

INSERT INTO `be_preferences` (`name`, `value`) VALUES
('default_user_group', '1'),
('smtp_host', ''),
('keep_error_logs_for', '30'),
('email_protocol', 'sendmail'),
('use_registration_captcha', '0'),
('page_debug', '0'),
('automated_from_name', 'Momo Engine'),
('allow_user_registration', '1'),
('use_login_captcha', '0'),
('site_name', 'Momo Engine Rapid Web Application Development Engine'),
('automated_from_email', 'noreply@momoengine.com'),
('account_activation_time', '7'),
('allow_user_profiles', '0'),
('activation_method', 'email'),
('autologin_period', '30'),
('min_password_length', '8'),
('smtp_user', ''),
('smtp_pass', ''),
('email_mailpath', '/usr/sbin/sendmail'),
('smtp_port', '25'),
('smtp_timeout', '5'),
('email_wordwrap', '1'),
('email_wrapchars', '76'),
('email_mailtype', 'html'),
('email_charset', 'utf-8'),
('bcc_batch_mode', '0'),
('bcc_batch_size', '200'),
('login_field', 'both'),
('meta_keywords', 'Momo Engine Fastest Web Application Development Engine'),
('meta_description', 'Momo Engine Fastest Web Application Development Engine'),
('offline_message', ''),
('theme', 'default'),
('site_status', '1'),
('date_format', 'Y-m-d'),
('date_time_format', 'Y-m-d H:i:s'),
('backup_path', 'backups'),
('google_analytics_tracking_code', ''),
('activate_google_analytics', '0');

-- --------------------------------------------------------

--
-- Table structure for table `be_resources`
--

CREATE TABLE IF NOT EXISTS `be_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `be_resources`
--

INSERT INTO `be_resources` (`id`, `locked`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `be_shortcuts`
--

CREATE TABLE IF NOT EXISTS `be_shortcuts` (
  `shortcut_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `new_window` tinyint(4) NOT NULL,
  `display_order` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`shortcut_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `be_users`
--

CREATE TABLE IF NOT EXISTS `be_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group` int(10) unsigned DEFAULT NULL,
  `activation_key` varchar(32) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `be_users`
--

INSERT INTO `be_users` (`id`, `username`, `password`, `email`, `active`, `group`, `activation_key`, `last_visit`, `created`, `modified`) VALUES
(1, 'admin', '0b7fd1f77b4f8ab74815b2fa9b87fd2ad43cfd3c', 'dixanta@gmail.com', 1, 2, NULL, '2014-06-18 09:12:52', '2014-06-18 12:40:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `be_user_profiles`
--

CREATE TABLE IF NOT EXISTS `be_user_profiles` (
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `be_user_profiles`
--

INSERT INTO `be_user_profiles` (`user_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `user_data` text NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE IF NOT EXISTS `layouts` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `slug_id` int(11) NOT NULL,
  `slug_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slugs`
--

CREATE TABLE IF NOT EXISTS `slugs` (
  `slug_id` int(11) NOT NULL AUTO_INCREMENT,
  `slug_name` varchar(250) NOT NULL,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY (`slug_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `gallery_title` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `slug_id` int(11) NOT NULL,
  `slug_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
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
-- Table structure for table `tbl_test`
--

CREATE TABLE IF NOT EXISTS `tbl_test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(255) NOT NULL,
  `test_description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`test_id`, `test_name`, `test_description`, `status`) VALUES
(1, 'Aakash', 'aakash shakya', 1);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `be_acl_permissions`
--
ALTER TABLE `be_acl_permissions`
  ADD CONSTRAINT `be_acl_permissions_ibfk_1` FOREIGN KEY (`aro_id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `be_acl_permissions_ibfk_2` FOREIGN KEY (`aco_id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_acl_permission_actions`
--
ALTER TABLE `be_acl_permission_actions`
  ADD CONSTRAINT `be_acl_permission_actions_ibfk_1` FOREIGN KEY (`access_id`) REFERENCES `be_acl_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `be_acl_permission_actions_ibfk_2` FOREIGN KEY (`axo_id`) REFERENCES `be_acl_actions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_groups`
--
ALTER TABLE `be_groups`
  ADD CONSTRAINT `be_groups_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_resources`
--
ALTER TABLE `be_resources`
  ADD CONSTRAINT `be_resources_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `be_users`
--
ALTER TABLE `be_users`
  ADD CONSTRAINT `be_users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `be_acl_groups` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `be_user_profiles`
--
ALTER TABLE `be_user_profiles`
  ADD CONSTRAINT `be_user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
