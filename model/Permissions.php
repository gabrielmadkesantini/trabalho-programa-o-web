<?php

require("Model.php");


class Permissions extends Model
{

  public function permit($data)
  {
    $sql = $this->conex->prepare("INSERT INTO {$this->table} SET document_id = :document_id, user_id = :user_id, permission = :permission");

    var_dump($data);

    $define = array();

    $define[':document_id'] = intval($data['document_id']);
    foreach ($data as $key => $val) {
      if ($key !== "document_id") {
        $define[':user_id'] = $key;
        $define[':permissions'] = $val;
        var_dump($define);
        $sql->execute($define);
      }
    }
  }
}
