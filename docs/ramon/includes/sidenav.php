<?php 
session_start();
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
  <!--<div class="position-fixed"> REGRESARLO CUANDO SE TERMINEN LAS PRUEBAS -->
  <div class="content-wrapper">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon" style="width: 33px; height: 33px;">
        <!--<i class="fas fa-laugh-wink"></i>-->
        <img class="cositecImage" src="img/logo.png" alt="" style="width: 100%; height: 100%;">
      </div>
      <div class="sidebar-brand-text mx-3">SODE</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Catálogos</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Catálogos:</h6>
            <a class="collapse-item <?php echo $_SESSION['rolUsuario'] == "1" ? 'show' : 'hidden';?>" href="usuarios.php"><i class="fas fa-user-cog"></i> Usuarios</a>
            <a class="collapse-item <?php echo $_SESSION['rolUsuario'] != "3" ? 'show' : 'hidden';?>" href="colaboradores.php"><i class="fas fa-user-astronaut"></i> Colaboradores</a>

            <a class="collapse-item" href="perfil.php"><i class="fas fa-user"></i> Mi Perfil</a>
            <a class="collapse-item" href="clientes.php"><i class="fas fa-user-plus"></i> Clientes</a>
            <a class="collapse-item" href="equipos.php"><i class="fas fa-laptop"></i> Equipos</a>
            <a class="collapse-item" href="marcas.php"><i class="fas fa-list-alt"></i> Marcas</a>
            <a class="collapse-item" href="modelos.php"><i class="fas fa-list"></i> Modelos</a>
            <a class="collapse-item" href="servicios.php"><i class="fas fa-tools"></i> Servicios</a>
            <a class="collapse-item" href="productos.php"><i class="fas fa-tools"></i> Productos</a>
          </div>
        </div>
      </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item ">
      <a class="nav-link" href="ordenes.php">
        <i class="fas fa-clipboard-list"></i>
        <span>Ordenes</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="text-center">
      <div class="col-lg-12">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline" style="padding: .75rem 1rem; width: 6.5rem;">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </div>
    </div>
  </div>
</ul>