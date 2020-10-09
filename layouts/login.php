<?php
include('includes/header_index.php');
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
    <link href="css/login.css" rel="stylesheet">
    <?php if(isset($TPL->CSSs)) { include $TPL->CSSs; } ?>


    <?php if(isset($TPL->preScripts)) {
        foreach ( $TPL->preScripts as $preScript ){
            echo "<script src='$preScript'></script>";
        }
    }?>

    <style>
        <?php if(isset($TPL->Style)) { echo $TPL->Style; } ?>
    </style>


</head>
<body>

    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        <!-- Para guardar temporarlmente el resultado del geocode -->
        <p id="geocode" hidden></p>

        <div id="wrapper">
            <?php if(isset($TPL->Vista)) { include $TPL->Vista; } ?>
        </div>
    </div>

    <?php if(isset($TPL->Modales)) { include "modales/".$TPL->Modales; } ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="plugins/CustomAlerts/js/jquery-confirm.js"></script>
    <script src="js/custom.js"></script>

    <script src="js/main.js"></script>


    <?php if(isset($TPL->Scripts)) {
        foreach ( $TPL->Scripts as $script ){
            echo "<script src='$script'></script>";
        }
    }?>

</body>

</html>
