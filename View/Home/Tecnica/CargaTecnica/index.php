carga tecnica<?php
require_once('../../../../Config/Conexion.php');
if (isset($_SESSION['usu_id']) && $_SESSION['usu_id'] > 0) {
    require_once('../../../../Public/Template/Head/head.php');
?>
    </head>

    <body>

        <style>
            #container-table_tecnica {
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
        </style>

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <?php require_once('../../../../Public/Template/Header/header.php'); ?>
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

                                    <?php require_once("../../../../Public/Template/Nav/nav.php"); ?>

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
                                    <h4 class="mb-sm-0">CARGAS</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" hidden id="usu_session" value="<?php echo $_SESSION['usu_id'] ?>">
                                            <h5 class="text-center text-muted mb-2">Desde aquí puedes crear nuevas tareas</h5>
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tecnicaAgregarTareaManual" role="tab" aria-selected="false">
                                                        TECNICA
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content  text-muted">

                                                <!-- Inicio carga de tareas tecnica -->
                                                <div class="tab-pane active" id="tecnicaAgregarTarea" role="tabpanel">
                                                    <div class="row mt-2">
                                                        <div class="col-10 text-center mt-3">
                                                            <div class="container">
                                                                <div id="container-table_tecnica" class="justify-content-center">
                                                                    <table id="tabla_carga_tareas_tecnica" class="mx-auto text-center table align-middle table-nowrap mb-0">
                                                                        <thead>
                                                                            <tr style="margin-bottom: 100px;">
                                                                                <th style="width: 5px;">N°</th>
                                                                                <th style="width: 500px;">N° GDE</th>
                                                                                <th style="width: 200px;">Operador</th>
                                                                                <th style="width: 300px;">Servicio</th>
                                                                                <th style="width: 200px;">Analista</th>
                                                                                <th style="width: 150px;">Sector</th>
                                                                                <th style="width: 10px;">Estado</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody_total_tareas_vista_carga_tecnica">

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-center">
                                                            <button type="button" id="btnAgregarTareaTecnicaManual" class="btn btn-success btn-label">Agregar Tarea</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIN CARGA TAREAS tecnica -->

                                                <?php require_once 'modalCargaTareasTecnica.php'; ?>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/feather-icons/feather.min.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="<?php echo URL; ?>/Public/velzon/assets/js/plugins.js"></script>

        <!-- App js -->
        <script src="<?php echo URL; ?>/Public/velzon/assets/js/app.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap JS -->

        <script src="main.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>