-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 02:22 AM
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
-- Database: `online_course_management`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddCourse` (IN `p_title` VARCHAR(255), IN `p_description` TEXT, IN `p_duration` INT)   BEGIN
    INSERT INTO Courses (title, description, duration)
    VALUES (p_title, p_description, p_duration);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddMaterial` (IN `p_course_id` INT, IN `p_title` VARCHAR(255), IN `p_description` TEXT, IN `p_embed_link` TEXT)   BEGIN
    INSERT INTO Materials (course_id, title, description, embed_link)
    VALUES (p_course_id, p_title, p_description, p_embed_link);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteCourse` (IN `p_id` INT)   BEGIN
    DELETE FROM Courses
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteMaterial` (IN `p_id` INT)   BEGIN
    DELETE FROM Materials
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCourse` (IN `p_id` INT, IN `p_title` VARCHAR(255), IN `p_description` TEXT, IN `p_duration` INT)   BEGIN
    UPDATE Courses
    SET title = p_title,
        description = p_description,
        duration = p_duration
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateMaterial` (IN `p_id` INT, IN `p_title` VARCHAR(255), IN `p_description` TEXT, IN `p_embed_link` TEXT)   BEGIN
    UPDATE Materials
    SET title = p_title,
        description = p_description,
        embed_link = p_embed_link
    WHERE id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `duration`) VALUES
(1, 'qqaa', 'qqqaa', 0),
(2, 'Pengembangan Aplikasi Web Lanjutan', 'Mendalami framework seperti React.js dan Vue.js serta pengembangan aplikasi web yang lebih kompleks.', 15),
(3, 'Dasar-Dasar Database', 'Kursus ini membahas konsep dasar database, SQL, dan cara menggunakan database relasional.', 8),
(6, 'Belajar HTML & CSS', 'Kursus ini mencakup dasar-dasar HTML dan CSS untuk membangun halaman web statis.', 12),
(7, 'JavaScript untuk Pemula', 'Pendahuluan ke JavaScript, mencakup sintaks dasar, DOM, dan event handling.', 15),
(8, 'Pengembangan Web dengan React.js', 'Membangun aplikasi web interaktif menggunakan React.js. Edisi 5', 203);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `embed_link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `course_id`, `title`, `description`, `embed_link`) VALUES
(1, 1, 'qqaa', 'qqqaa', 'qw'),
(2, 1, 'Pengantar JavaScript1', 'Pendahuluan ke JavaScript, termasuk sintaks dan konsep dasar.', 'https://example.com/embed/javascript-introduction'),
(3, 2, 'Memulai dengan React.js', 'Tutorial untuk memulai dengan React.js, termasuk komponen dan state management.', 'https://example.com/embed/react-introduction'),
(5, 3, 'Dasar-Dasar SQL', 'Memahami dasar-dasar SQL', 'https://example.com/embed/sql-basics'),
(26, 1, 'qqaa', 'qqq', 'qwaaa');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(10) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `Username`, `Password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
