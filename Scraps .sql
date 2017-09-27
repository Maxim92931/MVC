-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 27 2017 г., 20:45
-- Версия сервера: 5.7.19-0ubuntu0.17.04.1
-- Версия PHP: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Scraps`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Files`
--

CREATE TABLE `Files` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `login`, `password`, `name`, `age`, `description`, `photo`) VALUES
(74, 'test', '$2y$10$v6h3V5CIjQYpu.Y7m6WZnu9HEwAsLdMvAg66gptzv8WR5WvIlvbby', 'Name1', 25, 'fghfghgfhf', '465.jpg'),
(75, 'test5', '$2y$10$6w0Hy5h.guSnvUDi/3V4geHJHUROYLb.xGdv9CJArwPYBNmfFSg.O', 'Name2', 17, 'fgjfgjghj', ''),
(83, 'test2', '$2y$10$zuA8OwP.NQ5f88XnuMZFW..JYIYHIJ9oO0p2ka6l7D7BLIMMS1Ubu', 'Name3', 36, 'wegeh', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Files`
--
ALTER TABLE `Files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `files_id_uindex` (`id`),
  ADD KEY `Files_fk` (`user_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Users_id_uindex` (`id`),
  ADD UNIQUE KEY `Users_login_uindex` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Files`
--
ALTER TABLE `Files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Files`
--
ALTER TABLE `Files`
  ADD CONSTRAINT `Files_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
