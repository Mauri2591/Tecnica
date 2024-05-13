<?php
require '../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class Reportes extends Conexion
{
    public function get_primer_reporte($tarea_id)
    {
        try {
            $documento = new PhpWord();
            $section = $documento->addSection();

            $fuenteTitulo = [
                "name" => "Arial",
                "size" => 24,
                "color" => "405189",
                "bold" => true
            ];

            $fuenteTituloSegundo = [
                "name" => "Arial",
                "size" => 16,
                "color" => "405189",
                "bold" => true
            ];

            $fuente_subtitulo = [
                "name" => "Arial",
                "size" => 11,
                "color" => "405189",
                "bold" => true,
                "alignment" => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, // Alineación centrada
            ];

            $fuente_parrafo = [
                "name" => "Arial",
                "size" => 11,
                "color" => "313131",
                "italic" => false,
                "bold" => false,
                "alignment" => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, // Alineación centrada
            ];

            $fuente_num_tareas = [
                "name" => "Arial",
                "size" => 10,
                "color" => "6d7080",
                "italic" => false,
                "bold" => false,
            ];

            // Crear un estilo de párrafo para el texto justificado
            $estilo_parrafo_justificado = new PhpOffice\PhpWord\Style\Paragraph();
            $estilo_parrafo_justificado->setAlignment(\PhpOffice\PhpWord\SimpleType\Jc::BOTH); // Alineación justificada
            $documento->addParagraphStyle('parrafo_estilo_justificado', $estilo_parrafo_justificado); // Asignar el estilo de párrafo

            $documento->addTitleStyle(1, $fuenteTitulo);

            $section->addText("Informe de tareas realizadas", $fuenteTitulo, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $section->addText("Div. Seg. Informatica.", $fuenteTitulo, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $section->addTextBreak(3);
            
            
            $conn = parent::conexion();
            $sql = "SELECT actividades.*, tareas.servicio as id_servicio, tareas.descripcion as descripcion_tarea, tareas.gde as gde_tarea, sector.nombre_sector as sector,
            servicios.nombre AS servicio, servicios.descripcion AS servicio_descripcion,
            usuarios.nombre_usuario as usuario, tareas_finaliadas.gde as gde_cierre, tareas_finaliadas.fech_finalizacion as 				fech_finalizacion 
            FROM actividades 
            INNER JOIN tareas ON actividades.tarea_id = tareas.id 
            INNER JOIN sector ON tareas.sector = sector.id 
            INNER JOIN usuarios ON actividades.usu_id = usuarios.id 
            INNER JOIN servicios ON tareas.servicio = servicios.id 
            INNER JOIN tareas_finaliadas ON actividades.tarea_id=tareas_finaliadas.tarea_id
            WHERE actividades.tarea_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $tarea_id);
            $stmt->execute();
            $data = $stmt->fetchAll();

            $section->addTextBreak(1);

            $section->addText('Introduccion:', $fuente_subtitulo);
            $section->addText("Este informe proporciona un detalle de las tareas realizadas en el presente proyecto, incluyendo el tipo de servicio prestado, el nombre del colaborador involucrado, imágenes relevantes, fechas de realizacion y detalles específicos de cada tarea llevada a cabo. Dicha informacion se presenta como una valiosa guía para orientar las decisiones futuras en el desarrollo y gestión del proyecto.", $fuente_parrafo,array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

            $section->addText('Servicio realizado (' . $data[0]['servicio'] . '): ', $fuente_subtitulo);
            $section->addText($data[0]['servicio_descripcion'] . '.', $fuente_parrafo,array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

            $section->addText('Descripcion de la Tarea: ', $fuente_subtitulo);
            $section->addText($data[0]['descripcion_tarea'] == '' ? 'No posee descripcion' :  $data[0]['descripcion_tarea']. '.', $fuente_parrafo,array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

            $section->addText('Colaborador: ', $fuente_subtitulo);
            $section->addText($data[0]['usuario'],$fuente_parrafo);

            $section->addText('Sector: ', $fuente_subtitulo);
            $section->addText($data[0]['sector'],$fuente_parrafo);

            $section->addText('GDE solicitud: ',$fuente_subtitulo);
            $section->addText($data[0]['gde_tarea'] . '.', $fuente_parrafo);

            $section->addTextBreak(2);

            $section->addPageBreak();
            $section->addText("A continuacion se muestra un detalle de lo realizado en el proyecto.", $fuenteTituloSegundo,array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $section->addTextBreak(1);

            if ($data) {
                foreach ($data as $key => $row) {
                    $archivo_tarea = htmlspecialchars((string)$row['img_tarea'], ENT_COMPAT, 'UTF-8');
                    $descripcion = htmlspecialchars((string)$row['descripcion'], ENT_COMPAT, 'UTF-8');
                    $fech_crea = htmlspecialchars((string)$row['fech_crea'], ENT_COMPAT, 'UTF-8');

                    if (!empty($archivo_tarea) && file_exists('../Public/Uploads/' . $archivo_tarea)) {
                        $extension = pathinfo($archivo_tarea, PATHINFO_EXTENSION);
                        if ($extension === 'png' || $extension === 'jpeg' || $extension === 'jpg') {
                            $imageContent = file_get_contents('../Public/Uploads/' . $archivo_tarea);
                            $section->addText("Tarea " . ($key + 1),$fuente_num_tareas);
                            $section->addText($fech_crea == '' ? '' : "Fecha de realizacion: ($fech_crea)",$fuente_num_tareas);
                            $section->addText("Descripción: $descripcion",$fuente_parrafo,array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH)); // Descripción con alineación justificada
                            $section->addImage($imageContent, array('width' => 400, 'height' => 200));
                            $section->addTextBreak(2); // Agregar un espacio entre cada imagen y su descripción
                        } 
                        else if ($extension === 'pdf') {
                            $section->addText("Tarea " . ($key + 1),$fuente_num_tareas);
                            $section->addText($fech_crea == '' ? '' : "Fecha de realizacion: ($fech_crea)",$fuente_num_tareas);
                            $section->addText("Descripción: $descripcion",$fuente_parrafo,array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH)); // Descripción con alineación justificada
                            $pdfPath = 'C:/xampp/htdocs/Tecnica/Public/Uploads/' . $archivo_tarea;
                            $section->addLink($pdfPath, "Link PDF: $archivo_tarea", array('color' => '0000FF'));
                            $section->addTextBreak(2); // Agregar un espacio entre cada imagen y su descripción
                        } 
                        else {
                            $section->addText("No se puede mostrar el archivo: $archivo_tarea. Formato no compatible.");
                        }
                    } else {
                        $section->addText("Tarea " . ($key + 1),$fuente_num_tareas);
                        $section->addText($fech_crea == '' ? '' : "Fecha de realizacion: ($fech_crea)",$fuente_num_tareas);
                        $section->addText("Descripción: $descripcion",$fuente_parrafo,array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH)); // Descripción con alineación justificada
                        // $section->addText("No se encontró el archivo: $archivo_tarea", $fuente_parrafo);
                        $section->addTextBreak(2);
                    }
                }
                $section->addPageBreak();
                $section->addText('GDE cierre: ',$fuente_subtitulo);
                $section->addText($data[0]['gde_cierre'] . '.', $fuente_parrafo);
    
                $section->addText('Fecha de finalizacion del proyecto: ',$fuente_subtitulo);
                $section->addText($data[0]['fech_finalizacion'] . '.', $fuente_parrafo);
                $section->addTextBreak(2);
                $section->addLine(array('width' => 450));
            } else {
                $section->addText('No se encontraron registros ni datos');
            }

            $ruta = '../Public/Reportes/reporte_' . md5(uniqid(rand(), true)) . '.docx';
            $objWriter = IOFactory::createWriter($documento, "Word2007");
            $objWriter->save($ruta);
            return $ruta;
        } catch (\Exception $e) {
            throw new Exception("Error al generar reporte: " . $e->getMessage());
        }
    }
}
