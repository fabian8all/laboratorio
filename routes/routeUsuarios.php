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
        case 'registrar':
            echo json_encode($Usuario->registrar($info));
            break;
		case 'read':
			echo json_encode($Usuario->read($info));
			break;
		case 'activarUser':
			echo json_encode($Usuario->activa($info));
			break;
		case 'desactivarUser':
			echo json_encode($Usuario->desactiva($info));
			break;
		case 'getFull':
			echo json_encode($Usuario->getFull($info));
			break;
		case 'requestFull':
			echo json_encode($Usuario->requestFull($info));
			break;
	}

?>
