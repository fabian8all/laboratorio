var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
    fecha = hoy();

    $('#dateCorteInicio').val(fecha);
    $('#dateCorteFin').val(fecha);
    loadTablaCortes();

});

$("#selTipo").change(function(){
    if ($(this).val()=="dia"){
        $('#divCorteFin').hide();
    }else{
        $('#divCorteFin').show();
    }
});

$('#dateCorteInicio').change(function(){
    dateChange();
});
$('#dateCorteFin').change(function(){
    dateChange();
});

function dateChange(){
    if ($('#selTipo').val()=="periodo"){
        if (Date.parse($('#dateCorteFin').val()) < Date.parse($('#dateCorteInicio').val())){
            customAlert('Error!','La fecha de corte es menor que la fecha inicial');
            $('#btnPDFCorte').prop('disabled',true);
        }else{
            $('#btnPDFCorte').prop('disabled',false);
            loadTablaCortes();
        }
    }
    else{
        $('#btnPDFCorte').prop('disabled',false);
        loadTablaCortes();
    }

}

function hoy(){
    fecha = new Date();
    dia = ("0" + fecha.getDate()).slice(-2);
    mes = ("0" + (fecha.getMonth() + 1)).slice(-2);

    fecha = fecha.getFullYear()+"-"+(mes)+"-"+(dia) ;
    return fecha;
}

function loadTablaCortes(){
    if ($('#selTipo').val()=='dia'){

        fechaIni = $('#dateCorteInicio').val()+" 00:00:00";
        fechaFin = $('#dateCorteInicio').val()+" 23:59:59";

    }else{
        fechaIni = $('#dateCorteInicio').val();
        fechaFin = $('#dateCorteFin').val()
    }
    if (fechaIni == "" || fechaFin == "")
        return false;

    info = {
        fechaIni    : fechaIni,
        fechaFin    : fechaFin
    }
    tabla = "";
    $.post('routes/routeCortes.php',{info:info,action:'getPagos'})
        .done(function(data){
            if (data != null)
            {
                data = $.parseJSON(data);
                total = 0.00;
                totalClientes   = 0.00;
                totalPacientes  = 0.00;
                totalRetiros    = 0.00;
                totalEfectivo   = 0.00;
                totalCaja       = 0.00;
                totalTarjeta    = 0.00;
                totalTransfer   = 0.00;
                if (!data){
                    tabla += "<tr><td colspan='6'>No hay pagos realizados</td></tr>"
                }else{
                    $(data).each(function(k,pago){
                        sign = "";
                        switch (pago.modulo){
                            case "solicitudes":
                                total += parseFloat(pago.cantidad);
                                totalPacientes += parseFloat(pago.cantidad);
                                nombre = pago.nombreS;
                                break;
                            case "cortes":
                                total += parseFloat(pago.cantidad);
                                totalClientes += parseFloat(pago.cantidad);
                                nombre = pago.nombreC;
                                break;
                            case "retiros":
                                sign ="-";
                                total -= parseFloat(pago.cantidad);
                                totalRetiros += parseFloat(pago.cantidad);
                                nombre = pago.nombreR;
                                break;
                        }

                        switch (pago.tipo){
                            case "Efectivo":
                                if (pago.modulo =="retiros") {
                                    totalCaja -= parseFloat(pago.cantidad);
                                }else {
                                    totalCaja += parseFloat(pago.cantidad);
                                    totalEfectivo += parseFloat(pago.cantidad);
                                }
                                break;
                            case "Tarjeta":
                                totalTarjeta +=  parseFloat(pago.cantidad);
                                break;
                            case "Transferencia":
                                totalTransfer += parseFloat(pago.cantidad);
                                break;
                        }
                       tabla+="\
                                <tr>\
                                    <td align='left'>"+nombre+"</td>\
                                    <td align='right'>"+sign+"$"+parseFloat(pago.cantidad).toFixed(2)+"</td>\
                                    <td>"+pago.tipo+"</td>\
                                    <td align='left'>"+pago.referencia+"</td>\
                                    <td>"+pago.modulo+"</td>\
                                    <td>"+pago.creado+"</td>\
                                </tr>\
                           ";
                    });
                }
                $('#tablaSolicitudesCorte').html(tabla);
                $('#lblTotal').html('$'+total.toFixed(2));
                $('#lblTotalClientes').html('$'+totalClientes.toFixed(2));
                $('#lblTotalPacientes').html('$'+totalPacientes.toFixed(2));
                $('#lblTotalRetiros').html('-$'+totalRetiros.toFixed(2));
                $('#lblTotalEfectivo').html('$'+totalEfectivo.toFixed(2));
                $('#lblTotalCaja').html('$'+totalCaja.toFixed(2));
                $('#lblTotalTarjeta').html('$'+totalTarjeta.toFixed(2));
                $('#lblTotalTransfer').html('$'+totalTransfer.toFixed(2));
            }else{
                customAlert("Error!",ajaxError);
            }
        })
        .fail(function (error){
            customAlert("Error!",error);
        })
}

