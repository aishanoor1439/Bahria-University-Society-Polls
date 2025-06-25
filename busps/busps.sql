-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 03:18 AM
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
-- Database: `busps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `picture`, `bio`, `phonenumber`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$uOt96baoNAjmdyYso8.9BuXgQhUQZVdXRf/Yauzao3PwUFmTrNhui', NULL, NULL, NULL, '2025-06-13 05:11:43', '2025-06-13 05:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `election_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `student_id`, `election_id`, `status`, `note`, `created_at`, `updated_at`) VALUES
(3, 35, 1, 'pending', 'LONDON jaunga', '2025-06-14 07:19:46', '2025-06-21 02:54:26'),
(4, 1, 1, 'approved', '...', '2025-06-14 08:00:48', '2025-06-14 08:00:57'),
(5, 2, 1, 'approved', '...', '2025-06-14 08:20:22', '2025-06-14 08:20:29'),
(6, 1, 2, 'approved', '...', '2025-06-20 00:42:57', '2025-06-20 00:43:14'),
(7, 35, 2, 'pending', ';;', '2025-06-21 02:57:31', '2025-06-21 02:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `election_id` bigint(20) UNSIGNED NOT NULL,
  `manifesto` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `student_id`, `election_id`, `manifesto`, `created_at`, `updated_at`) VALUES
