"use strict";

// Lässt die Navigation in der linken Spalte mitscrollen
document.addEventListener("DOMContentLoaded", () => {

    return; // Deaktiviert!

    const nav = document.querySelector("#left .inside");
    nav.style.position = "relative";
    nav.style.transition = "top 0.5s ease-out"; // Sanfte Bewegung aktivieren

    const parent = document.querySelector("#left");
    let timeout = null;

    const setPos = () => {
        const scrollY = window.scrollY;
        const parentTop = parent.offsetTop;
        const parentBottom = parentTop + parent.offsetHeight;
        const navHeight = nav.offsetHeight;

        // Begrenzung: Falls die Navigation sich dem Footer nähert, fixieren
        const maxTop = parentBottom - navHeight;

        if (scrollY > maxTop) {
            nav.style.top = maxTop - 20 + "px";
        } else {
            nav.style.top = scrollY + "px";
        }
    }

    // Navigation direkt beim Laden an die richtige Position setzen
    setPos();
    const delay = 600;
    window.addEventListener("scroll", () => {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            setPos();
        }, delay); // Verzögerung, kann angepasst werden
    });
});
