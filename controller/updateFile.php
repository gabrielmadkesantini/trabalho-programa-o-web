<?php

require("../utils/config.php");
require("../model/Documents.php");


$files = $_FILES['arquivos'];
$idFile = $_POST['idFile'];
$idOwner = $_POST['idOwner'];

$fileName = $files['name'];
$filePath = $files['tmp_name'];

$formats = array('pdf', 'doc', 'docx');
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if (in_array($fileExtension, $formats)) {
    $targetDiretory = 'files';

    $targetFilePath = "../" . $targetDiretory . '/' . $fileName;


    if (move_uploaded_file($filePath, $targetFilePath)) {
        $fileModel = new Documents();


        $fileModel->update(
            $targetFilePath,
            $idOwner,
            $idFile
        );

        header('location: http://localhost/pw/trabalho-programa-o-web/controller/listPersonalFiles.php');


    }
} else {
    header('location: http://localhost/pw/trabalho-programa-o-web/controller/listPersonalFiles.php?error=1');
}

?>