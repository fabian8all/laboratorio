<?php

	require_once('DBConnection.class.php');
    require_once ("../plugins/dompdf/autoload.inc.php");

    use Dompdf\Dompdf;


	Class Corte extends DBConnection {

        public function getLast($idCliente){

            $param = array(':cid'=>$idCliente);
            $sql = "
                SELECT 
                    *,
                    DATE_FORMAT(fechaFin, '%Y-%m-%d') AS ultimoCorte
                FROM cortes 
                WHERE idCliente = :cid 
                ORDER BY id DESC 
                LIMIT 1 
            ";

            $corte = self::query_single_object($sql,$param);

            if ($corte){
                return $corte;
            }else{
                return false;
            }

        }

        public function getSolicitudes($data){
            if ($data['idCliente']==""){
                return false;
            }
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

        public function create($data){
            if ($data['idCliente']){
                $params = array(
                    ':cid'  => $data['idCliente'],
                    ':fci'  => $data['fechaIni'],
                    ':fcf'  => $data['fechaFin'],
                    ':tot'  => $data['total'],
                    ':sol'  => $data['solicitudes'],
                    ':crt'  => date('Y-m-d H:i:s')
                );

                $sql = "
                    INSERT INTO cortes
                        (idCliente,fechaIni,fechaFin,total,solicitudes,creado)
                    VALUES
                        (:cid,:fci,:fcf,:tot,:sol,:crt);
                ";
                $query = self::query($sql,$params);
                if($query){
                    $result = array(
                        'success'   => true,
                        'msg'       => 'El corte se ha realizado exitosamente'
                    );
                }else{
                    $result = array(
                        'success'   => false,
                        'msg'       => 'Ocurrió un error al intentar realizar el corte'
                    );
                }

            }else{
                $result = array(
                    'success'   =>false,
                    'msg'       =>'No se ha seleccionado cliente'
                );
            }
            return $result;
        }

        public function getPDF(){


// instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $html = "";
            
            $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
            $dompdf->render();

// Output the generated PDF to Browser
            $dompdf->stream();

            @file_put_contents("../resources/corte.pdf",$dompdf->output());
            return true;

        }

    }


?>
