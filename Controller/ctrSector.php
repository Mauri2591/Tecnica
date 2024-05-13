<?php
require_once '../Config/Conexion.php';
require_once '../Model/Sector.php';

$sector= new Sector();

switch ($_GET['op_sector']) {
    case 'get_sectores':
        echo json_encode($sector->get_sector($_POST['id']));
        break;
    
    default:
        # code...
        break;
}