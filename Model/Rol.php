<?php

class Rol extends Conexion{
    public function get_roles(){
        $conn=parent::conexion();
        $sql="SELECT * FROM roles";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}