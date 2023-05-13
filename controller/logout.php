<?php

session_start();
session_destroy();

header('location: http://localhost/pw/trabalho-programa-o-web/controller/login.php');

?>