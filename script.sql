-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2023 a las 20:26:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
    `id`         int(11)      NOT NULL,
    `id_session` varchar(255) NOT NULL,
    `id_product` int(11)      NOT NULL,
    `quantity`   int(11)      NOT NULL DEFAULT 1,
    `created_at` date         NOT NULL DEFAULT curdate()
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
    `created_at` date        NOT NULL DEFAULT curdate(),
    `img`        varchar(1000)        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `img`)
VALUES (1, 'Ceviches', '2023-10-31',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701183503/Categories/jogjypfilphhcvtjxbya.jpg'),
       (2, 'Fritos', '2023-10-31',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701183510/Categories/kxubundun8zyfqwbir58.jpg'),
       (3, 'Arroz', '2023-11-04',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701183516/Categories/rxavguv7uunl4bfetzv5.jpg'),
       (4, 'Sudados', '2023-11-04',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701183528/Categories/q6ypwcfdtemfiwdosb0x.jpg'),
       (5, 'Chicharrón', '2023-11-04',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701183551/Categories/cwbp9ayycamoq9dyrjvg.jpg'),
       (6, 'Rondas', '2023-11-11',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701183558/Categories/godddqwbpo6osptdjr4y.jpg'),
       (7, 'Fusiones', '2023-11-11',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701183564/Categories/gjr6yjqgdjlwmajp4ybe.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order`
--

CREATE TABLE `order`
(
    `id`           int(11) NOT NULL,
    `user_id`      int(11)          DEFAULT NULL,
    `payment_id`   int(11)          DEFAULT NULL,
    `total`        decimal(10, 0)   DEFAULT NULL,
    `created_at`   date    NOT NULL DEFAULT curdate(),
    `order_status` varchar(11)      DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order`
--

INSERT INTO `order` (`id`, `user_id`, `payment_id`, `total`, `created_at`, `order_status`)
VALUES (21, 22, 1319897481, 60, '2023-12-01', '1'),
       (22, 22, 1316137044, 85, '2023-12-03', '1');

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
VALUES (30, 21, 13, 1),
       (31, 21, 3, 1),
       (32, 22, 4, 1),
       (33, 22, 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_status`
--

CREATE TABLE `order_status`
(
    `id`     int(11)     NOT NULL,
    `status` varchar(20) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_status`
--

INSERT INTO `order_status` (`id`, `status`)
VALUES (1, 'En Revisión'),
       (2, 'Pagado'),
       (3, 'Rechazado'),
       (4, 'Enviado'),
       (5, 'Recibido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE `payment`
(
    `id`      int(11)      NOT NULL,
    `name`    varchar(255) NOT NULL,
    `receipt` text         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`id`, `name`, `receipt`)
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
    `name`        varchar(200)   NOT NULL DEFAULT '',
    `description` varchar(255)            DEFAULT '',
    `image`       varchar(255)            DEFAULT '',
    `price`       decimal(10, 0) NOT NULL DEFAULT 0,
    `active`      tinyint(1)              DEFAULT 1,
    `created_at`  date           NOT NULL DEFAULT curdate(),
    `discount`    decimal(10, 0)          DEFAULT 0
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `id_category`, `name`, `description`, `image`, `price`, `active`, `created_at`, `discount`)
VALUES (1, 1, 'CEVICHE DE CABALLA', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134609/img/ceviche_de_caballa_pehlql.jpg', 20, 1,
        '2023-10-31', 0),
       (2, 1, 'CEVICHE DE CABALLA', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134609/img/ceviche_de_caballa_pehlql.jpg', 35, 1,
        '2023-10-31', 0),
       (3, 1, 'CEVICHE DE FILETE', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134600/img/ceviche_de_filete_mariscos_djulg5.jpg', 30,
        1, '2023-11-08', 0),
       (4, 1, 'CEVICHE DE FILETE', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134600/img/ceviche_de_filete_mariscos_djulg5.jpg', 45,
        1, '2023-11-08', 0),
       (5, 1, 'CEVICHE MIXTO', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134600/img/ceviche_mixto_ixchq3.jpg', 25, 1,
        '2023-11-08', 0),
       (6, 1, 'CEVICHE MIXTO', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134600/img/ceviche_mixto_ixchq3.jpg', 40, 1,
        '2023-11-08', 0),
       (7, 1, 'CEVICHE DE MARISCOS', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134600/img/ceviche_de_mariscos_oaat80.jpg', 30, 1,
        '2023-11-08', 0),
       (8, 1, 'CEVICHE DE MARISCOS', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134600/img/ceviche_de_mariscos_oaat80.jpg', 45, 1,
        '2023-11-08', 0),
       (9, 1, 'CEVICHE DE FILETE + MARISCOS', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134601/img/Ceviche_de_filete_hg8oky.jpg', 30, 1,
        '2023-11-08', 0),
       (10, 1, 'CEVICHE DE FILETE + MARISCOS', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134601/img/Ceviche_de_filete_hg8oky.jpg', 45, 1,
        '2023-11-08', 0),
       (12, 2, 'CACHEMA', 'FUENTE',
        'https://caracol.com.co/resizer/bFlfSwFIZLVn2knJIvTdxoMeJsI=/768x576/filters:format(jpg):quality(70)/cloudfront-us-east-1.images.arcpublishing.com/prisaradioco/5ECEWWZR4NL3LJDQIEASH4YHAQ.jpg',
        35, 1, '2023-11-11', 0),
       (13, 2, 'PEJE', 'PERSONAL',
        'https://www.lavoz.com.ar/resizer/NwggIX3XrPLCTDVmYKgbWQfs14Q=/980x640/smart/filters:quality(75):format(webp)/cloudfront-us-east-1.images.arcpublishing.com/grupoclarin/C6HROYVD6RHGBI2WCMCOV4WZEM.jpg',
        30, 1, '2023-11-11', 0),
       (14, 2, 'PEJE', 'FUENTE',
        'https://www.lavoz.com.ar/resizer/NwggIX3XrPLCTDVmYKgbWQfs14Q=/980x640/smart/filters:quality(75):format(webp)/cloudfront-us-east-1.images.arcpublishing.com/grupoclarin/C6HROYVD6RHGBI2WCMCOV4WZEM.jpg',
        50, 1, '2023-11-11', 0),
       (15, 2, 'CABRILLA', 'PERSONAL',
        'https://th.bing.com/th/id/R.d90de52d92f6d8b9c9410b83d3286988?rik=lHJU%2bJbiXPEvWw&pid=ImgRaw&r=0', 30, 1,
        '2023-11-11', 0),
       (16, 2, 'CABRILLA', 'FUENTE', 'https://www.recetaspanama.com/base/stock/Recipe/55-image/55-image_web.jpg', 50, 1,
        '2023-11-11', 0),
       (17, 3, 'ARROZ CON MARISCOS', 'PERSONAL',
        'https://fthmb.tqn.com/d70E5NtVuE0jB5apvk1Lj6Nd6nY=/3865x2576/filters:fill(auto,1)/hispanic-cuisine--arroz-con-pollo-in-pan--horizontal-top-view-602328680-5a9d40e0c5542e00365cdf8a.jpg',
        20, 1, '2023-11-11', 0),
       (18, 3, 'ARROZ CON MARISCOS', 'FUENTE',
        'https://d1uz88p17r663j.cloudfront.net/original/508e90cc752880608500ad1646fd510e_ARROZ-BASICO-RECEITAS-NESTLE.jpg',
        35, 1, '2023-11-11', 0),
       (19, 3, 'CHAUFA CON MARISCOS', 'PERSONAL',
        'https://th.bing.com/th/id/R.8626b4d39157a9573a7c67f4b580c8c7?rik=oXHWatsJWjJw1A&pid=ImgRaw&r=0', 20, 1,
        '2023-11-11', 0),
       (20, 3, 'CHAUFA CON MARISCOS', 'FUENTE',
        'https://th.bing.com/th/id/R.af72ed98d60742cfac4210eae405b9ad?rik=E3uONJC3k2LVvA&riu=http%3a%2f%2fcocinaaldia.com%2fwp-content%2fuploads%2f2016%2f06%2fPlatanos-Maduros.jpg&ehk=xN1Zhgfx22PNw7QPKMhDM0xQFjzDCCsOD9crlZyuQIM%3d&risl=&pid=ImgRaw&r=0',
        35, 1, '2023-11-11', 0),
       (21, 4, 'SUDADO DE PEJE (Arroz + Cancha)', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134607/img/Sudado_de_peje_rmti2r.jpg', 30, 1,
        '2023-11-11', 0),
       (22, 4, 'SUDADO DE PEJE  (Arroz + Cancha)', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134607/img/Sudado_de_peje_rmti2r.jpg', 50, 1,
        '2023-11-11', 0),
       (23, 4, 'SUDADO DE CABRILLA', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134606/img/Sudado_de_cabrilla_q6ejwc.jpg', 30, 1,
        '2023-11-11', 0),
       (24, 4, 'SUDADO DE CABRILLA', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134606/img/Sudado_de_cabrilla_q6ejwc.jpg', 50, 1,
        '2023-11-11', 0),
       (25, 4, 'PARIHUELAS', 'PERSONAL',
        'https://th.bing.com/th/id/R.d90de52d92f6d8b9c9410b83d3286988?rik=lHJU%2bJbiXPEvWw&pid=ImgRaw&r=0', 40, 1,
        '2023-11-11', 0),
       (26, 4, 'PARIHUELAS', 'FUENTE', 'https://www.recetaspanama.com/base/stock/Recipe/55-image/55-image_web.jpg', 65,
        1, '2023-11-11', 0),
       (27, 4, 'OTROS PESCADOS', 'PERSONAL',
        'https://fthmb.tqn.com/d70E5NtVuE0jB5apvk1Lj6Nd6nY=/3865x2576/filters:fill(auto,1)/hispanic-cuisine--arroz-con-pollo-in-pan--horizontal-top-view-602328680-5a9d40e0c5542e00365cdf8a.jpg',
        20, 1, '2023-11-11', 0),
       (28, 4, 'OTROS PESCADOS', 'FUENTE',
        'https://d1uz88p17r663j.cloudfront.net/original/508e90cc752880608500ad1646fd510e_ARROZ-BASICO-RECEITAS-NESTLE.jpg',
        35, 1, '2023-11-11', 0),
       (29, 5, 'CHICHARRÓN DE PESCADO', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134601/img/Chicharron_de_pescado_tp4cvv.jpg', 25, 1,
        '2023-11-11', 0),
       (30, 5, 'CHICHARRÓN DE PESCADO', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134601/img/Chicharron_de_pescado_tp4cvv.jpg', 40, 1,
        '2023-11-11', 0),
       (31, 5, 'CHICHARRÓN DE CHANCHO', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134601/img/chicharron_de_chancho_copl7x.jpg', 30, 1,
        '2023-11-11', 0),
       (32, 5, 'CHICHARRÓN DE CHANCHO', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134601/img/chicharron_de_chancho_copl7x.jpg', 45, 1,
        '2023-11-11', 0),
       (33, 5, 'CHICHARRÓN DE POLLO', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134602/img/chicharron_de_pollo_fhgvnu.jpg', 25, 1,
        '2023-11-11', 0),
       (34, 5, 'CHICHARRÓN DE POLLO', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134602/img/chicharron_de_pollo_fhgvnu.jpg', 40, 1,
        '2023-11-11', 0),
       (35, 5, 'CHICHARRÓN MIXTO', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134603/img/CHICHARRON_MIXTO_ghtgrs.jpg', 35, 1,
        '2023-11-11', 0),
       (36, 5, 'CHICHARRÓN MIXTO', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134603/img/CHICHARRON_MIXTO_ghtgrs.jpg', 50, 1,
        '2023-11-11', 0),
       (37, 5, 'CHICHARRÓN DE PESCADO + MARISCOS', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134603/img/Mariscos_pescaso_chicharron_vttewq.jpg', 30,
        1, '2023-11-11', 0),
       (38, 5, 'CHICHARRÓN DE PESCADO + MARISCOS', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134603/img/Mariscos_pescaso_chicharron_vttewq.jpg', 45,
        1, '2023-11-11', 0),
       (42, 6, 'RONDA MARINA (Ceviche + Arroz con mariscos + Chicharrón + Chifles + Salsa criolla)', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134605/img/ronda_marina1_nhgulb.jpg', 45, 1,
        '2023-11-11', 0),
       (43, 6, 'RONDA MARINA (Ceviche + Arroz con mariscos + Chicharrón + Chifles + Salsa criolla)', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134605/img/ronda_marina1_nhgulb.jpg', 65, 1,
        '2023-11-11', 0),
       (44, 6, 'RONDA EL CHINO', 'FUENTE',
        'https://th.bing.com/th/id/R.84ba5281045b008d6b3dd08f2f9ed271?rik=AippEAt3V0v4Zw&pid=ImgRaw&r=0', 60, 1,
        '2023-11-11', 0),
       (45, 6, 'RONDA CRIOLLA', 'PERSONAL',
        'https://th.bing.com/th/id/R.d90de52d92f6d8b9c9410b83d3286988?rik=lHJU%2bJbiXPEvWw&pid=ImgRaw&r=0', 40, 1,
        '2023-11-11', 0),
       (46, 6, 'RONDA CRIOLLA', 'FUENTE', 'https://www.recetaspanama.com/base/stock/Recipe/55-image/55-image_web.jpg',
        65, 1, '2023-11-11', 0),
       (47, 6, 'RONDA MAR Y TIERRA', 'FUENTE',
        'https://fthmb.tqn.com/d70E5NtVuE0jB5apvk1Lj6Nd6nY=/3865x2576/filters:fill(auto,1)/hispanic-cuisine--arroz-con-pollo-in-pan--horizontal-top-view-602328680-5a9d40e0c5542e00365cdf8a.jpg',
        60, 1, '2023-11-11', 0),
       (48, 7, 'CHANCHO + PATACONES + CHIFLES + SALSA CRIOLLA + CREMAS', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134603/img/fusion_1_awluqf.jpg', 30, 1, '2023-11-11',
        0),
       (49, 7, 'CHANCHO + PATACONES + CHIFLES + SALSA CRIOLLA + CREMAS', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134603/img/fusion_1_awluqf.jpg', 45, 1, '2023-11-11',
        0),
       (50, 7, 'CHANCHO + YUCAS DORADAS + CHIFLES + SALSA CRIOLLA + CREMAS', 'PERSONAL',
        'https://th.bing.com/th/id/R.84ba5281045b008d6b3dd08f2f9ed271?rik=AippEAt3V0v4Zw&pid=ImgRaw&r=0', 30, 1,
        '2023-11-11', 0),
       (51, 7, 'CHANCHO + YUCAS DORADAS + CHIFLES + SALSA CRIOLLA + CREMAS', 'FUENTE',
        'https://th.bing.com/th/id/R.d90de52d92f6d8b9c9410b83d3286988?rik=lHJU%2bJbiXPEvWw&pid=ImgRaw&r=0', 45, 1,
        '2023-11-11', 0),
       (52, 7, 'SECO DE CHAVELO + CARNE SECA', 'PERSONAL',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134606/img/seco_de_chabelo_mfbd0y.jpg', 30, 1,
        '2023-11-11', 0),
       (53, 7, 'SECO DE CHAVELO + CARNE SECA', 'FUENTE',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701134606/img/seco_de_chabelo_mfbd0y.jpg', 45, 1,
        '2023-11-11', 0),
       (54, 7, 'SECO DE CHAVELO + CHICHARRÓN DE CHANCHO + CHIFLES + SALSA CRIOLLA + CREMAS', 'PERSONAL',
        'https://www.recetaspanama.com/base/stock/Recipe/55-image/55-image_web.jpg', 35, 1, '2023-11-11', 0),
       (55, 7, 'SECO DE CHAVELO + CHICHARRÓN DE CHANCHO + CHIFLES + SALSA CRIOLLA + CREMAS', 'FUENTE',
        'https://fthmb.tqn.com/d70E5NtVuE0jB5apvk1Lj6Nd6nY=/3865x2576/filters:fill(auto,1)/hispanic-cuisine--arroz-con-pollo-in-pan--horizontal-top-view-602328680-5a9d40e0c5542e00365cdf8a.jpg',
        50, 1, '2023-11-11', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review`
(
    `id`      int(11)      NOT NULL,
    `user_id` int(11)        DEFAULT NULL,
    `commet`  varchar(200) NOT NULL,
    `rating`  decimal(10, 0) DEFAULT 0
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
       (2, 'client');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule`
--

CREATE TABLE `schedule`
(
    `id`         int(11)     NOT NULL,
    `day`        varchar(10) NOT NULL,
    `open_time`  time        NOT NULL DEFAULT current_timestamp(),
    `close_time` time        NOT NULL DEFAULT current_timestamp(),
    `created_at` timestamp   NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `schedule`
--

INSERT INTO `schedule` (`id`, `day`, `open_time`, `close_time`, `created_at`)
VALUES (1, 'Lunes', '09:00:00', '03:00:00', '2023-11-11 15:44:21'),
       (2, 'Martes', '09:00:00', '03:00:00', '2023-11-11 15:44:21'),
       (3, 'Miércoles', '09:00:00', '03:00:00', '2023-11-11 15:44:21'),
       (4, 'Jueves', '09:00:00', '03:00:00', '2023-11-11 15:44:21'),
       (5, 'Viernes', '09:00:00', '03:00:00', '2023-11-11 15:44:21'),
       (6, 'Sábado', '09:00:00', '03:00:00', '2023-11-11 15:44:21'),
       (7, 'Domingo', '09:00:00', '03:00:00', '2023-11-11 15:44:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user`
(
    `id`         int(11)      NOT NULL,
    `id_role`    int(11)               DEFAULT 2,
    `address`    varchar(255)          DEFAULT '',
    `name`       varchar(50)           DEFAULT '',
    `last_name`  varchar(50)           DEFAULT '',
    `email`      varchar(100)          DEFAULT '',
    `password`   varchar(255)          DEFAULT '',
    `img`        varchar(250) NOT NULL DEFAULT 'https://res.cloudinary.com/di9iaerbb/image/upload/v1701239516/Users/user_up68gx.png',
    `active`     tinyint(1)            DEFAULT 1,
    `created_at` date         NOT NULL DEFAULT curdate(),
    `phone`      varchar(20)           DEFAULT ''
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `id_role`, `address`, `name`, `last_name`, `email`, `password`, `img`, `active`, `created_at`,
                    `phone`)
VALUES (22, 2, 'Piura', 'Jhair', 'Mendoza', 'jhair@gmail.com', 'e10adc3949ba59abbe56e057f20f883e',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701239516/Users/user_up68gx.png', 1, '2023-12-01',
        '904313651'),
       (23, 1, 'Piura', 'Jhair Steven', 'Admin', 'Jhairmendoza2003@gmail.com', 'e10adc3949ba59abbe56e057f20f883e',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701239516/Users/user_up68gx.png', 1, '2023-12-01',
        '987654320'),
       (24, 2, 'Sullana', 'Liz', 'Sosa', 'liz@gmail.com', 'e10adc3949ba59abbe56e057f20f883e',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701239516/Users/user_up68gx.png', 1, '2023-12-02',
        '123456789'),
       (25, 2, 'Piura', 'Cliente', 'Zeta', 'cliente@cliente.com', 'e10adc3949ba59abbe56e057f20f883e',
        'https://res.cloudinary.com/di9iaerbb/image/upload/v1701239516/Users/user_up68gx.png', 1, '2023-12-03',
        '987654321');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
    ADD PRIMARY KEY (`id`),
    ADD KEY `cart_ibfk_2` (`id_product`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `category_pk` (`name`);

--
-- Indices de la tabla `order`
--
ALTER TABLE `order`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `order_product`
--
ALTER TABLE `order_product`
    ADD PRIMARY KEY (`id`),
    ADD KEY `order_id` (`order_id`),
    ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `order_status`
--
ALTER TABLE `order_status`
    ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
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
    ADD KEY `id_address` (`address`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 117;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT de la tabla `order`
--
ALTER TABLE `order`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 29;

--
-- AUTO_INCREMENT de la tabla `order_product`
--
ALTER TABLE `order_product`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 34;

--
-- AUTO_INCREMENT de la tabla `order_status`
--
ALTER TABLE `order_status`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 70;

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
-- AUTO_INCREMENT de la tabla `schedule`
--
ALTER TABLE `schedule`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
    ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`);

--
-- Filtros para la tabla `order`
--
ALTER TABLE `order`
    ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
    ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
