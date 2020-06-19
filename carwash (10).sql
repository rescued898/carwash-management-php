-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 11:34 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(2, 'admin', '12345', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `id` int(11) NOT NULL,
  `invoice_number` int(100) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `contact_num` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `packageid` int(11) DEFAULT NULL,
  `totalprice` int(100) DEFAULT NULL,
  `bookingdate` varchar(20) DEFAULT NULL,
  `timeslot` varchar(20) DEFAULT NULL,
  `cartype` text DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `payment_opt` text DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `service` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`id`, `invoice_number`, `userEmail`, `contact_num`, `address`, `packageid`, `totalprice`, `bookingdate`, `timeslot`, `cartype`, `message`, `Status`, `payment_opt`, `PostingDate`, `service`) VALUES
(70, 896098002, 'user@gmail.com', '12569879', '6666', 19, 1240, '2020-02-27', '6-7', 'Truck', '', 2, 'Online', '2020-02-27 09:48:14', 'Pickup'),
(71, 2062409532, 'user@gmail.com', '12569879', '6666', 20, 440, '2020-03-11', '1-2', 'Car', '', 1, 'cash', '2020-03-06 19:47:09', 'Self'),
(72, 173911390, 'raisa.sandhi@gmail.com', '0', '', 19, 1240, '2020-03-19', '1-2', 'Truck', '', 1, 'Online', '2020-03-06 19:49:02', 'Pickup'),
(73, 1048670486, 'kausar@gmail.com', '0`52121829', 'Bashundhara,Dhaka, 229', 22, 1440, '2020-03-17', '3-4', 'Car', 'I need some extra service', 1, 'Online', '2020-03-07 19:28:48', 'Pickup'),
(74, 853368290, '1@gmail.com', '9092191659', '', 19, 740, '2020-05-30', '2-3', 'Car', '', 1, 'Online', '2020-05-03 15:46:45', 'Pickup'),
(75, 399929694, 'kausar@gmail.com', '0`52121829', '', 22, 1440, '2020-06-19', '1-2', 'Car', '', 1, 'Online', '2020-06-18 08:49:53', 'Pickup');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'Test Demo test demo																									', 'test@test.com', '8585233222');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'Harry Den', 'webhostingamigo@gmail.com', '2147483647', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2017-06-18 10:03:07', 1),
(2, 'Kausar Islam', 'RachelCSherman@armyspy.com', '9092191659', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a', '2020-03-07 18:50:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpackage`
--

CREATE TABLE `tblpackage` (
  `id` int(20) NOT NULL,
  `packagetitle` varchar(200) DEFAULT NULL,
  `service_type` text DEFAULT NULL,
  `service_quality` text DEFAULT NULL,
  `requiredtime` int(100) DEFAULT NULL,
  `image1` varchar(200) DEFAULT NULL,
  `image2` varchar(200) DEFAULT NULL,
  `image3` varchar(200) DEFAULT NULL,
  `image4` varchar(200) DEFAULT NULL,
  `image5` varchar(200) DEFAULT NULL,
  `TiresShined` int(200) DEFAULT NULL,
  `packageoverview` longtext DEFAULT NULL,
  `CompleteCarExteriorCleaning` int(11) DEFAULT NULL,
  `Exterirorcarwash` int(11) DEFAULT NULL,
  `Ecoglassclean` int(11) DEFAULT NULL,
  `Wheelclean` int(11) DEFAULT NULL,
  `Cleanfrontgrill` int(11) DEFAULT NULL,
  `CleanTire` int(11) DEFAULT NULL,
  `Completeinteriorvaccuming` int(11) DEFAULT NULL,
  `LeatherTreated` int(11) DEFAULT NULL,
  `price1` int(11) DEFAULT NULL,
  `price2` int(11) DEFAULT NULL,
  `price3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpackage`
--

INSERT INTO `tblpackage` (`id`, `packagetitle`, `service_type`, `service_quality`, `requiredtime`, `image1`, `image2`, `image3`, `image4`, `image5`, `TiresShined`, `packageoverview`, `CompleteCarExteriorCleaning`, `Exterirorcarwash`, `Ecoglassclean`, `Wheelclean`, `Cleanfrontgrill`, `CleanTire`, `Completeinteriorvaccuming`, `LeatherTreated`, `price1`, `price2`, `price3`) VALUES
(19, 'INTERIOR CLASSIC', 'WATERLESS', 'PREMIUM', 1, 'ia_100000034.jpeg', 'ia_100000033.jpeg', 'ia_100000034.jpeg', 'ia_100000036.jpeg', 'ia_100000035.jpeg', 1, 'This is a deep cleaning procedure for the interiors of the car. All kinds of stains and marks will be removed during this procedure, giving an enriched and new feel to the interiors of the car. Starting with the roof of the car, The dashboard, door pads, seats hand brake gear area, and the floor will be cleaned using a cleaners and brushes ensuring a stain free interior. Enjoy the experience!', 1, NULL, 1, 1, NULL, 1, 1, NULL, 500, 1000, 1500),
(20, 'INTERIOR CLASSIC', 'WAX', 'PREMIUMPLUS', 1, 'ia_100000084.jpg', 'ia_100000045.jpeg', 'ia_100000040.jpeg', 'ia_100000041.jpeg', 'ia_100000033.jpeg', 1, 'This is a deep cleaning procedure for the interiors of the car. All kinds of stains and marks will be removed during this procedure, giving an enriched and new feel to the interiors of the car. Starting with the roof of the car, The dashboard, door pads, seats hand brake gear area, and the floor will be cleaned using a cleaners and brushes ensuring a stain free interior. Enjoy the experience!', 1, 1, 1, 1, 1, 1, 1, 1, 600, 1000, 1500),
(22, 'Tidy & Secure', 'WATER', 'PREMIUM', 40, 'ia_100000060.jpg', 'ia_100000102.jpg', 'ia_100000125.jpg', 'ia_100000209.jpg', 'ia_100000040.jpeg', 1, 'Car Cleaning, Polish & Protection', 1, 1, NULL, 1, 1, NULL, 1, 1, 1200, 1500, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Terms and Conditions', 'terms', '<P align=justify><FONT size=2><STRONG><FONT color=#990000>(1) ACCEPTANCE OF TERMS</FONT><BR><BR></STRONG>Welcome to Yahoo! India. 1Yahoo Web Services India Private Limited Yahoo\", \"we\" or \"us\" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: <A href=\"http://in.docs.yahoo.com/info/terms/\">http://in.docs.yahoo.com/info/terms/</A>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>\r\n<P align=justify><FONT size=2>Welcome to Yahoo! India. Yahoo Web Services India Private Limited Yahoo\", \"we\" or \"us\" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: </FONT><A href=\"http://in.docs.yahoo.com/info/terms/\"><FONT size=2>http://in.docs.yahoo.com/info/terms/</FONT></A><FONT size=2>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>\r\n<P align=justify><FONT size=2>Welcome to Yahoo! India. Yahoo Web Services India Private Limited Yahoo\", \"we\" or \"us\" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: </FONT><A href=\"http://in.docs.yahoo.com/info/terms/\"><FONT size=2>http://in.docs.yahoo.com/info/terms/</FONT></A><FONT size=2>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>'),
(2, 'Privacy Policy', 'privacy', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(3, 'About Us ', 'aboutus', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(11, 'FAQs', 'faqs', '																														<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Address------Test &nbsp; &nbsp;dsfdsfds</span>');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `payment_id` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `payment_mode` text NOT NULL,
  `trans_no` text NOT NULL,
  `ref_id` text NOT NULL,
  `payment_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`payment_id`, `invoice_no`, `amount`, `payment_mode`, `trans_no`, `ref_id`, `payment_date`) VALUES
