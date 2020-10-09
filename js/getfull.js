$(document).ready(function(){
    loadRestauranteData();
});

function loadRestauranteData() {
    $.post("routes/routeRestaurantes.php", {info: {userId: userId}, action: 'get'})
        .done(function (data) {
            if (data != null) {
                data = $.parseJSON(data);
                if (data.prueba == 0) {
                    $('#spanVersion').html('completo');
                    $('#divGetFull').hide();
                } else {
                    $('#spanVersion').html('básico');
                    if(data.prueba == 2){
                        $('#btnSolicitarFull').prop('disabled',true);
                        $('#divGetFull').append('<p> *Su solicitud para obtener el paquete completo está siendo procesada. Los administradores se pondran en contacto con usted a la brevedad.</p>')
                    }
                }
            }
        })
    }

$('#btnSolicitarFull').click(function(e){
    $.post("routes/routeUsuarios.php",{info: userId, action: 'requestFull'})
        .done(function(data){
            if(data = 'true'){
               customAlert('Exito',"Su solicitud para obtener el paquete completo está siendo procesada.<br\/> \
                   Los administradores se pondrán en contacto con usted a la brevedad");
            }else{
                customAlert("Error!", "Ocurrió un error al procesar su solicitud");
            }
        })
});
