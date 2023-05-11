<?php

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;


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


        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE userId = $userId");
        $sql->execute($userId);
        $permissions = $sql->fetchAll(PDO::FETCH_ASSOC);

        $payload = ["id" => $userId];
        $permiss = [];

        foreach ($permissions as $perm) {
            array_push($permiss, $perm);
        }
        $payload['permissions'] = $permiss;


        $expires_in = 60 * 5;

        ini_set('session.gc_maxlifetime', $expires_in);
        session_start();
        $_SESSION['user'] = $payload;
    }

    public function auth()
    {
        $identify = $_SESSION['user'];


        $sql = $this->conex->prepare("SELECT * {$this->table} WHERE ATIVO = 1 AND ID={$identify['id']}");
        $sql->execute($identify['id']);
        $resp = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($resp)) {
            return "auth";
        } else {
            return "notAuth";
        }
    }
}
