<?php

	session_start();

	require_once ('../clases/Estudios.class.php');
	require_once ('../includes/permisos.php');

	$Estudio = new Estudio();
	$permisos = new Permisos(4);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";

	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];
	switch ($action) {
		case 'getAll':
			echo json_encode($Estudio->getAll($info));
			break;
		case 'BSTableData':
			echo json_encode($Estudio->BSTableData($info));
			break;
		case 'get':
			echo json_encode($Estudio->get($info));
			break;
		case 'Add':
			if ($permisos->crear()) {
				echo json_encode($Estudio->Add($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Update':
			if ($permisos->actualizar()) {
				echo json_encode($Estudio->Update($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Delete':
			if ($permisos->borrar()){
				echo json_encode($Estudio->Delete($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Solicitar':
			$permisosC = new permisos(1);

			if ($permisosC->bin[6]){
				echo json_encode($Estudio->Solicitar($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'getListaPrecios':
			echo ($Estudio->getListaPrecios());
			break;
		case 'importListaPrecios':
			echo json_encode($Estudio->importListaPrecios($_FILES));
			break;
	}

?>
