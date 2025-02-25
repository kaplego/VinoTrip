let page = 0;

/** @type {HTMLFormElement} */
const formFiltres = document.getElementById("filtres"),
    articlesSejours = document.querySelectorAll("article.sejour");

// Charger les images quand l'utilisateur scroll plutôt qu'au chargement de la page
articlesSejours.forEach((article) => {
    const img = article.querySelector(".image");
    if (!img || !img.hasAttribute("data-src")) return;

    const observer = new IntersectionObserver(
        (entries) => {
            if (entries[0].isIntersecting) {
                img.src = img.getAttribute("data-src");
                img.removeAttribute("data-src");
                observer.unobserve(img);
            }
        },
        {
            threshold: 1.0,
            rootMargin: `${window.innerHeight}px 0px ${window.innerHeight}px 0px`,
        }
    );
    observer.observe(img);
});

formFiltres.addEventListener("submit", (event) => {
    event.preventDefault();
    event.stopPropagation();

    const data = new FormData(formFiltres);

    const vignoble = data.get("vignoble") ?? "all",
        localite = data.get("localite") ?? "all",
        duree = data.get("duree") ?? "all",
        participant = data.get("participant") ?? "all",
        envies = data.get("envies") ?? "all";

    articlesSejours.forEach((article) => {
        let hidden = false;

        if (
            vignoble !== "all" &&
            article.getAttribute("data-vignoble") !== vignoble
        )
            hidden = true;
        if (duree !== "all" && article.getAttribute("data-duree") !== duree)
            hidden = true;
        if (
            localite !== "all" &&
            article.getAttribute("data-localite") !== localite
        )
            hidden = true;
        if (
            participant !== "all" &&
            article.getAttribute("data-participant") !== participant
        )
            hidden = true;
        if (
            envies !== "all" &&
            article.getAttribute("data-categorie") !== envies
        )
            hidden = true;

        article.classList.toggle("hidden", hidden);
    });
});

/** @type {HTMLSelectElement} */
const selectVignoble = document.getElementById("vignoble"),
    /** @type {HTMLSelectElement} */
    selectLocalite = document.getElementById("localite"),
    /** @type {NodeListOf<HTMLOptionElement>} */
    optionsLocalites = document.querySelectorAll("#localite option");

selectVignoble.addEventListener("change", (event) => {
    let nb = 0;
    optionsLocalites.forEach((opt, i) => {
        if (i < 2) return;

        let shown =
            opt.getAttribute("data-vignoble") === event.currentTarget.value;
        if (shown) nb++;
        opt.classList.toggle("hidden", !shown);
    });

    selectLocalite.classList.toggle("hidden", nb === 0);
    if (nb === 0) {
        selectLocalite.value = "all";
    }
});
