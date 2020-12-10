<?php
/*$server="localhost";
$user="root";
$pass="";
$db="mhsdb";*/

$role = "";
$login= "";
$nn = "";
$vn = "";
$long = "";
$lat = "";
$category = "";
$urgency = "";
$action = "";


if (!isset($_POST["login"]) or
    !isset($_POST["nn"]) or //check if input is set
    !isset($_POST["vn"]) or
    !isset($_POST["long"]) or
    !isset($_POST["lat"]) or
    !isset($_POST["urgency"]) or
    !isset($_POST["category"]) or
    !isset($_POST["role"]) or
    !isset($_POST["action"])) {
    include "mhs-1.php";
} else {
    $login =$_POST["login"];
    $action = $_POST["action"]; //pass the form to variables
    $role = $_POST["role"];
    $nn = $_POST["nn"];
    $vn = $_POST["vn"];
    $long = $_POST["long"];
    $lat = $_POST["lat"];
    $category = $_POST["category"];
    $urgency = $_POST["urgency"];

    //db variables
    $table="test";
    $verbindung = include("mhs-db.php");



    //check the action and change the query accordingly 1=insert, 2=update, 3=delete

    if ($action==1){
        if ($role=="user"){
            $query1 = "INSERT INTO user(vname,nname,login) VALUES ('$vn','$nn','$login')";
            mysqli_query($verbindung, $query1);
            $result = mysqli_query($verbindung, "SELECT id from user where (vname='$vn' and nname='$nn' and login='$login'");
            $query2=  "INSERT INTO offers(category,lat,lng,urgency,poster_id)VALUES ('$category','$lat','$long','$urgency','$result')";
        }

    }elseif($action==2){
        //$query1= "SELECT DISTINCT id FROM $table WHERE vname=";
        //$result = mysqli_query($verbindung, $query1);
    }else{
        include "mhs-1.php";
    }

    //mysqli_query($verbindung, $query);
}//else




//$verbindung = new mysqli($server, $user, $pass, $db) or
//die("Verbindung fehlgeschlagen"); //do sth or if fails stop and do sth


//$columns = "'vname','nname','lat','lng','category','urgency'";

//vname,nname,lat,lng,category,urgency



/*$vn="bambo";
$nn="jihn";
$lat=332;
$long=45;
$category="garten";
$urgency=3;*/


/*$nn = $_SESSION["nn"];
$vn = $_SESSION["vn"];
$long = $_SESSION["long"];
$lat = $_SESSION["lat"];
$category = $_SESSION["category"];
$urgency = $_SESSION["urgency"];*/