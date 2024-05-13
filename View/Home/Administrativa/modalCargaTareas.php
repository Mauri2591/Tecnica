<?php if (isset($_SESSION) && $_SESSION['usu_id'] > 0) { ?>

    <!-- Modal SOC-->
    <div class="modal fade" id="modalAgregarTareaSoc" tabindex="-1" aria-labelledby="exampleModalLabelSoc" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelSoc">Nueva tarea de SOC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" hidden id="validadorSoc" value="soc" ;>
                        <div class="mb-3 row">
                            <label for="gdeSoc" class="col-sm-2 col-form-label">N° de GDE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="gdeSoc" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Dependencia</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control form-control-sm" id="dependenciaValorSoc" style="font-size: 13px;">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-5 col-form-label">Ingrese informacion de la dependencia:</label>
                            <div class="col-sm-4 pl-0">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInputSoc" placeholder="Ingrese el Nombre" style="font-size: 13px;">
                            </div>
                            <div class="col-sm-3 pl-1">
                                <input type="hidden" hidden id="cod_depSoc">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInputCodigoSoc" placeholder="Ingrese el CODIGO" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 row">
                                <label for="servicioSoc" class="col-sm-2 col-form-label">Servicio</label>
                                <div class="col-sm-4">
                                    <select id="servicioSoc" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>

                                <label for="operadorSoc" class="col-sm-2 col-form-label">Operador</label>
                                <div class="col-sm-4">
                                    <select id="operadorSoc" disabled class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="analistaSoc" class="col-sm-2 col-form-label">Analista</label>
                                <div class="col-sm-4">
                                    <select id="analistaSoc" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>

                                <label for="sectorSoc" class="col-sm-2 col-form-label">Sector</label>
                                <div class="col-sm-4">
                                    <select id="sectorSoc" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="descripcionSoc" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descripcionSoc" cols="15" rows="5" maxlength="2000" style="font-size: 13px;"></textarea>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: end;">
                            <button type="button" id="btnInsertSoc" class="btn btn-primary btn-sm">Guardar</button>
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal TECNICA -->

    <!-- Modal Tecnica-->
    <div class="modal fade" id="modalAgregarTareaTecnica" tabindex="-1" aria-labelledby="exampleModalLabelTecnica" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelTecnica">Nueva tarea de Tecnica</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" hidden id="validadorTecnica" value="Tecnica" ;>
                        <div class="mb-3 row">
                            <label for="gdeTecnica" class="col-sm-2 col-form-label">N° de GDE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="gdeTecnica" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Dependencia</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control form-control-sm" id="dependenciaValorTecnica" style="font-size: 13px;">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-5 col-form-label">Ingrese informacion de la dependencia:</label>
                            <div class="col-sm-4 pl-0">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInputTecnica" placeholder="Ingrese el Nombre" style="font-size: 13px;">
                            </div>
                            <div class="col-sm-3 pl-1">
                                <input type="hidden" hidden id="cod_depTecnica">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInputCodigoTecnica" placeholder="Ingrese el CODIGO" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 row">
                                <label for="servicioTecnica" class="col-sm-2 col-form-label">Servicio</label>
                                <div class="col-sm-4">
                                    <select id="servicioTecnica" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>

                                <label for="operadorTecnica" class="col-sm-2 col-form-label">Operador</label>
                                <div class="col-sm-4">
                                    <select id="operadorTecnica" disabled class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

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
                                <textarea class="form-control" id="descripcionTecnica" cols="15" rows="5" maxlength="2000" style="font-size: 13px;"></textarea>
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


    <!-- Modal CONCIENTIZACION -->

    <!-- Modal Concientizacion-->
    <div class="modal fade" id="modalAgregarTareaConcientizacion" tabindex="-1" aria-labelledby="exampleModalLabelConcientizacion" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelConcientizacion">Nueva tarea de Concientizacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" hidden id="validadorConcientizacion" value="concientizacion" ;>
                        <div class="mb-3 row">
                            <label for="gdeConcientizacion" class="col-sm-2 col-form-label">N° de GDE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="gdeConcientizacion" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-2 col-form-label">Dependencia</label>
                            <div class="col-sm-10">
                                <input type="text" disabled class="form-control form-control-sm" id="dependenciaValorConcientizacion" style="font-size: 13px;">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-5 col-form-label">Ingrese informacion de la dependencia:</label>
                            <div class="col-sm-4 pl-0">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInputConcientizacion" placeholder="Ingrese el Nombre" style="font-size: 13px;">
                            </div>
                            <div class="col-sm-3 pl-1">
                                <input type="hidden" hidden id="cod_depConcientizacion">
                                <input type="text" class="form-control form-control-sm" id="dependenciaInputCodigoConcientizacion" placeholder="Ingrese el CODIGO" style="font-size: 13px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 row">
                                <label for="servicioConcientizacion" class="col-sm-2 col-form-label">Servicio</label>
                                <div class="col-sm-4">
                                    <select id="servicioConcientizacion" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">
                                        <span>aas</span>
                                    </select>
                                </div>

                                <label for="operadorConcientizacion" class="col-sm-2 col-form-label">Operador</label>
                                <div class="col-sm-4">
                                    <select id="operadorConcientizacion" disabled class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="analistaConcientizacion" class="col-sm-2 col-form-label">Analista</label>
                                <div class="col-sm-4">
                                    <select id="analistaConcientizacion" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>

                                <label for="sectorConcientizacion" class="col-sm-2 col-form-label">Sector</label>
                                <div class="col-sm-4">
                                    <select id="sectorConcientizacion" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="descripcionConcientizacion" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descripcionConcientizacion" cols="15" rows="5" maxlength="2000" style="font-size: 13px;"></textarea>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: end;">
                            <button type="button" id="btnInsertConcientizacion" class="btn btn-primary btn-sm">Guardar</button>
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