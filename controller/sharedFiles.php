<?php

require_once("../utils/config.php");
require(BASE_URL . "utils/twig_config.php");
require("../model/Documents.php");

$date = $_POST['date'] ?? null;
$user_name = $_POST['user'] ?? null;
$file = $_POST['file'] ?? null;

$convert_data = strtotime($date);
$finally_converted_time =  date("Y-m-d H:i:s", $convert_data);

if ($finally_converted_time === "1970-01-01 01:00:00") {
  $finally_converted_time = null;
}

$docs = new Documents();

session_start();
$id = $_SESSION['user'];

$where_formater = [
  "name" => "%{$user_name}%",
  "date" => $finally_converted_time,
  "file" => "%{$file}",
  "id" => intval($id['id'])
];

$new_formated_data = array();

foreach ($where_formater as $key => $val) {
  if ($val !== null) {
    $new_formated_data[$key] = $val;
  }
}

$shared_files = $docs->get_all_docs($new_formated_data);

echo $twig->render('listSharedFiles.html', [
  'shared' => $shared_files
]);
