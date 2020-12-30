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
		},
		formatSearch: function(){
			return 'Buscar';
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
				permisos = [];
				for (i = 7;i>=0;i--){
					permisos[i] = data.permisos.substr((i*2),2);
				}
				Pcotizacion  = hex2bin(permisos[7]).split("").reverse().join("");
				Presultados  = hex2bin(permisos[6]).split("").reverse().join("");
				Ppacientes 	= hex2bin(permisos[5]).split("").reverse().join("");
				Pestudios	= hex2bin(permisos[4]).split("").reverse().join("");
				Pclientes 	= hex2bin(permisos[3]).split("").reverse().join("");
				Pusuarios 	= hex2bin(permisos[2]).split("").reverse().join("");
				Pperfiles 	= hex2bin(permisos[1]).split("").reverse().join("");
				Pcortes 	= hex2bin(permisos[0]).split("").reverse().join("");

				for (i=7; i>=0; i--){
					val = Math.pow(2,i);

					if (Pcortes[i]=='1'){
						$('.chkPermisosCortes[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosCortes[value="'+val+'"]').prop('checked',false);
					}
					if (Pcotizacion[i]=='1'){
						$('.chkPermisosCotizacion[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosCotizacion[value="'+val+'"]').prop('checked',false);
					}
					if (Presultados[i]=='1'){
						$('.chkPermisosResultados[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosResultados[value="'+val+'"]').prop('checked',false);
					}
					if (Ppacientes[i]=='1'){
						$('.chkPermisosPacientes[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosPacientes[value="'+val+'"]').prop('checked',false);
					}
					if (Pestudios[i]=='1'){
						$('.chkPermisosEstudios[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosEstudios[value="'+val+'"]').prop('checked',false);
					}
					if (Pclientes[i]=='1'){
						$('.chkPermisosClientes[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosClientes[value="'+val+'"]').prop('checked',false);
					}
					if (Pusuarios[i]=='1'){
						$('.chkPermisosUsuarios[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosUsuarios[value="'+val+'"]').prop('checked',false);
					}
					if (Pperfiles[i]=='1'){
						$('.chkPermisosPerfiles[value="'+val+'"]').prop('checked',true);
					}else{
						$('.chkPermisosPerfiles[value="'+val+'"]').prop('checked',false);
					}
				}

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

function hex2bin(hex){
	return ("00000000" + (parseInt(hex, 16)).toString(2)).substr(-8);

}

$(document).on('click','.btnPerfilesDel',function(){
	id= $(this).data('idperfil');
	$.confirm({
		title: 'Atencion!',
		content: '¿Esta seguro que desea eliminar este perfil?',
		confirm: function(){
			$.post('routes/routePerfiles.php',{info: id,action: "Delete"},function(data){
				data = $.parseJSON(data);
				if(data.success)
					customAlert("Exito!", data.msg);
				else
					customAlert("Error!", data.msg);
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
	permisosCortes		= 0;
    permisosCotizacion  = 0;
    permisosResultados  = 0;
    permisosPacientes   = 0;
    permisosEstudios    = 0;
    permisosClientes    = 0;
    permisosUsuarios    = 0;
    permisosPerfiles    = 0;

	$('.chkPermisosCortes').each(function(k,v){
		permisosCortes += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
	});
    $('.chkPermisosCotizacion').each(function(k,v){
        permisosCotizacion += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
    });
    $('.chkPermisosResultados').each(function(k,v){
        permisosResultados += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
    });
    $('.chkPermisosPacientes').each(function(k,v){
        permisosPacientes += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
    });
    $('.chkPermisosEstudios').each(function(k,v){
        permisosEstudios += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
    });
    $('.chkPermisosClientes').each(function(k,v){
        permisosClientes += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
    });
    $('.chkPermisosUsuarios').each(function(k,v){
        permisosUsuarios += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
    });
    $('.chkPermisosPerfiles').each(function(k,v){
        permisosPerfiles += ($(v).prop('checked')) ? parseInt($(v).val()) : 0;
    });

	info =  {
		nombre: $("#txtPerfilesNombre").val(),
        permisos: {
			cortes 		: permisosCortes,
		    cotizacion  : permisosCotizacion,
            resultados  : permisosResultados,
            pacientes   : permisosPacientes,
            estudios    : permisosEstudios,
            clientes    : permisosClientes,
            usuarios    : permisosUsuarios,
            perfiles    : permisosPerfiles
        }
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

