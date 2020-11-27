<?php

	require_once ('DBConnection.class.php');
    require_once ('../includes/permisos.php');


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

            if ($count->total > 0){
                return $estudios;
            }else{
                return false;
            }

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
            $params = array(
                ':cod'=>$data['codigo'],
                ':nom'=>$data['nombre'],
//                ':cat'=>$data['categoria'],
                ':tim'=>$data['tiempo'],
                ':cos'=>$data['costo'],
                ':mue'=>$data['muestra'],
                ':crt'=>date('Y-m-d H:i:s')
            );
            $sql = "INSERT INTO estudios 
                        (codigo,nombre,tiempo,costo,muestra,creado) 
                    VALUES
                        (:cod,:nom,:tim,:cos,:mue,:crt)";
            $query = self::query($sql,$params);
            if ($query){
                return array('success' => true, 'msg' => "El registro de estudio ha sido creado");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar guardar la información");
            }

        }

        public function Update($data){
            $params = array(
                ':eid'=>$data['id'],
                ':cod'=>$data['codigo'],
                ':nom'=>$data['nombre'],
//                ':cat'=>$data['categoria'],
                ':tim'=>$data['tiempo'],
                ':cos'=>$data['costo'],
                ':mue'=>$data['muestra'],
            );
            $sql = "UPDATE estudios 
                        SET 
                            codigo = :cod,
                            nombre = :nom,
                            tiempo = :tim,
                            costo = :cos,
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
                $anticipo   = $data['anticipo'];
                $pago_completo = ($anticipo>=$total)?true:false;

                $pagado = json_encode(
                    array(
                        'completo'  => $pago_completo,
                        'pagos'     => array(
                            array(
                                'cantidad'  => $anticipo,
                                'fecha'     => date('Y-m-d H:i:s')
                            )
                        )
                    )
                );

                $param = array(
                    ':pid'=>$pacienteId,
                    ':sol'=>date('Y-m-d H:i:s'),
                    ':sta'=>1,
                    ':cst'=>$total,
                    ':des'=>$descuento,
                    ':ana'=>$analistaId,
                    ':pay'=>$pagado
                );


                $sql = "INSERT INTO solicitudes
                            (id_paciente,solicitud,estado,costo,descuento,analista,pagado)
                        VALUES
                            (:pid,:sol,:sta,:cst,:des,:ana,:pay)";
                $query = self::query($sql,$param);
                if ($query){
                    $sqlGetLast = "SELECT MAX(id) as id FROM solicitudes;";
                    $queryLast = self::query_single_object($sqlGetLast);
                    $solicitud = $queryLast->id;

                }
                $ok = true;
                foreach ($data['estudios'] as $key=>$estudio){
                    $param = array(
                        ':eid'=>$estudio['id'],
                        ':cst'=>$estudio['costo'],
                        ':sid'=>$solicitud
                    );
                    $sql = "INSERT INTO estudios_paciente
                            (id_estudio,id_solicitud,costo)
                        VALUES
                            (:eid,:sid,:cst)";
                    $query = self::query($sql,$param);
                    if(!$query){
                        $ok=false;
                        break;
                    }
                }

                if($ok){
                    return array('success' => true, 'msg' => "Se han solicitado los estudios a realizar");
                }else{
                    return array('success' => false, 'msg'=> "Ocurrió un error al intentar guardar la información");
                }
        }


    }


?>
