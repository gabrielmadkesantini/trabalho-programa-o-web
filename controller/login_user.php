<?php

require("../utils/config.php");

require("../model/Users.php");

$email = $_POST['email'] ?: false;
$password = $_POST['password'] ?: false;

if ($email === false || $password === false) {
    header("location:" . HTTP_URL . "controller/login.php?erro=1");
} else if ($password !== $passwordVerify) {
    header("location:" . HTTP_URL . "controller/signup.php?erro=2");
} else {



    $usr = new Users();

    $usr->create([
        "name" => $name,
        "email" => $email,
    ]);
    header("location:" . HTTP_URL . "controller/home.php");
}