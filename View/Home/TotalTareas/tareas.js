function init() {

}
var tabla;
var url = "http://localhost/Tecnica/View/Home";

$(document).ready(function () {

    $(document).ready(function () {
        tabla = $("#total_tareas_realizadas").dataTable({
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
                url: "../../../Controller/ctrTareas.php?op_tarea=get_total_tareas",
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
        });
    })
});


function descargarReporte(id) {
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_tarea_x_analista_detalle", {id: id},
        function (data, textStatus, jqXHR) {
            let nombre = data.nombre_servicio;
            
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
                    link.download = nombre +'_'+ fecha_formateada + '.docx'; // Nombre del archivo a descargar

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
        },
        "json"
    );
}

function verTarea(id) {
    window.open(url + "/Trabajos/?tarea=" + id)
}
verTarea();

init();