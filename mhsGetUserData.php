
<?php
header('Content-Type: application/json; charset=utf-8');
$verbindung = include("mhs-db.php");
$table = "user";
$userData = array(); //array for arrays of user data

$query = "select * from $table";         //sql query
$result = mysqli_query($verbindung, $query);

// testing query and return type of single row

//query result from DB
//array_push($userData,$result);
//$data= mysqli_fetch_assoc($result)["id"];
//echo implode(" id: ",$data);


if ($result) {
    while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
        $user = array(
            "id" => $row["id"],
            "vname" => $row["vname"],
            "nname" => $row["nname"],
            "latitude" => floatval($row["latitude"]),
            "longitude" => floatval($row["longitude"]),
            "category" => $row["category"],
            "urgency" => $row["urgency"]
        );
        array_push($userData, $user);//push the user array to main array
    }
}
mysqli_close($verbindung);

$jsonData = json_encode($userData);
print($jsonData);



