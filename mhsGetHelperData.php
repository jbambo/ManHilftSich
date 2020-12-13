<?php

header('Content-Type: application/json; charset=utf-8');
$verbindung = include("mhs-db.php");
$table = "helper";
$helperData = array();
//array for arrays of helper data

$query = "select * from $table";         //sql query
$result = mysqli_query($verbindung, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
        $helper = array(
            "id" => $row["id"],
            "vname" => $row["vname"],
            "nname" => $row["nname"],
            "latitude" => floatval($row["latitude"]),
            "longitude" => floatval($row["longitude"]),
            "category1" => $row["cat1"],
            "category2" => $row["cat2"]
        );
        array_push($helperData, $helper);//push the helper array to main array
    }
}
mysqli_close($verbindung);

$jsonData = json_encode($helperData);
print($jsonData);



