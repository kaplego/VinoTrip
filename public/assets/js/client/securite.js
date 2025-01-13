import A2F from "../classes/a2f.js";
const form = document.getElementById("a2f-form"), code = document.getElementById("a2f-code"), buttonSubmit = document.getElementById("button-submit"), buttonCancel = document.getElementById("button-cancel"), complete = document.getElementById("a2f-complete"), completeText = complete.querySelector(".text"), error = document.getElementById("a2f-code-error"), errorText = error.querySelector(".text");
const a2f = new A2F([buttonSubmit, buttonCancel], "/api/client/a2f");
a2f.init((verifying) => {
    if (verifying) {
        code.classList.remove("hidden");
        buttonCancel.classList.remove("hidden");
    }
});
buttonCancel.addEventListener("click", async () => {
    a2f.cancel((ok) => {
        if (ok) {
            code.classList.add("hidden");
            code.value = "";
            buttonCancel.classList.add("hidden");
            completeText.innerText = "L'opération a bien été annulée.";
        }
        else {
            errorText.innerText = "Une erreur s'est produite.";
        }
        complete.classList.toggle("hidden", !ok);
        error.classList.toggle("hidden", ok);
    });
});
form.addEventListener("submit", async (ev) => {
    ev.preventDefault();
    ev.stopPropagation();
    if (!a2f.verifying) {
        a2f.start((ok) => {
            if (ok) {
                code.classList.remove("hidden");
                buttonCancel.classList.remove("hidden");
            }
        });
    }
    else {
        a2f.check(new FormData(form).get("code")?.toString() ?? "", (result) => {
            if (result.ok) {
                code.classList.add("hidden");
                code.value = "";
                buttonCancel.classList.add("hidden");
                if (result.status === "disabled") {
                    buttonSubmit.innerText = "Activer l'A2F";
                    completeText.innerText = "L'A2F a bien été désactivée.";
                }
                else {
                    buttonSubmit.innerText = "Désactiver l'A2F";
                    completeText.innerText = "L'A2F a bien été activée.";
                }
            }
            else {
                errorText.innerText = result.error;
            }
            complete.classList.toggle("hidden", !result.ok);
            error.classList.toggle("hidden", result.ok);
        });
    }
});
