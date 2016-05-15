-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 15 2016 г., 20:18
-- Версия сервера: 5.6.14
-- Версия PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `intersoglabs2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `albums`
--

INSERT DELAYED INTO `albums` (`id`, `users_id`, `name`, `active`, `created_at`, `modified_at`) VALUES
(1, 3, 'Wedding', 1, '2016-04-08 15:56:02', '2016-04-14 10:16:40'),
(2, 5, 'Wedding', 1, '2016-04-14 09:45:11', '2016-04-14 10:20:04'),
(3, 5, 'Happy Birthday', 1, '2016-04-14 09:45:53', NULL),
(4, 5, 'Happy Birthday', 1, '2016-04-14 09:45:58', NULL),
(5, 5, 'Wedding', 1, '2016-04-14 09:46:09', NULL),
(6, 5, 'Paty', 1, '2016-04-14 09:46:37', NULL),
(7, 3, 'New Year', 1, '2016-04-14 09:47:13', NULL),
(8, 3, 'Session', 1, '2016-04-14 09:47:29', NULL),
(9, 3, 'Corparat...', 1, '2016-04-14 09:47:39', '2016-04-14 09:48:25'),
(10, 7, 'Testing', 1, '2016-04-15 05:18:35', '2016-05-06 18:37:08'),
(11, 3, 'New Wedding', 1, '2016-04-16 18:03:54', '2016-04-16 19:59:46'),
(14, 3, 'Oldd Wedding', 1, '2016-04-26 19:53:34', '2016-04-26 19:56:25');

-- --------------------------------------------------------

--
-- Структура таблицы `album_clients`
--

CREATE TABLE IF NOT EXISTS `album_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `albums_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `access` enum('read','grant') NOT NULL DEFAULT 'read',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `initiator` (`access`),
  KEY `albums_id` (`albums_id`,`users_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `album_clients`
--

INSERT DELAYED INTO `album_clients` (`id`, `albums_id`, `users_id`, `access`, `created_at`) VALUES
(1, 2, 4, 'read', '2016-05-06 18:51:36'),
(15, 1, 4, 'read', '2016-05-06 19:06:55'),
(16, 9, 4, 'read', '2016-05-06 19:06:55'),
(17, 7, 4, 'read', '2016-05-06 19:06:55'),
(18, 4, 4, 'read', '2016-05-06 19:06:55'),
(19, 10, 4, 'read', '2016-05-06 19:06:55'),
(20, 14, 4, 'read', '2016-05-06 19:06:55'),
(21, 11, 2, 'read', '2016-05-06 19:06:55'),
(22, 2, 2, 'read', '2016-05-06 19:06:55'),
(23, 6, 2, 'read', '2016-05-06 19:06:55'),
(24, 7, 2, 'read', '2016-05-06 19:06:55'),
(25, 3, 2, 'read', '2016-05-06 19:06:55'),
(26, 14, 2, 'read', '2016-05-06 19:06:55'),
(27, 1, 6, 'read', '2016-05-06 19:14:42'),
(28, 9, 6, 'read', '2016-05-06 19:14:42'),
(29, 7, 6, 'read', '2016-05-06 19:14:42'),
(30, 4, 3, 'read', '2016-05-06 19:14:42'),
(31, 10, 3, 'read', '2016-05-06 19:14:42'),
(32, 14, 7, 'read', '2016-05-06 19:14:42'),
(33, 1, 7, 'read', '2016-05-06 19:14:42');

-- --------------------------------------------------------

--
-- Структура таблицы `album_images`
--

CREATE TABLE IF NOT EXISTS `album_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `albums_id` int(10) unsigned NOT NULL,
  `image` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `albums_id` (`albums_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Дамп данных таблицы `album_images`
--

