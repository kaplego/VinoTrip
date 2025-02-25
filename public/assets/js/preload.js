"use strict";
const sleep = async (ms) => new Promise((r) => setTimeout(r, ms));
document.querySelectorAll(".clipboard-copy[data-text]").forEach((element) => {
    element.setAttribute("data-tooltip", "Copier dans le presse-papier");
    const iconCopy = document.createElement("i");
    iconCopy.setAttribute("data-lucide", "copy");
    iconCopy.classList.add("icon-copy");
    element.appendChild(iconCopy);
    const iconCopied = document.createElement("i");
    iconCopied.setAttribute("data-lucide", "circle-check-big");
    iconCopied.classList.add("icon-copied");
    element.appendChild(iconCopied);
    element.addEventListener("click", async () => {
        element.setAttribute("data-tooltip", "Copié !");
        element.classList.add("copied");
        navigator.clipboard.writeText(element.getAttribute("data-text") ?? '');
        await sleep(1500);
        element.classList.remove("copied");
        element.setAttribute("data-tooltip", "Copier");
    });
});
document.querySelectorAll("*[data-help]").forEach((element) => {
    const icon = document.createElement("i");
    icon.setAttribute("data-lucide", "circle-help");
    element.appendChild(icon);
});
