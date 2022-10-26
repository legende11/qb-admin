<?php
require "../__require/database.php";
require "../__require/css.php";
require "../__require/api.php";

if(!array_key_exists('username', $_SESSION)) {
    header("location: ../login/");
}

if(array_key_exists('hours', $_POST) && array_key_exists('minutes', $_POST)) {
    Api_Request("time/{$_POST['hours']}/{$_POST['minutes']}");
}

if(array_key_exists('blackout', $_POST)) {
    Api_Request("weather/blackout");
}

if(array_key_exists('clear', $_POST)) {
    Api_Request("weather/clear");
}

if(array_key_exists('rain', $_POST)) {
    Api_Request("weather/rain");
}

if(array_key_exists('thunder', $_POST)) {
    Api_Request("weather/thunder");
}




function Server_Time():string
{
    return "<div style='display: table'>
        <form method='post' style='display: inline-table; width: 40%'>
            <h3 class='w3-center'>Time management</h3>
            <p class='w3-center'>Hours:</p>
            <input type='number' id='hours' name='hours' class='w3-input'>
            <p class='w3-center'>Minutes:</p>
            <input type='number' id='minutes' name='minutes' class='w3-input' >
            <input type='submit' value='Set time' class='w3-button' style='width: 100%'>
        </form>
        <form method='post' style='display: inline-table; width:40%' >
            <h3 class='w3-center'>Weather management</h3>
            <input type='submit' class='w3-button' value='blackout' id='blackout' name='blackout' style='width: 100%'>
            <input type='submit' class='w3-button' value='clear' id='clear' name='clear' style='width: 100%'>
            <input type='submit' class='w3-button' value='rain' id='rain' name='rain' style='width: 100%'>
            <input type='submit' class='w3-button' value='thunder' id='thunder' name='thunder' style='width: 100%'>
            </form>
    </div>";
}

function Server_Weather():string
{
    return "
            <div style='width: 25%; display: grid'>
                <form method='post'>
                    <input type='submit' class='w3-button' value='blackout' id='blackout' name='blackout' style='width: 100%'>
                    <input type='submit' class='w3-button' value='clear' id='clear' name='clear' style='width: 100%'>
                    <input type='submit' class='w3-button' value='rain' id='rain' name='rain' style='width: 100%'>
                    <input type='submit' class='w3-button' value='thunder' id='thunder' name='thunder' style='width: 100%'>
                </form>
            </div>
    ";
}
?>

<head>
    <title>QB-admin - Main</title>
    <?=css()?>
</head>
<body>
    <?=Site_Header()?>
    <hr>
    <?=Server_Time()?>
</body>
