<script>
    var estudiosSelected = [];
    var descuento = 0.0;
</script>
<div class="container">
    <div id="console">
        <div class="title">
            <h3>
                <span class="fa fa-medkit"></span>
                Realizar estudio
            </h3>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card" id="cardREpaciente">
                    <div class="card-header card-primary">
                        <div class="card-title">
                            <span class="fa fa-user"></span>
                            Paciente
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="selREPaciente" class="col-form-label">
                                Seleccionar paciente:
                            </label>
                            <div class="input-group">
                                <select id="selREPacienteData" class="form-control">
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="btnREAddPaciente">
                                        <span class="fa fa-plus-circle"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div>
                                <strong>Nombre:</strong> <div class="dataLabel" id="lblREPacienteNom"></div>
                            </div>
                            <div>
                                <strong>Teléfono:</strong> <div class="dataLabel" id="lblREPacienteTel"></div>
                            </div>
                            <div>
                                <strong>Email:</strong> <div class="dataLabel" id="lblREPacienteEmail"></div>
                            </div>
                            <div>
                                <strong>Dirección:</strong> <div class="dataLabel" id="lblREPacienteDir"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div clasS="card" id="cardREEstudio">
                    <div class="card-header card-primary">
                        <div class="card-title">
                            <span class="fa fa-tasks"></span>
                            Estudios a realizar
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-6 col-sm-12 float-right">
                                    <button class="btn btn-info" id="btnREAddEstudio">
                                        <span class="fa fa-plus-circle"></span>
                                        Agregar estudio
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="container" id="divREListaEstudios"></div>
                        <hr>
                        <div class="contaier">
                            <div class="row">
                                <div class="col-8">
                                    <strong>Subtotal:</strong>
                                </div>
                                <div clasS="col-4" id="subTotalRE"></div>
                            </div>
                        </div>
                        <div id="descuentoRE"></div>
                        <hr>
                        <div class="contaier">
                            <div class="row">
                                <div class="col-8">
                                    <strong>Total:</strong>
                                </div>
                                <div clasS="col-4" id="totalRE"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button class="btn btn-success" id="btnRESolicitar">
                                <span class="fa fa-tasks"></span>
                                Solicitar Estudios
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

