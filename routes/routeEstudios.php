<?php

	session_start();

	require('../clases/Estudios.class.php');

	$Estudio = new Estudio();

	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getAll':
			echo json_encode($Estudio->getAll());
			break;
		case 'BSTableData':
			echo json_encode($Estudio->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Estudio->get($info));
			break;
		case 'Add':
			echo json_encode($Estudio->Add($info));
			break;
		case 'Update':
			echo json_encode($Estudio->Update($info));
			break;
		case 'Delete':
			echo json_encode($Estudio->Delete($info));
			break;
	}

?>
