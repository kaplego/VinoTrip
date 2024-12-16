const overlay = document.getElementById("suppr"),
    overlayIdAdresse = document.getElementById("suppr-idadresse");

function overlaySuppression(idadresse) {
    if (overlay.classList.contains("hidden")) {
        overlayIdAdresse.value = idadresse;
        overlay.classList.remove("hidden");
    }
}

document.querySelectorAll(".supprimer").forEach((btn) => {
    btn.addEventListener("click", () =>
        overlaySuppression(btn.getAttribute("data-idadresse"))
    );
});

document.getElementById("suppr-annuler").addEventListener("click", () => {
    overlay.classList.add("hidden");
});
