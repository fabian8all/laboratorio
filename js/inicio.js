var ajaxError     = "Ocurrió un error inesperado, intentelo mas tarde o pongase en contaco con el administrador";

$(document).ready(function(){
    $.post("routes/routeEstudios.php",{info:{},action:'getAll'})
    .done(function(data){
        if(data != null){
            data = $.parseJSON(data);
            if (!data){
                customAlert("Error!", "No hay estudios");
            }else{
                load_estudios(data);
            }
        } else{
            customAlert("Error!", ajaxError);
        }
    })
    .fail(function(error){
        customAlert("Error!", ajaxError);
    });
})

function load_estudios(data){
    console.log(data);
    cards = "";
    $(data).each(function(key,val){
       cards += "<div class='col-4'>\
                    <div class='card'>\
                        <div class='card-header card-primary'>\
                            <div class='card-title'>\
                                <h6>\
                                    <span class='badge badge-warning'>"+val.codigo+"</span>\
                                    "+val.nombre+"\
                                </h6>\
                            </div>\
                        </div>\
                        <div class='card-body'>\
                            <p>"+val.muestra+"</p>\
                            <p><strong>Tiempo: </strong>"+val.tiempo+"</p>\
                            <p><strong>Costo: </strong>$"+val.costo+"</p>\
                        </div>\
                    </div>\
                </div>";
    });
    $("#divEstudiosCards").html(cards);
}
