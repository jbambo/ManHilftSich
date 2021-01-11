//test functions

function testUser(testUserData) {
    testUserData.forEach(function (element) {
        let coords="";
        // coords+=element.longitude+"%2C"+element.latitude+"|";
        coords += "[" + element.longitude + "," + element.latitude+"]";
        //coords+=","
        //console.log(coords);
        runIsoService(coords);
    });
    //coords= coords.substring(0,coords.length-1);
    /*    $.ajax({
            url: "https://api.openrouteservice.org/isochrones?locations=8.34234%2C48.23424|8.34234%2C48.23424&
            profile=driving-car&range_type=distance&range=10000&location_type=start&intersections=false&api_key=
            5b3ce3597851110001cf62489c8e89fa393b423ca90a3ace2a38c9f2",
            data: {},
            type: "GET",
            dataType: "json",
            timeout: 1000,
            success: function () //pass the json data from query to this function
        });*/
}

function testAjax() {
    $.ajax({
        url: "mhsGetHelperDataIso.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: testUser //pass the json data from query to this function
    });
    /* $.ajax({
         url: "mhsGetUserData.php",
         data: {},
         type: "GET",
         dataType: "json",
         timeout: 1000,
         success: testUser //pass the json data from query to this function
     });*/

}

//select role  and show the according view for the user

function selectRole() {
    let role = document.getElementById("role").value;

    switch (role) {
        case "helper":
            document.getElementById("registerHelper").className = "open";
            document.getElementById("registerUser").className = "close";
            document.getElementById("bossView").className = "close";
            document.getElementById("display").classList.remove("open");
            document.getElementById("peasants").classList.remove("open");
            document.getElementById("addressField").className = "close";
            break;

        case"user":
            document.getElementById("registerUser").className = "open";
            document.getElementById("registerHelper").className = "close";
            document.getElementById("bossView").className = "close";
            document.getElementById("display").classList.remove("open");
            document.getElementById("peasants").classList.remove("open");
            document.getElementById("addressField").className = "close";
            break;

        case "boss":
            document.getElementById("registerUser").className = "close";
            document.getElementById("registerHelper").className = "close";
            document.getElementById("addressField").className = "close";
            document.getElementById("bossView").className = "open";
            document.getElementById("peasants").className = "open";
            document.getElementById("display").className = "open";
            break;
    }
}

//helper

