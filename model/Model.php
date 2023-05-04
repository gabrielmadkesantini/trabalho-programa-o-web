<?php

class Model
{
    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'test';
    private $port = '3306';
    private $user = 'root';
    private $password = null;
    protected $table;
    protected $conex;


    public function __construct()
    {
        $tbl = strtolower(get_class($this));
        $tbl .= 's';
        $this->table = $tbl;

        $this->conex = new PDO(
            "{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbname}",
            $this->user, $this->password
        );
    }

    public function create($data)
    {

        $create = "INSERT INTO {$this->table}";

        foreach ($data as $key => $data) {
            $insert_values[] = "{$key} = :{$key}";
            $key_toinsert[] = "{$key}"; 
        }
        
        $convert_insert_values = implode(', ', $insert_values);
        $convert_keys_toinsert = implode(', ', $key_toinsert);


        $sql = $this->conex->prepare("INSERT INTO{$this->table}({$convert_insert_values}) VALUES($convert_keys_toinsert)");

        $sql->execute($data);
    }


}