
function init() {

}

var url = "http://localhost/Tecnica"
var url_search_param = new URLSearchParams(location.search);
var url_id_ver_tarea = url_search_param.get('ver_tarea');
var url_tarea_id = url_search_param.get('tarea');
var usu_id = $("#usu_id").val();



$.post("../../../Controller/ctrTareas.php?op_tarea=get_tarea_x_analista_detalle", { id: url_tarea_id },
    function (data, textStatus, jqXHR) {
        if (data.servicio != 1) {
            $("#cont_reporte_analisis_vuln_zap").remove();
            $("#cont_reporte_analisis_vuln_nmap").remove();
        }
        if (data.analista != usu_id) {
            $("#form_tareas").hide();
        }
        if (data.servicio == 2 && data.contador != 2) {
            $(document).ready(function () {
                $("#mdlSiem").modal("show");
            });

        } else if (data.contador == 2) {
            $.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_tabla_siem", { tarea_id: url_tarea_id },
                function (data, textStatus, jqXHR) {
                    document.getElementById("cont_get_datos_tabla_siem").innerHTML = data;
                },
                'html'
            );
        }
        if (data.servicio == 1) {

            $("#cont_detalle_tabla_evento_siem").hide();
            $("#cont_reporte_analisis_vuln_zap").show();
            $("#cont_reporte_analisis_vuln_nmap").show();
            let htmltbody = `
                    <tr>
                    <th class="ps-0 pb-0 text-muted" scope="row">Fecha de creacion :</th>
                    <td id="id_fech_crea" class="fs-14 pb-0">${data.fech_crea == '' ? 'No posee' : data.fech_crea}</td>
                </tr>
                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">Dependencia :</th>
                    <td id="id_gde" class="fs-14 pb-0">${data.dependencia == '' ? 'No posee' : data.dependencia}</td>
                </tr>
                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">N° GDE :</th>
                    <td id="id_gde" class="fs-14 pb-0">${data.gde == '' ? 'No posee' : data.gde}</td>
                </tr>
                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">Servicio :</th>
                    <td id="id_servicio" class="fs-14 pb-0">${data.nombre_servicio}</td>
                </tr>

                ${data.servicio == 1 ? "" : `<tr><th class="ps-0 text-muted pb-0" scope="row">Categoria SIEM :</th>
                        <td id="id_servicio" class="fs-14 pb-0">${data.sub_cat_siem}</td>
                        </tr>`
                }
                
                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">Operador :</th>
                    <td id="id_operador" class="fs-14 pb-0">${data.usuario_operador}</td>
                </tr>
                <tr>
                <th class="ps-0 text-muted pb-0" scope="row">Analista :</th>
                <td id="id_operador" class="fs-14 pb-0">${data.usuario_analista}</td>
            </tr>
                <tr>
                    <th class="ps-0 text-muted" scope="row">Detalle :</th>
                    <td id="id_detalle" class="fs-14">${data.descripcion == '' ? 'No posee' : data.descripcion}</td>
                </tr>
            <tr>
                <th class="ps-0 text-muted" scope="row">Ips :</th>
                <td id="id_detalle" class="fs-14"><span class="badge badge-soft-primary">${data.ips == '' ? 'No posee' : data.ips == null ? 'No posee' : data.ips}</span>
                </td>
            </tr>

            <tr>
                <th class="ps-0 text-muted" scope="row">Urls :</th>
                    <td id="id_detalle" class="fs-14"><span class="badge badge-soft-primary">${data.urls == '' ? 'No posee' : data.urls == null ? 'No posee' : data.urls}</span></td>
                </tr>
            <tr>

            <tr>
                <th style="margin-left:20px" class="p-0 m-0 text-muted" scope="row" id="contbtnAgregarXmlNmap">
                    <div style="display:flex;">
                        <button style="height: 30px;" id="lanzarEscaneoNmap" type="button" onclick="lanzarEscaneoNmap(${data.id})" class="btn btn-sm pl-1 pr-1 pt-0 pb-0 mb-3 mr-3 btn-dark btn-animation waves-effect waves-light">Lanzar escaneo Nmap<i class="ri-code-box-fill fs-18"></i></button> 
                        <span style="height: 30px; display: flex; align-items: center; justify-content: center;" id="btnAgregarXmlNmap" type="button" onclick="subirXmlNmap(${data.id})"data-toggle="tooltip" data-placement="top" title="Subir reporte xml de Nmap" class="btn btn-sm mb-3 mx-1 btn-dark btn-animation waves-effect waves-light"><i class="ri-file-code-fill fs-18"></i></span>
                    </div>
                </th>
            </tr>

            <tr>
                <th style="margin-left:20px" class="p-0 m-0 text-muted" scope="row" id="contbtnAgregarXmlNmap">
                </th>
            </tr>

            <tr>
                <th class="p-0 m-0 text-muted" scope="row" id="contbtnAgregarXml">
                    <button id="btnAgregarXml" type="button" onclick="subirXml(${data.id})" class="btn btn-sm pl-1 pr-1 pt-0 pb-0 mb-3 btn-info btn-animation waves-effect waves-light">Subir reporte de escaneo Zap<i class="ri-code-box-fill fs-18"></i></button>
                </th>
            </tr>`;
            document.querySelector("#tbody_datos_tarea_x_analista").innerHTML = htmltbody;

        } else if (data.servicio == 14) {
            $("#cont_detalle_tabla_evento_siem").hide();
            $("#cont_reporte_analisis_vuln_zap").hide();
            $("#cont_reporte_analisis_vuln_nmap").hide();
            document.getElementById("container_relevamiento_activos_concientizacion").style.display = "block";
            let htmltbody = `
                    <tr>
                    <th class="ps-0 pb-0 text-muted" scope="row">Fecha de creacion :</th>
                    <td id="id_fech_crea" class="fs-14 pb-0">${data.fech_crea == '' ? 'No posee' : data.fech_crea}</td>
                </tr>
                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">Dependencia :</th>
                    <td id="id_gde" class="fs-14 pb-0">${data.dependencia == '' ? 'No posee' : data.dependencia}</td>
                </tr>
                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">N° GDE :</th>
                    <td id="id_gde" class="fs-14 pb-0">${data.gde == '' ? 'No posee' : data.gde}</td>
                </tr>
                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">Servicio :</th>
                    <td id="id_servicio" class="fs-14 pb-0">${data.nombre_servicio}</td>
                </tr>

                <tr>
                <th class="ps-0 text-muted pb-0" scope="row">Tipo :</th>
                <td id="id_servicio" class="fs-14 pb-0">${data.subcat_concientizacion}</td>
            </tr>

                    ${data.servicio == 14 ? "" : `<tr><th class="ps-0 text-muted pb-0" scope="row">Categoria SIEM :</th>
                        <td id="id_servicio" class="fs-14 pb-0">${data.sub_cat_siem}</td>
                        </tr>`
                }

                <tr>
                    <th class="ps-0 text-muted pb-0" scope="row">Operador :</th>
                    <td id="id_operador" class="fs-14 pb-0">${data.usuario_operador}</td>
                </tr>
                <tr>
                <th class="ps-0 text-muted pb-0" scope="row">Analista :</th>
                <td id="id_operador" class="fs-14 pb-0">${data.usuario_analista}</td>
            </tr>
                <tr>
                    <th class="ps-0 text-muted" scope="row">Detalle :</th>
                    <td id="id_detalle" class="fs-14">${data.descripcion == '' ? 'No posee' : data.descripcion}</td>
                </tr>
            <tr>`;
            document.querySelector("#tbody_datos_tarea_x_analista").innerHTML = htmltbody;
            let usu_id_inps = document.getElementById("usu_id").value;

            if (data.analista == usu_id_inps && data.estado === "En proceso") {
                document.getElementById("container_relevamiento_activos_concientizacion").innerHTML = `<a target="_blank" rel="noopener noreferrer" type="button" href="${url + '/View/Home/Inspecciones/CargaActivos/verActivos.php?tarea=' + url_tarea_id + '&dep=' + data.COD_DEP_PFA}" class="btn btn-primary btn-sm">Ir a Cargar Activo</a>`;
            } else {
                document.getElementById("container_relevamiento_activos_concientizacion").style.display = "none"
            }

        }

        else if (data.servicio == 2) {
            $("#cont_detalle_tabla_evento_siem").show();
            $("#cont_reporte_analisis_vuln_zap").hide();
            $("#cont_reporte_analisis_vuln_nmap").hide();
            let htmltbody = `
            <tr>
            <th class="ps-0 pb-0 text-muted" scope="row">Fecha de creacion :</th>
            <td id="id_fech_crea" class="fs-14 pb-0">${data.fech_crea == '' ? 'No posee' : data.fech_crea}</td>
        </tr>
        <tr>
            <th class="ps-0 text-muted pb-0" scope="row">Dependencia :</th>
            <td id="id_gde" class="fs-14 pb-0">${data.dependencia == '' ? 'No posee' : data.dependencia}</td>
        </tr>
        <tr>
            <th class="ps-0 text-muted pb-0" scope="row">N° GDE :</th>
            <td id="id_gde" class="fs-14 pb-0">${data.gde == '' ? 'No posee' : data.gde}</td>
        </tr>
    <tr>
            <th class="ps-0 text-muted pb-0" scope="row">Servicio :</th>
            <td id="id_servicio" class="fs-14 pb-0">${data.nombre_servicio}</td>
    </tr>
    <tr>
    <th class="ps-0 text-muted pb-0" scope="row">Subcategoria del Servicio :</th>
        <td id="id_servicio" class="fs-14 pb-0">${data.sub_cat_siem}</td>
    </tr>
        <tr>
            <th class="ps-0 text-muted pb-0" scope="row">Operador :</th>
            <td id="id_operador" class="fs-14 pb-0">${data.usuario_operador}</td>
        </tr>
        <tr>
        <th class="ps-0 text-muted pb-0" scope="row">Analista :</th>
        <td id="id_operador" class="fs-14 pb-0">${data.usuario_analista}</td>
    </tr>
        <tr>
            <th class="ps-0 text-muted" scope="row">Detalle :</th>
            <td id="id_detalle" class="fs-14">${data.descripcion == '' ? 'No posee' : data.descripcion}</td>
        </tr>`;
            document.querySelector("#tbody_datos_tarea_x_analista").innerHTML = htmltbody;
        }
        else if (data.servicio == 3 || data.servicio == 4 || data.servicio == 5 ||
            data.servicio == 6 || data.servicio == 7 || data.servicio == 8 ||
            data.servicio == 9 || data.servicio == 10 || data.servicio == 11 ||
            data.servicio == 12 || data.servicio == 14) {
            $("#cont_detalle_tabla_evento_siem").hide();
            $("#cont_reporte_analisis_vuln_zap").hide();
            $("#cont_reporte_analisis_vuln_nmap").hide();
            let htmltbody = `
            <tr>
            <th class="ps-0 pb-0 text-muted" scope="row">Fecha de creacion :</th>
            <td id="id_fech_crea" class="fs-14 pb-0">${data.fech_crea == '' ? 'No posee' : data.fech_crea}</td>
        </tr>
        <tr>
            <th class="ps-0 text-muted pb-0" scope="row">Dependencia :</th>
            <td id="id_gde" class="fs-14 pb-0">${data.dependencia == '' ? 'No posee' : data.dependencia}</td>
        </tr>
        <tr>
            <th class="ps-0 text-muted pb-0" scope="row">N° GDE :</th>
            <td id="id_gde" class="fs-14 pb-0">${data.gde == '' ? 'No posee' : data.gde}</td>
        </tr>
    <tr>
            <th class="ps-0 text-muted pb-0" scope="row">Servicio :</th>
            <td id="id_servicio" class="fs-14 pb-0">${data.nombre_servicio}</td>
    </tr>
        <tr>
            <th class="ps-0 text-muted pb-0" scope="row">Operador :</th>
            <td id="id_operador" class="fs-14 pb-0">${data.usuario_operador}</td>
        </tr>
        <tr>
        <th class="ps-0 text-muted pb-0" scope="row">Analista :</th>
        <td id="id_operador" class="fs-14 pb-0">${data.usuario_analista}</td>
    </tr>
        <tr>
            <th class="ps-0 text-muted" scope="row">Detalle :</th>
            <td id="id_detalle" class="fs-14">${data.descripcion == '' ? 'No posee' : data.descripcion}</td>
        </tr>`;
            document.querySelector("#tbody_datos_tarea_x_analista").innerHTML = htmltbody;
        }
    },
    "json"
);



