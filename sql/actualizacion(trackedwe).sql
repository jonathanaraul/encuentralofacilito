{\rtf1\ansi\ansicpg1252\deff0\deflang8202{\fonttbl{\f0\fnil\fcharset0 Calibri;}}
{\*\generator Msftedit 5.41.21.2509;}\viewkind4\uc1\pard\sa200\sl276\slmult1\lang10\f0\fs22\par
\par
CREATE TABLE IF NOT EXISTS `tracked_webs` (\par
  `id` int(11) NOT NULL AUTO_INCREMENT,\par
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,\par
  `web` varchar(255) COLLATE utf8_unicode_ci NOT NULL,\par
  `category` int(11) NOT NULL,\par
  PRIMARY KEY (`id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;\par
\par
--\par
-- Volcado de datos para la tabla `tracked_webs`\par
--\par
\par
INSERT INTO `tracked_webs` (`id`, `name`, `web`, `category`) VALUES\par
(1, 'todoapuestas_portal', 'todoapuestas.org', 1),\par
(2, 'todoapuestas_foro', 'foro-apuestas.com', 2),\par
(3, 'elmejorblogdeapuestas', 'elmejorblogdeapuestas.com', 2),\par
(4, 'nbaapuestas', 'nbaapuestas.com', 2),\par
(5, 'apuestablog', 'apuestablog.com', 2),\par
(6, 'apuestologia', 'apuestologia.com', 2),\par
(7, 'miramiapuesta', 'miramiapuesta.com', 2),\par
(8, 'cjd_car', 'resto', 2),\par
(9, 'apuestasdecaballos', 'apuestasdecaballos.com.es', 2),\par
(12, 'bonosdeapuestas', 'bonosdeapuestas.com.es', 2),\par
(14, 'pokermaestros', 'pokermaestros.es', 2),\par
(15, 'apuestasbaloncesto', 'apuestasbaloncesto.com.es', 2),\par
(16, 'pornoapuestas', 'pornoapuestas.com', 2),\par
(17, 'apuestasdeportes', 'apuestasdeportes.com.es', 2),\par
(18, 'blogapuestasfutbol', 'blogapuestasfutbol.com', 2),\par
(19, 'apuestaspremier', 'apuestaspremier.com', 2);\par
\par
\par
}
 