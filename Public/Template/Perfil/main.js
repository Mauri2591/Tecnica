function init() {

}

$(document).ready(function () {

    function get_datos() {
        $.post("../../../Controller/ctrUsuarios.php?op_user=get_usuario_editar_info",
            function (data, textStatus, jqXHR) {
                document.getElementById("info_usuario").innerHTML = data;
            },
            "html"
        );
    }
    get_datos();


    $("#btn_editar_usu").click("click", function (e) {
        e.preventDefault();
        $("#modalEditarPerfil").modal("show");

        $.post("../../../Controller/ctrUsuarios.php?op_user=get_usaurio_editar_info_desde_form",
            function (data, textStatus, jqXHR) {
                $("#form_update_user").html(data);

                let btnSwitch = document.getElementById("input_switch");
                btnSwitch.addEventListener("change", function () {
                    if (btnSwitch.value == "0") {
                        btnSwitch.value = "1";
                        document.getElementById("usu_pass").disabled = false;
                        document.getElementById("usu_pass").focus();
                    } else if (btnSwitch.value == "1") {
                        btnSwitch.value = "0";
                        document.getElementById("usu_pass").disabled = true;
                    }
                })


                function get_datos_ajax() {
                    if (btnSwitch.value == "1") {
                        let registro = {
                            lp: $("#lp").val(),
                            dni: $("#dni").val(),
                            fech_nac: $("#fech_nac").val(),
                            password: $("#usu_pass").val(),
                            nombre_usuario: $("#nombre_usuario").val(),
                            apellido_usuario: $("#apellido_usuario").val(),
                            jerarquia: $("#jerarquia").val(),
                            direccion: $("#direccion").val(),
                            telefono: $("#telefono").val(),
                            marca_armamento: $("#marca_armamento").val(),
                            modelo_armamento: $("#modelo_armamento").val(),
                            num_armamento: $("#num_armamento").val()
                        }
                        return registro;
                    } else {
                        let registro = {
                            lp: $("#lp").val(),
                            dni: $("#dni").val(),
                            fech_nac: $("#fech_nac").val(),
                            nombre_usuario: $("#nombre_usuario").val(),
                            apellido_usuario: $("#apellido_usuario").val(),
                            jerarquia: $("#jerarquia").val(),
                            direccion: $("#direccion").val(),
                            telefono: $("#telefono").val(),
                            marca_armamento: $("#marca_armamento").val(),
                            modelo_armamento: $("#modelo_armamento").val(),
                            num_armamento: $("#num_armamento").val()
                        }
                        return registro;
                    }

                }

                function update_informacion(data) {
                    $.ajax({
                        type: "POST",
                        url: "../../../Controller/ctrUsuarios.php?op_user=update_usuario_info_panel_usuario",
                        data: data,
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                        }, error: function (error) {
                            console.log(error);
                        }
                    });
                }

                $("#btnUpdateUser").click("click", function (e) {
                    e.preventDefault();
                    if ($("#input_switch").val() == "1" && $("#usu_pass").val() == '') {
                        Swal.fire({
                            icon: "warning",
                            title: "Error",
                            text: "Si desea cambiar la password, debe ingresar una nueva!",
                            showCancelButton: true,
                            showConfirmButton: true
                        });
                    } else {
                        let data = get_datos_ajax();
                        update_informacion(data);
                        Swal.fire({
                            icon: "success",
                            title: "Bien",
                            text: "Datos actualizados correctamente!",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        });

                        $("#modalEditarPerfil").modal("hide");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                })
            },
            "html"
        );


    })
});



init();