$(document).ready(function () {


    document.getElementById("img_base64").addEventListener("input", function () {
        $("#img_tarea").hide();
    })

    document.getElementById("img_tarea").addEventListener("change", function () {
        $("#img_base64").hide();
    })

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_tarea_x_analista_detalle", { id: url_tarea_id },
        function (data, textStatus, jqXHR) {
            if (data.estado == "En proceso") {
                $("#label_estado_tarea").addClass("badge bg-success pt-2");
                $("#label_estado_tarea").html("En proceso")

                $("#btnGuardarActividad").click(function (e) {
                    e.preventDefault();
                    if ($("#summernote").val() == '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Error, campo vacío',
                            text: 'Debe ingresar la descripción de la tarea',
                            showConfirmButton: true,
                            showCancelButton: false
                        })
                    } else {
                        var fileInput = $("#img_tarea")[0]; // Convertir a elemento DOM
                        // Verificar si se cargó un archivo
                        if (fileInput.files.length > 0) {
                            var file = fileInput.files[0]; // Obtener el primer archivo seleccionado
                            // Verificar la extensión del archivo
                            if (file.type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error de extensión',
                                    text: 'El archivo debe no ser un documento DOCX',
                                    showConfirmButton: true,
                                    showCancelButton: false,
                                });
                                $("#img_tarea").val('')
                                return;
                            }
                        }

                        Swal.fire({
                            icon: 'success',
                            title: 'Bien',
                            text: 'Actividad guardada correctamente',
                            timer: 1300,
                            showConfirmButton: false,
                            showCancelButton: false
                        });

                        var registro = new FormData();
                        // Agregar datos al objeto FormData
                        registro.append('descripcion', $("#summernote").val());
                        registro.append('tarea_id', url_tarea_id);
                        registro.append('est', 1);

                        // Agregar el archivo al FormData si está presente
                        if (fileInput.files.length > 0) {
                            var file = fileInput.files[0]; // Obtener el primer archivo seleccionado
                            registro.append('img_tarea', file);
                        }

                        // Agregar la captura de imagen en base64 al FormData si está presente
                        if ($("#img_base64").val() != '') {
                            registro.append('img_base64', $("#img_base64").val());
                        }

                        // Realizar la solicitud AJAX
                        $.ajax({
                            type: "POST",
                            url: "../../../Controller/ctrTareas.php?op_tarea=insert_actividad",
                            data: registro,
                            processData: false, // Evitar que jQuery procese los datos
                            contentType: false, // No establecer el tipo de contenido
                            dataType: "json",
                            success: function (response) {
                                (response);
                            },
                            error: function (error) {
                                (error);
                            }
                        });
                        setInterval(() => {
                            location.reload();
                        }, 1300);
                    }
                });

            } else if (data.estado == "Pendiente") {
                $("#label_estado_tarea").addClass("badge bg-warning pt-2");
                document.getElementById("label_estado_tarea").style.color = "#000";
                $("#label_estado_tarea").html("Pendiente");
                $("#form_tareas").hide();
            } else {
                $("#label_estado_tarea").addClass("badge bg-info pt-2");
                $("#label_estado_tarea").html("Finalizada");
                $("#form_tareas").hide();
            }
            if (usu_id == data.analista && data.estado == "En proceso") {
                $("#btn_group_tarea").show();
                $('#summernote').summernote({
                    height: 200,
                    readOnly: true,
                    disableFullscreen: true,
                    disablePicture: true,
                    callbacks: {
                        onImageUpload: function (files) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error',
                                text: 'No se permiten subidas de imagen o capturas en este campo',
                                showConfirmButton: true,
                                showCancelButton: false
                            });
                            return false; // Evita la carga de imágenes
                        }
                    }
                });
            } else {
                $('#summernote').hide();
                $("#btn_group_tarea").hide();
            }

        },
        "json"
    );


    $.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_tarea_finalizada", { tarea_id: url_tarea_id },
        function (data, textStatus, jqXHR) {
            if (data) {
                document.getElementById("btnEliminarXml").style.display = "none";
                document.getElementById("btnEliminarXml_nmap").style.display = "none";
            }
        },
        "json"
    );

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_finalizacion_tarea", { tarea_id: url_tarea_id },
        function (data, textStatus, jqXHR) {
            console.log(data);
            if (data.length == 0) {
                document.getElementById("cont_tarea_finalizada").style.display = "none";
            } else {
                document.getElementById("cont_tarea_finalizada").style.display = "block";
                document.getElementById("desc_tarea_finalizada").innerText = data[0].descripcion_cierre
                document.getElementById("fech_tarea_finalizada").innerText = data[0].fech_finalizacion
            }
        },
        "json"
    );

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_actividades_x_analista", { tarea_id: url_tarea_id },
        function (data, textStatus, jqXHR) {
            document.getElementById("container_actividades_realizadas").innerHTML = data;
        },
        "html   "
    );

    // Evento de pegar para el input
    $('#img_base64').on('paste', function (event) {
        var items = (event.clipboardData || event.originalEvent.clipboardData).items;
        for (index in items) {
            var item = items[index];
            if (item.kind === 'file') {
                var blob = item.getAsFile();
                var reader = new FileReader();
                reader.onload = function (event) {
                    // Agregar el valor base64 al input
                    $('#img_base64').val(event.target.result);
                };
                reader.readAsDataURL(blob);
            }
        }
    });
});
function subirXml(id) {
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_tarea", { id: id },
        function (data, textStatus, jqXHR) {
            if (data.urls == '' || data.urls == null) {
                return;
            } else {
                // window.open(url + "/View/Home/Trabajos/subirArchivo.php?proyecto=" + id);
                $("#modalAgregarArchivoZap").modal("show")
            }
        },
        "json"
    );
}

