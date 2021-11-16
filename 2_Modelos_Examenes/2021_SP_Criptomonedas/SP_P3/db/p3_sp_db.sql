-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2021 a las 00:41:04
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
-- Base de datos: `p3_sp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `image` text COLLATE utf8_spanish2_ci NOT NULL,
  `origin` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `image`, `origin`, `price`) VALUES
(6, 'Patacoin', './Currency_image/Patacoin.png', 'Argentina', 2),
(7, 'LecopCoin', './Currency_image/LecopCoin.png', 'Argentina', 1),
(8, 'FuhrerCoin', './Currency_image/FuhrerCoin.png', 'Alemania', 1),
(9, 'ReichCoin', './Currency_image/ReichCoin.png', 'Alemania', 1),
(10, 'EtherNauta', 'Image.png', 'LaSalada', 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `crypto_name` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `customer` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `date`, `crypto_name`, `amount`, `customer`, `user`, `image`) VALUES
(6, '2021-11-15 19:07:16', 'Patacoin', 100, 'AFF', 'Facundo', 'Patacoin_AFF_2021-11-15__19_07_16.png'),
(7, '2021-06-13 19:26:02', 'FuhrerCoin', 100, 'AFF', 'Facundo', 'FuhrerCoin_AFF_2021-11-15__19_26_02.png'),
(8, '2021-06-12 19:27:46', 'FuhrerCoin', 50, 'Cosme', 'Fulano', 'FuhrerCoin_Cosme_2021-11-15__19_27_46.png'),
(9, '2021-06-11 19:28:13', 'ReichCoin', 50, 'Cosme', 'Fulano', 'ReichCoin_Cosme_2021-11-15__19_28_13.png'),
(10, '2021-11-15 19:28:19', 'ReichCoin', 150, 'Cosme', 'Fulano', 'ReichCoin_Cosme_2021-11-15__19_28_19.png'),
(11, '2021-11-15 19:34:47', 'ReichCoin', 150, 'AFF', 'Facundo', 'ReichCoin_AFF_2021-11-15__19_34_47.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `type` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `password` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `type`, `password`) VALUES
(8, 'Facundo', 'Admin', '$2y$10$Vbfp3uFrHfWqPgEQfX1aku68B/6SEGsTAhcPnAjS/GEZzB.SZeeaK'),
(9, 'Fulano', 'Customer', '$2y$10$W3fFl7/6n2jiuHP0UbZh7uUHL27jopW77wp4.9i8zXSn4pAADXzUG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_sale` (`user`),
  ADD KEY `FK_crypto_sale` (`crypto_name`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `FK_crypto_sale` FOREIGN KEY (`crypto_name`) REFERENCES `currencies` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_sale` FOREIGN KEY (`user`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
