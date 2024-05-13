function init() {

}

$(document).ready(function () {

    function get_select_roles() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '../../../controller/ctrRol.php?op_rol=get_roles', true);
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.status == 200 && xhr.readyState == 4) {
                var data = JSON.parse(xhr.responseText);
                let htmlTemplate = '';
                data.forEach(elem => {
                    htmlTemplate += `
                        <option value="${elem.id}">${elem.rol}</option>
                    `;
                });
                document.getElementById("select_rol").innerHTML = htmlTemplate;
            }
        }
        xhr.send();
    }
    get_select_roles();

    function get_select_sector() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '../../../controller/ctrSector.php?op_sector=get_sectores', true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.onload = function () {
            if (xhr.status === 200 && xhr.readyState == 4) {
                let data = JSON.parse(xhr.responseText)
                let htmlTemplate = '';
                data.forEach(elem => {
                    htmlTemplate += `
                    <option value="${elem.id}">${elem.nombre_sector}</option>
                    `;
                });
                document.getElementById("select_sector").innerHTML = htmlTemplate;
            }
        }
        xhr.send();
    }
    get_select_sector();

    // ******************************* Inicio Servicio Usuarios  *******************************************//    
    //Insert usuarios
    function insert_usuario() {

        function recuperar_datos() {
            let registro = {
                lp: document.getElementById("lp").value,
                dni: document.getElementById("dni").value,
                id_rol: document.getElementById("select_rol").value,
                id_sector: document.getElementById("select_sector").value,
                usuario: document.getElementById("usuario").value,
                password: document.getElementById("password").value,
                nombre_usuario: document.getElementById("nombre_usuario").value,
                apellido_usuario: document.getElementById("apellido_usuario").value,
                direccion: document.getElementById("direccion").value,
                telefono: document.getElementById("telefono").value,
                est: 1
            }
            return registro;
        }
        function insert_usuario(registro) {
            $.ajax({
                type: "POST",
                url: "../../../controller/ctrUsuarios.php?op_user=insert",
                data: registro,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        $("#btnGuardarUsuario").click(function () {
            let registro = recuperar_datos();
            if (registro.apellido_usuario == '' || registro.direccion == '' || registro.dni == ''
                || registro.est == '' || registro.id_rol == '' || registro.id_sector == '' || registro.lp == ''
                || registro.nombre_usuario == '' || registro.password == '' || registro.telefono == '' ||
                registro.usuario == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: 'No dejar campos vacíos',
                    showConfirmButton: false,
                    timer: 1200
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Bien...',
                    text: 'Usuario creado correctamente',
                    showConfirmButton: false,
                    timer: 1200
                });
                insert_usuario(registro)
                $("#mdlInsertUsu").modal("hide");
                setInterval(() => {
                    window.location.reload();
                }, 1200);
            }
        })
    }
    insert_usuario();
});
//Final insert usuarios

//Inicio get usuarios table
function get_usuarios() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../../../controller/ctrUsuarios.php?op_user=get_usuarios', true);
    xhr.onload = function () {
        if (xhr.status == 200) {
            let htmlTemplate = '';
            let data = JSON.parse(xhr.responseText);
            console.log(data);
            data.forEach(elem => {
                htmlTemplate += `
                <tr>
                <td style="1px; text-align:center">${elem.nombre_usuario}</td>
                <td style="1px; text-align:center">${elem.apellido_usuario}</td>
                <td style="1px; text-align:center">${elem.nombre_sector}</td>
                <td style="1px; text-align:center">${elem.telefono}</td>
                <td style="1px; text-align:center">${elem.rol == "Desarrollador" ? '<span class="badge badge-label bg-primary">Desarrollador</span>' : '<span class="badge badge-label bg-info">' + `${elem.rol}` + '</span>'}</td>
                <td style="1px; text-align:center">${elem.est == 1 ? '<span class="badge rounded-pill bg-success">Activo</span>' : '<span class="badge rounded-pill bg-danger">Inactivo</span>'}</td>
                <td id="tabla_no_mostrar" style="padding-left:20px;">
                    <a onClick="editUsu(${elem.id})" type="button" data-toggle="tooltip" data-placement="top" title="Editar Usuario" style="padding-left:5px"><i style="font-size: 18px;" class=" ri-user-search-fill text-primary"></i></a>
                    <a onClick="elimUsu(${elem.id})" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario" style="padding-left:5px"><i style="font-size: 18px;" class="ri-user-unfollow-fill text-danger"></i></a>
                </td>
            </tr>            
                `;
            });
            document.getElementById("tbody_usuarios").innerHTML = htmlTemplate;
        }
    }
    xhr.send();
}
get_usuarios();
//Fin get usuarios
var valor_para_no_mostrar_datos_de_la_tabla = $("#valor_para_no_mostrar_datos_de_la_tabla").val();

