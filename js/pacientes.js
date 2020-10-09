var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

    $(document).ready(function(){
        load_pacientes_data();
    });

    function load_pacientes_data(){
        $.post("routes/routePacientes.php",{info:{},action:'getAll'})
            .done(function(data){
                if(data != null){
                    data = $.parseJSON(data);
                    if (!data){
                        $("#tablePacientes").html("<tr><td colspan='6'> -- No hay pacientes para mostrar --</td></tr>");
                        customAlert("Error!", "No hay pacientes");
                    }else{
                        load_tabla_pacientes(data);
                    }
                } else{
                    customAlert("Error!", ajaxError);
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            });
    }

    function load_tabla_pacientes(data) {
        table = "";
        $(data).each(function (key, val) {
            table += "<tr>\
                    <td>" + val.id + "</td>\
                    <td>" + val.nombre + "</td>\
                    <td>" + val.direccion + "</td>\
                    <td>" + val.telefono + "</td>\
                    <td>" + val.email + "</td>\
                    <td>\
                        <div class='form-inline'>\
                            <button class='btn btn-outline-warning btnPacientesEdit' data-idpaciente='" + val.id + "' data-toggle='tooltip' title='Editar'>\
                                <span class='fa fa-edit'></span>\
                            </button>\
                            <button class='btn btn-outline-danger btnPacientesDel' data-idpaciente='" + val.id + "' data-toggle='tooltip' title='Eliminar'>\
                                <span class='fa fa-trash-o'></span>\
                            </button>\
                        </div>\
                    </td>\
                 </tr>";
        });

        $("#tablePacientes").html(table);
    }

    $("#btnPacientesAdd").click(function(){
        $("#frmPacientes").trigger('reset');
        $("#hidPacientesMode").val("new");
        $("#modalPacientes").modal('show');
    });

    $(document).on('click','.btnPacientesEdit',function(){
        id = $(this).data('idpaciente');
        $.post('routes/routePacientes.php',{info:id,action:'get'})
            .done(function(data){
                if(data != null){
                    data =  $.parseJSON(data);
                    $('#hidPacientesMode').val('update');
                    $('#hidPacientesId').val(data.id);
                    $('#txtPacientesNombre').val(data.nombre);
                    $('#txtPacientesDireccion').val(data.direccion);
                    $('#txtPacientesTelefono').val(data.telefono);
                    $('#txtPacientesEmail').val(data.email);
                    $("#modalPacientes").modal('show');
                }else{
                    customAlert("Error!", "No se encuentra la información del paciente");
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            })
    });

    $(document).on('click','.btnPacientesDel',function(){
       id= $(this).data('idpaciente');
        $.confirm({
            title: 'Atencion!',
            content: '¿Esta seguro que desea eliminar este paciente?',
            confirm: function(){
                $.post('routes/routePacientes.php',{info: id,action: "Delete"},function(data){
                    if(data == 'true')
                        customAlert("Exito!", "El paciente ha sido eliminado");
                    else
                        customAlert("Error!", "Error al intentar eliminar al paciente");
                    load_pacientes_data()
                }).fail(function(error){
                    customAlert("Error!", ajaxError);
                });
            },
            cancel: function(){
                console.log('false');
            }
        });
    });

    $("#btnPacientesSave").click(function(){
        info =  {
            nombre: $("#txtPacientesNombre").val(),
            direccion: $("#txtPacientesDireccion").val(),
            telefono: $("#txtPacientesTelefono").val(),
            email: $("#txtPacientesEmail").val(),
        }
        if ($('#hidPacientesMode').val() == "new"){
            action="Add";
        }else if($('#hidPacientesMode').val() == "update"){
            action="Update";
            info.id = $("#hidPacientesId").val();
        }
        $('#btnPacientesSave').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
        ).prop('disabled',true);
        $.post("routes/routePacientes.php",{info:info,action:action})
        .done(function(data){
            if(data){
                customAlert("Exito!", "La información se ha guardado con exito");
                $("#modalPacientes").modal('hide');
                load_pacientes_data();
            } else{
                customAlert("Error!", "Ocurrió un error al intentar guardar la información");
            }
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })
        .always(function(){
            $('#btnPacientesSave').html( '\
                <span class="fa fa-save"></span>\
                Guardar\
            ').prop('disabled',false);
        });
    });

