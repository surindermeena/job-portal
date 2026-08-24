-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 12:46 PM
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
-- Database: `jpts_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_services`
--

CREATE TABLE `about_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(150) NOT NULL,
  `service_title` varchar(150) DEFAULT NULL,
  `service_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_services`
--

INSERT INTO `about_services` (`id`, `about_id`, `icon`, `service_title`, `service_description`) VALUES
(3, 1, 'la la-clock-o', 'Advertise A Job', 'Post your job openings easily and reach thousands of qualified job seekers quickly.'),
(4, 1, 'la la-search', 'CV Search', 'Access a vast database of resumes and filter candidates based on your hiring criteria.'),
(5, 1, 'la la-user', 'Recruiter Profiles', 'Create a recruiter profile to showcase your brand and connect with the right talent.'),
(6, 1, 'la la-codepen', 'Temp Search', 'Find qualified temporary workers quickly for short-term projects or urgent staffing needs.'),
(8, 1, 'la la-tv', 'Display Jobs', 'Highlight featured job listings to attract more attention from potential candidates.'),
(9, 1, 'la la-diamond', 'For Agencies', 'Designed to help staffing agencies manage jobs, clients, and applicants efficiently.');

-- --------------------------------------------------------

--
-- Table structure for table `about_social_links`
--

CREATE TABLE `about_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(100) NOT NULL,
  `about_id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_social_links`
--

INSERT INTO `about_social_links` (`id`, `icon`, `about_id`, `platform`, `url`) VALUES
(5, 'fa-brands fa-facebook', 1, 'facebook', 'https://facebook.com'),
(6, 'fa-brands fa-google', 1, 'google', 'https://google.com'),
(7, 'fa-brands fa-twitter', 1, 'twitter', 'https://twitter.com'),
(8, 'fa-brands fa-instagram', 1, 'instagram', 'https://instagram.com'),
(9, 'fa-brands fa-pinterest', 1, 'pinterest', 'https://pinterest.com');

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `content_1` text DEFAULT NULL,
  `content_2` text DEFAULT NULL,
  `content_3` text DEFAULT NULL,
  `content_4` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `content_1`, `content_2`, `content_3`, `content_4`) VALUES
