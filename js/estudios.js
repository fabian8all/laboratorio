var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

    $(document).ready(function(){
        $('#bstableEstudios').bootstrapTable({
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
                return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' estudios';
            },
            formatRecordsPerPage: function (pageNumber) {
                return pageNumber + ' estudios por página';
            },
            formatNoMatches: function () {
                return 'No se encontraron estudios registradas';
            },
            formatLoadingMessage: function(){
                return 'Cargando lista de estudios';
            },
            formatSearch: function(){
                return 'Buscar';
            }
        });
    });

    function formatEstudiosOptions(value, row, index){
        var options = "\
            <div class='dropup'> \
                <button class='btn btn-circle btn-sm btn-outline-warning btnEstudiosEdit' data-idestudio='" + value + "' data-toggle='tooltip' data-placement='top' title='Editar' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-edit fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-circle btn-sm btn-outline-danger btnEstudiosDel' data-idestudio='" + value + "' data-toggle='tooltip' data-placement='top' title='Eliminar' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-trash fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

        return options;
    }

    function formatEstudiosPrecio(value, row, index){
        var formatted = "$"+parseFloat(value).toFixed(2);

        return formatted;
    }

    function ajaxGetEstudios(params){

        $.ajax({
            type: "POST",
            url: "routes/routeEstudios.php",
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
                    $('#txtEstudiosCostoM').val(data.costo_medico);
                    $('#txtEstudiosCostoE').val(data.costo_empresa);
                    $('#txtEstudiosCostoL4').val(data.costo_lista4);
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
                    data = $.parseJSON(data);
                    if(data.success)
                        customAlert("Exito!", data.msg);
                    else
                        customAlert("Error!", data.msg);
                    $('#bstableEstudios').bootstrapTable('refresh');
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
            costom: $("#txtEstudiosCostoM").val(),
            costoe: $("#txtEstudiosCostoE").val(),
            costol4: $("#txtEstudiosCostoL4").val(),
            muestra: $("#txtEstudiosMuestra").val(),
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
                data = $.parseJSON(data);
                if(data.success){
                    customAlert("Exito!", data.msg);
                    $("#modalEstudios").modal('hide');
                    $('#bstableEstudios').bootstrapTable('refresh');
                } else{
                    customAlert("Error!", data.msg);
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

$('#btnImportarPrecios').click(function(){
   $("#fileListaCSV").val('');
   $("#modImportarPrecios").modal('show');
});

$("#btnDescargarPlantilla").click(function(e){
    e.preventDefault();
    $.post('routes/routeEstudios.php',{info:{},action:'getListaPrecios'})
        .done(function(data)
        {
            data = $.parseJSON(data);
            if (data.success){
                var filename = 'listaPrecios.csv';
                var uri = '' +
                    'data:text/csv;charset=UTF-8,%EF%BB%BF' + encodeURIComponent(data.data);
                var downloadLink = document.createElement("a");
                downloadLink.href = uri;
                downloadLink.download = filename;

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }else{
                customAlert("Error!", data.msg);
            }
        })
        .fail(function(error){
            customAlert("Error!", error);
        });
});

$("#btnImportarListaCSV").click(function(e){
   e.preventDefault();
    $('#btnImportarListaCSV').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Cargando datos...'
    ).prop('disabled',true);
    if ($('#file_logo').val() != ""){

        var formData = new FormData();
        formData.append('action',"importListaPrecios");
        formData.append('listaCSV',document.getElementById('fileListaCSV').files[0]);

        $.ajax({
            type: "POST",
            dataType:"html",
            data: formData,
            url: "routes/routeEstudios.php",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){
                response = $.parseJSON(response);
                if (response.success){
                    customAlert("Exito!",response.msg);
                }else{
                    customAlert("Error!",response.msg);
                    console.log(response.errors);
                }
            },
            error: function(errors){
                customAlert("Error!",error)
            }
        });

    }else{
        customAlert("Error!","No hay un archivo seleccionado");
    }
    $('#btnImportarListaCSV').html( '\
            <span class="fa fa-save"></span>\
            Importar Lista\
        ').prop('disabled',false);

});
