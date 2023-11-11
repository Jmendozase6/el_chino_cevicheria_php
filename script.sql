-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2023 a las 05:40:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `el_chino_cev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart`
(
    `id`       int(11) NOT NULL,
    `order_id` int(11) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category`
(
    `id`         int(11)     NOT NULL,
    `name`       varchar(20) NOT NULL,
    `created_at` timestamp   NOT NULL DEFAULT current_timestamp(),
    `img`        varchar(1000)        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `img`)
VALUES (1, 'Ceviches', '2023-10-31 06:38:34',
        'https://res.cloudinary.com/dgna2mogt/image/upload/v1699430316/El%20Chino%20Cevicher%C3%ADa/jekm5qlbdbgrsgk2qfwu.jpg'),
       (2, 'Sudados', '2023-10-31 06:38:51',
        'https://res.cloudinary.com/dgna2mogt/image/upload/v1699430283/El%20Chino%20Cevicher%C3%ADa/fqkfzttwijkcrqzxrjle.jpg'),
       (3, 'Parihuelas', '2023-11-05 04:11:29',
        'https://res.cloudinary.com/dgna2mogt/image/upload/v1699430282/El%20Chino%20Cevicher%C3%ADa/n8giq5eanky3cs3svt5h.jpg'),
       (4, 'Arroces', '2023-11-05 04:14:49',
        'https://res.cloudinary.com/dgna2mogt/image/upload/v1699430281/El%20Chino%20Cevicher%C3%ADa/b3sd5rrnxjvldnvokrb4.jpg'),
       (5, 'Acompañantes', '2023-11-05 04:14:49',
        'https://res.cloudinary.com/dgna2mogt/image/upload/v1699430182/El%20Chino%20Cevicher%C3%ADa/ecamikqksj0stkpcxfrg.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order`
(
    `id`         int(11)   NOT NULL,
    `user_id`    int(11)            DEFAULT NULL,
    `payment_id` int(11)            DEFAULT NULL,
    `total`      decimal(10, 0)     DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`id`, `user_id`, `payment_id`, `total`, `created_at`)
VALUES (1, 1, 1, 100, '2023-10-31 06:59:58'),
       (2, 2, 2, 100, '2023-10-31 07:01:22'),
       (3, 1, 3, 300, '2023-10-31 07:01:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_product`
--

CREATE TABLE `order_product`
(
    `id`         int(11) NOT NULL,
    `order_id`   int(11) DEFAULT NULL,
    `product_id` int(11) DEFAULT NULL,
    `quantity`   int(11) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`)
VALUES (1, 1, 1, 1),
       (2, 1, 2, 1),
       (3, 2, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE `payment_method`
(
    `id`      int(11)      NOT NULL,
    `name`    varchar(255) NOT NULL,
    `receipt` text         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `receipt`)
VALUES (1, 'Yape', 'yape-receipt.png'),
       (2, 'Plin', 'plin-receipt.png'),
       (3, 'Yape', 'yape-receipt.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product`
(
    `id`          int(11)        NOT NULL,
    `id_category` int(11)                 DEFAULT NULL,
    `name`        varchar(30)    NOT NULL,
    `description` varchar(255)            DEFAULT NULL,
    `image`       varchar(255)            DEFAULT NULL,
    `price`       decimal(10, 0) NOT NULL,
    `active`      tinyint(1)              DEFAULT 1,
    `created_at`  timestamp      NOT NULL DEFAULT current_timestamp(),
    `stock`       decimal(10, 0)          DEFAULT NULL,
    `discount`    decimal(10, 0)          DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `id_category`, `name`, `description`, `image`, `price`, `active`, `created_at`, `stock`,
                       `discount`)
VALUES (1, 1, 'Ceviche de conchas negras', '',
        'https://th.bing.com/th/id/R.1991a4853425268c841f4601290e56c2?rik=A7lw%2fU5ufiVezQ&pid=ImgRaw&r=0', 20, 1,
        '2023-10-31 07:03:03', 10, 0),
       (2, 1, 'Ceviche de filete', NULL,
        'https://s-media-cache-ak0.pinimg.com/originals/20/5c/01/205c010658835bfe3528861fb73db1bc.jpg', 20, 1,
        '2023-10-31 07:03:03', 10, 0),
       (3, 2, 'Sudado de merluza', NULL, 'https://comidasperuanas.net/wp-content/uploads/2020/10/Sudado-de-Pescado.jpg',
        30, 1, '2023-11-08 16:06:56', NULL, NULL),
       (4, 2, 'Sudado de cabrilla', NULL,
        'https://th.bing.com/th/id/R.8173c3cbc5874941065f5fdcd4d0dcf4?rik=Gwm9YA7o0jEyTw&riu=http%3a%2f%2fwww.acomerpescado.gob.pe%2fwp-content%2fuploads%2f2017%2f07%2f35774870440_c568f314dd_k.jpg&ehk=17NQHX%2bCEBRDEIaXgpxy1YdIvgNifyzcRFJ8o69MzDE%3d&risl=&pid=ImgR',
        30, 1, '2023-11-08 16:06:56', NULL, NULL),
       (5, 3, 'Parihuela', NULL,
        'https://th.bing.com/th/id/R.d90de52d92f6d8b9c9410b83d3286988?rik=lHJU%2bJbiXPEvWw&pid=ImgRaw&r=0', 25, 1,
        '2023-11-08 16:06:56', NULL, NULL),
       (6, 3, 'Parihuela 2', NULL, 'https://www.recetaspanama.com/base/stock/Recipe/55-image/55-image_web.jpg', 30, 1,
        '2023-11-08 16:06:56', NULL, NULL),
       (7, 4, 'Arroz con pollo', NULL,
        'https://fthmb.tqn.com/d70E5NtVuE0jB5apvk1Lj6Nd6nY=/3865x2576/filters:fill(auto,1)/hispanic-cuisine--arroz-con-pollo-in-pan--horizontal-top-view-602328680-5a9d40e0c5542e00365cdf8a.jpg',
        25, 1, '2023-11-08 16:06:56', NULL, NULL),
       (8, 4, 'Arroz simple', NULL,
        'https://d1uz88p17r663j.cloudfront.net/original/508e90cc752880608500ad1646fd510e_ARROZ-BASICO-RECEITAS-NESTLE.jpg',
        25, 1, '2023-11-08 16:06:56', NULL, NULL),
       (9, 5, 'Yucas', '',
        'https://th.bing.com/th/id/R.8626b4d39157a9573a7c67f4b580c8c7?rik=oXHWatsJWjJw1A&pid=ImgRaw&r=0', 5, 1,
        '2023-11-08 16:06:56', NULL, NULL),
       (10, 5, 'Plátano frito', '',
        'https://th.bing.com/th/id/R.af72ed98d60742cfac4210eae405b9ad?rik=E3uONJC3k2LVvA&riu=http%3a%2f%2fcocinaaldia.com%2fwp-content%2fuploads%2f2016%2f06%2fPlatanos-Maduros.jpg&ehk=xN1Zhgfx22PNw7QPKMhDM0xQFjzDCCsOD9crlZyuQIM%3d&risl=&pid=ImgRaw&r=0',
        4, 1, '2023-11-08 16:06:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review`
(
    `id`      int(11)      NOT NULL,
    `user_id` int(11) DEFAULT NULL,
    `review`  varchar(200) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role`
(
    `id`   int(11) NOT NULL,
    `role` varchar(30) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`id`, `role`)
VALUES (1, 'admin'),
       (2, 'collaborator'),
       (3, 'client');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale`
--

CREATE TABLE `sale`
(
    `id`       int(11) NOT NULL,
    `order_id` int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule`
--

CREATE TABLE `schedule`
(
    `id`         int(11)     NOT NULL,
    `day`        varchar(10) NOT NULL,
    `open_time`  timestamp   NOT NULL DEFAULT current_timestamp(),
    `close_time` timestamp   NOT NULL DEFAULT current_timestamp(),
    `created_at` timestamp   NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user`
(
    `id`         int(11)   NOT NULL,
    `id_role`    int(11)            DEFAULT NULL,
    `id_address` int(11)            DEFAULT NULL,
    `name`       varchar(50)        DEFAULT NULL,
    `last_name`  varchar(50)        DEFAULT NULL,
    `email`      varchar(100)       DEFAULT NULL,
    `password`   varchar(255)       DEFAULT NULL,
    `active`     tinyint(1)         DEFAULT 1,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `img`        varchar(1000)      DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `id_role`, `id_address`, `name`, `last_name`, `email`, `password`, `active`, `created_at`,
                    `img`)
VALUES (1, 1, NULL, 'Jhair', 'Mendoza', 'jhair@gmail.com', '12345', 1, '2023-10-31 06:10:45', 'cat.jpg'),
       (2, 1, NULL, 'Liz', 'Sosa', 'liz@gmail.com', '12345', 1, '2023-10-31 07:00:28', 'cat2.jpg'),
       (2, 1, NULL, 'Manuel', 'Antón', 'anton@gmail.com', '1', 1, '2023-10-31 07:00:28', 'cat.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_address`
--

CREATE TABLE `user_address`
(
    `id`      int(11)      NOT NULL,
    `user_id` int(11)      NOT NULL,
    `address` varchar(150) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT de la tabla `order_product`
--
ALTER TABLE `order_product`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

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

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
