<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="title text-center">
                <h3>
                    Pacientes
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-3 float-left">
                <button title="Agregar paciente" class="btn btn-success" id="btnPacientesAdd">
                    <span class="fa fa-user-plus"></span>
                    Nuevo Paciente
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table
                id="bstablePacientes"
                class="table table-striped"

                data-ajax="ajaxGetPacientes"
                data-search="true"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="5"
                data-page-list="[5, 10, 20, 50, 100]"
                data-row-style="pacientesRowStyle"
        >
            <thead>
                <tr>
                    <th data-field="id"  data-sortable="true" data-align="left">Id</th>
                    <th data-field="nombre"  data-sortable="true" data-align="left">Nombre</th>
                    <th data-field="direccion" data-sortable="true">Dirección</th>
                    <th data-field="telefono"  data-sortable="false">Teléfono</th>
                    <th data-field="email"  data-sortable="false">Email</th>
                    <th data-field="id"  data-formatter="formatPacientesOptions" data-align="center" data-sortable="false">Opciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
