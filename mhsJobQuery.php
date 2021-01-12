<?php
$verbindung = include("mhs-db.php");
$jobId = "";
$status = "";

if (!isset($_POST["jobId"]) or //check if input is set
    !isset($_POST["status"])) {

    echo "fehler";
} else {
    //pass the form to variables
    $jobId = htmlspecialchars($_POST["jobId"]);
    $status = htmlspecialchars($_POST["status"]);

    //db variables
    $verbindung = include("mhs-db.php");

    $query = "UPDATE assignments SET status= '$status' where id ='$jobId'";

    $result = mysqli_query($verbindung, $query);
}