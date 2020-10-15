<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Iniciar sesión";
    $TPL->Scripts =   array(
        "js/inicio.js",
    );
    $TPL->Vista = "inicio.php";
    $TPL->Modales = "inicio.php";


    include "layouts/lab.php";
    exit;
}
?>


