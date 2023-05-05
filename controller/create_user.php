<?php

require("../utils/config.php");

require("../model/Users.php");

$name = $_POST['name'] ?: false;
$email = $_POST['email'] ?: false;
$password = $_POST['password'] ?: false;
$passwordVerify = $_POST['passwordVerify'] ?: false;

if ($name === false || $email === false || $password === false || $passwordVerify === false) {
    header("location:" . HTTP_URL . "controller/signup.php?erro=1");
} else if ($password !== $passwordVerify) {
    header("location:" . HTTP_URL . "controller/signup.php?erro=2");
} else {
    $passwordHashed = password_hash($password, PASSWORD_BCRYPT, [
        'cost' => 12
    ]);


    $usr = new Users();

    $usr->create([
        "name" => $name,
        "email" => $email,
        "password" => $passwordHashed
    ]);
    header("location:" . HTTP_URL . "controller/home.php");
}