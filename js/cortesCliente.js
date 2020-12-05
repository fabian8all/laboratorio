var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
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
    loadTablaCortes($(this).val());
});

function setUltimoCorte(idCliente){
    $.post('routes/routeCortes.php',{info:idCliente,action:'getLast'})
        .done(function(data){
            if (data != null)
            {
                data = $.parseJSON(data);
                if (!data){
                    $('#lblUltimoCorte').html("__/__/____");
                }else{
                    $('#lblUltimoCorte').html(data.fechaCorte);
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
                if (!data){
                    tabla += "<tr><td colspan='5'>No hay estudios realizados</td></tr>"
                }else{
                    $(data).each(function(k,solicitud){
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
                                        <button class='btn btn-info btn-sm btnDetalles' data-idsolicitud='" + solicitud.id + "' data-toggle='tooltip' data-placement='top' title='Detalles' aria-haspopup='true' aria-expanded='false'>\
                                            <span class='fas fa-fw fa-list fa-sm' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                                        </button>\
                                    </td>\
                                </tr>\
                           ";
                    });
                }
                $('#tablaSolicitudesCorte').html(tabla);
            }else{
                customAlert("Error!",ajaxError);
            }
        })
        .fail(function (error){
            customAlert("Error!",error);
        })
}
