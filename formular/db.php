<?php
// ============================================================
// MODUL: DB.PHP – Připojení k databázi
// Připoj v PHP: include 'db.php';
// Upravte: $servername, $username, $password, $dbname
// ============================================================

$servername = "localhost";
$username   = "root";
$password   = "root";       // Na Windows MAMP může být prázdné: ""
$dbname     = "moje_db";    // ← ZDE ZMĚŇ název databáze

$spojeni = new mysqli($servername, $username, $password, $dbname);

// Kontrola připojení
if ($spojeni->connect_error) {
    die("Připojení selhalo: " . $spojeni->connect_error);
}

// Nastavení kódování UTF-8 (důležité pro češtinu!)
$spojeni->set_charset("utf8");
?>
