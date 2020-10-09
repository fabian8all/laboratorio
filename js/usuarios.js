var ajaxError = "Ocurrió un error, intentelo mas tarde o pongase en contacto con el administrador";
var success   = "Acción realizada con exito";



	$(document).ready(function(){
		$('#select_ac_in').val(1);
		$('#buscar').val("");
		load_tabla();
	});


	$(document).on('change', '#select_ac_in', function(){
		load_tabla();
	});


	$(document).on('keyup', '#buscar', function(){
		load_tabla();
	});


	$(document).on('click', '#btn_nuevo', function(){
        resetForm('formUser');
        $('#modalUser .modal-title').html("Nuevo usurio");
        $('.btnModal').attr('id','btnAdd');
        $('#check_pass').parent().hide();
        $('#pass_cambio_fila').show();
        $('#modalUser').modal('show');
        load_perfiles();
        $('#div_alerta').slideUp();
        $('#action').val('create');
	});

	$(document).on('click', '#btnAdd', function(){
		if(	$('#txt_username').val() != "" &&	$('#txt_pass').val() != "" &&	$('#sel_perfil').val() != null){
			$.post('routes/routeUsuarios.php',serializeForm('formUser'),function(data){
				if(data == 'true'){
					customAlert("Felicidades!", success);
					$('#modalUser').modal('hide');
				}
				else
					if (data == 'false')
						customAlert("Atención!", 'El nombre de usuario ya esta en uso');
					else if (data == 0)
                    		customAlert("Atención!", 'Las contraseñas no coinciden');
						else
							customAlert("Error!", ajaxError);
				
				load_tabla();
			})
			.fail(function(error){
                customAlert("Error!", ajaxError);
            });
		}else{
			customAlert('Atención!', 'Debe llenar "Nombre de usuario", "Perfil" y "Contraseña" para poder guardar');
		}
	});


	$(document).on('click', '#btnEdit', function(){
        if(	$('#txt_username').val() != "" ){
            if ($('#check_pass').is(':checked')){
                $('#check_pass').val('cambiar');
            }else{
                $('#check_pass').val('no_cambiar');
            }
			$.post('routes/routeUsuarios.php', serializeForm('formUser'),function(data){
                if(data == 'true'){
                    customAlert("Felicidades!", success);
                    $('#modalUser').modal('hide');
                }else if (data == 0)
						customAlert("Atención!", 'Ocurrió un error al intentar cambiar la contraseña');
					else if (data == 1)
							customAlert("Atención!", 'Las contraseñas no coinciden');
						else if (data == 2)
								customAlert("Atención!", 'El campo de contraseña está vacío');
							else if (data == 3)
									customAlert("Atención!", 'El nombre de usuario ya está ocupado')
								else
									customAlert("Error!", ajaxError);

                load_tabla();
			})
			.fail(function(error){
                customAlert("Error!", ajaxError);
			});
		}else{
			customAlert('Atención!', 'El nombre de usuario es requerido');
		}
	});



	$('#check_pass').on('change',function(){
		if ($(this).is(':checked')){
            $('#pass_cambio_fila').show();
		}else{
            $('#pass_cambio_fila').hide();
		}
    });


	function editUser(id){
		resetForm('formUser');
		$('.btnModal').attr('id','btnEdit');
        $('#modalUser .modal-title').html("Editar usuario");
        $('#check_pass').parent().show();
        $('#pass_cambio_fila').hide();
		$('#modalUser').modal('show');
        load_perfiles();
		$('#action').val('update');

		$.post('routes/routeUsuarios.php',{info: id, action: 'get'},function(data){
            data = $.parseJSON(data);
            if(data != ""){
                $('#id').val(data.id);
                $('#txt_nombre').val(data.nombre);
                $('#txt_username').val(data.username);
                $('#sel_perfil').val(data.rol);
            }
		})
		.fail(function(error){
				customAlert("Error!", ajaxError);
		});
	}


	function reactivaUser(id){
		$.confirm({
            title: 'Atencion!',
            content: '¿Esta seguro que desea reactivar este cliente?',
            confirm: function(){
                $.post('routes/routeUsuarios.php',{info: id, action: 'reactiva'},function(data){
                    if(data == 'true')
                        customAlert("Felicidades!", success);
                    else
                        customAlert("Error!", ajaxError);

                    load_tabla();
                })
				.fail(function(error){
						customAlert("Error!", ajaxError);
				});
            },
            cancel: function(){
                console.log('false');
            }
        });
	}

	function bajaUser(id){
		$.confirm({
            title: 'Atencion!',
            content: '¿Esta seguro que desea dar de baja a este usuario?',
            confirm: function(){
                $.post('routes/routeUsuarios.php',{info: id, action: 'desactiva'},function(data){
                    if(data == 'true')
                        customAlert("Felicidades!", success);
                    else
                        customAlert("Error!", ajaxError);

                    $('#select_ac_in').val(2);
                    load_tabla();
				})
				.fail(function(error){
					customAlert("Error!", ajaxError);
				});
            },
            cancel: function(){
                console.log('false');
            }
        });
	}


	function load_tabla(){
		var option = $('#select_ac_in').val();
		var busca = $('#buscar').val();
		$.post('routes/routeUsuarios.php',{info: {status:option,busca:busca},action: "read"},function(data){
			if(data != ""){
				data = $.parseJSON(data);
				jQueryTable("tableContainer", data, 5, 800);
			}
			else{
				$('tbody').empty();
				customAlert("Atencion!", "No hay clientes para mostrar");
			}
		}).fail(function(error){
			customAlert("Error!", ajaxError);
		});
	}

	function load_perfiles(){
		$.post('routes/routeUsuarios.php',{action: "load_perfiles"},function(data){
			if(data != ""){
				data=$.parseJSON(data);
                $('#sel_perfil').empty()
                $('#sel_perfil').append('<option value="0" selected disabled>Seleccione un perfil</option>')

                $.each(data,function(value,perfil){
					$('#sel_perfil').append('<option value="'+value+'">'+perfil+'</option>')
				});
			}
			else{
				$('tbody').empty();
				customAlert("Atencion!", "Error al cargar los perfiles");
			}
		}).fail(function(error){
			customAlert("Error!", ajaxError);
		});
	}


	validaCampoLength("txt_nombre", 50);
	validaCampoLength("txt_username", 50);
	validaCampoLength("txt_pass", 30);

