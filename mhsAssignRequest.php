<?php
header('Content-Type: application/json; charset=utf-8');

$helperId = "";
$userId = "";
$status = "to do";

if (!isset($_POST["helperId"]) or
    !isset($_POST["userId"])) {
    echo "fehler";
} else {
    $verbindung = include("mhs-db.php");

    $helperId = htmlspecialchars($_POST["helperId"]);
    $userId = htmlspecialchars($_POST["userId"]);

    $query = "INSERT INTO assignments(helper_id,user_id,status) VALUES ('$helperId','$userId','$status')";
    mysqli_query($verbindung, $query);


}