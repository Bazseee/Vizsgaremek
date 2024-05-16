-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Ápr 16. 22:49
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `mesterremek`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `announcementName` varchar(255) NOT NULL,
  `announcementsText` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `exercise_category`
--

CREATE TABLE `exercise_category` (
  `workout_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `announcement_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('read','unread') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password_hash` varchar(80) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `avatar` text NOT NULL,
  `is_banned` int(11) DEFAULT NULL,
  `permission` int(11) NOT NULL,
  `first_register` tinyint(1) NOT NULL DEFAULT 1,
  `generated_workout` text NOT NULL,
  `workout_consent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `reg_time`, `avatar`, `is_banned`, `permission`, `first_register`, `generated_workout`, `workout_consent`) VALUES
(28, 'asd', 'asd@gmail.com', '$2y$10$QGFjIDIxHpG09E1VqV9d4.QWw/XB4xt4vDX8IVx2XUmCK.KDFivDC', '2024-04-16 18:44:43', '', NULL, 1, 0, '{\"Week 1\":{\"2024-04-17\":{\"upper_body\":[\"16\",\"20\",\"17\",\"13\",\"12\",\"18\",\"14\"],\"lower_body\":[\"12\",\"19\",\"18\",\"20\",\"14\"]},\"2024-04-18\":{\"upper_body\":[\"14\",\"17\",\"16\",\"19\",\"12\",\"20\",\"15\"],\"lower_body\":[\"19\",\"14\",\"15\",\"20\",\"12\"]},\"2024-04-19\":\"Rest day\",\"2024-04-20\":{\"upper_body\":[\"16\",\"13\",\"20\",\"12\",\"18\",\"17\",\"19\"],\"lower_body\":[\"16\",\"17\",\"14\",\"18\",\"12\"]},\"2024-04-21\":{\"upper_body\":[\"16\",\"19\",\"20\",\"14\",\"18\",\"15\",\"12\"],\"lower_body\":[\"13\",\"16\",\"12\",\"15\",\"14\"]},\"2024-04-22\":\"Rest day\"}}', 1),
(29, 'Tibor', 'tibi@gmail.com', '$2y$10$EHuLl5b2OUbpszZaoym83OLsE.2TQtsremb9T9Meaywmu4oACymRe', '2024-04-16 18:52:33', 'IMG-661e3d648410b0.75935727.jpg', 0, 1, 0, '{\"Week 1\":{\"2024-04-17\":{\"upper_body\":[\"13\",\"15\",\"20\",\"16\",\"12\",\"19\",\"18\"],\"lower_body\":[\"20\",\"16\",\"14\",\"17\",\"18\"]},\"2024-04-18\":{\"upper_body\":[\"19\",\"15\",\"13\",\"14\",\"17\",\"12\",\"20\"],\"lower_body\":[\"20\",\"17\",\"16\",\"18\",\"15\"]},\"2024-04-19\":\"Rest day\",\"2024-04-20\":{\"upper_body\":[\"19\",\"12\",\"15\",\"14\",\"17\",\"18\",\"20\"],\"lower_body\":[\"19\",\"16\",\"17\",\"14\",\"15\"]},\"2024-04-21\":{\"upper_body\":[\"13\",\"17\",\"20\",\"19\",\"16\",\"12\",\"14\"],\"lower_body\":[\"20\",\"13\",\"19\",\"15\",\"12\"]},\"2024-04-22\":\"Rest day\"},\"Week 2\":{\"2024-04-23\":{\"upper_body\":[\"16\",\"14\",\"12\",\"15\",\"18\",\"19\",\"17\"],\"lower_body\":[\"12\",\"14\",\"15\",\"16\",\"17\"]},\"2024-04-24\":{\"upper_body\":[\"19\",\"15\",\"20\",\"14\",\"12\",\"16\",\"17\"],\"lower_body\":[\"12\",\"17\",\"19\",\"18\",\"14\"]},\"2024-04-25\":{\"upper_body\":[\"12\",\"16\",\"18\",\"14\",\"13\",\"19\",\"17\"],\"lower_body\":[\"16\",\"12\",\"14\",\"19\",\"17\"]},\"2024-04-26\":\"Rest day\",\"2024-04-27\":{\"upper_body\":[\"17\",\"18\",\"16\",\"14\",\"19\",\"12\",\"13\"],\"lower_body\":[\"13\",\"15\",\"16\",\"14\",\"12\"]},\"2024-04-28\":{\"upper_body\":[\"15\",\"16\",\"12\",\"20\",\"13\",\"18\",\"17\"],\"lower_body\":[\"17\",\"15\",\"20\",\"14\",\"13\"]},\"2024-04-29\":\"Rest day\"},\"Week 3\":{\"2024-04-30\":{\"upper_body\":[\"16\",\"18\",\"19\",\"14\",\"20\",\"12\",\"17\"],\"lower_body\":[\"20\",\"17\",\"19\",\"18\",\"15\"]},\"2024-05-01\":{\"upper_body\":[\"14\",\"15\",\"16\",\"18\",\"20\",\"13\",\"12\"],\"lower_body\":[\"14\",\"19\",\"20\",\"12\",\"17\"]},\"2024-05-02\":{\"upper_body\":[\"13\",\"19\",\"16\",\"15\",\"12\",\"20\",\"18\"],\"lower_body\":[\"12\",\"19\",\"20\",\"16\",\"17\"]},\"2024-05-03\":\"Rest day\",\"2024-05-04\":{\"upper_body\":[\"15\",\"20\",\"13\",\"12\",\"18\",\"19\",\"16\"],\"lower_body\":[\"18\",\"17\",\"13\",\"15\",\"20\"]},\"2024-05-05\":{\"upper_body\":[\"20\",\"14\",\"13\",\"16\",\"18\",\"15\",\"12\"],\"lower_body\":[\"17\",\"20\",\"18\",\"13\",\"15\"]},\"2024-05-06\":\"Rest day\"}}', 0),
(30, 'bazseee', 'bmartai05@gmail.com', '$2y$10$Dz0STUZIAy5dq6JjDRoG2uS2Fpqe9sU3mB7orcRoYsdUhYnUKiTEu', '2024-04-16 20:48:02', '', NULL, 1, 0, '{\"Week 1\":{\"2024-04-17\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-18\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-19\":\"Rest day\",\"2024-04-20\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-21\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-22\":\"Rest day\"},\"Week 2\":{\"2024-04-23\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-24\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-25\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-26\":\"Rest day\",\"2024-04-27\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-28\":{\"upper_body\":[],\"lower_body\":[]},\"2024-04-29\":\"Rest day\"},\"Week 3\":{\"2024-04-30\":{\"upper_body\":[],\"lower_body\":[]},\"2024-05-01\":{\"upper_body\":[],\"lower_body\":[]},\"2024-05-02\":{\"upper_body\":[],\"lower_body\":[]},\"2024-05-03\":\"Rest day\",\"2024-05-04\":{\"upper_body\":[],\"lower_body\":[]},\"2024-05-05\":{\"upper_body\":[],\"lower_body\":[]},\"2024-05-06\":\"Rest day\"}}', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(11) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `address` text NOT NULL,
  `gender` int(1) NOT NULL,
  `birthday` date NOT NULL,
  `phone` text NOT NULL,
  `intention` int(2) NOT NULL,
  `desired_time` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `user_data`
--

INSERT INTO `user_data` (`user_id`, `surname`, `firstname`, `weight`, `height`, `address`, `gender`, `birthday`, `phone`, `intention`, `desired_time`) VALUES
(28, 'Tibor', 'Száraz', 234, 216, 'Makay Imre u. 2', 1, '2024-04-12', ' 36', 0, 1),
(30, 'Tibor', 'Száraz', 207, 176, 'Vác', 0, '2024-04-20', ' 36 70 389 9128', 0, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workout_body_parts`
--

CREATE TABLE `workout_body_parts` (
  `id` int(2) NOT NULL,
  `body_parts` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `workout_body_parts`
--

INSERT INTO `workout_body_parts` (`id`, `body_parts`) VALUES
(1, 'Upper body'),
(2, 'Lower body');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workout_categories`
--

CREATE TABLE `workout_categories` (
  `id` int(2) NOT NULL,
  `categories` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `workout_categories`
--

INSERT INTO `workout_categories` (`id`, `categories`) VALUES
(1, 'Weight lifting'),
(2, 'Calisthenics'),
(3, 'Bands');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workout_completed`
--

CREATE TABLE `workout_completed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `completion_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `workout_exercises`
--

CREATE TABLE `workout_exercises` (
  `id` int(11) NOT NULL,
  `nameOfExercise` varchar(255) NOT NULL,
  `descriptionOfExercise` varchar(255) NOT NULL,
  `shortdescriptionOfExercise` varchar(255) NOT NULL,
  `imageOfExercise` text NOT NULL,
  `body_part_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `exercise_category`
--
ALTER TABLE `exercise_category`
  ADD KEY `workout_id` (`workout_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- A tábla indexei `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_id` (`announcement_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `workout_body_parts`
--
ALTER TABLE `workout_body_parts`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `workout_categories`
--
ALTER TABLE `workout_categories`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `workout_completed`
--
ALTER TABLE `workout_completed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `workout_exercises`
--
ALTER TABLE `workout_exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `body_part_id` (`body_part_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT a táblához `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `workout_body_parts`
--
ALTER TABLE `workout_body_parts`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `workout_categories`
--
ALTER TABLE `workout_categories`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `workout_completed`
--
ALTER TABLE `workout_completed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `workout_exercises`
--
ALTER TABLE `workout_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Megkötések a táblához `exercise_category`
--
ALTER TABLE `exercise_category`
  ADD CONSTRAINT `exercise_category_ibfk_1` FOREIGN KEY (`workout_id`) REFERENCES `workout_exercises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercise_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `workout_categories` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Megkötések a táblához `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `workout_completed`
--
ALTER TABLE `workout_completed`
  ADD CONSTRAINT `workout_completed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Megkötések a táblához `workout_exercises`
--
ALTER TABLE `workout_exercises`
  ADD CONSTRAINT `workout_exercises_ibfk_1` FOREIGN KEY (`body_part_id`) REFERENCES `workout_body_parts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
