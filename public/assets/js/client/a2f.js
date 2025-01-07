const form = document.getElementById("a2f-form"),
    code = document.getElementById("a2f-code"),
    buttonSubmit = document.getElementById("button-submit"),
    buttonCancel = document.getElementById("button-cancel"),
    error = document.getElementById("a2f-code-error");

function toggleButtons(force = null) {
    buttonSubmit.disabled = force !== null ? !force : !buttonSubmit.disabled;
    buttonCancel.disabled = force !== null ? !force : !buttonCancel.disabled;
}

let verifying = false;

form.addEventListener("submit", async (ev) => {
    ev.preventDefault();
    ev.stopPropagation();

    toggleButtons(false);
    if (!verifying) {
        const res = await axios.put("/api/client/a2f/login");
        if (res.data.ok && res.data.status && res.data.status === "pending") {
            code.classList.remove("hidden");
            buttonSubmit.value = 'Vérifier le code';
            buttonCancel.classList.remove("hidden");
            verifying = true;
        }
        toggleButtons(true);
    } else {
        const res = await axios.post(
            "/api/client/a2f/login",
            new FormData(form)
        );
        if (res.data.ok) {
            window.location.href = '/client';
        } else {
            error.querySelector(".text").innerText = res.data.error;
            error.classList.remove("hidden");
            toggleButtons(true);
        }
    }
});

buttonCancel.addEventListener("click", async () => {
    if (verifying) {
        toggleButtons(false);
        const res = await axios.delete("/api/client/a2f/login");
        if (!(res.data.ok && res.data.status && res.data.status === "canceled")) {
            error.querySelector(".text").innerText =
                "Une erreur s'est produite.";
            error.classList.remove("hidden");
        }

        window.location.href = '/connexion';
    }
});

async function load() {
    const res = await axios.get("/api/client/a2f/login");
    if (res.data.ok && res.data.status && res.data.status === "pending") {
        code.classList.remove("hidden");
        buttonSubmit.value = 'Vérifier le code';
        buttonCancel.classList.remove("hidden");
        verifying = true;
    }
}

load();
