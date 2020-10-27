<?php

	session_start();

	require('../clases/Resultados.class.php');

	$Resultados = new Resultados();

	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'getAll':
			echo json_encode($Resultados->getAll());
			break;
		case 'get':
			echo json_encode($Resultados->get($info));
			break;
		case 'Save':
			echo json_encode($Resultados->Save($info));
			break;
	}

?>
