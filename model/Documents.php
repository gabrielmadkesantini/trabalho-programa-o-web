<?php


require("Model.php");

class Documents extends Model
{
  public function get_user_docs($id)
  {
    $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE users_id = :id");
    $sql->execute([':id' => $id]);
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $response;
  }

  public function get_all_docs($id)
  {

    $and = 0;
    if ($id) {
      $and = "and permissions.user_id=:id";
    } else {
      $and = "";
    }

    $sql = $this->conex->prepare("SELECT documents.path, users.name, users.email FROM documents
    JOIN permissions on permissions.document_id = documents.id 
    JOIN users on documents.users_id = users.id where ativo=1 " . $and);
    if ($id) {
      $sql->execute([':id' => $id]);
    } else {
      $sql->execute();
    }
    
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $response;
  }

  public function permission($data)
  {

    $sql = $this->conex->prepare("UPDATE {$this->table} SET permission = 1 WHERE ATIVO=1 AND userId=:id");
    $sql->bindParams(":id", $data);
    $sql->execute();
  }


}