<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link href="styles/style_mhs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>

</head>
<body>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
        integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
        crossorigin="">
</script>
<header>
    <p class="tightwrap font45 ">
        Man Hilft Sich Portal
    </p>
</header>

<?php include "mhs-menu.html"; ?>

<div class="flex-center-row">
    <form action="mhs-2.php" method="post">
        <table class="font30">
            <tr>
                <td>Vorname:</td>
                <td><input class="font30" type="text" id="vn" name="vn"><br></td>
            </tr>
            <tr>
                <td>Nachname:</td>
                <td><input class="font30" type="text" id="nn" name="nn"><br></td>
            </tr>
            <tr>
                <td>Longitude:</td>
                <td><input class="font30" type="number" step="0.01" id="long" name="long"></td>
            </tr>
            <tr>
                <td>Latitude:</td>
                <td><input class="font30" type="number" step="0.01" id="lat" name="lat"><br></td>
            </tr>
            <tr>
                <td>Benötigte hilfe:</td>
                <td><input class="font30" type="text" id="category" name="category"></td>
            </tr>
            <tr>
                <td>Dringlichkeit:</td>
                <td><select class="font30 lime" name="urgency" id="urgency" required>
                        <option value="1">nicht dringend</option>
                        <option value="2">dringend</option>
                        <option value="3">jetzt gerade</option>
                        <!--option value="4">Emergency</option-->
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <!--<td><input class="submit tightwrap" type="submit" name="submit" value="SAVE"></td>-->
                <td><input class="font30" type="button" value="MAP" onclick="drawMap()">
                    <input class="font30" type="submit" name="submit" value="ENTER">
                    <input class="font30" type="reset" value="RESET">
                </td>
            </tr>
        </table>
    </form>

</div>

<div id="mapid"></div>
<script src="js/script.js"></script>

</body>
</html>



