<div class="modal fade" id="mdlAgregarActivo" tabindex="-1" aria-labelledby="exampleModalLabelSoc" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelSoc">Carga Activo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <p class="text-muted" style="width: 75%; margin:10px 0 0 20px">Los campos con (<span class="text-danger">*</span>) son requeridos y obligatorios</p>
            <div class="modal-body">
                <form method="post">

                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">Dependencia</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control form-control-sm" id="DESC_DEPENDENCIA_PFA" style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gdeSoc" class="col-sm-3 col-form-label">Tipo <span class="text-danger mx-1">*</span></label>
                        <div class="col-sm-9">
                            <select id="id_accion_concientizacion" class="form-select form-select-sm" aria-label=".form-select-sm example" style="font-size: 13px;">

                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">Activo <span class="text-danger mx-1">*</span></label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <input id="nom_activo" type="text" placeholder="Ingrese el nombre del activo" class="form-control form-control-sm" style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">GDE</label>
                        <div class="col-sm-9 d-flex align-items-center">
                            <input id="gde_activo" type="text" placeholder="Ingrese el n° de Ex, Memo, Nota, etc" class="form-control form-control-sm" style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ficha_activo" class="col-sm-5 col-form-label">Ingrese Ficha y Cantidad:</label>
                        <div class="col-sm-4 pl-0">
                            <input id="ficha_activo" type="text" class="form-control form-control-sm" placeholder="N° de Ficha" style="font-size: 13px;">
                        </div>
                        <div class="col-sm-3 pl-1">
                            <input type="hidden" hidden id="cod_depSoc">
                            <input id="cantidad_activo" type="number" class="form-control form-control-sm" placeholder="Cantidad" style="font-size: 13px;">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="descripcionSoc" class="col-sm-2 col-form-label">Descripcion</label>
                        <div class="col-sm-10">
                            <textarea id="descrip_activo" placeholder="En el caso que considere. Ingrese una brebe descripcion, la misma no debe superar los 255 caracteres." class="form-control" cols="20" rows="8" maxlength="255" style="font-size: 13px;"></textarea>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: end;">
                        <button type="button" id="btnInsertActivo" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>