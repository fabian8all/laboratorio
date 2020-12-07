<?php

	session_start();

	require_once ('../clases/Cortes.class.php');
	require_once ('../includes/permisos.php');


	$Corte = new Corte();
	$permisos = new Permisos(8);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";


$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getLast':
			echo json_encode($Corte->getLast($info));
			break;
		case 'getSolicitudes':
			echo json_encode($Corte->getSolicitudes($info));
			break;
		case 'create':
			echo json_encode($Corte->create($info));
			break;
	}

?>
