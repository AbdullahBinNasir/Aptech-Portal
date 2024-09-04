-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2024 at 03:20 PM
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
-- Database: `vision`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `Profile` varchar(255) NOT NULL,
  `cnic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_id`, `department_id`, `position`, `phone_number`, `user_email`, `dob`, `Profile`, `cnic`) VALUES
(2, NULL, 3, 'Head', '03302388406', 'syedammadali@outlook.com', '22 August 1999', '668be8de5dd8b.jpg', '421015881789');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `batch_id`, `faculty_id`, `title`, `description`, `due_date`) VALUES
(7, 7, 68, 'R2 Practical', 'hsadkjhsakjhd hadlhsakljdsdfjdshf hsajkdhsauh jsaduwaudh iads', '2024-08-18'),
(8, 9, 88, 'R3 Practical ', 'Its a php Practical', '2024-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `batch_id`, `attendance_date`, `status`) VALUES
(1, 32, 7, '2024-07-29', 'Present'),
(2, 33, 7, '2024-07-29', 'Present'),
(3, 35, 7, '2024-07-29', 'Present'),
(10, 34, 9, '2024-08-02', 'Present'),
(11, 34, 9, '2024-08-02', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `batch_id` int(11) NOT NULL,
  `batch_name` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `assigned_faculty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batch_id`, `batch_name`, `start_date`, `end_date`, `department_id`, `assigned_faculty`) VALUES
(7, '2306c2', '2024-07-29', '2026-06-29', NULL, 68),
(8, '2308A2', '2024-07-29', '2026-10-29', NULL, 67),
(9, '23A092', '2024-08-03', '2024-08-30', NULL, 88);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `Course_id` int(11) NOT NULL,
  `Course_Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`Course_id`, `Course_Title`, `Description`, `image`, `student_id`) VALUES
(45, 'ADSE 12', 'Good For Front End Developers', '66a6a5f90a7ca.png', NULL),
(47, 'Web Development', 'its a very good course for beginner', '66a694897cab2.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) DEFAULT NULL,
  `head_of_department` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `contact_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `head_of_department`, `location`, `contact_details`) VALUES
