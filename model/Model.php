<?php

require("../vendor/autoload.php");


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
            $this->user,
            $this->password
        );
    }

    public function create($data)
    {

        $sql = $this->conex->prepare("INSERT INTO {$this->table} SET " . set_values($data));

        $sql->execute($data);

        return $data;
    }

    public function update(
        $targetFilePath,
        $idOwner,
        $idFile
    ) {

        $sql = $this->conex->prepare("UPDATE {$this->table} SET path = :path, users_id = :idOwner WHERE id = :id");

        $sql->bindParam("path", $targetFilePath);
        $sql->bindParam("idOwner", $idOwner);
        $sql->bindParam("id", $idFile);
        // $setClause = set_values($data);
        // $sql = $this->conex->prepare("UPDATE {$this->table} SET {$setClause} WHERE id = :id");


        // $sql->bindParam(":id", $id);

         $sql->execute();

        return $sql->errorInfo();


    }

    public function delete($id)
    {


        $sql = $this->conex->prepare("UPDATE {$this->table} SET ATIVO= 0 WHERE id=:id");

        $sql->bindParam(":id", $id);

        $sql->execute();

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
        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getData($email)
    {
        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE email=:email");
        $sql->bindParam(":email", $email);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function createToken($userId)
    {


        $payload = ["id" => $userId];

        $expires_in = 60 * 5;

        ini_set('session.gc_maxlifetime', $expires_in);
        session_start();
        $_SESSION['user'] = $payload;
    }

    public function auth()
    {
        if (isset($_SESSION['user'])) {
            return;
        } else {
            header('location: http://localhost/pw/trabalho-programa-o-web/controller/home.php?error=1');
        }
    }

    public function verifyLogged()
    {
        session_start();

        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getAuthUserId()
    {

        $userId = $_SESSION['user'];
        return $userId['id'];
    }

    public function get_shared_documents($userId)
    {

        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE userId = $userId");
        $sql->execute($userId);
        $resp = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $resp;
    }
}