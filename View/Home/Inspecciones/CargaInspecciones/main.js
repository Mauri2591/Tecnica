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
        $.post("../../../../Controller/ctrServicios.php?op_servicio=get_servicios_concientizacion", function (data, textStatus, jqXHR) {                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                    <option value="${elem.id}">${elem.nombre}</option>
                    `;
                });
                document.getElementById("servicioConcientizacion").innerHTML = htmlOption;
            },
            "json"
        );
    }

    document.getElementById("cont_accion_concientizacion").style.display="none";

    function get_servicios_subCat() {  
        document.getElementById("servicioConcientizacion").addEventListener("change",function(){
            if(document.getElementById("servicioConcientizacion").value == 14){
                document.getElementById("cont_accion_concientizacion").style.display="flex";
                $.post("../../../../Controller/ctrServicios.php?op_servicio=get_option_accion_concientizacion",
                    function (data, textStatus, jqXHR) {
                        document.getElementById("id_accion_concientizacion").innerHTML=data;
                    },
                    "html"
                );
            }else{
                document.getElementById("cont_accion_concientizacion").style.display="none";
            }
        })
    }

    function get_analista() {
        $.post("../../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 3 },
            function (data, textStatus, jqXHR) {
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                        <option value="${elem.id}">${elem.nombre_usuario} ${elem.apellido_usuario}</option>
                        `;
                });
                document.getElementById("analistaConcientizacion").innerHTML = htmlOption;
            },
            "json"
        );
    }

    function get_sector() {
        $.post("../../../../Controller/ctrSector.php?op_sector=get_sectores", { id: 3 },
            function (data, textStatus, jqXHR) {
                let htmlOption = '';
                data.forEach(elem => {
                    htmlOption += `
                    <option value="${elem.id}">${elem.nombre_sector}</option>
                    `;
                });
                document.getElementById("sectorConcientizacion").innerHTML = htmlOption;
                document.getElementById("sectorConcientizacion").setAttribute('disabled', 'disabled');
            },
            "json"
        );
    }
    $("#btnAgregarTareaConcientizacionManual").click(function (e) {
        e.preventDefault();
        get_servicios()
        get_analista()
        get_sector()
        get_servicios_subCat();
        $("#modalAgregarTareaConcientizacion").modal("show")

    })
});


function getDatos() {
    let registro = {
        gde: $("#gdeConcientizacion").val() == '' ? 'No posee' : $("#gdeConcientizacion").val(),
        COD_DEP_PFA: $("#cod_dep").val(),
        servicio: $("#servicioConcientizacion").val(),
        id_accion_concientizacion: $("#id_accion_concientizacion").val(),
        id_subcat_siem: "",
        operador: $("#operadorConcientizacion").val(),
        analista: $("#analistaConcientizacion").val(),
        sector: $("#sectorConcientizacion").val(),
        descripcion: $("#descripcionConcientizacion").val(),
        ips: "",
        urls: "",
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

document.getElementById("btnInsertConcientizacion").addEventListener("click", function () {
    if ($("#gdeConcientizacion").val() == '' && $("#descripcionConcientizacion").val() == '') {
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