<?php

	require_once('DBConnection.class.php');

	Class Paciente extends DBConnection {

        public function getAll(){

            $sql = "SELECT * FROM pacientes WHERE eliminado IS NULL;";

            $pacientes = self::query_object($sql);

            if ($pacientes){
                return $pacientes;
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

            $andWhere = ($search != "")? "AND (nombre LIKE ('%$search%') OR email LIKE ('%$search%') )":"";


            $sql = "SELECT * 
                        FROM pacientes 
                        WHERE eliminado IS NULL
                            $andWhere
                        ORDER BY $sort $order
                        LIMIT $limit
                        OFFSET $offset
                        ;";

            $rows = self::query_object($sql);

            $sqlCount= "SELECT count(*) as total
                        FROM pacientes 
                        WHERE eliminado IS NULL
                            $andWhere
                        ;";


            $count = self::query_single_object($sqlCount);


            $pacientes = array(
                'rows'  => $rows,
                'count' => $count->total
            );

            if ($count->total > 0){
                return $pacientes;
            }else{
                return false;
            }

        }


        public function get($id){
            $param = array(
                ":eid"=>$id
            );

            $sql = "SELECT 
                        P.*,
                        IF (P.referente = 0, 0.0, U.descuento) AS descuento 
                    FROM pacientes P 
                        LEFT JOIN usuarios U 
                            ON U.id = P.referente    
                    WHERE P.id = :eid;";

            $paciente = self::query_single_object($sql,$param);

            if($paciente){
                return $paciente;
            }else{
                return false;
            }
        }

        public function Add($data){
            $params = array(
                ':nom'=>$data['nombre'],
                ':dir'=>$data['direccion'],
                ':tel'=>$data['telefono'],
                ':eml'=>$data['email'],
                ':rfr'=>0,
                ':crt'=>date('Y-m-d H:i:s')
            );
            $sql = "INSERT INTO pacientes 
                        (nombre,direccion,telefono,email,referente,creado) 
                    VALUES
                        (:nom,:dir,:tel,:eml,:rfr,:crt)";
            $query = self::query($sql,$params);
            if ($query){
                $sel = "SELECT MAX(id) as id FROM pacientes;";
                $id = self::query_single_object($sel);
                return $id;
            }else{
                return false;
            }

        }

        public function Update($data){
            $params = array(
                ':pid'=>$data['id'],
                ':nom'=>$data['nombre'],
                ':dir'=>$data['direccion'],
                ':tel'=>$data['telefono'],
                ':eml'=>$data['email'],
            );
            $sql = "UPDATE pacientes 
                        SET 
                            nombre = :nom,
                            direccion = :dir,
                            telefono = :tel,
                            email = :eml,
                            eliminado = null 
                        WHERE 
                            id = :pid";
            $query = self::query($sql,$params);
            if ($query){
                return true;
            }else{
                return false;
            }

        }

        public function Delete($id){
            $param = array(
              ':pid'=>$id,
              ':del'=>date("Y-m-d H:i:s")
            );
            $sql = "UPDATE pacientes 
                        SET 
                        eliminado = :del 
                    WHERE id = :pid;";
            $query = self::query($sql,$param);
            if($query){
                return true;
            }else{
                return false;
            }
        }


    }


?>
