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
            <div class="col-4">
                <div class="card" id="cardREpaciente">
                    <div class="card-header card-info">
                        <div class="card-title">
                            <span class="fa fa-user"></span>
                            Paciente
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="selREPaciente" class="col-form-label">
                            Seleccionar paciente:
                        </label>
                        <select id="selREPacienteData" class="form-control">
                        </select>
                        <div class="container">
                            <div>
                                <strong>Nombre:</strong><div id="lblREPacienteNom"></div>
                            </div>
                            <div>
                                <strong>Teléfono:</strong><div id="lblREPacienteTel"></div>
                            </div>
                            <div>
                                <strong>Email:</strong><div id="lblREPacienteEmail"></div>
                            </div>
                            <div>
                                <strong>Dirección:</strong><div id="lblREPacienteDir"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div clasS="card" id="cardREEstudio">
                    <div class="card-header card-info">
                        <div class="card-title">
                            <span class="fa fa-tasks"></span>
                            Estudios a realizar
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-6 float-right">
                                    <button class="btn btn-info">
                                        <span class="fa fa-plus-circle"></span>
                                        Agregar estudio
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="container" id="divREListaEstudios"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div id="divEstudiosCards" class="row"></div>
</div>
