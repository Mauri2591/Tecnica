<?php if (isset($_SESSION) && $_SESSION['usu_id'] > 0) { ?>
    <div class="modal fade" id="modalAgregarTareaTecnica" tabindex="-1" aria-labelledby="exampleModalLabelTecnica" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelTecnica">Nueva tarea - Area Técnica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" hidden id="validadorTecnica" value="tecnica">

                        <div class="mb-3 row">
                            <label for="gdeTecnica" class="col-sm-2 col-form-label">N° de GDE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="gdeTecnica" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Dependencia</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control form-control-sm" id="dependenciaValor" style="font-size: 13px;">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-5 col-form-label">Ingrese informacion de la dependencia:</label>
                            <div class="col-sm-4 pl-0">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInput" placeholder="Ingrese el Nombre" style="font-size: 13px;">
                            </div>
                            <div class="col-sm-3 pl-1">
                                <input type="hidden" hidden id="cod_dep">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInputCodigo" placeholder="Ingrese el CODIGO" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 row">
                                <label for="servicioTecnica" class="col-sm-2 col-form-label">Servicio</label>
                                <div class="col-sm-4">
                                    <select id="servicioCargaTecnica" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>

                                <label for="operadorTecnica" class="col-sm-2 col-form-label">Operador</label>
                                <div class="col-sm-4">
                                    <select id="operadorTecnica" disabled class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">
                                    <option value="<?php echo $_SESSION['usu_id'] ?>"><?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellido_usuario'] ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="analistaTecnica" class="col-sm-2 col-form-label">Analista</label>
                                <div class="col-sm-4">
                                    <select id="analistaTecnica" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>

                                <label for="sectorTecnica" class="col-sm-2 col-form-label">Sector</label>
                                <div class="col-sm-4">
                                    <select id="sectorTecnica" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="descripcionTecnica" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descripcionTecnica" cols="15" rows="5" maxlength="2000"></textarea>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: end;">
                            <button type="button" id="btnInsertTecnica" class="btn btn-primary btn-sm">Guardar</button>
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php } else {
    header("Location: " . URL);
} ?>