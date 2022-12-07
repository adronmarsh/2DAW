-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2022 a las 12:35:53
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `manganime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manganime`
--
DROP DATABASE IF EXISTS manganime;
CREATE DATABASE manganime;
USE manganime;


DROP TABLE IF EXISTS `manganime`;
CREATE TABLE `manganime` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `creador` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `demografia` enum('Kodomo','Shōnen','Shōjo','Seinien','Josei') NOT NULL,
  `estreno` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `tomos` int(11) DEFAULT NULL,
  `capitulos` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `manganime`
--

INSERT INTO `manganime` (`id`, `nombre`, `creador`, `genero`, `demografia`, `estreno`, `fin`, `tomos`, `capitulos`, `imagen`) VALUES
(1, 'Dragon Ball', 'Akira Toriyama', 'Acción, aventuras, fantasía', 'Shōnen', '1984-11-20', '1995-06-05', 42, 153, 'dragonball.jpg'),
(4, 'Naruto', 'Masashi Kishimoto', 'Acción, aventura, comedia, fantasía, Artes marciales', 'Shōnen', '1999-09-21', '2014-11-10', 72, 220, 'naruto.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `manganime`
--
ALTER TABLE `manganime`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `manganime`
--
ALTER TABLE `manganime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- Credenciales:
-- user: Goku
-- pass: Gohan
GRANT USAGE ON *.* TO `Goku`@`%` IDENTIFIED BY PASSWORD '*4EE94DE7B299DBC485D7DE7252C8D380CAFF8974';
GRANT ALL PRIVILEGES ON `manganime`.* TO `Goku`@`%` WITH GRANT OPTION;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