$('#btnXLSCorte').click(function (e){
    e.preventDefault();
    if ($('#selTipo').val()=='dia'){
        titulo = "Corte del día "+$('#dateCorteInicio').val();
        nombre = "CortePagos"+$('#dateCorteInicio').val().replace(/-/g, '');
    }else{
        titulo = "Corte del día "+$('#dateCorteInicio').val()+" al día "+$('#dateCorteFin').val();
        nombre = "CortePagos"+$('#dateCorteInicio').val().replace(/-/g, '')+"-"+$('#dateCorteFin').val().replace(/-/g, '');
    }
    data = "\
            <table>\
                <thead>\
                <tr>\
                    <th colspan='6'><h1>Corte de Pagos</h1></th>\
                </tr>\
                <tr></tr>\
                </thead>\
                <tbody>\
                    <tr>\
                        <td><b>"+titulo+"</b></td>\
                    </tr>\
                    <tr></tr>\
                </tbody>\
            </table>\
            ";
    data += $('#tableContainer').html();
    data += "\
            <table>\
                <thead><tr></tr><tr></tr></thead>\
                <tbody>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Pago de pacientes:</b></td>\
                        <td>"+$('#lblTotalPacientes').html()+"</td>\
                    </tr>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Pago de clientes:</b></td>\
                        <td>"+$('#lblTotalClientes').html()+"</td>\
                    </tr>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Retiros de efectivo:</b></td>\
                        <td>"+$('#lblTotalRetiros').html()+"</td>\
                    </tr>\
                    <tr></tr>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Pagos en efectivo:</b></td>\
                        <td>"+$('#lblTotalEfectivo').html()+"</td>\
                    </tr>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Pagos con tarjeta:</b></td>\
                        <td>"+$('#lblTotalTarjeta').html()+"</td>\
                    </tr>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Pagos por transferencia:</b></td>\
                        <td>"+$('#lblTotalTransfer').html()+"</td>\
                    </tr>\
                    <tr></tr>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Total en caja:</b></td>\
                        <td>"+$('#lblTotalCaja').html()+"</td>\
                    </tr>\
                    <tr>\
                        <td colspan='6'>&nbsp;</td>\
                        <td><b>Total de venta:</b></td>\
                        <td>"+$('#lblTotal').html()+"</td>\
                    </tr>\
                </tbody>\
            </table>\
    ";
    var filename = nombre+'.xls';
    var uri = '' +
        'data:application/vnd.ms-excel;charset=UTF-8,%EF%BB%BF' + encodeURIComponent(data);
    var downloadLink = document.createElement("a");
    downloadLink.href = uri;
    downloadLink.download = filename;

    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
});

$('#btnRetirarEfectivo').click(function(){
   $("#txtMontoRetirar").val("");
   $("#txtMotivoRetirar").val("");
   $("#modRetirarEfectivo").modal("show");
});

$('#btnAddRetiro').click(function(){
    info = {
        monto    : $("#txtMontoRetirar").val(),
        motivo   : $("#txtMotivoRetirar").val(),
        user     : userData.id
    }
    $.post('routes/routeCortes.php',{info:info,action:'Retirar'})
        .done(function(data){
            data = $.parseJSON(data);
            if (data.success){
                customAlert('Exito!',data.msg);
                $("modRetirarEfectivo").modal('hide');
                loadTablaCortes();
            }else{
                customAlert('Error!',data.msg);
            }
        })
        .fail(function(error){
            customAlert('Error!',error);
        })


});
