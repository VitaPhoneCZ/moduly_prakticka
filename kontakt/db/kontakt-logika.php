<?php
// ============================================================
// MODUL: KONTAKT/DB – PHP logika (ukládání do databáze)
// Zkopíruj TENTO KÓD NA ÚPLNÝ ZAČÁTEK svého index.php (před <!DOCTYPE html>)
// Vyžaduje: include '../formular/db.php'; (nebo nastav cestu k db.php)
// ============================================================

session_start();
include '../../formular/db.php'; // ← UPRAV cestu k db.php dle umístění souboru

// Zpracování formuláře (POST požadavek)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kontakt_jmeno'])) {

    // 1) Sanitace vstupů (ochrana proti XSS)
    $jmeno  = trim(htmlspecialchars($_POST['kontakt_jmeno']));
    $email  = trim(htmlspecialchars($_POST['kontakt_email']));
    $zprava = trim(htmlspecialchars($_POST['kontakt_zprava']));

    // 2) Server-side validace povinných polí
    if (empty($jmeno) || empty($email) || empty($zprava)) {
        $_SESSION['kontakt_error'] = "Všechna pole jsou povinná.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['kontakt_error'] = "Zadejte platnou e-mailovou adresu.";
    } else {
        // 3) Prepared statement – ochrana proti SQL Injection!
        $stmt = $spojeni->prepare(
            "INSERT INTO kontakty (jmeno, email, zprava) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $jmeno, $email, $zprava);

        if ($stmt->execute()) {
            $_SESSION['kontakt_success'] = "Zpráva byla úspěšně odeslána! Ozveme se vám co nejdříve.";
        } else {
            $_SESSION['kontakt_error'] = "Chyba při ukládání. Zkuste to prosím znovu.";
        }
        $stmt->close();
    }

    // POST → Redirect → GET (zabrání duplikaci při F5)
    header("Location: index.php#kontakt");
    exit();
}
?>
