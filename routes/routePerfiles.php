<?php

	session_start();

	require_once ('../clases/Perfiles.class.php');
	require_once ('../includes/permisos.php');


$Perfil = new Perfil();
	$permisos = new Permisos(4);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";

	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'BSTableData':
			echo json_encode($Perfil->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Perfil->get($info));
			break;
		case 'getAll':
			echo json_encode($Perfil->getAll());
			break;
		case 'Add':
			if ($permisos->crear()) {
				echo json_encode($Perfil->Add($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Update':
			if ($permisos->actualizar()) {
				echo json_encode($Perfil->Update($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Delete':
			if ($permisos->borrar()){
				echo json_encode($Perfil->Delete($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
	}

?>
