<?php
require_once '../Config/Conexion.php';
require_once '../Model/Servicios.php';

$servicio = new Servicios();

switch ($_GET['op_servicio']) {
    case 'get_servicios_soc':
        echo json_encode($servicio->get_servicios());
        break;

    case 'get_servicios_tecnica':
        $data = $servicio->get_servicios();
        $output = array();
        $elementos = array(3, 4, 5, 6, 7);
        foreach ($data as $key => $row) {
            if (in_array($row['id'], $elementos)) {
                $output[] = $row;
            }
        }
        echo json_encode($output);
        break;

    case 'get_servicios_concientizacion':
        $data = $servicio->get_servicios();
        $output = array();
        $elementos = [7, 8, 9, 10, 14];
        foreach ($data as $key => $row) {
            if (in_array($row['id'], $elementos)) {
                $output[] = $row;
            }
        }
        echo json_encode($output);
        break;

    case 'get_option_accion_concientizacion':
        $data = $servicio->get_option_accion_concientizacion();
        if (is_array($data) && count($data) > 0) {
            $option = '';
            foreach ($data as $key => $row) {
                $option .= '<option value=' . $row['id'] . '>' . $row['nom_subCat'] . '</option>';
            }
        }
        echo $option;
        break;

    case 'get_servicios_soc':
        $data = $servicio->get_servicios();
        $output = array();
        $elementos = [1, 2, 3, 4, 5, 6, 7, 11, 12, 13];
        foreach ($data as $key => $row) {
            if (in_array($row['id'], $elementos)) {
                $output[] = $row;
            }
        }
        echo json_encode($output);
        break;

    case 'get_subCategoria_siem';
        $data = $servicio->get_subCategoria_siem();
        if (is_array($data) && count($data) > 0) {
            $option = '';
            foreach ($data as $key => $row) {
                $option .= '<option value="' . $row["id"] . '">' . $row["nom_subCat"] . '</option>';
            }
        }
        echo $option;
        break;

    default:
        # code...
        break;
}
