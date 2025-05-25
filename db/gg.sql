-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2024 a las 06:44:55
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_producto` decimal(8,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total_producto` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `domiclio` varchar(100) NOT NULL,
  `iva` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `fecha` date NOT NULL,
  `ruta_factura` varchar(100) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_producto` decimal(8,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total_producto` decimal(12,2) NOT NULL,
  `orden_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `imagen`, `categoria`, `precio`, `stock`) VALUES
(1, 'Audifonos WHITE GG', 'Audifonos gaming con sonido envolvente 7.1', 'assets/Audifonos/A1.png', 'Audifonos', 1350.00, 43),
(2, 'Audifonos black mirror', 'Audifonos con almohadillas suaves y minimalistas', 'assets/Audifonos/A2.png', 'Audifonos', 1600.00, 54),
(3, 'Audifonos Dragon Fire GG', 'Audifonos con microfono integrado y supresion temporal de ruido', 'assets/Audifonos/A3.png', 'Audifonos', 1970.12, 54),
(4, 'Audífonos SuperBass', 'Audífonos con graves potentes y diseño elegante', 'assets/Audifonos/A4.png', 'Audifonos', 1299.99, 32),
(5, 'Audífonos Stealth 360', 'Audífonos inalámbricos con tecnología Bluetooth', 'assets/Audifonos/A5.png', 'Audifonos', 1750.50, 42),
(6, 'Audífonos Fury Blade', 'Audífonos con iluminación LED y control de volumen táctil', 'assets/Audifonos/A6.png', 'Audifonos', 1899.00, 39),
(7, 'Audífonos Noise Cancelling Pro', 'Audífonos con cancelación de ruido activa y batería de larga duración', 'assets/Audifonos/A7.png', 'Audifonos', 2499.99, 28),
(8, 'Audífonos Elite 900X', 'Audífonos con calidad de sonido premium y micrófono desmontable', 'assets/Audifonos/A8.png', 'Audifonos', 2199.00, 47),
(9, 'Audífonos Neon Beat', 'Audífonos con colores vibrantes y almohadillas ergonómicas', 'assets/Audifonos/A9.png', 'Audifonos', 1599.50, 56),
(10, 'Audífonos Pro X', 'Audífonos para gaming con sonido envolvente 3D y micrófono retráctil', 'assets/Audifonos/A10.png', 'Audifonos', 2899.99, 33),
(11, 'Control GGC-Armor', 'Control gaming con botones mecanicos, modo turbo y programación de macros', 'assets/Controles/C1.png', 'control', 899.00, 54),
(12, 'Control GGC-Dark Sepia', 'Control gaming inalambrico compatible con Xbox, dongle usb C y bateria de 600 mah', 'assets/Controles/C2.png', 'control', 599.00, 54),
(13, 'Control GGC-Essential', 'Control gaming inalambrico compatible con PC, Nintendo Switch, PS3 y Android con botones inferiores extra y para macros', 'assets/Controles/C3.png', 'control', 899.00, 54),
(14, 'Control GGC-Thunder', 'Control gaming inalambrico compatible con todas las plataformas, botones mecanicos y con triple conexión, alambrica, dongle USB C y BT', 'assets/Controles/C4.png', 'control', 1499.00, 54),
(15, 'Control GGC-Thunder Hit', 'Control gaming inalambrico comptabile con Xbox y Android', 'assets/Controles/C5.png', 'control', 499.00, 54),
(16, 'Control GGC-X66', 'Control gaming multiplataforma con joysticks de alta presición y gatillos responsivos', 'assets/Controles/C6.png', 'control', 1899.00, 54),
(17, 'Control GGC-XB', 'Control gaming alambrico comptatible con Xboz 360, One, Series S y PC', 'assets/Controles/C7.png', 'control', 1199.00, 54),
(18, 'Control GGC-Primal', 'Control gaming con botones mecanicos, gatillos adaptativos y triple conexión junto con botones mecánicos', 'assets/Controles/C8.png', 'control', 2199.00, 54),
(19, 'Control GGC-Tarvos', 'Control gaming compatible con Android y PC junto con conexión BT y botones extra en la parte inferior', 'assets/Controles/C9.png', 'control', 799.00, 54),
(20, 'Control GGC-PS', 'Control gaming compatible con PS3 yPS4 ', 'assets/Controles/C10.png', 'control', 899.00, 54),
(21, 'Gabinete Astro Galaxy GG', 'Gabinete con alta entrada de aire, organizacion de cables y RGB', 'assets/Gabinetes/G1.png', 'Gabinetes', 1820.00, 16),
(22, 'Gabinete Titan X', 'Gabinete de tamaño completo con soporte para refrigeración líquida', 'assets/Gabinetes/G2.png', 'Gabinetes', 2250.00, 23),
(23, 'Gabinete Phantom Strike', 'Gabinete con diseño agresivo y panel lateral transparente', 'assets/Gabinetes/G3.png', 'Gabinetes', 1980.00, 19),
(24, 'Gabinete Fortress Prime', 'Gabinete compacto con sistema de gestión de cables ocultos', 'assets/Gabinetes/G4.png', 'Gabinetes', 1560.50, 27),
(25, 'Gabinete Thunderstorm Pro', 'Gabinete de alto rendimiento con espacio para hasta 6 ventiladores', 'assets/Gabinetes/G5.png', 'Gabinetes', 2899.99, 14),
(26, 'Gabinete Eclipse Elite', 'Gabinete con paneles laterales de vidrio templado y RGB direccionable', 'assets/Gabinetes/G6.png', 'Gabinetes', 2499.00, 18),
(27, 'Gabinete Nova Crystal', 'Gabinete con iluminación LED RGB y soporte para tarjetas gráficas largas', 'assets/Gabinetes/G7.png', 'Gabinetes', 1799.00, 22),
(28, 'Gabinete X-Firestorm', 'Gabinete con diseño aerodinámico y compartimentos modulares', 'assets/Gabinetes/G8.png', 'Gabinetes', 2120.00, 20),
(29, 'Gabinete Horizon Blitz', 'Gabinete de torre media con múltiples puntos de montaje para unidades', 'assets/Gabinetes/G9.png', 'Gabinetes', 1690.50, 25),
(30, 'Gabinete Phoenix Fury', 'Gabinete de alta resistencia con construcción de acero de grado industrial', 'assets/Gabinetes/G10.png', 'Gabinetes', 3250.00, 17),
(31, 'Teclado GGK-Chaos B', 'Teclado gaming RGB, en color negro con formato 60% con switches RED ', 'assets/Teclados/T1.png', 'teclado', 1399.00, 54),
(32, 'Teclado GGK-Chaos W', 'Teclado gaming RGB, en color blanco con formato 60% con switches BLUE', 'assets/Teclados/T2.png', 'teclado', 1399.00, 54),
(33, 'Teclado GGK-Deimos W', 'Teclado gaming RGB, en color blanco con formato 100% con switches BROWN', 'assets/Teclados/T3.png', 'teclado', 1599.00, 54),
(34, 'Teclado GGK-Deimos B', 'Teclado gaming RGB, en color negro con formato 100% con switches BLUE', 'assets/Teclados/T4.png', 'teclado', 1599.00, 54),
(35, 'Teclado GGK-Defender', 'Teclado gaming RGB de formato TKL con reposamuñecas de plástico, controles multimedia y switches GREEN', 'assets/Teclados/T5.png', 'teclado', 1899.00, 54),
(36, 'Teclado GGK-Sumoner', 'Teclado gaming RGB de fomrato 100% con reposamuñecas de vinipiel relleno de memory foam, switches RED', 'assets/Teclados/T6.png', 'teclado', 2399.00, 54),
(37, 'Teclado GGK-Artis TKL', 'Teclado gaming RGB con cable desmontables y switches ópticos con botones dedicados para realizar macros o asignaciones personalizadas', 'assets/Teclados/T7.png', 'teclado', 1699.00, 54),
(38, 'Teclado GGK-Asmodeo', 'Teclado gaming RGB de fomrato 100% con reposamuñecas de vinipiel relleno de memory foam, switches ópticos y controles multimedia, switches BROWN', 'assets/Teclados/T8.png', 'teclado', 2799.00, 54),
(39, 'Teclado GGK-Gecko Born', 'Teclado gaming RGB en formato TKL, inamalmbricos, con controles múltimedia y botones para macros o nuevas asignaciones, switches BLUE', 'assets/Teclados/T9.png', 'teclado', 2099.00, 54),
(40, 'Teclado GGK-Hydra', 'Teclado gaming RGB con switches RED mecanicos en formato 100%, switches GREEN', 'assets/Teclados/T10.png', 'teclado', 1199.00, 54),
(41, 'Mouse GeckoGrip Pro', 'Mouse gaming profesional con sensor óptico de alta precisión', 'assets/Mouse/M1.png', 'mouse', 749.00, 17),
(42, 'Mouse VenomTail', 'Mouse gaming de alta gama con ajuste de peso y botones programables', 'assets/Mouse/M2.png', 'mouse', 1199.00, 21),
(43, 'Mouse StealthFang', 'Mouse gaming silencioso con tecnología de reducción de ruido', 'assets/Mouse/M3.png', 'mouse', 999.00, 27),
(44, 'Mouse PulseStrike', 'Mouse gaming de perfil bajo con tecnología inalámbrica de baja latencia', 'assets/Mouse/M4.png', 'mouse', 699.00, 12),
(45, 'Mouse FrostBite', 'Mouse gaming robusto con interruptores mecánicos y macros programables', 'assets/Mouse/M5.png', 'mouse', 1299.00, 19),
(46, 'Mouse BlazeGlide', 'Mouse gaming ergonómico con luces RGB', 'assets/Mouse/M6.png', 'mouse', 1049.00, 31),
(47, 'Mouse EmberClaw', 'Mouse gaming con diseño ergonómico y acabado antideslizante', 'assets/Mouse/M7.png', 'mouse', 999.00, 18),
(48, 'Mouse GeckoFury', 'Mouse gaming con iluminación LED y cable trenzado para mayor durabilidad', 'assets/Mouse/M8.png', 'mouse', 1399.00, 11),
(49, 'Mouse ShadowSprint', 'Mouse gaming con acabado brillante y deslizadores de teflón para movimientos suaves', 'assets/Mouse/M9.png', 'mouse', 1199.00, 20),
(50, 'Mouse InfernoGrip', 'Mouse gaming con sensor de alta velocidad y 12 botones laterales programables', 'assets/Mouse/M10.png', 'mouse', 2099.00, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `direccion`, `telefono`, `email`) VALUES
(1, 'richilm', '$2y$10$pvamNLGJ3.jOcwKqGbOjoegFtHNqMTtiYdWvC0XSBsEjzPLvpn8i6', 'Cuautitlan', '5522132454', 'fanwindygirk.rlom@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_compra`,`id_usuario`,`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_pedido`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`,`id_usuario`,`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `factura` (`id_pedido`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
