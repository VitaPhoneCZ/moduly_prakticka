<?php
// ============================================================
// MODUL: KONTAKT/MAIL – PHP logika (odesílání emailem)
// Zkopíruj TENTO KÓD NA ÚPLNÝ ZAČÁTEK svého index.php (před <!DOCTYPE html>)
// POZOR: PHP mail() funguje jen pokud má server nakonfigurovaný sendmail/SMTP
//        Na lokálním MAMP to výchozně nefunguje – použij spíš kontakt/db/ verzi!
// ============================================================

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kontakt_jmeno'])) {

    // 1) Sanitace vstupů
    $jmeno  = trim(htmlspecialchars($_POST['kontakt_jmeno']));
    $email  = trim(htmlspecialchars($_POST['kontakt_email']));
    $zprava = trim(htmlspecialchars($_POST['kontakt_zprava']));

    // 2) Validace
    if (empty($jmeno) || empty($email) || empty($zprava)) {
        $_SESSION['kontakt_error'] = "Všechna pole jsou povinná.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['kontakt_error'] = "Zadejte platnou e-mailovou adresu.";
    } else {

        // 3) Nastavení emailu
        $cil_email = "vas@email.cz";   // ← ZDE NASTAV CÍL EMAIL (kam přijde zpráva)
        $predmet   = "Nová zpráva z webu od: " . $jmeno;
        $obsah     = "Jméno: {$jmeno}\nEmail: {$email}\n\nZpráva:\n{$zprava}";
        $hlavicky  = "From: noreply@vasedomena.cz\r\n";       // ← uprav doménu
        $hlavicky .= "Reply-To: {$email}\r\n";
        $hlavicky .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // 4) Odeslání
        if (mail($cil_email, $predmet, $obsah, $hlavicky)) {
            $_SESSION['kontakt_success'] = "Zpráva byla úspěšně odeslána! Ozveme se vám co nejdříve.";
        } else {
            $_SESSION['kontakt_error'] = "Chyba při odesílání e-mailu. Zkuste to prosím znovu.";
        }
    }

    // POST → Redirect → GET
    header("Location: index.php#kontakt");
    exit();
}
?>
