<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>

<?php
//header('Content-Type: application/json; charset=utf-8');
$verbindung = include("mhs-db.php");
$table = "test";
//$userData = array(); //array for arrays of user data

$query = "select id from test where nname='martino'"; //sql query
$result = mysqli_query($verbindung, $query); //query result from DB
//array_push($userData,$result);
$data= mysqli_fetch_assoc($result)["id"];
echo $data;
//echo implode(" id: ",$data);


/*
if (!$result) {
    while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
        /*$user = array(
            "id" => $row["id"],
            "vname" => $row["vname"],
            "nname" => $row["nname"],
            "lat" => $row["lat"],
            "long" => $row["lng"],
            "category" => $row["category"],
            "urgency" => $row["urgency"]
        );// single user array
        $user = array(
               "id" =>$row["id"]
        );
        array_push($userData, $user);//push the user array to main array
    }
}*/
//mysqli_close($verbindung);
//$json = json_encode($userData);
//$json = json_encode($result);

//print($json);
?>

<script src="js/script.js"></script>
</body>
</html>