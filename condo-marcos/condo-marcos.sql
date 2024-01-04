-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 09:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `condo-marcos`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `id` int(11) NOT NULL,
  `num_apa` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_last_name` varchar(255) NOT NULL,
  `postal_address` varchar(255) NOT NULL,
  `genre` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `cuota` decimal(10,2) NOT NULL,
  `deuda` decimal(10,2) NOT NULL,
  `comment` text DEFAULT NULL,
  `condo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `num_apa`, `owner_name`, `owner_last_name`, `postal_address`, `genre`, `email`, `phone`, `cuota`, `deuda`, `comment`, `condo_id`) VALUES
(59, 36, 'Derek', 'Rivera', 'Po box g56', 'male', 'derekart@gmail.com', '9396521452', '1100.00', '1100.00', '0', 12),
(61, 89, 'Daniela', 'Toro', 'Po box g45', 'male', '0', '7874526985', '4000.00', '4000.00', '0', 14),
(62, 22, 'Marcos', 'Hernandez', 'po box t55', 'male', '0', '93962652145', '70000.00', '70000.00', '0', 15),
(63, 45, 'Esmeralda', 'Feliciano', 'po box 34', 'female', 'esme@gmail.com', '4541523658', '99526.00', '99526.00', '0', 11),
(64, 55, 'Cesar', 'Dario', 'po box 56', 'male', 'dariio@gmail.com', '9396542518', '5045430.00', '5045430.00', '0', 11),
(65, 15, 'Gloria', 'Martinez', 'po box u78', 'female', 'Gmartinez@gmail.com', '7874512563', '56000.00', '56000.00', '0', 16);

-- --------------------------------------------------------

--
-- Table structure for table `condos`
--

CREATE TABLE `condos` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `physical_address` varchar(55) NOT NULL,
  `postal_address` varchar(55) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `logo` blob NOT NULL,
  `webpage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condos`
--

INSERT INTO `condos` (`id`, `name`, `physical_address`, `postal_address`, `phone_number`, `logo`, `webpage`) VALUES
(11, 'Bob', 'Estancias claras Calle Diamante f4', 'Estancias claras Calle Diamante f4', '7874512563', '', 'www.linkup@gmail.com'),
(12, 'Felix', 'Urb Jardines del caribe calle flor g4', 'Urb Jardines del caribe calle flor g4', '7874512564', '', 'www.felixjavier@gmail.com'),
(14, 'Diego', 'Urb Hill View calle topacio d45', 'Urb Hill View calle topacio d45', '4512563258', '', 'www.Dmunoz@gmail.com'),
(15, 'Javier', 'Mansiones de monterey calle Esmeralda g4', 'Mansiones de monterey calle Esmeralda g4', '1254587896', '', 'www.Javicorp.com'),
(16, 'David Martinez', 'Estancias de jardines calle topacio g4', 'Estancias de jardines calle topacio g4', '7874512563', '', 'www.openia.com');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_concept` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `apartment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_date`, `payment_concept`, `description`, `amount`, `payment_method`, `apartment_id`) VALUES
(74, '2023-05-10', 'Quota', 'quota example', '430.00', '', 63),
(75, '2023-05-10', 'Quota', 'quota example', '430.00', '', 64),
(76, '2023-05-10', 'Quota', 'quota example', '400.00', '', 59);

-- --------------------------------------------------------

--
-- Table structure for table `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `id` int(11) NOT NULL,
  `name_user` varchar(25) NOT NULL,
  `lastname_user` varchar(25) NOT NULL,
  `genre_user` varchar(15) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `tel_user` varchar(30) NOT NULL,
  `tel_alt_user` varchar(30) DEFAULT NULL,
  `user_username` varchar(50) NOT NULL,
  `pass_user` varchar(25) NOT NULL,
  `comment_user` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`id`, `name_user`, `lastname_user`, `genre_user`, `email_user`, `tel_user`, `tel_alt_user`, `user_username`, `pass_user`, `comment_user`) VALUES
(14, 'admin', 'admin', 'other', 'admin@gmail.com', '(788) 745-4151', '', 'admin', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `condo_id` (`condo_id`);

--
-- Indexes for table `condos`
--
ALTER TABLE `condos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_ibfk_1` (`apartment_id`);

--
-- Indexes for table `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `condos`
--
ALTER TABLE `condos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_ibfk_2` FOREIGN KEY (`condo_id`) REFERENCES `condos` (`id`),
  ADD CONSTRAINT `apartments_ibfk_3` FOREIGN KEY (`condo_id`) REFERENCES `condos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_payments_apartments` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
