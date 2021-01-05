function refreshAlerts(){
    $.post('routes/routeResultados.php',{info:{},action:"getAlerts"})
        .done(function(data){
            data = $.parseJSON(data);
            if (data){
                $('#divAlerts').html(data);
            }
        })
        .fail(function(error){
            customAlert("Error!","Error al actualizar las alertas")
        });
}
refreshAlerts();
