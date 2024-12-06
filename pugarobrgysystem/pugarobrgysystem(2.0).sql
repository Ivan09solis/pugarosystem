-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 12:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Announcement 1', 'this is announcement 1 sample.', '2024-07-11 23:19:49', '2024-07-11 23:30:10'),
(3, 'Announcdement 2', 'sdgdfhfdhdfhfh', '2024-08-13 22:16:43', '2024-08-23 10:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `blotters`
--

CREATE TABLE `blotters` (
  `id` int(11) NOT NULL,
  `incident_type` varchar(255) NOT NULL,
  `date_time_reported` datetime NOT NULL,
  `date_time_incident` datetime NOT NULL,
  `reporter_name` varchar(255) NOT NULL,
  `reporter_birthdate` date NOT NULL,
  `reporter_civil_status` varchar(100) NOT NULL,
  `reporter_gender` varchar(50) NOT NULL,
  `reporter_religion` varchar(100) NOT NULL,
  `reporter_address` text NOT NULL,
  `defendant_name` varchar(255) NOT NULL,
  `defendant_birthdate` date NOT NULL,
  `defendant_civil_status` varchar(100) NOT NULL,
  `defendant_gender` varchar(50) NOT NULL,
  `defendant_religion` varchar(100) NOT NULL,
  `defendant_address` text NOT NULL,
  `narrative` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotters`
--

INSERT INTO `blotters` (`id`, `incident_type`, `date_time_reported`, `date_time_incident`, `reporter_name`, `reporter_birthdate`, `reporter_civil_status`, `reporter_gender`, `reporter_religion`, `reporter_address`, `defendant_name`, `defendant_birthdate`, `defendant_civil_status`, `defendant_gender`, `defendant_religion`, `defendant_address`, `narrative`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdf', '2024-11-26 23:15:00', '2024-11-26 23:15:00', 'sdfdfds', '2024-11-26', 'Single', 'Male', 'sdfdsfsdf', 'sfsdfsfsdf', 'fdsfsdfsd', '2024-11-26', 'Married', 'Male', 'cfdsfsdfs', 'sdfsdfsfsdf', 'sdfdsffsdfds', '2024-11-26 15:16:45', '2024-11-26 15:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `eventdate` date NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `venue` text NOT NULL,
  `img` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `eventdate`, `from`, `to`, `venue`, `img`, `created_at`, `updated_at`) VALUES
(1, 'title12', 'ddgdffdg', '2024-07-11', '00:00:00', '00:00:00', 'dfgdfgdfg', 'pugaro-bg.png', '2024-07-11 23:51:35', '2024-08-25 17:25:32'),
(3, 'secomd event', 'loremipsom dfvsdfdsfs,fdbskjfh ,vm ksjdhfksjfhskdjf', '2024-08-23', '10:15:00', '15:37:00', 'mer mer manaoag pangasinan', 'pugaro-bg.png', '2024-08-23 10:15:40', '2024-08-23 10:15:40'),
(4, 'Feeding Program Eventsss', 'this is a description for the feedign program event that be held on brgy mermer mapandan pangasinan', '2024-08-23', '11:40:00', '11:55:00', 'mer mer mapandan pangasinan', 'pugaro-bg.jpg', '2024-08-23 11:45:13', '2024-08-25 13:38:39'),
(5, 'Thanks Giving Mass Program', 'this is a description for thanks giving mass held on august 30 atbrgy. mermer barangay event center  in the afternoon 1 pm', '2024-08-31', '14:28:00', '07:28:00', 'mermer mapandan pangasinan', 'logo.gif', '2024-08-23 14:28:24', '2024-08-23 14:28:24'),
(6, 'title 2', 'this is description', '2024-08-25', '17:20:00', '17:21:00', 'manaoag pangasinan', 'logo.png', '2024-08-25 17:20:31', '2024-08-25 17:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `feedback`, `created_at`, `updated_at`) VALUES
(2, '11', 'SAMPLE', '2024-11-06 20:58:42', '2024-11-06 20:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `form_id` int(11) NOT NULL,
  `ref` text NOT NULL,
  `formtype` varchar(50) DEFAULT NULL,
  `purpose` text NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `bdate` date DEFAULT NULL,
  `age` int(150) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`form_id`, `ref`, `formtype`, `purpose`, `fname`, `mname`, `lname`, `bdate`, `age`, `address`, `created_at`, `updated_at`, `status`, `user`) VALUES
(1, '0', NULL, '', 'sample', '', '', NULL, 0, 'manaoag pangasinan', '2024-07-29 22:22:36', '2024-07-29 22:22:36', 'Accepted', 11),
(2, '0', NULL, '', 'sample', '', '', NULL, 0, 'manaoag pangasinan', '2024-07-29 22:23:23', '2024-08-25 15:33:04', 'Accepted', 11),
(3, '0', NULL, '', 'sample', '', '', NULL, 0, 'manaoag pangasinan', '2024-07-29 22:25:14', '2024-07-29 22:25:14', 'Declined', 11),
(4, '0', NULL, '', 'sample', '', '', NULL, 0, 'manaoag pangasinan', '2024-07-29 22:26:05', '2024-07-29 22:26:05', 'Cancelled', 11),
(9, '1166', 'Barangay Clearance', 'sample sdfdsffdssdfsdfsd', 'kulayot', 'lalayo', 'Cabotaje', '2024-08-05', 20, 'San Manuael Pangasinan', '2024-08-05 22:50:55', '2024-08-11 15:22:19', 'Accepted', 11),
(10, '0', 'Certificate of Indigency', 'sample sdfdsf', 'kulayot', 'lalayo', 'Cabotaje', '2024-08-05', 30, 'San Manuael Pangasinan', '2024-08-05 22:58:00', '2024-08-11 15:18:09', 'Accepted', 11),
(11, '0', 'Barangay Certificate', 'sample sdfdsffdssdfsdfsd', 'kulayot', 'Guzmansds', 'Cabotaje', '2024-08-05', 12, 'San Manuael Pangasinan', '2024-08-05 23:00:44', '2024-08-11 15:15:26', 'Accepted', 11),
(12, '0', 'Barangay Certificate', 'sample sdfdsffdssdfsdfsd', 'kulayot', 'Guzmansds', 'vabotajeerer', '2024-08-05', 20, 'San Manuael Pangasinan', '2024-08-05 23:02:54', '2024-08-11 15:15:03', 'Accepted', 11),
(13, '0', 'Barangay Certificate', 'sample sdfdsffdssdfsdfsd', 'kulayot', 'Guzmansds', 'Cabotaje', '2024-08-16', 12, 'fgdgdgdfgdfgdf', '2024-08-05 23:04:07', '2024-08-11 15:12:45', 'Accepted', 11),
(14, '1266', 'Certificate of Indigency', 'sample sdfdsf', 'kulayot', 'lalayo', 'Cabotaje', '2024-08-08', 11, 'San Manuael Pangasinan', '2024-08-05 23:05:18', '2024-08-09 22:29:49', 'Cancelled', 11),
(15, '2Jy4dTiSRO7W', 'Barangay Clearance', 'sample sdfdsffdssdfsdfsd', 'kulayot', 'Guzmansds', 'vabotaje', '2024-08-05', 11, 'MANAOAG PANGASINAN', '2024-08-05 23:13:32', '2024-08-07 23:35:27', 'Cancelled', 11),
(16, '1266b0ec64316d4', 'Certificate of Indigency', 'sample sdfdsffdssdfsdfsdsdsd', 'kulayot', 'lalayo', 'vabotaje', '2024-08-05', 11, 'MANAOAG PANGASINAN', '2024-08-05 23:14:44', '2024-08-07 23:29:41', 'Cancelled', 11),
(17, '1266b87be3c58be', 'Certificate of Indigency', 'sample work', 'Johari', 'Cruz', 'Last', '2024-08-11', 22, 'Mermer Mapandan', '2024-08-11 16:52:51', '2024-08-25 15:33:20', 'Accepted', 11),
(18, '1266cafd361f1f8', 'Barangay Clearance', 'For Work', 'kulayot', 'lalayo', 'Cabotaje', '2024-08-25', 20, 'MANAOAG PANGASINAN', '2024-08-25 17:45:26', '2024-11-02 21:20:52', 'Cancelled', 11);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(1, '2', 'sample message', '2024-11-02 15:58:12', '2024-11-02 15:58:12'),
(3, '11', 'This is a sample message 3\r\n', '2024-11-02 21:18:20', '2024-11-02 21:18:20'),
(4, '11', 'THIS IS A MESSAGE 4 FOR EXAMPLE ONLY', '2024-11-02 21:19:55', '2024-11-02 21:19:55'),
(5, '11', 'TOAST', '2024-11-02 21:23:01', '2024-11-02 21:23:01'),
(10, '11', 'SAMPLE MESSAGE', '2024-11-06 20:57:48', '2024-11-06 20:57:48'),
(11, '11', 'SA,PLE ULIT', '2024-11-06 20:58:00', '2024-11-06 20:58:00'),
(12, '2', 'SAMPLED', '2024-11-12 22:32:39', '2024-11-12 22:32:39'),
(13, '1', 'sample admin', '2024-11-12 22:46:09', '2024-11-12 22:46:09'),
(14, '1', 'sampledds', '2024-11-12 22:48:33', '2024-11-12 22:48:33'),
(15, '1', 'xzxzx', '2024-11-12 22:49:19', '2024-11-12 22:49:19'),
(16, '11', 'my sample', '2024-11-12 22:57:57', '2024-11-12 22:57:57'),
(17, '1', 'sample lang\r\n', '2024-11-12 22:58:48', '2024-11-12 22:58:48'),
(18, '1', 'saqmple', '2024-11-12 22:59:30', '2024-11-12 22:59:30'),
(19, '1', 'sdfsfsf', '2024-11-12 22:59:57', '2024-11-12 22:59:57'),
(20, '11', 'sample laned', '2024-11-12 23:01:32', '2024-11-12 23:01:32'),
(21, '1', 'sample2', '2024-11-12 23:03:07', '2024-11-12 23:03:07'),
(22, '1', 'sample', '2024-11-12 23:03:43', '2024-11-12 23:03:43'),
(23, '1', 'samplesss', '2024-11-12 23:03:55', '2024-11-12 23:03:55'),
(24, '1', 'hahaha', '2024-11-12 23:04:16', '2024-11-12 23:04:16'),
(25, '11', 'sammms', '2024-11-12 23:05:07', '2024-11-12 23:05:07'),
(26, '11', 'this is sample', '2024-11-12 23:09:49', '2024-11-12 23:09:49'),
(27, '11', 'SAMPLE KO', '2024-11-13 22:09:07', '2024-11-13 22:09:07'),
(28, '1', 'sample ko ulit', '2024-11-13 22:10:09', '2024-11-13 22:10:09'),
(29, '1', 'sample na talaga', '2024-11-13 22:11:36', '2024-11-13 22:11:36'),
(30, '1', 'talaga ba?', '2024-11-13 22:11:49', '2024-11-13 22:11:49'),
(31, '11', 'bess may chismis', '2024-11-13 22:12:39', '2024-11-13 22:12:39'),
(32, '1', 'this is completed sample', '2024-11-20 22:42:02', '2024-11-20 22:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`id`, `name`, `age`, `gender`, `address`, `created_at`, `updated_at`) VALUES
(6, 'Juana Dela Cruz', 55, 'Female', 'MANAOAG Pangasinan', '2024-07-11 21:48:42', '2024-08-25 16:33:02');

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
(1, 'Administrator', NULL, NULL, NULL, NULL, NULL, '09123456789', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '', 1, 'user.jpg', '2024-11-15 14:55:32', NULL),
(11, 'Jonel', 'Guzman', 'Nagtalon', 'Male', '2024-07-22', 'San Manuael Pangasinan', '09123456789', 'jonelnagtalon@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'cbf859b7307d660', 1, 'user.jpg', '2024-11-10 14:27:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blotters`
--
ALTER TABLE `blotters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blotters`
--
ALTER TABLE `blotters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
