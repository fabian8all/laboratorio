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

        public function getPDF($data){
            if($data['idCliente'] =="" || $data['fechaIni']=="" || $data['fechaFin']=="" ){
                return array("success"=>false,"msg"=>"No se han seleccionado los datos requeridos");
            }
            $info = $this->getInfoByClientDate($data);
            $html = "
                        <html>
                            <body>
                                Hola Mundo
              
                                <table border='0'>
                ";
            foreach($info as $solicitud){
                $html .= "
                                    <tr>
                                        <td>".$solicitud['paciente']."</td>
                                        <td>".$solicitud['fecha']."</td>
                                        <td>".$solicitud['total']."</td>
                                    </tr>
                ";
                foreach ($solicitud['estudios'] as $estudio) {
                    $html .= "
                                    <tr>
                                        <td colspan='2'>".$estudio['nombre']."</td>
                                        <td>".$estudio['costo']."</td>
                                    </tr>
                ";

                }
            }
            $html .= "
                                </table> 
                            </body>
                        </html>
            ";
// instantiate and use the dompdf class
            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
            $dompdf->render();

// Output the generated PDF to Browser

            @file_put_contents("../resources/corte.pdf",$dompdf->output());
            return array("success"=>true);

        }

        public function getHistory($id){
            $param = array(':cid'=>$id);
            $sql = "
                SELECT * 
                FROM cortes
                WHERE idCliente = :cid; 
            ";
            $query = self::query_object($sql,$param);
            return $query;

        }

        public function getInfoById($id){
            $param = array(':cid'=>$id);
            $sql = "
                SELECT solicitudes FROM cortes WHERE id=:cid;
            ";
            $solicitudes = self::query_single_object($sql,$param);
            $solicitudes = json_decode($solicitudes->solicitudes);
            $response = $this->getInfo($solicitudes);
            return $response;

        }

        private function getInfoByClientDate($data){
            $solicitudes = $this->getSolicitudes($data);

            $array = array();
            foreach ($solicitudes as $solicitud) {
                array_push($array,$solicitud->idSolicitud);
            }
            $response = $this->getInfo($array);
            return $response;
        }

        private function getInfo($solicitudes){
            $response = array();
            foreach ($solicitudes as $id){
                $sql = "
                    SELECT 
                        S.id as id,
                        P.nombre as paciente,
                        DATE_FORMAT(S.solicitud, '%Y-%m-%d') as fecha,
                        S.costo as total,
                        E.nombre as estudio,
                        EP.costo as costoEstudio                    
                    FROM solicitudes S
                        INNER JOIN pacientes P
                            ON P.id = S.id_paciente
                        INNER JOIN estudios_paciente EP 
                            ON EP.id_solicitud = S.id 
                        INNER JOIN estudios E
                            ON E.id = EP.id_estudio
                    WHERE S.id = $id
                ";
                $results = self::query_object($sql);
                if($results){
                    $solicitud = array(
                        "id"        => $results[0]->id,
                        "paciente"  => $results[0]->paciente,
                        "fecha"     => $results[0]->fecha,
                        "total"     => $results[0]->total,
                    );

                    $estudios = array();
                    foreach ($results as $estudio ){
                        array_push($estudios,array(
                            "nombre"    => $estudio->estudio,
                            "costo"     => $estudio->costoEstudio
                        ));
                    }
                    $solicitud['estudios'] = $estudios;
                    array_push($response,$solicitud);
                }

            }
            return $response;
        }
    }


?>
