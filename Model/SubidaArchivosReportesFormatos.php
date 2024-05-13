<?php
class SubidaArchivosReportesFormatos extends Conexion
{
    public function procesar_archivo_xml_zap($usu_id, $nom_archivo, $tarea_id, $nom_herramienta)
    {
        $ruta = "../Public/Uploads/Archivos_xml_zap/";
        $nombre_archivo = uniqid() . ".xml";
        $archivo_temporal = $_FILES[$nom_archivo]['tmp_name'];

        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $conn = parent::conexion();
        $sql = "INSERT INTO archivos_subidos (usu_id,tarea_id, nom_archivo, nom_herramienta, fech_crea, est) VALUES (?, ?, ?, ?,NOW(), 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usu_id);
        $stmt->bindValue(2, $tarea_id);
        $stmt->bindValue(3, $nombre_archivo);
        $stmt->bindValue(4, $nom_herramienta);
        $stmt->execute();

        // Mover el archivo subido a la ubicación deseada
        if (move_uploaded_file($archivo_temporal, $ruta . $nombre_archivo)) {
            header("Location:" . URL . "/View/Home/Trabajos/?tarea=" . $tarea_id);
            exit();
        } else {
            echo "Error al subir el archivo.";
        }
    }

    public function procesar_archivo_xml_nmap($usu_id, $nom_archivo, $tarea_id, $nom_herramienta)
    {
        $ruta = "../Public/Uploads/Archivos_xml_nmap/";
        $nombre_archivo = uniqid() . ".xml";
        $archivo_temporal = $_FILES[$nom_archivo]["tmp_name"];
        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $conn = parent::conexion();
        $sql = "INSERT INTO archivos_subidos (usu_id,tarea_id, nom_archivo, nom_herramienta, fech_crea, est) VALUES (?, ?, ?, ?,NOW(), 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $usu_id);
        $stmt->bindValue(2, $tarea_id);
        $stmt->bindValue(3, $nombre_archivo);
        $stmt->bindValue(4, $nom_herramienta);
        $stmt->execute();

        if (move_uploaded_file($archivo_temporal, $ruta . $nombre_archivo)) {
            header("Location:" . URL . "/View/Home/Trabajos/?tarea=" . $tarea_id);
            exit();
        } else {
            echo "Error al subir archivo xml Nmap";
        }
    }
}
