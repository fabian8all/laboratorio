<?php
	$user = "Usuario";
	

	if(!isset($_SESSION['id']) || !isset($_SESSION['perfil']) || !isset($_SESSION['nombre'])){
		header('Location: index.php');}
	else
		$user = $_SESSION['nombre'];

?>
