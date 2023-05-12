<?php 

require("../utils/config.php");
require("../model/Documents.php");
require("../model/Users.php");

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
        $FileCreator = new Users(); 

        $FileCreator->

        $fileModel->create([
            "path" => $targetFilePath
        ]);

        echo "Salvo com sucesso";

    }
}else {
    echo "extensão proibida";
}
    
?>