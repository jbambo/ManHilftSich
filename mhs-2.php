<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

<header>
    <p class="tightwrap font45 ">
        Man Hilft Sich Portal
    </p>
</header>

<?php include "mhs-menu.html"; ?>

<?php
//initialize variables
$nn = "";
$vn = "";
$long = "";
$lat = "";
$hilfe = "";
$urgency = "";
$m1 = "";
$m2 = "";

if (!(isset($_POST["nn"])) or //check if input is set
    !(isset($_POST["vn"])) or
    !(isset($_POST["long"])) or
    !(isset($_POST["lat"])) or
    !(isset($_POST["urgency"])) or
    !(isset($_POST["category"]))) {
    ?> <p class="flex-center">Fehler, gehen sie zürück zum formular.</p><?php
} else {
    $nn = htmlspecialchars($_POST["nn"]);//pass form to local variables
    $vn = htmlspecialchars($_POST["vn"]);
    $long = htmlspecialchars($_POST["long"]);
    $lat = htmlspecialchars($_POST["lat"]);
    $category = htmlspecialchars($_POST["category"]);
    $urgency = htmlspecialchars($_POST["urgency"]);


    if ($urgency == 1) $m2 = "nicht dringeng";      //assign string to urgency level
    elseif ($urgency == 2) $m2 = "dringend";
    elseif ($urgency == 3) $m2 = "jetzt gerade";
    elseif ($urgency == 4) $m2 = "notfall";

    ?>
    <div class="flex-center">
        <div class="font45">
            Ihrer input war:
        </div>
        <div class="flex-center-row mar10">
            <table class="font30">
                <tr>
                    <td>Vorname:</td>
                    <td><?php echo $vn ?></td>
                </tr>
                <tr>
                    <td>Nachname:</td>
                    <td><?php echo $nn ?></td>
                </tr>
                <tr>
                    <td>Longitude:</td>
                    <td><?php echo $long ?></td>
                </tr>
                <tr>
                    <td>Latitude:</td>
                    <td><?php echo $lat ?></td>
                </tr>
                <tr>
                    <td>Benötigte hilfe:</td>
                    <td><?php echo $category ?></td>
                </tr>
                <tr>
                    <td>Dringlichkeit:</td>
                    <td><?php echo $m2 ?></td>
                </tr>
                <tr>
                    <td>
                        <button class="font30 back-lime" id="wrongBtt" onclick="goStart()">Das Stimmt nicht,<br>Zurück!
                        </button>
                    </td>
                    <td>
                        <button class="font30 back-lime" id="saveBt" onclick="saveDB()">Najs,<br>Speichern!</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

<?php } //else end?>
<script src=js/script.js></script>
</body>
</html>
