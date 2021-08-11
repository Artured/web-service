-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-08-2021 a las 09:48:32
-- Versión del servidor: 5.7.35-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: ``
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rappi_ordenes`
--

CREATE TABLE `rappi_ordenes` (
  `orden_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `num_cia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL,
  `nombre_cliente` varchar(200) DEFAULT NULL,
  `articulos` varchar(200) DEFAULT NULL,
  `instrucciones_especiales` varchar(200) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rappi_ordenes`
--

INSERT INTO `rappi_ordenes` (`orden_id`, `order_id`, `num_cia`, `fecha`, `hora`, `nombre_cliente`, `articulos`, `instrucciones_especiales`, `total`, `tipo`) VALUES
(1, 0, 1, '2021-08-02', '05:09:17', NULL, NULL, NULL, NULL, NULL),
(5, 1, 2, '1991-09-07', '05:00:00', '\'Arturo\'', '\'fvd\'', '\'sfsfsf\'', '100', '\'sdsfddf\''),
(12, 0, 1, '2021-08-02', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 0, 1, '2021-08-02', NULL, NULL, NULL, NULL, NULL, NULL),
(45, 0, 1, '2021-08-02', NULL, NULL, NULL, NULL, NULL, NULL),
(89, 0, 1, '2021-08-02', NULL, NULL, NULL, NULL, NULL, NULL),
(222, 1, 2, '1991-09-07', '05:00:00', '\'Arturo\'', '\'fvd\'', '\'sfsfsf\'', '100', '\'sdsfddf\''),
(333, 1, 2, '1991-09-07', '05:00:00', '\'Arturo\'', '\'fvd\'', NULL, '100', '\'sdsfddf\''),
(532, 1, 2, '1991-09-07', '05:00:00', '\'Arturo\'', '\'fvd\'', '\'sfsfsf\'', '100', '\'sdsfddf\''),
(755, 1, 2, '1991-09-07', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rappi_ordenes`
--
ALTER TABLE `rappi_ordenes`
  ADD PRIMARY KEY (`orden_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rappi_ordenes`
--
ALTER TABLE `rappi_ordenes`
  MODIFY `orden_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=756;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
