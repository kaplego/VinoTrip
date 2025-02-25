"use strict";
function closeAccordeons(accordeons) {
    accordeons.forEach((item) => {
        item.classList.remove("actif");
    });
}
const accordeons = document.querySelectorAll(".accordeon");
accordeons.forEach((accordeon) => {
    const items = accordeon.querySelectorAll(".accordeon-item");
    items.forEach((item) => {
        const click = item.querySelector(".click");
        function action() {
            let actif = item.classList.contains("actif");
            closeAccordeons(items);
            item.classList.toggle("actif", !actif);
        }
        (click ?? item).addEventListener("click", action);
        (click ?? item).addEventListener("keyup", (ev) => {
            if (ev.key === "Spacebar" || ev.key === "Enter") {
                ev.preventDefault();
                action();
            }
        });
    });
});
document.querySelectorAll("img[data-src]").forEach((img) => {
    const observer = new IntersectionObserver((entries) => {
        const attr = img.getAttribute("data-src");
        if (entries[0].isIntersecting && attr) {
            img.src = attr;
            img.removeAttribute("data-src");
            observer.unobserve(img);
        }
    }, {
        threshold: 1.0,
        rootMargin: `${window.innerHeight}px 0px ${window.innerHeight}px 0px`,
    });
    observer.observe(img);
});
