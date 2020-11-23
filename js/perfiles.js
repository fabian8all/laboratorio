var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
	$('#bstablePerfiles').bootstrapTable({
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
			return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' perfiles';
		},
		formatRecordsPerPage: function (pageNumber) {
			return pageNumber + ' perfiles por página';
		},
		formatNoMatches: function () {
			return 'No se encontraron perfiles registradas';
		},
		formatLoadingMessage: function(){
			return 'Cargando lista de perfiles';
		}
	});
});

function formatPerfilesOptions(value, row, index){
	var options = "\
                <div class='dropup'> \
                    <button class='btn btn-circle btn-sm btn-outline-warning btnPerfilesEdit' data-idperfil='" + value + "' data-toggle='tooltip' data-placement='top' title='Editar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-edit fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                    <button class='btn btn-circle btn-sm btn-outline-danger btnPerfilesDel' data-idperfil='" + value + "' data-toggle='tooltip' data-placement='top' title='Eliminar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-trash fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                </div>";

	return options;
}



function ajaxGetPerfiles(params){

	$.ajax({
		type: "POST",
		url: "routes/routePerfiles.php",
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

$("#btnPerfilesAdd").click(function(){
	$("#frmPerfiles").trigger('reset');
	$("#hidPerfilesMode").val("new");
	$("#modalPerfiles").modal('show');
});

$(document).on('click','.btnPerfilesEdit',function(){
	id = $(this).data('idperfil');
	$.post('routes/routePerfiles.php',{info:id,action:'get'})
		.done(function(data){
			if(data != null){
				data =  $.parseJSON(data);
				$('#hidPerfilesMode').val('update');
				$('#hidPerfilesId').val(data.id);
				$('#txtPerfilesNombre').val(data.perfil);
				$("#modalPerfiles").modal('show');
			}else{
				customAlert("Error!", "No se encuentra la información del perfil");
			}
		})
		.fail(function(error){
			customAlert("Error!", ajaxError);
		})
});

$(document).on('click','.btnPerfilesDel',function(){
	id= $(this).data('idperfil');
	$.confirm({
		title: 'Atencion!',
		content: '¿Esta seguro que desea eliminar este perfil?',
		confirm: function(){
			$.post('routes/routePerfiles.php',{info: id,action: "Delete"},function(data){
				if(data == 'true')
					customAlert("Exito!", "El perfil ha sido eliminado");
				else
					customAlert("Error!", "Error al intentar eliminar el perfil");
				$('#bstablePerfiles').bootstrapTable('refresh');
			}).fail(function(error){
				customAlert("Error!", ajaxError);
			});
		},
		cancel: function(){
			console.log('false');
		}
	});
});

$("#btnPerfilesSave").click(function(){
	info =  {
		nombre: $("#txtPerfilesNombre").val(),
	}
	if ($('#hidPerfilesMode').val() == "new"){
		action="Add";
	}else if($('#hidPerfilesMode').val() == "update"){
		action="Update";
		info.id = $("#hidPerfilesId").val();
	}
	$('#btnPerfilesSave').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
	).prop('disabled',true);
	$.post("routes/routePerfiles.php",{info:info,action:action})
		.done(function(data){
			if(data){
				data = $.parseJSON(data);
				if(data.success){
					customAlert("Exito!", data.msg);
					$("#modalPerfiles").modal('hide');
					$('#bstablePerfiles').bootstrapTable('refresh');
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
			$('#btnPerfilesSave').html( '\
                <span class="fa fa-save"></span>\
                Guardar\
            ').prop('disabled',false);
		});
});

