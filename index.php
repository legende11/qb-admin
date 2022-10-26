<?php
require "__require/database.php";
require "__require/css.php";
require "__require/api.php";


if(!array_key_exists('username', $_SESSION)) {
    header("location: ./login/");
}




function Main_Buttons(): string
{
    return "
    <div style='width: 100%; margin-left: 5%;'>
        <div style='width: 45%; height:25%; border: thick black; display: inline-table'>
            <button class='w3-button w3-teal w3-hover-yellow' style='width: 100%; height: 100%' onclick='Button(1)'><h1>Speler beheer</h1></button>
        </div>
         <div style='width: 45%; height:25%; border: thick black; display: inline-table; '>
            <button class='w3-button w3-green w3-hover-yellow' style='width: 100%; height: 100%' onclick='Button(2)'><h1>Server beheer</h1></button>
        </div>
    </div>
    ";
}


function Main_ButtonJS(): string
{
    return "
    <script>
        function Button(id) {
            if(id === 1) {
                window.location.href = './players/';
            }
            if(id === 2) {
                window.location.href = './server/';
            }
            
        }
    </script>
    ";
}

?>


<head>
    <title>QB-admin - Main</title>
    <?=css()?>
</head>
<body>
    <?=Site_Header()?>
    <br>
    <?=Main_Buttons()?>

    <?=Main_ButtonJS()?>
</body>
