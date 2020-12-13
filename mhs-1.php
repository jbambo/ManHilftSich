<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link href="styles/style.css" rel="stylesheet">
    <!-- leaflet import css-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <!-- leaflet import js library-->
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
            integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
            crossorigin="">
    </script>
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script> <!-- jquery import-->
</head><!--testAjax()-->
<body onload="onloadFunction()">

<div id="menu">
    <?php include "mhs-menu.html" ?>
</div>

    <div class="content_max_width">
        <div id="parent">
            <form id="selectRole">
                <table>
                    <tr>
                        <td>Ich bin ein:</td>
                        <td><select name="role" id="role" required>
                                <option value="helper">Helfer</option>
                                <option value="user">Hilfesuchender</option>
                                <option value="boss">Verwalter</option>
                            </select>
                        </td>
                        <td><input type="button" value="Enter" onclick="selectRole()"></td>
                    </tr>
                </table>
            </form>
            <form id="registerUser" class="close" method="post" action="#">
                <table>
                    <tr><b>Hilfesuchender Anmeldung</b></tr>
                    <tr>
                        <td>Vorname:</td>
                        <td><input type="text" id="userName" name="userName" required></td>
                    </tr>
                    <tr>
                        <td>Nachname:</td>
                        <td><input type="text" id="userSurname" name="userSurname" required></td>
                    </tr>
                    <tr>
                        <td>Longitude:</td>
                        <td><input type="number" step="0.001" id="userLong" name="userLong" required></td>
                    </tr>
                    <tr>
                        <td>Latitude:</td>
                        <td><input type="number" step="0.001" id="userLat" name="userLat" required></td>
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
                            <input type="reset" value="reset">
                            <input type="button" value="delete" onclick="ajaxSendUser()">
                        </td>
                        <td>
                            <input type="button" value="add user" onclick="ajaxSendUser()">
                            <input type="button" value="update" onclick="ajaxSendUser()">
                            <input type="button" value="get location" onclick="getLocation()">
                        </td>
                    </tr>
                </table>
                <p id="response"></p>
            </form>
            <form id="registerHelper" class="close" method="post" action="#">
                <table>
                    <tr><b>Helfer Anmeldung</b></tr>
                    <tr>
                        <td>Vorname</td>
                        <td><input type="text" id="helperName" name="helperName" required></td>
                    </tr>
                    <tr>
                        <td>Nachname</td>
                        <td><input type="text" id="helperSurname" name="helperSurname" required></td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td><input type="number" step="0.001" id="helperLong" name="helperLong" required></td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td><input type="number" step="0.001" id="helperLat" name="helperLat" required></td>
                    </tr>
                    <tr>
                        <td>Ich erledige:</td>
                        <td>
                            <select name="category1" id="category1" required>
                                <option value="Garten">Garten</option>
                                <option value="zu Hause">zu Hause</option>
                                <option value="beim Einkaufen">beim Einkaufen</option>
                                <option value="im Hof">im Hof</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ich erledige auch:</td>
                        <td>
                            <select name="category2" id="category2" required>
                                <option value="Garten">Garten</option>
                                <option value="zu Hause">zu Hause</option>
                                <option value="beim Einkaufen">beim Einkaufen</option>
                                <option value="im Hof">im Hof</option>
                            </select>
                        </td>
                    </tr>
                    <tr><td>
                            <input type="reset" value="reset">
                            <input type="button" value="delete" onclick="ajaxSendUser()">
                        </td>
                        <td>
                            <input type="button" value="add user" onclick="ajaxSendHelper()">
                            <input type="button" value="update" onclick="ajaxSendHelper()">
                            <input type="button" value="get location" onclick="getLocation()">
                        </td>
                    </tr>
                </table>
                <p id="response"></p>
            </form>
            <div id="bossView" class="close">im am the boss, hello</div>
        </div>
        <div>
            <div id="mapid" class="mar10"></div>
            <div id="userData" class="mar10">
                <table>
                    <tr><b>Hilfesuchende</b>
                        <td>Vorname:</td>
                        <td>value</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

<script type="text/javascript" src="js/script.js"></script>

</body>
</html>



