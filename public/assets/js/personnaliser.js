let offrir = false,
    ecoffret = false,
    prixHebergement = null,
    repas = [],
    dejeuner = false,
    diner = false,
    activite = false;

const form = document.getElementById("formulaire"),
    priceElement = document.getElementById("prix-total"),
    dateDebut = document.getElementById("datedebut"),
    dateFin = document.getElementById("datefin"),
    nbAdultes = document.getElementById("nbadultes"),
    nbEnfants = document.getElementById("nbenfants"),
    nbChambresSimple = document.getElementById("chambressimple"),
    nbChambresDouble = document.getElementById("chambresdouble"),
    nbChambresTriple = document.getElementById("chambrestriple"),
    listeHebergements = document.querySelectorAll(".selection-hebergement"),
    listeRepas = document.querySelectorAll(".selection-repas"),
    offrirCheckbox = document.getElementById("offrir"),
    dejeunerCheckbox = document.getElementById("dejeuner"),
    dinerCheckbox = document.getElementById("diner"),
    activiteCheckbox = document.getElementById("activite");
// activitesListe = document.querySelectorAll(".activite");

//======================= DATES

dateDebut.addEventListener("change", () => {
    const duree = dateDebut.getAttribute("data-duree");
    let date = new Date(dateDebut.value);
    switch (duree) {
        case "2":
            date.setDate(date.getDate() + 1);
            break;
        case "3":
            date.setDate(date.getDate() + 2);
            break;
    }
    dateFin.value = date.toISOString().split("T")[0];
});

//======================= PERSONNES & CHAMBRES

nbAdultes.addEventListener("change", updatePrice);
nbEnfants.addEventListener("change", updatePrice);

nbChambresSimple.addEventListener("change", updatePrice);
nbChambresDouble.addEventListener("change", updatePrice);
nbChambresTriple.addEventListener("change", updatePrice);

//======================= HEBERGEMENT

listeHebergements.forEach((hebergementElement) => {
    const id = hebergementElement.getAttribute("data-value");
    const prix = +hebergementElement.getAttribute("data-price");

    if (new FormData(form).get("hebergement") === id) {
        prixHebergement = prix;
        hebergementElement.classList.add("active");
    }

    hebergementElement.addEventListener("click", () => {
        prixHebergement = prix;
        document.getElementById(`hebergement-${id}`).checked = true;
        listeHebergements.forEach((h) => h.classList.remove("active"));
        hebergementElement.classList.add("active");
        updatePrice();
    });
});

//======================= REPAS

function prixFromRepas(repas) {
    return +document
        .getElementById(`repas-${repas}`)
        .getAttribute("data-price");
}

listeRepas.forEach((repasElement) => {
    const id = repasElement.getAttribute("data-value");

    repasElement.addEventListener("click", () => {
        const checked = !(new FormData(form).getAll("repas[]").includes(id));

        document.querySelector(`#repas-${id} > input`).checked = checked;
        repasElement.classList.toggle("active", checked);
        updatePrice();
    });
});

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
    if (radio.checked) ecoffret = radio.value == "1";
    radio.addEventListener("change", () => {
        ecoffret = radio.value == "1";
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

    price += prixHebergement;
    price += new FormData(form)
        .getAll("repas[]")
        .reduce((prev, r) => prixFromRepas(r) + prev, 0);

    if (activite) price += 50;

    price *= +nbAdultes.value + +nbEnfants.value;

    if (offrir && !ecoffret) price += 5;
    price += nbChambresSimple.value * 75;
    price += nbChambresDouble.value * 100;
    price += nbChambresTriple.value * 125;

    priceElement.innerText = price.toFixed(2).replace(/\./g, ",") + " €";
}

updatePrice();
