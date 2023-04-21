-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2022 at 06:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emerdoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `password_check` text DEFAULT NULL,
  `profile_pic` varchar(500) DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `api_token` varchar(300) DEFAULT NULL,
  `profile_status` int(11) NOT NULL DEFAULT 0,
  `otp_code` varchar(255) DEFAULT NULL,
  `address_line_1` varchar(250) DEFAULT NULL,
  `address_line_2` varchar(250) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `dob`, `email`, `password`, `password_check`, `profile_pic`, `remember_token`, `api_token`, `profile_status`, `otp_code`, `address_line_1`, `address_line_2`, `updated_at`, `created_at`) VALUES
(1, 'admin', '7351334717', '2009-11-22', 'admin@gmail.com', '$2y$10$6SNPkIrAreBNGjU1DyiUPeG24rfJjZSp.wKfbvIC5oO2J3taMid0.', 'sample', NULL, NULL, '$2y$10$AqNLf6dmiAbUrs71HfIV0.7Qk/rCZsi6mRbtUJuwELDLsBYFItlYW', 0, '7957', NULL, NULL, '2022-08-03 04:29:50', NULL),
(2, 'Mr. Gulzar 121', '8909676762', '2009-10-22', 'mygmail111@gmail.com', NULL, NULL, NULL, NULL, '2', 0, '9110', 'A-240 Awas Vikas 220', 'Jwalapur Haridwar', '2022-08-17 10:36:23', '2022-08-03 01:29:19'),
(3, 'noshad', '9927631467', '2009-10-22', 'dksla@gmail.com', NULL, NULL, NULL, NULL, '3', 0, '5068', NULL, NULL, '2022-08-08 04:30:08', '2022-08-03 02:03:53'),
(4, 'MOHD. GULZAR', '9189096767', '2022-08-01', 'mohdgulzar5555@gmail.com', NULL, NULL, NULL, NULL, NULL, 0, '8572', 'rttyu fhjhvf', 'drghvv ffw 2', '2022-08-03 03:31:34', '2022-08-03 02:15:34'),
(5, 'Afzal Khan', '8057680071', '2011-08-11', 'mohdgulzar5555@gmail.com', NULL, NULL, NULL, NULL, '5', 0, '8303', 'eddfghh dfgvbhjfd vf', 'sweet. cffgh gddfg g2', '2022-08-08 07:22:54', '2022-08-03 02:20:44'),
(6, 'sdfgg', '5248880888', '2022-07-03', 'mohdgul55@gmail.com', NULL, NULL, NULL, NULL, NULL, 0, NULL, 'eddf', 'trrdx2', '2022-08-03 02:27:19', '2022-08-03 02:27:19'),
(7, 'Dipu Chn', '9997001122', '2022-06-06', 'umarali600002@gmail.com', NULL, NULL, NULL, NULL, '7', 0, '9769', 'erty1', 'wertè2', '2022-08-09 04:04:22', '2022-08-03 02:31:51'),
(8, 'Gfs', '9189000767', '2022-08-05', 'mohdgulzar5885@gmail.com', NULL, NULL, NULL, NULL, NULL, 0, NULL, 'ffghv ff', 'ffgvb2', '2022-08-03 02:34:11', '2022-08-03 02:34:11'),
(9, 'Mr. Gulzar11', NULL, '2009-10-22', 'dksla@gmail.com', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2022-08-17 04:34:29', '2022-08-17 04:34:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
