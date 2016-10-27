-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2016 at 02:04 PM
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
-- Table structure for table `on_events`
--

CREATE TABLE `on_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `participant` varchar(255) NOT NULL,
  `reminder` varchar(255) NOT NULL,
  `reminder_date` varchar(255) NOT NULL,
  `reminder_time` varchar(255) NOT NULL,
  `avail` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `on_events`
--

INSERT INTO `on_events` (`id`, `name`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `description`, `participant`, `reminder`, `reminder_date`, `reminder_time`, `avail`, `created`, `modified`) VALUES
(2, 'testin event', 'noida', 'Oct,27-10-2016', 'Oct,28-10-2016', '1:30pm', '3:00pm', 'vbncbnxnbkfn', '2,3', '', '28-10-2016', '9:00am', 1, '2016-10-27 10:04:56', '2016-10-27 10:04:56'),
(3, 'fgdfgdfgdfg', 'gffdgdf', 'Oct,20-10-2016', 'Oct,28-10-2016', '2:30pm', '2:00pm', 'fdgdfgdf gjdfhgj dfhj dfgh jdfgdf gdfg', '1,3', '', '26-10-2016', '2:30pm', 1, '2016-10-27 10:32:48', '2016-10-27 10:40:56'),
(4, 'testing', 'meerut', '27-10-2016', '28-10-2016', '4:30pm', '4:00pm', 'vchjvgdhghs dgfdsgh fdsh fds gfds', '1,2,3', '', '28-10-2016', '5:00pm', 0, '2016-10-27 13:12:43', '2016-10-27 13:13:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `on_events`
--
ALTER TABLE `on_events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `on_events`
--
ALTER TABLE `on_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
