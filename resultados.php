<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Resultados";
    $TPL->CSSs = array("plugins/bootstrap-table/bootstrap-table.min.css");
    $TPL->Scripts =   array(
        array("type"=>"module","js"=>"plugins/bootstrap-table/bootstrap-table.js"),
        "js/resultados.js"
    );
    $TPL->Vista = "resultados.php";
    $TPL->Modales = "resultados.php";
    $TPL->Permisos = 2;


    include "layouts/lab.php";
    exit;
}
?>


