const tp = document.getElementById("type-paiement");
tp.addEventListener("change", () => {
    document.querySelectorAll(".nouvelle-cb").forEach((e) => {
        e.querySelectorAll("input").forEach(
            (i) => (i.disabled = tp.value !== "cb-new")
        );
        e.classList.toggle("hidden", tp.value !== "cb-new");
    });
});
