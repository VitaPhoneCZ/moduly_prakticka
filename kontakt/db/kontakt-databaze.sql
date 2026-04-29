-- ============================================================
-- MODUL: KONTAKT/DB – SQL schema
-- Import: phpMyAdmin → vyber DB → záložka Import → nahraj tento soubor
-- Tabulka: kontakty (jméno, email, zpráva, datum)
-- ============================================================

-- Použijeme stejnou databázi jako ostatní moduly
USE `moje_db`;   -- ← ZDE ZMĚŇ název databáze (musí být stejný jako v db.php)

-- --------------------------------------------------------
-- Tabulka `kontakty`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `kontakty` (
  `id`             INT(11)      NOT NULL AUTO_INCREMENT,
  `jmeno`          VARCHAR(100) NOT NULL,
  `email`          VARCHAR(150) NOT NULL,
  `zprava`         TEXT         NOT NULL,
  `datum_odeslani` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------
-- Ukázkový testovací záznam (volitelné – smaž pokud nechceš)
-- --------------------------------------------------------
INSERT INTO `kontakty` (`jmeno`, `email`, `zprava`) VALUES
('Jan Novák', 'jan@email.cz', 'Dobrý den, zajímám se o vaše služby. Prosím o kontaktování.');

COMMIT;