function subirXmlNmap(id) {
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_tarea", { id: id },
        function (data, textStatus, jqXHR) {
            if (data.ips == '' || data.ips == null) {
                return;
            } else {
                $("#modalAgregarArchivoNmap").modal("show")
            }
        },
        "json"
    );
}

function btnEliminarXml_nmap(tarea) {
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_archivos_xml", { tarea_id: tarea, nom_herramienta: "nmap" },
        function (data, textStatus, jqXHR) {
            if (data == false) {
                Swal.fire({
                    icon: "question",
                    text: "No posee ningun archivo .xml almacenado para eliminar!",
                    showCancelButton: true,
                    showConfirmButton: true
                })
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Atención!",
                    text: "Está a punto de eliminar el archivo xml almacenado. ¿Desea continuar?",
                    showCancelButton: true,
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../Controller/ctrTareas.php?op_tarea=eliminarXml", { tarea_id: tarea, nom_herramienta: "nmap" },
                            function (data, textStatus, jqXHR) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Bien",
                                    text: "Eliminado correctamente",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }
                        );
                    }
                });
            }
        },
        "json"
    );
}

function btnEliminarXml(tarea) {
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_archivos_xml", { tarea_id: tarea, nom_herramienta: "zap" },
        function (data, textStatus, jqXHR) {
            if (data == false) {
                Swal.fire({
                    icon: "question",
                    text: "No posee ningun archivo .xml almacenado para eliminar!",
                    showCancelButton: true,
                    showConfirmButton: true
                })
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Atención!",
                    text: "Está a punto de eliminar el archivo xml almacenado. ¿Desea continuar?",
                    showCancelButton: true,
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../Controller/ctrTareas.php?op_tarea=eliminarXml", { tarea_id: tarea, nom_herramienta: "zap" },
                            function (data, textStatus, jqXHR) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Bien",
                                    text: "Eliminado correctamente",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }
                        );
                    }
                });
            }
        },
        "json"
    );
}

