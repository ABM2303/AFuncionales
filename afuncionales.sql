-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2025 a las 23:02:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `afuncionales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoyado`
--

CREATE TABLE `apoyado` (
  `id_apoyado` int(11) NOT NULL COMMENT 'id del apoyado',
  `curp` varchar(30) NOT NULL COMMENT 'CURP del Apoyado',
  `nombres` varchar(30) NOT NULL COMMENT 'Nombres del Apoyado',
  `paterno` varchar(30) NOT NULL COMMENT 'Apellido paterno del Apoyado',
  `materno` varchar(30) NOT NULL COMMENT 'Apellido materno del Apoyado',
  `genero` enum('H','M') NOT NULL DEFAULT 'H' COMMENT 'Genero del Apoyado',
  `fecha_nacimiento` varchar(30) NOT NULL COMMENT 'Fecha de nacimiento del Apoyado',
  `estado_civil` varchar(30) NOT NULL COMMENT 'Estado civil del Apoyado',
  `discapacidad` enum('Si','No') NOT NULL DEFAULT 'Si' COMMENT 'Tiene alguna discapacidad el Apoyado.',
  `id_apoyo` int(11) NOT NULL COMMENT 'Aparato para el Apoyado',
  `monto` int(11) NOT NULL COMMENT 'Monto que se le dio al apoyado',
  `poblacion` varchar(30) NOT NULL COMMENT 'Poblacion a la que pertenece el Apoyado',
  `Id_Cat_Tip_Via` int(11) NOT NULL DEFAULT 2 COMMENT 'Tipo de vialidad',
  `nombre_vial` varchar(30) NOT NULL COMMENT 'Nombre de la vialidad',
  `numero_ext` int(11) NOT NULL COMMENT 'Numero exterior del domicilio',
  `letra_ext` varchar(1) NOT NULL COMMENT 'Letra exterior del domicilio',
  `numero_int` int(11) NOT NULL COMMENT 'Numero interior del domicilio',
  `letra_int` varchar(1) NOT NULL COMMENT 'Letra interior del domicilio',
  `nombre_asen` varchar(30) NOT NULL COMMENT 'Nombre de asentamiento',
  `tipo_asen` varchar(30) NOT NULL COMMENT 'Tipo de asentamiento',
  `referencia` varchar(50) NOT NULL COMMENT 'Referencia',
  `celular` varchar(10) NOT NULL COMMENT 'Numero de celular del Apoyado',
  `id_supervisor` int(11) NOT NULL DEFAULT 0 COMMENT 'id del usuario con rol de spervisor que lo valido',
  `CVE_MUN` int(11) NOT NULL COMMENT 'Clave de municipio',
  `localidad` varchar(100) NOT NULL COMMENT 'Localidad de la escuela',
  `c_postal` varchar(30) NOT NULL COMMENT 'Código Postal',
  `id_usuario` int(11) NOT NULL DEFAULT 0 COMMENT 'id del usuario que lo registro',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de registro del Apoyado',
  `fecha_validacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha de validacion del Apoyado',
  `pdf_docs` varchar(50) NOT NULL DEFAULT 'Nada' COMMENT 'Ruta del documento pdf',
  `validado` enum('Si','No') NOT NULL DEFAULT 'No' COMMENT 'Documentos en informacion validada',
  `comentario` varchar(500) DEFAULT NULL COMMENT 'Comentario dirigido al apoyado',
  `clave_localidad` int(11) NOT NULL DEFAULT 0 COMMENT 'clave de la localidad',
  `estado_nacimiento` varchar(10) NOT NULL DEFAULT 'Nada' COMMENT 'Estado de nacimiento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabla para almacenar a los apoyados de un aparato funcional';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoyos`
--

CREATE TABLE `apoyos` (
  `id_apoyo` int(11) NOT NULL COMMENT 'ID del apoyo',
  `tipo_apoyo` varchar(100) NOT NULL COMMENT 'Tipo de apoyo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabla para almacenar los apoyos';

--
-- Volcado de datos para la tabla `apoyos`
--

INSERT INTO `apoyos` (`id_apoyo`, `tipo_apoyo`) VALUES
(1, 'Medicamentos'),
(2, 'Material de osteosíntesis'),
(3, 'Estudios de laboratorio'),
(4, 'Rayos X'),
(5, 'Hospitalizaciones'),
(6, 'Unidad de sangre'),
(7, 'Hemodiálisis'),
(8, 'Diálisis'),
(9, 'Pañales para niños y adulto'),
(10, 'Material ortopédico y de rehabilitación en general'),
(11, 'Tanque de oxígeno'),
(12, 'Servicio de ambulancia'),
(13, 'Fórmula láctea para infante con prescripción médica'),
(14, 'Resonancia magnética'),
(15, 'Material quirúrgico'),
(16, 'Tomografías'),
(17, 'Ecocardiogramas'),
(18, 'Electroencefalograma'),
(19, 'Electrocardiograma'),
(20, 'Potenciales evocados'),
(21, 'Vacunas'),
(22, 'Alimentación parenteral'),
(23, 'Consultas médicas'),
(24, 'Pasajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

CREATE TABLE `beneficiario` (
  `id_beneficiario` int(11) NOT NULL COMMENT 'id del beneficiado',
  `curp` varchar(30) NOT NULL COMMENT 'CURP del beneficiario',
  `nombres` varchar(30) NOT NULL COMMENT 'Nombres del beneficiario',
  `paterno` varchar(30) NOT NULL COMMENT 'Apellido paterno del beneficiario',
  `materno` varchar(30) NOT NULL COMMENT 'Apellido materno del beneficiario',
  `genero` enum('H','M') NOT NULL DEFAULT 'H' COMMENT 'Genero del beneficiario',
  `fecha_nacimiento` varchar(30) NOT NULL COMMENT 'Fecha de nacimiento del beneficiario',
  `estado_civil` varchar(30) NOT NULL COMMENT 'Estado civil del beneficiario',
  `discapacidad` enum('Si','No') NOT NULL DEFAULT 'Si' COMMENT 'Tiene alguna discapacidad el beneficiario.',
  `aparato` varchar(30) NOT NULL COMMENT 'Aparato para el beneficiario',
  `poblacion` varchar(30) NOT NULL COMMENT 'Poblacion a la que pertenece el beneficiario',
  `Id_Cat_Tip_Via` int(11) NOT NULL DEFAULT 2 COMMENT 'Tipo de vialidad',
  `nombre_vial` varchar(30) NOT NULL COMMENT 'Nombre de la vialidad',
  `numero_ext` int(11) NOT NULL COMMENT 'Numero exterior del domicilio',
  `letra_ext` varchar(1) NOT NULL COMMENT 'Letra exterior del domicilio',
  `numero_int` int(11) NOT NULL COMMENT 'Numero interior del domicilio',
  `letra_int` varchar(1) NOT NULL COMMENT 'Letra interior del domicilio',
  `nombre_asen` varchar(30) NOT NULL COMMENT 'Nombre de asentamiento',
  `tipo_asen` varchar(30) NOT NULL COMMENT 'Tipo de asentamiento',
  `referencia` varchar(50) NOT NULL COMMENT 'Referencia',
  `celular` varchar(10) NOT NULL COMMENT 'Numero de celular del beneficiario',
  `id_supervisor` int(11) DEFAULT NULL COMMENT 'id del usuario con rol de spervisor que lo valido',
  `CVE_MUN` int(11) NOT NULL COMMENT 'Clave de municipio',
  `localidad` varchar(100) NOT NULL COMMENT 'Localidad de la escuela',
  `c_postal` varchar(30) NOT NULL COMMENT 'Código Postal',
  `id_usuario` int(11) NOT NULL DEFAULT 0 COMMENT 'id del usuario que lo registro',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de registro del beneficiario',
  `fecha_validacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha de validacion del beneficiario',
  `pdf_docs` varchar(50) NOT NULL DEFAULT 'Nada' COMMENT 'Ruta del documento pdf',
  `validado` enum('Si','No') NOT NULL DEFAULT 'No' COMMENT 'Documentos e informacion validada',
  `comentario` varchar(500) DEFAULT NULL COMMENT 'Comentario dirigido al beneficiario',
  `clave_localidad` int(11) NOT NULL DEFAULT 0 COMMENT 'clave de la localidad',
  `estado_nacimiento` varchar(10) NOT NULL DEFAULT 'Nada' COMMENT 'Estado de nacimiento'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabla para almacenar alos beneficiados de un aparato funcional';

--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`id_beneficiario`, `curp`, `nombres`, `paterno`, `materno`, `genero`, `fecha_nacimiento`, `estado_civil`, `discapacidad`, `aparato`, `poblacion`, `Id_Cat_Tip_Via`, `nombre_vial`, `numero_ext`, `letra_ext`, `numero_int`, `letra_int`, `nombre_asen`, `tipo_asen`, `referencia`, `celular`, `id_supervisor`, `CVE_MUN`, `localidad`, `c_postal`, `id_usuario`, `fecha_registro`, `fecha_validacion`, `pdf_docs`, `validado`, `comentario`, `clave_localidad`, `estado_nacimiento`) VALUES
(58, 'AAVR010611MMNLLSA1', '', '', '', '', '', 'Soltero', 'Si', 'Ruedas', 'Otros', 1, '1', 1, '1', 1, '1', '1', 'AEROPUERTO', '1', '1', NULL, 1, 'Ejemplo', '0', 59, '2025-03-22 01:01:12', NULL, 'Nada', 'No', NULL, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_sesiones`
--

CREATE TABLE `bitacora_sesiones` (
  `id_bitacora_sesiones` int(11) NOT NULL COMMENT 'ID de la bitacora',
  `usuario` varchar(100) NOT NULL COMMENT 'Nombre de usuario',
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de inicio de la sesion',
  `fecha_cierre` timestamp NULL DEFAULT NULL COMMENT 'Fecha de fin de la sesion'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabla para almacenar las sesiones de los usuarios';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_ase`
--

CREATE TABLE `cat_ase` (
  `Id_Ase` int(11) DEFAULT NULL,
  `Des_Ase` varchar(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cat_ase`
--

INSERT INTO `cat_ase` (`Id_Ase`, `Des_Ase`) VALUES
(1, 'AEROPUERTO'),
(2, 'AMPLIACIÓN'),
(3, 'BARRIO'),
(4, 'CANTÓN'),
(5, 'CIUDAD'),
(6, 'CIUDAD INDUSTRIAL'),
(7, 'COLONIA'),
(8, 'CONDOMINIO'),
(9, 'CONJUNTO HABITACIONAL'),
(10, 'CORREDOR INDUSTRIAL'),
(11, 'COTO'),
(12, 'CUARTEL'),
(13, 'EJIDO'),
(14, 'EXHACIENDA'),
(15, 'FRACCIÓN'),
(16, 'FRACCIONAMIENTO'),
(17, 'GRANJA'),
(18, 'HACIENDA'),
(19, 'INGENIO'),
(20, 'MANZANA'),
(21, 'PARAJE'),
(22, 'PARQUE INDUSTRIAL'),
(23, 'PRIVADA'),
(24, 'PROLONGACIÓN'),
(25, 'PUEBLO'),
(26, 'PUERTO'),
(27, 'RANCHERÍA'),
(28, 'RANCHO'),
(29, 'REGIÓN'),
(30, 'RESIDENCIAL'),
(31, 'RINCONADA'),
(32, 'SECCIÓN'),
(33, 'SECTOR'),
(34, 'SUPERMANZANA'),
(35, 'UNIDAD'),
(36, 'UNIDAD HABITACIONAL'),
(37, 'VILLA'),
(38, 'ZONA FEDERAL'),
(39, 'ZONA INDUSTRIAL'),
(40, 'ZONA MILITAR'),
(43, 'ZONA NAVAL'),
(41, 'NINGUNO'),
(42, 'ZONA COMERCIAL'),
(44, 'LOCALIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_mun_loc`
--

CREATE TABLE `cat_mun_loc` (
  `CVE_ENT` int(11) DEFAULT NULL,
  `NOM_ENT` varchar(20) DEFAULT NULL,
  `NOM_ABR` varchar(5) DEFAULT NULL,
  `CVE_MUN` int(11) DEFAULT NULL,
  `NOM_MUN` varchar(31) DEFAULT NULL,
  `CVE_LOC` int(11) DEFAULT NULL,
  `NOM_LOC` varchar(69) DEFAULT NULL,
  `AMBITO` varchar(1) DEFAULT NULL,
  `LATITUD` decimal(9,3) DEFAULT NULL,
  `LONGITUD` decimal(10,3) DEFAULT NULL,
  `ALTITUD` int(11) DEFAULT NULL,
  `CVE_CARTA` varchar(6) DEFAULT NULL,
  `Clave Municipio` varchar(3) DEFAULT NULL,
  `Nombre Municipio` varchar(31) DEFAULT NULL,
  `Clave Localidad` varchar(4) DEFAULT NULL,
  `Nombre Localidad` varchar(61) DEFAULT NULL,
  `Grado` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cat_mun_loc`
--

INSERT INTO `cat_mun_loc` (`CVE_ENT`, `NOM_ENT`, `NOM_ABR`, `CVE_MUN`, `NOM_MUN`, `CVE_LOC`, `NOM_LOC`, `AMBITO`, `LATITUD`, `LONGITUD`, `ALTITUD`, `CVE_CARTA`, `Clave Municipio`, `Nombre Municipio`, `Clave Localidad`, `Nombre Localidad`, `Grado`) VALUES
(1, 'Ejemplo', 'EJEMP', 1, 'Ejemplo', 1, 'Ejemplo', 'A', 40.750, -74.040, 1, 'ABM023', '1', 'Ejemplo', 'ABM1', 'Ejemplo', '90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tip_via`
--

CREATE TABLE `cat_tip_via` (
  `Id_Cat_Tip_Via` int(11) NOT NULL,
  `Des_Cat_Tip_Via` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cat_tip_via`
--

INSERT INTO `cat_tip_via` (`Id_Cat_Tip_Via`, `Des_Cat_Tip_Via`) VALUES
(1, 'Ampliacion'),
(2, 'Andador'),
(3, 'Avenida'),
(4, 'Boulevard'),
(5, 'Calle'),
(6, 'Callejon'),
(7, 'Calzada'),
(8, 'Cerrada'),
(9, 'Circuito'),
(10, 'Circunvalacion'),
(11, 'Continuacion'),
(12, 'Corredor'),
(13, 'Diagonal'),
(14, 'Eje vial'),
(15, 'Pasaje'),
(16, 'Peatonal'),
(17, 'Periferico'),
(18, 'Privada'),
(19, 'Prolongacion'),
(20, 'Retorno'),
(21, 'Viaducto'),
(22, 'Ninguno'),
(23, 'Carretera'),
(24, 'Brecha'),
(25, 'Camino'),
(26, 'Terraceria'),
(27, 'Vereda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cp`
--

CREATE TABLE `cp` (
  `d_codigo` int(11) DEFAULT NULL,
  `c_mnpio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cp`
--

INSERT INTO `cp` (`d_codigo`, `c_mnpio`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL COMMENT 'ID del rol',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre del rol',
  `descripcion` varchar(255) NOT NULL COMMENT 'Descripcion del rol'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabla para almacenar los roles de los usuarios';

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`, `descripcion`) VALUES
(1, 'ADMINISTRADOR', 'Todos los permisos de administrador'),
(2, 'MUNICIPIO', 'Pueden ingresar los datos mediante la CURP'),
(3, 'SUPERVISOR', 'Supervisa las operaciones de los almacenes pero no puede realizar capturas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'id del usuario',
  `nombres` varchar(100) NOT NULL COMMENT 'Nombre del usuario',
  `apellido_paterno` varchar(100) NOT NULL COMMENT 'Apellido paterno del usuario',
  `apellido_materno` varchar(100) NOT NULL COMMENT 'Apellido materno del usuario',
  `usuario` varchar(100) NOT NULL COMMENT 'Nombre de usuario',
  `contrasena` varchar(100) NOT NULL COMMENT 'Contrasena del usuario',
  `id_rol` int(11) NOT NULL DEFAULT 2 COMMENT 'Rol del usuario',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de registro del usuario',
  `estado` enum('ACTIVO','INACTIVO') NOT NULL DEFAULT 'ACTIVO' COMMENT 'Estado del usuario',
  `clave_municipio` int(11) NOT NULL,
  `silla_ruedas` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de sillas de ruedas',
  `sillapci` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de sillas pci',
  `sillapca` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de sillas pca',
  `sillabath` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de sillas de baño',
  `andadera` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de andaderas',
  `baston` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de bastones',
  `baston4` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de bastones de 4 puntos',
  `auditivo` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de aparatos auditivos',
  `muleta` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de muletas',
  `optometrico` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de aparatos optometricos.',
  `diadema` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de aparatos auditivos diadema.',
  `ruedas_infantil` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero de sillas de ruedas infantiles.',
  `baston_invidente` int(11) NOT NULL DEFAULT 0 COMMENT 'Numero bastones plegables para invidentes.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Tabla para almacenar los usuarios de la institución';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellido_paterno`, `apellido_materno`, `usuario`, `contrasena`, `id_rol`, `fecha_registro`, `estado`, `clave_municipio`, `silla_ruedas`, `sillapci`, `sillapca`, `sillabath`, `andadera`, `baston`, `baston4`, `auditivo`, `muleta`, `optometrico`, `diadema`, `ruedas_infantil`, `baston_invidente`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'admin', '$2y$10$TyT7T9CA4hUBlk5hYBHkhukdsq0Rsn3xaBg7rixP8c9Ycy.z.dOKe', 1, '2024-05-27 22:58:42', 'ACTIVO', 53, 1, 2, 3, 4, 5, 6, 7, 8, 2, 5, 0, 1, 1),
(59, 'Municipio', 'Municipio', 'Municipio', 'municipio', '$2y$10$ZH//kQ4enndpHGL0Kyh0/.ucOGmurYk0AJ6sgSQ1DaJe170hkjZ5W', 2, '2025-03-22 00:48:32', 'ACTIVO', 1, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13),
(60, 'Supervisor', 'Supervisor', 'Supervisor', 'supervisor', '$2y$10$tyo7lT99amDoaZMueV4QH.QCtvV8.xCF0PjFbw4H46WegmHEzbNyC', 3, '2025-03-31 20:20:00', 'ACTIVO', 1, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apoyado`
--
ALTER TABLE `apoyado`
  ADD PRIMARY KEY (`id_apoyado`),
  ADD KEY `Id_Cat_Tip_Via` (`Id_Cat_Tip_Via`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_apoyo` (`id_apoyo`);

--
-- Indices de la tabla `apoyos`
--
ALTER TABLE `apoyos`
  ADD PRIMARY KEY (`id_apoyo`);

--
-- Indices de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD PRIMARY KEY (`id_beneficiario`),
  ADD KEY `Id_Cat_Tip_Via` (`Id_Cat_Tip_Via`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `bitacora_sesiones`
--
ALTER TABLE `bitacora_sesiones`
  ADD PRIMARY KEY (`id_bitacora_sesiones`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cat_tip_via`
--
ALTER TABLE `cat_tip_via`
  ADD PRIMARY KEY (`Id_Cat_Tip_Via`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apoyado`
--
ALTER TABLE `apoyado`
  MODIFY `id_apoyado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del apoyado', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  MODIFY `id_beneficiario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del beneficiado', AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `bitacora_sesiones`
--
ALTER TABLE `bitacora_sesiones`
  MODIFY `id_bitacora_sesiones` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la bitacora', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cat_tip_via`
--
ALTER TABLE `cat_tip_via`
  MODIFY `Id_Cat_Tip_Via` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del usuario', AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apoyado`
--
ALTER TABLE `apoyado`
  ADD CONSTRAINT `apoyado_ibfk_1` FOREIGN KEY (`Id_Cat_Tip_Via`) REFERENCES `cat_tip_via` (`Id_Cat_Tip_Via`),
  ADD CONSTRAINT `apoyado_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `apoyado_ibfk_3` FOREIGN KEY (`id_apoyo`) REFERENCES `apoyos` (`id_apoyo`);

--
-- Filtros para la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD CONSTRAINT `beneficiario_ibfk_1` FOREIGN KEY (`Id_Cat_Tip_Via`) REFERENCES `cat_tip_via` (`Id_Cat_Tip_Via`),
  ADD CONSTRAINT `beneficiario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `bitacora_sesiones`
--
ALTER TABLE `bitacora_sesiones`
  ADD CONSTRAINT `bitacora_sesiones_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
