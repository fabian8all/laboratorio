<?php

	session_start();

	require_once ('../clases/Usuarios.class.php');
	require_once ('../includes/permisos.php');


	$Usuario = new Usuario();
	$permisos = new Permisos(6);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";

	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'auth':
			echo json_encode($Usuario->login($info));
			break;
		case 'BSTableData':
			echo json_encode($Usuario->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Usuario->get($info));
			break;
		case 'Add':
			if ($permisos->crear()) {
				echo json_encode($Usuario->Add($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Update':
			if ($permisos->actualizar()) {
				echo json_encode($Usuario->Update($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Delete':
			if ($permisos->borrar()){
				echo json_encode($Usuario->Delete($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
	}

?>
