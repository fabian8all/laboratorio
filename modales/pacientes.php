<div id="modalPacientes" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPacientes">
                    <input type="hidden" id="hidPacientesMode" value="">
                    <input type="hidden" id="hidPacientesId" value="">
                    <div class="row">
                        <div class="col-12">
                            <label for="txtPacientesNombre" class="col-form-label">
                                <strong>Nombre:</strong>
                            </label>
                            <input type="text" class="form-control" id="txtPacientesNombre">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="txtPacientesDireccion" class="col-form-label">
                                <strong>Dirección:</strong>
                            </label>
                            <input type="text" class="form-control" id="txtPacientesDireccion">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="txtPacientesTelefono" class="col-form-label">
                                <strong>Telefono:</strong>
                            </label>
                            <input type="text" class="form-control" id="txtPacientesTelefono">
                        </div>
                        <div class="col-8">
                            <label for="txtPacientesEmail" class="col-form-label">
                                <strong>Email:</strong>
                            </label>
                            <input type="email" class="form-control" id="txtPacientesEmail">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnPacientesSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
