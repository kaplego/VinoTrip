const overlay = document.getElementById("suppr"),
    overlayIdSejour = document.getElementById("suppr-idsejour");

function overlaySuppression(idsejour) {
    if (overlay.classList.contains("hidden")) {
        overlayIdSejour.value = idsejour;
        overlay.classList.remove("hidden");
    }
}

document.querySelectorAll(".unfav").forEach((btn) => {
    btn.addEventListener("click", () =>
        overlaySuppression(btn.getAttribute("data-idsejour"))
    );
});

document.getElementById("suppr-annuler").addEventListener("click", () => {
    overlay.classList.add("hidden");
});
