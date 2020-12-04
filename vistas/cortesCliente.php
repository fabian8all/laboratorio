<div class="row">
    <div class="col-12">
        <div class="title text-center">
            <h1 class="h3 mb-2 text-gray-800">
                Cortes
            </h1>
        </div>
    </div>
</div>
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
