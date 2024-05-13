<?php require_once 'Config/Conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/Css/style.css">
    <title>Sistema de Gestión</title>
</head>

<body>
    <div class="login">
        <h1>Ingreso</h1>
        <form method="post" action="Controller/ctrUsuarioLogin.php">
            <div class="form-group">
                <label for="usuario" style="color:#fff">Usuario</label>
                <input type="email" name="usuario" id="usuario" placeholder="Ingrese su usuario" />
            </div>
            <div class="form-group">
                <label for="password" style="color:#fff">Usuario</label>
                <input type="password" name="password" id="password" placeholder="Ingrese su password" />
            </div>
            <button type="submit" name="ingresar" class="btn btn-primary btn-block btn-large">Ingresar</button>
        </form>
    </div>

    <script src="<?php echo URL; ?>/Public/jsMios/sweetAlert2.js"></script>
    <script>
        let p1 = new URLSearchParams(location.search);
        let param1 = p1.get("email");
        let param2 = p1.get("pass");
        let param3 = p1.get("pass_email");

        if (param3 == "vacios"){
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Usuario o contraseñas vacíos',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1400
            });
            let urlCambiar= window.location.href.replace("?pass_email=vacios", "");
            history.replaceState({},document.title, urlCambiar);
        }else if(param1 == "error") {
            Swal.fire({
                icon: 'error', // Cambiado de 'type' a 'icon'
                title: 'Error!',
                text: 'El correo electrónico no existe o fue incorrecto, intenta de nuevo',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1400
            });
            // Eliminar el parámetro "error" de la URL
            let urlCambiar = window.location.href.replace("?email=error", "");
            history.replaceState({}, document.title, urlCambiar);
        } else if (param2 == "error") {
            Swal.fire({
                icon: 'error', // Cambiado de 'type' a 'icon'
                title: 'Error!',
                text: 'El password ingresado no existe o fue incorrecto, intenta de nuevo',
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1400
            });
            // Eliminar el parámetro "error" de la URL
            let urlCambiar = window.location.href.replace("?pass=error", "");
            history.replaceState({}, document.title, urlCambiar);
        }
    </script>
</body>

</html>