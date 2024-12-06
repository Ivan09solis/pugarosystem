-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 04:52 PM
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
-- Database: `pugarobrgysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bdate` date NOT NULL,
  `civilstatus` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `pwd` varchar(200) NOT NULL,
  `senior_citizen` varchar(200) NOT NULL,
  `4ps` varchar(200) NOT NULL,
  `voter` varchar(200) NOT NULL,
  `voterid` int(50) DEFAULT NULL,
  `Is4ps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`id`, `name`, `bdate`, `civilstatus`, `religion`, `gender`, `address`, `created_at`, `updated_at`, `pwd`, `senior_citizen`, `4ps`, `voter`, `voterid`, `Is4ps`) VALUES
(6, 'Juana Dela Cruzes', '2024-11-01', 'single', 'INC', 'Female', 'MANAOAG Pangasinan', '2024-07-11 21:48:42', '2024-11-30 22:42:19', '0', '0', '0', '', 0, 0),
(12, 'Sun Kissed Lola', '2024-11-30', 'married', 'INC', 'Male', 'TAGA DOON', '2024-11-30 22:25:28', '2024-11-30 22:25:28', '0', '0', '0', '', 0, 0),
(14, 'SAMPLE', '2024-12-04', 'single', 'INC', 'Male', 'Pugaro Manaoag Pangasinan', '2024-12-04 21:46:45', '2024-12-04 21:54:09', 'PWD', 'Senior Citizen', 'Non-beneficiary', 'Voter', 0, 0),
(15, 'SAMPLE sss', '2024-12-04', 'single', 'INC', 'Male', 'Zone 4', '2024-12-04 21:47:50', '2024-12-05 23:18:57', 'PWD', 'Senior Citizen', 'Non-beneficiary', 'Voter', 2147483647, 0),
(16, 'SAMPLE sssasas', '2024-12-05', 'married', 'INC', 'Female', 'Zone 2', '2024-12-05 22:55:26', '2024-12-05 22:55:26', 'PWD', 'MINOR', '4P\'S', 'Non-voter', 2147483647, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `vkey` varchar(1000) NOT NULL,
  `isVerified` int(50) NOT NULL,
  `profile` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `gender`, `bdate`, `address`, `contact`, `email`, `password`, `vkey`, `isVerified`, `profile`, `updated_at`, `created_at`) VALUES
(1, 'Administrator', NULL, NULL, NULL, NULL, NULL, '09123456789', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '', 1, 'user.jpg', '2024-11-27 12:44:25', NULL),
(11, 'Jonels', 'Guzman', 'Nagtalon', 'Male', '2024-07-22', 'San Manuael Pangasinan', '', 'ds,fdsfh@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'cbf859b7307d660', 1, 'user.jpg', '2024-11-27 12:37:07', NULL),
(12, 'Mark Jordan', 'Deguzman', 'Sagun', 'Male', '2002-11-25', 'Pugaro Manaoag Pangasinan', '09858827237', 'sagunmark381@gmail.com', 'a0e3fb607521d0538e21dfa71e073845', '699b15896cb065e', 0, NULL, NULL, NULL),
(13, 'sample ', 'ko', 'Lang', 'Male', '2024-12-01', 'Pugaro Manaoag Pangasinan', '09123456789', 'dfgdfdfg', '81dc9bdb52d04dc20036dbd8313ed055', '294695', 1, NULL, NULL, NULL),
(40, 'Jonel', 'K', 'Lang', 'Male', '2024-12-03', 'Pugaro Manaoag Pangasinan', '00912345678', 'jonelnagtalon@gmail.com', '202cb962ac59075b964b07152d234b70', '463816', 1, 'user.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
