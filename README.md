# 📦 MODULY – Maturitní příprava (TWS + DB)

Tato složka obsahuje **připravené moduly** pro Ctrl+C → Ctrl+V do jakékoli HTML/PHP stránky.  
Každý modul má vlastní složku s HTML snippetem, CSS a (pokud potřebuje) JS nebo PHP.

---

## 🗂️ Struktura modulů

```
moduly_prakticka/
│
├── base/                    ← ZÁKLAD – připoj vždy jako první CSS!
│   └── base.css
│
├── header/                  ← ✅ Header s hamburger menu (desktop + mobil v jednom)
│   ├── header.html              Nahrazuje starý mobilni-header/ i header/
│   ├── header.css
│   └── header.js
│
├── mobilni-header/          ← ⚠️ ZASTARALÝ – použij header/ místo tohoto!
│   ├── mobilni-header.html
│   ├── mobilni-header.css
│   └── mobilni-header.js
│
├── footer/                  ← Footer se třemi sloupci
│   ├── footer.html
│   └── footer.css
│
├── hero/                    ← Hero sekce (gradient nebo foto na pozadí)
│   ├── hero.html                Dvě varianty: gradient / hero--img (foto + overlay)
│   └── hero.css
│
├── formular/                ← Formulář s DB (více polí – hodnocení, kategorie...)
│   ├── formular.html
│   ├── formular-logika.php
│   ├── formular.css
│   ├── db.php                   ← Připojení k DB – UPRAV jméno databáze!
│   └── databaze.sql
│
├── kontakt/                 ← Jednoduchý kontaktní formulář (Jméno, Email, Zpráva)
│   │
│   ├── db/                  ← ✅ HLAVNÍ verze – ukládá zprávy do databáze
│   │   ├── kontakt.html
│   │   ├── kontakt.css
│   │   ├── kontakt-logika.php
│   │   └── kontakt-databaze.sql    ← Vytvoří tabulku `kontakty`
│   │
│   └── mail/                ← Alternativní verze – odesílá email přes PHP mail()
│       ├── kontakt.html
│       ├── kontakt.css
│       └── kontakt-logika.php      ← Nastav cílový email na řádku s komentářem "ZDE"
│
├── obrazky/                 ← Slideshow (automatická + šipky + tečky)
│   ├── slideshow.html
│   ├── slideshow.css
│   └── slideshow.js
│
├── grid/                    ← Grid rozložení (2×2, 3×3, 3 sloupce)
│   ├── grid.html
│   └── grid.css
│
├── db-vypis/                ← Výpis záznamů z DB (grid karet)
│   ├── db-vypis.html
│   └── db-vypis.css
│
├── vzorova-stranka/         ← Kompletní vzorová stránka se VŠEMI moduly
│   └── index.php
│
└── prakticke-stranky/       ← 5 praktických stránek pro živnosti/firmy
    ├── automechanik/
    │   └── index.php            Opravy vozidel, pneuservis, diagnostika
    ├── elektrikar/
    │   └── index.php            Elektroinstalace, revize, hromosvody
    ├── instalater/
    │   └── index.php            Vodoinstalace, topení, odpadní potrubí
    ├── kovar/
    │   └── index.php            Kované brány, zábradlí, umělecké kovářství
    └── zednicka-firma/
        └── index.php            Zdění, omítky, fasády, rekonstrukce
```

---

## 🚀 Jak použít modul – 3 kroky

### 1) Připoj CSS do `<head>`
```html
<link rel="stylesheet" href="../../base/base.css">         <!-- VŽDY PRVNÍ! -->
<link rel="stylesheet" href="../../header/header.css">
<link rel="stylesheet" href="../../hero/hero.css">
<link rel="stylesheet" href="../../kontakt/db/kontakt.css">
<!-- ... další moduly dle potřeby ... -->
```

### 2) Připoj JS do `<head>` s `defer`
```html
<script src="../../header/header.js" defer></script>
<script src="../../obrazky/slideshow.js" defer></script>
```

