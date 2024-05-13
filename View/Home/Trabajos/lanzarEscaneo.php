<?php
require_once('../../../Config/Conexion.php');
if (isset($_SESSION['usu_id']) && $_SESSION['usu_id'] > 0) {
    require_once('../../../Public/Template/Head/head.php');
?>
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote.min.css" rel="stylesheet">

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
                                    <h4 class="mb-sm-0 m-0">SCANNER NMAP</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <p class="text-muted mb-3">Desde aqui puede lanzar escaneos con la herramienta NMAP</p>
                                                <form action="../../../Controller/ctrEscaneos.php" method="post">
                                                    <input type="hidden" name="nom_herramienta" value="nmap">
                                                    <input type="hidden" hidden name="tarea_id" id="tarea_id" value="<?php echo $_GET['tarea'];?>">
                                                    <input id="lanzarEscaneoNmap" name="Escanear" value="Escanear" class="mb-2 btn tet-light btn-danger btn-sm pt-0 pb-0 fw-bold fs-13" type="submit" data-toggle="tooltip" data-placement="top" title="Lanzar Escaneo">
                                                    <div>
                                                    <span id="importar_resultado_xml" class="btn btn-outline-primary waves-effect waves-light pt-0 pb-0 pr-1 pr-1 mb-2 fs-11" data-toggle="tooltip" data-placement="top" title="Importar el resultado al proyecto" type="button">Procesar Resultados</span>
                                                    </div>
                                                    <div class="live-preview">
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <span class="text-muted mb-1">Ips para el escaneo: </span>
                                                                <input type="text" style="width: 100%; outline: none; border-radius: 3px; padding-left: 5px;" readonly name="lista_de_ips" value="lista_de_ips" id="lista_de_ips"></pre>
                                                            </li>
                                                            <span class="badge badge-outline-light text-dark fs-12" id="lanzando_escaneo"></span>
                                                        </ul>
                                                    </div>
                                                </form>
                                                <div class="card card-body text-light p-2">
                                                    <pre><p id="resultado_escaneo_nmap" class="fs-14 p-2 bg-dark border border-light"></pre>
                                                </div>
                                            </div>
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

        <!-- Bootstrap JS -->
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="lanzarEscaneo.js"></script>
        <?php require_once '../../../Public/Template/Body/body.php'; ?>

    </body>

    </html>
<?php
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>