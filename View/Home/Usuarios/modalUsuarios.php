<!-- Modal -->
<div class="modal fade" id="mdlInsertUsu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-1">
                    <label for="usuario" class="form-label">Email</label>
                    <input id="usuario" class="form-control form-control-sm" type="text" placeholder="Ingrese el nombre" aria-label=".form-control-sm example">
                </div>

                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control form-control-sm" type="password" placeholder="Ingrese su password" aria-label=".form-control-sm example">
                </div>

                <div class="mb-1">
                    <label for="nombre_usuario" class="form-label">Nombre</label>
                    <input id="nombre_usuario" class="form-control form-control-sm" type="text" placeholder="Ingrese el nombre" aria-label=".form-control-sm example">
                </div>
                <div class="mb-1">
                    <label for="apellido_usuario" class="form-label">Apellido</label>
                    <input id="apellido_usuario" class="form-control form-control-sm" type="text" placeholder="Ingrese el apellido" aria-label=".form-control-sm example">
                </div>


                <div class="row mb-1">
                    <div class="col-md-6 mt-1">
                        <label for="exampleFormControlTextarea1" class="form-label">Sector</label>
                        <select id="select_sector" class="form-select form-select-sm" aria-label=".form-select-sm example">

                        </select>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="exampleFormControlTextarea1" class="form-label">Rol</label>
                        <select id="select_rol" class="form-select form-select-sm" aria-label=".form-select-sm example">

                        </select>
                    </div>
                </div>

                <div class="row g-3 ml-3">
                    <div class="col-4">
                        <label for="lp" class="form-label">L.P</label>
                        <input id="lp" class="form-control form-control-sm" type="text" placeholder="Ingrese el LP" aria-label=".form-control-sm example">
                    </div>
                    <div class="col-8">
                        <label for="dni" class="form-label">DNI</label>
                        <input id="dni" class="form-control form-control-sm" type="text" placeholder="Ingrese el DNI" aria-label=".form-control-sm example">
                    </div>
                </div>
                <div class="mb-1 mt-2">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input id="direccion" class="form-control form-control-sm" type="text" placeholder="Ingrese la dirección" aria-label=".form-control-sm example">
                </div>
                <div class="mb-1">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input id="telefono" class="form-control form-control-sm" type="text" placeholder="Ingrese el teléfono" aria-label=".form-control-sm example">
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnGuardarUsuario" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal para editar -->
<div class="modal fade" id="mdlEditUsu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-1">
                    <label for="nombre_usuario" class="form-label">Nombre</label>
                    <input disabled id="nombre_usuario_edit" class="form-control form-control-sm" type="text" placeholder="Ingrese el nombre" aria-label=".form-control-sm example">
                </div>
                <div class="mb-1">
                    <label for="apellido_usuario" class="form-label">Apellido</label>
                    <input disabled id="apellido_usuario_edit" class="form-control form-control-sm" type="text" placeholder="Ingrese el apellido" aria-label=".form-control-sm example">
                </div>


                <div class="row mb-1">
                    <div class="col-md-6 mt-1">
                        <label for="exampleFormControlTextarea1" class="form-label">Sector</label>
                        <select id="select_sector_edit" class="form-select form-select-sm" aria-label=".form-select-sm example">

                        </select>
                    </div>
                    <div class="col-md-6 mt-1">
                        <label for="exampleFormControlTextarea1" class="form-label">Rol</label>
                        <select id="select_rol_edit" class="form-select form-select-sm" aria-label=".form-select-sm example">

                        </select>
                    </div>
                </div>

                <div class="row g-3 ml-3">
                    <div class="col-4">
                        <label for="lp" class="form-label">L.P</label>
                        <input id="lp_edit" class="form-control form-control-sm" type="text" placeholder="Ingrese el LP" aria-label=".form-control-sm example">
                    </div>
                </div>
                <div class="mb-1 mt-2">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input id="direccion_edit" class="form-control form-control-sm" type="text" placeholder="Ingrese la dirección" aria-label=".form-control-sm example">
                </div>
                <div class="mb-1">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input id="telefono_edit" class="form-control form-control-sm" type="text" placeholder="Ingrese el teléfono" aria-label=".form-control-sm example">
                </div>
            </div>

            <div class="modal-footer">
            <button id="btnGuardarUsuario_edit" type="button" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>