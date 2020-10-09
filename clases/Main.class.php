<?php  

	Class Main{

		public function DateTime(){
			$time = date('H:i:s', time());
			$date = date('d-m-Y');
			return array($time, $date);
		}

		public function getDate(){
			$dateTime = $this->DateTime();
			$fecha = explode('-', $dateTime[1]);
			// $fecha[2] = substr($fecha[2], 2, 3);
			$fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
			return $fecha;
		}

		public function getTime(){
			$dateTime = $this->DateTime();
			$hora = $dateTime[0];
			return $hora;
		}

		public function consumeAPI($url, $method, $info){
			
			$curl = curl_init();

			$headers = array('header: authorization');

	        switch ($method)
	        {
	            case "POST":
	                curl_setopt($curl, CURLOPT_POST, 1);

	                if ($info){
	                  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	                  curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
	                }


	                break;
	            case "PUT":
	                curl_setopt($curl, CURLOPT_PUT, 1);
	                break;
	            default:
	                if ($info)
	                    $url = sprintf("%s?%s", $url, http_build_query($info));
	        }

	        // Optional Authentication:
	        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	        // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

	        curl_setopt($curl, CURLOPT_URL, $url);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	        $result = curl_exec($curl);

	        curl_close($curl);

	        return $result;
		}

		public function getURL(){
			$url = $_SERVER['HTTP_REFERER'];
			$folders = explode('/', $url);
			$web = $_SERVER['HTTP_HOST'];
			for ($i = 3; $i < count($folders) - 1; $i++){
				$web .= "/".$folders[$i];
			}
			return $web;
		}

		public function log($texto){
			$myfile = fopen("log.txt", "a") or die("Unable to open file!");

			$txt = "
			---- ".$texto." ----- ";

			fwrite($myfile, $txt);
			fclose($myfile);
		}


		public function jsonToObject($info){
			$info = str_replace('\"', '"', $info);
			$info = json_decode($info);
			return $info[0];
		}

		public function normaliza($cadena){
		    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
		    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
		    $cadena = utf8_decode($cadena);
		    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
		    $cadena = strtolower($cadena);
		    return utf8_encode($cadena);
		}

		// public function getEstados($bandera){
		// 	if($bandera)
		// 		return json_encode($this->query_assoc("SELECT * FROM estados"));
		// 	else
		// 		return $this->query_assoc("SELECT * FROM estados");
		// }

		// public function getMunicipios($edo){
		// 	$consult = "SELECT idmunicipio, municipio 
		// 				FROM municipios WHERE idestado = $edo";
								
		// 	return json_encode($this->query_assoc($consult));
		// }

		public function enviarMail($mailTo, $nameTo, $cuerpo, $subject, $copia){
			// $page = 'http://localhost/volanteo/configTrabajo.php'; CAMBIAR ESTA VARIABLE POR SITIO DONDE SE ALOJA PROYECTO
			$msg = $cuerpo;
			
		    $bcc = "";
			$mailFrom = 'pruebacorreo2236@gmail.com';

			require_once("../plugins/PHPMailer-maste/PHPMailerAutoload.php");
			
			$mail = new PHPMailer();

			$mail->SMTPDebug = 0;

		    $mail->SetLanguage( 'es', '../PHPMailer-maste/includes/language/' );
		                    
		    $mail->From     = $mailFrom;   // Correo Electronico para SMTP 
		    $mail->FromName = 'Grupo Publicitario Heraldos'.$copia;
		    $mail->AddAddress($mailTo); // Dirección a la que llegaran los mensajes

		    if($bcc != "")
		    	$mail->AddBCC($bcc); // copia oculta

		    $mail->WordWrap = 50; 
		    $mail->IsHTML(true);     
		    $mail->CharSet = 'UTF-8';  
		    $mail->Subject  =  utf8_decode($subject);
		    $mail->Body     =  $msg;

			$mail->IsSMTP(); 
		    $mail->Host = "smtp.gmail.com";  // mail. o solo dominio - Servidor de 
		    $mail->Port = 587;
    		$mail->SMTPSecure = 'tls';
		    $mail->SMTPAuth = true; 
		    $mail->Username = $mailFrom;  // Correo Electrónico para SMTP correo@dominio
		    $mail->Password = "prueba2236"; // Contraseña para SMTP

		    if(!$mail->send())
		    	return false;
		    else
		    	return true;
		}

		public function estruct_pdf($ref,$regs){
            $html = "<html>
            <head>
                <style>
                    @page { margin: 80px 25px 50px 25px; }
                    header { margin: 0; position: fixed; top: -55px; left: 0px; right: 0px; background-color: #FFF; height: 50px;}
                    footer { position: fixed; bottom: -20px; left: 0px; right: 0px; height: 20px; }
                    p { page-break-after: always; }
                    p:last-child { page-break-after: never; }
                    
                    .logo { margin: 0 0 0 auto; height: 50px; }
                    .titulo {margin: 0; color:rgb(54, 128, 122);}
                    
                    table,th,td{border: 2px solid #FFF; mso-cellspacing: 0px;}
                    
                    table {margin: 0; width: 100%}
                    
                    
                    thead {background-color: #4fa6a0; color: #FFF;}
                    .sub_header {background-color: #6cc3bf; color: #FFF;}
                    th {font-weight: bolder; padding: 10px; }
                    
                    .impar {color:color:rgb(31,74,69); background: #b0fdff;}
                    .par{color:color:rgb(31,74,69); background: #c9f5ff;}
                    
                    .pagenum:before { content: counter(page);  }
                </style>
            </head>
            <body>
                <header><div class='logo'><img src='../images/logo.png' align='right' width='50' height='50'/></div></header>
                <footer><div align='right'>Página <span class='pagenum'></span></div></footer>
                <main>                         
                    <div class='titulo'><h2 class='titulo'>REPORTE DE " .strtoupper($ref).", FECHA: " .date("d-m-Y")."</h2></div> ";
            if (!empty($regs)){
                $html.= "<table cellspacing='0'>
                                    <thead>
                                        <tr>";

                foreach($regs[0] as $key=>$c){
                    if ($key=="sub"){
                        $html.="                <th align='center' colspan='$c[span]'>$c[name]</th>";
                    }else{
                        $html.="                <th align='center'>$key</th>";
                    }
                }
                $html.= "               </tr>
                                    </thead>
                                    <tbody>
                                           ";
                $l=0;
                foreach ($regs as $campos){
                    $l++;
                    $clase = ($l%2==0)?"par":"impar";
                    $html .="            <tr class='$clase'>";
                    foreach ($campos as $key=>$campo){
                        if ($key=="sub"){
                            if (is_array($campo['values'])){

                                foreach ($campo['values'][0] as $subkey=> $s){
                                    $html.="<td class='sub_header' align='center'>$subkey</td>";
                                }
                                $html.= "</tr>";

                                foreach ($campo['values'] as $sub){
                                    $l++;
                                    $clase = ($l%2==0)?"par":"impar";
                                    $html .="<tr class='$clase'>
                                                <td colspan=$campo[skip]'></td>";
                                    foreach ($sub as $val){
                                        $html.="            <td align='$val[align]'>$val[val]</td>";
                                    }
                                }
                            }else{
                                $html.="<td align='center' colspan='$campo[skip]'>$campo[values]</td>";
                            }
                        }else{
                            $html.="            <td align='$campo[align]'>$campo[val]</td>";
                        }
                    }

                    $html.="             </tr>";
                }
                $html .="            </tbody>
                                </table>";
            }else {
    $html.= "      <h3>--No hay $ref para mostrar--</h3>  ";
    }
$html .= "  </main>
                            
                        </body>
                    </html>";
            return $html;
        }

	}
	
?>