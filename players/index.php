<?php
require "../__require/database.php";
require "../__require/css.php";
require "../__require/api.php";

if(!array_key_exists('username', $_SESSION)) {
    header("location: ../login/");
}



if(array_key_exists('reason', $_POST)) {
    $reden = str_replace(' ', '_', $_POST['reason']);
    $reden = str_replace('/', '-', $reden);
    Api_Request("kickall/$reden");

}

function Players_Table_Generate(): string
{
    $players = json_decode(Api_Request("players"));
    $table = "";
    foreach ($players as $player) {
        $ping = Api_Request("ping/$player");
        $pdata = json_decode(Api_Request("playerdata/$player"));

        $firstname = $pdata ->charinfo ->firstname;
        $lastname = $pdata ->charinfo ->lastname;

        $cash = $pdata -> money ->cash;
        $bank = $pdata -> money ->bank;
        $crypto = $pdata -> money ->crypto;

        $job = $pdata -> job -> label;
        $grade = $pdata -> job -> grade -> level;
        $table .= "
        <tr>
            <td>$player</td>
            <td>$firstname $lastname</td>
            <td>Contant: $cash -Bank: $bank -Crypto: $crypto</td>
            <td>$job - $grade</td>
            <td>$ping</td>
            <td><button class='w3-button' onclick='location.href = `./beheer.php?id=$player`' style='height: 25%'><bold>Beheer</bold></button></td>
        </tr>
        ";
    }
    return $table;
}

function Players_Table(): string
{
    $table = Players_Table_Generate();
    return "
    <table class='w3-table w3-striped'>
        <tr>
            <th>ID</th>
            <th>Charname</th>
            <th>Geld</th>
            <th>Baan</th>
            <th>Ping</th>
            <th>Beheer</th>
        </tr>
        $table
    </table>
    ";

}

function Player_KickAll():string
{
    return "
    <div style='margin-right: auto; display: grid'>
        <form method='post' style='margin:auto'><input type='submit' id='kickall' name='kickall' value='⚠️Kick iedereen⚠️' class='w3-button w3-center'><input type='text' id='reason' name='reason' value='Reden' class='input w3-center'></form>
    </div>
    ";
}
?>

<head>
    <title>QB-admin - Spelers</title>
    <?=css()?>
</head>
<body>
    <?=Site_Header()?>
    <hr>
    <?=Player_KickAll()?>
    <hr>
    <?=Players_Table()?>
</body>
