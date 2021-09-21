-- Productos
-- Create
CREATE TABLE `tp_01`.`producto` (
    `id` INT NOT NULL AUTO_INCREMENT=1001,
    `codigo_de_barra` INT NOT NULL,
    `nombre` VARCHAR(30) NULL DEFAULT NULL,
    `tipo` VARCHAR(30) NULL DEFAULT NULL,
    `stock` SMALLINT NOT NULL DEFAULT '0',
    `precio` FLOAT NOT NULL,
    `fecha_de_creacion` DATE NOT NULL,
    `fecha_de_modificacion` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8 COLLATE utf8_spanish_ci;
--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- Volcado de datos para la tabla `producto`
--
-- Fields: id código_de_barra nombre tipo stock precio fecha_de_creación fecha_de_modificación
INSERT INTO producto VALUES (1001, 77900361, 'Westmacott', 'liquido', 33, 15.87, '2021-02-09', '2020-09-26');
INSERT INTO producto VALUES (1002, 77900362, 'Spirit', 'solido', 45, 69.74, '2020-09-18', '2020-04-14');
INSERT INTO producto VALUES (1003, 77900363, 'Newgrosh', 'polvo', 14, 68.19, '2020-11-29', '2021-02-11');
INSERT INTO producto VALUES (1004, 77900364, 'McNickle', 'polvo', 19, 53.51, '2020-11-28', '2020-04-17');
INSERT INTO producto VALUES (1005, 77900365, 'Hudd', 'solido', 68, 26.56, '2020-12-19', '2020-06-19');
INSERT INTO producto VALUES (1006, 77900366, 'Schrader', 'polvo', 17, 96.54, '2020-08-02', '2020-04-18');
INSERT INTO producto VALUES (1007, 77900367, 'Bachellier', 'solido', 59, 69.17, '2021-01-30', '2020-06-07');
INSERT INTO producto VALUES (1008, 77900368, 'Fleming', 'solido', 38, 66.77, '2020-10-26', '2020-10-03');
INSERT INTO producto VALUES (1009, 77900369, 'Hurry', 'solido', 44, 43.01, '2020-07-04', '2020-05-30');
INSERT INTO producto VALUES (1010, 77900310, 'Krauss', 'polvo', 73, 35.73, '2021-03-03', '2020-08-30');

-- --------------------------------------------------------

-- Usuarios
--
-- Estructura de tabla para la tabla `usuario`
--
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_de_registro` date NOT NULL,
  `localidad` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

-- Fields: nombre apellido clave mail fecha_de_registro localidad
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO usuario VALUES (101, 'Esteban' , 'Madou' , 2345 , 'dkantor0@example.com' , '2021-01-07' , 'Quilmes');
INSERT INTO usuario VALUES (102, 'German' , 'Gerram' , 1234 , 'ggerram1@hud.gov' , '2020-05-08' , 'Berazategui');
INSERT INTO usuario VALUES (103, 'Deloris' , 'Fosis' , 5678 , 'bsharpe2@wisc.edu' , '2020-11-28' , 'Avellaneda');
INSERT INTO usuario VALUES (104, 'Brok' , 'Neiner' , 4567 , 'bblazic3@desdev.cn' , '2020-12-08' , 'Quilmes');
INSERT INTO usuario VALUES (105, 'Garrick' , 'Brent' , 6789 , 'gbrent4@theguardian.com' , '2020-12-17' , 'Moron');
INSERT INTO usuario VALUES (106, 'Bili' , 'Baus' , 0123 , 'bhoff5@addthis.com' , '2020-11-27' , 'Moreno');

-- --------------------------------------------------------

-- Ventas
--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_de_venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD KEY `venta_producto` (`id_producto`),
  ADD KEY `venta_usuario` (`id_usuario`);

--
-- Volcado de datos para la tabla `venta`
--
-- Fields: id_producto id_usuario cantidad fecha_de_venta
INSERT INTO venta VALUES (1001, 101, 2, '2020-07-19');
INSERT INTO venta VALUES (1008, 102, 3, '2020-08-16');
INSERT INTO venta VALUES (1007, 102, 4, '2021-01-24');
INSERT INTO venta VALUES (1006, 103, 5, '2021-01-14');
INSERT INTO venta VALUES (1003, 104, 6, '2021-03-20');
INSERT INTO venta VALUES (1005, 105, 7, '2021-02-22');
INSERT INTO venta VALUES (1003, 104, 6, '2020-12-02');
INSERT INTO venta VALUES (1003, 106, 6, '2020-06-10');
INSERT INTO venta VALUES (1002, 106, 6, '2021-02-04');
INSERT INTO venta VALUES (1001, 106, 1, '2020-05-17');

-- --------------------------------------------------------

-- Queries
-- 1. Obtener los detalles completos de todos los usuarios ordenados alfabéticamente.
SELECT  * FROM usuario
ORDER BY nombre, apellido;
-- 2. Obtener los detalles completos de todos los productos líquidos.
SELECT  * FROM producto
WHERE tipo = 'liquido';
-- 3. Obtener todas las compras en los cuales la cantidad esté entre 6 y 10 inclusive.
SELECT  * FROM venta WHERE cantidad BETWEEN 6 AND 10;
-- 4. Obtener la cantidad total de todos los productos vendidos.
SELECT  SUM(cantidad) AS total_vendidos
FROM venta;
-- 5. Mostrar los primeros 3 números de productos que se han enviado.
SELECT DISTINCT(V.id_producto) AS Productos_Vendidos
FROM venta AS V
ORDER BY fecha_de_venta ASC
LIMIT 3;
-- 6. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
SELECT  U.nombre, P.nombre
FROM usuario AS U
JOIN venta AS V
ON U.id = V.id_usuario
JOIN producto AS P
ON P.id = V.id_producto;
-- 7. Indicar el monto (cantidad * precio) por cada una de las ventas.
SELECT ROUND((V.cantidad * P.precio), 2) AS MontoVenta
FROM venta AS V
INNER JOIN producto AS P
ON V.id_producto = P.id;
-- 8. Obtener la cantidad total del producto 1003 vendido por el usuario 104.
SELECT  SUM(V.cantidad) AS Cantidad_Total
FROM venta AS V
WHERE V.id_producto = 1003
AND V.id_usuario = 104;
-- 9. Obtener todos los números de los productos vendidos por algún usuario de 'Avellaneda'.
SELECT  DISTINCT(V.id_producto) AS Productos_Vendidos
FROM venta AS V 
JOIN usuario AS U 
ON V.id_usuario = U.id 
WHERE U.localidad = 'Avellaneda';
-- 10. Obtener los datos completos de los usuarios cuyos nombres contengan la letra ‘u’.
SELECT  * FROM usuario WHERE nombre LIKE '%u%';
-- 11. Traer las ventas entre junio del 2020 y febrero 2021.
SELECT  * FROM venta WHERE fecha_de_venta BETWEEN '2020-06-01' AND '2021-02-01';
--12. Obtener los usuarios registrados antes del 2021.
SELECT  * FROM usuario WHERE fecha_de_registro < '2021-01-01';
--13. Agregar el producto llamado ‘Chocolate’, de tipo Sólido y con un precio de 25,35.
INSERT INTO producto VALUES (1011, 'Chocolate', 'solido', 25, 25.35, '2021-09-03', '2020-09-21');
--14. Insertar un nuevo usuario.
INSERT INTO usuario VALUES (107, 'Facu', 'Falcone', 2345, 'falcone.facu@mail.com' , '1990-02-25' , 'Berazategui');
--15. Cambiar los precios de los productos de tipo sólido a 66,60.
UPDATE producto SET precio = 66.60 WHERE tipo = 'solido';
--16. Cambiar el stock a 0 de todos los productos cuyas cantidades de stock sean menores a 20 inclusive.
UPDATE producto SET stock = 0 WHERE stock < 21;
--17. Eliminar el producto número 1010.
DELETE FROM producto WHERE id = 1010;
--18. Eliminar a todos los usuarios que no han vendido productos.
DELETE FROM usuario WHERE id NOT IN (SELECT id_usuario FROM venta);
