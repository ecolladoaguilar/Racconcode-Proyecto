
-- Base de datos: `proyecto`

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2021 a las 01:17:08
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Estructura de tabla para la tabla `registro`

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `fecha` date NOT NULL
);

-- Añadir clave primaria para la tabla `registro`
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`);

-- Modificar el id para que se vaya autoincrementando en 1 en la tabla `registro`
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;