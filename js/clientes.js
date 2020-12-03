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


    function formatClientesOptions(value, row, index){
        var options = "\
                <div class='dropup'> \
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
  $("#hidClientesMode").val("new");
  $("#divClientesChkPass").hide();
  $("#divClientesChgPass").show();
  $("#modalClientes").modal("show");
});


    $(document).on('click','.btnClientesDel',function(){
       id= $(this).data('idcliente');
        $.confirm({
            title: 'Atencion!',
            content: '¿Esta seguro que desea eliminar este cliente?',
            confirm: function(){
                $.post('routes/routeClientes.php',{info: id,action: "Delete"},function(data){
                    data =$.parseJSON(data);
                    if(data.success)
                        customAlert("Exito!", data.msg);
                    else
                        customAlert("Error!", data.msg);
                    $('#bstableClientes').bootstrapTable('refresh');
                }).fail(function(error){
                    customAlert("Error!", ajaxError);
                });
            },
            cancel: function(){
                console.log('false');
            }
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
          if (data == "true")
            customAlert("Exito!", "El cliente ha sido eliminado");
          else customAlert("Error!", "Error al intentar eliminar al cliente");
          load_clientes_data();
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
    descuento: $("#txtClientesDescuento").val(),
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
