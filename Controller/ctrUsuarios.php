<?php
require_once '../Config/Conexion.php';
require_once '../Model/Usuarios.php';

$user = new Usuario();
switch ($_GET['op_user']) {
    case 'insert':
        $user->insert_ususario(
            $_POST['lp'],
            $_POST['dni'],
            $_POST['id_rol'],
            $_POST['id_sector'],
            $_POST['usuario'],
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['nombre_usuario'],
            $_POST['apellido_usuario'],
            $_POST['direccion'],
            $_POST['telefono'],
            $_POST['est']
        );
        break;

    case 'get_usuarios':
        echo json_encode($user->get_usuarios());
        break;

    case 'get_usuarios_x_id_sector':
        echo json_encode($user->get_usuarios_x_id_sector($_POST['id_sector']));
        break;

    case 'dalete_usuario':
        $user->dalete_usuario($_POST['id']);
        break;

    case 'get_usuario':
        echo json_encode($user->get_usuario($_SESSION['usu_id']));
        break;

    case 'get_usuario_editar_info':
        $data = $user->get_usuario($_SESSION['usu_id']);
?>
        <li class="mb-3" style="font-weight: bold;">Nombre: <span id="usu_nom"><?php echo $data->nombre_usuario; ?></span></li>
        <li class="mb-3" style="font-weight: bold;">Apellido: <span id="usu_ape"><?php echo $data->apellido_usuario; ?></span></li>
        <li class="mb-3" style="font-weight: bold;">Jerarquia: <span id="usu_jerarquia"><?php echo $data->jerarquia; ?></span></li>
        <li class="mb-3" style="font-weight: bold;">DNI: <span id="usu_dni"></span><?php echo $data->dni; ?></li>
        <li class="mb-3" style="font-weight: bold;">Fecha de Nacimiento: <span id="usu_nacimiento"><?php echo $data->fech_nac; ?></span></li>
        <li class="mb-3" style="font-weight: bold;">Direccion: <span id="usu_direccion"></span><?php echo $data->direccion; ?></li>
        <li class="mb-3" style="font-weight: bold;">Numero de Celular: <span id="usu_cel"><?php echo $data->telefono; ?></span></li>
        <li class="mb-3" style="font-weight: bold;">L.P: <span id="usu_lp"><?php echo $data->lp; ?><?php echo $data->lp; ?></span></li>
        <li class="mb-3" style="font-weight: bold;">Marca de Armamento: <span id="usu_marca_armamento"><?php echo $data->marca_armamento; ?></span></li>
        <li class="mb-3" style="font-weight: bold;">Modelo de Armamento: <span id="usu_modelo_armamento"><?php echo $data->modelo_armamento; ?></span></li>
        <li class="mb-2" style="font-weight: bold;">Numero de Armamento: <span id="usu_num_armamento"><?php echo $data->num_armamento; ?></span></li>
    <?php
        break;

    case 'get_usaurio_editar_info_desde_form':
        $data = $user->get_usuario($_SESSION['usu_id']);
    ?>
        <div class="mb-3 row">
            <div class="flex-shrink-0 col-sm-3">
                <div class="form-check form-switch form-switch-right form-switch-md">
                    <label for="input_switch" class="form-label">Cambiar Password</label>
                    <input class="form-check-input code-switcher" data-toggle="tooltip" data-placement="top" title="Habilitar campo" value="0" type="checkbox" id="input_switch">
                </div>
            </div>
            <div class="col-sm-9">
                <input class="form-control form-control-sm" disabled id="usu_pass" type="text" placeholder="Ingrese la nueva pasword">
            </div>
        </div>

        <div class="mb-1 row">
            <label for="usu_nom" class="col-2 col-form-label">Nombre:</label>
            <div class="col-10">
                <input class="form-control form-control-sm" id="nombre_usuario" value="<?php echo $data->nombre_usuario; ?>" type="text" placeholder="Ingrese su nombre">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="usu_ape" class="col-sm-2 col-form-label">Apellido: </label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" id="apellido_usuario" value="<?php echo $data->apellido_usuario; ?>" type="text" placeholder="Ingrese su apellido">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="jerarquia" class="col-sm-2 col-form-label">Jerarquia: </label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" id="jerarquia" value="<?php echo $data->jerarquia; ?>" type="text" placeholder="Ingrese su jerarquia">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="dni" class="col-sm-2 col-form-label">DNI: </label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" value="<?php echo $data->dni; ?>" id="dni" type="text" placeholder="Ingrese su dni">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="fech_nac" class="col-sm-2 col-form-label">Fecha de nac:</label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" id="fech_nac" value="<?php echo $data->fech_nac; ?>" type="date" placeholder="Ingrese su fecha de nacimiento">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="direccion" class="col-sm-2 col-form-label">Direccion: </label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" id="direccion" value="<?php echo $data->direccion; ?>" type="text" placeholder="Ingrese su direccion">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="telefono" class="col-sm-2 col-form-label">Celular: </label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" id="telefono" value="<?php echo $data->telefono; ?>" type="text" placeholder="Ingrese su celular">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="lp" class="col-sm-2 col-form-label">L.P: </label>
            <div class="col-sm-10">
                <input class="form-control form-control-sm" id="lp" type="text" value="<?php echo $data->lp; ?>" placeholder="Ingrese su LP  ">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="marca_armamento" class="col-sm-3 col-form-label">Marca de Armamento: </label>
            <div class="col-sm-9">
                <input class="form-control form-control-sm" id="marca_armamento" value="<?php echo $data->marca_armamento; ?>" type="text" placeholder="Ingrese su marca de armamento">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="modelo_armamento" class="col-sm-3 col-form-label">Modelo de armamento: </label>
            <div class="col-sm-9">
                <input class="form-control form-control-sm" id="modelo_armamento" value="<?php echo $data->modelo_armamento; ?>" type="text" placeholder="Ingrese su modelo de armamento">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="num_armamento" class="col-sm-3 col-form-label">Nro. de Armamento: </label>
            <div class="col-sm-9">
                <input class="form-control form-control-sm" id="num_armamento" type="text" value="<?php echo $data->num_armamento; ?>" placeholder="Ingrese su numero de armamento">
            </div>
        </div>

        <div style="display: flex; justify-content: end;">
            <button type="button" id="btnUpdateUser" class="btn btn-success btn-sm">Guardar</button>
            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
        </div>
<?php
        break;

    case 'update_usuario':
        $user->update_usuario($_POST['lp'], $_POST['id_rol'], $_POST['id_sector'], $_POST['direccion'], $_POST['telefono'], $_POST['id']);
        break;

    case 'update_usuario_info_panel_usuario':
        $user->update_usuario_info_panel_usuario($_POST['lp'], $_POST['dni'], $_POST['fech_nac'],password_hash($_POST['password'],PASSWORD_DEFAULT), $_POST['nombre_usuario'], $_POST['apellido_usuario'], $_POST['jerarquia'], $_POST['direccion'], $_POST['telefono'], $_POST['marca_armamento'], $_POST['modelo_armamento'], $_POST['num_armamento'], $_SESSION['usu_id']);
        break;

    default:
        # code...
        break;
}