function eliminarActividad(id) {
    Swal.fire({
        icon: 'warning',
        title: "Atencion!",
        text: "Desea eliminar esta actividad?",
        showCancelButton: true,
        showConfirmButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: "Bien",
                text: "Eliminado correctamente",
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1100
            })
            $.post("../../../Controller/ctrTareas.php?op_tarea=delete_actividad", { id: id },
                function (data, textStatus, jqXHR) {

                },
                "json"
            );
            setTimeout(() => {
                location.reload();
            }, 1100);
        }
    })
}

$("#btnCerrarActividad").click(function (e) {
    e.preventDefault();

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_actividades_x_tarea", { tarea_id: url_tarea_id },
        function (data, textStatus, jqXHR) {
            if (data == false) {
                Swal.fire({
                    icon: "warning",
                    title: "Error!",
                    text: "Al menos debe ingresar una actividad",
                    showConfirmButton: true,
                    showCancelButton: false
                })
            } else {
                $.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_tarea", { id: url_tarea_id },
                    function (data, textStatus, jqXHR) {
                        if (data.servicio == 7) {
                            $("#gde_finalizar_tarea").attr('disabled', 'disabled');
                            $("#gde_finalizar_tarea").css("text-align", "center")
                            $("#gde_finalizar_tarea").val('No posee num. de GDE o descripcion')
                        }
                    },
                    "json"
                );

                $("#gde_finalizar_tarea").val('')
                $("#mdlFinalziarTareas").modal("show");
            }
        },
        "json"
    );

})

