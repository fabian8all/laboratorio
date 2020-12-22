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
            $html = '
                    <table>
                        <thead>
                            <tr>
                                <th rowspan="6">
                                    <img src="laboratorio\resources\logopdf.jpg" style="width:200px;" alt="">
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;" colspan="2" rowspan="" headers="" scope="">LABORATORIO DE ANÁLISIS CLÍNICOS Y BACTERIOLÓGICOS</th>
                            </tr>
                            <tr>
                                <td style="text-align: center;" colspan="2" rowspan="" headers="">MATRIZ: BLVD. Camino Real No. 318 Int 5, Col, Las Viboras, Colima,Col.</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" colspan="2" rowspan="" headers="">Teléfono: (312) 16 06 333, 3121093341, 3121223644</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" colspan="2" rowspan="" headers="">Horario: Lunes a Viernes 7:00am-9:00pm y Sábado 7:00am-2:00pm</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" colspan="2" rowspan="" headers="">laboratoriodml@hotmail.com &nbsp;&nbsp;&nbsp;&nbsp;servicio de urgencia las 24hrs.</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="" rowspan="" headers=""></td>
                                <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Cliente: </b> '.$info['cliente'].'</td>
                            </tr>
                            <tr>
                                <td colspan="" rowspan="" headers=""></td>
                                <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Fecha de corte: </b> '.$info['fechaCorte'].'</td>
                            </tr>
                            <tr>
                                <td colspan="" rowspan="" headers=""></td>
                                <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Total a pagar: </b> $'.$info['info']['total'].'</td>
                            </tr>
                            <tr>
                                <td colspan="" rowspan="" headers=""></td>
                                <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Estado: </b> '.$info['estado'].'</td>
                            </tr>
                            <tr>
                                <table width="100%" border="0">
                                <tr align="left">
                                    <th>
                                        Paciente
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Costo
                                    </th>
                                </tr>
                ';
            foreach($info['info']['solicitudes'] as $solicitud){
                $html .= "
                                    <tr style='background: #AAAAAA; font-weight:bolder; ' >
                                        <td>".$solicitud['paciente']."</td>
                                        <td>".$solicitud['fecha']."</td>
                                        <td>".$solicitud['total']."</td>
                                    </tr>
                ";
                foreach ($solicitud['estudios'] as $estudio) {
                    $html .= "
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>".$estudio['nombre']."</td>
                                        <td>".$estudio['costo']."</td>
                                    </tr>
                ";

                }
            }
            $html .= "
                                </table> 
                            </tr>
                        </tbody>
                    </table>
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
                SELECT 
                    U.nombre as nombre,
                    C.fechaFin as fechaFin,
                    C.solicitudes as solicitudes,
                    (CASE 
                        WHEN C.pagado = 0 THEN 'PENDIENTE'
                        WHEN C.pagado = 1 THEN 'PAGADO'
                        ELSE 'NO GENERADO'
                    ) as estado 
                FROM cortes C 
                    INNER JOIN usuarios U
                        ON C.idCliente = U.id
                WHERE id=:cid;
            ";

            $data = self::query_single_object($sql,$param);
            $dataCorte = array(
                'cliente'=>$data['nombre'],
                'fechaCorte'=>$data['fechaFin'],
                'estado'=>$data['estado']
            );

            $solicitudes = json_decode($data->solicitudes);

            $info = $this->getInfo($solicitudes);
            $dataCorte['info'] = $info;
            return $dataCorte;

        }

        private function getInfoByClientDate($data){
            $param = array(
              ':cid'=>$data['idCliente']
            );
            $sqlClient = "
                SELECT nombre FROM usuarios WHERE id = :cid; 
            ";
            $cliente = self::query_single_object($sqlClient,$param);

            $dataCorte = array(
                'cliente'=>$cliente->nombre,
                'fechaCorte'=>$data['fechaFin'],
                'estado'=>'NO GENERADO'
            );

            $solicitudes = $this->getSolicitudes($data);


            $array = array();
            foreach ($solicitudes as $solicitud) {
                array_push($array,$solicitud->idSolicitud);
            }
            $info = $this->getInfo($array);
            $dataCorte['info'] = $info;
            return $dataCorte;
        }

        private function getInfo($solicitudes){
            $array = array();
            $total = 0.00;
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
                    $total += floatval($results[0]->total);

                    $estudios = array();
                    foreach ($results as $estudio ){
                        array_push($estudios,array(
                            "nombre"    => $estudio->estudio,
                            "costo"     => $estudio->costoEstudio
                        ));
                    }
                    $solicitud['estudios'] = $estudios;
                    array_push($array,$solicitud);
                }

            }
            $response = array(
                'solicitudes'=>$array,
                'total'=>$total
            );
            return $response;
        }
    }


?>
