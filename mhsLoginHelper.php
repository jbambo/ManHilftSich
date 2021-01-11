<?php
$verbindung = include("mhs-db.php");
$vn = "";
$nn = "";
$category1 = "";
$category2 = "";
$assignments = array();

if (!isset($_POST["helperName"]) or //check if input is set
    !isset($_POST["helperSurname"]) or
    !isset($_POST["category1"]) or
    !isset($_POST["category2"])) {

    echo "fehler";
} else {
    //pass the form to variables
    $nn = htmlspecialchars($_POST["helperSurname"]);
    $vn = htmlspecialchars($_POST["helperName"]);
    $category1 = htmlspecialchars($_POST["category1"]);
    $category2 = htmlspecialchars($_POST["category2"]);


    //db variables
    $verbindung = include("mhs-db.php");

    $query = "SELECT * FROM assignments WHERE helper_id=(select id from helper WHERE 
        (helper.vname = '$vn' AND helper.nname='$nn' AND helper.cat1='$category1' AND helper.cat2='$category2'))";

    /* INNER JOIN
     helper on assignments.helper_id = helper.id
     WHERE (helper.vname = '$vn' AND helper.nname='$nn' AND helper.cat1='$category1' AND helper.cat2='$category2')";*/

    $result = mysqli_query($verbindung, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) { //loop to iterate over result query and pass it to local variables
            $assignment = array(
                "id" => $row["id"],
                "helper_id" => $row["helper_id"],
                "user_id" => $row["user_id"],
                "status" => $row["status"]

            );
            array_push($assignments, $assignment);//push the user array to main array
        }
    }
    mysqli_close($verbindung);

    $jsonData = json_encode($assignments);
    print($jsonData);
}