var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
    load_sel_pacientes();
    load_estudios_selected();
});

function load_sel_pacientes(){
    if (userData.perfil == 1) {
        action = "getAll";
        info = {};
    }else{
        action = "getMy";
        info = userData.id;
    }

    $.post("routes/routePacientes.php",{info:info,action:action})
        .done(function(data){
            if(data != null){
                data = $.parseJSON(data);
                if (!data){
                    customAlert("Error!","No hay pacientes")
                }else{
                    selData="<option selected disabled value='0'>--Seleccione paciente--</option>";
                    $(data).each(function(key,val){
                        selData += "<option value='"+val.id+"'>"+val.nombre+"</option>";
                    });
                    $("#selREPacienteData").html(selData)
                }
            } else{
                customAlert("Error!",ajaxError);
            }
        })
        .fail(function(error){
            customAlert("Error!",error);
        });
}

$("#selREPacienteData").change(function(){
    id = $(this).val();
    $.post("routes/routePacientes.php",{info:id,action:"get"})
        .done(function(data){
            if(data != null){
                data = $.parseJSON(data);
                if (!data){
                    customAlert("Error!","No se encuentra la información del paciente")
                }else{
                    $("#lblREPacienteNom").html(data.nombre);
                    $("#lblREPacienteTel").html(data.telefono);
                    $("#lblREPacienteDir").html(data.direccion);
                    $("#lblREPacienteEmail").html(data.email);
                    descuento = data.descuento;
                    load_estudios_selected();
                }
            } else{
                customAlert("Error!",ajaxError);
            }
        })
        .fail(function(error){
            customAlert("Error!",error);
        });
});

function load_estudios_selected(){
    var tablaRE = ""
    var subTotal = 0;
    $(estudiosSelected).each(function(key,val){
        tablaRE += "<div class='row'> \
                        <div class='col-8'>\
                            <span class='fa fa-check-circle-o'></span>\
                            "+val.nombre+"\
                        </div>\
                        <div class='col-4'>\
                            $"+parseFloat(val.costo).toFixed(2)+"\
                        </div>\
                    </div>";
        subTotal += parseFloat(val.costo);
    });
    if (tablaRE == ""){
        tablaRE =  "<div class='container'>\
                        <div class='row'>\
                            <div class='col-12'>\
                                -- No hay estudios seleccionados --\
                            </div>\
                        </div>\
                    </div>";
    }else{
        tablaRE = "<div class='container'>\
                        <div class='row'>\
                            <div class='col-12'>\
                                "+tablaRE+"\
                            </div>\
                        </div>\
                    </div>"
    }
    $("#divREListaEstudios").html(tablaRE);
    $("#subTotalRE").html("$"+parseFloat(subTotal).toFixed(2));
    if (descuento > 0 ){
        descVal =  subTotal * (descuento/100);
        descuentoRE = "<hr>\
                        <div class='container'>\
                            <div class='row'>\
                                <div class='col-8'>\
                                    <strong>Descuento (%"+parseFloat(descuento).toFixed(2)+"):</strong>\
                                </div>\
                                <div class='col-4'>\
                                    <red>-$"+parseFloat(descVal).toFixed(2)+"</red>\
                                </div>\
                            </div>\
                        </div>";

    }else{
        descVal = 0;
        descuentoRE = "";
    }
    $("#descuentoRE").html(descuentoRE);
    total = subTotal - descVal;
    $("#totalRE").html("$"+parseFloat(total).toFixed(2));

}

$("#btnREAddEstudio").click(function(){
    load_data_estudios();
    $("#modalREAddEstudio").modal('show');
});

function load_data_estudios(){
    $.post("routes/routeEstudios.php",{info:{},action:'getAll'})
        .done(function(data){
            if(data != null){
                data = $.parseJSON(data);
                if (!data){
                    customAlert("Error!", "No hay estudios");
                }else{
                    load_estudios(data);
                }
            } else{
                customAlert("Error!", ajaxError);
            }
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        });
}

function load_estudios(data){
    cards = "";
    $(data).each(function(key,val){
       cards += "<div class='col-4'>\
                    <div class='card  cardEstudio'>\
                        <div class='card-header card-info'>\
                            <div class='card-title'>\
                                <h6>\
                                    <span class='badge badge-warning'>"+val.codigo+"</span>\
                                    "+val.nombre+"\
                                </h6>\
                            </div>\
                        </div>\
                        <div class='card-body'>\
                            <input type='hidden' class='hidCardERid' value='"+val.id+"'>\
                            <input type='hidden' class='hidCardERnombre' value='"+val.nombre+"'>\
                            <input type='hidden' class='hidCardERcosto' value='"+val.costo+"'>\
                            <input type='hidden' class='hidCardERtiempo' value='"+val.tiempo+"'>\
                            <p>"+val.muestra+"</p>\
                            <p><strong>Tiempo: </strong>"+val.tiempo+"</p>\
                            <p><strong>Costo: </strong>$"+val.costo+"</p>\
                        </div>\
                    </div>\
                </div>";
    });
    $("#divEstudiosCards").html(cards);
}

$(document).on('click',".cardEstudio",function (){
    card = $(this).find(".card-body");

    estudio = {
        id      : card.find(".hidCardERid").val(),
        nombre  : card.find(".hidCardERnombre").val(),
        costo   : card.find(".hidCardERcosto").val(),
        tiempo  : card.find(".hidCardERtiempo").val()
    }

    $.confirm({
        title: 'Atencion!',
        content: '¿Agreagar este estudio '+estudio.nombre+' a la lista de estudios a realizar?',
        confirm: function(){
            estudiosSelected.push(estudio);
            load_estudios_selected();
        },
        cancel: function(){
            console.log('false');
        }
    });
});
