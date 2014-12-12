-- phpMyAdmin SQL Dump
-- version 4.2.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-12-2014 a las 16:08:14
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.5.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `WebSantoscoy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`id` int(11) unsigned NOT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 'Arquitectura', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Interiorismo', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Sustentabilidad', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'OAP', 4, '2014-12-08 06:00:00', '0000-00-00 00:00:00'),
(5, 'Landscape', 5, '2014-12-08 06:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_proyecto`
--

CREATE TABLE IF NOT EXISTS `categoria_proyecto` (
`id` int(11) unsigned NOT NULL,
  `categoria_id` int(11) unsigned NOT NULL,
  `proyecto_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_proyecto`
--

INSERT INTO `categoria_proyecto` (`id`, `categoria_id`, `proyecto_id`, `created_at`, `updated_at`) VALUES
(15, 3, 2, '2014-12-11 18:45:33', '2014-12-11 18:45:33'),
(14, 1, 2, '2014-12-11 18:45:33', '2014-12-11 18:45:33'),
(13, 3, 3, '2014-12-11 18:45:17', '2014-12-11 18:45:17'),
(12, 1, 3, '2014-12-11 18:45:17', '2014-12-11 18:45:17'),
(17, 2, 4, '2014-12-11 21:47:51', '2014-12-11 21:47:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
`id` int(11) unsigned NOT NULL,
  `archivo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `no_publicacion` int(11) NOT NULL,
  `titulo` varchar(150) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(255) CHARACTER SET latin1 NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `published` tinyint(3) NOT NULL DEFAULT '1',
  `removed` tinyint(3) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id`, `archivo`, `no_publicacion`, `titulo`, `descripcion`, `url`, `published`, `removed`, `created_at`, `updated_at`) VALUES
(4, 'edicion_2.jpg', 1, 'Design: El diseño como estilo de vida', 'descripcion corta', NULL, 1, 0, '2014-12-11 17:11:20', '2014-12-11 17:11:20'),
(5, 'edicion.jpg', 2, 'Design: El segundo jojo', 'mi segunda descripción', NULL, 1, 0, '2014-12-11 17:11:50', '2014-12-11 17:11:50'),
(6, 'edicion.jpg', 3, 'tercero', 'descripción corta tercero', NULL, 1, 0, '2014-12-11 18:02:52', '2014-12-11 18:02:53'),
(7, 'edicion_2.jpg', 4, 'cuarto', 'descripción corta para el CUARTO, wiiii!!!', NULL, 1, 0, '2014-12-11 18:03:29', '2014-12-11 18:03:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE IF NOT EXISTS `proyectos` (
`id` int(11) unsigned NOT NULL,
  `titulo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `arquitectura` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET latin1 NOT NULL,
  `locacion` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `tipologia` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `cliente` varchar(150) CHARACTER SET latin1 NOT NULL,
  `status` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `asociado` varchar(150) CHARACTER SET latin1 NOT NULL,
  `dimension` varchar(100) CHARACTER SET latin1 NOT NULL,
  `published` tinyint(3) NOT NULL DEFAULT '1',
  `removed` tinyint(3) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `titulo`, `arquitectura`, `descripcion`, `locacion`, `tipologia`, `cliente`, `status`, `asociado`, `dimension`, `published`, `removed`, `created_at`, `updated_at`) VALUES
(2, 'Primer Registro', 'Chidismo super Wow', 'descripción corta', 'Guadalajara', 'bien chida', 'Juan Camaney', 'Completado', 'Pedrito Fernández', 'big', 1, 0, '2014-12-04 23:06:58', '2014-12-11 18:45:33'),
(3, 'Segundo Registro', 'Interiorismo 2014', 'descripcion segundo registro', 'al norti', 'mucho topos si', 'Ron Damon', 'A medias', 'El chavo', 'medianito', 1, 0, '2014-12-04 23:44:52', '2014-12-11 18:45:17'),
(4, 'Tercero', 'muajaja', 'descrip corta muajaja', 'en China', 'simon', 'Wallmart', 'mas o menos', 'Pollos Hermanos Cheeen', 'grande jojo', 1, 0, '2014-12-11 18:59:54', '2014-12-11 18:59:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_imagenes`
--

CREATE TABLE IF NOT EXISTS `proyecto_imagenes` (
`id` int(11) unsigned NOT NULL,
  `proyecto_id` int(11) unsigned NOT NULL,
  `archivo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '1',
  `removed` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyecto_imagenes`
--

INSERT INTO `proyecto_imagenes` (`id`, `proyecto_id`, `archivo`, `descripcion`, `created_at`, `updated_at`, `ordering`, `published`, `removed`) VALUES
(5, 1, 'tornado_01.jpg', NULL, '2014-12-04 22:13:40', '2014-12-04 22:14:02', 3, 1, 0),
(6, 1, 'fachada3.jpg', NULL, '2014-12-04 22:13:40', '2014-12-04 22:14:02', 2, 1, 0),
(4, 1, 'fachada1.jpg', NULL, '2014-12-04 22:13:40', '2014-12-04 22:14:02', 1, 1, 0),
(7, 2, 'fachada1.jpg', NULL, '2014-12-04 23:07:11', '2014-12-04 23:07:25', 3, 1, 0),
(8, 2, 'tornado_01.jpg', NULL, '2014-12-04 23:07:11', '2014-12-04 23:07:25', 1, 1, 0),
(9, 2, 'fachada3.jpg', NULL, '2014-12-04 23:07:11', '2014-12-04 23:07:25', 2, 1, 0),
(10, 3, 'fachada2.jpg', 'casa2', '2014-12-04 23:45:03', '2014-12-08 14:59:22', 3, 1, 0),
(11, 3, '3128337520_cd854cd50a_o.jpg', 'perro', '2014-12-04 23:45:03', '2014-12-08 14:59:22', 2, 1, 0),
(12, 3, 'fachada3.jpg', 'casa1', '2014-12-08 14:47:46', '2014-12-08 14:59:22', 1, 1, 0),
(23, 4, '3128337520_cd854cd50a_o.jpg', 'perrito guau guau', '2014-12-11 23:58:29', '2014-12-11 23:58:47', 1, 1, 0),
(22, 4, 'fachada1.jpg', '', '2014-12-11 23:35:06', '2014-12-11 23:44:59', 0, 1, 0),
(17, 3, 'All_The_Lovers.jpg', 'All the lovers', '2014-12-08 14:59:07', '2014-12-08 15:17:10', 0, 1, 0),
(20, 4, 'mariah_carey_without_you_6.jpg', 'mi mensaje de prueba jojooj', '2014-12-11 19:30:29', '2014-12-11 23:58:47', 2, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sendmail`
--

CREATE TABLE IF NOT EXISTS `sendmail` (
  `id` int(11) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sendmail`
--

INSERT INTO `sendmail` (`id`, `email`, `nombre`) VALUES
(1, 'c.torres@bitweb.mx', 'Cuauhtémoc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `pareja_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ap` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `am` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genero` enum('M','F') COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8_unicode_ci,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `random_key` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nivel_id` int(11) unsigned NOT NULL,
  `status` enum('A','I') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `agree` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `pareja_id`, `nombre`, `ap`, `am`, `genero`, `email`, `celular`, `direccion`, `username`, `password`, `random_key`, `nivel_id`, `status`, `remember_token`, `imagen`, `created_at`, `updated_at`, `agree`) VALUES
(0, NULL, 'Administrador', NULL, NULL, 'M', 'c.torres@bitweb.mx', NULL, NULL, 'admin', '$2y$10$5kX9jHMsFFDLsahKEGJxd.E0BNowQf81FJxWMYjl/8CHH/G9nktXq', '', 1, 'A', NULL, NULL, '2014-11-28 23:03:54', '2014-11-28 23:03:54', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_nivel_acceso`
--

CREATE TABLE IF NOT EXISTS `user_nivel_acceso` (
  `id` int(10) unsigned NOT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_nivel_acceso`
--

INSERT INTO `user_nivel_acceso` (`id`, `tipo`, `descripcion`, `published`) VALUES
(1, 'Administrador', 'Nivel mas alto, puede hacer y deshacer', 1),
(2, 'Asesores', 'Usuario para Los Asesores de Frava', 1),
(3, 'Arrendadores', 'Usuario de tipo Arrendador', 1),
(4, 'Usuario Registrado/Clientes', 'casi no tienen privilegios', 1),
(5, 'Público', 'Nivel de permisos mas bajo que existe', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_proyecto`
--
ALTER TABLE `categoria_proyecto`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `no_publicacion` (`no_publicacion`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto_imagenes`
--
ALTER TABLE `proyecto_imagenes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `categoria_proyecto`
--
ALTER TABLE `categoria_proyecto`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_imagenes`
--
ALTER TABLE `proyecto_imagenes`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
