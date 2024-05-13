<?php
class Tareas extends Conexion
{

    public function get_datos_tarea($id)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM tareas WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insertTarea($gde, $COD_DEP_PFA, $servicio, $id_accion_concientizacion,$id_subcat_siem, $operador, $analista, $sector, $descripcion,$ips,$urls, $estado)
    {
        $conn = parent::conexion();
        $sql = "INSERT INTO tareas (gde,COD_DEP_PFA,servicio,id_accion_concientizacion,id_subcat_siem,operador,analista,sector,descripcion,ips,urls,fech_crea,estado,est) VALUES (?,?,?,?,?,?,?,?,?,?,?,now(),?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $gde);
        $stmt->bindParam(2, $COD_DEP_PFA);
        $stmt->bindParam(3, $servicio);
        $stmt->bindParam(4, $id_accion_concientizacion);
        $stmt->bindParam(5, $id_subcat_siem);
        $stmt->bindParam(6, $operador);
        $stmt->bindValue(7, $analista);
        $stmt->bindParam(8, $sector);
        $stmt->bindParam(9, $descripcion);
        $stmt->bindParam(10, $ips);
        $stmt->bindParam(11, $urls);
        $stmt->bindParam(12, $estado);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function get_total_tareas_vista_carga()
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, servicios.nombre AS nombre_servicio, 
        operador_usuario.nombre_usuario AS operador, 
        analista_usuario.nombre_usuario AS analista, 
        sector.nombre_sector 
        FROM tareas 
        INNER JOIN servicios ON tareas.servicio = servicios.id 
        INNER JOIN usuarios AS operador_usuario ON tareas.operador = operador_usuario.id 
        INNER JOIN usuarios AS analista_usuario ON tareas.analista = analista_usuario.id 
        INNER JOIN sector ON tareas.sector = sector.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_tareas_activas_x_sector($sector_id)
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, 
        servicios.nombre AS nombre_servicio, 
        servicios.descripcion AS servicio_descripcion, 
        operador_usuario.nombre_usuario AS operador, 
        analista_usuario.nombre_usuario AS analista_nombre, 
        sector.nombre_sector 
        FROM tareas 
        INNER JOIN servicios ON tareas.servicio = servicios.id 
        INNER JOIN usuarios AS operador_usuario ON tareas.operador = operador_usuario.id 
        INNER JOIN usuarios AS analista_usuario ON tareas.analista = analista_usuario.id 
        INNER JOIN sector ON tareas.sector = sector.id 
        WHERE sector.id = ? 
        AND (estado='En Proceso' OR estado='Pendiente')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $sector_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_tareas_finalizadas_x_sector($sector_id)
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, 
        servicios.nombre AS nombre_servicio, 
        servicios.descripcion AS servicio_descripcion, 
        operador_usuario.nombre_usuario AS operador, 
        analista_usuario.nombre_usuario AS analista_nombre, 
        sector.nombre_sector, 
        tareas_finaliadas.gde as gde_cierre,
        tareas_finaliadas.fech_finalizacion as fech_finalizacion
        FROM tareas  
        INNER JOIN servicios ON tareas.servicio = servicios.id 
        INNER JOIN usuarios AS operador_usuario ON tareas.operador = operador_usuario.id  
        INNER JOIN usuarios AS analista_usuario ON tareas.analista = analista_usuario.id 
        INNER JOIN sector ON tareas.sector = sector.id 
        INNER JOIN (SELECT tarea_id, MAX(actividades.id) AS ultima_actividad_id FROM actividades GROUP BY tarea_id) AS ultima_actividad 
            ON tareas.id = ultima_actividad.tarea_id  
        INNER JOIN actividades ON ultima_actividad.ultima_actividad_id = actividades.id 
        LEFT JOIN (SELECT tarea_id, gde, fech_finalizacion 
                FROM tareas_finaliadas 
                GROUP BY tarea_id) AS tareas_finaliadas
            ON tareas.id = tareas_finaliadas.tarea_id 
        WHERE sector.id = ?
            AND tareas.estado IN ('Finalizada', 'Cancelada')
        GROUP BY tareas.id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $sector_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_tareas_finalizadas_x_todos_los_sectores_final()
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, servicios.nombre AS nombre_servicio, servicios.descripcion AS servicio_descripcion, 
        operador_usuario.nombre_usuario AS operador, analista_usuario.nombre_usuario 
        AS analista_nombre, sector.nombre_sector, actividades.gde as gde_cierre FROM tareas INNER JOIN servicios 
        ON tareas.servicio = servicios.id INNER JOIN usuarios AS operador_usuario 
        ON tareas.operador = operador_usuario.id INNER JOIN usuarios AS analista_usuario 
        ON tareas.analista = analista_usuario.id INNER JOIN sector ON tareas.sector = sector.id 
        INNER JOIN actividades ON tareas.id=actividades.tarea_id WHERE (estado='Finalizada' OR estado='Cancelada')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_tareas_finalizadas_x_todos_los_sectores()
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, servicios.nombre AS nombre_servicio, servicios.descripcion AS servicio_descripcion, 
        operador_usuario.nombre_usuario AS operador, analista_usuario.nombre_usuario 
        AS analista_nombre, sector.nombre_sector FROM tareas INNER JOIN servicios 
        ON tareas.servicio = servicios.id INNER JOIN usuarios AS operador_usuario 
        ON tareas.operador = operador_usuario.id INNER JOIN usuarios AS analista_usuario 
        ON tareas.analista = analista_usuario.id INNER JOIN sector ON tareas.sector = sector.id 
        WHERE estado='Finalizada' OR estado='Cancelada'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_total_tareas_activas_x_tecnica()
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, servicios.nombre AS nombre_servicio, 
        operador_usuario.nombre_usuario AS operador, 
        analista_usuario.nombre_usuario AS analista, 
        sector.nombre_sector 
        FROM tareas 
        INNER JOIN servicios ON tareas.servicio = servicios.id 
        INNER JOIN usuarios AS operador_usuario ON tareas.operador = operador_usuario.id 
        INNER JOIN usuarios AS analista_usuario ON tareas.analista = analista_usuario.id 
        INNER JOIN sector ON tareas.sector = sector.id 
        WHERE estado = 'abierto' AND sector.id = 2";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_tarea_x_analista($id, $analista)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM tareas WHERE id=? AND analista=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $analista);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_tarea_x_analista_detalle($id)
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, accion_concientizacion.nom_subCat as subcat_concientizacion, servicios.nombre 
        AS nombre_servicio, operador.nombre_usuario AS usuario_operador, subcat_siem.nom_subCat 
        as sub_cat_siem, analista.nombre_usuario AS usuario_analista, codificador.DESC_DEPENDENCIA_PFA 
        AS dependencia, siem.contador as contador FROM tareas LEFT JOIN accion_concientizacion 
        ON tareas.id_accion_concientizacion=accion_concientizacion.id LEFT JOIN subcat_siem 
        ON tareas.id_subcat_siem=subcat_siem.id INNER JOIN servicios ON tareas.servicio = servicios.id 
        INNER JOIN codificador ON tareas.COD_DEP_PFA=codificador.COD_DEP_PFA INNER JOIN usuarios 
        AS operador ON tareas.operador = operador.id INNER JOIN usuarios AS analista ON tareas.analista = analista.id 
        LEFT JOIN siem ON tareas.id=siem.tarea_id WHERE tareas.id =?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_actividades_x_tarea($tarea_id)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM actividades WHERE tarea_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $tarea_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update_estado_en_proceso_tarea_x_analista($id)
    {
        $conn = parent::conexion();
        $sql = "UPDATE tareas SET estado='En proceso' WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_total_tareas_para_actualizar_vistas()
    {
        $conn = parent::conexion();
        $sql = "SELECT tareas.*, tareas_finaliadas.fech_finalizacion FROM tareas 
        LEFT JOIN tareas_finaliadas ON tareas.id=tareas_finaliadas.tarea_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_actividad($usu_id, $descripcion, $img_tarea, $img_base64, $tarea_id, $est)
    {
        $conn = parent::conexion();
        $sql = "INSERT INTO actividades (usu_id, descripcion, img_base64, img_tarea, tarea_id, fech_crea, est) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usu_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $descripcion, PDO::PARAM_STR);
        $stmt->bindValue(3, $img_tarea, PDO::PARAM_STR); // Aquí se pasa la ruta del archivo
        $stmt->bindValue(4, $img_base64, PDO::PARAM_STR); // Aquí se pasa la imagen en base64
        $stmt->bindValue(5, $tarea_id, PDO::PARAM_INT);
        $stmt->bindValue(6, $est, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount(); // Retorna la cantidad de filas afectadas por la inserción
    }

    public function get_datos_actividades_x_analista($tarea_id, $usu_id)
    {
        $conn = parent::conexion();
        $sql = "SELECT actividades.*, tareas.estado, tareas_finaliadas.gde as descripcion_cierre, 
        tareas_finaliadas.fech_finalizacion FROM actividades LEFT JOIN tareas_finaliadas 
        ON actividades.tarea_id=tareas_finaliadas.tarea_id INNER JOIN tareas ON actividades.tarea_id=tareas.id 
        WHERE actividades.tarea_id=? AND actividades.usu_id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $tarea_id);
        $stmt->bindParam(2, $usu_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_datos_total_actividades_x_analista_todos_los_sectores($tarea_id)
    {
        $conn = parent::conexion();
        $sql = "SELECT actividades.*, tareas.estado FROM actividades INNER JOIN tareas ON actividades.tarea_id=tareas.id WHERE tareas.id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $tarea_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function finalizar_tarea($usu_id, $tarea_id, $gde)
    {
        $conn = parent::conexion();
        $sql = "INSERT INTO tareas_finaliadas(usu_id,tarea_id,gde,est) VALUES(?,?,?,1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usu_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $tarea_id, PDO::PARAM_INT);
        $stmt->bindValue(3, $gde, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update_finalizar_tarea($id)
    {
        $conn = parent::conexion();
        $sql = "UPDATE tareas SET estado='Finalizada' WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_total_tareas_grafico()
    {
        $conn = parent::conexion();
        $sql = "SELECT COUNT(*) as total, servicios.nombre AS servicio FROM tareas INNER JOIN servicios 
        ON tareas.servicio=servicios.id where tareas.estado='Finalizada' GROUP BY servicio";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_total_tareas()
    {
        $conn = parent::conexion();
        $sql = "SELECT 
        tareas.*, 
        tareas_finaliadas.gde AS gde_finalizacion, 
        tareas_finaliadas.fech_finalizacion,
        codificador.DESC_DEPENDENCIA_PFA as dependencia,
        servicios.nombre AS nombre_servicio, 
        operador_usuario.nombre_usuario AS nombre_operador, 
        analista_usuario.nombre_usuario AS nombre_analista, 
        sector.nombre_sector 
    FROM 
        tareas 
    INNER JOIN 
        servicios ON tareas.servicio = servicios.id 
        INNER JOIN codificador ON tareas.COD_DEP_PFA=codificador.COD_DEP_PFA
    INNER JOIN 
        usuarios AS operador_usuario ON tareas.operador = operador_usuario.id 
    INNER JOIN 
        usuarios AS analista_usuario ON tareas.analista = analista_usuario.id 
    INNER JOIN 
        sector ON tareas.sector = sector.id 
    LEFT JOIN 
        tareas_finaliadas ON tareas.id = tareas_finaliadas.tarea_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_dependencias($desc_dependencia_pfa)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM codificador WHERE LOWER(DESC_DEPENDENCIA_PFA) LIKE ?";
        $stmt = $conn->prepare($sql);
        $param1 = "%" . strtolower($desc_dependencia_pfa) . "%";
        $stmt->bindParam(1, $param1, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_dependenciasPorCodigo($cod_dep_pfa)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM codificador WHERE LOWER(cod_dep_pfa) LIKE ?";
        $stmt = $conn->prepare($sql);
        $param1 = "%" . strtolower($cod_dep_pfa) . "%";
        $stmt->bindParam(1, $param1, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_nombre_xml_zap_almacenado($tarea_id,$nom_archivo)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM archivos_subidos WHERE tarea_id=? AND nom_herramienta='zap' AND usu_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->bindParam(2, $nom_archivo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_nombre_xml_nmap_almacenado($tarea_id,$nom_archivo)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM archivos_subidos WHERE tarea_id=? AND usu_id=? AND nom_herramienta='nmap' AND est=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->bindParam(2, $nom_archivo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update_xml_nmap_almacenado_scanner($tarea_id,$usu_id){ //Se crea con el scanner y luego con el boton procesar se pasa a estado=1
        $conn = parent::conexion();
        $sql = "UPDATE archivos_subidos SET est=1 WHERE tarea_id=? AND usu_id=? AND nom_herramienta='nmap' AND est=0";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->bindParam(2, $usu_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function simplexml_load_file($nom_archivo){
        // Construye la ruta completa al archivo XML
        $ruta = URL . "/Public/Uploads/Archivos_xml_zap/" . $nom_archivo;
    
        // Intenta cargar el archivo XML y devolver un objeto SimpleXMLElement
        $xml = simplexml_load_file($ruta);
    
        // Verificar si la carga del XML fue exitosa
        if ($xml !== false) {
            // Devolver el objeto SimpleXMLElement si la carga fue exitosa
            return $xml;
        } else {
            // Si la carga falla, devuelve false o lanza una excepción según lo desees
            return false;
        }
    }

    public function simplexml_load_file_nmap($nom_archivo){
        // Construye la ruta completa al archivo XML
        $ruta = URL . "/Public/Uploads/Archivos_xml_nmap/" . $nom_archivo;
    
        // Intenta cargar el archivo XML y devolver un objeto SimpleXMLElement
        $xml = simplexml_load_file($ruta);
    
        // Verificar si la carga del XML fue exitosa
        if ($xml !== false) {
            // Devolver el objeto SimpleXMLElement si la carga fue exitosa
            return $xml;
        } else {
            // Si la carga falla, devuelve false o lanza una excepción según lo desees
            return false;
        }
    }

    public function validar_si_se_subio_archivo_xml_zap($tarea_id,$nom_herramienta){
        $conn=parent::conexion();
        $sql="SELECT * FROM archivos_subidos WHERE tarea_id=? AND nom_herramienta=?";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1, $tarea_id);
        $stmt->bindParam(2, $nom_herramienta);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function validar_si_se_subio_archivo_xml_nmap($tarea_id,$nom_herramienta){
        $conn=parent::conexion();
        $sql="SELECT * FROM archivos_subidos WHERE tarea_id=? AND nom_herramienta=?";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1, $tarea_id);
        $stmt->bindParam(2, $nom_herramienta);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function get_archivos_xml($tarea_id, $nom_herramienta){
        $conn=parent::conexion();
        $sql="SELECT * FROM archivos_subidos WHERE tarea_id=? AND nom_herramienta=? AND est=1";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->bindParam(2,$nom_herramienta);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function eliminarXml($tarea_id,$nom_herramienta){
        $conn=parent::conexion();
        $sql="DELETE FROM archivos_subidos WHERE tarea_id=? AND nom_herramienta=?";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->bindParam(2,$nom_herramienta);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_datos_tarea_finalizada($tarea_id){
        $conn=parent::conexion();
        $sql="SELECT * FROM tareas_finaliadas WHERE tarea_id=?";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function delete_actividad($id){
        $conn=parent::conexion();
        $sql="DELETE FROM actividades WHERE id=?";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_datos_siem($tarea_id){
        $conn=parent::conexion();
        $sql="SELECT * FROM siem WHERE tarea_id=? AND est=1";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->execute();
        return $result= $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert_datos_siem($tarea_id,$fecha_evento,$nom_incidencia,$event_name,$reporting_device,$reporting_model,$source_ip,$destination_ip,$process_path,$process_name,$url,$information_url,$contador){
        $conn=parent::conexion();
        $sql="INSERT INTO siem(tarea_id,fecha_evento,nom_incidencia,event_name,reporting_device,reporting_model,source_ip,destination_ip,process_path,process_name,url,information_url,contador,fech_crea,est)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,now(),1)";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(1,$tarea_id);
        $stmt->bindParam(2,$fecha_evento);
        $stmt->bindParam(3,$nom_incidencia);
        $stmt->bindParam(4,$event_name);
        $stmt->bindParam(5,$reporting_device);
        $stmt->bindParam(6,$reporting_model);
        $stmt->bindParam(7,$source_ip);
        $stmt->bindParam(8,$destination_ip);
        $stmt->bindParam(9,$process_path);
        $stmt->bindParam(10,$process_name);
        $stmt->bindParam(11,$url);
        $stmt->bindParam(12,$information_url);
        $stmt->bindParam(13,$contador);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function get_total_dependencias(){
        $conn=parent::conexion();
        $sql="SELECT id, COD_DEP_PFA, DESC_DEPENDENCIA_PFA, DESC_CALLE, SUPER FROM codificador";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function get_datos_x_dependnecia($COD_DEP_PFA){
        $conn=parent::conexion();
        $sql="SELECT * FROM codificador WHERE COD_DEP_PFA=?";
        $stmt=$conn->prepare($sql);
        $stmt->bindValue(1,$COD_DEP_PFA);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}



