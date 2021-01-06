var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";
var estudiosSelected = [];
var descuento = 0.0;
var lista =0;

$(document).ready(function(){
    load_sel_pacientes();
    load_data_estudios();
    load_estudios_selected();
});

function load_sel_pacientes(selId = 0){
    if (userData.verPacientes == 'All') {
        action = "getAll";
        info = {};
    }else if (userData.verPacientes == 'My') {
        action = "getMy";
        info = userData.id;
    }else{
        customAlert("Error!","Error al intentar obtener la lista de pacientes");
        return false;
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
                    lista = parseInt(data.lista);
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
                       nombre = v.nombre;
                        options += "<option value='"+v.id+"' title='"+v.nombre+"' data-costo='"+v.costo+"' data-costom='"+v.costo_medico+"' data-costoe='"+v.costo_empresa+"' data-costol4='"+v.costo_lista4+"' data-tiempo='"+v.tiempo+"'>"+v.codigo+" - "+nombre+"</option>";
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


$("#btnREAddPaciente").click(function(){

    $("#frmPacientes").trigger('reset');
    $("#modalPacientes").modal('show');
});

    $("#btnPacientesSave").click(function(){
        if (userData.perfil != 1){
            referente = userData.id;
        }else{
            referente = 0;
        }
        info =  {
            nombre: $("#txtPacientesNombre").val(),
            genero: $("#selPacientesGenero").val(),
            fechaNac: $("#txtPacientesFechaNac").val(),
            direccion: $("#txtPacientesDireccion").val(),
            telefono: $("#txtPacientesTelefono").val(),
            email: $("#txtPacientesEmail").val(),
            referente: referente
        }
        $('#btnPacientesSave').html( '\
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
                   Guardando...'
        ).prop('disabled',true);
        $.post("routes/routePacientes.php",{info:info,action:"Add"})
            .done(function(data){
                data =  $.parseJSON(data);
                if(data.success){
                    customAlert("Exito!", data.msg);
                    $("#modalPacientes").modal('hide');
                    load_sel_pacientes(data.id);
                    $("#selREPacienteData").trigger("change");
                } else{
                    customAlert("Error!", data.msg);
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
$('#btnREEstudioData').click(function(){
    if($('#selREEstudioData').val()) {
        $('#selREEstudioData').trigger('change');
    }
});
$("#selREEstudioData").change(function (){
    option = $(this).children("option:selected");

    estudio = {
        id      : $(this).val(),
        nombre  : option.attr("title"),
        costo   : option.data("costo"),
        costom  : option.data("costom"),
        costoe  : option.data("costoe"),
        costol4 : option.data("costol4"),
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
    var Total = 0;
    var costoCliente = 0.0;
    $(estudiosSelected).each(function(key,val) {
        tablaRE += '\
            <div class="row">\
                <div class="col-lg-2 col-md-2  col-2">\
                    <button type="" class="btn btn-sm btn-danger btnREEstudiosUnsel" data-selectedestudiokey="' + key + '">\
                        <i class="fas fa-minus-circle"></i>\
                    </button>\
                </div>\
                <div class="col-lg-8 col-md-8 col-7">\
                    <label>\
                        <i class="far fa-check-circle"></i> \
                        ' + val.nombre + '\
                    </label>\
                </div>\
                <div class="col-lg-2 col-md-2  col-3">\
                    <label>\
                        $' + parseFloat(val.costo).toFixed(2) + '\
                    </label>\
                </div>\
            </div>\
        ';
        Total += parseFloat(val.costo);
        if (lista > 0 ) {
            switch (lista) {
                case 1:
                    costoCliente += val.costom;
                    break;
                case 2:
                    costoCliente += val.costoe;
                    break;
                case 3:
                    costoCliente += val.costol4;
                    break;
            }
        }
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

    if (costoCliente > 0){
        descuentoRE = '\
                        <hr style="width: 90%; margin:.6rem 0">\
                        <div class="col-lg-2 col-md-2 col-2">\
                            <label><b>Costo Cliente:</b></label>\
                        </div>\
                        <div class="col-lg-8 col-md-8 col-7">\
                        </div>\
                        <div class="col-lg-2 col-md-2 col-3">\
                            <label id="lblCostoCliente">$'+parseFloat(costoCliente).toFixed(2)+'</label>\
                        </div>\
                        ';
    }else{
        descuentoRE =""
    }
    $("#descuentoRE").html(descuentoRE);
    $("#totalRE").html("$"+parseFloat(Total).toFixed(2))
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
    $.confirm({
        title: 'Atencion!',
        content: '¿Solicitar estudios?',
        confirm: function(){
            $('#txtAnticipo').val('0.00');
            $('#hidAnticipo').val('0.00');
            $('#lblAnticipoTotal').html($('#totalRE').html());
            $('#selFormaPago').val(0);
            $('#txtReferenciaAnticipo').val('');
            $('#modAgregarAnticipo').modal('show');
        },
        cancel: function(){
            console.log('false');
        }
    });
});


$('#modAgregarAnticipo').on('hide.bs.modal',function(){
    solicitarEstudios();
});

$('#btnAnticipoSubmit').click(function(){
    anticipo = $('#txtAnticipo').val();
    if (parseFloat(anticipo)>0){
        formaPago = $('#selFormaPago').val();
        if(formaPago == "" || formaPago == null) {
            customAlert('Error!','No se ha especificado la forma de pago');
        }else {
            $('#hidAnticipo').val(anticipo);
            $('#hidFormaPago').val(formaPago);
            $('#modAgregarAnticipo').modal('hide');
        }
    }else{
        $('#hidAnticipo').val(anticipo);
        $('#modAgregarAnticipo').modal('hide');
    }
});

function solicitarEstudios(){
    total = Number($("#totalRE").html().replace(/[^0-9\.]+/g,""));
    costoCliente = ($("#lblCostoCliente").html())?$("#lblCostoCliente").html():"0.0";
    totalCliente = Number(costoCliente.replace(/[^0-9\.]+/g,""));
    info = {
        pacienteId  : $("#selREPacienteData").val(),
        descuento   : descuento,
        analistaId  : userData.id,
        estudios    : estudiosSelected,
        total       : total,
        totalCliente: totalCliente,
        lista       : lista,
        anticipo    : $('#hidAnticipo').val(),
        formaPago   : $('#hidFormaPago').val(),
        refAnticipo : $('#txtReferenciaAnticipo').val(),
        aDomicilio  : $('#chkADomicilio').prop('checked')
    }

    $('#btnRESolicitar').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
    ).prop('disabled',true);

    $.post("routes/routeEstudios.php",{info:info,action:"Solicitar"})
        .done(function(data){
            data =  $.parseJSON(data);
            if(data.success){
                customAlert("Exito!", data.msg);
                $("#selREPacienteData").val(0);
                $("#selREPacienteData").trigger('change');
                estudiosSelected = [];
                descuento = 0.00;
                load_estudios_selected();
            } else{
                customAlert("Error!", data.msg);
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
            refreshAlerts();
        });
}


