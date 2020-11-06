<?php 
  session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'includes/links.html'; ?>
  <title>COTIZACION | LABORATORIO</title>
  
</head>

<body id="page-top">

          <?php 
            echo "<div id='wrapper'>";

            include 'includes/sidenav.php'; 

            echo "<div id='content-wrapper' class='d-flex flex-column'>";

            echo "<div id='content'>";

            include 'includes/navbar.php'; 

            echo "<div class='container-fluid'>";

            include 'vistas/prueba.php';
            //include 'views/clientes.php';
          ?>
          

        </div>

      </div>

      <?php include 'includes/footer.php'; ?>

    </div>

  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <?php include 'includes/scripts.html'; ?>

  <script src="resources/js/clientes.js"></script>


</body>

</html>

