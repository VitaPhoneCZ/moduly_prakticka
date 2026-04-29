<?php
// ============================================================
// PRAKTICKÁ STRÁNKA: ZEDNICKÁ FIRMA
// Téma: Zdění / Omítky / Rekonstrukce
// Spusť přes MAMP: http://localhost/moduly_prakticka/prakticke-stranky/zednicka-firma/
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
    <title>Zednická firma – Zdění, omítky, rekonstrukce budov</title>
    <meta name="description" content="Profesionální zednická firma. Zdění, fasády, omítky a rekonstrukce. Kvalitní stavební práce s tradicí a zárukou.">

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
                <span class="logo-text">🧱 Zednická firma</span>
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
            <!-- [FOTO: Stavba v procesu – zedník při zdění, lešení, nebo pohled na dokončenou fasádu domu] -->
            <div class="wrapper">
                <div class="hero-content">
                    <h1 class="hero-title">Kvalitní stavební práce<br><span>s tradicí</span></h1>
                    <p class="hero-subtitle">
                        Zednická firma s dlouholetou zkušeností. Zdění, omítky,
                        fasády a rekonstrukce – vše provedeno precizně a na čas.
                    </p>
                    <div class="hero-buttons">
                        <a href="#kontakt" class="btn btn-primary">Poptat práce</a>
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
                        <h2>O naší firmě</h2>
                        <p>
                            Jsme rodinná zednická firma s tradicí sahající přes dvě desetiletí.
                            Za tu dobu jsme dokončili stovky projektů – od menších oprav po
                            kompletní rekonstrukce rodinných domů.
                        </p>
                        <p>
                            Pracujeme poctivě, s důrazem na kvalitu materiálů a preciznost
                            provedení. Každou zakázku zakončujeme kontrolou a úklidem staveniště.
                        </p>
                        <p>
                            Disponujeme vlastní technikou a pracujeme po celém regionu.
                            Bezplatná prohlídka a cenová nabídka <strong>do 48 hodin</strong>.
                        </p>
                    </div>
                    <div class="o-nas-img">
                        <!-- [FOTO: Tým zedníků při práci na stavbě, nebo pohled na dokončenou stavbu či rekonstrukci] -->
                        📷 Sem vložte fotografii týmu při práci nebo dokončeného projektu
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= GALERIE ======= -->
        <section class="galerie-sekce" id="galerie">
            <div class="wrapper">
                <h2 class="section-title">Realizované projekty</h2>
                <div class="slideshow" id="slideshow">
                    <div class="slide active">
                        <img src="" alt="[FOTO: Zdění – zedník klade cihly nebo tvárnice, přesná spára, lešení v pozadí]">
                        <div class="slide-caption">Novostavby a přístavby</div>
                    </div>
                    <div class="slide">
                        <img src="" alt="[FOTO: Fasáda rodinného domu po dokončení – rovná omítka, čistý povrch, nové barvy]">
                        <div class="slide-caption">Fasády a zateplení budov</div>
                    </div>
                    <div class="slide">
                        <img src="" alt="[FOTO: Rekonstrukce bytu – strhávání omítek, nové příčky nebo pohled na dokončený interiér]">
                        <div class="slide-caption">Rekonstrukce interiérů</div>
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
                        <h3>🧱 Zdění a příčky</h3>
                        <p>Zdění z cihel, tvárnic a porobetonu. Příčky, nosné zdi, komíny. Novostavby i rozšíření stávajících objektů.</p>
                    </div>
                    <div class="grid-card">
                        <h3>🏠 Fasády a omítky</h3>
                        <p>Venkovní fasády, zateplení budov, sádrové a vápenné omítky. Štukatérské práce a dekorativní povrchy.</p>
                    </div>
                    <div class="grid-card">
                        <h3>🔨 Rekonstrukce</h3>
                        <p>Kompletní rekonstrukce bytů a rodinných domů. Bourací práce, sanace vlhkosti, obnova historických omítek.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= CTA BANNER ======= -->
        <section class="cta-banner">
            <div class="wrapper">
                <h2>Stavíme s kvalitou a tradicí</h2>
                <p>Zavolejte nám – přijedeme, prohlédneme a nacenujeme zdarma.</p>
                <a href="tel:+420123456789" class="cta-tel">+420 123 456 789</a>
            </div>
        </section>

        <!-- ======= KONTAKT ======= -->
        <section class="kontakt-sekce" id="kontakt">
            <div class="wrapper">
                <h2 class="section-title">Kontaktujte nás</h2>
                <p class="section-subtitle">Popište nám váš projekt a my vám zdarma připravíme cenovou nabídku.</p>
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
                            <label for="kontakt_zprava">Popis projektu / Zpráva *</label>
                            <textarea name="kontakt_zprava" id="kontakt_zprava" placeholder="Popište co potřebujete udělat – druh prací, rozsah, lokalita..." required></textarea>
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
                <h3>🧱 Zednická firma</h3>
                <p>Profesionální zednické práce – zdění, omítky, fasády a rekonstrukce s tradicí a zárukou kvality.</p>
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
                <p>✉️ info@zednicka-firma.cz</p>
                <p>🕐 Po–Pá: 7:00–16:00</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Zednická firma. Všechna práva vyhrazena.</p>
        </div>
    </footer>

</body>
</html>
