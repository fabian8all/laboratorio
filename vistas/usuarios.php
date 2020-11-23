<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
<div class="row">
    <div class="col-lg-4 col-md-4 col-12">
        <div class="form-group">
            <button title="Agregar usuario" class="btn btn-info w-100 btn-icon-split" id="btnUsuariosAdd">
                <span class="icon text-white-50">
                    <i class="fa fa-user-plus"></i>
                </span>
                <span class="text">
                    Nuevo Usuario
                </span>
            </button>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-12"></div>
</div>
<div class="card shadow mb-4" style="margin: 10px 0">
    <div class="card-body">
        <div id="tableContainer" class="table-responsive">
            <table
                id="bstableUsuarios"
                class="table table-striped"

                data-ajax="ajaxGetUsuarios"
                data-search="true"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="5"
                data-page-list="[5, 10, 20, 50, 100]"
                data-row-style="usuariosRowStyle"
            >
                <thead>
                    <tr>
                        <th data-field="id"  data-sortable="true" data-align="left">Id</th>
                        <th data-field="username"  data-sortable="true" data-align="left">USERNAME</th>
                        <th data-field="perfil" data-sortable="true">PERFIL</th>
                        <th data-field="nombre"  data-sortable="false">NOMBRE</th>
                        <th data-field="email"  data-sortable="false">EMAIL</th>
                        <th data-field="id"  data-formatter="formatUsuariosOptions" data-align="center" data-sortable="false">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

