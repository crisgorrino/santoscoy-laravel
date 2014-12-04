-- phpMyAdmin SQL Dump
-- version 4.2.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-12-2014 a las 22:45:19
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 'Arquitectura', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Interiorismo', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Sustentabilidad', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_proyecto`
--

INSERT INTO `categoria_proyecto` (`id`, `categoria_id`, `proyecto_id`, `created_at`, `updated_at`) VALUES
(7, 2, 1, '2014-12-04 22:37:39', '2014-12-04 22:37:39'),
(6, 1, 1, '2014-12-04 22:37:39', '2014-12-04 22:37:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE IF NOT EXISTS `proyectos` (
`id` int(11) unsigned NOT NULL,
  `titulo` varchar(255) CHARACTER SET latin1 NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `titulo`, `descripcion`, `locacion`, `tipologia`, `cliente`, `status`, `asociado`, `dimension`, `published`, `removed`, `created_at`, `updated_at`) VALUES
(1, 'primero', 'descripción', 'guadalajara', 'chido', 'juan topo', 'completo', 'yo mesmo', 'muy grande', 1, 0, '2014-12-03 00:05:09', '2014-12-03 00:05:09');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyecto_imagenes`
--

INSERT INTO `proyecto_imagenes` (`id`, `proyecto_id`, `archivo`, `descripcion`, `created_at`, `updated_at`, `ordering`, `published`, `removed`) VALUES
(5, 1, 'tornado_01.jpg', NULL, '2014-12-04 22:13:40', '2014-12-04 22:14:02', 3, 1, 0),
(6, 1, 'fachada3.jpg', NULL, '2014-12-04 22:13:40', '2014-12-04 22:14:02', 2, 1, 0),
(4, 1, 'fachada1.jpg', NULL, '2014-12-04 22:13:40', '2014-12-04 22:14:02', 1, 1, 0);

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
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `categoria_proyecto`
--
ALTER TABLE `categoria_proyecto`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `proyecto_imagenes`
--
ALTER TABLE `proyecto_imagenes`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
