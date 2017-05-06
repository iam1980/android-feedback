-- phpMyAdmin SQL Dump
-- version 4.0.10.19
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2017 at 12:00 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `androidfeedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `a3m_account`
--

CREATE TABLE IF NOT EXISTS `a3m_account` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(24) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `verifiedon` datetime DEFAULT NULL,
  `lastsignedinon` datetime DEFAULT NULL,
  `resetsenton` datetime DEFAULT NULL,
  `deletedon` datetime DEFAULT NULL,
  `suspendedon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=837 ;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_account_details`
--

CREATE TABLE IF NOT EXISTS `a3m_account_details` (
  `account_id` bigint(20) unsigned NOT NULL,
  `fullname` varchar(160) DEFAULT NULL,
  `firstname` varchar(80) DEFAULT NULL,
  `lastname` varchar(80) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `postalcode` varchar(40) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `language` char(2) DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  `picture` varchar(240) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_account_facebook`
--

CREATE TABLE IF NOT EXISTS `a3m_account_facebook` (
  `account_id` bigint(20) NOT NULL,
  `facebook_id` bigint(20) NOT NULL,
  `linkedon` datetime NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `facebook_id` (`facebook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_account_openid`
--

CREATE TABLE IF NOT EXISTS `a3m_account_openid` (
  `openid` varchar(240) NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `linkedon` datetime NOT NULL,
  PRIMARY KEY (`openid`),
  KEY `account_id` (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_account_twitter`
--

CREATE TABLE IF NOT EXISTS `a3m_account_twitter` (
  `account_id` bigint(20) NOT NULL,
  `twitter_id` bigint(20) NOT NULL,
  `oauth_token` varchar(80) NOT NULL,
  `oauth_token_secret` varchar(80) NOT NULL,
  `linkedon` datetime NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `twitter_id` (`twitter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_acl_permission`
--

CREATE TABLE IF NOT EXISTS `a3m_acl_permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suspendedon` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_acl_role`
--

CREATE TABLE IF NOT EXISTS `a3m_acl_role` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `suspendedon` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_rel_account_permission`
--

CREATE TABLE IF NOT EXISTS `a3m_rel_account_permission` (
  `account_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`account_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_rel_account_role`
--

CREATE TABLE IF NOT EXISTS `a3m_rel_account_role` (
  `account_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`account_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a3m_rel_role_permission`
--

CREATE TABLE IF NOT EXISTS `a3m_rel_role_permission` (
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
  `UID` bigint(20) NOT NULL AUTO_INCREMENT,
  `key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `account` bigint(20) NOT NULL,
  `counter` bigint(20) NOT NULL,
  `pname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`UID`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=926 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_session`
--

CREATE TABLE IF NOT EXISTS `ci_session` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_items`
--

CREATE TABLE IF NOT EXISTS `feedback_items` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `question_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_ts` datetime NOT NULL,
  `received_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `model` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sdk` int(11) NOT NULL,
  `package_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `api_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email_status` enum('pending','sending','sent') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `msg_hash` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `UUID` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `libver` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `versionname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `versioncode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `custommessage` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59721 ;

-- --------------------------------------------------------

--
-- Table structure for table `ref_country`
--

CREATE TABLE IF NOT EXISTS `ref_country` (
  `alpha2` char(2) NOT NULL,
  `alpha3` char(3) NOT NULL,
  `numeric` varchar(3) NOT NULL,
  `country` varchar(80) NOT NULL,
  PRIMARY KEY (`alpha2`),
  UNIQUE KEY `alpha3` (`alpha3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_currency`
--

CREATE TABLE IF NOT EXISTS `ref_currency` (
  `alpha` char(3) NOT NULL,
  `numeric` varchar(3) DEFAULT NULL,
  `currency` varchar(80) NOT NULL,
  PRIMARY KEY (`alpha`),
  KEY `numeric` (`numeric`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ref_iptocountry`
--

CREATE TABLE IF NOT EXISTS `ref_iptocountry` (
  `ip_from` int(10) unsigned NOT NULL,
  `ip_to` int(10) unsigned NOT NULL,
  `country_code` char(2) NOT NULL,
  KEY `country_code` (`country_code`),
  KEY `ip_to` (`ip_to`),
  KEY `ip_from` (`ip_from`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_language`
--

CREATE TABLE IF NOT EXISTS `ref_language` (
  `one` char(2) NOT NULL,
  `two` char(3) NOT NULL,
  `language` varchar(120) NOT NULL,
  `native` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`one`),
  KEY `two` (`two`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ref_timezone`
--

CREATE TABLE IF NOT EXISTS `ref_timezone` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `abbr` varchar(8) NOT NULL,
  `name` varchar(80) NOT NULL,
  `utc` varchar(18) NOT NULL,
  `hours` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `abbr` (`abbr`),
  KEY `utc` (`utc`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Table structure for table `ref_zoneinfo`
--

CREATE TABLE IF NOT EXISTS `ref_zoneinfo` (
  `zoneinfo` varchar(40) NOT NULL,
  `offset` varchar(16) DEFAULT NULL,
  `summer` varchar(16) DEFAULT NULL,
  `country` char(2) NOT NULL,
  PRIMARY KEY (`zoneinfo`),
  KEY `country` (`country`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `response_items`
--

CREATE TABLE IF NOT EXISTS `response_items` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `fiUID` int(11) NOT NULL,
  `UUID` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `received_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `response_status` enum('pending','delivered','read') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `read_ts` datetime NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9312 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
