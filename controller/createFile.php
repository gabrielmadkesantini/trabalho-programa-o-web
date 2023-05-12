<?php 

$files = $_FILES['file'];

$fileName = $files['name'];
$filePath = $files['tmp_name'];

$formats = array('pdf', 'doc', 'docx');

$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));



if(in_array($fileExtension, $formats)){
    $targetDiretory = 'files';

    $targetFilePath = "../".$targetDiretory . '/' . $fileName;

    
    

   

    if(move_uploaded_file($filePath, $targetFilePath)){
        var_dump($targetFilePath);
        die;

    }
}else {
    echo "extensão proibida";
}
    

?>