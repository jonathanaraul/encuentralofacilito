-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-09-2014 a las 20:06:59
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.4.31

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `todoapuestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sf2_acceso`
--

CREATE TABLE IF NOT EXISTS `sf2_acceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrasenia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `sf2_acceso`
--

INSERT INTO `sf2_acceso` (`id`, `nombre`, `url`, `usuario`, `contrasenia`, `published`, `created`, `updated`) VALUES
(1, 'milcasinos', 'http://www.milcasinos.com', 'milcasinos', 'pirracas', 1, '2014-08-09 23:16:22', '2014-08-12 23:11:24'),
(2, 'pronoapuestas', 'http://www.pronoapuestas.com', 'pronoapuestas', 'pirracas', 1, '2014-09-07 21:21:27', '2014-09-07 21:21:27'),
(3, 'apuestasmotos', 'http://apuestasmotos.com/', 'apuestasmotos', 'pirracas', 1, '2014-09-07 21:22:57', '2014-09-07 21:22:57'),
(4, 'apgoles', 'http://www.apuestasgoles.com', 'apgoles', 'pirracas', 1, '2014-09-07 21:50:30', '2014-09-07 21:50:30'),
(5, 'apuestaseurocopa', 'http://apuestaseurocopa.com.es/', 'apuestaseurocopa', 'pirracas', 1, '2014-09-07 21:58:31', '2014-09-07 21:58:31'),
(6, 'apuestasformula1', 'http://apuestasformula1.com.es/', 'apuestasformula1', 'pirracas', 1, '2014-09-07 22:02:14', '2014-09-07 22:02:14'),
(7, 'caballos', 'http://apuestasdecaballos.com.es/', 'caballos', 'pirracas', 1, '2014-09-07 22:03:28', '2014-09-07 22:03:28'),
(8, 'apuestas_cartas', 'http://www.apuestascartas.com', 'apuestas_cartas', 'pirracas', 1, '2014-09-07 22:05:42', '2014-09-07 22:05:42'),
(9, 'apuestascasino', 'http://apuestascasino.com.es/', 'apuestascasino', 'pirracas', 1, '2014-09-07 22:07:09', '2014-09-07 22:07:09'),
(10, 'apuestasmundial', 'http://www.apuestasmundial.com.es', 'apuestasmundial', 'pirracas', 1, '2014-09-07 22:30:27', '2014-09-07 22:30:27'),
(11, 'apuestaspremier', 'http://www.apuestaspremier.com', 'apuestaspremier', 'pirracas', 1, '2014-09-07 22:43:57', '2014-09-07 22:43:57'),
(12, 'blackjack', 'http://blackjackapuestas.com/', 'blackjack', 'pirracas', 1, '2014-09-07 22:59:18', '2014-09-07 22:59:18'),
(13, 'blogdebingo', 'http://www.blogdebingo.es', 'blogdebingo', 'pirracas', 1, '2014-09-07 23:09:45', '2014-09-07 23:09:45'),
(14, 'casinoapuestas', 'http://www.casinoapuestasred.com', 'casinoapuestas', 'pirracas', 1, '2014-09-07 23:10:52', '2014-09-07 23:10:52'),
(15, 'casinoyruleta', 'http://www.casinoyruleta.com', 'casinoyruleta', 'pirracas', 1, '2014-09-07 23:14:08', '2014-09-07 23:14:08'),
(16, 'pokermaestros', 'http://www.pokermaestros.com', 'pokermaestros', '830828&&m', 1, '2014-09-07 23:19:55', '2014-09-07 23:20:13'),
(17, 'reddeapuestas', 'http://www.reddeapuestas.com', 'reddeapuestas', 'pirracas', 1, '2014-09-07 23:28:57', '2014-09-07 23:28:57');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
