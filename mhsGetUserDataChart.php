<?php
header('Content-Type: application/json; charset=utf-8');
$verbindung = include("mhs-db.php");
$table = "user";
$userData = array(); //array for arrays of user data
$cats = ["Garten", "zu Hause", "beim Einkaufen", "im Hof"];
$urgencies = ["1", "2", "3", "4"];
$values=array();
$query = "select category,urgency from $table";//sql query
$result = mysqli_query($verbindung, $query);

// testing query and return type of single row


if ($result) {
    while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
        $user = array(
            "category" => $row["category"],
            "urgency" => $row["urgency"]
        );
        array_push($userData, $user);//push the user array to main array
    }
}

for ($i=0;$i<4;$i++){
    $tempArr = array();
    for ($j=0;$j<4;$j++) {
        $tempArr[$j]=sumByKey($userData, $cats[$i], $urgencies[$j]);
    }
    array_push($values,$tempArr);
}

function sumByKey($arr, $catValue, $urgencyValue){
    $sum = 0;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i]["category"] == $catValue) {
            if ($arr[$i]["urgency"] == $urgencyValue) {
                $sum++;
            }
        }
    }
    return $sum;

}

mysqli_close($verbindung);

$jsonData= json_encode($values);
print($jsonData);



