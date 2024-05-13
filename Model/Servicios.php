<?php
class Servicios extends Conexion{
    public function get_servicios(){
        $conn=parent::conexion();
        $sql="SELECT * FROM servicios WHERE est=1";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_subCategoria_siem(){
        $conn=parent::conexion();
        $sql= "SELECT * FROM subCat_siem WHERE est = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_option_accion_concientizacion(){
        $conn=parent::conexion();
        $sql="SELECT * FROM accion_concientizacion WHERE est = 1";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}