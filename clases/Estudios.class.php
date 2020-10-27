<?php

	require_once('DBConnection.class.php');

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
                ':tst'=>$data['pruebas'],
                ':crt'=>date('Y-m-d H:i:s')
            );
            $sql = "INSERT INTO estudios 
                        (codigo,nombre,tiempo,costo,muestra,pruebas,creado) 
                    VALUES
                        (:cod,:nom,:tim,:cos,:mue,:tst,:crt)";
            $query = self::query($sql,$params);
            if ($query){
                return true;
            }else{
                return false;
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
                ':tst'=>$data['pruebas']
            );
            $sql = "UPDATE estudios 
                        SET 
                            codigo = :cod,
                            nombre = :nom,
                            tiempo = :tim,
                            costo = :cos,
                            muestra = :mue,
                            pruebas = :tst,
                            eliminado = null 
                        WHERE 
                            id = :eid";
            $query = self::query($sql,$params);
            if ($query){
                return true;
            }else{
                return false;
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
                return true;
            }else{
                return false;
            }
        }

        public function Solicitar($data){
            $pacienteId = $data['pacienteId'];
            $descuento  = $data['descuento'];

            $ok=true;
            foreach ($data['estudios'] as $key=>$estudio){
                if ($key == 0){
                    $paquete = 0;
                }else if($paquete == 0){
                    $sqlGetLast = "SELECT MAX(id) as id FROM estudios_paciente;";
                    $query = self::query_single_object($sqlGetLast);
                    $paquete = $query->id;
                }
                $param = array(
                    ':eid'=>$estudio['id'],
                    ':pid'=>$pacienteId,
                    ':sol'=>date('Y-m-d H:i:s'),
                    ':sta'=>1,
                    ':cst'=>$estudio['costo'],
                    ':des'=>$descuento,
                    ':paq'=>$paquete
                );
                $sql = "INSERT INTO estudios_paciente
                            (id_estudio,id_paciente,solicitud,estado,costo,descuento,paquete)
                        VALUES
                            (:eid,:pid,:sol,:sta,:cst,:des,:paq)";
                $query = self::query($sql,$param);
                if(!$query){
                    $ok=false;
                    break;
                }
            }

            if($ok){
                return true;
            }else{
                return false;
            }

        }


    }


?>
