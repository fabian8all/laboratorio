<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Corte Pagos";

    $TPL->Scripts =   array(
        "js/cortePagos.js"
    );
    $TPL->Vista = "cortePagos.php";
    $TPL->Modales = "cortePagos.php";
    $TPL->Permisos = 8;



    include "layouts/lab.php";
    exit;
}
?>