(3, 1, 1, NULL, '2025-06-14 08:00:57', '2025-06-14 08:00:57'),
(4, 2, 1, NULL, '2025-06-14 08:20:29', '2025-06-14 08:20:29'),
(5, 1, 2, NULL, '2025-06-20 00:43:14', '2025-06-20 00:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `election_id` bigint(20) UNSIGNED NOT NULL,
  `society_id` bigint(20) UNSIGNED NOT NULL,
  `election_name` varchar(255) NOT NULL,
  `election_year` year(4) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`election_id`, `society_id`, `election_name`, `election_year`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Presidential Elections', '2025', '2025-06-21', '2025-06-22', 1, '2025-06-13 07:23:41', '2025-06-14 05:58:51'),
(2, 2, 'Vice Presidential Elections', '2025', '2025-06-14', '2025-06-15', 1, '2025-06-14 06:35:57', '2025-06-20 00:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `election_voters`
--

CREATE TABLE `election_voters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `election_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_20_152429_create_admin_table', 1),
(5, '2025_06_04_120828_create_students_table', 1),
(6, '2025_06_04_121834_create_societies_table', 1),
(7, '2025_06_04_121835_create_student_societies_table', 1),
(8, '2025_06_04_121836_create_elections_table', 1),
(9, '2025_06_04_121836_create_positions_table', 1),
(10, '2025_06_04_121837_create_candidates_table', 1),
(11, '2025_06_04_121838_create_election_voters_table', 1),
(12, '2025_06_04_121839_create_results_table', 1),
(13, '2025_06_04_121839_create_votes_table', 1),
(14, '2025_06_05_132113_add_position_id_to_student_societies_table', 1),
(15, '2025_06_06_105846_add_election_name_to_elections_table', 1),
(16, '2025_06_09_115121_create_applications_table', 1),
(17, '2025_06_09_131031_remove_position_id_from_candidates_table', 1),
(18, '2025_06_14_112832_create_votes_table', 1),
(19, '2025_06_23_163440_create_notifications_table', 2),
(20, '2025_06_23_163627_create_notification_views__table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('election_created','application_submitted') NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `related_entity_id` bigint(20) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_views`
--

CREATE TABLE `notification_views` (
  `view_id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `society_id` bigint(20) UNSIGNED NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `society_id`, `position_name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Mentor', NULL, NULL),
(2, 2, 'President', NULL, NULL),
(3, 2, 'Vice President', NULL, NULL),
(4, 2, 'Advisor', NULL, NULL),
(5, 2, 'General Secretary', NULL, NULL),
(6, 2, 'Joint Secretary', NULL, NULL),
(7, 2, 'Director Media', NULL, NULL),
(8, 2, 'Deputy Director Media', NULL, NULL),
(10, 2, 'Director Designing', NULL, NULL),
(11, 2, 'Deputy Director Designing', NULL, NULL),
(13, 2, 'Director Operations', NULL, NULL),
(14, 2, 'Deputy Director Operations', NULL, NULL),
(15, 2, 'Director Marketing', NULL, NULL),
(16, 2, 'Deputy Director Marketing', NULL, NULL),
(17, 2, 'Director Planing & Coordination', NULL, NULL),
(18, 2, 'Deputy Director Planning & Coordination', NULL, NULL),
(19, 2, 'Member', '2025-06-13 05:56:43', '2025-06-13 05:56:43'),
(20, 3, 'Mentor', NULL, NULL),
(21, 3, 'President', NULL, NULL),
(22, 3, 'Vice President', NULL, NULL),
(23, 3, 'General Secretary', NULL, NULL),
(24, 3, 'Secretary', NULL, NULL),
(26, 3, 'Head DGM', NULL, NULL),
(27, 3, 'Vice Head DGM', NULL, NULL),
(28, 3, 'Head Photography', NULL, NULL),
(29, 3, 'Vice Head Photography', NULL, NULL),
(30, 3, 'Head Protocol', NULL, NULL),
(31, 3, 'Vice Head Protocol', NULL, NULL),
(32, 3, 'Head Marketing', NULL, NULL),
(33, 3, 'Vice Head Marketing', NULL, NULL),
(34, 3, 'Head Management', NULL, NULL),
(35, 3, 'Vice Head Management', NULL, NULL),
(36, 3, 'Head Creativity', NULL, NULL),
(37, 3, 'Vice Head Creativity', NULL, NULL),
(38, 3, 'Member', '2025-06-13 06:02:20', '2025-06-13 06:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` bigint(20) UNSIGNED NOT NULL,
  `election_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `total_votes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('XeTvPmnWJRzirUnLvZV9FlWnvtHpPsmR7xS57eXu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRlY2Q1lvVXpoVlcxbW4wb09LSzhJUVpGYzZiRmNSUGRlZVFCRVZzbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9lbGVjdGlvbnMiO31zOjE1OiJMb2dnZWRBZG1pbkluZm8iO2k6MTt9', 1750811595);

-- --------------------------------------------------------

--
-- Table structure for table `societies`
--

CREATE TABLE `societies` (
  `society_id` bigint(20) UNSIGNED NOT NULL,
  `society_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `societies`
--

INSERT INTO `societies` (`society_id`, `society_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Bahria University AI Club', 'Discover, Build, and Connect', NULL, NULL),
(2, 'Bahria University Character Building Society', 'Young Ambassadors of Change', NULL, NULL),
(3, 'Bahria University Community Support Program Club', 'A community that uplifts, supports, and grows together', NULL, NULL),
(4, 'Bahria University Debating Club', 'The stage is set, and the lectern awaits. Stay focused, sharpen your wits, and let the war of words begin.', NULL, NULL),
(5, 'Bahria University Developers Society', 'A society full of enthusiasts and passionate software engineers of the future.', NULL, NULL),
(6, 'Bahria University Dramatics Club', 'Bahria University Ke Dramatic Janasheen!', NULL, NULL),
(7, 'Bahria University Event Management Club', 'EMC is dedicated to bringing the best events for our fellow Bahrians to remember forever.', NULL, NULL),
(8, 'Bahria University Media Club', 'A Family Built on Passion', NULL, NULL),
(9, 'Bahria University Music Club', 'Where passion meets art!', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) DEFAULT NULL,
  `batch_year` int(11) DEFAULT NULL,
  `is_candidate` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `email`, `password`, `department`, `batch_year`, `is_candidate`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Haroon Anjum', 'muhammad.haroon@gmail.com', '$2y$12$LMy5L8Mnvwbrq75g.4JB6OGn6tY9cDKaUxZVtw6M5am2xcZjdBB8e', NULL, NULL, 0, '2025-06-13 06:11:38', '2025-06-13 06:11:38'),
(2, 'Muhammad Muzammil', 'muhammad.muzammil@gmail.com', '$2y$12$nw4kISHBJW5knZCUNSWTduweWfCc7f9pG0uMrbCsaDm1qD7avr7bO', NULL, NULL, 0, '2025-06-13 06:12:14', '2025-06-13 06:12:14'),
(3, 'Ilma Jhanzeib', 'ilma.jhanzeib@gmail.com', '$2y$12$aHO3TdUOK0hIzHIM5cQQLOwp3eVv4nsy8yU1RPo8mL/.QT1Q47CGO', NULL, NULL, 0, '2025-06-13 06:12:45', '2025-06-13 06:12:45'),
(4, 'Maheen Abbas', 'maheen.abbas@gmail.com', '$2y$12$kWrhuJzg/UKEi52BuUK37uamMeL42pft7eOPu2h0MjFi44bBasQOe', NULL, NULL, 0, '2025-06-13 06:13:09', '2025-06-13 06:13:09'),
(6, 'Maleeha Khan', 'maleeha.khan@gmail.com', '$2y$12$B6RBneTfY.F8yPiybNSa8.5gIId13jv.yz0dQpkC/X/2sp.ZnEpSy', NULL, NULL, 0, '2025-06-13 06:14:28', '2025-06-13 06:14:28'),
(7, 'Omar Sudhir', 'omar.sudhir@gmail.com', '$2y$12$JnoRKo4P5YdX4nsxLINOEOry4NJDRQcqsbXiBV3eT1L99ZNKhcN92', NULL, NULL, 0, '2025-06-13 06:14:53', '2025-06-13 06:14:53'),
(8, 'Saba Sharif', 'saba.sharif@gmail.com', '$2y$12$Y/u79uJO683j.jFk/bjsw.2R48euTNQEX42fJn/idFa6nn11LaxX2', NULL, NULL, 0, '2025-06-13 06:15:28', '2025-06-13 06:15:28'),
(9, 'Ali Raza', 'ali.raza@gmail.com', '$2y$12$aoXQ4fIyi2SzWCnAcMsseOwgpK0rrbepIUfTsb3jUGGJge0Qyl6J.', NULL, NULL, 0, '2025-06-13 06:15:54', '2025-06-13 06:15:54'),
(10, 'Sikandar Khan', 'sikandar.khan@gmail.com', '$2y$12$TDM.9oRt0b1MKMLiftuPxuvUCniUOCfLSqKywFp4chIOBJujUupAa', NULL, NULL, 0, '2025-06-13 06:16:18', '2025-06-13 06:16:18'),
(11, 'Rehmeen Zahoor', 'rehmeen.zahoor@gmail.com', '$2y$12$qQ2SGQd/BsNxvXmYbVWYSugxhWefK1unQlmjk031F.8ahpGNn3vke', NULL, NULL, 0, '2025-06-13 06:16:42', '2025-06-13 06:16:42'),
(12, 'Sobia Faisal', 'sobia.faisal@gmail.com', '$2y$12$c5FNPyQFGsS4eFGXn76/9O2HpTJpUebZ9Nl2oQPivluVNK1a3hW2K', NULL, NULL, 0, '2025-06-13 06:17:06', '2025-06-13 06:17:06'),
(13, 'Sara Tariq', 'sara.tariq@gmail.com', '$2y$12$PSYvc7ulqNSJ46vRwCRjV.1o9MYVwF8jgd6Y2QRFwcQKh7MqBZqzy', NULL, NULL, 0, '2025-06-13 06:17:39', '2025-06-13 06:17:39'),
(14, 'Amar Ali', 'amar.ali@gmail.com', '$2y$12$uUqdqhwuH3RwcsGr3yFIQOszVOqnkROGVN8QgxU5n3Y04nLh2.5Xe', NULL, NULL, 0, '2025-06-13 06:18:12', '2025-06-13 06:18:12'),
(15, 'Furqan Khan', 'furqan.khan@gmail.com', '$2y$12$szA73kaXGIvSh5PMk2arPuSZJh9zoSLdPQ9WglILBgqNmacz6tre2', NULL, NULL, 0, '2025-06-13 06:18:38', '2025-06-13 06:18:38'),
(16, 'Mazar Khan', 'mazar.khan@gmail.com', '$2y$12$bpf4xwyKqPsRsXpFrhmuL.0EqyjLeq2zr8jLvyK4OC.RZAp9kf1yW', NULL, NULL, 0, '2025-06-13 06:19:03', '2025-06-13 06:19:03'),
(17, 'Muhammad Hammad', 'muhammad.hammad@gmail.com', '$2y$12$vdc7rqCEOZweadSpap1rmO3YJpRyWTYSfn33It3SA.C0VqzNsbuF2', NULL, NULL, 0, '2025-06-13 06:19:38', '2025-06-13 06:19:38'),
(18, 'Anam Khalid', 'anam.khalid@gmail.com', '$2y$12$J/AqfUdCTV1gZVzwWM7afOoHq09MM7jXss6BzooLPEpo6qvtrkWeC', NULL, NULL, 0, '2025-06-13 06:20:38', '2025-06-13 06:20:38'),
(19, 'Fasih Khan', 'fasih.khan@gmail.com', '$2y$12$m8QFiP/utoD5RjjQXgITUOT8zXU1p1sv6Sbelqsss.qr/mzMXsr36', NULL, NULL, 0, '2025-06-13 06:21:07', '2025-06-13 06:21:07'),
(20, 'Ibtesam Haider Cheema', 'ibtesam.cheema@gmail.com', '$2y$12$uoT33IHbhiHotB5pFZV9zeLmmlD0jJne.LJ6rIbFnL.KJIsrLeoPK', NULL, NULL, 0, '2025-06-13 06:21:32', '2025-06-13 06:21:32'),
(21, 'Shayaan Latif', 'shayaan.latif@gmail.com', '$2y$12$T9srsFtQpErnxLxcNO7QJ.iRh/ONJVqsqW7XEhF7AaFJqbaHpEs.2', NULL, NULL, 0, '2025-06-13 06:21:54', '2025-06-13 06:21:54'),
(22, 'Umer', 'umer@gmail.com', '$2y$12$oOEEoMmZOg2Mr.xaK.eVeevmPUwzdASHvr0pqZa.MVktOqz6aJAdq', NULL, NULL, 0, '2025-06-13 06:22:18', '2025-06-13 06:22:18'),
(23, 'Fatima', 'fatima@gmail.com', '$2y$12$oaeqjb9xfHBwtbLTKLTbLu8TXvNxttGB4AF7EPZeev5LevdWycHz2', NULL, NULL, 0, '2025-06-13 06:22:41', '2025-06-13 06:22:41'),
(24, 'Maria', 'maria@gmail.com', '$2y$12$n2dEiJ8Aj9mNM9m8KvTHoeWJBQX56W3JM8dqe.KXVmKtc9wyhfOA2', NULL, NULL, 0, '2025-06-13 06:23:03', '2025-06-13 06:23:03'),
(25, 'Alishba', 'alishba@gmail.com', '$2y$12$RUsGuFm/WSKc/rmqouOdMuBTq1tflM1fiiIElQu5pUUkGI6lrKt/u', NULL, NULL, 0, '2025-06-13 06:23:34', '2025-06-13 06:23:34'),
(26, 'Abdullah', 'abdullah@gmail.com', '$2y$12$x2LhlkFmbr43iVSrGYsnTutu4UlI7vc3Cf6mRIlA00SfHUzzOEFgu', NULL, NULL, 0, '2025-06-13 06:24:00', '2025-06-13 06:24:00'),
(27, 'Hussaina', 'hussaina@gmail.com', '$2y$12$DwRK.dWobeyN7Jh/w0EKE.XBQ8Jl3BGKOI8FW7iFEz0vIAkC.AhZq', NULL, NULL, 0, '2025-06-13 06:24:44', '2025-06-13 06:24:44'),
(28, 'Kumail', 'kumail@gmail.com', '$2y$12$09KxTwiUUmm6HolCxgEqyuL0gZlpyJ126HuqaCEQp0HZ/a5i54ygO', NULL, NULL, 0, '2025-06-13 06:25:07', '2025-06-13 06:25:07'),
(29, 'Mohsin', 'mohsin@gmail.com', '$2y$12$usVuQxKAQeF.fsX0K2ae7OOqOv1RzS54ylP3PAerKgkd0vO6PsN.e', NULL, NULL, 0, '2025-06-13 06:25:31', '2025-06-13 06:25:31'),
(30, 'Samra', 'samra@gmail.com', '$2y$12$CcfSGjYi2Ny.vMn99pgsm.JepSfD3H0//jW85H.FHhFQu4RUL.nqG', NULL, NULL, 0, '2025-06-13 06:26:27', '2025-06-13 06:26:27'),
(31, 'Sara', 'sara@gmail.com', '$2y$12$fm.llCmJh0bSooL44WXF0eN0ZX9xK6.yNjsqoZx4hbnLZrHRlQa5i', NULL, NULL, 0, '2025-06-13 06:26:59', '2025-06-13 06:26:59'),
(32, 'Sudarshan', 'sudarshan@gmail.com', '$2y$12$5gpCFMRRhjjYzAj4LCKwb.6v0iEB4PxjBZ9BmM3lIp1BCzdKXPapa', NULL, NULL, 0, '2025-06-13 06:27:54', '2025-06-13 06:27:54'),
(33, 'Preety', 'preety@gmail.com', '$2y$12$DqTTwcNypYNw2ElakBSe1ew1hkm.6UVYx66c.DfziWcJBaLLVX6QW', NULL, NULL, 0, '2025-06-13 06:28:27', '2025-06-13 06:28:27'),
(34, 'Shanza', 'shanza@gmail.com', '$2y$12$DN.O14Ni2.IQdQqOQQdiM.81zxC1iUb9sYlsr45E03CeQLEiAAa5u', NULL, NULL, 0, '2025-06-13 06:28:54', '2025-06-13 06:28:54'),
(35, 'Hadia', 'hadia@gmail.com', '$2y$12$N872yvptSVMy.ZrCGsUWseQMdrs4VT0HJq7mEc8aBIOL.RRlaPtAK', NULL, NULL, 0, '2025-06-13 06:29:22', '2025-06-13 06:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `student_societies`
--

CREATE TABLE `student_societies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `society_id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `joined_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_societies`
--

INSERT INTO `student_societies` (`id`, `student_id`, `society_id`, `position_id`, `joined_date`, `created_at`, `updated_at`) VALUES
(5, 3, 2, 4, NULL, NULL, NULL),
(6, 1, 2, 2, NULL, NULL, NULL),
(7, 2, 2, 3, NULL, NULL, NULL),
(8, 6, 2, 6, NULL, NULL, NULL),
(9, 4, 2, 5, NULL, NULL, NULL),
(10, 7, 2, 7, NULL, NULL, NULL),
(11, 8, 2, 10, NULL, NULL, NULL),
(12, 9, 2, 13, NULL, NULL, NULL),
(13, 10, 2, 15, NULL, NULL, NULL),
(14, 11, 2, 17, NULL, NULL, NULL),
(15, 12, 2, 19, NULL, NULL, NULL),
(16, 13, 2, 19, NULL, NULL, NULL),
(17, 14, 2, 19, NULL, NULL, NULL),
(18, 15, 2, 19, NULL, NULL, NULL),
(19, 16, 2, 19, NULL, NULL, NULL),
(20, 17, 2, 19, NULL, NULL, NULL),
(21, 35, 2, 19, NULL, NULL, NULL),
(22, 18, 3, 20, NULL, NULL, NULL),
(23, 19, 3, 21, NULL, NULL, NULL),
(24, 20, 3, 22, NULL, NULL, NULL),
(25, 21, 3, 23, NULL, NULL, NULL),
(26, 22, 3, 24, NULL, NULL, NULL),
(27, 23, 3, 24, NULL, NULL, NULL),
(28, 24, 3, 26, NULL, NULL, NULL),
(29, 26, 3, 28, NULL, NULL, NULL),
(30, 28, 3, 30, NULL, NULL, NULL),
(31, 30, 3, 32, NULL, NULL, NULL),
(32, 32, 3, 34, NULL, NULL, NULL),
(33, 34, 3, 36, NULL, NULL, NULL),
(34, 25, 3, 38, NULL, NULL, NULL),
(35, 27, 3, 38, NULL, NULL, NULL),
(36, 29, 3, 38, NULL, NULL, NULL),
(37, 31, 3, 38, NULL, NULL, NULL),
(38, 33, 3, 38, NULL, NULL, NULL),
(39, 35, 3, 38, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `phonenumber` varchar(20) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` bigint(20) UNSIGNED NOT NULL,
  `voter_id` bigint(20) UNSIGNED NOT NULL,
  `election_id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `vote_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `voter_id`, `election_id`, `candidate_id`, `vote_timestamp`, `created_at`, `updated_at`) VALUES
(1, 35, 1, 3, '2025-06-14 11:36:09', '2025-06-14 11:36:09', '2025-06-14 11:36:09'),
(3, 35, 2, 5, '2025-06-21 07:57:06', '2025-06-21 02:57:06', '2025-06-21 02:57:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `applications_student_id_foreign` (`student_id`),
  ADD KEY `applications_election_id_foreign` (`election_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`),
  ADD UNIQUE KEY `candidates_student_id_election_id_unique` (`student_id`,`election_id`),
  ADD KEY `candidates_election_id_foreign` (`election_id`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`election_id`),
  ADD KEY `elections_society_id_foreign` (`society_id`);

--
-- Indexes for table `election_voters`
--
ALTER TABLE `election_voters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `election_voters_election_id_student_id_unique` (`election_id`,`student_id`),
  ADD KEY `election_voters_student_id_foreign` (`student_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `notifications_recipient_id_index` (`recipient_id`),
  ADD KEY `notifications_is_read_index` (`is_read`),
  ADD KEY `notifications_created_at_index` (`created_at`);

--
-- Indexes for table `notification_views`
--
ALTER TABLE `notification_views`
  ADD PRIMARY KEY (`view_id`),
  ADD KEY `notification_views_notification_id_foreign` (`notification_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`),
  ADD KEY `positions_society_id_foreign` (`society_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `results_election_id_foreign` (`election_id`),
  ADD KEY `results_position_id_foreign` (`position_id`),
  ADD KEY `results_candidate_id_foreign` (`candidate_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `societies`
--
ALTER TABLE `societies`
  ADD PRIMARY KEY (`society_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `student_societies`
--
ALTER TABLE `student_societies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_societies_student_id_foreign` (`student_id`),
  ADD KEY `student_societies_society_id_foreign` (`society_id`),
  ADD KEY `student_societies_position_id_foreign` (`position_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `votes_voter_id_election_id_unique` (`voter_id`,`election_id`),
  ADD KEY `votes_election_id_foreign` (`election_id`),
  ADD KEY `votes_candidate_id_foreign` (`candidate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `election_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `election_voters`
--
ALTER TABLE `election_voters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_views`
--
ALTER TABLE `notification_views`
  MODIFY `view_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `societies`
--
ALTER TABLE `societies`
  MODIFY `society_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `student_societies`
--
ALTER TABLE `student_societies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_election_id_foreign` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_election_id_foreign` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidates_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `elections`
--
ALTER TABLE `elections`
  ADD CONSTRAINT `elections_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`society_id`) ON DELETE CASCADE;

--
-- Constraints for table `election_voters`
--
ALTER TABLE `election_voters`
  ADD CONSTRAINT `election_voters_election_id_foreign` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `election_voters_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_views`
--
ALTER TABLE `notification_views`
  ADD CONSTRAINT `notification_views_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`notification_id`) ON DELETE CASCADE;

--
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`society_id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_election_id_foreign` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_societies`
--
ALTER TABLE `student_societies`
  ADD CONSTRAINT `student_societies_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `student_societies_society_id_foreign` FOREIGN KEY (`society_id`) REFERENCES `societies` (`society_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_societies_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_election_id_foreign` FOREIGN KEY (`election_id`) REFERENCES `elections` (`election_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_voter_id_foreign` FOREIGN KEY (`voter_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