(1, 'Job Hunt', 'Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much.', 'Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.', 'Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much.', 'Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `image`, `address`, `pin`, `city`, `state`, `country`, `created_at`, `updated_at`) VALUES
(1, 10, '1756766518_er4.jpg', '123 Main St, Springfield', '123456', 'Bhiwani', 'Haryana', 'India', '2025-09-01 16:55:33', '2025-09-01 17:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('applied','reviewed','shortlisted','rejected','hired') DEFAULT 'applied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `candidate_id`, `job_id`, `applied_at`, `status`) VALUES
(10, 2, 12, '2025-09-01 23:15:43', 'applied'),
(11, 2, 9, '2025-09-01 23:19:36', 'applied'),
(12, 2, 5, '2025-09-01 23:21:05', 'applied'),
(13, 2, 3, '2025-09-01 23:50:09', 'applied'),
(14, 1, 12, '2025-09-01 23:53:52', 'applied'),
(15, 1, 9, '2025-09-01 23:54:04', 'applied'),
(16, 1, 6, '2025-09-01 23:54:14', 'applied'),
(17, 1, 2, '2025-09-01 23:54:34', 'applied'),
(18, 1, 7, '2025-09-03 17:08:41', 'applied');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `min_salary` decimal(10,2) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `user_id`, `image`, `job_title`, `category_id`, `min_salary`, `experience`, `description`, `address`, `pin`, `city`, `state`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1756755120_t1.jpg', 'Frontend Developer', 7, 10000.00, '3 Years', 'Test Description', '789 Pine Rd', '123456', 'Jaipur', 'Rajasthan', 'India', 1, '2025-09-01 13:58:35', '2025-09-01 14:02:00'),
(2, 3, '1756756025_er3.jpg', 'Laravel Developer', 1, 15000.00, '1 Year', 'Test Description', '123 Main St', '32017', 'Alwar', 'Rajasthan', 'India', 1, '2025-09-01 14:13:36', '2025-09-01 14:17:05'),
(3, 12, '1756756674_cart-item-2.jpg', 'Project Manager', 2, 55000.00, '10 Years', 'Testing Description', 'S-37, 1st Floor, JDA Central Market', '32017', 'Delhi', 'Delhi', 'USA', 1, '2025-09-01 14:24:13', '2025-09-01 14:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_education`
--

CREATE TABLE `candidate_education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `degree` varchar(150) DEFAULT NULL,
  `institute` varchar(150) DEFAULT NULL,
  `year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_education`
--

INSERT INTO `candidate_education` (`id`, `candidate_id`, `degree`, `institute`, `year`) VALUES
(1, 1, 'B.tech', 'NCCE', '2000'),
(2, 1, 'M.tech', 'MNIT', '2005'),
(3, 2, 'BCA', 'Rajasthan University', '2005'),
(4, 2, 'MCA', 'Rajasthan University', '2010'),
(5, 3, 'B.tech', 'KUK', '2001'),
(6, 3, 'MBA', 'Rajasthan University', '2010');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_languages`
--

CREATE TABLE `candidate_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(100) DEFAULT NULL,
  `level` enum('basic','intermediate','advanced','native') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_languages`
--

INSERT INTO `candidate_languages` (`id`, `candidate_id`, `language`, `level`) VALUES
(1, 1, 'Hindi', 'native'),
(2, 1, 'English', 'intermediate'),
(3, 2, 'Hindi', 'advanced'),
(4, 2, 'German', 'basic'),
(5, 3, 'Korean', 'intermediate'),
(6, 3, 'Spanish', 'advanced');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_skills`
--

CREATE TABLE `candidate_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_skills`
--

INSERT INTO `candidate_skills` (`id`, `candidate_id`, `name`) VALUES
(1, 1, 'html'),
(2, 1, 'css'),
(3, 1, 'JavaScript'),
(4, 2, 'PHP'),
(5, 2, 'MySQL'),
(6, 2, 'Laravel'),
(7, 3, 'Adobe Photoshop'),
(8, 3, 'Adobe Lightroom'),
(9, 3, 'Gimp');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `icon` varchar(100) DEFAULT NULL,
  `open_positions` int(50) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `icon`, `open_positions`) VALUES
(1, 'Software Development', 1, 'la la-code', 10),
(2, 'Data and Analytics', 1, 'la la-chart-line', 9),
(3, 'Project and Product Management', 1, 'la la-tasks', 8),
(4, 'Design', 1, 'la la-paint-brush', 8),
(5, 'Content and Marketing', 1, 'la la-bullhorn', 8),
(6, 'Human Resources', 1, 'la la-users', 7),
(7, 'IT and Network', 1, 'la la-network-wired', 6),
(8, 'Sales and Business Development', 1, 'la la-handshake', 4);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `company_image` varchar(255) DEFAULT NULL,
  `since` year(4) DEFAULT NULL,
  `team_size` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `hr_email` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `user_image`, `company_name`, `company_image`, `since`, `team_size`, `description`, `hr_email`, `website`, `address`, `pin`, `city`, `state`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'Tech Solutions Ltd.', '1756757424_em1.jpg', '1990', '45', 'Test Description', 'companyHR@gmail.com', 'https://www.company1.com/', '123 Main St, Springfield', '123456', 'Noida', 'Uttar Pradesh', 'India', 1, '2025-09-01 20:05:13', '2025-09-03 10:10:27'),
(2, 5, NULL, 'Data Insights Inc.', '1756757791_em2.jpg', '1993', '50', 'Data Insights Inc. Description', 'rohitHR@gmail.com', 'https://www.rohit.com/', '123 Main St, Springfield', '32017', 'Gurgaon', 'Haryana', 'India', 1, '2025-09-01 20:14:25', '2025-09-03 10:10:55'),
(3, 7, NULL, 'Project Pro LLC', '1756758185_em3.jpg', '2002', '110', 'Company test description', 'sapnaHR@gmail.com', 'https://www.sapna.com/', '123 Main St, Springfield', '32017', 'Jaipur', 'Rajasthan', 'India', 1, '2025-09-01 20:19:45', '2025-09-03 10:11:13'),
(4, 8, NULL, 'Creative Designs', '1756758802_em7.jpg', '2005', '80', 'Test  Description', 'amitHR@gmail.com', 'https://www.amit.com/', 'S-37, 1st Floor, JDA Central Market', '123456', 'Bangalore', 'Karnataka', 'India', 1, '2025-09-01 20:30:52', '2025-09-03 10:11:34'),
(5, 9, NULL, 'Marketing Masters', '1756759012_em4.jpg', '1956', '150', 'Test  Description', 'rohanroy@gmail.com', 'https://www.rohan.com/', '789 Pine Rd, Gotham', '678901', 'Pune', 'Maharashtra', 'India', 1, '2025-09-01 20:34:36', '2025-09-03 10:11:50'),
(6, 6, NULL, 'Agile Solution Pvt. Ltd.', '1756763309_em6.jpg', '1993', '75', 'Description of Agile Solution Pvt. Ltd.', 'mohitemil@gmail.com', 'https://www.mohit.com/', '123 Main St, Springfield', '225874', 'Hyderabad', 'Telangana', 'India', 1, '2025-09-01 21:16:07', '2025-09-03 17:58:04'),
(7, 10, NULL, 'StarTrack Corporation', '1756767823_em7.jpg', '2020', '110', 'Test Description', 'startrackHR@gmail.com', 'https://www.startrack.com/', '123 Main St, Springfield', '123456', 'Noida', 'Uttar Pradesh', 'India', 1, '2025-09-01 23:03:43', '2025-09-03 10:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `company_categories`
--

CREATE TABLE `company_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_categories`
--

INSERT INTO `company_categories` (`id`, `company_id`, `category_id`) VALUES
(1, 1, 5),
(2, 2, 8),
(4, 3, 5),
(5, 4, 3),
(6, 5, 8),
(7, 7, 4),
(8, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_skills`
--

CREATE TABLE `company_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `skill` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_skills`
--

INSERT INTO `company_skills` (`id`, `company_id`, `skill`) VALUES
(1, 1, 'React'),
(2, 1, 'Github'),
(5, 2, 'React'),
(6, 2, 'Laravel'),
(7, 2, 'AutoCad'),
(9, 3, 'SEO'),
(10, 4, 'Python'),
(11, 4, 'Adobe Lightroom'),
(12, 4, 'Excel'),
(16, 5, 'SEO'),
(17, 5, 'PowerBI'),
(18, 5, 'Node.js'),
(19, 7, 'Adobe Photoshop'),
(20, 7, 'Adobe Lightroom'),
(21, 7, 'AutoCad'),
(22, 6, 'React'),
(23, 6, 'Github'),
(24, 6, 'Laravel');

-- --------------------------------------------------------

--
-- Table structure for table `company_social_links`
--

CREATE TABLE `company_social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_social_links`
--

INSERT INTO `company_social_links` (`id`, `company_id`, `type`, `url`) VALUES
(1, 1, NULL, 'https://www.facebook.com'),
(2, 1, NULL, 'https://www.linkedin.com'),
(3, 1, NULL, 'https://www.twitter.com'),
(7, 2, NULL, 'https://www.facebook.com'),
(8, 2, NULL, 'https://www.linkedin.com'),
(9, 2, NULL, 'https://www.twitter.com'),
(13, 3, NULL, 'https://www.facebook.com'),
(14, 3, NULL, 'https://www.linkedin.com'),
(15, 3, NULL, 'https://www.twitter.com'),
(16, 4, NULL, 'https://www.facebook.com'),
(17, 4, NULL, 'https://www.linkedin.com'),
(18, 4, NULL, 'https://www.twitter.com'),
(22, 5, NULL, 'https://www.facebook.com'),
(23, 5, NULL, 'https://www.linkedin.com'),
(24, 5, NULL, 'https://www.twitter.com'),
(25, 7, NULL, 'https://www.facebook.com'),
(26, 7, NULL, 'https://www.linkedin.com'),
(27, 7, NULL, 'https://www.twitter.com'),
(28, 6, NULL, 'https://www.facebook.com'),
(29, 6, NULL, 'https://www.linkedin.com'),
(30, 6, NULL, 'https://www.twitter.com');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `reply_status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `full_name`, `email`, `subject`, `message`, `reply_status`, `created_at`) VALUES
(1, 'hello', 'hello@gmail.com', 'hello subject', 'hello message', 1, '2025-08-26 01:25:22'),
(2, 'Surinder Kumar', 'surinder@gmail.com', 'Test Subject', 'Some random test message', 1, '2025-08-26 01:25:53'),
(4, 'Mohinder Meena', 'mohinder240685@gmail.co', 'Inquery about Mern', 'i want to know about what is mern stack  and what about its future scope', 1, '2025-08-27 05:17:15'),
(5, 'Sarita Meena', 'sartia@gmail.com', 'about Mehandi', 'i want to know about what is mern stack  and what about its future scope', 1, '2025-08-27 05:18:53'),
(6, 'hello india', 'helloindia@gmail.com', 'hello world', 'hello world', 1, '2025-08-27 05:20:47'),
(7, 'Lalit Kumar', 'lalitkumar@gmail.com', 'test subject', 'test message', 1, '2025-08-28 05:02:10'),
(8, 'Ram Kishore', 'ramkishore@gmail.com', 'job search', 'hello sir i need a job as fast as possible', 1, '2025-08-31 21:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `size_kb` int(11) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `filename`, `original_name`, `extension`, `size_kb`, `uploaded_at`) VALUES
(1, 2, '1756755479_testfile.pdf', 'testfile.pdf', 'pdf', 219, '2025-09-01 14:07:59'),
(2, 3, '1756756187_testfile.pdf', 'testfile.pdf', 'pdf', 219, '2025-09-01 14:19:47'),
(3, 12, '1756756703_size-guide.jpg', 'size-guide.jpg', 'jpg', 51, '2025-09-01 14:28:23'),
(4, 12, '1756756730_testfile.pdf', 'testfile.pdf', 'pdf', 219, '2025-09-01 14:28:50');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`) VALUES
(1, 'How do I create an account ?', 'Creating an account is quick and easy. Click on the “Sign Up” button, provide your basic information such as name, email, and password, then verify your email address. Once confirmed, you can log in, complete your profile, upload your resume, and start searching for jobs that match your skills. A complete profile increases your chances of getting noticed by employers.', 1),
(2, 'Is creating and using my profile free ?', 'Yes, creating and using your profile on our platform is completely free. There are no hidden charges for job seekers. You can register, build a professional profile, upload your resume, search for jobs, and apply without paying anything. Our mission is to connect you with the right opportunities, and we believe that finding a job should never cost you money.', 1),
(3, 'Can I apply to multiple jobs at once ?', 'Absolutely. You are encouraged to apply to as many relevant jobs as you\'d like. There’s no limit to how many applications you can send. The more jobs you apply to, the higher your chances of finding the right opportunity. Just make sure each application is tailored and your profile is updated, so employers can see your best qualifications.', 1),
(4, 'How do I track my job applications ?', 'Once you’ve applied to a job, it will appear in your dashboard under the “My Applications” section. There, you can track the status of each application, see if an employer has viewed your resume, and receive updates. You can also edit or withdraw applications if needed. Keeping an eye on this section helps you stay informed and proactive.', 1),
(5, 'What should I do if I forget my password ?', 'If you forget your password, click on the “Forgot Password” link on the login page. Enter your registered email address, and we’ll send you a secure link to reset your password. Follow the instructions in the email to set a new password. If you don’t receive the email within a few minutes, check your spam folder or request again.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `how_it_works`
--

CREATE TABLE `how_it_works` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `how_it_works`
--

INSERT INTO `how_it_works` (`id`, `icon`, `title`, `image`, `description`) VALUES
(1, 'user', 'Register an account', 'hw1.jpg', 'Create your free account in minutes. Fill in basic details, verify your email, and set up your profile to start exploring exciting job opportunities tailored to your skills.'),
(2, 'file-text', 'Specify & Search Your Job', 'hw2.jpg', 'Define your desired job type, industry, or location. Use filters to narrow results and instantly explore job listings that match your skills, experience, and career goals.'),
(3, 'pencil', 'Apply For Job', 'hw3.jpg', 'Choose the jobs that fit your profile, upload your resume, and apply with one click. Track application status and communicate with employers directly through your dashboard.');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `job_title` varchar(150) NOT NULL,
  `job_description` text DEFAULT NULL,
  `job_category` bigint(20) UNSIGNED DEFAULT NULL,
  `salary_min` decimal(10,2) DEFAULT NULL,
  `salary_max` decimal(10,2) DEFAULT NULL,
  `min_experience` varchar(50) DEFAULT NULL,
  `application_deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company_id`, `status`, `featured`, `job_title`, `job_description`, `job_category`, `salary_min`, `salary_max`, `min_experience`, `application_deadline`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'Software Engineer', 'testing', 1, 30000.00, 40000.00, '10', '2025-09-03', '2025-09-01 15:22:42', '2025-09-01 15:22:42'),
(2, 1, 1, 1, 'Data Analyst', 'Testing', 4, 20000.00, 40000.00, '5', '2025-10-10', '2025-09-01 15:26:22', '2025-09-03 10:58:28'),
(3, 1, 1, 0, 'Project Manager', 'Testing', 5, 15000.00, 25000.00, '6', '2025-09-03', '2025-09-01 15:30:24', '2025-09-01 15:30:24'),
(4, 2, 1, 1, 'UX Designer', 'UX Designer', 1, 10000.00, 20000.00, '1', '2025-09-16', '2025-09-01 15:35:57', '2025-09-03 10:58:35'),
(5, 2, 1, 0, 'Content Writer', 'Content Writer', 6, 25000.00, 35000.00, '15', '2025-09-14', '2025-09-01 15:38:15', '2025-09-01 15:38:15'),
(6, 2, 1, 1, 'Network Engineer', 'Network Engineer', 7, 30000.00, 60000.00, '7', '2025-09-27', '2025-09-01 15:41:22', '2025-09-03 10:58:51'),
(7, 4, 1, 0, 'Sales Executive', 'Sales Executive', 8, 15000.00, 17000.00, '8', '2025-09-06', '2025-09-01 15:51:06', '2025-09-01 15:51:06'),
(8, 4, 1, 1, 'Backend Developer', 'Backend Developer', 1, 30000.00, 50000.00, '8', '2025-10-09', '2025-09-01 15:52:52', '2025-09-03 10:59:00'),
(9, 6, 1, 0, 'Data Scientist', 'Data Scientist', 2, 60000.00, 70000.00, '5', '2025-09-30', '2025-09-01 16:15:36', '2025-09-01 17:55:50'),
(10, 6, 1, 1, 'Content Strategist', 'Content Strategist', 5, 25000.00, 35000.00, '6', '2025-09-23', '2025-09-01 16:17:17', '2025-09-03 10:59:05'),
(11, 5, 1, 0, 'HR Manager', 'HR Manager', 6, 40000.00, 60000.00, '5', '2025-10-08', '2025-09-01 16:21:55', '2025-09-01 16:21:55'),
(12, 7, 1, 1, 'Account Manager', 'Account Manager Description', 8, 25000.00, 35000.00, '6', '2025-09-25', '2025-09-01 17:38:00', '2025-09-03 10:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `job_qualifications`
--

CREATE TABLE `job_qualifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `qualification` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_qualifications`
--

INSERT INTO `job_qualifications` (`id`, `job_id`, `qualification`) VALUES
(1, 1, 'B.Tech'),
(2, 1, 'M.Tech'),
(3, 1, 'P.hd'),
(4, 2, 'BCA'),
(5, 2, 'Diploma'),
(6, 2, 'P.hd'),
(7, 3, 'ITI'),
(8, 3, 'Diploma'),
(9, 3, 'P.hd'),
(10, 4, 'BCA'),
(11, 4, 'Diploma'),
(12, 4, 'MCA'),
(13, 5, 'BCA'),
(14, 5, 'M.Tech'),
(15, 5, 'P.hd'),
(16, 6, 'B.Sc'),
(17, 6, 'MCA'),
(18, 6, 'P.hd'),
(19, 7, 'BA'),
(20, 7, 'MA'),
(21, 8, 'B.Tech'),
(22, 8, 'M.Tech'),
(23, 8, 'P.hd'),
(27, 10, 'BA'),
(28, 10, 'Diploma'),
(29, 11, 'MBA'),
(30, 11, 'B.Com'),
(31, 12, 'B.Com'),
(32, 12, 'M.Com'),
(33, 9, 'B.Tech'),
(34, 9, 'M.Tech'),
(35, 9, 'P.hd');

-- --------------------------------------------------------

--
-- Table structure for table `job_skills`
--

CREATE TABLE `job_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `skill` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_skills`
--

INSERT INTO `job_skills` (`id`, `job_id`, `skill`) VALUES
(1, 1, 'PHP'),
(2, 1, 'Adobe Photoshop'),
(3, 1, 'SQL'),
(4, 2, 'PHP Advance'),
(5, 2, 'Python'),
(6, 3, 'Photoshop'),
(7, 3, 'html'),
(8, 3, 'Github'),
(9, 4, 'Photoshop'),
(10, 4, 'React'),
(11, 4, 'JavaScript'),
(12, 5, 'Photoshop'),
(13, 5, 'Python'),
(14, 5, 'Adobe Lightroom'),
(15, 6, 'Photoshop'),
(16, 6, 'Adobe Photoshop'),
(17, 6, 'Adobe Lightroom'),
(18, 7, 'SEO'),
(19, 7, 'MySQL'),
(20, 7, 'Adobe Lightroom'),
(21, 8, 'PHP'),
(22, 8, 'Python'),
(23, 8, 'Advance PHP'),
(27, 10, 'MS Office'),
(28, 10, 'MS Excell'),
(29, 10, 'Laravel'),
(30, 11, 'Tally'),
(31, 11, 'MS Excell'),
(32, 12, 'Tally'),
(33, 12, 'Tally GST'),
(34, 12, 'Excel Advance'),
(35, 9, 'MySQL'),
(36, 9, 'PHP'),
(37, 9, 'PowerBI');

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `job_id`, `type`) VALUES
(1, 1, 'full-time'),
(2, 2, 'part-time'),
(3, 3, 'contract'),
(4, 4, 'temporary'),
(5, 5, 'internship'),
(6, 6, 'freelance'),
(7, 7, 'internship'),
(8, 8, 'freelance'),
(10, 10, 'part-time'),
(11, 11, 'full-time'),
(12, 12, 'internship'),
(13, 9, 'full-time');

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
(1, '2025_08_26_033130_create_password_resets_table', 1),
(2, '2025_08_26_033132_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('rohit@gmail.com', '$2y$12$5FY7/93b1Et1lJJUw9nE0uOqVsXo1UTIxIwvw6LRajVw5MT.ml/0a', '2025-09-01 08:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
('b7CARaXPHe2GDidmUksPiWsXfwB0QxNPPsd4WQYg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0F1MXBEaVkzbWNnaldOOWJKSEZsRmFFTXc2eVYwb2sxS1pyY2pDSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756925474),
('FDxgjv1Ga9KSeABIh19ooDA6HlCWAsBcEXztV0kn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUpVbzU2OWtjb2xuNHloSFd5bndrejh5UW9rM2djRjZWUVBKMW1iMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1756913704),
('XH3pEtHIywwDx3EEzK4JTK1MknSpLVuMTDOLrsGl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS201a1ZyT2lrQXRKeXlCUHBSS3hPeHhDVGthYW5zMkNMRTM3VGN1OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb21wYW5pZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1756944477);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'address', '263/845 Pratap Nagar, Jaipur, Rajasthan, India - 302033'),
(2, 'phone', '	\r\n+91 80943-24555'),
(3, 'email', 'hello@w3care.com'),
(4, 'map', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.9255634712254!2d75.84234828614042!3d26.810498677334863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396dc9c85544af8f%3A0xf8681cd66e6f90a6!2sW3care%20Technologies%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1754484386303!5m2!1sen!2sin'),
(5, 'social_links', '[\n  {\n    \"platform\": \"Facebook\",\n    \"icon\": \"fab fa-facebook\",\n    \"url\": \"https://www.facebook.com\"\n  },\n  {\n    \"platform\": \"Twitter\",\n    \"icon\": \"fab fa-twitter\",\n    \"url\": \"https://www.twitter.com\"\n  },\n  {\n    \"platform\": \"LinkedIn\",\n    \"icon\": \"fab fa-linkedin\",\n    \"url\": \"https://www.linkedin.com\"\n  },\n  {\n    \"platform\": \"WhatsApp\",\n    \"icon\": \"fab fa-whatsapp\",\n    \"url\": \"https://www.whatsapp.com\"\n  },\n  {\n    \"platform\": \"Microsoft Teams\",\n    \"icon\": \"fab fa-microsoft\",\n    \"url\": \"https://www.microsoft.com/en/microsoft-teams/group-chat-software\"\n  }\n]\n'),
(6, 'design_credit', 'Design by Creative Layers');

-- --------------------------------------------------------

--
-- Table structure for table `terms_conditions`
--

CREATE TABLE `terms_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms_conditions`
--

INSERT INTO `terms_conditions` (`id`, `title`, `content`, `status`) VALUES
(1, 'Terms of Use', 'By accessing this website, you agree to be bound by these Terms and Conditions of Use, all applicable laws, and regulations. You are responsible for compliance with any local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. All content and materials on this website are protected by applicable copyright and trademark laws.', 1),
(2, 'Limitations of Liability', 'While we strive to ensure the website operates smoothly, we cannot guarantee uninterrupted service. The internet is inherently unstable, and errors, delays, or interruptions may occur. We are not liable for any such disruptions or for the accuracy, completeness, or usefulness of the information provided. We may update or modify any part of the website at any time without notice.', 1),
(3, 'Acceptable Use Policy', 'You may only use this website for lawful purposes, such as searching for jobs, submitting applications, or recruiting candidates. You must not attempt to compromise the website\'s security or functionality. Prohibited actions include unauthorized access, overloading systems, introducing malicious code, scraping data, or interfering with the site\'s normal operation.', 1),
(4, 'Modifications to Terms', 'We may revise these Terms and Conditions at any time without prior notice. By continuing to use the website, you agree to be bound by the current version of these terms. It is your responsibility to review this page periodically for updates.', 1),
(5, 'Revisions and Accuracy', 'The materials appearing on this website may include technical, typographical, or photographic errors. We do not warrant that any material is accurate, complete, or current. We may make changes to the content at any time without notice but do not commit to updating the materials regularly.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `job_post` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `image`, `name`, `job_post`, `description`, `status`) VALUES
(1, '1756749458_t1.jpg', 'Alice Johnson', 'Marketing Manage', 'Without JobHunt I’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite believe the service.', 1),
(2, '1756749477_t2.jpg', 'Bob Smith', 'Software Engineer', 'Without JobHunt I’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite believe the service.', 1),
(3, '1756749501_t3.jpg', 'Clara Davis', 'HR Consultant', 'Without JobHunt I’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite believe the service.', 1),
(4, '1756749520_t4.jpg', 'David Lee', 'Product Manager', 'Without JobHunt I’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite believe the service.', 1),
(5, '1756749550_t1.jpg', 'Emma Wilson', 'Recruitment Lead', 'Without JobHunt I’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite believe the service.', 1),
(7, '1756749567_t2.jpg', 'Ravi Sani', 'Backend Developer', 'I highly recommend job portal. It has been so important for us as we continue to grow our company.', 1),
(8, '1756749766_t3.jpg', 'Vikar Nandal', 'Software Engineer', 'Without JobHunt I’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite believe the service.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('candidate','company','admin') DEFAULT 'candidate',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'student2', 'student2@gmail.com', '1234567890', NULL, '$2y$12$1YPpMlifDmH6jTzOULw1euX2y4ScSBakmsFYdN/RdicKrTyYYGmjS', 'candidate', NULL, NULL, NULL),
(3, 'surinder', 'surinder@gmail.com', '7206816640', NULL, '$2y$12$hizQEVaQfvEXaETGhlVA..3NWG6.KecbCudDcDD0HdVcPVtGfocYS', 'candidate', NULL, NULL, NULL),
(4, 'company1', 'company1@gmail.com', '2345678901', NULL, '$2y$12$1Y/GYzq64/oTlT6vkTDtdu2oaWyUDLVi1O07XcgaZRHZ3mSLV5RN.', 'company', NULL, NULL, NULL),
(5, 'rohit', 'rohit@gmail.com', '2345678901', NULL, '$2y$12$tT3T1uNe.e7E0c/quNwoseilaXBfrMzTA6o9rIbQUiWm8xULHmU3C', 'company', NULL, NULL, NULL),
(6, 'mohit', 'mohit@gmail.com', '7206816640', NULL, '$2y$12$/hW/21FVgFIh1BgOZDuSeeQa1mDLz1dqikbwayOjxw.CXHAQ4v/7i', 'company', NULL, NULL, NULL),
(7, 'sapna', 'sapna@gmail.com', '1234567890', NULL, '$2y$12$sCmRdaPztbWiA.7PECbvgOBDaRbjAwu/daUv8ZYv5ow2M/rxjnpQW', 'company', NULL, NULL, NULL),
(8, 'amit', 'amit@gmail.com', '7206816640', NULL, '$2y$12$NcURiWnzIU5hmwUjswVoW.BqqzLcl4kLylOHmf8kJHWeSLtbiB2Re', 'company', NULL, NULL, NULL),
(9, 'rohan', 'rohan@gmail.com', '7206816640', NULL, '$2y$12$TYkrKG8SZ6SiwugC6J4XzOgY2zZEDDy3X9Qh04nHm9196491iJjIm', 'company', NULL, NULL, NULL),
(10, 'admin1', 'admin1@gmail.com', '7206816640', NULL, '$2y$12$SkUPiB6ll.70/COAcZARsO4c6P8G/CCyPxsOEgylQsDxYzCJGjCG.', 'admin', NULL, NULL, NULL),
(12, 'student3', 'student3@gmail.com', '7891593542', NULL, '$2y$12$qcl1Cf1FxSlVc5eLnZRDR..Pwr8QRkurKdNZdSloKulmlCKsPGxhW', 'candidate', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_services`
--
ALTER TABLE `about_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_id` (`about_id`);

--
-- Indexes for table `about_social_links`
--
ALTER TABLE `about_social_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_id` (`about_id`);

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `candidate_education`
--
ALTER TABLE `candidate_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `candidate_languages`
--
ALTER TABLE `candidate_languages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `candidate_skills`
--
ALTER TABLE `candidate_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `company_categories`
--
ALTER TABLE `company_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `company_skills`
--
ALTER TABLE `company_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `company_social_links`
--
ALTER TABLE `company_social_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `how_it_works`
--
ALTER TABLE `how_it_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `job_category` (`job_category`);

--
-- Indexes for table `job_qualifications`
--
ALTER TABLE `job_qualifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_services`
--
ALTER TABLE `about_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `about_social_links`
--
ALTER TABLE `about_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidate_education`
--
ALTER TABLE `candidate_education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `candidate_languages`
--
ALTER TABLE `candidate_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `candidate_skills`
--
ALTER TABLE `candidate_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `company_categories`
--
ALTER TABLE `company_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company_skills`
--
ALTER TABLE `company_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `company_social_links`
--
ALTER TABLE `company_social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `how_it_works`
--
ALTER TABLE `how_it_works`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `job_qualifications`
--
ALTER TABLE `job_qualifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `job_skills`
--
ALTER TABLE `job_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `terms_conditions`
--
ALTER TABLE `terms_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_services`
--
ALTER TABLE `about_services`
  ADD CONSTRAINT `about_services_ibfk_1` FOREIGN KEY (`about_id`) REFERENCES `about_us` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `about_social_links`
--
ALTER TABLE `about_social_links`
  ADD CONSTRAINT `about_social_links_ibfk_1` FOREIGN KEY (`about_id`) REFERENCES `about_us` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `candidate_education`
--
ALTER TABLE `candidate_education`
  ADD CONSTRAINT `candidate_education_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `candidate_languages`
--
ALTER TABLE `candidate_languages`
  ADD CONSTRAINT `candidate_languages_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `candidate_skills`
--
ALTER TABLE `candidate_skills`
  ADD CONSTRAINT `candidate_skills_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_categories`
--
ALTER TABLE `company_categories`
  ADD CONSTRAINT `company_categories_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `company_skills`
--
ALTER TABLE `company_skills`
  ADD CONSTRAINT `company_skills_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_social_links`
--
ALTER TABLE `company_social_links`
  ADD CONSTRAINT `company_social_links_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`job_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_qualifications`
--
ALTER TABLE `job_qualifications`
  ADD CONSTRAINT `job_qualifications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_skills`
--
ALTER TABLE `job_skills`
  ADD CONSTRAINT `job_skills_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_types`
--
ALTER TABLE `job_types`
  ADD CONSTRAINT `job_types_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
