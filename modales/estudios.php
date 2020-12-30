<div id="modalEstudios" class="modal" tabindex="-1" role="dialog" style="overflow-y: auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del estudio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEstudios" class="user">
                    <input type="hidden" id="hidEstudiosMode" value="">
                    <input type="hidden" id="hidEstudiosId" value="">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="txtEstudiosCode" placeholder="Código">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user necesary" id="txtEstudiosNombre" placeholder="Nombre del estudio*">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
<!--                                <select id="selEstudiosCategoria" class="form-control form-control-user" style="padding: 0rem 1rem;height: 3.2rem;">-->
<!--                                    <option selected disabled value="0">Categoría</option>-->
<!--                                </select>-->
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user necesary" id="txtEstudiosTiempo" placeholder="Tiempo*">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" step="0.05" class="form-control form-control-user necesary" id="txtEstudiosCosto" placeholder="Costo*">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" step="0.05" class="form-control form-control-user necesary" id="txtEstudiosCostoM" placeholder="Costo Medico*">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" step="0.05" class="form-control form-control-user necesary" id="txtEstudiosCostoE" placeholder="Costo Empresa*">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" step="0.05" class="form-control form-control-user necesary" id="txtEstudiosCostoL4" placeholder="Costo Lista4*">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control form-control-user" id="txtEstudiosMuestra" placeholder="Muestra"></textarea>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" id="btnEstudiosSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="modImportarPrecios" class="modal" tabindex="-1" role="dialog" style="overflow-y: auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Importar lista de precios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmListaPrecios" class="user" action="importarPrecios.php" enctype="multipart/form-data" target="importarPrecios_target">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <button class="btn btn-primary btn-icon-split" id="btnDescargarPlantilla">
                                <span class="icon text-white-50">
                                    <i class="fa fa-download"></i>
                                </span>
                                <span class="text">
                                    Descargar Plantilla
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8"></div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" id="fileListaCSV" name="fileListaCSV" class="form-control" accept=".csv" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnImportarListaCSV" class="btn btn-success">
                    <span class="fa fa-upload"></span>
                    Importar Lista
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
