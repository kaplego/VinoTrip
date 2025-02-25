"use strict";
const CardTypes = {
    mastercard: /^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$/,
    visa: /^4[0-9]{6,}$/,
    amex: /^3[47][0-9]{5,}$/,
};
function creditCardType(number) {
    for (const type in CardTypes) {
        if (CardTypes[type].test(number.toString()))
            return type;
    }
    return "unknown";
}
function createElement(tag, parent, config = null) {
    const configuration = {
        ...(config ?? {}),
        tag,
    };
    const element = document.createElement(tag);
    if (configuration) {
        if (configuration.class)
            element.classList.add(configuration.class);
        else if (configuration.classes)
            element.classList.add(...configuration.classes);
        if (configuration.id)
            element.id = configuration.id;
        if (configuration.innerText)
            element.innerText = configuration.innerText;
        if (configuration.innerHTML)
            element.innerHTML = configuration.innerHTML;
        if (configuration.data) {
            Object.entries(configuration.data).forEach(([name, value]) => {
                element.setAttribute(`data-${name}`, value.toString());
            });
        }
        if (configuration.tag === "button" &&
            element instanceof HTMLButtonElement) {
            if (configuration.type)
                element.type = configuration.type;
        }
        else if ((configuration.tag === "input" &&
            element instanceof HTMLInputElement) ||
            (configuration.tag === "select" &&
                element instanceof HTMLSelectElement)) {
            if (configuration.name)
                element.name = configuration.name.toString();
            if (configuration.hidden)
                element.hidden = configuration.hidden;
            if (configuration.disabled)
                element.disabled = configuration.disabled;
            if (configuration.tag === "input" &&
                element instanceof HTMLInputElement) {
                if (configuration.type)
                    element.type = configuration.type;
                if (configuration.accept)
                    element.accept = configuration.accept;
                if (configuration.value)
                    element.value = configuration.value.toString();
            }
        }
        else if (configuration.tag === "textarea" &&
            element instanceof HTMLTextAreaElement) {
            if (configuration.name)
                element.name = configuration.name;
            if (configuration.cols)
                element.cols = configuration.cols;
            if (configuration.rows)
                element.rows = configuration.rows;
        }
        else if (configuration.tag === "option" &&
            element instanceof HTMLOptionElement) {
            if (configuration.value)
                element.value = configuration.value.toString();
        }
        else if (configuration.tag === "img" &&
            element instanceof HTMLImageElement) {
            if (configuration.src)
                element.src = configuration.src;
            if (configuration.alt)
                element.alt = configuration.alt;
        }
    }
    if (configuration && configuration.insertBefore)
        parent.insertBefore(element, configuration.insertBefore);
    else
        parent.appendChild(element);
    return element;
}
function icon(name, parent, createIcons = true) {
    const i = createElement("i", parent, {
        data: {
            lucide: name,
        },
    });
    if (createIcons)
        lucide.createIcons();
    return i;
}
const requiredFields = document.querySelectorAll(".input-control.required");
requiredFields.forEach((field) => {
    const span = createElement("span", field.querySelector("label") ?? field.firstElementChild, {
        class: "required-star",
        data: {
            tooltip: "Requis",
        },
    });
    icon("asterisk", span);
});
document.querySelectorAll("*[data-open]").forEach((element) => {
    element.addEventListener("click", (ev) => {
        if (ev.target instanceof HTMLAnchorElement && ev.target.href)
            return;
        window.open(element.getAttribute("data-open"), element.getAttribute("data-target") ?? "_self");
    });
});
const inputPhotos = document.querySelectorAll(".input-control-image");
const createImageField = (field) => {
    const input = field.querySelector("input"), removeButton = field.querySelector("button"), image = field.querySelector("img"), imageContainer = field.querySelector(".image"), hover = field.querySelector(".hover");
    if (input && image && imageContainer) {
        function change() {
            const hasFile = (input.files?.length ?? 0) > 0;
            if (removeButton)
                removeButton.disabled = !hasFile;
            image.src = hasFile
                ? URL.createObjectURL(input.files[0])
                : "https://placehold.co/800x450/png?text=Choisir+une+image";
        }
        change();
        input.addEventListener("change", change);
        imageContainer.addEventListener("click", (ev) => {
            input.click();
        });
        removeButton?.addEventListener("click", () => {
            input.value = "";
            change();
        });
        if (hover) {
            icon("image-up", hover);
        }
    }
};
inputPhotos.forEach(createImageField);
// Générer les icônes
lucide.createIcons();
