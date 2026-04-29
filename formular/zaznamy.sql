-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2026 at 05:13 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moje_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `zaznamy`
--

CREATE TABLE `zaznamy` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `predmet` varchar(200) NOT NULL,
  `hodnoceni` int(11) NOT NULL,
  `kategorie` varchar(50) NOT NULL DEFAULT 'A',
  `popis` text NOT NULL,
  `datum_pridani` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zaznamy`
--

INSERT INTO `zaznamy` (`id`, `jmeno`, `email`, `predmet`, `hodnoceni`, `kategorie`, `popis`, `datum_pridani`) VALUES
(1,  'Jan Novák',            'jan@email.cz',                     'Matematika',         5, 'A', 'Skvělý předmět, doporučuji!',                               '2026-01-05 08:42:00'),
(2,  'Eva Malá',             'eva@email.cz',                     'Fyzika',             3, 'B', 'Docela těžké, ale zvládnutelné.',                            '2026-01-12 11:15:00'),
(3,  'Tomáš Vlk',            'tomas@email.cz',                   'Čeština',            4, 'A', 'Zajímavé texty, dobrý učitel.',                              '2026-01-20 14:30:00'),
(4,  'a',                    'a@f.j',                            '0',                  2, '0', 'a',                                                          '2026-01-22 09:00:00'),
(5,  'andtejka',             'A@gmanasdf.xcom',                  '0',                  5, '0', 'SUP/ER',                                                     '2026-01-25 16:10:00'),
(6,  'ACASC',                'can@nig.com',                      '0',                  4, '0', 'DE TO NO',                                                   '2026-01-28 13:05:00'),
(7,  'asxddasdfd',           'ASDFadsw@edrtg',                   '0',                  4, '0', 'asdfg',                                                      '2026-02-01 10:22:00'),
(8,  'sdfh',                 'asdfgh@g',                         '0',                  1, '0', 'asdgasdgsdgf',                                               '2026-02-03 17:40:00'),
(9,  'asdg',                 'asdfgasdfg@asfdasdfasdfasdf',      'asedrfg',            3, 'C', 'asdasfdsadfsadfsadfsdfafasdasfdafsdf',                        '2026-02-06 08:55:00'),
(10, 'Jan Kláda',            'KladaJakoHrom@seznam.cz',          'Mariokart 67',       5, 'A', 'Hej nejlepší věc evr',                                       '2026-02-10 20:30:00'),
(11, 'Petr Dvořák',          'petr.dvorak@email.cz',             'Český jazyk',        4, 'B', 'Příjemné lekce, občas náročné na přípravu.',                 '2026-02-14 09:15:00'),
(12, 'Lucie Novotná',        'lucie.novotna@seznam.cz',          'Dějepis',            5, 'A', 'Výborný výklad, učivo mě opravdu bavilo.',                   '2026-02-18 13:45:00'),
(13, 'Karel Svoboda',        'karel.svobo@gmail.com',            'Zeměpis',            3, 'C', 'Průměrné hodiny, moc jsme toho neprobrali.',                 '2026-02-22 11:00:00'),
(14, 'Jana Kučerová',        'jana.kucerova@post.cz',            'Angličtina',         5, 'A', 'Skvělá konverzace a super učitelka.',                        '2026-03-01 14:20:00'),
(15, 'Martin Veselý',        'm.vesely@email.cz',                'Němčina',            2, 'B', 'Moc mi to nešlo, chybělo víc opakování.',                    '2026-03-05 08:10:00'),
(16, 'Anna Kovářová',        'anna.kov@seznam.cz',               'Chemie',             4, 'C', 'Pokusy byly super, ale teorie docela nuda.',                  '2026-03-10 15:35:00'),
(17, 'Michal Černý',         'michal.c@gmail.com',               'Tělocvik',           5, 'A', 'Pohoda a relax, dostali jsme prostor na fotbal.',            '2026-03-14 10:50:00'),
(18, 'Zuzana Procházková',   'zuzkapro@post.cz',                 'Informatika',        4, 'B', 'Zajímavé projekty, ale pomalé počítače.',                    '2026-03-18 12:00:00'),
(19, 'Tomáš Král',           'kral.tomas@email.cz',              'Matematika',         1, 'C', 'Vůbec jsem to nepochopil, strašný přístup.',                 '2026-03-22 16:40:00'),
(20, 'Veronika Pospíšilová', 'verca.p@seznam.cz',                'Biologie',           5, 'A', 'Paní učitelka to umí krásně vysvětlit.',                     '2026-03-27 09:25:00'),
(21, 'Jakub Marek',          'jakub.m@gmail.com',                'Fyzika',             3, 'B', 'Docela to šlo, akorát těch vzorečků bylo moc.',              '2026-04-01 11:30:00'),
(22, 'Tereza Růžičková',     'tereza.ruz@email.cz',              'Hudební výchova',    4, 'A', 'Pěkné písničky a odpočinkový předmět.',                      '2026-04-05 13:15:00'),
(23, 'Pavel Horák',          'pavel.horak@seznam.cz',            'Výtvarná výchova',   5, 'C', 'Mohl jsem se plně realizovat. Doporučuji.',                  '2026-04-09 14:00:00'),
(24, 'Kateřina Vacková',     'katka.vackova@post.cz',            'Ekonomie',           4, 'B', 'Hodně nových informací, které využiju v praxi.',              '2026-04-13 10:20:00'),
(25, 'Jiří Pokorný',         'jiri.pokorny@gmail.com',           'Právo',              2, 'C', 'Příliš suché a těžké na zapamatování.',                      '2026-04-17 15:45:00'),
(26, 'Markéta Hájková',      'marketa.h@email.cz',               'Společenské vědy',   5, 'A', 'Velmi podnětné debaty a zajímavá témata.',                   '2026-04-21 09:00:00'),
(27, 'Ondřej Janda',         'ondra.janda@seznam.cz',            'Programování',       5, 'B', 'Naprosto super, konečně pořádné kódení.',                    '2026-04-24 17:10:00'),
(28, 'Kristýna Křížová',     'kristyna.k@post.cz',               'Robotika',           4, 'A', 'Bavilo mě skládat a programovat robota.',                    '2026-04-26 11:55:00'),
(29, 'David Šmíd',           'david.smid@gmail.com',             'Webdesign',          5, 'C', 'CSS a HTML mě chytlo, udělal jsem hezký web.',               '2026-04-28 08:30:00'),
(30, 'Barbora Vlčková',      'bara.vlckova@email.cz',            'Marketing',          3, 'B', 'Přednášky trochu zdlouhavé, ale užitečné.',                  '2026-04-29 16:05:00');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `zaznamy`
--
ALTER TABLE `zaznamy`
  ADD PRIMARY KEY (`id`);

--
-- Pokud již máš tabulku bez sloupce datum_pridani, spusť toto:
-- ALTER TABLE `zaznamy` ADD `datum_pridani` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `zaznamy`
--
ALTER TABLE `zaznamy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
