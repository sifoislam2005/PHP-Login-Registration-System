-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2026 at 01:04 AM
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
-- Database: `auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `informations`
--

CREATE TABLE `informations` (
  `name` varchar(190) DEFAULT NULL,
  `email` varchar(190) DEFAULT NULL,
  `phone` char(190) DEFAULT NULL,
  `pass` varchar(190) DEFAULT NULL,
  `verify_token` varchar(190) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verify_status` int(1) DEFAULT 0 COMMENT '0=no_verify , 1=verified',
  `psw_repeat` varchar(50) DEFAULT NULL,
  `psw_verify_token` varchar(190) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informations`
--

INSERT INTO `informations` (`name`, `email`, `phone`, `pass`, `verify_token`, `created_at`, `verify_status`, `psw_repeat`, `psw_verify_token`) VALUES
('Djilali ayad', 'sifoda2107@gmail.com', '+33608834616', 'dsdsds', 'a32bc21d78ebb28ca80506ec01e03e4a', '2026-02-26 17:14:13', 0, NULL, NULL),
('SeyfElislam', 'sifoislam2005@gmail.com', '0608834516', 'sifoda2107', '987047e88b0d66cf282ff8e21f8ae681', '2026-02-28 01:16:43', 1, NULL, '8ab42afda8020644b21537c48aa78dbd'),
('roberto', 'rob.hernandez@gmail.com', '0608834516', '12345678', '17172bbf40f5c9c0cf61cf9da389c208', '2026-03-02 08:44:47', 0, NULL, NULL),
('SeyfElislam', 'rob.hernandezdiaz@gmail.com', '0608834516', '123456786', '7439d32da0854adfffbcea4696035e84', '2026-03-02 08:45:35', 0, NULL, '328e4cf21ebffeade54ef25d32ab82e6'),
('snow', 'snow@gmail.com', '0608834516', '12345678', '0e981df4e1ac76aa31c72423b0e3c169', '2026-03-05 01:33:00', 0, '12345678', NULL),
('enzo', 'enzodruere@gmail.com', '0608834516', '12345678', 'c6520018eea050d601aae0fcb5784b0d', '2026-03-12 10:17:28', 0, '12345678', '43636f2a0722a7a5ea92fb37d94665be');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
