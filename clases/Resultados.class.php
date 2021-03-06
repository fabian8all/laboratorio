<?php

	require_once('DBConnection.class.php');

	Class Resultados extends DBConnection {


        public function get($id){
            $sql = "
                SELECT 
                    S.id as id,
                    S.estado as estado,
                    S.costo as costo,
                    S.descuento as descuento,
                    S.solicitud as fechaSolicitud,
                    S.muestra as fechaMuestra,
                    S.entrega as fechaEntrega,
                    S.statusPago as pagado,
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
            $sqlPagos = "
                SELECT 
                    *
                FROM pagos P 
                WHERE (id_ref = $id AND modulo = 'solicitudes'); 
            ";
            $pagos = self::query_object($sqlPagos);
            $resultados->estudios = $estudios;
            $resultados->pagos = $pagos;
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
            $order = (array_key_exists('order',$data))?$data['order']:"desc";
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
                            S.resultados as resultados, 
                            (CASE  
                                WHEN ((SELECT perfil FROM usuarios U2 WHERE P.referente = U2.id) = 2) THEN TRUE
                                WHEN ((SELECT perfil FROM usuarios U2 WHERE P.referente = U2.id) = 3) THEN TRUE
                                ELSE  FALSE
                             END   
                            ) as pagaCliente,
                            GROUP_CONCAT(E.nombre SEPARATOR'||') as estudios
                    FROM solicitudes S 
                        INNER JOIN pacientes P
                            ON S.id_paciente = P.id
                        INNER JOIN usuarios U
                            ON S.analista = U.id
                        INNER JOIN estudios_paciente EP
                            ON EP.id_solicitud = S.id
                        INNER JOIN estudios E 
                            ON E.id = EP.id_estudio    
                    WHERE
                        S.cancelado IS NULL 
                        AND S.estado = $status
                        $andWhere
                    GROUP BY S.id                            
                    ORDER BY $sort $order
                    LIMIT $limit
                    OFFSET $offset
                        ;";
            $rows = self::query_object($sql);

            $sqlCount= "SELECT count(*) as total
                        FROM solicitudes S
                            INNER JOIN pacientes P
                                ON S.id_paciente = P.id
                            INNER JOIN usuarios U
                                ON S.analista = U.id
                        WHERE 
                            S.cancelado IS NULL 
                            AND S.estado = $status
                            $andWhere
                        ;";

            $count = self::query_single_object($sqlCount);


            $estudios = array(
                'rows'  => $rows,
                'count' => $count->total
            );

                return $estudios;
        }

        public function tomarMuestra($id){
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

        public function uploadFile($data){
            $id =$data['id'];

            $param = array(':sid'=>$id);

            $sqlSelect = "
                SELECT statusPago FROM solicitudes WHERE id= :sid;
            ";

            $solicitud = self::query_single_object($sqlSelect,$param);
            $status = ($solicitud->statusPago=="1")?3:2;

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

        public function Pagar($data)
        {
            $id =$data['id'];

            $param = array(':sid'=>$id);

            $sqlSelect = "
                SELECT * FROM solicitudes WHERE id= :sid;
            ";

            $solicitud = self::query_single_object($sqlSelect,$param);

            $sqlPagos = "
                SELECT * FROM pagos 
                    WHERE 
                        modulo = 'solicitudes' AND 
                        id_ref = :sid;
                        
            ";


            $pagos = self::query_object($sqlPagos,$param);

            $pago = floatval($data['pago']);
            $totalAnticipo = 0;
            if($pagos) {
                foreach ($pagos as $anticipo) {
                    $cantidad = $anticipo->cantidad;
                    $totalAnticipo += floatval($cantidad);
                }
            }
            if (($pago + $totalAnticipo) > floatval($solicitud->costo)){
                    return array('success' => false, 'msg'=> "El monto del anticipo es mayor al total a pagar");
            }

            $completo = (($pago + $totalAnticipo + 0.009)>=floatval($solicitud->costo))?true:false;
            $status = ($completo)?3:2;

            $paramsPago = array(
                ':cnt'=>$pago,
                ':crt'=>date('Y-m-d H:i:s'),
                ':typ'=>$data['formaPago'],
                ':rfr'=>$data['referencia'],
                ':mod'=>'solicitudes',
                ':sid'=>$id
            );

            $sqlPago = "
                INSERT 
                    INTO pagos
                        (cantidad,tipo,referencia,modulo,id_ref,creado)
                    VALUES
                        (:cnt,:typ,:rfr,:mod,:sid,:crt);
                
            ";
            $queryPago = self::query($sqlPago,$paramsPago);

            if ($queryPago) {
                $params = array(
                    ":sid" => $id,
                    ":pay" => $completo,
                    ":sta" => $status
                );
                $sql = "
                    UPDATE 
                        solicitudes
                    SET
                        statusPago = :pay,
                        estado = :sta
                    WHERE id = :sid;
                ";
                $query = self::query($sql, $params);
                if ($query) {
                    return array('success' => true, 'msg' => 'El pago ha sido registrado');
                } else {
                    return array('success' => false, 'msg' => 'Ocurrió un error al cambiar el estado de la solicitud el pago');
                }
            }else{
                return array('success' => false, 'msg' => 'Ocurrió un error al intentar guardar el pago');

            }

        }

        public function Cancelar($idSol){
            $param = array(
                ':sid'=>$idSol,
                ':del'=>date("Y-m-d H:i:s")
            );
            $sql = "UPDATE solicitudes 
                        SET 
                            cancelado = :del 
                    WHERE id = :sid;";
            $query = self::query($sql,$param);
            if($query){
                return array('success' => true, 'msg' => "La solicitud de estudios ha sido cancelada");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar cancelar la solicitud");
            }

        }
    }


?>
