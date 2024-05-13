<?php if (isset($_SESSION) && $_SESSION['usu_id'] > 0) { ?>

    <!-- Modal ZAP y Burpsuite-->
    <div class="modal fade" id="modalAgregarArchivoZap" tabindex="-1" aria-labelledby="exampleModalLabelSoc" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="page-content pt-5 pb-5 pl-0 pr-0">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="card-body border border border-muted">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false">
                                                ZAP
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content  text-muted">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <p class="bg-info p-3 text-light rounded">Desde aquí puede subir un reporte en formato .xml realizado en la herramienta ZAP de OWASP</p>
                                            <div class="col-4">
                                                <div class="justify-content-center mt-3">
                                                    <form action="../../../Controller/ctrSubidaArchivosReportesFormatos.php" enctype="multipart/form-data" method="post">
                                                        <input type="hidden" hidden value="zap" name="nom_herramienta" id="nom_herramienta">
                                                        <label for="nom_archivo" class="form-label">Seleccione archivo XML:</label>
                                                        <input class="form-control form-control-sm" name="nom_archivo" id="nom_archivo" type="file">
                                                        <input type="hidden" hidden name="tarea_id" value="<?php echo $_GET['tarea'] ?>">
                                                        <input type="submit" id="subir_xml_zap" value="Procesar archivo" class="btn btn-sm bg-info mt-2 text-light">
                                                        <p id="mje_xml"></p>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal NMAP-->
    <div class="modal fade" id="modalAgregarArchivoNmap" tabindex="-1" aria-labelledby="exampleModalLabelSoc" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="page-content pt-5 pb-5 pl-0 pr-0">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-xxl-12">
                                <div class="card-body border border border-muted">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false">
                                                NMAP
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content  text-muted">

                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <p class="bg-dark p-3 text-light rounded">Desde aquí puede subir un reporte en formato .xml realizado con la herramienta NMAP</p>
                                            <div class="col-4">
                                                <div class="justify-content-center mt-3">
                                                    <form action="../../../Controller/ctrSubidaArchivosReportesFormatos.php" enctype="multipart/form-data" method="post">
                                                        <input type="hidden" hidden value="nmap" name="nom_herramienta" id="nom_herramienta">
                                                        <label for="nom_archivo" class="form-label">Seleccione archivo XML:</label>
                                                        <input class="form-control form-control-sm" name="nom_archivo" id="nom_archivo" type="file">
                                                        <input type="hidden" hidden name="tarea_id" value="<?php echo $_GET['tarea'] ?>">
                                                        <input type="submit" id="subir_xml_nmap" value="Procesar archivo" class="btn btn-sm bg-dark mt-2 text-light">
                                                        <p id="mje_xml_nmap"></p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    header("Location: " . URL);
} ?>