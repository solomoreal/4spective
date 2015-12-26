-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2015 at 11:52 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

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
(13, 'S', '2008-01-01', '9999-12-31'),
(18, 'P', '2008-01-01', '9999-12-31'),
(19, 'S', '2008-01-01', '9999-12-31'),
(20, 'P', '2008-01-01', '9999-12-31'),
(21, 'P', '2008-01-01', '9999-12-31'),
(22, 'P', '2008-01-01', '9999-12-31');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

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
(13, 13, 'STFCEO', 'Staff to CEO', '2008-01-01', '9999-12-31'),
(18, 18, '000001', 'Hedi Unus', '2008-01-01', '9999-12-31'),
(19, 19, 'GMHR', 'GM HR and GA', '2008-01-01', '9999-12-31'),
(20, 20, '000002', 'Elizabeth Chealsea', '2008-01-01', '9999-12-31'),
(21, 21, '000003', 'Joko Priono', '2008-01-01', '9999-12-31'),
(22, 22, '000004', 'Budi Warto', '2008-01-01', '9999-12-31');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

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
(22, '002', 2, 13, NULL, '2008-01-01', '9999-12-31'),
(24, '003', 5, 19, NULL, '2008-01-01', '9999-12-31'),
(25, '012', 5, 19, NULL, '2008-01-01', '9999-12-31'),
(26, '002', 7, 19, NULL, '2008-01-01', '9999-12-31'),
(27, '008', 7, 20, 1, '2008-01-01', '9999-12-31'),
(28, '008', 6, 21, 1, '2008-01-01', '9999-12-31'),
(29, '008', 11, 22, 1, '2008-01-01', '9999-12-31'),
(30, '008', 2, 18, 1, '2008-01-01', '9999-12-31'),
(31, '008', 9, 18, 1, '2015-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `sc_emp`
--

CREATE TABLE IF NOT EXISTS `sc_emp` (
`sc_id` int(11) NOT NULL,
  `emp_code` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `period` varchar(10) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `copy_from` int(11) DEFAULT NULL,
  `ref_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sc_emp_kpi`
--

CREATE TABLE IF NOT EXISTS `sc_emp_kpi` (
  `kpi_id` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `short_text` varchar(10) NOT NULL,
  `long_text` varchar(150) NOT NULL,
  `description` text,
  `measure_id` int(11) DEFAULT NULL,
  `formula_id` int(11) DEFAULT NULL,
  `ytd_code` varchar(3) NOT NULL,
  `weight` float unsigned NOT NULL DEFAULT '0',
  `kpi_gen` int(11) DEFAULT NULL,
  `copy_from` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sc_emp_rel`
--

CREATE TABLE IF NOT EXISTS `sc_emp_rel` (
`rel_id` int(11) NOT NULL,
  `kpi_parent` int(11) DEFAULT NULL,
  `kpi_child` int(11) DEFAULT NULL,
  `val` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sc_emp_so`
--

CREATE TABLE IF NOT EXISTS `sc_emp_so` (
  `so_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `short_text` varchar(10) NOT NULL,
  `long_text` varchar(150) NOT NULL,
  `description` text,
  `so_parent` int(11) DEFAULT NULL,
  `copy_from` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sc_emp_target`
--

CREATE TABLE IF NOT EXISTS `sc_emp_target` (
  `target_id` int(11) NOT NULL,
  `kpi_id` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `target_value` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_formula`
--

CREATE TABLE IF NOT EXISTS `sc_m_formula` (
`formula_id` int(11) NOT NULL,
  `formula_name` varchar(200) NOT NULL,
  `description` text,
  `type` int(11) NOT NULL,
  `begin` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sc_m_formula`
--

INSERT INTO `sc_m_formula` (`formula_id`, `formula_name`, `description`, `type`, `begin`, `end`) VALUES
(1, 'Default Max', '', 1, '2008-01-01', '9999-12-31'),
(2, 'Default Min', '', 2, '2008-01-01', '9999-12-31'),
(3, 'Default Stable', '', 3, '2008-01-01', '9999-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_formula_score`
--

CREATE TABLE IF NOT EXISTS `sc_m_formula_score` (
`score_id` int(11) NOT NULL,
  `formula_id` int(11) NOT NULL,
  `pc_score` int(11) NOT NULL,
  `lower` float DEFAULT NULL,
  `upper` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sc_m_formula_score`
--

INSERT INTO `sc_m_formula_score` (`score_id`, `formula_id`, `pc_score`, `lower`, `upper`) VALUES
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
-- Table structure for table `sc_m_measure`
--

CREATE TABLE IF NOT EXISTS `sc_m_measure` (
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
-- Dumping data for table `sc_m_measure`
--

INSERT INTO `sc_m_measure` (`measure_id`, `short_name`, `long_name`, `description`, `has_min`, `has_max`, `min_val`, `max_val`, `real_num`) VALUES
(1, 'IDR', 'Indonesian Rupiah', '', 1, 0, 0, NULL, 1),
(2, 'USD', 'United State Dollar', '', 1, 0, 0, NULL, 1),
(3, '%', 'Percentage Progress', 'Percentage of Progress', 1, 1, 0, 100, 1),
(4, '%', 'Percentage', '', 0, 0, NULL, NULL, 1),
(5, 'Qty', 'Quantity', '', 0, 0, NULL, NULL, 0),
(6, '1-5', 'Scale', '1 = Very Bad ; 5 = Very Good', 1, 1, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_period`
--

CREATE TABLE IF NOT EXISTS `sc_m_period` (
  `period_code` varchar(10) NOT NULL DEFAULT '',
  `begin` date DEFAULT NULL,
  `end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sc_m_period`
--

INSERT INTO `sc_m_period` (`period_code`, `begin`, `end`) VALUES
('2014', '2014-01-01', '2014-12-31'),
('2015', '2015-01-01', '2015-12-31'),
('2016', '2016-01-01', '2016-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_perspective`
--

CREATE TABLE IF NOT EXISTS `sc_m_perspective` (
  `perspective_code` varchar(3) NOT NULL DEFAULT '',
  `icon` varchar(200) NOT NULL,
  `description` varchar(25) DEFAULT NULL,
  `order_val` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sc_m_perspective`
--

INSERT INTO `sc_m_perspective` (`perspective_code`, `icon`, `description`, `order_val`) VALUES
('CUS', 'fa-users', 'Customer', 2),
('FIN', 'fa-money', 'Financial', 1),
('IBP', 'fa-cogs', 'Internal Business Process', 3),
('LNG', 'fa-line-chart', 'Learning And Growth', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_ref`
--

CREATE TABLE IF NOT EXISTS `sc_m_ref` (
  `ref_code` varchar(10) NOT NULL,
  `ref_name` varchar(125) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sc_m_ref`
--

INSERT INTO `sc_m_ref` (`ref_code`, `ref_name`, `description`) VALUES
('AVG', 'Average', NULL),
('MAX', 'Maximum', NULL),
('MIN', 'Minimum', NULL),
('MODE', 'Mode', NULL),
('PROP', 'Proprotional', NULL),
('SUM', 'Summary', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_relation`
--

CREATE TABLE IF NOT EXISTS `sc_m_relation` (
  `code` varchar(4) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_m_relation`
--

INSERT INTO `sc_m_relation` (`code`, `description`) VALUES
('001', 'Employee Working Plan to Employee\r\nEmployee to Employee Working Plan'),
('002', 'Employee Working Plan to Position\r\nPosition to Employee Working Plan'),
('003', 'Organization Working Plan to Organization\r\nOrganization to Organization Working Plan');

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_score`
--

CREATE TABLE IF NOT EXISTS `sc_m_score` (
  `pc_score` int(11) NOT NULL,
  `lower` float DEFAULT NULL,
  `upper` float DEFAULT NULL,
  `color` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_m_score`
--

INSERT INTO `sc_m_score` (`pc_score`, `lower`, `upper`, `color`) VALUES
(1, 0, 1.6, 'f56954'),
(2, 1.61, 2.5, 'f39c12'),
(3, 2.51, 3.5, '00a65a'),
(4, 3.51, 4.4, '00c0ef'),
(5, 4.41, 5, '3c8dbc');

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_type`
--

CREATE TABLE IF NOT EXISTS `sc_m_type` (
  `code` varchar(3) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_m_type`
--

INSERT INTO `sc_m_type` (`code`, `description`) VALUES
('Emp', 'Employee Working Plan'),
('KPI', 'Key Performance Index'),
('Org', 'Organization Working Plan'),
('SO', 'Strategic Objective');

-- --------------------------------------------------------

--
-- Table structure for table `sc_m_ytd`
--

CREATE TABLE IF NOT EXISTS `sc_m_ytd` (
  `ytd_code` varchar(10) NOT NULL,
  `ytd_name` varchar(125) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sc_m_ytd`
--

INSERT INTO `sc_m_ytd` (`ytd_code`, `ytd_name`, `description`) VALUES
('AVG', 'Average', 'Average Value'),
('FIRST', 'First Value', 'First Value'),
('LAST', 'Last Value', 'Last Value'),
('MAX', 'Maximum', 'Highest Value'),
('MIN', 'Minimum', 'Lowest Value'),
('SUM', 'Accumulation', 'Accumulation of Value');

-- --------------------------------------------------------

--
-- Table structure for table `sc_org`
--

CREATE TABLE IF NOT EXISTS `sc_org` (
`sc_id` int(11) NOT NULL,
  `org_id` int(11) DEFAULT NULL,
  `period` varchar(10) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `copy_from` int(11) DEFAULT NULL,
  `ref_to` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_org`
--

INSERT INTO `sc_org` (`sc_id`, `org_id`, `period`, `status`, `copy_from`, `ref_to`) VALUES
(1, 1, '2015', 'draft', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sc_org_kpi`
--

CREATE TABLE IF NOT EXISTS `sc_org_kpi` (
`kpi_id` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `short_text` varchar(10) NOT NULL,
  `long_text` varchar(150) NOT NULL,
  `description` text,
  `measure_id` int(11) DEFAULT NULL,
  `formula_id` int(11) DEFAULT NULL,
  `ytd_code` varchar(5) NOT NULL,
  `weight` float unsigned NOT NULL DEFAULT '0',
  `kpi_gen` int(11) DEFAULT NULL,
  `copy_from` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_org_kpi`
--

INSERT INTO `sc_org_kpi` (`kpi_id`, `so_id`, `sc_id`, `short_text`, `long_text`, `description`, `measure_id`, `formula_id`, `ytd_code`, `weight`, `kpi_gen`, `copy_from`) VALUES
(1, 1, 1, 'F1.1', 'Serapaan Anggaran', 'dibadingkan dengan perencaan', 4, 3, 'AVG', 10, NULL, NULL),
(2, 3, 1, 'C1.1', 'Kepuasan Konsumen', 'Survei Internal', 6, 1, 'LAST', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sc_org_rel`
--

CREATE TABLE IF NOT EXISTS `sc_org_rel` (
`rel_id` int(11) NOT NULL,
  `kpi_parent` int(11) DEFAULT NULL,
  `kpi_child` int(11) DEFAULT NULL,
  `val` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sc_org_so`
--

CREATE TABLE IF NOT EXISTS `sc_org_so` (
`so_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `perspective_code` varchar(3) NOT NULL,
  `short_text` varchar(10) NOT NULL,
  `long_text` varchar(150) NOT NULL,
  `description` text,
  `so_parent` int(11) DEFAULT NULL,
  `copy_from` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_org_so`
--

INSERT INTO `sc_org_so` (`so_id`, `sc_id`, `perspective_code`, `short_text`, `long_text`, `description`, `so_parent`, `copy_from`) VALUES
(1, 1, 'FIN', 'F1', 'Efektifitas Pengeluaran', '', NULL, NULL),
(3, 1, 'CUS', 'C1', 'Kepuasan Konsumen', '', NULL, NULL),
(4, 1, 'IBP', 'P1', 'Operasional Rutin', '', NULL, NULL),
(5, 1, 'LNG', 'L1', 'Pengembangan Feature', '', NULL, NULL),
(10, 1, 'FIN', 'F2', 'Income', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sc_org_target`
--

CREATE TABLE IF NOT EXISTS `sc_org_target` (
`target_id` int(11) NOT NULL,
  `kpi_id` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `target_value` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_org_target`
--

INSERT INTO `sc_org_target` (`target_id`, `kpi_id`, `month`, `target_value`) VALUES
(1, 1, 1, 100),
(2, 1, 2, 100),
(3, 1, 3, 100),
(4, 1, 4, 100),
(5, 1, 5, 100),
(6, 1, 6, 100),
(7, 1, 7, 100),
(8, 1, 8, 100),
(9, 1, 9, 100),
(10, 1, 10, 100),
(11, 1, 11, 100),
(12, 1, 12, 100),
(13, 2, 3, 3.5),
(14, 2, 6, 3.5),
(15, 2, 9, 3.5),
(16, 2, 12, 3.5);

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
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `username`, `password`, `email`, `phone`, `is_active`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@dimana.co', '+62999999', 1),
(4, '000001', 'e99a18c428cb38d5f260853678922e03', 'hedi.unus@dimana.co', '+62999999', 1),
(5, '000002', 'e99a18c428cb38d5f260853678922e03', 'elizabeth.chelsea@dimana.co', '+62999999', 1),
(6, '000003', 'e99a18c428cb38d5f260853678922e03', 'joko@dimana.co', '+629999', 1),
(7, '000004', 'e99a18c428cb38d5f260853678922e03', 'budi.warto@dimana.co', '+629999', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_privilege`
--

CREATE TABLE IF NOT EXISTS `sys_user_privilege` (
`privilege_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_code` varchar(5) NOT NULL,
  `begin` date DEFAULT '2008-01-01',
  `end` date NOT NULL DEFAULT '9999-12-31'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_user_privilege`
--

INSERT INTO `sys_user_privilege` (`privilege_id`, `user_id`, `role_code`, `begin`, `end`) VALUES
(1, 1, 'SA', '2008-01-01', '9999-12-31'),
(4, 4, 'USER', '2008-01-01', '9999-12-31'),
(5, 5, 'USER', '2008-01-01', '9999-12-31'),
(6, 6, 'USER', '2008-01-01', '9999-12-31'),
(7, 7, 'USER', '2008-01-01', '9999-12-31');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `sc_emp`
--
ALTER TABLE `sc_emp`
 ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `sc_emp_kpi`
--
ALTER TABLE `sc_emp_kpi`
 ADD PRIMARY KEY (`kpi_id`);

--
-- Indexes for table `sc_emp_rel`
--
ALTER TABLE `sc_emp_rel`
 ADD PRIMARY KEY (`rel_id`);

--
-- Indexes for table `sc_emp_so`
--
ALTER TABLE `sc_emp_so`
 ADD PRIMARY KEY (`so_id`);

--
-- Indexes for table `sc_emp_target`
--
ALTER TABLE `sc_emp_target`
 ADD PRIMARY KEY (`target_id`);

--
-- Indexes for table `sc_m_formula`
--
ALTER TABLE `sc_m_formula`
 ADD PRIMARY KEY (`formula_id`);

--
-- Indexes for table `sc_m_formula_score`
--
ALTER TABLE `sc_m_formula_score`
 ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `sc_m_measure`
--
ALTER TABLE `sc_m_measure`
 ADD PRIMARY KEY (`measure_id`);

--
-- Indexes for table `sc_m_period`
--
ALTER TABLE `sc_m_period`
 ADD PRIMARY KEY (`period_code`);

--
-- Indexes for table `sc_m_perspective`
--
ALTER TABLE `sc_m_perspective`
 ADD PRIMARY KEY (`perspective_code`), ADD KEY `perspective_code` (`perspective_code`);

--
-- Indexes for table `sc_m_ref`
--
ALTER TABLE `sc_m_ref`
 ADD PRIMARY KEY (`ref_code`);

--
-- Indexes for table `sc_m_relation`
--
ALTER TABLE `sc_m_relation`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `sc_m_score`
--
ALTER TABLE `sc_m_score`
 ADD KEY `pc_score` (`pc_score`);

--
-- Indexes for table `sc_m_type`
--
ALTER TABLE `sc_m_type`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `sc_m_ytd`
--
ALTER TABLE `sc_m_ytd`
 ADD PRIMARY KEY (`ytd_code`);

--
-- Indexes for table `sc_org`
--
ALTER TABLE `sc_org`
 ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `sc_org_kpi`
--
ALTER TABLE `sc_org_kpi`
 ADD PRIMARY KEY (`kpi_id`);

--
-- Indexes for table `sc_org_rel`
--
ALTER TABLE `sc_org_rel`
 ADD PRIMARY KEY (`rel_id`);

--
-- Indexes for table `sc_org_so`
--
ALTER TABLE `sc_org_so`
 ADD PRIMARY KEY (`so_id`);

--
-- Indexes for table `sc_org_target`
--
ALTER TABLE `sc_org_target`
 ADD PRIMARY KEY (`target_id`);

--
-- Indexes for table `sys_user`
--
ALTER TABLE `sys_user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sys_user_privilege`
--
ALTER TABLE `sys_user_privilege`
 ADD PRIMARY KEY (`privilege_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `om_obj`
--
ALTER TABLE `om_obj`
MODIFY `obj_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `om_obj_attr`
--
ALTER TABLE `om_obj_attr`
MODIFY `attr_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `om_obj_rel`
--
ALTER TABLE `om_obj_rel`
MODIFY `rel_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `sc_emp`
--
ALTER TABLE `sc_emp`
MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sc_emp_rel`
--
ALTER TABLE `sc_emp_rel`
MODIFY `rel_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sc_m_formula`
--
ALTER TABLE `sc_m_formula`
MODIFY `formula_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sc_m_formula_score`
--
ALTER TABLE `sc_m_formula_score`
MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sc_m_measure`
--
ALTER TABLE `sc_m_measure`
MODIFY `measure_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sc_org`
--
ALTER TABLE `sc_org`
MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sc_org_kpi`
--
ALTER TABLE `sc_org_kpi`
MODIFY `kpi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sc_org_rel`
--
ALTER TABLE `sc_org_rel`
MODIFY `rel_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sc_org_so`
--
ALTER TABLE `sc_org_so`
MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `sc_org_target`
--
ALTER TABLE `sc_org_target`
MODIFY `target_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sys_user`
--
ALTER TABLE `sys_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sys_user_privilege`
--
ALTER TABLE `sys_user_privilege`
MODIFY `privilege_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
