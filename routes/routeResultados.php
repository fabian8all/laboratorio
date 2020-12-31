<?php

	session_start();

	require_once ('../clases/Resultados.class.php');
	require_once ('../includes/permisos.php');


	$Resultados = new Resultados();
	$permisos = new Permisos(2);
	$sin_permisos = "Lo sentimos, usted no cuenta con los permisos necesarios para llevar a cabo esta operación";


	$action = $_POST['action'];

	if(isset($_POST['info']))
		$info = $_POST['info'];

	switch ($action) {
		case 'get':
			echo json_encode($Resultados->get($info));
			break;
		case 'Save':
			echo json_encode($Resultados->Save($info));
			break;
		case 'BSTableData':
			$info['mode']=$permisos->verPacientes();
			echo json_encode($Resultados->BSTableData($info));
			break;
		case 'tomarMuestra':
			if ($permisos->bin[6]=='1') {
				echo json_encode($Resultados->tomarMuestra($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'uploadFile':
			if ($permisos->bin[5]=='1') {
				echo json_encode($Resultados->uploadFile($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Pagar':
			if ($permisos->bin[3]=='1') {
				echo json_encode($Resultados->Pagar($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;
		case 'Cancelar':
			if ($permisos->bin[2]=='1') {
				echo json_encode($Resultados->Cancelar($info));
			}else{
				echo json_encode(
					array('success'=>false, 'msg' => $sin_permisos)
				);
			}
			break;

	}

?>
