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
		case 'get':
			echo json_encode($Corte->get($info));
			break;
		case 'getLast':
			echo json_encode($Corte->getLast($info));
			break;
		case 'getPagos':
			echo json_encode($Corte->getPagos($info));
			break;
		case 'getSolicitudes':
			echo json_encode($Corte->getSolicitudes($info));
			break;
		case 'create':
			echo json_encode($Corte->create($info));
			break;
		case 'getPDF':
			echo json_encode($Corte->getPDF($info));
			break;
		case 'getHistory':
			echo json_encode($Corte->getHistory($info));
			break;
		case 'getInfoById':
			echo json_encode($Corte->getInfoById($info));
			break;
		case 'Pagar':
			echo json_encode($Corte->Pagar($info));
			break;
	}

?>
