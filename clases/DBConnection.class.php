<?php  
	
	require_once 'config.php';
    require_once 'Main.class.php';

	class DBConnection extends Main{

        public static $dbCon = null;
        public static $db = null;

        /**
         * [__construct description]
         */
        public function __construct(){
            self::connect();
        }

        /**
         * [connect description]
         * @return [type] [description]
         */
        public static function connect(){

            try {
                self::$dbCon = new PDO(
                    "mysql:dbname=".BASE_DE_DATOS.";
                    host=".NOMBRE_HOST."", USUARIO, CONTRASENA, 
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );
                return self::$dbCon;
            } catch (PDOException $e) {
                print "¡Error!: " . $e->getMessage() . "<br/>";
                die();
            }

        }

        /**
         * [query description]
         * @param  [TEXT]  $consult [consulta a ejecutar]
         * @param  [Array] $params  [parametros para la consulta]       
         * @return [bool]           [resultado de la consulta]
         */
        public static function query($consult, $params = null){
            $sentencia = self::connect()->prepare($consult);
            
            if ($params != null)
                foreach ($params as $key => $value)
                    $sentencia->bindValue($key, $value);

            
            return $sentencia->execute();
            
        }

        /**
         * [next_result description]
         * Sin funcionamiento
         */
        public static function next_result(){
            return;
            self::connect()->next_result();
        }


        /**
         * [query_assoc description]
         * @param  [TEXT]  $consult [consulta a ejecutar]
         * @param  [Array] $params  [parametros para la consulta]       
         * @return [bool]           [resultado de la consulta]
         */
        public static function query_assoc($consult, $params = null){

            $sentencia = self::connect()->prepare($consult);
            
            if ($params != null)
                foreach ($params as $key => $value)
                    $sentencia->bindValue($key, $value);

            
            if($sentencia->execute())
                return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }

        /**
         * [query_row description]
         * @param  [TEXT]  $consult [consulta a ejecutar]
         * @param  [Array] $params  [parametros para la consulta]       
         * @return [bool]           [resultado de la consulta]
         */
        public static function query_row($consult, $params = null){
            $sentencia = self::connect()->prepare($consult);
            
            if ($params != null)
                foreach ($params as $key => $value)
                    $sentencia->bindValue($key, $value);

            if($sentencia->execute())
                return $sentencia->fetchAll(PDO::FETCH_NUM);
        
        }

        /**
         * [query_object description]
         * @param  [TEXT]  $consult [consulta a ejecutar]
         * @param  [Array] $params  [parametros para la consulta]       
         * @return [bool]           [resultado de la consulta]
         */
        public static function query_object($consult, $params = null){         
            $sentencia = self::connect()->prepare($consult);
            
            if ($params != null)
                foreach ($params as $key => $value)
                    $sentencia->bindValue($key, $value);

            if($sentencia->execute())
                return $sentencia->fetchAll(PDO::FETCH_OBJ);
        
        }

        /**
         * [query_single_object description]
         * @param  [TEXT]  $consult [consulta a ejecutar]
         * @param  [Array] $params  [parametros para la consulta]       
         * @return [bool]           [resultado de la consulta]
         */
        public static function query_single_object($consult, $params = null){         
            $sentencia = self::connect()->prepare($consult);

            if ($params != null)
                foreach ($params as $key => $value)
                    $sentencia->bindValue($key, $value);

            if($sentencia->execute())
                return $sentencia->fetch(PDO::FETCH_OBJ);
        
        }

        public static function query_multi_rowset($consult, $params = null){
            $sentencia = self::connect()->prepare($consult);

            if ($params != null)
                foreach ($params as $key => $value)
                    $sentencia->bindValue($key, $value);
            $c = -1;
            $arr = array();
            if($sentencia->execute()) {
                do{
                    $c++;
                    $rowset = $sentencia->fetchAll(PDO::FETCH_OBJ);
                    if (!empty($rowset))
                        $arr[$c] = $rowset;
                } while ($sentencia->nextRowset());
                return $arr;
            }
        }

        /**
         * [__clone description]
         * Evita la clonación del objeto
         */
        final protected function __clone() {
        }

        /**
         * [__destructor description]
         */
        function __destructor(){
            self::$dbCon = null;
        }

     
    }



?>