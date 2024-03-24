-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 06:11 AM
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

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `role`, `name`, `address`, `gender`, `birthdate`, `registration_date`, `verified`, `can_verify_registration`, `can_verify_savings`, `can_list_users`) VALUES
(1, 'admin', 'admin@example.com', 'Admin', 'Admin', 'Admin Name', 'Admin Address', 'Male', '1990-01-01', '2024-03-17 21:18:50', 1, 1, 1, 1),
(2, 'test', 'test@admin.com', 'admin', 'Admin', 'test', 'test', 'Male', '2024-03-05', '2024-03-13 22:00:15', 1, 1, 1, 1);

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
  `status` enum('pending','verified','rejected') DEFAULT 'pending',
  `verified` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `category`, `transaction_date`, `amount`, `proof_path`, `status`, `verified`) VALUES
(1, NULL, 'sukarela', '2024-03-01', 123.00, 'Screenshot 2023-12-15 203545.png', 'verified', 'pending'),
(2, NULL, 'wajib', '2024-03-21', 5221.00, 'Screenshot 2023-12-14 132059.png', 'verified', 'pending'),
(3, NULL, 'wajib', '2024-03-13', 12314.00, 'Screenshot 2023-12-17 200606.png', 'verified', 'pending'),
(4, NULL, 'wajib', '2024-02-28', 123.00, 'Screenshot 2023-12-15 205919.png', 'verified', 'pending'),
(5, NULL, 'sukarela', '2024-02-28', 1242352.00, 'Screenshot 2024-02-28 105129.png', 'verified', 'pending'),
(7, NULL, 'sukarela', '2024-02-28', 1242352.00, 'Screenshot 2024-02-28 105129.png', 'rejected', 'pending'),
(8, NULL, 'sukarela', '2024-03-01', 200000.00, 'Screenshot 2023-12-15 203545.png', 'rejected', 'pending'),
(9, NULL, 'sukarela', '2024-02-27', 200000.00, 'Screenshot 2023-12-15 195714.png', 'rejected', 'pending'),
(10, NULL, 'sukarela', '2024-03-09', 2000000.00, 'Screenshot 2023-12-14 140953.png', 'rejected', 'pending'),
(11, NULL, 'wajib', '2024-03-08', 3000000.00, 'Screenshot 2023-12-15 195714.png', 'verified', 'pending'),
(12, NULL, 'sukarela', '2024-03-05', 800000.00, 'Screenshot 2023-12-18 135548.png', 'verified', 'pending'),
(13, NULL, 'wajib', '2024-02-27', 5100000.00, 'Screenshot 2023-12-15 195714.png', 'pending', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
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

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `photo_path`, `role`, `name`, `address`, `gender`, `birthdate`, `registration_date`, `verified`) VALUES
(2, 'FaizSH', 'faizcool@gmail.com', 'Faiz', 'uploads/Screenshot 2024-02-18 180930.png', '', 'fex', 'Faiz', 'male', '2024-02-26', '2024-03-17 00:00:00', 1),
(3, 'Davergamer', 'dave@gamer.com', 'dave', 'uploads/New Project (1).png', '', 'Dave simuthan', 'ddave', 'male', '2024-02-27', '2024-03-17 00:00:00', 1),
(7, 'Jeffry', 'jeffry@jeff.com', 'jeff', 'uploads/New Project (1).png', '', 'Jeff', 'homeless', 'female', '2024-01-17', '2024-03-17 00:00:00', 1),
(9, 'edrtg', 'idk@idk.com', 'idk', NULL, '', 'idk', 'Faiz', 'female', '2024-02-27', '2024-03-23 00:00:00', 1),
(10, 'qwerty', 'qwerty@email.com', 'qwerty', NULL, '', 'qwere', 'homeless', 'male', '2024-03-13', '2024-03-24 00:00:00', 0);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
