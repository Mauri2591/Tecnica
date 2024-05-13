<?php
session_start();
 define("URL","http://localhost/Tecnica");
 
class Conexion{
    protected $conectar;
    protected function conexion(){
        try {
            $conn = $this->conectar = new PDO("mysql:host=localhost; dbname=tecnica", 'root', '');
            return $conn;
        } catch (\PDOException $e) {
            echo "Error".$e->getMessage();
            die();
        }
    }
}
