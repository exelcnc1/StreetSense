-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 08:10 AM
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
-- Database: `rms123`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `barangay_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `region_id`, `city_name`) VALUES
(409, 1, 'Caloocan'),
(410, 1, 'Las Piñas'),
(411, 1, 'Makati'),
(412, 1, 'Malabon'),
(413, 1, 'Mandaluyong'),
(414, 1, 'Manila'),
(415, 1, 'Marikina'),
(416, 1, 'Muntinlupa'),
(417, 1, 'Navotas'),
(418, 1, 'Parañaque'),
(419, 1, 'Pasay'),
(420, 1, 'Pasig'),
(421, 1, 'Quezon City'),
(422, 1, 'San Juan'),
(423, 1, 'Taguig'),
(424, 1, 'Valenzuela'),
(425, 1, 'Pateros'),
(426, 2, 'Baguio'),
(427, 2, 'Tabuk'),
(428, 3, 'Alaminos'),
(429, 3, 'Dagupan'),
(430, 3, 'San Carlos'),
(431, 3, 'Urdaneta'),
(432, 3, 'Laoag'),
(433, 3, 'Candon'),
(434, 3, 'Vigan'),
(435, 4, 'Tuguegarao'),
(436, 4, 'Ilagan'),
(437, 4, 'Cauayan'),
(438, 4, 'Santiago'),
(439, 5, 'Angeles'),
(440, 5, 'Balanga'),
(441, 5, 'Cabanatuan'),
(442, 5, 'Gapan'),
(443, 5, 'Malolos'),
(444, 5, 'Meycauayan'),
(445, 5, 'Olongapo'),
(446, 5, 'Palayan'),
(447, 5, 'San Fernando'),
(448, 5, 'San Jose del Monte'),
(449, 5, 'Tarlac City'),
(450, 5, 'Muñoz'),
(451, 6, 'Antipolo'),
(452, 6, 'Bacoor'),
(453, 6, 'Batangas City'),
(454, 6, 'Biñan'),
(455, 6, 'Cabuyao'),
(456, 6, 'Calamba'),
(457, 6, 'Cavite City'),
(458, 6, 'Dasmariñas'),
(459, 6, 'General Trias'),
(460, 6, 'Imus'),
(461, 6, 'Lipa'),
(462, 6, 'San Pablo'),
(463, 6, 'San Pedro'),
(464, 6, 'Santa Rosa'),
(465, 6, 'Tanauan'),
(466, 6, 'Tayabas'),
(467, 6, 'Trece Martires'),
(468, 6, 'Tagaytay'),
(469, 7, 'Calapan'),
(470, 7, 'Puerto Princesa'),
(471, 8, 'Iriga'),
(472, 8, 'Legazpi'),
(473, 8, 'Ligao'),
(474, 8, 'Masbate City'),
(475, 8, 'Naga'),
(476, 8, 'Sorsogon City'),
(477, 8, 'Tabaco'),
(478, 9, 'Bacolod'),
(479, 9, 'Bago'),
(480, 9, 'Cadiz'),
(481, 9, 'Escalante'),
(482, 9, 'Himamaylan'),
(483, 9, 'Iloilo City'),
(484, 9, 'Kabankalan'),
(485, 9, 'La Carlota'),
(486, 9, 'Passi'),
(487, 9, 'Roxas'),
(488, 9, 'Sagay'),
(489, 9, 'San Carlos'),
(490, 9, 'Silay'),
(491, 9, 'Sipalay'),
(492, 9, 'Talisay'),
(493, 9, 'Victorias'),
(494, 10, 'Bogo'),
(495, 10, 'Carcar'),
(496, 10, 'Cebu City'),
(497, 10, 'Danao'),
(498, 10, 'Lapu-Lapu'),
(499, 10, 'Mandaue'),
(500, 10, 'Naga'),
(501, 10, 'Talisay'),
(502, 10, 'Tagbilaran'),
(503, 10, 'Toledo'),
(504, 11, 'Baybay'),
(505, 11, 'Borongan'),
(506, 11, 'Calbayog'),
(507, 11, 'Catbalogan'),
(508, 11, 'Maasin'),
(509, 11, 'Ormoc'),
(510, 11, 'Tacloban'),
(511, 12, 'Dapitan'),
(512, 12, 'Dipolog'),
(513, 12, 'Isabela City'),
(514, 12, 'Pagadian'),
(515, 12, 'Zamboanga City'),
(516, 13, 'Cagayan de Oro'),
(517, 13, 'El Salvador'),
(518, 13, 'Gingoog'),
(519, 13, 'Iligan'),
(520, 13, 'Malaybalay'),
(521, 13, 'Valencia'),
(522, 13, 'Oroquieta'),
(523, 13, 'Ozamiz'),
(524, 13, 'Tangub'),
(525, 14, 'Davao City'),
(526, 14, 'Digos'),
(527, 14, 'Island Garden City of Samal'),
(528, 14, 'Panabo'),
(529, 14, 'Tagum'),
(530, 14, 'Mati'),
(531, 15, 'Cotabato City'),
(532, 15, 'General Santos'),
(533, 15, 'Kidapawan'),
(534, 15, 'Koronadal'),
(535, 15, 'Tacurong'),
(536, 16, 'Bayugan'),
(537, 16, 'Bislig'),
(538, 16, 'Butuan'),
(539, 16, 'Cabadbaran'),
(540, 16, 'Surigao City'),
(541, 16, 'Tandag'),
(542, 17, 'Cotabato City'),
(543, 17, 'Lamitan'),
(544, 17, 'Marawi');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `Name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Region` int(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Barangay` varchar(200) NOT NULL,
  `Road` varchar(200) NOT NULL,
  `Incident` varchar(200) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Severity` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`Name`, `Email`, `Region`, `City`, `Barangay`, `Road`, `Incident`, `Date`, `Description`, `Severity`) VALUES
('', '', 2, 'Mandaue', 'Tipolo', 'Elm Street', 'Fallen Trees', '0000-00-00', '', 'Bad'),
('Heart', 'heartdkho@gmail.com', 7, 'Mandaue', 'Subangdako', 'Ac Cortes st.', 'Accident', '2025-03-05', 'Pothole', 'Good'),
('Jithrix', 'Jithrix@gmail.com', 8, 'Manila', 'Osamis', 'Balen', 'Baug ulo', '2025-04-06', '', 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobileno` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`first_name`, `last_name`, `username`, `password`, `mobileno`) VALUES
('Heart', 'Kho', 'heartk466', 'gwapako123', 9164446350),
('Jithrix', 'Bolambao', 'jithrix123', 'Jithrix123', 9074597513),
('Kaye', 'Hormillada', 'kaye123', 'kaye123', 9455210119);

