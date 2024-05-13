
var url = "http://localhost/Tecnica/View/Home";
$(document).ready(function () {
    tabla = $("#table_tecnica").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lenghtChange: false,
        colReorder: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ajax": {
            url: "../../controller/articulos.php?op=select_articulos",
            type: "post",
            dataType: "json",
            data: {
                // est: 1
            },
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "order": [[0, "desc"]], //Ordenar descendentemente
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10, //cantidad de tuplas o filas a mostrar
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
    }).DataTable();
});
$(document).ready(function () {
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_finalizadas_x_sector", { sector_id: 2 },
        function (data, textStatus, jqXHR) {
            let htmltbody = '';
            data.map((elem) => {
                htmltbody += `<tr>
                <td>${elem.gde}</td>
                <td>${elem.gde_cierre == null ? 'No posee' : elem.gde_cierre}</td>
                <td>${elem.operador}</td>
                <td>${elem.nombre_servicio}</td>
                <td>${elem.analista_nombre}</td>
                <td>${elem.nombre_sector}</td>
                <td>${elem.estado == "Finalizada" ? `<span onclick='verDetalleTareaFinalizada(${elem.id})' class="badge fs-11 bg-info">${elem.estado}` : `<span type=button onclick='verDetalleTareaFinalizada(${elem.id})' data-toggle="tooltip" data-placement="top" title="Ver info" class="badge fs-11 bg-danger">${elem.estado}`}</td>
                <td><span type="button" onclick="descargarReporteTecnica(${elem.id})" data-toggle="tooltip" data-placement="top" title="Descargar"><i class=" ri-file-word-2-fill text-primary fs-20" style="margin-left:2px"></i></span></td>
                <td><span type="button" onclick="verTareaTecnica(${elem.id})" data-toggle="tooltip" data-placement="top" title="Ver"><i class="ri-eye-fill fs-20" style="margin-left:2px; color:gray"></i></span></td>
                `;
            })
            document.getElementById("tbody_tabla_tareas_finalizadas_tecnica").innerHTML = htmltbody;
        },
        "json"
    );

    $.post("../../../Controller/ctrServicios.php?op_servicio=get_servicios_tecnica", function (data, textStatus, jqXHR) {
        console.log(data);
        let htmlTbody='';
        data.forEach(elem => {
            htmlTbody += `<tr>
                            <td>${elem.nombre}</td>
                            <td>${elem.descripcion}</td>
                        </tr>`;
        });
        document.getElementById('tbody_servicios_tecnica').innerHTML = htmlTbody;
    },
        "json"
    );
});
function verTareaTecnica(id) {
    window.open(url + "/Trabajos/?tarea=" + id)
}
verTareaTecnica();

function descargarReporteTecnica(id) {
    $.ajax({
        url: "../../../Controller/ctrReportes.php?op_reporte=get_primer_reporte",
        type: "POST",
        data: { tarea_id: id },
        xhrFields: {
            responseType: 'blob' // Especificamos el tipo de respuesta como Blob
        },
        success: function(data) {
            // Crear un objeto Blob con los datos de respuesta
            var blob = new Blob([data]);

            // Crear un objeto URL para el blob
            var url = window.URL.createObjectURL(blob);

            let fecha = new Date();
            let anio = fecha.getFullYear();
            let mes = fecha.getMonth() + 1;
            let dia = fecha.getDate();
            
            let fecha_formateada = dia.toString().padStart(2, '0') + '-' + mes.toString().padStart(2, '0') + '-' + anio;
            
            // Crear un enlace temporal
            var link = document.createElement('a');
            link.href = url;
            link.download = 'Reporte_'+fecha_formateada+'.docx'; // Nombre del archivo a descargar

            // Agregar el enlace al DOM y simular un clic
            document.body.appendChild(link);
            link.click();

            // Limpiar el objeto URL y eliminar el enlace temporal
            window.URL.revokeObjectURL(url);
            document.body.removeChild(link);
        },
        error: function(xhr, status, error) {
            console.error('Error al descargar el archivo:', error);
        }
    });
}

