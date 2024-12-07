let offrir = false,
    ecoffret = false,
    hebergement = null,
    dejeuner = false,
    diner = false,
    activite = false;

const priceElement = document.getElementById("prix-total"),
    dateDebut = document.getElementById('datedebut'),
    dateFin = document.getElementById('datefin'),
    nbAdultes = document.getElementById('nbadultes'),
    nbEnfants = document.getElementById('nbenfants'),
    nbChambresSimple = document.getElementById('chambressimple'),
    nbChambresDouble = document.getElementById('chambresdouble'),
    nbChambresTriple = document.getElementById('chambrestriple'),
    hebergementSelect = document.getElementById("hebergement"),
    listeHebergements = document.querySelectorAll(".hebergement"),
    offrirCheckbox = document.getElementById("offrir"),
    dejeunerCheckbox = document.getElementById("dejeuner"),
    dinerCheckbox = document.getElementById("diner"),
    activiteCheckbox = document.getElementById("activite");
// activitesListe = document.querySelectorAll(".activite");

//======================= DATES

dateDebut.addEventListener('change', () => {
    const duree = dateDebut.getAttribute('data-duree');
    let date = new Date(dateDebut.value);
    switch (duree) {
        case '2':
            date.setDate(date.getDate() + 1);
            break;
        case '3':
            date.setDate(date.getDate() + 2);
            break;
    }
    dateFin.value = date.toISOString().split('T')[0];
});

//======================= PERSONNES & CHAMBRES

nbAdultes.addEventListener('change', updatePrice);
nbEnfants.addEventListener('change', updatePrice);

nbChambresSimple.addEventListener('change', updatePrice);
nbChambresDouble.addEventListener('change', updatePrice);
nbChambresTriple.addEventListener('change', updatePrice);

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
    document
        .querySelectorAll("*[data-offrir]")
        .forEach((element) => element.classList.toggle("hidden", !checked));
}

setOffrir(offrirCheckbox.checked);
offrirCheckbox.addEventListener("change", (event) => {
    setOffrir(offrirCheckbox.checked);
    updatePrice();
});

//======================= FORMAT CADEAU

document.querySelectorAll("input[name=ecoffret]").forEach((radio) => {
    if (radio.checked) ecoffret = radio.value == '1';
    radio.addEventListener("change", () => {
        ecoffret = radio.value == '1';
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

//======================= ACTIVITES

// activitesListe.forEach((activiteCheckbox) => {
//     if (activiteCheckbox.checked) {
//         activites.push(activiteCheckbox.name);
//     }
//     activiteCheckbox.addEventListener('change', () => {
//         if (activiteCheckbox.checked) {
//             activites.push(activiteCheckbox.name);
//         }
//         else {
//             activites = activites.filter((a) => a !== activiteCheckbox.name);
//         }
//         updatePrice();
//     });
// });

//======================= MAJ PRIX

function updatePrice() {
    let price = prixDeBase;
    if (dejeuner) price += 20;
    if (diner) price += 20;
    if (activite) price += 50;
    price *= +nbAdultes.value + +nbEnfants.value;

    if (offrir && !ecoffret) price += 5;
    price += nbChambresSimple.value * 75;
    price += nbChambresDouble.value * 100;
    price += nbChambresTriple.value * 125;

    priceElement.innerText = price.toFixed(2) + " €";
}

updatePrice();
