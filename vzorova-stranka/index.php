<?php
// ============================================================
// VZOROVÁ STRÁNKA – ukázka použití všech modulů
// Spusť přes MAMP: http://localhost/priprava_maturita/MODULY/vzorova-stranka/
// ============================================================
session_start();
include '../formular/db.php';

// Pomocná funkce – relativní čas ("Před 2 hodinami", "Včera"...)
function cas_relativni(string $datum): string {
    $ted   = new DateTime();
    $potom = new DateTime($datum);
    $diff  = $ted->diff($potom);
    if ($diff->y >= 1) return 'Před ' . $diff->y . ' ' . ($diff->y === 1 ? 'rokem' : ($diff->y < 5 ? 'lety' : 'lety'));
    if ($diff->m >= 1) return 'Před ' . $diff->m . ' ' . ($diff->m === 1 ? 'měsícem' : ($diff->m < 5 ? 'měsíci' : 'měsíci'));
    if ($diff->d >= 2) return 'Před ' . $diff->d . ' dny';
    if ($diff->d === 1) return 'Včera';
    if ($diff->h >= 1) return 'Před ' . $diff->h . ' ' . ($diff->h === 1 ? 'hodinou' : ($diff->h < 5 ? 'hodinami' : 'hodinami'));
    if ($diff->i >= 1) return 'Před ' . $diff->i . ' min';
    return 'Právě teď';
}

// Zpracování formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jmeno'])) {
    $jmeno     = trim(htmlspecialchars($_POST['jmeno']));
    $email     = trim(htmlspecialchars($_POST['email']));
    $predmet   = trim(htmlspecialchars($_POST['predmet']));
    $hodnoceni = isset($_POST['hodnoceni']) ? (int)$_POST['hodnoceni'] : 0;
    $kategorie = trim(htmlspecialchars($_POST['kategorie'] ?? 'A'));
    $popis     = trim(htmlspecialchars($_POST['popis']));

    if (empty($jmeno) || empty($email) || empty($predmet) || empty($hodnoceni) || empty($popis)) {
        $_SESSION['error'] = "Všechna povinná pole musí být vyplněna (včetně hodnocení).";
    } else {
        $stmt = $spojeni->prepare(
            "INSERT INTO zaznamy (jmeno, email, predmet, hodnoceni, kategorie, popis) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssiss", $jmeno, $email, $predmet, $hodnoceni, $kategorie, $popis);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Záznam byl úspěšně uložen!";
        } else {
            $_SESSION['error'] = "Chyba při ukládání do databáze.";
        }
        $stmt->close();
    }
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vzorová stránka – Moduly</title>
    <meta name="description" content="Vzorová maturitní stránka s ukázkou všech modulů.">

    <!-- BASE reset (připoj vždy jako první!) -->
    <link rel="stylesheet" href="../base/base.css">

    <!-- Moduly -->
    <link rel="stylesheet" href="../mobilni-header/mobilni-header.css">
    <link rel="stylesheet" href="../hero/hero.css">
    <link rel="stylesheet" href="../obrazky/slideshow.css">
    <link rel="stylesheet" href="../grid/grid.css">
    <link rel="stylesheet" href="../formular/formular.css">
    <link rel="stylesheet" href="../db-vypis/db-vypis.css">
    <link rel="stylesheet" href="../footer/footer.css">

    <!-- Scripty (defer = načte se po HTML) -->
    <script src="../mobilni-header/mobilni-header.js" defer></script>
    <script src="../obrazky/slideshow.js" defer></script>