-- --------------------------------------------------------

--
-- Table structure for table `login2`
--

CREATE TABLE `login2` (
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobileno` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login2`
--

INSERT INTO `login2` (`first_name`, `last_name`, `username`, `password`, `mobileno`) VALUES
('Heart', 'Kho', 'heartk466', 'gwapako123', 9164446350),
('Kaye', 'Hormillada', 'kaye123', 'kaye123', 9455210119);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(200) NOT NULL,
  `Region` int(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Barangay` varchar(200) NOT NULL,
  `Project` varchar(200) NOT NULL,
  `Road` varchar(200) NOT NULL,
  `Status` varchar(200) NOT NULL,
  `Percentage` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `Region`, `City`, `Barangay`, `Project`, `Road`, `Status`, `Percentage`) VALUES
(1, 7, 'Mandaue		', 'Subangdako', 'Pothole Repairs', 'M.L Quezon St.', 'Completed', 0),
(2, 7, 'Mandaue', 'Tipolo', 'Resurfacing', 'Lopez Jaena St.', 'Inprogress', 30),
(3, 1, 'La Union', 'San Fernando', 'Bridge Inspection', 'Marilag St.', 'Pending', 0),
(4, 2, 'Mandaue', 'Tipolo', 'Drainage Improvement', 'Elm Street', 'Ongoing', 10),
(5, 4, 'Mandaue', 'Tipolo', 'Lane Expansion', 'Parkway', 'Completed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `region_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `region_name`) VALUES
(1, 'National Capital Region (NCR)'),
(2, 'Cordillera Administrative Region (CAR)'),
(3, 'Region I - Ilocos Region'),
(4, 'Region II - Cagayan Valley'),
(5, 'Region III - Central Luzon'),
(6, 'Region IV-A - CALABARZON'),
(7, 'Region IV-B - MIMAROPA'),
(8, 'Region V - Bicol Region'),
(9, 'Region VI - Western Visayas'),
(10, 'Region VII - Central Visayas'),
(11, 'Region VIII - Eastern Visayas'),
(12, 'Region IX - Zamboanga Peninsula'),
(13, 'Region X - Northern Mindanao'),
(14, 'Region XI - Davao Region'),
(15, 'Region XII - SOCCSKSARGEN'),
(16, 'Region XIII - Caraga'),
(17, 'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)');

-- --------------------------------------------------------

--
-- Table structure for table `road`
--

CREATE TABLE `road` (
  `id` int(200) NOT NULL,
  `Region` int(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Barangay` varchar(200) NOT NULL,
  `Road` varchar(200) NOT NULL,
  `Km` int(200) NOT NULL,
  `Condition` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `road`
--

INSERT INTO `road` (`id`, `Region`, `City`, `Barangay`, `Road`, `Km`, `Condition`) VALUES
(1, 7, 'Mandaue', 'Subangdako', 'M.L Quezon St.', 5, 'Poor'),
(2, 7, 'Mandaue', 'Tipolo', 'Lopez Jaena St.', 8, 'Fair'),
(3, 1, 'La Union', 'San Fernando', 'Marilag St.', 12, 'Poor'),
(4, 2, 'Mandaue', 'Tipolo', 'Elm Street', 6, 'Good'),
(5, 4, 'Mandaue', 'Tipolo', 'Parkway', 10, 'Fair');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`first_name`);

--
-- Indexes for table `login2`
--
ALTER TABLE `login2`
  ADD PRIMARY KEY (`first_name`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `road`
--
ALTER TABLE `road`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=545;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangays`
--
ALTER TABLE `barangays`
  ADD CONSTRAINT `barangays_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
