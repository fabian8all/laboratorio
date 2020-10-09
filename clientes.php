<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Clientes";
    $TPL->Scripts =   array("js/clientes.js");
    $TPL->Vista = "clientes.php";
    $TPL->Modales = "clientes.php";


    include "layouts/lab.php";
    exit;
}
?>


