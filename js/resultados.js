var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
    $('#bstableResultsPM').bootstrapTable({
        queryParams: function (p) {
            return {
                search          : p.search,
                limit           : p.limit,
                offset          : p.offset,
                sort            : p.sort,
                order           : p.order,
                status          : 0
            };
        },
        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' solicitudes';
        },
        formatRecordsPerPage: function (pageNumber) {
            return pageNumber + ' solicitudes por página';
        },
        formatNoMatches: function () {
            return 'No se encontraron solicitudes registradas';
        }
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        switch (e.target.id){
            case 'nav-pendienteMuestra-tab':
                $('#bstableResultsPM').bootstrapTable('refresh');
                break;
            case 'nav-enProceso-tab':
                $('#bstableResultsEP').bootstrapTable({
                    queryParams: function (p) {
                        return {
                            search          : p.search,
                            limit           : p.limit,
                            offset          : p.offset,
                            sort            : p.sort,
                            order           : p.order,
                            status          : 1
                        };
                    },
                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' solicitudes';
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + ' solicitudes por página';
                    },
                    formatNoMatches: function () {
                        return 'No se encontraron solicitudes registradas';
                    }
                }).bootstrapTable('refresh');
                break;
            case 'nav-pendientePago-tab':
                $('#bstableResultsPP').bootstrapTable({
                    queryParams: function (p) {
                        return {
                            search          : p.search,
                            limit           : p.limit,
                            offset          : p.offset,
                            sort            : p.sort,
                            order           : p.order,
                            status          : 2
                        };
                    },
                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' solicitudes';
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + ' solicitudes por página';
                    },
                    formatNoMatches: function () {
                        return 'No se encontraron solicitudes registradas';
                    }
                }).bootstrapTable('refresh');
                break;
            case 'nav-finalizado-tab':
                $('#bstableResultsF').bootstrapTable({
                    queryParams: function (p) {
                        return {
                            search          : p.search,
                            limit           : p.limit,
                            offset          : p.offset,
                            sort            : p.sort,
                            order           : p.order,
                            status          : 3
                        };
                    },
                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' solicitudes';
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + ' solicitudes por página';
                    },
                    formatNoMatches: function () {
                        return 'No se encontraron solicitudes registradas';
                    }
                }).bootstrapTable('refresh');
                break;
        }
    });
});

function formatResultsPMOptions(value, row, index){
    var options = "\
            <div class='dropup'> \
                <button class='btn btn-info btn-sm btnDetalles' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Detalles' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-list fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-success btn-sm btnTomarMuestra' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Tomar muestra' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-eye-dropper fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

    return options;
}

function formatResultsEPOptions(value, row, index){
    var options = "\
            <div class='dropup'> \
                <button class='btn btn-info btn-sm btnDetalles' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Detalles' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-list fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-success btn-sm btnSubirResultados' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Subir resultados' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-upload fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

    return options;
}

function formatResultsPPOptions(value, row, index){
    var options = "\
            <div class='dropup'> \
                <button class='btn btn-info btn-sm btnDetalles' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Detalles' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-list fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-warning btn-sm btnGuardarPago' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Guardar pago' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-cash-register fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-primary btn-sm btnDescargarResultados' data-filename='" + row.resultados + "' data-toggle='tooltip' data-placement='top' title='Descargar resultados' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-download fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

    return options;
}

function formatResultsFOptions(value, row, index){
    console.log(row);
    var options = "\
            <div class='dropup'> \
                <button class='btn btn-info btn-sm btnDetalles' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Detalles' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-list fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-primary btn-sm btnDescargarResultados' data-filename='" + row.resultados + "' data-toggle='tooltip' data-placement='top' title='Descargar resultados' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-download fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

    return options;
}

