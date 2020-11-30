<?php
header('Content-Type: application/json; charset=utf-8');
$verbindung = include("mhs-db.php");
$table = "test";
$userData = array(); //array for arrays of user data

$query = "select * from $table"; //sql query
$result = mysqli_query($verbindung, $query); //query result from DB

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
        $user = array(
            "id" => $row["id"],
            "vname" => $row["vname"],
            "nname" => $row["nname"],
            "lat" => $row["lat"],
            "long" => $row["lng"],
            "category" => $row["category"],
            "urgency" => $row["urgency"]
        );// single user array
        array_push($userData, $user);//push the user array to main array
    }
}
mysqli_close($verbindung);
$json = json_encode($userData);
print($json);