let offrir = false,
    formatCadeau = null,
    hebergement = null,
    dejeuner = false,
    diner = false,
    activite = false;

const priceElement = document.getElementById("prix-total"),
    hebergementSelect = document.getElementById("hebergement"),
    listeHebergements = document.querySelectorAll(".hebergement"),
    offrirCheckbox = document.getElementById("offrir"),
    dejeunerCheckbox = document.getElementById("dejeuner"),
    dinerCheckbox = document.getElementById("diner"),
    activiteCheckbox = document.getElementById("activite");

//======================= HEBERGEMENT

// listeHebergements.forEach((hebergementElement) => {
//     if (
//         hebergementSelect.value ===
//         hebergementElement.getAttribute("data-value")
//     )
//         hebergementElement.classList.add("active");

//     hebergementElement.addEventListener("click", () => {
//         hebergementSelect.value = hebergement =
//             hebergementElement.getAttribute("data-value");
//         listeHebergements.forEach((h) => h.classList.remove("active"));
//         hebergementElement.classList.add("active");
//         updatePrice();
//     });
// });

//======================= OFFRIR

function setOffrir(checked) {
    offrir = checked;
    updatePrice();
    document
        .querySelectorAll("*[data-offrir]")
        .forEach((element) => element.classList.toggle("hidden", !checked));
}

setOffrir(offrirCheckbox.checked);
offrirCheckbox.addEventListener("change", (event) => {
    setOffrir(offrirCheckbox.checked);
});

//======================= FORMAT CADEAU

document.querySelectorAll("input[name=formatCadeau]").forEach((radio) => {
    if (radio.checked) formatCadeau = radio.value;
    updatePrice();

    radio.addEventListener("change", () => {
        formatCadeau = radio.value;
        updatePrice();
    });
});

//======================= DEJEUNER, DINER & ACTIVITE

dejeunerCheckbox.addEventListener("change", () => {
    dejeuner = dejeunerCheckbox.checked;
    updatePrice();
});
dinerCheckbox.addEventListener("change", () => {
    diner = dinerCheckbox.checked;
    updatePrice();
});
activiteCheckbox.addEventListener("change", () => {
    activite = activiteCheckbox.checked;
    updatePrice();
});

//======================= MAJ PRIX

function updatePrice() {
    let price = prixDeBase;
    if (offrir && formatCadeau === "coffret") price += 5;
    if (dejeuner) price += 80;
    if (diner) price += 80;
    if (activite) price += 100;

    priceElement.innerText = price.toFixed(2) + " €";
}
