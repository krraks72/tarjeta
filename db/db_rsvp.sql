-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-03-2026 a las 14:34:34
-- Versión del servidor: 11.8.3-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rsvp`
--
CREATE DATABASE rsvp;
USE rsvp;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rsvp`
--



CREATE TABLE `rsvp` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `NumberOfGuests` int(11) NOT NULL,
  `MealPreferences` varchar(50) NOT NULL,
  `Attendance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rsvp`
--

INSERT INTO `rsvp` (`Id`, `Name`, `Phone`, `NumberOfGuests`, `MealPreferences`, `Attendance`) VALUES
(1, 'Martha linares', '3013055629', 1, 'con hospedaje', 1),
(2, 'Katherine Rodríguez', '3125231490', 1, 'con hospedaje', 1),
(3, 'Richar padilla', '3147386205', 2, 'con hospedaje', 1),
(4, 'Carlos Hernan Acero Acosta ', '3202166281', 4, 'con hospedaje', 1),
(5, 'Mauricio García vergara', '3232872660', 2, 'con hospedaje', 1),
(6, 'Angela Yinett Rodriguez Leon ', '3187200149', 1, 'con hospedaje', 1),
(7, 'Yobany Palacios Torres ', '3112685858', 4, 'con hospedaje', 1),
(8, 'Eduardo Primero - Fotógrafo ', '3169888844', 1, 'con hospedaje', 1),
(9, 'Nelly León', '3114983655', 1, 'con hospedaje', 1),
(10, 'Wilson Daniel Rodríguez León', '3112375984', 4, 'con hospedaje', 1),
(11, 'Daniel Palacios, Zoe Stroobosscher', '7729719319', 2, 'con hospedaje', 1),
(12, 'Julian Camilo Castro Diaz', '3173727681', 2, 'con hospedaje', 1),
(13, 'juan perez', '1245687', 4, 'con hospedaje', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rsvp`
--
ALTER TABLE `rsvp`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rsvp`
--
ALTER TABLE `rsvp`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- Estructura de tabla para plantilla dinámica de invitación

CREATE TABLE `invitation_template` (
  `id` int(11) NOT NULL,
  `couple_names` varchar(150) NOT NULL,
  `invitation_text` varchar(255) NOT NULL,
  `celebration_text` varchar(255) NOT NULL,
  `event_date_label` varchar(100) NOT NULL,
  `countdown_target` datetime NOT NULL,
  `venue_address` varchar(255) NOT NULL,
  `reservation_url` varchar(255) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `background_image_url` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `invitation_template` (`id`, `couple_names`, `invitation_text`, `celebration_text`, `event_date_label`, `countdown_target`, `venue_address`, `reservation_url`, `logo_url`, `background_image_url`) VALUES
(1, 'Iván y Diana', 'Tenemos el placer de invitarle(s)', 'A la celebración de nuestra Boda', 'Dic, 14 de 2024', '2026-12-14 00:00:00', 'Finca Villa Isa, Chinauta, km 65 vía a melgar', 'index.html#rspv', 'assets/media/logo.png', 'assets/media/bg/invitation.png');

ALTER TABLE `invitation_template`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `invitation_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
