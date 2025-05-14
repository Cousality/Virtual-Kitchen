-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2025 at 12:58 PM
-- Server version: 8.0.41-0ubuntu0.20.04.1
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_230107571_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `rid` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` enum('French','Italian','Chinese','Indian','Mexican','Others') COLLATE utf8mb4_general_ci NOT NULL,
  `Cookingtime` int DEFAULT NULL,
  `ingredients` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instructions` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`rid`, `name`, `description`, `type`, `Cookingtime`, `ingredients`, `instructions`, `image`, `uid`) VALUES
(5, 'Pancake', 'This is a basic Pancake', 'French', 20, '[\"Flour\"]', 'One Two Three', 'basicpancakes.jpg', 9),
(7, 'Chicken', 'Yes', 'Indian', 10, '[\"Stuff\"]', 'yay me', 'recipe_6809307ea8ccb.jpg', 9),
(8, 'Chocolate Cake', 'Chocolate Cake innit', 'French', 30, '[\"Chocolate\",\"Flour\"]', 'Just make it innit', 'recipe_680958889f6bc.jpg', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`) VALUES
(8, 'register', '$2y$10$WY2JH3zTGYaOTgDyah97HOA5o./A9KTT4ZAhibPgyoE9pcx0/UvMa', '123@gmail.com'),
(9, 'Hello', '$2y$10$Uu.sG6cy2kqfrDn7fhC7o.0sPXtuFh44Z..c6wn0fVJSHbN8wwv16', 'Hello@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
