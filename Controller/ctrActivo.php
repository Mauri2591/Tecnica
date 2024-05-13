<?php

require_once '../Config/Conexion.php';
require_once '../Model/Activo.php';

$activo = new Activo();
switch ($_GET['op_activo']) {
    case 'insert_activo':
        $activo->insert_activo(
            $_SESSION['usu_id'],
            $_POST['id_tarea'],
            $_POST['id_accion_concientizacion'],
            $_POST['gde_activo'],
            $_POST['ficha_activo'],
            $_POST['nom_activo'],
            $_POST['cantidad_activo'],
            $_POST['descrip_activo'],
            $_POST['COD_DEP_PFA']
        );
        break;

    case 'get_dependencia_para_activo':
        echo json_encode($activo->get_dependencia_para_activo($_POST['COD_DEP_PFA']));
        break;

    case 'get_total_activos_dependencias':
        $datos = $activo->get_total_activos_dependencias($_POST['COD_DEP_PFA']);
        $data = array();
        if (is_array($datos) && count($datos) > 0) {
            foreach ($datos as $key => $row) {
                $sub_array = array();
                $sub_array[] = '<span class="badge bg-light text-dark fs-11">'.$row['dependencia'].'</span>';
                $sub_array[] = $row['subcat'] == 'Software' ? '<span class="badge bg-info fs-11">Software</span>' : '<span class="badge bg-dark text-light">Hardware</span>';
                $sub_array[] = $row['cantidad_activo'] == '' ? 'N/A' : '<span class="badge bg-danger fs-11">'.$row['cantidad_activo'].'</span>';
                $sub_array[] = '<span class="badge badge-label bg-danger fs-11"><i class="mdi mdi-circle-medium"></i> '. $row['nom_activo'].'</span>';
                $sub_array[] = $row['descrip_activo'];
                $sub_array[] = $row['usuario_asignador'];
                $sub_array[] = date('d/m/Y H:m', strtotime($row['fech_crea']));
                $sub_array[] = '<span fs-16 class="badge bg-warning text-dark">' . ($row['fech_baja'] == '' ? 'N/A' : $row['fech_baja']) . '</span>';
                $data[] = $sub_array;
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

    case 'get_categoria_activo':
        $dato=$activo->get_categoria_activo();
        if(is_array($dato) && count($dato)>0){
            $html='';
            foreach ($dato as $key => $row) {
                $html.='<option value='.$row['id'].'>'.$row['nom_subcat'].'</option>';
            }
        }
        echo $html;
        break;

    default:
        break;
}
