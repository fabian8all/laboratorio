<?php

	session_start();

	require('../clases/Pacientes.class.php');

	$Paciente = new Paciente();

	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getAll':
			echo json_encode($Paciente->getAll());
			break;
		case 'BSTableData':
			echo json_encode($Paciente->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Paciente->get($info));
			break;
		case 'Add':
			echo json_encode($Paciente->Add($info));
			break;
		case 'Update':
			echo json_encode($Paciente->Update($info));
			break;
		case 'Delete':
			echo json_encode($Paciente->Delete($info));
			break;
	}

?>
