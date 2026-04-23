<?php
// ============================================================
// MODUL: FORMULÁŘ – PHP LOGIKA
// Zkopíruj TENTO KÓD NA ÚPLNÝ ZAČÁTEK svého index.php (před <!DOCTYPE html>)
// Uprav: název tabulky, sloupce a DB v db.php
// ============================================================

session_start();
include 'db.php'; // nebo 'MODULY/formular/db.php'

// Zpracování formuláře (POST požadavek)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jmeno'])) {

    // 1) Sanitace vstupů (ochrana proti XSS)
    $jmeno = trim(htmlspecialchars($_POST['jmeno']));
    $email = trim(htmlspecialchars($_POST['email']));
    $predmet = trim(htmlspecialchars($_POST['predmet']));
    $hodnoceni = isset($_POST['hodnoceni']) ? (int) $_POST['hodnoceni'] : 0;
    $kategorie = trim(htmlspecialchars($_POST['kategorie']));
    $popis = trim(htmlspecialchars($_POST['popis']));

    // 2) Server-side validace (povinná pole)
    if (empty($jmeno) || empty($email) || empty($predmet) || empty($hodnoceni) || empty($popis)) {
        $_SESSION['error'] = "Všechna povinná pole musí být vyplněna (včetně hodnocení).";
    } else {
        // 3) Prepared statements – ochrana proti SQL Injection!
        $stmt = $spojeni->prepare(
            "INSERT INTO zaznamy (jmeno, email, predmet, hodnoceni, kategorie, popis) VALUES (?, ?, ?, ?, ?, ?)"
        );
        // Typy: s=string, i=integer
        $stmt->bind_param("ssisis", $jmeno, $email, $predmet, $hodnoceni, $kategorie, $popis);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Záznam byl úspěšně uložen!";
        } else {
            $_SESSION['error'] = "Chyba při ukládání do databáze.";
        }
        $stmt->close();
    }

    // POST → Redirect → GET (zabrání duplikaci při F5)
    header("Location: index.php");
    exit();
}
?>