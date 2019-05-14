<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4><span class="glyphicon glyphicon-lock"></span> Registro </h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
            <form>

                <div class="alert alert-danger" id="alert-danger">
                    <strong> Se han encontrado los siguientes errores: </strong>
                    <ul id="listaErroresFormularioRegistro"></ul>
                </div>

                <div id="alert alert-success" name="alert-success">
                    <strong> El registro se ha realizado con exito </strong>
                </div>


                <div class="form-group">
                    <label for="usrname">
                        <></span> Usuario
                    </label>
                    <input type="text" class="form-control" name="usuario" placeholder="Introduce el usuario">
                </div>
                <div class="form-group">
                    <?= form_error('contraseña'); ?>
                    <label for="psw"><span></span> Contraseña </label>
                    <input type="password" class="form-control" name="contraseña" placeholder="Introduce la contraseña">
                </div>
                <div class="form-group">
                    <?= form_error('correo'); ?>
                    <label for="psw"><span></span> Correo </label>
                    <input type="text" class="form-control" name="correo" placeholder="Introduce el correo">
                </div>
                <div class="form-group">
                    <?= form_error('nombre'); ?>
                    <label for="psw"><span></span> Nombre </label>
                    <input type="text" class="form-control" name="nombre" placeholder="Introduce el nombre">
                </div>
                <div class="form-group">
                    <?= form_error('apellnameos'); ?>
                    <label for="psw"><span></span> Apellnameos </label>
                    <input type="text" class="form-control" name="apellnameos" placeholder="Introduce los apellnameos">
                </div>

                <div class="form-group">
                    <?= form_error('dni'); ?>
                    <label for="psw"><span></span> Dni </label>
                    <input type="text" class="form-control" name="dni" placeholder="Introduce el DNI, ej: 48927745W">
                </div>
                <div class="form-group">
                    <?= form_error('direccion'); ?>
                    <label for="psw"><span></span> Direccion </label>
                    <input type="text" class="form-control" name="direccion" placeholder="Introduce la direccion">
                </div>

                <div class="form-group">
                    <label for="psw"><span></span> Provincias </label> <br>

                    <select name="provincias">


                    </select>

                </div>

                <div class="form-group">
                    <label for="psw"><span></span> Codigo postal </label>
                    <input type="text" class="form-control" name="codigoPostal"
                        placeholder="Introduce el codigo postal">
                </div>
                <button type="submit" name="registro" class="btn btn-success btn-block"> Aceptar </button>
            </form>


        </div>
        <div class="modal-footer">
            <br><button type="submit" class="btn btn-danger btn-default" data-dismiss="modal"> Cancelar </button>
        </div>




    </div>

</div>