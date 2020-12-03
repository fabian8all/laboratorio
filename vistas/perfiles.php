<div class="row">
    <div class="col-12">
        <div class="title text-center">
            <h1 class="h3 mb-2 text-gray-800">
                Perfiles
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-12">
        <div class="form-group">
            <button title="Agregar perfil" class="btn btn-info btn-icon-split" id="btnPerfilesAdd">
                <span class="icon text-white-50">
                    <i class="fa fa-user-tag"></i>
                </span>
                <span class="text">
                    Nuevo Perfil
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
                id="bstablePerfiles"
                class="table table-striped"

                data-ajax="ajaxGetPerfiles"
                data-search="true"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="5"
                data-page-list="[5, 10, 20, 50, 100]"
                data-row-style="perfilesRowStyle"
            >
                <thead>
                    <tr>
                        <th data-field="id"  data-sortable="true" data-align="left">Id</th>
                        <th data-field="perfil" data-sortable="true">PERFIL</th>
                        <th data-field="id"  data-formatter="formatPerfilesOptions" data-align="center" data-sortable="false">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

