<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "PERFILES | LABORATORIO";
    $TPL->CSSs = array("plugins/bootstrap-table/bootstrap-table.min.css");
    $TPL->Scripts =   array(
        array("type"=>"module","js"=>"plugins/bootstrap-table/bootstrap-table.js"),
//        "plugins/bootstrap-table/bootstrap-table-es-MX.js",
        "js/perfiles.js"
    );
    $TPL->Vista = "perfiles.php";
    $TPL->Modales = "perfiles.php";
    $TPL->Permisos = 7;


    include "layouts/lab.php";
    exit;
}
?>


