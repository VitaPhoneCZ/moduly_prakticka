// ============================================================
// MODUL: MOBILNÍ HEADER JS (hamburger toggle)
// Připoj do <head>: <script src="MODULY/mobilni-header/mobilni-header.js" defer></script>
// ============================================================

const hamburger = document.getElementById("hamburgerBtn");
const nav = document.getElementById("mainNav");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    nav.classList.toggle("active");
});

// Zavři menu po kliknutí na odkaz (pro SPA nebo #kotvy)
const navLinks = nav.querySelectorAll(".nav-link");
navLinks.forEach(link => {
    link.addEventListener("click", () => {
        hamburger.classList.remove("active");
        nav.classList.remove("active");
    });
});
