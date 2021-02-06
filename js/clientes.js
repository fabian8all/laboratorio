var ajaxError =
  "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function () {
  $("#bstableClientes").bootstrapTable({
    queryParams: function (p) {
      return {
        search: p.search,
        limit: p.limit,
        offset: p.offset,
        sort: p.sort,
        order: p.order,
      };
    },
    formatShowingRows: function (pageFrom, pageTo, totalRows) {
      return (
        "Mostrando " +
        pageFrom +
        " a " +
        pageTo +
        " de un total de " +
        totalRows +
        " clientes"
      );
    },
    formatRecordsPerPage: function (pageNumber) {
      return pageNumber + " clientes por página";
    },
    formatNoMatches: function () {
      return "No se encontraron clientes registradas";
    },
    formatLoadingMessage: function () {
      return "Cargando lista de clientes";
    },
  });
});

    $(document).ready(function(){
        $('#bstableClientes').bootstrapTable({
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
                return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de un total de ' + totalRows + ' clientes';
            },
            formatRecordsPerPage: function (pageNumber) {
                return pageNumber + ' clientes por página';
            },
            formatNoMatches: function () {
                return 'No se encontraron clientes registradas';
            },
            formatLoadingMessage: function(){
                return 'Cargando lista de clientes';
            },
            formatSearch: function(){
                return 'Buscar';
            }
        });
    });

    function formatClientesOptions(value, row, index){
        var options = "\
                <div class='dropup'> \
                    <button class='btn btn-circle btn-sm btn-outline-info btnClientesHistory' data-nombre='"+row.nombre+"' data-idcliente='" + value + "' data-toggle='tooltip' data-placement='top' title='Historial de cortes' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-history fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                    <button class='btn btn-circle btn-sm btn-outline-warning btnClientesEdit' data-idcliente='" + value + "' data-toggle='tooltip' data-placement='top' title='Editar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-edit fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                    <button class='btn btn-circle btn-sm btn-outline-danger btnClientesDel' data-idcliente='" + value + "' data-toggle='tooltip' data-placement='top' title='Eliminar' aria-haspopup='true' aria-expanded='false'>\
                        <span class='fas fa-fw fa-trash fa-lg' aria-hidden='true'></span><span class='sr-only'>Opciones</span> <span class='caret'></span>\
                    </button>\
                </div>";

  return options;
}

function formatClientesDescuento(value, row, index) {
  var formatted = "%" + parseFloat(value).toFixed(2);

  return formatted;
}

function formatClientesLista(value, row, index) {
        switch (value){
            case '1' : lista = "Público general"; break;
            case '2' : lista = "Precio Médico"; break;
            case '3' : lista = "Precio Empresa"; break;
            case '4' : lista = "Precio Lista 4"; break;
            case '5' : lista = "Precio Lista 5"; break;
            default : lista = "Público general"; break;
        }

    return lista;
}

function formatClientesPerfil(value, row, index) {
        switch (value){
            case '2' : perfil = "Médico"; break;
            case '3' : perfil = "Empresa"; break;
            default : perfil = "--"; break;
        }

    return perfil;
}

function ajaxGetClientes(params) {
  $.ajax({
    type: "POST",
    url: "routes/routeClientes.php",
    data: { info: params.data, action: "BSTableData" },
    dataType: "json",
    success: function (data) {
      console.log(data);
      params.success({
        total: data.count,
        rows: data.rows,
      });
    },
    error: function (er) {
      params.error(er);
    },
  });
}

$("#btnClientesAdd").click(function () {
    $("#frmClientes").trigger("reset");
    $("#txtClientesUser").prop("disabled", false);
    $("#hidClientesMode").val("new");
    $("#divClientesChkPass").hide();
    $("#divClientesChgPass").show();
    $("#modalClientes").modal("show");
});


$(document).on("click", ".btnClientesEdit", function () {
    id = $(this).data("idcliente");
    $.post("routes/routeClientes.php", { info: id, action: "get" })
        .done(function (data) {
            if (data != null) {
                data = $.parseJSON(data);
                $("#hidClientesMode").val("update");
                $("#hidClientesId").val(data.id);
                $("#txtClientesNombre").val(data.nombre);
                $("#txtClientesUser").val(data.username).prop("disabled", true);
                $("#txtClientesEmail").val(data.email);
                $("#selClientesPerfil").val(data.perfil);
                $("#chkClientesChgPass").prop("checked", false);
                $("#divClientesChgPass").hide();
                $("#txtClientesPass1").val("");
                $("#txtClientesPass2").val("");
                $("#txtClientesDescuento").val(data.descuento);
                $("#modalClientes").modal("show");
            } else {
                customAlert("Error!", "No se encuentra la informaciÃ³n del cliente");
            }
        })
        .fail(function (error) {
            customAlert("Error!", ajaxError);
        });
});

$(document).on("click", ".btnClientesDel", function () {
  id = $(this).data("idcliente");
  $.confirm({
    title: "Atencion!",
    content: "¿Esta seguro que desea eliminar este cliente?",
    confirm: function () {
      $.post(
        "routes/routeClientes.php",
        { info: id, action: "Delete" },
        function (data) {
            data = $.parseJSON(data);
            if (data.success)
                customAlert("Exito!", data.msg);
            else
                customAlert("Error!", data.error);
            $('#bstableClientes').bootstrapTable('refresh');
        }
      ).fail(function (error) {
        customAlert("Error!", ajaxError);
      });
    },
    cancel: function () {
      console.log("false");
    },
  });
});

