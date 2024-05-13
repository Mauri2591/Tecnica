<div class="layout-width">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box horizontal-logo">
                <a href="<?php echo URL; ?>/index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo URL; ?>/Public/velzon/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo URL; ?>/Public/velzon/assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>

                <a href="<?php echo URL; ?>/index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo URL; ?>/Public/velzon/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo URL; ?>/Public/velzon/assets/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                <span class="hamburger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>

        </div>

        <div class="d-flex align-items-center">

            <div class="dropdown d-md-none topbar-head-dropdown header-item">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-search fs-22"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown topbar-head-dropdown ms-1 header-item">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="tooltip" data-placement="top" title="Ver herramientas de Pentesting" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-category-alt fs-22"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
                    <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fw-semibold fs-15 text-center"> Enlaces externos </h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" target="_blank" href="https://www.shodan.io/">
                                    <img class="data-toggle=tooltip" data-placement="top" title="Esta herramienta nos da informacion sobre Dominios, Subdominios, Ips, Routers, etc..." src="<?php echo URL; ?>/Public/velzon/assets/images/flags/shodan.png" alt="Shodan">
                                </a>
                            </div>

                            <div class="col">
                                <a class="dropdown-icon-item" target="_blank" href="https://search.censys.io/">
                                    <img class="data-toggle=tooltip" data-placement="top" title="Esta herramienta nos da informacion sobre Dominios, Subdominios, Ips, Routers, etc..." src="<?php echo URL; ?>/Public/velzon/assets/images/flags/censys.png" alt="Censys">
                                </a>
                            </div>

                            <div class="col">
                                <a class="dropdown-icon-item" target="_blank" href="https://www.virustotal.com/gui/home/upload">
                                    <img class="data-toggle=tooltip" data-placement="top" title="VirusTotal proporciona informacion de archivos y URL sospechosos en busca de malware y otros tipos de amenazas..." src="<?php echo URL; ?>/Public/velzon/assets/images/flags/virustotal.png" alt="VirusTotal">
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" target="_blank" href="https://www-exploit--db-com.translate.goog/?_x_tr_sl=en&_x_tr_tl=es&_x_tr_hl=es-419&_x_tr_pto=sc">
                                    <img class="data-toggle=tooltip" data-placement="top" title="O comunmente llamada Exploit Db, es una base de datos en línea que recopila y cataloga exploits..." src="<?php echo URL; ?>/Public/velzon/assets/images/flags/exploitDatabase.png" alt="Exploit Database">
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" target="_blank" href="https://exploits.shodan.io/welcome">
                                <img class="data-toggle=tooltip" data-placement="top" title="Shodan Exploit es una seccion dentro de Shodan que permite buscar exploits para dispositivos específicos en su base de datos" src="<?php echo URL; ?>/Public/velzon/assets/images/flags/shodanExploit.png" alt="Shodan Exploit">
                                </a>
                            </div>

                            <div class="col">
                                <a class="dropdown-icon-item" target="_blank" href="https://nmap.org/nsedoc/categories/">
                                <img class="data-toggle=tooltip" data-placement="top" title="Nmap es una herramienta para descubrimientos de puertos y servicios, desde aquí puedes consultar en la página oficial los distintos scripts NSE" src="<?php echo URL; ?>/Public/Uploads/nmap.jpeg" width="80" height="100" alt="Shodan Exploit">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown ms-sm-3 header-item topbar-user">
                <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center">
                        <img class="rounded-circle header-profile-user" src="<?php echo URL; ?>/Public/velzon/assets/images/userGeneral.png" alt="Header Avatar">
                        <span class="text-start ms-xl-2">
                            <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $_SESSION['nombre_usuario']; ?></span>
                            <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">
                                <?php echo ($_SESSION['id_rol'] == 1) ? 'Desarrollador' : ($_SESSION['id_rol'] == 2 ? 'Administrador' : 'Usuario'); ?>
                            </span>
                        </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="<?php echo URL; ?>/Public/Template/Perfil/"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Perfil</span></a>
                    <!-- <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a> -->
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-soft-success text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Configuración</span></a> -->
                    <a class="dropdown-item" href="<?php echo URL; ?>/View/Logout/"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Salir</span></a>
                </div>
            </div>
        </div>
    </div>
</div>