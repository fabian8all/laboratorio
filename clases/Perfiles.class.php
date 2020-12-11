<?php

	require_once('DBConnection.class.php');

	Class Perfil extends DBConnection {

        public function BSTableData($data){
            $search = (array_key_exists('search',$data))? $data['search']:"";
            $limit = (array_key_exists('limit',$data))?$data['limit']:0;
            $offset = (array_key_exists('offset',$data))?$data['offset']:0;
            $sort = (array_key_exists('sort',$data))?$data['sort']:"id";
            $order = (array_key_exists('order',$data))?$data['order']:"asc";

            $andWhere = ($search != "")? "AND perfil LIKE ('%$search%') ":"";


            $sql = "SELECT * 
                        FROM perfiles 
                        WHERE id != 1 AND id!=2 AND id!=3 AND eliminado IS NULL
                            $andWhere
                        ORDER BY $sort $order
                        LIMIT $limit
                        OFFSET $offset
                        ;";

            $rows = self::query_object($sql);

            $sqlCount= "SELECT count(*) as total
                        FROM perfiles 
                        WHERE eliminado IS NULL
                            $andWhere
                        ;";


            $count = self::query_single_object($sqlCount);


            $perfiles = array(
                'rows'  => $rows,
                'count' => $count->total
            );

            return $perfiles;

        }

        public function getAll(){
            $sql = "
                SELECT * 
                FROM perfiles
                WHERE 
                    id != 1 
                    AND id != 2 
                    AND id!=3 
                    AND eliminado IS NULL;
            ";

            $query = self::query_object($sql);

            if ($query){
                return $query;
            }else{
                return false;
            }
        }


        public function get($id){
            $param = array(
                ":eid"=>$id
            );

            $sql = "SELECT * FROM perfiles WHERE id = :eid;";

            $perfil = self::query_single_object($sql,$param);

            if($perfil){
                return $perfil;
            }else{
                return false;
            }
        }

        public function Add($data){
            if($data['nombre'] == ""){
                return array('success' => false, 'msg'=> "Falta alguno de los datos requeridos");
            }

            $pCot = str_pad(dechex($data['permisos']['cotizacion']),2,'0',STR_PAD_LEFT);
            $pRes = str_pad(dechex($data['permisos']['resultados']),2,'0',STR_PAD_LEFT);
            $pPac = str_pad(dechex($data['permisos']['pacientes']),2,'0',STR_PAD_LEFT);
            $pEst = str_pad(dechex($data['permisos']['estudios']),2,'0',STR_PAD_LEFT);
            $pCli = str_pad(dechex($data['permisos']['clientes']),2,'0',STR_PAD_LEFT);
            $pUsr = str_pad(dechex($data['permisos']['usuarios']),2,'0',STR_PAD_LEFT);
            $pPrf = str_pad(dechex($data['permisos']['perfiles']),2,'0',STR_PAD_LEFT);

            $params = array(
                    ':nom'=>$data['nombre'],
                    ':prm'=>$pPrf.$pUsr.$pCli.$pEst.$pPac.$pRes.$pCot,
                    ':crt'=>date('Y-m-d H:i:s')
                );
                $sql = "INSERT INTO perfiles 
                        (perfil,permisos,creado) 
                    VALUES
                        (:nom,:prm,:crt)";
                $query = self::query($sql,$params);
                if ($query){
                    $result = array(
                        "success" =>true,
                        "msg"=>"La información se ha guardado con éxito"
                    );
                }else{
                    $result = array(
                        "success" =>false,
                        "msg"=>"Ocurrió un error al guardar la información"
                    );
                }
            return $result;

        }

        public function Update($data){
            if($data['nombre'] == ""){
                return array('success' => false, 'msg'=> "Falta alguno de los datos requeridos");
            }

            $pCot = str_pad(dechex($data['permisos']['cotizacion']),2,'0',STR_PAD_LEFT);
            $pRes = str_pad(dechex($data['permisos']['resultados']),2,'0',STR_PAD_LEFT);
            $pPac = str_pad(dechex($data['permisos']['pacientes']),2,'0',STR_PAD_LEFT);
            $pEst = str_pad(dechex($data['permisos']['estudios']),2,'0',STR_PAD_LEFT);
            $pCli = str_pad(dechex($data['permisos']['clientes']),2,'0',STR_PAD_LEFT);
            $pUsr = str_pad(dechex($data['permisos']['usuarios']),2,'0',STR_PAD_LEFT);
            $pPrf = str_pad(dechex($data['permisos']['perfiles']),2,'0',STR_PAD_LEFT);

            $params = array(
                ':pid'=>$data['id'],
                ':nom'=>$data['nombre'],
                ':prm'=>$pPrf.$pUsr.$pCli.$pEst.$pPac.$pRes.$pCot
            );

            $sql = "UPDATE perfiles
                        SET 
                            perfil = :nom,
                            permisos = :prm
                        WHERE 
                            id = :pid";
            $query = self::query($sql,$params);
            if ($query){
                $result = array(
                    "success" =>true,
                    "msg"=>"La información se ha guardado con éxito"
                );
            }else{
                $result = array(
                    "success" =>false,
                    "msg"=>"Ocurrió un error al guardar la información"
                );
            }
            return $result;
        }

        public function Delete($id){
            $param = array(
                ':pid'=>$id,
                ':del'=>date("Y-m-d H:i:s")
            );
            $sql = "UPDATE perfiles 
                        SET 
                        eliminado = :del 
                    WHERE id = :pid;";
            $query = self::query($sql,$param);
            if($query){
                return array(
                    "success" =>true,
                    "msg"=>"El perfil ha sido eliminado"
                );
            }else{
                return array(
                    "success" =>false,
                    "msg"=>"Ocurrió un error al intentar eliminar el perfil"
                );
            }
        }



    }


?>
