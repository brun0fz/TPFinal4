-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2022 at 08:00 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PetHero`
--

-- --------------------------------------------------------

--
-- Table structure for table `Duenios`
--

CREATE TABLE `Duenios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` int(11) DEFAULT 1,
  `rutaFoto` varchar(100) DEFAULT 'undefinedProfile.png',
  `alta` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Duenios`
--

INSERT INTO `Duenios` (`id`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`) VALUES
(1, 'Bruno', 'Fabrizio', '2236683755', 'bruno@gmail.com', '123', 1, 'bruno@gmail.com.jpg', 1),
(8, 'Gina', 'Fabrizio', '2236589865', 'gina@gmail.com', '123', 1, 'undefinedProfile.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Mascotas`
--

CREATE TABLE `Mascotas` (
  `id` int(11) NOT NULL,
  `animal` varchar(100) NOT NULL,
  `raza` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tamanio` varchar(100) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `rutaFoto` varchar(100) NOT NULL,
  `idDuenio` int(11) NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT 1
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Mascotas`
--
ALTER TABLE `Mascotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
