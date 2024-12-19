// Générer les icônes
lucide.createIcons();

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
