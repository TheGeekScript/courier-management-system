-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2023 at 10:19 AM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u844157008_portalomega`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Aland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bonaire, Sint Eustatius and Saba'),
(29, 'Bosnia and Herzegovina'),
(30, 'Botswana'),
(31, 'Bouvet Island'),
(32, 'Brazil'),
(33, 'British Indian Ocean Territory'),
(34, 'Brunei Darussalam'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cambodia'),
(39, 'Cameroon'),
(40, 'Canada'),
(41, 'Cape Verde'),
(42, 'Cayman Islands'),
(43, 'Central African Republic'),
(44, 'Chad'),
(45, 'Chile'),
(46, 'China'),
(47, 'Christmas Island'),
(48, 'Cocos (Keeling) Islands'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Congo, the Democratic Republic of the'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Cote D\'Ivoire'),
(56, 'Croatia'),
(57, 'Cuba'),
(58, 'Curacao'),
(59, 'Cyprus'),
(60, 'Czech Republic'),
(61, 'Denmark'),
(62, 'Djibouti'),
(63, 'Dominica'),
(64, 'Dominican Republic'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands (Malvinas)'),
(73, 'Faroe Islands'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'French Guiana'),
(78, 'French Polynesia'),
(79, 'French Southern Territories'),
(80, 'Gabon'),
(81, 'Gambia'),
(82, 'Georgia'),
(83, 'Germany'),
(84, 'Ghana'),
(85, 'Gibraltar'),
(86, 'Greece'),
(87, 'Greenland'),
(88, 'Grenada'),
(89, 'Guadeloupe'),
(90, 'Guam'),
(91, 'Guatemala'),
(92, 'Guernsey'),
(93, 'Guinea'),
(94, 'Guinea-Bissau'),
(95, 'Guyana'),
(96, 'Haiti'),
(97, 'Heard Island and Mcdonald Islands'),
(98, 'Holy See (Vatican City State)'),
(99, 'Honduras'),
(100, 'Hong Kong'),
(101, 'Hungary'),
(102, 'Iceland'),
(103, 'India'),
(104, 'Indonesia'),
(105, 'Iran, Islamic Republic of'),
(106, 'Iraq'),
(107, 'Ireland'),
(108, 'Isle of Man'),
(109, 'Israel'),
(110, 'Italy'),
(111, 'Jamaica'),
(112, 'Japan'),
(113, 'Jersey'),
(114, 'Jordan'),
(115, 'Kazakhstan'),
(116, 'Kenya'),
(117, 'Kiribati'),
(118, 'Korea, Democratic People\"s Republic of'),
(119, 'Korea, Republic of'),
(120, 'Kosovo'),
(121, 'Kuwait'),
(122, 'Kyrgyzstan'),
(123, 'Lao People\'s Democratic Republic'),
(124, 'Latvia'),
(125, 'Lebanon'),
(126, 'Lesotho'),
(127, 'Liberia'),
(128, 'Libyan Arab Jamahiriya'),
(129, 'Liechtenstein'),
(130, 'Lithuania'),
(131, 'Luxembourg'),
(132, 'Macao'),
(133, 'Macedonia, the Former Yugoslav Republic of'),
(134, 'Madagascar'),
(135, 'Malawi'),
(136, 'Malaysia'),
(137, 'Maldives'),
(138, 'Mali'),
(139, 'Malta'),
(140, 'Marshall Islands'),
(141, 'Martinique'),
(142, 'Mauritania'),
(143, 'Mauritius'),
(144, 'Mayotte'),
(145, 'Mexico'),
(146, 'Micronesia, Federated States of'),
(147, 'Moldova, Republic of'),
(148, 'Monaco'),
(149, 'Mongolia'),
(150, 'Montenegro'),
(151, 'Montserrat'),
(152, 'Morocco'),
(153, 'Mozambique'),
(154, 'Myanmar'),
(155, 'Namibia'),
(156, 'Nauru'),
(157, 'Nepal'),
(158, 'Netherlands'),
(159, 'Netherlands Antilles'),
(160, 'New Caledonia'),
(161, 'New Zealand'),
(162, 'Nicaragua'),
(163, 'Niger'),
(164, 'Nigeria'),
(165, 'Niue'),
(166, 'Norfolk Island'),
(167, 'Northern Mariana Islands'),
(168, 'Norway'),
(169, 'Oman'),
(170, 'Pakistan'),
(171, 'Palau'),
(172, 'Palestinian Territory, Occupied'),
(173, 'Panama'),
(174, 'Papua New Guinea'),
(175, 'Paraguay'),
(176, 'Peru'),
(177, 'Philippines'),
(178, 'Pitcairn'),
(179, 'Poland'),
(180, 'Portugal'),
(181, 'Puerto Rico'),
(182, 'Qatar'),
(183, 'Reunion'),
(184, 'Romania'),
(185, 'Russian Federation'),
(186, 'Rwanda'),
(187, 'Saint Barthelemy'),
(188, 'Saint Helena'),
(189, 'Saint Kitts and Nevis'),
(190, 'Saint Lucia'),
(191, 'Saint Martin'),
(192, 'Saint Pierre and Miquelon'),
(193, 'Saint Vincent and the Grenadines'),
(194, 'Samoa'),
(195, 'San Marino'),
(196, 'Sao Tome and Principe'),
(197, 'Saudi Arabia'),
(198, 'Senegal'),
(199, 'Serbia'),
(200, 'Serbia and Montenegro'),
(201, 'Seychelles'),
(202, 'Sierra Leone'),
(203, 'Singapore'),
(204, 'Sint Maarten'),
(205, 'Slovakia'),
(206, 'Slovenia'),
(207, 'Solomon Islands'),
(208, 'Somalia'),
(209, 'South Africa'),
(210, 'South Georgia and the South Sandwich Islands'),
(211, 'South Sudan'),
(212, 'Spain'),
(213, 'Sri Lanka'),
(214, 'Sudan'),
(215, 'Suriname'),
(216, 'Svalbard and Jan Mayen'),
(217, 'Swaziland'),
(218, 'Sweden'),
(219, 'Switzerland'),
(220, 'Syrian Arab Republic'),
(221, 'Taiwan, Province of China'),
(222, 'Tajikistan'),
(223, 'Tanzania, United Republic of'),
(224, 'Thailand'),
(225, 'Timor-Leste'),
(226, 'Togo'),
(227, 'Tokelau'),
(228, 'Tonga'),
(229, 'Trinidad and Tobago'),
(230, 'Tunisia'),
(231, 'Turkey'),
(232, 'Turkmenistan'),
(233, 'Turks and Caicos Islands'),
(234, 'Tuvalu'),
(235, 'Uganda'),
(236, 'Ukraine'),
(237, 'United Arab Emirates'),
(238, 'United Kingdom'),
(239, 'United States'),
(240, 'United States Minor Outlying Islands'),
(241, 'Uruguay'),
(242, 'Uzbekistan'),
(243, 'Vanuatu'),
(244, 'Venezuela'),
(245, 'Viet Nam'),
(246, 'Virgin Islands, British'),
(247, 'Virgin Islands, U.s.'),
(248, 'Wallis and Futuna'),
(249, 'Western Sahara'),
(250, 'Yemen'),
(251, 'Zambia'),
(252, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `courier_name` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `courier_name`, `status`) VALUES
(1, 'Self', 1),
(2, 'DHL', 1),
(3, 'Fedex', 1),
(4, 'UPS', 1),
(5, 'Aramex', 1),
(6, 'DPD', 1),
(7, 'DPEX', 1),
(8, 'Elite Airborne Express', 1),
(9, 'TNT', 1),
(10, 'DHL Parcel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_admin`
--

