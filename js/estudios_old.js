var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

    $(document).ready(function(){
        $('#bstableEstudios').bootstrapTable({
            queryParams: function (p) {
                return {
                    search          : p.search,
                    limit           : p.limit,
                    offset          : p.offset,
                    sort            : p.sort,
                    order           : p.order,
                };
            },
            formatShowingRows: function (pageFrom, pageTo, totalRows) {
                return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' estudios';
            },
            formatRecordsPerPage: function (pageNumber) {
                return pageNumber + ' estudios por página';
            },
            formatNoMatches: function () {
                return 'No se encontraron estudios registradas';
            },
            formatLoadingMessage: function(){
                return 'Cargando lista de estudios';
            }
        });
    });

    function formatEstudiosOptions(value, row, index){
        var options = "\
            <div class='dropup'> \
                <button class='btn btn-circle btn-sm btn-outline-warning btnEstudiosEdit' data-idestudio='" + value + "' data-toggle='tooltip' data-placement='top' title='Editar' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-edit fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
                <button class='btn btn-circle btn-sm btn-outline-danger btnEstudiosDel' data-idestudio='" + value + "' data-toggle='tooltip' data-placement='top' title='Eliminar' aria-haspopup='true' aria-expanded='false'>\
                    <span class='fas fa-fw fa-trash fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                </button>\
            </div>";

        return options;
    }

    function formatEstudiosPrecio(value, row, index){
        var formatted = "$"+parseFloat(value).toFixed(2);

        return formatted;
    }

    function ajaxGetEstudios(params){

        $.ajax({
            type: "POST",
            url: "routes/routeEstudios.php",
            data: {info:params.data,action:'BSTableData'},
            dataType: "json",
            success: function (data) {
                console.log(data);
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

function load_tabla_estudios(data) {
    table = "";
    $(data).each(function (key, val) {
        table += "<tr>\
                    <td>" + val.codigo + "</td>\
                    <td>" + val.nombre + "</td>\
                    <td> -- </td>\
                    <td>" + val.costo + "</td>\
                    <td>\
                        <div class='form-inline'>\
                            <button class='btn btn-outline-warning btnEstudiosEdit' data-idestudio='" + val.id + "' data-toggle='tooltip' title='Editar'>\
                                <span class='fa fa-edit'></span>\
                            </button>\
                            <button class='btn btn-outline-danger btnEstudiosDel' data-idestudio='" + val.id + "' data-toggle='tooltip' title='Eliminar'>\
                                <span class='fa fa-trash-o'></span>\
                            </button>\
                        </div>\
                    </td>\
                 </tr>";
    });
    $("#tableEstudios").html(table);
}

    $("#btnEstudiosAdd").click(function(){
        $("#frmEstudios").trigger('reset');
        $("#hidEstudiosMode").val("new");
        $("#divCardEstudiosPruebas").html("");
        addClassPrueba('',0,0,1);
        $("#modalEstudios").modal('show');
    });

    $(document).on('click','.btnEstudiosEdit',function(){
        id = $(this).data('idestudio');
        $.post('routes/routeEstudios.php',{info:id,action:'get'})
            .done(function(data){
                if(data != null){
                    data =  $.parseJSON(data);
                    $('#hidEstudiosMode').val('update');
                    $('#hidEstudiosId').val(data.id);
                    $('#txtEstudiosCode').val(data.codigo);
                    $('#txtEstudiosNombre').val(data.nombre);
                    $('#txtEstudiosTiempo').val(data.tiempo);
                    $('#txtEstudiosCosto').val(data.costo);
                    $('#txtEstudiosMuestra').val(data.muestra);
                    $("#accordion").html("");
                    if (data.pruebas){
                        pruebas = $.parseJSON(data.pruebas);
                        $(pruebas).each(function(k,v){
                            if (v.tipo == 1) {
                                data = v.pruebas
                            }else if (v.tipo == 2){
                                data = {interps:v.interps,pruebas:v.pruebas};
                            }else {
                                v.tipo = 1;
                                data = v.pruebas
                            }
                           addClassPrueba(v.nombre,0,data,v.tipo)
                        });

                    }else{
                        addClassPrueba('',0,0,1);
                    }

                    $("#modalEstudios").modal('show');
                }else{
                    customAlert("Error!", "No se encuentra la información del estudio");
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            })
    });

    $(document).on('click','.btnEstudiosDel',function(){
       id= $(this).data('idestudio');
        $.confirm({
            title: 'Atencion!',
            content: '¿Esta seguro que desea eliminar este estudio?',
            confirm: function(){
                $.post('routes/routeEstudios.php',{info: id,action: "Delete"},function(data){
                    if(data == 'true')
                        customAlert("Exito!", "El estudio ha sido eliminado");
                    else
                        customAlert("Error!", "Error al intentar eliminar el estudio");
                    load_estudios_data()
                }).fail(function(error){
                    customAlert("Error!", ajaxError);
                });
            },
            cancel: function(){
                console.log('false');
            }
        });
    });

    $("#btnEstudiosSave").click(function(){
        clasifs =[];
        $('.hidNomClasif').each(function(k,v){
            ok = 1;
            nomClasif = $(v).val();
            panelClasif = $(v).closest('.card');

            tipoClasif = $(panelClasif).find('.selEstudiosTipoClasif').val();


            if (tipoClasif == '2'){
                interps = [];
                noHayInterpretaciones = true;
                interpretaciones = $(panelClasif).find('.divInterpretacion');
                $(interpretaciones).each(function(k,interp){
                    noHayInterpretaciones = false;
                    interpVal = $(interp).find('.txtClasifInterpretacionValor').val();
                    interpNom = $(interp).find('.txtClasifInterpretacionNombre').val();
                    interpObj = {valor: interpVal, nombre: interpNom };
                    interps.push(interpObj);
                });
                if (noHayInterpretaciones){
                    ok = 5;
                }
            }

            pruebas = [];
            noHayPruebas = true;
            $(panelClasif).find('.divPrueba').each(function(key,divPrueba){
                noHayPruebas = false;
                nomPrueba = $(divPrueba).find('.txtEstudiosNomPrueba').val();
                if (nomPrueba == ""){
                    ok=2;
                    pruebaError = divPrueba;
                    return false;
                }
                prueba = {
                    nombre: nomPrueba,
                }
                if (tipoClasif =='1'){
                    prueba.referencia = $(divPrueba).find('.txtEstudiosRefPrueba').val();
                }
                pruebas.push(prueba);
            });
            if (noHayPruebas){
                ok=3;
            }

            clasif = {
                nombre: nomClasif,
                tipo: tipoClasif,
                pruebas: pruebas
            };

            if (tipoClasif == '2'){
                clasif.interps = interps;
            }

            clasifs.push(clasif);
        });
    if (ok == 1){

        pruebas = JSON.stringify(clasifs);
        info =  {
            codigo: $("#txtEstudiosCode").val(),
            nombre: $("#txtEstudiosNombre").val(),
            categoria: $("#selEstudiosCategoria").val(),
            tiempo: $("#txtEstudiosTiempo").val(),
            costo: $("#txtEstudiosCosto").val(),
            muestra: $("#txtEstudiosMuestra").val(),
            pruebas: pruebas
        }
        if ($('#hidEstudiosMode').val() == "new"){
            action="Add";
        }else if($('#hidEstudiosMode').val() == "update"){
            action="Update";
            info.id = $("#hidEstudiosId").val();
        }
        $('#btnEstudiosSave').html( '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
        ).prop('disabled',true);
        $.post("routes/routeEstudios.php",{info:info,action:action})
            .done(function(data){
                if(data){
                    customAlert("Exito!", "La información se ha guardado con exito");
                    $("#modalEstudios").modal('hide');
                    $('#bstableEstudios').bootstrapTable('refresh');
                } else{
                    customAlert("Error!", "Ocurrió un error al intentar guardar la información");
                }
            })
            .fail(function(error){
                customAlert("Error!", ajaxError);
            })
            .always(function(){
                $('#btnEstudiosSave').html( '\
                    <span class="fa fa-save"></span>\
                    Guardar\
                ').prop('disabled',false);
            });
    }else if (ok == 0){
        customAlert("Error!", "No hay clasificaciones");
        return false;
    }else if (ok == 2){
        $(pruebaError).focus();
        customAlert("Error!", "Falta nombre de alguna de las pruebas");
        return false;
    }else if(ok==3){
        customAlert("Error!", "No hay pruebas en alguna de las clasificaciones");
        return false;
    }else if(ok==4){
        customAlert("Error!", "El tipo de la clasificación requiere interpretaciones");
        return false;
    }else{
        customAlert("Error!", "Ocurrió un error");
        return false;
    }


    });

    $("#btnEstudiosModalClassPrueba").click(function(e){
       e.preventDefault();
        $("#txtEstudiosNomClassPrueba").val('');
        $("#modalEstudiosClassPrueba").modal('show');
    });

    $("#btnEstudiosAddClassPrueba").click(function(e) {
        e.preventDefault();
        addClassPrueba($('#txtEstudiosNomClassPrueba').val(),0,0,1);
        $("#modalEstudiosClassPrueba").modal('hide');
    });



$(document).on('click',".btnModalEditClasif",function(e) {
    e.preventDefault();
    divClasif = $(this).closest('.card').find('.collapse').prop('id');
    hidNomClasif = $(this).closest('.card').find('.hidNomClasif');
    $("#txtEditNomClasif").val(hidNomClasif.val());
    $("#btnEditClasif").data('divclasif',divClasif);
    $("#modalEditClasif").modal('show');
});

$(document).on('click',"#btnEditClasif",function(e) {
    e.preventDefault();
    divClasif = $(this).data('divclasif');
    clasif = $('#txtEditNomClasif').val();
    nomClasif = (clasif != "")?clasif:"sin clasificación";
    valClasif = clasif;
    noSpaces = clasif.replace(/\s/g,"_");
    card = $('#'+divClasif).closest('.card');
    ahref = $(card).find('.hrefCollapse');
    collapse = $(card).find('.collapse');
    hidNomClasif = $(card).find('.hidNomClasif');
    $(ahref).attr('data-target',"#divClasif_"+noSpaces);
    $(ahref).html(nomClasif);
    $(hidNomClasif).val(valClasif);
    $(collapse).prop('id',"divClasif_"+noSpaces)
    $("#modalEditClasif").modal('hide');
});

function addClassPrueba(clasif,sin,clasifData,tipo){
    nomClasif = (clasif != "")?clasif:"sin clasificación";
    valClasif = clasif;
    noSpaces = clasif.replace(/\s/g,"_");

    interps = [];
    if (tipo == 2){
        interps = clasifData.interps;
        clasifData = clasifData.pruebas;
    }

    if (!($("#divClasif_"+noSpaces).length)){
        panel = $("#accordion");

        frmClasif = '<div class="row">   \
                    <div class="col-sm-12">   \
                        <div class="card" >\
                            <div class="card-header card-info" style="border-radius:'+((sin==0)?'20px 20px 0 0;':'20px 20px 20px 20px;')+'">\
                                <div class="card-title">\
                                    <div class="col-sm-6">\
                                        <span class="fa '+((sin==0)?'fa-chevron-circle-down':' fa-chevron-circle-right')+'">\
                                        <a class="hrefCollapse" role="button" data-toggle="collapse" data-parent="#accordion" data-target="#divClasif_'+noSpaces+'" aria-expanded="true" aria-controls="collapseOne">\
                                            '+nomClasif+'\
                                        </a>\
                                    </div>\
                                    <input type="hidden" class="hidNomClasif" value="'+valClasif+'">\
                                </div>\
                                <div class="float-right">\
                                    <button class="btn btn-warning btnModalEditClasif">\
                                        <span class="fa fa-edit"></span>\
                                    </button>\
                                    <button class="btn btn-danger btnDelClasif collapsed">\
                                        <span class="fa fa-trash-o"></span>\
                                    </button>\
                                </div>\
                            </div>\
                            <div id="divClasif_'+noSpaces+'" class="collapse '+((sin==0)?'show':'')+'" role="tabpanel" >\
                                <div class="card-body">\
                                    <div class="row divEstudiosClasifConsole">\
                                        <div class="col-12" >\
                                            <div class="col-6">\
                                                <label class="col-form-label">\
                                                    <strog>Tipo:</strog>\
                                                </label>\
                                                <select class="form-control selEstudiosTipoClasif">\
                                                    <option '+((tipo==1)?'selected':'')+' value="1">Resultado</option>\
                                                    <option '+((tipo==2)?'selected':'')+' value="2">Interpretación</option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                        <div class="col-12 divEstudiosInterpretaciones" '+((tipo!=2)?'style="display: none;"':'')+' >\
                                            <hr>\
                                            <div class="row">\
                                                <div class="col-12">\
                                                    <div class="float-left">\
                                                        <h3>Interpretaciones</h3>\
                                                    </div>\
                                                    <div class="float-right">\
                                                        <br/>\
                                                        <button class="btn btn-success btnAddInterpretacion">\
                                                            <span class="fa fa-plus-square-o"></span>\
                                                            Agregar\
                                                        </button>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                            <hr>\
                                            <div class="divInterpretaciones">\
        ';

        if (!interps){
            frmClasif += addInterpretacion(0,true)
        }else{
            $(interps).each(function(k,interpretacion){
                first = (k==0)?true:false;
                frmClasif += addInterpretacion(interpretacion,first);
            });
        }

        frmClasif += '\
                                            </div>\
                                        </div>\
                                    </div>\
        ';

        if (clasifData == 0){
            frmClasif += addPrueba(0,true,tipo)
        }else{
            $(clasifData).each(function(k,prueba){
                first = (k==0)?true:false;
                frmClasif += addPrueba(prueba,first,tipo);
            });
        }
        frmClasif += '\
                                </div>\
                                <div class="card-footer">\
                                    <div class="row">\
                                        <div class="col-6 float-right">\
                                            <button class="btn btn-info btnEstudiosAddPrueba">\
                                                <span class="fa fa-plus-square-o"></span>\
                                                Agregar prueba\
                                            </button>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>';
        $(panel).append(frmClasif);
    }else{
        customAlert("Error!", "El nombre de la clasificación ya existe");
    }

}

$(document).on('change','.selEstudiosTipoClasif',function(){
    sel = $(this);
    panel = sel.closest('.divEstudiosClasifConsole');
    divClasif = panel.closest('.card-body')
    if (sel.val()=='2'){
        panel.find(".divEstudiosInterpretaciones").show();
        divClasif.find(".divReferencia").hide();
    }else{
        panel.find(".divEstudiosInterpretaciones").hide();
        divClasif.find(".divReferencia").show();
    }

});

$(document).on('click',".btnAddInterpretacion",function(e){
   e.preventDefault();
   div = $(this).closest(".divEstudiosInterpretaciones").find(".divInterpretaciones");
    $(div).append(addInterpretacion(0,false));
});

function addInterpretacion(data,first){
    interp = '\
                <div class="divInterpretacion row">\
            ';
    interp += (!first)?'<hr>':'';
    interp += '\
                    <div class="col-2">\
                        <br/>\
                        <button class="btn btn-danger btn-sm btnDelInterpretacion">\
                            <span class="fa fa-trash"></span>\
                        </button>\
                    </div>\
                    <div class="col-5">\
                        <label class="">\
                            Valor\
                        </label>\
                        <input type="text" class="txtClasifInterpretacionValor form-control" value="'+data.valor+'">\
                    </div>\
                    <div class="col-5">\
                        <label class="">\
                            Interpretación\
                        </label>\
                        <input type="text" class="txtClasifInterpretacionNombre form-control" value="'+data.nombre+'">\
                    </div>\
                </div>\
            ';
    return interp;
}

$(document).on('click','.btnDelInterpretacion',function(e){
   e.preventDefault();
   $(this).closest(".divInterpretacion").remove();
});

$(document).on('click',".btnDelClasif",function(e) {
    e.preventDefault();
    $(this).closest('.card').remove();
});

$(document).on('click',".btnEstudiosAddPrueba",function(e){
    e.preventDefault();
    panel = $(this).closest('.card').find('.card-body');
    tipo = panel.find('.selEstudiosTipoClasif').val();
    frmPrueba = addPrueba(0, false,tipo);
    $(panel).append(frmPrueba);

});

function addPrueba(data,first,tipo){
    if(data == 0){
        nombre = "";
        referencia = "";
    }else{
        nombre = data.nombre;
        referencia = data.referencia;
    }
    hideRef = (tipo == '2') ? 'style="display:none;"':"";
    valRef = (tipo == '1') ? referencia:'';
    frmPrueba =  '<div class="divPrueba">';
    frmPrueba += (!first)?'<hr>':'';
    frmPrueba +=      '<div class="row">\
                            <div class="col-5">\
                                <label class="col-form-label"> \
                                    Prueba:\
                                    <input type="text" class="txtEstudiosNomPrueba form-control" value="'+nombre+'" />\
                                </label>\
                            </div>\
                            <div class="col-5 divReferencia" '+hideRef+'>\
                                <label class="col-form-label">\
                                    Referencia:\
                                    <input type="text" class="txtEstudiosRefPrueba form-control" value="'+valRef+'"/>\
                                </label>\
                            </div>\
                            <div class="col-2"> \
                                <br/>\
                                <button class="btn btn-sm btn-danger btnDelPrueba">\
                                    <span class="fa fa-trash-o"></span>\
                                </button>\
                            </div>\
                        </div>\
                    </div>';
    return frmPrueba;
}

$(document).on('click',".btnDelPrueba",function(e){
    e.preventDefault();
    $(this).closest(".divPrueba").remove();
});
