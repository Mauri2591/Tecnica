<?php
require_once '../Config/Conexion.php';
require_once '../Model/Escaneos.php';

if (isset($_POST['nom_herramienta']) && $_POST['nom_herramienta'] == "nmap") {
    $scanner_nmap= new Escaneos();
    if (isset($_POST['lista_de_ips'])) {

    $nom_herramienta= $_POST['nom_herramienta'];    
    $lista_de_ips= $_POST['lista_de_ips'];
    $tarea_id= $_POST['tarea_id'];  
    $usu_id= $_SESSION['usu_id'];
    
    $scanner_nmap->escaneo_nmap($usu_id,$tarea_id,$nom_herramienta,$lista_de_ips);
    }else{
        echo "Lista de IPs no especificada.";
    }
}
