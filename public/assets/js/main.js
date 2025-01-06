const CardTypes = {
    mastercard:
        /^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$/,
    visa: /^4[0-9]{6,}$/,
    amex: /^3[47][0-9]{5,}$/,
};

function creditCardType(number) {
    for (const type in CardTypes) {
        if (CardTypes[type].test(number.toString())) return type;
    }
    return 'unknown';
}

/**
 * @typedef {{
 *  class: string;
 *  classes: string[];
 *  id: string;
 *  innerText: string;
 *  innerHTML: string;
 *  data: Record<string, string>;
 * }} CreateElementConfig
 *
 * @typedef { {
 *  type: "button" | "checkbox" | "color" | "date" | "datetime-local" | "email" | "file" | "hidden" | "image" | "month" | "number" | "password" | "radio" | "range" | "reset" | "search" | "submit" | "tel" | "text" | "time" | "url" | "week";
 *  value: string;
 *  name: string;
 *  hidden: boolean;
 *  disabled: boolean;
 * }} CreateInputElementConfig
 *
 * @typedef {{
 *  input: CreateInputElementConfig;
 *  textarea: {
 *      name: string;
 *      cols: number;
 *      rows: number;
 *  };
 *  select: Exclude<CreateInputElementConfig, 'type' | 'value'>;
 *  option: {
 *      value: string;
 *  };
 *  button: {
 *      type: "button" | "submit"
 *  };
 *  label: {
 *      for: string;
 *  };
 *  img: {
 *      src: string;
 *      alt: string;
 *  };
 * }} CreateSpecificElementConfig
 */

/**
 * @template {keyof HTMLElementTagNameMap} Tag
 * @param {Tag} tag
 * @param {Node} parent
 * @param {Partial<CreateSpecificElementConfig[Tag] & CreateElementConfig>?} config
 * @returns {HTMLElementTagNameMap[Tag]}
 */
function createElement(tag, parent, config = null) {
    const element = document.createElement(tag);

    if (config) {
        if (config.class) element.classList.add(config.class);
        else if (config.classes) element.classList.add(...config.classes);

        if (config.id) element.id = config.id;

        if (config.innerText) element.innerText = config.innerText;
        if (config.innerHTML) element.innerHTML = config.innerHTML;

        if (config.data) {
            Object.entries(config.data).forEach(([name, value]) => {
                element.setAttribute(`data-${name}`, value);
            });
        }

        if (tag === 'button') {
            if (config.type) element.type = config.type;
        }
        else if (tag === 'input' || tag === 'select') {
            if (config.name) element.name = config.name;
            if (config.hidden) element.hidden = config.hidden;
            if (config.disabled) element.hidden = config.hidden;
            if (tag === 'input') {
                if (config.type) element.type = config.type;
                if (config.value) element.value = config.value;
            }
        }
        else if (tag === 'textarea') {
            if (config.name) element.name = config.name;
            if (config.cols) element.cols = config.cols;
            if (config.rows) element.rows = config.rows;
        }
        else if (tag === 'option') {
            if (config.value) element.value = config.value;
        }
        else if (tag === 'img') {
            if (config.src) element.src = config.src;
            if (config.alt) element.alt = config.alt;
        }
    }

    parent.appendChild(element);

    return element;
}

/**
 * @param {string} name
 * @param {Node} parent
 * @param {boolean} createIcons
 * @returns {HTMLElement}
 */
function icon(name, parent, createIcons = true) {
    const i = createElement('i', parent, {
        data: {
            lucide: name
        }
    });

    if (createIcons)
        lucide.createIcons();

    return i;
}

const requiredFields = document.querySelectorAll('.input-control.required');

requiredFields.forEach((field) => {
    const span = createElement('span', field.querySelector('label') ?? field.firstElementChild, {
        class: 'required-star',
        data: {
            tooltip: 'Requis'
        }
    });
    icon('asterisk', span);
});

// Générer les icônes
lucide.createIcons();
