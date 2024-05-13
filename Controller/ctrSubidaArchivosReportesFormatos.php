<?php
require_once '../Config/Conexion.php';
require_once '../Model/SubidaArchivosReportesFormatos.php';

$xml_zap = new SubidaArchivosReportesFormatos();

// Verificar si se subió un archivo y si el parámetro 'tarea_id' está presente
if (isset($_FILES["nom_archivo"]) && !empty($_FILES["nom_archivo"]["name"]) && isset($_POST['tarea_id'])) {
    $tarea_id = $_POST['tarea_id'];

    // Verificar si se subió un archivo
    if (isset($_FILES["nom_archivo"]) && !empty($_FILES["nom_archivo"]["name"]) && isset($_POST['nom_herramienta'])) {
        if($_POST["nom_herramienta"] == "zap"){
            $xml_zap->procesar_archivo_xml_zap($_SESSION['usu_id'], "nom_archivo", $tarea_id,$_POST['nom_herramienta']);
        }else if($_POST["nom_herramienta"] == "nmap"){
            $xml_zap->procesar_archivo_xml_nmap($_SESSION['usu_id'], "nom_archivo", $tarea_id,$_POST['nom_herramienta']);
        }
    } else {
        echo "No se ha subido ningún archivo.";
    }
} else {
    echo "ok";
}
