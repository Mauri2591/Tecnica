<?php

class Escaneos extends Conexion{
    public function escaneo_nmap($usu_id,$tarea_id,$nom_herramienta,$lista_de_ips){
        $ips_replace= str_replace(",", " ", $lista_de_ips);
        $ips_array = explode(" ", $ips_replace);
        $nom_archivo = uniqid(true) . ".xml"; // Nombre único para el archivo de reporte XML
        $ruta_carpeta = 'C:\xampp\htdocs\Tecnica\Public\Uploads\Archivos_xml_nmap'; // Ruta de la carpeta donde se guardarán los archivos XML
        $ruta_archivo = "$ruta_carpeta/$nom_archivo"; // Ruta completa del archivo de reporte XML
        
        // Verificar si la carpeta existe, si no, crearla
        if (!is_dir($ruta_carpeta)) {
            if (!mkdir($ruta_carpeta, 0777, true)) {
                die("Error: No se pudo crear la carpeta.");
            }
        }
        $comando = '"C:\Program Files (x86)\Nmap\nmap.exe"';  // Ruta de instalación del Nmap
        // Concatenar las IPs al comando
        foreach ($ips_array as $ip) {
            $comando .= ' ' . $ip;
        }        
        $comando .= ' -A -v -n -oX ' . $ruta_archivo; // Agregar la ruta del archivo de reporte XML

        // Abrir el proceso para ejecutar el comando de Nmap
        $descriptorSpec = array(
            0 => array("pipe", "r"), // stdin 
            1 => array("pipe", "w"), // stdout 
            2 => array("pipe", "w")  // stderr 
        );

        $process = proc_open($comando, $descriptorSpec, $pipes);

        if (is_resource($process)) {
            // Leer la salida del proceso en tiempo real
            while ($line = fgets($pipes[1])) {
                // Envía la salida del proceso a la salida estándar (pantalla)
                echo($line);

                // Guarda la información en la
                // Puedes almacenar o procesar la salida como desees aquí
                // Por ejemplo, podrías enviarla a través de AJAX a la página web para mostrarla en tiempo real
                flush(); // Vacía el búfer de salida
            }

            // Cerrar el proceso
            proc_close($process);

            if(isset($nom_herramienta)){
                $conn=parent::conexion();
                $sql="INSERT INTO archivos_subidos (usu_id, tarea_id, nom_archivo,nom_herramienta,est) VALUES(?,?,?,?,0)";
                $stmt=$conn->prepare($sql);
                $stmt->bindParam(1,$usu_id);
                $stmt->bindParam(2,$tarea_id);
                $stmt->bindParam(3,$nom_archivo);
                $stmt->bindParam(4,$nom_herramienta);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }

        } else {
            echo "Error al ejecutar el comando.";
        }
    }
}