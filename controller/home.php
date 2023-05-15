<?php

require_once("../utils/config.php");
// require(BASE_URL."utils/verifyUser.php");
require(BASE_URL . "utils/twig_config.php");

require("../model/Users.php");
$usr = new Users();

$logged = $usr->verifyLogged();
$error = $_GET['error'] ?? false;

echo $twig->render('home.html', [
    "error" => $error,
    "logged" => $logged
]);


?>