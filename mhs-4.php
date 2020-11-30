<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Data</title>
    <link href="styles/style_mhs.css" rel="stylesheet">

</head>
<body>
<div class="container" style="font-size: 45px">
    <p class="tightwrap">
        Man Hilft Sich Portal
    </p>
</div>
<?php include "mhs-menu.html"; ?>

<p class='flex-center font45'>Alle Hilfesuchenden:</p>
<div class="flex-wrap-col">
    <?php
    $data = "alleHilfesuchenden.txt";
    $handle = fopen($data, "r");
    if ($handle != FALSE) {
        $i = 1;
        while (!feof($handle)) {
            $zeile = fgets($handle);
            if (strcmp("", $zeile) != 0) { //if (compare string "" to zeile)!= 0
                $arrayOfData = explode(";", $zeile);
                echo "<div class='width22pr back-lime mar10 font20 pad10'>User " . $i . ": ";
                echo "$arrayOfData[0] ";
                echo "$arrayOfData[1]<br>";
                echo "Long: $arrayOfData[2]<br>";
                echo "Lat: $arrayOfData[3]<br>";
                echo "Kategorie: $arrayOfData[4]<br>";
                echo "<a href='mhs-5.php?user=$zeile'>Details von $arrayOfData[1]</a></div>";
                $i++;

            }
            // echo "<br>". $zeile;
        }
    } else {
        echo "Fehler beim Öffnen";
    }


    ?>
</div>
</body>
</html>