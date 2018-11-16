-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2018 at 04:36 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `berichten`
--

CREATE TABLE `berichten` (
  `BerichtID` int(11) NOT NULL,
  `BerichtTitel` varchar(255) DEFAULT NULL,
  `BerichtOmschrijving` text,
  `BerichtInhoud` text,
  `Auteur` varchar(128) DEFAULT NULL,
  `BerichtDatum` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `berichten`
--

INSERT INTO `berichten` (`BerichtID`, `BerichtTitel`, `BerichtOmschrijving`, `BerichtInhoud`, `Auteur`, `BerichtDatum`) VALUES
(1, 'Mijn eerste bericht', 'onderwerp van mijn eerste bericht', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris facilisis velit at tempus ornare. Suspendisse placerat egestas ipsum eget aliquet. Praesent rutrum nec nisi ac euismod.', 'BasvanEvelingen', '2018-11-14 12:56:50'),
(8, 'Hackaton', 'Bootcamp Insights', 'Vaak wordt er in teamverband gehacked en moet het project aan het einde gepresenteerd worden. Hierdoor zijn niet alleen sterke IT-skills bepalend voor de uitslag maar ook sterke sociale skills. Deelnemen aan een hackathon kan het zelfvertrouwen van de individuen versterken Ã©n die van het team als geheel. Omdat deelnemers de mogelijkheid hebben om uit te blinken op meerdere vlakken maakt CodeGorilla gebruik van hackathons.', 'BasvanEvelingen', '2018-11-16 15:55:32'),
(9, 'Hacken en marathon maakt hackathon', 'Bootcamp Insights', 'Op een hackathon wordt, je raadt het al, veel gehacked. De 24 uur of langer durende evenementen komen steeds meer voor. Zo ook recent in Vaticaanstad waar hackers probeerden om problemen omtrent sociale inclusie, migratie en communicatie tussen geloofsgroepen op te lossen. Niet elke hackathon vindt plaats in een gebouw uit 1490, maar toch kennen de meeste evenementen veel overeenkomsten. Innovatieve ideeÃ«n, snacks, energiedrank en weinig slaap zijn enkele elementen die bijna op elke hackathons te vinden zijn. De ervaring van deelnemers is meestal erg positief. Ook hebben zij het gevoel dat ze dingen leren die ze in een standaard situatie niet hadden kunnen leren.', 'BasvanEvelingen', '2018-11-16 15:57:22'),
(10, 'Nintendo ontkent plannen te hebben voor N64 Classic Mini', 'Games', 'Reggie Fils-Aime, topman van Nintendo in de Verenigde Staten, sluit in een interview met Kotaku een N64 Classic Mini niet totaal uit, maar zegt dat er nu geen plannen zijn om zo\'n console te maken. Het spelen van klassieke games zou nu moeten verlopen via abonnement Switch Online op de Switch-console.', 'BasvanEvelingen', '2018-11-16 15:59:20'),
(11, 'Google Home Hub', 'Slimme speaker en fotolijst in Ã©Ã©n', 'Kleiner dan je denkt. Zo groot is de Google Home Hub als we afgaan op de eerste reacties toen hij op de redactie uit zijn doosje werd gehaald. Het 7â€-scherm is niet veel groter dan dat van sommige heel grote smartphones. Heel opvallend is het apparaatje verder evenmin; het scherm is onder een hoek bevestigd op een voet die is afgewerkt met de stof die we kennen van de Google Home Mini. In die voet is ook de luidspreker weggewerkt. Achter op het scherm zitten de volumeknoppen en een knop om de microfoons uit te zetten. In de bovenste schermrand zitten die twee microfoons en een lichtsensor, waarbij Google met die laatste indrukwekkende dingen doet. Een camera is niet aanwezig, volgens Google om de drempel om een Home Hub in je huis te zetten, te verlagen.', 'BasvanEvelingen', '2018-11-16 16:01:38'),
(12, NULL, 'At the end of the HTML tutorial, you can find more than 200 examples.', 'At W3Schools you will find complete references about tags, attributes, events, color names, entities, character-sets, URL encoding, language codes, HTTP messages, and more.', 'BasvanEvelingen', '2018-11-16 16:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'BasvanEvelingen', '$2y$10$rJfeoaWOERr8Xnf9U2ZFLe0kgvW6dXm3VUXuv7LXr749aZkQu1pZu', '2018-11-15 15:20:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berichten`
--
ALTER TABLE `berichten`
  ADD PRIMARY KEY (`BerichtID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berichten`
--
ALTER TABLE `berichten`
  MODIFY `BerichtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
