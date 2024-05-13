<?php
require_once '../Config/Conexion.php';
require_once '../Model/Tareas.php';

$tarea = new Tareas();

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

switch ($_GET['op_tarea']) {

    case 'get_datos_tarea':
        echo json_encode($tarea->get_datos_tarea($_POST['id']));
        break;

    case 'insertTarea':
        $tarea->insertTarea(
            $_POST['gde'],
            $_POST['COD_DEP_PFA'],
            $_POST['servicio'],
            $_POST['id_accion_concientizacion'],
            $_POST['id_subcat_siem'],
            $_POST['operador'],
            $_POST['analista'],
            $_POST['sector'],
            $_POST['descripcion'],
            $_POST['ips'],
            $_POST['urls'],
            $_POST['estado']
        );
        break;

    case 'get_total_tareas_para_actualizar_vistas':
        echo json_encode($tarea->get_total_tareas_para_actualizar_vistas());
        break;

    case 'get_total_tareas_vista_carga':
        echo json_encode($tarea->get_total_tareas_vista_carga());
        break;

    case 'get_total_tareas_activas_x_sector':
        echo json_encode($tarea->get_total_tareas_activas_x_sector($_POST['sector_id']));
        break;

    case 'get_total_tareas_finalizadas_x_sector':
        echo json_encode($tarea->get_total_tareas_finalizadas_x_sector($_POST['sector_id']));
        break;

    case 'get_total_tareas_finalizadas_x_todos_los_sectores_final':
        echo json_encode($tarea->get_total_tareas_finalizadas_x_todos_los_sectores_final());
        break;

    case 'get_total_tareas_activas_x_tecnica':
        echo json_encode($tarea->get_total_tareas_activas_x_tecnica());
        break;

    case 'get_tarea_x_analista':
        echo json_encode($tarea->get_tarea_x_analista($_POST['id'], $_SESSION['usu_id']));
        break;

    case 'get_total_tareas_finalizadas_x_todos_los_sectores':
        echo json_encode($tarea->get_total_tareas_finalizadas_x_todos_los_sectores());
        break;

    case 'get_tarea_x_analista_detalle':
        $data = $tarea->get_tarea_x_analista_detalle($_POST['id']);
        echo json_encode($tarea->get_tarea_x_analista_detalle($_POST['id']));
        break;

    case 'insert_actividad':
        $ruta_img = "../Public/Uploads"; // Ruta donde se guardarán las imágenes
        if (!is_dir($ruta_img)) {
            mkdir($ruta_img, 0777);
        }
        if (isset($_FILES["img_tarea"])) {
            // Asignar nombre de archivo basado en el tipo MIME
            if ($_FILES['img_tarea']['type'] == 'image/jpeg') {
                $nom_img = md5(uniqid(rand(0, 9999))) . ".jpeg";
            } else if ($_FILES['img_tarea']['type'] == 'image/jpg') {
                $nom_img = md5(uniqid(rand(0, 9999))) . ".jpg";
            } else if ($_FILES['img_tarea']['type'] == 'image/png') {
                $nom_img = md5(uniqid(rand(0, 9999))) . ".png";
            } else if ($_FILES['img_tarea']['type'] == 'application/pdf') {
                $nom_img = md5(uniqid(rand(0, 9999))) . ".pdf";
            }
            // Construir la ruta completa del archivo
            $ruta_completa = $ruta_img . "/" . $nom_img;

            // Mover el archivo a la carpeta de destino
            $img_tarea = move_uploaded_file($_FILES['img_tarea']['tmp_name'], $ruta_completa);

            // Verificar si la carga fue exitosa antes de insertar en la base de datos
            if ($img_tarea) {
                $tarea->insert_actividad($_SESSION['usu_id'], strip_tags($_POST['descripcion']), '', $nom_img, $_POST['tarea_id'], $_POST['est']);
                echo "Archivo subido correctamente";
            } else if ($img_tarea == UPLOAD_ERR_NO_FILE) {
                echo "Error al subir el archivo";
            }
        } elseif (isset($_POST["img_base64"])) {
            // Obtener la imagen en base64 y decodificarla
            $img_base64 = $_POST["img_base64"];
            $img_base64 = str_replace('data:image/png;base64,', '', $img_base64);
            $img_base64 = str_replace(' ', '+', $img_base64);
            $img_data = base64_decode($img_base64);

            // Asignar nombre de archivo basado en el tipo MIME
            $nom_img = md5(uniqid(rand(0, 9999))) . ".png";
            $ruta_completa = $ruta_img . "/" . $nom_img;

            // Guardar la imagen en el servidor
            if (file_put_contents($ruta_completa, $img_data)) {
                $tarea->insert_actividad($_SESSION['usu_id'], strip_tags($_POST['descripcion']), $img_base64, $nom_img, $_POST['tarea_id'], $_POST['est']);
                echo "Archivo en base64 subido correctamente";
            } else {
                echo "Error al subir el archivo en base64";
            }
        } else {
            $tarea->insert_actividad($_SESSION['usu_id'], strip_tags($_POST['descripcion']), '', '', $_POST['tarea_id'], $_POST['est']);
            echo "Actividad insertada correctamente";
        }
        break;

    case 'get_actividades_x_tarea':
        echo json_encode($tarea->get_actividades_x_tarea($_POST['tarea_id']));
        break;

    case 'get_finalizacion_tarea':
        echo json_encode($tarea->get_datos_actividades_x_analista($_POST['tarea_id'], $_SESSION['usu_id']));
        break;

    case 'get_datos_tarea_finalizada':
        echo json_encode($tarea->get_datos_tarea_finalizada($_POST['tarea_id']));
        break;

    case 'get_datos_actividades_x_analista':
        if ($_SESSION['id_sector'] == 4) {
            $datos = $tarea->get_datos_total_actividades_x_analista_todos_los_sectores($_POST['tarea_id']);
            if (is_array($datos) && count($datos) > 0) {
                foreach ($datos as $key => $row) {
                    if (isset($row['img_tarea'])) {
?>
                        <div class="d-flex mb-0 p-0">
                            <div class="flex-shrink-0">
                                <img src="<?php echo URL; ?>/Public/velzon/assets/images/userPolice.png" alt="Usuario pfa" class="avatar-xs rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2 p-0">
                                <h5 class="fs-13"><small class="text-muted"><?php echo $row['fech_crea']; ?></small></h5>

                                <p style="font-size: 14px;"><?php echo $row['descripcion']; ?></p>

                                <?php if ($row['estado'] === "En proceso") : ?>
                                    <div style="display: flex; justify-content: end;"><span id="btn_eliminar_actividad" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar actividad" onclick="eliminarActividad(<?php echo  $row['id'] ?>)"><i class="ri-delete-bin-5-fill fs-20 text-danger"></i></span> </div>
                                <?php elseif ($row['estado'] === "Finalizada") : ?>
                                    <div style="display: flex; justify-content: end;"></div>
                                <?php endif; ?>

                                <span class="badge badge-soft-success fs-12"><i class="fs-13 align-middle me-1"></i><?php echo ($key + 1); ?><span></span></span>
                                <div class="card-header">
                                    <?php if (!empty($row['img_tarea'])) : ?>
                                        <div class="card-header">
                                            <iframe src="<?php echo URL . "/Public/Uploads/" . $row['img_tarea'] ?>?embedded=true" width="100%" height="300" style="border: none;"></iframe>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($row['gde'])) {
                                ?>
                                    <p style="font-size: 14px;">N° GDE de finalización: <?php echo $row['gde']; ?></p>
                                <?php
                                } ?>
                                <hr>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="d-flex mb-0 p-0">
                            <div class="flex-shrink-0">
                                <img src="<?php echo URL; ?>/Public/velzon/assets/images/userPolice.png" alt="Usuario pfa" class="avatar-xs rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2 p-0">
                                <h5 class="fs-13"><small class="text-muted"><?php echo $row['fech_crea']; ?></small></h5>

                                <p style="font-size: 14px;"><?php echo $row['descripcion']; ?></p>

                                <?php if ($row['estado'] === "En proceso") : ?>
                                    <div style="display: flex; justify-content: end;"><span id="btn_eliminar_actividad" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar actividad" onclick="eliminarActividad(<?php echo  $row['id'] ?>)"><i class="ri-delete-bin-5-fill fs-20 text-danger"></i></span> </div>
                                <?php elseif ($row['estado'] === "Finalizada") : ?>
                                    <div style="display: flex; justify-content: end;"></div>
                                <?php endif; ?>

                                <?php if (!empty($row['gde'])) {
                                ?>
                                    <p style="font-size: 14px;">N° GDE de finalización: <?php echo $row['gde']; ?></p>
                                <?php
                                } ?> <span class="badge badge-soft-success fs-12"><i class="fs-13 align-middle me-1"></i><?php echo ($key + 1); ?><span></span></span>
                                <hr>
                            </div>
                        </div>
                    <?php
                    }
                }
            }
        } else {
            $datos = $tarea->get_datos_actividades_x_analista($_POST['tarea_id'], $_SESSION['usu_id']);
            if (is_array($datos) && count($datos) > 0) {
                foreach ($datos as $key => $row) {
                    if (isset($row['img_tarea']) && isset($row['estado'])) {
                    ?>
                        <div class="d-flex mb-0 p-0">
                            <div class="flex-shrink-0">
                                <img src="<?php echo URL; ?>/Public/velzon/assets/images/userPolice.png" alt="Usuario pfa" class="avatar-xs rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2 p-0">
                                <h5 class="fs-13"><small class="text-muted"><?php echo $row['fech_crea']; ?></small></h5>

                                <p style="font-size: 14px;"><?php echo $row['descripcion']; ?></p>


                                <?php if ($row['estado'] === "En proceso") : ?>
                                    <div style="display: flex; justify-content: end;"><span id="btn_eliminar_actividad" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar actividad" onclick="eliminarActividad(<?php echo  $row['id'] ?>)"><i class="ri-delete-bin-5-fill fs-20 text-danger"></i></span> </div>
                                <?php elseif ($row['estado'] === "Finalizada") : ?>
                                    <div style="display: flex; justify-content: end;"></div>
                                <?php endif; ?>

                                <?php if (!empty($row['gde'])) {
                                ?>
                                    <p style="font-size: 14px;">N° GDE de finalización: <?php echo $row['gde']; ?></p>
                                <?php
                                } ?> <span class="badge badge-soft-success fs-12"><i class="fs-13 align-middle me-1"></i><?php echo ($key + 1); ?><span></span></span>
                                <div class="card-header">
                                    <?php if (!empty($row['img_tarea'])) : ?>
                                        <div class="card-header">
                                            <iframe src="<?php echo URL . "/Public/Uploads/" . $row['img_tarea'] ?>?embedded=true" width="100%" height="300" style="border: none;"></iframe>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <hr>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="d-flex mb-0 p-0">
                            <div class="flex-shrink-0">
                                <img src="<?php echo URL; ?>/Public/velzon/assets/images/userPolice.png" alt="Usuario pfa" class="avatar-xs rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2 p-0">
                                <h5 class="fs-13"><small class="text-muted"><?php echo $row['fech_crea']; ?></small></h5>

                                <p style="font-size: 14px;"><?php echo $row['descripcion']; ?></p>


                                <?php if ($row['estado'] === "En proceso") : ?>
                                    <div style="display: flex; justify-content: end;"><span id="btn_eliminar_actividad" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar actividad" onclick="eliminarActividad(<?php echo  $row['id'] ?>)"><i class="ri-delete-bin-5-fill fs-20 text-danger"></i></span> </div>
                                <?php elseif ($row['estado'] === "Finalizada") : ?>
                                    <div style="display: flex; justify-content: end;"></div>
                                <?php endif; ?>

                                <?php if (!empty($row['gde'])) {
                                ?>
                                    <p style="font-size: 14px;">N° GDE de finalización: <?php echo $row['gde']; ?></p>
                                <?php
                                } ?> <span class="badge badge-soft-success fs-12"><i class="fs-13 align-middle me-1"></i><?php echo ($key + 1); ?><span></span></span>
                                <hr>
                            </div>
                        </div>
        <?php
                    }
                }
            }
        }
        break;

    case 'update_estado_en_proceso_tarea_x_analista':
        echo json_encode($tarea->update_estado_en_proceso_tarea_x_analista($_POST['id']));
        break;

    case 'finalizar_tarea':
        $tarea->finalizar_tarea($_SESSION['usu_id'], $_POST['tarea_id'], $_POST['gde']);
        break;

    case 'update_finalizar_tarea':
        $tarea->update_finalizar_tarea($_POST['id']);
        break;

    case 'get_total_tareas_grafico':
        echo json_encode($tarea->get_total_tareas_grafico());
        break;

    case 'get_total_tareas':
        $datos = $tarea->get_total_tareas();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['id'];
            $sub_array[] = $row['dependencia'];
            $sub_array[] = $row['gde'] == '' ? 'No posee' : $row['gde'];
            $sub_array[] = $row['gde_finalizacion'] == '' ? 'No posee' : $row['gde_finalizacion'];
            $sub_array[] = $row['nombre_servicio'];
            $sub_array[] = $row['nombre_operador'];
            $sub_array[] = $row['nombre_analista'];
            $sub_array[] = $row['nombre_sector'];
            $sub_array[] = $row['estado'] == 'Finalizada' ? '<span class="fs-10 badge badge-label bg-info"><i class="mdi mdi-circle-medium"></i> Finalizada</span>' : ($row['estado'] == 'Pendiente' ? '<span class="fs-10 badge badge-label bg-warning" style="color:#222"><i class="mdi mdi-circle-medium"></i> Pendiente</span>' : '<span class="fs-10 badge badge-label bg-success"><i class="mdi mdi-circle-medium"></i> En proceso</span>');
            $sub_array[] = $row['estado'] == 'Finalizada' ? '<span type="button" onclick="descargarReporte(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Descargar informe"><i class=" ri-file-word-2-fill text-primary fs-20" style="margin-left:2px"></i></span>' : '<span><i class=" ri-file-word-2-fill text-primary fs-20" style="margin-left:2px"></i></span>';
            $sub_array[] = '<td><span type="button" onclick="verTarea(' . $row['id'] . ')" data-toggle="tooltip" data-placement="top" title="Ver detalle"><i class="ri-eye-fill fs-20" style="margin-left:2px; color:gray"></i></span></td>';
            $sub_array[] = $row['fech_crea'];
            $sub_array[] = isset($row['fech_finalizacion']) ? $row['fech_finalizacion'] : '<span class="text-danger">No posee</span>';
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case 'get_dependencias':
        echo json_encode($tarea->get_dependencias($_POST['desc_dependencia_pfa']));
        break;

    case 'get_dependenciasPorCodigo':
        echo json_encode($tarea->get_dependenciasPorCodigo($_POST['cod_dep_pfa']));
        break;

    case 'get_nombre_xml_zap_almacenado':
        echo json_encode($tarea->get_nombre_xml_zap_almacenado($_POST['tarea_id'], $_SESSION['usu_id']));
        break;

    case 'get_nombre_xml_nmap_almacenado':
        echo json_encode($tarea->get_nombre_xml_nmap_almacenado($_POST['tarea_id'], $_SESSION['usu_id']));
        break;

    case 'update_xml_nmap_almacenado_scanner':
        $tarea->update_xml_nmap_almacenado_scanner($_POST['tarea_id'], $_SESSION['usu_id']);
        break;



    case 'simplexml_load_file':
        // Carga el archivo XML
        $xmlFilePath = URL . "/Public/Uploads/Archivos_xml_zap/" . $_POST['nom_archivo'];
        $xmlContent = file_get_contents($xmlFilePath);

        // Verifica si el archivo se cargó correctamente
        if ($xmlContent !== false) {
            // Convierte el contenido XML en un objeto SimpleXMLElement
            $xml = simplexml_load_string($xmlContent);

            // Convierte el objeto SimpleXMLElement a un array asociativo
            $json = json_encode($xml, JSON_PRETTY_PRINT);

            // Devuelve el contenido del XML en formato JSON
            header('Content-Type: application/json');
            echo $json;
        } else {
            // Devuelve un mensaje de error si no se pudo cargar el archivo XML
            echo json_encode(['error' => 'No se pudo cargar el archivo XML']);
        }

        break;

    case 'simplexml_load_file_nmap':
        $xmlFilePath = URL . "/Public/Uploads/Archivos_xml_nmap/" . $_POST['nom_archivo'];
        $xmlContent = file_get_contents($xmlFilePath);
        // Verifica si el archivo se cargó correctamente
        if ($xmlContent !== false) {
            // Convierte el contenido XML en un objeto SimpleXMLElement
            $xml = simplexml_load_string($xmlContent);

            // Convierte el objeto SimpleXMLElement a un array asociativo
            $json = json_encode($xml, JSON_PRETTY_PRINT);

            // Devuelve el contenido del XML en formato JSON
            header('Content-Type: application/json');
            echo $json;
        } else {
            // Devuelve un mensaje de error si no se pudo cargar el archivo XML
            echo json_encode(['error' => 'No se pudo cargar el archivo XML']);
        }
        break;

    case 'validar_si_se_subio_archivo_xml_zap':
        echo json_encode($tarea->validar_si_se_subio_archivo_xml_zap($_POST['tarea_id'], $_POST['nom_herramienta']));
        break;

    case 'validar_si_se_subio_archivo_xml_nmap':
        echo json_encode($tarea->validar_si_se_subio_archivo_xml_nmap($_POST['tarea_id'], $_POST['nom_herramienta']));
        break;

    case 'get_archivos_xml':
        echo json_encode($tarea->get_archivos_xml($_POST['tarea_id'], $_POST['nom_herramienta']));
        break;

    case 'eliminarXml':
        echo json_encode($tarea->eliminarXml($_POST['tarea_id'], $_POST['nom_herramienta']));
        break;

    case 'delete_actividad':
        $tarea->delete_actividad($_POST['id']);
        break;

    case 'get_datos_siem':
        echo json_encode($tarea->get_datos_siem($_POST['tarea_id']));
        break;

    case 'insert_datos_siem':
        $tarea->insert_datos_siem($_POST['tarea_id'], $_POST['fecha_evento'], $_POST['nom_incidencia'], $_POST['event_name'], $_POST['reporting_device'], $_POST['reporting_model'], $_POST['source_ip'], $_POST['destination_ip'], $_POST['process_path'], $_POST['process_name'], $_POST['url'], $_POST['information_url'], $_POST['contador']);
        break;

    case 'get_datos_tabla_siem':
        $data = $tarea->get_datos_siem($_POST['tarea_id']);
        ?>
        <ul class="list-group">

            <div class="row">
                <div class="d-flex col-lg-12">
                    <div class="col-md-6">
                        <?php if ($data->fecha_evento == "N/A") : ?>
                            <li class="list-group-item">Fecha evento: <span class="badge bg-warning text-dark ms-1"><?php echo $data->fecha_evento ?><span id="fecha_evento"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Fecha evento: <span class="badge bg-success ms-1"><?php echo $data->fecha_evento ?><span id="nom_incidencia"></span></li>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if ($data->nom_incidencia == "N/A") : ?>
                            <li class="list-group-item">Nombre Incidencia: <span class="badge bg-warning text-dark ms-1"><?php echo $data->nom_incidencia ?><span id="nom_incidencia"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Nombre Incidencia: <span class="badge bg-success ms-1"><?php echo $data->nom_incidencia ?><span id="nom_incidencia"></span></li>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex col-lg-12">
                    <div class="col-md-6">
                        <?php if ($data->event_name == "N/A") : ?>
                            <li class="list-group-item">Event Name: <span class="badge bg-warning text-dark ms-1"><?php echo $data->event_name ?><span id="event_name"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Event Name: <span class="badge bg-success ms-1"><?php echo $data->event_name ?><span id="event_name"></span></li>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if ($data->reporting_device == "N/A") : ?>
                            <li class="list-group-item">Reporting Device: <span class="badge bg-warning text-dark ms-1"><?php echo $data->reporting_device ?><span id="reporting_device"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Reporting Device: <span class="badge bg-success ms-1"><?php echo $data->reporting_device ?><span id="reporting_device"></span></li>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex col-lg-12">
                    <div class="col-md-6">
                        <?php if ($data->reporting_model == "N/A") : ?>
                            <li class="list-group-item">Reporting Model: <span class="badge bg-warning text-dark ms-1"><?php echo $data->reporting_model ?><span id="reporting_model"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Reporting Model: <span class="badge bg-success ms-1"><?php echo $data->reporting_model ?><span id="reporting_model"></span></li>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if ($data->url == "N/A") : ?>
                            <li class="list-group-item">URL: <span class="badge bg-warning text-dark ms-1"><?php echo $data->url ?><span id="url"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">URL: <span class="badge bg-success ms-1"><?php echo $data->url ?><span id="url"></span></li>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex col-lg-12">
                    <div class="col-md-6">
                        <?php if ($data->source_ip == "N/A") : ?>
                            <li class="list-group-item">Source Ip: <span class="badge bg-warning text-dark ms-1"><?php echo $data->source_ip ?><span id="source_ip"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Source Ip: <span class="badge bg-success ms-1"><?php echo $data->source_ip ?><span id="source_ip"></span></li>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if ($data->process_path == "N/A") : ?>
                            <li class="list-group-item">Destinarion Ip: <span class="badge bg-warning text-dark ms-1"><?php echo $data->destination_ip ?><span id="destination_ip"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Destinarion Ip: <span class="badge bg-success ms-1"><?php echo $data->destination_ip ?><span id="destination_ip"></span></li>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex col-lg-12">
                    <div class="col-md-6">
                        <?php if ($data->process_path == "N/A") : ?>
                            <li class="list-group-item">Process Path: <span class="badge bg-warning text-dark ms-1"><?php echo $data->process_path ?><span id="process_path"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Process Path: <span class="badge bg-success ms-1"><?php echo $data->process_path ?><span id="process_path"></span></li>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <?php if ($data->process_name == "N/A") : ?>
                            <li class="list-group-item">Process Name: <span class="badge bg-warning text-dark ms-1"><?php echo $data->process_name ?><span id="process_name"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Process Name: <span class="badge bg-success ms-1"><?php echo $data->process_name ?><span id="process_name"></span></li>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-flex col-lg-12">
                    <div class="col-md-6">
                        <?php if ($data->information_url == "N/A") : ?>
                            <li class="list-group-item">Information Url: <span class="badge bg-warning text-dark ms-1"><?php echo $data->information_url ?><span id="information_url"></span></li>
                        <?php else : ?>
                            <li class="list-group-item">Information Url: <span class="badge bg-success ms-1"><?php echo $data->information_url ?><span id="information_url"></span></li>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </ul>
<?php
        break;

    case 'get_total_dependencias':
        $dato = $tarea->get_total_dependencias();
        if (is_array($dato) && count($dato) > 0) {
            $data = array();
            foreach ($dato as $key => $row) {
                $sub_array = array();
                $sub_array[] = $row['DESC_DEPENDENCIA_PFA'];
                $sub_array[] = $row['COD_DEP_PFA'];
                $sub_array[] = $row['DESC_CALLE'];
                $sub_array[] = $row['SUPER'];
                $sub_array[] = '<span type="button" onclick="ver_activo_dependencia('.$row['COD_DEP_PFA'].')" data-toggle="tooltip" data-placement="top" title="Ver Activos"><i class="text-secondary fs-20 ri-eye-fill"></i></span>';
                $data[]=$sub_array;
            }
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case'get_datos_x_dependnecia':
        echo json_encode($tarea->get_datos_x_dependnecia($_POST['COD_DEP_PFA']));
        break;

    default:
        # code...
        break;
}
