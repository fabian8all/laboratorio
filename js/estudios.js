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


    $("#btnEstudiosAdd").click(function(){
        $("#frmEstudios").trigger('reset');
        $("#hidEstudiosMode").val("new");
        $("#divCardEstudiosPruebas").html("");
        addClassPrueba('',0,0,1);
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
                if(data){
                    customAlert("Exito!", "La información se ha guardado con exito");
                    $("#modalEstudios").modal('hide');
                    $('#bstableEstudios').bootstrapTable('refresh');
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

