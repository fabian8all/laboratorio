<h1 class="h3 mb-2 text-gray-800">Cortes</h1>
<button type="button" class="btn btn-primary" data-target="#modPdfCortes" data-toggle="modal">Boton prueba formato PDF</button>
<div class="row">
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <div class="input-group">
                <label class="font-weight-bold" style="display:inline-block;display: flex;align-items: center;"
                    for="">Cliente:&nbsp; </label>
                <select name="" id="select_status" style="display:inline-block;" class="form-control selectpicker"
                    data-live-search="true">
                    <option value="" disabled selected>Seleccione paciente</option>
                    <option value="1">ACTIVOS</option>
                    <option value="0">INACTIVOS</option>
                    <option value="3">ELIMINADOS</option>
                    <option value="2">TODOS</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modAgregarCliente">
                        <i class="fas fa-plus fa-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <div class="input-group">
                <label class="font-weight-bold" style="display:inline-block;display: flex;align-items: center;"
                    for="">Último corte:&nbsp; </label>
                <label style="display:inline-block;display: flex;align-items: center;" for=""> 02/02/2020</label>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="" class="font-weight-bold" style="display:inline-block;display: flex;align-items: center;">
                    Fecha Inicio &nbsp;
                </label>
                <input type="date" name="" class="form-control" id="">
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="" class="font-weight-bold" style="display:inline-block;display: flex;align-items: center;">
                    Fecha Fin &nbsp;
                </label>
                <input type="date" name="" class="form-control" id="">
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div id="tableContainer" class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead id="thead" class="text-center">
                    <th>FECHA</th>
                    <th>PACIENTE</th>
                    <th>COSTO</th>
                    <th>ESTADO</th>
                    <th>OPCIONES</th>
                </thead>
                <tbody id="tbody" class="text-center">
                    <tr>
                        <td>07/01/2020</td>
                        <td>Jose Ramon Diaz Ortega</td>
                        <td>$800.00</td>
                        <td><span class="btn btn-warning btn-sm" style="color:white">Pendiente de muestra</span></td>
                        <td>
                            <button type="" class="btn btn-info btn-sm" title="Detalles"><i
                                    class="fas fa-list"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>07/01/2020</td>
                        <td>Jose Ramon Diaz Ortega</td>
                        <td>$800.00</td>
                        <td><span class="btn btn-primary btn-sm">En proceso</span></td>
                        <td>
                            <button type="" class="btn btn-info btn-sm" title="Detalles"><i
                                    class="fas fa-list"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>07/01/2020</td>
                        <td>Jose Ramon Diaz Ortega</td>
                        <td>$800.00</td>
                        <td><span class="btn btn-danger btn-sm">Pendiente de pago</span></td>
                        <td>
                            <button type="" class="btn btn-info btn-sm" title="Detalles"><i
                                    class="fas fa-list"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>07/01/2020</td>
                        <td>Jose Ramon Diaz Ortega</td>
                        <td>$800.00</td>
                        <td><span class="btn btn-success btn-sm">Finalizado</span></td>
                        <td>
                            <button type="" class="btn btn-info btn-sm" title="Detalles"><i
                                    class="fas fa-list"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-7 col-md-2 col-12">
    </div>
    <div class="col-lg-3 col-md-5 col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="" class="font-weight-bold"
                    style="display:inline-block;display: flex;align-items: center;">Subtotal: &nbsp;</label>
                <label for="" class="" style="display:inline-block;display: flex;align-items: center;">$100.00</label>
            </div>
            <div class="input-group">
                <label for="" class="font-weight-bold"
                    style="display:inline-block;display: flex;align-items: center;">Descuento: &nbsp;</label>
                <label for="" class="" style="display:inline-block;display: flex;align-items: center;">$100.00</label>
            </div>
            <div class="input-group">
                <label for="" class="font-weight-bold"
                    style="display:inline-block;display: flex;align-items: center;">Total:&nbsp; </label>
                <label for="" class="" style="display:inline-block;display: flex;align-items: center;">$100.00</label>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-5 col-12">
        <div class="form-group">
            <button type="button" class="btn btn-primary w-100">Realizar corte</button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-success w-100">Imprimir</button>
        </div>
    </div>
</div>
<div id="modPdfCortes" class="modal" tabindex="-1" role="dialog" style="overflow-y: auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del estudio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <thead>
                        <tr>
                            <th rowspan="6">
                                <img src="resources/logoFormato.jpeg" style="width:200px;" alt="">
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="2" rowspan="" headers="" scope="">LABORATORIO DE ANÁLISIS CLÍNICOS Y BACTERIOLÓGICOS</th>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2" rowspan="" headers="">MATRIZ: BLVD. Camino Real No. 318 Int 5, Col, Las Viboras, Colima,Col.</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2" rowspan="" headers="">Teléfono: (312) 16 06 333, 3121093341, 3121223644</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2" rowspan="" headers="">Horario: Lunes a Viernes 7:00am-9:00pm y Sábado 7:00am-2:00pm</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="2" rowspan="" headers="">laboratoriodml@hotmail.com &nbsp;&nbsp;&nbsp;&nbsp;servicio de urgencia las 24hrs.</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="" rowspan="" headers=""></td>
                            <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Cliente: </b> José Ramón Díaz Ortega</td>
                        </tr>
                        <tr>
                            <td colspan="" rowspan="" headers=""></td>
                            <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Fecha de corte: </b> 12/12/2020</td>
                        </tr>
                        <tr>
                            <td colspan="" rowspan="" headers=""></td>
                            <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Total a pagar: </b> $100.00</td>
                        </tr>
                        <tr>
                            <td colspan="" rowspan="" headers=""></td>
                            <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Estado: </b> Pagado</td>
                        </tr>
                        <tr>
                            <td colspan="" rowspan="" headers=""></td>
                            <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Estudios: </b> 17 ALFA HIDROXI PROGESTERONA (SUERO)</td>
                        </tr>
                        <tr>
                            <td colspan="" rowspan="" headers=""></td>
                            <td style="text-align: left;" colspan="2" rowspan="" headers=""><b>Costo: </b> $100.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnEstudiosSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
