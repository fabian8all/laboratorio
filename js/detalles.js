$(document).on('click','.btnDetalles',function(){
    id=$(this).data('idresult');
    $.post("routes/routeResultados.php",{info:id,action:'get'})
        .done(function(data){
            data =  $.parseJSON(data);
            if(data){
                estudios = "";
                costo = 0;
                $(data.estudios).each(function(k,v){
                    estudios += "\
                        <tr><td>"+v.estudio+"</td></tr>\
                    ";
                });
                $('#listaEstudios').html(estudios);

                pagado = $.parseJSON(data.pagado);
                lblPagado = "\
                    <div class='row'>\
                        <div class='col-12'>";
                lblPagado+=(pagado.completo)
                    ?"<span class='badge badge-success'>pagado</span>"
                    :"<span class='badge badge-warning'>pendiente</span>";
                lblPagado +="\
                        </div>\
                        <div class='col-12'>\
                            <table class='table table-borderless table-responsive table-striped'>\
                                <thead>\
                                    <tr>\
                                        <th>PAGO</th>\
                                        <th>TIPO</th>\
                                        <th>FECHA</th>\
                                        <th>REFERENCIA</th>\
                                    </tr>\
                                </thead>\
                                <tbody>";
                c = 0;
                $(pagado.pagos).each(function(k,v){
                    c++;
                    if(parseFloat(v.cantidad) > 0){
                        lblPagado += "\
                                            <tr>\
                                                <td>$"+parseFloat(v.cantidad).toFixed(2)+"</td>\
                                                <td>"+v.tipo+"</td>\
                                                <td>"+v.fecha+"</td>\
                                                <td>"+v.referencia+"</td>\
                                            </tr>\
                                        ";
                    }
                });
                console.log(c);
                lblPagado += (c == 0)?"<tr><td colspan='3'>No hay pagos registrados</td></tr>":"";
                lblPagado += "\
                                </tbody>\
                            </table>\
                        </div>\
                    </div>\
                ";

                $('#lblCosto').html("$"+parseFloat(data.costo).toFixed(2));
                $('#lblDescuento').html("%"+parseFloat(data.descuento).toFixed(2));
                $('#lblFechaSol').html(data.fechaSolicitud);
                $('#lblFechaMuestra').html((data.fechaMuestra)?data.fechaMuestra:"--");
                $('#lblPagado').html(lblPagado);
                $('#lblFechaEntrega').html((data.fechaEntrega)?data.fechaEntrega:"--");
                $('#lblAnalista').html(data.analista);

                $('#modalDetalles').modal('show');

            } else{
                customAlert("Error!", "Ocurrió un error al intentar obtener la información");
            }
        })
        .fail(function(error){
            customAlert("Error!", ajaxError);
        })
});
