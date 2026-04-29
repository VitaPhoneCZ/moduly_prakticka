<!-- ============================================================
     MODUL: VÝPIS Z DATABÁZE (cards grid)
     Použití: zkopíruj <div class="db-vypis">...</div> do index.php
     Připoj:  <link rel="stylesheet" href="MODULY/db-vypis/db-vypis.css">
              include 'db.php'; // v PHP hlavičce
     Uprav:   Jméno tabulky a sloupců v PHP foreach
     ============================================================ -->

<section class="db-vypis-sekce">
    <div class="wrapper">
        <h2 class="section-title">Záznamy z databáze</h2>

        <!-- CAROUSEL MÓD:
             Pokud chceš carousel, přidej třídu "db-carousel" na .db-vypis a odkomentuj tento wrapper a tlačítka.
        <div class="db-carousel-wrapper">
            <button class="db-btn prev" onclick="document.querySelector('.db-carousel').scrollBy({left: -340, behavior: 'smooth'})">&#10094;</button>
        -->
        <div class="db-vypis"> <!-- Sem přidej "db-carousel" pokud chceš slider -->
            <?php
            // Výpis z DB – nejnovější první (ORDER BY id DESC)
            $dotaz = "SELECT * FROM zaznamy ORDER BY id DESC";
            $vysledek = $spojeni->query($dotaz);

            if ($vysledek && $vysledek->num_rows > 0) {
                while ($radek = $vysledek->fetch_assoc()) {
                    // XSS ochrana při výpisu
                    $jmeno     = htmlspecialchars($radek['jmeno']);
                    $email     = htmlspecialchars($radek['email']);
                    $predmet   = htmlspecialchars($radek['predmet']);
                    $hodnoceni = (int)$radek['hodnoceni'];
                    $popis     = htmlspecialchars($radek['popis']);

                    echo "
                    <div class='db-karta'>
                        <h3>{$jmeno}</h3>
                        <p class='db-email'>{$email}</p>
                        <p><strong>{$predmet}</strong></p>
                        <p class='db-hvezdy'>" . str_repeat("⭐", $hodnoceni) . "</p>
                        <p class='db-popis'>{$popis}</p>
                    </div>
                    ";
                }
            } else {
                echo "<p class='db-prazdno'>Zatím nejsou žádné záznamy.</p>";
            }
            ?>
        </div>
        <!-- Konec carousel wrapperu:
            <button class="db-btn next" onclick="document.querySelector('.db-carousel').scrollBy({left: 340, behavior: 'smooth'})">&#10095;</button>
        </div>
        -->
    </div>
</section>