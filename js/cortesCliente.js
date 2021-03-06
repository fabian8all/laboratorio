var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
    fecha = hoy();

    $('#dateCorteInicio').val(fecha);
    $('#dateCorteFin').val(fecha);
    $('#dateCorteFin').prop('max',fecha);
    $.post('routes/routeClientes.php',{info:{},action:'getAll'})
        .done(function(data){
            if (data != null)
            {
                data = $.parseJSON(data);
                if (!data){
                    customAlert("Error!","No hay clientes");
                }else{
                    selClientes = "<option value='' selected disabled>Seleccione cliente</option>";
                    $(data).each(function(k,v){
                        selClientes += "<option value='"+v.id+"'>"+v.nombre+"</option>";
                    });
                    $("#selClientes").html(selClientes);
                    $("#selClientes").selectpicker('refresh');
                }
            }else{
                customAlert("Error!",ajaxError);
            }
        })
        .fail(function (error){
            customAlert("Error!",error);
        });
});

$("#selClientes").change(function(){
    setUltimoCorte($(this).val());
});

$('#dateCorteInicio').change(function(){
    dateChange();
});
$('#dateCorteFin').change(function(){
    dateChange();
});

function dateChange(){
    if (Date.parse($('#dateCorteFin').val()) < Date.parse($('#dateCorteInicio').val())){
        customAlert('Error!','La fecha de corte es menor que la fecha inicial');
        $('#btnRealizarCorte').prop('disabled',true);
        $('#btnPDFCorte').prop('disabled',true);
    }else{
        $('#btnRealizarCorte').prop('disabled',false);
        $('#btnPDFCorte').prop('disabled',false);
    }
    loadTablaCortes($('#selClientes').val());

}

function hoy(){
    fecha = new Date();
    dia = ("0" + fecha.getDate()).slice(-2);
    mes = ("0" + (fecha.getMonth() + 1)).slice(-2);

    fecha = fecha.getFullYear()+"-"+(mes)+"-"+(dia) ;
    return fecha;
}

function setUltimoCorte(idCliente){
    $.post('routes/routeCortes.php',{info:idCliente,action:'getLast'})
        .done(function(data){
            if (data != null)
            {
                data = $.parseJSON(data);
                if (!data){
                    $('#lblUltimoCorte').html("__/__/____");
                    $('#lblEstadoCorte').removeClass().addClass('badge').addClass('badge-secondary').html('NO DISPONIBLE');
                    $('#btnPagarCorte').hide();
                    $('#dateCorteInicio').val(hoy()).prop('disabled',false);
                    $('#dateCorteInicio').trigger('change');
                }else{
                    $('#lblUltimoCorte').html(data.ultimoCorte);
                    $('#dateCorteInicio').val(data.ultimoCorte).prop('disabled',true);
                    $('#dateCorteInicio').trigger('change');
                    if (data.pagado == '0'){
                        $('#lblEstadoCorte').removeClass().addClass('badge').addClass('badge-warning').html('PENDIENTE');
                        $('#btnPagarCorte').data('idcorte',data.id).show();
                        $('#btnRealizarCorte').prop('disabled',true);
                    }else if (data.pagado == '1'){
                        $('#lblEstadoCorte').removeClass().addClass('badge').addClass('badge-success').html('PAGADO');
                        $('#btnPagarCorte').hide();
                        $('#btnRealizarCorte').prop('disabled',false);
                    }
                }
            }else{
                customAlert("Error!",ajaxError);
            }
        })
        .fail(function (error){
            customAlert("Error!",error);
        })
}

