<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sidebar-menu" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img class="cositecImage rounded-circle" src="resources/logo.png" alt="" style="width: 100%; height: 100%; background: white;">
        </div>
        <div class="sidebar-brand-text mx-3">Laboratorio DML</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="inicio.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Inicio</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="resultados.php">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Resultados</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCortes" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cortes</span>
        </a>
        <div id="collapseCortes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cortes:</h6>

                <a class="collapse-item" href="cortesCliente.php">
                    <i class="fa fa-briefcase"></i> Clientes
                </a>
                <a class="collapse-item" href="cortePagos.php">
                    <i class="fa fa-money"></i> Pagos
                </a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Catálogos</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Catálogos:</h6>

                <a class="collapse-item" href="estudios.php">
                    <i class="fa fa-tasks"></i> Estudios
                </a>
                <a class="collapse-item" href="pacientes.php">
                    <i class="fa fa-book-medical"></i> Pacientes
                </a>
                <a class="collapse-item" href="clientes.php">
                    <i class="fa fa-briefcase"></i> Clientes
                </a>
                <a class="collapse-item" href="usuarios.php">
                    <i class="fa fa-user"></i> Usuarios
                </a>
                <a class="collapse-item" href="perfiles.php">
                    <i class="fa fa-user-tag"></i> Perfiles
                </a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
