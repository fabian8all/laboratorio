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

        public function get($id){
            $sql = "
                SELECT 
                    S.id as id,
                    S.estado as estado,
                    S.costo as costo,
                    S.descuento as descuento,
                    S.solicitud as fechaSolicitud,
                    S.muestra as fechaMuestra,
                    S.pagado as pagado,
                    S.entrega as fechaEntrega,
                    S.resultados as resultados,
                    U.nombre as analista
                FROM solicitudes S 
                    INNER JOIN usuarios U 
                        ON S.analista = U.id 
                WHERE S.id = $id;
            ";
            $resultados = self::query_single_object($sql);
            $sqlEstudios = "
                SELECT
                    EP.id as id,
                    E.nombre as estudio,
                    EP.costo as costo
                FROM estudios_paciente EP
                    INNER JOIN estudios E
                        ON EP.id_estudio = E.id
                WHERE EP.id_solicitud = $id;   
            ";

            $estudios = self::query_object($sqlEstudios);
            $resultados->estudios = $estudios;
            if ($resultados){
                return $resultados;
            }else{
                return false;
            }

        }

        public function BSTableData($data){
            $search = (array_key_exists('search',$data))? $data['search']:"";
            $limit = (array_key_exists('limit',$data))?$data['limit']:0;
            $offset = (array_key_exists('offset',$data))?$data['offset']:0;
            $sort = (array_key_exists('sort',$data))?$data['sort']:"id";
            $order = (array_key_exists('order',$data))?$data['order']:"asc";
            $status = $data['status'];

            $andWhere = ($search != "")? "AND (P.nombre LIKE ('%$search%') OR U.nombre LIKE ('%$search%') )":"";

            if ($data['mode']=="0"){
                $idUser = $_SESSION['id'];
                $andWhere.="AND referente = $idUser";
            }

            $sql = "SELECT 
                            S.id as id,
                            S.solicitud as fecha,
                            P.nombre as paciente,
                            U.nombre as levanto, 
                            S.resultados as resultados
                    FROM solicitudes S 
                        INNER JOIN pacientes P
                            ON S.id_paciente = P.id
                        INNER JOIN usuarios U
                            ON S.analista = U.id
                    WHERE S.estado = $status
                        $andWhere
                        ORDER BY $sort $order
                        LIMIT $limit
                        OFFSET $offset
                        ;";

            $rows = self::query_object($sql);

            $sqlCount= "SELECT count(*) as total
                        FROM solicitudes S
                        WHERE S.estado = $status
                        $andWhere
                        ;";

            $count = self::query_single_object($sqlCount);


            $estudios = array(
                'rows'  => $rows,
                'count' => $count->total
            );

                return $estudios;
        }

        function tomarMuestra($id){
            $param = array(':sid'=>$id);
            $fecha = date('Y-m-d H:i:s');
            $sql ="
                UPDATE 
                    solicitudes
                SET 
                    estado = 1,
                    muestra = '$fecha'
                WHERE
                    id = :sid
            ";
            $query = self::query($sql,$param);
            if($query){
                return array('success'=>true,'msg'=>'La toma de muestra ha sido registrada');
            }else{
                return array('success'=>false,'msg'=>'Ha ocurrido un error al intentar registrar la toma dela muestra');
            }
        }

        function uploadFile($data){
            $id =$data['id'];

            $param = array(':sid'=>$id);

            $sqlSelect = "
                SELECT pagado FROM solicitudes WHERE id= :sid;
            ";

            $solicitud = self::query_single_object($sqlSelect,$param);

            $pagado = json_decode($solicitud->pagado);

            $status = ($pagado->completo)?3:2;

            $params = array(
                ':sid'  => $data['id'],
                ':ent'  => date('Y-m-d H:i:s'),
                ':fil'  => $data['file'],
                ':sta'  => $status
            );

            $sql = "
                UPDATE solicitudes 
                    SET entrega = :ent,
                        resultados = :fil,
                        estado = :sta
                    WHERE id = :sid;
            ";
            $query = self::query($sql,$params);
            if ($query){
                $res = true;
            }else{
                $res = false;
            }

            return $res;

        }

        function Pagar($data)
        {
            $id =$data['id'];

            $param = array(':sid'=>$id);

            $sqlSelect = "
                SELECT * FROM solicitudes WHERE id= :sid;
            ";

            $solicitud = self::query_single_object($sqlSelect,$param);

            $pagado = json_decode($solicitud->pagado);

            $pago = floatval($data['pago']);
            $totalAnticipo = 0;
            if($pagado->pagos) {
                foreach ($pagado->pagos as $anticipo) {
                    $cantidad = $anticipo->cantidad;
                    $totalAnticipo += floatval($cantidad);
                }
            }
            $completo = (($pago + $totalAnticipo + 0.01)>=floatval($solicitud->costo))?true:false;
            $status = ($completo)?3:2;

            if (!$pagado->pagos){
                $pagado->pagos = array();
            }
            array_push($pagado->pagos,array(
                    'cantidad'=>$pago,
                    'fecha'=>date('Y-m-d H:i:s'),
                    'tipo'=>$data['formaPago'],
                    'referencia'=>$data['referencia']
                )
            );

            $pagado->completo = $completo;
            $pagadoNew = json_encode($pagado);

            $params =array(
              ":sid" => $id,
              ":pay" => $pagadoNew,
              ":sta" => $status
            );
            $sql = "
                UPDATE 
                    solicitudes
                SET
                    estado = :sta,
                    pagado = :pay
                WHERE id = :sid;
            ";
            $query = self::query($sql,$params);
            if ($query) {
                return array('success' => true, 'msg' => 'El pago ha sido registrado');
            }else{
                return array('success' => false, 'msg' => 'Ocurrió un error al intentar guardar el pago');
            }

        }
    }


?>
