<h1 class="h3 mb-2 text-gray-800">Cotización</h1>
<div class="row">
  <div class="col-lg-4 col-md-4 col-12">
    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#ClienteCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="ClienteCard">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> Paciente</h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="ClienteCard">
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
                  <select name="" id="select_status" class="form-control selectpicker" data-live-search="true">
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
            <div class="col-lg-12">
              <label><b>Nombre:</b></label>
              <label>Jose Ramon Diaz Ortega</label>
            </div>
            <div class="col-lg-12">
              <label><b>Genero:</b></label>
              <label>Masculino</label>
            </div>
            <div class="col-lg-12">
              <label><b>Edad:</b></label>
              <label>24</label>
            </div>
            <div class="col-lg-12">
              <label><b>Teléfono:</b></label>
              <label>3121078034</label>
            </div>
            <div class="col-lg-12">
              <label><b>Email:</b></label>
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
                <div class="input-group">
                  <select name="" id="select_status" class="form-control selectpicker" data-live-search="true">
                    <option value="" disabled selected>Seleccione estudios</option>
                    <option value="1">ACTIVOS</option>
                    <option value="0">INACTIVOS</option>
                    <option value="3">ELIMINADOS</option>
                    <option value="2">TODOS</option>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-info" type="button" data-toggle="" data-target="#">
                      <i class="fas fa-plus fa-sm"></i>
                    </button>
                  </div>
                </div>
              </div>
              <!--<div class="form-group">
                <button class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#modAgregarEstudio"><i class="fas fa-plus fa-sm"></i> Agregar estudio</button>
              </div>-->
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
<!-- MODAL AGREGAR CLIENTE -->
<div class="modal fade" id="modAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregar" class="user">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <input type="text" class="form-control form-control-user necesary" id="txtNombres" placeholder="Nombres*">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <input type="text" class="form-control form-control-user necesary" name="" value="" placeholder="Genero*">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <input type="number" class="form-control form-control-user necesary" name="" value="" placeholder="Edad*">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <input type="tel" class="form-control form-control-user necesary" name="" value="" placeholder="Teléfono*">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <input type="email" class="form-control form-control-user necesary" name="" value="" placeholder="Correo electrónico*">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button id="btnAgregarNew" type="submit" class="btn btn-success">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- MODAL EDITAR -->
<div class="modal fade" id="modAgregarEstudio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-8 col-md-8 col-12">
          </div>
          <div class="col-lg-4 col-md-4 col-12 smallMargin">
            <form>
              <div class="input-group">
                <input type="text" id="txt_busqueda" class="form-control bg-light border-0 small" style="background-color: white !important" placeholder="Buscar cliente..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div style="margin-top: 20px" id="carouselExampleControls" class="carousel " data-ride="">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="card">
                    <div class="card-header">
                      <span style="display:inline-block" class="btn btn-info">4568</span>
                      <h6 style="display:inline-block">VDRL EM SUERO</h6>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Tiempo:</p>
                        <label style="display:inline-block">1</label>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Costo:</p>
                        <label style="display:inline-block">$100</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="card">
                    <div class="card-header">
                      <span style="display:inline-block" class="btn btn-info">4568</span>
                      <h6 style="display:inline-block">VDRL EM SUERO</h6>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Tiempo:</p>
                        <label style="display:inline-block">1</label>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Costo:</p>
                        <label style="display:inline-block">$100</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="card">
                    <div class="card-header">
                      <span style="display:inline-block" class="btn btn-info">4568</span>
                      <h6 style="display:inline-block">VDRL EM SUERO</h6>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Tiempo:</p>
                        <label style="display:inline-block">1</label>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Costo:</p>
                        <label style="display:inline-block">$100</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="card">
                    <div class="card-header">
                      <span style="display:inline-block" class="btn btn-info">4568</span>
                      <h6 style="display:inline-block">VDRL EM SUERO</h6>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Tiempo:</p>
                        <label style="display:inline-block">1</label>
                      </div>
                      <div class="form-group">
                        <p style="display:inline-block">Costo:</p>
                        <label style="display:inline-block">$100</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="..." alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="..." alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button id="btnguardarEdit" type="submit" class="btn btn-success">Aceptar</button>
      </div>
      </form>
    </div>
  </div>
</div>
