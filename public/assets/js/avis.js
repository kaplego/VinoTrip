document.querySelectorAll(".signaler").forEach((btn) => {
    btn.addEventListener("click", () =>
        createElement("p", btn.parentElement, {
            innerText:"Merci pour votre signalement. Il sera étudier dans les prochains jours afin de prendres les mesures nécessaires.",
        }).style = "background-color : rgba(0,255,0,0.2); text-align : center; margin-top: 5px"
    );
});
