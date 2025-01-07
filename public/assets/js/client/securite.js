const form = document.getElementById("a2f-form"),
    code = document.getElementById("a2f-code"),
    buttonSubmit = document.getElementById("button-submit"),
    buttonCancel = document.getElementById("button-cancel"),
    complete = document.getElementById("a2f-complete"),
    error = document.getElementById("a2f-code-error");

let verifying = false;

form.addEventListener("submit", async (ev) => {
    ev.preventDefault();
    ev.stopPropagation();

    if (!verifying) {
        const res = await axios.put("/api/client/a2f");
        if (res.data.ok && res.data.status && res.data.status === "pending") {
            code.classList.remove("hidden");
            buttonCancel.classList.remove("hidden");
            verifying = true;
        }
    } else {
        const res = await axios.post(
            "/api/client/a2f",
            new FormData(form)
        );
        if (res.data.ok) {
            code.classList.add("hidden");
            code.value = '';
            error.classList.add("hidden");
            buttonCancel.classList.add("hidden");

            if (res.data.status === "disabled") {
                buttonSubmit.value = "Activer l'A2F";
                complete.querySelector(".text").innerText =
                    "L'A2F a bien été désactivée.";
            } else {
                buttonSubmit.value = "Désactiver l'A2F";
                complete.querySelector(".text").innerText =
                    "L'A2F a bien été activée.";
            }

            complete.classList.remove("hidden");
            verifying = true;
        } else {
            complete.classList.add("hidden");
            error.querySelector(".text").innerText = res.data.error;
            error.classList.remove("hidden");
        }
    }
});

buttonCancel.addEventListener("click", async () => {
    if (verifying) {
        const res = await axios.delete("/api/client/a2f");
        if (res.data.ok && res.data.status && res.data.status === "canceled") {
            code.classList.add("hidden");
            code.value = '';
            error.classList.add("hidden");
            buttonCancel.classList.add("hidden");

            complete.querySelector(".text").innerText =
                "L'opération a bien été annulée.";

            complete.classList.remove("hidden");
            verifying = false;
        } else {
            complete.classList.add("hidden");
            error.querySelector(".text").innerText =
                "Une erreur s'est produite.";
            error.classList.remove("hidden");
        }
    }
});

async function load() {
    const res = await axios.get("/api/client/a2f");
    if (res.data.ok && res.data.status && res.data.status === "pending") {
        code.classList.remove("hidden");
        buttonCancel.classList.remove("hidden");
        verifying = true;
    }
}

load();
