var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
    load_resultados_data();
});

function load_resultados_data(){
    divSolicitudes = "";
    $.post("routes/routeResultados.php",{info: {},action:"getAll"})
        .done(function(data){
            data = $.parseJSON(data);
            $(data).each(function(k,solicitud){
                clase = "card-secondary";
                switch (solicitud.estado){
                    case '1':
                        clase = "card-warning";
                        break;
                    case '2':
                        clase = "card-warning";
                        break;
                    case '3':
                        clase = "card-success";
                        break;

                }
                divSolicitudes += '<div class="row">   \
                    <div class="col-sm-12">   \
                        <div class="card" >\
                            <div class="card-header '+clase+'" style="border-radius:20px;">\
                                <div class="card-title">\
                                    <div class="col-sm-6">\
                                        <span class="fa fa-chevron-circle-right">\
                                        <a class="hrefCollapse" role="button" data-toggle="collapse" data-parent="#divSolicitudes" data-target="#divSolicitud_'+k+'" aria-expanded="true" aria-controls="collapseOne">\
                                            '+solicitud.paciente+" - "+solicitud.fecha+'\
                                        </a>\
                                    </div>\
                                </div>\
                            </div>\
                            <div id="divSolicitud_'+k+'" class="collapse divSolicitud" data-idpaquete="'+solicitud.id+'" role="tabpanel" >\
                            </div>\
                        </div>\
                    </div>\
                </div>';
            });
            $("#divSolicitudes").html(divSolicitudes);
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })

}

$(document).on('show.bs.collapse',".divSolicitud",function(){
   id=$(this).data("idpaquete");
   div = $(this).prop("id");

    divResultados = '<div class="card-body">\
                        <div class="row">\
                            <div class="col-12">';
    $.post("routes/routeResultados.php",{info:id,action:"get"})
        .done(function(data){
            data = $.parseJSON(data);

            $(data).each(function(k,estudio){
                divResultados += "\
                    <div class='card'>\
                        <div class='card-header card-primary'>\
                            <div class='card-title'>\
                                "+estudio.estudio+"\
                            </div>\
                        </div>\
                        <div class='card-body' style='overflow-x: scroll;'>\
                ";
                if (estudio.estado == "1"){
                    pruebas = $.parseJSON(estudio.pruebas);
                    $(pruebas).each(function(k2,clasif){
                        if(clasif.nombre != ""){
                            divResultados += "\
                                <h3>"+clasif.nombre+"</h3>\
                                <hr>\
                            ";
                        }
                        $(clasif.pruebas).each(function(k3,prueba){
                            divResultados += "\
                                <div class='row'>\
                                    <div class='col-md-6 col-sm-12'>\
                                        <label>\
                                            <strong>"+prueba.nombre+":</strong>\
                                        </label>\
                                    </div>\
                                    <div class='col-md-6 col-sm-12'>\
                                        <input type='text' class='form-control txtResultadosPrueba' data-prueba='"+k3+"' data-clasif='"+k2+"'>\
                                    </div>\
                                </div>\
                            ";
                        });
                    });
                    divResultados += "\
                        <hr>\
                        <div class='row'>\
                            <div class='col-md-6 col-sm-12'>\
                                <label>\
                                    <strong>Observaciones:</strong>\
                                </label>\
                            </div>\
                            <div class='col-md-6 col-sm-12'>\
                                <textarea class='form-control txtResultadosObservaciones' cols='60' rows='5'></textarea>\
                            </div>\
                        </div>\
                        <hr>\
                        <div class='row'>\
                            <div class='col-md-6 col-sm-12'>\
                                <label>\
                                    <strong>Analista:</strong>\
                                </label>\
                            </div>\
                            <div class='col-md-6 col-sm-12'>\
                                <textarea class='form-control txtResultadosAnalista' cols='60' rows='5'></textarea>\
                            </div>\
                        </div>\
                        <hr>\
                        <div class='row'>\
                            <div class='float-right'>\
                                <button class='btn btn-success btnResultadosSave' data-idestudio='"+estudio.id+"'>\
                                    <span class='fa fa-save'></span>\
                                    Guardar Resultados\
                                </button>\
                            </div>\
                        </div>\
                    ";
                }
                if (estudio.estado == "2" || estudio.estado == "3"){
                    pruebas = $.parseJSON(estudio.pruebas);
                    resultados = $.parseJSON(estudio.resultados);
                    $(pruebas).each(function(k2,clasif){
                        if(clasif.nombre != ""){
                            divResultados += "\
                                <h3>"+clasif.nombre+"</h3>\
                                <hr>\
                            ";
                        }
                        divResultados += "\
                                <div class='row'>\
                                    <div class='col-4'>\
                                        <label>\
                                            <strong>PRUEBA</strong>\
                                        </label>\
                                    </div>\
                                    <div class='col-4'>\
                                        <label>\
                                            <strong>RESULTADO</strong>\
                                        </label>\
                                    </div>\
                                    <div class='col-4'>\
                                        <label>\
                                            <strong>REFERENCIA</strong>\
                                        </label>\
                                    </div>\
                                </div>\
                            ";
                        $(clasif.pruebas).each(function(k3,prueba){
                            divResultados += "\
                                <div class='row'>\
                                    <div class='col-4'>\
                                        <label>\
                                            <strong>"+prueba.nombre+":</strong>\
                                        </label>\
                                    </div>\
                                    <div class='col-4'>\
                                        "+resultados[k2][k3]+"\
                                    </div>\
                                    <div class='col-4'>\
                                        <label>\
                                            <strong>"+prueba.referencia+":</strong>\
                                        </label>\
                                    </div>\
                                </div>\
                            ";
                        });
                    });
                    divResultados += "\
                        <hr>\
                        <div class='row'>\
                            <div class='col-md-6 col-sm-12'>\
                                <label>\
                                    <strong>Observaciones:</strong>\
                                </label>\
                            </div>\
                            <div class='col-md-6 col-sm-12'>\
                                "+estudio.observaciones+"\
                            </div>\
                        </div>\
                        <hr>\
                        <div class='row'>\
                            <div class='col-md-6 col-sm-12'>\
                                <label>\
                                    <strong>Analista:</strong>\
                                </label>\
                            </div>\
                            <div class='col-md-6 col-sm-12'>\
                                "+estudio.analista+"\
                            </div>\
                        </div>\
                    ";
                }
                divResultados += "\
                        </div>\
                    </div>\
                ";
            });
            $("#"+div).html(divResultados);
        })
        .fail(function(error){
           customAlert("Error!",ajaxError);
        });
});

