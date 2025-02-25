import A2F from "../classes/a2f.js";
const form = document.getElementById("a2f-form"), code = document.getElementById("a2f-code"), buttonSubmit = document.getElementById("button-submit"), buttonCancel = document.getElementById("button-cancel"), error = document.getElementById("a2f-code-error"), errorText = error.querySelector(".text");
const a2f = new A2F([buttonSubmit, buttonCancel], "/api/client/a2f/login");
a2f.init((ok) => {
    if (ok) {
        code.classList.remove("hidden");
        buttonSubmit.value = "Vérifier le code";
        buttonCancel.classList.remove("hidden");
    }
});
form.addEventListener("submit", async (ev) => {
    ev.preventDefault();
    ev.stopPropagation();
    if (!a2f.verifying) {
        a2f.start((ok) => {
            if (ok) {
                code.classList.remove("hidden");
                buttonSubmit.value = "Vérifier le code";
                buttonCancel.classList.remove("hidden");
            }
        });
    }
    else {
        a2f.check(new FormData(form).get("code")?.toString() ?? "", (result) => {
            if (result.ok) {
                window.location.href = "/client";
            }
            else {
                errorText.innerText = result.error;
                error.classList.remove("hidden");
            }
        });
    }
});
buttonCancel.addEventListener("click", async () => {
    a2f.cancel(async (ok) => {
        if (ok) {
            errorText.innerText = "Une erreur s'est produite.";
            error.classList.remove("hidden");
        }
        window.location.href = "/connexion";
        await new Promise((r) => setTimeout(r, 5000));
    });
});
