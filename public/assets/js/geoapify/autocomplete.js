const myAPIKey = "a6a920505a804fa39096deb61a2c10d6";

const streetInput = new autocomplete.GeocoderAutocomplete(
    document.getElementById("street"),
    myAPIKey,
    {
        type: "street",
        allowNonVerifiedHouseNumber: true,
        allowNonVerifiedStreet: true,
        skipDetails: true,
        skipIcons: true,
        placeholder: " ",
    }
);

const stateInput = new autocomplete.GeocoderAutocomplete(
    document.getElementById("state"),
    myAPIKey,
    {
        type: "state",
        skipDetails: true,
        placeholder: " ",
        skipIcons: true,
    }
);

const cityInput = new autocomplete.GeocoderAutocomplete(
    document.getElementById("city"),
    myAPIKey,
    {
        type: "city",
        skipDetails: true,
        skipIcons: true,
        placeholder: " ",
    }
);

const countryInput = new autocomplete.GeocoderAutocomplete(
    document.getElementById("country"),
    myAPIKey,
    {
        type: "country",
        skipDetails: true,
        placeholder: " ",
        skipIcons: true,
    }
);

const postcodeElement = document.getElementById("cpadresse");
const housenumberElement = document.getElementById("numadresse");

streetInput.on("select", (street) => {
    if (street) {
        streetInput.setValue(street.properties.street || "");
    }

    if (street && street.properties.housenumber) {
        housenumberElement.value = street.properties.housenumber;
    }

    if (street && street.properties.postcode) {
        postcodeElement.value = street.properties.postcode;
    }

    if (street && street.properties.city) {
        cityInput.setValue(street.properties.city);
    }

    if (street && street.properties.state) {
        stateInput.setValue(street.properties.state);
    }

    if (street && street.properties.country) {
        countryInput.setValue(street.properties.country);
    }
});

cityInput.on("select", (city) => {
    if (city) {
        cityInput.setValue(city.properties.city || "");
    }

    if (city && city.properties.postcode) {
        postcodeElement.value = city.properties.postcode;
    }

    if (city && city.properties.state) {
        stateInput.setValue(city.properties.state);
    }

    if (city && city.properties.country) {
        countryInput.setValue(city.properties.country);
    }
});

stateInput.on("select", (state) => {
    if (state) {
        stateInput.setValue(state.properties.state || "");
    }

    if (state && state.properties.country) {
        countryInput.setValue(state.properties.country);
    }
});

async function checkAddress() {
    const postcode = document.getElementById("cpadresse").value;
    const city = cityInput.getValue();
    const street = streetInput.getValue();
    const country = countryInput.getValue();
    const housenumber = document.getElementById("numadresse").value;

    const message = document.getElementById("message");
    message.textContent = "";

    if (!postcode || !city || !street || !housenumber || !country) {
        highlightEmpty();
        message.textContent = "Veuillez remplir tous les champs.";
        return;
    }

    var requestOptions = {
        method: "GET",
    };
    // Check the address with Geoapify Geocoding API
    // You may use it for internal information only. Please note that house numbers might be missing for new buildings and non-mapped buildings. So consider that most addresses with verified streets and cities are correct.
    try {
        fetch(
            `https://api.geoapify.com/v1/geocode/search?housenumber=${encodeURIComponent(
                housenumber
            )}&street=${encodeURIComponent(
                street
            )}&postcode=${encodeURIComponent(
                postcode
            )}&city=${encodeURIComponent(city)}&country=${encodeURIComponent(
                country
            )}&apiKey=${myAPIKey}`,
            requestOptions
        )
            .then((result) => result.json())
            .then((result) => {
                let features = result.features || [];

                // To find a confidence level that works for you, try experimenting with different levels
                const confidenceLevelToAccept = 0.25;
                features = features.filter(
                    (feature) =>
                        feature.properties.rank.confidence >=
                        confidenceLevelToAccept
                );
                if (features.length) {
                    const foundAddress = features[0];

                    if (foundAddress.properties.rank.confidence === 1) {
                        console.log("oui");
                        document.getElementById("modification").requestSubmit();
                    } else if (
                        foundAddress.properties.rank.confidence_street_level ===
                        1
                    ) {
                        message.textContent = `Ce numéro n'existe pas à cette adresse, veuillez vérifier le numéro indiqué.`;
                    } else {
                        message.textContent =
                            "Votre adresse est introuvable, veuillez vérifier si vous avez renseigner une adresse correcte";
                    }
                } else {
                    message.textContent =
                        "Votre adresse est introuvable, veuillez vérifier si vous avez renseigner une adresse correcte";
                }
            });
    } catch (error) {
        console.log(error);
    }
}

function highlightEmpty() {
    const toHightlight = [];

    if (!document.getElementById("cpadresse").value) {
        toHightlight.push(document.getElementById("cpadresse"));
    }

    if (!cityInput.getValue()) {
        toHightlight.push(cityInput.inputElement);
    }

    if (!streetInput.getValue()) {
        toHightlight.push(streetInput.inputElement);
    }

    if (!document.getElementById("numadresse").value) {
        toHightlight.push(document.getElementById("numadresse"));
    }

    if (!stateInput.getValue()) {
        toHightlight.push(stateInput.inputElement);
    }

    if (!countryInput.getValue()) {
        toHightlight.push(countryInput.inputElement);
    }

    toHightlight.forEach((element) => element.classList.add("warning-input"));

    setTimeout(() => {
        toHightlight.forEach((element) =>
            element.classList.remove("warning-input")
        );
    }, 3000);
}

-document.getElementById("submit").addEventListener("click", () => {
    document.getElementById("paysadresse").value = countryInput.getValue();
    document.getElementById("villeadresse").value = cityInput.getValue();
    document.getElementById("rueadresse").value = streetInput.getValue();
    document.activeElement.blur();

    checkAddress();
});

streetInput.setValue(document.getElementById("oldstreet").value);
countryInput.setValue(document.getElementById("oldcountry").value);
cityInput.setValue(document.getElementById("oldcity").value);
