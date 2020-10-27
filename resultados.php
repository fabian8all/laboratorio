<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Resultados";
    $TPL->CSSs = array("plugins/bootstrap-table/bootstrap-table.min.css");
    $TPL->Scripts =   array("js/resultados.js");
    $TPL->Vista = "resultados.php";
//    $TPL->Modales = "resultados.php";


    include "layouts/lab.php";
    exit;
}
?>


