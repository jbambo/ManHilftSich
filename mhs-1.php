<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link href="styles/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
            integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
            crossorigin="">
    </script>
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
</head>
<body>

<div id="menu">
    <?php include "mhs-menu.html" ?>
</div>
<div class="content_max_width">
    <div class="mar10">
        <form action="mhs-2.php" method="post">
            <table>
                <tr>
                    <td>Vorname:</td>
                    <td><input type="text" id="vn" name="vn"><br></td>
                </tr>
                <tr>
                    <td>Nachname:</td>
                    <td><input  type="text" id="nn" name="nn"><br></td>
                </tr>
                <tr>
                    <td>Longitude:</td>
                    <td><input  type="number" step="0.01" id="long" name="long"></td>
                </tr>
                <tr>
                    <td>Latitude:</td>
                    <td><input  type="number" step="0.01" id="lat" name="lat"><br></td>
                </tr>
                <tr>
                    <td>Benötigte hilfe:</td>
                    <td><input type="text" id="category" name="category"></td>
                </tr>
                <tr>
                    <td>Dringlichkeit:</td>
                    <td>
                        <select  name="urgency" id="urgency" required>
                            <option value="1">nicht dringend</option>
                            <option value="2">dringend</option>
                            <option value="3">jetzt gerade</option>
                            <option value="4">notfall</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <!--<td><input class="submit tightwrap" type="submit" name="submit" value="SAVE"></td>-->
                    <td><input  type="button" value="MAP" onclick="drawMap()">
                        <input  type="submit" name="submit" value="ENTER">
                        <input  type="reset" value="RESET">
                        <input  type="button" onclick="saveDB()" value="Send">

                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div id="mapid" class="mar10"></div>
</div>

<script type="text/javascript" src="js/script.js"></script>

</body>
</html>



