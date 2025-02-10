-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 04:51 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ohmsphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `adminname` varchar(25) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  `usertype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `loginid`, `password`, `status`, `usertype`) VALUES
(1, 'Daniel Christopher', 'admin', 'Password@123', 'Active', '');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `problemid` int(10) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'ONLINE',
  `userid` int(10) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `volunteerid` int(10) NOT NULL,
  `panchayatrajid` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `pro_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`problemid`, `type`, `userid`, `departmentid`, `date`, `time`, `volunteerid`, `panchayatrajid`, `status`, `pro_reason`) VALUES
(1, 'online', 1, 1, '2019-06-17', '03:00:00', 1, 1, 'Approved', 'Our elders are not receiving their pensions on time, which makes it hard for them to meet their basic needs and live with dignity'),
(2, 'online', 3, 2, '2021-06-25', '09:22:00', 2, 2, 'Approved', 'We often go without clean drinking water, and during the dry season, we worry about having enough water for our crops and daily needs.'),
(4, 'online', 5, 4, '2021-06-24', '14:28:00', 4, 4, 'Approved', 'We have to travel many miles to see a doctor, and even then, there aren''t enough medicines or equipment to treat us properly.'),
(5, 'online', 6, 7, '2021-06-24', '11:18:00', 7, 7, 'Approved', 'Women here still struggle to get an education or own land, and they don''t have as many opportunities to earn an income.'),
(6, 'online', 7, 3, '2022-10-22', '10:20:00', 3, 3, 'Approved', 'The roads here are in terrible condition, making it difficult to reach the market or the hospital, especially during the rainy season.'),
(8, 'online', 9, 7, '2022-10-26', '20:00:00', 10, 10, 'Approved', 'Women here still struggle to get an education or own land, and they don''t have as many opportunities to earn an income.'),
(9, 'online', 11, 5, '2022-10-27', '20:30:00', 5, 5, 'Approved', 'It''s difficult to get a loan from the bank, and we aren''t familiar with how to access government schemes that could help us.'),
(10, 'online', 12, 3, '2022-11-04', '21:44:00', 13, 13, 'Approved', 'Our homes can''t withstand storms, and when disaster strikes, we have to rebuild with our limited resources.'),
(11, 'online', 13, 8, '2022-11-04', '21:48:00', 8, 8, 'Approved', 'We are setting up mobile libraries and conducting evening classes to help children catch up on their studies, while advocating for better educational facilities.'),
(12, 'online', 14, 6, '2022-11-05', '14:58:00', 6, 6, 'Approved', 'Our crops keep failing because of unpredictable weather, and without proper irrigation or support, we are struggling to feed our families.'),
(14, 'online', 17, 9, '2022-11-13', '21:19:00', 9, 9, 'Approved', 'There aren''t enough jobs here apart from farming, and many of our young people have had to move to the city to make a living.');



