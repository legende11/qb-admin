<?php
session_start();

function GetConnection():mysqli
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, "qbox-test");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;

}



function Database_Login($username, $password): bool
{
    $conn = GetConnection();
    $sanitized_username = mysqli_real_escape_string($conn, $username);
    $sanitized_password = mysqli_real_escape_string($conn, sha1($password));
    $result = $conn -> query("SELECT username FROM `admin-login` WHERE username = '$sanitized_username' AND password = '$sanitized_password';");
    $conn -> close();
    return count($result -> fetch_all()) != 0;
}


function Database_Api(): string
{
    $conn = GetConnection();
    $random = RandomString(20);
    $conn -> query("INSERT into `api` SET `key` = '$random';");
    $conn -> close();
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