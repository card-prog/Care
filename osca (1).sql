-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2025 at 03:06 PM
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
-- Database: `osca`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `number` int(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `position`, `number`, `age`, `sex`, `address`, `picture`) VALUES
(1, 'paulo', '1234', 'Ferdinand Paulo', 'Felices', 'Sacdalan', 'Admin', 2147483647, '22', 'Male', 'Tuy, Batangas', 'uploads/1742969275_Monk-Fray-Juan-de-Plasencia.jpg'),
(2, 'student', '$2y$10$Yz9DVFv.aBGLfLniQANKkOk5OCenmzsVVqzpDAOiVXEAMeK7rUW9q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(255) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `captions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `pic`, `captions`) VALUES
(1, 'uploads/1744334053_486653823_1150594753468630_8107579498389991473_n.jpg', 'gfbdf'),
(2, 'uploads/1744341008_WELCOME TO OSCA.png', 'ASDSD'),
(3, 'uploads/1744348510_486239536_1194557882022390_1489356583325271876_n.jpg', 'dasfdgdfgsfvdfdvfvbeefeetgrybtyhrgfddd'),
(4, 'uploads/1744350273_91d1f9b0e7ee7d6d0171c9c9c714e0f1.jpg', 'mbnnn'),
(5, 'uploads/1744350331_91d1f9b0e7ee7d6d0171c9c9c714e0f1.jpg', 'mbnnn'),
(6, 'uploads/1744350341_bg.png', 'sdcscx'),
(7, 'uploads/1744350361_Group 6.png', 'asdaasd'),
(8, 'uploads/1744350383_Group 6.png', 'asdaasd'),
(9, 'uploads/1744350414_Group 6.png', 'asdaasd'),
(10, 'uploads/1744350440_Group 6.png', 'asdaasd'),
(11, 'uploads/1744350478_Group 6.png', 'asdaasd'),
(12, 'uploads/1744350724_486187339_1008676887362383_7803255008832822985_n.jpg', 'zxcxzc'),
(13, 'uploads/1744350727_486187339_1008676887362383_7803255008832822985_n.jpg', 'zxcxzc'),
(14, 'uploads/1744350731_486187339_1008676887362383_7803255008832822985_n.jpg', 'zxcxzc'),
(15, 'uploads/1744350812_486187339_1008676887362383_7803255008832822985_n.jpg', 'zxcxzc');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`) VALUES
(1, 'High Cost of Medicines'),
(2, 'Lack of Medicines'),
(3, 'Lack of Medical Attension'),
(4, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(255) NOT NULL,
  `asset` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id`, `asset`) VALUES
(1, 'Automobile'),
(2, 'Heavy Equipment'),
(3, 'Motorcycle'),
(4, 'Personal Computer'),
(5, 'Laptop'),
(6, 'Mobile Phones'),
(7, 'Boats'),
(8, 'Drones'),
(9, 'Appliances'),
(10, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `id` int(255) NOT NULL,
  `barangay` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`id`, `barangay`) VALUES
(43, 'AGA'),
(44, 'BALAYTIGUI'),
(45, 'BANILAD'),
(46, 'BARANGAY 1 (POB.)'),
(47, 'BARANGAY 2 (POB.)'),
(48, 'BARANGAY 3 (POB.)'),
(49, 'BARANGAY 4 (POB.)'),
(50, 'BARANGAY 5 (POB.)'),
(51, 'BARANGAY 6 (POB.)'),
(52, 'BARANGAY 7 (POB.)'),
(53, 'BARANGAY 8 (POB.)'),
(54, 'BARANGAY 9 (POB.)'),
(55, 'BARANGAY 10 (POB.)'),
(56, 'BARANGAY 11 (POB.)'),
(57, 'BARANGAY 12 (POB.)'),
(58, 'BILARAN'),
(59, 'BUCANA'),
(60, 'BULIHAN'),
(61, 'BUNDUCAN'),
(62, 'BUTUCAN'),
(63, 'CALAYO'),
(64, 'CATANDAAN'),
(65, 'KAYLAWAY'),
(66, 'KAYRILAW'),
(67, 'COGUNAN'),
(68, 'DAYAP'),
(69, 'LATAG'),
(70, 'LOOC'),
(71, 'LUMBANGAN'),
(72, 'MALAPAD NA BATO'),
(73, 'MATAAS NA PULO'),
(74, 'MAUGAT'),
(75, 'MUNTING INDANG'),
(76, 'NATIPUAN'),
(77, 'PANTALAN'),
(78, 'PAPAYA'),
(79, 'PUTAT'),
(80, 'REPARO'),
(81, 'TALANGAN'),
(82, 'TUMALIM'),
(83, 'UTOD'),
(84, 'WAWA');

