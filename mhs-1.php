<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Man Hilft Sich</title>
    <link href="styles/style.css" rel="stylesheet">
    <!-- leaflet import css-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <!--here api import -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
            type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
            type="text/javascript" charset="utf-8"></script>
    <!-- leaflet import js library-->
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
            integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
            crossorigin="">
    </script>
    <!-- jquery import-->
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <!-- highcharts import -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body onload="onloadFunction()">

<div id="menu" class="close">
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
        <div id="registerUser" class="close">
            <form method="post" action="#">
                <table>
                    <th>Hilfesuchender Anmeldung</b></th>
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
                        </td>
                        <td>
                            <input type="button" value="add user" onclick="ajaxSendUser()">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" value="get location" onclick="getLocation(2)">
                            <input type="button" value="adress" onclick="showAddress()">
                        </td>
                    </tr>
                </table>
                <p id="message"></p>
            </form>
        </div>
        <div id="registerHelper" class="close">
            <form method="post" action="#">
                <table>
                    <th>Helfer Anmeldung</th>
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
                        <td>Ich erledige 1.:</td>
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
                        <td>Ich erledige 2.:</td>
                        <td>
                            <select name="category2" id="category2" required>
                                <option value="Garten">Garten</option>
                                <option value="zu Hause">zu Hause</option>
                                <option value="beim Einkaufen">beim Einkaufen</option>
                                <option value="im Hof">im Hof</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="button" value="add user" onclick="ajaxSendHelper()">
                            <input type="button" value="location" onclick="getLocation(1)">
                            <input type="button" value="address" onclick="showAddress()">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="button" value="show route" onclick="showTheWay()">
                            <input type="button" value="LOGIN/LOAD" onclick="loginHelper()">
                            <input type="reset" value="reset">
                        </td>
                    </tr>

                </table>
                <p id="message"></p>
            </form>
            <form id="jobStatus" method="post" action="#" class="close">
                <table>
                    <thead>
                    <tr>
                        <th>Job id</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="number" id="jobId" name="jobId">
                        </td>
                        <td>
                            <select name="status" id="status">
                                <option value="in progress">in progress</option>
                                <option value="done">done</option>
                            </select>
                        </td>
                        <td>
                            <input type="button" value="change status" onclick="changeJobStatus()">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
            <table id="helperJobs"></table>
        </div>
        <div id="addressField" class="close">
            <table>
                <tr>
                    <td>Address:</td>
                    <td>
                        <input type="text" id="address" name="address">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="button" value="submit" onclick="addressToCoords()">
                        <input type="button" value="close" onclick="closeAddress()">
                    </td>
                </tr>
            </table>
        </div>
        <div id="bossView" class="close">
            <input type="button" value="show Helper" onclick="ajaxShowHelperBoss()">
            <input type="button" value="show User" onclick="ajaxShowUserBoss()">
            <input type="button" value="show graphic" onclick="showChart()">
            <input type="button" value="update iso" onclick="ajaxRunIsoService()">
            <form id="assignJob" method="post" action="#">
                <table>
                    <tr>
                        <th>Hilfesuchender ID:</th>
                        <th>Helfer ID:</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" step="1" id="userId" name="userId">
                        </td>
                        <td>
                            <input type="number" step="1" id="helperId" name="helperId">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" value="zuweisen" onclick="ajaxAssignJobs()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="peasants" class="close">
            <table id="helperData"></table>
            <table id="userData"></table>
        </div>
    </div>


        <div id="graphics">
            <div id="map">
                <div id="mapid"></div>
            </div>
            <div id="charts">
                <div id="chart1"></div>
                <div id="chart2"></div>
            </div>
        </div>

</div>

<script type="text/javascript" src="js/script.js"></script>

</body>
</html>



