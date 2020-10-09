function showMap(latlng){
	window.open('https://www.google.es/maps?q='+latlng);
}

function serializeForm(idForm){
	var form = $('#'+idForm)[0];
	var action = '';
	var info = {};
	$.each(form,function(k,item){
		if (item.name == 'action')
			action = item.value;
		else
			if (item.name.slice(-2) == '[]'){
				var name =item.name.replace('[]','');
				if(item.checked){
					if (typeof(info[name])=='undefined')
						info[name]=[];
                	info[name].push(item.value);
				}
			}
			else
				info[item.name]=item.value;
	});

	info = JSON.stringify(info);

	return {'info': info, 'action': action};

}

function capitalize(str) {
	return str.replace(/^(.)|\s(.)/g, function($1){ 
		return $1.toUpperCase( ); 
	});

}

function toast(type, msg, time, position){

	$.dreamAlert({
	  'base_path' :   'source/',
	  'type'      :   type,
	  'message'   :   msg,
	  'summary'   :   '',
	  'icon'      :   '',
	  'position'  :   position, // or center
	  'message_id':   1,
	  'duration'  :   time,
	  'id'        :   0
	});

}

function toastLoader(){
	new PNotify({
        text: "Please Wait",
        type: 'info',
        icon: 'fa fa-spinner fa-spin',
        hide: false,
        buttons: {
            closer: false,
            sticker: false
        },
        opacity: .75,
        shadow: false,
        width: "170px"
    });
}




function resetForm(id){
	$('#'+id).each (function(){
	  this.reset();
	});

}

function customAlert(title, content){
	$.alert({
        title: title,
        content: content,
        theme: 'black',
        animation: 'left',
        closeAnimation: 'right',
        icon: 'fa fa-warning',
        keyboardEnabled: true,
        confirm: function(){
            // $.alert('Confirmed!'); // shorthand.
        }
    });
}

// validaCampoLength("txt_destino_viaje", 100)
function validaCampoLength(idCampo, length){

	var contenido = "";
	$(document).on('keyup', '#'+idCampo, function(event){ 					
																		
		var caracteres = $(this).val();									
																		
		if (caracteres.length > length){			
			customAlert("Error!", "No se pueden agregar mas de "+length+" caracteres");
			//toast('danger','Error',"No se pueden agregar mas de 100 caracteres", 4000)	
			$(this).val(contenido);
		}else{								
			contenido = $(this).val();
		}																					
																																							
	});	

}

// validaOnlyNumbers("txt_cont_d_unid_edit")
function validaOnlyNumbers(idCampo){

	var contenido = "";
	$(document).on('keyup', '#'+idCampo, function(event){ 					
																		
		var caracteres = $(this).val();									
																		
		if (caracteres.match(/[^1234567890]/g) ){
			customAlert("Error!", "Solo se admiten numeros");
			//toast1("Error!", "Solo se admiten numeros", 4000, "error")
			$(this).val(contenido);
		}else{								
			contenido = $(this).val();
		}																					
																		
																							
	});	

}

// validaPrecio("txt_cont_d_unid_edit")
function validaPrecio(idCampo){

	var contenido = "";
	$(document).on('keyup', '#'+idCampo, function(event){ 					
																		
		var caracteres = $(this).val();									
																		
		if (caracteres.match(/[^1234567890.]/g) ){
			customAlert("Error!", "Solo se admiten numeros");
			//toast1("Error!", "Solo se admiten numeros", 4000, "error")
			$(this).val(contenido);
		}else{								
			contenido = $(this).val();
		}																					
																		
																							
	});	

}


function validaOnlyLetters(idCampo){

	var contenido = "";
	$(document).on('keyup', '#'+idCampo, function(event){ 					
																		
		var caracteres = $(this).val();									
																		
		if (caracteres.match(/[^a-zA-Z_áéíóúñÁÉÍÓÚ. ]/g) ){
			toast1("Error!", "Solo se admiten letras", 4000, "error")	
			//toast1("Error!", "Solo se admiten numeros", 4000, "error")
			$(this).val(contenido);
		}else{								
			contenido = $(this).val();
		}																					
																		
																							
	});	

}

