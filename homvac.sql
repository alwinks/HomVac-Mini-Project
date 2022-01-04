-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2022 at 11:59 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homvac`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_username` varchar(15) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_status` varchar(10) NOT NULL,
  PRIMARY KEY  (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_status`) VALUES
(1, 'Admin', '2bB@2bB@', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `member_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `member_name` varchar(25) NOT NULL,
  `member_gender` varchar(6) NOT NULL,
  `member_dob` date NOT NULL,
  `member_proof_type` varchar(20) NOT NULL,
  `member_proof_photo` varchar(255) NOT NULL,
  `member_status` varchar(10) NOT NULL,
  PRIMARY KEY  (`member_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`member_id`, `user_id`, `member_name`, `member_gender`, `member_dob`, `member_proof_type`, `member_proof_photo`, `member_status`) VALUES
(1, 1, 'Ana Trujillo', 'Female', '2021-06-08', 'Birth Certificate', '1630731599.jpg', 'Active'),
(2, 2, 'Christina Berglund', 'Female', '2021-05-20', 'Birth Certificate', '1630731599.jpg', 'Active'),
(3, 1, 'Patricio Simpson', 'Male', '2021-09-13', 'Birth Certificate', '1630731599.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL auto_increment,
  `place_name` varchar(25) NOT NULL,
  `place_status` varchar(10) NOT NULL,
  PRIMARY KEY  (`place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `place_status`) VALUES
(1, 'Thrikkariyoor', 'Active'),
(3, 'Kedavoor', 'Active'),
(5, 'Eramalloor (CT)', 'Active'),
(6, 'Keerampara', 'Active'),
(7, 'Kottappady', 'Active'),
(8, 'Kuttamangalam', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL auto_increment,
  `place_id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_house` varchar(20) NOT NULL,
  `user_landmark` varchar(100) NOT NULL,
  `user_mobile` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_status` varchar(10) NOT NULL,
  PRIMARY KEY  (`user_id`),
  KEY `place_id` (`place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `place_id`, `user_name`, `user_house`, `user_landmark`, `user_mobile`, `user_password`, `user_status`) VALUES
(1, 5, 'Maria Anders', 'Mill House', 'Obere Str. 7', '9876543210', '1aA!1aA!', 'Active'),
(2, 6, 'Thomas Hardy', 'Woodlands', '120 Hanover Sq.', '7654321098', '3cC#3cC#', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccination`
--

CREATE TABLE `tbl_vaccination` (
  `vaccination_id` int(11) NOT NULL auto_increment,
  `place_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `vaccinator_id` int(11) NOT NULL,
  `vaccination_date` date NOT NULL,
  `vaccination_time` varchar(255) NOT NULL,
  `vaccination_status` varchar(15) NOT NULL,
  `vaccinated_date` date NOT NULL,
  `vaccinated_time` time NOT NULL,
  PRIMARY KEY  (`vaccination_id`),
  KEY `user_id` (`user_id`),
  KEY `member_id` (`member_id`),
  KEY `vaccine_id` (`vaccine_id`),
  KEY `vaccinator_id` (`vaccinator_id`),
  KEY `place_id` (`place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_vaccination`
--

INSERT INTO `tbl_vaccination` (`vaccination_id`, `place_id`, `user_id`, `member_id`, `vaccine_id`, `vaccinator_id`, `vaccination_date`, `vaccination_time`, `vaccination_status`, `vaccinated_date`, `vaccinated_time`) VALUES
(1, 5, 1, 1, 1, 1, '2021-12-21', '10:30 AM - 11:30 AM', 'Vaccinated', '2021-12-20', '22:18:21'),
(2, 6, 2, 2, 2, 1, '2021-12-01', '02:30 PM - 03:30 PM', 'Pending', '0000-00-00', '00:00:00'),
(3, 5, 1, 3, 2, 1, '2021-12-25', '01:30 PM - 02:30 PM', 'Vaccinated', '2021-12-21', '10:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccinator`
--

CREATE TABLE `tbl_vaccinator` (
  `vaccinator_id` int(11) NOT NULL auto_increment,
  `place_id` int(11) NOT NULL,
  `vaccinator_name` varchar(25) NOT NULL,
  `vaccinator_mobile` varchar(100) NOT NULL,
  `vaccinator_password` varchar(255) NOT NULL,
  `vaccinator_status` varchar(15) NOT NULL,
  PRIMARY KEY  (`vaccinator_id`),
  KEY `place_id` (`place_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_vaccinator`
--

INSERT INTO `tbl_vaccinator` (`vaccinator_id`, `place_id`, `vaccinator_name`, `vaccinator_mobile`, `vaccinator_password`, `vaccinator_status`) VALUES
(1, 1, 'Antonio Moreno', '8765432109', '4dD$4dD$', 'Verified'),
(2, 7, 'Hanna Moos', '6543210987', '5eE%5eE%', 'Non-verified');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccine`
--

CREATE TABLE `tbl_vaccine` (
  `vaccine_id` int(11) NOT NULL auto_increment,
  `vaccine_age` varchar(15) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `vaccine_status` varchar(10) NOT NULL,
  PRIMARY KEY  (`vaccine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_vaccine`
--

INSERT INTO `tbl_vaccine` (`vaccine_id`, `vaccine_age`, `vaccine_name`, `vaccine_status`) VALUES
(1, '6 weeks', 'OPV-1, Pentavalent-1, RVV-1, fIPV-1', 'Active'),
(2, '10 weeks', 'OPV-2, Pentavalent-2, RVV-2', 'Active'),
(3, '14 weeks', 'OPV-2, Pentavalent-3, RVV-3, fIPV-2', 'Active'),
(4, '9-12 months', 'MR-1', 'Active'),
(5, '16-24 months', 'MR-2, DPT-Booster-1, OPV-Booster', 'Active'),
(6, '5-6 years', 'DPT-Booster-2', 'Active'),
(7, '10 years', 'Td', 'Active'),
(8, '16 years', 'Td', 'Active'),
(9, 'Pregnant Mother', 'Td-1, Td-2 or Td-Booster', 'Active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD CONSTRAINT `tbl_member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `tbl_place` (`place_id`);

--
-- Constraints for table `tbl_vaccination`
--
ALTER TABLE `tbl_vaccination`
  ADD CONSTRAINT `tbl_vaccination_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_vaccination_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `tbl_member` (`member_id`),
  ADD CONSTRAINT `tbl_vaccination_ibfk_3` FOREIGN KEY (`vaccine_id`) REFERENCES `tbl_vaccine` (`vaccine_id`),
  ADD CONSTRAINT `tbl_vaccination_ibfk_4` FOREIGN KEY (`vaccinator_id`) REFERENCES `tbl_vaccinator` (`vaccinator_id`),
  ADD CONSTRAINT `tbl_vaccination_ibfk_5` FOREIGN KEY (`place_id`) REFERENCES `tbl_place` (`place_id`);

--
-- Constraints for table `tbl_vaccinator`
--
ALTER TABLE `tbl_vaccinator`
  ADD CONSTRAINT `tbl_vaccinator_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `tbl_place` (`place_id`);
