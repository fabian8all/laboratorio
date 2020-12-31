<!--MODAL AGREGAR/ACTUALIZAR CLIENTE-->
<div id="modalClientes" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmClientes" class="user">
                <div class="modal-body">
                    <input type="hidden" id="hidClientesMode" value="">
                    <input type="hidden" id="hidClientesId" value="">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="txtClientesNombre" placeholder="Nombre">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="txtClientesUser" placeholder="Nombre de usuario">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="txtClientesEmail" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <select class="form-control form-control-user" id="selClientesPerfil" style="padding: 0rem 1rem;height: 3.2rem;">
                                    <option value="0" selected disabled> Perfil </option>
                                    <option value="2"> Medico </option>
                                    <option value="3"> Empresa </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
<!--                            <div class="form-group">-->
<!--                                <input type="number" min="0" step="0.01" class="form-control form-control-user" id="txtClientesDescuento" placeholder="Descuento" >-->
<!--                            </div>-->
                            <div class="form-group">
                                <select class="form-control form-control-user" id="selClientesLista" style="padding: 0rem 1rem;height: 3.2rem;">
                                    <option value="0" selected disabled>Lista de precios</option>
                                    <option value="1">Publico General</option>
                                    <option value="2">Precios Médico</option>
                                    <option value="3">Precios Empresa</option>
                                    <option value="4">Precios Lista 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="divClientesChkPass">
                        <div class="col-6">
<!--                            <label for="chkClientesChgPass" class="col-form-label">
                                <strong>Cambiar contraseña</strong>
                                <input type="checkbox" class="form-control form-check" id="chkClientesChgPass" value=1>
                            </label>
-->                        </div>
                    </div>
                    <div class="row" id="divClientesChgPass">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="txtClientesPass1" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="txtClientesPass2" placeholder="Repetir contraseña">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnClientesSave" class="btn btn-success">
                        <span class="fa fa-save"></span>
                        Guardar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--MODAL HISTORIAL DE CORTES -->
<div id="modalHistorialCortes" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="titleNomCliente"></span> - Historial De Cortes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12" id="bodyHistorialCortes">

                    </div>
                </div>
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
