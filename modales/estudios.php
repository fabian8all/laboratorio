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
                <form id="frmEstudios">
                    <input type="hidden" id="hidEstudiosMode" value="">
                    <input type="hidden" id="hidEstudiosId" value="">
                    <div class="row">
                        <div class="col-4">
                            <label for="txtEstudiosCode" class="col-form-label">
                                <strong>Código:</strong>
                            </label>
                            <input type="text" class="form-control" id="txtEstudiosCode">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="txtEstudiosNombre" class="col-form-label">
                                <strong>Nombre:</strong>
                            </label>
                            <input type="text" class="form-control" id="txtEstudiosNombre">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="selEstudiosCategoria" class="col-form-label">
                                <strong>Categoría</strong>
                            </label>
                            <select id="selEstudiosCategoria" class="form-control">
                                <option selected disabled value="0">--Seleccione categoría</option>
                                <option value="1">Hematología</option>
                                <option value="2">Orina</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="txtEstudiosTiempo" class="col-form-label">
                                <strong>Tiempo:</strong>
                            </label>
                            <input type="number" class="form-control" id="txtEstudiosTiempo">
                        </div>
                        <div class="col-4">
                            <label for="txtEstudiosCosto" class="col-form-label">
                                <strong>Costo:</strong>
                            </label>
                            <input type="number" step="0.05" class="form-control" id="txtEstudiosCosto">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="txtEstudiosMuestra" class="col-form-label">
                                <strong>Muestra:</strong>
                            </label>
                            <textarea class="form-control" id="txtEstudiosMuestra"></textarea>
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
