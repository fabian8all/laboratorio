<div class="top_nav">
	<div class="nav_menu">
	  <nav class="" role="navigation">
	    <div class="nav toggle">
	      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
	    </div>
	    <div class="navbar navbar-dark float-right">
	      <div class="dropdown">
	        <button class="user-profile btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	            <?php echo strtoupper($_SESSION['nombre']); ?>
	        </button>
	        <div class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
	          <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>
	        </div>
	      </div>
	    </div>
	  </nav>
	</div>
</div>
