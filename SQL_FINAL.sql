-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2023 at 06:05 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21288983_sjcjob`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `newplacement`
--

CREATE TABLE `newplacement` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `contact` int(200) NOT NULL,
  `details` varchar(100) NOT NULL,
  `vacancy` varchar(100) NOT NULL,
  `lastdate` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newplacement`
--

INSERT INTO `newplacement` (`id`, `name`, `title`, `qualification`, `location`, `contact`, `details`, `vacancy`, `lastdate`) VALUES
(53, 'ZOOHO', 'SOFTWARE DEVELOPER', 'MCA, MSC(CS)', 'CHENNAI', 9948578, 'PYTHON', '90', '2023-09-25'),
(54, 'ZUCI SYSTEM', 'SOFTWARE DEVELOPER', 'MCA, MSC(CS)', 'CHENNAI', 994378293, 'JAVA, PYTHON, SQL', '10', '2023-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `pdf`
--

CREATE TABLE `pdf` (
  `id` int(100) NOT NULL,
  `s_id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf`
--

INSERT INTO `pdf` (`id`, `s_id`, `c_id`, `resume`, `date`) VALUES
(131, 42, 53, 'resume_uploads/22PCA15953_resume.pdf', '2023-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetail`
--

CREATE TABLE `studentdetail` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dno` varchar(100) NOT NULL,
  `major` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `skill` varchar(200) NOT NULL,
  `10th` varchar(100) NOT NULL,
  `12th` varchar(100) NOT NULL,
  `1st` varchar(100) NOT NULL,
  `profile_photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentdetail`
--

INSERT INTO `studentdetail` (`id`, `name`, `dno`, `major`, `phone`, `email`, `degree`, `year`, `skill`, `10th`, `12th`, `1st`, `profile_photo`) VALUES
(42, 'SURENDHAR S', '22PCA159', 'MCA', '9943782932', '22pca159@mail.sjctni.edu', 'PG', '2nd year', 'Core Java, Core Python, SQL', '96', '80', '82', 'profile_photo/22PCA159_profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stud_select`
--

CREATE TABLE `stud_select` (
  `s_id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dno` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dno` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dno`, `pass`) VALUES
(42, 'SURENDHAR S', '22PCA159', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newplacement`
--
ALTER TABLE `newplacement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf`
--
ALTER TABLE `pdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newplacement`
--
ALTER TABLE `newplacement`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `pdf`
--
ALTER TABLE `pdf`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
