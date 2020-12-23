<?php
    Class Permisos {

        public $bin;

        function __construct($posicion)
        {
            $start = (-1 * ($posicion * 2));
            $profile_permission = substr($_SESSION['permisos'], $start, 2);
            $this->bin = str_pad(base_convert($profile_permission, 16, 2), 8, '0', STR_PAD_LEFT);
        }

        public function ver(){
            return ($this->bin[7] == '1')?true:false;
        }
        public function crear(){
            return ($this->bin[6] == '1')?true:false;
        }
        public function actualizar(){
            return ($this->bin[5] == '1')?true:false;
        }
        public function borrar(){
            return ($this->bin[4] == '1')?true:false;
        }
        public function verPacientes(){
            $permisosPacientes = new permisos(3);
            return ($permisosPacientes->bin[3]);
        }
    }
?>
