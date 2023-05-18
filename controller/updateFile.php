<?php

require("../utils/config.php");
require("../model/Documents.php");
require("../model/Permissions.php");


$files = $_FILES['arquivos'];
$idFile = $_POST['idFile'];
$idOwner = $_POST['idOwner'];

$fileName = $files['name'];
$filePath = $files['tmp_name'];

$formats = array('pdf', 'doc', 'docx');
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

$permiss = new Permissions();
session_start();

$user_id = $_SESSION['user'];
$permiss->auth_shared(intval($user_id), intval($fileId));


if (in_array($fileExtension, $formats)) {
    $targetDiretory = 'files';

    $targetFilePath = "../" . $targetDiretory . '/' . $fileName;


    if (move_uploaded_file($filePath, $targetFilePath)) {
        $fileModel = new Documents();

        if ($permiss === true) {
            $fileModel->update(
                $targetFilePath,
                $idOwner,
                $idFile
            );
            header('location: http://localhost/pw/trabalho-programa-o-web/controller/listPersonalFiles.php?error=2');
        } else {
            header('location: http://localhost/pw/trabalho-programa-o-web/controller/listPersonalFiles.php?error=4');
        }
    }
} else {
    header('location: http://localhost/pw/trabalho-programa-o-web/controller/listPersonalFiles.php?error=1');
}
