<h1 class="h3 mb-2 text-gray-800">Perfiles</h1>
<div class="row">
  <div class="col-lg-8 col-md-8 col-12">
  </div>
  <div class="col-lg-4 col-md-4 col-12">
  	<button type="button" class="btn btn-info w-100" data-target="#modAgregarPerfil" data-toggle="modal"><i class="fas fa-user"></i>   Agregar perfil</button>
  </div>
</div>
<div class="card shadow mb-4" style="margin: 10px 0">
  <div class="card-body">
    <div id="tableContainer" class="table-responsive">
      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
        <thead id="thead" class="text-center">
          <th>PERFIL</th>
          <th>ESTATUS</th>
          <th>OPCIONES</th>
        </thead>
        <tbody id="tbody" class="text-center">
          <tr>
            <td>Administrador</td>
            <td><span class="btn btn-success btn-sm">Activo</span></td>
            <td>
              <button type="" class="btn btn-info btn-sm">Algo</button>
            </td>
          </tr>
          <tr>
            <td>Administrador</td>
            <td><span class="btn btn-danger btn-sm">Activo</span></td>
            <td>
              <button type="" class="btn btn-warning btn-sm" style="color:white">Algo</button>
            </td>
          </tr>
          <tr>
            <td>Administrador</td>
            <td><span class="btn btn-primary btn-sm">Activo</span></td>
            <td>
              <button type="" class="btn btn-secondary btn-sm">Algo</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- MODAL AGREGAR USUARIO -->
<div class="modal fade" style=" overflow-y: scroll" id="modAgregarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 950px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregar" class="user">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="" placeholder="Nombre de perfil">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#cotizacionCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="cotizacionCard">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Cotización</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="cotizacionCard">
                  <div class="card-body">
                    <div id="tableContainer" class="table-responsive">
                      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead id="thead" class="text-center">
                          <th>PERFIL</th>
                          <th>VER</th>
                          <th>SOLICITAR ESTUDIOS</th>
                        </thead>
                        <tbody id="tbody" class="text-center">
                          <tr>
                            <td>ADMINISTRADOR</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                          <tr>
                            <td>PACIENTE</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#resultadosCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="resultadosCard">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Resultados</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="resultadosCard">
                  <div class="card-body">
                    <div id="tableContainer" class="table-responsive">
                      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead id="thead" class="text-center">
                          <th>PERFIL</th>
                          <th>VER</th>
                          <th>TOMAR MUESTRA</th>
                          <th>SUBIR RESULTADOS</th>
                          <th>DESCARGAR RESULTADOS</th>
                          <th>GUARDAR PAGO</th>
                        </thead>
                        <tbody id="tbody" class="text-center">
                          <tr>
                            <td>ADMINISTRADOR</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                          <tr>
                            <td>PACIENTE</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#estudiosCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="estudiosCard">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Estudios</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="estudiosCard">
                  <div class="card-body">
                    <div id="tableContainer" class="table-responsive">
                      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead id="thead" class="text-center">
                          <th>PERFIL</th>
                          <th>VER</th>
                          <th>CREAR</th>
                          <th>ACTUALIZAR</th>
                          <th>BORRAR</th>
                        </thead>
                        <tbody id="tbody" class="text-center">
                          <tr>
                            <td>ADMINISTRADOR</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                          <tr>
                            <td>PACIENTE</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#pacienteCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="pacienteCard">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Pacientes</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="pacienteCard">
                  <div class="card-body">
                    <div id="tableContainer" class="table-responsive">
                      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead id="thead" class="text-center">
                          <th>PERFIL</th>
                          <th>VER</th>
                          <th>CREAR</th>
                          <th>ACTUALIZAR</th>
                          <th>BORRAR</th>
                        </thead>
                        <tbody id="tbody" class="text-center">
                          <tr>
                            <td>ADMINISTRADOR</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                          <tr>
                            <td>PACIENTE</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#clientesCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="clientesCard">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Clientes</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="clientesCard">
                  <div class="card-body">
                    <div id="tableContainer" class="table-responsive">
                      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead id="thead" class="text-center">
                          <th>PERFIL</th>
                          <th>VER</th>
                          <th>CREAR</th>
                          <th>ACTUALIZAR</th>
                          <th>BORRAR</th>
                        </thead>
                        <tbody id="tbody" class="text-center">
                          <tr>
                            <td>ADMINISTRADOR</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                          <tr>
                            <td>PACIENTE</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#UsuariosCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="UsuariosCard">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Usuarios</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="UsuariosCard">
                  <div class="card-body">
                    <div id="tableContainer" class="table-responsive">
                      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead id="thead" class="text-center">
                          <th>PERFIL</th>
                          <th>VER</th>
                          <th>CREAR</th>
                          <th>ACTUALIZAR</th>
                          <th>BORRAR</th>
                        </thead>
                        <tbody id="tbody" class="text-center">
                          <tr>
                            <td>ADMINISTRADOR</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                          <tr>
                            <td>PACIENTE</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#PerfilesCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="PerfilesCard">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Perfiles</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="PerfilesCard">
                  <div class="card-body">
                    <div id="tableContainer" class="table-responsive">
                      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead id="thead" class="text-center">
                          <th>PERFIL</th>
                          <th>VER</th>
                          <th>CREAR</th>
                          <th>ACTUALIZAR</th>
                          <th>BORRAR</th>
                        </thead>
                        <tbody id="tbody" class="text-center">
                          <tr>
                            <td>ADMINISTRADOR</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                          <tr>
                            <td>PACIENTE</td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                            <td><input type="checkbox" name="" value=""></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button id="btnAgregarNew" type="submit" class="btn btn-success">Aceptar</button>
      </div>
      </form>
    </div>
  </div>
</div>