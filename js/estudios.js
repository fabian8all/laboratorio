var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

    $(document).ready(function(){
        load_estudios_data();
    });

    function load_estudios_data(){
        $.post("routes/routeEstudios.php",{info:{},action:'getAll'})
            .done(function(data){
                if(data != null){
                    data = $.parseJSON(data);
                    if (!data){
                        $("#tableEstudios").html("<tr><td colspan='5'> -- No hay estudios para mostrar --</td></tr>");
                        customAlert("Error!", "No hay estudios");
                    }else{
                        load_tabla_estudios(data);
                    }
                } else{
                    customAlert("Error!", ajaxError);
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            });
    }

    function load_tabla_estudios(data) {
        table = "";
        $(data).each(function (key, val) {
            table += "<tr>\
                    <td>" + val.codigo + "</td>\
                    <td>" + val.nombre + "</td>\
                    <td> -- </td>\
                    <td>" + val.costo + "</td>\
                    <td>\
                        <div class='form-inline'>\
                            <button class='btn btn-outline-warning btnEstudiosEdit' data-idestudio='" + val.id + "' data-toggle='tooltip' title='Editar'>\
                                <span class='fa fa-edit'></span>\
                            </button>\
                            <button class='btn btn-outline-danger btnEstudiosDel' data-idestudio='" + val.id + "' data-toggle='tooltip' title='Eliminar'>\
                                <span class='fa fa-trash-o'></span>\
                            </button>\
                        </div>\
                    </td>\
                 </tr>";
        });
        $("#tableEstudios").html(table);
    }

    $("#btnEstudiosAdd").click(function(){
        $("#frmEstudios").trigger('reset');
        $("#hidEstudiosMode").val("new");
        $("#modalEstudios").modal('show');
    });

    $(document).on('click','.btnEstudiosEdit',function(){
        id = $(this).data('idestudio');
        $.post('routes/routeEstudios.php',{info:id,action:'get'})
            .done(function(data){
                if(data != null){
                    data =  $.parseJSON(data);
                    $('#hidEstudiosMode').val('update');
                    $('#hidEstudiosId').val(data.id);
                    $('#txtEstudiosCode').val(data.codigo);
                    $('#txtEstudiosNombre').val(data.nombre);
                    $('#txtEstudiosTiempo').val(data.tiempo);
                    $('#txtEstudiosCosto').val(data.costo);
                    $('#txtEstudiosMuestra').val(data.muestra);
                    $("#modalEstudios").modal('show');
                }else{
                    customAlert("Error!", "No se encuentra la información del estudio");
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            })
    });

    $(document).on('click','.btnEstudiosDel',function(){
       id= $(this).data('idestudio');
        $.confirm({
            title: 'Atencion!',
            content: '¿Esta seguro que desea eliminar este estudio?',
            confirm: function(){
                $.post('routes/routeEstudios.php',{info: id,action: "Delete"},function(data){
                    if(data == 'true')
                        customAlert("Exito!", "El estudio ha sido eliminado");
                    else
                        customAlert("Error!", "Error al intentar eliminar el estudio");
                    load_estudios_data()
                }).fail(function(error){
                    customAlert("Error!", ajaxError);
                });
            },
            cancel: function(){
                console.log('false');
            }
        });
    });

    $("#btnEstudiosSave").click(function(){
        info =  {
            codigo: $("#txtEstudiosCode").val(),
            nombre: $("#txtEstudiosNombre").val(),
            categoria: $("#selEstudiosCategoria").val(),
            tiempo: $("#txtEstudiosTiempo").val(),
            costo: $("#txtEstudiosCosto").val(),
            muestra: $("#txtEstudiosMuestra").val()
        }
        if ($('#hidEstudiosMode').val() == "new"){
            action="Add";
        }else if($('#hidEstudiosMode').val() == "update"){
            action="Update";
            info.id = $("#hidEstudiosId").val();
        }
        $('#btnEstudiosSave').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
        ).prop('disabled',true);
        $.post("routes/routeEstudios.php",{info:info,action:action})
            .done(function(data){
                if(data){
                    customAlert("Exito!", "La información se ha guardado con exito");
                    $("#modalEstudios").modal('hide');
                    load_estudios_data();
                } else{
                    customAlert("Error!", "Ocurrió un error al intentar guardar la información");
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            })
            .always(function(){
                $('#btnEstudiosSave').html( '\
                    <span class="fa fa-save"></span>\
                    Guardar\
                ').prop('disabled',false);
            });
    });

