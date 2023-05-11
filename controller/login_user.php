<?php

require("../utils/config.php");

require("../model/Users.php");

$usr = new Users();

$email = $_POST['email'] ?: false;
$password = $_POST['password'] ?: false;

if ($email === false || $password === false) {
    header("location:" . HTTP_URL . "controller/login.php?erro=1");
} else {

    $userPass = $usr->getData($email);

    if (!password_verify($password, $userPass['password'])) {
        // Falha no login
        header('location:login.php?erro=2');
        die;
    }

    $userData = $usr->getData($email);

    $usr->createToken($userData['id']);

    header("location:" . HTTP_URL . "controller/home.php");
}
