<?php

$nn = $_SESSION["nn"];
$vn = $_SESSION["vn"];
$long = $_SESSION["long"];
$lat = $_SESSION["lat"];
$category = $_SESSION["category"];
$urgency = $_SESSION["urgency"];

$verbindung = include("mhs-db.php");
$table = "test";


$sql = "INSERT INTO $table(vname,nname,lat,long,category,urgency) VALUES 
($vn,$nn,$lat,$long,$category,$urgency)";

mysqli_query($verbindung, $sql);

echo "daten Gespeichert";



