
var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";
var validapass	  = "Las contraseñas no coinciden";
var validaCampos  = "Debe llenar todos los campos para poder guardar";
var validaAccess  = "Falta nombre de usuario o contraseña";
var access_denied = "Datos incorrectos, vuelve a intentarlo.";

$(document).on('click', '#btn_login', function(event){
	event.preventDefault();


	var info = {username: $('#user').val(), password: $('#pass').val()}

	if (info.user == "" || info.password == "")
		customAlert("Error!", validaAccess);
	else{
		$.ajax({
			url:'routes/routeUsuarios.php',
			type:'POST',
			data: {info: info, action: 'auth'},
			dataType:'JSON',
			error: function(error){
				customAlert("Error!", ajaxError);
			},
			success: function(data) {
				if (data.logged) {
					window.location = 'inicio.php';
				} else {
					$('#password').val("");
					customAlert("Atención!", data.msg);
				}
			}
		}); //fin ajax

	}
})

