<?php

require_once("../utils/config.php");
require(BASE_URL . "utils/twig_config.php");
require("../model/Documents.php");
require_once("../model/Users.php");


$users = new Users();
$documents = new Documents();

$userList = $users->get_all();
$logged = $documents->verifyLogged();
$documents->auth();
$userId = $documents->getAuthUserId();
$userDocs = $documents->get_user_docs($userId);

$docsNames = array();


foreach ($userDocs as $doc) {
    $docName = basename($doc['path']);

    $docData = [
        "path" => $doc['path'],
        "name" => $docName,
        "id" => $doc['id'],
    ];

    array_push($docsNames, $docData);
}

$error = $_GET['error'] ?? false;

echo $twig->render('listPersonalFiles.html', [
    "error" => $error,
    "userDocs" => $docsNames,
    "logged" => $logged,
    "users" => $userList
]);
