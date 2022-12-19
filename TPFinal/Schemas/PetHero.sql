-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2022 at 10:45 PM
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
-- Table structure for table `Animales`
--

CREATE TABLE `Animales` (
  `idAnimal` int(11) NOT NULL,
  `animal` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `raza` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `idCupon` int(11) NOT NULL,
  `total` float NOT NULL,
  `fk_idReserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Cupones`
--

INSERT INTO `Cupones` (`idCupon`, `total`, `fk_idReserva`) VALUES
(40, 899, 54);

-- --------------------------------------------------------

--
-- Table structure for table `Direcciones`
--

CREATE TABLE `Direcciones` (
  `idDireccion` int(11) NOT NULL,
  `calle` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numero` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `piso` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `departamento` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `codigoPostal` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Direcciones`
--

INSERT INTO `Direcciones` (`idDireccion`, `calle`, `numero`, `piso`, `departamento`, `codigoPostal`) VALUES
(5, 'Luro', '2365', '2', 'C', '7600'),
(7, 'San Martin', '2365', '6', 'C', '7600'),
(8, 'Independencia', '1225', '', '', '7600'),
(10, 'Calle 1', '1759', '', '', '7607');

-- --------------------------------------------------------

--
-- Table structure for table `Disponibilidades`
--

CREATE TABLE `Disponibilidades` (
  `idDisponibilidad` int(11) NOT NULL,
  `lunes` tinyint(1) DEFAULT 0,
  `martes` tinyint(1) DEFAULT 0,
  `miercoles` tinyint(1) DEFAULT 0,
  `jueves` tinyint(1) DEFAULT 0,
  `viernes` tinyint(1) DEFAULT 0,
  `sabado` tinyint(1) DEFAULT 0,
  `domingo` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Disponibilidades`
--

INSERT INTO `Disponibilidades` (`idDisponibilidad`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`) VALUES
(3, 1, 1, 1, 1, 1, 0, 0),
(5, 0, 0, 0, 0, 0, 1, 1),
(6, 1, 1, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Duenios`
--

CREATE TABLE `Duenios` (
  `idDuenio` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varbinary(150) NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 1,
  `rutaFoto` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Duenios`
--

INSERT INTO `Duenios` (`idDuenio`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`) VALUES
(1, 'Bruno', 'Fabrizio', '2236698574', 'brunofabrizio15@gmail.com', 0x18554f9643d38d9945ad7038765c2419, 1, 'bruno@gmail.com.jpg', 1),
(2, 'Clara', 'Videla', '2235874785', 'clara@gmail.com', 0x18554f9643d38d9945ad7038765c2419, 1, 'clara@gmail.com.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Guardianes`
--

CREATE TABLE `Guardianes` (
  `idGuardian` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varbinary(150) NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 2,
  `rutaFoto` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT 1,
  `reputacion` float DEFAULT 2.5,
  `precioXDia` float DEFAULT 0,
  `fk_idDireccion` int(11) DEFAULT NULL,
  `fk_idDisponibilidad` int(11) DEFAULT NULL,
  `fk_idTamanioMascota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Guardianes`
--

INSERT INTO `Guardianes` (`idGuardian`, `nombre`, `apellido`, `telefono`, `email`, `password`, `tipo`, `rutaFoto`, `alta`, `reputacion`, `precioXDia`, `fk_idDireccion`, `fk_idDisponibilidad`, `fk_idTamanioMascota`) VALUES
(5, 'Belen', 'Robledo', '2235986532', 'belen@gmail.com', 0x18554f9643d38d9945ad7038765c2419, 2, 'belen@gmail.com.png', 1, 2.5, 899, 5, 3, 4),
(7, 'Lionel', 'Messi', '2235856985', 'messi@gmail.com', 0x18554f9643d38d9945ad7038765c2419, 2, 'messi@gmail.com.jpeg', 1, 4, 15000, 7, 5, 6),
(8, 'Emma', 'Watson', '2236859632', 'emma@gmail.com', 0x18554f9643d38d9945ad7038765c2419, 2, 'emma@gmail.com.jpeg', 1, 2.5, 899, 8, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `Mascotas`
--

CREATE TABLE `Mascotas` (
  `idMascota` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `tamanio` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `observaciones` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rutaFoto` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rutaPlanVacunas` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rutaVideo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT 'undefinedVideo',
  `fk_idDuenio` int(11) NOT NULL,
  `fk_idAnimal` int(11) NOT NULL,
  `alta` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Mascotas`
--

INSERT INTO `Mascotas` (`idMascota`, `nombre`, `tamanio`, `observaciones`, `rutaFoto`, `rutaPlanVacunas`, `rutaVideo`, `fk_idDuenio`, `fk_idAnimal`, `alta`) VALUES
(3, 'Sasha', 'M', 'Dormilona', '1-Sasha.jpeg', '1-Sasha-Vacunas.png', 'undefinedVideo', 1, 5, 1),
(8, 'Pepa', 'M', 'Muy enojona', '2-Pepa.jpeg', '2-Pepa-Vacunas.png', '2-Pepa-Video.mp4', 2, 30, 1),
(10, 'Pompon', 'M', 'Le gusta el pollito', '2-Pompon.jpeg', '2-Pompon-Vacunas.jpeg', 'undefinedVideo', 2, 30, 1),
(11, 'Yuumi', 'S', 'Muy bonita', '1-Yuumi.jpeg', '1-Yuumi-Vacunas.jpeg', 'undefinedVideo', 1, 30, 1),
(12, 'Kiba', 'L', 'Muy valiente', '1-Kiba.jpeg', '1-Kiba-Vacunas.png', '1-Kiba-Video.mp4', 1, 18, 1),
(13, 'Lisa', 'M', 'Juguetona', '1-Lisa.png', '1-Lisa-Vacunas.png', 'undefinedVideo', 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Reservas`
--

CREATE TABLE `Reservas` (
  `idReserva` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `precioTotal` float NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'Solicitada',
  `fk_idMascota` int(11) NOT NULL,
  `fk_idDuenio` int(11) NOT NULL,
  `fk_idGuardian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Reservas`
--

INSERT INTO `Reservas` (`idReserva`, `fechaInicio`, `fechaFin`, `precioTotal`, `estado`, `fk_idMascota`, `fk_idDuenio`, `fk_idGuardian`) VALUES
(47, '2022-11-17', '2022-11-18', 1798, 'Finalizada', 3, 1, 5),
(48, '2022-11-21', '2022-11-23', 2697, 'Cancelada', 11, 1, 5),
(51, '2022-11-12', '2022-11-13', 30000, 'Finalizada', 12, 1, 7),
(54, '2022-12-20', '2022-12-21', 1798, 'Confirmada', 11, 1, 5),
(55, '2022-12-22', '2022-12-23', 1798, 'Solicitada', 3, 1, 5),
(56, '2022-12-22', '2022-12-23', 1798, 'Solicitada', 13, 1, 5),
(57, '2022-12-22', '2022-12-23', 1798, 'Solicitada', 11, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `idReview` int(11) NOT NULL,
  `comentario` varchar(144) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `puntaje` int(11) NOT NULL,
  `fk_idReserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`idReview`, `comentario`, `puntaje`, `fk_idReserva`) VALUES
(31, 'Muy buena atencion', 4, 51);

-- --------------------------------------------------------

--
-- Table structure for table `TamaniosMascota`
--

CREATE TABLE `TamaniosMascota` (
  `idTamanioMascota` int(11) NOT NULL,
  `pequenia` tinyint(1) DEFAULT 0,
  `mediana` tinyint(1) DEFAULT 0,
  `grande` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `TamaniosMascota`
--

INSERT INTO `TamaniosMascota` (`idTamanioMascota`, `pequenia`, `mediana`, `grande`) VALUES
(4, 1, 1, 0),
(6, 0, 0, 1),
(7, 1, 1, 1),
(9, 0, 1, 1);

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
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Cupones`
--
ALTER TABLE `Cupones`
  MODIFY `idCupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `Direcciones`
--
ALTER TABLE `Direcciones`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Disponibilidades`
--
ALTER TABLE `Disponibilidades`
  MODIFY `idDisponibilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Duenios`
--
ALTER TABLE `Duenios`
  MODIFY `idDuenio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Guardianes`
--
ALTER TABLE `Guardianes`
  MODIFY `idGuardian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Mascotas`
--
ALTER TABLE `Mascotas`
  MODIFY `idMascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Reservas`
--
ALTER TABLE `Reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `idReview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `TamaniosMascota`
--
ALTER TABLE `TamaniosMascota`
  MODIFY `idTamanioMascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `fk_id_direccion` FOREIGN KEY (`fk_idDireccion`) REFERENCES `Direcciones` (`idDireccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_disponibilidad` FOREIGN KEY (`fk_idDisponibilidad`) REFERENCES `Disponibilidades` (`idDisponibilidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_tamanioMascota` FOREIGN KEY (`fk_idTamanioMascota`) REFERENCES `TamaniosMascota` (`idTamanioMascota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Mascotas`
--
ALTER TABLE `Mascotas`
  ADD CONSTRAINT `fk_id_animal` FOREIGN KEY (`fk_idAnimal`) REFERENCES `Animales` (`idAnimal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_duenio` FOREIGN KEY (`fk_idDuenio`) REFERENCES `Duenios` (`idDuenio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reservas`
--
ALTER TABLE `Reservas`
  ADD CONSTRAINT `fk_id_mascota` FOREIGN KEY (`fk_idMascota`) REFERENCES `Mascotas` (`idMascota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`fk_idDuenio`) REFERENCES `Duenios` (`idDuenio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`fk_idGuardian`) REFERENCES `Guardianes` (`idGuardian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `fk_id_reserv` FOREIGN KEY (`fk_idReserva`) REFERENCES `Reservas` (`idReserva`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
