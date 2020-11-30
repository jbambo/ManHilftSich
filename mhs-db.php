<?php
$server="localhost";
$user="root";
$pass="";
$db="mhsdb";

$verbindung= new mysqli($server, $user, $pass, $db) or
die("Verbindung fehlgeschlagen"); //do sth or if fails stop and do sth
return $verbindung;

//echo "<br>Verbindung hergestelllt";

//mysqli_close($verbindung);

//echo "<br>Verbindung geschlossen";

?>