<!-- MODAL AGREGAR PACIENTE -->
<div class="modal fade" id="modalPacientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPacientes" class="user">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user necesary" id="txtPacientesNombre" placeholder="Nombres*">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <select id="selPacientesGenero" class="form-control form-control-user necesary" style="padding: 0rem 1rem;height: 3.2rem;" >
                                    <option value="" selected disabled>Género</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="date" id="txtPacientesFechaNac" class="form-control form-control-user necesary" name="" value="" placeholder="Fecha de nacimiento*">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" id="txtPacientesDireccion" class="form-control form-control-user" name="" value="" placeholder="Dirección">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="tel" id="txtPacientesTelefono" class="form-control form-control-user" name="" value="" placeholder="Teléfono">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="email" id="txtPacientesEmail" class="form-control form-control-user" name="" value="" placeholder="Correo electrónico">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button id="btnPacientesSave" type="button" class="btn btn-success">Agregar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL Anticipo -->
<div class="modal fade" id="modAgregarAnticipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">¿Desea agregar anticipo?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAnticipo" class="user">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><b>Total:</b></label>
                                <label id="lblAnticipoTotal"></label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="number" class="form-control" id="txtAnticipo" value="" placeholder="Anticipo">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control" id="selFormaPago" style="padding: 0rem 1rem;height: 3.2rem;">
                                    <option selected disabled value="">Forma de pago</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtReferenciaAnticipo" value="" placeholder="Referencia">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button id="btnAnticipoSubmit" type="button" class="btn btn-success">Agregar</button>
            </div>
            </form>
        </div>
    </div>
</div>
