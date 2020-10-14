<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Pacientes";
    $TPL->CSSs = array("plugins/bootstrap-table/bootstrap-table.min.css");
    $TPL->Scripts =   array(
        array("type"=>"module","js"=>"plugins/bootstrap-table/bootstrap-table.js"),
//        "plugins/bootstrap-table/bootstrap-table-es-MX.js",
        "js/pacientes.js"
    );
    $TPL->Vista = "pacientes.php";
    $TPL->Modales = "pacientes.php";


    include "layouts/lab.php";
    exit;
}
?>


