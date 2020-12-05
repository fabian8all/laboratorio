<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Cortes";
    $TPL->CSSs = array(
        "css/bootstrap-select.min.css"
    );
    $TPL->Scripts =   array(
        "js/cortesCliente.js",
        "js/bootstrap-select.min.js",
        "js/defaults-es_ES.min.js",
        "js/detalles.js"
    );
    $TPL->Vista = "cortesCliente.php";
    $TPL->Modales = "cortesCliente.php";
    $TPL->Permisos = 8;



    include "layouts/lab.php";
    exit;
}
?>


