<h1 class="h3 mb-2 text-gray-800">Cotización</h1>
<div class="row">
  <div class="col-lg-4 col-md-4 col-12">
    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#cardREpaciente" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="ClienteCard">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> Paciente</h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="cardREpaciente">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <p><b>Seleccionar paciente:</b></p>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <div class="input-group">
                  <select name="" id="selREPacienteData" class="form-control" data-live-search="true">
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modAgregarCliente">
                      <i class="fas fa-plus fa-sm"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <label><b>Nombre:</b></label>
              <label class="dataLabel" id="lblREPacienteNom">Jose Ramon Diaz Ortega</label>
            </div>
            <div class="col-lg-12">
              <label><b>Genero:</b></label>
              <label class="dataLabel" id="lblREPacienteGen>Masculino</label>
            </div>
            <div class="col-lg-12">
              <label><b>Edad:</b></label>
              <label class="dataLabel" id="lblREPacienteAge>24</label>
            </div>
            <div class="col-lg-12">
              <label><b>Teléfono:</b></label>
              <label class="dataLabel" id="lblREPacienteTel>3121078034</label>
            </div>
            <div class="col-lg-12">
              <label class="dataLabel" id="lblREPacienteEmail><b>Email:</b></label>
              <label style="word-wrap: break-word;">jramondiaz96@gmail.com</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8 col-md-8 col-12">
    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#TotalCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="TotalCard">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Estudios a realizar</h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="TotalCard">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-12">
            </div>
            <div class="col-lg-4 col-md-4 col-12">
              <div class="form-group">
                <button class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#modAgregarEstudio"><i class="fas fa-plus fa-sm"></i> Agregar estudio</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2 col-md-2  col-2">
              <button type="" class="btn btn-sm btn-danger"><i class="fas fa-minus-circle"></i></button>
            </div>
            <div class="col-lg-8 col-md-8 col-7">
              <label><i class="far fa-check-circle"></i> 17 ALFA HIDROXI PROGESTERONA (SUERO)</label>
            </div>
            <div class="col-lg-2 col-md-2  col-3">
              <label>$256.00</label>
            </div>
            <div class="col-lg-2 col-md-2  col-2">
              <button type="" class="btn btn-sm btn-danger"><i class="fas fa-minus-circle"></i></button>
            </div>
            <div class="col-lg-8 col-md-8 col-7">
              <label><i class="far fa-check-circle"></i> 17 ALFA HIDROXI PROGESTERONA (SUERO)</label>
            </div>
            <div class="col-lg-2 col-md-2  col-3">
              <label>$256.00</label>
            </div>
            <div class="col-lg-2 col-md-2  col-2">
              <button type="" class="btn btn-sm btn-danger"><i class="fas fa-minus-circle"></i></button>
            </div>
            <div class="col-lg-8 col-md-8 col-7">
              <label><i class="far fa-check-circle"></i> 17 ALFA HIDROXI PROGESTERONA (SUERO)</label>
            </div>
            <div class="col-lg-2 col-md-2  col-3">
              <label>$256.00</label>
            </div>
          </div>
          <div class="row">
            <hr style="width: 90%; margin:.6rem 0">
            <div class="col-lg-2 col-md-2 col-2">
              <label><b>Subtotal</b></label>
            </div>
            <div class="col-lg-8 col-md-8 col-7">
            </div>
            <div class="col-lg-2 col-md-2 col-3">
              <label>$256.00</label>
            </div>
            <hr style="width: 90%; margin:.6rem 0">
            <div class="col-lg-2 col-md-2 col-2">
              <label><b>Total</b></label>
            </div>
            <div class="col-lg-8 col-md-8 col-7">
            </div>
            <div class="col-lg-2 col-md-2 col-3">
              <label>$256.00</label>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-12">
            </div>
            <div class="col-lg-4 col-md-4 col-12">
              <div class="form-group">
                <button class="btn btn-success" style="width: 100%;" data-toggle="modal" data-target="#"><i class="fas fa-clipboard-list"></i> Solicitar estudios</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
