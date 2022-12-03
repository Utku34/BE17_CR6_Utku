-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Dez 2022 um 16:15
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `day3fswd17`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221129082638', '2022-11-29 09:26:45', 92);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Offen '),
(2, 'Akzeptiert'),
(3, 'in Bearbeitung'),
(4, 'Storniert'),
(5, 'Erledigt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `e_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_startdate` datetime NOT NULL,
  `e_date` datetime NOT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `todo`
--

INSERT INTO `todo` (`id`, `e_name`, `category`, `e_description`, `priority`, `e_startdate`, `e_date`, `fk_status_id`, `picture`) VALUES
(10, 'The Permanent Collection Redisplayed', 'theather', 'The Belvedere’s collection comprises several thousands of works from five centuries. In 2018, the museum’s permanent collection was redisplayed shedding a fresh and exciting light on artworks by artists like Rueland Frueauf the Elder, Franz Xaver Messersc', 'theater', '2022-12-03 15:31:27', '2022-03-12 13:30:00', 1, 'Belvedere-Schausammlung-638b5dbf06667.jpg'),
(11, 'Christmas in Vienna 2021– Preview', 'music', 'Traditional Christmas Concert at Konzerthaus\r\n\r\nORF Radio-Symphonieorchester Wien\r\nWiener Singakademie\r\nVienna Boys Choir\r\n\r\nConductor: Claire Levacher\r\n\r\nBartolomeyBittmann:\r\nMatthias Bartolomey, violoncello\r\nKlemens Bittmann, violin, mandola\r\n\r\nKatharin', 'music', '2022-12-03 15:33:55', '2021-01-01 00:00:00', 3, 'schedl-03-christmasinvienna-045-1-638b5e53ccb0e.jpg'),
(12, 'Gute Hirten', 'theater', 'Christmas with the Vienna Boys Choir\r\n\r\nShepherds play an important part in the Christmas story; many have marvelled at their faith, their dignity and their constancy. And here at MuTh, “The Good Shepherds” Christmas concert has become a tradition for all', 'theater', '2022-12-03 15:34:52', '2022-05-17 22:00:00', 1, '41178-638b5e8c3c796.jpg'),
(13, 'Wiener Symphoniker', 'music', 'Wiener Symphoniker\r\nConductor: Thomas Guggeis\r\n\r\nFrank Peter Zimmermann, violin\r\nBarbara Rett, presentation\r\n\r\n\r\nJohn Adams: Tromba lontana. Fanfare for orchestra (1985)\r\nFelix Mendelssohn Bartholdy:Ouverture \"The Hebrides / Fingal\'s Cave\" op. 26 (1829-18', 'music', '2022-12-03 15:36:21', '2021-05-29 21:20:00', 5, 'KHGrosserSaalNeu-638b5ee5dd297.jpg'),
(14, 'Der gestiefelte Kater', 'movie', 'Fairy tale opera by César Cui\r\n\r\nFairy tale opera in two acts based on the fairy tale of the same name by Charles Perrault.\r\n\r\nPupils of the Upper Secondary School of the Vienna Boys\' Choir\r\nStudents in the preparatory course dance MUK under the direction', 'movie', '2022-12-03 15:37:07', '2022-04-29 22:18:00', 2, 'Der-gestiefelte-Kater-c-Alena-Hoffmann-press-1-638b5f138bc0f.jpg'),
(15, 'Bonez MC & RAF Camora', 'music', 'Palmen Aus Plastik III – Tour\r\n\r\nFans have been waiting and hoping for this for a long time: Plastic Palms is back! After 4 years the successful project of Bonez MC & RAF Camora starts into the third round.', 'music', '2022-12-03 15:38:25', '2022-02-17 15:18:00', 3, '151-WienerStadthalle-HalleD-credit-BildagenturZolles-YZ-2373-edit-1-638b5f61c912d.jpg'),
(16, 'Argentinien – Australien', 'sport', 'Bei der Weltmeisterschaft 2022 in Katar startet am kommenden Wochenende die K.o.-Phase. Auch wenn noch nicht alle Gruppen die Vorrunde abgeschlossen haben, stehen dennoch schon die ersten Paarungen für das Achtelfinale fest. So muss etwa Mit-Favorit Argen', 'sport', '2022-12-03 15:54:44', '2022-04-01 19:14:00', 3, 'regular-16-9-638b633492e16.jpg'),
(17, 'test for deleting', 'sport', 'test for delete', 'sport', '2022-12-03 15:55:21', '2017-01-01 00:18:00', 4, 'Download-638b638d7482e.jpg');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indizes für die Tabelle `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A0EB6A0AAED72D` (`fk_status_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `FK_5A0EB6A0AAED72D` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
