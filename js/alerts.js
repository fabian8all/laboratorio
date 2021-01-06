function refreshAlerts(){
    $.post('routes/routeResultados.php',{info:{},action:"getAlerts"})
        .done(function(data){
            data = $.parseJSON(data);
            if (data){
                $('#divAlerts').html(data.lg);
                $('#divAlertsSm').html(data.sm);
            }
        })
        .fail(function(error){
            customAlert("Error!","Error al actualizar las alertas")
        });
}
refreshAlerts();
