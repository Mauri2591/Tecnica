<?php
require_once('../../../Config/Conexion.php');
if (isset($_SESSION['usu_id']) && $_SESSION['usu_id'] > 0) {
    require_once('../../../Public/Template/Head/head.php');
?>
    </head>

    <body>

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
                                    <ul class="nav nav-sm flex-column">
                                        <?php
                                        if (isset($_SESSION) && $_SESSION['id_sector'] === 1) {
                                        ?>
                                            <li class="nav-item">
                                                <a href="<?php echo URL; ?>/View/Home/Soc/soc.php" class="nav-link" data-key="t-crm"><i class="ri-cast-fill"></i> SOC </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php echo URL; ?>/View/Home/Soc/CargaSoc/" class="nav-link" data-key="t-crypto"><i class="ri-drag-drop-fill"></i> Carga Manual </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php echo URL; ?>/View/Home/Tareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-terminal-box-fill"></i> Tareas </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php echo URL; ?>/View/Home/TotalTareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-database-2-fill"></i> Gestor de Tareas </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
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
                                    <h4 class="mb-sm-0">SOC</h4>
                                </div>
                            </div>

                            <input id="usu_id" type="hidden" hidden value="<?php echo $_SESSION['usu_id'] ?>">

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="false">
                                                        Tareas
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#product1" role="tab" aria-selected="false">
                                                        Servicios
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false">
                                                        RRHH
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content  text-muted">

                                                <div class="tab-pane active" id="home" role="tabpanel">
                                                    <h6>Desde aquí puede consultar todas las tareas creadas</h6>
                                                    <div class="col-12">
                                                        <div class="justify-content-center">
                                                            <table id="tabla_tareas_finalizadas_soc" class="table table-bordered text-center">
                                                                <caption class="text-center">Historial de tareas</caption>
                                                                <thead class="text-center">
                                                                    <tr>
                                                                        <th style="width: 200px;">N° GDE Solicitud</th>
                                                                        <th style="width: 200px;">N° GDE Cierre</th>
                                                                        <th style="width: 130px;">Operador</th>
                                                                        <th style="width: 300px;">Servicio</th>
                                                                        <th style="width: 200px;">Analista</th>
                                                                        <th style="width: 5px;">Sector</th>
                                                                        <th style="width: 5px;">Estado</th>
                                                                        <th style="width: 5px;">Reporte</th>
                                                                        <th style="width: 5px;">Detalle</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody_tabla_tareas_finalizadas">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane mt-2" id="product1" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="justify-content-center">
                                                                <table id="tabla_servicios" class="table table-bordered text-center">
                                                                    <caption class="text-center">Tabla de Servicios Creados</caption>
                                                                    <thead class="text-center">
                                                                        <tr>
                                                                            <th style="width: 300px;">Servicio</th>
                                                                            <th style="width: 600px;">Descripción</th>
                                                                            <!-- <th style="width: 5px;">Detalle</th> -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_tabla_servicios">

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="messages" role="tabpanel">
                                                    <h6>Desde aquí puede consultar las licencias</h6>

                                                </div>
                                                <div class="tab-pane" id="settings" role="tabpanel">
                                                    <h6> Desde aquí puede ver las Dependencias y su información</h6>

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

        <!-- Bootstrap JS -->
        <script src="<?php echo URL; ?>/Public/velzon/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="soc.js"></script>
        <?php require_once '../../../Public/Template/Body/body.php'; ?>

    </body>

    </html>
<?php
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>