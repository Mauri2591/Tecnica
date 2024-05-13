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
            <a href="<?php echo URL; ?>/View/Home/Inspecciones/activosInstitucionales.php" class="nav-link" data-key="t-crypto"><i class="ri-funds-fill"></i> Activos </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/TotalTareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-database-2-fill"></i> Gestor de Tareas </a>
        </li>
    <?php } else if ($_SESSION['id_sector'] === 2) { ?>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Tecnica/tecnica.php" class="nav-link" data-key="t-crypto"><i class=" ri-pencil-ruler-2-fill"></i> Tecnica </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Tecnica/CargaTecnica/" class="nav-link" data-key="t-crypto"><i class="ri-drag-drop-fill"></i> Carga Manual </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Tareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-terminal-box-fill"></i> Tareas </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Inspecciones/activosInstitucionales.php" class="nav-link" data-key="t-crypto"><i class="ri-funds-fill"></i> Activos </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/TotalTareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-database-2-fill"></i> Gestor de Tareas </a>
        </li>
    <?php } else if (isset($_SESSION) && $_SESSION['id_sector'] === 3) { ?>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Inspecciones/inspecciones.php" class="nav-link" data-key="t-crypto"><i class=" ri-slideshow-line"></i> Concientizacion </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Inspecciones/CargaInspecciones/" class="nav-link" data-key="t-crypto"><i class="ri-drag-drop-fill"></i> Carga Manual </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Tareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-terminal-box-fill"></i> Tareas </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Inspecciones/activosInstitucionales.php" class="nav-link" data-key="t-crypto"><i class="ri-funds-fill"></i> Activos </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/TotalTareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-database-2-fill"></i> Gestor de Tareas </a>
        </li>
    <?php } else if (isset($_SESSION) && $_SESSION['id_sector'] == 4) {
    ?>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Administrativa/administrativa.php" class="nav-link" data-key="t-crypto"><i class=" ri-file-copy-2-fill"></i> Administrativa </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Administrativa/carga.php" class="nav-link" data-key="t-crypto"><i class=" ri-tools-fill"></i> Cargas </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/Inspecciones/activosInstitucionales.php" class="nav-link" data-key="t-crypto"><i class="ri-funds-fill"></i> Activos </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo URL; ?>/View/Home/TotalTareas/tareas.php" class="nav-link" data-key="t-crypto"><i class="ri-database-2-fill"></i> Gestor de Tareas </a>
        </li>
    <?php
    }
    ?>
</ul>