-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentid` int(10) NOT NULL,
  `departmentname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentid`, `departmentname`, `description`, `status`) VALUES
(1, 'Rural Pension Administration Department ', 'The Rural Pension Administration Department (RPAD) ensures the timely distribution of pension benefits to eligible villagers, enhancing their financial security. Our commitment is to empower rural communities through efficient management of pension schemes.', 'Active'),
(2, 'Village Water and Sanitation Committee', 'The Village Water and Sanitation Committee (GPWSC/VWSC) is a standing committee that plans, monitors, implements, and maintains water supply schemes in Gram Panchayats. ', 'Active'),
(3, ' Rural Development Department', 'The Rural Development Department are responsible for the construction, maintenance, and repair of roads within the village administrative area.', 'Active'),
(4, ' Village Health Committee', 'The Village Health Committee/ Gram Sabha, which is responsible for planning, monitoring, and provisioning of primary healthcare services at the grassroots level.', 'Active'),
(5, 'Panchayat education committee', 'The Panchayat education committee  be in-charge of all educational activities of the Zilla Panchayat', 'Active'),
(6, 'Department of Agriculture ', 'The Department of Agriculture has been created mainly to provide Agricultural Extension services to farmers and to transfer the latest technical knowledge to the farming community.', 'Active'),
(7, 'Mahila Kisan Sashaktikaran Pariyojana', 'The Mahila Kisan Sashaktikaran Pariyojana aimed at empowering women farmers by providing them with training, credit, and other resources.', 'Active'),
(8, 'Child Welfare Committee ', 'CWC is responsible for ensuring the well-being and protection of children in rural areas and it aldso key services like Child Protection,Child Education,Child Health and Child Development', 'Active'),
(9, 'National Rural Livelihood Mission', 'The National Rural Livelihood Mission focuses on promoting livelihoods and employment opportunities for rural households, particularly those in poverty.', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `volunteerid` int(10) NOT NULL,
  `volunteername` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`volunteerid`, `volunteername`, `mobileno`, `departmentid`, `loginid`, `password`, `status`) VALUES
(1, 'Srinivas', '7002225650', 1, 'srinu', 'password', 'Active'),
(2, 'RaviMantri', '7023695696', 2, 'ravi', 'password', 'Active'),
(3, 'Raghava Rao', '7014545470', 3, 'raghava', 'password', 'Active'),
(4, 'Ramana', '7025558690', 4, 'ramana', 'password', 'Active'),
(5, 'Sathya Narayana', '7854025410', 5, 'sathya', 'password', 'Active'),
(6, 'Ramesh', '7410002540', 6, 'ramesh', 'password', 'Active'),
(7, 'Santhosh', '7012569990', 7, 'santhosh', 'password', 'Active'),
(8, 'Suresh', '7012225470', 8, 'suri', 'password', 'Active'),
(9, 'Basvayya', '1234567890', 9, 'basvayya', '1234567890', 'Active'),
(10, 'Ramarao', '1234567890', 7, 'ramarao', 'ramarao172@', 'Active'),
(11, 'Seethayya', '1234567890', 4, 'seetha', '172@', 'Active'),
(12, 'Nareshwarao', '1234567890', 6, 'naresh', 'naresh172@', 'Active'),
(13, 'Veerayya', '23456789809', 7, 'veera', 'veera172@', 'Active'),
(14, 'Daanayya', '1234567890', 2, 'dana', 'dana172@', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `panchayatraj`
--

CREATE TABLE `panchayatraj` (
  `panchayatrajid` int(10) NOT NULL,
  `panchayatrajname` varchar(50) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panchayatraj`
--

