<?php

	session_start();

	require_once ('../clases/Clientes.class.php');
	require_once ('../includes/permisos.php');


	$Cliente = new Cliente();
	$permisos = new Permisos(5);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";


$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getAll':
			$info['mode']=$permisos->verClientes();
			echo json_encode($Cliente->getAll($info));
			break;
		case 'BSTableData':
			echo json_encode($Cliente->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Cliente->get($info));
			break;
		case 'Add':
			if ($permisos->crear()) {
				echo json_encode($Cliente->Add($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Update':
			if ($permisos->actualizar()) {
				echo json_encode($Cliente->Update($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Delete':
			if ($permisos->borrar()){
				echo json_encode($Cliente->Delete($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
	}

?>