if (valor_para_no_mostrar_datos_de_la_tabla == 0) {
    $("#tabla_no_mostrar").hide();
} else {
    function verUsu(id) {
        console.log(id);
    }

    function editUsu(id) {
        $("#mdlEditUsu").modal("show");
        $.post("../../../controller/ctrUsuarios.php?op_user=get_usuario", { id: id },
            function (data, textStatus, jqXHR) {
                var data1=data
                $("#nombre_usuario_edit").val(data.nombre_usuario);
                $("#apellido_usuario_edit").val(data.apellido_usuario);
                $("#lp_edit").val(data.lp);
                $("#direccion_edit").val(data.direccion);
                $("#telefono_edit").val(data.telefono);

                $.post("../../../controller/ctrRol.php?op_rol=get_roles", function (data, textStatus, jqXHR) {
                    let htmlTemplate = '';
                    data.forEach(elem => {
                        htmlTemplate += `
                            <option value="${elem.id}" ${elem.id == data1.id_rol ? "selected" : ""}>${elem.rol}</option>
                            `;
                    });
                    document.getElementById("select_rol_edit").innerHTML = htmlTemplate;
                },
                    "json"
                );
        
                $.post("../../../controller/ctrSector.php?op_sector=get_sectores", function (data, textStatus, jqXHR) {
                    let htmlTemplate = '';
                    data.forEach(elem => {
                        htmlTemplate += `
                            <option value="${elem.id}" ${elem.id == data1.id_sector ? "selected" : ""}>${elem.nombre_sector}</option>
                            `;
                    });
                    document.getElementById("select_sector_edit").innerHTML = htmlTemplate;
                },
                    "json"
                );

                function registro_update_usuario(){
                    let data = {
                        id: data1.id,
                        lp: $("#lp_edit").val(),
                        id_rol: $("#select_rol_edit").val(),
                        id_sector: $("#select_sector_edit").val(),
                        direccion: $("#direccion_edit").val(),
                        telefono: $("#telefono_edit").val()
                    };
                    return data;
                }
                

                function update_usuario(registro){
                    $.ajax({
                        type: "POST",
                        url: "../../../controller/ctrUsuarios.php?op_user=update_usuario",
                        data: registro,
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                }

                $("#btnGuardarUsuario_edit").click(function () {
                    if($("#lp_edit").val() == '' || $("#select_rol_edit").val() == '' 
                        || $("#select_sector_edit").val() == '' || $("#direccion_edit").val() == '' 
                        || $("#telefono_edit").val() == ''){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Hay campos vacíos',
                                text: 'Todos los campos son obligatorios',
                                showCancelButton: false,
                                showConfirmButton: true
                            });
                        }else{
                            let registro = registro_update_usuario();
                            update_usuario(registro);
                            $("#mdlEditUsu").hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Bien',
                                text: 'Guardado correctamente',
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            $("#mdlEditUsu").hide();
                            setInterval(() => {
                                window.location.reload();
                            }, 1300);
                        }
                    
                });

                
                
            },
            "json"
        );
            
    }


    function elimUsu(id) {
        Swal.fire({
            icon: 'warning',
            title: 'Desea eliminar este usuario?',
            showCancelButton: true,
            confirmButtonColor: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario eliminado correctamente',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1300
                });
                $.post("../../../controller/ctrUsuarios.php?op_user=dalete_usuario", { id: id }, function (data, textStatus, jqXHR) {
              
                },
                    "json"
                );
                setInterval(() => {
                    window.location.reload();
                }, 1300);   
            }
        });

    }
}




// ******************************* Fin Servicio Usuarios  ***********************************************//    

function openModalInserUsu() {
    $("#mdlInsertUsu").modal("show")
}

init();