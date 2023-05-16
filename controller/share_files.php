<pre>
<?php

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
$organized_data['document_id'] = $_POST['document'];


$permiss =  new Permissions();
$permiss->permit($organized_data);

?>

</pre>






// $permission = new Permissions();

// $permissions->auth();
// $permission->create([]);