<?php 

require("../utils/config.php");
require("../model/Documents.php");

$files = $_FILES['arquivos'];

$fileName = $files['name'];
$filePath = $files['tmp_name'];

$formats = array('pdf', 'doc', 'docx');
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if(in_array($fileExtension, $formats)){
    $targetDiretory = 'files';

    $targetFilePath = "../".$targetDiretory . '/' . $fileName;   


    if(move_uploaded_file($filePath, $targetFilePath)){
        $fileModel = new Documents();       

        $fileModel->auth();

        session_start();
        $idFileCreator = $_SESSION['user'];

        $fileModel->create([
            "path" => $targetFilePath,
            "users_id" => $idFileCreator["id"]
        ]);

        echo "Salvo com sucesso";

    }
}else {
    echo "extensão proibida";
}
    
?>