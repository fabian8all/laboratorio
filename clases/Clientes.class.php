<?php

	require_once('DBConnection.class.php');

	Class Cliente extends DBConnection {

        public function getAll(){

            $sql = "SELECT * FROM usuarios WHERE perfil != 1 AND eliminado IS NULL;";

            $clientes = self::query_object($sql);

            if ($clientes){
                return $clientes;
            }else{
                return false;
            }

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
                    ':dsc'=>$data['descuento'],
                    ':crt'=>date('Y-m-d H:i:s')
                );
                $sql = "INSERT INTO usuarios 
                        (username,perfil,nombre,email,descuento,password,creado) 
                    VALUES
                        (:usr,:prf,:nom,:eml,:dsc,:pwd,:crt)";
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
                ':cid'=>$data['id'],
                ':nom'=>$data['nombre'],
                ':eml'=>$data['email'],
                ':prf'=>$data['perfil'],
                ':dsc'=>$data['descuento']
            );

            $sql = "UPDATE usuarios
                        SET 
                            nombre = :nom,
                            email = :eml,
                            perfil = :prf,
                            descuento = :dsc,
                            eliminado = null 
                        WHERE 
                            id = :cid";
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
              ':cid'=>$id,
              ':del'=>date("Y-m-d H:i:s")
            );
            $sql = "UPDATE usuarios 
                        SET 
                        eliminado = :del 
                    WHERE id = :cid;";
            $query = self::query($sql,$param);
            if($query){
                return true;
            }else{
                return false;
            }
        }


    }


?>
