const dfMessenger = document.querySelector("df-messenger");

dfMessenger.addEventListener("df-response-received", (event) => {
    if (event.detail.response.queryResult.fulfillmentText.includes("🕺"))
        window.location.href = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
});
