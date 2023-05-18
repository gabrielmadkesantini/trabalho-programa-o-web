<pre>
<?php

require("../utils/config.php");
require("../model/Permissions.php");
require("../model/Users.php");

$users = new Users();
$all_users = $users->get_all();



$permission = $_POST['permiss'] ?? [1];
$user_ids = $_POST['user'];

$organized_data = array();

foreach ($user_ids as $value) {
  $organized_data[$value] = 0;
  foreach ($permission as $permiss) {
    if ($value === $permiss) {
      $organized_data[$value] = 1;
    }
  }
}


$permiss =  new Permissions();

$permiss->permit($organized_data, $_POST['document']);

header("location:" . HTTP_URL . "controller/listPersonalFiles.php?error=3");
?>

</pre>