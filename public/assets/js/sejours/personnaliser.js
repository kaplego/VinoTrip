const activite_overlay = document.getElementById("form-add-activite"),
    activite_inputPrix = document.getElementById("activite-prix"),
    activite_inputNomActivite = document.getElementById("activite-nom"),
    activite_buttonAnnuler = document.getElementById("activite-annuler");
if (activite_overlay) {
    function activite_overlayShow(idetape) {
        if (activite_overlay.classList.contains("hidden")) {
            activite_overlay.action = `/api/etape/${idetape}/activite/add`;
            activite_overlay.classList.remove("hidden");
        }
    }
    document.querySelectorAll(".add-activite").forEach((btn) => {
        btn.addEventListener("click", () =>
            activite_overlayShow(btn.getAttribute("data-idetape"))
        );
    });
    activite_buttonAnnuler.addEventListener("click", () => {
        activite_overlay.classList.add("hidden");
        activite_inputNomActivite.value = "";
        activite_inputPrix.value = "50";
    });
}

const delete_activite_overlay = document.getElementById("form-delete-activite"),
    delete_activite_buttonAnnuler = document.getElementById(
        "delete-activite-annuler"
    );
if (delete_activite_overlay) {
    function delete_activite_overlayShow(idetape, idactivite) {
        if (delete_activite_overlay.classList.contains("hidden")) {
            activite_overlay.action = `/api/etape/${idetape}/activite/${idactivite}/delete`;
            delete_activite_overlay.classList.remove("hidden");
        }
    }
    document.querySelectorAll(".delete-activite-annuler").forEach((btn) => {
        btn.addEventListener("click", () =>
            delete_activite_overlay.classList.add("hidden")
        );
    });
    document.querySelectorAll(".delete-activite").forEach((btn) => {
        btn.addEventListener("click", () =>
            delete_activite_overlayShow(
                btn.getAttribute("data-idetape"),
                btn.getAttribute("data-idactivite")
            )
        );
    });
}

let offrir = false,
    ecoffret = false,
    prixHebergement = null;

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
    radiosOffrirContainer = document.getElementById("radios-offrir"),
    listeActivites = document.querySelectorAll(".activite");

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

    if (new FormData(form).getAll("repas[]").includes(id)) {
        repasElement.classList.add("active");
    }

    repasElement.addEventListener("click", () => {
        const checked = !new FormData(form).getAll("repas[]").includes(id);

        document.querySelector(`#repas-${id} > input`).checked = checked;
        repasElement.classList.toggle("active", checked);
        updatePrice();
    });
});

//======================= ACTIVITES

function prixFromActivite(activite) {
    return +document
        .getElementById(`activite-${activite}`)
        .getAttribute("data-price");
}

listeActivites.forEach((activiteCheckbox) => {
    activiteCheckbox.addEventListener("change", () => {
        updatePrice();
    });
});

//======================= OFFRIR

function setOffrir(checked) {
    offrir = checked;
    radiosOffrirContainer.classList.toggle("hidden", !checked);
    radiosOffrirContainer
        .querySelectorAll("input")
        .forEach((element) => (element.disabled = !checked));
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

//======================= MAJ PRIX

function updatePrice() {
    let price = prixDeBase;

    const data = new FormData(form);

    price += prixHebergement;
    price += data
        .getAll("repas[]")
        .reduce((prev, r) => prixFromRepas(r) + prev, 0);
    price += data
        .getAll("activites[]")
        .reduce((prev, a) => prixFromActivite(a) + prev, 0);

    price *= +nbAdultes.value + +nbEnfants.value;

    if (offrir && !ecoffret) price += 5;
    price += nbChambresSimple.value * 75;
    price += nbChambresDouble.value * 100;
    price += nbChambresTriple.value * 125;

    priceElement.innerText = price.toFixed(2).replace(/\./g, ",") + " €";
}

updatePrice();
