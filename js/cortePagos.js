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
                totalClientes  = 0.00;
                totalPacientes = 0.00;
                totalEfectivo  = 0.00;
                totalTarjeta   = 0.00;
                totalTransfer  = 0.00;
                if (!data){
                    tabla += "<tr><td colspan='6'>No hay pagos realizados</td></tr>"
                }else{
                    $(data).each(function(k,pago){
                        total += parseFloat(pago.cantidad);
                        if (pago.modulo == "solicitudes"){
                            totalPacientes += parseFloat(pago.cantidad);
                            nombre = pago.nombreS;
                        }else{
                            totalClientes += parseFloat(pago.cantidad);
                            nombre = pago.nombreC;
                        }

                        switch (pago.tipo){
                            case "Efectivo":
                                totalEfectivo += parseFloat(pago.cantidad);
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
                                    <td>"+nombre+"</td>\
                                    <td> $"+parseFloat(pago.cantidad).toFixed(2)+"</td>\
                                    <td>"+pago.tipo+"</td>\
                                    <td>"+pago.referencia+"</td>\
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
                $('#lblTotalEfectivo').html('$'+totalEfectivo.toFixed(2));
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


$('#btnPDFCorte').click(function(e){
    e.preventDefault();
    info = {
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
