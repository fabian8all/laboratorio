<!-- MODAL DETALLES -->
<div class="modal fade" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
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
                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Estudios solicitados:</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-responsive">
                                            <tbody id="listaEstudios"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Fecha de solicitud:</b>
                                    </div>
                                    <div class="card-body">
                                        <span id="lblFechaSol"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-8">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Levantó orden:</b>
                                    </div>
                                    <div class="card-body">
                                        <span id="lblAnalista"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Muestra tomada:</b>
                                    </div>
                                    <div class="card-body">
                                        <span id="lblFechaMuestra"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Entregado:</b>
                                    </div>
                                    <div class="card-body">
                                        <span id="lblFechaEntrega"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Costo:</b>
                                    </div>
                                    <div class="card-body">
                                        <span id="lblCosto"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Descuento:</b>
                                    </div>
                                    <div class="card-body">
                                        <span id="lblDescuento"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <b>Pagado:</b>
                                    </div>
                                    <div class="card-body">
                                        <div id="lblPagado"></div>
                                    </div>
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
