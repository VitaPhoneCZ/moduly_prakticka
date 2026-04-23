-- ============================================================
-- MODUL: FORMULÁŘ – SQL DUMP pro phpMyAdmin
-- Import: phpMyAdmin → vyber DB → záložka Import → nahraj tento soubor
-- Upravit: název databáze a tabulky dle potřeby
-- ============================================================

-- Vytvoření databáze (pokud ještě neexistuje)
CREATE DATABASE IF NOT EXISTS `moje_db`
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_czech_ci;

USE `moje_db`;

-- --------------------------------------------------------
-- Struktura tabulky `zaznamy`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `zaznamy` (
  `id`        INT(11)      NOT NULL AUTO_INCREMENT,  -- Primární klíč (auto increment)
  `jmeno`     VARCHAR(100) NOT NULL,
  `email`     VARCHAR(150) NOT NULL,
  `predmet`   VARCHAR(200) NOT NULL,
  `hodnoceni` INT(11)      NOT NULL,                 -- 1–5 (radio buttony)
  `kategorie` VARCHAR(50)  NOT NULL DEFAULT 'A',
  `popis`     TEXT         NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- Ukázková testovací data (volitelné – smaž pokud nechceš)
-- --------------------------------------------------------
INSERT INTO `zaznamy` (`jmeno`, `email`, `predmet`, `hodnoceni`, `kategorie`, `popis`) VALUES
('Jan Novák',  'jan@email.cz',   'Matematika', 5, 'A', 'Skvělý předmět, doporučuji!'),
('Eva Malá',   'eva@email.cz',   'Fyzika',     3, 'B', 'Docela těžké, ale zvládnutelné.'),
('Tomáš Vlk',  'tomas@email.cz', 'Čeština',    4, 'A', 'Zajímavé texty, dobrý učitel.');

COMMIT;