(8, 1852897340, 8118, 'Bcash', '32653698', '326565', '2-25-2020'),
(9, 57543978, 300, 'Ucash', '264564', 'eqwewq', '5498659'),
(10, 2856100, 900, 'Bcash', '264564', 'eqwewq', '5498659'),
(11, 896098002, 900, 'Bcash', '264564', 'eqwewq', '458'),
(12, 1048670486, 1440, 'Rocket', '264564', 'eqwewq', '12154');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscribers`
--

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubscribers`
--

INSERT INTO `tblsubscribers` (`id`, `SubscriberEmail`, `PostingDate`) VALUES
(1, 'anuj.lpu1@gmail.com', '2017-06-22 16:35:32'),
(4, '12@gmail.com', '2020-02-24 14:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbltecnician`
--

CREATE TABLE `tbltecnician` (
  `id` int(100) NOT NULL,
  `tec_name` varchar(100) DEFAULT NULL,
  `tec_contact` varchar(100) DEFAULT NULL,
  `tec_email` varchar(100) DEFAULT NULL,
  `tec_address` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltecnician`
--

INSERT INTO `tbltecnician` (`id`, `tec_name`, `tec_contact`, `tec_email`, `tec_address`) VALUES
(1, 'Abir', '8888888', 'Abir@gmail.com', 'ttttt'),
(3, 'Alvi', '44384329', 'RachelCSherman@armyspy.com', '3824 Fairfax Drive');

-- --------------------------------------------------------

--
-- Table structure for table `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `Testimonial` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltestimonial`
--

INSERT INTO `tbltestimonial` (`id`, `UserEmail`, `Testimonial`, `PostingDate`, `status`) VALUES
(1, 'test@gmail.com', 'Test Test', '2017-06-18 07:44:31', 1),
(2, 'test@gmail.com', '\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilis', '2017-06-18 07:46:05', 1),
(4, 'user@gmail.com', '\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilis', '2020-02-25 14:13:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(6, 'Kausar Islam', 'user@gmail.com', '12345', '012569879', '999', '6666', '', '2222', '2020-02-19 08:43:56', '2020-02-27 11:10:15'),
(7, 'Raisa', 'raisa.sandhi@gmail.com', '123456', 'Sandhi', NULL, NULL, NULL, NULL, '2020-02-26 06:20:45', NULL),
(8, 'Kausar Islam', 'kausar@gmail.com', '12345', '0`52121829', '', 'bashundhara', 'Dhaka', 'Bangladesh', '2020-03-07 19:27:20', '2020-06-18 08:51:29'),
(9, 'Kausar Islam', '1@gmail.com', '12345', '9092191659', NULL, NULL, NULL, NULL, '2020-05-03 15:45:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblwork_order`
--

CREATE TABLE `tblwork_order` (
  `id` int(100) NOT NULL,
  `invoice_no` int(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `product_id` int(100) DEFAULT NULL,
  `technician_id` int(100) DEFAULT NULL,
  `package_id` int(100) DEFAULT NULL,
  `appointment_date` varchar(255) DEFAULT NULL,
  `appointment_time` varchar(255) DEFAULT NULL,
  `order_status` int(100) DEFAULT NULL,
  `assign_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblwork_order`
--

INSERT INTO `tblwork_order` (`id`, `invoice_no`, `customer_email`, `product_id`, `technician_id`, `package_id`, `appointment_date`, `appointment_time`, `order_status`, `assign_date`) VALUES
(53, 896098002, 'user@gmail.com', NULL, 1, 19, '2020-02-27', '6-7', 1, '2020-03-07 10:50:25'),
(54, 2062409532, 'user@gmail.com', NULL, 1, 20, '2020-03-11', '1-2', 1, '2020-03-07 10:50:33'),
(55, 173911390, 'raisa.sandhi@gmail.com', NULL, 1, 19, '2020-03-19', '1-2', 1, '2020-03-07 10:50:40'),
(56, 1048670486, 'kausar@gmail.com', NULL, 3, 22, '2020-03-17', '3-4', 0, '2020-03-07 19:34:46'),
(57, 853368290, '1@gmail.com', NULL, 1, 19, '2020-05-30', '2-3', 0, '2020-05-03 15:48:33'),
(58, 399929694, 'kausar@gmail.com', NULL, 1, 22, '2020-06-19', '1-2', 0, '2020-06-18 09:18:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpackage`
--
ALTER TABLE `tblpackage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltecnician`
--
ALTER TABLE `tbltecnician`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblwork_order`
--
ALTER TABLE `tblwork_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpackage`
--
ALTER TABLE `tblpackage`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbltecnician`
--
ALTER TABLE `tbltecnician`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblwork_order`
--
ALTER TABLE `tblwork_order`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
