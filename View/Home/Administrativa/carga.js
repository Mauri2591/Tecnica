function init() {

}

$(document).ready(function () {

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_activas_x_sector", { sector_id: 1 },
        function (data, textStatus, jqXHR) {
            let htmlTable = '';
            data.forEach((elem, index) => {
                htmlTable += `<tr>
                <td>${index + 1}</td>
                <td>${elem.gde}</td>
                <td><span style="cursor:default" type="button" data-toggle="tooltip" data-placement="top" title="${elem.servicio_descripcion}">${elem.nombre_servicio}</span></td>
                <td>${elem.operador}</td>
                <td>${elem.analista_nombre}</td>
                <td>${elem.nombre_sector}</td>
                <td>
                    <span type="button" onclick='tomarTareaSoc(${elem.id})' 
                        class="badge rounded-pill ${elem.estado == 'Pendiente' ? 'bg-warning' : elem.estado == 'En proceso' ? 'bg-info' : ''}" 
                        style="color: ${elem.estado == 'Pendiente' ? '#222' : elem.estado == 'En proceso' ? '#fff' : ''}; font-size: 12px;">
                        ${elem.estado == "Pendiente" ? "Pendiente" :
                        elem.estado == "En proceso" ? "En proceso" : ""}
                    </span>
                </td>                    
                </tr>`;
            });
            document.getElementById("tbody_total_tareas_vista_carga_soc").innerHTML = htmlTable;
        },
        "json"
    );

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_activas_x_sector", { sector_id: 2 },
        function (data, textStatus, jqXHR) {
            let htmlTable = '';
            data.forEach((elem, index) => {
                htmlTable += `<tr>
                <td>${index + 1}</td>
                <td>${elem.gde}</td>
                <td>${elem.nombre_servicio}</td>
                <td>${elem.operador}</td>
                <td>${elem.analista_nombre}</td>
                <td>${elem.nombre_sector}</td>
                <td>
                <span type="button" onclick='tomarTareaTecnica(${elem.id})' 
                    class="badge rounded-pill ${elem.estado == 'Pendiente' ? 'bg-warning' : elem.estado == 'En proceso' ? 'bg-info' : ''}" 
                    style="color: ${elem.estado == 'Pendiente' ? '#222' : elem.estado == 'En proceso' ? '#fff' : ''}; font-size: 12px;">
                    ${elem.estado == "Pendiente" ? "Pendiente" :
                        elem.estado == "En proceso" ? "En proceso" : ""}
                </span>
            </td>                  </tr>`;
            });
            document.getElementById("tbody_total_tareas_vista_carga_tecnica").innerHTML = htmlTable;
        },
        "json"
    );

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_activas_x_sector", { sector_id: 3 },
        function (data, textStatus, jqXHR) {
            let htmlTable = '';
            data.forEach((elem, index) => {
                htmlTable += `<tr>
                <td>${index + 1}</td>
                <td>${elem.gde}</td>
                <td>${elem.nombre_servicio}</td>
                <td>${elem.operador}</td>
                <td>${elem.analista_nombre}</td>
                <td>${elem.nombre_sector}</td>
                <td>
                <span type="button" onclick='tomarTareaConcientizacion(${elem.id})' 
                    class="badge rounded-pill ${elem.estado == 'Pendiente' ? 'bg-warning' : elem.estado == 'En proceso' ? 'bg-info' : ''}" 
                    style="color: ${elem.estado == 'Pendiente' ? '#222' : elem.estado == 'En proceso' ? '#fff' : ''}; font-size: 12px;">
                    ${elem.estado == "Pendiente" ? "Pendiente" :
                        elem.estado == "En proceso" ? "En proceso" : ""}
                </span>
            </td>                  </tr>`;
            });
            document.getElementById("tbody_total_tareas_vista_carga_concientizacion").innerHTML = htmlTable;
        },
        "json"
    );


    //***************************   INICIO vista SOC ******************************
    function btnAgregarTareaSoc() {
        try {
            let modalAbierto = false;
            if (!modalAbierto) {
                document.getElementById("btnAgregarTareaSoc").addEventListener("click", function () {
                    $("#dependenciaValorSoc").val('');
                    $("#dependenciaInputSoc").val('');
                    $("#dependenciaInputCodigoSoc").val('');
                    $("#descripcionSoc").val('');

                    function get_dependencia() {
                        $("#dependenciaInputSoc").on('input', function (e) {
                            e.preventDefault();
                            let descripcion = $(this).val().trim();
                            if (descripcion === "") {
                                $("#dependenciaValorSoc").val("");
                                return;
                            } else if (descripcion != "") {
                                $("#dependenciaInputCodigoSoc").val('');
                            }
                            $.post("../../../Controller/ctrTareas.php?op_tarea=get_dependencias", { desc_dependencia_pfa: descripcion },
                                function (data, textStatus, jqXHR) {
                                    data = JSON.parse(data);
                                    $("#dependenciaValorSoc").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                                    $("#cod_depSoc").val(data.COD_DEP_PFA);
                                    if ($("#dependenciaValorSoc").val() == "undefined - COD undefined") {
                                        Swal.fire({
                                            icon: "warning",
                                            title: "Error!",
                                            text: "Ingrese un nombre o codigo valido",
                                            showCancelButton: false,
                                            showConfirmButton: false,
                                            timer: 1200
                                        })
                                        $("#dependenciaInputSoc").val('');
                                        $("#dependenciaInputCodigoSoc").val('')
                                        $("#dependenciaValorSoc").val('')
                                    }
                                }
                            );

                        });

                        $("#dependenciaInputCodigoSoc").on('input', function (e) {
                            e.preventDefault();
                            let cod_dep_pfa = $(this).val().trim();
                            if (cod_dep_pfa === "") {
                                $("#dependenciaValorSoc").val("");
                                return;
                            } else if (cod_dep_pfa != '') {
                                $("#dependenciaInputSoc").val('')
                            }
                            $.post("../../../Controller/ctrTareas.php?op_tarea=get_dependenciasPorCodigo", { cod_dep_pfa: cod_dep_pfa },
                                function (data, textStatus, jqXHR) {
                                    data = JSON.parse(data);
                                    console.log(data);
                                    $("#dependenciaValorSoc").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                                    $("#cod_depSoc").val(data.COD_DEP_PFA);
                                    if ($("#dependenciaValorSoc").val() == "undefined - COD undefined") {
                                        Swal.fire({
                                            icon: "warning",
                                            title: "Error!",
                                            text: "Ingrese un nombre o codigo valido",
                                            showCancelButton: false,
                                            showConfirmButton: false,
                                            timer: 1200
                                        })
                                        $("#dependenciaInputSoc").val('');
                                        $("#dependenciaInputCodigoSoc").val('')
                                        $("#dependenciaValorSoc").val('')
                                    }
                                }
                            );
                        });
                    }
                    get_dependencia();

                    $("#gdeSoc").val('');
                    $("#descripcionSoc").val('');

                    //************************ Inicio Traer servicios SOC ***************************** */
                    function get_servicios_soc() {
                        $.post("../../../Controller/ctrServicios.php?op_servicio=get_servicios_soc",
                            function (data, textStatus, jqXHR) {
                                let htmlOption = '';
                                if ($("#validadorSoc").val() == "soc") {
                                    data.forEach(elem => {
                                        if (elem.id == 1 || elem.id == 2 || elem.id == 3 || elem.id == 4 || elem.id == 5 || elem.id == 7 || elem.id == 11) {
                                            htmlOption += `<option value=${elem.id}>${elem.nombre}</option>`;
                                        }
                                    });
                                    document.getElementById("servicioSoc").innerHTML = htmlOption;
                                }
                            },
                            "json"
                        );

                        $("#servicioSoc").on("change", function () {
                            // Si el valor seleccionado es 7, deshabilita #gdeSoc; de lo contrario, habilítalo.
                            if ($(this).val() == 7) {
                                $("#gdeSoc").val('No posee numero de GDE');
                                $("#gdeSoc").css('text-align', 'center');
                                $("#gdeSoc").prop('disabled', true);
                            } else {
                                $("#gdeSoc").val('');
                                $("#gdeSoc").prop('disabled', false);
                            }
                        });
                    }

                    get_servicios_soc();


                    //************************ Fin Traer servicios  ***************************** */


                    //************************ Inicio Traer operador SOC ***************************** */
                    function get_usuarioOperador() {
                        let usu_session = $("#usu_session").val();
                        $.post("../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 4 },
                            function (data, textStatus, jqXHR) {
                                let htmlOption = '';
                                data.forEach(elem => {
                                    htmlOption += `<option value="${elem.id}" ${elem.id == usu_session ? "selected" : ""} ${elem.id == usu_session ? "" : "disabled"}>${elem.nombre_usuario}</option>`;
                                });
                                document.getElementById("operadorSoc").innerHTML = htmlOption;
                            },
                            "json"
                        );
                    }
                    get_usuarioOperador();
                    //************************ Fin Traer operador  ***************************** */


                    //************************ Inicio Traer analista  ***************************** */
                    function get_usuarioAnalista() {
                        $.post("../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 1 },
                            function (data, textStatus, jqXHR) {
                                let htmlOption = '';
                                data.forEach(elem => {
                                    htmlOption += `<option value=${elem.id}>${elem.nombre_usuario}</option>`;
                                });
                                document.getElementById("analistaSoc").innerHTML = htmlOption;
                            },
                            "json"
                        );
                    }
                    get_usuarioAnalista();
                    //************************ Fin Traer analista  ***************************** */

                    //************************ Inicio Traer sector Soc  ***************************** */
                    function get_usuarioSector() {
                        $.post("../../../Controller/ctrSector.php?op_sector=get_sectores", { id: 1 },
                            function (data, textStatus, jqXHR) {
                                let htmlOption = '';
                                data.forEach(elem => {
                                    htmlOption += `<option value=${elem.id} ${$("#validadorSoc").val() == elem.nombre_sector ? "selected" : ""}>${elem.nombre_sector}</option>`;
                                });
                                document.getElementById("sectorSoc").innerHTML = htmlOption;
                                $("#sectorSoc").attr('disabled', 'disabled');

                            },
                            "json"
                        );
                    }
                    get_usuarioSector();
                    //************************ Fin Traer sector Soc  ***************************** */

                    $("#gdeSoc").val('');
                    $("#descripcionSoc").val('');

                    function getDatos() {
                        if ($("#validadorSoc").val() == "soc") {
                            if ($("#gdeSoc").val() == '') {
                                let registro = {
                                    gde: 'No posee nmero de GDE',
                                    COD_DEP_PFA: $("#cod_depSoc").val(),
                                    servicio: $("#servicioSoc").val(),
                                    operador: $("#operadorSoc").val(),
                                    analista: $("#analistaSoc").val(),
                                    sector: $("#sectorSoc").val(),
                                    descripcion: $("#descripcionSoc").val(),
                                    estado: "Pendiente"
                                }
                                return registro;
                            } else {
                                let registro = {
                                    gde: $("#gdeSoc").val(),
                                    COD_DEP_PFA: $("#cod_depSoc").val(),
                                    servicio: $("#servicioSoc").val(),
                                    operador: $("#operadorSoc").val(),
                                    analista: $("#analistaSoc").val(),
                                    sector: $("#sectorSoc").val(),
                                    descripcion: $("#descripcionSoc").val(),
                                    estado: "Pendiente"
                                }
                                return registro;
                            }
                        } else {
                            return;
                        }
                    }

                    function insertTarea(registro) {
                        $.ajax({
                            type: "POST",
                            url: "../../../Controller/ctrTareas.php?op_tarea=insertTarea",
                            data: registro,
                            dataType: "json",
                            success: function (response) {
                            },
                            error: function (error) {
                            }
                        });
                    }

                    $("#btnInsertSoc").click(function () {
                        if ($("#gdeSoc").val() == '') {
                            if ($("#servicioSoc").val() == 1 || $("#servicioSoc").val() == 2) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Error!',
                                    text: 'Para cargar este servicio se requiere un numero de GDE',
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                });
                            } else if ($("#descripcionSoc").val() == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ooops...',
                                    text: 'Si no ingresó un número de GDE debe ingresar una descripción de la tarea a realizar',
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'N° de gde vacío',
                                    text: 'No ingresó un número de GDE. ¿Desea continuar?',
                                    showConfirmButton: true,
                                    showCancelButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        let registro = getDatos();
                                        insertTarea(registro);
                                        Swal.fire({
                                            icon: "success",
                                            title: "¡Registrado!",
                                            text: "La tarea se ha registrado correctamente.",
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                            timer: 1100
                                        });
                                        $("#modalAgregarTareaSoc").modal("hide");
                                        setTimeout(() => {
                                            //location.reload();
                                        }, 1000);
                                    }
                                })
                            }
                        } else {
                            let registro = getDatos();
                            insertTarea(registro);
                            Swal.fire({
                                icon: "success",
                                title: "¡Registrado!",
                                text: "La tarea se ha registrado correctamente.",
                                showConfirmButton: false,
                                showCancelButton: false,
                                timer: 1100
                            });
                            $("#modalAgregarTareaSoc").modal("hide");
                            setTimeout(() => {
                                //location.reload();
                            }, 1000);
                        }
                    });
                    $("#modalAgregarTareaSoc").modal("show")
                    modalAbierto=true;
                });
            }
            $("#modalAgregarTareaSoc").on("hide.bs.modal", function () {
                modalAbierto = false; // Establecer el estado del modal como cerrado
            });

        } catch (error) {
            console.log(error.message);
        }
    }
    btnAgregarTareaSoc();
    //***************************   FIN vista SOC ******************************

    //***************************   INICIO vista TECNICA ******************************
    function btnAgregarTareaTecnica() {
        document.getElementById("btnAgregarTareaTecnica").addEventListener("click", function () {
            $("#modalAgregarTareaTecnica").modal("show");

            $("#dependenciaValorTecnica").val('');
            $("#dependenciaInputTecnica").val('');
            $("#dependenciaInputCodigoTecnica").val('');
            $("#descripcionTecnica").val('');

            function get_dependencia() {
                $("#dependenciaInputTecnica").on('input', function (e) {
                    e.preventDefault();
                    let descripcion = $(this).val().trim();
                    if (descripcion === "") {
                        $("#dependenciaValorTecnica").val("");
                        return;
                    } else if (descripcion != "") {
                        $("#dependenciaInputCodigoTecnica").val('');
                    }
                    $.post("../../../Controller/ctrTareas.php?op_tarea=get_dependencias", { desc_dependencia_pfa: descripcion },
                        function (data, textStatus, jqXHR) {
                            data = JSON.parse(data);
                            $("#dependenciaValorTecnica").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                            $("#cod_depTecnica").val(data.COD_DEP_PFA);
                            if ($("#dependenciaValorTecnica").val() == "undefined - COD undefined") {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Error!",
                                    text: "Ingrese un nombre o codigo valido",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1200
                                })
                                $("#dependenciaInputTecnica").val('');
                                $("#dependenciaInputCodigoTecnica").val('')
                                $("#dependenciaValorTecnica").val('')
                            }
                        }
                    );

                });

                $("#dependenciaInputCodigoTecnica").on('input', function (e) {
                    e.preventDefault();
                    let cod_dep_pfa = $(this).val().trim();
                    if (cod_dep_pfa === "") {
                        $("#dependenciaValorTecnica").val("");
                        return;
                    } else if (cod_dep_pfa != '') {
                        $("#dependenciaInputTecnica").val('')
                    }
                    $.post("../../../Controller/ctrTareas.php?op_tarea=get_dependenciasPorCodigo", { cod_dep_pfa: cod_dep_pfa },
                        function (data, textStatus, jqXHR) {
                            data = JSON.parse(data);
                            console.log(data);
                            $("#dependenciaValorTecnica").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                            $("#cod_depTecnica").val(data.COD_DEP_PFA);
                            if ($("#dependenciaValorTecnica").val() == "undefined - COD undefined") {
                                Swal.fire({
                                    icon: "warning",
                                    title: "Error!",
                                    text: "Ingrese un nombre o codigo valido",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 1200
                                })
                                $("#dependenciaInputTecnica").val('');
                                $("#dependenciaInputCodigoTecnica").val('')
                                $("#dependenciaValorTecnica").val('')
                            }
                        }
                    );
                });
            }
            get_dependencia();

            //************************ Inicio Traer servicios Tecnica  ***************************** */
            function get_servicios_tecnica() {
                $.post("../../../Controller/ctrServicios.php?op_servicio=get_servicios_tecnica",
                    function (data, textStatus, jqXHR) {
                        console.log(data);
                        let htmlOption = '';
                        if ($("#validadorTecnica").val() == "Tecnica") {
                            data.forEach(elem => {
                                if (elem.id == 3 || elem.id == 4 || elem.id == 5 || elem.id == 6 || elem.id == 7) {
                                    htmlOption += `<option value=${elem.id}>${elem.nombre}</option>`;
                                }
                                document.getElementById("servicioTecnica").innerHTML = htmlOption;
                            });
                        }
                    },
                    "json"
                );
            }
            get_servicios_tecnica();
            //************************ Fin Traer servicios Tecnica  ***************************** */

            function getDatosTecnica() {
                if ($("#validadorTecnica").val() == "Tecnica") {
                    if ($("#gdeTecnica").val() == '') {
                        let registro = {
                            gde: "No posee",
                            COD_DEP_PFA: $("#cod_depTecnica").val(),
                            servicio: $("#servicioTecnica").val(),
                            operador: $("#operadorTecnica").val(),
                            analista: $("#analistaTecnica").val(),
                            sector: $("#sectorTecnica").val(),
                            descripcion: $("#descripcionTecnica").val(),
                            estado: "Pendiente"
                        }
                        return registro;
                    } else {
                        let registro = {
                            gde: $("#gdeTecnica").val(),
                            COD_DEP_PFA: $("#cod_depTecnica").val(),
                            servicio: $("#servicioTecnica").val(),
                            operador: $("#operadorTecnica").val(),
                            analista: $("#analistaTecnica").val(),
                            sector: $("#sectorTecnica").val(),
                            descripcion: $("#descripcionTecnica").val(),
                            estado: "Pendiente"
                        }
                        return registro;
                    }
                } else {
                    return;
                }
            }

            function agregarAjaxTecnica(registro) {
                $.ajax({
                    type: "POST",
                    url: "../../../Controller/ctrTareas.php?op_tarea=insertTarea",
                    data: registro,
                    dataType: "json",
                    success: function (response) {
                    }, error: function (error) {
                    }
                });
            }


            //************************ Inicio Traer analista Tecnica  ***************************** */
            function get_usuarioAnalista() {
                $.post("../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 2 },
                    function (data, textStatus, jqXHR) {
                        let htmlOption = '';
                        data.forEach(elem => {
                            htmlOption += `<option value=${elem.id}>${elem.nombre_usuario}</option>`;
                        });
                        document.getElementById("analistaTecnica").innerHTML = htmlOption;
                    },
                    "json"
                );
            }
            get_usuarioAnalista();
            //************************ Fin Traer analista Tecnica  ***************************** */

            //************************ Inicio Traer operador Tecnica  ***************************** */
            function get_usuarioOperadorTecnica() {
                let usu_session = $("#usu_session").val();
                $.post("../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 4 },
                    function (data, textStatus, jqXHR) {
                        let htmlOption = '';
                        data.forEach(elem => {
                            htmlOption += `<option value="${elem.id}" ${elem.id == usu_session ? "selected" : ""} ${elem.id == usu_session ? "" : "disabled"}>${elem.nombre_usuario}</option>`;
                        });
                        document.getElementById("operadorTecnica").innerHTML = htmlOption;
                    },
                    "json"
                );
            }
            get_usuarioOperadorTecnica();
            //************************ Fin Traer operador Tecnica ***************************** */

            //************************ Inicio Traer sector Tecnica  ***************************** */
            function get_usuarioSector() {
                $.post("../../../Controller/ctrSector.php?op_sector=get_sectores", { id: 2 },
                    function (data, textStatus, jqXHR) {
                        let htmlOption = '';
                        data.forEach(elem => {
                            htmlOption += `<option value=${elem.id} ${$("#validadorSoc").val() == elem.nombre_sector ? "selected" : ""}>${elem.nombre_sector}</option>`;
                        });
                        document.getElementById("sectorTecnica").innerHTML = htmlOption;
                        $("#sectorTecnica").attr('disabled', 'disabled');

                    },
                    "json"
                );
            }
            get_usuarioSector();
            //************************ Fin Traer sector Tecnica  ***************************** */

            function insertTareaTecnica() {
                try {
                    $("#btnInsertTecnica").click(function () {
                        if ($("#gdeTecnica").val() == '') {
                            if ($("#descripcionTecnica").val() == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Error',
                                    text: 'Si no ingresó un número de GDE debe ingresar una descripción de la tarea a realizar',
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'N° de gde vacío',
                                    text: 'No ingresó un número de GDE. ¿Desea continuar?',
                                    showConfirmButton: true,
                                    showCancelButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        let registro = getDatosTecnica();
                                        agregarAjaxTecnica(registro);
                                        Swal.fire({
                                            icon: "success",
                                            title: "¡Registrado!",
                                            text: "La tarea se ha registrado correctamente.",
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                            timer: 1100
                                        });
                                        $("#modalAgregarTareaTecnica").modal("hide");
                                        setTimeout(() => {
                                            //location.reload();
                                        }, 1000);
                                    }
                                })
                            }
                        } else {
                            let registro = getDatosTecnica();
                            agregarAjaxTecnica(registro);
                            Swal.fire({
                                icon: "success",
                                title: "¡Registrado!",
                                text: "La tarea se ha registrado correctamente.",
                                showConfirmButton: false,
                                showCancelButton: false,
                                timer: 1100
                            });
                            $("#modalAgregarTareaTecnica").modal("hide");
                            setTimeout(() => {
                                //location.reload();
                                url + '/Tareas/tareas.php';

                            }, 1000);
                        }
                    });
                } catch (error) {
                    console.log(error.message);
                }
            }
            insertTareaTecnica();
        });
    }
    btnAgregarTareaTecnica();
    //***************************   FIN vista TECNICA ******************************



    //***************************   INICIO vista CONCIENTIZACION ******************************
    function btnAgregarTareaConcientizacion() {
        try {
            document.getElementById("btnAgregarTareaConcientizacion").addEventListener("click", function () {
                $("#modalAgregarTareaConcientizacion").modal("show");

                $("#dependenciaValorConcientizacion").val('');
                $("#dependenciaInputConcientizacion").val('');
                $("#dependenciaInputCodigoConcientizacion").val('');
                $("#descripcionConcientizacion").val('');


                function get_dependencia() {
                    $("#dependenciaInputConcientizacion").on('input', function (e) {
                        e.preventDefault();
                        let descripcion = $(this).val().trim();
                        if (descripcion === "") {
                            $("#dependenciaValorConcientizacion").val("");
                            return;
                        } else if (descripcion != "") {
                            $("#dependenciaInputCodigoConcientizacion").val('');
                        }
                        $.post("../../../Controller/ctrTareas.php?op_tarea=get_dependencias", { desc_dependencia_pfa: descripcion },
                            function (data, textStatus, jqXHR) {
                                data = JSON.parse(data);
                                $("#dependenciaValorConcientizacion").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                                $("#cod_depConcientizacion").val(data.COD_DEP_PFA);
                                if ($("#dependenciaValorConcientizacion").val() == "undefined - COD undefined") {
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Error!",
                                        text: "Ingrese un nombre o codigo valido",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1200
                                    })
                                    $("#dependenciaInputConcientizacion").val('');
                                    $("#dependenciaInputCodigoConcientizacion").val('')
                                    $("#dependenciaValorConcientizacion").val('')
                                }
                            }
                        );

                    });

                    $("#dependenciaInputCodigoConcientizacion").on('input', function (e) {
                        e.preventDefault();
                        let cod_dep_pfa = $(this).val().trim();
                        if (cod_dep_pfa === "") {
                            $("#dependenciaValorConcientizacion").val("");
                            return;
                        } else if (cod_dep_pfa != '') {
                            $("#dependenciaInputConcientizacion").val('')
                        }
                        $.post("../../../Controller/ctrTareas.php?op_tarea=get_dependenciasPorCodigo", { cod_dep_pfa: cod_dep_pfa },
                            function (data, textStatus, jqXHR) {
                                data = JSON.parse(data);
                                console.log(data);
                                $("#dependenciaValorConcientizacion").val(data.DESC_DEPENDENCIA_PFA + ' - COD ' + data.COD_DEP_PFA);
                                $("#cod_depConcientizacion").val(data.COD_DEP_PFA);
                                if ($("#dependenciaValorConcientizacion").val() == "undefined - COD undefined") {
                                    Swal.fire({
                                        icon: "warning",
                                        title: "Error!",
                                        text: "Ingrese un nombre o codigo valido",
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                        timer: 1200
                                    })
                                    $("#dependenciaInputConcientizacion").val('');
                                    $("#dependenciaInputCodigoConcientizacion").val('')
                                    $("#dependenciaValorConcientizacion").val('')
                                }
                            }
                        );
                    });
                }
                get_dependencia();

                //************************ Inicio Traer servicios Tecnica  ***************************** */
                function get_servicios_concientizacion() {
                    $.post("../../../Controller/ctrServicios.php?op_servicio=get_servicios_concientizacion",
                        function (data, textStatus, jqXHR) {
                            data = JSON.parse(data);
                            console.log(data);
                            let htmlOption = '';
                            data.forEach(elem => {
                                htmlOption += `<option value=${elem.id}>${elem.nombre}</option>`;
                            });
                            document.getElementById("servicioConcientizacion").innerHTML = htmlOption;
                        },
                        "html"
                    );
                }
                get_servicios_concientizacion();

                //************************ Fin Traer servicios Tecnica  ***************************** */

                function getDatosConcientizacion() {
                    if ($("#validadorConcientizacion").val() == "concientizacion") {
                        if ($("#gdeConcientizacion").val() == '') {
                            let registro = {
                                gde: "No posee",
                                COD_DEP_PFA: $("#cod_depConcientizacion").val(),
                                servicio: $("#servicioConcientizacion").val(),
                                operador: $("#operadorConcientizacion").val(),
                                analista: $("#analistaConcientizacion").val(),
                                sector: $("#sectorConcientizacion").val(),
                                descripcion: $("#descripcionConcientizacion").val(),
                                estado: "Pendiente"
                            }
                            return registro;
                        } else {
                            let registro = {
                                gde: $("#gdeConcientizacion").val(),
                                COD_DEP_PFA: $("#cod_depConcientizacion").val(),
                                servicio: $("#servicioConcientizacion").val(),
                                operador: $("#operadorConcientizacion").val(),
                                analista: $("#analistaConcientizacion").val(),
                                sector: $("#sectorConcientizacion").val(),
                                descripcion: $("#descripcionConcientizacion").val(),
                                estado: "Pendiente"
                            }
                            return registro;
                        }
                    } else {
                        return;
                    }
                }

                function agregarAjaxConcientizacion(registro) {
                    $.ajax({
                        type: "POST",
                        url: "../../../Controller/ctrTareas.php?op_tarea=insertTarea",
                        data: registro,
                        dataType: "json",
                        success: function (response) {
                        }, error: function (error) {
                        }
                    });
                }

                function insertTareaConcientizacion() {
                    $("#btnInsertConcientizacion").click(function () {
                        if ($("#gdeConcientizacion").val() == '') {
                            if ($("#descripcionConcientizacion").val() == '') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Error',
                                    text: 'Si no ingresó un número de GDE debe ingresar una descripción de la tarea a realizar',
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'N° de gde vacío',
                                    text: 'No ingresó un número de GDE. ¿Desea continuar?',
                                    showConfirmButton: true,
                                    showCancelButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        let registro = getDatosConcientizacion();
                                        agregarAjaxConcientizacion(registro);
                                        Swal.fire({
                                            icon: "success",
                                            title: "¡Registrado!",
                                            text: "La tarea se ha registrado correctamente.",
                                            showConfirmButton: false,
                                            showCancelButton: false,
                                            timer: 1100
                                        });
                                        $("#modalAgregarTareaTecnica").modal("hide");
                                        setTimeout(() => {
                                            //location.reload();
                                        }, 1000);
                                    }
                                })
                            }
                        } else {
                            let registro = getDatosConcientizacion();
                            agregarAjaxConcientizacion(registro);
                            Swal.fire({
                                icon: "success",
                                title: "¡Registrado!",
                                text: "La tarea se ha registrado correctamente.",
                                showConfirmButton: false,
                                showCancelButton: false,
                                timer: 1100
                            });
                            $("#modalAgregarTareaConcientizacion").modal("hide");
                            setTimeout(() => {
                                //location.reload();
                                url + '/Tareas/tareas.php';

                            }, 1000);
                        }
                    });
                }
                insertTareaConcientizacion();


                //************************ Inicio Traer analista Tecnica  ***************************** */
                function get_usuarioAnalista() {
                    $.post("../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 3 },
                        function (data, textStatus, jqXHR) {
                            let htmlOption = '';
                            data.forEach(elem => {
                                htmlOption += `<option value=${elem.id}>${elem.nombre_usuario}</option>`;
                            });
                            document.getElementById("analistaConcientizacion").innerHTML = htmlOption;
                        },
                        "json"
                    );
                }
                get_usuarioAnalista();
                //************************ Fin Traer analista Tecnica  ***************************** */

                //************************ Inicio Traer operador Tecnica  ***************************** */
                function get_usuarioOperadorConcientizacion() {
                    let usu_session = $("#usu_session").val();
                    $.post("../../../Controller/ctrUsuarios.php?op_user=get_usuarios_x_id_sector", { id_sector: 4 },
                        function (data, textStatus, jqXHR) {
                            let htmlOption = '';
                            data.forEach(elem => {
                                htmlOption += `<option value="${elem.id}" ${elem.id == usu_session ? "selected" : ""} ${elem.id == usu_session ? "" : "disabled"}>${elem.nombre_usuario}</option>`;
                            });
                            document.getElementById("operadorConcientizacion").innerHTML = htmlOption;
                        },
                        "json"
                    );
                }
                get_usuarioOperadorConcientizacion();
                //************************ Fin Traer operador Tecnica ***************************** */

                //************************ Inicio Traer sector Tecnica  ***************************** */
                function get_usuarioSector() {
                    $.post("../../../Controller/ctrSector.php?op_sector=get_sectores", { id: 3 },
                        function (data, textStatus, jqXHR) {
                            let htmlOption = '';
                            data.forEach(elem => {
                                htmlOption += `<option value=${elem.id} ${$("#validadorConcientizacion").val() == elem.nombre_sector ? "selected" : ""}>${elem.nombre_sector}</option>`;
                            });
                            document.getElementById("sectorConcientizacion").innerHTML = htmlOption;
                            $("#sectorConcientizacion").attr('disabled', 'disabled');

                        },
                        "json"
                    );
                }
                get_usuarioSector();
                //************************ Fin Traer sector Tecnica  ***************************** */
            });
        } catch (error) {
            console.log(error.message);
        }
    }
    btnAgregarTareaConcientizacion();
    //***************************   FIN vista TECNICA ******************************



});


init();