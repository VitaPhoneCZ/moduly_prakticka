<?php
// ============================================================
// PRAKTICKÁ STRÁNKA: AUTOMECHANIK
// Téma: Autoservis / Pneuservis / Oprava vozidel
// Spusť přes MAMP: http://localhost/moduly_prakticka/prakticke-stranky/automechanik/
// ============================================================
session_start();
include '../../formular/db.php'; // připojení k databázi

// Zpracování kontaktního formuláře
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
    <title>Autoservis – Opravy vozidel, pneuservis, diagnostika</title>
    <meta name="description" content="Profesionální autoservis. Opravy motorů, pneuservis, diagnostika. Rychlá a spolehlivá pomoc pro váš vůz.">

    <!-- Base reset (vždy první) -->
    <link rel="stylesheet" href="../../base/base.css">

    <!-- Moduly -->
    <link rel="stylesheet" href="../../header/header.css">
    <link rel="stylesheet" href="../../hero/hero.css">
    <link rel="stylesheet" href="../../obrazky/slideshow.css">
    <link rel="stylesheet" href="../../grid/grid.css">
    <link rel="stylesheet" href="../../kontakt/db/kontakt.css">
    <link rel="stylesheet" href="../../footer/footer.css">

    <!-- Inline styly specifické pro tuto stránku -->
    <style>
        /* ---- O nás sekce ---- */
        .o-nas {
            padding: 80px 0;
            background: #fff;
        }
        .o-nas-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .o-nas-text h2 {
            font-size: 36px;
            color: #1a1a2e;
            margin-bottom: 16px;
        }
        .o-nas-text p {
            color: #555;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 12px;
        }
        .o-nas-img {
            width: 100%;
            height: 320px;
            border-radius: 12px;
            overflow: hidden;
        }
        .o-nas-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
            display: block;
        }

        /* ---- CTA Banner ---- */
        .cta-banner {
            background: linear-gradient(135deg, #e94560 0%, #c73652 100%);
            padding: 60px 0;
            text-align: center;
        }
        .cta-banner h2 {
            color: #fff;
            font-size: 32px;
            margin-bottom: 12px;
        }
        .cta-banner p {
            color: rgba(255,255,255,0.85);
            font-size: 18px;
            margin-bottom: 28px;
        }
        .cta-tel {
            display: inline-block;
            font-size: 36px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            border-bottom: 3px solid rgba(255,255,255,0.5);
            padding-bottom: 4px;
            transition: border-color 0.3s;
        }
        .cta-tel:hover { border-bottom-color: #fff; }

        /* ---- Sekce služby ---- */
        .sluzby-sekce {
            padding: 80px 0;
            background-color: #f4f4f8;
        }
        .sluzby-sekce .section-title {
            text-align: center;
            font-size: 36px;
            color: #1a1a2e;
            margin-bottom: 48px;
        }

        /* ---- Galerie ---- */
        .galerie-sekce {
            padding: 80px 0;
            background: #fff;
        }
        .galerie-sekce .section-title {
            text-align: center;
            font-size: 36px;
            color: #1a1a2e;
            margin-bottom: 36px;
        }

        /* ---- Responzivita O nás ---- */
        @media (max-width: 768px) {
            .o-nas-grid { grid-template-columns: 1fr; gap: 30px; }
            .cta-banner h2 { font-size: 24px; }
            .cta-tel { font-size: 28px; }
        }
    </style>

    <!-- JS -->
    <script src="../../header/header.js" defer></script>
    <script src="../../obrazky/slideshow.js" defer></script>
</head>
<body>

    <!-- ======= HEADER ======= -->
    <header>
        <div class="wrapper">
            <a href="/" class="wrapper-logo">
                <span class="logo-text">🔧 Autoservis</span>
            </a>
            <button class="hamburger" id="hamburgerBtn" aria-label="Otevřít menu">
                <span class="stick"></span>
                <span class="stick"></span>
                <span class="stick"></span>
            </button>
            <nav id="mainNav">
                <a href="#uvod"   class="nav-link active">Úvod</a>
                <a href="#o-nas"  class="nav-link">O nás</a>
                <a href="#galerie" class="nav-link">Galerie</a>
                <a href="#sluzby" class="nav-link">Služby</a>
                <a href="#kontakt" class="nav-link">Kontakt</a>
            </nav>
        </div>
    </header>

    <main>

        <!-- ======= HERO ======= -->
        <!-- Varianta s fotkou: přidej třídu hero--img a style="background-image: url('foto.jpg')" -->
        <section class="hero hero--img" id="uvod" style="background-image: url('https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1190000/page_bg_raw.jpg?t=1777037970')">
            <!-- [FOTO: Exteriér autoservisu nebo pohled na dílnu s automobily] -->
            <div class="wrapper">
                <div class="hero-content">
                    <h1 class="hero-title">Váš spolehlivý<br><span>autoservis</span></h1>
                    <p class="hero-subtitle">
                        Rychlé a profesionální opravy vozidel všech značek.
                        Pneuservis, diagnostika a servis na jednom místě.
                    </p>
                    <div class="hero-buttons">
                        <a href="#kontakt" class="btn btn-primary">Objednat se</a>
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
                        <h2>O našem servisu</h2>
                        <p>
                            Jsme rodinný autoservis s dlouholetou tradicí. Staráme se o vaše
                            vozidlo s maximální pečlivostí a za férové ceny. Naši mechanici
                            mají certifikaci pro všechny běžné i exotické značky.
                        </p>
                        <p>
                            Díky modernímu vybavení jsme schopni provést kompletní diagnostiku
                            vozidla a odhalit i skrytá poškození. Vždy vás informujeme o stavu
                            vozu dříve, než začneme s opravou.
                        </p>
                        <p>
                            Jsme otevřeni <strong>Po–Pá 7:00–17:00</strong>, v naléhavých
                            případech se domluvíme individuálně.
                        </p>
                    </div>
                    <div class="o-nas-img">
                        <img src="https://fuu-sachsen.international/wp-content/uploads/sites/4/2019/10/71933769_1083444518713610_2708774253691404288_n-1024x768.jpg"
                             alt="Interiér dílny – mechanik při práci na vozidle">
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= GALERIE (SLIDESHOW) ======= -->
        <section class="galerie-sekce" id="galerie">
            <div class="wrapper">
                <h2 class="section-title">Naše práce</h2>
                <div class="slideshow" id="slideshow">
                    <div class="slide active">
                        <img src="https://www.klavkarr.com/blog/image/service-reset-1-reset-oil-service-light-dacia.webp" alt="[FOTO: Oprava motoru – demontáž a kontrola motorových dílů]">
                        <div class="slide-caption">Opravy motorů a převodovek</div>
                    </div>
                    <div class="slide">
                        <img src="https://cdn.skoda-storyboard.com/2019/03/skoda-fabia-r5-motorsport-mechanic-1440x1061.jpg" alt="[FOTO: Pneuservis – montáž pneumatiky na disk, přezouvání]">
                        <div class="slide-caption">Pneuservis a výměna kol</div>
                    </div>
                    <div class="slide">
                        <img src="https://res.cloudinary.com/dkaezguiw/images/w_448,h_301,dpr_2/f_auto,q_auto/v1729837346/pic-3-4/pic-3-4.jpg?_i=AA" alt="[FOTO: Diagnostické zařízení připojené k palubní počítači vozu]">
                        <div class="slide-caption">Moderní autodiagnostika</div>
                    </div>
                    <button class="slide-btn prev" id="slidePrev">&#10094;</button>
                    <button class="slide-btn next" id="slideNext">&#10095;</button>
                    <div class="slide-dots" id="slideDots"></div>
                </div>
            </div>
        </section>

        <!-- ======= SLUŽBY (GRID) ======= -->
        <section class="sluzby-sekce" id="sluzby">
            <div class="wrapper">
                <h2 class="section-title">Naše služby</h2>
                <div class="grid grid-3col">
                    <div class="grid-card">
                        <h3>🔧 Opravy motorů</h3>
                        <p>Kompletní opravy a generální revize motorů všech typů. Výměna oleje, filtrů, rozvodů a dalších dílů.</p>
                    </div>
                    <div class="grid-card">
                        <h3>🛞 Pneuservis</h3>
                        <p>Přezouvání, vyvažování a skladování pneumatik. Kompletní servis kol a disků pro osobní i SUV vozy.</p>
                    </div>
                    <div class="grid-card">
                        <h3>💻 Autodiagnostika</h3>
                        <p>Moderní diagnostika elektroniky vozidla. Čtení a mazání chybových kódů, kontrola senzorů a systémů.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= CTA BANNER ======= -->
        <section class="cta-banner">
            <div class="wrapper">
                <h2>Váš vůz si zaslouží to nejlepší</h2>
                <p>Zavolejte nám a domluvte se na termínu – reagujeme rychle!</p>
                <a href="tel:+420123456789" class="cta-tel">+420 123 456 789</a>
            </div>
        </section>

        <!-- ======= KONTAKT FORMULÁŘ (DB verze) ======= -->
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
                            <textarea name="kontakt_zprava" id="kontakt_zprava" placeholder="Popište váš problém nebo dotaz..." required></textarea>
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
                <h3>🔧 Autoservis</h3>
                <p>Profesionální opravy vozidel, pneuservis a diagnostika. Kvalita a férovost na prvním místě.</p>
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
                <p>✉️ servis@autoservis.cz</p>
                <p>🕐 Po–Pá: 7:00–17:00</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Autoservis. Všechna práva vyhrazena.</p>
        </div>
    </footer>

</body>
</html>
