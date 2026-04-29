<!-- ============================================================
     MODUL: KONTAKT FORMULÁŘ – DB verze (ukládání do databáze)
     Použití: zkopíruj sekci do svého index.php
     Připoj:  <link rel="stylesheet" href="MODULY/kontakt/db/kontakt.css">
     Logika:  zkopíruj kontakt-logika.php na začátek index.php (před DOCTYPE)
     SQL:     importuj kontakt-databaze.sql přes phpMyAdmin
     ============================================================ -->

<!-- PHP logika patří NA ZAČÁTEK souboru (před <!DOCTYPE html>) -->
<!-- Viz: MODULY/kontakt/db/kontakt-logika.php -->

<section class="kontakt-sekce" id="kontakt">
    <div class="wrapper">
        <h2 class="section-title">Kontaktujte nás</h2>
        <p class="section-subtitle">Napište nám zprávu a ozveme se vám co nejdříve.</p>

        <div class="kontakt-container">
            <!-- Zpětná vazba ze SESSION -->
            <div class="kontakt-feedback">
                <?php
                if (isset($_SESSION['kontakt_error'])) {
                    echo '<p class="kontakt-error">' . $_SESSION['kontakt_error'] . '</p>';
                    unset($_SESSION['kontakt_error']);
                }
                if (isset($_SESSION['kontakt_success'])) {
                    echo '<p class="kontakt-success">' . $_SESSION['kontakt_success'] . '</p>';
                    unset($_SESSION['kontakt_success']);
                }
                ?>
            </div>

            <form action="index.php" method="POST" class="kontakt-form">
                <div class="kontakt-row">
                    <div class="kontakt-group">
                        <label for="kontakt_jmeno">Jméno *</label>
                        <input type="text" name="kontakt_jmeno" id="kontakt_jmeno"
                               placeholder="Jan Novák" required>
                    </div>
                    <div class="kontakt-group">
                        <label for="kontakt_email">E-mail *</label>
                        <input type="email" name="kontakt_email" id="kontakt_email"
                               placeholder="jan@email.cz" required>
                    </div>
                </div>

                <div class="kontakt-group">
                    <label for="kontakt_zprava">Zpráva *</label>
                    <textarea name="kontakt_zprava" id="kontakt_zprava"
                              placeholder="Sem napište vaši zprávu..." required></textarea>
                </div>

                <div class="kontakt-buttons">
                    <input type="submit" value="Odeslat zprávu" class="kontakt-btn-submit">
                    <input type="reset" value="Vymazat" class="kontakt-btn-reset">
                </div>
            </form>
        </div>
    </div>
</section>
