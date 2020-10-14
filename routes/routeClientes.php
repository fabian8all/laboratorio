<?php

	session_start();

	require('../clases/Clientes.class.php');

	$Cliente = new Cliente();

	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getAll':
			echo json_encode($Cliente->getAll());
			break;
		case 'BSTableData':
			echo json_encode($Cliente->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Cliente->get($info));
			break;
		case 'Add':
			echo json_encode($Cliente->Add($info));
			break;
		case 'Update':
			echo json_encode($Cliente->Update($info));
			break;
		case 'Delete':
			echo json_encode($Cliente->Delete($info));
			break;
	}

?>
