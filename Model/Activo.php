<?php

class Activo extends Conexion
{

    public function insert_activo(
        $usu_id,
        $id_tarea,
        $id_accion_concientizacion,
        $gde_activo,
        $ficha_activo,
        $nom_activo,
        $cantidad_activo,
        $descrip_activo,
        $COD_DEP_PFA
    ) {
        $conn = parent::conexion();
        $sql = "INSERT INTO activos (usu_id,id_tarea,id_accion_concientizacion,gde_activo,ficha_activo,nom_activo,
        cantidad_activo,descrip_activo,COD_DEP_PFA,fech_crea,est) VALUES (?,?,?,?,?,?,?,?,?,now(),1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usu_id);
        $stmt->bindValue(2, $id_tarea);
        $stmt->bindValue(3, $id_accion_concientizacion);
        $stmt->bindValue(4, $gde_activo);
        $stmt->bindValue(5, $ficha_activo);
        $stmt->bindValue(6, $nom_activo);
        $stmt->bindValue(7, $cantidad_activo);
        $stmt->bindValue(8, $descrip_activo);
        $stmt->bindValue(9, $COD_DEP_PFA);
        return $stmt->execute();
    }

    public function get_dependencia_para_activo($COD_DEP_PFA)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM codificador WHERE COD_DEP_PFA = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $COD_DEP_PFA);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function get_total_activos_dependencias($COD_DEP_PFA)
    {
        $conn = parent::conexion();
        $sql = "SELECT activos.*, cat_activo_concientizacion.nom_subcat AS subcat, usuarios.usuario 
        AS usuario_asignador, codificador.DESC_DEPENDENCIA_PFA as dependencia FROM activos 
        INNER JOIN cat_activo_concientizacion ON activos.id_accion_concientizacion=cat_activo_concientizacion.id 
        INNER JOIN usuarios ON activos.usu_id=usuarios.id INNER JOIN codificador 
        ON activos.COD_DEP_PFA=codificador.COD_DEP_PFA WHERE activos.COD_DEP_PFA = ? 
        AND activos.est=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $COD_DEP_PFA);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_categoria_activo(){
        $conn=parent::conexion();
        $sql="SELECT * FROM cat_activo_concientizacion WHERE est=1";
        $stmt=$conn->prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll();
    }
}
