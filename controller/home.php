<?php

require_once("../utils/config.php");
// require(BASE_URL."utils/verifyUser.php");
require(BASE_URL . "utils/twig_config.php");


echo $twig->render('home.html');


?>