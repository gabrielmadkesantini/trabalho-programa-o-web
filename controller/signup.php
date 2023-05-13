<?php 

require_once("../utils/config.php");
// require(BASE_URL."utils/verifyUser.php");
require(BASE_URL."utils/twig_config.php");

require("../model/Users.php");
$usr = new Users();

$logged = $usr->verifyLogged();

if($logged){
    header('location: http://localhost/pw/trabalho-programa-o-web/controller/home.php?error=2');
}

$erro = $_GET['erro'] ?? false;

echo $twig->render('signup.html', [
    "erro" => $erro,
]);


?>