INSERT DELAYED INTO `album_images` (`id`, `albums_id`, `image`, `created_at`) VALUES
(1, 3, 'http://tut_kakoito_URL_1', '2016-04-21 05:30:21'),
(2, 5, 'http://tut_kakoito_URL_2', '2016-04-21 05:31:04'),
(3, 5, 'http://tut_kakoito_URL_3', '2016-04-21 05:31:27'),
(4, 3, 'http://tut_kakoito_URL_4', '2016-04-21 05:29:28'),
(5, 3, 'http://tut_kakoito_URL_5', '2016-04-21 05:29:58'),
(6, 5, 'http://tut_kakoito_URL_6', '2016-04-21 05:31:42'),
(7, 1, 'http://tut_kakoito_URL_7', '2016-04-21 05:35:02'),
(8, 1, 'http://tut_kakoito_URL_8', '2016-04-21 05:35:13'),
(9, 1, 'http://tut_kakoito_URL_9', '2016-04-21 05:35:26'),
(10, 3, 'http://tut_kakoito_URL_10', '2016-04-22 11:06:16'),
(11, 3, 'http://ctotXXXXXdoljnobit', '2016-04-22 11:08:57'),
(12, 5, 'http://tut_kakoito_URL_12', '2016-04-22 14:25:28'),
(14, 5, 'http://tut_kakoito_URL_13', '2016-04-22 14:36:37'),
(15, 5, 'http://tut_kakoito_URL_15', '2016-04-22 14:51:27'),
(16, 6, 'http://tut_kakoito_URL_13', '2016-04-22 14:53:53'),
(17, 5, 'http://tut_kakoito_URL_17', '2016-04-22 14:58:59'),
(20, 1, 'http://tut_kakoito_URL_177', '2016-05-02 17:06:55'),
(21, 1, '../upload/IntersogPhoto.png', '2016-05-12 11:27:42'),
(22, 1, '../upload/cat_acrobat.png', '2016-05-12 11:29:14'),
(23, 1, '../upload/cat_acrobat.png', '2016-05-12 12:25:08'),
(24, 1, '../upload/IntersogPhoto.png', '2016-05-12 12:25:37'),
(25, 4, '../upload/U_7wslyM.png', '2016-05-12 13:32:29'),
(26, 4, '../upload/!bfoto_ru_otragatel3.jpg', '2016-05-12 22:23:25'),
(27, 4, '../upload/Диод01.jpg', '2016-05-12 22:28:01'),
(28, 4, '../upload/Screenshot_2015-07-28-23-07-41.png', '2016-05-14 13:24:29'),
(29, 4, '../upload/Screenshot_2015-07-28-23-07-41.png', '2016-05-14 13:25:43'),
(30, 4, '../upload/Screenshot_2015-07-28-23-07-41.png', '2016-05-14 13:30:15'),
(31, 4, '../upload/Снимок.PNG', '2016-05-14 13:30:42'),
(32, 4, '../upload/Снимок.PNG', '2016-05-14 15:45:35'),
(33, 4, '../upload/Снимок.PNG', '2016-05-14 15:46:32'),
(34, 4, '../upload/Снимок.PNG', '2016-05-14 15:47:00'),
(35, 4, '../upload/Снимок.PNG', '2016-05-14 15:54:45'),
(36, 4, '../upload/Снимок.PNG', '2016-05-14 16:01:14'),
(37, 4, '../upload/Снимок.PNG', '2016-05-14 16:03:10'),
(38, 4, '../upload/Снимок.PNG', '2016-05-14 16:11:13'),
(39, 4, '../upload/Снимок.PNG', '2016-05-14 16:16:15'),
(40, 4, '../upload/Снимок.PNG', '2016-05-14 16:25:05'),
(41, 4, '../upload/Screenshot_2015-07-28-23-07-41.png', '2016-05-14 16:31:51'),
(42, 4, '../upload/LGICO.jpg', '2016-05-14 17:26:11'),
(43, 4, '../upload/LGICO.jpg', '2016-05-14 17:39:11'),
(44, 4, '../upload/movian.jpg', '2016-05-14 17:41:08'),
(45, 4, '../upload/movian.jpg', '2016-05-15 06:51:33'),
(46, 4, '../upload/4/movian1.jpg', '2016-05-15 07:32:35'),
(47, 4, '../upload/4/movian2.jpg', '2016-05-15 07:32:43'),
(48, 4, '../upload/4/movian3.jpg', '2016-05-15 07:32:49'),
(49, 4, '../upload/albom_id_4/movian.jpg', '2016-05-15 07:37:09'),
(50, 4, '../upload/albom_id_4/movian1.jpg', '2016-05-15 08:06:45'),
(51, 4, '../upload/albom_id_4/09 - день 3й.jpg', '2016-05-15 10:14:23'),
(52, 4, '../upload/albom_id_4/09 - день 3й1.jpg', '2016-05-15 18:20:16');