### 3) Zkopíruj HTML snippet do `<body>`
Otevři příslušný `.html` soubor modulu a zkopíruj obsah do svého souboru.

---

## 📋 Moduly – rychlý přehled

| Modul | Co dělá | Soubory |
|-------|---------|---------|
| **base** | CSS reset + utility třídy + CSS proměnné | `base.css` |
| **header** | Header s hamburger menu (desktop + mobil) | HTML + CSS + JS |
| **footer** | Footer se třemi sloupci | HTML + CSS |
| **hero** | Úvodni sekce – gradient nebo foto na pozadí | HTML + CSS |
| **formular** | Složitější formulář → DB (hodnocení, kategorie, čas) | HTML + PHP + CSS + SQL |
| **kontakt/db** | Jednoduchý kontakt → uloží do tabulky `kontakty` | HTML + PHP + CSS + SQL |
| **kontakt/mail** | Jednoduchý kontakt → odešle emailem | HTML + PHP + CSS |
| **obrazky** | Slideshow obrázků (šipky + tečky + auto) | HTML + CSS + JS |
| **grid** | Grid 2×2, 3×3, 3 sloupce | HTML + CSS |
| **db-vypis** | Výpis z DB v grid kartách + paginace + relativní čas | HTML (PHP) + CSS |

---

## 🏠 Hero sekce – dvě varianty

### Varianta A – barevný gradient (výchozí):
```html
<section class="hero" id="uvod">
```

### Varianta B – foto na pozadí (třída `hero--img`):
```html
<section class="hero hero--img" id="uvod" style="background-image: url('foto.jpg')">
```
> Tmavý overlay se přidá automaticky přes CSS – text bude vždy čitelný.

---

## 📬 Kontaktní formulář – dvě verze

### Hlavní verze – DB (doporučeno):
```php
// Na začátek index.php (před DOCTYPE):
session_start();
include '../../formular/db.php';

// Logika zpracování:
// Viz: kontakt/db/kontakt-logika.php
```
SQL schema importuj z `kontakt/db/kontakt-databaze.sql` → vytvoří tabulku `kontakty`.

### Alternativní verze – Email:
```php
// Viz: kontakt/mail/kontakt-logika.php
// Nastav cílový email na řádku označeném komentářem: // ← ZDE NASTAV CÍL EMAIL
```
> ⚠️ PHP `mail()` funguje jen na serveru s nakonfigurovaným SMTP. Na lokálním MAMP nemusí fungovat.

---

## 🗄️ Práce s databází

### Import SQL do phpMyAdmin:
1. Spusť MAMP (Apache + MySQL)
2. Otevři `http://localhost/phpmyadmin`
3. Vytvoř novou databázi (např. `moje_db`, kolace `utf8_czech_ci`)
4. Záložka **Import** → nahraj soubor `.sql` (dle potřeby):
   - `formular/databaze.sql` → tabulka `zaznamy`
   - `kontakt/db/kontakt-databaze.sql` → tabulka `kontakty`
5. Uprav `formular/db.php` – změň `$dbname = "moje_db";`

### db.php – připojení (sdílí oba kontaktní formuláře):
```php
<?php
include '../../formular/db.php'; // uprav cestu dle umístění souboru
?>
```

### Sloupec `datum_pridani` – automatický čas záznamu:
Tabulka `zaznamy` má sloupec `datum_pridani TIMESTAMP DEFAULT CURRENT_TIMESTAMP`

---

## 📄 Paginace a relativní čas (db-vypis)

### Paginace – 9 záznamů na stránku:
Vzorova stránka má výpis z DB rozdělený na stránky po 9. Stránka se řídí GET parametrem `?stranka=2`. Tlačítka jsou generována PHP automaticky podle počtu záznamů.

> ⚠️ URL musí mít správné pořadí: `?stranka=2#zaznamy` – ne `#zaznamy?stranka=2` (ten prohledač ignoruje).

