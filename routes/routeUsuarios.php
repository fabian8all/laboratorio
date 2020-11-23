<?php

	session_start();

	require('../clases/Usuarios.class.php');

	$Usuario = new Usuario();

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
			echo json_encode($Usuario->Add($info));
			break;
		case 'Update':
			echo json_encode($Usuario->Update($info));
			break;
		case 'Delete':
			echo json_encode($Usuario->Delete($info));
			break;
	}

?>
