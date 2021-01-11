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
<!--                        <div class="col-12 col-md-3 col-lg-3">-->
<!--                            <div class="form-group">-->
<!--                                <div class="card mb-4">-->
<!--                                    <div class="card-header">-->
<!--                                        <b>Descuento:</b>-->
<!--                                    </div>-->
<!--                                    <div class="card-body">-->
<!--                                        <span id="lblDescuento"></span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="col-12 col-md-9 col-lg-9">
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
<!-- MODAL Pagar Corte -->
<div class="modal fade" id="modPagarCorte" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">¿Pagar corte?</h5>
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
                                        <table class="table table-bordered table-sm" id="dataTable" width="100%"
                                               cellspacing="0">
                                            <thead id="thead" class="text-center">
                                            <th>COSTO TOTAL</th>
                                            <th>PAGADO</th>
                                            <th>TOTAL A PAGAR</th>
                                            </thead>
                                            <tbody id="tbody" class="text-center">
                                            <tr>
                                                <td id="lblCostoTotal"></td>
                                                <td id="lblUCortePagado"></td>
                                                <td id="lblTotalAPagar"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="txtPago" value="" onkeyup="if(this.value<0){this.value= this.value * -1}" min="0" step="0.05" placeholder="Pago">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="txtPagaCon" value="" onkeyup="if(this.value<0){this.value= this.value * -1}" min="0" step="0.05" placeholder="Paga con">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><b>Cambio: </b><span id="lblCambio"></span></label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <select class="form-control" id="selFormaPago">
                                        <option selected disabled value="">Forma de pago</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="txtReferencia" value="" placeholder="Referencia">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <input type="hidden" id="hidPagoIdCorte" value="">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
