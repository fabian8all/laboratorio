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
    <div class="col-lg-3 col-md-4 col-12">
        <button data-toggle="modal" data-target="#modalHistorialCortes" title="Historial Cortes"
            class="btn btn-info btn-icon-split w-100 position-relative" style="padding-left:10px" id="btnVerCortes">
            <span class="icon text-white-50" style="position:absolute;left:0;">
                <i class="fa fa-user-md"></i>
            </span>
            <span class="text">
                Historial Cortes
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
            <th data-field="perfil"  data-sortable="false">Perfil</th>
            <th data-field="descuento" data-formatter="formatClientesDescuento" data-sortable="false">Descuento</th>
            <th data-field="id"  data-formatter="formatClientesOptions" data-align="center" data-sortable="false">Opciones</th>
        </tr>
        </thead>
    </table>
</div>

<div id="modalHistorialCortes" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial De Cortes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Collapsable Card Example -->
                        <div class="card shadow mb-4">
                            <!-- Card Header - Accordion -->
                            <a href="#historialCorteCard" class="d-block card-header py-3" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="historialCorteCard">
                                <h6 class="m-0 font-weight-bold text-primary">02/02/2020 - $100.00</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse" id="historialCorteCard">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Accordion -->
                                                <a href="#listaSolicitudesCard" class="d-block card-header py-3"
                                                    data-toggle="collapse" role="button" aria-expanded="true"
                                                    aria-controls="listaSolicitudesCard">
                                                    <h6 class="m-0 font-weight-bold text-primary">Jose Ramon Diaz Ortega - 20/20/20 - $100.00
                                                    </h6>
                                                </a>
                                                <!-- Card Content - Collapse -->
                                                <div class="collapse show" id="listaSolicitudesCard">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label><b>Estudios:</b></label>
                                                                <label>17 ALFA HIDROXI PROGESTERONA (SUERO)</label>
                                                                <label>17 ALFA HIDROXI PROGESTERONA (SUERO)</label>
                                                                <label>17 ALFA HIDROXI PROGESTERONA (SUERO)</label>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label><b>Costo:</b></label>
                                                                <label>$100.00</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnClientesSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
