-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2019 at 04:05 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `password`) VALUES
('administrator', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `semsub`
--

CREATE TABLE `semsub` (
  `sr` int(11) NOT NULL,
  `semester` text NOT NULL,
  `subject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semsub`
--

INSERT INTO `semsub` (`sr`, `semester`, `subject`) VALUES
(1, 'Semester-1', '@#$chemestery@#$math 2@#$physics@#$python'),
(2, 'Semester-2', '@#$programming in c@#$java@#$advance java@#$c++');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sr` int(11) NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `sid` text NOT NULL,
  `semester` text NOT NULL,
  `sphone` text NOT NULL,
  `dob` text NOT NULL,
  `pass` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sr`, `fname`, `mname`, `lname`, `sid`, `semester`, `sphone`, `dob`, `pass`, `status`) VALUES
(1, 'shubham', 'm', 'more', 's101', 'Semester-1', '9999999999', '2019-01-29', 'password', 'active'),
(2, 'ballu', 'b', 'pura', 's202', 'Semester-2', '4774747747', '2019-01-01', 'password', 'active'),
(3, 'ballu', 'b', 'puram', 's393', 'Semester-1', '9938882938', '2018-11-01', 'password', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `sr` int(11) NOT NULL,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `tid` text NOT NULL,
  `semester` text NOT NULL,
  `subjects` text NOT NULL,
  `tphone` text NOT NULL,
  `tpass` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`sr`, `fname`, `mname`, `lname`, `tid`, `semester`, `subjects`, `tphone`, `tpass`, `status`) VALUES
(20, 'ballu', 'b', 'puram', 't202', '', '', '4848484884', 'password', 'Active'),
(21, 'shu', 'bha', 'mmm', 't101', ', Semester-1', '%&~math 2%&~physics', '0394809838', 'password', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `tid` text NOT NULL,
  `semester` text NOT NULL,
  `subject` text NOT NULL,
  `date` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `video` text NOT NULL,
  `docs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `semsub`
--
ALTER TABLE `semsub`
  ADD KEY `sr` (`sr`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD KEY `sr` (`sr`),
  ADD KEY `sr_2` (`sr`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`sr`),
  ADD KEY `sr` (`sr`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `semsub`
--
ALTER TABLE `semsub`
  MODIFY `sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
