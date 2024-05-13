<?php
require_once('../../../Config/Conexion.php');
if (isset($_SESSION['usu_id']) && $_SESSION['usu_id'] > 0) {
    require_once('../../../Public/Template/Head/head.php');
?>
    </head>

    <body>
        <link rel="stylesheet" href="../../../Public/Css/styleUsuarios.css">
        <link rel="stylesheet" href="../../../Public/Css/icons.css">
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
                                    <h4 class="mb-sm-0">Usuarios</h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <?php if (isset($_SESSION) && $_SESSION['id_rol'] == 1 && $_SESSION['id_sector'] == 1) { ?>
                                        <div class="col-9">
                                            <h6 class="mb-sm-0 text-center text-muted">Consultar Usuarios</h6>
                                            <div class="card mt-2" id="container_table">
                                                <table class="table table-hover" id="tabla_usuarios">
                                                    <thead>
                                                        <tr>
                                                            <th style="padding:5px; text-align:center">Nombre</th>
                                                            <th style="padding:5px; text-align:center">Apellido</th>
                                                            <th style="padding:5px; text-align:center">Área</th>
                                                            <th style="padding:5px; text-align:center">Teléfono</th>
                                                            <th style="padding:5px; text-align:center">Rol</th>
                                                            <th style="padding:5px; text-align:center">Estado</th>
                                                            <th style="padding:5px; text-align:center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_usuarios">

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <h6 class="mb-sm-0 text-muted text-center">Agregar Usuario</h6>
                                            <div class="col-xl-12 col-md-12 ">
                                                <!-- card -->
                                                <div class="card card-animate mt-2">
                                                    <div class="card-body bg-light border">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1">
                                                                <p class="text-uppercase fw-medium text-muted mb-0">Crear Usuario</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                                                    <a type="button" onclick="openModalInserUsu()"><i class="bx bx-user-circle text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar nuevo usuario"></i></a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <input type="hidden" hidden value="0" id="valor_para_no_mostrar_datos_de_la_tabla">
                                        <div class="col-12">
                                            <h5 class="mb-sm-0 text-center text-muted">Consultar Usuarios</h5>
                                            <div class="card mt-2" id="container_table">
                                                <table class="table table-hover" id="tabla_usuarios">
                                                    <thead>
                                                        <tr>
                                                            <th style="padding:5px; text-align:center">Nombre</th>
                                                            <th style="padding:5px; text-align:center">Apellido</th>
                                                            <th style="padding:5px; text-align:center">Área</th>
                                                            <th style="padding:5px; text-align:center">Teléfono</th>
                                                            <th style="padding:5px; text-align:center">Rol</th>
                                                            <th style="padding:5px; text-align:center">Estado</th>
                                                            <th style="padding:5px; text-align:center">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_usuarios">

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php require_once 'modalUsuarios.php'; ?>

                    </div>
                    <!-- end page title -->
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
        <?php require_once '../../../Public/Template/Body/body.php'; ?>
        <script src="usuarios.js"></script>
        <script src="../../../Public/Js/sweetAlert.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:" . URL . "/View/Logout/");
}
?>