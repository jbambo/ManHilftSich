<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link href="styles/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/> <!-- leaflet import css-->
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
            integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
            crossorigin="">
    </script> <!-- leaflet import js library-->
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script> <!-- jquery import-->
</head>
<body>

<div id="menu">
    <?php include "mhs-menu.html" ?>
</div>

<div class="content_max_width">

    <div id="parent">
        <form id="selectRole">
            <table>
                <tr>
                    <td>Ich bin ein: </td>
                    <td><select name="role" id="role" required>
                            <option value="helper">Helfer</option>
                            <option value="user">Hilfesuchender</option>
                            <option value="boss">Verwalter</option>
                        </select>
                    </td>
                    <td><input type="button" value="Submit" onclick="selectRole()"></td>
                </tr>
            </table>
        </form>
        <form id="registerUser" class="close" action="#" method="post">
            <table>
                <tr><b>Hilfesuchender Anmeldung</b></tr>
                <tr>
                    <td>Login: </td>
                    <td><input type="text" id="login" name="login" required></td>
                </tr>
                    <td>Vorname:</td>
                    <td><input type="text" id="vn" name="vn" required></td>
                </tr>
                <tr>
                    <td>Nachname:</td>
                    <td><input type="text" id="nn" name="nn" required></td>
                </tr>
                <tr>
                    <td>Longitude:</td>
                    <td><input type="number" step="0.001" id="long" name="long" required></td>
                </tr>
                <tr>
                    <td>Latitude:</td>
                    <td><input type="number" step="0.001" id="lat" name="lat" required></td>
                </tr>
                <tr>
                    <td>Benötigte hilfe:</td>
                    <td>
                        <select name="category" id="category" required>
                            <option value="Garten">Garten</option>
                            <option value="zu Hause">zu Hause</option>
                            <option value="beim Einkaufen">beim Einkaufen</option>
                            <option value="im Hof">im Hof</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Dringlichkeit:</td>
                    <td>
                        <select name="urgency" id="urgency" required>
                            <option value="1">nicht dringend</option>
                            <option value="2">dringend</option>
                            <option value="3">sehr dringend</option>
                            <option value="4">notfall</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="reset"  value="reset">
                        <input type="button" name="map" value="map" onclick="drawMap()">
                    </td>
                    <td>
                        <input type="button" value="add user" onclick="ajaxSend(1)">
                        <input type="button" value="update" onclick="ajaxSend(1)">
                        <input type="button" value="delete" onclick="ajaxSend(1)" >
                        <input type="hidden" name="action" id="action" value="0">
                    </td>
                </tr>
            </table>
        </form>
        <form id="registerHelper" class="close">
            <table >
                <tr><b>Helfer Anmeldung</b>
                    <td>Vorname</td>
                    <td>input</td>
                </tr>
                <tr>
                    <td>Nachname</td>
                    <td>input</td>
                </tr>

            </table>
        </form>
        <div id="bossView" class="close">im am the boss, hello</div>
    </div>


        <div id="mapid" class="mar10"></div>
</div>

<script type="text/javascript" src="js/script.js"></script>

</body>
</html>



