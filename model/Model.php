<?php

require("../funcs/set_values.php");

class Model
{
    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'pw';
    private $port = '3306';
    private $user = 'root';
    private $password = null;
    protected $table;
    protected $conex;


    public function __construct()
    {
        $tbl = strtolower(get_class($this));

        $this->table = $tbl;

        $this->conex = new PDO(
            "{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbname}",
            $this->user, $this->password
        );
    }

    public function create($data)
    {

        $sql = $this->conex->prepare("INSERT INTO {$this->table} SET " . set_values($data));

        $sql->execute($data);

        return $sql->errorInfo();

    }

    public function update($data)
    {

        $sql = $this->conex->prepare("UPDATE {$this->table} SET " . set_values($data) . "WHERE id=:id");
        $sql->execute($data);

        return $sql->errorInfo();
    }

    public function delete($id)
    {


        $sql = $this->conex->prepare("UPDATE {$this->table} SET ATIVO= 0 WHERE id=:id");

        $sql->execute($id);

        return $sql->errorInfo();
    }

    public function get_all()
    {

        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE ativo = 1");

        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_one($id)
    {
        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE ID=:id");

        $sql->execute($id);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}