-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2021 a las 02:34:45
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pp_progra3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `sabor` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `fecha`, `usuario`, `sabor`, `tipo`, `cantidad`) VALUES
(13, '2021-10-18 19:05:08', 'GokuSSJG@DBS.com', 'Napolitana', 'Piedra', 2),
(15, '2021-10-18 19:19:48', 'GokuSSJG@DBS.com', 'Napolitana', 'Piedra', 4),
(16, '2021-10-18 19:19:55', 'GokuSSJG@DBS.com', 'Napolitana', 'Piedra', 7),
(17, '2021-10-18 21:32:43', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 4),
(18, '2021-10-18 21:36:34', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 4),
(19, '2021-10-18 21:38:05', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 4),
(20, '2021-10-18 21:39:17', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 4),
(21, '2021-10-18 21:40:58', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 4),
(22, '2021-10-20 19:45:10', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 4),
(23, '2021-10-20 19:45:40', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 4),
(24, '2021-10-20 19:46:45', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 6),
(25, '2021-10-20 19:46:50', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 6),
(26, '2021-10-20 20:56:17', 'Rafiki@mail.com', 'Napolitana', 'Piedra', 6),
(28, '2021-10-20 21:04:22', 'GogetaSSJ4@DragonBallHeroes.com', 'Champignon', 'Piedra', 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