function ajaxGetResults(params){
    $.ajax({
        type: "POST",
        url: "routes/routeResultados.php",
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

$(document).on('click','.btnDetalles',function(){
    id=$(this).data('idresult');
    $.post("routes/routeResultados.php",{info:id,action:'get'})
        .done(function(data){
            data =  $.parseJSON(data);
            if(data){
                estudios = "";
                costo = 0;
                $(data.estudios).each(function(k,v){
                    estudios += "\
                        <li class='list-group-item'>"+v.estudio+"</li>\
                    ";
                });
                $('#listaEstudios').html(estudios);

                pagado = $.parseJSON(data.pagado);
                lblPagado = "\
                    <div class='row'>\
                        <div class='col-12'>";
                lblPagado+=(pagado.completo)
                                ?"<span class='badge badge-success'>pagado</span>"
                                :"<span class='badge badge-warning'>pendiente</span>";
                lblPagado +="\
                        </div>\
                        <div class='col-12'>\
                            <table class='table table-borderless table-responsive table-striped'>\
                                <thead>\
                                    <tr>\
                                        <th>PAGOS</th>\
                                        <th>FECHA</th>\
                                    </tr>\
                                </thead>\
                                <tbody>";
                                $(pagado.pagos).each(function(k,v){
                                    if(parseFloat(v.cantidad) > 0){
                                        lblPagado += "\
                                            <tr>\
                                                <td>$"+parseFloat(v.cantidad).toFixed(2)+"</td>\
                                                <td>"+v.fecha+"</td>\
                                            </tr>\
                                        ";
                                    }
                                });
                    lblPagado += "\
                                </tbody>\
                            </table>\
                        </div>\
                    </div>\
                ";

                $('#lblCosto').html("$"+parseFloat(data.costo).toFixed(2));
                $('#lblDescuento').html("%"+parseFloat(data.descuento).toFixed(2));
                $('#lblFechaSol').html(data.fechaSolicitud);
                $('#lblFechaMuestra').html(data.fechaMuestra);
                $('#lblPagado').html(lblPagado);
                $('#lblFechaEntrega').html(data.fechaEntrega);
                $('#lblAnalista').html(data.analista);

                $('#modalDetalles').modal('show');

            } else{
                customAlert("Error!", "Ocurrió un error al intentar obtener la información");
            }
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })
});

$(document).on('click','.btnSubirResultados',function(){
    $('#resultsFileForm').trigger('reset');
    $('#hidSRSolicitudId').val($(this).data('idresult'));
    $('#modalSubirResultados').modal('show');
});

$('#btnUploadResults').click(function(){
    $(this).html( '\
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
            Guardando...'
    ).prop('disabled',true);
    if ($('#fileResultados').val() != ""){
        $('body').append('\
            <div id="divIframeUpload">\
                <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe> \
            </div>\
        ');

        $("#resultsFileForm").submit();
    }
});

function UploadResults(success){
    if (success != 0){
        $('#hidSRFileName').val(success);
    }
    else {
        customAlert("Error!", "Ocurrió un error al subir el archivo");
    }


    info = {
        id: $('#hidSRSolicitudId').val(),
        file: success,
    }
    $.post("routes/routeResultados.php",{info,action:'uploadFile'}, function (data) {
        if(data!='false'){
            $('#modalSubirResultados').modal('hide');
            $('#bstableResultsEP').bootstrapTable('refresh');
            customAlert("Exito!", "Los resultados han sido cargados");
        }else{

        }
    });

    $('#divIframeUpload').remove();
    return true;
}

$(document).on('click','.btnDescargarResultados',function(){
    file = $(this).data('filename');

        window.open('resources/resultsFiles/'+file);
});

$(document).on('click','.btnGuardarPago',function(){
    id=$(this).data('idresult');
    $.post("routes/routeResultados.php",{info:id,action:'get'})
        .done(function(data){
            data =  $.parseJSON(data);
            pagado = $.parseJSON(data.pagado);
            anticipo = 0;
            $(pagado.pagos).each(function(k,v){
                anticipo+=v.cantidad;
            });
            APagar = data.costo - anticipo;
            if(data){
                $('#lblCostoTotal').html("$"+parseFloat(data.costo).toFixed(2));
                $('#lblAnticipo').html("$"+parseFloat(anticipo).toFixed(2));
                $('#lblTotalAPagar').html("$"+parseFloat(APagar).toFixed(2));
                $('#txtPago').val('');
                $('#hidPagoIdSolicitud').val(id);
                $('#modAgregarPago').modal('show');
            } else{
                customAlert("Error!", "Ocurrió un error al intentar obtener la información");
            }
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })
});

$('#btnPagoSubmit').click(function(){
    info = {
        id      : $("#hidPagoIdSolicitud").val(),
        pago    : $("#txtPago").val()
    }

    $('#btnPagoSubmit').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
    ).prop('disabled',true);

    $.post("routes/routeResultados.php",{info:info,action:"Pagar"})
        .done(function(data){
            data =  $.parseJSON(data);
            if(data.success){
                customAlert("Exito!", data.msg);
                $("#txtPago").val('');
                $("#hidPagoIdSolicitud").val('');
                $('#modAgregarPago').modal('hide');
                $('#bstableResultsPP').bootstrapTable('refresh');
            } else{
                customAlert("Error!", data.msg);
            }
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })
        .always(function(){
            $('#btnPagoSubmit').html( '\
                    <span class="fa fa-money"></span>\
                    Guardar pago\
                ').prop('disabled',false);
        });

});
