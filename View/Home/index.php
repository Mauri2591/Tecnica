<?php
require_once('../../Config/Conexion.php');
if (isset($_SESSION['usu_id']) && $_SESSION['usu_id'] > 0) {
    require_once('../../Public/Template/Head/head.php');
?>
    </head>

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <?php require_once('../../Public/Template/Header/header.php'); ?>
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
                                        require_once '../../Public/Template/Nav/nav.php';
                                        ?>
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
                                    <h4 class="mb-sm-0">Inicio</h4>
                                </div>
                                <h6 class="text-muted text-center mb-5">Desde aqui puede consultar la estadistica de las tareas realizadas a la fecha</h6>
                                <?php var_dump($_SESSION);?>
                            </div>
                            <div>
                                <div class="row p-3" style="border:1px solid #C0C0C0">
                                    <div class="col-8">
                                        <canvas id="barTareas"></canvas>
                                    </div>
                                    <div class="col-4">
                                        <canvas id="donutTareas"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- container-fluid -->
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

        <script src="home.js"></script>
        <!-- <?php require_once '../../Public/Template/Body/body.php'; ?> -->


        <script>
            Swal.fire({
                title: "Bienvenido " + <?php echo json_encode($_SESSION['nombreUsuBienvenida']) ?>,
                text: "Puede realizar funciones en el sistema",
                showConfirmButton: false,
                timer: 1700
            });
        </script>
    </body>

    </html>
<?php
    unset($_SESSION['nombreUsuBienvenida']);
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>