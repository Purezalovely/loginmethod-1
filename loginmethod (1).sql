-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:06 AM
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
-- Database: `loginmethod`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `account_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `birthday`, `sex`, `user_email`, `profile_picture`, `account_type`) VALUES
(16, 'kenasdswdasd', '123', 'Drex', 'Cueto', '2024-05-17', 'male', '', '', 0),
(22, 'dancing dog', '6]Rbup|&', 'Dancing ', 'Dog', '2024-05-14', 'male', 'dr@g', 'uploads/365750560_674505234521708_2732450809141846597_n_1716351415.gif', 1),
(25, 'Goku', '$2y$10$zY7q2.aK.GA8TSweHjcXYubt99.Fe08HbK3U/HHP4G6HSQZXK4mJe', 'Goku', 'Son', '2024-05-07', 'male', 'goku@gmail.com', 'uploads/goku-son-goku.gif', 1),
(26, 'Madara', '$2y$10$b83KHx42k4eC6UnxXcey.unMP.OMuAtvWWjU0.FC1Uhl7NG5X/mpq', 'Madara', 'Uchiha', '2024-05-16', 'male', 'madara@uchih', 'uploads/madara-uchiha_1716446802.gif', 0),
(27, 'drex', '$2y$10$STkgW0RuK4SaUw.UjbHuVucz7CVvyle1UOffB.X/pzJFAYGaaoX2q', 'Madara', 'Uchiha', '2024-05-15', 'male', 'drx@gm', 'uploads/365750560_674505234521708_2732450809141846597_n_1716451202.gif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_add_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_add_street` varchar(255) DEFAULT NULL,
  `user_add_barangay` varchar(255) DEFAULT NULL,
  `user_add_city` varchar(255) DEFAULT NULL,
  `user_add_province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_add_id`, `user_id`, `user_add_street`, `user_add_barangay`, `user_add_city`, `user_add_province`) VALUES
(9, 22, 'Lipa', 'Concepcion', 'Calintaan', 'MIMAROPA'),
(12, 25, 'Lipas', 'Plaridel', 'Jose Panganiban', 'Region V (Bicol Region)'),
(13, 26, 'Lipas', 'Mauringuen', 'Araceli', 'MIMAROPA'),
(14, 27, 'Lipas', 'Bagumbayan (Pob.)', 'Bagac', 'Region III (Central Luzon)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_add_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `user_add_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
