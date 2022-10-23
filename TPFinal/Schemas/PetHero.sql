-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bumivsrscryp1fqpzsmn-mysql.services.clever-cloud.com:3306
-- Generation Time: Oct 23, 2022 at 02:33 AM
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
-- Table structure for table `Animales`
--

CREATE TABLE `Animales` (
  `idAnimal` int NOT NULL,
  `animal` varchar(100) NOT NULL,
  `raza` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Animales`
--

INSERT INTO `Animales` (`idAnimal`, `animal`, `raza`) VALUES
(5, 'Perro', 'Breton'),
(6, 'Perro', 'Caniche');

-- --------------------------------------------------------

--
-- Table structure for table `Direcciones`
--

CREATE TABLE `Direcciones` (
  `idDireccion` int NOT NULL,
  `calle` varchar(100) NOT NULL,
  `numero` varchar(100) DEFAULT NULL,
  `piso` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `codigoPostal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Direcciones`
--

INSERT INTO `Direcciones` (`idDireccion`, `calle`, `numero`, `piso`, `departamento`, `codigoPostal`) VALUES
(3, 'Luro', '2365', '7', 'C', '7600'),
(4, 'Funes', '3652', '', '', '7600');

-- --------------------------------------------------------

--
-- Table structure for table `Disponibilidades`
--

CREATE TABLE `Disponibilidades` (
  `idDisponibilidad` int NOT NULL,
  `lunes` tinyint(1) DEFAULT '0',
  `martes` tinyint(1) DEFAULT '0',
  `miercoles` tinyint(1) DEFAULT '0',
  `jueves` tinyint(1) DEFAULT '0',
  `viernes` tinyint(1) DEFAULT '0',
  `sabado` tinyint(1) DEFAULT '0',
  `domingo` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Disponibilidades`
--

INSERT INTO `Disponibilidades` (`idDisponibilidad`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`) VALUES
(1, 0, 0, 0, 0, 1, 1, 1),
(2, 1, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Duenios`
--

CREATE TABLE `Duenios` (
  `idDuenio` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` tinyint NOT NULL DEFAULT '1',
  `rutaFoto` varchar(100) NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Duenios`
--

INSERT INTO `Duenios` (`idDuenio`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`) VALUES
(1, 'Bruno', 'Fabrizio', '2236698574', 'bruno@gmail.com', '123', 1, 'bruno@gmail.com.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Guardianes`
--

CREATE TABLE `Guardianes` (
  `idGuardian` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` tinyint NOT NULL DEFAULT '2',
  `rutaFoto` varchar(100) NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1',
  `reputacion` float DEFAULT '0',
  `precioXDia` float DEFAULT '0',
  `fk_idDireccion` int DEFAULT NULL,
  `fk_idDisponibilidad` int DEFAULT NULL,
  `fk_idTamanioMascota` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Guardianes`
--

INSERT INTO `Guardianes` (`idGuardian`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`, `reputacion`, `precioXDia`, `fk_idDireccion`, `fk_idDisponibilidad`, `fk_idTamanioMascota`) VALUES
(3, 'Belen', 'Robledo', '2235589863', 'belen@gmail.com', '123', 2, 'belen@gmail.com.jpeg', 1, 0, 899, 3, 1, 2),
(4, 'Clara', 'Videla', '2235452536', 'clara@gmail.com', '123', 2, 'clara@gmail.com.jpeg', 1, 0, 899, 4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Mascotas`
--

CREATE TABLE `Mascotas` (
  `idMascota` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tamanio` varchar(100) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `rutaFoto` varchar(100) NOT NULL,
  `rutaPlanVacunas` varchar(100) NOT NULL,
  `rutaVideo` varchar(100) DEFAULT 'undefinedVideo',
  `fk_idDuenio` int NOT NULL,
  `fk_idAnimal` int NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Mascotas`
--

INSERT INTO `Mascotas` (`idMascota`, `nombre`, `tamanio`, `observaciones`, `rutaFoto`, `rutaPlanVacunas`, `rutaVideo`, `fk_idDuenio`, `fk_idAnimal`, `alta`) VALUES
(3, 'Sasha', 'M', 'Dormilona', '1-Sasha.jpeg', '1-Vacunas.png', 'undefinedVideo', 1, 5, 1),
(4, 'Lolo', 'S', 'Marron', '1-Lolo.png', '1-Vacunas.png', 'undefinedVideo', 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Reservas`
--

CREATE TABLE `Reservas` (
  `idReserva` int NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `precioTotal` float NOT NULL,
  `fk_idMascota` int NOT NULL,
  `fk_idDuenio` int NOT NULL,
  `fk_idGuardian` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TamaniosMascota`
--

CREATE TABLE `TamaniosMascota` (
  `idTamanioMascota` int NOT NULL,
  `pequenia` tinyint(1) DEFAULT '0',
  `mediana` tinyint(1) DEFAULT '0',
  `grande` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TamaniosMascota`
--

INSERT INTO `TamaniosMascota` (`idTamanioMascota`, `pequenia`, `mediana`, `grande`) VALUES
(2, 1, 0, 1),
(3, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Animales`
--
ALTER TABLE `Animales`
  ADD PRIMARY KEY (`idAnimal`);

--
-- Indexes for table `Direcciones`
--
ALTER TABLE `Direcciones`
  ADD PRIMARY KEY (`idDireccion`);

--
-- Indexes for table `Disponibilidades`
--
ALTER TABLE `Disponibilidades`
  ADD PRIMARY KEY (`idDisponibilidad`);

--
-- Indexes for table `Duenios`
--
ALTER TABLE `Duenios`
  ADD PRIMARY KEY (`idDuenio`);

--
-- Indexes for table `Guardianes`
--
ALTER TABLE `Guardianes`
  ADD PRIMARY KEY (`idGuardian`),
  ADD KEY `fk_id_disponibilidad` (`fk_idDisponibilidad`),
  ADD KEY `fk_id_direccion` (`fk_idDireccion`),
  ADD KEY `fk_id_tamanioMascota` (`fk_idTamanioMascota`);

--
-- Indexes for table `Mascotas`
--
ALTER TABLE `Mascotas`
  ADD PRIMARY KEY (`idMascota`),
  ADD KEY `fk_id_duenio` (`fk_idDuenio`),
  ADD KEY `fk_id_animal` (`fk_idAnimal`);

--
-- Indexes for table `Reservas`
--
ALTER TABLE `Reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `fk_idDuenio` (`fk_idDuenio`),
  ADD KEY `fk_id_mascota` (`fk_idMascota`),
  ADD KEY `fk_idGuardian` (`fk_idGuardian`);

--
-- Indexes for table `TamaniosMascota`
--
ALTER TABLE `TamaniosMascota`
  ADD PRIMARY KEY (`idTamanioMascota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Animales`
--
ALTER TABLE `Animales`
  MODIFY `idAnimal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Direcciones`
--
ALTER TABLE `Direcciones`
  MODIFY `idDireccion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Disponibilidades`
--
ALTER TABLE `Disponibilidades`
  MODIFY `idDisponibilidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Duenios`
--
ALTER TABLE `Duenios`
  MODIFY `idDuenio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Guardianes`
--
ALTER TABLE `Guardianes`
  MODIFY `idGuardian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Mascotas`
--
ALTER TABLE `Mascotas`
  MODIFY `idMascota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Reservas`
--
ALTER TABLE `Reservas`
  MODIFY `idReserva` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TamaniosMascota`
--
ALTER TABLE `TamaniosMascota`
  MODIFY `idTamanioMascota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Guardianes`
--
ALTER TABLE `Guardianes`
  ADD CONSTRAINT `fk_id_direccion` FOREIGN KEY (`fk_idDireccion`) REFERENCES `Direcciones` (`idDireccion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_disponibilidad` FOREIGN KEY (`fk_idDisponibilidad`) REFERENCES `Disponibilidades` (`idDisponibilidad`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_tamanioMascota` FOREIGN KEY (`fk_idTamanioMascota`) REFERENCES `TamaniosMascota` (`idTamanioMascota`) ON UPDATE CASCADE;

--
-- Constraints for table `Mascotas`
--
ALTER TABLE `Mascotas`
  ADD CONSTRAINT `fk_id_animal` FOREIGN KEY (`fk_idAnimal`) REFERENCES `Animales` (`idAnimal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_duenio` FOREIGN KEY (`fk_idDuenio`) REFERENCES `Duenios` (`idDuenio`) ON UPDATE CASCADE;

--
-- Constraints for table `Reservas`
--
ALTER TABLE `Reservas`
  ADD CONSTRAINT `fk_id_mascota` FOREIGN KEY (`fk_idMascota`) REFERENCES `Mascotas` (`idMascota`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`fk_idDuenio`) REFERENCES `Duenios` (`idDuenio`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`fk_idGuardian`) REFERENCES `Guardianes` (`idGuardian`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
