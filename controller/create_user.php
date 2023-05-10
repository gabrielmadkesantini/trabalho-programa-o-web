<?php

require("../utils/config.php");

require("../model/Users.php");

$usr = new Users();

$name = $_POST['name'] ?: false;
$email = $_POST['email'] ?: false;
$password = $_POST['password'] ?: false;
$passwordVerify = $_POST['passwordVerify'] ?: false;


if ($name === false || $email === false || $password === false || $passwordVerify === false) {
    header("location:" . HTTP_URL . "controller/signup.php?erro=1");
} else if ($password !== $passwordVerify) {
    header("location:" . HTTP_URL . "controller/signup.php?erro=2");
} else {

    $userData = $usr->getData($email);
    if ($userData['email'] !== false) {
        header("location:" . HTTP_URL . "controller/signup.php?erro=3");
}

    $passwordHashed = password_hash($password, PASSWORD_BCRYPT, [
        'cost' => 12
    ]);


    $usr->create([
        "name" => $name,
        "email" => $email,
        "password" => $passwordHashed
    ]);

    header("location:" . HTTP_URL . "controller/home.php");
}