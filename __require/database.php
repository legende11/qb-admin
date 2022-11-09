<?php
session_start();

function GetConnection():PDO
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    return new PDO("mysql:host=$servername;dbname=qbox-test", $username, $password);
}



function Database_Login($username, $password): bool
{
    $conn = GetConnection();
    $prep = $conn -> prepare("SELECT username, password FROM `admin-login` WHERE username = :username;");
    $prep -> bindParam(":username", $username);
    $prep -> execute();
    foreach ($prep -> fetchAll() as $item) {
        if(array_key_exists('password', $item )) {
            if(password_verify($password, $item['password'])) {
                return true;
            }
        }
    }
    return false;
}


function Database_Api(): string
{
    $conn = GetConnection();
    $random = RandomString(20);
    $prep = $conn -> prepare("INSERT into `api` SET `key` = :apikey;");
    $prep -> bindParam(":apikey", $random);
    $prep -> execute();
    return $random;
}

function RandomString($length): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}