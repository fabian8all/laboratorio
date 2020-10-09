<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Pacientes";
    $TPL->Scripts =   array("js/pacientes.js");
    $TPL->Vista = "pacientes.php";
    $TPL->Modales = "pacientes.php";


    include "layouts/lab.php";
    exit;
}
?>


