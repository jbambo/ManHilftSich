<?php //start the session
session_start()
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link href="styles/style_mhs.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <p class="tightwrap font45">
        Man Hilft Sich Portal
    </p>
</div>
<?php include "menu.html"; ?>
<?php
$vn = $_SESSION["vn"];
$nn = $_SESSION["nn"];
$long = $_SESSION["long"];
$lat = $_SESSION["lat"];

if (!isset($_GET["kat"])) {
    echo "Fehler, gehen sie zurück.";

} else {

    $k = $_GET["kat"];
    $data = "alleHilfesuchenden.txt";

    if ($k == "G") {
        $output = "$vn;$nn;$long;$lat;Garten\n";
        $handle = fopen($data, "a");

        if ($handle != false) {
            fputs($handle, $output);
            fclose($handle);
            echo "Gespeichert!";
        } else echo "fehler beim speichern";

        ?>

        <div class="flex-center font30"><p>Ich <?php echo $vn . " " . $nn ?> benötige hilfe im
                Garten an der lokalisation:<br> <?php echo "long: " . $long . "<br>lat: " . $lat ?>  </p></div>

        <?php
    } elseif ($k == "H") {
        $output = "$vn;$nn;$long;$lat;Haushalt\n";
        $handle = fopen($data, "a");

        if ($handle != false) {
            fputs($handle, $output);
            fclose($handle);
            echo "Gespeichert!";

        } else echo "fehler beim speichern";

        ?>
        <div class="flex-center font30"><p>Ich <?php echo $vn . " " . $nn ?> benötige hilfe im
                Haushalt an der lokalisation:<br> <?php echo "long: " . $long . "<br>lat: " . $lat ?>  </p></div>

        <?php
    } else {
        $output = "$vn;$nn;$long;$lat;Einkaufen\n";
        $handle = fopen($data, "a");

        if ($handle != false) {
            fputs($handle, $output);
            fclose($handle);
            ?>

            <div class="flex-center font45">
                Daten Gespeichert!
            </div>

            <?php
        } else echo "fehler beim speichern";

        ?>
        <div class="flex-center font30"><p>Ich <?php echo $vn . " " . $nn ?> benötige hilfe beim Einkaufen
                an der lokalisation:<br> <?php echo "long: " . $long . "<br>lat: " . $lat ?>  </p></div>
        <?php
    }

}

?>
</body>
</html>