$("#btnClientesSave").click(function () {
  info = {
    nombre: $("#txtClientesNombre").val(),
    username: $("#txtClientesUser").val(),
    email: $("#txtClientesEmail").val(),
    perfil: $("#selClientesPerfil").val(),
    chkpass: $("#chkClientesChgPass").val(),
    pass1: $("#txtClientesPass1").val(),
    pass2: $("#txtClientesPass2").val(),
    lista: $("#selClientesLista").val(),
  };
  if ($("#hidClientesMode").val() == "new") {
    action = "Add";
  } else if ($("#hidClientesMode").val() == "update") {
    action = "Update";
    info.id = $("#hidClientesId").val();
  }
  $("#btnClientesSave")
    .html(
      '\
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> \
               Guardando...'
        ).prop('disabled',true);
        $.post("routes/routeClientes.php",{info:info,action:action})
        .done(function(data){
            if(data){
                data = $.parseJSON(data);
                if(data.success){
                    customAlert("Exito!", data.msg);
                    $("#modalClientes").modal('hide');
                    $('#bstableClientes').bootstrapTable('refresh')
                }else{
                    customAlert("Error!", data.msg);
                }
            } else{
                customAlert("Error!", "Ocurrió un error al intentar guardar la información");
            }
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })
        .always(function(){
            $('#btnClientesSave').html( '\
                <span class="fa fa-save"></span>\
                Guardar\
            '
        )
        .prop("disabled", false);
    });
});

$(document).on('click','.btnClientesHistory',function(){
    idCliente = $(this).data('idcliente');
    nomCliente = $(this).data('nombre');
    $.post('routes/routeCortes.php',{info:idCliente,action:'getHistory'})
        .done(function(data){
            data = $.parseJSON(data);
            if (data){
                html ='<div id="accordion">';
                $(data).each(function(k,corte){
                    html += '\
                    <!-- Collapsable Card Example -->\
                    <div class="card shadow mb-4">\
                        <div class="card-header">\
                            <!-- Card Header - Accordion -->\
                            <a href="#" data-target="#historialCorteCard_'+k+'" class="d-block card-header py-3" data-toggle="collapse"\
                               role="button" aria-expanded="true" aria-controls="historialCorteCard_'+k+'">\
                                <h6 class="m-0 font-weight-bold text-primary">Fecha de corte: '+corte.fechaFin+' - Total: $'+parseFloat(corte.total).toFixed(2)+'</h6>\
                            </a>\
                        </div>\
                        <!-- Card Content - Collapse -->\
                        <div class="collapse histCardCollapse" data-idcorte="'+corte.id+'" id="historialCorteCard_'+k+'" data-parent="#accordion">\
                            <div class="card-body" id="hCC_'+corte.id+'">\
                            </div>\
                        </div>\
                    </div>\
                ';
                });
                html +="</div>"
                $('#bodyHistorialCortes').html(html);
            }else{
                $('#bodyHistorialCortes').html("\
                <div class='alert alert-danger'>\
                    No hay cortes registrados para este cliente\
                </div> \
                ");
            }
            $('#titleNomCliente').html(nomCliente);
            $('#modalHistorialCortes').modal('show');
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })
});

$(document).on('show.bs.collapse','.histCardCollapse', function (e){
    if ( e.target.id.search("historialCorteCard")!=-1) {

        idCorte = $(this).data('idcorte');
        card = $('#hCC_' + idCorte);
        $.post('routes/routeCortes.php', {info: idCorte, action: 'getInfoById'})
            .done(function (data) {
                data = $.parseJSON(data);
                data = data.info.solicitudes;
                if (data) {
                    html = "";
                    $(data).each(function (k, solicitud) {
                        html += '\
                                <table class="table table-striped table-borderless table-condensed table-responsive" style="display: table;">\
                                    <thead>\
                                        <tr>\
                                            <th>' + solicitud.paciente + '</th>\
                                            <th>' + solicitud.fecha + '</th>\
                                            <th>$' + parseFloat(solicitud.total).toFixed(2) + '</th>\
                                        </tr>\
                                    </thead>\
                                    <tbody>\
                                        <tr>\
                                            <th>&nbsp;</th>\
                                            <th>Estudios</th>\
                                            <th>Costo</th>\
                                        </tr>\
                                                ';
                        $(solicitud.estudios).each(function (k2, estudio) {
                            html += '\
                                <tr>\
                                    <td>&nbsp;</td>\
                                    <td>' + estudio.nombre + '</td>\
                                    <td>$' + parseFloat(estudio.costo).toFixed(2) + '</td>\
                                </tr>\
                                ';
                        });

                        html += '\
                                    </tbody>\
                                </table>\
                        ';
                    });
                    card.html(html);
                } else {
                    console.log('No hay datos');
                }
            })
            .fail(function (error) {
                customAlert("Error!", ajaxError);
            })
    }
})
