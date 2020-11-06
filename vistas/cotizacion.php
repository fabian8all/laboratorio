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
                    <button class="btn btn-info" type="button">
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
        <div class="card-body" >
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
<!-- MODAL AGREGAR CLIENTE -->
<div class="modal fade" id="modAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregar" class="user">
          <div class="form-group">
            <input type="text" class="form-control form-control-user necesary" id="txtNombres" placeholder="Nombres*">
          </div>
          <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-12">
              <input type="text" class="form-control form-control-user necesary" id="txtPrimerAp" placeholder="Primer apellido*">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-12 smallMargin">
              <input type="text" class="form-control form-control-user necesary" id="txtSegundoAp" placeholder="Segundo apellido*">
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user " id="txtCalle" placeholder="Calle">
          </div>
          <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-12">
              <input type="text" class="form-control form-control-user " id="txtNoExt" placeholder="No. Exterior">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-12 smallMargin">
              <input type="text" class="form-control form-control-user" id="txtNoInt" placeholder="No. Interior">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-12 ">
              <input type="text" class="form-control form-control-user " id="txtColonia" placeholder="Colonia">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-12">
              <input type="text" class="form-control form-control-user" id="txtEntreCalle1" placeholder="Entre calle">
            </div>
            <div class="col-lg-6 col-md-6 col-12 smallMargin">
              <input type="text" class="form-control form-control-user" id="txtEntreCalle2" placeholder="Entre calle">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-12">
              <input type="text" class="form-control form-control-user " id="txtEstado" placeholder="Estado">
            </div>
            <div class="col-lg-4 col-md-4 col-12 smallMargin">
              <input type="text" class="form-control form-control-user " id="txtMunicipio" placeholder="Municipio">
            </div>
            <div class="col-lg-4 col-md-4 col-12 smallMargin">
              <input type="text" class="form-control form-control-user necesary" id="txtTelefono" placeholder="Teléfono*">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-12">
              <input type="text" class="form-control form-control-user" id="txtCorreoElec" placeholder="Correo electrónico">
            </div>
            <!--<div class="col-lg-6 col-md-6 col-12">
                <input type="date" class="form-control form-control-user" id="txtFechaRegistro*" placeholder="Fecha de registro">
              </div>-->
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
<div class="modal fade" id="modEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregarE" class="user">
          <div class="form-group" style="display: none">
            <input type="text" class="form-control form-control-user necesary" id="txtIdE" placeholder="">
          </div>
          <div class="form-group" style="display: none">
            <input type="text" class="form-control form-control-user necesary" id="txtIdUE" placeholder="">
          </div>
          <div class="form-group text-center">
            <label><b>Nombres*</b></label>
            <input type="text" class="form-control form-control-user necesary" id="txtNombresE" placeholder="Nombres*">
          </div>
          <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-12 text-center">
              <label><b>Primer apellido*</b></label>
              <input type="text" class="form-control form-control-user necesary" id="txtPrimerApE" placeholder="Primer apellido*">
            </div>
            <div class="col-lg-6 col-md-6 col-12 text-center">
              <label><b>Segundo apellido*</b></label>
              <input type="text" class="form-control form-control-user necesary" id="txtSegundoApE" placeholder="Segundo apellido*">
            </div>
          </div>
          <div class="form-group text-center">
            <label><b>Calle</b></label>
            <input type="text" class="form-control form-control-user " id="txtCalleE" placeholder="Calle">
          </div>
          <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-12 text-center">
              <label><b>No. Exterior</b></label>
              <input type="text" class="form-control form-control-user " id="txtNoExtE" placeholder="No. Exterior">
            </div>
            <div class="col-lg-4 col-md-4 col-12 text-center">
              <label><b>No. Interior</b></label>
              <input type="text" class="form-control form-control-user" id="txtNoIntE" placeholder="No. Interior">
            </div>
            <div class="col-lg-4 col-md-4 col-12 text-center">
              <label><b>Colonia</b></label>
              <input type="text" class="form-control form-control-user " id="txtColoniaE" placeholder="Colonia">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-12 text-center">
              <label><b>Entre calle</b></label>
              <input type="text" class="form-control form-control-user" id="txtEntreCalle1E" placeholder="Entre calle">
            </div>
            <div class="col-lg-6 col-md-6 col-12 text-center">
              <label><b>Entre calle</b></label>
              <input type="text" class="form-control form-control-user" id="txtEntreCalle2E" placeholder="Entre calle">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-12 text-center">
              <label><b>Estado</b></label>
              <input type="text" class="form-control form-control-user " id="txtEstadoE" placeholder="Estado">
            </div>
            <div class="col-lg-4 col-md-4 col-12 text-center">
              <label><b>Municipio</b></label>
              <input type="text" class="form-control form-control-user " id="txtMunicipioE" placeholder="Municipio">
            </div>
            <div class="col-lg-4 col-md-4 col-12 text-center">
              <label><b>Teléfono*</b></label>
              <input type="text" class="form-control form-control-user necesary" id="txtTelefonoE" placeholder="Teléfono*">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-12 text-center">
              <label><b>Correo electrónico</b></label>
              <input type="text" class="form-control form-control-user" id="txtCorreoElecE" placeholder="Correo electrónico">
            </div>
            <!--<div class="col-lg-6 col-md-6 col-12">
                <input type="date" class="form-control form-control-user " id="txtFechaRegistroE" placeholder="Fecha de registro">
              </div>-->
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