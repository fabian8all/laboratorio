var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";
var estudiosSelected = [];
var descuento = 0.0;

$(document).ready(function(){
    load_sel_pacientes();
    load_estudios_selected();
});

function load_sel_pacientes(selId = 0){
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
                    selected = (selId == 0 )?"selected":"";
                    selData="<option "+selected+" disabled value='0'>--Seleccione paciente--</option>";
                    $(data).each(function(key,val){
                        selected = (selId == val.id )?"selected":"";
                        selData += "<option "+selected+" value='"+val.id+"'>"+val.nombre+"</option>";
                    });
                    $("#selREPacienteData").html(selData);
                    $("#selREPacienteData").trigger("change");
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
    if(id)
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

$("#btnREAddEstudio").click(function(){
    $("#txtREAddSearch").val("");
    load_data_estudios("");
    $("#modalREAddEstudio").modal('show');
});

function load_data_estudios(busca){
    info = {search:busca}
    loading = true;
    $("#divREAddLoader").html("\
        <span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span> \
        Cargando...");
    $.post("routes/routeEstudios.php",{info:info,action:'getAll'})
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
        })
        .always(function(){
            $("#divREAddLoader").html("");
            loading = false;
        });
}

function load_estudios(data){

    cards = [];
    if(detectMob()){
        cardNumber = 1;
    }else{
        cardNumber = 6;
    }
    $(data).each(function(key,val){
       card =  "<div class='col-md-4 col-sm-12'>\
                    <div class='card cardEstudio'>\
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
       cards.push(card);
    });


    carousel = "<div class='container'>\
                    <div id='carouselEstudios' class='carousel slide' data-interval='false'>\
                        <ol class='carousel-indicators'>\
                        </ol>\
                        <div class='carousel-inner'>";
    count = 0;
    indicators = "";
    $(cards).each(function(key,card){
        active = (count == 0) ? "active": "";

        if ((count % cardNumber)==0){
            if (count !=0){
                carousel += "</div>";
            }
            carousel += "<div class='carousel-item "+active+"'>";

            indicators += "<li data-target='#carouselEstudios' data-slide-to='"+(count/6)+"' class='"+active+" carouselControl'></li>"
        }
        carousel += card;
        count++;

    });
    if (count == 0){
        carousel += "<div class='carousel-item active'> -- No hay estudios para mostrar -- </div>";
    }else{
        carousel +="</div>";
    }

        carousel += "</div>\
                        <a class='carousel-control-prev carouselControl' href='#carouselEstudios' role='button' data-slide='prev'>\
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>\
                        <span class='sr-only'>Previous</span>\
                      </a>\
                      <a class='carousel-control-next carouselControl' href='#carouselEstudios' role='button' data-slide='next'>\
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>\
                        <span class='sr-only'>Next</span>\
                      </a>\
                </div>\
            </div>";
    $("#divEstudiosCards").html(carousel);
    $("#carouselEstudios").find(".carousel-indicators").html(indicators);
}

function detectMob() {
    return ( ( window.innerWidth <= 800 ));
}

var loading = false;
$("#txtREAddSearch").keyup(function(e){
   if(!loading) {
       if ($(this).val().length >= 3) {
           load_data_estudios($(this).val());
       } else if ($(this).val().length == 0) {
           load_data_estudios("");
       }
   }
});

$("#btnREAddPaciente").click(function(){
    $("#frmPacientes").trigger('reset');
    $("#modalPacientes").modal('show');
});

$("#btnPacientesSave").click(function(){
    info =  {
        nombre: $("#txtPacientesNombre").val(),
        direccion: $("#txtPacientesDireccion").val(),
        telefono: $("#txtPacientesTelefono").val(),
        email: $("#txtPacientesEmail").val(),
    }
    $('#btnPacientesSave').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
    ).prop('disabled',true);
    $.post("routes/routePacientes.php",{info:info,action:"Add"})
        .done(function(data){
            data =  $.parseJSON(data);
            if(data){
                customAlert("Exito!", "La información se ha guardado con exito");
                $("#modalPacientes").modal('hide');
                load_sel_pacientes(data.id);
            } else{
                customAlert("Error!", "Ocurrió un error al intentar guardar la información");
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

function load_estudios_selected(){
    var tablaRE = ""
    var subTotal = 0;
    $(estudiosSelected).each(function(key,val){
        tablaRE += "<div class='row'> \
                        <div class='col-2'>\
                            <button class='btn btn-sm btn-danger btnREEstudiosUnsel' data-selectedestudiokey='"+key+"' >\
                                <span class='fa fa-minus-circle'></span>\
                            </button>\
                        </div>\
                        <div class='col-6'>\
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

$(document).on('click',".btnREEstudiosUnsel",function(){
   key = $(this).data("selectedestudiokey");
   estudiosSelected.splice(key,1);
   load_estudios_selected();
});

$("#btnRESolicitar").click(function(){
    pacienteId = $("#selREPacienteData").val();
    if (!pacienteId){
        customAlert("Error!", "No se ha seleccionado paciente");
        return false;
    }
    if (!estudiosSelected.length){
        customAlert("Error!", "No se han seleccionado estudios a realizar");
        return false;
    }
    info = {
        pacienteId  : $("#selREPacienteData").val(),
        descuento   : descuento,
        estudios    : estudiosSelected
    }
    $.confirm({
        title: 'Atencion!',
        content: '¿Solicitar estudios?',
        confirm: function(){
            $('#btnRESolicitar').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
            ).prop('disabled',true);

            $.post("routes/routeEstudios.php",{info:info,action:"Solicitar"})
            .done(function(data){
                data =  $.parseJSON(data);
                if(data){
                    customAlert("Exito!", "Se han solicitado los estudios a realizar");
                    $("#selREPacienteData").val(0);
                    $("#selREPacienteData").trigger('change');
                    estudiosSelected = [];
                    descuento = 0.00;
                    load_estudios_selected();
                } else{
                    customAlert("Error!", "Ocurrió un error al intentar guardar la información");
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            })
            .always(function(){
                $('#btnRESolicitar').html( '\
                    <span class="fa fa-tasks"></span>\
                    Solicitar Estudios\
                ').prop('disabled',false);
            });
        },
        cancel: function(){
            console.log('false');
        }
    });
});