function finalizarTarea() {
    let registro = {
        tarea_id: url_tarea_id,
        gde: $("#gde_finalizar_tarea").val(),
    }

    $.ajax({
        type: "POST",
        url: "../../../Controller/ctrTareas.php?op_tarea=finalizar_tarea",
        data: registro,
        dataType: "json",
        success: function (response) {
            (response);
        }, error: function (error) {
            (error);
        }
    });

    $.ajax({
        type: "POST",
        url: "../../../Controller/ctrTareas.php?op_tarea=update_finalizar_tarea",
        data: { id: url_tarea_id },
        dataType: "json",
        success: function (response) {
        }, error: function (error) {
        }
    });
}

let registroSinGde = {
    tarea_id: url_tarea_id,
    gde: "No posee"
}

$("#btnFinalizarActividad").click(function (e) {
    e.preventDefault();
    if ($("#gde_finalizar_tarea").val() == '') {
        Swal.fire({
            icon: "warning",
            title: "Atencion!",
            text: "Desea finalizar sin num. de GDE o descripcion?",
            showCancelButton: true,
            showConfirmButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "../../../Controller/ctrTareas.php?op_tarea=finalizar_tarea",
                    data: registroSinGde,
                    dataType: "json",
                    success: function (response) {
                    }, error: function (error) {
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "../../../Controller/ctrTareas.php?op_tarea=update_finalizar_tarea",
                    data: { id: url_tarea_id },
                    dataType: "json",
                    success: function (response) {
                    }, error: function (error) {
                    }
                });
            }
            $('#mdlFinalziarTareas').modal('hide');
            setInterval(() => {
                location.reload()
            }, 1300);
        })
    } else {
        finalizarTarea()
        Swal.fire({
            icon: "success",
            title: "Bien",
            text: "Proyecto archivado correctamente",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 1300
        });
        $('#mdlFinalziarTareas').modal('hide');
        setInterval(() => {
            location.reload()
        }, 1300);
    }
});


