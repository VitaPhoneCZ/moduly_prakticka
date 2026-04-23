// ============================================================
// MODUL: SLIDESHOW JS
// Připoj: <script src="MODULY/obrazky/slideshow.js" defer></script>
// Automaticky přepíná každé 4 sekundy + ruční šipky + tečky
// ============================================================

const slides  = document.querySelectorAll(".slide");
const prevBtn = document.getElementById("slidePrev");
const nextBtn = document.getElementById("slideNext");
const dotsContainer = document.getElementById("slideDots");

let current = 0;
let autoTimer;

// --- Vytvoř tečky dynamicky ---
slides.forEach((_, i) => {
    const dot = document.createElement("button");
    dot.classList.add("dot");
    if (i === 0) dot.classList.add("active");
    dot.addEventListener("click", () => goTo(i));
    dotsContainer.appendChild(dot);
});

const dots = dotsContainer.querySelectorAll(".dot");

// --- Zobraz určitý slide ---
function goTo(index) {
    slides[current].classList.remove("active");
    dots[current].classList.remove("active");

    current = (index + slides.length) % slides.length;

    slides[current].classList.add("active");
    dots[current].classList.add("active");

    resetTimer();
}

// --- Šipky ---
prevBtn.addEventListener("click", () => goTo(current - 1));
nextBtn.addEventListener("click", () => goTo(current + 1));

// --- Automatické přepínání (4 s) ---
function startTimer() {
    autoTimer = setInterval(() => goTo(current + 1), 4000);
}

function resetTimer() {
    clearInterval(autoTimer);
    startTimer();
}

startTimer();
