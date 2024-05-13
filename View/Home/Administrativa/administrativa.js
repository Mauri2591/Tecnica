function init() {

}

$(document).ready(function () {
    function get_usuarios() {
        $.post("../../../controller/ctrUsuarios.php?op_user=get_usuarios", function (data, textStatus, jqXHR) {
            let htmlTbody = '';
            data.forEach(elem => {
                htmlTbody += `
                <tr>
                    <td style="width: 30%;"class="p-2">${elem.nombre_usuario}</td>
                    <td style="width: 30%;"class="p-2">${elem.apellido_usuario}</td>
                    <td style="width: 30%;"class="p-2">${elem.nombre_sector}</td>
                    <td style="width: 5%;"class="p-2"><a onclick="verUsu(${elem.id})" type="button" data-toggle="tooltip" data-placement="top" title="Ver info" style="padding-left:5px"><i style="font-size: 18px;" class="  ri-file-user-line text-primary"></i></a></td>
                </tr>`;
            });
            document.getElementById("table_usuarios_adm").innerHTML = htmlTbody;
        },
            "json"

        );
    }
    get_usuarios();

});

function verUsu(id) {
}

