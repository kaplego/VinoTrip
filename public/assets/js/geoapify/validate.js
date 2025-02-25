const myAPIKey="a6a920505a804fa39096deb61a2c10d6"
const postcode = document.getElementById("cpadresse").value;
const housenumber = document.getElementById("housenumber").value;


fetch(`https://api.geoapify.com/v1/geocode/search?housenumber=${encodeURIComponent(housenumber)}&street=${encodeURIComponent(street)}&postcode=${encodeURIComponent(postcode)}&city=${encodeURIComponent(city)}&state=${encodeURIComponent(state)}&country=${encodeURIComponent(country)}&apiKey=${myAPIKey}`,requestOptions).then(result => result.json()).then((result) => {
