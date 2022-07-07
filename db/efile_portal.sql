-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2022 at 06:37 PM
-- Server version: 5.7.38-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efile_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `my_key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Demo', 'Demo product', '2022-05-24 11:35:10', '2022-05-24 11:35:10'),
(2, 'Demo p', 'Demo product', '2022-05-24 11:35:10', '2022-05-24 11:35:10'),
(3, 'chitranjan', 'sdfsfsdfdsf', NULL, NULL),
(16, 'chitranjan', 'sdfsfsdfdsf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_department`
--

CREATE TABLE `md_department` (
  `sl_no` int(11) NOT NULL,
  `department_name` varchar(50) DEFAULT NULL,
  `short_code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_department`
--

INSERT INTO `md_department` (`sl_no`, `department_name`, `short_code`) VALUES
(1, 'Administration', 'ADM'),
(2, 'Accounts & Billing', 'ACC'),
(3, 'Legal', 'LGL'),
(4, 'Paddy Procurement', 'PDP'),
(5, 'Social Welfare', 'ICD'),
(6, 'Confiscated Goods', 'CGS'),
(7, 'Disaster Management', 'DIM'),
(8, 'Stationary', 'STN');

-- --------------------------------------------------------

--
-- Table structure for table `md_file_type`
--

CREATE TABLE `md_file_type` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  `file_no` varchar(55) NOT NULL,
  `insception_date` date DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(55) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_file_type`
--

INSERT INTO `md_file_type` (`id`, `dept_id`, `file_name`, `file_no`, `insception_date`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 1, 'Professional Tax', 'P-77', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(2, 1, 'Contingency', 'C-60', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(3, 1, 'Advertisement', 'A-17', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(4, 1, 'Programme Related to Cooperative Department', 'P-206', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(5, 1, 'Licence File', 'G-28', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(6, 1, 'Repair and Maintenance of Machine/Other', 'R-47', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(7, 1, 'Postage and Courier Service', 'P-76', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(8, 1, 'Cnteen Subsidy', 'C-99', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(9, 1, 'Institutional Professional Tax', 'I-45', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(10, 1, 'Salary', 'S-220', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(11, 1, 'Printing and Stationery', 'P-27', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(12, 1, 'Provident Fund', 'P-26', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(13, 1, 'Electric and Telephone', 'P-69', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(14, 1, 'Establishment', 'E-1', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(15, 1, 'System Digitisation and Renovation of Confed Office', 'R-84', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(16, 1, 'Maintenance of Office Car', 'P-70', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(17, 1, 'Travelling and Conveyance', 'T-91', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(18, 1, 'House Rent (Head Office)', 'O-1', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(19, 1, 'Payment file for Contractual Purchase Officer', 'P-173', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(20, 1, 'Bonus and Others', 'B-26', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(21, 1, 'Travelling and Conveyance (S.O.)', 'T-90', '2015-05-21', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(22, 1, 'Hired car of Cooperation Directorate', 'P-171', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(23, 1, 'Contingency Contigent Labours', 'C-123', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(24, 1, 'Contractual Engagement', 'C-130', '2015-11-02', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(25, 1, 'W.B. State Cooperative Union', 'C-88', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(26, 1, 'A.G.M.', 'S-180', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(27, 1, 'Trade License', 'T-5', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(28, 1, 'Office Order', 'O-3', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(29, 1, 'Revision of Pay Scale', 'R-73', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(30, 1, 'Gradation', 'G-36', '2021-02-20', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(31, 1, 'Payment of Daily Wages Emplyoees', 'P-177', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(32, 1, 'Amendment of Bye-Laws of Confed', 'A-84', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(33, 1, 'Group Leave Encashment Scheme', 'G-33', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(34, 1, 'Employee Group Gratuity Scheme', 'G-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(35, 1, 'LIC New Group Gratuity', 'G-37', '2021-07-20', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(36, 1, 'Promotion of Emloyees', 'P-201', '2021-08-02', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(37, 1, 'D.A. & I.R.', 'D-80/P-11', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(38, 1, 'Renovation Gangarampur Godown', 'R-85', '2018-09-25', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(39, 1, 'Sri Ajit Kr. Biswas 31.07.2017', 'P-175', '2017-07-31', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(40, 1, 'Sri Jyotisankar Mondal 29.03.2018', 'P-176', '2018-03-29', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(41, 1, 'Smt Anamita Sen 30.05.2018', 'P-178', '2018-05-30', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(42, 1, 'Sri Subrata Ghosh 04.10.2018', 'P-179', '2018-04-10', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(43, 1, 'Smt.Rupa Hazra 4.10.2018', 'P-180', '2018-04-10', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(44, 1, 'Kishor Ghosh 4.10.2018', 'P-181', '2018-04-10', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(45, 1, 'Shila Pal 8.01.2019', 'P-182', '2019-01-08', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(46, 1, 'Subhas Dutta 14.01.2019', 'P-183', '2019-01-14', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(47, 1, 'Subhasis Saha 20.02.2019', 'P-184', '2019-02-20', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(48, 1, 'Rakhi Bala 5.03.2019', 'P-185', '2018-03-05', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(49, 1, 'Arka Prasad Sen 19.03.2019', 'P-186', '2019-03-19', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(50, 1, 'Bikash Sarkar 17.05.2019', 'P-187', '2019-05-17', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(51, 1, 'Tuhinangshu Ghosh 30.05.2019', 'P-188', '2019-05-30', 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(52, 1, 'Arup Kr. Pal (ARCS) 02.08.2019', 'P-189', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(53, 1, 'Nemai Ghosh 04.10.2018', 'P-190', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(54, 1, 'Anup Chowdhury 19.11.2019', 'P-191', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(55, 1, 'Arindam Das 19.11.2019', 'P-192', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(56, 1, 'Surojit Banerjee 19.11.2019', 'P-193', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(57, 1, 'Debasis Debnath 19.11.2019', 'P-194', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(58, 1, 'Jagneswar Pradhan CEO, 14.02.2020', 'P-195', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(59, 1, 'Uttam Kr. Mitra,(ARCS) 17.03.2020', 'P-196', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(60, 1, 'Sri Ajit Kr. Biswas 22.05.2020', 'P-197', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(61, 1, 'Aalok Das 10.08.2020', 'P-198', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(62, 1, 'Tuhinangshu Ghosh 6.11.2020', 'P-199', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(63, 1, 'Sandip Kumar Das', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(64, 1, 'Tumpa Majumdar', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(65, 1, 'Bapan Chatterjee', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(66, 1, 'Mohan Ram', 'P-152', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(67, 1, 'Siddharta Nandy', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(68, 1, 'Tarak Nath Kar', 'P-12(34)', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(69, 1, 'Uday Sankar Barik Retired DRCS', 'P-202', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(70, 1, 'Prasad Gangopadhyay', 'P-208', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(71, 1, 'Tapas Ghosh Retired CI', 'P-207', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(72, 1, 'Lakshmi Narayan Rajak Retired Inspector', 'P-205', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(73, 1, 'Sobhan Ghosh CDO', 'P-204', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(74, 1, 'Biswajit Pramanik ARCS', 'P-203', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(75, 1, 'Susanta Kumar Chakraborty', 'P-12 (48)', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(76, 1, 'Shyamal Samanta', 'P-12(46)', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(77, 1, 'Sk Samsul Islam', 'P-12(41)', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(78, 1, 'Gulshan Kumar Gund', 'P-12(35)', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(79, 1, 'Housing Complex Shalimar', 'S-357', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(80, 1, 'Bowbazar Land', 'B-46', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(81, 1, 'Siddharta Nandy 1/12/14', 'L-75', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(82, 1, 'SUBRATA GHOSH DT 4/10/18', 'L-77', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(83, 1, 'RUPA HAZRA DT 4/10/18', 'L-78', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(84, 1, 'NEMAI GHOSH DT 4/10/18', 'L-79', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(85, 1, 'ANAMITA SEN DT 3/11/2020', 'L-80', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(86, 1, 'LEAVE FILE OF ANUP CHOWDHURY DT 02/12/2020', 'L-81', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(87, 1, 'ARKA PRASAD SEN DT 22/12/2020', 'L-83', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(88, 1, 'SUROJIT BANERJEE ASTT MANAGER 1 DT 7/1/2021', 'L-84', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(89, 1, 'DEBASHIS DEBNATH ASTT MANAGER II DT 7/1/2021', 'L-85', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(90, 1, 'SUBHASIS SAHA DT 20/1/2021', 'L-86', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(91, 1, 'Aloke Das', 'L-87', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(92, 1, 'Tuhinagshu Ghosh', 'L-88', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(93, 1, 'Sandip Kumar Das', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(94, 1, 'Tumpa Majumdar', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(95, 1, 'Bapan Chatterjee', 'L-25', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(96, 1, 'Tarak Nath Kar', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(97, 1, 'Mohan Ram', 'P-12', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(98, 1, 'Administration Cost of RKVY', 'A-91', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(99, 1, 'Hired car of S.O.', 'P-104', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(100, 1, 'Correspondence under RIDF', 'R-79', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(101, 1, 'Employees Credit Society', 'E-8', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(102, 1, 'Future Preserve Associates', 'F-41', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(103, 1, 'Financial Proposal', 'F-40', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(104, 1, 'Financial Assistant for Short term Loan', 'F-39', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(105, 1, 'Filing Charges', 'F-38', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(106, 1, 'Howrah Hospital', 'H-25', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(107, 2, 'TDS', 'I-42', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(108, 2, 'ACCOUNTS FILE', 'A-83', NULL, 'UPLOAD', '2022-05-18 00:00:00', 'UPLOAD', NULL),
(109, 2, 'STATIONERY AUDIT FEE', 'A-71', NULL, 'UPLOAD', '2022-05-19 00:00:00', 'UPLOAD', NULL),
(110, 2, 'E-FILLING CHARGES', 'F-38', NULL, 'UPLOAD', '2022-05-20 00:00:00', 'UPLOAD', NULL),
(111, 2, 'CSGL ACCOUNT/GOVT SECURITIES', 'P-200', NULL, 'UPLOAD', '2022-05-21 00:00:00', 'UPLOAD', NULL),
(112, 2, 'NABARD LOAN', 'L-74', NULL, 'UPLOAD', '2022-05-22 00:00:00', 'UPLOAD', NULL),
(113, 2, 'INFORMATION UNDER RTI ACT', 'R-71', NULL, 'UPLOAD', '2022-05-23 00:00:00', 'UPLOAD', NULL),
(114, 2, 'NATIONAL COOPERATIVE UNION OF INDIA (NCUI)', 'N-2', NULL, 'UPLOAD', '2022-05-24 00:00:00', 'UPLOAD', NULL),
(115, 2, 'WHOLESALE OUTSTANDING DUES', 'W-40', NULL, 'UPLOAD', '2022-05-25 00:00:00', 'UPLOAD', NULL),
(116, 2, 'POTATO LOAN RECONSTRUCTION SCHEME', 'S-328', NULL, 'UPLOAD', '2022-05-26 00:00:00', 'UPLOAD', NULL),
(117, 2, 'REPORT OR ORDER TO/FROM SECRETARY/REGISTRAR OF COOPERATIVE SOCIETIES', 'I-52', NULL, 'UPLOAD', '2022-05-27 00:00:00', 'UPLOAD', NULL),
(118, 2, 'RENEWAL OF FIXED DEPOSIT', 'F-9', NULL, 'UPLOAD', '2022-05-28 00:00:00', 'UPLOAD', NULL),
(119, 2, 'BANK TRANSFER OF FUND', 'B-58', NULL, 'UPLOAD', '2022-05-29 00:00:00', 'UPLOAD', NULL),
(120, 2, 'SALES TAX/W.B. VAT', 'S-12', NULL, 'UPLOAD', '2022-05-30 00:00:00', 'UPLOAD', NULL),
(121, 2, 'STATUTORY AUDIT REPORT', 'I-42', NULL, 'UPLOAD', '2022-05-31 00:00:00', 'UPLOAD', NULL),
(122, 2, 'APPLICATION FOR SHARE', 'A-1', NULL, 'UPLOAD', '2022-06-01 00:00:00', 'UPLOAD', NULL),
(123, 2, 'LOAN FROM GOVERNMENT/COOPERATIVE BANK', 'L-74', NULL, 'UPLOAD', '2022-06-02 00:00:00', 'UPLOAD', NULL),
(124, 2, 'YEARLY VERIFICATION OF CASH AND DEAD STOCKS', 'V-3', NULL, 'UPLOAD', '2022-06-03 00:00:00', 'UPLOAD', NULL),
(125, 2, 'ACCOUNTS OPENING/CLOSING OF DIFFERENT BANKS', 'A-72', NULL, 'UPLOAD', '2022-06-04 00:00:00', 'UPLOAD', NULL),
(126, 3, 'LEGAL EXPENSES/MATTERS', 'I-42', NULL, 'UPLOAD', '2022-05-17 00:00:00', 'UPLOAD', NULL),
(127, 3, 'CASE NO. 1903 DILIP KR. DUTTA VS CEO,CONFED.', 'T-41', NULL, 'UPLOAD', '2022-05-18 00:00:00', 'UPLOAD', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_fin_year`
--

CREATE TABLE `md_fin_year` (
  `sl_no` int(11) NOT NULL,
  `fin_year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_fin_year`
--

INSERT INTO `md_fin_year` (`sl_no`, `fin_year`) VALUES
(1, '2022-23');

-- --------------------------------------------------------

--
-- Table structure for table `md_terms`
--

CREATE TABLE `md_terms` (
  `sl_no` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `terms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `md_users`
--

CREATE TABLE `md_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dept` varchar(20) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone_no` bigint(20) NOT NULL,
  `phone_verification` enum('0','1') NOT NULL DEFAULT '0',
  `password` varchar(200) NOT NULL,
  `conifrm_pwd` varchar(200) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `user_approve` enum('0','1') NOT NULL DEFAULT '0',
  `approve_by` varchar(55) DEFAULT NULL,
  `approve_dt` datetime DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(55) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `md_users`
--

INSERT INTO `md_users` (`id`, `first_name`, `last_name`, `dept`, `email`, `phone_no`, `phone_verification`, `password`, `conifrm_pwd`, `designation`, `user_type`, `user_approve`, `approve_by`, `approve_dt`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'demo', 'demo', 'Dispatch', 'abc@gmail.com', 9007507220, '0', '$2y$10$uo9FFOXV6c1eCAsH4JKAkuyJ.aKTqcey1Xxhl1fLQG3W56XdcZM0e', '$2y$10$3tHEhJdG5gIe.EgwtGiIWuMOjWB.HPQwPdDgla.g8DVQgmzbiWztq', 'junior Assistant', '', '1', NULL, NULL, 'demo demo', '2022-05-11 16:11:55', NULL, NULL),
(2, 'arko', 'arko', 'Administration', 'abc@gmail.com', 9876543217, '0', '$2y$10$uo9FFOXV6c1eCAsH4JKAkuyJ.aKTqcey1Xxhl1fLQG3W56XdcZM0e', '$2y$10$3tHEhJdG5gIe.EgwtGiIWuMOjWB.HPQwPdDgla.g8DVQgmzbiWztq', 'junior Assistant', '', '1', NULL, NULL, 'demo demo', '2022-05-11 16:11:55', NULL, NULL),
(3, 'raja', 'raja', 'Administration', 'abc@gmail.com', 1234567890, '0', '$2y$10$uo9FFOXV6c1eCAsH4JKAkuyJ.aKTqcey1Xxhl1fLQG3W56XdcZM0e', '$2y$10$3tHEhJdG5gIe.EgwtGiIWuMOjWB.HPQwPdDgla.g8DVQgmzbiWztq', 'junior Assistant', '', '1', NULL, NULL, 'demo demo', '2022-05-11 16:11:55', NULL, NULL),
(4, 'CEO', 'CEO', 'Administration', 'ceo@gmail.com', 9999999999, '0', '$2y$10$uo9FFOXV6c1eCAsH4JKAkuyJ.aKTqcey1Xxhl1fLQG3W56XdcZM0e', '$2y$10$3tHEhJdG5gIe.EgwtGiIWuMOjWB.HPQwPdDgla.g8DVQgmzbiWztq', 'CEO', '', '1', NULL, NULL, 'demo demo', '2022-05-11 16:11:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_user_type`
--

CREATE TABLE `md_user_type` (
  `sl_no` int(11) NOT NULL,
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `td_docket_no`
--

CREATE TABLE `td_docket_no` (
  `docket_dt` date NOT NULL,
  `fin_year` int(11) NOT NULL,
  `sl_no` int(11) NOT NULL,
  `docket_no` varchar(30) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=> Forwarded',
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_docket_no`
--

INSERT INTO `td_docket_no` (`docket_dt`, `fin_year`, `sl_no`, `docket_no`, `status`, `created_by`, `created_at`) VALUES
('2022-05-12', 1, 1, '2022-23-1', '1', '1', '2022-05-12 11:11:18'),
('2022-05-12', 1, 2, '2022-23-2', '0', '1', '2022-05-12 11:48:13'),
('2022-05-16', 1, 3, '2022-23-3', '0', '1', '2022-05-16 03:11:11'),
('2022-05-23', 1, 4, '2022-23-4', '0', '1', '2022-05-23 12:46:56'),
('2022-05-23', 1, 5, '2022-23-5', '0', '1', '2022-05-23 02:55:09'),
('2022-05-23', 1, 6, '2022-23-6', '0', '1', '2022-05-23 02:55:41'),
('2022-05-23', 1, 7, '2022-23-7', '0', '1', '2022-05-23 02:56:11'),
('2022-05-23', 1, 8, '2022-23-8', '0', '1', '2022-05-23 02:56:31'),
('2022-05-23', 1, 9, '2022-23-9', '0', '1', '2022-05-23 02:58:08'),
('2022-05-23', 1, 10, '2022-23-10', '0', '1', '2022-05-23 02:58:23'),
('2022-06-08', 1, 11, '2022-23-11', '0', '1', '2022-06-08 11:12:50'),
('2022-06-08', 1, 12, '2022-23-12', '1', '1', '2022-06-08 03:24:57'),
('2022-06-21', 1, 13, '2022-23-13', '0', '2', '2022-06-21 11:38:16'),
('2022-07-06', 1, 14, '2022-23-14', '0', '1', '2022-07-06 11:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `td_document`
--

CREATE TABLE `td_document` (
  `upload_dt` date NOT NULL,
  `docket_no` varchar(50) NOT NULL,
  `sl_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `document` text NOT NULL,
  `term_flag` enum('Y','N') NOT NULL DEFAULT 'N',
  `fwd_flag` enum('Y','N') DEFAULT 'N',
  `remarks` text,
  `fwd_dept` int(11) NOT NULL,
  `fwd_to` int(11) NOT NULL,
  `upld_by` varchar(50) DEFAULT NULL,
  `upld_at` datetime DEFAULT NULL,
  `fwd_by` varchar(50) DEFAULT NULL,
  `fwd_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_document`
--

INSERT INTO `td_document` (`upload_dt`, `docket_no`, `sl_no`, `name`, `document`, `term_flag`, `fwd_flag`, `remarks`, `fwd_dept`, `fwd_to`, `upld_by`, `upld_at`, `fwd_by`, `fwd_at`) VALUES
('2022-05-16', '2022-23-1', 1, 'Tara traders', '01652678432.jpeg', 'N', 'Y', 'test data', 1, 2, '1', '2022-05-16 10:50:32', '1', '2022-06-20 01:17:39'),
('2022-05-16', '2022-23-1', 2, 'Ma kali traders', '11652678432.jpeg', 'N', 'Y', 'test data', 1, 2, '1', '2022-05-16 10:50:32', '1', '2022-06-20 01:17:39'),
('2022-05-16', '2022-23-1', 3, 'RS TRADESRS', '21652678432.jpeg', 'N', 'Y', 'test data', 1, 2, '1', '2022-05-16 10:50:32', '1', '2022-06-20 01:17:39'),
('2022-06-13', '2022-23-1', 10, 'test data', '01655099723.pdf', 'N', 'Y', 'Test data ', 1, 2, '1', '2022-06-13 11:25:23', '1', '2022-06-20 01:17:39'),
('2022-06-13', '2022-23-1', 11, 'tredr', '11655099723.jpeg', 'N', 'Y', 'Test data ', 1, 2, '1', '2022-06-13 11:25:23', '1', '2022-06-20 01:17:39'),
('2022-06-13', '2022-23-1', 12, 'DASDD', '01655101076.pdf', 'N', 'Y', 'axdSD', 1, 2, '1', '2022-06-13 11:47:56', '1', '2022-06-20 01:17:39'),
('2022-06-13', '2022-23-12', 15, 'test', '01655124637.pdf', 'N', 'Y', 'test dat here', 1, 2, '1', '2022-06-13 06:20:37', '1', '2022-06-21 11:12:58'),
('2022-06-13', '2022-23-5', 18, 'testg', '01655125817.pdf', 'N', 'Y', 'test', 1, 2, '1', '2022-06-13 06:40:17', '1', '2022-06-16 01:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `td_doc_track`
--

CREATE TABLE `td_doc_track` (
  `fwd_dt` date NOT NULL,
  `sl_no` int(11) NOT NULL,
  `docket_no` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 NOT NULL,
  `fwd_status` enum('A','R') CHARACTER SET utf8mb4 NOT NULL COMMENT 'A - approve R- reject',
  `fwd_dept` int(11) NOT NULL,
  `fwd_to` int(11) NOT NULL,
  `forwarded_by` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `forwarded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `td_doc_track`
--

INSERT INTO `td_doc_track` (`fwd_dt`, `sl_no`, `docket_no`, `remarks`, `fwd_status`, `fwd_dept`, `fwd_to`, `forwarded_by`, `forwarded_at`) VALUES
('2022-06-20', 5, '2022-23-1', 'asxDADASFD', 'A', 1, 2, '1', '2022-06-20 01:17:39'),
('2022-06-21', 6, '2022-23-12', 'dsfsdf', 'A', 1, 2, '1', '2022-06-21 11:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `td_file`
--

CREATE TABLE `td_file` (
  `file_date` date NOT NULL,
  `sl_no` int(11) NOT NULL,
  `fin_year` int(11) NOT NULL,
  `file_no` varchar(50) NOT NULL,
  `dept_no` int(11) NOT NULL,
  `application_no` varchar(150) DEFAULT NULL,
  `docket_no` varchar(15) DEFAULT NULL,
  `note_sheet` text NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `creater_forward` enum('0','1') NOT NULL DEFAULT '0',
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_file`
--

INSERT INTO `td_file` (`file_date`, `sl_no`, `fin_year`, `file_no`, `dept_no`, `application_no`, `docket_no`, `note_sheet`, `created_by`, `created_at`, `creater_forward`, `modified_by`, `modified_at`) VALUES
('2022-05-18', 4, 1, 'I-42-2022-23-4', 3, NULL, '2022-23-1', '<p>This is test data developed for test purpose&nbsp;</p>', '2', '2022-05-18 05:40:26', '0', NULL, NULL),
('2022-05-18', 5, 1, 'C-99-2022-23-5', 1, NULL, '2022-23-1', '<p>This is test data developed for test purpose&nbsp;</p>', '1', '2022-05-18 06:11:12', '0', NULL, NULL),
('2022-05-19', 6, 1, 'I-42-2022-23-6', 3, NULL, '2022-23-1', '<p>This is test data developed for test purpose&nbsp;</p>\n', '2', '2022-05-19 11:53:09', '0', NULL, NULL),
('2022-05-19', 8, 1, 'P-206-2022-23-8', 1, NULL, '2022-23-1', '<p>asSAS SQAs s qwed qq edq xadasd csafaf dasdasdasdasd lokesh vdsfgesgv dvfsegver</p>\r\n', '1', '2022-05-19 05:11:28', '0', '1', '2022-05-19 06:48:21'),
('2022-06-21', 11, 1, 'P-77-2022-23-11', 1, NULL, '', '<p>dshdsa skadksa d jkasksafj ksljkasfk&nbsp; asdaklfakl</p>\r\n', '2', '2022-06-21 12:24:32', '0', NULL, NULL),
('2022-06-21', 12, 1, 'S-220-2022-23-12', 1, NULL, '', '', '1', '2022-06-21 05:14:08', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `td_file_document`
--

CREATE TABLE `td_file_document` (
  `upload_dt` date NOT NULL,
  `file_no` varchar(50) NOT NULL,
  `sl_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `document` text NOT NULL,
  `upld_by` varchar(50) DEFAULT NULL,
  `upld_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_file_document`
--

INSERT INTO `td_file_document` (`upload_dt`, `file_no`, `sl_no`, `name`, `document`, `upld_by`, `upld_at`) VALUES
('2022-06-21', 'P-77-2022-23-11', 1, 'SAsasas', '01655794472.jpeg', '2', '2022-06-21 12:24:32'),
('2022-06-21', 'P-77-2022-23-11', 2, 'ffdhh', '11655794472.jpeg', '2', '2022-06-21 12:24:32'),
('2022-06-21', 'S-220-2022-23-12', 3, 'asSAS', '01655811848.jpeg', '1', '2022-06-21 05:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `td_track_file`
--

CREATE TABLE `td_track_file` (
  `fwd_dt` date NOT NULL,
  `sl_no` int(11) NOT NULL,
  `file_no` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `fwd_status` enum('A','R') NOT NULL COMMENT 'A - approve R- reject',
  `fwd_dept` int(11) NOT NULL,
  `fwd_to` int(11) NOT NULL,
  `forwarded_by` varchar(50) DEFAULT NULL,
  `forwarded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_track_file`
--

INSERT INTO `td_track_file` (`fwd_dt`, `sl_no`, `file_no`, `remarks`, `fwd_status`, `fwd_dept`, `fwd_to`, `forwarded_by`, `forwarded_at`) VALUES
('2022-05-20', 1, 'I-42-2022-23-4', 'asSS', 'A', 0, 2, NULL, NULL),
('2022-06-22', 2, 'S-220-2022-23-12', 'Wll done it is very special data for tst ', 'A', 0, 2, '1', '2022-06-22 05:20:25'),
('2022-06-23', 3, 'S-220-2022-23-12', 'Hi it si my forward to data ', 'A', 0, 3, '2', '2022-06-23 03:24:59'),
('2022-07-06', 4, 'L-83-2022-23-13', 'Leave for Arko ', 'A', 0, 3, '1', '2022-07-06 12:54:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_department`
--
ALTER TABLE `md_department`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_file_type`
--
ALTER TABLE `md_file_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_fin_year`
--
ALTER TABLE `md_fin_year`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_terms`
--
ALTER TABLE `md_terms`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_users`
--
ALTER TABLE `md_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_user_type`
--
ALTER TABLE `md_user_type`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `td_docket_no`
--
ALTER TABLE `td_docket_no`
  ADD PRIMARY KEY (`fin_year`,`sl_no`);

--
-- Indexes for table `td_document`
--
ALTER TABLE `td_document`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `td_doc_track`
--
ALTER TABLE `td_doc_track`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `td_file`
--
ALTER TABLE `td_file`
  ADD PRIMARY KEY (`sl_no`,`fin_year`);

--
-- Indexes for table `td_file_document`
--
ALTER TABLE `td_file_document`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `td_track_file`
--
ALTER TABLE `td_track_file`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `md_department`
--
ALTER TABLE `md_department`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `md_file_type`
--
ALTER TABLE `md_file_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `md_fin_year`
--
ALTER TABLE `md_fin_year`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `md_terms`
--
ALTER TABLE `md_terms`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `md_users`
--
ALTER TABLE `md_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `md_user_type`
--
ALTER TABLE `md_user_type`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `td_document`
--
ALTER TABLE `td_document`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `td_doc_track`
--
ALTER TABLE `td_doc_track`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `td_file_document`
--
ALTER TABLE `td_file_document`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `td_track_file`
--
ALTER TABLE `td_track_file`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
