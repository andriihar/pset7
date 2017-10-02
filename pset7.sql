-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 02 2017 г., 20:17
-- Версия сервера: 5.7.16-log
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pset7`
--

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `symbol` varchar(255) NOT NULL,
  `stocks` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `time`, `symbol`, `stocks`, `action`, `price`, `user_id`) VALUES
(1, '2017-09-28 11:45:08', 'FREE', 100, 'Sell', '1.00', 0),
(2, '2017-09-28 11:46:38', 'GOOG', 12, 'Sell', '944.00', 0),
(3, '2017-09-28 11:48:43', 'GOOG', 12, 'buy', '944.00', 0),
(4, '2017-09-28 11:49:07', 'GOOG', 12, 'Sell', '944.00', 0),
(5, '2017-09-28 11:49:36', 'GOOG', 2, 'buy', '944.00', 0),
(6, '2017-09-28 11:49:43', 'AAPL', 12, 'buy', '154.00', 0),
(7, '2017-09-28 11:51:30', 'AAPL', 12, 'Sell', '154.23', 0),
(8, '2017-09-28 11:52:05', 'AAPL', 24, 'buy', '154.23', 0),
(9, '2017-09-28 12:02:09', 'AAPL', 24, 'Sell', '154.23', 43),
(10, '2017-09-28 12:02:12', 'GOOG', 2, 'Sell', '944.49', 43),
(11, '2017-09-28 12:02:17', 'RE', 13, 'buy', '221.08', 43),
(12, '2017-09-28 12:05:19', 'RE', 13, 'Sell', '221.08', 43),
(13, '2017-09-28 12:18:50', 'AApl', 24, 'buy', '154.23', 45),
(14, '2017-09-28 12:23:24', 'GE', 120, 'buy', '24.37', 45),
(15, '2017-09-28 12:29:27', 'DPG.F', 300, 'buy', '2.26', 45),
(16, '2017-10-01 12:52:01', 'AApl', 20, 'buy', '154.12', 47),
(17, '2017-10-01 12:54:09', 'GOOG', 5, 'buy', '959.11', 47),
(18, '2017-10-01 12:54:26', 'AAPL', 1, 'buy', '154.12', 47),
(19, '2017-10-01 14:29:32', 'GOOG', 5, 'buy', '959.11', 48),
(20, '2017-10-01 14:29:40', 'RE', 13, 'buy', '228.39', 48),
(21, '2017-10-01 14:29:58', 'RE', 2, 'buy', '228.39', 48),
(22, '2017-10-01 19:23:09', 'GTE', 100, 'buy', '2.28', 48),
(23, '2017-10-01 19:23:49', 'HY', 13, 'buy', '76.44', 48),
(24, '2017-10-02 16:27:12', 'AAPL', 12, 'buy', '152.91', 49),
(25, '2017-10-02 16:27:20', 'AAPL', 12, 'Sell', '152.89', 49),
(26, '2017-10-02 16:27:31', 'AAPL', 15, 'buy', '152.86', 49),
(27, '2017-10-02 16:29:57', 'RE', 0, 'buy', '228.15', 49),
(28, '2017-10-02 16:31:23', 'RE', 1, 'buy', '228.08', 49),
(29, '2017-10-02 16:48:12', 'GOOG', 1, 'buy', '953.92', 49),
(30, '2017-10-02 17:01:29', 'GOOG', 100, 'buy', '953.39', 49),
(31, '2017-10-02 17:10:40', 'RE', 1, 'Sell', '228.39', 49);

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(10) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `stocks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `symbol`, `stocks`) VALUES
(45, 'AAPL', 24),
(45, 'DPG.F', 300),
(45, 'GE', 120),
(47, 'AAPL', 21),
(47, 'GOOG', 5),
(48, 'GOOG', 5),
(48, 'GTE', 100),
(48, 'HY', 13),
(48, 'RE', 15),
(49, 'AAPL', 15),
(49, 'GOOG', 101);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `cash` decimal(65,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `hash`, `cash`, `email`) VALUES
(44, 'Max', '$2y$10$PV2d9z0B/uxkOp5J1Hh7QetbA9cFIw3Va2R1c6Hvfc2ipscBMATxC', '253660.00', ''),
(45, 'Andrii', '$2y$10$PV2d9z0B/uxkOp5J1Hh7QetbA9cFIw3Va2R1c6Hvfc2ipscBMATxC', '102697.28', 'adsf3@gmail.com'),
(48, 'Vad', '$2y$10$mhKeKWOg9/81/ySWi06Nee/PGePFzlxbNNwtkkg9s1iO1.PZ1fIEu', '100000.88', 'vad@gmail.com'),
(49, 'A', '$2y$10$269YmwcEdk5Fpyyp0/AQTejdAAb.Z8YysJXKu0SBiZyO119kdgjzm', '11414.33', 'sd@gs.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`,`symbol`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
