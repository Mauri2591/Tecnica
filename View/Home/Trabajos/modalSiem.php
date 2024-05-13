<!-- moda SIEM -->

<div class="modal fade" id="mdlSiem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Fecha</span>
                    <input id="fecha_evento" type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nombre Incidencia</span>
                    <input id="nom_incidencia" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nombre Evento</span>
                    <input id="event_name" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Reporting Device</span>
                    <input id="reporting_device" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Reporting Model</span>
                    <input id="reporting_device" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Source Ip</span>
                    <input id="source_ip" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Destination Ip	</span>
                    <input id="destination_ip" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Process Path</span>
                    <input id="process_path" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Process Name</span>
                    <input id="process_name" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">URL</span>
                    <input id="url" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-1">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Urinformation Url</span>
                    <input id="information_url" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="btn-group btn-group-sm mt-2 justify-content-end" role="group" aria-label="Basic example">
                    <button id="btnGuardarEventoSiem" type="button" class="btn btn-secondary">Guardar</button>
                    <button type="button" class="btn btn-muted" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>