-- --------------------------------------------------------

--
-- Table structure for table `dental`
--

CREATE TABLE `dental` (
  `id` int(11) NOT NULL,
  `dental` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dental`
--

INSERT INTO `dental` (`id`, `dental`) VALUES
(1, 'NEED DENTAL CARE'),
(2, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `done`
--

CREATE TABLE `done` (
  `id` int(255) NOT NULL,
  `done` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `done`
--

INSERT INTO `done` (`id`, `done`) VALUES
(1, 'Yearly'),
(2, 'Monthly'),
(3, 'Every 6 Months?'),
(4, 'When Every have Sickness?');

-- --------------------------------------------------------

--
-- Table structure for table `educational`
--

CREATE TABLE `educational` (
  `id` int(11) NOT NULL,
  `educational` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational`
--

INSERT INTO `educational` (`id`, `educational`) VALUES
(1, 'Elementary Level'),
(2, 'Elementary Graduate'),
(3, 'High School Level'),
(4, 'High School Graduate'),
(5, 'College Level'),
(6, 'College Graduate'),
(7, 'Post Graduate'),
(8, 'Vocational'),
(9, 'Not Attended School');

-- --------------------------------------------------------

--
-- Table structure for table `hearing`
--

CREATE TABLE `hearing` (
  `id` int(11) NOT NULL,
  `hearing` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hearing`
--

INSERT INTO `hearing` (`id`, `hearing`) VALUES
(1, 'Aural Impairment'),
(2, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `id` int(255) NOT NULL,
  `household` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`id`, `household`) VALUES
(1, 'No Privacy'),
(2, 'Informal Settler'),
(3, 'High Cost of Rent'),
(4, 'Overcrowded in Home'),
(5, 'No Permanent House'),
(6, 'Longing for Independent Living Quiet Atmosphere'),
(7, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `income` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `income`) VALUES
(1, '70,000 and Above'),
(2, '60,000 to 70,000'),
(3, '50,000 to 60,000'),
(4, '40,000 to 50,000'),
(5, '30,000 to 40,000'),
(6, '20,000 to 30,000'),
(7, '10,000 to 20,000'),
(8, '5,000 to 10,000'),
(9, '1,000 to 5,000'),
(10, 'Below 1,000'),
(11, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `mastery`
--

CREATE TABLE `mastery` (
  `id` int(11) NOT NULL,
  `mastery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mastery`
--

INSERT INTO `mastery` (`id`, `mastery`) VALUES
(1, 'Medical'),
(2, 'Dental'),
(3, 'Fishing'),
(4, 'Engineering'),
(5, 'Barber'),
(6, 'Evangelization'),
(7, 'Millwright'),
(8, 'Teaching'),
(9, 'Counseling'),
(10, 'Cooking'),
(11, 'Carpenter'),
(12, 'Mason'),
(13, 'Tailor'),
(14, 'Legal Services'),
(15, 'Farming'),
(16, 'Arts'),
(17, 'Plumber'),
(18, 'Sapatero'),
(19, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `optical`
--

CREATE TABLE `optical` (
  `id` int(11) NOT NULL,
  `optical` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `optical`
--

INSERT INTO `optical` (`id`, `optical`) VALUES
(1, 'EYE IMPAIRMENT'),
(2, 'NEED EYE CARE'),
(3, 'NONE');

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `id` int(11) NOT NULL,
  `problem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`id`, `problem`) VALUES
(1, 'Lack of Income / Resources'),
(2, 'Loss of Income / Resources'),
(3, 'Skills / Capability Training'),
(4, 'Livelihood Oppurtunities'),
(5, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `properties` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `properties`) VALUES
(1, 'House'),
(2, 'Commercial Building'),
(3, 'House & Lot'),
(4, 'Lot'),
(5, 'Fishpond / Resort'),
(6, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `residency`
--

CREATE TABLE `residency` (
  `id` int(11) NOT NULL,
  `residency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residency`
--

INSERT INTO `residency` (`id`, `residency`) VALUES
(1, 'Alone'),
(2, 'Spouse'),
(3, 'Children'),
(4, 'Grand Children'),
(5, 'In Laws'),
(6, 'Relatives'),
(7, 'Common Law Spouse'),
(8, 'Care Instution'),
(9, 'Friends'),
(10, 'Sister / Brother'),
(11, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `senior_citizens`
--

CREATE TABLE `senior_citizens` (
  `id` int(11) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birthdate` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthplace` varchar(100) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `ethnic` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `osca_id` varchar(50) DEFAULT NULL,
  `rrn` int(255) DEFAULT NULL,
  `sss_gsis` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `other_govt_id` varchar(100) DEFAULT NULL,
  `travel` varchar(50) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `pension` varchar(50) DEFAULT NULL,
  `spouse_name` varchar(100) DEFAULT NULL,
  `fspouse` varchar(255) DEFAULT NULL,
  `mspouse` varchar(255) DEFAULT NULL,
  `children` text DEFAULT NULL,
  `fchild` varchar(255) DEFAULT NULL,
  `mchild` varchar(255) DEFAULT NULL,
  `childage` int(255) DEFAULT NULL,
  `occhild` varchar(50) DEFAULT NULL,
  `working` varchar(255) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `mastery` varchar(100) DEFAULT NULL,
  `residency` varchar(100) DEFAULT NULL,
  `household` varchar(255) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `properties` varchar(255) DEFAULT NULL,
  `asset` varchar(255) DEFAULT NULL,
  `income` varchar(255) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `blood` varchar(255) DEFAULT NULL,
  `hearing` varchar(255) DEFAULT NULL,
  `dental` varchar(255) DEFAULT NULL,
  `optical` varchar(255) DEFAULT NULL,
  `social` varchar(255) DEFAULT NULL,
  `area` varchar(255) NOT NULL,
  `medical` varchar(255) DEFAULT NULL,
  `medicines` varchar(255) DEFAULT NULL,
  `checkup` varchar(255) DEFAULT NULL,
  `done` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `senior_citizens`
--

INSERT INTO `senior_citizens` (`id`, `last_name`, `first_name`, `middle_name`, `region`, `province`, `municipality`, `barangay`, `address`, `birthdate`, `age`, `birthplace`, `marital_status`, `gender`, `contact_number`, `religion`, `ethnic`, `language`, `osca_id`, `rrn`, `sss_gsis`, `tin`, `philhealth`, `other_govt_id`, `travel`, `service`, `pension`, `spouse_name`, `fspouse`, `mspouse`, `children`, `fchild`, `mchild`, `childage`, `occhild`, `working`, `education`, `mastery`, `residency`, `household`, `source`, `properties`, `asset`, `income`, `problem`, `blood`, `hearing`, `dental`, `optical`, `social`, `area`, `medical`, `medicines`, `checkup`, `done`, `remarks`) VALUES
(1162, 'VALDEZ', 'MYRNA', 'SAGRADA', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'SILANGAN', '10-12-56', 64, 'MASBATE', 'MARRIED', 'FEMALE', 'NONE', 'CATHOLIC', '', 'TAGALOG', 'B22-4522', 0, 'N/A', 'NO', 'NO', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'LUNOK', 'SASUKE', 'UCHIA', 23, 'GUARD', 'WORKING', 'ELEMENTARY LEVEL', 'MEDICAL', 'ALONE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'AUTOMOBILE', '1,000-5,000', 'NONE', 'AB', 'AURAL IMPAIRMENT', 'NONE', 'EYE IMPAIRMENT', 'UNABLE TO PERFORM SIMPLE DAILY TASK', 'HIGH COST OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1163, 'VELASQUEZ', 'FRANCISCO', 'CALIO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LOWE VILLAGE', '12-13-41', 87, 'LEYTE', 'MARRIED', 'MALE', 'N/A', 'CATHOLIC', '', 'TAGALOG', 'B22-1261', 0, 'N/A', 'NO', 'YES', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'DELTA', 'HINATA', 'YUGA', 23, 'HOUSE WIFE', 'NOT WORKING', 'COLLEGE GRADUATE', 'DENTAL', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'LAPTOP', '70,000 ABOVE', 'NONE', 'B', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'DIABETES', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1164, 'VILLAFLOR', 'REMEDIOS', 'FRANCISCO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LABAK', '01-14-60', 60, 'NASUGBU', 'MARRIED', 'FEMALE', '9054851524', '', '', 'TAGALOG', 'B19-1736', 0, 'YES', 'YES', 'YES', 'YES', 'YES', 'NONE', 'GSIS PENSION', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'HIGH SCHOOL GRADUTAE', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'MOTORCYCLE', '70,000 ABOVE', 'NONE', 'AB', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'HIGH BLOOD', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1165, 'VALDEZ', 'MYRNA', 'SAGRADA', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'SILANGAN', '10-12-56', 64, 'MASBATE', 'MARRIED', 'FEMALE', 'NONE', 'CATHOLIC', '', 'TAGALOG', 'B22-4522', 0, 'N/A', 'NO', 'NO', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'LUNOK', 'SASUKE', 'UCHIA', 23, 'GUARD', 'WORKING', 'ELEMENTARY LEVEL', 'MEDICAL', 'ALONE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'AUTOMOBILE', '1,000-5,000', 'NONE', 'AB', 'AURAL IMPAIRMENT', 'NONE', 'EYE IMPAIRMENT', 'UNABLE TO PERFORM SIMPLE DAILY TASK', 'HIGH COST OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1168, 'VALDEZ', 'MYRNA', 'SAGRADA', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'SILANGAN', '10-12-56', 64, 'MASBATE', 'MARRIED', 'FEMALE', 'NONE', 'CATHOLIC', '', 'TAGALOG', 'B22-4522', 0, 'N/A', 'NO', 'NO', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'LUNOK', 'SASUKE', 'UCHIA', 23, 'GUARD', 'WORKING', 'ELEMENTARY LEVEL', 'MEDICAL', 'ALONE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'AUTOMOBILE', '1,000-5,000', 'NONE', 'AB', 'AURAL IMPAIRMENT', 'NONE', 'EYE IMPAIRMENT', 'UNABLE TO PERFORM SIMPLE DAILY TASK', 'HIGH COST OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1169, 'VELASQUEZ', 'FRANCISCO', 'CALIO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LOWE VILLAGE', '12-13-41', 87, 'LEYTE', 'MARRIED', 'MALE', 'N/A', 'CATHOLIC', '', 'TAGALOG', 'B22-1261', 0, 'N/A', 'NO', 'YES', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'DELTA', 'HINATA', 'YUGA', 23, 'HOUSE WIFE', 'NOT WORKING', 'COLLEGE GRADUATE', 'DENTAL', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'LAPTOP', '70,000 ABOVE', 'NONE', 'B', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'DIABETES', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1170, 'VILLAFLOR', 'REMEDIOS', 'FRANCISCO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LABAK', '01-14-60', 60, 'NASUGBU', 'MARRIED', 'FEMALE', '9054851524', '', '', 'TAGALOG', 'B19-1736', 0, 'YES', 'YES', 'YES', 'YES', 'YES', 'NONE', 'GSIS PENSION', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'HIGH SCHOOL GRADUTAE', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'MOTORCYCLE', '70,000 ABOVE', 'NONE', 'AB', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'HIGH BLOOD', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1171, 'VALDEZ', 'MYRNA', 'SAGRADA', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'SILANGAN', '10-12-56', 64, 'MASBATE', 'MARRIED', 'FEMALE', 'NONE', 'CATHOLIC', '', 'TAGALOG', 'B22-4522', 0, 'N/A', 'NO', 'NO', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'LUNOK', 'SASUKE', 'UCHIA', 23, 'GUARD', 'WORKING', 'ELEMENTARY LEVEL', 'MEDICAL', 'ALONE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'AUTOMOBILE', '1,000-5,000', 'NONE', 'AB', 'AURAL IMPAIRMENT', 'NONE', 'EYE IMPAIRMENT', 'UNABLE TO PERFORM SIMPLE DAILY TASK', 'HIGH COST OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1172, 'VELASQUEZ', 'FRANCISCO', 'CALIO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LOWE VILLAGE', '12-13-41', 87, 'LEYTE', 'MARRIED', 'MALE', 'N/A', 'CATHOLIC', '', 'TAGALOG', 'B22-1261', 0, 'N/A', 'NO', 'YES', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'DELTA', 'HINATA', 'YUGA', 23, 'HOUSE WIFE', 'NOT WORKING', 'COLLEGE GRADUATE', 'DENTAL', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'LAPTOP', '70,000 ABOVE', 'NONE', 'B', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'DIABETES', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1173, 'VILLAFLOR', 'REMEDIOS', 'FRANCISCO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LABAK', '01-14-60', 60, 'NASUGBU', 'MARRIED', 'FEMALE', '9054851524', '', '', 'TAGALOG', 'B19-1736', 0, 'YES', 'YES', 'YES', 'YES', 'YES', 'NONE', 'GSIS PENSION', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'HIGH SCHOOL GRADUTAE', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'MOTORCYCLE', '70,000 ABOVE', 'NONE', 'AB', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'HIGH BLOOD', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1174, 'VALDEZ', 'MYRNA', 'SAGRADA', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'SILANGAN', '10-12-56', 64, 'MASBATE', 'MARRIED', 'FEMALE', 'NONE', 'CATHOLIC', '', 'TAGALOG', 'B22-4522', 0, 'N/A', 'NO', 'NO', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'LUNOK', 'SASUKE', 'UCHIA', 23, 'GUARD', 'WORKING', 'ELEMENTARY LEVEL', 'MEDICAL', 'ALONE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'AUTOMOBILE', '1,000-5,000', 'NONE', 'AB', 'AURAL IMPAIRMENT', 'NONE', 'EYE IMPAIRMENT', 'UNABLE TO PERFORM SIMPLE DAILY TASK', 'HIGH COST OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1175, 'VELASQUEZ', 'FRANCISCO', 'CALIO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LOWE VILLAGE', '12-13-41', 87, 'LEYTE', 'MARRIED', 'MALE', 'N/A', 'CATHOLIC', '', 'TAGALOG', 'B22-1261', 0, 'N/A', 'NO', 'YES', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'DELTA', 'HINATA', 'YUGA', 23, 'HOUSE WIFE', 'NOT WORKING', 'COLLEGE GRADUATE', 'DENTAL', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'LAPTOP', '70,000 ABOVE', 'NONE', 'B', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'DIABETES', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1176, 'VILLAFLOR', 'REMEDIOS', 'FRANCISCO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUE', 'LABAK', '01-14-60', 60, 'NASUGBU', 'MARRIED', 'FEMALE', '9054851524', '', '', 'TAGALOG', 'B19-1736', 0, 'YES', 'YES', 'YES', 'YES', 'YES', 'NONE', 'GSIS PENSION', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'HIGH SCHOOL GRADUTAE', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'MOTORCYCLE', '70,000 ABOVE', 'NONE', 'AB', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'HIGH BLOOD', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1180, 'VALDEZ', 'MYRNA', 'SAGRADA', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUI', 'SILANGAN', '03-28-56', 64, 'MASBATE', 'MARRIED', 'FEMALE', 'NONE', 'CATHOLIC', '', 'TAGALOG', 'B22-4522', 0, 'N/A', 'NO', 'NO', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'LUNOK', 'SASUKE', 'UCHIA', 23, 'GUARD', 'WORKING', 'ELEMENTARY LEVEL', 'MEDICAL', 'ALONE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'AUTOMOBILE', '1,000-5,000', 'NONE', 'AB', 'AURAL IMPAIRMENT', 'NONE', 'EYE IMPAIRMENT', 'UNABLE TO PERFORM SIMPLE DAILY TASK', 'HIGH COST OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1181, 'VELASQUEZ', 'FRANCISCO', 'CALIO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUI', 'LOWE VILLAGE', '12-25-41', 87, 'LEYTE', 'MARRIED', 'MALE', 'N/A', 'CATHOLIC', '', 'TAGALOG', 'B22-1261', 0, 'N/A', 'NO', 'YES', 'NO', 'YES', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'DELTA', 'HINATA', 'YUGA', 23, 'HOUSE WIFE', 'NOT WORKING', 'COLLEGE GRADUATE', 'DENTAL', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'LAPTOP', '70,000 ABOVE', 'NONE', 'B', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'DIABETES', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1182, 'VILLAFLOR', 'REMEDIOS', 'FRANCISCO', '4-A', 'BATANGAS', 'NASUGBU', 'BALAYTIGUI', 'LABAK', '11-04-60', 60, 'NASUGBU', 'MARRIED', 'FEMALE', '9054851524', '', '', 'TAGALOG', 'B19-1736', 0, 'YES', 'YES', 'YES', 'YES', 'YES', 'NONE', 'GSIS PENSION', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'HIGH SCHOOL GRADUTAE', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE', 'MOTORCYCLE', '70,000 ABOVE', 'NONE', 'AB', 'HEARING IMPAIRMENT', 'NONE', 'NONE', 'FEELING NEGLECTES / REJECTION', 'HIGH COST OF MEDICINES', 'HIGH BLOOD', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1183, 'ULARTE', 'ENGRACIO', 'BAUYON', '4-A', 'BATANGAS', 'NASUGBU', 'LOOC', 'HULO', '04-16-62', 63, 'BILARAN', 'WIDOW', 'MALE', '9915829858', 'CATHOLIC', '', 'TAGALOG', 'NONE', 0, 'YES', 'NONE', 'YES', 'YES', 'NONE', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'ELEMENTARY LEVEL', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'LOT', 'MOBILE PHONE', 'BELOW 1,000', 'LACK OF INCOME / RESOURCES', 'AB', 'NONE', 'NEED DENTAL CARE', 'NEED EYE CARE', 'FEELING LONELINESS / ISOLATE', 'LACK OF MEDICINES', 'HIGH BLOOD', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1184, 'ULARTE', 'DOMINCA', 'MENDOZA', '4-A', 'BATANGAS', 'NASUGBU', 'LOOC', 'HULO', '01-09-59', 66, 'LOOC', 'NONE', 'FEMALE', 'NONE', 'CATHOLIC', '', 'TAGALOG', 'NONE', 0, 'NONE', 'NONE', 'NONE', 'NO', 'NONE', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'VOCATIONAL', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'HOUSE & LOT', 'MOTORCYCLE', '1,000 to 5,000', 'LIVELIHOOD OPPORTUNITIES', 'B', 'AURAL IMPAIRMENT', 'NONE', 'EYE IMPAIRMENT', 'LACK OF LESUIRE / RECREATIONAL ACTIVITIES', 'LACK OF MEDICINES', 'DIABETES', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1185, 'ULARTE', 'LORETA', 'HERNANDEZ', '4-A', 'BATANGAS', 'NASUGBU', 'LOOC', 'IBAYO', '12-09-53', 72, 'LOOC', 'SINGLE', 'FEMALE', '9516046340', 'CATHOLIC', '', 'TAGALOG', 'NONE', 0, 'NONE', 'YES', 'YES', 'NO', 'NONE', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 23, 'HOKAGE', 'WORKING', 'COLLEGE GRADUATE', 'COOKING', 'SPOUSE', 'NONE', 'OWN EARNING, SALARY / WAGES', 'FARM & LOT', 'LAPTOP', 'BELOW 1,000', 'NONE', 'O', 'NONE', 'NEED DENTAL CARE', 'NONE', 'UNABLE TO PERFORM SIMPLE DAILY TASK', 'LACK OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1186, 'VILLALUNA', 'EUFROCINA', 'BAUTISTA', '4-A', 'BATANGAS', 'NASUGBU', 'CALAYO', 'CENTRO', '03-04-50', 80, 'NASUGBU', 'MARRIED', 'FEMALE', '9516046340', 'CATHOLIC', '', 'TAGALOG', 'NONE', 0, 'NONE', 'YES', 'YES', 'NO', 'NONE', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 24, 'HOKAGE', 'WORKING', 'VOCATIONAL', 'FARMING', 'CHILDREN', 'NO PRIVACY', 'SPOUSE SALARY', 'FARM & LOT', 'LAPTOP', 'BELOW 1,000', 'LIVELIHOOD OPPORTUNITIES', 'B', 'AURAL IMPAIRMENT', 'NEED DENTAL CARE', 'NEED EYE CARE', 'FEELING LONELINESS / ISOLATE', 'HIGH COST OF MEDICINES', 'HYPERTENSION', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1187, 'VILLACIETE', 'REYNALDO', 'LIWANAG', '4-A', 'BATANGAS', 'NASUGBU', 'CALAYO', 'CENTRO', '05-08-35', 89, 'NASUGBU', 'WIDOW', 'FEMALE', '9516046340', 'CATHOLIC', '', 'TAGALOG', 'NONE', 0, 'NONE', 'YES', 'YES', 'NO', 'NONE', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 25, 'HOKAGE', 'WORKING', 'COLLEGE GRADUATE', 'COOKING', 'FRIENDS', 'HIGH COST RENT', 'SPOUSE PENSION', 'LOT', 'LAPTOP', '70,000 ABOVE', 'LIVELIHOOD OPPORTUNITIES', 'A', 'NONE', 'NONE', 'EYE IMPAIRMENT', 'LACK OF LESUIRE / RECREATIONAL ACTIVITIES', 'LACK OF MEDICINES', 'HIGH BLOOD', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1188, 'VELOSO', 'JOSEPH', 'AMBAL', '4-A', 'BATANGAS', 'NASUGBU', 'CALAYO', 'SAMPAGUITA', '01-01-55', 90, 'NASUGBU', 'SEPERATED', 'FEMALE', '9516046340', 'CATHOLIC', '', 'TAGALOG', 'NONE', 0, 'NONE', 'YES', 'YES', 'NO', 'NONE', 'NONE', 'NONE', 'N/A', 'N/A', 'N/A', 'UZUMAKI', 'NARUTO', 'KAMIKAZE', 26, 'HOKAGE', 'WORKING', 'HIGH SCHOOL GRADUTAE', 'MEDICAL', 'ALONE', 'INFORMAL SETTLER', 'OWN PENSION', 'FARM & LOT', 'LAPTOP', '70,000 ABOVE', 'LACK OF INCOME / RESOURCES', 'O', 'NONE', 'NEED DENTAL CARE', 'NONE', 'FEELING LONELINESS / ISOLATE', 'HIGH COST OF MEDICINES', 'DIABETES', 'INSOLN', 'NO', 'NONE', 'PRIORITY'),
(1190, 'sdas', 'dasda', 'adas', '', '', '', '', '', '2025-04-05', 65, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1191, 'Sacdalan', 'Ferdinand Paulo', 'Felices', '', '', '', 'AGA', '', '2025-04-06', 56, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `social` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `social`) VALUES
(1, 'Unable to Perform Simple Daily Task'),
(2, 'Feeling Neglect / Rejection'),
(3, 'Feeling Helplessness / Worthless'),
(4, 'Feeling Loneliness / Isolate'),
(5, 'Lack of Leisure / Recreational Activities'),
(6, 'Lack of Friendly Environment'),
(7, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `source`) VALUES
(1, 'Own Ernings Salary / Wages'),
(2, 'Dependent on Children / Relatives'),
(3, 'Spouse Salary'),
(4, 'Spouse Pension'),
(5, 'Livestock / Orchard / Farm'),
(6, 'Own Pension'),
(7, 'Rental / Sharecrops'),
(8, 'Stock / Divodends'),
(9, 'Insurance'),
(10, 'Savings'),
(11, 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dental`
--
ALTER TABLE `dental`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `done`
--
ALTER TABLE `done`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational`
--
ALTER TABLE `educational`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hearing`
--
ALTER TABLE `hearing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `household`
--
ALTER TABLE `household`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mastery`
--
ALTER TABLE `mastery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `optical`
--
ALTER TABLE `optical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residency`
--
ALTER TABLE `residency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senior_citizens`
--
ALTER TABLE `senior_citizens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `dental`
--
ALTER TABLE `dental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `done`
--
ALTER TABLE `done`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `educational`
--
ALTER TABLE `educational`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hearing`
--
ALTER TABLE `hearing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mastery`
--
ALTER TABLE `mastery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `optical`
--
ALTER TABLE `optical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `residency`
--
ALTER TABLE `residency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `senior_citizens`
--
ALTER TABLE `senior_citizens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1208;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