INSERT INTO `panchayatraj` (`panchayatrajid`, `panchayatrajname`, `mobileno`, `departmentid`, `loginid`, `password`, `status`) VALUES
(1, 'Chandram', '7002225650', 1, 'chandram', 'password', 'Active'),
(2, 'Lingesham', '7023695696', 2, 'linga', 'password', 'Active'),
(3, 'Surya ', '7014545470', 3, 'surya', 'password', 'Active'),
(4, 'Narayana', '7025558690', 4, 'narayana', 'password', 'Active'),
(5, 'Krishnayya', '7854025410', 5, 'krishna', 'password', 'Active'),
(6, 'Yogi Narayana', '7410002540', 6, 'yogi', 'password', 'Active'),
(7, 'Venkatesh', '7012569990', 7, 'venky', 'password', 'Active'),
(8, 'Nageshwarao', '7012225470', 8, 'nag', 'password', 'Active'),
(9, 'Lakshmi', '1234567890', 9, 'lakshmi', '1234567890', 'Active'),
(10, 'Parvesh', '1234567890', 7, 'parvesh', 'parvesh172@', 'Active'),
(11, 'Mallikarjuna', '1234567890', 4, 'mallikarjuna', 'mallikarjuna172@', 'Active'),
(12, 'Kranthi', '1234567890', 6, 'kranthi', 'kranthi172@', 'Active'),
(13, 'Venkatashwarao', '23456789809', 3, 'venkatesh', 'eren172@', 'Active'),
(14, 'Eeshwar', '1234567890', 2, 'eeshwar', 'eeshwar', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_timings`
--

CREATE TABLE `volunteer_timings` (
  `volunteer_timings_id` int(10) NOT NULL,
  `volunteerid` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer_timings`
--

INSERT INTO `volunteer_timings` (`volunteer_timings_id`, `volunteerid`, `start_time`, `end_time`, `status`) VALUES
(7, 5, '09:30:00', '13:00:00', 'Active'),
(8, 6, '13:30:00', '17:00:00', 'Active'),
(19, 7, '14:00:00', '18:00:00', 'Active'),
(20, 8, '17:00:00', '21:00:00', 'Active'),
(21, 9, '13:00:00', '19:00:00', 'Active'),
(22, 4, '07:00:00', '11:00:00', 'Active'),
(31, 1, '01:02:00', '15:04:00', 'Active'),
(32, 10, '16:25:00', '01:00:00', 'Active'),
(33, 3, '18:00:00', '00:02:00', 'Active'),
(34, 2, '07:36:00', '15:37:00', 'Active'),
(37, 11, '07:00:00', '21:00:00', 'Active'),
(38, 12, '07:16:00', '22:18:00', 'Active'),
(39, 13, '06:21:00', '22:22:00', 'Active');

-- --------------------------------------------------------
--
-- Table structure for table `panchayatraj_timings`
--

CREATE TABLE `panchayatraj_timings` (
  `panchayatraj_timings_id` int(10) NOT NULL,
  `panchayatrajid` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panchayatraj_timings`
--

INSERT INTO `panchayatraj_timings` (`panchayatraj_timings_id`, `panchayatrajid`, `start_time`, `end_time`, `status`) VALUES
(7, 5, '09:30:00', '13:00:00', 'Active'),
(8, 6, '13:30:00', '17:00:00', 'Active'),
(19, 7, '14:00:00', '18:00:00', 'Active'),
(20, 8, '17:00:00', '21:00:00', 'Active'),
(21, 9, '13:00:00', '19:00:00', 'Active'),
(22, 4, '07:00:00', '11:00:00', 'Active'),
(31, 1, '01:02:00', '15:04:00', 'Active'),
(32, 10, '16:25:00', '01:00:00', 'Active'),
(33, 3, '18:00:00', '00:02:00', 'Active'),
(34, 2, '07:36:00', '15:37:00', 'Active'),
(37, 11, '07:00:00', '21:00:00', 'Active'),
(38, 12, '07:16:00', '22:18:00', 'Active'),
(39, 13, '06:21:00', '22:22:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `admissiondate` date NOT NULL,
  `admissiontime` time NOT NULL,
  `address` varchar(250) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `admissiondate`, `admissiontime`, `address`, `mobileno`, `city`, `pincode`, `loginid`, `password`, `bloodgroup`, `gender`, `dob`, `status`) VALUES
(1, 'Narsayya', '2019-06-15', '18:47:22', 'Dhanmondi', '2125798361', 'Dhaka', '1207', 'admin', '123456789', 'O+', 'MALE', '1990-01-01', 'Active'),
(3, 'Rani', '2021-06-24', '14:38:04', '4327 Â Pride Avenue', '7012225690', 'Elmhurst', '63520', 'christine', 'password', 'A-', 'Female', '1992-02-12', 'Active'),
(4, 'Somayya', '2021-06-24', '15:26:32', 'demo address', '7474747474', 'demo city', '65432', 'demo', 'password', 'AB+', 'Male', '1995-02-02', 'Active'),
(5, 'Latha', '2021-06-24', '18:44:22', '1723  Cinnamon Lane', '7023658800', 'San Antonio', '67543', 'thomas', 'password', 'O-', 'Female', '1992-03-12', 'Active'),
(6, 'Lakshmi', '2021-06-24', '19:34:27', '2649 Wayside Lane', '7012225896', 'San Jose', '89762', 'carlos', 'password', 'A+', 'Female', '1994-03-12', 'Active'),
(7, 'Sathyam', '2022-10-21', '16:55:52', 'adc', '1234567890', 'BANGALORE CITY', '87654', 'allwin', '1234567890', 'B-', 'Male', '2014-02-21', 'Active'),
(9, 'Maresh', '2022-10-26', '15:39:55', '14, Krishnappa Layout, R M V 2nd Stage, R M V', '9845154035', 'Bangalore', '56024', 'brian@gmail.com', 'brain172@', 'B+', 'MALE', '1999-02-27', 'Active'),
(11, 'Mallesham', '2022-10-27', '20:30:34', 'konnapaana agrahara', '1234567890', 'BANGALORE CITY', '56432', 'dean@gmail.com', 'dean172@', 'O+', 'Male', '2011-02-27', 'Active'),
(12, 'Paramesh', '2022-11-04', '20:44:29', 'adc', '1234567890', 'BANGALORE CITY', '56124', 'dean@gmail.com', 'dean172@', 'A-', 'Male', '2022-11-04', 'Active'),
(13, 'Narendra', '2022-11-04', '20:47:35', 'adc', '1234567890', 'BANGALORE CITY', '56234', 'dean@gmail.com', 'dean172@', 'A+', 'Male', '2022-11-04', 'Active'),
(14, 'Kalyan', '2022-11-05', '14:57:29', 'adc', '1234567890', 'BANGALORE CITY', '56262', 'john@gmail.com', 'john172@', 'O+', 'Male', '2022-11-05', 'Active'),
(15, 'Anil', '2022-11-09', '12:33:21', 'adc', '1234567890', 'BANGALORE CITY', '56214', 'dean@gmail.com', 'dean172@', 'AB+', 'Male', '2022-11-03', 'Active'),
(16, 'Sairam', '2022-11-09', '19:11:25', 'adc', '1234567890', 'BANGALORE CITY', '56324', 'dean@gmail.com', 'dean172@', 'A+', 'Male', '2022-11-10', 'Active'),
(17, 'Surendra', '2022-11-13', '20:19:02', 'siganshina', '23434546576868', 'wall maria', '560032', 'armin@gmail.com', 'armin172@', 'B+', 'MALE', '2008-02-13', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `action_records`
--

CREATE TABLE `action_records` (
  `action_records_id` int(10) NOT NULL,
  `problemid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `volunteerid` int(10) NOT NULL,
  `panchayatrajid` int(10) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action_records`
--

INSERT INTO `action_records` (`action_records_id`, `problemid`, `userid`, `volunteerid`, `panchayatrajid`, `description`, `date`, `time`, `status`) VALUES
(1, 1, 1, 1, 1, 'We are assisting seniors with the application and documentation process, coordinating with government offices to ensure timely pension disbursal, and raising awareness about their rights to social security benefits.', '2019-06-15', '17:00:00', 'Active'),
(2, 2, 3, 2, 2, 'We are helping dig wells and install rainwater harvesting systems to ensure a reliable water supply for drinking and farming needs.', '2021-06-24', '18:24:00', 'Active'),
(3, 4, 5, 4, 4, 'We are organizing medical camps and partnering with healthcare providers to bring essential medical services closer to your community.', '2021-06-24', '16:40:00', 'Active'),
(4, 5, 6, 7, 7, 'We are empowering women through literacy programs, vocational training, and awareness workshops to ensure equal opportunities.', '2021-06-24', '15:22:00', 'Active'),
(8, 6, 7, 3, 3, 'We are working with local authorities to repair roads and organizing transportation options for emergencies and market access.', '2022-10-19', '16:34:00', 'Active'),
(9, 10, 3, 13, 13, 'We are collaborating with housing organizations to provide affordable and disaster-resilient homes, ensuring safe shelter for every family', '2022-10-20', '18:09:00', 'Active'),
(10, 8, 9, 10, 10, 'We are empowering women through literacy programs, vocational training, and awareness workshops to ensure equal opportunities.', '2022-10-26', '20:05:00', 'Active'),
(11, 9, 11, 5, 5, 'We are educating villagers on banking processes, helping them open accounts, and connecting them to financial schemes for support', '2022-10-27', '20:43:00', 'Active'),
(12, 12, 14, 6, 6, 'We are introducing farmers to climate-resilient crops and training them in modern irrigation and sustainable farming techniques.', '2022-11-05', '16:46:00', 'Active'),
(13, 14, 17, 9, 9, 'We are offering skill development workshops and supporting small business initiatives to create more employment opportunities in the village.', '2022-11-13', '20:23:00', 'Active');


-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `adminname` (`adminname`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`problemid`),
  ADD KEY `volunteerid` (`volunteerid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `departmentid` (`departmentid`);


--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentid`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`volunteerid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `volunteer_timings`
--
ALTER TABLE `volunteer_timings`
  ADD PRIMARY KEY (`volunteer_timings_id`),
  ADD KEY `volunteer_timings_ibfk_1` (`volunteerid`);
--
-- Indexes for table `panchayatraj`
--
ALTER TABLE `panchayatraj`
  ADD PRIMARY KEY (`panchayatrajid`),
  ADD KEY `departmentid` (`departmentid`);

--
-- Indexes for table `panchayatraj_timings`
--
ALTER TABLE `panchayatraj_timings`
  ADD PRIMARY KEY (`panchayatraj_timings_id`),
  ADD KEY `panchayatraj_timings_ibfk_1` (`panchayatrajid`);



--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `loginid` (`loginid`);

--
-- Indexes for table `action_records`
--
ALTER TABLE `action_records`
  ADD PRIMARY KEY (`action_records_id`),
  ADD KEY `volunteerid` (`volunteerid`),
  ADD KEY `panchayatrajid` (`panchayatrajid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `problemid` (`problemid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `problemid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;



--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `volunteerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `volunteer_timings`
--
ALTER TABLE `volunteer_timings`
  MODIFY `volunteer_timings_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `panchayatraj`
--
ALTER TABLE `panchayatraj`
  MODIFY `panchayatrajid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `panchayatraj_timings`
--
ALTER TABLE `panchayatraj_timings`
  MODIFY `panchayatraj_timings_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;




--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `problem`
--
ALTER TABLE `problem`
  ADD CONSTRAINT `problem_ibfk_1` FOREIGN KEY (`volunteerid`) REFERENCES `volunteer` (`volunteerid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `problem_ibfk_2` FOREIGN KEY (`panchayatrajid`) REFERENCES `panchayatraj` (`panchayatrajid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `problem_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `problem_ibfk_4` FOREIGN KEY (`departmentid`) REFERENCES `department` (`departmentid`) ON DELETE CASCADE ON UPDATE CASCADE;


-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`departmentid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer_timings`
--
ALTER TABLE `volunteer_timings`
  ADD CONSTRAINT `volunteer_timings_ibfk_1` FOREIGN KEY (`volunteerid`) REFERENCES `volunteer` (`volunteerid`) ON DELETE CASCADE ON UPDATE CASCADE;

  --
-- Constraints for table `panchayatraj`
--
ALTER TABLE `panchayatraj`
  ADD CONSTRAINT `panchayatraj_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `department` (`departmentid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `panchayatraj_timings`
--
ALTER TABLE `panchayatraj_timings`
  ADD CONSTRAINT `panchayatraj_timings_ibfk_1` FOREIGN KEY (`panchayatrajid`) REFERENCES `panchayatraj` (`panchayatrajid`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Constraints for table `action_records`
--
ALTER TABLE `action_records`
  ADD CONSTRAINT `action_records_ibfk_1` FOREIGN KEY (`volunteerid`) REFERENCES `volunteer` (`volunteerid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `action_records_ibfk_2` FOREIGN KEY (`panchayatrajid`) REFERENCES `panchayatraj` (`panchayatrajid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `action_records_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `action_records_ibfk_4` FOREIGN KEY (`problemid`) REFERENCES `problem` (`problemid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
 