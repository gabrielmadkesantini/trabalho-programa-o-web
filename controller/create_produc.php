<?php

require("twig_config");
require("../model/Users.php");

$nome = $_POST['nome'];
$valor = $_POST['valor'];
$quantia = $_POST['quantia'];

$usr = new Users();

$usr->create([
"name"=> $nome,
"email"=> $email,
"password"=> $password
]);

 