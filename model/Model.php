<?php

class Model {
    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'test';
    private $port = '3306';
    private $user = 'root';
    private $password = null;
    protected $table;
    protected $conex;


public function __construct(){
    $tbl = strtolower(get_class($this));
    $tbl .= 's'; 
    $this->table = $tbl;

    $this->conex =new PDO("{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbname}",
    $this->user, $this->password);    
}

public function create(){
    $create = $this->connex->prepare("INSERT INTO {$this->table}")
}
}