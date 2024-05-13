function init(){

}


var tabla;
var url = "http://localhost/Tecnica";
var url_param = new URLSearchParams(location.search);
var url_get_tarea = url_param.get("tarea");
var url_cod_dep = new URLSearchParams(location.search);
var cod_dep = url_cod_dep.get("dep");


$(document).ready(function () {
    tabla = $("#ver_activos_dependencias").DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lenghtChange: false,
        colReorder: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax": {
            url: "../../../../Controller/ctrActivo.php?op_activo=get_total_activos_dependencias",
            type: "post",
            dataType: "json",
            data: {
                COD_DEP_PFA:cod_dep
            },
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "order": [[0, "desc"]], //Ordenar descendentemente
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        // "iDisplayLength": 10, //cantidad de tuplas o filas a mostrar
        "autoWith": false,
        "language": {
            "sProcessing": "Procesando..",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados..",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(Filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar: ",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ùltimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ":Activar para ordenar la columna de manera ascendiente",
                "sSortDescending": ":Activar para ordenar la columna de manera descendiente"
            }
        }
    });

    $.post("../../../../Controller/ctrTareas.php?op_tarea=get_datos_x_dependnecia", { COD_DEP_PFA: cod_dep },
        function (data, textStatus, jqXHR) {
            document.getElementById("nom_activo_dependencia").innerText = data.DESC_DEPENDENCIA_PFA;
        },
        "json"
    );

    //Limpiar formulario activos
    function limpiar_formulario_activos() {
        $("#nom_activo").val('');
        $("#gde_activo").val('');
        $("#ficha_activo").val('');
        $("#cantidad_activo").val('');
        $("#descrip_activo").val('');
    }

    function get_servicios_subCat_activos() {
        $.post("../../../../Controller/ctrActivo.php?op_activo=get_categoria_activo",
            function (data, textStatus, jqXHR) {
                document.getElementById("id_accion_concientizacion").innerHTML = data;
            },
            "html"
        );
    }

    function get_dependencia_para_activo() {
        $.post("../../../../Controller/ctrActivo.php?op_activo=get_dependencia_para_activo", { COD_DEP_PFA: cod_dep },
            function (data, textStatus, jqXHR) {
                document.getElementById("DESC_DEPENDENCIA_PFA").value = data.DESC_DEPENDENCIA_PFA;
            },
            "json"
        );
    }

    $.post("../../../../Controller/ctrTareas.php?op_tarea=get_tarea_x_analista_detalle", { id: url_get_tarea },
        function (data, textStatus, jqXHR) {
            let usu_id_inps = document.getElementById("usu_id").value;
            if (data.analista == usu_id_inps) {
                document.getElementById("boton_agregar_activo").style.display = "block"
                $("#boton_agregar_activo").click(function (e) {
                    e.preventDefault();
                    $("#mdlAgregarActivo").modal("show");
                    get_servicios_subCat_activos();
                    get_dependencia_para_activo();
                    limpiar_formulario_activos();

                });

            } else {
                document.getElementById("boton_agregar_activo").style.display = "none"
            }
        },
        "json"
    );

    //get datos formulario activos
    function get_datos_formulario_activos() {
        let registro = {
            id_tarea: url_get_tarea,
            id_accion_concientizacion: $('#id_accion_concientizacion').val(),
            gde_activo: $('#gde_activo').val() == '' ? 'N/A' : $('#gde_activo').val(),
            ficha_activo: $('#ficha_activo').val() == '' ? 'N/A' : $('#ficha_activo').val(),
            nom_activo: $('#nom_activo').val(),
            cantidad_activo: $('#cantidad_activo').val() == '' ? 'N/A' : $('#cantidad_activo').val(),
            descrip_activo: $("#descrip_activo").val() == '' ? 'N/A' : $("#descrip_activo").val(),
            COD_DEP_PFA: cod_dep
        }
        return registro;
    }

    function insert_datos_activos_ajax(registro) {
        $.ajax({
            type: "POST",
            url: "../../../../Controller/ctrActivo.php?op_activo=insert_activo",
            data: registro,
            dataType: "json",
            success: function (response) {
            }, error: function (e) {
                console.log(e);
            }
        });
        
    }

    document.getElementById("btnInsertActivo").addEventListener("click", function () {
        if ($("#nom_activo").val() == '') {
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "El campo Activo es obligatorio!",
                showConfirmButton: true,
                showCancelButton: true
            })
        } else {
            let registro = get_datos_formulario_activos();
            insert_datos_activos_ajax(registro);
            Swal.fire({
                icon: "success",
                title: "Bien",
                text: "Activo guardado correctamente",
                timer: 1100,
                showConfirmButton: false,
                showCancelButton: false
            })
            $('#ver_activos_dependencias').DataTable().ajax.reload();
            $("#mdlAgregarActivo").modal("hide");
        }
    })
})

init();