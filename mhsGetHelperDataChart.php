<?php

header('Content-Type: application/json; charset=utf-8');
$verbindung = include("mhs-db.php");
$table = "helper";

$data = array(); //array for arrays
$cats = ["Garten", "zu Hause", "beim Einkaufen", "im Hof"];
$values = array(); //final array

$query = "select cat1,cat2 from $table";//sql query

$result = mysqli_query($verbindung, $query);



if ($result) {
    while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
        $helper = array(
            "cat1" => $row["cat1"],
            "cat2" => $row["cat2"]
        );
        array_push($data,$helper);//push the  array to main array
    }
}

for ($i = 0; $i < 4; $i++) {
    $tempArr = array();
    for ($j = 0; $j < 4; $j++) {
        $tempArr[$j] = sumByKey($data, $cats[$i], $cats[$j]);
    }
    array_push($values, $tempArr);
}

function sumByKey($arr, $cat1Value, $cat2Value)
{
    $sum = 0;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i]["cat1"] == $cat1Value) {
            if ($arr[$i]["cat2"] == $cat2Value) {
                $sum++;
            }
        }
    }
    return $sum;

}

mysqli_close($verbindung);

$jsonData = json_encode($values);
print($jsonData);