### Relativní čas (`cas_relativni()`):
Funkce je definována na začátku `vzorova-stranka/index.php`. Bere `datum_pridani` z DB a vrátí člověku čitelnou hodnotu:
```
Právě teď / Před 5 min / Před 2 hodinami / Včera / Před 3 dny / Před 1 měsícem / Před 2 lety
```
Zobrazí se vpravo od jména na každé kartě – CSS třída `.db-kas` ve `db-vypis.css`.

---

## 🖼️ Vkládání obrázků

### Foto v sekci "O nás" (`.o-nas-img`):
```html
<!-- URL z internetu: -->
<div class="o-nas-img">
    <img src="https://example.com/foto.jpg" alt="Popis">
</div>

<!-- Lokální soubor (ve stejné složce jako index.php): -->
<div class="o-nas-img">
    <img src="foto.jpg" alt="Popis">
</div>
```
> `object-fit: cover` je již nastaven v CSS – obrázek zaplni celý box bez deformace.

### Foto v Hero sekci (pozadí):
```html
<section class="hero hero--img" id="uvod" style="background-image: url('foto.jpg')">
```

### Slideshow – doplnění `src`:
```html
<img src="https://example.com/foto.jpg" alt="Popis snimku">
<!-- nebo lokální soubor: -->
<img src="images/foto1.jpg" alt="Popis snimku">
```

---

## 🏭 Praktické stránky – struktura každé stránky

Každá stránka v `prakticke-stranky/` obsahuje **8 sekcí**:

| # | Sekce | Popis |
|---|-------|-------|
| 1 | **Header** | Hamburger navigace (Úvod / O nás / Galerie / Služby / Kontakt) |
| 2 | **Hero** | Nadpis + tlačítka, třída `hero--img` – doplň `url('foto.jpg')` |
| 3 | **O nás** | 2 sloupce – text vlevo, foto vpravo (`.o-nas-img img`) |
| 4 | **Galerie** | Slideshow – 3 slidy, doplň `src=""` vlastní fotkou |
| 5 | **Služby** | Grid 3 sloupce s emoji ikonou a popisem |
| 6 | **CTA Banner** | Barevný pruh s telefonním číslem – uprav |
| 7 | **Kontakt** | Formulář (DB verze) – ukládá do tabulky `kontakty` |
| 8 | **Footer** | Logo, navigace, kontaktní info – uprav |

---

## ⚠️ Důležité poznámky

- **`defer`** u scriptu = JS se načte až po HTML (querySelector funguje)
- **`session_start()`** musí být PRVNÍ řádek PHP souboru (před echo i include)
- **`header("Location: ...")`** + `exit()` = PRG pattern (zabrání duplikaci při F5)
- **Prepared statements** (`bind_param`) = ochrana proti SQL Injection
- **`htmlspecialchars()`** při výpisu = ochrana proti XSS
- **`mobilni-header/`** složka je zastaralá – nový modul je **`header/`**

---

## 🎓 Vzorová stránka

Otevři `vzorova-stranka/index.php` přes MAMP:
```
http://localhost/moduly_prakticka/vzorova-stranka/index.php
```
> Nejdřív importuj `formular/databaze.sql` a uprav `formular/db.php`!

### Praktické stránky:
```
http://localhost/moduly_prakticka/prakticke-stranky/automechanik/
http://localhost/moduly_prakticka/prakticke-stranky/elektrikar/
http://localhost/moduly_prakticka/prakticke-stranky/instalater/
http://localhost/moduly_prakticka/prakticke-stranky/kovar/
http://localhost/moduly_prakticka/prakticke-stranky/zednicka-firma/
```
> Nezapomeň naimportovat `kontakt/db/kontakt-databaze.sql` pro kontaktní formulář!

---

**Autor:** Vítek Fikrle | SOU Elektrotechnické, Plzeň | IT4b 2025/26
