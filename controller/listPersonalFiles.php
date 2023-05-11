<?php 

require_once("../utils/config.php");
// require(BASE_URL."utils/verifyUser.php");
require(BASE_URL."utils/twig_config.php");

require("../model/Users.php");

$usr = new Users();

$all = $usr->get_all();

$erro = $_GET['erro'] ?? false;

echo $twig->render('listPersonalFiles.html', [
    "erro" => $erro,
    "users" => $all
]);


?>