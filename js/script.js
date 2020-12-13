//test functions
function testUser(testUserData) {
    console.log(testUserData)

}

function testHelper(testHelperData) {
    console.log(testHelperData)

}

function testAjax() {
    $.ajax({
        url: "mhsGetHelperData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: testHelper //pass the json data from query to this function
    });
    $.ajax({
        url: "mhsGetUserData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: testUser //pass the json data from query to this function
    });
}

//function to load when the site has completely loaded, used with <body> tag
function onloadFunction() {
    initMap();
    ajaxLoadUser();
    ajaxLoadHelper();
    setInterval(function () {
            ajaxLoadUser();         //run user and helper functions for markers
            ajaxLoadHelper();
        },
        3000
    );

}

//run the query (select from user table) with ajax
function ajaxLoadUser() {
    $.ajax({
        url: "mhsGetUserData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: ajaxLoadUserSuccess //pass the json data from query to this function
    });

}

//run the select query on helper table with ajax
function ajaxLoadHelper() {
    $.ajax({
        url: "mhsGetHelperData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: ajaxLoadHelperSuccess //pass the json data from query to this function
    });
}

//function to execute on ajax load helper success
function ajaxLoadHelperSuccess(jsonData) {
    addHelperMarker(jsonData);
}

//function to execute on ajax load user success
function ajaxLoadUserSuccess(jsonData) {
    addUserMarker(jsonData);
}

// initialize map variable and marker layer, initialize marker layers, initialize icons,
var map;
var markerLayerUser = null;
var markerLayerHelper = null;
var greenIcon;
var tealIcon;
var yellowIcon;
var redIcon;

//initialize map with center in mainz,
function initMap() {
    map = L.map("mapid").setView([49.9928617, 8.2472526], 12);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
}

//initialize corresponding markers

greenIcon = L.icon({iconUrl: "img/icon_green.png"});
tealIcon = L.icon({iconUrl: "img/icon_teal.png"});
yellowIcon = L.icon({iconUrl: "img/icon_yellow.png"});
redIcon = L.icon({iconUrl: "img/icon_red.png"});

//add user marker to layer and to map
function addUserMarker(jsonData) {
    if (markerLayerUser == null) {
        markerLayerUser = L.layerGroup();
    } else {
        markerLayerUser.clearLayers();
    }
    //for each element in json data run the anon function
    jsonData.forEach(function (element) {
        let icon;
        if (element.urgency == 1) {
            icon = tealIcon;
        } else if (element.urgency == 2) {
            icon = greenIcon;
        } else if (element.urgency == 3) {
            icon = yellowIcon;
        } else if (element.urgency == 4)
            icon = redIcon;


        let marker = new L.marker([element.latitude, element.longitude], {
            clickable: true,
            icon: icon
        })     //set the popup for each user marker
            .bindPopup("<p>" + element.vname + " " + element.nname + "<br>Benötigt Hilfe: " + element.category + "</p>")
            .addTo(markerLayerUser);   //add the marker to the layer in a loop so that the layer is filled with markers for all users
    });
    map.addLayer(markerLayerUser); //add the created user layer to the map
}

//add helper marker to layer and to map
function addHelperMarker(jsonData) {
    if (markerLayerHelper == null) {
        markerLayerHelper = L.layerGroup();
    } else {
        markerLayerHelper.clearLayers();
    }
    let helperIcon = L.icon({
        iconUrl: "img/icon_helper.png"
    });

    jsonData.forEach(function (element) {
        let marker = new L.marker([element.latitude, element.longitude], {
            clickable: true,
            icon: helperIcon
        })
            .bindPopup("<p>" + element.vname + " " + element.nname + "<br>Bietet Hilfe an: " + element.category1 + " und " + element.category2 + "</p>")
            .addTo(markerLayerHelper);
        let circle = new L.circle([element.latitude, element.longitude], {
            radius: 1000,
            stroke: false,
            fillColor: "#9405fa"
        })
            .addTo(markerLayerHelper);
    });//foreach loop
    map.addLayer(markerLayerHelper);
}

//get location
let longitude, latitude;
function getLocation() {
    let position;
    switch (role) {
        case "helper":
            longitude= document.getElementById("helperLong");
            latitude=document.getElementById("helperLat");
            break;
        case"user":
            longitude=document.getElementById("userLong");
            latitude=document.getElementById("userLat");
            break;
    }

    if (navigator.geolocation){
       navigator.geolocation.getCurrentPosition(function inputPosition(){
           
        });
    }else document.getElementById("response").innerHTML="Geolocation not supported";
}

//select role function and show the according view for the user
let role = document.getElementById("role").value;

function selectRole() {
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

//ajax run the user insert query
function ajaxSendUser() {
    let data = $("form").serializeArray();
    $.ajax(
        {
            url: "mhsUserQuery.php",
            data: data,
            type: "POST",
            timeout: 1000,
        });
}

//ajax run the helper insert query
function ajaxSendHelper() {
    let data = $("form").serializeArray();
    $.ajax(
        {
            url: "mhsHelperQuery.php",
            data: data,
            type: "POST",
            timeout: 1000,
        });
}





