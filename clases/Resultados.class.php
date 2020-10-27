<?php

	require_once('DBConnection.class.php');

	Class Resultados extends DBConnection {

        public function getAll(){

            $sql = "SELECT 
                            EP.id as id,
                            EP.solicitud as fecha,
                            EP.estado as estado,
                            P.nombre as paciente 
                    FROM estudios_paciente EP 
                        INNER JOIN pacientes P
                            ON EP.id_paciente = P.id
                    WHERE paquete = 0;";

            $resultados = self::query_object($sql);

            if ($resultados){
                return $resultados;
            }else{
                return false;
            }

        }

        public function get($idPaquete){
            $sql = "SELECT 
                            EP.id as id,
                            EP.estado as estado,
                            EP.resultados as resultados,
                            Ep.observaciones as observaciones,
                            Ep.analista as analista,
                            E.nombre as estudio,
                            E.pruebas as pruebas
                    FROM estudios_paciente EP 
                        INNER JOIN estudios E
                            ON EP.id_estudio = E.id
                    WHERE EP.id = $idPaquete OR EP.paquete = $idPaquete;";

            $resultados = self::query_object($sql);

            if ($resultados){
                return $resultados;
            }else{
                return false;
            }

        }

        public function Save($data){
            $params = array(
                ":eid"  => $data['idEstudio'],
                ":res"  => $data['resultados'],
                ":obs"  => $data['observaciones'],
                ":ana"  => $data['analista']
            );
            $sql = "UPDATE estudios_paciente 
                        SET resultados = :res, 
                            observaciones = :obs,
                            analista = :ana,
                            estado = 2
                        WHERE id = :eid;";
            $query = self::query($sql,$params);

            $selpaq = "SELECT paquete FROM estudios_paciente WHERE id = ".$data['idEstudio'].";";

            $querypaq = self::query_single_object($selpaq);

            $idPaq = ($querypaq->paquete == 0)?$data['idEstudio']:$querypaq->paquete;

            $selStat = "SELECT estado FROM estudios_paciente WHERE paquete = $idPaq OR id = $idPaq";

            $queryStat = self::query_object($selStat);

            $completo = true;
            foreach ($queryStat as $estados){
                if ($estados->estado == 1){
                    $completo = false;
                    break;
                }
            }
            if ($completo){
                $sql = "UPDATE estudios_paciente 
                            SET estado = 3
                            WHERE id = $idPaq;";
                $query = self::query($sql);
                if ($query){
                    return array("success"=>true,"full"=>true);
                }
            }else{
                return array("success"=>true,"full"=>false);
            }
        }

    }


?>
