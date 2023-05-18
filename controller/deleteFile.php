<?php

require("../utils/config.php");
require("../model/Documents.php");
require("../model/Permissions.php");


$fileModel = new Documents();
$permiss = new Permissions();

$fileId = $_GET['id'] ?? false;

session_start();

$user_id = $_SESSION['user'];
$permiss->auth_shared(intval($user_id), intval($fileId));

if ($permiss === true) {
  $fileModel->delete($fileId);
  header('location: http://localhost/pw/trabalho-programa-o-web/controller/listPersonalFiles.php?error=2');
} else {
  header('location: http://localhost/pw/trabalho-programa-o-web/controller/listPersonalFiles.php?error=4');
}
