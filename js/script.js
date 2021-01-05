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
            // showHelperBoss();
            // showUserBoss();
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

//function block for boss view
//run the queries with ajax
function showUserBoss() {
    $.ajax({
        url: "mhsGetUserData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: displayUser //pass the json data from query to this function
    });
}

function displayUser(jsonData){
    let table = "<thead><tr>" +
        "<th>ID</th>" +
        "<th>Vorname</th>" +
        "<th>Nachname</th>" +
        "<th>Long</th>" +
        "<th>Lat</th>" +
        "<th>Category</th>" +
        "<th>Urgency</th>" +
        "</tr></thead><tbody>";
    jsonData.forEach(function (d){
        table=
    })
    //let string= JSON.stringify(jsonData, undefined, 2);
    //document.getElementById("userData").innerH =("User: "+string);
}

function showHelperBoss(){
    $.ajax({
        url: "mhsGetHelperData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: displayHelper //pass the json data from query to this function
    });
}

function displayHelper(jsonData){
    let table="<thead><tr>" +   //create a table header
        "<th>ID</th>" +
        "<th>Vorname</th>" +
        "<th>Nachname</th>" +
        "<th>Long</th>" +
        "<th>Lat</th>"+
        "<th>Category 1</th>"+
        "<th>Category 2</th>"+
         "</tr></thead><tbody>";
    jsonData.forEach(function (d){   //loop over json object data and create table rows
       table+="<tr><td>"+d.id+"</td>";
        table+="<td>"+d.vname+"</td>";
        table+="<td>"+d.nname+"</td>";
        table+="<td>"+d.latitude+"</td>";
        table+="<td>"+d.longitude+"</td>";
        table+="<td>"+d.category1+"</td>";
        table+="<td>"+d.category2+"</td></tr>";
    })
    table+= "</tbody>" ; //close the table body
    document.getElementById("helperData").innerHTML=table;//put the table string into  element
    console.log(table);
   // let string= JSON.stringify(jsonData, undefined, 2);
   // document.getElementById("helperData").textContent =("Helper: "+string);
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

function truncateCoords(num) {
    num = num.toString(); //If it's not already a String
    num = num.slice(0, (num.indexOf(".")) + 3); //With 3 exposing the hundredths place
    return Number(num);
}

//get location function, validating which input field to change w. function setLocation  :)
function getLocation(token) {
    let longitude, latitude;
    switch (token) {
        case 1:
            longitude = document.getElementById("helperLong");
            latitude = document.getElementById("helperLat");
            setLocation(longitude, latitude);
            break;
        case 2:
            longitude = document.getElementById("userLong");
            latitude = document.getElementById("userLat");
            setLocation(longitude, latitude);
            break;
    }
}

//function for setting location
function setLocation(setLong, setLat,) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function inputPosition(position) {
            setLong.value = truncateCoords(position.coords.longitude);
            setLat.value = truncateCoords(position.coords.latitude);
        });
    } else document.getElementById("response").innerHTML = "Geolocation not supported";
}

//getting coordinates from an address block
//show address field
function showAddress() {
    document.getElementById("addressField").className = "open";
}

//close address field
function closeAddress() {
    document.getElementById("addressField").className = "close";
}

// Instantiate a map and platform object:
var platform = new H.service.Platform({
    'apikey': 'cIrFMY6URD4dT2R-f89f0gZm0D8MMi5W6CYPnJcKGB8'
});

// Get an instance of the geocoding service:
var service = platform.getSearchService();

// Call the geocode method with the geocoding parameters,
// the callback and an error callback function (called if a
// communication error occurs):
function addressToCoords() {
    service.geocode({
            q: document.getElementById("address").value
        }, function (result) { //get the result and pass the value of long and lat to variables, truncate them and pass to function
            let lng = truncateCoords(result.items[0].position.lng);
            let lat = truncateCoords(result.items[0].position.lat);
            showAddressCords(lat, lng);
            console.log(lng + ", " + lat);
        }, console.error()
    );

}

//show the  cords from address
function showAddressCords(lat, lng) {
    let longitudeH = document.getElementById("helperLong");
    let latitudeH = document.getElementById("helperLat");
    let longitudeU = document.getElementById("userLong");
    let latitudeU = document.getElementById("userLat");

    longitudeH.value = lng;
    latitudeH.value = lat;

    longitudeU.value = lng;
    latitudeU.value = lat;

}

//select role  and show the according view for the user

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