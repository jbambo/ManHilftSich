function drawMap() {
    let long = "", lat = "", nname = "", vname = "", category = "", urgency = "";
    urgency = document.getElementById("urgency").value;
    category = document.getElementById("category").value;
    vname = document.getElementById("vn").value;
    nname = document.getElementById("nn").value;
    long = document.getElementById("long").value;
    lat = document.getElementById("lat").value;

    const map = L.map("mapid").setView([lat, long], 14);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const redIcon = L.icon({iconUrl: "img/icon_red.png"});
    const greenIcon = L.icon({iconUrl: "img/icon_green.png"});
    const yellowIcon = L.icon({iconUrl: "img/icon_yellow.png"});

    const marker = L.marker([lat, long]);

    if (urgency == 1) {
        marker
            .setIcon(greenIcon)
            .bindPopup("<br>" + vname + " " + nname + " benötigt<br>nicht dringend<br>Hilfe: " + category)
            .addTo(map);
    } else if (urgency == 2) {
        marker
            .setIcon(yellowIcon)
            .bindPopup("<br>" + vname + " " + nname + " benötigt<br>dringend<br>Hilfe: " + category)
            .addTo(map);
    } else if (urgency == 3) {
        marker
            .setIcon(redIcon)
            .bindPopup("<br>" + vname + " " + nname + " benötigt<br>jetzt gerade<br>Hilfe: " + category)
            .addTo(map);
    }
}

function saveDB() {

}

function goStart() {
    window.open("index.php", "_self");
}

function goSaved() {
    window.open("mhs-4.php", "_self");
}

function goContact() {
    window.open("mhs-kontakt.html", "_self");
}

function goMap() {
    window.open("mhs_karte.html", "_self");
}










