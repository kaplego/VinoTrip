let page = 0;

/** @type {HTMLFormElement} */
const formFiltres = document.getElementById("filtres"),
    articlesSejours = document.querySelectorAll("article.sejour");

// Charger les images quand l'utilisateur scroll plutôt qu'au chargement de la page
articlesSejours.forEach((article) => {
    const img = article.querySelector('.image');
    if (!img || !img.hasAttribute('data-src')) return;

    const observer = new IntersectionObserver(
        (entries) => {
            if (entries[0].isIntersecting) {
                img.src = img.getAttribute('data-src');
                img.removeAttribute('data-src');
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
        if (
            duree !== "all" &&
            article.getAttribute("data-duree") !== duree
        )
            hidden = true;
        if (
            participant !== "all" &&
            !article
                .getAttribute("data-participants")
                .split(",")
                .includes(participant)
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
    selectLocalite = document.getElementById("localite");

selectVignoble.addEventListener("change", (event) => {
    if ([].includes(selectVignoble.value))
        selectLocalite.classList.remove("hidden");
    else selectLocalite.classList.add("hidden");
});