$.post("../../../Controller/ctrTareas.php?op_tarea=get_nombre_xml_nmap_almacenado", { tarea_id: url_tarea_id },
    function (data, textStatus, jqXHR) {
        console.log(data);
    },
    "json"
);

$("#subir_xml_zap").click(function (e) {
    e.preventDefault();

    $("#mje_xml").html("Archivo procesado correctamente");
    setTimeout(function () {
        $("#subir_xml_zap").closest("form").submit();
    }, 1100);
});

$("#subir_xml_nmap").click(function (e) {
    e.preventDefault();
    // Mostrar mensaje archivo procesado
    $("#mje_xml_nmap").html("Archivo procesado correctamente");
    setTimeout(function () {
        $("#subir_xml_nmap").closest("form").submit();
    }, 1100);
});

$.post("../../../Controller/ctrTareas.php?op_tarea=get_nombre_xml_zap_almacenado", { tarea_id: url_tarea_id },
    function (data, textStatus, jqXHR) {
        if (data.nom_archivo != '' || data.nom_archivo != null) {
            let nom_xml = data.nom_archivo;
            $.post("../../../Controller/ctrTareas.php?op_tarea=simplexml_load_file", { nom_archivo: nom_xml },
                function (data, textStatus, jqXHR) {

                    const attibutes = data['@attributes'];
                    let htmlEncabezado = '';
                    htmlEncabezado += `
                    <li class="list-group-item">Fecha de escaneo: <span class="badge badge-outline-secondary">${attibutes.generated}</span></li>
                    <li class="list-group-item">Programa: <span class="badge badge-outline-secondary">${attibutes.programName}</span></li>
                    <li class="list-group-item">Version: <span class="badge badge-outline-secondary">${attibutes.version}</span></li>
                    `;
                    document.getElementById("datos_del_escanner_zap").innerHTML = htmlEncabezado;

                    let imgUrl = `${url}/Public/Uploads/zap.png`;
                    let img = `<img src='${imgUrl}' width='20' height='20'>`;
                    document.getElementById("tipo_de_scanner").innerHTML = img;
                    document.getElementById("reporte_analisis_va").innerText = "Repote Analisis de Vulnerabilidades - Resultado"

                    function result_xml() {
                        const siteAttributes = data.site["@attributes"];
                        const siteXmlZap = data.site.alerts["alertitem"];

                        let htmlEncabezadoData = ``;
                        let htmlCuerpoCantidadDeEvidencias = '';

                        htmlEncabezadoData = `
                        <li class="list-group-item">Host: <span class="badge badge-outline-secondary">${siteAttributes.host}</span></li>
                        <li class="list-group-item">URL: <span class="badge badge-outline-secondary">${siteAttributes.name}</span></li>
                        <li class="list-group-item">Puerto: <span class="badge badge-outline-secondary">${siteAttributes.port}</span></li>
                        <li class="list-group-item">Ssl: <span class="badge badge-outline-secondary">${siteAttributes.ssl}</span></li>
                        `;
                        document.getElementById("encabezado_reporte_xml_zap").innerHTML = htmlEncabezadoData;

                        for (const elem of siteXmlZap) {
                            htmlCuerpoCantidadDeEvidencias = `
                            <li class="list-group-item">Cantidad total de evidencias: <span class="badge badge-outline-secondary fs-11">${siteXmlZap.length}</span></li>
                            `;
                        }
                        document.getElementById("cantidadDeEvidencias").innerHTML = htmlCuerpoCantidadDeEvidencias;

                        (siteXmlZap);

                        let htmlCuerpoData = '';

                        siteXmlZap.forEach((elem, index) => {
                            htmlCuerpoData += `
                                <ul class="bg-success">
                                    <li class="list-group-item badge badge-outline-success text-light fs-14">Evidencia ${index + 1} : <span>${elem.alert}</span></li>`;

                            // Verificar si elem.instances es un objeto
                            if (typeof elem.instances === 'object') {
                                htmlCuerpoData += `<ul class="list-group">`;

                                // Iterar sobre las propiedades de elem.instances
                                for (const key in elem.instances) {
                                    // Iterar sobre las propiedades de elem.instances
                                    if (elem.instances && elem.instances.instance && Array.isArray(elem.instances.instance) && elem.instances.instance.length > 0) {
                                        htmlCuerpoData += `<ul class="list-group text-light">Recursos afectados: ${elem.instances.instance.length}`;
                                        // Iterar sobre las instancias
                                        elem.instances.instance.forEach((instance, index) => {
                                            htmlCuerpoData += `<li class="list-group-item">Instancia ${index + 1}: ${instance.uri}</li>`;
                                        });

                                        htmlCuerpoData += `</ul>`;

                                        // Añade aquí el resto del código relacionado con la vulnerabilidad
                                    } else {
                                        // Si no hay instancias definidas, simplemente pasa al siguiente ciclo del bucle
                                        continue;
                                    }
                                }
                                htmlCuerpoData += `</ul>`;
                            }
                            htmlCuerpoData += `
                                    <li class="list-group-item">Descripcion: <span>${elem.desc}</span></li>
                                    <li class="list-group-item">Referencia: <span>${elem.reference}</span></li>
                                    <li class="list-group-item">Riesgo: <span class="badge bg-danger">${elem.riskdesc}</span></li>
                                    <li class="list-group-item">Solucion: <span>${elem.solution}</span></li>
                                </ul><br>`;
                        });
                        // Actualizar el contenido del elemento con el id "cuerpo_reporte_xml_zap"
                        document.getElementById("cuerpo_reporte_xml_zap").innerHTML = htmlCuerpoData;
                    }
                    result_xml();
                },
                "json"
            );
        }
    },
    "json"
);



