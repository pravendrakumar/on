-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2016 at 08:00 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onscene`
--

-- --------------------------------------------------------

--
-- Table structure for table `on_admins`
--

CREATE TABLE `on_admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'SUB' COMMENT 'SUP->Super-Admin, SUB-> Sub-Admin',
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '0->Inactive, 1->Active',
  `last_login` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `on_admins`
--

INSERT INTO `on_admins` (`id`, `username`, `password`, `email`, `type`, `status`, `last_login`, `created`, `modified`) VALUES
(1, 'admin', '9056398d17c645650e7eb98ea7d274d6d0ae2c89', 'arun@codingexperts.in', 'SUP', '1', '2016-10-16 14:50:24', '2013-08-23 13:46:45', '2016-10-16 18:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `on_department`
--

CREATE TABLE `on_department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `addedon` varchar(255) NOT NULL,
  `updatedon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `on_stations`
--

CREATE TABLE `on_stations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `strength` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `distance_type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `on_stations`
--

INSERT INTO `on_stations` (`id`, `name`, `location`, `contact`, `strength`, `distance`, `vehicle`, `distance_type`, `status`, `created`, `modified`) VALUES
(2, 'IP Fire Limit', 'Ip  Extentiso', '4543534543', 20, 40, 15, 'mile', 0, '2016-10-15 13:36:47', '2016-10-15 13:40:01'),
(3, 'New FS', 'laxminagar', '67565675777', 45, 40, 20, 'km', 0, '2016-10-15 13:40:49', '2016-10-15 13:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `on_users`
--

CREATE TABLE `on_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `department` varchar(255) NOT NULL,
  `station_number` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `cell_number` varchar(255) NOT NULL,
  `eme_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `on_users`
--

INSERT INTO `on_users` (`id`, `first_name`, `last_name`, `email`, `password`, `image`, `status`, `created`, `modified`, `department`, `station_number`, `rank`, `id_number`, `driver`, `cell_number`, `eme_number`) VALUES
(1, 'James Judy', 'Frank ', 'james@gmail.com', '12345678', '774891475001373285491.jpg', '1', '2016-09-27 00:00:00', '2016-10-15 12:13:07', 'Hydero', '200', 'LEUTENEIENT', 'V898H78', 'on', '64356345636363456', '6356363636356544'),
(2, 'John', 'Sena', 'john@gmail.com', '12345678', '2229914750023237232403.jpg', '1', '0000-00-00 00:00:00', '2016-10-15 11:50:52', 'FIRE', '535', 'LEUTENEIENT', 'V898H79', 'YES', '5235363665366', '45646436363663'),
(3, NULL, NULL, '', 'd41d8cd98f00b204e9800998ecf8427e', NULL, '1', '2016-10-15 13:16:37', '2016-10-15 13:16:37', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `on_vehicles`
--

CREATE TABLE `on_vehicles` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `on_vehicles`
--

INSERT INTO `on_vehicles` (`id`, `station_id`, `name`, `model`, `number`, `capacity`, `created`, `modified`) VALUES
(1, 2, 'Fire name', '34234423', 'r3243242iop344', 300, '2016-10-16 15:07:02', '2016-10-16 18:54:33'),
(3, 3, 'Fire name', '34234423', 'r3243242iop344', 300, '2016-10-16 18:45:38', '2016-10-16 18:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `on_watertanks`
--

CREATE TABLE `on_watertanks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `water_capicity` bigint(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `addedon` varchar(255) NOT NULL,
  `updatedon` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `on_watertanks`
--

INSERT INTO `on_watertanks` (`id`, `name`, `water_capicity`, `location`, `description`, `status`, `addedon`, `updatedon`) VALUES
(1, 'gfsfsgdsgffsdfgsdgsd', 454325325, '5432532543', 'fdsafasfasdfdassadf asdfa sfsa fasfd adfsafasfsa f fdafdasfas fdas fa sdfdas', '2', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `on_department`
--
ALTER TABLE `on_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_stations`
--
ALTER TABLE `on_stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_users`
--
ALTER TABLE `on_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_vehicles`
--
ALTER TABLE `on_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_watertanks`
--
ALTER TABLE `on_watertanks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `on_department`
--
ALTER TABLE `on_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `on_stations`
--
ALTER TABLE `on_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `on_users`
--
ALTER TABLE `on_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `on_vehicles`
--
ALTER TABLE `on_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `on_watertanks`
--
ALTER TABLE `on_watertanks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
