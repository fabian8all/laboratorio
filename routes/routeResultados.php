<?php

	session_start();

	require_once ('../clases/Resultados.class.php');
	require_once ('../includes/permisos.php');


	$Resultados = new Resultados();
	$permisos = new Permisos(2);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";


	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getAll':
			echo json_encode($Resultados->getAll());
			break;
		case 'get':
			echo json_encode($Resultados->get($info));
			break;
		case 'Save':
			echo json_encode($Resultados->Save($info));
			break;
		case 'BSTableData':
			echo json_encode($Resultados->BSTableData($info));
			break;
		case 'uploadFile':
			echo json_encode($Resultados->uploadFile($info));
			break;

	}

?>
