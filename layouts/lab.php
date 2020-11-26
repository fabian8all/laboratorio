<?php
require_once ('includes/loginProtect.php');
require_once ('includes/permisos.php');

$permisos = new Permisos((isset($TPL->Permisos)?$TPL->Permisos:0));
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Laboratorio - COSITEC">
        <meta name="author" content="COSITEC">

        <title><?php if(isset($TPL->PageTitle)) { echo $TPL->PageTitle; } ?></title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">

        <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="fonts/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


        <!-- Page CSSs -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link href="plugins/CustomAlerts/css/jquery-confirm.css" rel="stylesheet">

        <link href="css/miEstilo.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">


        <?php if(isset($TPL->CSSs)) {
            foreach ( $TPL->CSSs as $CSS ){
                echo "<link href='$CSS' rel='stylesheet'>";
            }
        }?>
        <!-- /Page CSSs-->

        <!--    Page PreScripts-->
        <?php if(isset($TPL->preScripts)) {
            foreach ( $TPL->preScripts as $preScript ){
                echo "<script src='$preScript'></script>";
            }
        }?>
        <script>
            userData = {
                id          : <?=$_SESSION['id']?>,
                perfil      : <?=$_SESSION['perfil']?>,
                username    : "<?=$_SESSION['username']?>",
                nombre      : "<?=$_SESSION['nombre']?>"
            }
        </script>
        <!-- /Page PreScripts-->

        <!--    Page Styles-->
        <style>
            <?php if(isset($TPL->Style)) { echo $TPL->Style; } ?>
        </style>
        <!--/Page Styles-->
    </head>

    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <?php include("includes/lab_sidebar.php"); ?>
            <!-- /Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include("includes/lab_topbar.php"); ?>
                    <!-- /Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <?php
                            if($permisos->ver()) {
                                if (isset($TPL->Vista)) {
                                    include "vistas/" . $TPL->Vista;
                                }
                            }else{
                        ?>
                                <div class="alert alert-danger" role="alert">
                                    Lo sentimos, no cuenta con los permisos necesarios para ingresar a este módulo.
                                </div>
                        <?php
                            }
                        ?>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include("includes/footer.php"); ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!--    Page Modals-->
        <?php
            if($permisos->ver()) {
                if (isset($TPL->Modales)) {
                    include "modales/" . $TPL->Modales;
                }
            }
        ?>
        <!--    /Page Modals-->

        <!-- Bootstrap core JavaScript-->
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="plugins/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
        <script src="plugins/CustomAlerts/js/jquery-confirm.js"></script>
        <script src="js/customAlerts.js"></script>

        <!-- Page Scripts-->
        <?php
            if($permisos->ver()) {
                if (isset($TPL->Scripts)) {
                    foreach ($TPL->Scripts as $script) {
                        if (is_array($script)) {
                            echo "<script type='" . $script["type"] . "' src='" . $script["js"] . "'></script>";
                        } else {
                            echo "<script src='$script'></script>";
                        }
                    }
                }
            }
        ?>
        <!-- /Page Scripts-->

    </body>
</html>
