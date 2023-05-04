<?php

require(BASE_URL.'vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader(BASE_URL.'view');

$twig = new \Twig\Environment($loader);