<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
<div class="row">
  <div class="col-lg-4 col-md-4 col-12">
    <div class="form-group">
      <button type="button" class="btn btn-info w-100" data-target="#modAgregarUsuario" data-toggle="modal"><i class="fas fa-user"></i> Agregar usuario</button>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-12">
    <div class="form-group">
      <select name="" id="select_status" class="form-control selectpicker" data-live-search="true">
        <option value="" disabled selected>Seleccione estatus</option>
        <option value="1">ACTIVOS</option>
        <option value="0">INACTIVOS</option>
      </select>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-12">
    <form class="busquedaForm">
      <div class="input-group">
        <input type="text" id="txt_busqueda" class="form-control bg-light border-0 small" style="background-color: white !important" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-info onlyBig" id="btnBuscar" type="button">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="card shadow mb-4" style="margin: 10px 0">
  <div class="card-body">
    <div id="tableContainer" class="table-responsive">
      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
        <thead id="thead" class="text-center">
          <th>USERNAME</th>
          <th>PERFIL</th>
          <th>NOMBRE</th>
          <th>CORREO ELECTRÓNICO</th>
          <th>ESTATUS</th>
          <th>OPCIONES</th>
        </thead>
        <tbody id="tbody" class="text-center">
          <tr>
            <td>ramondiaz2020</td>
            <td>Administrador</td>
            <td>Dr. Juan Jose</td>
            <td>jramondiaz96@gmail.com</td>
            <td><span class="btn btn-success btn-sm">Activo</span></td>
            <td>
              <button type="" class="btn btn-info btn-sm">Algo</button>
            </td>
          </tr>
          <tr>
            <td>ramondiaz2020</td>
            <td>Administrador</td>
            <td>Dr. Juan Jose</td>
            <td>jramondiaz96@gmail.com</td>
            <td><span class="btn btn-danger btn-sm">Activo</span></td>
            <td>
              <button type="" class="btn btn-warning btn-sm" style="color:white">Algo</button>
            </td>
          </tr>
          <tr>
            <td>ramondiaz2020</td>
            <td>Administrador</td>
            <td>Dr. Juan Jose</td>
            <td>jramondiaz96@gmail.com</td>
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
<div class="modal fade" style=" overflow-y: scroll" id="modAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAgregar" class="user">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="" placeholder="Username">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <select name="" id="select_status"  class=" selectpicker form-control" data-live-search="true">
                  <option value="" disabled selected>Seleccione perfil</option>
                  <option value="1">ACTIVOS</option>
                  <option value="0">INACTIVOS</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="" placeholder="Nombre completo">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="" placeholder="Correo electrónico">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <input type="password" class="form-control form-control-user" id="" placeholder="contraseña">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
              <div class="form-group">
                <input type="password" class="form-control form-control-user" id="" placeholder="Repetir contraseña">
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