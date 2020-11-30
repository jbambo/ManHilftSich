<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link href="styles/style_mhs.css" rel="stylesheet">
</head>
<body>
<div class="container" style="font-size: 45px">
    <p class="tightwrap">
        Man Hilft Sich Portal
    </p>
</div>
<?php include "mhs-menu.html"; ?>


<?php
$user = "";
if (isset($_GET["user"])) {
    $user = $_GET["user"];
    $arrayOfData = explode(";", $user);
    ?>
    <p class="tightwrap back-lime margin-left-20pr font45">Karteikarte von: </p>
    <div class="margin-left-20pr">
        <table class=" neat font45">
            <tr>
                <td>Vorname:</td>
                <td><?php echo $arrayOfData[0] ?><br></td>
            </tr>
            <tr>
                <td>Nachname:</td>
                <td><?php echo $arrayOfData[1] ?><br></td>
            </tr>
            <tr>
                <td>Longitude:</td>
                <td><?php echo $arrayOfData[2] ?><br></td>
            </tr>
            <tr>
                <td>Latitude:</td>
                <td><?php echo $arrayOfData[3] ?></td>
            </tr>


        </table>


    </div>


    <?php
} else echo "<p class='container font45'>fehler, gehen sie zurück :)</p>";


?>
</body>
</html>