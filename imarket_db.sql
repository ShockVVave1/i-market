-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Гру 16 2018 р., 22:00
-- Версія сервера: 10.1.36-MariaDB
-- Версія PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `imarket_db`
--

-- --------------------------------------------------------

--
-- Структура таблиці `im_category`
--

CREATE TABLE `im_category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text,
  `image` text NOT NULL,
  `parent_cat` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `child_cat` text,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `im_category`
--

INSERT INTO `im_category` (`id`, `name`, `description`, `image`, `parent_cat`, `sort_order`, `status`, `child_cat`, `tag`) VALUES
(1, 'Ноутбуки', 'Описание ноутбуков', 'public/image/5c16b9bba1225завантаження.jpg', 0, 1, 1, 'true', 'Ноутбуки'),
(2, 'Смартфоны', 'Описание смартфонов', 'public/image/5c16b9fdd116cзавантаження (3).jpg', 0, 2, 1, NULL, 'Смартфоны'),
(3, 'Планшеты', 'Описание планшетов', 'public/image/5c16ba0dd8202завантаження (6).jpg', 0, 3, 1, NULL, 'Планшеты'),
(4, 'Бюджетные ноутбуки', 'Описание бюджетных ноутбуков', 'public/image/5c16b9cac0138завантаження (1).jpg', 1, 0, 1, NULL, 'Бюджетные_ноутбуки'),
(5, 'Игровой ноутбук', 'Описание игровых ноубуков', 'public/image/5c16b9e184bffзавантаження (2).jpg', 1, 0, 1, NULL, 'Игровой_ноутбук'),
(6, 'Ультрабуки', 'Описание ультрабуков', 'public/image/5c16b9ef36f40завантаження.jpg', 1, 0, 1, NULL, 'Ультрабуки');

-- --------------------------------------------------------

--
-- Структура таблиці `im_orders`
--

CREATE TABLE `im_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) NOT NULL,
  `products` text NOT NULL,
  `tel` varchar(20) NOT NULL,
  `message` text,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `im_product`
--

CREATE TABLE `im_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `tag` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `parent_cat` int(11) NOT NULL DEFAULT '0',
  `image` text,
  `description` text,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `im_product`
--

INSERT INTO `im_product` (`id`, `name`, `price`, `count`, `tag`, `status`, `parent_cat`, `image`, `description`, `date_add`) VALUES
(1, 'Ноутбук Lenovo', 1000, 50, 'Ноутбук_Lenovo', 1, 4, 'public/image/5c16ba8f655c1завантаження (1).jpg', 'Описание ноутбука', '2018-12-10 18:35:41'),
(2, 'Ноутбук Acer', 950, 1, 'Ноутбук_Acer', 1, 4, 'public/image/5c16ba8244c9dзавантаження.jpg', 'Описание Ноутбук Acer', '2018-12-10 18:38:05'),
(3, 'Ноутбук Lenovo 2', 1000, 50, 'Ноутбук_Lenovo', 1, 4, 'public/image/5c16ba9c0b3eeзавантаження (2).jpg', 'Описание ноутбука', '2018-12-10 18:35:41'),
(4, 'Ноутбук Lenovo 3', 1000, 50, 'Ноутбук_Lenovo', 1, 4, 'public/image/5c16babbbfc2aзавантаження.jpg', 'Описание ноутбука', '2018-12-10 18:35:41'),
(12, 'Ноутбук Yiii', 1400, 0, 'Ноутбук_Yiii', 1, 5, 'public/image/5c16bac492e11завантаження (1).jpg', 'Описание Ноутбук Yiii', '2018-12-16 12:00:29');

-- --------------------------------------------------------

--
-- Структура таблиці `im_users`
--

CREATE TABLE `im_users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `registration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `im_users`
--

INSERT INTO `im_users` (`id`, `login`, `password`, `registration`, `email`, `status`, `role`) VALUES
(5, 'login2', '$2y$10$ehEvhW6o1J3OIYs37JJFmulYkgJAiYtJZHxkDbPR2dcZRo6gS11m6', '2018-12-14 18:15:43', 'impald123@mail.ru', 1, 'admin');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `im_category`
--
ALTER TABLE `im_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `im_category_id_uindex` (`id`),
  ADD UNIQUE KEY `im_category_name_uindex` (`name`),
  ADD UNIQUE KEY `im_category_tag_uindex` (`tag`);

--
-- Індекси таблиці `im_orders`
--
ALTER TABLE `im_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `im_orders_id_uindex` (`id`);

--
-- Індекси таблиці `im_product`
--
ALTER TABLE `im_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `im_product_id_uindex` (`id`),
  ADD UNIQUE KEY `im_product_name_uindex` (`name`);

--
-- Індекси таблиці `im_users`
--
ALTER TABLE `im_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `im_users_id_uindex` (`id`),
  ADD UNIQUE KEY `im_users_email_uindex` (`email`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `im_category`
--
ALTER TABLE `im_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблиці `im_orders`
--
ALTER TABLE `im_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблиці `im_product`
--
ALTER TABLE `im_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблиці `im_users`
--
ALTER TABLE `im_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
