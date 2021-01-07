<?php

	require_once ('DBConnection.class.php');


	Class Estudio extends DBConnection {

        public function getAll($data){
            $search = (array_key_exists('search',$data))? $data['search']:"";
            $andWhere = ($search != "")? "AND (nombre LIKE ('%$search%') OR codigo = '$search' )":"";

            $sql = "SELECT * FROM estudios WHERE eliminado IS NULL $andWhere;";

            $estudios = self::query_object($sql);

            if ($estudios){
                return $estudios;
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

            $andWhere = ($search != "")? "AND (nombre LIKE ('%$search%') OR codigo = '$search' )":"";


            $sql = "SELECT * 
                        FROM estudios 
                        WHERE eliminado IS NULL
                            $andWhere
                        ORDER BY $sort $order
                        LIMIT $limit
                        OFFSET $offset
                        ;";

            $rows = self::query_object($sql);

            $sqlCount= "SELECT count(*) as total
                        FROM estudios 
                        WHERE eliminado IS NULL
                            $andWhere
                        ;";


            $count = self::query_single_object($sqlCount);


            $estudios = array(
                'rows'  => $rows,
                'count' => $count->total
            );

            return $estudios;

        }

        public function get($id){
            $param = array(
                ":eid"=>$id
            );

            $sql = "SELECT * FROM estudios WHERE id = :eid;";

            $estudio = self::query_single_object($sql,$param);

            if($estudio){
                return $estudio;
            }else{
                return false;
            }
        }

        public function Add($data){
            if($data['nombre'] == "" || $data['tiempo']=="" || $data['costo']==""){
                return array('success' => false, 'msg'=> "Falta alguno de los datos requeridos");
            }
            $params = array(
                ':cod'=>$data['codigo'],
                ':nom'=>$data['nombre'],
//                ':cat'=>$data['categoria'],
                ':tim'=>$data['tiempo'],
                ':cos'=>$data['costo'],
                ':cmd'=>$data['costom'],
                ':cem'=>$data['costoe'],
                ':cl4'=>$data['costol4'],
                ':mue'=>$data['muestra'],
                ':crt'=>date('Y-m-d H:i:s')
            );
            $sql = "INSERT INTO estudios 
                        (codigo,nombre,tiempo,costo,costo_medico,costo_empresa,costo_lista4,muestra,creado) 
                    VALUES
                        (:cod,:nom,:tim,:cos,:cmd,:cem,:cl4,:mue,:crt)";
            $query = self::query($sql,$params);
            if ($query){
                return array('success' => true, 'msg' => "El registro de estudio ha sido creado");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar guardar la información");
            }

        }

        public function Update($data){
            if($data['nombre'] == "" || $data['tiempo']=="" || $data['costo']==""){
                return array('success' => false, 'msg'=> "Falta alguno de los datos requeridos");
            }
            $params = array(
                ':eid'=>$data['id'],
                ':cod'=>$data['codigo'],
                ':nom'=>$data['nombre'],
//                ':cat'=>$data['categoria'],
                ':tim'=>$data['tiempo'],
                ':cos'=>$data['costo'],
                ':cmd'=>$data['costom'],
                ':cem'=>$data['costoe'],
                ':cl4'=>$data['costol4'],
                ':mue'=>$data['muestra'],
            );
            $sql = "UPDATE estudios 
                        SET 
                            codigo = :cod,
                            nombre = :nom,
                            tiempo = :tim,
                            costo = :cos,
                            costo_medico = :cmd,
                            costo_empresa = :cem,
                            costo_lista4 = :cl4,
                            muestra = :mue
                        WHERE 
                            id = :eid";
            $query = self::query($sql,$params);
            if ($query){
                return array('success' => true, 'msg' => "La información de estudio ha sido actualizada");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar guardar la información");
            }

        }

        public function Delete($id){
            $param = array(
              ':eid'=>$id,
              ':del'=>date("Y-m-d H:i:s")
            );
            $sql = "UPDATE estudios 
                        SET 
                        eliminado = :del 
                    WHERE id = :eid;";
            $query = self::query($sql,$param);
            if($query){
                return array('success' => true, 'msg' => "El estudio ha sido eliminado");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar guardar la información");
            }
        }

        public function Solicitar($data){

                $analistaId = $data['analistaId'];
                $pacienteId = $data['pacienteId'];
                $descuento  = $data['descuento'];
                $total      = $data['total'];
                $totalCliente = $data['totalCliente'];
                $anticipo   = $data['anticipo'];
                $formaPago  = $data['formaPago'];
                $refAnticipo = $data['refAnticipo'];
                $aDomicilio =  strtolower($data['aDomicilio']) == 'true' ? true : false;

                if ($anticipo > $total){
                    return array('success' => false, 'msg'=> "El monto del anticipo es mayor al total a pagar");
                }

                $pago_completo = ($anticipo=$total)?true:false;




                $muestra = ($aDomicilio)?NULL:date('Y-m-d H:i:s');
                $status = ($aDomicilio)?0:1;
                $param = array(
                    ':pid'=>$pacienteId,
                    ':sol'=>date('Y-m-d H:i:s'),
                    ':sta'=>$status,
                    ':cst'=>$total,
                    ':csc'=>$totalCliente,
                    ':des'=>$descuento,
                    ':ana'=>$analistaId,
                    ':pay'=>$pago_completo,
                    ':mue'=>$muestra,
                    ':dom'=>$aDomicilio
                );


                $sql = "INSERT INTO solicitudes
                            (id_paciente,solicitud,estado,costo,costoCliente,descuento,analista,statusPago,muestra,aDomicilio)
                        VALUES
                            (:pid,:sol,:sta,:cst,:csc,:des,:ana,:pay,:mue,:dom)";
                $query = self::query($sql,$param);
                $ok = true;
                $msg = "";
                if ($query){
                    $sqlGetLast = "SELECT MAX(id) as id FROM solicitudes;";
                    $queryLast = self::query_single_object($sqlGetLast);
                    $solicitud = $queryLast->id;


                    foreach ($data['estudios'] as $key=>$estudio){
                        switch ($data['lista']){
                            case 0: $costoCliente = $estudio['costo'];break;
                            case 1: $costoCliente = $estudio['costom'];break;
                            case 2: $costoCliente = $estudio['costoe'];break;
                            case 3: $costoCliente = $estudio['costol4'];break;

                        }
                        $param = array(
                            ':eid'=>$estudio['id'],
                            ':cst'=>$estudio['costo'],
                            ':csc'=>$costoCliente,
                            ':sid'=>$solicitud
                        );
                        $sql = "INSERT INTO estudios_paciente
                                (id_estudio,id_solicitud,costo,costoCliente)
                            VALUES
                                (:eid,:sid,:cst,:csc)";
                        $query = self::query($sql,$param);
                        if(!$query){
                            $ok=false;
                            $msg = "Ocurrió un error al intentar guardar los estudios a realizar.";
                            break;
                        }
                    }
                    if (floatval($anticipo)>0) {
                        $paramsPago = array(
                            ':cnt' => $anticipo,
                            ':typ' => $formaPago,
                            ':rfr' => $refAnticipo,
                            ':mod' => 'solicitudes',
                            ':sid' => $solicitud,
                            ':crt' => date('Y-m-d H:i:s')
                        );
                        $sqlPago = "
                            INSERT INTO
                                pagos
                                    (cantidad,tipo,referencia,modulo,id_ref,creado)
                            VALUES
                               (:cnt,:typ,:rfr,:mod,:sid,:crt);
                        ";
                        $queryPago = self::query($sqlPago,$paramsPago);
                        if (!$queryPago){
                            $ok = false;
                            $msg = "Ocurrió un error al intentar guardar el pago del anticipo.";
                        }
                    }
                }else{
                    $ok = false;
                    $msg = "Ocurrió un error al intentar guardar la solicitud de estudios";
                }

            if($ok){
                    return array('success' => true, 'msg' => "Se han solicitado los estudios a realizar");
                }else{
                    return array('success' => false, 'msg'=> $msg);
                }
        }

        public function getListaPrecios(){

            $sql = "
                SELECT 
                    id,
                    nombre,
                    costo as l1,
                    costo_medico as l2,
                    costo_empresa as l3,
                    costo_lista4 as l4
                FROM estudios
                WHERE eliminado IS NULL;
            ";

            $estudios = self::query_object($sql);
            if ($estudios){
                $csv = "Id,Estudio,Público General,Médico,Empresa,Lista 4\n";
                foreach ($estudios as $estudio){
                    $nombre = '"'.$estudio->nombre.'"';
                    $csv .= $estudio->id.",".
                            $nombre.",".
                            $estudio->l1.",".
                            $estudio->l2.",".
                            $estudio->l3.",".
                            $estudio->l4."\n";
                }
                return array("success"=>true,"data"=>$csv);
            }else{
                return array("success"=>false,"msg"=>"Error al intentar obtener la lista de precios");
            }


        }
        public function importListaPrecios($file){
            $fileName = $file["listaCSV"]["tmp_name"];

            if ($file["listaCSV"]["size"] > 0) {

                $file = fopen($fileName, "r");

                $headers=true;
                $ok = true;
                $errors = array();
                while (($row = fgetcsv($file, 10000, ",")) !== FALSE) {
                    if ($headers){
                        $headers = false;
                    }else {
                        $id = "";
                        if (isset($row[0])) {
                            $id = $row[0];
                        }
                        $precioPG = "";
                        if (isset($row[2])) {
                            $precioPG = $row[2];
                        }
                        $precioMd = "";
                        if (isset($row[3])) {
                            $precioMd = $row[3];
                        }
                        $precioEm = "";
                        if (isset($row[4])) {
                            $precioEm = $row[4];
                        }
                        $precioL4 = "";
                        if (isset($row[5])) {
                            $precioL4 = $row[5];
                        }

                        $params = array(
                            ':eid' => $id,
                            ':pl1' => $precioPG,
                            ':pl2' => $precioMd,
                            ':pl3' => $precioEm,
                            ':pl4' => $precioL4
                        );

                        $sql = "
                            UPDATE estudios E
                                SET costo = :pl1,
                                    costo_medico = :pl2,
                                    costo_empresa = :pl3,
                                    costo_lista4 = :pl4 
                            WHERE id = :eid;";

                        $query = self::query($sql, $params);

                        if (!$query) {
                            $ok = false;
                            array_push($errors,array(
                                    'id'=>$id,
                                    'PG'=>$precioPG,
                                    'MD'=>$precioMd,
                                    'EM'=>$precioEm,
                                    'L4'=>$precioL4
                                )
                            );
                        }
                    }
                }
                if($ok){
                    $results = array(
                        'success'   => true,
                        'msg'       => "La lista de precios ha sido importada con exito"
                    );
                }else{
                    $results = array(
                        'success'   => false,
                        'msg'       => "La lista de precios se ha importado con errores",
                        'errors'    => $errors
                    );
                }
            }else{
                $results = array(
                    'success'   => false,
                    'msg'       => "El archivo se encuentra vacío",
                    'errors'    => $file['listaCSV']
                );
            }
            return $results;
        }

    }


?>
