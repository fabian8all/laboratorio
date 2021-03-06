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

        public function getMy($idCliente){

            $param = array(':cid'=>$idCliente);
            $sql = "SELECT * FROM pacientes WHERE referente = :cid AND eliminado IS NULL;";

            $pacientes = self::query_object($sql,$param);

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

            $andWhere = ($search != "")? "AND (nombre LIKE ('%$search%') OR email LIKE ('%$search%') ) ":"";

            if ($data['mode']=="0"){
                $idUser = $_SESSION['id'];
                $andWhere.="AND referente = $idUser";
            }
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

            return $pacientes;

        }


        public function get($id){
            $param = array(
                ":eid"=>$id
            );

            $sql = "SELECT 
                        P.*,
                        DATE_FORMAT(P.fechaNac,'%Y-%m-%d') AS fechaNacInput,
                        IF (P.referente = 0, 0, U.lista) AS lista,
                        (CASE  
                            WHEN ((SELECT perfil FROM usuarios U2 WHERE P.referente = U2.id) = 2) THEN U.nombre
                            WHEN ((SELECT perfil FROM usuarios U2 WHERE P.referente = U2.id) = 3) THEN U.nombre
                            ELSE  'Ninguno'
                         END   
                        ) as referente,
                        (CASE  
                            WHEN ((SELECT perfil FROM usuarios U2 WHERE P.referente = U2.id) = 2) THEN TRUE
                            WHEN ((SELECT perfil FROM usuarios U2 WHERE P.referente = U2.id) = 3) THEN TRUE
                            ELSE  FALSE
                         END   
                        ) as pagaCliente 
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
            if($data['nombre'] == "" || $data['fechaNac']==""){
                return array('success' => false, 'msg'=> "Falta alguno de los datos requeridos");
            }
            $params = array(
                ':nom'=>$data['nombre'],
                ':gen'=>$data['genero'],
                ':fna'=>$data['fechaNac'],
                ':dir'=>$data['direccion'],
                ':tel'=>$data['telefono'],
                ':eml'=>$data['email'],
                ':rfr'=>$data['referente'],
                ':crt'=>date('Y-m-d H:i:s')
            );
            $sql = "INSERT INTO pacientes 
                        (nombre,genero,fechaNac,direccion,telefono,email,referente,creado) 
                    VALUES
                        (:nom,:gen,:fna,:dir,:tel,:eml,:rfr,:crt)";
            $query = self::query($sql,$params);
            if ($query){
                $sel = "SELECT MAX(id) as id FROM pacientes;";
                $id = self::query_single_object($sel);
                return array('success' => true, 'id' => $id, 'msg' => "El registro del paciente ha sido creado");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar guardar la información");
            }

        }

        public function Update($data){
            if($data['nombre'] == "" || $data['fechaNac']==""){
                return array('success' => false, 'msg'=> "Falta alguno de los datos requeridos");
            }
            $params = array(
                ':pid'=>$data['id'],
                ':nom'=>$data['nombre'],
                ':gen'=>$data['genero'],
                ':fna'=>$data['fechaNac'],
                ':dir'=>$data['direccion'],
                ':tel'=>$data['telefono'],
                ':eml'=>$data['email'],
            );
            $sql = "UPDATE pacientes 
                        SET 
                            nombre = :nom,
                            genero = :gen,
                            fechaNac = :fna,
                            direccion = :dir,
                            telefono = :tel,
                            email = :eml,
                            eliminado = null 
                        WHERE 
                            id = :pid";
            $query = self::query($sql,$params);
            if ($query){
                return array('success' => true, 'msg' => "La información del paciente ha sido actualizada");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar guardar la información");
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
                return array('success' => true, 'msg' => "El registro del paciente ha sido eliminado");
            }else{
                return array('success' => false, 'msg'=> "Ocurrió un error al intentar eliminar el registro del paciente");
            }
        }


    }


?>
