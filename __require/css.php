<?php
function css() {
    $t = '
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    ';
    return $t;
}


function Site_Header(): string
{
    $arrcount = count(explode('/', $_SERVER['REQUEST_URI'])) - 3;
    $str = "";
    for ($i = 0; $i < $arrcount; $i++) {
        $str .= "../";
    }
    return "
    <div>
        <div style='display: inline-table'>
        <button onclick='window.location.href = `$str`' class='w3-button'>Home</button>
        </div>
        <div style='line-height: 75%;'>
        <h1 class='w3-center'>QB-Admin</h1>
        <p class='w3-center'>With 💛 From L1</p>
        </div>

    </div>
    ";
}


?>



<!DOCTYPE html>
