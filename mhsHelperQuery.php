<?php
$nn = "";
$vn = "";
$long = "";
$lat = "";
$category1 = "";
$category2 = "";

if (!isset($_POST["helperName"]) or //check if input is set
    !isset($_POST["helperSurname"]) or
    !isset($_POST["category1"]) or
    !isset($_POST["category2"]) or
    !isset($_POST["helperLong"]) or
    !isset($_POST["helperLat"])) {

    echo "fehler";
} else {
    //pass the form to variables
    $nn = htmlspecialchars($_POST["helperSurname"]);
    $vn = htmlspecialchars($_POST["helperName"]);
    $long = htmlspecialchars($_POST["helperLong"]);
    $lat = htmlspecialchars($_POST["helperLat"]);
    $category1 = htmlspecialchars($_POST["category1"]);
    $category2 = htmlspecialchars($_POST["category2"]);


    //db variables
    $verbindung = include("mhs-db.php");


    $query = "INSERT INTO helper(vname,nname,latitude,longitude,cat1,cat2) VALUES ('$vn','$nn','$lat','$long','$category1','$category2')";
    mysqli_query($verbindung, $query);


}
