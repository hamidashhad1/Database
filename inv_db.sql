-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2018 at 04:46 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inv_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dumyitem`
--

CREATE TABLE `dumyitem` (
  `itemid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `carton` int(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `caritem` int(4) NOT NULL,
  `price` int(11) NOT NULL,
  `dateofentry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dumyitem`
--

INSERT INTO `dumyitem` (`itemid`, `name`, `descrip`, `carton`, `quantity`, `caritem`, `price`, `dateofentry`) VALUES
(1, 'Rods', '34K_rods jhj', 0, 0, 20, 350, '2018-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `itemid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `carton` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `caritem` int(4) NOT NULL,
  `price` int(5) NOT NULL,
  `dateofentry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`itemid`, `name`, `descrip`, `carton`, `quantity`, `caritem`, `price`, `dateofentry`) VALUES
(1, 'Rods', '34K_rods', 15, 300, 20, 350, '2018-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `oderitem`
--

CREATE TABLE `oderitem` (
  `oderid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `orderid` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `orderdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_order`
--

CREATE TABLE `_order` (
  `orderid` int(11) NOT NULL,
  `orderdatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_user`
--

CREATE TABLE `_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_user`
--

INSERT INTO `_user` (`id`, `username`, `_pass`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dumyitem`
--
ALTER TABLE `dumyitem`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`itemid`);

--
-- Indexes for table `oderitem`
--
ALTER TABLE `oderitem`
  ADD PRIMARY KEY (`oderid`,`itemid`),
  ADD KEY `itemid` (`itemid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `_order`
--
ALTER TABLE `_order`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dumyitem`
--
ALTER TABLE `dumyitem`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `itemid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `_user`
--
ALTER TABLE `_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oderitem`
--
ALTER TABLE `oderitem`
  ADD CONSTRAINT `oderitem_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `inventory` (`itemid`),
  ADD CONSTRAINT `oderitem_ibfk_2` FOREIGN KEY (`oderid`) REFERENCES `_order` (`orderid`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `_order` (`orderid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
