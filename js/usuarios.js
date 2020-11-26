var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
	$('#bstableUsuarios').bootstrapTable({
		queryParams: function (p) {
			return {
				search          : p.search,
				limit           : p.limit,
				offset          : p.offset,
				sort            : p.sort,
				order           : p.order,
			};
		},
		formatShowingRows: function (pageFrom, pageTo, totalRows) {
			return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' usuarios';
		},
		formatRecordsPerPage: function (pageNumber) {
			return pageNumber + ' usuarios por página';
		},
		formatNoMatches: function () {
			return 'No se encontraron usuarios registradas';
		},
		formatLoadingMessage: function(){
			return 'Cargando lista de usuarios';
		}
	});

	$.post('routes/routePerfiles.php',{info: {},action:'getAll'})
		.done(function(data) {
			if (data) {
				data = $.parseJSON(data);
				options = "<option value='' selected disabled>Seleccionar perfil</option>";
				$(data).each(function(k,v){
					options+="<option value='"+v.id+"'>"+v.perfil+"</option>";
				});
				$('#selUsuariosPerfil').html(options);
			}
		});

});

function formatUsuariosOptions(value, row, index){
	var options = "\
                <div class='dropup'> \
                    <button class='btn btn-circle btn-sm btn-outline-warning btnUsuariosEdit' data-idusuario='" + value + "' data-toggle='tooltip' data-placement='top' title='Editar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-edit fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                    <button class='btn btn-circle btn-sm btn-outline-danger btnUsuariosDel' data-idusuario='" + value + "' data-toggle='tooltip' data-placement='top' title='Eliminar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-trash fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                </div>";

	return options;
}



function ajaxGetUsuarios(params){

	$.ajax({
		type: "POST",
		url: "routes/routeUsuarios.php",
		data: {info:params.data,action:'BSTableData'},
		dataType: "json",
		success: function (data) {
			console.log(data);
			params.success({
				"total": data.count,
				"rows" : data.rows
			})
		},
		error: function (er) {
			params.error(er);
		}
	});
}

$("#btnUsuariosAdd").click(function(){
	$("#frmUsuarios").trigger('reset');
	$("#hidUsuariosMode").val("new");
	$("#divUsuariosChkPass").hide();
	$('#divUsuariosChgPass').show();
	$("#modalUsuarios").modal('show');
});

$(document).on('click','.btnUsuariosEdit',function(){
	id = $(this).data('idusuario');
	$.post('routes/routeUsuarios.php',{info:id,action:'get'})
		.done(function(data){
			if(data != null){
				data =  $.parseJSON(data);
				console.log(data);
				$('#hidUsuariosMode').val('update');
				$('#hidUsuariosId').val(data.id);
				$('#txtUsuariosNombre').val(data.nombre);
				$('#txtUsuariosUser').val(data.username).prop('disabled',true);
				$('#txtUsuariosEmail').val(data.email);
				$('#selUsuariosPerfil').val(data.perfil);
				$('#chkUsuariosChgPass').prop('checked',false);
				$('#divUsuariosChgPass').hide();
				$('#txtUsuariosPass1').val('');
				$('#txtUsuariosPass2').val('');
				$("#modalUsuarios").modal('show');
			}else{
				customAlert("Error!", "No se encuentra la información del usuario");
			}
		})
		.fail(function(error){
			customAlert("Error!", ajaxError);
		})
});


$(document).on('click','.btnUsuariosDel',function(){
	id= $(this).data('idusuario');
	$.confirm({
		title: 'Atencion!',
		content: '¿Esta seguro que desea eliminar este usuario?',
		confirm: function(){
			$.post('routes/routeUsuarios.php',{info: id,action: "Delete"},function(data){
				data = $.parseJSON(data);
				if(data.success)
					customAlert("Exito!", data.msg);
				else
					customAlert("Error!", data.msg);
				$('#bstableUsuarios').bootstrapTable('refresh');
			}).fail(function(error){
				customAlert("Error!", ajaxError);
			});
		},
		cancel: function(){
			console.log('false');
		}
	});
});

$("#btnUsuariosSave").click(function(){
	info =  {
		nombre: $("#txtUsuariosNombre").val(),
		username: $("#txtUsuariosUser").val(),
		email: $("#txtUsuariosEmail").val(),
		perfil: $("#selUsuariosPerfil").val(),
		chkpass: $("#chkUsuariosChgPass").val(),
		pass1: $("#txtUsuariosPass1").val(),
		pass2: $("#txtUsuariosPass2").val(),
	}
	if ($('#hidUsuariosMode').val() == "new"){
		action="Add";
	}else if($('#hidUsuariosMode').val() == "update"){
		action="Update";
		info.id = $("#hidUsuariosId").val();
	}
	$('#btnUsuariosSave').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
	).prop('disabled',true);
	$.post("routes/routeUsuarios.php",{info:info,action:action})
		.done(function(data){
			if(data){
				data = $.parseJSON(data);
				if(data.success){
					customAlert("Exito!", data.msg);
					$("#modalUsuarios").modal('hide');
					$('#bstableUsuarios').bootstrapTable('refresh');
				}else{
					customAlert("Error!", data.msg);
				}
			} else{
				customAlert("Error!", "Ocurrió un error al intentar guardar la información");
			}
		})
		.fail(function(error){
			customAlert("Error!", ajaxError);
		})
		.always(function(){
			$('#btnUsuariosSave').html( '\
                <span class="fa fa-save"></span>\
                Guardar\
            ').prop('disabled',false);
		});
});

