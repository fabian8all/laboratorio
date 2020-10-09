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


    }


?>