</head>
<body>

    <!-- ======= MODUL: MOBILNÍ HEADER ======= -->
    <header>
        <div class="wrapper">
            <a href="/" class="wrapper-logo">
                <span class="logo-text">MůjWeb</span>
            </a>
            <button class="hamburger" id="hamburgerBtn" aria-label="Otevřít menu">
                <span class="stick"></span>
                <span class="stick"></span>
                <span class="stick"></span>
            </button>
            <nav id="mainNav">
                <a href="#uvod" class="nav-link active">Úvod</a>
                <a href="#galerie" class="nav-link">Galerie</a>
                <a href="#sluzby" class="nav-link">Služby</a>
                <a href="#formular" class="nav-link">Formulář</a>
                <a href="#zaznamy" class="nav-link">Záznamy</a>
            </nav>
        </div>
    </header>

    <main>

        <!-- ======= MODUL: HERO SEKCE ======= -->
        <section class="hero" id="uvod">
            <div class="wrapper">
                <div class="hero-content">
                    <h1 class="hero-title">Vítej na <span>vzorové</span> stránce</h1>
                    <p class="hero-subtitle">
                        Tato stránka ukazuje, jak použít všechny připravené moduly
                        pro maturitní praktickou zkoušku.
                    </p>
                    <div class="hero-buttons">
                        <a href="#formular" class="btn btn-primary">Přidat záznam</a>
                        <a href="#zaznamy" class="btn btn-ghost">Zobrazit záznamy</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= MODUL: SLIDESHOW ======= -->
        <section style="padding: 60px 0; background:#fff;" id="galerie">
            <div class="wrapper">
                <h2 class="section-title" style="text-align:center; margin-bottom:30px;">Galerie – Slideshow</h2>
                <div class="slideshow" id="slideshow">
                    <div class="slide active">
                        <!-- Placeholder obrázky (barva + text) -->
                        <img src="https://placehold.co/900x400/1a1a2e/e94560?text=Slide+1" alt="Slide 1">
                        <div class="slide-caption">První obrázek – nahraď src za vlastní</div>
                    </div>
                    <div class="slide">
                        <img src="https://placehold.co/900x400/16213e/ffffff?text=Slide+2" alt="Slide 2">
                        <div class="slide-caption">Druhý obrázek</div>
                    </div>
                    <div class="slide">
                        <img src="https://placehold.co/900x400/0f3460/e94560?text=Slide+3" alt="Slide 3">
                        <div class="slide-caption">Třetí obrázek</div>
                    </div>
                    <button class="slide-btn prev" id="slidePrev">&#10094;</button>
                    <button class="slide-btn next" id="slideNext">&#10095;</button>
                    <div class="slide-dots" id="slideDots"></div>
                </div>
            </div>
        </section>

        <!-- ======= MODUL: GRID 3 sloupce ======= -->
        <section class="grid-section" id="sluzby">
            <div class="wrapper">
                <h2 class="section-title">Naše Služby – Grid 3 sloupce</h2>
                <div class="grid grid-3col">
                    <div class="grid-card">
                        <h3>🎨 Design</h3>
                        <p>Tvoříme moderní a responzivní webové stránky na míru každému klientovi.</p>
                    </div>
                    <div class="grid-card">
                        <h3>💻 Vývoj</h3>
                        <p>Programujeme v PHP, HTML, CSS a JavaScript. Propojujeme databáze.</p>
                    </div>
                    <div class="grid-card">
                        <h3>🗄️ Databáze</h3>
                        <p>Navrhujeme MySQL databáze, importujeme data přes phpMyAdmin.</p>
                    </div>
                    <div class="grid-card">
                        <h3>📱 Responzivita</h3>
                        <p>Každá stránka funguje na mobilu, tabletu i počítači pomocí Media Queries.</p>
                    </div>
                    <div class="grid-card">
                        <h3>🔒 Bezpečnost</h3>
                        <p>Prepared statements, htmlspecialchars a SESSION ochrana jsou základ.</p>
                    </div>
                    <div class="grid-card">
                        <h3>⚡ Výkon</h3>
                        <p>Optimalizujeme rychlost – script defer, minimální závislosti.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= MODUL: FORMULÁŘ ======= -->
        <section style="padding: 60px 0; background:#fff;" id="formular">
            <div class="wrapper">
                <div class="formular-container">
                    <div class="formular-feedback">
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<p class="feedback-error">' . $_SESSION['error'] . '</p>';
                            unset($_SESSION['error']);
                        }
                        if (isset($_SESSION['success'])) {
                            echo '<p class="feedback-success">' . $_SESSION['success'] . '</p>';
                            unset($_SESSION['success']);
                        }
                        ?>
                    </div>
                    <h2>Přidat záznam</h2>
                    <form action="index.php" method="POST" class="formular">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="jmeno">Jméno *</label>
                                <input type="text" name="jmeno" id="jmeno" placeholder="Jan Novák" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" name="email" id="email" placeholder="jan@email.cz" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="predmet">Předmět *</label>
                            <input type="text" name="predmet" id="predmet" placeholder="Název předmětu" required>
                        </div>
                        <div class="form-group">
                            <p class="form-label">Hodnocení ⭐</p>
                            <div class="radio-group">
                                <input type="radio" name="hodnoceni" id="h1" value="1"><label for="h1">1</label>
                                <input type="radio" name="hodnoceni" id="h2" value="2"><label for="h2">2</label>
                                <input type="radio" name="hodnoceni" id="h3" value="3"><label for="h3">3</label>
                                <input type="radio" name="hodnoceni" id="h4" value="4"><label for="h4">4</label>
                                <input type="radio" name="hodnoceni" id="h5" value="5"><label for="h5">5</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kategorie">Kategorie</label>
                            <select name="kategorie" id="kategorie">
                                <option value="A">Kategorie A</option>
                                <option value="B">Kategorie B</option>
                                <option value="C">Kategorie C</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="popis">Popis *</label>
                            <textarea name="popis" id="popis" rows="4" placeholder="Sem napište zprávu..." required></textarea>
                        </div>
                        <div class="form-buttons">
                            <input type="submit" value="Odeslat" class="btn-submit">
                            <input type="reset" value="Vymazat" class="btn-reset">
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- ======= MODUL: VÝPIS Z DB (s pagiací) ======= -->
        <section class="db-vypis-sekce" id="zaznamy">
            <div class="wrapper">
                <h2 class="section-title">Záznamy z databáze</h2>
                <?php
                // ---- Paginace ----
                $na_stranku = 9;
                $stranka    = max(1, (int)($_GET['stranka'] ?? 1));
                $offset     = ($stranka - 1) * $na_stranku;

                // Celkový počet záznamů
                $celkem_res = $spojeni->query("SELECT COUNT(*) AS pocet FROM zaznamy");
                $celkem     = (int)$celkem_res->fetch_assoc()['pocet'];
                $stran_celkem = (int)ceil($celkem / $na_stranku);

                // Záznamy pro aktuální stránku
                $stmt = $spojeni->prepare(
                    "SELECT * FROM zaznamy ORDER BY id DESC LIMIT ? OFFSET ?"
                );
                $stmt->bind_param("ii", $na_stranku, $offset);
                $stmt->execute();
                $vysledek = $stmt->get_result();
                ?>

                <div class="db-vypis">
                    <?php
                    if ($vysledek && $vysledek->num_rows > 0) {
                        while ($radek = $vysledek->fetch_assoc()) {
                            $jmeno     = htmlspecialchars($radek['jmeno']);
                            $email     = htmlspecialchars($radek['email']);
                            $predmet   = htmlspecialchars($radek['predmet']);
                            $hodnoceni = (int)$radek['hodnoceni'];
                            $popis     = htmlspecialchars($radek['popis']);
                            // Relativní čas – pouze pokud sloupec existuje
                            $cas = isset($radek['datum_pridani'])
                                ? cas_relativni($radek['datum_pridani'])
                                : '';
                            echo "
                            <div class='db-karta'>
                                <div class='db-karta-header'>
                                    <h3>{$jmeno}</h3>
                                    <span class='db-cas'>{$cas}</span>
                                </div>
                                <p class='db-email'>{$email}</p>
                                <p><strong>{$predmet}</strong></p>
                                <p class='db-hvezdy'>" . str_repeat("⭐", $hodnoceni) . "</p>
                                <p class='db-popis'>{$popis}</p>
                            </div>
                            ";
                        }
                    } else {
                        echo "<p class='db-prazdno'>Zatím nejsou žádné záznamy. Přidej první přes formulář výše! ⬆️</p>";
                    }
                    ?>
                </div>

                <!-- Paginace - tlačítka -->
                <?php if ($stran_celkem > 1): ?>
                <div class="db-paginace">
                    <?php if ($stranka > 1): ?>
                        <a href="?stranka=<?= $stranka - 1 ?>#zaznamy" class="db-pag-btn">&laquo; Předchozí</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $stran_celkem; $i++): ?>
                        <a href="?stranka=<?= $i ?>#zaznamy"
                           class="db-pag-btn <?= $i === $stranka ? 'db-pag-aktivni' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($stranka < $stran_celkem): ?>
                        <a href="?stranka=<?= $stranka + 1 ?>#zaznamy" class="db-pag-btn">Další &raquo;</a>
                    <?php endif; ?>

                    <span class="db-pag-info">Strana <?= $stranka ?> z <?= $stran_celkem ?> (celkem <?= $celkem ?> záznamů)</span>
                </div>
                <?php endif; ?>

            </div>
        </section>

    </main>

    <!-- ======= MODUL: FOOTER ======= -->
    <footer>
        <div class="footer-wrapper">
            <div class="footer-col">
                <h3>MůjWeb</h3>
                <p>Vzorová maturitní stránka s ukázkou všech připravených modulů.</p>
            </div>
            <div class="footer-col">
                <h4>Navigace</h4>
                <ul>
                    <li><a href="#uvod">Úvod</a></li>
                    <li><a href="#galerie">Galerie</a></li>
                    <li><a href="#sluzby">Služby</a></li>
                    <li><a href="#formular">Formulář</a></li>
                    <li><a href="#zaznamy">Záznamy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Kontakt</h4>
                <p>email@example.com</p>
                <p>SOU Elektrotechnické, Plzeň</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> MůjWeb. Maturitní projekt – IT obor.</p>
        </div>
    </footer>

</body>
</html>
