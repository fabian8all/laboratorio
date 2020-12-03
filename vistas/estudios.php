<div class="row">
    <div class="col-12">
        <div class="title text-center">
            <h1 class="h3 mb-2 text-gray-800">
                Estudios
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12 float-left">
        <button class="btn btn-success btn-icon-split" id="btnEstudiosAdd">
            <span class="icon text-white-50">
               <i class="fa fa-plus-circle"></i>
            </span>
            <span class="text">
               Agregar estudio
            </span>
        </button>
    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table
                id="bstableEstudios"
                class="table table-striped"

                data-ajax="ajaxGetEstudios"
                data-search="true"
                data-side-pagination="server"
                data-pagination="true"
                data-page-size="5"
                data-page-list="[5, 10, 20, 50, 100]"
                data-row-style="estudiosRowStyle"
        >
            <thead>
            <tr>
                <th data-field="codigo"  data-sortable="true" data-align="left">Código</th>
                <th data-field="nombre"  data-sortable="true" data-align="left">Estudio</th>
                <th data-field="categoria" data-sortable="true">Categoría</th>
                <th data-field="costo" data-formatter="formatEstudiosPrecio" data-sortable="false">Precio</th>
                <th data-field="id"  data-formatter="formatEstudiosOptions" data-align="center" data-sortable="false">Opciones</th>
            </tr>
            </thead>
        </table>
    </div>

</div>
