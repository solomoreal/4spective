-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2015 at 05:16 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `4spective`
--

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_measure`
--

CREATE TABLE IF NOT EXISTS `bsc_m_measure` (
`measure_id` int(11) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `long_name` varchar(125) NOT NULL,
  `description` text,
  `has_min` tinyint(1) NOT NULL DEFAULT '0',
  `has_max` tinyint(1) NOT NULL DEFAULT '0',
  `min_val` int(11) DEFAULT NULL,
  `max_val` int(11) DEFAULT NULL,
  `real_num` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bsc_m_measure`
--

INSERT INTO `bsc_m_measure` (`measure_id`, `short_name`, `long_name`, `description`, `has_min`, `has_max`, `min_val`, `max_val`, `real_num`) VALUES
(1, 'IDR', 'Indonesian Rupiah', '', 1, 0, 0, NULL, 1),
(2, 'USD', 'United State Dollar', '', 1, 0, 0, NULL, 1),
(3, '%', 'Percentage', '0-100 Percentage', 1, 1, 0, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_period`
--

CREATE TABLE IF NOT EXISTS `bsc_m_period` (
  `period_code` int(4) DEFAULT NULL,
  `begin` varchar(8) DEFAULT NULL,
  `end` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_perspective`
--

CREATE TABLE IF NOT EXISTS `bsc_m_perspective` (
  `perspective_code` varchar(3) NOT NULL DEFAULT '',
  `description` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsc_m_perspective`
--

INSERT INTO `bsc_m_perspective` (`perspective_code`, `description`) VALUES
('CUS', 'Customer'),
('FIN', 'Financial'),
('IBP', 'Internal Business Process'),
('LNG', 'Learning And Growth');

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_relation`
--

CREATE TABLE IF NOT EXISTS `bsc_m_relation` (
  `code` varchar(4) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bsc_m_relation`
--

INSERT INTO `bsc_m_relation` (`code`, `description`) VALUES
('001', 'Employee Working Plan to Employee\r\nEmployee to Employee Working Plan'),
('002', 'Employee Working Plan to Position\r\nPosition to Employee Working Plan'),
('003', 'Organization Working Plan to Organization\r\nOrganization to Organization Working Plan');

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_type`
--

CREATE TABLE IF NOT EXISTS `bsc_m_type` (
  `code` varchar(3) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bsc_m_type`
--

INSERT INTO `bsc_m_type` (`code`, `description`) VALUES
('EWP', 'Employee Working Plan'),
('KPI', 'Key Performance Index'),
('OI', 'Strategic Objective / Strategic Initiative'),
('OWP', 'Organization Working Plan');

-- --------------------------------------------------------

--
-- Table structure for table `bsc_obj`
--

CREATE TABLE IF NOT EXISTS `bsc_obj` (
  `obj_id` bigint(11) unsigned NOT NULL,
  `obj_type` varchar(3) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Working Plan / Rencana Kerja';

-- --------------------------------------------------------

--
-- Table structure for table `bsc_obj_attr`
--

CREATE TABLE IF NOT EXISTS `bsc_obj_attr` (
`attr_id` bigint(20) unsigned NOT NULL,
  `obj_id` bigint(20) unsigned NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `long_name` varchar(255) NOT NULL,
  `description` text,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bsc_obj_rel`
--

CREATE TABLE IF NOT EXISTS `bsc_obj_rel` (
`rel_id` bigint(11) unsigned NOT NULL,
  `direction` varchar(1) NOT NULL,
  `rel_type` varchar(4) NOT NULL,
  `obj_from` bigint(11) unsigned NOT NULL,
  `obj_to` bigint(11) unsigned NOT NULL,
  `value` int(11) DEFAULT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `om_m_relation`
--

CREATE TABLE IF NOT EXISTS `om_m_relation` (
  `code` varchar(4) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_m_relation`
--

INSERT INTO `om_m_relation` (`code`, `description`) VALUES
('002', 'A: Report to \r\nB: is Line Supervisor of'),
('003', 'A: Belongs to \r\nB: Incorporates'),
('007', 'A: Describes \r\nB: is Described by'),
('011', 'A: Org Unit, Post assigned to cost center'),
('012', 'A: post manages an org \r\nB: org managed by ');

-- --------------------------------------------------------

--
-- Table structure for table `om_m_type`
--

CREATE TABLE IF NOT EXISTS `om_m_type` (
  `code` varchar(1) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_m_type`
--

INSERT INTO `om_m_type` (`code`, `description`) VALUES
('A', 'Work Center'),
('C', 'Job'),
('K', 'Cost Center'),
('O', 'Organization Unit'),
('P', 'Person'),
('S', 'Position'),
('T', 'Task');

-- --------------------------------------------------------

--
-- Table structure for table `om_obj`
--

CREATE TABLE IF NOT EXISTS `om_obj` (
`obj_id` bigint(11) unsigned NOT NULL,
  `obj_type` varchar(1) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_obj`
--

INSERT INTO `om_obj` (`obj_id`, `obj_type`, `begin`, `end`) VALUES
(1, 'O', '2008-01-01', '9999-12-31'),
(2, 'S', '2008-01-01', '9999-12-31'),
(3, 'O', '2008-01-01', '9999-12-31'),
(4, 'O', '2008-01-01', '9999-12-31'),
(5, 'O', '2008-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `om_obj_attr`
--

CREATE TABLE IF NOT EXISTS `om_obj_attr` (
`attr_id` bigint(11) unsigned NOT NULL,
  `obj_id` bigint(11) unsigned NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `long_name` varchar(255) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_obj_attr`
--

INSERT INTO `om_obj_attr` (`attr_id`, `obj_id`, `short_name`, `long_name`, `begin`, `end`) VALUES
(1, 1, '0HLD', 'Holding Company', '2008-01-01', '9999-12-31'),
(2, 2, 'CEO', 'Chief Executive Officer', '2008-01-01', '9999-12-31'),
(3, 3, '1AAA', 'Sub-Holding 1', '2008-01-01', '9999-12-31'),
(4, 4, '1BBB', 'Sub-Holding 2', '2008-01-01', '9999-12-31'),
(5, 5, '2AAAHR', 'HR & GA Div', '2008-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `om_obj_rel`
--

CREATE TABLE IF NOT EXISTS `om_obj_rel` (
`rel_id` bigint(11) unsigned NOT NULL,
  `direction` varchar(1) NOT NULL,
  `rel_type` varchar(4) NOT NULL,
  `obj_from` bigint(11) unsigned NOT NULL,
  `obj_to` bigint(11) unsigned NOT NULL,
  `value` int(11) DEFAULT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_obj_rel`
--

INSERT INTO `om_obj_rel` (`rel_id`, `direction`, `rel_type`, `obj_from`, `obj_to`, `value`, `begin`, `end`) VALUES
(1, 'A', '003', 2, 1, 0, '2008-01-01', '9999-12-31'),
(2, 'B', '003', 1, 2, 0, '2008-01-01', '9999-12-31'),
(3, 'A', '002', 3, 1, NULL, '2008-01-01', '9999-12-31'),
(4, 'B', '002', 1, 3, NULL, '2008-01-01', '9999-12-31'),
(5, 'A', '002', 4, 1, NULL, '0000-00-00', '0000-00-00'),
(6, 'B', '002', 1, 4, NULL, '0000-00-00', '0000-00-00'),
(7, 'A', '002', 4, 1, NULL, '2008-01-01', '9999-12-31'),
(8, 'B', '002', 1, 4, NULL, '2008-01-01', '9999-12-31'),
(9, 'A', '002', 5, 3, NULL, '2008-01-01', '9999-12-31'),
(10, 'B', '002', 3, 5, NULL, '2008-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `pa_employee`
--

CREATE TABLE IF NOT EXISTS `pa_employee` (
`emp_id` bigint(20) unsigned NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `nickname` varchar(100) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bsc_m_measure`
--
ALTER TABLE `bsc_m_measure`
 ADD PRIMARY KEY (`measure_id`);

--
-- Indexes for table `bsc_m_perspective`
--
ALTER TABLE `bsc_m_perspective`
 ADD PRIMARY KEY (`perspective_code`), ADD KEY `perspective_code` (`perspective_code`);

--
-- Indexes for table `bsc_m_relation`
--
ALTER TABLE `bsc_m_relation`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `bsc_m_type`
--
ALTER TABLE `bsc_m_type`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `bsc_obj`
--
ALTER TABLE `bsc_obj`
 ADD PRIMARY KEY (`obj_id`);

--
-- Indexes for table `bsc_obj_attr`
--
ALTER TABLE `bsc_obj_attr`
 ADD PRIMARY KEY (`attr_id`);

--
-- Indexes for table `bsc_obj_rel`
--
ALTER TABLE `bsc_obj_rel`
 ADD PRIMARY KEY (`rel_id`);

--
-- Indexes for table `om_m_relation`
--
ALTER TABLE `om_m_relation`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `om_m_type`
--
ALTER TABLE `om_m_type`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `om_obj`
--
ALTER TABLE `om_obj`
 ADD PRIMARY KEY (`obj_id`);

--
-- Indexes for table `om_obj_attr`
--
ALTER TABLE `om_obj_attr`
 ADD PRIMARY KEY (`attr_id`);

--
-- Indexes for table `om_obj_rel`
--
ALTER TABLE `om_obj_rel`
 ADD PRIMARY KEY (`rel_id`);

--
-- Indexes for table `pa_employee`
--
ALTER TABLE `pa_employee`
 ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bsc_m_measure`
--
ALTER TABLE `bsc_m_measure`
MODIFY `measure_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bsc_obj_attr`
--
ALTER TABLE `bsc_obj_attr`
MODIFY `attr_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsc_obj_rel`
--
ALTER TABLE `bsc_obj_rel`
MODIFY `rel_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `om_obj`
--
ALTER TABLE `om_obj`
MODIFY `obj_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `om_obj_attr`
--
ALTER TABLE `om_obj_attr`
MODIFY `attr_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `om_obj_rel`
--
ALTER TABLE `om_obj_rel`
MODIFY `rel_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pa_employee`
--
ALTER TABLE `pa_employee`
MODIFY `emp_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;