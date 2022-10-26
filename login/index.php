<?php
require "../__require/database.php";
require "../__require/css.php";


if (array_key_exists("username", $_POST) && array_key_exists("password", $_POST)) {
    Login_Login($_POST['username'], $_POST['password']);
}

function Login_Login($username, $password)
{
    if (Database_Login($username, $password)) {
        $_SESSION['username'] = $username;
        header("location: ../");


    }
}

function Login_Form()
{
    return "
    <div style='width:50%; margin: auto;' class='w3-center'>
        <form method='post' class='w3-center'>
            <p>Username</p>
            <input type='text' name='username' class='w3-input'>
            <p>Password</p>
            <input type='password' name='password' class='w3-input'>
            <input type='submit' name='submit' class='w3-button' value='login'>
        </form>
    </div>
    ";
}

function Login_Header()
{
    if (array_key_exists('username', $_SESSION)) {
        $username = $_SESSION['username'];
        return "
        <h1 class='w3-center'>Login - $username</h1>
        ";
    } else {
        return "
        <h1 class='w3-center'>Login</h1>
        ";
    }

}


?>

<head>
    <title>QB-admin - Login</title>
    <?= css() ?>
</head>
<body>
<?= Login_Header() ?>
<hr>
<?= Login_Form() ?>
</body>