(3, 'Admin', 31, '3rd Floor', '0013258658'),
(4, 'Human Resourse Department', 28, '3rd Floor', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `performance_reviews` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `cnic` varchar(12) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `user_id`, `designation`, `hire_date`, `salary`, `performance_reviews`, `email`, `cnic`, `profile`, `pic`) VALUES
(1, NULL, 'Faculty', NULL, NULL, NULL, '', '', '', ''),
(2, NULL, 'Faculty', '2024-07-29', 25000.00, 'ksdjfhjkfsh alka joiad ;lajiwna djsnd uwoi', 'noodles78@gmail.com', '', '', ''),
(5, NULL, 'Faculty', '2024-08-02', 25000.00, 'overall good', 'Noodle4516@gmail.com', '', '', ''),
(6, NULL, 'Faculty', '0000-00-00', 5000.00, 'Overall Very Good ', 'syedanasali123@outlook.com', '165165658451', '', ''),
(7, NULL, 'Faculty', NULL, NULL, NULL, 'spagatti12@gmail.com', '5468415548', '', ''),
(8, NULL, 'Faculty', NULL, NULL, NULL, 'spagatti1234@gmail.com', '5468415548', '', '66ad2587c5c8b.png'),
(9, NULL, 'Faculty', '2024-08-02', 2555.00, 'Very Baaaaad!!!', 'basimzaki12@gmail.com', '546841554813', '66ad451a3288f.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`attendance_id`, `employee_id`, `attendance_date`, `status`) VALUES
(1, 2, '2024-08-01', 'Present'),
(2, 5, '2024-08-01', 'Absent'),
(3, 6, '2024-08-01', 'Present'),
(4, 2, '2024-08-02', 'Absent'),
(5, 5, '2024-08-02', 'Present'),
(6, 6, '2024-08-02', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `organizer_id` int(11) DEFAULT NULL,
  `registration_deadline` date DEFAULT NULL,
  `max_attendees` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `description`, `event_date`, `location`, `organizer_id`, `registration_deadline`, `max_attendees`) VALUES
(2, 'M Furqan Siddiqui', 'hfdfsfgfjhyujjk', '2024-07-08', 'ytfgvjhgu gu', 28, '2024-07-17', 456);

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE `hr` (
  `hr_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `contact_details` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `DOB` varchar(255) NOT NULL,
  `CNIC` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hr`
--

INSERT INTO `hr` (`hr_id`, `user_id`, `department_id`, `role`, `contact_details`, `email`, `DOB`, `CNIC`, `profile`) VALUES
(7, NULL, 4, 'Senior', NULL, 'Noodles1234@gmail.com', '2024-07-01', '468681688483', '66ad17296335d.png'),
(8, NULL, 4, 'Senior', NULL, 'penniesaviour123@gmail.com', '2024-07-31', '25651546885', '66aa3fd89ec0f.png');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registration_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `payment_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `current_courses` text DEFAULT NULL,
  `CNIC` int(11) NOT NULL,
  `Father_Name` varchar(100) NOT NULL,
  `Father_Occupation` int(50) NOT NULL,
  `Guardian_Phone` int(11) NOT NULL,
  `Profile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_id`, `batch_id`, `program`, `current_courses`, `CNIC`, `Father_Name`, `Father_Occupation`, `Guardian_Phone`, `Profile`, `email`) VALUES
(21, NULL, 9, 'ADSE', 'FrontEnd-Dev', 45654646, 'Ali', 0, 356513655, '66913d10dc580.jpeg', 'syedanasali@outlook.com'),
(23, NULL, NULL, 'ADSE', 'BackEnd-Dev', 2147483647, 'Ali', 0, 2147483647, '6691465aa8ffb.jpeg', 'syedammadali@outlook.com'),
(24, NULL, NULL, 'ADSE', 'FrontEnd-Dev', 2147483647, 'Ammasd', 0, 46540813, '669aa6a6b6c41.png', 'Murghi@gmail.com'),
(25, NULL, NULL, 'ADSE', 'FrontEnd-Dev', 2147483647, 'Abcasdjsha bd', 0, 46540813, '669aa6db82b7e.png', 'Murghi123@gmail.com'),
(26, NULL, NULL, 'ADSE', 'FrontEnd-Dev', 2147483647, 'Abcasdasdw', 0, 46540813, '669aa7261a33a.png', 'bkri@gmail.com'),
(28, NULL, NULL, 'ADSE', 'FrontEnd-Dev', 2147483647, 'Abcasadsad', 0, 46540813, '669aa776b6994.png', 'bkri1@gmail.com'),
(29, NULL, NULL, 'ADSE', 'FrontEnd-Dev', 2147483647, 'Abcasadsad2', 0, 46540813, '669aa78b3730e.png', 'bkri3@gmail.com'),
(32, NULL, 7, 'ADSE', 'FrontEnd-Dev', 2147483647, 'magie3', 0, 45468465, '669aa940b5401.jpeg', 'maggie23@gmail.com'),
(33, NULL, 7, 'ADSE', 'FrontEnd-Dev', 56431653, 'Maggie', 0, 465531654, '669aa9b80a156.jpeg', 'maggie45@gmail.com'),
(34, NULL, 9, 'ADSE', 'FrontEnd-Dev', 56431653, 'Maggie564', 0, 465531654, '669aaa7369092.png', 'maggie10@gmail.com'),
(35, NULL, 7, 'ADSE', 'FrontEnd-Dev', 56431653, 'Maggie56454', 0, 465531654, '669aaaa1e34dd.png', 'maggie105@gmail.com'),
(36, NULL, NULL, 'Computer Science', 'Algorithms', 2147483647, 'Bkri', 0, 0, '66aa59a921255.png', 'Noodles5@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `submission_date` date NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `marks` int(11) NOT NULL DEFAULT 0,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`submission_id`, `assignment_id`, `student_id`, `submission_date`, `file_path`, `marks`, `feedback`) VALUES
(4, 7, 45, '2024-08-11', 'assignments/Spring 2024_CS504_2.docx', 0, ''),
(5, 7, 46, '2024-08-11', 'assignments/Spring 2024_CS504_2.docx', 0, ''),
(6, 7, 35, '2024-08-11', 'assignments/Assignment-Dynamic Website Development using PHP-7062 [Last updated on 13 Oct 2022].docx', 0, ''),
(7, 8, 46, '2024-08-11', 'assignments/ViewHr.php', 0, ''),
(8, 8, 28, '2024-08-12', 'assignments/Fall 2023_CS403_2.pdf', 0, ''),
(11, 8, 28, '2024-08-12', 'assignments/Fall 2023_CS403_2.pdf', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('Student','Admin','HR','Employee') NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `gender` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `email`, `full_name`, `is_approved`, `address`, `phone_number`, `gender`) VALUES
(28, 'Ammad', '$2y$10$XZsb5Nq58W0/LS8i1iouheVWHHyh6EuCjPyyE1ZSK9mP0ExQjgpJq', 'Student', 'syedanasali@outlook.com', 'Syed Ammad Ali', 1, '2 F 7/5 Nazimabad, Karachi, Sindh', '465465465', 'male'),
(31, 'Ammad2', '$2y$10$ny6nw698STZfUBu8oJ4TneTpR/66l6ChonW4EsjTTJz/CjM4BlwsK', 'Admin', 'syedammadali@outlook.com', 'Syed Ammad Ali', 1, 'Punjabi Saudagar', '03302388406', 'male'),
(32, 'Isadkhj', '$2y$10$FGBw4Jvk8xCZv8mFJ0v3oual0DTxAKm30TBdaBJE8ajVGbWWWYIK2', 'Student', 'Murghi@gmail.com', 'Murghi', 0, '123 Street  Karachi', '231046480', ''),
(34, 'Isadkshadjk', '$2y$10$wRmDL2A00rcf2mjCtAPluu8mvNCXv2l2/erhXqm71F6RIXLp1LGPm', 'Student', 'Murghi123@gmail.com', 'Murghi123', 0, '123 Street  Karachi', '231046480', ''),
(35, '4656', '$2y$10$JmM7/nn4H6tbtEb.09emkOxwYfF44QgKTk9PyDj0wKW5e0TG5zHFG', 'Student', 'bkri@gmail.com', 'bkri', 3, '123 Street  Karachi', '231046480', 'male'),
(36, 'Bkri', '$2y$10$nQ2/bPQ1NaDLs3Y4po86guVeIwWU5VVbWn8LmB0z/wDai7xg/y9ka', 'Student', 'bkri123@gmail.com', 'bkri', 1, '123 Street  Karachi', '231046480', 'male'),
(37, 'Bkri1', '$2y$10$ryLq/31lRhrS6F.3uGc71equy9qp7lhv7weDW4fh5K5gi8Kvv1IZq', 'Student', 'bkri1@gmail.com', 'bkri2', 0, '123 Street  Karachi', '231046480', ''),
(38, 'Bkri2', '$2y$10$MMV8fcMo0CqOJJNrYEeHyuP/CTQqoR8ttFo29PPjRhJWLgbMhmugS', 'Student', 'bkri3@gmail.com', 'bkri3', 0, '123 Street  Karachi', '231046480', ''),
(39, 'murghi1', '$2y$10$MN3y6wMwyvWYWLnM/naNgeJCirugbkZum3RmJRjvPjit7ZeWh/wSG', 'Student', 'murgi1@outlook.com', 'murgi1', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '1235646', ''),
(40, 'murghi2', '$2y$10$EryBgLKLLzeKO9ILyToJguxu9udZeCjKGId7E3MicuOujlChcIU62', 'Student', 'murgi12@outlook.com', 'murgi2', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '1235646', ''),
(41, 'murghi3', '$2y$10$jVSPNf4Y9DOH.C.FrsZ/h.H8xtghmqIAbstrhHR.1j8X2xAKT/3nO', 'Student', 'murgi3@outlook.com', 'murgi3', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '1235646', ''),
(42, 'Maggie', '$2y$10$bUpBso2twyJLgbPNSbLHc.8ghZVeFtgqA1TYwVcfytZC8NuS3XTXm', 'Student', 'maggie@gmail.com', 'Ali', 0, 'absajhdjkhsad', '13546465', ''),
(43, 'Maggie2', '$2y$10$c/kBMeyvMEjOvCch4tzczuECTVXy5OTXjaQUcjT0GA2LGjSfrC6zW', 'Student', 'maggie2@gmail.com', 'Ali', 1, 'absajhdjkhsad', '13546465', 'male'),
(44, 'Maggie3', '$2y$10$ae/miI54j6Q44mgNsQapkO88Dzs8/Ylmfg2aDX4YM2VHYULSX6Mye', 'Student', 'maggie23@gmail.com', 'Ali', 1, 'absajhdjkhsad', '13546465', 'male'),
(45, 'Maggie4', '$2y$10$OK6g.fMNwbQRpXIVpce.RO2jri/H9vpVKmnBR2XeOxI2IIPUBrsSK', 'Student', 'maggie45@gmail.com', 'Maggiue', 1, 'sadhjksadjasdjhksd', '56468465684', 'male'),
(46, 'Maggie45', '$2y$10$LS6xRMDhVvN3D4NfJDLnseViNyp56b4xk1xmNwmLLHWuuaAwtR.9.', 'Student', 'maggie10@gmail.com', 'Maggiue', 1, 'sadhjksadjasdjhksd', '56468465684', 'male'),
(47, 'Maggie453', '$2y$10$RQ5Q26vr.dnHssAvb109ZOElbZKPYK2BXqwfVvuG3IDd6n.F3JaP6', 'Student', 'maggie105@gmail.com', 'Maggiue', 1, 'sadhjksadjasdjhksd', '56468465684', 'male'),
(48, 'Noodles', '$2y$10$eCzQym4RRexcCafJnfnkQ.SVaHQBilaLzwfU/2e0JLsBamaucThY.', 'Student', 'noodles@gmail.com', 'Noodles', 0, 'R43 Punjabi Saudagar', '03302388406', ''),
(62, 'Sause', '$2y$10$LszdQmOFaB0OiHbLlFpDWefmwi5OF3967guc63t.AxVupr1YoIQde', 'Employee', 'sause@gmail.com', 'Sause 123', 0, '123 Street  Karachi', '', ''),
(65, 'nOodles1', '$2y$10$UlY9BAuelaqrQb29p3rltOwWVQ0JxYQw0h2ggmfVruTzqpE8Eq3Vi', 'Employee', 'noodles78@gmail.com', 'noodles78', 1, '123 Street  Karachi', '32132131', 'male'),
(66, 'Noodle456', '$2y$10$6zTKgLlPJGyMsKSRNUOKoe1N2TvHR0k2U.WeURhi5zXa4SOUTb6FK', 'Employee', 'Noodle456@gmail.com', 'Noodle456', 0, '132 kjasdljioj ioa aiasdj', '1123106251', ''),
(67, 'Noodle4561', '$2y$10$6BTGuilIBF/7LeSkNVPeDu5XjpyKu7luDBAF2AY/NJEUeJ0ETT3qu', 'Employee', 'Noodle4516@gmail.com', 'Noodle4561', 1, '132 kjasdljioj ioa aiasdj', '1123106251', ''),
(68, 'Anas', '$2y$10$nDqlrtdEDkCJlhn4cLfTOu9Sm8jYxdO0AauQ8USk7T9wYX9FikZym', 'Employee', 'syedanasali123@outlook.com', 'Syed Anas Ali', 1, '2 F 7/5 Nazimabad, Karachi, Sindh', '031651545', 'male'),
(73, 'Noodles123421', '$2y$10$bYxVT902fuex.7x/m.6H1uBD5kFELhO/UVsY7rR0ssML5yLSwjliu', 'HR', 'Noodles1234@gmail.com', 'Noodles1234210', 1, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'female'),
(74, 'penniesaviour123', '$2y$10$sjOdGK25Ck2ieKmQhfo0/ucqTs9B7aTr8CFLdDXCrrmf.X9WDIqpa', 'HR', 'penniesaviour123@gmail.com', 'penniesaviour123', 1, '56sad54s 4sa54fdas ', '3302388406', ''),
(75, 'noodles5', '$2y$10$5dGxmXtZL0xIHayMjvQiGOuW04nsw2OelxZnLLjk63UGrz9/Sh3wO', 'Student', 'Noodles5@gmail.com', 'Noodles Bki', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', ''),
(76, 'BaasimZaki', '$2y$10$8T1OhF1yuHWv9CldX3WYLumPjWx83LQZlQzpfwikrGIOelg1.G88i', 'Employee', 'baasimzaki@gmail.com', 'M. Baasim Zaki', 0, 'house no R43, Punjabi Saudagar Society Phase 1 Scheme 33 Karachi', '3302388488', 'male'),
(77, 'BaasimZaki1', '$2y$10$ciWFORosX/2SAsG/HQRbI.JUgKlxVUIYPvJnqf7Yd9vtkK6bwg6Au', 'Employee', 'baasimzaki1@gmail.com', 'BaasimZaki', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male'),
(78, 'BaasimZaki12', '$2y$10$s3ctTORraRXotIt4uq78vep1GiswHAMgF0gdRfjYmD5CeztogWBBe', 'Employee', 'baasimzaki12@gmail.com', 'BaasimZaki', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male'),
(79, 'Unzila1123', '$2y$10$bRxxwmD8iiOpKuOqvHqf0uBaw5DwGhF9B13qAx7MjPvUYw9J9LwrG', 'Employee', 'hsdahd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male'),
(80, 'Unzila11232', '$2y$10$h814pMOvzFuk0tl9DLLcX.jIY3TD0jNiCmlgW055KFVjO5FtcUM0.', 'Employee', 'hsda2hd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male'),
(81, 'Unzila11', '$2y$10$pcv0JhhpODIhLD7NnxjBSOeimqeyGRTMfbUGWjrrypvz7yoHqmc2G', 'Employee', 'hs2da2hd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male'),
(82, 'Unzila115', '$2y$10$ZSt9HY9P6lcMQcwZU33CJunQzXJ7Tjl5m8K2mLC9H9uTdCYgIWYbi', 'Employee', 'hs2da22hd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male'),
(83, 'spagatti', '$2y$10$kai99v63ho2qmmBrtHUqMuTflW1cbGJf54Uk8M.Xs0M6QbrtNXXo.', 'Employee', 'spagatti@gmail.com', 'spagatti', 0, '2f 7/5 Nazimabad', '054684235', 'male'),
(84, 'spagatti1', '$2y$10$IXTcq2R2NFTkoYBez0r6t.MFU5XAistPuVQIBCHRGE4sm/ZGtXooG', 'Employee', 'spagatti1@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male'),
(85, 'spagatti12', '$2y$10$/nWLBdGGZy2XHo7QFDX23.NJmM8NUBOwRtIXi2Jv/gr3fHF53RY42', 'Employee', 'spagatti12@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male'),
(86, 'spagatti123', '$2y$10$/55zW6P2IM0LjkmhLP9ggO4ifFzJcNKpKCKrqG8BHWmv1KgqTe6Yi', 'Employee', 'spagatti123@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male'),
(87, 'spagatti1234', '$2y$10$WrMe3gjynTN1fmHo4kdK2.9.QAy.WGYmX7j.1j5aeWLbs6d6uZzMm', 'Employee', 'spagatti1234@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male'),
(88, 'spagatti99', '$2y$10$chmMNdhh1nI6OK3../7HxuiNO6TtZXM7zzC.nNx3X/dMyzRRI4Vym', 'Employee', 'basimzaki12@gmail.com', 'spagatti', 1, 'R43 Punjabi Saudagar Society', '05468423555', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `assignments_ibfk_1` (`batch_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`batch_id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `assigned_faculty` (`assigned_faculty`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`Course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `head_of_department` (`head_of_department`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`hr_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `hr_ibfk_3` (`email`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `Course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admins` (`admin_id`),
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `students` (`batch_id`);

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batches_ibfk_2` FOREIGN KEY (`assigned_faculty`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`head_of_department`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD CONSTRAINT `employee_attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `hr`
--
ALTER TABLE `hr`
  ADD CONSTRAINT `hr_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_ibfk_3` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`assignment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
