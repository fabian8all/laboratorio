<div id="modalPerfiles" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPerfiles" class="user">
                    <input type="hidden" id="hidPerfilesMode" value="">
                    <input type="hidden" id="hidPerfilesId" value="">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="txtPerfilesNombre" placeholder="Nombre de perfil*">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
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
                                                    <th>VER</th>
                                                    <th>SOLICITAR ESTUDIOS</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                <tr>
                                                    <td><input type="checkbox"  class="chkPermisosCotizacion" value="1"></td>
                                                    <td><input type="checkbox" class="chkPermisosCotizacion" value="2"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                                    <th>VER</th>
                                                    <th>TOMAR MUESTRA</th>
                                                    <th>SUBIR RESULTADOS</th>
                                                    <th>DESCARGAR RESULTADOS</th>
                                                    <th>GUARDAR PAGO</th>
                                                    <th>CANCELAR SOLICITUD</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                    <tr>
                                                        <td><input type="checkbox" class="chkPermisosResultados" value="1"></td>
                                                        <td><input type="checkbox" class="chkPermisosResultados" value="2"></td>
                                                        <td><input type="checkbox" class="chkPermisosResultados" value="4"></td>
                                                        <td><input type="checkbox" class="chkPermisosResultados" value="8"></td>
                                                        <td><input type="checkbox" class="chkPermisosResultados" value="16"></td>
                                                        <td><input type="checkbox" class="chkPermisosResultados" value="32"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#cortesCard" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="resultadosCard">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list"></i> Cortes</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse" id="cortesCard">
                                    <div class="card-body">
                                        <div id="tableContainer" class="table-responsive">
                                            <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                                <thead id="thead" class="text-center">
                                                <th>VER</th>
                                                <th>REALIZAR CORTE</th>
                                                <th>IMPRIMIR</th>
                                                <th>PAGAR</th>
                                                <th>VER CORTE INGRESOS</th>
                                                <th>RETIRAR EFECTIVO</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                <tr>
                                                    <td><input type="checkbox" class="chkPermisosCortes" value="1"></td>
                                                    <td><input type="checkbox" class="chkPermisosCortes" value="2"></td>
                                                    <td><input type="checkbox" class="chkPermisosCortes" value="4"></td>
                                                    <td><input type="checkbox" class="chkPermisosCortes" value="8"></td>
                                                    <td><input type="checkbox" class="chkPermisosCortes" value="16"></td>
                                                    <td><input type="checkbox" class="chkPermisosCortes" value="32"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                                    <th>VER</th>
                                                    <th>CREAR</th>
                                                    <th>ACTUALIZAR</th>
                                                    <th>BORRAR</th>
                                                    <th>IMPORTAR LISTA DE PRECIOS</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                    <tr>
                                                        <td><input type="checkbox" class="chkPermisosEstudios" value="1"></td>
                                                        <td><input type="checkbox" class="chkPermisosEstudios" value="2"></td>
                                                        <td><input type="checkbox" class="chkPermisosEstudios" value="4"></td>
                                                        <td><input type="checkbox" class="chkPermisosEstudios" value="8"></td>
                                                        <td><input type="checkbox" class="chkPermisosEstudios" value="16"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                                    <th>VER</th>
                                                    <th>CREAR</th>
                                                    <th>ACTUALIZAR</th>
                                                    <th>BORRAR</th>
                                                    <th>VER TODOS</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                    <tr>
                                                        <td><input type="checkbox" class="chkPermisosPacientes" value="1"></td>
                                                        <td><input type="checkbox" class="chkPermisosPacientes" value="2"></td>
                                                        <td><input type="checkbox" class="chkPermisosPacientes" value="4"></td>
                                                        <td><input type="checkbox" class="chkPermisosPacientes" value="8"></td>
                                                        <td><input type="checkbox" class="chkPermisosPacientes" value="16"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                                    <th>VER</th>
                                                    <th>CREAR</th>
                                                    <th>ACTUALIZAR</th>
                                                    <th>BORRAR</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                    <tr>
                                                        <td><input type="checkbox" class="chkPermisosClientes" value="1"></td>
                                                        <td><input type="checkbox" class="chkPermisosClientes" value="2"></td>
                                                        <td><input type="checkbox" class="chkPermisosClientes" value="4"></td>
                                                        <td><input type="checkbox" class="chkPermisosClientes" value="8"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                                    <th>VER</th>
                                                    <th>CREAR</th>
                                                    <th>ACTUALIZAR</th>
                                                    <th>BORRAR</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                    <tr>
                                                        <td><input type="checkbox" class="chkPermisosUsuarios" value="1"></td>
                                                        <td><input type="checkbox" class="chkPermisosUsuarios" value="2"></td>
                                                        <td><input type="checkbox" class="chkPermisosUsuarios" value="4"></td>
                                                        <td><input type="checkbox" class="chkPermisosUsuarios" value="8"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                                    <th>VER</th>
                                                    <th>CREAR</th>
                                                    <th>ACTUALIZAR</th>
                                                    <th>BORRAR</th>
                                                </thead>
                                                <tbody id="tbody" class="text-center">
                                                    <tr>
                                                        <td><input type="checkbox" class="chkPermisosPerfiles" value="1"></td>
                                                        <td><input type="checkbox" class="chkPermisosPerfiles" value="2"></td>
                                                        <td><input type="checkbox" class="chkPermisosPerfiles" value="4"></td>
                                                        <td><input type="checkbox" class="chkPermisosPerfiles" value="8"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnPerfilesSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
