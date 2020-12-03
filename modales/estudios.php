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
                                <input type="text" class="form-control form-control-user" id="txtEstudiosNombre" placeholder="Nombre del estudio">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <select id="selEstudiosCategoria" class="form-control form-control-user" style="padding: 0rem 1rem;height: 3.2rem;">
                                    <option selected disabled value="0">Categoría</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="txtEstudiosTiempo" placeholder="Tiempo">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" step="0.05" class="form-control form-control-user" id="txtEstudiosCosto" placeholder="Costo">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnEstudiosSave" class="btn btn-success">
                    <span class="fa fa-save"></span>
                    Guardar
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
