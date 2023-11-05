-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2023 a las 06:29:14
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `el_chino_cev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
                        `id` int(11) NOT NULL,
                        `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
                            `id` int(11) NOT NULL,
                            `name` varchar(20) NOT NULL,
                            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                            `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `img`) VALUES
                                                               (1, 'Bebidas', '2023-10-31 06:38:34', 'https://res.cloudinary.com/dk3uxckba/image/upload/v1699158083/b7jrjpz6gjskyzchel0u.jpg'),
                                                               (2, 'Ceviches', '2023-10-31 06:38:51', 'https://res.cloudinary.com/dk3uxckba/image/upload/v1699158083/sljv0o7lbjrumzg7eba1.jpg'),
                                                               (3, 'Entradas', '2023-11-05 04:11:29', 'https://res.cloudinary.com/dk3uxckba/image/upload/v1699158083/a3idodddn2rvekrqwo3d.jpg'),
                                                               (4, 'ssdsd', '2023-11-05 04:14:49', 'https://res.cloudinary.com/dk3uxckba/image/upload/v1699158083/odm2wduy1zp4oo8euti0.jpg'),
                                                               (5, 'sdfsdf', '2023-11-05 04:14:49', 'https://res.cloudinary.com/dk3uxckba/image/upload/v1699158084/mftogjar4lbuswlsb9kz.jpg\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order` (
                         `id` int(11) NOT NULL,
                         `user_id` int(11) DEFAULT NULL,
                         `payment_id` int(11) DEFAULT NULL,
                         `total` decimal(10,0) DEFAULT NULL,
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`id`, `user_id`, `payment_id`, `total`, `created_at`) VALUES
                                                                               (1, 1, 1, 100, '2023-10-31 06:59:58'),
                                                                               (2, 2, 2, 100, '2023-10-31 07:01:22'),
                                                                               (3, 1, 3, 300, '2023-10-31 07:01:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_product`
--

CREATE TABLE `order_product` (
                                 `id` int(11) NOT NULL,
                                 `order_id` int(11) DEFAULT NULL,
                                 `product_id` int(11) DEFAULT NULL,
                                 `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`) VALUES
                                                                             (1, 1, 1, 1),
                                                                             (2, 1, 2, 1),
                                                                             (3, 2, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE `payment_method` (
                                  `id` int(11) NOT NULL,
                                  `name` varchar(255) NOT NULL,
                                  `receipt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `receipt`) VALUES
                                                           (1, 'Yape', 'yape-receipt.png'),
                                                           (2, 'Plin', 'plin-receipt.png'),
                                                           (3, 'Yape', 'yape-receipt.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
                           `id` int(11) NOT NULL,
                           `id_category` int(11) DEFAULT NULL,
                           `name` varchar(30) NOT NULL,
                           `description` varchar(255) DEFAULT NULL,
                           `image` varchar(255) DEFAULT NULL,
                           `price` decimal(10,0) NOT NULL,
                           `active` tinyint(1) DEFAULT 1,
                           `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                           `stock` decimal(10,0) DEFAULT NULL,
                           `discount` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `id_category`, `name`, `description`, `image`, `price`, `active`, `created_at`, `stock`, `discount`) VALUES
                                                                                                                                      (1, 1, 'Agua', NULL, 'agua.png', 2, 1, '2023-10-31 07:03:03', 10, 0),
                                                                                                                                      (2, 2, 'Coca', NULL, 'ceviche.png', 10, 1, '2023-10-31 07:03:03', 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
                          `id` int(11) NOT NULL,
                          `user_id` int(11) DEFAULT NULL,
                          `review` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
                        `id` int(11) NOT NULL,
                        `role` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
                                      (1, 'admin'),
                                      (2, 'collaborator'),
                                      (3, 'client');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale`
--

CREATE TABLE `sale` (
                        `id` int(11) NOT NULL,
                        `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule`
--

CREATE TABLE `schedule` (
                            `id` int(11) NOT NULL,
                            `day` varchar(10) NOT NULL,
                            `open_time` timestamp NOT NULL DEFAULT current_timestamp(),
                            `close_time` timestamp NOT NULL DEFAULT current_timestamp(),
                            `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `id_role` int(11) DEFAULT NULL,
                        `id_address` int(11) DEFAULT NULL,
                        `name` varchar(50) DEFAULT NULL,
                        `last_name` varchar(50) DEFAULT NULL,
                        `email` varchar(100) DEFAULT NULL,
                        `password` varchar(255) DEFAULT NULL,
                        `active` tinyint(1) DEFAULT 1,
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `img` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `id_role`, `id_address`, `name`, `last_name`, `email`, `password`, `active`, `created_at`, `img`) VALUES
                                                                                                                                (1, 1, NULL, 'Jhair', 'Mendoza', 'jhair@gmail.com', '12345', 1, '2023-10-31 06:10:45', NULL),
                                                                                                                                (2, 1, NULL, 'Liz', 'Sosa', 'liz@gmail.com', '12345', 1, '2023-10-31 07:00:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_address`
--

CREATE TABLE `user_address` (
                                `id` int(11) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
    ADD PRIMARY KEY (`id`),
    ADD KEY `order_id` (`order_id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`),
    ADD KEY `payment_method_id` (`payment_id`);

--
-- Indices de la tabla `order_product`
--
ALTER TABLE `order_product`
    ADD PRIMARY KEY (`id`),
    ADD KEY `order_id` (`order_id`),
    ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `payment_method`
--
ALTER TABLE `payment_method`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
    ADD PRIMARY KEY (`id`),
    ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sale`
--
ALTER TABLE `sale`
    ADD PRIMARY KEY (`id`),
    ADD KEY `order_id` (`order_id`);

--
-- Indices de la tabla `schedule`
--
ALTER TABLE `schedule`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `user_pk` (`email`),
    ADD KEY `id_role` (`id_role`),
    ADD KEY `id_address` (`id_address`);

--
-- Indices de la tabla `user_address`
--
ALTER TABLE `user_address`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `order_product`
--
ALTER TABLE `order_product`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sale`
--
ALTER TABLE `sale`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `schedule`
--
ALTER TABLE `schedule`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_address`
--
ALTER TABLE `user_address`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
    ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Filtros para la tabla `order`
--
ALTER TABLE `order`
    ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment_method` (`id`);

--
-- Filtros para la tabla `order_product`
--
ALTER TABLE `order_product`
    ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
    ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
    ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
    ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `sale`
--
ALTER TABLE `sale`
    ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
    ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`),
    ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_address`) REFERENCES `user_address` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
