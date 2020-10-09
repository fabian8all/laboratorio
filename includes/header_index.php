<?php
	 session_start();

	require('clases/DBConnection.class.php');

	$main = new DBConnection();

	$hoy = $main->getDate();

	if((isset($_SESSION['id']) || isset($_SESSION['perfil']) || isset($_SESSION['nombre']))
        && ($_SESSION['perfil'] == 1 || $_SESSION['perfil'] == 2))
		header('Location: inicio.php');

	// echo $_SESSION['iduser'].' -- '.$_SESSION['roluser'].' -- '.$_SESSION['name'];
	// echo "HOLA";
	// exit;

?>
