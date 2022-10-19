-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bumivsrscryp1fqpzsmn-mysql.services.clever-cloud.com:3306
-- Generation Time: Oct 19, 2022 at 08:27 PM
-- Server version: 8.0.22-13
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumivsrscryp1fqpzsmn`
--
CREATE DATABASE IF NOT EXISTS `bumivsrscryp1fqpzsmn` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bumivsrscryp1fqpzsmn`;

-- --------------------------------------------------------

--
-- Table structure for table `Duenios`
--

CREATE TABLE `Duenios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` int DEFAULT '1',
  `rutaFoto` varchar(100) DEFAULT 'undefinedProfile.png',
  `alta` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Duenios`
--

INSERT INTO `Duenios` (`id`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`) VALUES
(1, 'Bruno', 'Fabrizio', '2236683755', 'bruno@gmail.com', '123', 1, 'bruno@gmail.com.jpg', 1),
(8, 'Gina', 'Fabrizio', '2236589865', 'gina@gmail.com', '123', 1, 'undefinedProfile.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Guardianes`
--

CREATE TABLE `Guardianes` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '2',
  `rutaFoto` varchar(100) NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1',
  `calle` varchar(100) NOT NULL,
  `numero` varchar(100) NOT NULL,
  `precioXDia` float DEFAULT '0',
  `reputacion` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Guardianes`
--

INSERT INTO `Guardianes` (`id`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`, `calle`, `numero`, `precioXDia`, `reputacion`) VALUES
(1, 'Belen', 'Robledo', '2236658582', 'belen@gmail.com', '123', 2, 'belen@gmail.com.jpeg', 1, 'Luro', '2365', 799, 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `Mascotas`
--

CREATE TABLE `Mascotas` (
  `id` int NOT NULL,
  `animal` varchar(100) NOT NULL,
  `raza` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tamanio` varchar(100) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `rutaFoto` varchar(100) NOT NULL,
  `idDuenio` int NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Mascotas`
--

INSERT INTO `Mascotas` (`id`, `animal`, `raza`, `nombre`, `tamanio`, `observaciones`, `rutaFoto`, `idDuenio`, `alta`) VALUES
(1, 'Perro', 'Shihtzu', 'Junior', 'S', 'Muy bonito', '1-Junior.jpeg', 1, 1),
(2, 'Perro', 'Caniche', 'Luna', 'S', 'Tranquila', '1-Luna.jpeg', 1, 1),
(3, 'Perro', 'Breton', 'Sasha', 'M', 'Dormilona', '8-Sasha.jpeg', 8, 1),
(4, 'Perro', 'Husky', 'Snow', 'L', 'Tranquilo y bueno', '8-Snow.jpeg', 8, 1),
(7, 'Perro', 'Golden', 'Pepito', 'M', 'muy lindo', '1-Pepito.jpeg', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Duenios`
--
ALTER TABLE `Duenios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- Indexes for table `Guardianes`
--
ALTER TABLE `Guardianes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Mascotas`
--
ALTER TABLE `Mascotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_IdDuenio` (`idDuenio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Duenios`
--
ALTER TABLE `Duenios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Guardianes`
--
ALTER TABLE `Guardianes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Mascotas`
--
ALTER TABLE `Mascotas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Mascotas`
--
ALTER TABLE `Mascotas`
  ADD CONSTRAINT `FK_IdDuenio` FOREIGN KEY (`idDuenio`) REFERENCES `Duenios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