function loadTablaCortes(idCliente){
    fechaIni = $('#dateCorteInicio').val();
    fechaFin = $('#dateCorteFin').val()
    if (idCliente == "" || fechaIni == "" || fechaFin == "")
        return false;

    info = {
        idCliente   : idCliente,
        fechaIni    : $('#dateCorteInicio').val(),
        fechaFin    : $('#dateCorteFin').val()
    }
    tabla = "";
    $.post('routes/routeCortes.php',{info:info,action:'getSolicitudes'})
        .done(function(data){
            if (data != null)
            {
                data = $.parseJSON(data);
                total = 0.00;
                solicitudes = []
                if (!data){
                    tabla += "<tr><td colspan='5'>No hay estudios realizados</td></tr>"
                }else{
                    $(data).each(function(k,solicitud){
                        solicitudes.push(solicitud.idSolicitud);
                        total += parseFloat(solicitud.costo);
                        switch (parseInt(solicitud.estado)){
                            case 0:
                                estado = '<span class="btn btn-warning btn-sm" style="color:white">Pendiente de muestra</span>';
                                break;
                            case 1:
                                estado = '<span class="btn btn-primary btn-sm" style="color:white">En proceso</span>';
                                break;
                            case 2:
                                estado = '<span class="btn btn-danger btn-sm" style="color:white">Pendiente de pago</span>';
                                break;
                            case 3:
                                estado = '<span class="btn btn-success btn-sm" style="color:white">Finalizado</span>';
                                break;

                        }
                       tabla+="\
                                <tr>\
                                    <td>"+solicitud.fecha+"</td>\
                                    <td>"+solicitud.paciente+"</td>\
                                    <td>"+solicitud.costo+"</td>\
                                    <td>"+estado+"</td>\
                                    <td>\
                                        <button class='btn btn-info btn-sm btnDetalles' data-idresult='" + solicitud.idSolicitud + "' data-toggle='tooltip' data-placement='top' title='Detalles' aria-haspopup='true' aria-expanded='false'>\
                                            <span class='fas fa-fw fa-list fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                                        </button>\
                                    </td>\
                                </tr>\
                           ";
                    });
                }
                $('#tablaSolicitudesCorte').html(tabla);
                $('#lblTotal').html('$'+total.toFixed(2));
                $('#hidTotal').val(total);
                $('#hidSolicitudes').val(JSON.stringify(solicitudes));
            }else{
                customAlert("Error!",ajaxError);
            }
        })
        .fail(function (error){
            customAlert("Error!",error);
        })
}

$('#btnRealizarCorte').click(function(){

    info = {
        idCliente    : $('#selClientes').val(),
        fechaIni     : $('#dateCorteInicio').val(),
        fechaFin     : $('#dateCorteFin').val(),
        total        : $('#hidTotal').val(),
        solicitudes  : $('#hidSolicitudes').val()
    }
    $.post('routes/routeCortes.php',{info:info,action:'create'})
        .done(function(data){
            data = $.parseJSON(data);
            if (data.success){
                customAlert('Exito!',data.msg);
                $('#selClientes').trigger('change');
            }else{
                customAlert('Error!',data.msg);
            }
        })
        .fail(function(error){
            customAlert('Error!',error);
        })


});

$('#btnPDFCorte').click(function(e){
    e.preventDefault();
    info = {
        idCliente    : $('#selClientes').val(),
        fechaIni     : $('#dateCorteInicio').val(),
        fechaFin     : $('#dateCorteFin').val(),
        total        : $('#hidTotal').val(),
        solicitudes  : $('#hidSolicitudes').val()
    }

    $.post('routes/routeCortes.php',{info:info,action:'getPDF'})
        .done(function(data)
        {
            data = $.parseJSON(data);
            if (data.success){
                window.open('resources/corte.pdf',"_blank");
            }else{
                customAlert("Error!",data.msg);
            }
        })
        .fail(function(error){
            customAlert("Error!", error);
        });
});

$('#btnPagarCorte').click(function(){
    idCorte = $(this).data('idcorte');
    $.post('routes/routeCortes.php',{info:idCorte,action:'get'})
        .done(function(data){
            data = $.parseJSON(data);
            total = data.total;
            pagado = 0.00;
            $(data.pagos).each(function(k,pago){
                pagado += parseFloat(pago.cantidad);
            });
            aPagar = total - pagado;
            $('#lblCostoTotal').html("$"+parseFloat(total).toFixed(2));
            $('#lblUCortePagado').html("$"+pagado.toFixed(2));
            $('#lblTotalAPagar').html("$"+parseFloat(aPagar).toFixed(2));
            $('#txtPagaCon').val('0.00');
            $('#lblCambio').html('$0.00');
            $('#hidPagoIdCorte').val(idCorte);
            $('#modPagarCorte').modal('show');
        })
    .fail(function(error){
        customAlert("Error!",error);
    });
});

$('#btnPagoSubmit').click(function(){
    info = {
        id          : $("#hidPagoIdCorte").val(),
        pago        : $("#txtPago").val(),
        formaPago   : $("#selFormaPago").val(),
        referencia  : $("#txtReferencia").val()
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

            $.post("routes/routeCortes.php", {info: info, action: "Pagar"})
                .done(function (data) {
                    data = $.parseJSON(data);
                    if (data.success) {
                        customAlert("Exito!", data.msg);
                        $("#txtPago").val('');
                        $("#hidPagoIdCorte").val('');
                        $('#selFormaPago').val('');
                        $('#modPagarCorte').modal('hide');
                        idCliente = $('#selClientes').val();
                        setUltimoCorte(idCliente);
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


function getCambio(){
    aPagar = ($('#txtPago').val())?parseFloat($('#txtPago').val()):0.00;
    pagaCon = ($('#txtPagaCon').val())?parseFloat($('#txtPagaCon').val()):0.00;
    Cambio = pagaCon - aPagar;
    $('#lblCambio').html("$"+Cambio.toFixed(2));
}

$('#txt')

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
