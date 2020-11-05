
<h1 class="h3 mb-2 text-gray-800">Clientes</h1>
<div class="row" style="margin: 10px 0">
  <div class="col-lg-4 col-md-4 col-12">
    <button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#modAgregarCliente">Agregar cliente</button>
  </div>
  <div class="col-lg-4 col-md-4 col-12 smallMargin">
    <select name="" id="select_status" class="form-control">
      <option value="1">ACTIVOS</option>
      <option value="0">INACTIVOS</option>
      <option value="3">ELIMINADOS</option>
      <option value="2">TODOS</option>
    </select>
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
<div class="card shadow mb-4">
  <div class="card-body">
    <div id="tableContainer" class="table-responsive">
      <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead id="thead">
        </thead>
        <tbody id="tbody">
        </tbody>
      </table>
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
<!-- Modal DETALLES-->
<div class="modal fade" id="modDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 850px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Información clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="card shadow mb-4 col-lg-12">
              <div class="card-header py-3">
                <h6 id="txtIdD" style="display: none"></h6>
                <h6 id="txtIdUD" style="display: none"></h6>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <h6 style="display: inline-block;" class="m-0 font-weight-bold text-primary">Cliente: </h6>
                    <h6 style="display: inline-block;" id="txtNombresD"></h6>
                    <h6 style="display: inline-block;" id="txtPrimerApD"></h6>
                    <h6 style="display: inline-block;" id="txtSegundoApD"></h6>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <h6 style="display: inline-block;" class="m-0 font-weight-bold text-primary">Usuario dio de alta: </h6>
                    <h6 style="display: inline-block;" id="txtUsuarioD"></h6>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!--<div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <label><b>Primer apellido:</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                          <label for="" id="txtPrimerApD"></label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                          <label><b>Segundo apellido:</b></label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                          <label for="" id="txtSegundoApD"></label>
                        </div>
                      </div>
                    </div>
                  </div>-->
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Calle:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtCalleD"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>No. Exterior:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtNoExtD"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>No. Interior:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtNoIntD"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Colonia:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtColoniaD"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Entre calle:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtEntreCalle1D"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Entre calle:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtEntreCalle2D"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Estado:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtEstadoD"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Municipio:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtMunicipioD"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Teléfono:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtTelefonoD"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Correo Electrónico:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtCorreoElecD"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Fecha de registro:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtFechaRegistroD"></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-12">
                        <label><b>Fecha de actualización:</b></label>
                      </div>
                      <div class="col-lg-6 col-md-6 col-12">
                        <label for="" id="txtFechaActualizacionD"></label>
                      </div>
                    </div>
                  </div>
                </div>
                <!--<div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                      <label><b>Fecha de registro:</b></label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                      <label for="" id="txtFechaRegistroD"></label>
                    </div>
                  </div>-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        <!--<button type="button" class="btn btn-primary">Aceptar</button>-->
      </div>
    </div>
  </div>
</div>