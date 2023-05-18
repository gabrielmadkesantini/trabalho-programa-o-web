<?php



require_once("Model.php");


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
        var_dump($define);
        $sql->execute($define);
      }
    }
  }

  public function auth_shared($user_id, $document_id)
  {

    $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE user_id= :id and document_id=:id");
    $sql->bindParam(':id', $user_id);
    $sql->bindParam(':id', $document_id);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($result['permissions'] === 1) {
      return true;
    } else {
      return false;
    }
  }
}
