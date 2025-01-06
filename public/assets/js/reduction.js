const overlay = document.getElementById("reduc"),
    overlayIdSejour = document.getElementById("reduc-idsejour"),
    inputPrix = document.getElementById("reduc-nouvprix"),
    inputPourcentage = document.getElementById("reduc-pourcentage");

function overlaySuppression(idsejour) {
    if (overlay.classList.contains("hidden")) {
        overlayIdSejour.value = idsejour;
        overlay.classList.remove("hidden");
    }
}

document.querySelectorAll(".reduction").forEach((btn) => {
    btn.addEventListener("click", () =>
        overlaySuppression(btn.getAttribute("data-idsejour"))
    );
});

document.getElementById("reduc-annuler").addEventListener("click", () => {
    overlay.classList.add("hidden");
    inputPourcentage.value = inputPourcentage.getAttribute("basevalue")
    inputPrix.value = inputPrix.getAttribute("basevalue")
});

inputPrix.addEventListener("input", () => {
    inputPourcentage.value = ((1 - (inputPrix.value) / inputPrix.getAttribute("max")) * 100).toFixed(2)
});

inputPourcentage.addEventListener("input", () => {
    inputPrix.value = (inputPrix.getAttribute("max") * (100 - inputPourcentage.value) / 100).toFixed(2)
});

