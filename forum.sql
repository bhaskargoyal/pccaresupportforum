-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2017 at 05:27 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `heading` varchar(200) NOT NULL,
  `subheading` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `resolved` int(1) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `heading`, `subheading`, `text`, `resolved`, `time`) VALUES
(1, 1, 'Hardware Support', 'Laptop Power Button not Working', 'From last 3 days the power button is not working. 	Thanks.																																																				', 1, '2017-05-21 15:08:59'),
(2, 1, 'Hardware Support', 'Monitor not showing anything', 'Some time ago, my monitor stopped working. Maybe this is because of no earthing in the socket to which the monitor was always connected. Also, it used to give static charge shows. \r\nPlease see to it as soon as possible.\r\nThank You.', 1, '2017-05-21 15:09:10'),
(3, 1, 'Software Support', 'Need assistant to setup a Local Area Network', 'We need help to set up our computer network which should be in a star topology, with a firewall at the central server.						', 1, '2017-05-21 15:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `admin`, `username`, `password`) VALUES
(0, 1, 'ravi', 'ravi'),
(1, 0, 'bhaskar', 'qwerty'),
(2, 0, 'arihant', 'arihant'),
(3, 0, 'arjun', 'arjun'),
(4, 0, 'chirag', 'chirag');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `admin`, `firstname`, `lastname`, `age`, `username`) VALUES
(0, 1, 'Ravi', 'Mittal', 44, 'ravi'),
(1, 0, 'Bhaskar', 'Goyal', 19, 'bhaskar'),
(2, 0, 'Arihant', 'Jain', 20, 'arihant'),
(3, 0, 'Arjun', 'Sharma', 20, 'arjun'),
(4, 0, 'Chirag', 'Batra', 20, 'chirag'),
(5, 0, 'Prachi', 'Gupta', 23, 'prachi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