function loginHelper() {


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
function ajaxShowUserBoss() {
    $.ajax({
        url: "mhsGetUserData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: displayUser //pass the json data from query to this function
    });
}

function displayUser(jsonData) {
    let table = "<thead><tr><th>Hilfesuchende</th></tr><tr>" +
        "<th>ID</th>" +
        "<th>Vorname</th>" +
        "<th>Nachname</th>" +
        "<th>Long</th>" +
        "<th>Lat</th>" +
        "<th>Category</th>" +
        "<th>Urgency</th>" +
        "</tr></thead><tbody>";
    jsonData.forEach(function (element) {
        table += "<tr><td>" + element.id + "</td>";
        table += "<td>" + element.vname + "</td>";
        table += "<td>" + element.nname + "</td>";
        table += "<td>" + element.longitude + "</td>";
        table += "<td>" + element.latitude + "</td>";
        table += "<td>" + element.category + "</td>";
        table += "<td>" + element.urgency + "</td></tr>";
    })
    table += "</body>" // close the table
    document.getElementById("userData").innerHTML = table; //fill the table
    //let string= JSON.stringify(jsonData, undefined, 2);
    //document.getElementById("userData").innerHTML =("User: "+string);
}

function ajaxShowHelperBoss() {
    $.ajax({
        url: "mhsGetHelperData.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: displayHelper //pass the json data from query to this function
    });
}

function displayHelper(jsonData) {
    let table = "<thead><tr><th>Helfer</th></tr><tr>" +   //create a table header
        "<th>ID</th>" +
        "<th>Vorname</th>" +
        "<th>Nachname</th>" +
        "<th>Long</th>" +
        "<th>Lat</th>" +
        "<th>Category 1</th>" +
        "<th>Category 2</th>" +
        "</tr></thead><tbody>";
    jsonData.forEach(function (d) {   //loop over json object data and create table rows
        table += "<tr><td>" + d.id + "</td>";
        table += "<td>" + d.vname + "</td>";
        table += "<td>" + d.nname + "</td>";
        table += "<td>" + d.longitude + "</td>";
        table += "<td>" + d.latitude + "</td>";
        table += "<td>" + d.category1 + "</td>";
        table += "<td>" + d.category2 + "</td></tr>";
    })
    table += "</tbody>"; //close the table body
    document.getElementById("helperData").innerHTML = table;//put the table string into  element
    // let string= JSON.stringify(jsonData, undefined, 2);
    // document.getElementById("helperData").textContent =("Helper: "+string);
}

function ajaxAssignJobs() {
    let data = $("form").serializeArray();
    $.ajax(
        {
            url: "mhsAssignRequest.php",
            data: data,
            type: "POST",
            timeout: 1000,
        });
}

function ajaxRunIsoService(){
    $.ajax({
        url: "mhsGetHelperDataIso.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: function(jsonData){
            isoLayer.addTo(map);

            jsonData.forEach(function (element) {
                let coords="";
                // coords+=element.longitude+"%2C"+element.latitude+"|";
                coords += "[" + element.longitude + "," + element.latitude+"]";

                let request = new XMLHttpRequest();
                request.open('POST', "https://api.openrouteservice.org/v2/isochrones/driving-car");
                request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');
                request.setRequestHeader('Content-Type', 'application/json');
                request.setRequestHeader('Authorization', '5b3ce3597851110001cf62489c8e89fa393b423ca90a3ace2a38c9f2');

                request.onreadystatechange = function () {
                    if (this.readyState === 4) {
                        //console.log('Status:', this.status);
                        //console.log('Headers:', this.getAllResponseHeaders());
                        //isoLayer.addData(this.responseText) ;
                        console.log(this.response);
                        let geoJson= JSON.parse(this.response)
                        isoLayer.addData(geoJson);
                    }
                };

                const body = '{"locations":['+coords+'],"range":[10000],"intersections":"true","range_type":"distance","units":"m"}';

                request.send(body);
            });

        } //pass the json data from query to this function
    });
}

function runIsoService(coords){
    let request = new XMLHttpRequest();
    request.open('POST', "https://api.openrouteservice.org/v2/isochrones/driving-car");
    request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');
    request.setRequestHeader('Content-Type', 'application/json');
    request.setRequestHeader('Authorization', '5b3ce3597851110001cf62489c8e89fa393b423ca90a3ace2a38c9f2');

    request.onreadystatechange = function () {
        if (this.readyState === 4) {
            //console.log('Status:', this.status);
            //console.log('Headers:', this.getAllResponseHeaders());
             isoLayer.addData(this.responseText) ;
        }
    };

    const body = '{"locations":['+coords+'],"range":[10000],"intersections":"true","range_type":"distance","units":"m"}';

    request.send(body);

}
// initialize map variable and marker layer, initialize marker layers, initialize icons,
var map;
var markerLayerUser = null;
var isoLayer = L.geoJSON();
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
        /*let circle = new L.circle([element.latitude, element.longitude], {
            radius: 1000,
            stroke: false,
            fillColor: "#9405fa"
        })
            .addTo(markerLayerHelper);*/

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

