<?php
session_start();
require_once ("includes/permisos.php");

$permisos = new permisos(2);
if ($permisos->bin[5]=='1') {
    $destination_path = getcwd() . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "resultsFiles" . DIRECTORY_SEPARATOR;

    $result = 0;

    $filename = $_FILES['fileResultados']['name'];
    $ext = preg_match('/\./', $filename) ? preg_replace('/^.*\./', '', $filename) : '';
    $name = date("YmdHis") . random_int("0", "1000") . "." . $ext;

    $target_path = $destination_path . basename($name);


    if (@move_uploaded_file($_FILES['fileResultados']['tmp_name'], $target_path)) {
        $result = json_encode(array('success' => true, 'data' => $name));
    } else {
        $result = json_encode(array('success' => false, 'msg' => "Error al intentar subir el archivo"));
    }
}else{
    $result = json_encode(array('success'=>false,'msg'=>"Lo sentimos, no cuenta con los permisos suficientes para realizar esta operación"));
}

sleep(1);

?>
<script language="javascript" type="text/javascript">
    window.top.window.UploadResults('<?php echo $result; ?>');
</script>
