const promo_overlay = document.getElementById("reduc") as HTMLDivElement,
    promo_idSejour = document.getElementById(
        "reduc-idsejour"
    ) as HTMLInputElement,
    promo_inputPrix = document.getElementById(
        "reduc-nouvprix"
    ) as HTMLInputElement,
    promo_inputPourcentage = document.getElementById(
        "reduc-pourcentage"
    ) as HTMLInputElement,
    promo_buttonAnnuler = document.getElementById(
        "reduc-annuler"
    ) as HTMLButtonElement;

if (promo_overlay) {
    function promo_overlayShow(idsejour: string) {
        if (promo_overlay.classList.contains("hidden")) {
            promo_idSejour.value = idsejour;
            promo_overlay.classList.remove("hidden");
        }
    }

    document.querySelectorAll(".reduction").forEach((btn) => {
        btn.addEventListener("click", () =>
            promo_overlayShow(btn.getAttribute("data-idsejour")!)
        );
    });

    promo_buttonAnnuler.addEventListener("click", () => {
        promo_overlay.classList.add("hidden");
        promo_inputPourcentage.value =
            promo_inputPourcentage.getAttribute("basevalue")!;
        promo_inputPrix.value = promo_inputPrix.getAttribute("basevalue")!;
    });

    promo_inputPrix.addEventListener("input", () => {
        promo_inputPourcentage.value = (
            (1 -
                +promo_inputPrix.value! /
                    +promo_inputPrix.getAttribute("max")!) *
            100
        ).toFixed(2);
    });

    promo_inputPourcentage.addEventListener("input", () => {
        promo_inputPrix.value = (
            (+promo_inputPrix.getAttribute("max")! *
                (100 - +promo_inputPourcentage.value!)) /
            100
        ).toFixed(2);
    });
}

const avis_overlay = document.getElementById("publier-avis") as HTMLDivElement,
    avis_ecrire = document.getElementById("ecrire-avis") as HTMLButtonElement,
    avis_inputTitre = document.getElementById(
        "pavis-titre"
    ) as HTMLInputElement,
    avis_inputDescription = document.getElementById(
        "pavis-description"
    ) as HTMLInputElement,
    avis_buttonAnnuler = document.getElementById(
        "pavis-annuler"
    ) as HTMLButtonElement;

function avis_overlaySuppression(idsejour: string) {
    if (avis_overlay.classList.contains("hidden")) {
        avis_overlay.classList.remove("hidden");
    }
}

avis_ecrire.addEventListener("click", () => {
    avis_overlaySuppression(avis_ecrire.getAttribute("data-idsejour")!);
});

avis_buttonAnnuler.addEventListener("click", () => {
    avis_overlay.classList.add("hidden");
    avis_inputTitre.value = "";
    avis_inputDescription.value = "";
});

const maxCooldown = 1000 * 5;
let cooldown = false;

document.querySelectorAll(".signaler").forEach((btn) => {
    btn.addEventListener("click", () => {
        if (cooldown) return;

        const elt = createElement("p", btn.parentElement!.parentElement!, {
            innerText:
                "Merci pour votre signalement. Il sera étudier dans les prochains jours afin de prendres les mesures nécessaires.",
            classes: ["alert", "alert-success"],
            insertBefore: btn.parentElement!,
        });

        cooldown = true;

        setTimeout(() => {
            elt.remove();
        }, 1000 * 4);

        setTimeout(() => {
            cooldown = false;
        }, maxCooldown);
    });
});
