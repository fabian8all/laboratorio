<div class="row">
    <div class="col-12">
        <div class="title text-center">
            <h1 class="h3 mb-2 text-gray-800">
                Corte de Pagos
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <div class="input-group">
                <label class="font-weight-bold" style="display:inline-block;display: flex;align-items: center;"
                    for="">Tipo:&nbsp; </label>
                <select name="" id="selTipo" style="display:inline-block;" class="form-control">
                    <option value="dia">Día</option>
                    <option value="periodo">Periodo</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12"></div>
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="" class="font-weight-bold" style="display:inline-block;display: flex;align-items: center;">
                    Fecha Inicio &nbsp;
                </label>
                <input type="date" name="" class="form-control" id="dateCorteInicio">
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group" id = "divCorteFin" style="display: none;">
            <div class="input-group">
                <label for="" class="font-weight-bold" style="display:inline-block;display: flex;align-items: center;">
                    Fecha Fin &nbsp;
                </label>
                <input type="date" name="" class="form-control" id="dateCorteFin">
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div id="tableContainer" class="table-responsive">
            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead id="thead" class="text-center">
                    <th>PACIENTE/CLIENTE</th>
                    <th>PAGO</th>
                    <th>TIPO</th>
                    <th>REFERENCIA</th>
                    <th>MODULO</th>
                    <th>FECHA/HORA</th>
                </thead>
                <tbody class="text-center" id="tablaSolicitudesCorte">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-3 col-12">
        <div class="input-group">
            <label for="" class="font-weight-bold"
                   style="display:inline-block;display: flex;align-items: center;">Pacientes:&nbsp; </label>
            <label for="" class="" id="lblTotalPacientes" style="display:inline-block;display: flex;align-items: center;"></label>
        </div>
        <div class="input-group">
            <label for="" class="font-weight-bold"
                   style="display:inline-block;display: flex;align-items: center;">Clientes:&nbsp; </label>
            <label for="" class="" id="lblTotalClientes" style="display:inline-block;display: flex;align-items: center;"></label>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12">
        <div class="input-group">
            <label for="" class="font-weight-bold"
                   style="display:inline-block;display: flex;align-items: center;">Efectivo:&nbsp; </label>
            <label for="" class="" id="lblTotalEfectivo" style="display:inline-block;display: flex;align-items: center;"></label>
        </div>
        <div class="input-group">
            <label for="" class="font-weight-bold"
                   style="display:inline-block;display: flex;align-items: center;">Tarjeta:&nbsp; </label>
            <label for="" class="" id="lblTotalTarjeta" style="display:inline-block;display: flex;align-items: center;"></label>
        </div>
        <div class="input-group">
            <label for="" class="font-weight-bold"
                   style="display:inline-block;display: flex;align-items: center;">Transferencia:&nbsp; </label>
            <label for="" class="" id="lblTotalTransfer" style="display:inline-block;display: flex;align-items: center;"></label>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12">
        <div class="form-group">
            <div class="input-group">
                <label for="" class="font-weight-bold"
                    style="display:inline-block;display: flex;align-items: center;">Total:&nbsp; </label>
                <label for="" class="" id="lblTotal" style="display:inline-block;display: flex;align-items: center;"></label>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-12">
        <div class="form-group">
            <button type="button" id="btnXLSCorte" class="btn btn-success w-100">Enviar a XLS</button>
        </div>
    </div>
</div>
