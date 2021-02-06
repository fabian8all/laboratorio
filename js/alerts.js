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
function validaphone(e) {
    var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
}
function validaemail(id,submit){
        if ($("#"+id).val() !="") {
            var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test($("#" + id).val());
            if (!re) {
                $("#" + id).css({
                    "border-color": "#ff0000",
                    "border-width": "1px",
                    "border-style": "solid"
                });
                $("#"+submit).prop('disabled',true);
            } else {
                $("#" + id).css({
                    "border-color": "#d1d3e2",
                    "border-width": "1px",
                    "border-style": "solid"
                });
                $("#"+submit).prop('disabled',false);
            }
        }else{
            $("#" + id).css({
                "border-color": "#d1d3e2",
                "border-width": "1px",
                "border-style": "solid"
            });
            $("#"+submit).prop('disabled',false);
        }
}
