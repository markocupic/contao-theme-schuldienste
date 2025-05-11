"use strict";

document.addEventListener("DOMContentLoaded", function () {

    // Smooth scrolling
    var scrollTriggers = document.querySelectorAll('a.js-scroll-trigger[href*="#"]:not([href="#"])');

    scrollTriggers.forEach(function (trigger) {
        trigger.addEventListener("click", function (event) {
            var pathname = window.location.pathname.replace(/^\//, '');
            var hostname = window.location.hostname;
            if (pathname === this.pathname.replace(/^\//, '') && hostname === this.hostname) {
                var target = document.querySelector(this.hash);
                target = target ? target : document.querySelector('[name="' + this.hash.slice(1) + '"]');
                if (target) {
                    event.preventDefault();
                    window.scrollTo({
                        top: target.offsetTop,
                        behavior: "smooth"
                    });
                }
            }
        });
    });

    // Closes responsive menu when a scroll trigger link is clicked
    var scrollTriggerLinks = document.querySelectorAll('.js-scroll-trigger');
    var navbarCollapse = document.querySelector('.navbar-collapse');

    scrollTriggerLinks.forEach(function (link) {
        link.addEventListener("click", function () {
            if (navbarCollapse) {
                navbarCollapse.classList.remove("show");
            }
        });
    });
});

// Lässt die Navigation in der linken Spalte mitscrollen
document.addEventListener("DOMContentLoaded", function () {

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

        timeout = setTimeout(function () {
            setPos();
        }, delay); // Verzögerung, kann angepasst werden
    });
});
