function saveUser(token) {
    let urgency = document.getElementById("urgency").value;
    let category = document.getElementById("category").value;
    let vname = document.getElementById("vn").value;
    let nname = document.getElementById("nn").value;
    let long = document.getElementById("long").value;
    let lat = document.getElementById("lat").value;
    //let data = document.getElementById("registerUser");
    console.log(vname,nname,long,lat,category,urgency);
    let data =$("form").serializeArray();
   console.log(data);

}

function selectRole() {
    let role = document.getElementById("role").value;

    switch (role) {
        case "helper":
            document.getElementById("registerHelper").className = "open";
            document.getElementById("registerUser").className = "close";
            document.getElementById("bossView").className = "close";

            break;
        case"user":
            document.getElementById("registerUser").className = "open";
            document.getElementById("registerHelper").className = "close";
            document.getElementById("bossView").className = "close";

            break;
        case "boss":
            document.getElementById("registerUser").className = "close";
            document.getElementById("registerHelper").className = "close";
            document.getElementById("bossView").className = "open";

            break;
    }
}

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
    const tealIcon = L.icon({iconUrl: "img/icon_teal.png"});
    const helperIcon = L.icon({iconUrl: "img/icon_helper.png"});



    const marker = L.marker([lat, long]);

    if (urgency == 1) {
        marker
            .setIcon(tealIcon)
            .bindPopup(  vname + " " + nname + " benötigt<br>nicht dringend Hilfe: " + category)
            .addTo(map);
    } else if (urgency == 2) {
        marker
            .setIcon(greenIcon)
            .bindPopup(  vname + " " + nname + " benötigt <br>dringend Hilfe: " + category)
            .addTo(map);
    } else if (urgency == 3) {
        marker
            .setIcon(yellowIcon)
            .bindPopup( vname + " " + nname + " benötigt<br>sehr dringend Hilfe: " + category)
            .addTo(map);
    }else if(urgency == 4){
        marker
            .setIcon(redIcon)
            .bindPopup( vname + " " + nname + " hat ein<br>notfall, : " + category)
            .addTo(map);
    }
}

function ajaxSend(token) {
    document.getElementById("action").value=token;
    let data =$("form").serializeArray();
    $.ajax(
        {
            url: "mhs_runQuery.php",
            data: data,
            type: "POST",
            timeout:1000,
        });
}





