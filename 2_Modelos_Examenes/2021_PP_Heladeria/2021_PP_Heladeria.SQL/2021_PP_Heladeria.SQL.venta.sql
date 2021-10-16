-- MIT License
--
-- Copyright (C) 2021 <FacuFalcone - CaidevOficial>
--
-- Permission is hereby granted, free of charge, to any person obtaining a copy
-- of this software and associated documentation files (the "Software"), to deal
-- in the Software without restriction, including without limitation the rights
-- to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
-- copies of the Software, and to permit persons to whom the Software is
-- furnished to do so, subject to the following conditions:
-- 
-- The above copyright notice and this permission notice shall be included in all
-- copies or substantial portions of the Software.
-- 
-- THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
-- IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
-- FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
-- AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
-- LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
-- OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
-- SOFTWARE.
--
-- You should have received a copy of the MIT license
-- along with this program.  If not, see <https://opensource.org/licenses/MIT>.
--
-- @author Facundo Falcone <CaidevOficial> 
--
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2021 a las 05:09:24
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
-- Base de datos: `heladeria`
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

INSERT INTO 
`venta` (`id`, `fecha`, `usuario`, `sabor`, `tipo`, `cantidad`) 
VALUES
(2, '2021-10-15 19:27:34', 'GohanSSJ2@DragonBallZ.com', 'Chocolate', 'Crema', 4),
(3, '2021-10-15 21:14:46', 'GogetaSSJ4@DragonBallHeroes.com', 'Nutella', 'Crema', 10),
(4, '2021-10-15 21:17:33', 'GogetaSSJ4@DragonBallHeroes.com', 'Marroc', 'Crema', 15),
(5, '2021-10-15 21:24:54', 'GogetaSSJ4@DragonBallHeroes.com', 'Marroc', 'Crema', 18),
(6, '2021-10-15 21:28:18', 'GogetaSSJ4@DragonBallHeroes.com', 'Oreo', 'Crema', 18),
(7, '2021-10-15 21:29:56', 'Kirito@SwordArtOnline.com', 'Melon', 'Agua', 18),
(10, '2021-10-15 22:32:31', 'Naruto@Konoha.com', 'Marroc', 'Crema', 30),
(12, '2021-10-15 23:19:58', 'VegitoSSJBlue@DragonBallSuper.com', 'Kinder', 'Crema', 35);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
