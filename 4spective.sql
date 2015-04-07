-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2015 at 10:40 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
-- Table structure for table `bsc_kpi_formula`
--

CREATE TABLE IF NOT EXISTS `bsc_kpi_formula` (
`kpi_formula_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `formula_id` int(11) NOT NULL,
  `ytd_code` varchar(5) NOT NULL,
  `refrence_code` varchar(5) DEFAULT NULL,
  `measure_id` int(11) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL DEFAULT '9999-12-31'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bsc_kpi_target`
--

CREATE TABLE IF NOT EXISTS `bsc_kpi_target` (
`kpi_target_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `subperiod` varchar(10) NOT NULL,
  `target_val` float DEFAULT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL DEFAULT '9999-12-31'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bsc_kpi_weight`
--

CREATE TABLE IF NOT EXISTS `bsc_kpi_weight` (
`kpi_weight_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  `begin` date NOT NULL,
  `end` date NOT NULL DEFAULT '9999-12-31'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_formula`
--

CREATE TABLE IF NOT EXISTS `bsc_m_formula` (
`formula_id` int(11) NOT NULL,
  `formula_name` varchar(200) NOT NULL,
  `description` text,
  `type` int(11) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsc_m_formula`
--

INSERT INTO `bsc_m_formula` (`formula_id`, `formula_name`, `description`, `type`, `begin`, `end`) VALUES
(1, 'Default Max', '', 1, '2008-01-01', '9999-12-31'),
(2, 'Default Min', '', 2, '2008-01-01', '9999-12-31'),
(3, 'Default Stable', '', 3, '2008-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_formula_score`
--

CREATE TABLE IF NOT EXISTS `bsc_m_formula_score` (
`score_id` int(11) NOT NULL,
  `formula_id` int(11) NOT NULL,
  `pc_score` int(11) NOT NULL,
  `lower` float DEFAULT NULL,
  `upper` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsc_m_formula_score`
--

INSERT INTO `bsc_m_formula_score` (`score_id`, `formula_id`, `pc_score`, `lower`, `upper`) VALUES
(1, 1, 1, -9999.99, 70),
(2, 1, 2, 70.01, 95),
(3, 1, 3, 95.01, 115),
(4, 1, 4, 115.01, 130),
(5, 1, 5, 130.01, 9999.99),
(6, 2, 1, 9999.99, 130.01),
(7, 2, 2, 130, 115.01),
(8, 2, 3, 115, 95.01),
(9, 2, 4, 95, 70.01),
(10, 2, 5, 70, -9999.99),
(11, 3, 1, -9999.99, 200.01),
(12, 3, 1, 200.01, 9999.99),
(13, 3, 2, 100.01, 200),
(14, 3, 2, -200, -100.01),
(15, 3, 3, -100, 100);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bsc_m_measure`
--

INSERT INTO `bsc_m_measure` (`measure_id`, `short_name`, `long_name`, `description`, `has_min`, `has_max`, `min_val`, `max_val`, `real_num`) VALUES
(1, 'IDR', 'Indonesian Rupiah', '', 1, 0, 0, NULL, 1),
(2, 'USD', 'United State Dollar', '', 1, 0, 0, NULL, 1),
(3, '%', 'Percentage', 'Percentage of Progress', 1, 1, 0, 100, 1),
(4, '%', 'Percentage', '', 0, 0, NULL, NULL, 1),
(5, 'Qty', 'Quantity', '', 0, 0, NULL, NULL, 0),
(6, '1-5', 'Scale', '1 = Very Bad ; 5 = Very Good', 1, 1, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_period`
--

CREATE TABLE IF NOT EXISTS `bsc_m_period` (
  `period_code` varchar(10) NOT NULL DEFAULT '',
  `begin` date DEFAULT NULL,
  `end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsc_m_period`
--

INSERT INTO `bsc_m_period` (`period_code`, `begin`, `end`) VALUES
('2015', '2015-01-01', '2015-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_perspective`
--

CREATE TABLE IF NOT EXISTS `bsc_m_perspective` (
  `perspective_code` varchar(3) NOT NULL DEFAULT '',
  `icon` varchar(200) NOT NULL,
  `description` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsc_m_perspective`
--

INSERT INTO `bsc_m_perspective` (`perspective_code`, `icon`, `description`) VALUES
('CUS', 'fa-users', 'Customer'),
('FIN', 'fa-money', 'Financial'),
('IBP', 'fa-cogs', 'Internal Business Process'),
('LNG', 'fa-line-chart', 'Learning And Growth');

-- --------------------------------------------------------

--
-- Table structure for table `bsc_m_ref`
--

CREATE TABLE IF NOT EXISTS `bsc_m_ref` (
  `ref_code` varchar(10) NOT NULL,
  `ref_name` varchar(125) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsc_m_ref`
--

INSERT INTO `bsc_m_ref` (`ref_code`, `ref_name`, `description`) VALUES
('AVG', 'Average', NULL),
('MAX', 'Maximum', NULL),
('MIN', 'Minimum', NULL),
('MODE', 'Mode', NULL),
('PROP', 'Proprotional', NULL),
('SUM', 'Summary', NULL);

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
-- Table structure for table `bsc_m_score`
--

CREATE TABLE IF NOT EXISTS `bsc_m_score` (
  `pc_score` int(11) NOT NULL,
  `lower` float DEFAULT NULL,
  `upper` float DEFAULT NULL,
  `color` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bsc_m_score`
--

INSERT INTO `bsc_m_score` (`pc_score`, `lower`, `upper`, `color`) VALUES
(1, 0, 1.6, 'f56954'),
(2, 1.61, 2.5, 'f39c12'),
(3, 2.51, 3.5, '00a65a'),
(4, 3.51, 4.4, '00c0ef'),
(5, 4.41, 5, '3c8dbc');

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
-- Table structure for table `bsc_m_ytd`
--

CREATE TABLE IF NOT EXISTS `bsc_m_ytd` (
  `ytd_code` varchar(10) NOT NULL,
  `ytd_name` varchar(125) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bsc_m_ytd`
--

INSERT INTO `bsc_m_ytd` (`ytd_code`, `ytd_name`, `description`) VALUES
('AVG', 'Average', 'Average Value'),
('FIRST', 'First Value', 'First Value'),
('LAST', 'Last Value', 'Last Value'),
('MAX', 'Maximum', 'Highest Value'),
('MIN', 'Minimum', 'Lowest Value'),
('SUM', 'Summary', 'Accumulation of Value');

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
('008', 'Holder\r\n'),
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_obj`
--

INSERT INTO `om_obj` (`obj_id`, `obj_type`, `begin`, `end`) VALUES
(1, 'O', '2008-01-01', '9999-12-31'),
(2, 'S', '2008-01-01', '9999-12-31'),
(3, 'O', '2008-01-01', '9999-12-31'),
(4, 'O', '2008-01-01', '9999-12-31'),
(5, 'O', '2008-01-01', '9999-12-31'),
(6, 'S', '2008-01-01', '9999-12-31'),
(7, 'S', '2008-01-01', '9999-12-31'),
(9, 'S', '2008-01-01', '9999-12-31'),
(10, 'S', '2008-01-01', '9999-12-31'),
(11, 'S', '2008-01-01', '9999-12-31'),
(12, 'S', '2008-01-01', '9999-12-31'),
(13, 'S', '2008-01-01', '9999-12-31');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_obj_attr`
--

INSERT INTO `om_obj_attr` (`attr_id`, `obj_id`, `short_name`, `long_name`, `begin`, `end`) VALUES
(1, 1, '0HLD', 'Holding Company', '2008-01-01', '9999-12-31'),
(2, 2, 'CEO', 'Chief Executive Officer', '2008-01-01', '9999-12-31'),
(3, 3, '1SH', 'Sub-Holding 1', '2008-01-01', '9999-12-31'),
(4, 4, '1SH', 'Sub-Holding 2', '2008-01-01', '9999-12-31'),
(5, 5, '2AAAHR', 'HR & GA Div', '2008-01-01', '9999-12-31'),
(6, 6, 'SCR', 'Secretary to CEO', '2008-01-01', '9999-12-31'),
(7, 7, 'DIR', 'Director Sub-Holding 1', '2008-01-01', '9999-12-31'),
(9, 9, 'DIR', 'Director Sub-Holding 2', '2008-01-01', '9999-12-31'),
(10, 10, 'SCR', 'Secretary to Director', '2008-01-01', '9999-12-31'),
(11, 11, 'SCR', 'Secretary to Director', '2008-01-01', '9999-12-31'),
(12, 12, 'STFCEO', 'Staff to CEO', '2008-01-01', '9999-12-31'),
(13, 13, 'STFCEO', 'Staff to CEO', '2008-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `om_obj_rel`
--

CREATE TABLE IF NOT EXISTS `om_obj_rel` (
`rel_id` bigint(11) unsigned NOT NULL,
  `rel_type` varchar(4) NOT NULL,
  `obj_from` bigint(11) unsigned NOT NULL,
  `obj_to` bigint(11) unsigned NOT NULL,
  `value` int(11) DEFAULT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `om_obj_rel`
--

INSERT INTO `om_obj_rel` (`rel_id`, `rel_type`, `obj_from`, `obj_to`, `value`, `begin`, `end`) VALUES
(1, '003', 1, 2, NULL, '2008-01-01', '9999-12-31'),
(2, '002', 1, 3, NULL, '2008-01-01', '9999-12-31'),
(3, '002', 1, 4, NULL, '2008-01-01', '9999-12-31'),
(4, '002', 3, 5, NULL, '2008-01-01', '9999-12-31'),
(5, '012', 1, 2, NULL, '2008-01-01', '9999-12-31'),
(6, '003', 1, 6, NULL, '2008-01-01', '9999-12-31'),
(7, '002', 2, 6, NULL, '2008-01-01', '9999-12-31'),
(8, '003', 3, 7, NULL, '2008-01-01', '9999-12-31'),
(9, '012', 3, 7, NULL, '2008-01-01', '9999-12-31'),
(10, '002', 2, 7, NULL, '2008-01-01', '9999-12-31'),
(12, '003', 4, 9, NULL, '2008-01-01', '9999-12-31'),
(13, '012', 4, 9, NULL, '2008-01-01', '9999-12-31'),
(14, '002', 2, 9, NULL, '2008-01-01', '9999-12-31'),
(15, '003', 3, 10, NULL, '2008-01-01', '9999-12-31'),
(16, '002', 7, 10, NULL, '2008-01-01', '9999-12-31'),
(17, '003', 4, 11, NULL, '2008-01-01', '9999-12-31'),
(18, '002', 9, 11, NULL, '2008-01-01', '9999-12-31'),
(19, '003', 1, 12, NULL, '2008-01-01', '9999-12-31'),
(20, '002', 2, 12, NULL, '2008-01-01', '9999-12-31'),
(21, '003', 1, 13, NULL, '2008-01-01', '9999-12-31'),
(22, '002', 2, 13, NULL, '2008-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `pa_employee`
--

CREATE TABLE IF NOT EXISTS `pa_employee` (
`emp_id` bigint(20) unsigned NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `birthplace` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL DEFAULT '9999-12-31'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pa_emp_status`
--

CREATE TABLE IF NOT EXISTS `pa_emp_status` (
  `status_id` int(11) NOT NULL,
  `status_code` varchar(5) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL DEFAULT '9999-12-31'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pa_m_status`
--

CREATE TABLE IF NOT EXISTS `pa_m_status` (
  `status_code` varchar(5) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pa_m_status`
--

INSERT INTO `pa_m_status` (`status_code`, `status_name`, `description`) VALUES
('TRN', 'Training', NULL),
('CONT1', '1st Contract', NULL),
('CONT2', '2nd Contract', NULL),
('CONT3', '3rd Contract', NULL),
('PERM', 'Permanent', NULL),
('VAC', 'Vacuum', NULL),
('PROB', 'Probation', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sys_m_role`
--

CREATE TABLE IF NOT EXISTS `sys_m_role` (
  `role_code` varchar(5) NOT NULL,
  `role_name` varchar(125) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_m_role`
--

INSERT INTO `sys_m_role` (`role_code`, `role_name`, `description`) VALUES
('SA', 'Super Administrator', NULL),
('ADMIN', 'Administrator', NULL),
('CHR', 'Corporate Human Resources', NULL),
('HRU', 'Human Resources Unit', NULL),
('USER', 'User', 'Ordinary User');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
`user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(125) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_privilege`
--

CREATE TABLE IF NOT EXISTS `sys_user_privilege` (
`sys_privilege` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_code` varchar(5) NOT NULL,
  `begin` date NOT NULL DEFAULT '9999-12-31',
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bsc_kpi_formula`
--
ALTER TABLE `bsc_kpi_formula`
 ADD PRIMARY KEY (`kpi_formula_id`);

--
-- Indexes for table `bsc_kpi_target`
--
ALTER TABLE `bsc_kpi_target`
 ADD PRIMARY KEY (`kpi_target_id`);

--
-- Indexes for table `bsc_kpi_weight`
--
ALTER TABLE `bsc_kpi_weight`
 ADD PRIMARY KEY (`kpi_weight_id`);

--
-- Indexes for table `bsc_m_formula`
--
ALTER TABLE `bsc_m_formula`
 ADD PRIMARY KEY (`formula_id`);

--
-- Indexes for table `bsc_m_formula_score`
--
ALTER TABLE `bsc_m_formula_score`
 ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `bsc_m_measure`
--
ALTER TABLE `bsc_m_measure`
 ADD PRIMARY KEY (`measure_id`);

--
-- Indexes for table `bsc_m_period`
--
ALTER TABLE `bsc_m_period`
 ADD PRIMARY KEY (`period_code`);

--
-- Indexes for table `bsc_m_perspective`
--
ALTER TABLE `bsc_m_perspective`
 ADD PRIMARY KEY (`perspective_code`), ADD KEY `perspective_code` (`perspective_code`);

--
-- Indexes for table `bsc_m_ref`
--
ALTER TABLE `bsc_m_ref`
 ADD PRIMARY KEY (`ref_code`);

--
-- Indexes for table `bsc_m_relation`
--
ALTER TABLE `bsc_m_relation`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `bsc_m_score`
--
ALTER TABLE `bsc_m_score`
 ADD KEY `pc_score` (`pc_score`);

--
-- Indexes for table `bsc_m_type`
--
ALTER TABLE `bsc_m_type`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `bsc_m_ytd`
--
ALTER TABLE `bsc_m_ytd`
 ADD PRIMARY KEY (`ytd_code`);

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
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sys_user_privilege`
--
ALTER TABLE `sys_user_privilege`
 ADD PRIMARY KEY (`sys_privilege`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bsc_kpi_formula`
--
ALTER TABLE `bsc_kpi_formula`
MODIFY `kpi_formula_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsc_kpi_target`
--
ALTER TABLE `bsc_kpi_target`
MODIFY `kpi_target_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsc_kpi_weight`
--
ALTER TABLE `bsc_kpi_weight`
MODIFY `kpi_weight_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bsc_m_formula`
--
ALTER TABLE `bsc_m_formula`
MODIFY `formula_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bsc_m_formula_score`
--
ALTER TABLE `bsc_m_formula_score`
MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `bsc_m_measure`
--
ALTER TABLE `bsc_m_measure`
MODIFY `measure_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
MODIFY `obj_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `om_obj_attr`
--
ALTER TABLE `om_obj_attr`
MODIFY `attr_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `om_obj_rel`
--
ALTER TABLE `om_obj_rel`
MODIFY `rel_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `pa_employee`
--
ALTER TABLE `pa_employee`
MODIFY `emp_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_user`
--
ALTER TABLE `sys_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_user_privilege`
--
ALTER TABLE `sys_user_privilege`
MODIFY `sys_privilege` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
