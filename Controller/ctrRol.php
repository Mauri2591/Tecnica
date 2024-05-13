<?php
require_once '../Config/Conexion.php';
require_once '../Model/Rol.php';

$rol= new Rol();
switch ($_GET['op_rol']) {
    case 'get_roles':
        echo json_encode($rol->get_roles());
        break;

    default:
        break;
}