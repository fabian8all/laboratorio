<?php

	require_once('DBConnection.class.php');

	Class Usuario extends DBConnection {

        public function login($info){

            $array = array(
                ':usn' => $info['username'],
                ':pwd' => sha1(md5('-t3CN01oG1a5%C0s173c!' . $info['password']))
            );

            $fn_username = "SELECT * FROM usuarios U WHERE username = :usn AND password = :pwd ;";

            $usr = self::query_single_object($fn_username,$array);
            if (!empty($usr)) {

                $_SESSION["id"]        = $usr->id;
                $_SESSION["perfil"]       = $usr->perfil;
                $_SESSION["username"]      = $usr->username;
                $_SESSION["nombre"]      = $usr->nombre;

                return array('logged'=>true,'perfil'=>$usr->perfil,'msg'=>"Sesión iniciada");

            }else{
                return array('logged'=>false,'msg'=>"Los datos de inicio de sesión son incorrectos");
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
                        WHERE (perfil != 1 AND perfil != 2 AND perfil !=3) AND eliminado IS NULL
                            $andWhere
                        ORDER BY $sort $order
                        LIMIT $limit
                        OFFSET $offset
                        ;";

            $rows = self::query_object($sql);

            $sqlCount= "SELECT count(*) as total
                        FROM usuarios 
                        WHERE (perfil != 1 AND perfil != 2 AND perfil !=3) AND eliminado IS NULL
                            $andWhere
                        ;";


            $count = self::query_single_object($sqlCount);


            $usuarios = array(
                'rows'  => $rows,
                'count' => $count->total
            );

            if ($count->total > 0){
                return $usuarios;
            }else{
                return false;
            }

        }


        public function get($id){
            $param = array(
                ":eid"=>$id
            );

            $sql = "SELECT * FROM usuarios WHERE id = :eid;";

            $usuario = self::query_single_object($sql,$param);

            if($usuario){
                return $usuario;
            }else{
                return false;
            }
        }

        public function Add($data){
            $usrnmParam = array(":usr"=>$data['username']);
            $sqlFindUser = "SELECT * FROM usuarios WHERE username = :usr;";
            $user = self::query_single_object($sqlFindUser,$usrnmParam);
            if($user){
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
                    ':usr'=>$data['username'],
                    ':prf'=>$data['perfil'],
                    ':nom'=>$data['nombre'],
                    ':eml'=>$data['email'],
                    ':pwd'=>sha1(md5('-t3CN01oG1a5%C0s173c!' . $data['pass1'])),
                    ':crt'=>date('Y-m-d H:i:s')
                );
                $sql = "INSERT INTO usuarios 
                        (username,perfil,nombre,email,password,creado) 
                    VALUES
                        (:usr,:prf,:nom,:eml,:pwd,:crt)";
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
            $params = array(
                ':uid'=>$data['id'],
                ':nom'=>$data['nombre'],
                ':eml'=>$data['email'],
                ':prf'=>$data['perfil'],
            );

            $sql = "UPDATE usuarios
                        SET 
                            nombre = :nom,
                            email = :eml,
                            perfil = :prf,
                        WHERE 
                            id = :uid";
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
                ':uid'=>$id,
                ':del'=>date("Y-m-d H:i:s")
            );
            $sql = "UPDATE usuarios 
                        SET 
                        eliminado = :del 
                    WHERE id = :uid;";
            $query = self::query($sql,$param);
            if($query){
                return true;
            }else{
                return false;
            }
        }



    }


?>
