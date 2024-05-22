-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 04:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fareco_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_ID` bigint(100) NOT NULL,
  `Fname` varchar(150) NOT NULL,
  `Lname` varchar(150) NOT NULL,
  `acc_user` varchar(100) NOT NULL,
  `acc_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`user_ID`, `Fname`, `Lname`, `acc_user`, `acc_pass`) VALUES
(8135, 'Rhyz', 'Macapagal', 'q', 'q'),
(35778, 'Rhea', '', 'rhea', '12345'),
(46355, 'Rhyzeline', 'Macapagal', 'rhy', 'qweqwe'),
(12345678, 'Michelle', 'Asis', 'michi_23', '12345me');

-- --------------------------------------------------------

--
-- Table structure for table `dress`
--

CREATE TABLE `dress` (
  `CID` int(11) NOT NULL,
  `DRESSES` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dress`
--

INSERT INTO `dress` (`CID`, `DRESSES`) VALUES
(2, 'defaultimg/dress/IMG-66454bc52e9a70.98957441.jpg'),
(3, 'defaultimg/dress/IMG-66454bda5bbe15.92715999.jpg'),
(4, 'defaultimg/dress/IMG-66454be1067e78.00074405.jpg'),
(5, 'defaultimg/dress/IMG-66454be6dd7ac4.55310784.jpg'),
(6, 'defaultimg/dress/IMG-66454bf62e85a5.32105751.jpg'),
(7, 'defaultimg/dress/IMG-66454c12eab077.62122536.jpg'),
(8, 'defaultimg/dress/IMG-66454c17ac7925.30900668.jpg'),
(9, 'defaultimg/dress/IMG-66454c1c007fe9.86481095.jpg'),
(10, 'defaultimg/dress/IMG-66454c229578a2.96656957.jpg'),
(11, 'defaultimg/dress/IMG-66454c26d96fb7.34625762.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pant`
--

CREATE TABLE `pant` (
  `CID` int(11) NOT NULL,
  `PANTS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pant`
--

INSERT INTO `pant` (`CID`, `PANTS`) VALUES
(1, 'defaultimg/pant/IMG-66454cf1603f36.06718248.jpg'),
(2, 'defaultimg/pant/IMG-66454d082480a5.40422530.jpg'),
(3, 'defaultimg/pant/IMG-66454d0c6b0812.06590818.jpg'),
(4, 'defaultimg/pant/IMG-66454d139112f9.04820060.jpg'),
(5, 'defaultimg/pant/IMG-66454d197acad1.27222709.jpg'),
(6, 'defaultimg/pant/IMG-66454d1e5216f4.59444240.jpg'),
(7, 'defaultimg/pant/IMG-66454d223ae8e0.26386201.jpg'),
(8, 'defaultimg/pant/IMG-66454d27373b97.90211102.jpg'),
(9, 'defaultimg/pant/IMG-66454d2c3fca17.23227096.jpg'),
(10, 'defaultimg/pant/IMG-66454d30719086.63508604.jpg'),
(11, 'defaultimg/pant/IMG-66454d3480ee58.59939312.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `title` varchar(250) NOT NULL,
  `content` varchar(300) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `image` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `likes` bigint(250) NOT NULL,
  `acc_user` varchar(250) NOT NULL,
  `PID` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shirt`
--

CREATE TABLE `shirt` (
  `CID` int(11) NOT NULL,
  `SHIRTS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shirt`
--

INSERT INTO `shirt` (`CID`, `SHIRTS`) VALUES
(10, 'defaultimg/top/IMG-66457d3f2ef8b3.66717040.jpg'),
(11, 'defaultimg/top/IMG-66457d4ed54a04.23728818.jpg'),
(12, 'defaultimg/top/IMG-66457d54cbb0b7.59098772.jpg'),
(13, 'defaultimg/top/IMG-66457d593179b6.08657099.jpg'),
(14, 'defaultimg/top/IMG-66457d5f902cd1.34527576.jpg'),
(15, 'defaultimg/top/IMG-66457d63c13136.08330509.jpg'),
(16, 'defaultimg/top/IMG-66457d6a8bc423.66203588.jpg'),
(17, 'defaultimg/top/IMG-66457d709380a6.57225654.jpg'),
(18, 'defaultimg/top/IMG-66457d767e5ee5.96212943.jpg'),
(19, 'defaultimg/top/IMG-66457d7d0d6554.52505366.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `short`
--

CREATE TABLE `short` (
  `CID` int(11) NOT NULL,
  `SHORTS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `short`
--

INSERT INTO `short` (`CID`, `SHORTS`) VALUES
(1, 'defaultimg/short/IMG-66454dbaca8255.24552557.jpg'),
(2, 'defaultimg/short/IMG-66454dc14fc7e6.30321196.jpg'),
(3, 'defaultimg/short/IMG-66454dc6ee4d64.21576182.jpg'),
(4, 'defaultimg/short/IMG-66454dcb8265a6.52429387.jpg'),
(5, 'defaultimg/short/IMG-66454dd006a921.40822067.jpg'),
(6, 'defaultimg/short/IMG-66454dd50da892.00657231.jpg'),
(7, 'defaultimg/short/IMG-66454dd8dfdb16.58638485.jpg'),
(8, 'defaultimg/short/IMG-66454ddec6abb8.90020486.jpg'),
(9, 'defaultimg/short/IMG-66454de3e5a0b1.80969046.jpg'),
(10, 'defaultimg/short/IMG-66454de9c63fa5.82265452.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `skirt`
--

CREATE TABLE `skirt` (
  `CID` int(11) NOT NULL,
  `SKIRTS` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skirt`
--

INSERT INTO `skirt` (`CID`, `SKIRTS`) VALUES
(1, 'defaultimg/skirt/IMG-66454e1288e7c9.59763449.jpg'),
(2, 'defaultimg/skirt/IMG-66454e1d5a4bf4.03657299.jpg'),
(3, 'defaultimg/skirt/IMG-66454e22d92e11.85790591.jpg'),
(4, 'defaultimg/skirt/IMG-66454e27e44a35.45625231.jpg'),
(5, 'defaultimg/skirt/IMG-66454e2d63d676.82489203.jpg'),
(6, 'defaultimg/skirt/IMG-66454e32d2ac12.70529540.jpg'),
(7, 'defaultimg/skirt/IMG-66454e3804fc34.33464200.jpg'),
(8, 'defaultimg/skirt/IMG-66454e3d76e047.32545656.jpg'),
(9, 'defaultimg/skirt/IMG-66454e4423e3c4.78832631.jpg'),
(10, 'defaultimg/skirt/IMG-66454e4a2ca675.81162400.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userprof`
--

CREATE TABLE `userprof` (
  `acc_user` varchar(200) NOT NULL,
  `avatar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `dress`
--
ALTER TABLE `dress`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `pant`
--
ALTER TABLE `pant`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `shirt`
--
ALTER TABLE `shirt`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `short`
--
ALTER TABLE `short`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `skirt`
--
ALTER TABLE `skirt`
  ADD PRIMARY KEY (`CID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dress`
--
ALTER TABLE `dress`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pant`
--
ALTER TABLE `pant`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shirt`
--
ALTER TABLE `shirt`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `short`
--
ALTER TABLE `short`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skirt`
--
ALTER TABLE `skirt`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
