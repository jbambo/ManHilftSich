<?php
$helperId = "";
$jobId = "";
$route = array();

if (!isset($_POST["myId"]) or
    !isset($_POST["jobId"])) {
    echo "fehler!";
} else {

    $helperId = htmlspecialchars($_POST["myId"]);
    $jobId = htmlspecialchars($_POST["jobId"]);

    $verbindung = include("mhs-db.php");

    $query = "SELECT helper.longitude AS startLong,helper.latitude AS startLat, user.longitude as endLong, user.latitude as endLat 
            FROM helper inner join assignments on assignments.helper_id=helper.id 
                inner join user on assignments.user_id=user.id WHERE helper.id='$helperId' and assignments.id='$jobId'";

    $result = mysqli_query($verbindung, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
            $coords = array(
                "startLong" => floatval($row["startLong"]),
                "startLat" => floatval($row["startLat"]),
                "endLong" => floatval($row["endLong"]),
                "endLat" => floatval($row["endLat"]),

            );
            array_push($route, $coords);//push the user array to main array
        }
    }
    mysqli_close($verbindung);

    $jsonData = json_encode($route);
    print($jsonData);

}

