<?php

require("../utils/config.php");
require("../model/Documents.php");
require("../model/Permissions.php");


$fileModel = new Documents();
$permiss = new Permissions();

$fileId = $_GET['id'] ?? false;

session_start();

$user_id = $_SESSION['user'];

$permitted = $permiss->auth_shared(intval($user_id['id']), intval($fileId));

if ($permitted === true) {
  $fileModel->delete($fileId);
  header('location: http://localhost/pw/trabalho-programa-o-web/controller/sharedFiles.php?error=1');
} else {
  header('location: http://localhost/pw/trabalho-programa-o-web/controller/sharedFiles.php?error=2');
}
