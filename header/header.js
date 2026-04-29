// ============================================================
// MODUL: HEADER JS (hamburger toggle)
// Připoj do <head>: <script src="MODULY/header/header.js" defer></script>
// ============================================================

const hamburger = document.getElementById("hamburgerBtn");
const nav = document.getElementById("mainNav");

// Přepínání otevřeného/zavřeného menu
hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    nav.classList.toggle("active");
});

// Zavři menu po kliknutí na odkaz (funguje i pro #kotvy na jedné stránce)
const navLinks = nav.querySelectorAll(".nav-link");
navLinks.forEach(link => {
    link.addEventListener("click", () => {
        hamburger.classList.remove("active");
        nav.classList.remove("active");
    });
});
