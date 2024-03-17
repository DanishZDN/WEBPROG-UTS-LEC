-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 02:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin & nasabah bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Moderator') NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `registration_date` datetime DEFAULT current_timestamp(),
  `verified` tinyint(1) DEFAULT 0,
  `can_verify_registration` tinyint(1) DEFAULT 1,
  `can_verify_savings` tinyint(1) DEFAULT 1,
  `can_list_users` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `id` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_verification`
--

CREATE TABLE `registration_verification` (
  `user_id` int(11) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `savings_verification`
--

CREATE TABLE `savings_verification` (
  `user_id` int(11) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category` enum('pokok','wajib','sukarela') DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `proof_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','verified','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','nasabah') DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `registration_date` datetime DEFAULT current_timestamp(),
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `name`, `address`, `gender`, `birthdate`, `registration_date`, `verified`) VALUES
(2, 'FaizHS', 'faizcool@gmail.com', 'Faiz', '', 'Faiz hasanudin', 'Faiz', 'male', '2024-02-26', '2024-03-17 00:00:00', 0),
(3, 'Davergamer', 'dave@gamer.com', 'Dave', '', 'Dave simuthan', 'ddave', 'male', '2024-02-27', '2024-03-17 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `registration_verification`
--
ALTER TABLE `registration_verification`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `savings_verification`
--
ALTER TABLE `savings_verification`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `registration_verification`
--
ALTER TABLE `registration_verification`
  ADD CONSTRAINT `registration_verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `savings_verification`
--
ALTER TABLE `savings_verification`
  ADD CONSTRAINT `savings_verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
