<?php


require("Model.php");
require_once("../funcs/set_where_filter.php");

class Documents extends Model
{
  public function get_user_docs($id)
  {
    $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE users_id = :id AND ativo = 1");
    $sql->execute([':id' => $id]);
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $response;
  }

  public function get_all_docs($data)
  {

    $and = set_where_filter($data);

<<<<<<< HEAD

=======
>>>>>>> 42bcf7c21c12beddad2fa5cd2fc374bd9fc3e18c
    $sql = $this->conex->prepare("SELECT documents.path, documents.users_id, documents.data_criacao, documents.id,users.name, users.email FROM documents
      JOIN permissions on permissions.document_id = documents.id 
      JOIN users on documents.users_id = users.id where documents.ativo=1 and " . $and);

    $sql->execute($data);
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $response;
  }

  public function permission($data)
  {

    $sql = $this->conex->prepare("UPDATE {$this->table} SET permission = 1 WHERE ATIVO=1 AND userId=:id");
    $sql->bindParam(":id", $data);
    $sql->execute();
  }
}
