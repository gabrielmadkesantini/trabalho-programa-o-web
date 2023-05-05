<?php

require("../model/Users.php");

// $nome = $_POST['nome'];
// $valor = $_POST['valor'];
// $quantia = $_POST['quantia'];

$usr = new Users();
$result = $usr->get_one([
    "id"=>1,
]);

var_dump($result);  


 