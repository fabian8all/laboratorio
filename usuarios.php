<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "USUARIOS | LABORATORIO";
    $TPL->CSSs = array("plugins/bootstrap-table/bootstrap-table.min.css");
    $TPL->Scripts =   array(
        array("type"=>"module","js"=>"plugins/bootstrap-table/bootstrap-table.js"),
//        "plugins/bootstrap-table/bootstrap-table-es-MX.js",
        "js/usuarios.js"
    );
    $TPL->Vista = "usuarios.php";
    $TPL->Modales = "usuarios.php";


    include "layouts/lab.php";
    exit;
}
?>


