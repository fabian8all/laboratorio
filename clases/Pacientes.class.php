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

        public function get($id){
            $param = array(
                ":eid"=>$id
            );

            $sql = "SELECT * FROM pacientes WHERE id = :eid;";

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
                return true;
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
