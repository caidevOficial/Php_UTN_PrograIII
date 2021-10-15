-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2021 a las 06:00:44
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `numero_pedido` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `correo_usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `sabor_pizza` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_pizza` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad_pizza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`numero_pedido`, `fecha`, `correo_usuario`, `sabor_pizza`, `tipo_pizza`, `cantidad_pizza`) VALUES
(50, '2021-10-15 03:20:14', 'GohanSSJ2@mail.com', 'Champignon', 'Piedra', 3),
(51, '2021-10-15 03:21:16', 'VegetaSSJBlue@dragonBallSuper.com', 'Champignon', 'Piedra', 5),
(52, '2021-10-15 03:51:40', 'GogetaSSJ4@DragonBallHeroes.com', 'Calabresa', 'Piedra', 6),
(53, '2021-10-15 03:23:36', 'GogetaSSJBlue@dragonBallSuper.com', 'Albahaca', 'Piedra', 4),
(54, '2021-10-15 03:23:52', 'VegitoSSJBlue@dragonBallSuper.com', 'Albahaca', 'Piedra', 8),
(55, '2021-10-15 03:24:37', 'GokuSSJG@dragonBallSuper.com', 'Muzzarella', 'Piedra', 8),
(56, '2021-10-15 03:24:44', 'GokuSSJG@dragonBallSuper.com', 'Muzzarella', 'Piedra', 2),
(57, '2021-10-15 03:25:10', 'Broly@dragonBallSuper.com', 'Morron', 'Piedra', 2),
(58, '2021-10-15 03:25:22', 'Broly@dragonBallSuper.com', 'Morron', 'Piedra', 10),
(59, '2021-10-15 03:26:07', 'Asta@BlackClover.com', 'Champignon', 'Piedra', 10),
(60, '2021-10-15 03:26:34', 'Asta@BlackClover.com', 'Calabresa', 'Piedra', 10),
(61, '2021-10-15 03:27:10', 'Kirito@SwordArtOnline.com', 'Albahaca', 'Piedra', 12),
(62, '2021-10-15 03:27:18', 'Kirito@SwordArtOnline.com', 'Albahaca', 'Piedra', 1),
(63, '2021-10-15 03:29:30', 'Kirito@SwordArtOnline.com', 'Albahaca', 'Piedra', 1),
(64, '2021-10-15 03:30:44', 'Kirito@SwordArtOnline.com', 'Albahaca', 'Piedra', 1),
(65, '2021-10-15 03:31:33', 'Naruto@Konoha.com', 'Champignon', 'Piedra', 2),
(66, '2021-10-15 03:31:43', 'Naruto@Konoha.com', 'Morron', 'Piedra', 2),
(67, '2021-10-15 03:32:01', 'Naruto@Konoha.com', 'Muzzarella', 'Piedra', 6),
(68, '2021-10-15 03:39:35', 'Rafiki@TheLionKing.com', 'Muzzarella', 'Piedra', 6),
(71, '2021-10-15 03:34:28', 'GogetaSSJ4@DragonBallHeroes.com', 'Morron', 'Piedra', 5),
(72, '2021-10-15 03:34:40', 'GogetaSSJ4@DragonBallHeroes.com', 'Champignon', 'Piedra', 3),
(73, '2021-10-15 03:34:57', 'GogetaSSJ4@DragonBallHeroes.com', 'Muzzarella', 'Piedra', 1),
(74, '2021-10-15 03:35:09', 'GogetaSSJ4@DragonBallHeroes.com', 'Calabresa', 'Piedra', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`numero_pedido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `numero_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
