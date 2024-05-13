function init() {

}

$(document).ready(function () {

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
        $.post("../../../../Controller/ctrServicios.php?op_servicio=get_servicios_tecnica",
            function (data, textStatus, jqXHR) {
                data=JSON.parse(data);
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                    <option value="${elem.id}">${elem.nombre}</option>
                    `;
                });
                document.getElementById("servicioCargaTecnica").innerHTML = htmlOption;
            },
            "html"
        );
    }

    function get_analista() {
        $.post("../../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 2 },
            function (data, textStatus, jqXHR) {
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                        <option value="${elem.id}">${elem.nombre_usuario} ${elem.apellido_usuario}</option>
                        `;
                });
                document.getElementById("analistaTecnica").innerHTML = htmlOption;
            },
            "json"
        );
    }
    function get_sector() {
        $.post("../../../../Controller/ctrSector.php?op_sector=get_sectores", { id: 2 },
            function (data, textStatus, jqXHR) {
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                    <option value="${elem.id}">${elem.nombre_sector}</option>
                    `;
                });
                document.getElementById("sectorTecnica").innerHTML = htmlOption;
                document.getElementById("sectorTecnica").setAttribute('disabled', 'disabled');
            },
            "json"
        );
    }
    $("#btnAgregarTareaTecnicaManual").click(function (e) {
        e.preventDefault();
        get_servicios()
        get_analista()
        get_sector()
        $("#modalAgregarTareaTecnica").modal("show")

    })
});


function getDatos() {
    let registro = {
        gde: $("#gdeTecnica").val() == '' ? 'No posee' : $("#gdeTecnica").val(),
        COD_DEP_PFA: $("#cod_dep").val(),
        servicio: $("#servicioCargaTecnica").val(),
        operador: $("#operadorTecnica").val(),
        analista: $("#analistaTecnica").val(),
        sector: $("#sectorTecnica").val(),
        descripcion: $("#descripcionTecnica").val(),
        estado: "Pendiente"
    }
    return registro;
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

document.getElementById("btnInsertTecnica").addEventListener("click", function () {
    if ($("#gdeTecnica").val() == '' && $("#descripcionTecnica").val() == '') {
        Swal.fire({
            icon: 'warning',
            title: 'Error',
            text: "Si no ingresa un numero de GDE al menos debe agregar una descripcion!",
            showConfirmButton: true,
            showCancelButton: true
        })
    } else {
        try {
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