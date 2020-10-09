<!-- MODAL -->
<div class="modal fade bs-example-modal-lg" id="modalUser" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">Registrar restaurante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="modal_body">




                <div class="row">
                    <form class="form-horizontal form-label-left input_mask" id="formUser">
                        <input type="hidden" value="user" name="action" id="action" >
                        <input type="hidden" value="" name="id" id="id" >

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_nombre">
                                Nombre del responsable
                                <span class="fa fa-user" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left required" id="txt_nombre" name="txt_nombre" placeholder="Ej. Juan Perez" type="text">
                            </label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_username">
                                Usuario
                                <span class="fa fa-id-badge" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left required" id="txt_username" name="txt_username" placeholder="Ej. Juanpe123" type="text">
                            </label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_email">
                                Email
                                <span class="fa fa-envelope" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left required" id="txt_email" name="txt_email" placeholder="Ej. Juanpe123@gmail.com" type="text">
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_pass">
                                Contraseña
                                <span class="fa fa-lock" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left required" id="txt_pass" name="txt_pass" type="password">
                            </label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_pass2">
                                Repetir contraseña
                                <span class="fa fa-lock" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left" id="txt_pass2" name="txt_pass2" type="password">
                            </label>
                        </div>
                    </div>
                    <hr>
                    <h3>Datos del restaurante</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_restaurante">
                                Nombre del restaurante
                                <span class="fa fa-home" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left required" id="txt_restaurante" name="txt_restaurante" type="text">
                            </label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_facebook">
                                Facebook
                                <span class="fa fa-facebook" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left" id="txt_facebook" name="txt_facebook" type="text">
                            </label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_telefono">
                                Telefono
                                <span class="fa fa-phone" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left" id="txt_telefono" name="txt_telefono" type="text">
                            </label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            <label class="col-form-label" for="txt_horarios">
                                Horarios
                                <span class="fa fa-clock-o" aria-hidden="true"></span>
                                <input class="form-control has-feedback-left" id="txt_horarios" name="txt_horarios" type="text">
                            </label>
                        </div>
                    </form>
<!--                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">-->
<!--                        <label class="col-form-label" for="file_logo">-->
<!--                            Logo-->
<!--                            <span class="fa fa-image" aria-hidden="true"></span>-->
<!--                            <form id="logoFileForm" method="post" action="upload.php" enctype="multipart/form-data" target="upload_target">-->
<!--                                <input class="form-control dataInput" id="file_logo" name="file_logo" type="file">-->
<!--                                <input type="hidden" id="hidFileLogoName" name="hidFileLogoName" value="">-->
<!--                            </form>-->
<!--                        </label>-->
<!--                    </div>-->
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnRegistrar" class="btn btn-success btnModal">Registrar</button>
            </div>
        </div>
    </div>
</div>
