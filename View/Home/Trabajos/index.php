<?php
require_once('../../../Config/Conexion.php');
if (isset($_SESSION['usu_id']) && $_SESSION['usu_id'] > 0) {
    require_once('../../../Public/Template/Head/head.php');
?>
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    </head>

    <body>

        <style>
            #container-table_tareas_en_curso {
                width: 100%;
                border-collapse: collapse;
                overflow-y: auto;
                /* Agrega un scroll vertical */
                max-height: 300px;
                /* Define la altura máxima de la tabla */
            }

            .scrollable-table th,
            .scrollable-table td {
                border: 1px solid #ddd;
                padding: 8px;
            }

            .card-body {
                overflow-x: auto;
                /* Agrega desplazamiento horizontal si el contenido es demasiado ancho */
            }

            .table {
                width: 100%;
                /* Opcional: asegura que la tabla ocupe todo el ancho del contenedor */
            }

            .table th,
            .table td {
                white-space: nowrap;
                /* Evita que el contenido de las celdas se envuelva */
                overflow: hidden;
                /* Oculta el contenido que sobresale */
                text-overflow: ellipsis;
                /* Muestra puntos suspensivos (...) cuando el contenido se corta */
            }
        </style>

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <?php require_once('../../../Public/Template/Header/header.php'); ?>
            </header>
            <!-- ========== App Menu ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <a href="<?php echo URL; ?>/View/Home/" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo URL; ?>/Public/velzon/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo URL; ?>/Public/velzon/assets/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="<?php echo URL; ?>/View/Home/" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo URL; ?>/Public/velzon/assets/images/userPolice2.png" alt="" width="30" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo URL; ?>/Public/velzon/assets/images/userPolice2.png" alt="" width="80" height="70">

                        </span>
                    </a>
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>

                <input type="hidden" hidden id="usu_id" value="<?php echo $_SESSION['usu_id'] ?>">

                <div id="scrollbar">
                    <div class="container-fluid">
                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Panel</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarDashboards">

                                    <?php require_once("../../../Public/Template/Nav/nav.php"); ?>

                                </div>
                            </li> <!-- end Dashboard Menu -->
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>

                <div class="sidebar-background"></div>
            </div>
            <!-- Left Sidebar End -->
            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 m-0">TRABAJAR</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div id="cont_vista_detalle_tarea" class="card-body pb-0 mb-0 border border-warning" style="background-color:#f9f9f9">
                                                <h5 class="card-title text mb-2">Detalle de la tarea <span id="label_estado_tarea" class="badge bg-success pt-1" style="margin-left: 15px;"></span></h5>
                                                <div class="card-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody id="tbody_datos_tarea_x_analista">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="cont_detalle_tabla_evento_siem" class="card-body pb-0 mb-0 border border-warning" style="background-color:#f9f9f9">
                                                <div class="card-body">
                                                    <p class="text-muted">Evento - <code class="fs-18">SIEM</code></p>
                                                    <div class="live-preview" id="cont_get_datos_tabla_siem">
                                                        <ul class="list-group">

                                                            <div class="row">
                                                                <div class="d-flex col-lg-12">
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">fecha_evento: <span id="fecha_evento"></span></li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Nombre Incidencia: <span id="nom_incidencia"></span></li>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="d-flex col-lg-12">
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Nombre Evento: <span id="event_name"></span></li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Reporting Device: <span id="reporting_device"></span></li>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="d-flex col-lg-12">
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Reporting Model: <span id="reporting_model"></span></li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">url: <span id="url"></span></li>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="d-flex col-lg-12">
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Source Ip: <span id="source_ip"></span></li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Destination Ip: <span id="destination_ip"></span></li>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="d-flex col-lg-12">
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Process Path: <span id="process_path"></span></li>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Process Name: <span id="process_name"></span></li>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="d-flex col-lg-12">
                                                                    <div class="col-md-6">
                                                                        <li class="list-group-item">Information Url: <span id="information_url"></span></li>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="container_relevamiento_activos_concientizacion" class="card-header mt-2 border border-light" style="display: none;">
                                            
                                            </div>

                                            <hr class="mb-4">

                                            <div class="row bg-light border border-primary" id="cont_reporte_analisis_vuln_zap"><!--Inicio Reporte XML ZAP-->
                                                <h6 class="card-title text-center text-secondary fw-bold mb-5 mt-3" id="reporte_analisis_va">Repote Analisis de Vulnerabilidades WEB - Ningun archivo subido</h6>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header align-items-center d-flex">
                                                            <div class="flex-grow-1">
                                                                <p style="display: flex; justify-content: space-between; margin-bottom: 0;">
                                                                    <span class="text-secondary fs-15">El Target escaneado presenta las siguientes vulnerabilidades: (Escaneo Web) <span id="tipo_de_scanner"></span></span>
                                                                    <span id="btnEliminarXml" onclick="btnEliminarXml(<?php echo $_GET['tarea']; ?>)" type="button" style="align-self: flex-end; color:#CF2C00; margin-right: 10px;" class="data-toggle=tooltip" data-placement="top" title="Eliminar .xml almacenado"><i class="fs-22 ri-file-excel-fill"></i></span>
                                                                </p>
                                                            </div>
                                                        </div><!-- end card header -->
                                                        <div class="card-body"> <!-- Conetido del reporte -->
                                                            <div class="live-preview">
                                                                <div class="live-preview"> <!-- Cabecera del reporte -->
                                                                    <h6 class="mb-1 text-secondary">Cabecera:</h6>
                                                                    <ul class="list-group" id="datos_del_escanner_zap">

                                                                    </ul>
                                                                </div><!-- Fin cabecera del reporte -->

                                                                <div class="live-preview"> <!-- Cuerpo del reporte -->
                                                                    <h6 class="mb-1 mt-4 text-secondary">Cuerpo:</h6>
                                                                    <p class="mb-1 mt-4 text-secondary" id="id_ips"></p>
                                                                    <ul class="list-group" id="encabezado_reporte_xml_zap"></ul>
                                                                    <ul class="list-group" id="cantidadDeEvidencias"></ul><br>
                                                                    <ul class="list-group" id="cuerpo_reporte_xml_zap">

                                                                    </ul>

                                                                </div><!-- Fin cuerpo del reporte -->
                                                            </div>
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div>
                                            </div><!--Fin Reporte xml ZAP -->

                                            <div class="row bg-light border border-primary mt-3" id="cont_reporte_analisis_vuln_nmap"><!--Inicio Reporte XML NMAP-->
                                                <h6 class="card-title text-center mb-5 mt-3 fw-bold" id="reporte_analisis_va_nmap">Repote Analisis de Vulnerabilidades IP - Ningun archivo subido</h6>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header bg-dark align-items-center d-flex">
                                                            <div class="flex-grow-1">
                                                                <p style="display: flex; justify-content: space-between; margin-bottom: 0;">
                                                                    <span class="text-light fs-15">El Target escaneado presenta las siguientes vulnerabilidades: (Puertos y Servicios) <span id="tipo_de_scanner_nmap"></span></span>
                                                                    <span id="btnEliminarXml_nmap" onclick="btnEliminarXml_nmap(<?php echo $_GET['tarea']; ?>)" type="button" style="align-self: flex-end; color:#ccc; margin-right: 10px;" class="data-toggle=tooltip" data-placement="top" title="Eliminar .xml almacenado"><i class="fs-22 ri-file-excel-fill"></i></span>
                                                                </p>
                                                            </div>
                                                        </div><!-- end card header -->
                                                        <div class="card-body bg-dark"> <!-- Conetido del reporte -->
                                                            <div class="live-preview">
                                                                <div class="live-preview"> <!-- Cabecera del reporte -->
                                                                    <h6 class="mb-1 text-light">Cabecera:</h6>
                                                                    <ul class="list-group" id="datos_del_escanner_nmap">

                                                                    </ul>
                                                                </div><!-- Fin cabecera del reporte -->

                                                                <div class="live-preview bg-dark"> <!-- Cuerpo del reporte -->
                                                                    <h6 class="mb-1 mt-4 text-light">Cuerpo:</h6>

                                                                    <ul class="list-group" id="cuerpo_reporte_xml_zap_nmap">

                                                                    </ul>
                                                                </div><!-- Fin cuerpo del reporte -->
                                                            </div>
                                                        </div><!-- end card-body -->
                                                    </div><!-- end card -->
                                                </div>
                                            </div><!--Fin Reporte xml NMAP -->
                                            <?php require_once 'modalSiem.php'; ?>


                                            <hr class="mb-3">
                                            <?php require_once 'modalSubirArchivo.php'; ?>

                                            <div style="background-color: #f9f9f9;padding:15px;">
                                                <h5 class="card-title mb-4">Actividades realizadas</h5>
                                                <div data-simplebar="init" style="height: 400px;" class="px-3 mx-n3">
                                                    <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                                        <div class="simplebar-height-auto-observer-wrapper">
                                                            <div class="simplebar-height-auto-observer"></div>
                                                        </div>
                                                        <div class="simplebar-mask">
                                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                                                    <div id="container_actividades_realizadas" class="simplebar-content" style="padding: 0px 16px;">

                                                                    </div>

                                                                    <div id="cont_tarea_finalizada" style="margin-left: 50px;">
                                                                        <span class="fs-13 fw-bold">Fecha de cierre: <span id="fech_tarea_finalizada"></span></span>
                                                                        <br>
                                                                        <span class="fs-13 fw-bold">Descripcion de cierre: <span id="desc_tarea_finalizada"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="simplebar-placeholder" style="width: auto; height: 598px;"></div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                                    </div>
                                                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                        <div class="simplebar-scrollbar" style="height: 150px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form method="post" id="form_tareas" enctype="multipart/form-data">

                                                <textarea id="summernote" name="summernote"></textarea>
                                                <input type="file" width="100" height="100" name="img_tarea" id="img_tarea" accept="image/jpeg, image/png, image/jpg, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                                <label style="margin-left: 30px; border: 1px solid gray; padding:2px" for="img_base64">Ingrese captura de pantalla
                                                    <input type="text" id="img_base64">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="mb-3" style="margin-left: 15px;">
                                            <div id="btn_group_tarea" class="btn-group btn-group-sm mt-2 justify-content-end" role="group" aria-label="Basic example">
                                                <input type="submit" name="guardar" value="Guardar" id="btnGuardarActividad" class="btn btn-secondary">
                                                <!-- <button id="btnGuardarActividad" type="submit" class="btn btn-secondary">Guardar</button> -->
                                                <button id="btnCerrarActividad" type="button" class="btn btn-success">Finalizar</button>
                                            </div>
                                        </div>
                                        </form>

                                        <?php require_once 'modalCerrarTareas.php';
                                        require_once 'modalSiem.php';
                                        ?>


                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Mauricio Raúl Gonzalez.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                División SEGURIDAD INFORMÁTICA
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



        <!-- JAVASCRIPT -->
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/feather-icons/feather.min.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/js/plugins.js"></script>

        <!-- App js -->
        <script src="<?php echo URL; ?>/Public/velzon/assets/js/app.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.js"></script>

        <!-- JavaScript de DataTables -->
        <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->

        <!--datatable js-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="main.js"></script>
        <?php require_once '../../../Public/Template/Body/body.php'; ?>

    </body>

    </html>
<?php
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>