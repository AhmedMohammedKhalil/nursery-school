-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2022 at 04:11 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nurses`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `type`, `contact`) VALUES
(1, 'Facebook', 'www.facebook.com'),
(2, 'Email', 'nurses@email.com'),
(3, 'phone', '69532152');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `result` varchar(50) NOT NULL,
  `evaluate_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `type`, `result`, `evaluate_id`, `staff_id`, `parent_id`) VALUES
(1, 'manager', '100', 3, 2, NULL),
(4, 'parent', '100', 3, NULL, 4),
(5, 'manager', '64.285714285714', 5, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kids`
--

CREATE TABLE `kids` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `vaccination` text NOT NULL,
  `class` text NOT NULL,
  `birth_date` text NOT NULL,
  `description` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'not accepted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kids`
--

INSERT INTO `kids` (`id`, `fname`, `lname`, `vaccination`, `class`, `birth_date`, `description`, `parent_id`, `staff_id`, `status`) VALUES
(30, 'saad', 'ahmed', 'Yes', 'KJ2', '10-Apr-2014', 'description', 3, 3, 'accepted'),
(31, 'tala', 'ahmed', 'No', 'KJ1', '16-Aug-2015', 'details', 3, NULL, 'not accepted'),
(32, 'sama', 'mohamed', 'Yes', 'KJ3', '24-Feb-2013', 'description', 4, 5, 'accepted'),
(33, 'yassen', 'mohamed', 'No', 'KJ1', '05-Mar-2015', 'description', 4, NULL, 'not accepted');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`) VALUES
(4, 'News Title', 'Details about News'),
(5, 'News Title', 'Content');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message_to` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `staff_id` int(11) NOT NULL,
  `kid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message_to`, `message`, `staff_id`, `kid_id`) VALUES
(5, 'staff', 'New kids added', 1, 30),
(6, 'staff', 'New kids added', 1, 31),
(7, 'staff', 'New kids added', 1, 32),
(8, 'parent', 'your Kid Accepted', 3, 30),
(12, 'parent', 'Must be Add Payment for your kid', 3, 30),
(14, 'staff', 'New kids added', 1, 33),
(15, 'parent', 'your Kid Accepted', 5, 32),
(16, 'staff', 'Payment Done successfuly', 3, 30);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ssn` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `created_at` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `username`, `name`, `ssn`, `address`, `password`, `created_at`) VALUES
(3, 'ahmed omran', 'ahmed', '653291736582', 'Kuwait city', '$2y$10$t7oAuWKQZ.hWsqLnteGpDeJUchRUwYw56iRaecnACrArP8e9EyCBK', '2022-01-13 21:06:31'),
(4, 'mohamed talal', 'mohamed', '658235469213', 'Kuwait city', '$2y$10$t7oAuWKQZ.hWsqLnteGpDeJUchRUwYw56iRaecnACrArP8e9EyCBK', '2022-01-23 02:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `parent_phone`
--

CREATE TABLE `parent_phone` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent_phone`
--

INSERT INTO `parent_phone` (`id`, `parent_id`, `phone`) VALUES
(1, 3, '69532581'),
(2, 4, '65921545');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` double NOT NULL,
  `kids_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `description`, `amount`, `kids_id`, `created_at`) VALUES
(1, 'By master card', 120, 30, '2022-01-23 15:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `body`) VALUES
(4, 'Service Title', 'Content'),
(5, 'service Title', 'details');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` text NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'staff',
  `created_at` text NOT NULL DEFAULT current_timestamp(),
  `review` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `name`, `position`, `password`, `role`, `created_at`, `review`) VALUES
(1, 'talal saadawy', 'talal', 'staff', '$2y$10$t7oAuWKQZ.hWsqLnteGpDeJUchRUwYw56iRaecnACrArP8e9EyCBK', 'staff', '2022-01-13 21:32:09', ''),
(2, 'admin', 'administrator', 'management', '$2y$10$t7oAuWKQZ.hWsqLnteGpDeJUchRUwYw56iRaecnACrArP8e9EyCBK', 'manager', '2022-01-13 18:32:09', ''),
(3, 'hamad abdalla', 'hamad', 'teacher', '$2y$10$t7oAuWKQZ.hWsqLnteGpDeJUchRUwYw56iRaecnACrArP8e9EyCBK', 'advisor', '2022-01-17 04:44:53', 'Excellent'),
(5, 'abdalla mohammed', 'abdalla', 'Teacher', '$2y$10$t7oAuWKQZ.hWsqLnteGpDeJUchRUwYw56iRaecnACrArP8e9EyCBK', 'advisor', '2022-01-22 04:00:57', 'Good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `kids`
--
ALTER TABLE `kids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kid_id` (`kid_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `parent_phone`
--
ALTER TABLE `parent_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kids_id` (`kids_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kids`
--
ALTER TABLE `kids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parent_phone`
--
ALTER TABLE `parent_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kids`
--
ALTER TABLE `kids`
  ADD CONSTRAINT `kids_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`id`),
  ADD CONSTRAINT `kids_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`kid_id`) REFERENCES `kids` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `parent_phone`
--
ALTER TABLE `parent_phone`
  ADD CONSTRAINT `parent_phone_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`kids_id`) REFERENCES `kids` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
