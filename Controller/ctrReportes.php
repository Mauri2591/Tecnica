<?php

require_once '../Config/Conexion.php';
require_once '../Model/Reportes.php';

$reporte = new Reportes();

switch ($_GET['op_reporte']) {

    case 'get_primer_reporte':
        try {
            $ruta_archivo = $reporte->get_primer_reporte($_POST['tarea_id']);
            if ($ruta_archivo) {
                // Obtener el nombre del archivo a partir de la ruta completa
                $nombre_archivo = basename($ruta_archivo);

                // Establecer los encabezados para la descarga del archivo
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment; filename=$nombre_archivo");

                // Enviamos el contenido del archivo
                readfile($ruta_archivo);
                exit();
            } else {
                // Mostrar un mensaje de error si no se pudo generar el archivo
                echo "Error al generar reporte: No se pudo generar el archivo";
            }
        } catch (\Exception $e) {
            // Mostrar un mensaje de error si ocurre una excepción
            echo "Error al generar reporte: " . $e->getMessage();
        }
        break;

    default:
        // Código para manejar otras operaciones, si es necesario
        break;
}
