<?php if (isset($_SESSION) && $_SESSION['usu_id'] > 0) { ?>

    <!-- Modal Soc-->
    <div class="modal fade" id="modalAgregarTareaSoc" tabindex="-1" aria-labelledby="exampleModalLabelSoc" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelSoc">Nueva tarea SOC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">

                        <div class="mb-3 row">
                            <label for="gdeSoc" class="col-sm-2 col-form-label">N° de GDE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="gdeSoc" style="font-size: 13px;">
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
                                <label for="servicioSoc" class="col-sm-2 col-form-label">Servicio</label>
                                <div class="col-sm-4">
                                    <select id="servicioCargaSoc" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                                    </select>
                                </div>

                                <label for="operadorSoc" class="col-sm-2 col-form-label">Operador</label>
                                <div class="col-sm-4">
                                    <select id="operadorSoc" disabled class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">
                                        <option value="<?php echo $_SESSION['usu_id'] ?>"><?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellido_usuario'] ?></option>
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

                            <label id="id_servicioSocSubCategoria" for="servicioSocSubCategoria" class="col-sm-2 col-form-label">Subcategoria</label>
                            <div class="col-sm-4">
                                <select id="servicioSocSubCategoria" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                            </select>
                            </div>


                        </div>


                        <div class="mb-3 row" id="container_ips_urls">
                            <label for="descripcionSoc" class="col-sm-2 col-form-label">Ip's</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" placeholder='Si ingresa mas de 1 ip coloque al final una "," y coloque la siguiente por debajo' id="ips" cols="10" rows="5" maxlength="2000"></textarea>
                            </div>

                            <label for="descripcionSoc" class="col-sm-2 col-form-label">URL´s</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" placeholder='Si ingresa mas de 1 url coloque al final una "," y coloque la siguiente por debajo' id="urls" cols="10" rows="5" maxlength="2000"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="descripcionSoc" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descripcionSoc" cols="15" rows="5" maxlength="2000"></textarea>
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

    <!-- Modal CONCIENTIZACIÓN-->
    <div class="modal fade" id="modalAgregarTareaConcientizacion" tabindex="-1" aria-labelledby="exampleModalLabelConcientizacion" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelConcientizacion">Nueva tarea de Auditoría y Concientización</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">

                        <div class="mb-3 row">
                            <label for="gdeConcientizacion" class="col-sm-2 col-form-label">N° de GDE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="gdeConcientizacion">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 row">
                                <label for="servicioConcientizacion" class="col-sm-2 col-form-label">Servicio</label>
                                <div class="col-sm-4">
                                    <select id="servicioConcientizacion" class="form-select form-select-sm" aria-label=".form-select-sm example">

                                    </select>
                                </div>

                                <label for="operadorConcientizacion" class="col-sm-2 col-form-label">Operador</label>
                                <div class="col-sm-4">
                                    <select id="operadorConcientizacion" disabled class="form-select form-select-sm" aria-label=".form-select-sm example">

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="analistaConcientizacion" class="col-sm-2 col-form-label">Analista</label>
                                <div class="col-sm-4">
                                    <select id="analistaConcientizacion" class="form-select form-select-sm" aria-label=".form-select-sm example">

                                    </select>
                                </div>

                                <label for="sectorConcientizacion" class="col-sm-2 col-form-label">Sector</label>
                                <div class="col-sm-4">
                                    <select id="sectorConcientizacion" class="form-select form-select-sm" aria-label=".form-select-sm example">

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="descripcionConcientizacion" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descripcionConcientizacion" cols="15" rows="5"></textarea>
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