-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 02:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nusuario`
--

-- --------------------------------------------------------

--
-- Table structure for table `recuperar`
--

CREATE TABLE `recuperar` (
  `email` varchar(50) NOT NULL,
  `clave_nueva` int(8) NOT NULL,
  `token` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recuperar`
--

INSERT INTO `recuperar` (`email`, `clave_nueva`, `token`, `fecha`) VALUES
('mtorti@murialdo.edu.ar', 36578716, '5e9d68141bf673a656df95cc28791c6e', '2025-05-27 20:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `registronuevo`
--

CREATE TABLE `registronuevo` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registronuevo`
--

INSERT INTO `registronuevo` (`nombre`, `apellido`, `email`, `user`, `pass`) VALUES
('Matias', 'Torti', 'mtorti@murialdo.edu.ar', 'Mati21', '$2y$10$wG0ZzxEu37QiHtOvrl0TneO7zC4gebKoGL6he9oePiKUikZ/02TAi'),
('Maxi', 'Friso', 'mfrison@murialdo.edu.ar', 'maxi69', '$2y$10$13TpW5x9sG7oazfC4B.LSurX1ch78xcTYhfel2PKNdH3mb.f1V5fa'),
('Maxi', 'Torti', 'mfrison@murialdo.edu.ar', 'Mati21', '$2y$10$/evagyzouud6b0T7Lh3ILObAuPXTQ7pvw/MSATp.ZMlJtl.MUhAIK'),
('Joaquin', 'Soria', 'jsoria@murialdo.edu.ar', 'js', '$2y$10$CC7INZRS243vKERzEVYvmez/0dxSPZSU63HcvSlM7bcilb.EOrOTS'),
('Julian', 'Panaggio', 'jpanaggio@murialdo.edu.ar', 'julitechy', '$2y$10$/LtQ/OBnCqeJYcDDSFaoYuY47OgaxulHvzFQOJHN2hkQRm1sqIE2m');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
