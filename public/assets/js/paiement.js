const tp = document.getElementById("type-paiement");
tp.addEventListener("change", () => {
    document.querySelectorAll(".nouvelle-cb").forEach((e) => {
        e.querySelectorAll("input").forEach(
            (i) => (i.disabled = tp.value !== "cb-new")
        );
        e.classList.toggle("hidden", tp.value !== "cb-new");
    });
});

const cbnum = document.getElementById('numero-cb'),
    cbtype = document.getElementById('type-cb'),
    cbtypelucide = document.getElementById('type-cb-icon');
cbnum.addEventListener('change', () => {
    if (tp.value !== 'cb-new') return;
    switch (creditCardType(cbnum.value)) {
        default:
            break;
    }
});
