function init() {

}
var url = "http://localhost/Tecnica";
var url_search_param = new URLSearchParams(location.search);
var url_id = url_search_param.get('tarea');

$(document).ready(function () {
    document.getElementById("importar_resultado_xml").style.display = "none";

    $.post("../../../Controller/ctrTareas.php?op_tarea=get_tarea_x_analista", { id: url_id },
        function (data, textStatus, jqXHR) {
            let ips = data.ips;
            document.getElementById("lista_de_ips").value = ips
        },
        "json"
    );

    document.getElementById("lanzarEscaneoNmap").addEventListener("click", () => {
        let mensaje = `Lanzando escaneo Nmap <span class="spinner-border spinner-border-sm" style="width: 10px; height: 10px;" role="status">
            <span class="visually-hidden">Lanzando escaneo Nmap</span>
        </span>`;
        document.getElementById("lanzando_escaneo").innerHTML = mensaje;
        document.getElementById("lanzarEscaneoNmap").style.display = "none";
    });





    document.getElementById("importar_resultado_xml").addEventListener("click", function () {
        if ($("#lanzando_escaneo").html() == "Escaneo finalizado") {
            $.post("../../../Controller/ctrTareas.php?op_tarea=update_xml_nmap_almacenado_scanner", { tarea_id: url_id },
                function (data, textStatus, jqXHR) {

                }
            );
            let mensaje = `Procesando resultado, sera rederigido a su pagina de trabajo <span class="spinner-border spinner-border-sm" style="width: 10px; height: 10px;" role="status">
            <span class="visually-hidden"></span>
        </span>`;
            document.getElementById("importar_resultado_xml").innerHTML = mensaje
            setTimeout(() => {
                location.href = url + "/View/Home/Trabajos/?tarea=" + url_id;
            }, 3000);
        }
    })

    document.querySelector("form[action$='ctrEscaneos.php']").addEventListener("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                document.getElementById("resultado_escaneo_nmap").innerText = response;
                document.getElementById("lanzando_escaneo").innerText = "Escaneo finalizado";
                document.getElementById("importar_resultado_xml").style.display = "inline";
            }
        });
    });
});

init();