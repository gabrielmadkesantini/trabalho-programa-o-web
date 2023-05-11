<?php


require("Model.php");

class Documents extends Model
{
  public function get_user_docs($id)
  {
    $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE ATIVO=1 AND USERID=$id");
    $sql->execute($id);

    $response = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $response;
  }

  public function get_all_docs()
  {
    $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE ATIVO=1");
    $sql->execute();
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $response;
  }

  public function get_filtred($data){
$sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE ATIVO=1 and ");
  }
}
