declare const hebergements: {
    idhebergement: string;
    descriptionhebergement: string;
}[];

/* ========================================== *
 * ==               LOCALITE               == *
 * ========================================== */

const vignobleSelect = document.getElementById("vignoble") as HTMLSelectElement,
    localiteControl = document.getElementById(
        "localite-control"
    ) as HTMLDivElement,
    localiteSelect = document.getElementById("localite") as HTMLSelectElement;

function updateLocalite() {
    const vignoble = vignobleSelect.value;

    localiteControl.classList.toggle(
        "hidden",
        localiteSelect.querySelectorAll(`option[data-vignoble='${vignoble}']`)
            .length === 0
    );

    localiteSelect.querySelectorAll(`option`).forEach((localite) => {
        localite.classList.toggle(
            "hidden",
            localite.getAttribute("data-vignoble") != vignoble &&
                localite.value !== "null"
        );
    });
    localiteSelect.value = "null";
}

updateLocalite();
vignobleSelect.addEventListener("change", () => updateLocalite());

/* ========================================== *
 * ==                ETAPES                == *
 * ========================================== */

const etapesTitre = document.getElementById(
        "etapes-titre"
    ) as HTMLHeadingElement,
    addEtape = document.getElementById("add-etape") as HTMLButtonElement,
    etapes = document.getElementById("etapes") as HTMLDivElement,
    maxEtapes = 5,
    minEtapes = 1;

const countEtapes = () => etapes.querySelectorAll(".etape").length;

function updateEtapeCount() {
    const nbEtapes = countEtapes();
    etapesTitre.innerText = `Étapes (${nbEtapes}/${maxEtapes} max)`;
    etapes
        .querySelectorAll<HTMLButtonElement>(".btn-supprimer")
        .forEach((btn) => (btn.disabled = nbEtapes <= minEtapes));
    addEtape.disabled = nbEtapes >= maxEtapes;
}

function updateEtapeIndexes() {
    etapes.querySelectorAll<HTMLDivElement>(".etape").forEach((etape, i) => {
        etape.id = `etape-${i}`;
        etape.querySelector<HTMLInputElement>(
            'input[type="file"]'
        )!.name = `etapes[${i}][image]`;
        etape.querySelector<HTMLInputElement>(
            "input.titre"
        )!.name = `etapes[${i}][titre]`;
        etape.querySelector<HTMLTextAreaElement>(
            "textarea.description"
        )!.name = `etapes[${i}][description]`;
        etape.querySelector<HTMLLabelElement>(".hebergement label")!.htmlFor =
            etape.querySelector(".hebergement select")!.id = `hebergement-${i}`;
        etape.querySelector<HTMLSelectElement>(
            ".hebergement select"
        )!.name = `etapes[${i}][hebergement]`;
        etape
            .querySelector<HTMLButtonElement>(".button.btn-supprimer")!
            .setAttribute("data-etape", `${i}`);
    });
}

function deleteEtape(ev: MouseEvent) {
    if (ev.currentTarget instanceof HTMLElement) {
        document
            .getElementById(
                "etape-" + ev.currentTarget.getAttribute("data-etape")
            )
            ?.remove();
        document
            .getElementById(
                "hebergement-" + ev.currentTarget.getAttribute("data-etape")
            )
            ?.remove();
    }

    updateEtapeIndexes();
    updateEtapeCount();
}

function createEtape() {
    updateEtapeIndexes();

    if (countEtapes() >= maxEtapes) return;

    const etapeIndex = countEtapes();

    // ======================== ETAPE ========================

    const etape = createElement("div", etapes, {
        class: "etape",
        id: `etape-${etapeIndex}`,
    });

    // ------------ PHOTO ------------

    const etapeImageControl = createElement("div", etape, {
        classes: ["image", "input-control", "input-control-image"],
    });

    const etapeImageImage = createElement("div", etapeImageControl, {
        class: "image",
    });
    createElement("img", etapeImageImage, {
        src: "https://placehold.co/1600x900/png?text=Choisir+une+image",
    });
    createElement("div", etapeImageImage, {
        class: "hover",
    });

    const etapeImageInputs = createElement("div", etapeImageControl, {
        class: "input-container",
    });

    createElement("input", etapeImageInputs, {
        type: "file",
        accept: "image/png, image/jpeg",
    });

    createImageField(etapeImageControl);

    // ------------ INPUTS ------------

    createElement("input", etape, {
        class: "titre",
        type: "text",
        value: "Titre",
        name: `etapes[${etapeIndex}][titre]`,
    });

    createElement("textarea", etape, {
        class: "description",
        innerText: "Description",
        name: `etapes[${etapeIndex}][description]`,
        rows: 3,
    });

    // ------------ HEBERGEMENT ------------

    const hebergement = createElement("div", etape, {
        classes: ["hebergement", "input-control", "input-control-select"],
    });

    let hebergementId = `hebergement-${etapeIndex}`;

    createElement("label", hebergement, {
        for: hebergementId,
        innerText: "Hébergement",
    });

    const hebergementSelect = createElement("select", hebergement, {
        class: "hebergement",
        name: `etapes[${etapeIndex}][hebergement]`,
        id: hebergementId,
    });

    for (const opt of hebergements) {
        createElement("option", hebergementSelect, {
            value: opt.idhebergement,
            innerText: `${opt.idhebergement}. ${opt.descriptionhebergement}`,
        });
    }

    // ------------ DELETE ------------

    const btnSupprimer = createElement("button", etape, {
        classes: ["button", "btn-supprimer"],
        type: "button",
        data: {
            etape: etapeIndex,
        },
    });
    icon("trash-2", btnSupprimer, true);
    btnSupprimer.addEventListener("click", deleteEtape);

    updateEtapeCount();
}

// etapes.querySelectorAll<HTMLDivElement>(".etape").forEach((etape) => {
//     const etapePhoto = etape.querySelector<HTML>(".image"),
//         etapePhotoImg = etapePhoto.querySelector("img"),
//         etapePhotoInput = etapePhoto.querySelector("input");
//     etapePhoto.addEventListener("click", () => {
//         etapePhotoInput.click();
//     });
//     etapePhotoInput.addEventListener("change", () => {
//         etapePhotoImg.src = URL.createObjectURL(etapePhotoInput.files[0]);
//     });

//     const btnSupprimer = etape.querySelector(".button.btn-supprimer");
//     btnSupprimer.addEventListener("click", deleteEtape);
// });
updateEtapeIndexes();
updateEtapeCount();

addEtape.addEventListener("click", () => createEtape());

for (let i = countEtapes(); i < minEtapes; i++) {
    createEtape();
}
