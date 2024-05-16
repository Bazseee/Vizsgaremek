-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Máj 16. 21:02
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

--
-- A tábla adatainak kiíratása `announcements`
--

INSERT INTO `announcements` (`id`, `announcementName`, `announcementsText`, `date`) VALUES
(30, 'Server shutdown', 'Servers will be under maintenance. The website will not work! Thank you for understanding.', '2024-06-09 20:00:00');

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

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `topic_id`, `content`, `created_at`) VALUES
(64, 32, 27, 'I found one!', '2024-05-16 19:01:24');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `exercise_category`
--

CREATE TABLE `exercise_category` (
  `workout_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `exercise_category`
--

INSERT INTO `exercise_category` (`workout_id`, `category_id`) VALUES
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(24, 3),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 2),
(27, 3),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 2),
(29, 3),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(31, 3),
(32, 1),
(32, 2),
(32, 3),
(33, 1),
(33, 2),
(33, 3),
(34, 1),
(34, 2),
(34, 3),
(35, 1),
(35, 2),
(35, 3),
(36, 1),
(36, 2),
(36, 3),
(37, 1),
(37, 2),
(37, 3),
(38, 1),
(38, 2),
(38, 3),
(39, 1),
(39, 2),
(39, 3);

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

--
-- A tábla adatainak kiíratása `notifications`
--

INSERT INTO `notifications` (`id`, `announcement_id`, `user_id`, `status`) VALUES
(12, 30, 32, 'read');

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

--
-- A tábla adatainak kiíratása `topics`
--

INSERT INTO `topics` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(27, 32, 'Asking for assistance', 'Hello! I am looking for a trainer who can guide me how to do my exercises properly. If you are interested, please contact me.\r\nTEL.: +36301234567', '2024-05-16 19:01:13');

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
(32, 'TesztJancsi', 'tesztjancsi@gmail.com', '$2y$10$yotBE4IsX9mIrTkorcnDT.MrUaYFrxzDPWjMwTjN32FnrCKRMiFke', '2024-05-16 18:51:35', '', NULL, 1, 0, '{\"Week 1\":{\"2024-05-17\":{\"upper_body\":[\"23\",\"31\",\"39\",\"28\",\"27\",\"37\",\"26\"],\"lower_body\":[\"30\",\"25\",\"24\",\"36\",\"28\"]},\"2024-05-18\":{\"upper_body\":[\"32\",\"39\",\"38\",\"35\",\"30\",\"34\",\"36\"],\"lower_body\":[\"37\",\"34\",\"31\",\"32\",\"24\"]},\"2024-05-19\":\"Rest day\",\"2024-05-20\":{\"upper_body\":[\"23\",\"35\",\"34\",\"28\",\"33\",\"26\",\"25\"],\"lower_body\":[\"33\",\"36\",\"24\",\"26\",\"28\"]},\"2024-05-21\":{\"upper_body\":[\"32\",\"33\",\"34\",\"27\",\"25\",\"39\",\"24\"],\"lower_body\":[\"27\",\"33\",\"34\",\"36\",\"37\"]},\"2024-05-22\":\"Rest day\"},\"Week 2\":{\"2024-05-23\":{\"upper_body\":[\"39\",\"33\",\"26\",\"27\",\"34\",\"30\",\"29\"],\"lower_body\":[\"35\",\"26\",\"39\",\"28\",\"30\"]},\"2024-05-24\":{\"upper_body\":[\"29\",\"38\",\"35\",\"24\",\"33\",\"32\",\"27\"],\"lower_body\":[\"38\",\"27\",\"30\",\"39\",\"33\"]},\"2024-05-25\":{\"upper_body\":[\"24\",\"23\",\"33\",\"27\",\"26\",\"39\",\"28\"],\"lower_body\":[\"32\",\"31\",\"23\",\"33\",\"25\"]},\"2024-05-26\":\"Rest day\",\"2024-05-27\":{\"upper_body\":[\"33\",\"25\",\"35\",\"26\",\"38\",\"30\",\"29\"],\"lower_body\":[\"35\",\"25\",\"24\",\"28\",\"26\"]},\"2024-05-28\":{\"upper_body\":[\"31\",\"35\",\"26\",\"27\",\"25\",\"23\",\"32\"],\"lower_body\":[\"36\",\"34\",\"25\",\"24\",\"28\"]},\"2024-05-29\":\"Rest day\"},\"Week 3\":{\"2024-05-30\":{\"upper_body\":[\"25\",\"37\",\"30\",\"27\",\"23\",\"33\",\"32\"],\"lower_body\":[\"28\",\"30\",\"36\",\"33\",\"39\"]},\"2024-05-31\":{\"upper_body\":[\"39\",\"37\",\"32\",\"29\",\"33\",\"36\",\"25\"],\"lower_body\":[\"39\",\"33\",\"29\",\"23\",\"25\"]},\"2024-06-01\":{\"upper_body\":[\"26\",\"38\",\"34\",\"35\",\"25\",\"32\",\"23\"],\"lower_body\":[\"38\",\"33\",\"25\",\"23\",\"27\"]},\"2024-06-02\":\"Rest day\",\"2024-06-03\":{\"upper_body\":[\"33\",\"37\",\"30\",\"24\",\"38\",\"32\",\"39\"],\"lower_body\":[\"33\",\"25\",\"24\",\"26\",\"23\"]},\"2024-06-04\":{\"upper_body\":[\"23\",\"29\",\"30\",\"35\",\"31\",\"34\",\"38\"],\"lower_body\":[\"37\",\"27\",\"33\",\"34\",\"28\"]},\"2024-06-05\":\"Rest day\"}}', 1),
(33, 'ElvaráZsolt', 'elvarazsolt@gmail.com', '$2y$10$E063DwW9z6N872nI/zw8HedhEavIBnwXL4SauDSTM4/mS2pvGvLnS', '2024-05-16 18:58:01', '', NULL, 0, 1, '', 0);

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
(32, 'Teszt', 'János', 98, 190, 'Vác', 0, '2000-01-06', ' 36123456789', 0, 3);

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
-- A tábla adatainak kiíratása `workout_exercises`
--

INSERT INTO `workout_exercises` (`id`, `nameOfExercise`, `descriptionOfExercise`, `shortdescriptionOfExercise`, `imageOfExercise`, `body_part_id`) VALUES
(23, 'Cruches', 'Cruches 4x12', 'Cruches 4x12', 'IMG-6646528461b036.13351985.gif', 1),
(24, 'Bench press', 'Bench press 4x10', 'Bench press 4x10', 'IMG-664652e081c3e1.43158103.gif', 1),
(25, 'Forward raise with dumbbell or barbell', 'Forward raise with dumbbell or barbell 4x10', 'Forward raise with dumbbell or barbell 4x10', 'IMG-66465343c42315.73527511.gif', 1),
(26, 'Barbell curl', 'Barbell curl 4x12', 'Barbell curl 4x12', 'IMG-664653659ea146.21230760.gif', 1),
(27, 'Triceps dips', 'Triceps dips 4x10', 'Triceps dips 4x10', 'IMG-664653c36df067.21606251.gif', 1),
(28, 'Barbell bent over row', 'Barbell bent over row 4x10', 'Barbell bent over row 4x10', 'IMG-664653e26f2348.11471077.gif', 1),
(29, 'Cable rear pulldown / behind the neck pulldown', 'Cable rear pulldown / behind the neck pulldown 4x12', 'Cable rear pulldown / behind the neck pulldown 4x12', 'IMG-66465411a8f4b6.06311340.gif', 1),
(30, 'Wrist roller', 'Wrist roller 4x10', 'Wrist roller 4x10', 'IMG-6646543ec26213.60845047.gif', 1),
(31, 'Heel touch', 'Heel touch 4x12', 'Heel touch 4x12', 'IMG-66465477a66560.46843848.gif', 1),
(32, 'Concentration curl', 'Concentration curl 4x12', 'Concentration curl 4x12', 'IMG-6646549c47ee52.52542385.gif', 1),
(33, 'Standing leg circles', 'Standing leg circles 4x12', 'Standing leg circles 4x12', 'IMG-664654c96f1627.03015232.gif', 2),
(34, 'Barbell split squat', 'Barbell split squat 4x12', 'Barbell split squat 4x12', 'IMG-664654ebbe6bd2.32816598.gif', 2),
(35, 'Barbell glute bridge two legs on bench', 'Barbell glute bridge two legs on bench 4x12', 'Barbell glute bridge two legs on bench 4x12', 'IMG-6646551ba223d4.32836636.gif', 2),
(36, 'Leg curl', 'Leg curl 4x12', 'Leg curl 4x12', 'IMG-66465536981b85.97622936.gif', 2),
(37, 'Calf raise', 'Calf raise 4x12', 'Calf raise 4x12', 'IMG-6646554cee4e09.06760317.gif', 2),
(38, 'Lever side hip abduction', 'Lever side hip abduction 4x12', 'Lever side hip abduction 4x12', 'IMG-66465583ba5434.58532190.gif', 2),
(39, 'Frog reverse hyperextension', 'Frog reverse hyperextension 4x10', 'Frog reverse hyperextension 4x10', 'IMG-664655a797d075.21285244.gif', 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT a táblához `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT a táblához `workout_exercises`
--
ALTER TABLE `workout_exercises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
