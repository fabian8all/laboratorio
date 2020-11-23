<?php

	session_start();

	require('../clases/Perfiles.class.php');

	$Perfil = new Perfil();

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
		case 'Add':
			echo json_encode($Perfil->Add($info));
			break;
		case 'Update':
			echo json_encode($Perfil->Update($info));
			break;
		case 'Delete':
			echo json_encode($Perfil->Delete($info));
			break;
	}

?>
