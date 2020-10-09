<?php
session_start();
require_once('includes/PageTemplate.php');

if (!isset($TPL)) {
    $TPL = new PageTemplate();
    $TPL->PageTitle = "Laboratorio - Estudios";
    $TPL->Scripts =   array("js/estudios.js");
    $TPL->Vista = "estudios.php";
    $TPL->Modales = "estudios.php";


    include "layouts/lab.php";
    exit;
}
?>


