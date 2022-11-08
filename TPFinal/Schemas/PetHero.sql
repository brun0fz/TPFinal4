-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bumivsrscryp1fqpzsmn-mysql.services.clever-cloud.com:3306
-- Generation Time: Nov 08, 2022 at 03:52 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `Animales`
--

CREATE TABLE `Animales` (
  `idAnimal` int NOT NULL,
  `animal` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `raza` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Animales`
--

INSERT INTO `Animales` (`idAnimal`, `animal`, `raza`) VALUES
(5, 'Perro', 'Breton'),
(6, 'Perro', 'Caniche'),
(7, 'Gato', 'Siames'),
(9, 'Gato', 'Persa'),
(10, 'Gato', 'Angora'),
(11, 'Perro', 'Dalmata'),
(12, 'Perro', 'Golden Retriever'),
(13, 'Perro', 'Labrador Retriever'),
(14, 'Perro', 'Beagle'),
(15, 'Perro', 'Bulldog'),
(16, 'Perro', 'Boxer'),
(17, 'Perro', 'Pastor Aleman'),
(18, 'Perro', 'Akita Inu'),
(19, 'Perro', 'Shiba Inu'),
(20, 'Gato', 'Sphynx'),
(21, 'Gato', 'Ruso Azul'),
(22, 'Gato', 'Bobtail Americano'),
(23, 'Gato', 'Somali'),
(24, 'Gato', 'Siberiano'),
(25, 'Gato', 'Ragdoll'),
(26, 'Gato', 'Maine Coon'),
(27, 'Gato', 'Manes'),
(28, 'Gato', 'Birmano'),
(29, 'Perro', 'Mestizo'),
(30, 'Gato', 'Mestizo');

-- --------------------------------------------------------

--
-- Table structure for table `Cupones`
--

CREATE TABLE `Cupones` (
  `idCupon` int NOT NULL,
  `total` float NOT NULL,
  `fk_idReserva` int NOT NULL,
  `aliasGuardian` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Cupones`
--

INSERT INTO `Cupones` (`idCupon`, `total`, `fk_idReserva`, `aliasGuardian`) VALUES
(8, 7500, 32, 'messi.rve'),
(9, 15000, 33, 'messi.rve'),
(10, 449.5, 34, ''),
(11, 449.5, 34, ''),
(12, 7500, 32, 'messi.rve'),
(13, 7500, 36, 'messi.rve'),
(14, 7500, 32, 'messi.rve'),
(15, 7500, 32, 'messi.rve'),
(16, 7500, 36, ''),
(18, 449.5, 34, ''),
(20, 299.5, 37, ''),
(21, 299.5, 38, ''),
(22, 299.5, 38, '');

-- --------------------------------------------------------

--
-- Table structure for table `Direcciones`
--

CREATE TABLE `Direcciones` (
  `idDireccion` int NOT NULL,
  `calle` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `piso` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `departamento` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigoPostal` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Direcciones`
--

INSERT INTO `Direcciones` (`idDireccion`, `calle`, `numero`, `piso`, `departamento`, `codigoPostal`) VALUES
(5, 'Luro', '2365', '2', 'C', '7600'),
(7, 'San Martin', '2365', '6', 'C', '7600');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Disponibilidades`
--

INSERT INTO `Disponibilidades` (`idDisponibilidad`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`) VALUES
(3, 1, 1, 1, 1, 1, 0, 0),
(5, 1, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Duenios`
--

CREATE TABLE `Duenios` (
  `idDuenio` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` tinyint NOT NULL DEFAULT '1',
  `rutaFoto` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Duenios`
--

INSERT INTO `Duenios` (`idDuenio`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`) VALUES
(1, 'Bruno', 'Fabrizio', '2236698574', 'brunofabrizio15@gmail.com', '123', 1, 'bruno@gmail.com.jpg', 1),
(2, 'Clara', 'Videla', '2235874785', 'clara@gmail.com', '123', 1, 'clara@gmail.com.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Guardianes`
--

CREATE TABLE `Guardianes` (
  `idGuardian` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `aliasCBU` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` tinyint NOT NULL DEFAULT '2',
  `rutaFoto` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1',
  `reputacion` float DEFAULT '2.5',
  `precioXDia` float DEFAULT '0',
  `fk_idDireccion` int DEFAULT NULL,
  `fk_idDisponibilidad` int DEFAULT NULL,
  `fk_idTamanioMascota` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Guardianes`
--

INSERT INTO `Guardianes` (`idGuardian`, `nombre`, `apellido`, `telefono`, `email`, `password`, `aliasCBU`, `tipo`, `rutaFoto`, `alta`, `reputacion`, `precioXDia`, `fk_idDireccion`, `fk_idDisponibilidad`, `fk_idTamanioMascota`) VALUES
(5, 'Belen', 'Robledo', '2235986532', 'belen@gmail.com', '123', '', 2, 'belen@gmail.com.png', 1, 2.5, 599, 5, 3, 4),
(7, 'Lionel', 'Messi', '2235856985', 'messi@gmail.com', '123', '', 2, 'messi@gmail.com.jpeg', 1, 4, 15000, 7, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Mascotas`
--

CREATE TABLE `Mascotas` (
  `idMascota` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tamanio` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rutaFoto` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rutaPlanVacunas` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rutaVideo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT 'undefinedVideo',
  `fk_idDuenio` int NOT NULL,
  `fk_idAnimal` int NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Mascotas`
--

INSERT INTO `Mascotas` (`idMascota`, `nombre`, `tamanio`, `observaciones`, `rutaFoto`, `rutaPlanVacunas`, `rutaVideo`, `fk_idDuenio`, `fk_idAnimal`, `alta`) VALUES
(3, 'Sasha', 'M', 'Dormilona', '1-Sasha.jpeg', '1-Sasha-Vacunas.png', 'undefinedVideo', 1, 5, 1),
(8, 'Pepa', 'M', 'Muy enojona', '2-Pepa.jpeg', '2-Pepa-Vacunas.png', '2-Pepa-Video.mp4', 2, 30, 1),
(10, 'Pompon', 'M', 'Le gusta el pollito', '2-Pompon.jpeg', '2-Pompon-Vacunas.jpeg', 'undefinedVideo', 2, 30, 1),
(11, 'Yuumi', 'S', 'Muy bonita', '1-Yuumi.jpeg', '1-Yuumi-Vacunas.jpeg', 'undefinedVideo', 1, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Mensajes`
--

CREATE TABLE `Mensajes` (
  `idMensaje` int NOT NULL,
  `idEmisor` int NOT NULL,
  `idReceptor` int NOT NULL,
  `mensaje` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Reservas`
--

CREATE TABLE `Reservas` (
  `idReserva` int NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `precioTotal` float NOT NULL,
  `estado` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Solicitada',
  `fk_idMascota` int NOT NULL,
  `fk_idDuenio` int NOT NULL,
  `fk_idGuardian` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Reservas`
--

INSERT INTO `Reservas` (`idReserva`, `fechaInicio`, `fechaFin`, `precioTotal`, `estado`, `fk_idMascota`, `fk_idDuenio`, `fk_idGuardian`) VALUES
(31, '2022-11-07', '2022-11-09', 2697, 'Cancelada', 11, 1, 5),
(32, '2022-11-15', '2022-11-17', 15000, 'En espera de pago', 3, 1, 7),
(33, '2022-10-20', '2022-10-21', 30000, 'Finalizada', 11, 1, 7),
(34, '2022-11-10', '2022-11-10', 899, 'En espera de pago', 3, 1, 5),
(35, '2022-11-14', '2022-11-18', 75000, 'Cancelada', 11, 1, 7),
(36, '2022-12-05', '2022-12-05', 15000, 'En espera de pago', 11, 1, 7),
(37, '2022-11-28', '2022-11-28', 599, 'En espera de pago', 11, 1, 5),
(38, '2022-12-26', '2022-12-26', 599, 'En espera de pago', 3, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `idReview` int NOT NULL,
  `comentario` varchar(144) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `puntaje` int NOT NULL,
  `fk_idReserva` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`idReview`, `comentario`, `puntaje`, `fk_idReserva`) VALUES
(15, 'Muy buena atencion', 4, 33);

-- --------------------------------------------------------

--
-- Table structure for table `TamaniosMascota`
--

CREATE TABLE `TamaniosMascota` (
  `idTamanioMascota` int NOT NULL,
  `pequenia` tinyint(1) DEFAULT '0',
  `mediana` tinyint(1) DEFAULT '0',
  `grande` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `TamaniosMascota`
--

INSERT INTO `TamaniosMascota` (`idTamanioMascota`, `pequenia`, `mediana`, `grande`) VALUES
(4, 1, 1, 1),
(6, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Animales`
--
ALTER TABLE `Animales`
  ADD PRIMARY KEY (`idAnimal`);

--
-- Indexes for table `Cupones`
--
ALTER TABLE `Cupones`
  ADD PRIMARY KEY (`idCupon`),
  ADD KEY `fk_id_reserva` (`fk_idReserva`);

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
-- Indexes for table `Mensajes`
--
ALTER TABLE `Mensajes`
  ADD PRIMARY KEY (`idMensaje`);

--
-- Indexes for table `Reservas`
--
ALTER TABLE `Reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `fk_idDuenio` (`fk_idDuenio`),
  ADD KEY `fk_id_mascota` (`fk_idMascota`),
  ADD KEY `fk_idGuardian` (`fk_idGuardian`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`idReview`),
  ADD KEY `fk_id_reserv` (`fk_idReserva`);

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
  MODIFY `idAnimal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Cupones`
--
ALTER TABLE `Cupones`
  MODIFY `idCupon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Direcciones`
--
ALTER TABLE `Direcciones`
  MODIFY `idDireccion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Disponibilidades`
--
ALTER TABLE `Disponibilidades`
  MODIFY `idDisponibilidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Duenios`
--
ALTER TABLE `Duenios`
  MODIFY `idDuenio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Guardianes`
--
ALTER TABLE `Guardianes`
  MODIFY `idGuardian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Mascotas`
--
ALTER TABLE `Mascotas`
  MODIFY `idMascota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Mensajes`
--
ALTER TABLE `Mensajes`
  MODIFY `idMensaje` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Reservas`
--
ALTER TABLE `Reservas`
  MODIFY `idReserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `idReview` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `TamaniosMascota`
--
ALTER TABLE `TamaniosMascota`
  MODIFY `idTamanioMascota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cupones`
--
ALTER TABLE `Cupones`
  ADD CONSTRAINT `fk_id_reserva` FOREIGN KEY (`fk_idReserva`) REFERENCES `Reservas` (`idReserva`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `fk_id_reserv` FOREIGN KEY (`fk_idReserva`) REFERENCES `Reservas` (`idReserva`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
