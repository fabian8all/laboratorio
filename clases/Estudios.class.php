<?php

	require_once('DBConnection.class.php');

	Class Estudio extends DBConnection {

        public function getAll(){

            $sql = "SELECT * FROM estudios WHERE eliminado IS NULL;";

            $estudios = self::query_object($sql);

            if ($estudios){
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
                ':mue'=>$data['muestra']
            );
            $sql = "UPDATE estudios 
                        SET 
                            codigo = :cod,
                            nombre = :nom,
                            tiempo = :tim,
                            costo = :cos,
                            muestra = :mue,
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


    }


?>
