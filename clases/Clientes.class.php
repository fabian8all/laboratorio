<?php

	require_once('DBConnection.class.php');

	Class Cliente extends DBConnection {

        public function getAll($data){
            if ($data['mode']=="0"){
                $idUser = $_SESSION['id'];
                $andWhere ="AND id = $idUser";
            }else{
                $andWhere = "";
            }

            $sql = "SELECT 
                        * 
                    FROM usuarios 
                    WHERE 
                        (perfil = 2 OR perfil = 3) 
                        AND eliminado IS NULL
                        $andWhere;";

            $clientes = self::query_object($sql);

            if ($clientes){
                return $clientes;
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
                        FROM usuarios 
                        WHERE (perfil = 2 OR perfil = 3) AND eliminado IS NULL
                            $andWhere
                        ORDER BY $sort $order
                        LIMIT $limit
                        OFFSET $offset
                        ;";

            $rows = self::query_object($sql);

            $sqlCount= "SELECT count(*) as total
                        FROM usuarios 
                        WHERE (perfil = 2 OR perfil = 3) AND eliminado IS NULL
                            $andWhere
                        ;";


            $count = self::query_single_object($sqlCount);


            $clientes = array(
                'rows'  => $rows,
                'count' => $count->total
            );

            return $clientes;

        }


        public function get($id){
            $param = array(
                ":eid"=>$id
            );

            $sql = "SELECT * FROM usuarios WHERE id = :eid;";

            $cliente = self::query_single_object($sql,$param);

            if($cliente){
                return $cliente;
            }else{
                return false;
            }
        }

        public function Add($data){
            $usrnm = $data['username'];
            $lista = $data['lista'];
            $usrnmParam = array(":usr"=> $usrnm);
                $sqlFindUser = "SELECT * FROM usuarios WHERE username = :usr;";
            $user = self::query_single_object($sqlFindUser,$usrnmParam);
            if($usrnm == ""){
                $result = array(
                    "success" =>false,
                    "msg"=>"El nombre de usuario es requerido"
                );
            }else if($lista == ""){
                $result = array(
                    "success" =>false,
                    "msg"=>"No se ha seleccionado lista de precios"
                );
            }else if($user){
                $result = array(
                    "success" =>false,
                    "msg"=>"El nombre de usuario ya existe en la base de datos"
                );
            }else if($data['pass1'] == ""){
                $result = array(
                    "success" =>false,
                    "msg"=>"El campo contraseña es requerido"
                );
            }else if($data['pass1']!=$data['pass2']){
                $result = array(
                    "success" =>false,
                    "msg"=>"Las contraseñas no coinciden"
                );
            }else{
                $params = array(
                    ':usr'=>$usrnm,
                    ':prf'=>$data['perfil'],
                    ':nom'=>$data['nombre'],
                    ':eml'=>$data['email'],
                    ':pwd'=>sha1(md5('-t3CN01oG1a5%C0s173c!' . $data['pass1'])),
                    ':lst'=>$lista,
                    ':crt'=>date('Y-m-d H:i:s')
                );
                $sql = "INSERT INTO usuarios 
                        (username,perfil,nombre,email,lista,password,creado) 
                    VALUES
                        (:usr,:prf,:nom,:eml,:lst,:pwd,:crt)";
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

            }
            return $result;

        }

        public function Update($data){
            $lista = $data['lista'];
            if($lista == ""){
                $result = array(
                    "success" =>false,
                    "msg"=>"No se ha seleccionado lista de precios"
                );
            }else {
                $params = array(
                    ':cid' => $data['id'],
                    ':nom' => $data['nombre'],
                    ':eml' => $data['email'],
                    ':prf' => $data['perfil'],
                    ':lst' => $data['lista']
                );

                $sql = "UPDATE usuarios
                            SET 
                                nombre = :nom,
                                email = :eml,
                                perfil = :prf,
                                lista = :lst,
                                eliminado = null 
                            WHERE 
                                id = :cid";
                $query = self::query($sql, $params);
                if ($query) {
                    $result = array(
                        "success" => true,
                        "msg" => "La información se ha guardado con éxito"
                    );
                } else {
                    $result = array(
                        "success" => false,
                        "msg" => "Ocurrió un error al guardar la información"
                    );
                }
            }
            return $result;
        }

        public function Delete($id){
            $param = array(
              ':cid'=>$id,
              ':del'=>date("Y-m-d H:i:s")
            );
            $sql = "UPDATE usuarios 
                        SET 
                        eliminado = :del 
                    WHERE id = :cid;";
            $query = self::query($sql,$param);
            if($query){
                return array('success' => true, 'msg' => "El registro del cliente ha sido eliminado");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar eliminar el registro del cliente");
            }
        }


    }


?>
