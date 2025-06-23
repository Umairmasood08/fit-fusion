-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 01:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitfusion`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `attended` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `member_id`, `class_id`, `attended`) VALUES
(1, 1, 1, 0),
(2, 11, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `schedule` datetime DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `name`, `schedule`, `trainer_id`) VALUES
(1, 'Custom Session - 1', '2025-06-20 15:30:00', 4),
(2, 'Custom Session - 11', '2025-06-21 15:30:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `name`, `email`, `password`, `trainer_id`, `age`, `weight`) VALUES
(1, 'umair masood', 'umair1@gmail.com', '$2y$10$8FSdw.tZy4S6mBUcim69a.6nR3MBrKdnAtym5Pr8U9QZDXv1R1GjO', 4, NULL, NULL),
(2, 'anum', 'anumali1@gmail.com', '$2y$10$X0JFHZOCTkWjaGB3DjOM8eHFmTtoQBKk6mu/YEo6A3tx7mSlp7YOa', NULL, NULL, NULL),
(4, 'moeez raza', 'moeezkhokhar@badmash.com', '$2y$10$CNQOKGzVxv1QqTamvtxRz.RSg3LPR0bTTaXT3a3Bn.FnD2JB/ULMW', 3, NULL, NULL),
(5, 'haris masood', 'harismasood08@gmail.com', '$2y$10$PLsDf4SYVi72sxxRKJRFYeHsGG4Si6rt5.B3At6mQdi.z8D8QhRg6', 4, 16, 52),
(6, 'Amna Ahmed', 'Amna_A2005@gmail.com', '$2y$10$HrbF7WMjQDXCmRJluTN9r.E2Lnhk/blYqOsl3s3FQHiLEzsqq/vdy', NULL, 22, 59),
(7, 'Amna Ahmed', 'am24@gmail.com', '$2y$10$4T7QrtdpTV3KlaSwuNjyc.qzIhu7VhBrGKYO6uK8GF5Uig.aGqsxi', NULL, 22, 59),
(8, 'esha farooq', 'esha99@gmail.com', '$2y$10$khpbaHO4sCaSVL8hAfVZIevPezzn9gE6Z4/K0hwpvwfARatDgCigG', NULL, 22, 59),
(10, 'sadia', 'sadia1@gmail.com', '$2y$10$sZl0QIrfJOWmZr7Udh6Oa.6Ya8qjRLQqiKkqijPxfMNbdY5SbpcHi', NULL, 23, 55),
(11, 'Aliya aftab', 'AF12@gmail.com', '$2y$10$4ukXHbBTDu5uzHz9/eSmHu2ERnN4b.BapDixkRD0LcrERA6HGPyay', 4, 19, 45);

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_plan`
--

CREATE TABLE `nutrition_plan` (
  `plan_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `assigned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrition_plan`
--

INSERT INTO `nutrition_plan` (`plan_id`, `member_id`, `description`, `assigned_date`) VALUES
(1, 4, 'chicken', '2025-06-01'),
(2, 1, 'banana , apples, chicken steak', '2025-06-19'),
(3, 11, 'banana, steak', '2025-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `status` enum('Paid','Due') DEFAULT 'Due'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `trainer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`trainer_id`, `name`, `email`, `password`) VALUES
(1, 'Ali', 'aliakbar1@gmail.com', '$2y$10$nutq11AlK0DtA86Es7PIq.IQLigLNHfVJ.Djz1Q8jYipH3NGaLBhS'),
(2, 'waqar masood', 'waqarmasood5@yahoo.com', '$2y$10$hUhoR9Hamcl9dF9v.HwYleEAY/tT9yVPBYJze61.was90LCKzuewW'),
(3, 'umair masood', 'masoodumair1@gmail.com', '$2y$10$EI7EXf0Y8c.OUcud.nqtpOLwHMVCduyI/z6EoT16ymsKAur8XMvt.'),
(4, 'usman lodhi', 'ul12@gmail.com', '$2y$10$olb9RLEox5wTse7UxI1T9ODi5HXaneG8SZmetVBxzX9IIplfMtQOO');

-- --------------------------------------------------------

--
-- Table structure for table `workout_plan`
--

CREATE TABLE `workout_plan` (
  `plan_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `assigned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_plan`
--

INSERT INTO `workout_plan` (`plan_id`, `member_id`, `description`, `assigned_date`) VALUES
(1, 4, 'legs and arms', '2025-06-01'),
(2, 11, 'legs and arms', '2025-06-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `nutrition_plan`
--
ALTER TABLE `nutrition_plan`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`trainer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workout_plan`
--
ALTER TABLE `workout_plan`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nutrition_plan`
--
ALTER TABLE `nutrition_plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workout_plan`
--
ALTER TABLE `workout_plan`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`trainer_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`trainer_id`) ON DELETE SET NULL;

--
-- Constraints for table `nutrition_plan`
--
ALTER TABLE `nutrition_plan`
  ADD CONSTRAINT `nutrition_plan_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `workout_plan`
--
ALTER TABLE `workout_plan`
  ADD CONSTRAINT `workout_plan_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
