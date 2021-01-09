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
        },
        formatSearch: function(){
            return 'Buscar';
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
                    },
                    formatSearch: function(){
                        return 'Buscar';
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
                    },
                    formatSearch: function(){
                        return 'Buscar';
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
                    },
                    formatSearch: function(){
                        return 'Buscar';
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
                <button class='btn btn-danger btn-sm btnCancelarSolicitud' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Cancelar Solicitud' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-times-circle fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
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
                <button class='btn btn-danger btn-sm btnCancelarSolicitud' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Cancelar Solicitud' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-times-circle fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

    return options;
}

function formatResultsPPOptions(value, row, index){
    disabled = (row.pagaCliente == '1') ? "disabled":"";
    var options = "\
            <div class='dropup'> \
                <button class='btn btn-info btn-sm btnDetalles' data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Detalles' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-list fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-warning btn-sm btnGuardarPago' "+disabled+" data-idresult='" + value + "' data-toggle='tooltip' data-placement='top' title='Guardar pago' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-cash-register fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-primary btn-sm btnDescargarResultados' data-filename='" + row.resultados + "' data-toggle='tooltip' data-placement='top' title='Descargar resultados' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-download fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

    return options;
}

function formatResultsFOptions(value, row, index){
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

$(document).on('click','.btnTomarMuestra',function(){
    id=$(this).data('idresult');
    $.confirm({
        title: 'Atencion!',
        content: '¿Muestra tomada?',
        confirm: function(){
            $.post("routes/routeResultados.php",{info:id,action:'tomarMuestra'})
                .done(function(data){
                    data =  $.parseJSON(data);
                    if(data.success){
                        customAlert("Exito!", data.msg);
                        $('#bstableResultsPM').bootstrapTable('refresh');
                        refreshAlerts();
                    } else{
                        customAlert("Error!", data.msg);
                    }
                })
                .fail(function(error){
                    customAlert("Error!", ajaxError);
                })

        },
        cancel: function(){
            console.log('false');
        }
    });
});

$(document).on('click','.btnSubirResultados',function(){
    $('#resultsFileForm').trigger('reset');
    $('#hidSRSolicitudId').val($(this).data('idresult'));
    $('#modalSubirResultados').modal('show');
});

$('#btnUploadResults').click(function(){
    if ($('#fileResultados').val() != ""){
        $('#btnUploadResults').html( '\
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
            Guardando...'
        ).prop('disabled',true);

        $('body').append('\
            <div id="divIframeUpload">\
                <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe> \
            </div>\
        ');

        $("#resultsFileForm").submit();
    }else{
        customAlert("Error!","No se ha seleccionado el archivo");
    }

});

function UploadResults(results){
        results = $.parseJSON(results)
    if (results.success){
        $('#hidSRFileName').val(results.data);


        info = {
            id: $('#hidSRSolicitudId').val(),
            file: results.data,
        }
        $.post("routes/routeResultados.php",{info,action:'uploadFile'})
            .done(function (data) {
                if(data!='false'){
                    $('#modalSubirResultados').modal('hide');
                    $('#bstableResultsEP').bootstrapTable('refresh');
                    customAlert("Exito!", "Los resultados han sido cargados");
                    refreshAlerts();
                }else{

                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            })
            .always(function(){
                $('#btnUploadResults').html( '\
                    <span class="fa fa-save"  aria-hidden="true"></span> \
                    Subir Resultados'
                ).prop('disabled',false);

            })
    }else {
        $('#btnUploadResults').html( '\
                    <span class="fa fa-save"  aria-hidden="true"></span> \
                    Subir Resultados'
        ).prop('disabled',false);
        customAlert("Error!", results.msg);
    }
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
            anticipo = 0.0;
            $(data.pagos).each(function(k,v){
                anticipo+=parseFloat(v.cantidad);
            });
            APagar = data.costo - anticipo;
            if(data){
                $('#lblCostoTotal').html("$"+parseFloat(data.costo).toFixed(2));
                $('#lblAnticipo').html("$"+parseFloat(anticipo).toFixed(2));
                $('#lblTotalAPagar').html("$"+parseFloat(APagar).toFixed(2));
                $('#txtPago').val('');
                $('#txtPagaCon').val('0.00');
                $('#lblCambio').html('$0.00');
                $('#txtReferenciaAnticipo').val('');
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
        id          : $("#hidPagoIdSolicitud").val(),
        pago        : $("#txtPago").val(),
        formaPago   : $("#selFormaPago").val(),
        referencia  : $("#txtReferenciaAnticipo").val()
    }
    total = Number($('#lblTotalAPagar').html().replace(/[^0-9\.]+/g,""))

    if (parseFloat(info.pago)>total){
        customAlert('Error!','El monto del pago es mayor que el total a pagar');
    }else {
        if (info.formaPago == "" || info.formaPago == null) {
            customAlert('Error!', 'No se ha especificado la forma de pago');
        } else {


            $('#btnPagoSubmit').html('\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
                Guardando...'
            ).prop('disabled', true);

            $.post("routes/routeResultados.php", {info: info, action: "Pagar"})
                .done(function (data) {
                    data = $.parseJSON(data);
                    if (data.success) {
                        customAlert("Exito!", data.msg);
                        $("#txtPago").val('');
                        $("#hidPagoIdSolicitud").val('');
                        $('#selFormaPago').val('');
                        $('#modAgregarPago').modal('hide');
                        $('#bstableResultsPP').bootstrapTable('refresh');
                        refreshAlerts();
                    } else {
                        customAlert("Error!", data.msg);
                    }
                })
                .fail(function (error) {
                    customAlert("Error!", ajaxError);
                })
                .always(function () {
                    $('#btnPagoSubmit').html('\
                            <span class="fa fa-money"></span>\
                            Guardar pago\
                        ').prop('disabled', false);
                });
        }
    }
});

$(document).on('click','.btnCancelarSolicitud',function(){
    id = $(this).data('idresult');
    $.confirm({
        title: 'Atencion!',
        content: '¿Cancelar la realización de los estudios?',
        confirm: function(){
            $.post("routes/routeResultados.php",{info:id,action:'Cancelar'})
                .done(function(data){
                    data =  $.parseJSON(data);
                    if(data.success){
                        customAlert("Exito!", data.msg);
                        $('#bstableResultsPM').bootstrapTable('refresh');
                        $('#bstableResultsEP').bootstrapTable('refresh');
                        refreshAlerts();
                    } else{
                        customAlert("Error!", data.msg);
                    }
                })
                .fail(function(error){
                    customAlert("Error!", ajaxError);
                })

        },
        cancel: function(){
            console.log('false');
        }
    });
});

function getCambio(){
    aPagar = ($('#txtPago').val())?parseFloat($('#txtPago').val()):0.00;
    pagaCon = ($('#txtPagaCon').val())?parseFloat($('#txtPagaCon').val()):0.00;
    Cambio = pagaCon - aPagar;
    $('#lblCambio').html("$"+Cambio.toFixed(2));
}

var typingTimer;
var doneTypingInterval = 1000;

$("#txtPago").on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(getCambio, doneTypingInterval);
});

$("#txtPago").on('keydown', function () {
    clearTimeout(typingTimer);
});

$("#txtPago").on('blur',function(){
    getCambio();
});

$("#txtPagaCon").on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(getCambio, doneTypingInterval);
});

$("#txtPagaCon").on('keydown', function () {
    clearTimeout(typingTimer);
});

$("#txtPagaCon").on('blur',function(){
    getCambio();
});
