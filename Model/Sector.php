<?php
class Sector extends Conexion{
    public function get_sector($id){
        $conn=parent::conexion();
        $sql="SELECT * FROM sector WHERE id = ?";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}