<?php
    Class Permisos {

        public $bin;
        public $pos;

        function __construct($posicion)
        {
            $this->pos = $posicion;
            if ($posicion == 9){
                $posicion = 8;
            }
            $start = (-1 * ($posicion * 2));
            $profile_permission = substr($_SESSION['permisos'], $start, 2);
            $this->bin = str_pad(base_convert($profile_permission, 16, 2), 8, '0', STR_PAD_LEFT);
        }

        public function ver(){
            if ($this->pos == 9){
                $verPos = 4;
            }else{
                $verPos = 7;
            }
            return ($this->bin[$verPos] == '1')?true:false;
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
        public function verClientes(){
            $permisosClientes = new permisos(5);
            return ($permisosClientes->ver());
        }

    }
?>
