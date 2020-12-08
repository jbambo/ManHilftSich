
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

function saveDB(vn,nn,lat,lng,category,urgency) {
    /*let vn = document.getElementById("vn").value;
    let nn = document.getElementById("nn").value;
    let lat = document.getElementById("lat").value;
    let lng = document.getElementById("long").value;
    let category = document.getElementById("category").value;
    let urgency = document.getElementById("urgency").value;*/


    let xhttp = new XMLHttpRequest();
    xhttp.open("","mhs-SendData.php",true )
    xhttp.send(vn,nn,lat,lng,category,urgency);
}

onload=(function (){ //loop to use ajaxloaddata function every 3 seconds
   initMap();
   ajaxLoadData();
   setInterval(function (){
       ajaxLoadData();}, 3000);
});

function ajaxLoadData(){ //jquery code for getting  data with ajax
    $.ajax({
        url: ("mhs-getData.php"),
        data: {},
        type: "GET",
        timeout: 1000,
        dataType: "json",
        error: ajaxLoadMhsError,
        success: ajaxLoadMhsDataSuccess
    })

};

function ajaxLoadMhsDataSuccess(myData){
        console.log(myData);
        var output ="<p>";
        myData.forEach(element =>{
            output+=""+element.vn+ ""+element.nn
        })
};

function ajaxLoadMhsError(myData){

};