$(document).on('click','.btnResultadosSave',function() {
    btn =  this;
    estudio = $(btn).closest('.card-body');
    idEstudio = $(btn).data('idestudio');
    $.confirm({
        title: 'Atencion!',
        content: '¿Guardar resultados del estudio?',
        confirm: function () {
            resultados = [];
            pruebas = estudio.find(".txtResultadosPrueba");
            observaciones = estudio.find(".txtResultadosObservaciones").val();
            analista = estudio.find(".txtResultadosAnalista").val();
            $(pruebas).each(function (k, prueba) {
                clasif = $(prueba).data("clasif");
                key = $(prueba).data("prueba");
                if (!(clasif in resultados)){
                    resultados[clasif]=[];
                }
                resultados[clasif][key]=$(prueba).val();
            });
            resultados = JSON.stringify(resultados);
            info = {
                idEstudio : idEstudio,
                resultados : resultados,
                observaciones : observaciones,
                analista : analista
            }
            $(btn).html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
            ).prop('disabled',true);

            $.post('routes/routeResultados.php', {info: info, action: "Save"}, function (data) {
                data = $.parseJSON(data);
                if (data.success) {
                    customAlert("Exito!", "Los resutados han sido guardados");
                    if(data.full){
                        load_resultados_data();
                    }else{
                        $(estudio).closest(".divSolicitud").trigger('show');
                    }
                }else {
                    customAlert("Error!", "Error al intentar guardar los resultados");
                }
            }).fail(function (error) {
                customAlert("Error!", ajaxError);
            }).always(function(){
                $(btn).html( '\
                    <span class="fa fa-save"></span>\
                    Guardar Resultados\
                ').prop('disabled',false);
            });
        },
        cancel: function () {
            console.log('false');
        }
    });
});
