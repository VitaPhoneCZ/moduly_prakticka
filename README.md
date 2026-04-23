# 📦 MODULY – Maturitní příprava (TWS + DB)

Tato složka obsahuje **připravené moduly** pro Ctrl+C → Ctrl+V do jakékoli HTML/PHP stránky.  
Každý modul má vlastní složku s HTML snippetem, CSS a (pokud potřebuje) JS.

---

## 🗂️ Struktura modulů

```
MODULY/
├── base/               ← ZÁKLAD – připoj vždy jako první CSS!
│   └── base.css
│
├── mobilni-header/     ← Header s hamburger menu (desktop + mobil)
│   ├── mobilni-header.html
│   ├── mobilni-header.css
│   └── mobilni-header.js
│
├── header/             ← Jednoduchý desktopový header (bez JS)
│   ├── header.html
│   └── header.css
│
├── footer/             ← Footer se třemi sloupci
│   ├── footer.html
│   └── footer.css
│
├── hero/               ← Hero sekce (velký úvodní banner)
│   ├── hero.html
│   └── hero.css
│
├── formular/           ← Formulář s DB připojením
│   ├── formular.html         ← HTML část (zkopíruj do body)
│   ├── formular-logika.php   ← PHP logika (zkopíruj NA ZAČÁTEK souboru)
│   ├── formular.css
│   ├── db.php                ← Připojení k DB (uprav jméno DB!)
│   └── databaze.sql          ← Import do phpMyAdmin
│
├── obrazky/            ← Slideshow (automatická + šipky + tečky)
│   ├── slideshow.html
│   ├── slideshow.css
│   └── slideshow.js
│
├── grid/               ← Grid rozložení (2×2, 3×3, 3 sloupce)
│   ├── grid.html
│   └── grid.css
│
├── db-vypis/           ← Výpis záznamů z DB (grid karet)
│   ├── db-vypis.html
│   └── db-vypis.css
│
└── vzorova-stranka/    ← Kompletní vzorová stránka se VŠEMI moduly
    └── index.php
```

---

## 🚀 Jak použít modul – 3 kroky

### 1) Připoj CSS do `<head>`
```html
<link rel="stylesheet" href="MODULY/base/base.css">           <!-- VŽDY PRVNÍ! -->
<link rel="stylesheet" href="MODULY/mobilni-header/mobilni-header.css">
<link rel="stylesheet" href="MODULY/hero/hero.css">
<!-- ... další moduly dle potřeby ... -->
```

### 2) Připoj JS před `</body>` (nebo s `defer`)
```html
<script src="MODULY/mobilni-header/mobilni-header.js" defer></script>
<script src="MODULY/obrazky/slideshow.js" defer></script>
```

### 3) Zkopíruj HTML snippet do `<body>`
Otevři příslušný `.html` soubor modulu a zkopíruj obsah do svého souboru.

---

## 📋 Moduly – rychlý přehled

| Modul | Co dělá | Soubory |
|-------|---------|---------|
| **base** | CSS reset + utility třídy | `base.css` |
| **mobilni-header** | Header + hamburger menu | HTML + CSS + JS |
| **header** | Jednoduchý desktop header | HTML + CSS |
| **footer** | Footer se sloupci | HTML + CSS |
| **hero** | Úvodní sekce s tlačítky | HTML + CSS |
| **formular** | Formulář → DB (prepared statements) | HTML + PHP + CSS + SQL |
| **obrazky** | Slideshow obrázků | HTML + CSS + JS |
| **grid** | Grid 2×2, 3×3, 3col | HTML + CSS |
| **db-vypis** | Výpis z DB v grid kartách | HTML (PHP) + CSS |

---

## 🗄️ Práce s databází

### Import SQL do phpMyAdmin:
1. Spusť MAMP (Apache + MySQL)
2. Otevři `http://localhost/phpmyadmin`
3. Vytvoř novou databázi (např. `moje_db`, kolace `utf8_czech_ci`)
4. Záložka **Import** → nahraj `MODULY/formular/databaze.sql`
5. Uprav `MODULY/formular/db.php` – změň `$dbname = "moje_db";`

### db.php – připojení:
```php
<?php
include 'MODULY/formular/db.php'; // nebo jen 'db.php' pokud je ve stejné složce
?>
```

---

## ⚠️ Důležité poznámky

- **`defer`** u scriptu = JS se načte až po HTML (query selectory fungují)
- **`session_start()`** musí být PRVNÍ řádek PHP souboru (před echo i include)
- **`header("Location: ...")`** + `exit()` = PRG pattern (zabrání duplikaci F5)
- **Prepared statements** (`bind_param`) = ochrana proti SQL Injection
- **`htmlspecialchars()`** při výpisu = ochrana proti XSS

---

## 🎓 Vzorová stránka

Otevři `MODULY/vzorova-stranka/index.php` přes MAMP:
```
http://localhost/priprava_maturita/MODULY/vzorova-stranka/index.php
```
> Nejdřív importuj `databaze.sql` a uprav `db.php`!

---

**Autor:** Vítek Fikrle | SOU Elektrotechnické, Plzeň | IT4b 2025/26
