<?php

// error_reporting(0);

require_once("../utils/config.php");
require(BASE_URL . "utils/twig_config.php");
require("../model/Documents.php");

$date = $_POST['date'] ?? null;
$user_name = $_POST['name'] ?? null;
$file = $_POST['file'] ?? null;

$convert_data = strtotime($date);
$finally_converted_time =  date("Y-m-d", $convert_data);

var_dump($finally_converted_time);
if ($finally_converted_time === "1970-01-01") {
  $finally_converted_time = null;
}

$docs = new Documents();

session_start();
$id = $_SESSION['user'];
$where_formater = [
  "name" => "%{$user_name}%",
  "date" => $finally_converted_time,
  "file" => "%{$file}%",
  "id" => intval($id['id'])
];

$new_formated_data = array();

foreach ($where_formater as $key => $val) {
  if ($val !== null) {
    $new_formated_data[$key] = $val;
  }
}

$shared_files = $docs->get_all_docs($new_formated_data);
$real_date = date("d/m/Y", $shared_files["data_criacao"]);
echo $twig->render('listSharedFiles.html', [
  'shared' => $shared_files,
  'date' => $real_date
]);
