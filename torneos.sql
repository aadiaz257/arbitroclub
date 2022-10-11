-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2022 a las 16:52:23
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `torneos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `inicio` date NOT NULL,
  `termino` date DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`id`, `nombre`, `inicio`, `termino`, `costo`, `estado`) VALUES
(1, 'Sur Oriente', '2022-08-28', '2022-08-31', '20000.00', 1),
(3, 'Botica Privada', '2022-08-28', '2022-08-31', '15000.00', 1),
(7, 'Santander', '2022-08-12', '2022-08-12', '15000.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos_usuarios`
--

CREATE TABLE `torneos_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `torneo_id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `cancha` varchar(10) CHARACTER SET latin1 NOT NULL,
  `horas_laboradas` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_termino` datetime DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `torneos_usuarios`
--

INSERT INTO `torneos_usuarios` (`id`, `torneo_id`, `usuario_id`, `cancha`, `horas_laboradas`, `fecha_inicio`, `fecha_termino`, `estado`) VALUES
(1, 1, 4, '2', '839', '2022-08-27 01:22:29', '2022-08-27 01:36:28', 0),
(2, 1, 3, '4', '79645', '2022-08-27 11:52:01', '2022-08-28 09:59:26', 0),
(3, 3, 2, '7', '4860', '2022-08-28 11:30:37', '2022-08-28 12:51:02', 0),
(4, 3, 2, '7', '12', '2022-08-28 11:59:18', '2022-08-28 11:59:30', 0),
(7, 3, 4, '7', '14', '2022-08-28 01:01:45', '2022-08-28 01:01:59', 0),
(8, 1, 2, '7', '56', '2022-08-28 01:02:41', '2022-08-28 01:03:37', 0),
(9, 1, 3, '14', '2658', '2022-08-28 10:26:16', '2022-08-28 11:10:34', 0),
(10, 1, 4, '12', '2638', '2022-08-28 10:26:45', '2022-08-28 11:10:43', 0),
(15, 7, 3, '7', '19', '2022-08-29 01:27:01', '2022-08-29 01:27:20', 0),
(16, 3, 3, '1', '38', '2022-08-29 01:28:14', '2022-08-29 01:28:52', 0),
(17, 3, 4, '5', '35', '2022-08-29 01:28:20', '2022-08-29 01:28:55', 0),
(18, 1, 2, '3', '352445', '2022-08-29 07:53:55', '2022-09-02 09:48:00', 0),
(19, 1, 3, '8', '352441', '2022-08-29 07:54:02', '2022-09-02 09:48:03', 0),
(21, 1, 3, '1', '436706', '2022-09-02 09:49:15', '2022-09-07 11:07:41', 0),
(22, 1, 4, '1', '434441', '2022-09-02 10:27:05', '2022-09-07 11:07:46', 0),
(23, 1, 2, '2', '1621', '2022-09-08 06:06:25', '2022-09-08 06:33:26', 0),
(24, 1, 4, '2', '1609', '2022-09-08 06:06:41', '2022-09-08 06:33:30', 0),
(25, 1, 2, '1', '3700', '2022-09-22 04:11:12', '2022-09-22 05:12:52', 0),
(26, 1, 6, '1', '3696', '2022-09-22 04:11:19', '2022-09-22 05:12:55', 0),
(27, 7, 3, '4', '1884', '2022-09-23 08:41:42', '2022-09-23 09:13:06', 0),
(28, 7, 6, '4', '1876', '2022-09-23 08:41:51', '2022-09-23 09:13:07', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `apellido` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) NOT NULL DEFAULT 'user@gmail.com',
  `password` varchar(100) NOT NULL DEFAULT '1234567',
  `cedula` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tipo_usuario` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `cedula`, `tipo_usuario`, `estado`) VALUES
(1, 'Administrador', 'Caddies', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '46467845', 'Admin', 1),
(2, 'Eduardo', 'Saravia', 'user@gmail.com', '1234567', '234234', 'Arbitro', 1),
(3, 'Alberto', 'Sanchez', 'user@gmail.com', '1234567', '123456', 'Arbitro', 1),
(4, 'Michael', 'Jackson Five', 'user@gmail.com', '1234567', '999999', 'Arbitro', 1),
(6, 'Claudia', 'Delgadillo', 'user@gmail.com', '1234567', '5453245345', 'Arbitro', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `torneos_usuarios`
--
ALTER TABLE `torneos_usuarios`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `torneos_usuarios_usuario_id_fk` (`usuario_id`) USING BTREE,
  ADD KEY `torneos_usuarios_torneo_id_fk` (`torneo_id`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `torneos_usuarios`
--
ALTER TABLE `torneos_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `torneos_usuarios`
--
ALTER TABLE `torneos_usuarios`
  ADD CONSTRAINT `torneos_usuarios_torneo_id_fk` FOREIGN KEY (`torneo_id`) REFERENCES `torneos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `torneos_usuarios_usuario_id_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
