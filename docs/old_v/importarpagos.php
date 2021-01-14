<?php
require_once('clases/DBConnection.class.php');
class pagos extends DBConnection{
    public function __construct()
    {
        $sqlClean ="TRUNCATE TABLE pagos;";
        $truncate = self::query($sqlClean);
        $sql = "SELECT id,pagado FROM solicitudes;";
        $pagos_solicitudes =  self::query_object($sql);
        $array_estados = array();
        foreach ($pagos_solicitudes as $object){
            $pagos_solicitud = json_decode($object->pagado);
            $id_solicitud = $object->id;
            array_push($array_estados,array('id'=>$id_solicitud,'estado'=>$pagos_solicitud->completo));
            if(is_array($pagos_solicitud->pagos)){
                foreach($pagos_solicitud->pagos as $pagos){
                    if (!empty($pagos)){
                        if (key_exists("cantidad",$pagos)){
                            $cnt = $pagos->cantidad;
                            $typ = (key_exists("tipo",$pagos)&&$pagos->tipo !== "")?$pagos->tipo:"Efectivo";
                            $rfr = (key_exists("referencia",$pagos))?$pagos->referencia:"";
                            $crt = (key_exists("fecha",$pagos))?$pagos->fecha:date("Y-m-d H:i:s");
                            $paramsPagos = array(
                                ":cnt"=>$cnt,
                                ":typ"=>$typ,
                                ":rfr"=>$rfr,
                                ":mod"=>"solicitudes",
                                ":idr"=>$id_solicitud,
                                ":crt"=>$crt
                            );
                            $sqlPagos = "INSERT INTO pagos 
                                        (cantidad,tipo,referencia,modulo,id_ref,creado) 
                                    VALUES (:cnt,:typ,:rfr,:mod,:idr,:crt)";
                            $qryPagos = self::query($sqlPagos,$paramsPagos);
                        }
                    }
                }
            }
        }

        foreach ($array_estados as $estado){
            $paramsEstado = array(
                ":sta" => $estado['estado'],
                ":sid" => $estado['id']
            );
            $sqlEstado = "
                UPDATE solicitudes
                SET statusPago = :sta
                WHERE id = :sid             
            ";
            $queryEstado = self::query($sqlEstado,$paramsEstado);
        }

    }
}
$pagos = new pagos();
?>
