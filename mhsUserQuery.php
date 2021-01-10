<?php
$nn = "";
$vn = "";
$long = "";
$lat = "";
$category = "";
$urgency = "";

if (!isset($_POST["userName"]) or //check if input is set
    !isset($_POST["userSurname"]) or
    !isset($_POST["category"]) or
    !isset($_POST["userLat"]) or
    !isset($_POST["userLong"]) or
    !isset($_POST["urgency"])) {
    echo "Fehler";

} else {
    //pass the form to variables
    $vn = htmlspecialchars($_POST["userName"]);
    $nn = htmlspecialchars($_POST["userSurname"]);
    $long = htmlspecialchars($_POST["userLong"]);
    $lat = htmlspecialchars($_POST["userLat"]);
    $category = htmlspecialchars($_POST["category"]);
    $urgency = htmlspecialchars($_POST["urgency"]);

    //db variables
    $verbindung = include("mhs-db.php");

    $query = "INSERT INTO user(vname,nname,latitude,longitude,category,urgency) VALUES ('$vn','$nn','$lat','$long','$category','$urgency')";
    mysqli_query($verbindung, $query);

}

