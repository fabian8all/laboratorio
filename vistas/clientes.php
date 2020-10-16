<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="title text-center">
                <h3>
                    Clientes
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-12 float-left">
            <button title="Agregar cliente" class="btn btn-success" id="btnClientesAdd">
                <span class="fa fa-user-md"></span>
                Nuevo Cliente
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
                <th data-field="perfil"  data-sortable="false">Perfil</th>
                <th data-field="descuento" data-formatter="formatClientesDescuento" data-sortable="false">Descuento</th>
                <th data-field="id"  data-formatter="formatClientesOptions" data-align="center" data-sortable="false">Opciones</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