$.post("../../../Controller/ctrTareas.php?op_tarea=get_nombre_xml_nmap_almacenado", { tarea_id: url_tarea_id },
    function (data, textStatus, jqXHR) {
        let nom_xml_nmap = data.nom_archivo;

        $.post("../../../Controller/ctrTareas.php?op_tarea=get_tarea_x_analista", { id: url_tarea_id },
            function (data, textStatus, jqXHR) {


                //********************************** INICIO ESTA PARTE NO TOCAR YA QUE PARSEA EL REPORTE IMPORTADO DEL NMAP     ************************************************* */
                if (data.nom_archivo != '' || data.nom_archivo != null) {
                    $.post("../../../Controller/ctrTareas.php?op_tarea=simplexml_load_file_nmap", { nom_archivo: nom_xml_nmap },
                        function (data, textStatus, jqXHR) {
                            let xmlAtributes = data['@attributes'];
                            // Cadena de fecha proporcionada por el XML de Nmap
                            var fechaNmap = xmlAtributes.startstr;

                            function convertirFecha(fecha) {
                                // Array de nombres de los días de la semana en español
                                var diasSemana = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
                                // Array de nombres de los meses en español
                                var meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
                                // Parsea la cadena de fecha
                                var fechaParseada = new Date(fecha);
                                // Obtiene los componentes de la fecha
                                var diaSemana = diasSemana[fechaParseada.getDay()];
                                var dia = fechaParseada.getDate();
                                var mes = meses[fechaParseada.getMonth()];
                                var año = fechaParseada.getFullYear();
                                var horas = fechaParseada.getHours();
                                var minutos = fechaParseada.getMinutes();
                                var segundos = fechaParseada.getSeconds();

                                // Formatea la fecha en español
                                var fechaEnEspañol = diaSemana + " " + dia + " de " + mes + " de " + año + " " + horas + ":" + minutos + ":" + segundos;

                                return fechaEnEspañol;
                            }

                            var fechaConvertida = convertirFecha(fechaNmap);
                            let htmlEncabezado = '';
                            htmlEncabezado += `
                                <li class="list-group-item bg-dark text-light">Fecha de escaneo: <span class="badge badge-outline-success fs-12">${fechaConvertida}</span></li>
                                <li class="list-group-item bg-dark text-light">Scanner: <span class="badge badge-outline-success fs-12">${xmlAtributes.scanner}</span></li>
                                <li class="list-group-item bg-dark text-light">Version: <span class="badge badge-outline-success fs-12">${xmlAtributes.version}</span></li>
                                `;
                            document.getElementById("datos_del_escanner_nmap").innerHTML = htmlEncabezado;
                            let cuerpo_reporte_xml_nmap = data.output;

                            let htmlEncabezadoCuerpo = '';
                            htmlEncabezadoCuerpo += `
                                <div class="list-group-item bg-dark text-light fs-14">Resultado: <p class="fs-12"><pre>${cuerpo_reporte_xml_nmap}</p></div>
                                `;
                            let imgUrl = `${url}/Public/Uploads/nmap.jpeg`;
                            let img = `<img src='${imgUrl}' width='70' height='40'>`;
                            document.getElementById("tipo_de_scanner_nmap").innerHTML = img;
                            document.getElementById("reporte_analisis_va_nmap").innerText = "Reporte Analisis de Vulnerabilidades - Resultado"
                            document.getElementById("cuerpo_reporte_xml_zap_nmap").innerHTML = htmlEncabezadoCuerpo;
                        }
                    );
                }
                //********************************** FIN ESTA PARTE NO TOCAR YA QUE PARSEA EL REPORTE IMPORTADO DEL NMAP     ************************************************* */
            },
            "json"
        );
    },
    "json"
);

