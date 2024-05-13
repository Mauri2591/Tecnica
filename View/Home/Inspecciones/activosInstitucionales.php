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
                                    <h4 class="mb-sm-0 m-0">VER ACTIVOS INSTITUCIONALES POR DEPENDENCIA</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <table id="tabla_dependencias">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Dependencia</th>
                                                                    <th>Codigo</th>
                                                                    <th>Ubicacion</th>
                                                                    <th>Super</th>
                                                                    <th>Ver</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="text-center">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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

        <script src="activosInstitucionales.js"></script>
        <?php require_once '../../../Public/Template/Body/body.php'; ?>

    </body>

    </html>
<?php
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>