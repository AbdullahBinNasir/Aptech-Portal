-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 09:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vision`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty_gpa`
--

CREATE TABLE `faculty_gpa` (
  `gpa_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `gpa_class_timing` float NOT NULL,
  `gpa_covered_topics` float NOT NULL,
  `gpa_lab_guidance` float NOT NULL,
  `gpa_clear_teaching` float NOT NULL,
  `gpa_exams_assignments_timing` float NOT NULL,
  `gpa_book_utilization` float NOT NULL,
  `gpa_sar_delivery` float NOT NULL,
  `gpa_system_complaints` float NOT NULL,
  `total_gpa` float NOT NULL,
  `gpa_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_gpa`
--

INSERT INTO `faculty_gpa` (`gpa_id`, `faculty_id`, `gpa_class_timing`, `gpa_covered_topics`, `gpa_lab_guidance`, `gpa_clear_teaching`, `gpa_exams_assignments_timing`, `gpa_book_utilization`, `gpa_sar_delivery`, `gpa_system_complaints`, `total_gpa`, `gpa_date`) VALUES
(4, 88, 4, 4, 4, 4, 4, 4, 4, 4, 4, '2024-08-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty_gpa`
--
ALTER TABLE `faculty_gpa`
  ADD PRIMARY KEY (`gpa_id`),
  ADD KEY `faculty_gpa_ibfk_1` (`faculty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty_gpa`
--
ALTER TABLE `faculty_gpa`
  MODIFY `gpa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_gpa`
--
ALTER TABLE `faculty_gpa`
  ADD CONSTRAINT `faculty_gpa_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