//charts
//user chart
function showChart() {
    //initialize charts
    var options = {
        chart: {
            animation: false,
            type: "column"
        },
        title: {
            style: {
                fontSize: '35px',
                fontWeight: 'bold'
            },
            text: 'Hilfesuchenden'
        },
        tooltip: {
            style: {
                fontSize: '25px'
            },
            formatter: function () {
                return this.x + ': ' + this.y + '<br>' + this.series.name;
            },
            shared: false
        },
        xAxis: {
            labels: {
                style: {
                    fontSize: '25px',
                    whiteSpace: 'nowrap'
                }
            },
            categories:
                ['im Garten', 'zu Hause', 'beim Einkaufen', 'im Hof'],
            title: {
                style: {
                    fontWeight: 'bold'
                },
                text: 'Dringlichkeit:'
            }
        },
        yAxis: {
            labels: {
                style: {
                    fontSize: '25px'
                }
            },
            title: {
                text: 'Anzahl Benutzer'
            }
        },
        colors: ['#04d4bc', '#0ee331', '#ddb809', '#ff0000'],
        series: [{
            name: "nicht dringend",
            data: []
        },
            {
                name: "dringend",
                data: []
            },
            {
                name: "sehr dringend",
                data: []
            },
            {
                name: "notfall",
                data: []
            }
        ]
    };
    $.ajax({
        url: "mhsGetUserDataChart.php",
        data: {},
        type: "GET",
        dataType: "json",
        timeout: 1000,
        success: function (jsonData) {//pass the json data from query to this function
            console.log(jsonData);
            let cats = ["Garten", "zu Hause", "beim Einkaufen", "im Hof"];
            let urgencies = ["1", "2", "3", "4"];
            let arr = {0: [], 1: [], 2: [], 3: []};
            console.log(arr + " fresh aray")
            for (let i = 0; i < 4; i++) {
                for (let j = 0; j < 4; j++) {
                    console.log("checking: " + cats[i] + " and " + urgencies[j])
                    let currentSum = sumByKey(jsonData, cats[i], urgencies[j]);
                    console.log(currentSum + "current sum");
                    arr[1][j] = currentSum;
                }
            }
            console.log(arr + "array ")
            options.series[0].data = arr["0"];
            options.series[1].data = arr["1"];
            options.series[2].data = arr["2"];
            options.series[3].data = arr["3"];

            const chart1 = Highcharts.chart('chart1', options);

        }
    });
}

/*var options2 = {
    chart: {
        animation: false,
        type: "column"
    },
    title: {
        style: {
            fontSize: '35px',
            fontWeight: 'bold'
        },
        text: 'Helfer'
    },
    tooltip: {
        style: {
            fontSize: '25px'
        },
        formatter: function () {
            return this.x + ': ' + this.y + '<br>' + this.series.name;
        },
        shared: false
    },

    xAxis: {
        labels: {
            style: {
                fontSize: '25px',
                whiteSpace: 'nowrap'
            }
        },

        categories:
            ['im Garten', 'zu Hause', 'beim Einkaufen', 'im Hof'],

        title: {
            style: {
                fontWeight: 'bold'
            },
            text: 'Dringlichkeit:'
        }
    },
    yAxis: {
        labels: {
            style: {
                fontSize: '25px'
            }
        },
        title: {
            text: 'Anzahl Benutzer'
        }
    },
    colors: ['#04d4bc', '#0ee331', '#ddb809', '#ff0000'],
    series: [{
        name: 'nicht dringend',
        data: [1, 1, 4, 6]
    }, {
        name: 'dringend',
        data: [5, 7, 3, 8]
    }, {
        name: 'sehr dringend',
        data: [5, 7, 3, 8]
    }, {
        name: 'Notfall',
        data: [5, 7, 3, 12]
    },
    ]

};*/

//const chart2 = Highcharts.chart('chart2', options2);

//return an array of objects according to key, value, or key and value matching
function getObjects(obj, key, val) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(getObjects(obj[i], key, val));
        } else
            //if key matches and value matches or if key matches and value is not passed (eliminating the case where key matches but passed value does not)
        if (i == key && obj[i] == val || i == key && val == '') { //
            objects.push(obj);
        } else if (obj[i] == val && key == '') {
            //only add if the object is not already in the array
            if (objects.lastIndexOf(obj) == -1) {
                objects.push(obj);
            }
        }
    }
    return objects;
}

//return an array of values that match on a certain key
function getValues(obj, key) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(getValues(obj[i], key));
        } else if (i == key) {
            objects.push(obj[i]);
        }
    }
    return objects;
}

//return an array of keys that match on a certain value
function getKeys(obj, val) {
    var objects = [];
    for (var i in obj) {
        if (!obj.hasOwnProperty(i)) continue;
        if (typeof obj[i] == 'object') {
            objects = objects.concat(getKeys(obj[i], val));
        } else if (obj[i] == val) {
            objects.push(i);
        }
    }
    return objects;
}

//awesome function to count categries and urgency

var sumByKey = function (array, catValue, urgencyValue) {
    let sum = 0;
    for (let i = 0, len = array.length; i < len; i++) {
        if (array[i]["category"] == catValue) {
            if (array[i]["urgency"] == urgencyValue) {
                sum++;
            }
        }
    }
    return sum;
}


