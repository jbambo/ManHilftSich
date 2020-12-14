<?php
$server="localhost";
$user="root";
$pass="";
$db="mhsdb";

$verbindung= new mysqli($server, $user, $pass, $db) or
die("Verbindung fehlgeschlagen"); //do sth or if fails stop and do sth
return $verbindung;

$table = "requests";


$query = "INSERT INTO requests(request_id,helper_id,status) VALUES(1,2,'to do')";

mysqli_query($query,$verbindung);

/*if(mysqli_query($verbindung,$sql)){
    echo "query executed";
}else{
    echo "error: ".mysqli_error($verbindung);
}*/
mysqli_close($verbindung);