$.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_siem", { tarea_id: url_tarea_id },
    function (data, textStatus, jqXHR) {

        function data() {
            let registro = {
                tarea_id: url_tarea_id,
                fecha_evento: $("#fecha_evento").val() == '' ? "N/A" : $("#fecha_evento").val(),
                nom_incidencia: $("#nom_incidencia").val() == '' ? "N/A" : $("#nom_incidencia").val(),
                event_name: $("#event_name").val() == '' ? "N/A" : $("#event_name").val(),
                reporting_device: $("#reporting_device").val() == '' ? "N/A" : $("#reporting_device").val(),
                reporting_model: $("#reporting_model").val() == '' ? "N/A" : $("#reporting_model").val(),
                source_ip: $("#source_ip").val() == '' ? "N/A" : $("#source_ip").val(),
                destination_ip: $("#destination_ip").val() == '' ? "N/A" : $("#destination_ip").val(),
                process_path: $("#process_path").val() == '' ? "N/A" : $("#process_path").val(),
                process_name: $("#process_name").val() == '' ? "N/A" : $("#process_name").val(),
                url: $("#url").val() == '' ? "N/A" : $("#url").val(),
                information_url: $("#information_url").val() == '' ? "N/A" : $("#information_url").val(),
                contador: 2
            }
            return registro;
        }

        function insert_datos_siem_ajax(registro) {
            $.ajax({
                type: "POST",
                url: "../../../Controller/ctrTareas.php?op_tarea=insert_datos_siem",
                data: registro,
                dataType: "json",
                success: function (jqXHR, textStatus, errorThrown) {

                }, error: function (jqXHR, textStatus, errorThrown) {

                }
            })
        }

        $("#btnGuardarEventoSiem").click("click", function (e) {
            e.preventDefault();
            let registro = data();
            insert_datos_siem_ajax(registro);
            Swal.fire({
                icon: "success",
                title: "Bien",
                text: "Datos guardados correctamente!",
                showCancelButton: false,
                showConfirmButton: false,
                timer: 1100
            });
            setTimeout(() => {
                location.reload();
            }, 1100);
        })


    },
    "json"
);


$.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_tabla_siem", { tarea_id: url_tarea_id },
    function (data, textStatus, jqXHR) {
        console.log(data);
    },
    "json"
);


$.post("../../../Controller/ctrTareas.php?op_tarea=validar_si_se_subio_archivo_xml_zap", { tarea_id: url_tarea_id, nom_herramienta: "zap" },
    function (data, textStatus, jqXHR) {
        if (data == false) {
            $("#contbtnAgregarXml").show();
        } else {
            $("#contbtnAgregarXml").hide();

        }
    },
    "json"
);

function lanzarEscaneoNmap(id) {
    location.href = url + "//View/Home/Trabajos/lanzarEscaneo.php?tarea=" + id;
}

$.post("../../../Controller/ctrTareas.php?op_tarea=validar_si_se_subio_archivo_xml_nmap", { tarea_id: url_tarea_id, nom_herramienta: "nmap" },
    function (data, textStatus, jqXHR) {
        if (data == false) {
            $("#contbtnAgregarXmlNmap").show();
        } else {
            $("#contbtnAgregarXmlNmap").hide();
        }
    },
    "json"
);
$.post("../../../Controller/ctrTareas.php?op_tarea=get_datos_tarea", { id: url_tarea_id },
    function (data, textStatus, jqXHR) {
        console.log(data);
        if (data.estado == "Finalizada") {
            document.getElementById("btnAgregarXml").style.display = "none";
            document.getElementById("btnAgregarXmlNmap").style.display = "none";
            document.getElementById("lanzarEscaneoNmap").style.display = "none";
        } else {
            document.getElementById("btnAgregarXml").style.display = "block";
            document.getElementById("btnAgregarXmlNmap").style.display = "block";
        }
    },
    "json"
);


init();