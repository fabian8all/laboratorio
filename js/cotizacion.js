var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";
var estudiosSelected = [];
var descuento = 0.0;

$(document).ready(function(){
    load_sel_pacientes();
    load_data_estudios();
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
                    selData="";
                    $(data).each(function(key,val){
                        selected = (selId == val.id )?"selected":"";
                        selData += "<option "+selected+" value='"+val.id+"'>"+val.nombre+"</option>";
                    });
                    $("#selREPacienteData").html(selData);
                    $("#selREPacienteData").selectpicker('refresh');

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
                    hoy = new Date();
                    fechaNac = new Date(data.fechaNac);
                    dayDiff = Math.ceil(hoy - fechaNac) / (1000 * 60 * 60 * 24 * 365);
                    edad = parseInt(dayDiff);
                    $("#lblREPacienteNom").html(data.nombre);
                    $("#lblREPacienteGen").html((data.genero == "M")?"Masculino":"Femenino");
                    $("#lblREPacienteAge").html(edad+" año"+((edad>1)?"s":""));
                    $("#lblREPacienteTel").html(data.telefono);
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



function load_data_estudios(){
    $.post("routes/routeEstudios.php",{info: {search:""},action:'getAll'})
        .done(function(data){
            if(data != null){
                data = $.parseJSON(data);
                if (!data){
                    customAlert("Error!", "No hay estudios");
                }else{
                    options = "";
                    $(data).each(function(k,v){
                        if (detectMob()){
                            nombre = (v.nombre.length > 25)?(v.nombre.substr(1,22)+"..."):v.nombre;
                        }else{
                            nombre = (v.nombre.length > 80)?(v.nombre.substr(1,77)+"..."):v.nombre;
                        }
                        options += "<option value='"+v.id+"' title='"+v.nombre+"' data-costo='"+v.costo+"' data-tiempo='"+v.tiempo+"'>"+v.codigo+" - "+nombre+"</option>";
                    });
                    $("#selREEstudioData").html(options)
                    $("#selREEstudioData").selectpicker('refresh')
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

function detectMob() {
    return ( ( window.innerWidth <= 800 ));
}

$("#btnREAddPaciente").click(function(){
    $("#frmPacientes").trigger('reset');
    $("#modalPacientes").modal('show');
});

    $("#btnPacientesSave").click(function(){
        info =  {
            nombre: $("#txtPacientesNombre").val(),
            genero: $("#selPacientesGenero").val(),
            fechaNac: $("#txtPacientesFechaNac").val(),
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
                    $("#selREPacienteData").trigger("change");
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

$("#selREEstudioData").change(function (){
    option = $(this).children("option:selected");

    estudio = {
        id      : $(this).val(),
        nombre  : option.attr("title"),
        costo   : option.data("costo"),
        tiempo  : option.data("tiempo")
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
        tablaRE +='\
            <div class="row">\
                <div class="col-lg-2 col-md-2  col-2">\
                    <button type="" class="btn btn-sm btn-danger btnREEstudiosUnsel" data-selectedestudiokey="'+key+'">\
                        <i class="fas fa-minus-circle"></i>\
                    </button>\
                </div>\
                <div class="col-lg-8 col-md-8 col-7">\
                    <label>\
                        <i class="far fa-check-circle"></i> \
                        '+val.nombre+'\
                    </label>\
                </div>\
                <div class="col-lg-2 col-md-2  col-3">\
                    <label>\
                        $'+parseFloat(val.costo).toFixed(2)+'\
                    </label>\
                </div>\
            </div>\
        ';
        subTotal += parseFloat(val.costo);
    });
    if (tablaRE == ""){
        tablaRE =  "\
                        <div class='row'>\
                            <div class='col-12'>\
                                -- No hay estudios seleccionados --\
                            </div>\
                        </div>\
                    ";
    }

    $("#divREListaEstudios").html(tablaRE);
    $("#subTotalRE").html("$"+parseFloat(subTotal).toFixed(2));
    if (descuento > 0 ){
        descVal =  subTotal * (descuento/100);
        descuentoRE = '\
                        <hr style="width: 90%; margin:.6rem 0">\
                        <div class="col-lg-2 col-md-2 col-2">\
                            <label><b>Descuento (%'+parseFloat(descuento).toFixed(2)+'):</b></label>\
                        </div>\
                        <div class="col-lg-8 col-md-8 col-7">\
                        </div>\
                        <div class="col-lg-2 col-md-2 col-3">\
                            <label class="text-danger">-$'+parseFloat(descVal).toFixed(2)+'</label>\
                        </div>\
                        ';
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
    total = Number($("#totalRE").html().replace(/[^0-9\.]+/g,""));
    info = {
        pacienteId  : $("#selREPacienteData").val(),
        descuento   : descuento,
        analistaId  : userData.id,
        estudios    : estudiosSelected,
        total       : total
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


