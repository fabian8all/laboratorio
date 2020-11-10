<!-- MODAL AGREGAR CLIENTE -->
<div class="modal fade" id="modAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAgregar" class="user">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user necesary" id="txtNombres" placeholder="Nombres*">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user necesary" name="" value="" placeholder="Genero*">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user necesary" name="" value="" placeholder="Edad*">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="tel" class="form-control form-control-user necesary" name="" value="" placeholder="Teléfono*">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user necesary" name="" value="" placeholder="Correo electrónico*">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button id="btnAgregarNew" type="submit" class="btn btn-success">Agregar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL EDITAR -->
<div class="modal fade" id="modAgregarEstudio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-12">
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 smallMargin">
                        <form>
                            <div class="input-group">
                                <input type="text" id="txt_busqueda" class="form-control bg-light border-0 small" style="background-color: white !important" placeholder="Buscar cliente..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="margin-top: 20px" id="carouselExampleControls" class="carousel " data-ride="">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <span style="display:inline-block" class="btn btn-info">4568</span>
                                            <h6 style="display:inline-block">VDRL EM SUERO</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Tiempo:</p>
                                                <label style="display:inline-block">1</label>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Costo:</p>
                                                <label style="display:inline-block">$100</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <span style="display:inline-block" class="btn btn-info">4568</span>
                                            <h6 style="display:inline-block">VDRL EM SUERO</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Tiempo:</p>
                                                <label style="display:inline-block">1</label>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Costo:</p>
                                                <label style="display:inline-block">$100</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <span style="display:inline-block" class="btn btn-info">4568</span>
                                            <h6 style="display:inline-block">VDRL EM SUERO</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Tiempo:</p>
                                                <label style="display:inline-block">1</label>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Costo:</p>
                                                <label style="display:inline-block">$100</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <span style="display:inline-block" class="btn btn-info">4568</span>
                                            <h6 style="display:inline-block">VDRL EM SUERO</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <h6>SUERO 1 ML AYUNO 8HRS. REFRIGERAR</h6>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Tiempo:</p>
                                                <label style="display:inline-block">1</label>
                                            </div>
                                            <div class="form-group">
                                                <p style="display:inline-block">Costo:</p>
                                                <label style="display:inline-block">$100</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="..." alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button id="btnguardarEdit" type="submit" class="btn btn-success">Aceptar</button>
            </div>
            </form>
        </div>
    </div>
</div>
