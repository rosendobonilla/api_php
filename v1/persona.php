<?php
class Persona{
 
    private $conn;
    private $table_name = "persona";
 
    public $id;
    public $nombre;
    public $apellido;
    public $direccion;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
 
    $query = "  SELECT
                *
                FROM
                " . $this->table_name;
 
    $stmt = $this->conn->prepare($query);
 
    $stmt->execute();
 
    return $stmt;
    }
}