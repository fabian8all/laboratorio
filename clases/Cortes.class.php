<?php

	require_once('DBConnection.class.php');

	Class Corte extends DBConnection {

        public function getLast($idCliente){

            $param = array(':cid'=>$idCliente);
            $sql = "SELECT * FROM cortes WHERE idCliente = :cid LIMIT 1 ORDER BY id DESC";

            $corte = self::query_object($sql,$param);

            if ($corte){
                return $corte;
            }else{
                return false;
            }

        }

        public function getSolicitudes($data){
            $params = array(
                ':cid'  => $data['idCliente'],
                ':fci'  => $data['fechaIni'],
                ':fcf'  => $data['fechaFin']
                );
            $sql = "
                SELECT 
                    S.id as idSolicitud,
                    S.solicitud as fecha,
                    P.nombre as paciente,
                    S.costo as costo,
                    S.estado as estado 
                FROM solicitudes S
                    INNER JOIN pacientes P
                        ON P.id = S.id_paciente
                WHERE P.referente = :cid
                    AND S.solicitud >= :fci
                    AND S.solicitud <= :fcf 
                ;
            ";
            $solicitudes = self::query_object($sql,$params);

            if ($solicitudes){
                return $solicitudes;
            }else{
                return false;
            }

        }

    }


?>
