<div class="row">
    <div class="col-12">
        <div class="title text-center">
            <h1 class="h3 mb-2 text-gray-800">
                Clientes
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12 float-left">
        <button title="Agregar cliente" class="btn btn-success btn-icon-split" id="btnClientesAdd">
            <span class="icon text-white-50">
                <i class="fa fa-user-md"></i>
            </span>
            <span class="text">
                Nuevo Cliente
            </span>
        </button>
    </div>
</div>
<div class="table-responsive">
    <table
            id="bstableClientes"
            class="table table-striped"

            data-ajax="ajaxGetClientes"
            data-search="true"
            data-side-pagination="server"
            data-pagination="true"
            data-page-size="5"
            data-page-list="[5, 10, 20, 50, 100]"
            data-row-style="clientesRowStyle"
    >
        <thead>
        <tr>
            <th data-field="id"  data-sortable="true" data-align="left">Id</th>
            <th data-field="nombre"  data-sortable="true" data-align="left">Nombre</th>
            <th data-field="email" data-sortable="true">Email</th>
            <th data-field="perfil" data-formatter="formatClientesPerfil"  data-sortable="false">Perfil</th>
            <th data-field="lista" data-formatter="formatClientesLista" data-sortable="false">Lista de precios</th>
            <th data-field="id"  data-formatter="formatClientesOptions" data-align="center" data-sortable="false">Opciones</th>
        </tr>
        </thead>
    </table>
</div>
