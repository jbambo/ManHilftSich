<?php
$verbindung= include("mhs-db.php");
$table = "punkte";

for ($i=0; $i <= 5;$i++){
    $x= rand(0,256);
    $y= rand(0,256);
    $sql= "Insert into punkte(x,y)
        values($x,$y)";
    mysqli_query($verbindung,$sql);
    echo $i." time. x: ".$x." y: ".$y."<br>";
}

$query= "select * from punkte ";
$result =mysqli_query($verbindung,$query);
if ($result){
    echo "nr  x   y";
    while($row=mysqli_fetch_assoc($result)){
        $nr=$row["nr"];
        $x=$row["x"];
        $y=$row["y"];
        echo "<br>$nr  $x   $y";
    }
}

/*if(mysqli_query($verbindung,$sql)){
    echo "query executed";
}else{
    echo "error: ".mysqli_error($verbindung);
}*/
mysqli_close($verbindung);