// validaCampoNum("txt_numero_unid", 2147483647)
function validaCampoNum(idCampo, val){

	var contenido = "";
	$(document).on('keyup', '#'+idCampo, function(event){ 					
																		
		var caracteres = $(this).val();									
																		
		if (caracteres > val){	
			toast1("Error!", "No se puede ingresar un valor tan grande, intente con uno mas pequeño", 4000, "error")								
			//toast('danger','Error',"No se puede ingresar un valor tan grande, intente con uno mas pequeño", 4000)	
			$(this).val(contenido);
		}else{								
			contenido = $(this).val();
		}																					
																																							
	});	

}


// ================= Validacion de Email =============================================================

var extenciones = [".aero", ".am", ".biz", ".cc", ".com", ".fm",
				   ".info", ".jobs", ".mobi", ".museum", ".name",
				   ".net", ".org", ".tel", ".tm", ".travel", ".tv",
				   ".ws",".edu",".web", ".com.ai", ".ai", ".aq", ".ag", 
				   ".com.ag", ".net.ag", ".org.ag", ".co.ag", ".com.an", 
				   ".com.ar", ".aw", ".com.bs", ".bs", ".com.bb", ".bb", 
				   ".bz", ".com.bz", ".net.bz", ".bo", ".com.bo", 
				   ".org.bo", ".net.bo", ".com.br", ".tv.br", ".net.br", 
				   ".org.br", ".ca", ".cl", ".com.co", ".net.co", ".nom.co", 
				   ".co", ".co.cr", ".cr", ".cu", ".com.cu", ".dm", ".ec", 
				   ".com.ec", ".info.ec", ".net.ec", ".fm.ec", ".com.sv", 
				   ".us", ".gs", ".gd", ".com.gp", ".gp", ".gy", ".ht", 
				   ".com.ht", ".net.ht", ".hn", ".com.hn", ".net.hn", ".tc", 
				   ".vg", ".com.vi", ".co.vi", ".com.jm", ".mx", ".com.mx", 
				   ".org.mx", ".ms", ".com.ni", ".co.ni", ".info.ni", 
				   ".web.ni", ".com.pa", ".com.py", ".net.py", ".edu.py", 
				   ".pe", ".com.pe", ".net.pe", ".pr", ".com.pr", ".net.pr", 
				   ".org.pr", ".biz.pr", ".info.pr", ".isla.pr", ".com.do", 
				   ".do", ".kn", ".lc", ".com.lc", ".co.lc", ".vc", ".com.vc", 
				   ".sr", ".tt", ".com.tt", ".co.tt", ".com.uy", ".net.uy", 
				   ".org.uy", ".com.ve", ".co.ve", ".info.ve", ".net.ve", 
				   ".org.ve", ".web.ve"];

// validarEmail($('#mail').val());
function validarEmail(email){

	var ext = "";
	var patronArroba = /[@]/;
	var patronPunto = /[.]/;
	var resultado = false;

	if (patronArroba.test(email)) { //reviso que exista una @

		var emailCompleto = email.split("@"); //divido donde halla una @

		// emailCompleto -> array(email, dominio);
		
		if (patronPunto.test(emailCompleto[1])) { //reviso que exista un punto dentro del dominio completo del email

			dominio = emailCompleto[1].split("."); //divido donde este el punto

			for (var i = 1; i < dominio.length; i++) { //recorro el array del dominio pero leyendo
														//solo apartir de la posision 1 (osea desde l extencion)
				ext = ext+"."+dominio[i]; //aplico los puntos correspondientes a la extencion
			};

			for (var i = 0; i < extenciones.length; i++) {
				if (extenciones[i] == ext) { //compruebo que la extencion sea valida comparandola con mi array de extenciones
					resultado = true;
				}
			}

		}		
		
	}
	//console.log(resultado);
	return resultado;
//http://www.webusable.com/ExtensionsTable.htms

}
