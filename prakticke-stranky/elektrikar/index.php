<?php
// ============================================================
// PRAKTICKÁ STRÁNKA: ELEKTRIKÁŘ
// Téma: Elektroinstalace / Revize / Hromosvody
// Spusť přes MAMP: http://localhost/moduly_prakticka/prakticke-stranky/elektrikar/
// ============================================================
session_start();
include '../../formular/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kontakt_jmeno'])) {
    $jmeno  = trim(htmlspecialchars($_POST['kontakt_jmeno']));
    $email  = trim(htmlspecialchars($_POST['kontakt_email']));
    $zprava = trim(htmlspecialchars($_POST['kontakt_zprava']));

    if (empty($jmeno) || empty($email) || empty($zprava)) {
        $_SESSION['kontakt_error'] = "Všechna pole jsou povinná.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['kontakt_error'] = "Zadejte platnou e-mailovou adresu.";
    } else {
        $stmt = $spojeni->prepare("INSERT INTO kontakty (jmeno, email, zprava) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $jmeno, $email, $zprava);
        if ($stmt->execute()) {
            $_SESSION['kontakt_success'] = "Zpráva byla úspěšně odeslána! Ozveme se vám co nejdříve.";
        } else {
            $_SESSION['kontakt_error'] = "Chyba při ukládání. Zkuste to prosím znovu.";
        }
        $stmt->close();
    }
    header("Location: index.php#kontakt");
    exit();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elektrikář – Elektroinstalace, revize, hromosvody</title>
    <meta name="description" content="Profesionální elektrikářské služby. Instalace, revize elektřiny, hromosvody. Bezpečná elektřina pro váš domov i firmu.">

    <link rel="stylesheet" href="../../base/base.css">
    <link rel="stylesheet" href="../../header/header.css">
    <link rel="stylesheet" href="../../hero/hero.css">
    <link rel="stylesheet" href="../../obrazky/slideshow.css">
    <link rel="stylesheet" href="../../grid/grid.css">
    <link rel="stylesheet" href="../../kontakt/db/kontakt.css">
    <link rel="stylesheet" href="../../footer/footer.css">

    <style>
        .o-nas { padding: 80px 0; background: #fff; }
        .o-nas-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
        .o-nas-text h2 { font-size: 36px; color: #1a1a2e; margin-bottom: 16px; }
        .o-nas-text p { color: #555; font-size: 16px; line-height: 1.8; margin-bottom: 12px; }
        .o-nas-img {
            width: 100%; height: 320px; background-color: #e0e0e0; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: #888; font-size: 14px; text-align: center; padding: 20px;
            border: 2px dashed #ccc;
        }
        .cta-banner { background: linear-gradient(135deg, #e94560 0%, #c73652 100%); padding: 60px 0; text-align: center; }
        .cta-banner h2 { color: #fff; font-size: 32px; margin-bottom: 12px; }
        .cta-banner p { color: rgba(255,255,255,0.85); font-size: 18px; margin-bottom: 28px; }
        .cta-tel { display: inline-block; font-size: 36px; font-weight: 700; color: #fff; text-decoration: none; border-bottom: 3px solid rgba(255,255,255,0.5); padding-bottom: 4px; transition: border-color 0.3s; }
        .cta-tel:hover { border-bottom-color: #fff; }
        .sluzby-sekce { padding: 80px 0; background-color: #f4f4f8; }
        .sluzby-sekce .section-title { text-align: center; font-size: 36px; color: #1a1a2e; margin-bottom: 48px; }
        .galerie-sekce { padding: 80px 0; background: #fff; }
        .galerie-sekce .section-title { text-align: center; font-size: 36px; color: #1a1a2e; margin-bottom: 36px; }
        @media (max-width: 768px) {
            .o-nas-grid { grid-template-columns: 1fr; gap: 30px; }
            .cta-banner h2 { font-size: 24px; }
            .cta-tel { font-size: 28px; }
        }
    </style>

    <script src="../../header/header.js" defer></script>
    <script src="../../obrazky/slideshow.js" defer></script>
</head>
<body>

    <!-- ======= HEADER ======= -->
    <header>
        <div class="wrapper">
            <a href="/" class="wrapper-logo">
                <span class="logo-text">⚡ Elektrikář</span>
            </a>
            <button class="hamburger" id="hamburgerBtn" aria-label="Otevřít menu">
                <span class="stick"></span>
                <span class="stick"></span>
                <span class="stick"></span>
            </button>
            <nav id="mainNav">
                <a href="#uvod"    class="nav-link active">Úvod</a>
                <a href="#o-nas"   class="nav-link">O nás</a>
                <a href="#galerie" class="nav-link">Galerie</a>
                <a href="#sluzby"  class="nav-link">Služby</a>
                <a href="#kontakt" class="nav-link">Kontakt</a>
            </nav>
        </div>
    </header>

    <main>

        <!-- ======= HERO ======= -->
        <section class="hero hero--img" id="uvod" style="background-image: url('')">
            <!-- [FOTO: Elektrikář při práci – zapojování rozvaděče, instalace zásuvek nebo kabelů] -->
            <div class="wrapper">
                <div class="hero-content">
                    <h1 class="hero-title">Bezpečná<br><span>elektroinstalace</span></h1>
                    <p class="hero-subtitle">
                        Profesionální elektrikářské práce pro domácnosti i firmy.
                        Instalace, revize a hromosvody – vše na klíč.
                    </p>
                    <div class="hero-buttons">
                        <a href="#kontakt" class="btn btn-primary">Nezávazná poptávka</a>
                        <a href="#sluzby"  class="btn btn-ghost">Naše služby</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= O NÁS ======= -->
        <section class="o-nas" id="o-nas">
            <div class="wrapper">
                <div class="o-nas-grid">
                    <div class="o-nas-text">
                        <h2>Kdo jsme</h2>
                        <p>
                            Jsme zkušení elektrikáři s certifikací dle platných norem ČSN.
                            Provádíme elektroinstalace v rodinných domech, bytech i průmyslových objektech.
                        </p>
                        <p>
                            Každá naše instalace splňuje přísné bezpečnostní normy a je doložena
                            revizní zprávou. Pracujeme čistě, rychle a bez zbytečného bordelu.
                        </p>
                        <p>
                            Dostupní <strong>Po–So 7:00–18:00</strong>,
                            havarijní výjezdy i o víkendech.
                        </p>
                    </div>
                    <div class="o-nas-img">
                        <!-- [FOTO: Elektrikář při zapojování rozvaděče nebo pohled na dokončenou instalaci] -->
                        📷 Sem vložte fotografii dokončené elektroinstalace nebo práce v rozvaděči
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= GALERIE ======= -->
        <section class="galerie-sekce" id="galerie">
            <div class="wrapper">
                <h2 class="section-title">Ukázky naší práce</h2>
                <div class="slideshow" id="slideshow">
                    <div class="slide active">
                        <img src="" alt="[FOTO: Nový rozvaděč – přehledně zapojené jističe a kabely]">
                        <div class="slide-caption">Instalace a zapojení rozvaděčů</div>
                    </div>
                    <div class="slide">
                        <img src="" alt="[FOTO: Venkovní osvětlení domu nebo zahradní světla po instalaci]">
                        <div class="slide-caption">Venkovní osvětlení a přívodní vedení</div>
                    </div>
                    <div class="slide">
                        <img src="" alt="[FOTO: Revizní měření – elektrikář s měřicím přístrojem]">
                        <div class="slide-caption">Revize a kontrola elektroinstalací</div>
                    </div>
                    <button class="slide-btn prev" id="slidePrev">&#10094;</button>
                    <button class="slide-btn next" id="slideNext">&#10095;</button>
                    <div class="slide-dots" id="slideDots"></div>
                </div>
            </div>
        </section>

        <!-- ======= SLUŽBY ======= -->
        <section class="sluzby-sekce" id="sluzby">
            <div class="wrapper">
                <h2 class="section-title">Naše služby</h2>
                <div class="grid grid-3col">
                    <div class="grid-card">
                        <h3>⚡ Elektroinstalace</h3>
                        <p>Kompletní elektroinstalace na klíč – zásuvky, vypínače, rozvody, rozvaděče. Novostavby i rekonstrukce.</p>
                    </div>
                    <div class="grid-card">
                        <h3>📋 Revize a kontroly</h3>
                        <p>Provádíme výchozí i periodické revize dle ČSN. Revizní zpráva jako doklad pro pojišťovnu i kolaudaci.</p>
                    </div>
                    <div class="grid-card">
                        <h3>🌩️ Hromosvody a uzemnění</h3>
                        <p>Instalace hromosvodů, uzemnění a přepěťové ochrany. Ochrana domu i elektroniky před bouřkami.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= CTA BANNER ======= -->
        <section class="cta-banner">
            <div class="wrapper">
                <h2>Bezpečná elektřina – zavolejte ještě dnes</h2>
                <p>Poradíme, nacenujeme a domluvíme termín rychle a bez závazků.</p>
                <a href="tel:+420123456789" class="cta-tel">+420 123 456 789</a>
            </div>
        </section>

        <!-- ======= KONTAKT ======= -->
        <section class="kontakt-sekce" id="kontakt">
            <div class="wrapper">
                <h2 class="section-title">Kontaktujte nás</h2>
                <p class="section-subtitle">Napište nám zprávu a ozveme se vám co nejdříve.</p>
                <div class="kontakt-container">
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
                                <input type="text" name="kontakt_jmeno" id="kontakt_jmeno" placeholder="Jan Novák" required>
                            </div>
                            <div class="kontakt-group">
                                <label for="kontakt_email">E-mail *</label>
                                <input type="email" name="kontakt_email" id="kontakt_email" placeholder="jan@email.cz" required>
                            </div>
                        </div>
                        <div class="kontakt-group">
                            <label for="kontakt_zprava">Zpráva *</label>
                            <textarea name="kontakt_zprava" id="kontakt_zprava" placeholder="Popište váš požadavek nebo dotaz..." required></textarea>
                        </div>
                        <div class="kontakt-buttons">
                            <input type="submit" value="Odeslat zprávu" class="kontakt-btn-submit">
                            <input type="reset"  value="Vymazat"        class="kontakt-btn-reset">
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <!-- ======= FOOTER ======= -->
    <footer>
        <div class="footer-wrapper">
            <div class="footer-col">
                <h3>⚡ Elektrikář</h3>
                <p>Elektroinstalace, revize a hromosvody pro domácnosti i firmy. Bezpečnost na prvním místě.</p>
            </div>
            <div class="footer-col">
                <h4>Navigace</h4>
                <ul>
                    <li><a href="#uvod">Úvod</a></li>
                    <li><a href="#o-nas">O nás</a></li>
                    <li><a href="#galerie">Galerie</a></li>
                    <li><a href="#sluzby">Služby</a></li>
                    <li><a href="#kontakt">Kontakt</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Kontakt</h4>
                <p>📍 Ulice 123, Město</p>
                <p>📞 +420 123 456 789</p>
                <p>✉️ info@elektrikar.cz</p>
                <p>🕐 Po–So: 7:00–18:00</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Elektrikář. Všechna práva vyhrazena.</p>
        </div>
    </footer>

</body>
</html>
