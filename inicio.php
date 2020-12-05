<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Iniciar sesión";
    $TPL->CSSs = array(
        "css/bootstrap-select.min.css"
    );
    $TPL->Scripts =   array(
        "js/inicio.js",
        "js/bootstrap-select.min.js",
        "js/defaults-es_ES.min.js"
    );
    $TPL->Vista = "inicio.php";
    $TPL->Modales = "inicio.php";
    $TPL->Permisos = 1;

    include "layouts/lab.php";
    exit;
}
?>


