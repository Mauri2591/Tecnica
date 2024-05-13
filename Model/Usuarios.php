<?php
class Usuario extends Conexion
{
    public function login_usuario($email, $pass)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $resul = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($email) || empty($pass)) {
            // El usuario vacío o password vacía
            header("Location:" . URL . "/?pass_email=vacios");
            exit();
        } else if (!$resul) {
            // El usuario no existe
            header("Location:" . URL . "/?email=error");
            exit();
        }
        // Verificar la contraseña
        if (password_verify($pass, $resul['password'])) {
            // Contraseña válida, establecer sesiones y redirigir al usuario
            $_SESSION['usu_id'] = $resul['id'];
            $_SESSION['usuario'] = $resul['usuario'];
            $_SESSION['id_rol'] = intval($resul['id_rol']);
            $_SESSION['id_sector'] = intval($resul['id_sector']);
            $_SESSION['nombre_usuario'] = $resul['nombre_usuario'];
            $_SESSION['apellido_usuario'] = $resul['apellido_usuario'];
            $_SESSION['est'] = intval($resul['est']);
            $_SESSION['nombreUsuBienvenida'] = $resul['nombre_usuario'];
            header("Location: " . URL . "/View/Home/");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location:" . URL . "/?pass=error");
            exit();
        }
    }

    public function insert_ususario($lp, $dni, $id_rol, $id_sector, $usuario, $password, $nombre_usuario, $apellido_usuario, $direccion, $telefono, $est)
    {
        $conn = parent::conexion();
        $sql = "INSERT INTO usuarios(lp,dni,id_rol, id_sector, usuario,password, nombre_usuario, apellido_usuario, direccion,telefono,est)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $lp);
        $stmt->bindParam(2, $dni);
        $stmt->bindParam(3, $id_rol);
        $stmt->bindParam(4, $id_sector);
        $stmt->bindParam(5, $usuario);
        $stmt->bindParam(6, $password);
        $stmt->bindParam(7, $nombre_usuario);
        $stmt->bindParam(8, $apellido_usuario);
        $stmt->bindParam(9, $direccion);
        $stmt->bindParam(10, $telefono);
        $stmt->bindParam(11, $est);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_usuarios()
    {
        $conn = parent::conexion();
        $sql = "SELECT usuarios.*, roles.rol, sector.nombre_sector FROM usuarios INNER JOIN roles 
        ON usuarios.id_rol=roles.id INNER JOIN sector ON usuarios.id_sector=sector.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_usuarios_x_id_sector($id_sector)
    {
        $conn = parent::conexion();
        $sql = "SELECT usuarios.*, roles.rol, sector.nombre_sector FROM usuarios INNER JOIN roles 
        ON usuarios.id_rol=roles.id INNER JOIN sector ON usuarios.id_sector=sector.id WHERE id_sector=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id_sector, PDO::PARAM_INT);
        $stmt->execute();
        return $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_usuario($id)
    {
        $conn = parent::conexion();
        $sql = "SELECT * FROM usuarios WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function dalete_usuario($id)
    {
        $conn = parent::conexion();
        $sql = "DELETE FROM usuarios WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_usuario($lp, $id_rol, $id_sector, $direccion, $telefono, $id)
    {
        $conn = parent::conexion();
        $sql = "UPDATE usuarios SET lp=?, id_rol=?, id_sector=?, direccion=?, telefono=? WHERE id=? AND est=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $lp);
        $stmt->bindParam(2, $id_rol);
        $stmt->bindParam(3, $id_sector);
        $stmt->bindParam(4, $direccion);
        $stmt->bindParam(5, $telefono);
        $stmt->bindParam(6, $id);
        $stmt->execute();
    }

    public function update_usuario_info_panel_usuario($lp, $dni,$fech_nac,$password,$nombre_usuario, $apellido_usuario,$jerarquia,$direccion, $telefono,$marca_armamento,$modelo_armamento, $num_armamento,$id)
    {
        $conn = parent::conexion();
        $sql = "UPDATE usuarios SET lp=?,dni=?,fech_nac=?,password=?,nombre_usuario=?,apellido_usuario=?,jerarquia=?,direccion=?,telefono=?,marca_armamento=?,modelo_armamento=?,
            num_armamento=? WHERE id=? AND est=1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $lp);
        $stmt->bindParam(2, $dni);
        $stmt->bindParam(3, $fech_nac);
        $stmt->bindParam(4, $password);
        $stmt->bindParam(5, $nombre_usuario);
        $stmt->bindParam(6, $apellido_usuario);
        $stmt->bindParam(7, $jerarquia);
        $stmt->bindParam(8, $direccion);
        $stmt->bindParam(9, $telefono);
        $stmt->bindParam(10, $marca_armamento);
        $stmt->bindParam(11, $modelo_armamento);
        $stmt->bindParam(12, $num_armamento);
        $stmt->bindParam(13, $id);
        $stmt->execute();
        return $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
