import A2F from "../classes/a2f.js";

const form = document.getElementById("a2f-form")! as HTMLFormElement,
    code = document.getElementById("a2f-code")! as HTMLInputElement,
    buttonSubmit = document.getElementById(
        "button-submit"
    )! as HTMLButtonElement,
    buttonCancel = document.getElementById(
        "button-cancel"
    )! as HTMLButtonElement,
    complete = document.getElementById("a2f-complete")! as HTMLDivElement,
    completeText = complete.querySelector<HTMLSpanElement>(".text")!,
    error = document.getElementById("a2f-code-error")! as HTMLDivElement,
    errorText = error.querySelector<HTMLSpanElement>(".text")!;

const a2f = new A2F([buttonSubmit, buttonCancel], "/api/client/a2f");

a2f.init((verifying) => {
    if (verifying) {
        code.classList.remove("hidden");
        buttonCancel.classList.remove("hidden");
    }
});

buttonCancel.addEventListener("click", () => {
    a2f.cancel((ok) => {
        if (ok) {
            code.classList.add("hidden");
            code.value = "";
            buttonCancel.classList.add("hidden");

            completeText.innerText = "L'opération a bien été annulée.";
        } else {
            errorText.innerText = "Une erreur s'est produite.";
        }
        complete.classList.toggle("hidden", !ok);
        error.classList.toggle("hidden", ok);
    });
});

form.addEventListener("submit", (ev) => {
    ev.preventDefault();
    ev.stopPropagation();

    if (!a2f.verifying) {
        a2f.start((ok) => {
            if (ok) {
                code.classList.remove("hidden");
                buttonCancel.classList.remove("hidden");
            }
        });
    } else {
        a2f.check(
            new FormData(form).get("code") as string ?? "",
            (result) => {
                if (result.ok) {
                    code.classList.add("hidden");
                    code.value = "";
                    buttonCancel.classList.add("hidden");

                    if (result.status === "disabled") {
                        buttonSubmit.innerText = "Activer l'A2F";
                        completeText.innerText = "L'A2F a bien été désactivée.";
                    } else {
                        buttonSubmit.innerText = "Désactiver l'A2F";
                        completeText.innerText = "L'A2F a bien été activée.";
                    }
                } else {
                    errorText.innerText = result.error;
                }
                complete.classList.toggle("hidden", !result.ok);
                error.classList.toggle("hidden", result.ok);
            }
        );
    }
});
