<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Search -->
    <!--<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">-->
    <form style="width: 70%;">
        <div class="row onlyBig">
            <div class="col-lg-12">
                <label>Estatus de las ordenes:</label>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <label style="display: inline-block">Recepción a cliente</label>
                <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrders"></span>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <label style="display: inline-block">Pre-diagnóstico</label>
                <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrdersPre"></span>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <label style="display: inline-block">Por entregar</label>
                <span style="display: inline-block" class="badge badge-danger badge-counter" id="numOrdersFin"></span>
            </div>
        </div>
        <div class="dropdown onlySmall">
            <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Estatus
                <span class="btn btn-danger btn-sm">1</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item">Pendiente de muestra <span class="btn btn-danger btn-sm">1</span></a>
                <a class="dropdown-item">En proceso <span class="btn btn-danger btn-sm">0</span></a>
                <a class="dropdown-item">Pendiente de pago <span class="btn btn-danger btn-sm">0</span></a>
                <a class="dropdown-item">Finalizado <span class="btn btn-danger btn-sm">0</span></a>
            </div>
        </div>
    </form>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
<!--        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
-->            <!-- Dropdown - Messages -->
<!--
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <span class="badge badge-danger badge-counter" id=""></span>
        </a>
-->
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo strtoupper($_SESSION['nombre']); ?>
                </span>
                <span class="img-profile rounded-circle bg-dark">
                    <i class="fas fa-lg fa-user" style="margin: 6px;"></i>
                </span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="logout.php">
                    <i class="fas fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesión
                </a>
            </div>
        </li>
    </ul>
</nav>
