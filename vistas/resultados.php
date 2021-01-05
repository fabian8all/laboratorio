<h1 class="h3 mb-2 text-gray-800">Resultados</h1>
<nav>
    <div class="nav nav-fill nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-pendienteMuestra-tab" data-toggle="tab" href="#nav-pendienteMuestra" role="tab" aria-controls="nav-pendienteMuestra" aria-selected="true">Pendiente de muestra</a>
        <a class="nav-item nav-link" id="nav-enProceso-tab" data-toggle="tab" href="#nav-enProceso" role="tab" aria-controls="nav-enProceso" aria-selected="false">En proceso</a>
        <a class="nav-item nav-link" id="nav-pendientePago-tab" data-toggle="tab" href="#nav-pendientePago" role="tab" aria-controls="nav-pendientePago" aria-selected="false">Pendiente de pago</a>
        <a class="nav-item nav-link " id="nav-finalizado-tab" data-toggle="tab" href="#nav-finalizado" role="tab" aria-controls="nav-finalizado" aria-selected="false">Finalizado</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <!-- ------------ PESTAÑA PARA DIAGNOSTICO CLIENTE --------------- -->
    <div class="tab-pane fade show active" id="nav-pendienteMuestra" role="tabpanel" aria-labelledby="nav-pendienteMuestra-tab">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="tableContainer" class="table-responsive">
                    <table
                            id="bstableResultsPM"
                            class="table table-striped table-bordered table-sm"
                            width="100%"
                            cellspacing="0"
                            data-ajax="ajaxGetResults"
                            data-search="true"
                            data-side-pagination="server"
                            data-pagination="true"
                            data-page-size="5"
                            data-page-list="[5, 10, 20, 50, 100]"
                            data-row-style="ResultsRowStyle"
                    >
                        <thead>
                        <tr>
                            <th data-field="paciente"  data-sortable="true" data-align="left">PACIENTE</th>
                            <th data-field="fecha"  data-sortable="true" data-align="left">FECHA</th>
                            <th data-field="levanto" data-sortable="true">LEVANTÓ ORDEN</th>
<!--                            <th data-field="status" data-formatter="formatEstudiosPrecio" data-sortable="false">ESTATUS</th>-->
                            <th data-field="id"  data-formatter="formatResultsPMOptions" data-align="center" data-sortable="false">OPCIONES</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------ PESTAÑA PARA PRE-DIAGNOSTICO--------------- -->
    <div class="tab-pane fade" id="nav-enProceso" role="tabpanel" aria-labelledby="nav-enProceso-tab">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="tableContainer" class="table-responsive">
                    <table
                            id="bstableResultsEP"
                            class="table table-striped table-bordered table-sm"
                            width="100%"
                            cellspacing="0"
                            data-ajax="ajaxGetResults"
                            data-search="true"
                            data-side-pagination="server"
                            data-pagination="true"
                            data-page-size="5"
                            data-page-list="[5, 10, 20, 50, 100]"
                            data-row-style="ResultsRowStyle"
                    >
                        <thead>
                        <tr>
                            <th data-field="paciente"  data-sortable="true" data-align="left">PACIENTE</th>
                            <th data-field="fecha"  data-sortable="true" data-align="left">FECHA</th>
                            <th data-field="levanto" data-sortable="true">LEVANTÓ ORDEN</th>
<!--                            <th data-field="status" data-formatter="formatEstudiosPrecio" data-sortable="false">ESTATUS</th>-->
                            <th data-field="id"  data-formatter="formatResultsEPOptions" data-align="center" data-sortable="false">OPCIONES</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------ PESTAÑA PARA DIAGNOSTICO FINAL --------------- -->
    <div class="tab-pane fade" id="nav-pendientePago" role="tabpanel" aria-labelledby="nav-pendientePago-tab">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="tableContainer" class="table-responsive">
                    <table
                            id="bstableResultsPP"
                            class="table table-striped table-bordered table-sm"
                            width="100%"
                            cellspacing="0"
                            data-ajax="ajaxGetResults"
                            data-search="true"
                            data-side-pagination="server"
                            data-pagination="true"
                            data-page-size="5"
                            data-page-list="[5, 10, 20, 50, 100]"
                            data-row-style="ResultsRowStyle"
                    >
                        <thead>
                        <tr>
                            <th data-field="paciente"  data-sortable="true" data-align="left">PACIENTE</th>
                            <th data-field="fecha"  data-sortable="true" data-align="left">FECHA</th>
                            <th data-field="levanto" data-sortable="true">LEVANTÓ ORDEN</th>
                            <!--                            <th data-field="status" data-formatter="formatEstudiosPrecio" data-sortable="false">ESTATUS</th>-->
                            <th data-field="id"  data-formatter="formatResultsPPOptions" data-align="center" data-sortable="false">OPCIONES</th>
                        </tr>
                        </thead>
                    </table>                </div>
            </div>
        </div>
    </div>
    <!-- ------------ PESTAÑA PARA ORDEN ENTREGADA NO PAGADA --------------- -->
    <div class="tab-pane fade" id="nav-finalizado" role="tabpanel" aria-labelledby="nav-finalizado-tab">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="tableContainer" class="table-responsive">
                    <table
                            id="bstableResultsF"
                            class="table table-striped table-bordered table-sm"
                            width="100%"
                            cellspacing="0"
                            data-ajax="ajaxGetResults"
                            data-search="true"
                            data-side-pagination="server"
                            data-pagination="true"
                            data-page-size="5"
                            data-page-list="[5, 10, 20, 50, 100]"
                            data-row-style="ResultsRowStyle"
                    >
                        <thead>
                        <tr>
                            <th data-field="paciente"  data-sortable="true" data-align="left">PACIENTE</th>
                            <th data-field="fecha"  data-sortable="true" data-align="left">FECHA</th>
                            <th data-field="levanto" data-sortable="true">LEVANTÓ ORDEN</th>
                            <!--                            <th data-field="status" data-formatter="formatEstudiosPrecio" data-sortable="false">ESTATUS</th>-->
                            <th data-field="id"  data-formatter="formatResultsFOptions" data-align="center" data-sortable="false">OPCIONES</th>
                        </tr>
                        </thead>
                    </table>                </div>
            </div>
        </div>
    </div>
</div>
