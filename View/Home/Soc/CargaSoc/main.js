function init() {


}

$(document).ready(function () {


    document.getElementById("servicioCargaSoc").addEventListener("change", function () {
        if ($("#servicioCargaSoc").val() == 1 || $("#servicioCargaSoc").val() == 13) {
            $("#container_ips_urls").show();
        } else {
            $("#container_ips_urls").hide();
            $("#ips").val('')
            $("#urls").val('');

            if ($("#servicioCargaSoc").val() == 2) {
                $("#servicioSocSubCategoria").show();
                $("#id_servicioSocSubCategoria").show()
            } else {
                $("#servicioSocSubCategoria").hide()
                $("#id_servicioSocSubCategoria").hide();
            }
        }
    })

    function get_dependencia() {
        $("#dependenciaInput").on('input', function (e) {
            e.preventDefault();
            let descripcion = $(this).val().trim();
            if (descripcion === "") {
                $("#dependenciaValor").val("");
                return;
            } else if (descripcion != "") {
                $("#dependenciaInputCodigo").val('');
            }
            $.post("../../../../Controller/ctrTareas.php?op_tarea=get_dependencias", { desc_dependencia_pfa: descripcion },
                function (data, textStatus, jqXHR) {
                    data = JSON.parse(data);
                    $("#dependenciaValor").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                    $("#cod_dep").val(data.COD_DEP_PFA);
                    if ($("#dependenciaValor").val() == "undefined - COD undefined") {
                        Swal.fire({
                            icon: "warning",
                            title: "Error!",
                            text: "Ingrese un nombre o codigo valido",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1200
                        })
                        $("#dependenciaInput").val('');
                        $("#dependenciaInputCodigo").val('')
                        $("#dependenciaValor").val('')
                    }
                }
            );

        });

        $("#dependenciaInputCodigo").on('input', function (e) {
            e.preventDefault();
            let cod_dep_pfa = $(this).val().trim();
            if (cod_dep_pfa === "") {
                $("#dependenciaValor").val("");
                return;
            } else if (cod_dep_pfa != '') {
                $("#dependenciaInput").val('')
            }
            $.post("../../../../Controller/ctrTareas.php?op_tarea=get_dependenciasPorCodigo", { cod_dep_pfa: cod_dep_pfa },
                function (data, textStatus, jqXHR) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("#dependenciaValor").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                    $("#cod_dep").val(data.COD_DEP_PFA);
                    if ($("#dependenciaValor").val() == "undefined - COD undefined") {
                        Swal.fire({
                            icon: "warning",
                            title: "Error!",
                            text: "Ingrese un nombre o codigo valido",
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1200
                        })
                        $("#dependenciaInput").val('');
                        $("#dependenciaInputCodigo").val('')
                        $("#dependenciaValor").val('')
                    }
                }
            );
        });
    }
    get_dependencia();


    function get_servicios() {
        $.post("../../../../Controller/ctrServicios.php?op_servicio=get_servicios_soc",
            function (data, textStatus, jqXHR) {
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                    <option value="${elem.id}">${elem.nombre}</option>
                    `;
                });
                document.getElementById("servicioCargaSoc").innerHTML = htmlOption;
            },
            "json"
        );
    }

    function get_analista() {
        $.post("../../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 1 },
            function (data, textStatus, jqXHR) {
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                        <option value="${elem.id}">${elem.nombre_usuario} ${elem.apellido_usuario}</option>
                        `;
                });
                document.getElementById("analistaSoc").innerHTML = htmlOption;
            },
            "json"
        );
    }
    function get_sector() {
        $.post("../../../../Controller/ctrSector.php?op_sector=get_sectores", { id: 1 },
            function (data, textStatus, jqXHR) {
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                    <option value="${elem.id}">${elem.nombre_sector}</option>
                    `;
                });
                document.getElementById("sectorSoc").innerHTML = htmlOption;
                document.getElementById("sectorSoc").setAttribute('disabled', 'disabled');
            },
            "json"
        );
    }

    document.getElementById("btnAgregarTareaSocManual").addEventListener("click", function () {
        $("#servicioSocSubCategoria").hide();
    });


    $("#btnAgregarTareaSocManual").click(function (e) {
        let modalAbierto = false;
        e.preventDefault();
        $("#id_servicioSocSubCategoria").hide();

        $.post("../../../../Controller/ctrServicios.php?op_servicio=get_subCategoria_siem",
            function (data, textStatus, jqXHR) {
                console.log(data);
                $("#servicioSocSubCategoria").html(data);
            },
            "html"
        );

        if (!modalAbierto) {
            get_servicios()
            get_analista()
            get_sector()
            $("#modalAgregarTareaSoc").modal("show");
            modalAbierto = true;
        }
    })
    $("#modalAgregarTareaSoc").on("hide.bs.modal", function () {
        modalAbierto = false; // Establecer el estado del modal como cerrado
    });
});

function getUrls() {
    var texto = document.getElementById("urls").value.trim(); // Obtener el texto y eliminar espacios en blanco
    // Verificar si el texto está vacío
    if (texto === "") {
        return true; // Permitir campo vacío
    }
    var urls = texto.split(/\s*,\s*/); // Separar por comas y eliminar espacios en blanco alrededor
    // Expresión regular para validar URLs
    var regex = /^(https?:\/\/)?(www\.)?([\w-]+\.)+[\w-]+(\/[\w- ./?%&=]*)?$/;
    var valid = true;
    for (var i = 0; i < urls.length; i++) {
        // Limpiar la URL de espacios en blanco antes de validar
        var url = urls[i].trim();
        // Validar si la URL es válida
        if (!regex.test(url)) {
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "La URL '" + url + "' no es válida",
                showCancelButton: false,
                showConfirmButton: true
            });
            valid = false;
            break; // Detener el bucle si se encuentra una URL no válida
        }
    }
    return valid;
}



function getIps() {
    var texto = document.getElementById("ips").value.trim(); // Obtener el texto y eliminar espacios en blanco
    // Verificar si el texto está vacío
    if (texto === "") {
        return true; // Permitir campo vacío
    }
    var ips = texto.split(/\s*,\s*/); // Separar por comas y eliminar espacios en blanco alrededor
    // Expresión regular para validar IPs
    var regex = /^(?:\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})$/;
    var valid = true;
    for (var i = 0; i < ips.length; i++) {
        // Limpiar la IP de espacios en blanco antes de validar
        var ip = ips[i].trim();
        // Validar si la IP es válida
        if (!regex.test(ip)) {
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "La IP '" + ip + "' no es válida",
                showCancelButton: false,
                showConfirmButton: true
            });
            valid = false;
            break; // Detener el bucle si se encuentra una IP no válida
        }
    }
    return valid;
}

function getDatos() {
    if ($("#servicioCargaSoc").val() == 2) {
        let registro = {
            gde: $("#gdeSoc").val() == '' ? 'No posee' : $("#gdeSoc").val(),
            COD_DEP_PFA: $("#cod_dep").val(),
            servicio: $("#servicioCargaSoc").val(),
            id_subcat_siem: $("#servicioSocSubCategoria").val(),
            operador: $("#operadorSoc").val(),
            analista: $("#analistaSoc").val(),
            sector: $("#sectorSoc").val(),
            descripcion: $("#descripcionSoc").val(),
            ips: $("#ips").val(),
            urls: $("#urls").val(),
            estado: "Pendiente"
        }
        return registro;
    } else {
        let registro = {
            gde: $("#gdeSoc").val() == '' ? 'No posee' : $("#gdeSoc").val(),
            COD_DEP_PFA: $("#cod_dep").val(),
            servicio: $("#servicioCargaSoc").val(),
            id_subcat_siem: "",
            operador: $("#operadorSoc").val(),
            analista: $("#analistaSoc").val(),
            sector: $("#sectorSoc").val(),
            descripcion: $("#descripcionSoc").val(),
            ips: $("#ips").val(),
            urls: $("#urls").val(),
            estado: "Pendiente"
        }
        return registro;
    }
}

function ajaxDatos(registro) {
    $.ajax({
        type: "POST",
        url: "../../../../Controller/ctrTareas.php?op_tarea=insertTarea",
        data: registro,
        dataType: "json",
        success: function (response) {
            console.log(response);
        }, error: function (error) {
            console.log(error);
        }
    });
}

document.getElementById("btnInsertSoc").addEventListener("click", function () {
    if ($("#gdeSoc").val() == '' && $("#descripcionSoc").val() == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: "Si no ingresa un numero de GDE al menos debe agregar una descripcion!",
            showConfirmButton: true,
            showCancelButton: true
        })
    } else if ($("#dependenciaValor").val() == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: "Debe ingresar la Dependencia",
            showConfirmButton: true,
            showCancelButton: false,
        })
    }
    else {
        try {
            if (!getIps() || !getUrls()) {
                return
            }
            let data = getDatos();
            ajaxDatos(data);
            Swal.fire({
                icon: 'success',
                title: 'Bien',
                text: "Tarea agregada correctamente",
                showConfirmButton: false,
                showCancelButton: false,
                timer: 1200
            })
            setTimeout(() => {
                location.reload();
            }, 1200);
        } catch (error) {
            console.log(error);
        }
    }

});


init();