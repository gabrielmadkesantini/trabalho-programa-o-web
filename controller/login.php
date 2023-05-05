<?php

require_once("../utils/config.php");
// require(BASE_URL."utils/verifyUser.php");
require(BASE_URL . "utils/twig_config.php");

$erro = $_GET['erro'] ?? false;

echo $twig->render('login.html', [
    "erro" => $erro,
]);


?>