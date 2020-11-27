<!-- MODAL DETALLES -->
<div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detalles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Estudios solicitados:
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush" id="listaEstudios"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <b>Fecha de solicitud:</b>
                                </div>
                                <div class="card-body" >
                                    <span id="lblFechaSol"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <b>Levantó orden:</b>
                                </div>
                                <div class="card-body" >
                                    <span id="lblAnalista"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <b>Muestra tomada:</b>
                                </div>
                                <div class="card-body">
                                    <span id="lblFechaMuestra"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <b>Entregado:</b>
                                </div>
                                <div class="card-body" >
                                    <span id="lblFechaEntrega"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <b>Costo:</b>
                                </div>
                                <div class="card-body" >
                                    <span id="lblCosto"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <b>Descuento:</b>
                                </div>
                                <div class="card-body" >
                                    <span id="lblDescuento"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <b>Pagado:</b>
                                </div>
                                <div class="card-body" >
                                    <div id="lblPagado"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AGREGAR PACIENTE -->
<div class="modal fade" id="modalSubirResultados" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Subir resultados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="resultsFileForm" method="post" action="uploadFile.php" enctype="multipart/form-data" target="upload_target">
                                <input type="hidden" id="hidSRSolicitudId" name="hidSRSolicitudId" value="">
                                <input type="hidden" id="hidSRFileName" name="hidSRFileName" value="">
                                <input type="file" id="fileResultados" name="fileResultados" class="form-control" accept="application/pdf" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnUploadResults" type="button" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Subir Resultados
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL TERMINAR PAGO -->
<div class="modal fade" id="modAgregarPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div id="tableContainer" class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                            <thead id="thead" class="text-center">
                                            <th>COSTO TOTAL</th>
                                            <th>ANTICIPO</th>
                                            <th>TOTAL A PAGAR</th>
                                            </thead>
                                            <tbody id="tbody" class="text-center">
                                            <tr>
                                                <td id="lblCostoTotal"></td>
                                                <td id="lblAnticipo"></td>
                                                <td id="lblTotalAPagar"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="txtPago" value="" placeholder="Agregar pago">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input type="hidden" id="hidPagoIdSolicitud" value="">
                                    <button type="button" class="btn btn-success w-100" id="btnPagoSubmit">
                                        <span class="fa fa-money"></span>
                                        Guardar pago
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
