<?php
require "../__require/database.php";
require "../__require/css.php";
require "../__require/api.php";

if(!array_key_exists('username', $_SESSION)) {
    header("location: ../login/");
}

GLOBAL $player;
$id = str_replace('/qb-admin/players/beheer.php?id=', '', $_SERVER['REQUEST_URI']);
$player = json_decode(Api_Request("playerdata/$id"));

if(!isset($player -> cid)) {
    header("location: ./");
    // Making sure the player is online and the ID is there
}

if(!isset($id)) {
    header("location: ./");
}



function beheer_ButtonsLeft():string
{
    return "
            <div style='display: table'>
                <form method='post' style='display: inline-table'>
                    <p class='w3-center'>Player options</p>
                    <input type='submit' value='revive' id='revive' name='revive' class='w3-button' style='width: 100%'>
                    <input type='submit' value='kill' id='kill' name='kill' class='w3-button' style='width: 100%'>
                    <input type='submit' value='cuff' id='cuff' name='cuff' class='w3-button' style='width: 100%'>

                </form>
                <form method='post' style='display: inline-table;'>
                    <p class='w3-center'>Kick/Ban</p>
                    <input type='submit' value='kick' id='kick' name='kick' class='w3-button' style='width: 100%'>
                    <input type='submit' value='ban' id='ban' name='ban' class='w3-button' style='width: 100%'>
                    <hr>
                    <p class='w3-center'>Reason</p>
                    <input type='text'  id='Reason' name='Reason' class='w3-input' style='width: 100%;'>
                    <p class='w3-center'>Duration (in minutes)</p>
                    <input type='number' id='time'  name='time' class='w3-input' min=0 style='width: 100%;'>

                </form>
                <form method='post' style='display: inline-table;'>
                    <p class='w3-center'>Financial options</p>
                    <input type='submit' value='add' id='add' name='add' class='w3-button' style='width: 100%'>
                    <input type='submit' value='remove' id='remove' name='remove' class='w3-button' style='width: 100%'>

                    <input type='number' id='amnt' name='amnt' class='w3-input' min=0 style='width: 100%;'>
                </form>
            </div>
    ";
}



if(array_key_exists('revive', $_POST)) {
    Api_Request("revive/$id");
}

if(array_key_exists('kill', $_POST)) {
    Api_Request("kill/$id");
}

if(array_key_exists('kick', $_POST) && array_key_exists('Reason', $_POST)) {
    $Reason = str_replace(' ', '_', $_POST['Reason']);
    $Reason = str_replace('/', '-', $Reason);
    Api_Request("kick/$id/$Reason");
}


if(array_key_exists('ban', $_POST) && array_key_exists('Reason', $_POST) && array_key_exists('time', $_POST)) {
    $Reason = str_replace(' ', '_', $_POST['Reason']);
    $Reason = str_replace('/', '-', $Reason);
    Api_Request("ban/$id/$Reason/$_POST[time]");
}

if(array_key_exists('cuff', $_POST)) {
    Api_Request("cuff/$id");
}

if(array_key_exists('add', $_POST) && array_key_exists('amnt', $_POST)) {
    Api_Request("money/$id/$_POST[amnt]/add/cash");
}

if(array_key_exists('remove', $_POST) && array_key_exists('amnt', $_POST)) {
    Api_Request("money/$id/$_POST[amnt]/remove/cash");
}
?>

<head>
    <title>QB-admin - Speler beheer</title>
    <?=css()?>
</head>
<body>
<?=Site_Header()?>
<?=beheer_ButtonsLeft()?>
</body>
