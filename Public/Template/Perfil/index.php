<?php
require_once('../../../Config/Conexion.php');
if (isset($_SESSION['usu_id']) && $_SESSION['usu_id'] > 0) {
    require_once('../../../Public/Template/Head/head.php');
?>
    </head>

    <body>
        <script src="<?php echo URL; ?>/Public/jsMios/jquery.js"></script>
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
                                    <h4 class="mb-sm-0">PERFIL DEL USUARIO</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#info_usuario" role="tab" aria-selected="false">
                                                        Mi Informacion
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#licencia_usuario" role="tab" aria-selected="false">
                                                        Mi Licencia
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content  text-muted">
                                                <div class="tab-pane active justifi-content-center" style="width: 60%;" role="tabpanel">
                                                    <nav class="border rounded border-success p-3">
                                                        <ul id="info_usuario">
                                                        
                                                        </ul>
                                                        <section style="display: flex; justify-content: end;">
                                                            <button class="btn btn-sm btn-success" id="btn_editar_usu">Editar</button>
                                                        </section>
                                                    </nav>
                                                </div>

                                                <div class="tab-pane" id="licencia_usuario" role="tabpanel">
                                                    <h6>Licencias</h6>

                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once 'modalPerfil.php';?>
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

        <script src="main.js"></script>
        <?php require_once '../../../Public/Template/Body/body.php'; ?>

    </body>

    </html>
<?php
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>