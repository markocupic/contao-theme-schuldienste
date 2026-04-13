"use strict";

/** Inject a scroll to top button **/
document.addEventListener("DOMContentLoaded", () => {
    const scrollButton = document.createElement("button");
    scrollButton.className = "scroll-to-top";
    scrollButton.setAttribute("aria-label", "Scroll to the top of the page");
    scrollButton.innerHTML = '<span class="fas fa-chevron-up"></span>';
    document.body.appendChild(scrollButton);

    const toggleVisibility = () => {
        scrollButton.classList.toggle("visible", window.scrollY > 100);
    };

    // Initial check on load
    toggleVisibility();

    // Scroll listener
    window.addEventListener("scroll", toggleVisibility);

    scrollButton.addEventListener("click", (event) => {
        event.preventDefault();
        window.scrollTo({top: 0, behavior: "smooth"});
    });
});


