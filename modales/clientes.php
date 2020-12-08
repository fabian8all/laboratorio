<div id="modalClientes" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmClientes">
                    <input type="hidden" id="hidClientesMode" value="">
                    <input type="hidden" id="hidClientesId" value="">
                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <label for="txtClientesNombre" class="col-form-label">
                                <strong>Nombre:</strong>
                            </label>
                            <input type="text" class="form-control" id="txtClientesNombre">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-lg-4 col-md-6">
                            <label for="txtClientesUser" class="col-form-label">
                                <strong>Nombre de usuario:</strong>
                            </label>
                            <input type="text" class="form-control" id="txtClientesUser">
                        </div>
                        <div class="col-6 col-md-6 col-lg-8">
                            <label for="txtClientesEmail" class="col-form-label">
                                <strong>Email:</strong>
                            </label>
                            <input type="email" class="form-control" id="txtClientesEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-6">
                            <label for="selClientesPerfil" class="col-form-label">
                                <strong>Perfil:</strong>
                            </label>
                            <select class="form-control" id="selClientesPerfil">
                                <option value="0" selected disabled> -- Seleccione perfil --</option>
                                <option value="2"> Medico </option>
                                <option value="3"> Empresa </option>
                            </select>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <label for="txtClientesDescuento" class="col-form-label">
                                <strong>Descuento:</strong>
                            </label>
                            <input type="number" step="0.01" class="form-control" id="txtClientesDescuento">
                        </div>
                    </div>
                    <div class="row" id="divClientesChkPass">
                        <div class="col-6 col-md-6 col-lg-6">
                            <label for="chkClientesChgPass" class="col-form-label">
                                <strong>Cambiar contraseña</strong>
                                <input type="checkbox" class="form-control form-check" id="chkClientesChgPass" value=1>
                            </label>
                        </div>
                    </div>
                    <div class="row" id="divClientesChgPass">
                        <div class="col-6 col-md-6 col-lg-6">
                            <label for="txtClientesPass1" class="col-form-label">
                                <strong>Contraseña:</strong>
                            </label>
                            <input type="password" class="form-control" id="txtClientesPass1">
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <label for="txtClientesPass2" class="col-form-label">
                                <strong>Repetir contraseña:</strong>
                            </label>
                            <input type="password" class="form-control" id="txtClientesPass2">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnClientesSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
