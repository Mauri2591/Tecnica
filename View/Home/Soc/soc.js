function init(){

}
//********************************  Inicio servicio  *********************************** */
var url="http://localhost/Tecnica/View/Home";
var usu_id=$("#usu_id").val();

$(document).ready(function () {
   
function get_servicios_soc(){
    $.post("../../../controller/ctrServicios.php?op_servicio=get_servicios_soc",function (data, textStatus, jqXHR) {
            let htmlTemplate='';
            data.forEach(elem => {
                if(elem.id == 1 || elem.id == 2 || elem.id == 3 || elem.id == 4 || elem.id == 5 || elem.id == 7 || elem.id == 11){
                    htmlTemplate+=`
                    <tr>
                        <td class="text-center fs-14">${elem.nombre}</td>
                        <td class="fs-14">${elem.descripcion}</td>
                    </tr>`;
                }
                document.getElementById("tbody_tabla_servicios").innerHTML=htmlTemplate;
            });
        },
        "json"
    );
}
get_servicios_soc();

function tareas_finalziadas_soc(){
    $.post("../../../Controller/ctrTareas.php?op_tarea=get_total_tareas_finalizadas_x_sector", {sector_id:1},
        function (data, textStatus, jqXHR) {
            console.log(data);
            let htmltbody='';
            data.map((elem)=>{
                htmltbody +=`<tr>
                <td>${elem.gde}</td>
                <td>${elem.gde_cierre == null ? 'No posee' : elem.gde_cierre}</td>
                <td>${elem.operador}</td>
                <td>${elem.nombre_servicio}</td>
                <td>${elem.analista_nombre}</td>
                <td>${elem.nombre_sector}</td>
                <td>${elem.estado == "Finalizada" ? `<span class="badge bg-info fs-11">${elem.estado}`: `<span type=button onclick='verDetalleTareaFinalizada(${elem.id})' data-toggle="tooltip" data-placement="top" title="Ver info" class="badge fs-11 bg-danger">${elem.estado}`}</td>
                <td><span type="button" onclick="descargarReporteSoc(${elem.id})" data-toggle="tooltip" data-placement="top" title="Descargar"><i class=" ri-file-word-2-fill text-primary fs-20" style="margin-left:2px"></i></span></td>
                <td><span type="button" onclick="verTareaSoc(${elem.id})" data-toggle="tooltip" data-placement="top" title="Ver"><i class="ri-eye-fill fs-20" style="margin-left:2px; color:gray"></i></span></td>
                `;
            })
            document.getElementById("tbody_tabla_tareas_finalizadas").innerHTML=htmltbody;
        },
        "json"
    );
}
tareas_finalziadas_soc()    

});
//********************************* Final servicio ************************************* */


function verTareaSoc(id) {
    window.open(url+"/Trabajos/?tarea="+id)
}
verTareaSoc();

function descargarReporteSoc(id) {
    console.log(id);
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


init();