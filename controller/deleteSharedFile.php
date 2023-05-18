<?php

require("../utils/config.php");
require("../model/Documents.php");


$fileModel = new Documents();


$fileId = $_GET['id'] ?? false;


$fileModel->delete($fileId);

header('location: http://localhost/pw/trabalho-programa-o-web/controller/sharedFiles.php?error=1');



?>