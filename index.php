<?php

require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Iniciar sesión";
    $TPL->Scripts =   array("js/index.js");
    $TPL->Vista = "vistas/index.php";


    include "layouts/login.php";
    exit;
}
?>