-- --------------------------------------------------------

--
-- Структура таблицы `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `code` varchar(128) NOT NULL,
  `create_at` int(20) NOT NULL,
  `valid_time` int(20) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `auth`
--

INSERT DELAYED INTO `auth` (`id`, `user_id`, `code`, `create_at`, `valid_time`, `used`) VALUES
(1, 9, 'fNBZsXZczjju738NR9z1WX2WzxfBgp-z', 1462363650, 1462363710, 1),
(2, 9, '9n1CHGy9oDplq5wj9efogTQjunH13wBN', 1462378305, 1462378365, 1),
(3, 9, 'keTWMu4BmZkXGDFyp0YOeALsdxqUWbea', 1462378314, 1462378374, 1),
(4, 9, '9IHWyG9UeP_NIsQaKitx92BX6JiImmOM', 1462378322, 1462378382, 1),
(5, 9, 'w0mseA2bjTHkLnGHVOggfX2jhm2ql5gJ', 1462378841, 1462378901, 1),
(6, 9, 'dvwLn0y6gRjFsQ1rTylxOjM9vUnE0bGp', 1462378901, 1462378961, 1),
(7, 9, 'ZuIJO_F4_cCcm86fARrQO9Exh8X2McYy', 1462381257, 1462381317, 1),
(8, 9, '039Ub0GAE9k6TlOFb2O7vYSNAabIRYvK', 1462381743, 1462382343, 1),
(9, 9, 'FyrWYuJKPwU8pG_X6R0vmn8i7GkOwf94', 1462381800, 1462382400, 1),
(10, 1, 'ZDK7dPiWai6pjD7MmEOL5hYqAtzaQODX', 1462381837, 1462382437, 1),
(11, 1, 's32E_0PvhzwIWyxMphF4Gtr8DEvQ6FzR', 1462382621, 1462383221, 1),
(12, 1, 'zaSwlINEPCX-I65m5QRao4e4VQ36GZct', 1462386704, 1462387304, 1),
(13, 9, 'ISiZEu9GifQTA_0jMu8B1c1ytPR2tG4e', 1462390740, 1462391340, 1),
(14, 1, 'ZX6fz5g7PtLCIsf9UYp-ptLM7HwKn8-s', 1462390798, 1462390818, 1),
(15, 1, 'tsv7EEypHyvttEUZdkEtoXz-c-yCRma3', 1462390907, 1462390927, 1),
(16, 1, 'vLtr2hgccxDX4p09lXi0HCoxzoUbJCaB', 1462392481, 1462392501, 1),
(17, 1, '9ktGTVXu1k1iwGl0Qvr5BbGS5UsBVYk5', 1462392575, 1462392595, 1),
(18, 1, 'eg5Bm9A-XXqtDZH3IU4G5dS5tciW_ZPr', 1462392697, 1462392717, 1),
(19, 1, 'u-sNNZvwjplVhXeLCRwsctf9PIfPWEia', 1462392928, 1462392948, 1),
(20, 1, 'DECgEq1zdg5LOFnsi9SvE3Iprjh4pfAO', 1462393086, 1462393106, 1),
(21, 1, 'cA9IOngmQgaWmPXdjNAZY8Ny0X0B-7Yr', 1462393254, 1462393274, 1),
(22, 1, 'Sx01pOKUNuoc-s-Uj7AWbOQlltVvyAXr', 1462393450, 1462393470, 1),
(23, 9, '66_YnoSio123lUSXS9oudLltEO31J4GQ', 1462393661, 1462393681, 1),
(24, 9, 'Oo-cIDyKk9NgLC0T5oGtRsjCDwwSTFwD', 1462393775, 1462393795, 1),
(25, 9, 'GOSd4zZnu6SXGYs8nsxSvsTzwLe5TrZN', 1462393885, 1462393905, 1),
(26, 9, 'wx0ymcB76YMbhlFXsSFCwlpIJLHBwseR', 1462395369, 1462395389, 1),
(27, 9, 'bLWQRyH9iTWG87_s4bYgK1UdWPRUFnbZ', 1462395406, 1462395426, 1),
(28, 9, '6edproVMv9S-TozDxiiV1OA_CP4RgfLM', 1462396502, 1462396522, 1),
(29, 9, 'z52SfCGrrOqnxJnrpf2aoAKn0EiidzTy', 1462396600, 1462396620, 1),
(30, 9, 'YJesJ-slWImiwnQBMcef10uhrDoK_rD0videomiv@gmail.com', 1462398630, 1462398650, 1),
(31, 9, 'Os7rf181VP8CbCLNvqrZwoCU2fJug2J9videomivgmail.com', 1462399125, 1462399145, 1),
(32, 9, 'bt-ZVg1E3j_cHXSg0j15qfFfCuuJ-zbqvideomivgmail.com1462399327', 1462399327, 1462399347, 1),
(33, 9, 'gy3-UPyCF0rouYXuvfCtg9Vb9YJ-wrKL13defb74b84869348a4b27d16b9b739a', 1462400197, 1462400217, 1),
(34, 9, '4mNf6T0Bkvt9en506r5baQL4ERHohHiq9c9f8e9cbffcc05e835ea9db697cce3b', 1462400359, 1462400379, 1),
(35, 9, 'rFz_33YvxcAkaX3ezwokkjruEomkkB6S89c51b845a29a97aaebea0345b43acd9', 1462432794, 1462432814, 1),
(36, 9, '5i-wbWem81SfCWjxIKc4neIkON1XW1c87196491a29272d265683544d79dcf979', 1462438009, 1462449209, 0),
(37, 9, '9qubdcPtWft2ROprOWJawOz7IOcPSWrTc22e11be8eefdca1f0cb58a5c639a5c3', 1462451614, 1462452814, 1),
(38, 9, 'ModDNHNlg2KgiLyJ9M01OIVeA09-itgq9a4844b5badba74c1c17bf1b0faa8653', 1462455302, 1462456502, 1),
(39, 9, 'PdRKJwjSFpCCA3VOQWHfOD9_Smxm8Ekka7c0fcf64583958c9dd51e991b6f8cc7', 1462527526, 1462528726, 0),
(40, 9, '9ZRbw-rei_kWS35NfbHEXygkvTYKMCbs1df19754fdc662ce39cb2aab6254c368', 1462530464, 1462531664, 1),
(41, 9, '14E36PZ2z79lvgOZSJj2DQ0SR61KvLpb2d1922750fbe35980d21123963c09898', 1462551197, 1462551207, 0),
(42, 9, 'vNdwYjlJlTOcBdGwXxZp8SdnGDU9Rh-J09ef5c120035be44082d42b5de0056f6', 1462552112, 1462552122, 0),
(43, 9, 'Hksqlxxw-30yhiFdAdNcr63f-tfEQeFHa03db5608028ad7fe7656592f95cfeb2', 1462552144, 1462552154, 0),
(44, 9, 'R6SnwkhCAZa6xZbPuIwoTBCyweuZvBQn114801a656fbe03403ac9e9a976dc7cd', 1462552855, 1462552915, 0),
(45, 9, 'fZ6lJyDG8jsv6hBUjVwBgn_LYzVpruu1fc296f0c239d907947b7b18f0e2793f0', 1462553170, 1462553230, 0),
(46, 9, 'Ouu7pmES5-Naa04Fy_xKcomcdEuFeFBv0ad24d5ba75ac853b3363b45a5162dd6', 1462554352, 1462554952, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `status` enum('new','in progress','reject','done') NOT NULL DEFAULT 'new',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `order_images`
--

CREATE TABLE IF NOT EXISTS `order_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(10) unsigned NOT NULL,
  `album_images_id` int(10) unsigned NOT NULL,
  `type` enum('print','digital') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `album_images_id` (`album_images_id`),
  KEY `orders_id` (`orders_id`,`album_images_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` smallint(5) unsigned NOT NULL,
  `limitation` smallint(5) unsigned NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `resized_photos`
--

CREATE TABLE IF NOT EXISTS `resized_photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `size` varchar(32) DEFAULT NULL,
  `image_id` int(10) unsigned NOT NULL,
  `src` varchar(256) DEFAULT NULL,
  `status` enum('new','in_progress','complete','error') NOT NULL,
  `comment` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `resized_photos`
--

INSERT DELAYED INTO `resized_photos` (`id`, `size`, `image_id`, `src`, `status`, `comment`) VALUES
(1, '100x55', 40, '../upload/100px/Снимок_100px.jpg', 'complete', 'size 100px'),
(2, '400x221', 40, '../upload/400px/Снимок_400px.jpg', 'complete', 'size 400px'),
(3, '100x75', 41, '../upload/100px/Screenshot_2015-07-28-23-07-41_100px.jpg', 'complete', 'size 100px'),
(4, '400x300', 41, '../upload/400px/Screenshot_2015-07-28-23-07-41_400px.jpg', 'complete', 'size 400px'),
(5, '100x100', 42, '../upload/100px/LGICO_100px.jpg', 'complete', 'size 100px'),
(6, '400x400', 42, '../upload/400px/LGICO_400px.jpg', 'complete', 'size 400px'),
(7, '100x100', 43, '../upload/100px/LGICO_100px.jpg', 'complete', 'size 100px'),
(8, '400x400', 43, '../upload/400px/LGICO_400px.jpg', 'complete', 'size 400px'),
(9, '100x52', 44, '../upload/100px/movian_100px.jpg', 'complete', 'size 100px'),
(10, '400x210', 44, '../upload/400px/movian_400px.jpg', 'complete', 'size 400px'),
(11, '100x52', 45, '../upload/100px/movian_100px.jpg', 'complete', 'size 100px'),
(12, '400x210', 45, '../upload/400px/movian_400px.jpg', 'complete', 'size 400px'),
(13, '100x52', 46, '../upload/4/100px/movian1_100px.jpg', 'complete', 'size 100px'),
(14, '400x210', 46, '../upload/4/400px/movian1_400px.jpg', 'complete', 'size 400px'),
(15, '100x52', 47, '../upload/4/100px/movian2_100px.jpg', 'complete', 'size 100px'),
(16, '400x210', 47, '../upload/4/400px/movian2_400px.jpg', 'complete', 'size 400px'),
(17, '100x52', 48, '../upload/4/100px/movian3_100px.jpg', 'complete', 'size 100px'),
(18, '400x210', 48, '../upload/4/400px/movian3_400px.jpg', 'complete', 'size 400px'),
(19, '100x52', 49, '../upload/albom_id_4/100px/movian_100px.jpg', 'complete', 'size 100px'),
(20, '400x210', 49, '../upload/albom_id_4/400px/movian_400px.jpg', 'complete', 'size 400px'),
(21, '100x52', 50, '../upload/albom_id_4/100px/movian1_100px.jpg', 'complete', 'Width size 100px'),
(22, '400x210', 50, '../upload/albom_id_4/400px/movian1_400px.jpg', 'complete', 'Width size 400px'),
(23, '100x133', 51, '../upload/albom_id_4/100px/09 - день 3й_100px.jpg', 'complete', 'Width size 100px'),
(24, '400x533', 51, '../upload/albom_id_4/400px/09 - день 3й_400px.jpg', 'complete', 'Width size 400px'),
(25, '100x133', 52, '../upload/albom_id_4/100px/09 - день 3й1_100px.jpg', 'complete', 'Width size 100px'),
(26, '400x533', 52, '../upload/albom_id_4/400px/09 - день 3й1_400px.jpg', 'complete', 'Width size 400px');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('client','photographer','admin') NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `access_token` varchar(64) DEFAULT NULL,
  `token_timelife` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `users`
--

INSERT DELAYED INTO `users` (`id`, `role`, `name`, `email`, `password`, `phone`, `modified_at`, `created_at`, `access_token`, `token_timelife`) VALUES
(1, 'admin', 'Igor', 'admin@mymail.ru', '$2y$13$7Li3kyMYfJgmYKaFCxgrK.Y.tbkjwmU8i06BX4RRzxSwUlBai7mWO', '0677015800', '2016-05-12 13:29:04', '2016-04-08 15:52:14', '3lHQNFtRtpD32t8jc5jiDwdT_Fj6rNUM', 1463059744),
(2, 'client', 'Sergo', 'serg@mymail.ru', '$2y$13$xxVj6Cdi79r2PUF36QFBYuqIwzy/AZE8kkQ2fgUDlS13a5upknWZq', NULL, '2016-05-07 16:53:29', '2016-04-08 20:37:20', 'xXuTI93OcwO2TdUpeMxe_HbbrcPjUXqz', 1462640009),
(3, 'photographer', 'Alex', 'alex@mymail.ru', '$2y$13$R8aji/D3lDX/KDWku/Es7eaGmK4s.zMRTxkjfpxAE6vQn33GQfIJK', NULL, '2016-05-12 13:29:36', '2016-04-08 20:39:12', 'rymsysleKzJ3ttI5vccXQueI8wNJ9bAX', 1463059776),
(4, 'client', 'Den', 'den@mymail.ru', '$2y$13$GiZwGaBpPxI7SfPFChC0C.mG.THXIp36X8iCAScikyVavoyreNqnK', NULL, '2016-05-12 13:09:06', '2016-04-10 07:40:37', 'MuBEV5Q6PbNSi5nmI9iUZ9Om0vShC-cM', 1463058546),
(5, 'photographer', 'Vladik', 'vlad@mymail.ru', '$2y$13$LmGJcSHACyJw6H1XedhH1OnyfC.ktGHuRmMyQNVYZnb7dlSMZ890G', NULL, '2016-05-15 19:32:09', '2016-04-10 07:43:24', 'JwU6aHbNh-3nhlSZc2Ecwl_SyFrnBDwz', 1463340729),
(6, 'client', 'Griga', 'grig@mymail.ru', '$2y$13$Stof8A3TCbIYxhLuYaLbFu/sDT597dtDm9ASvytHUh7ARCRyYmPPm', NULL, '2016-05-07 14:37:49', '2016-04-10 07:45:13', 'mJGFbjvOJOzvHqrkQ6FxChZQ2JSpKtmA', 1462631869),
(7, 'photographer', 'Alexey', 'alexalex@mymail.ru', '12345alex', NULL, NULL, '2016-04-27 04:50:51', NULL, NULL),
(8, 'admin', 'Ivan', 'Ivavann@my.ru', '$2y$13$oGBgbytuNsUvm1NjGjgmlujYNmfd/nrRYfKaCuRE9zy0OQ9byUV3K', NULL, '2016-05-03 09:21:33', '2016-05-03 06:33:56', NULL, NULL),
(9, 'admin', 'Igor', 'videomiv@gmail.com', '$2y$13$/7FSKUBGyBpZWIjJYSPDSOQagZPqXM6VAwnYhwcjQNVFoaYtFk2I6', NULL, '2016-05-06 14:39:45', '2016-05-03 09:18:02', '0kc6U-oJ6NsePemzVmr1xjUnHzy_xNiB', 1462545585);

-- --------------------------------------------------------

--
-- Структура таблицы `user_packages`
--

CREATE TABLE IF NOT EXISTS `user_packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `packages_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`),
  KEY `packages_id` (`packages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `album_clients`
--
ALTER TABLE `album_clients`
  ADD CONSTRAINT `album_clients_ibfk_1` FOREIGN KEY (`albums_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_clients_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `album_images`
--
ALTER TABLE `album_images`
  ADD CONSTRAINT `album_images_ibfk_1` FOREIGN KEY (`albums_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_images`
--
ALTER TABLE `order_images`
  ADD CONSTRAINT `order_images_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_images_ibfk_2` FOREIGN KEY (`album_images_id`) REFERENCES `album_images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `resized_photos`
--
ALTER TABLE `resized_photos`
  ADD CONSTRAINT `resized_photos_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `album_images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_packages`
--
ALTER TABLE `user_packages`
  ADD CONSTRAINT `user_packages_ibfk_1` FOREIGN KEY (`packages_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_packages_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
