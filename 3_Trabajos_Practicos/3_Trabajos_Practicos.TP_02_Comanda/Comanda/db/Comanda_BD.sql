-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2021 a las 04:26:42
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
-- Base de datos: `comanda`
--
CREATE DATABASE IF NOT EXISTS `comanda` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `comanda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `area_description` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`area_id`, `area_description`) VALUES
(1, 'Salon'),
(2, 'Cocina'),
(3, 'Barra'),
(4, 'Administracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dish`
--

DROP TABLE IF EXISTS `dish`;
CREATE TABLE IF NOT EXISTS `dish` (
  `dish_id` int(11) NOT NULL AUTO_INCREMENT,
  `dish_area` int(11) NOT NULL,
  `dish_order_associated` int(11) DEFAULT NULL,
  `dish_status` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `dish_description` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `dish_cost` float NOT NULL,
  `time_init` datetime NOT NULL,
  `time_finish` datetime DEFAULT NULL,
  `time_to_finish` int(11) DEFAULT NULL,
  PRIMARY KEY (`dish_id`),
  KEY `FK_dish_order_assoc` (`dish_order_associated`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dish`
--

INSERT INTO `dish` (`dish_id`, `dish_area`, `dish_order_associated`, `dish_status`, `dish_description`, `dish_cost`, `time_init`, `time_finish`, `time_to_finish`) VALUES
(9, 2, 8, 'Listo Para Servir', 'Pollo Al Champignon', 550, '2021-11-27 02:50:33', '2021-11-27 03:20:33', 30),
(10, 3, 8, 'Listo Para Servir', 'Gaseosa Linea Pepsi 2lt.', 300, '2021-11-27 02:51:24', '2021-11-27 02:56:24', 35),
(11, 3, 8, 'Listo Para Servir', 'Gaseosa Linea Pepsi 2lt.', 300, '2021-11-27 03:05:14', '2021-11-27 03:10:14', 5),
(12, 3, 8, 'Listo Para Servir', 'Gaseosa Linea Pepsi 2lt.', 300, '2021-11-27 03:05:51', '2021-11-27 03:10:51', 5),
(13, 2, 8, 'Listo Para Servir', 'Hamburguesa con Bacon', 550, '2021-11-27 03:06:59', '2021-11-27 03:26:59', 20),
(14, 2, 8, 'Listo Para Servir', 'Hamburguesa con Cheddar y Guarnicion', 550, '2021-11-27 03:09:14', '2021-11-27 03:27:14', 18),
(15, 2, 8, 'Listo Para Servir', 'Ensalada Waldorf', 550, '2021-11-27 03:10:27', '2021-11-27 03:17:27', 7),
(16, 2, 9, 'Listo Para Servir', 'Ensalada Waldorf', 350, '2021-11-27 11:54:41', '2021-11-27 12:01:41', 7),
(17, 2, 9, 'Listo Para Servir', 'Ensalada Rusa', 250, '2021-11-27 11:55:24', '2021-11-27 12:03:24', 8),
(18, 2, 10, 'Listo Para Servir', 'Pollo al Champignon', 450, '2021-11-28 00:16:04', '2021-11-28 00:36:04', 0),
(19, 2, 10, 'Listo Para Servir', 'Pollo al Verdeo', 400, '2021-11-28 00:16:29', '2021-11-28 00:38:29', 0),
(20, 3, 10, 'Listo Para Servir', 'Cerveza Stella Artois 1lt.', 300, '2021-11-28 00:17:06', '2021-11-28 00:22:06', 0),
(21, 3, 11, 'Listo Para Servir', 'Cerveza Stella Artois 1lt.', 300, '2021-11-28 20:01:14', '2021-11-28 20:06:14', 0),
(22, 3, 11, 'Listo Para Servir', 'Cerveza Rabieta Irish Ale 750ml.', 300, '2021-11-28 20:01:46', '2021-11-28 20:08:46', 0),
(23, 2, 11, 'Listo Para Servir', 'Papas bravas', 450, '2021-11-28 20:02:07', '2021-11-28 20:27:07', 0),
(24, 2, 11, 'Listo Para Servir', 'Papas con Cheddar & Bacon', 500, '2021-11-28 20:02:29', '2021-11-28 20:32:29', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `employee_area_id` int(11) DEFAULT NULL,
  `name` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `date_init` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employee_area` (`employee_area_id`),
  KEY `FK_employee_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Employees table';

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `employee_area_id`, `name`, `date_init`, `date_end`) VALUES
(11, 15, 1, 'Athena', '2021-11-27 01:54:58', NULL),
(12, 16, 1, 'Persefone', '2021-11-27 01:55:33', NULL),
(13, 17, 1, 'Hera', '2021-11-27 01:55:44', NULL),
(14, 18, 2, 'Hades', '2021-11-27 01:56:01', NULL),
(15, 19, 2, 'Zeus', '2021-11-27 01:56:28', NULL),
(16, 20, 2, 'Odin', '2021-11-27 01:56:36', NULL),
(17, 21, 3, 'Poseidon', '2021-11-27 01:58:02', NULL),
(18, 22, 3, 'Wukong', '2021-11-27 01:58:24', NULL),
(19, 10, 4, 'Facu Falcone', '2021-11-27 01:59:42', NULL),
(20, 30, 3, 'Lilith', '2021-11-28 19:38:09', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historical_logins`
--

DROP TABLE IF EXISTS `historical_logins`;
CREATE TABLE IF NOT EXISTS `historical_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `date_login` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_login_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `historical_logins`
--

INSERT INTO `historical_logins` (`id`, `user_id`, `username`, `date_login`) VALUES
(119, 10, 'Facu', '2021-11-27 00:54:03'),
(120, 10, 'Facu', '2021-11-27 00:58:51'),
(121, 10, 'Facu', '2021-11-27 01:00:10'),
(122, 10, 'Facu', '2021-11-27 01:11:00'),
(123, 10, 'Facu', '2021-11-27 01:16:53'),
(124, 10, 'Facu', '2021-11-27 01:18:08'),
(125, 10, 'Facu', '2021-11-27 01:49:22'),
(126, 15, 'C1', '2021-11-27 02:25:33'),
(127, 15, 'C1', '2021-11-27 02:26:44'),
(128, 16, 'C2', '2021-11-27 03:12:04'),
(129, 17, 'C3', '2021-11-27 03:12:33'),
(130, 21, 'Bar1', '2021-11-27 03:12:56'),
(131, 22, 'Bar2', '2021-11-27 03:13:16'),
(132, 18, 'Co1', '2021-11-27 03:13:35'),
(133, 19, 'Co2', '2021-11-27 03:13:49'),
(134, 20, 'Co3', '2021-11-27 03:14:07'),
(135, 20, 'Co3', '2021-11-28 19:33:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) DEFAULT NULL,
  `order_status` varchar(30) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Pendiente',
  `customer_name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `order_picture` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `order_cost` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_Table_Orders` (`table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `table_id`, `order_status`, `customer_name`, `order_picture`, `order_cost`) VALUES
(8, 2, 'En Preparacion', 'Fulano_01', './OrderImages/8.png', 3100),
(9, 3, 'En Preparacion', 'Fulano_02', './OrderImages/9.png', 600),
(10, 3, 'Listo Para Servir', 'Fulano_03', './OrderImages/10.png', 1150),
(11, 3, 'Listo Para Servir', 'Fulano_04', './OrderImages/11.png', 1550),
(12, 2, 'Pendiente', 'Fulano_05', './OrderImages/Order_12.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poll`
--

DROP TABLE IF EXISTS `poll`;
CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `table_score` int(11) NOT NULL,
  `resto_score` int(11) NOT NULL,
  `waitress_score` int(11) NOT NULL,
  `cheff_score` int(11) NOT NULL,
  `average_score` float NOT NULL,
  `comment` varchar(66) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fo_poll_order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `poll`
--

INSERT INTO `poll` (`id`, `order_id`, `table_score`, `resto_score`, `waitress_score`, `cheff_score`, `average_score`, `comment`) VALUES
(1, 10, 8, 8, 10, 9, 8.75, 'La mesa parecia la de pepe argento, pero muy rico todo'),
(2, 11, 7, 8, 8, 4, 6.75, 'Perder mi perro fue muy duro pero no tanto como la milanesa de aca'),
(3, 9, 7, 8, 8, 10, 8.25, 'Tardo un poquito pero la comida de 10!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_code` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_code` (`table_code`),
  KEY `FK_table_employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`id`, `table_code`, `employee_id`, `state`) VALUES
(2, 'ME002', 20, 'Con Cliente Esperando Pedido'),
(3, 'ME003', 12, 'Con Cliente Pagando'),
(4, 'ME004', 20, 'Cerrada'),
(5, 'ME005', NULL, 'Cerrada'),
(6, 'ME006', NULL, 'Cerrada'),
(8, 'ME008', NULL, 'Cerrada'),
(9, 'ME009', NULL, 'Cerrada'),
(10, 'ME010', NULL, 'Cerrada'),
(11, 'ME011', NULL, 'Cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `password` text COLLATE utf8_spanish2_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `user_type` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `date_init` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isAdmin`, `user_type`, `status`, `date_init`, `date_end`) VALUES
(10, 'Facu', '$2y$10$YC33xVvmADBUIczUmSShY.hkCB7pLh5ksH.COU7loi2Zd4V8h.0cy', 1, 'Admin', 'Active', '2021-11-27 00:32:31', NULL),
(15, 'C1', '$2y$10$3bG3uAu2AJ7VnMcM08IBcu3kLehg9t6YjWBAQ/j6FeLR7VgMzOWN2', 0, 'Camarera', 'Active', '2021-11-27 01:31:07', NULL),
(16, 'C2', '$2y$10$yT74CCOm7isBvu19UvpP.uXCyy3rTYqLw5mNH4AYb.uIzozX6hY3.', 0, 'Camarera', 'Active', '2021-11-27 01:31:15', NULL),
(17, 'C3', '$2y$10$izib3ooG60BV9VhfVWEpnuk67M3EzAz/yboSaGlq4tvFrjIKTFAl2', 0, 'Camarera', 'Active', '2021-11-27 01:31:19', NULL),
(18, 'Co1', '$2y$10$CnSjF.0SF2FHYhxXKzjrsuZbWZzS4CrQ.kin1GhgDpHmiDXv.kZQO', 0, 'Cocinero', 'Active', '2021-11-27 01:31:32', NULL),
(19, 'Co2', '$2y$10$QLr2gkRy4rB6rYkRT/lUye4WUv.iCkSr2Bm4gcDFrYF09R1MclHl.', 0, 'Cocinero', 'Active', '2021-11-27 01:31:41', NULL),
(20, 'Co3', '$2y$10$JxpnNeff2MzRNzrX/LfoRu7U/A8GzU7CEdrF3E8KCFyXHNccnLDo2', 0, 'Cocinero', 'Active', '2021-11-27 01:31:47', NULL),
(21, 'Bar1', '$2y$10$/jvBeHcBsJXiVqno25eAx.kePekvRQrqDjTOmY8Yd3w8rw3MCcXsq', 0, 'Barman', 'Active', '2021-11-27 01:32:01', NULL),
(22, 'Bar2', '$2y$10$M9DS08Vxs0MR2OdjL1OIxuYcDCOIOffGzdDk3AHS3cms6tGCGS9eO', 0, 'Barman', 'Active', '2021-11-27 01:32:05', NULL),
(30, 'Bar3', '$2y$10$6CYGTBDQ6a3migWWTYHqtuMWIIF7P4NHfOAddeaPvAliFHQUsWg2a', 0, 'Barman', 'Active', '2021-11-28 19:36:36', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `FK_dish_order_assoc` FOREIGN KEY (`dish_order_associated`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Filtros para la tabla `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_employee_area` FOREIGN KEY (`employee_area_id`) REFERENCES `area` (`area_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_employee_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historical_logins`
--
ALTER TABLE `historical_logins`
  ADD CONSTRAINT `FK_login_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Table_Orders` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Filtros para la tabla `poll`
--
ALTER TABLE `poll`
  ADD CONSTRAINT `fo_poll_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `FK_table_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
