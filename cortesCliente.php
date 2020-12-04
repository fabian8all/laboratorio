<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Cortes";
    $TPL->Scripts =   array(
        "js/cortesCliente.js"
    );
    $TPL->Vista = "cortesCliente.php";
    $TPL->Modales = "cortesCliente.php";
    $TPL->Permisos = 8;



    include "layouts/lab.php";
    exit;
}
?>


