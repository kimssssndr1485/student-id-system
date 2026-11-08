-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2026 at 04:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_id_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middle_initial` varchar(1) NOT NULL DEFAULT '',
  `lastname` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `course` varchar(100) NOT NULL,
  `year_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_number`, `firstname`, `middle_initial`, `lastname`, `date_of_birth`, `course`, `year_level`) VALUES
(1, '2026-0001', 'Sandara', '', 'Pilas', '2005-01-01', 'BS in Information Systems', '2nd Year'),
(2, '2026-0002', 'Mabrick', '', 'Teompa', '2005-01-01', 'BS in Information Systems', '2nd Year'),
(3, '2026-0003', 'Hershie', '', 'Balza', '2005-01-01', 'BS in Information Systems', '2nd Year'),
(4, '2026-0004', 'Alyssa', '', 'Diocson', '2005-01-01', 'BS in Information Systems', '2nd Year'),
(5, '2026-0005', 'Jexy', '', 'Viva', '2005-01-01', 'BS in Information Systems', '2nd Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_number` (`student_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
