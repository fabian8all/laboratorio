<?php

	session_start();

	require_once ('../clases/Pacientes.class.php');
	require_once ('../includes/permisos.php');


$Paciente = new Paciente();
	$permisos = new Permisos(3);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";


$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getAll':
			if ($permisos->verPacientes()) {
				echo json_encode($Paciente->getAll());
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'getMy':
			echo json_encode($Paciente->getMy($info));
			break;
		case 'BSTableData':
			$info['mode']=$permisos->verPacientes();
			echo json_encode($Paciente->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Paciente->get($info));
			break;
		case 'Add':
			if ($permisos->crear()) {
				echo json_encode($Paciente->Add($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Update':
			if ($permisos->actualizar()) {
				echo json_encode($Paciente->Update($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Delete':
			if ($permisos->borrar()){
				echo json_encode($Paciente->Delete($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
	}

?>
