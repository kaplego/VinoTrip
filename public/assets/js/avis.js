const maxCooldown = 1000 * 5;
let cooldown = false;

document.querySelectorAll(".signaler").forEach((btn) => {
    btn.addEventListener("click", () => {
        if (cooldown) return;

        const elt = createElement("p", btn.parentElement, {
            innerText:
                "Merci pour votre signalement. Il sera étudier dans les prochains jours afin de prendres les mesures nécessaires.",
            classes: ["alert", "alert-success"],
            insertBefore: btn.nextElementSibling,
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
