var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

    $(document).ready(function(){
        $('#bstablePacientes').bootstrapTable({
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
                return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' pacientes';
            },
            formatRecordsPerPage: function (pageNumber) {
                return pageNumber + ' pacientes por página';
            },
            formatNoMatches: function () {
                return 'No se encontraron pacientes registradas';
            },
            formatLoadingMessage: function(){
                return 'Cargando lista de pacientes';
            },
            formatSearch: function(){
                return 'Buscar';
            }
        });
    });

    function formatPacientesOptions(value, row, index){
        var options = "\
                <div class='dropup'> \
                    <button class='btn btn-circle btn-sm btn-outline-warning btnPacientesEdit' data-idpaciente='" + value + "' data-toggle='tooltip' data-placement='top' title='Editar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-edit fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                    <button class='btn btn-circle btn-sm btn-outline-danger btnPacientesDel' data-idpaciente='" + value + "' data-toggle='tooltip' data-placement='top' title='Eliminar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-trash fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                </div>";

        return options;
    }

    function ajaxGetPacientes(params){

        $.ajax({
            type: "POST",
            url: "routes/routePacientes.php",
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
                    $('#selPacientesGenero').val(data.genero);
                    $('#txtPacientesFechaNac').val(data.fechaNacInput);
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
                    data = $.parseJSON(data);
                    if(data.success){
                        customAlert("Exito!", data.msg);
                        $('#bstablePacientes').bootstrapTable("refresh");
                    }
                    else
                        customAlert("Error!", data.msg);
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
            genero: $("#selPacientesGenero").val(),
            fechaNac: $("#txtPacientesFechaNac").val(),
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
            data = $.parseJSON(data)
            if(data.success){
                customAlert("Exito!", data.msg);
                $("#modalPacientes").modal('hide');
                $('#bstablePacientes').bootstrapTable("refresh");
            } else{
                customAlert("Error!", data.msg);
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

