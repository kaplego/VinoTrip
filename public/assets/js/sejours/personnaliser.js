const activite_overlay = document.getElementById("form-add-activite"), activite_idEtape = document.getElementById("activite-idetape"), activite_inputPrix = document.getElementById("activite-prix"), activite_inputNomActivite = document.getElementById("activite-nom"), activite_buttonAnnuler = document.getElementById("activite-annuler");
if (activite_overlay) {
    function activite_overlayShow(idetape) {
        if (activite_overlay.classList.contains("hidden")) {
            activite_idEtape.value = idetape;
            activite_overlay.classList.remove("hidden");
        }
    }
    document.querySelectorAll(".add-activite").forEach((btn) => {
        btn.addEventListener("click", () => activite_overlayShow(btn.getAttribute("data-idetape")));
    });
    activite_buttonAnnuler.addEventListener("click", () => {
        activite_overlay.classList.add("hidden");
        activite_inputNomActivite.value = "";
        activite_inputPrix.value = "50"
    });
}


const delete_activite_overlay = document.getElementById("form-delete-activite"),delete_activite_idActivite = document.getElementById("delete-activite-idactivite") , delete_activite_idEtape = document.getElementById("delete-activite-idetape"),  delete_activite_buttonAnnuler = document.getElementById("delete-activite-annuler")
if (delete_activite_overlay) {
    function delete_activite_overlayShow(idetape, idactivite) {
        if (delete_activite_overlay.classList.contains("hidden")) {
            delete_activite_idEtape.value = idetape;
            delete_activite_idActivite.value = idactivite
            delete_activite_overlay.classList.remove("hidden");
        }
    }
    document.querySelectorAll(".delete-activite").forEach((btn) => {
        btn.addEventListener("click", () => delete_activite_overlayShow(btn.getAttribute("data-idetape"),btn.getAttribute("data-idactivite")));
    });
}
