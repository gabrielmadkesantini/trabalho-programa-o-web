<?php



require("Model.php");


class Permissions extends Model
{

  public function permit($data, $id)
  {
    $sql = $this->conex->prepare("INSERT INTO {$this->table} SET document_id = :document_id, user_id = :user_id, permission = :permission");


    $define = array();

    foreach ($data as $key => $val) {
      if ($key !== "document_id") {
        $define[':document_id'] = intval($id);
        $define[':user_id'] = $key;
        $define[':permission'] = $val;
      //  var_dump($define);
        $sql->execute($define);
      }
    }
  }
}