CREATE TABLE `master_admin` (
  `master_id` int(11) NOT NULL,
  `type` enum('ADM','EMP','CUST') NOT NULL,
  `access_status` int(10) NOT NULL DEFAULT 1,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `reg_date` varchar(25) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_admin`
--

INSERT INTO `master_admin` (`master_id`, `type`, `access_status`, `f_name`, `l_name`, `email`, `phone`, `password`, `gender`, `gst`, `company_name`, `address`, `reg_date`, `update_date`, `is_active`) VALUES
(1, 'ADM', 1, 'Prasad', 'Deokar', 'prasaddeokar@gmail.com', '9876543210', '202cb962ac59075b964b07152d234b70', 'Male', '', 'Omega Enterprises', 'Mumbai', '2021-02-25 20:42:33', '2020-04-28 15:12:33', 1),
(2, 'ADM', 1, 'Sachin', 'Raut', 'vishalraut1977@gmail.com', '9876543211', '21232F297A57A5A743894A0E4A801FC3', 'Male', '', 'Omega Enterprises', 'Mumbai', '2021-02-25 20:42:33', '2020-04-28 15:12:33', 1),
(5, 'EMP', 1, 'emo', 'emp', 'emp@emp.com', '9876543222', '202cb962ac59075b964b07152d234b70', 'Male', '', 'Omega Enterprises', 'Mumbai', '2021-02-25 20:42:33', '2020-04-29 10:30:45', 1),
(6, 'CUST', 1, 'Hakim Turab', 'Kapadia', 'hkapadia@gmail.com', '9876543333', '202cb962ac59075b964b07152d234b70', 'Male', '', 'Omega Enterprises', 'Mumbai', '2021-02-25 20:42:33', '2020-04-29 10:30:45', 1),
(7, 'CUST', 1, 'Darshan', 'Kataria', 'dsquarelogistics@gmail.com', '9221046789', '70b4269b412a8af42b1f7b0d26eceff2', 'Male', '27AOMPB2321M1Z0', 'Dsquare Logistics', 'Mulund dscbhsdbc msndv dchbsdh sdcbhsnd', '2021-02-27 17:14:39', '2021-02-27 11:44:39', 1),
(9, 'CUST', 1, 'Ramesh ', 'Bodke', 'ontimeexpress678@gmail.com', '9822049045', '9a0088c7340f499cdb7c45164abfdc89', 'Male', '27AEYPB9688M1Z9', 'ONTIME EXPRESS', '4, OPP KALIKA MANDIR\r\nKALIKA TOWER\r\nOLD BOMBAY AGRA ROAD\r\nNASIK 422002', '2021-03-31 17:49:09', '2021-03-31 12:19:09', 1),
(12, 'CUST', 1, 'Akshay ', 'Shah', 'a12thexpress@gmail.com', '9892468453', '3b6066c2eb5cc02805f73cb0144b41c3', 'Male', '', 'A12 Express', 'Kandivali West\r\nMumbai', '2021-06-17 13:09:42', '2021-06-17 07:39:42', 1),
(14, 'CUST', 1, 'Chaitra', 'A', 'chaitra12@yahoo.com', '7777777777', '202cb962ac59075b964b07152d234b70', 'Female', '', '', 'Flat No, Apartment Name, Street Name,\r\nLandmark Location, Area Name,\r\nCity Name, State, Country', '2022-02-24 08:52:04', '2022-02-24 03:22:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `b_date` varchar(15) DEFAULT 'NULL',
  `b_time` time NOT NULL,
  `awb` varchar(100) NOT NULL,
  `forwarding` varchar(100) DEFAULT NULL,
  `ref` varchar(100) DEFAULT NULL,
  `service_type` varchar(10) NOT NULL,
  `content_type` varchar(10) NOT NULL,
  `content_desc` varchar(200) NOT NULL,
  `pieces` int(10) NOT NULL,
  `base_rate` float(10,2) NOT NULL,
  `covid_rate` float(10,2) NOT NULL,
  `fuel_rate` float(10,2) NOT NULL,
  `extra_charge` float(10,2) NOT NULL,
  `select_gst` varchar(10) NOT NULL,
  `gst_rate` float(10,2) NOT NULL,
  `total_charge` float(10,2) NOT NULL,
  `consignor_name` varchar(50) NOT NULL,
  `consignor_cperson` varchar(50) NOT NULL,
  `consignor_email` varchar(50) NOT NULL,
  `consignor_phone` varchar(20) NOT NULL,
  `consignor_address` mediumtext NOT NULL,
  `consignor_address2` mediumtext NOT NULL,
  `consignor_address3` mediumtext NOT NULL,
  `consignor_country` varchar(50) NOT NULL,
  `consignor_state` varchar(50) NOT NULL,
  `consignor_city` varchar(50) NOT NULL,
  `consignor_zip` varchar(10) NOT NULL,
  `consignor_doc_type` varchar(20) NOT NULL,
  `consignor_doc` varchar(100) NOT NULL,
  `consignee_name` varchar(50) NOT NULL,
  `consignee_cperson` varchar(50) NOT NULL,
  `consignee_email` varchar(50) NOT NULL,
  `consignee_phone` varchar(20) NOT NULL,
  `consignee_address` mediumtext NOT NULL,
  `consignee_address2` mediumtext NOT NULL,
  `consignee_address3` mediumtext NOT NULL,
  `consignee_country` varchar(50) NOT NULL,
  `consignee_state` varchar(50) NOT NULL,
  `consignee_city` varchar(50) NOT NULL,
  `consignee_zip` varchar(10) NOT NULL,
  `remarks` mediumtext NOT NULL,
  `shipping_status` enum('Not Received','Received') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `user_id`, `b_date`, `b_time`, `awb`, `forwarding`, `ref`, `service_type`, `content_type`, `content_desc`, `pieces`, `base_rate`, `covid_rate`, `fuel_rate`, `extra_charge`, `select_gst`, `gst_rate`, `total_charge`, `consignor_name`, `consignor_cperson`, `consignor_email`, `consignor_phone`, `consignor_address`, `consignor_address2`, `consignor_address3`, `consignor_country`, `consignor_state`, `consignor_city`, `consignor_zip`, `consignor_doc_type`, `consignor_doc`, `consignee_name`, `consignee_cperson`, `consignee_email`, `consignee_phone`, `consignee_address`, `consignee_address2`, `consignee_address3`, `consignee_country`, `consignee_state`, `consignee_city`, `consignee_zip`, `remarks`, `shipping_status`, `timestamp`, `status`) VALUES
(1, 7, '2021-02-27', '00:00:00', '16144264761', '1879517021', '', 'DHL', 'Document', 'dox', 1, 0.00, 0.00, 0.00, 0.00, '0', 0.00, 0.00, 'darshan', 'darshan', 'abc@gmail.com', '9820234535', 'mulund', '', '', 'India', 'maharashtra', 'mumbai', '400099', 'Pan Card', '', 'zsadszc', 'czx', 'prasaddeokar@gmail.com', '9820234535', 'Shop no 5 Bhakti Bldg', '', '', 'United States', 'new york', 'new york', '10001', '', 'Received', '2021-04-24 13:09:21', 1),
(20, 6, '2021-07-09', '17:15:06', '16258311061', '888805210', '', 'Self', 'Parcel', 'SWING', 1, 0.00, 0.00, 0.00, 0.00, '18', 0.00, 0.00, 'HAKIM TURAB KAPADIA 			', 'SUSHIL GUPTA', '', '', 'B -10 TWINKLE APT 			LOKHANDWALA COMPLEX OPP KAMAT CLUB 			ANDHERI 			', '', '', 'India', 'MAHARASHTRA', 'MUMBAI', '400053', 'Aadhar Card', '319318653125', 'RAVINDRAN SUBRAMANIAM 			', 'RAVINDRAN SUBRAMANIAM 			', '', '60193237396			', 'NO 6 JALAN BUKIT SETIAWANGSA 6		TAMAN SETIAWANGSA 			KUALA LUMPUR - 54200', '', '', 'Malaysia', 'KULALAMPUR', 'KULALAMPUR', '45200', '', 'Received', '2021-07-09 11:45:06', 1),
(9, 2, '2021-03-23', '00:00:00', '16164976991', '', '987897977', 'DHL', 'Document', 'jhhkhkj', 1, 100.00, 0.00, 0.00, 0.00, '18', 18.00, 118.00, 'juy', 'trt', 'tyr', '1y5', 'mnm', '', '', 'India', 'Maharashtra', 'Mumbai', '400004', 'Pan Card', '', 'jnhjhj', 'kjjjhjh', 'kjhh', 'kjhhj', 'kjhkj', '', '', 'India', 'Maharashtra', 'Mumbai', 'WC2N 5DU', '', 'Not Received', '2021-04-24 13:09:21', 1),
(10, 9, '2021-03-31', '00:00:00', '16171936711', '888736053', '', 'DHL Parcel', 'Parcel', 'CLOTHES', 1, 1000.00, 0.00, 0.00, 0.00, '0', 0.00, 1000.00, 'SHABBIR GHADIWALA', 'SHABBIR', 'XYZ@XYZ.COM', '9820234535', 'FLAT 7 SILVER SKY, TAKLI ROAD, NASIK', '', '', 'India', 'MAHARASHTRA', 'NASIK', '422011', 'Aadhar Card', '849765070790', 'HUSENA', 'HUSENA', 'ABC@ABC.COM', '+447462209552', '73 PARKHILL DRIVE ALLERTON BRADFORD', '', '', 'United Kingdom', 'WEST YORKSHIRE', 'BRADFORD', 'BD80DE', '', 'Not Received', '2021-04-24 13:09:21', 1),
(21, 1, '2022-02-24', '08:15:08', '16456707081', '2222222222222222', '1111111111111', 'DHL', 'Document', 'papers', 1, 20.00, 10.00, 10.00, 10.00, '0', 0.00, 50.00, 'chaitra', 'chaitra', 'chaitra12@yahoo.com', '9876543210', 'Apt, Street, Area, City, State, Country', '', '', 'India', 'Maharashtra', 'mumbai', '400020', 'Aadhar Card', '858585858585', 'yash mehta', 'yash', 'yashm30@gmail.com', '9876543210', 'Apt, Street, Area, City, State, Country', '', '', 'India', 'Maharashtra', 'mumbai', '400020', 'none', 'Not Received', '2022-02-24 02:45:08', 1),
(22, 6, '2022-02-24', '08:28:33', '16456715132', '', '5555555555555', 'DHL', 'Document', 'papers', 2, 0.00, 0.00, 0.00, 0.00, '0', 0.00, 0.00, 'Prakash Rathi', 'prakash', 'rahul@gmail.com', '9876543210', 'Mangalwal peth near gokul college, kolhapur', '', '', 'India', 'Maharashtra', 'kolhapur', '416012', 'Aadhar Card', '999966669999', 'ankur rathi', 'ankur', 'rahul@gmail.com', '08329515281', 'Mangalwal peth near gokul college, kolhapur', '', '', 'India', 'Maharashtra', 'kolhapur', '416012', 'handle with care', 'Received', '2022-02-24 02:58:33', 1),
(23, 14, '2022-08-10', '21:55:23', '16601487231', '', '', 'Self', 'Document', '', 1, 100.00, 50.00, 50.00, 50.00, '18', 36.00, 286.00, 'Chaitra', '', 'localtest80@gmail.com', '+919876543210', 'abc', '', '', 'India', 'Maharashtra', 'mumbai', '400020', 'Pan Card', 'XXXXX0000X', 'Chaitra', '', 'localtest80@gmail.com', '+919876543210', 'abc', '', '', 'India', 'Maharashtra', 'mumbai', '400020', '', 'Not Received', '2022-08-10 16:25:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_parcel`
--

CREATE TABLE `shipping_parcel` (
  `id` int(11) NOT NULL,
  `awb_no` varchar(50) NOT NULL,
  `piece_no` varchar(50) NOT NULL,
  `actual_weight` float(10,2) NOT NULL,
  `length` float(10,2) NOT NULL,
  `breadth` float(10,2) NOT NULL,
  `height` float(10,2) NOT NULL,
  `volume_weight` float(10,2) NOT NULL,
  `charge_weight` float(10,2) NOT NULL,
  `total_weight` float(10,2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_parcel`
--

INSERT INTO `shipping_parcel` (`id`, `awb_no`, `piece_no`, `actual_weight`, `length`, `breadth`, `height`, `volume_weight`, `charge_weight`, `total_weight`, `timestamp`, `status`) VALUES
(1, '16144264761', '1', 0.50, 0.00, 0.00, 0.00, 0.00, 0.50, 0.50, '2021-02-27 11:47:56', 1),
(9, '16164976991', '1', 4.00, 55.00, 44.00, 55.00, 26.62, 26.62, 26.62, '2021-03-23 11:08:19', 1),
(10, '16171936711', '1', 25.90, 30.00, 30.00, 30.00, 5.40, 25.90, 25.90, '2021-03-31 12:27:51', 1),
(20, '16258311061', '1', 57.00, 27.00, 77.00, 136.00, 56.55, 57.00, 57.00, '2021-07-09 11:45:06', 1),
(21, '16456707081', '1', 20.00, 20.00, 1.00, 40.00, 0.16, 20.00, 20.00, '2022-02-24 02:45:08', 1),
(22, '16456707081', '2', 20.00, 20.00, 1.00, 40.00, 0.16, 20.00, 20.00, '2022-02-24 02:45:08', 1),
(23, '16456715132', '1', 20.00, 20.00, 1.00, 40.00, 0.16, 20.00, 20.00, '2022-02-24 02:58:33', 1),
(24, '16456715132', '2', 20.00, 20.00, 1.00, 40.00, 0.16, 20.00, 20.00, '2022-02-24 02:58:33', 1),
(25, '16601487231', '1', 100.00, 0.00, 0.00, 0.00, 0.00, 100.00, 100.00, '2022-08-10 16:25:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_progress`
--

CREATE TABLE `shipping_progress` (
  `id` int(11) NOT NULL,
  `shipping_id` int(10) NOT NULL,
  `progress_date` date NOT NULL,
  `progress_location` varchar(100) NOT NULL,
  `progress_time` varchar(10) NOT NULL,
  `progress_details` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_progress`
--

INSERT INTO `shipping_progress` (`id`, `shipping_id`, `progress_date`, `progress_location`, `progress_time`, `progress_details`, `status`, `timestamp`) VALUES
(1, 18, '2021-06-16', 'Mumbai', '1305', 'In Transit', 1, '2021-06-17 07:36:11'),
(2, 18, '2021-06-17', 'USA', '0305', 'Shipment  Received', 1, '2021-06-17 07:36:34'),
(3, 20, '2021-07-08', 'Mumbai', '14:55', 'Shipment Received', 1, '2021-07-09 11:46:16'),
(4, 20, '2021-07-08', 'Mumbai', '17:30', 'in transit to destination', 1, '2021-07-09 11:46:48'),
(5, 22, '2022-02-24', 'Kolhapur', '09:00', 'Shipment Received', 1, '2022-02-24 03:00:28'),
(6, 22, '2022-02-24', 'Kolhapur', '11:00', 'In Transit', 1, '2022-02-24 03:01:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_admin`
--
ALTER TABLE `master_admin`
  ADD PRIMARY KEY (`master_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_parcel`
--
ALTER TABLE `shipping_parcel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_progress`
--
ALTER TABLE `shipping_progress`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_admin`
--
ALTER TABLE `master_admin`
  MODIFY `master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `shipping_parcel`
--
ALTER TABLE `shipping_parcel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `shipping_progress`
--
ALTER TABLE `shipping_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
