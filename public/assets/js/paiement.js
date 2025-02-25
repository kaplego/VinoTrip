const tp = document.getElementById("type-paiement");

function changeTypePaiement() {
    document.querySelectorAll("*[data-show-paiement]").forEach((e) => {
        const val = e.getAttribute('data-show-paiement');

        e.querySelectorAll("input").forEach(
            (i) => (i.disabled = tp.value !== val)
        );
        e.classList.toggle("hidden", tp.value !== val);
    });
}

tp.addEventListener("change", changeTypePaiement);
changeTypePaiement();

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
