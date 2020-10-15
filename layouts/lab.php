<?php
include_once('includes/loginProtect.php');
require_once('includes/PageTemplate.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php if(isset($TPL->PageTitle)) { echo $TPL->PageTitle; } ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="plugins/CustomAlerts/css/jquery-confirm.css" rel="stylesheet">

    <!-- Page CSSs -->
    <link href="css/style.css" rel="stylesheet">
    <?php if(isset($TPL->CSSs)) {
        foreach ( $TPL->CSSs as $CSS ){
            echo "<link href='$CSS' rel='stylesheet'>";
        }
    }?>


    <script src="js/jquery.min.js"></script>
    <!-- <script src="plugins/toast/jquery.dreamalert.js"></script> -->
    <script src="plugins/CustomAlerts/js/jquery-confirm.js"></script>
    <script src="js/main.js"></script>

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
    <style>
        <?php if(isset($TPL->Style)) { echo $TPL->Style; } ?>
    </style>

</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- Navigation bar left -->
            <?php include("includes/navigation_lab.php"); ?>
            <!-- /Navigation bar left -->

            <!-- Navigation bar top -->
            <?php include("includes/navigation_top.php"); ?>
            <!-- /Navigation bar top -->

            <!-- page content -->
            <div class="right_col" role="main">

                <?php if(isset($TPL->Vista)) { include "vistas/".$TPL->Vista; } ?>


                <!-- footer content -->
                <?php include("includes/footer.html"); ?>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>
    </div>
    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <?php if(isset($TPL->Modales)) { include "modales/".$TPL->Modales; } ?>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <?php if(isset($TPL->Scripts)) {
        foreach ( $TPL->Scripts as $script ){
            if (is_array($script)){
                echo "<script type='".$script["type"]."' src='".$script["js"]."'></script>";
            }else{
                echo "<script src='$script'></script>";
            }
        }
    }?>

</body>
</html>
