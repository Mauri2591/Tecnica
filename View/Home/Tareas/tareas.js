function init() {

}
var url="http://localhost/Tecnica/View/Home";
var usu_id = $("#usu_id").val();
var sector_id=$("#id_sector").val();

$(document).ready(function () {

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_para_actualizar_vistas",
        function (data, textStatus, jqXHR) {
            var contador = data.lenght;
            for (var i = contador; i < data.length; i++) {
                console.log(i);
                console.log(contador);
            }
        },
        "json"
    );

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_finalizadas_x_todos_los_sectores_final",
        function (data, textStatus, jqXHR) {
            console.log(data);
            let htmltbody='';
            data.map((elem)=>{
                htmltbody +=`<tr><td>${elem.gde}</td>
                <td>${elem.gde_cierre}</td>
                <td>${elem.operador}</td>
                <td>${elem.nombre_servicio}</td>
                <td>${elem.analista_nombre}</td>
                <td>${elem.nombre_sector}</td>
                <td>${elem.estado == "Finalizada" ? `<span type=button onclick='verDetalleTareaFinalizada(${elem.id})' data-toggle="tooltip" data-placement="top" title="Ver info" class="badge bg-success fs-11">${elem.estado}`: `<span type=button onclick='verDetalleTareaFinalizada(${elem.id})' data-toggle="tooltip" data-placement="top" title="Ver info" class="badge fs-11 bg-danger">${elem.estado}`}</td>
                <td><span type="button" onclick="verTareaTodosLosSectores(${elem.id})" data-toggle="tooltip" data-placement="top" title="Ver"><i class="ri-eye-fill text-primary fs-20" style="margin-left:2px"></i></span></td>
                `;
            })
            document.getElementById("tbody_total_tareas_finalizadas_x_todos_los_sectores_final").innerHTML=htmltbody;
        },
        "json"
    );

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_activas_x_sector", { sector_id: $("#id_sector").val() },
        function (data, textStatus, jqXHR) {
            let htmlTable = '';
            let usu_id = $("#usu_id").val();
            data.forEach((elem, index) => {
                htmlTable += `<tr>
                <td>${index + 1}</td>
                <td>${elem.gde}</td>
                <td><span style="cursor:default" type="button" data-toggle="tooltip" data-placement="top" title="${elem.servicio_descripcion}">${elem.nombre_servicio}</span></td>
                <td>${elem.operador}</td>
                <td>${elem.analista_nombre}</td>
                <td>${elem.nombre_sector}</td>
                <td>
                    <span type="button" onclick="tomarTarea(${elem.id})" 
                        class="badge rounded-pill ${elem.estado == 'Pendiente' ? 'bg-warning' : elem.estado == 'En proceso' ? 'bg-success' : ''}" 
                        style="color: ${elem.estado == 'Pendiente' ? '#222' : elem.estado == 'En proceso' ? '#fff' : ''}; font-size: 12px;">
                        ${elem.estado == "Pendiente" ? "Pendiente" :
                        elem.estado == "En proceso" ? "En proceso" : ""}
                    </span>
                </td>                
                <td>
                    <span ${elem.estado == 'En proceso' && elem.analista == usu_id ? 'type=button' : ''} onclick="trabajarTarea(${elem.analista == usu_id && elem.estado == 'En proceso' ? elem.id : false})" data-toggle="tooltip" data-placement="top" ${elem.analista == usu_id && elem.estado == 'En proceso' ? 'title=Click' : ''}><i class="ri-edit-box-fill text-primary fs-20"></i></span>
                </td>           
            </tr>`;
            });
            document.getElementById("tbody_total_tareas_activas_soc").innerHTML = htmlTable;
        },
        "json"
    );
});

function tomarTarea(id) {
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_tarea_x_analista", { id: id },
        function (data, textStatus, jqXHR) {
            let usu_id = $("#usu_id").val();
            if (data.estado == "En proceso") {
                return
            }
            if (usu_id === data.analista) {
                Swal.fire({
                    icon: "question",
                    title: '¿Desea tomar esta tarea?',
                    text: "Presione OK para iniciar",
                    showConfirmButton: true,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("../../../Controller/ctrTareas.php?op_tarea=update_estado_en_proceso_tarea_x_analista", { id: id },
                            function (data, textStatus, jqXHR) {
                                Swal.fire({
                                    icon: "success",
                                    title: 'Bien',
                                    text: "Se cambió el estado de la tarea a En proceso",
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    timer: 1300
                                })
                            },
                            "json"
                        );
                        setInterval(() => {
                            window.location.reload();
                        }, 1300);
                    }
                })

            } else {
                Swal.fire({
                    icon: "warning",
                    title: 'No tiene permiso para operar sobre esta tarea',
                    showConfirmButton: false,
                    showCancelButton: false,
                    timer: 1300
                })
            }
        },
        "json"
    );
}
tomarTarea();

function trabajarTarea(id) {
    if(id != false){
        window.open(url+"/Trabajos/?tarea="+id)
    }
}
trabajarTarea();

function verTareaTodosLosSectores(id){
    if(id != false){
        window.open(url+"/Trabajos/?tarea="+id)
    }
}
verTareaTodosLosSectores();

init();