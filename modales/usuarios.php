<div id="modalUsuarios" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmUsuarios" class="user">
                    <input type="hidden" id="hidUsuariosMode" value="">
                    <input type="hidden" id="hidUsuariosId" value="">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="txtUsuariosNombre" placeholder="Nombre">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="txtUsuariosUser" placeholder="Nombre de Usuario">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="txtUsuariosEmail" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <select class="form-control form-control-user" id="selUsuariosPerfil"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="divUsuariosChkPass">
                        <div class="col-6">
                            <label for="chkUsuariosChgPass" class="col-form-label">
                                <strong>Cambiar contraseña</strong>
                                <input type="checkbox" class="form-control form-check" id="chkUsuariosChgPass" value=1>
                            </label>
                        </div>
                    </div>
                    <div class="row" id="divUsuariosChgPass">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="txtUsuariosPass1" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="txtUsuariosPass2" placeholder="Repetir contraseña">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnUsuariosSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
