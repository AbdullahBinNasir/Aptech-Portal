-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 05:11 AM
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
(2, NULL, 3, 'Head', '03302388406', 'syedammadali@outlook.com', '', '668be8de5dd8b.jpg', '421015881789');

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
(8, 9, 88, 'R3 Practical ', 'Its a php Practical', '2024-08-18'),
(10, 9, 88, 'R5 Practical', 'ahsjkdsajkhd ashdjkshaiuwad gasdkjh', '2024-08-20');

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
(11, 34, 9, '2024-08-02', 'Present'),
(12, 21, 9, '2024-08-14', 'Present'),
(13, 34, 9, '2024-08-14', 'Present');

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
(7, '2306c2', '2024-08-24', '2026-06-09', NULL, 68),
(8, '2308A2', '2024-07-29', '2026-10-29', NULL, 67),
(9, '23A092', '2024-08-03', '2024-08-30', NULL, 88);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `year`) VALUES
(4, 'PHP', 'Aptech', '2020'),
(5, 'BMW', 'Aptech', '2019'),
(6, 'Version Controle', 'Aptech', '2022'),
(7, 'Laravel', 'Aptech', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `room_name`, `created_on`, `user_id`, `userid`, `msg`) VALUES
(5, '', '2024-08-14 04:58:36', NULL, 12, 'Hello Everyone'),
(6, '', '2024-08-14 04:58:50', NULL, 10, 'Hi Shamsi'),
(7, '', '2024-08-15 06:34:40', NULL, 10, '123'),
(8, '', '2024-08-16 07:33:21', NULL, 10, 'hi\n'),
(9, '', '2024-08-16 07:37:12', NULL, 12, 'hi\n'),
(10, '', '2024-08-17 03:55:56', NULL, 31, 'hi'),
(11, '', '2024-08-17 04:08:34', NULL, 31, 'wot doing\n'),
(12, '', '2024-08-17 04:08:40', NULL, 28, 'Nothing'),
(13, '', '2024-08-17 04:08:53', NULL, 31, 'y\n'),
(14, '', '2024-08-17 04:09:00', NULL, 28, 'meri mrzi'),
(15, '', '2024-08-17 04:19:41', NULL, 31, 'Hi'),
(16, '', '2024-08-17 04:20:14', NULL, 28, 'wot'),
(17, '', '2024-08-18 04:24:12', NULL, 88, 'nothing'),
(18, '', '2024-08-18 04:24:44', NULL, 88, '123'),
(19, '', '2024-08-18 04:29:34', NULL, 88, '123'),
(20, '', '2024-08-18 04:34:02', NULL, 88, 'hi'),
(21, '', '2024-08-18 04:34:11', NULL, 31, 'why'),
(22, '', '2024-08-18 04:50:03', NULL, 88, 'hi'),
(23, '', '2024-08-18 04:50:26', NULL, 31, 'aaa'),
(24, '', '2024-08-18 05:01:20', NULL, 31, 'asd'),
(25, '', '2024-08-18 05:01:41', NULL, 88, 'asda'),
(26, '', '2024-08-18 05:03:26', NULL, 31, 'asd'),
(27, '', '2024-08-18 05:09:22', NULL, 31, 'hi'),
(28, '', '2024-08-18 05:27:18', NULL, 28, 'sad'),
(29, '', '2024-08-18 05:27:29', NULL, 31, 'asdsad'),
(30, '', '2024-08-18 05:33:07', NULL, 88, 'asdsad'),
(31, '', '2024-08-18 05:33:15', NULL, 28, 'sadasd'),
(32, '', '2024-08-18 05:33:20', NULL, 88, 'asdsad'),
(33, '', '2024-08-18 05:33:21', NULL, 88, 'asdsad'),
(34, '', '2024-08-18 05:33:23', NULL, 88, 'asdsadsd'),
(35, '', '2024-08-18 05:33:28', NULL, 88, 'asdsadsdsad'),
(36, '', '2024-08-18 05:33:28', NULL, 88, 'asdsadsdsad'),
(37, '', '2024-08-18 05:33:36', NULL, 88, 'sadasd'),
(38, '', '2024-08-18 05:33:43', NULL, 88, 'abc'),
(39, '', '2024-08-18 05:34:07', NULL, 88, 'asd'),
(40, '', '2024-08-18 05:34:12', NULL, 28, 'e'),
(41, '', '2024-08-18 05:38:07', NULL, 28, 'abc'),
(42, '', '2024-08-18 05:38:21', NULL, 31, 'asdasd'),
(43, '', '2024-08-18 05:43:03', NULL, 31, 'asda'),
(44, '', '2024-08-18 05:43:12', NULL, 28, 'sad'),
(45, '', '2024-08-18 05:54:43', NULL, 31, '123'),
(46, '', '2024-08-18 05:55:02', NULL, 28, '456'),
(47, '', '2024-08-18 05:55:11', NULL, 31, '123'),
(48, '', '2024-08-18 05:55:22', NULL, 28, '123'),
(49, '', '2024-08-18 05:55:37', NULL, 31, '456'),
(50, '', '2024-08-18 05:59:06', NULL, 28, 'asd'),
(51, '', '2024-08-18 05:59:22', NULL, 31, 'asd'),
(52, '', '2024-08-18 06:00:24', NULL, 88, '123'),
(53, '', '2024-08-18 06:54:35', NULL, 31, 'sada'),
(54, '', '2024-08-19 07:00:06', NULL, 88, 'asd'),
(55, '', '2024-08-19 07:10:45', NULL, 31, 'asds'),
(56, '', '2024-08-19 07:10:58', NULL, 28, 'sasd'),
(57, '', '2024-08-19 07:12:12', NULL, 31, 'asdasd'),
(58, '', '2024-08-19 07:15:34', NULL, 28, 'sad'),
(59, '', '2024-08-19 07:15:54', NULL, 88, 'sadsad'),
(60, '', '2024-08-19 07:18:13', NULL, 28, 'sadasd'),
(61, '', '2024-08-19 07:27:44', NULL, 31, 'hi'),
(62, '', '2024-08-19 07:32:39', NULL, 88, 'asdsd'),
(63, '', '2024-08-19 07:37:32', NULL, 88, 'sad'),
(64, '', '2024-08-19 07:37:47', NULL, 88, 'sad'),
(65, '', '2024-08-19 07:38:42', NULL, 88, 'asdsa'),
(66, '', '2024-08-19 07:39:14', NULL, 88, 'asd'),
(67, '', '2024-08-19 07:39:57', NULL, 88, 'sad'),
(68, '', '2024-08-19 07:40:22', NULL, 88, 'asd'),
(69, '', '2024-08-19 07:44:50', NULL, 31, 'asd'),
(70, '', '2024-08-19 07:53:25', NULL, 31, 'adsa'),
(71, '', '2024-08-19 07:53:49', NULL, 31, 'asd'),
(72, '', '2024-08-19 07:54:50', NULL, 88, 'ammad\n'),
(73, '', '2024-08-19 07:57:57', NULL, 28, 'asdsad'),
(74, '', '2024-08-18 20:02:07', NULL, 31, 'asd'),
(75, '', '2024-08-18 20:03:15', NULL, 28, 'sadad'),
(76, '', '2024-08-18 20:08:00', NULL, 31, 'sadads'),
(77, '', '2024-08-18 20:08:12', NULL, 28, 'sad'),
(78, '', '2024-08-18 20:09:54', NULL, 28, 'asd'),
(79, '', '2024-08-18 20:13:20', NULL, 28, 'asdsad'),
(80, '', '2024-08-18 20:13:27', NULL, 31, 'asd'),
(81, '', '2024-08-18 20:13:35', NULL, 28, 'asd'),
(82, '', '2024-08-18 20:13:39', NULL, 31, 'sad'),
(83, '', '2024-08-18 20:13:46', NULL, 31, 'asdsad'),
(84, '', '2024-08-18 20:14:13', NULL, 28, 'sad'),
(85, '', '2024-08-18 20:14:24', NULL, 31, 'asdasd'),
(86, '', '2024-08-18 20:14:43', NULL, 28, '321'),
(87, '', '2024-08-18 20:21:33', NULL, 28, 'adssa'),
(88, '', '2024-08-18 20:21:58', NULL, 31, 'asdasd'),
(89, '', '2024-08-18 20:25:42', NULL, 28, 'asda'),
(90, '', '2024-08-18 20:27:35', NULL, 28, 'asdasd'),
(91, '', '2024-08-18 20:29:42', NULL, 28, 'sadasd'),
(92, '', '2024-08-18 20:41:22', NULL, 31, 'asdasd'),
(93, '', '2024-08-18 20:41:33', NULL, 28, 'asd'),
(94, '', '2024-08-18 20:41:40', NULL, 28, 'asd'),
(95, '', '2024-08-18 20:41:55', NULL, 31, 'asdsad'),
(96, '', '2024-08-18 20:42:10', NULL, 28, 'asdasd'),
(97, '', '2024-08-18 20:42:33', NULL, 28, 'sad'),
(98, '', '2024-08-18 20:42:54', NULL, 31, 'asdasd'),
(99, '', '2024-08-18 20:42:58', NULL, 28, 'sadad'),
(100, '', '2024-08-18 20:43:15', NULL, 31, 'sadasd'),
(101, '', '2024-08-18 20:43:30', NULL, 31, 'abc'),
(102, '', '2024-08-18 20:43:53', NULL, 31, 'asd'),
(103, '', '2024-08-18 20:45:59', NULL, 31, 'asd'),
(104, '', '2024-08-18 20:46:06', NULL, 31, 'avc\n'),
(105, '', '2024-08-18 20:47:03', NULL, 88, 'asd'),
(106, '', '2024-08-19 00:15:57', NULL, 0, 'asdasd\n'),
(107, '', '2024-08-19 00:16:29', NULL, 0, 'asd'),
(108, '', '2024-08-19 00:16:51', NULL, 0, 'asdad'),
(109, '', '2024-08-19 00:17:24', NULL, 0, 'abc'),
(110, '', '2024-08-19 00:18:44', NULL, 0, 'asd'),
(111, '', '2024-08-19 00:19:01', NULL, 0, 'bca'),
(112, '', '2024-08-19 00:19:43', NULL, 0, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `from_user_id`, `to_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 31, 28, 'hi', '2024-08-17 09:01:24', 'Yes'),
(2, 28, 31, 'Hi', '2024-08-17 09:23:29', 'Yes'),
(3, 31, 28, 'ammad', '2024-08-19 02:50:08', 'Yes'),
(4, 28, 31, 'asd', '2024-08-19 02:50:57', 'Yes');

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
(9, NULL, 'Faculty', '2024-08-02', 2555.00, 'Very Baaaaad!!!', 'basimzaki12@gmail.com', '546841554813', '66ad451a3288f.png', ''),
(11, NULL, 'Faculty', '2024-08-14', 5000.00, 'Goood', 'syedammadali17@gmail.com', '421015881789', '', ''),
(12, NULL, 'Faculty', NULL, NULL, NULL, 'gamermonster2017@gmail.com', '421015881789', '66c8ced620507.png', '');

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
  `max_attendees` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `description`, `event_date`, `location`, `organizer_id`, `registration_deadline`, `max_attendees`, `image`) VALUES
(3, 'Aptech Vision', 'This is a very Good Event', '2024-08-23', 'Taj Banquet', 31, '2024-08-24', 50, '66c8b32f19db3.png');

-- --------------------------------------------------------

--
-- Table structure for table `e_project_assignments`
--

CREATE TABLE `e_project_assignments` (
  `assignment_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `Group_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_project_assignments`
--

INSERT INTO `e_project_assignments` (`assignment_id`, `batch_id`, `student_id`, `Group_Id`) VALUES
(4, 7, 32, 1),
(6, 7, 35, 10),
(7, 7, 32, 1),
(8, 7, 35, 5);

-- --------------------------------------------------------

--
-- Table structure for table `e_submissions`
--

CREATE TABLE `e_submissions` (
  `submission_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `submission_file` varchar(255) DEFAULT NULL,
  `submission_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_submissions`
--

INSERT INTO `e_submissions` (`submission_id`, `project_id`, `group_id`, `submission_file`, `submission_date`) VALUES
(12, 4, 3, 'Schema.docx', '2024-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_feedback`
--

CREATE TABLE `faculty_feedback` (
  `feedback_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `class_timing` varchar(50) NOT NULL,
  `covered_topics` varchar(10) NOT NULL,
  `lab_guidance` varchar(50) NOT NULL,
  `clear_teaching` varchar(50) NOT NULL,
  `exams_assignments_timing` varchar(10) NOT NULL,
  `book_utilization` varchar(50) NOT NULL,
  `sar_delivery` varchar(10) NOT NULL,
  `system_complaints` varchar(10) NOT NULL,
  `feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_feedback`
--

INSERT INTO `faculty_feedback` (`feedback_id`, `student_id`, `faculty_id`, `class_timing`, `covered_topics`, `lab_guidance`, `clear_teaching`, `exams_assignments_timing`, `book_utilization`, `sar_delivery`, `system_complaints`, `feedback_date`) VALUES
(15, 28, 88, '4', '4', '4', '4', '4', '4', '4', '4', '2024-08-22'),
(16, 46, 88, '4', '1', '4', '3', '4', '4', '4', '4', '2024-08-22');

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
  `gpa_date` date NOT NULL,
  `student_ID` int(11) NOT NULL,
  `batch_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_gpa`
--

INSERT INTO `faculty_gpa` (`gpa_id`, `faculty_id`, `gpa_class_timing`, `gpa_covered_topics`, `gpa_lab_guidance`, `gpa_clear_teaching`, `gpa_exams_assignments_timing`, `gpa_book_utilization`, `gpa_sar_delivery`, `gpa_system_complaints`, `total_gpa`, `gpa_date`, `student_ID`, `batch_ID`) VALUES
(6, 88, 4, 4, 4, 4, 4, 4, 4, 4, 4, '2024-08-22', 28, 9),
(7, 88, 4, 2.5, 4, 3.5, 4, 4, 4, 4, 3.75, '2024-08-22', 46, 9);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `project_id`, `group_id`, `grade`, `comments`) VALUES
(2, 4, 3, '50', 'gfhghg');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `team_leader_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `batch_id`, `group_name`, `team_leader_id`) VALUES
(2, 9, 'Group 1', 28),
(3, 7, 'Group 2', 44),
(5, 9, 'E-project 1', 28);

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `group_member_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`group_member_id`, `group_id`, `student_id`) VALUES
(2, 2, 34),
(3, 3, 44),
(4, 3, 45),
(5, 3, 47),
(8, 5, 28),
(9, 5, 46);

-- --------------------------------------------------------

--
-- Table structure for table `group_projects`
--

CREATE TABLE `group_projects` (
  `project_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `privatechat`
--

CREATE TABLE `privatechat` (
  `chat_message_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `status` enum('Yes','No') DEFAULT 'No',
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `assigned_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `group_id`, `title`, `description`, `attachment`, `assigned_date`, `due_date`) VALUES
(1, 2, 'LAwyer', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Jummah Mubarak.png', '2024-08-24', '2024-10-01'),
(4, 3, 'ashdkjasdkj', 'asjdioafahfhuisfhadjsaldjioaisd', 'Jummah Mubarak.png', '2024-08-24', '2024-09-07'),
(5, 5, 'Lab Automation', 'lorem ispum sajhdskajhdjksahjkdhsjkadhjk khaskdhjk ashdjkashkdhkas ahdishak', 'submissions (1).sql', '2024-08-24', '2024-09-07');

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
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
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
  `feedback` text NOT NULL,
  `Assigned_batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`submission_id`, `assignment_id`, `student_id`, `submission_date`, `file_path`, `marks`, `feedback`, `Assigned_batch`) VALUES
(1, 8, 46, '2024-08-14', 'assignments/Aptech-Favicon.png', 50, 'good Good', 9),
(5, 8, 28, '2024-08-14', 'assignments/vision (11).sql', 40, 'Berry Berry Good', 9),
(6, 8, 32, '2024-08-14', 'assignments/vision (11).sql', 0, '', 7),
(7, 10, 28, '2024-08-15', '../Employee_pannel/assignments/66912310a3f7f.jpeg', 50, 'Good Good', 9);

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
  `gender` varchar(6) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_status` varchar(50) NOT NULL DEFAULT 'Enable',
  `user_connection_id` varchar(255) NOT NULL,
  `user_login_status` varchar(50) NOT NULL,
  `user_profile` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `email`, `full_name`, `is_approved`, `address`, `phone_number`, `gender`, `token`, `user_status`, `user_connection_id`, `user_login_status`, `user_profile`, `user_token`) VALUES
(28, 'Ammad', '$2y$10$XZsb5Nq58W0/LS8i1iouheVWHHyh6EuCjPyyE1ZSK9mP0ExQjgpJq', 'Student', 'syedanasali@outlook.com', 'Syed Ammad Ali', 1, '2 F 7/5 Nazimabad, Karachi, Sindh', '465465465', 'male', '', '', '98', 'Logout', '', '44e4a0e2e3856dd511a2964b232c3e12'),
(31, 'Ammad2', '$2y$10$ny6nw698STZfUBu8oJ4TneTpR/66l6ChonW4EsjTTJz/CjM4BlwsK', 'Admin', 'syedammadali@outlook.com', 'Syed Ammad Ali', 1, 'Punjabi Saudagar 123', '03302388406', 'male', '', 'Enable', '272', 'Logout', '', '3b817b0d05f22f65044dc93ef1fb5ea7'),
(32, 'Isadkhj', '$2y$10$FGBw4Jvk8xCZv8mFJ0v3oual0DTxAKm30TBdaBJE8ajVGbWWWYIK2', 'Student', 'Murghi@gmail.com', 'Murghi', 0, '123 Street  Karachi', '231046480', '', '', '', '295', '', '', ''),
(34, 'Isadkshadjk', '$2y$10$wRmDL2A00rcf2mjCtAPluu8mvNCXv2l2/erhXqm71F6RIXLp1LGPm', 'Student', 'Murghi123@gmail.com', 'Murghi123', 0, '123 Street  Karachi', '231046480', '', '', '', '295', '', '', ''),
(35, '4656', '$2y$10$JmM7/nn4H6tbtEb.09emkOxwYfF44QgKTk9PyDj0wKW5e0TG5zHFG', 'Student', 'bkri@gmail.com', 'bkri', 3, '123 Street  Karachi', '231046480', 'male', '', '', '295', '', '', ''),
(36, 'Bkri', '$2y$10$nQ2/bPQ1NaDLs3Y4po86guVeIwWU5VVbWn8LmB0z/wDai7xg/y9ka', 'Student', 'bkri123@gmail.com', 'bkri', 1, '123 Street  Karachi', '231046480', 'male', '', '', '295', '', '', ''),
(37, 'Bkri1', '$2y$10$ryLq/31lRhrS6F.3uGc71equy9qp7lhv7weDW4fh5K5gi8Kvv1IZq', 'Student', 'bkri1@gmail.com', 'bkri2', 0, '123 Street  Karachi', '231046480', '', '', '', '295', '', '', ''),
(38, 'Bkri2', '$2y$10$MMV8fcMo0CqOJJNrYEeHyuP/CTQqoR8ttFo29PPjRhJWLgbMhmugS', 'Student', 'bkri3@gmail.com', 'bkri3', 0, '123 Street  Karachi', '231046480', '', '', '', '295', '', '', ''),
(39, 'murghi1', '$2y$10$MN3y6wMwyvWYWLnM/naNgeJCirugbkZum3RmJRjvPjit7ZeWh/wSG', 'Student', 'murgi1@outlook.com', 'murgi1', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '1235646', '', '', '', '295', '', '', ''),
(40, 'murghi2', '$2y$10$EryBgLKLLzeKO9ILyToJguxu9udZeCjKGId7E3MicuOujlChcIU62', 'Student', 'murgi12@outlook.com', 'murgi2', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '1235646', '', '', '', '295', '', '', ''),
(41, 'murghi3', '$2y$10$jVSPNf4Y9DOH.C.FrsZ/h.H8xtghmqIAbstrhHR.1j8X2xAKT/3nO', 'Student', 'murgi3@outlook.com', 'murgi3', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '1235646', '', '', '', '295', '', '', ''),
(42, 'Maggie', '$2y$10$bUpBso2twyJLgbPNSbLHc.8ghZVeFtgqA1TYwVcfytZC8NuS3XTXm', 'Student', 'maggie@gmail.com', 'Ali', 0, 'absajhdjkhsad', '13546465', '', '', '', '295', '', '', ''),
(43, 'Maggie2', '$2y$10$c/kBMeyvMEjOvCch4tzczuECTVXy5OTXjaQUcjT0GA2LGjSfrC6zW', 'Student', 'maggie2@gmail.com', 'Ali', 1, 'absajhdjkhsad', '13546465', 'male', '', '', '295', '', '', ''),
(44, 'Maggie3', '$2y$10$ae/miI54j6Q44mgNsQapkO88Dzs8/Ylmfg2aDX4YM2VHYULSX6Mye', 'Student', 'maggie23@gmail.com', 'Ali', 1, 'absajhdjkhsad', '13546465', 'male', '', '', '295', '', '', ''),
(45, 'Maggie4', '$2y$10$OK6g.fMNwbQRpXIVpce.RO2jri/H9vpVKmnBR2XeOxI2IIPUBrsSK', 'Student', 'maggie45@gmail.com', 'Maggiue', 1, 'sadhjksadjasdjhksd', '56468465684', 'male', '', '', '295', '', '', ''),
(46, 'Maggie45', '$2y$10$LS6xRMDhVvN3D4NfJDLnseViNyp56b4xk1xmNwmLLHWuuaAwtR.9.', 'Student', 'maggie10@gmail.com', 'Maggiue', 1, 'sadhjksadjasdjhksd', '56468465684', 'male', '', '', '295', '', '', ''),
(47, 'Maggie453', '$2y$10$RQ5Q26vr.dnHssAvb109ZOElbZKPYK2BXqwfVvuG3IDd6n.F3JaP6', 'Student', 'maggie105@gmail.com', 'Maggiue', 1, 'sadhjksadjasdjhksd', '56468465684', 'male', '', '', '295', '', '', ''),
(48, 'Noodles', '$2y$10$eCzQym4RRexcCafJnfnkQ.SVaHQBilaLzwfU/2e0JLsBamaucThY.', 'Student', 'noodles@gmail.com', 'Noodles', 0, 'R43 Punjabi Saudagar', '03302388406', '', '', '', '295', '', '', ''),
(62, 'Sause', '$2y$10$LszdQmOFaB0OiHbLlFpDWefmwi5OF3967guc63t.AxVupr1YoIQde', 'Employee', 'sause@gmail.com', 'Sause 123', 0, '123 Street  Karachi', '', '', '', '', '295', '', '', ''),
(65, 'nOodles1', '$2y$10$UlY9BAuelaqrQb29p3rltOwWVQ0JxYQw0h2ggmfVruTzqpE8Eq3Vi', 'Employee', 'noodles78@gmail.com', 'noodles78', 1, '123 Street  Karachi', '32132131', 'male', '', '', '295', '', '', ''),
(66, 'Noodle456', '$2y$10$6zTKgLlPJGyMsKSRNUOKoe1N2TvHR0k2U.WeURhi5zXa4SOUTb6FK', 'Employee', 'Noodle456@gmail.com', 'Noodle456', 0, '132 kjasdljioj ioa aiasdj', '1123106251', '', '', '', '295', '', '', ''),
(67, 'Noodle4561', '$2y$10$6BTGuilIBF/7LeSkNVPeDu5XjpyKu7luDBAF2AY/NJEUeJ0ETT3qu', 'Employee', 'Noodle4516@gmail.com', 'Noodle4561', 1, '132 kjasdljioj ioa aiasdj', '1123106251', '', '', '', '295', '', '', ''),
(68, 'Anas', '$2y$10$nDqlrtdEDkCJlhn4cLfTOu9Sm8jYxdO0AauQ8USk7T9wYX9FikZym', 'Employee', 'syedanasali123@outlook.com', 'Syed Anas Ali', 1, '2 F 7/5 Nazimabad, Karachi, Sindh', '031651545', 'male', '', '', '295', '', '', ''),
(73, 'Noodles123421', '$2y$10$bYxVT902fuex.7x/m.6H1uBD5kFELhO/UVsY7rR0ssML5yLSwjliu', 'HR', 'Noodles1234@gmail.com', 'Noodles1234210', 1, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'female', '', '', '295', '', '', ''),
(74, 'penniesaviour123', '$2y$10$sjOdGK25Ck2ieKmQhfo0/ucqTs9B7aTr8CFLdDXCrrmf.X9WDIqpa', 'HR', 'penniesaviour123@gmail.com', 'penniesaviour123', 1, '56sad54s 4sa54fdas ', '3302388406', '', '', '', '295', '', '', ''),
(75, 'noodles5', '$2y$10$5dGxmXtZL0xIHayMjvQiGOuW04nsw2OelxZnLLjk63UGrz9/Sh3wO', 'Student', 'Noodles5@gmail.com', 'Noodles Bki', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', '', '', '', '295', '', '', ''),
(76, 'BaasimZaki', '$2y$10$8T1OhF1yuHWv9CldX3WYLumPjWx83LQZlQzpfwikrGIOelg1.G88i', 'Employee', 'baasimzaki@gmail.com', 'M. Baasim Zaki', 0, 'house no R43, Punjabi Saudagar Society Phase 1 Scheme 33 Karachi', '3302388488', 'male', '', '', '295', '', '', ''),
(77, 'BaasimZaki1', '$2y$10$ciWFORosX/2SAsG/HQRbI.JUgKlxVUIYPvJnqf7Yd9vtkK6bwg6Au', 'Employee', 'baasimzaki1@gmail.com', 'BaasimZaki', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male', '', '', '295', '', '', ''),
(78, 'BaasimZaki12', '$2y$10$s3ctTORraRXotIt4uq78vep1GiswHAMgF0gdRfjYmD5CeztogWBBe', 'Employee', 'baasimzaki12@gmail.com', 'BaasimZaki', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male', '', '', '295', '', '', ''),
(79, 'Unzila1123', '$2y$10$bRxxwmD8iiOpKuOqvHqf0uBaw5DwGhF9B13qAx7MjPvUYw9J9LwrG', 'Employee', 'hsdahd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male', '', '', '295', '', '', ''),
(80, 'Unzila11232', '$2y$10$h814pMOvzFuk0tl9DLLcX.jIY3TD0jNiCmlgW055KFVjO5FtcUM0.', 'Employee', 'hsda2hd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male', '', '', '295', '', '', ''),
(81, 'Unzila11', '$2y$10$pcv0JhhpODIhLD7NnxjBSOeimqeyGRTMfbUGWjrrypvz7yoHqmc2G', 'Employee', 'hs2da2hd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male', '', '', '295', '', '', ''),
(82, 'Unzila115', '$2y$10$ZSt9HY9P6lcMQcwZU33CJunQzXJ7Tjl5m8K2mLC9H9uTdCYgIWYbi', 'Employee', 'hs2da22hd@gmail.com', 'Syed Ammad Ali', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', 'male', '', '', '295', '', '', ''),
(83, 'spagatti', '$2y$10$kai99v63ho2qmmBrtHUqMuTflW1cbGJf54Uk8M.Xs0M6QbrtNXXo.', 'Employee', 'spagatti@gmail.com', 'spagatti', 0, '2f 7/5 Nazimabad', '054684235', 'male', '', '', '295', '', '', ''),
(84, 'spagatti1', '$2y$10$IXTcq2R2NFTkoYBez0r6t.MFU5XAistPuVQIBCHRGE4sm/ZGtXooG', 'Employee', 'spagatti1@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male', '', '', '295', '', '', ''),
(85, 'spagatti12', '$2y$10$/nWLBdGGZy2XHo7QFDX23.NJmM8NUBOwRtIXi2Jv/gr3fHF53RY42', 'Employee', 'spagatti12@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male', '', '', '295', '', '', ''),
(86, 'spagatti123', '$2y$10$/55zW6P2IM0LjkmhLP9ggO4ifFzJcNKpKCKrqG8BHWmv1KgqTe6Yi', 'Employee', 'spagatti123@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male', '', '', '295', '', '', ''),
(87, 'spagatti1234', '$2y$10$WrMe3gjynTN1fmHo4kdK2.9.QAy.WGYmX7j.1j5aeWLbs6d6uZzMm', 'Employee', 'spagatti1234@gmail.com', 'spagatti2', 0, '2f 7/5 Nazimabad', '054684235', 'male', '', '', '295', '', '', ''),
(88, 'spagatti99', '$2y$10$chmMNdhh1nI6OK3../7HxuiNO6TtZXM7zzC.nNx3X/dMyzRRI4Vym', 'Employee', 'basimzaki12@gmail.com', 'spagatti', 1, 'R43 Punjabi Saudagar Society', '05468423555', 'male', '', '', '295', 'Login', '', 'c035bd478d6d1fa6b095bbb5ac614172'),
(90, 'ItsMeMaady', '$2y$10$e54Kdk.zDRPjwHJ5VdyonOF1RXecp7tk20Y2Xtg/TclUqjIeX1yU2', 'Employee', 'syedammadali17@gmail.com', 'Syed Ammad Ali', 1, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', '', '07c11acea38ff1839a00b1d85655746a', '', '295', '', '', ''),
(91, 'Faculty', '$2y$10$ogU5VGZia6ryKOgvXsqc3Oa.YDYt126erpB9TRWI7cIhJKott2yIS', 'Employee', 'gamermonster2017@gmail.com', 'Faculty', 0, '2 F 7/5 Nazimabad, Karachi, Sindh', '3302388406', '', '', 'Enable', '', '', '', '');

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
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

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
-- Indexes for table `e_project_assignments`
--
ALTER TABLE `e_project_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `e_submissions`
--
ALTER TABLE `e_submissions`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `faculty_feedback`
--
ALTER TABLE `faculty_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `faculty_feedback_ibfk_1` (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculty_gpa`
--
ALTER TABLE `faculty_gpa`
  ADD PRIMARY KEY (`gpa_id`),
  ADD KEY `faculty_gpa_ibfk_1` (`faculty_id`),
  ADD KEY `faculty_gpa_ibfk_2` (`student_ID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `groups_ibfk_1` (`batch_id`),
  ADD KEY `groups_ibfk_2` (`team_leader_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`group_member_id`),
  ADD KEY `group_members_ibfk_1` (`group_id`),
  ADD KEY `group_members_ibfk_2` (`student_id`);

--
-- Indexes for table `group_projects`
--
ALTER TABLE `group_projects`
  ADD PRIMARY KEY (`project_id`,`group_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`hr_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `hr_ibfk_3` (`email`);

--
-- Indexes for table `privatechat`
--
ALTER TABLE `privatechat`
  ADD PRIMARY KEY (`chat_message_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `batch_id` (`batch_id`);

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
  ADD KEY `student_id` (`student_id`),
  ADD KEY `Assigned_batch` (`Assigned_batch`);

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
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `e_project_assignments`
--
ALTER TABLE `e_project_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `e_submissions`
--
ALTER TABLE `e_submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faculty_feedback`
--
ALTER TABLE `faculty_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `faculty_gpa`
--
ALTER TABLE `faculty_gpa`
  MODIFY `gpa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `group_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `privatechat`
--
ALTER TABLE `privatechat`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

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
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `chat_message_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `chat_message_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`user_id`);

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
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `e_project_assignments`
--
ALTER TABLE `e_project_assignments`
  ADD CONSTRAINT `e_project_assignments_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`),
  ADD CONSTRAINT `e_project_assignments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `e_submissions`
--
ALTER TABLE `e_submissions`
  ADD CONSTRAINT `e_submissions_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `e_submissions_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `faculty_feedback`
--
ALTER TABLE `faculty_feedback`
  ADD CONSTRAINT `faculty_feedback_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faculty_feedback_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `faculty_gpa`
--
ALTER TABLE `faculty_gpa`
  ADD CONSTRAINT `faculty_gpa_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `faculty_gpa_ibfk_2` FOREIGN KEY (`student_ID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`team_leader_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `group_projects`
--
ALTER TABLE `group_projects`
  ADD CONSTRAINT `group_projects_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `group_projects_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `hr`
--
ALTER TABLE `hr`
  ADD CONSTRAINT `hr_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hr_ibfk_3` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `privatechat`
--
ALTER TABLE `privatechat`
  ADD CONSTRAINT `privatechat_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `privatechat_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_3` FOREIGN KEY (`Assigned_batch`) REFERENCES `batches` (`batch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
