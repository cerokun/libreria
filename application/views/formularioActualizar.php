 <div class="container" id="formularioActualizar">

     <h3 class="text-center" style="color:cadetblue"> Actualizar datos del usuario </h3><br>

     <?php if ( isset($actualizado)) : ?>
         <div class="alert alert-success text-center">
             <p> <strong> ¡Información! </strong> ¡Los datos han sido actualizados!. </p>
         </div>
     <?php endif ?>

     <?php if (validation_errors()) : ?>
         <div class="alert alert-danger text-center">
             <p> <strong> ¡Atención! </strong> Se han encontrado <strong> <?= count($this->form_validation->error_array())  ?> </strong>
                 errores revise los datos del formulario e intentelo de nuevo. </p>
         </div>
     <?php endif ?>


     <?= form_open("ModificarDatos/usuario") ?>

     <div class="row">

         <div class="col-4">
             <div class="form-group">
                 <label> <i class="far fa-user"></i> Usuario <?= form_error('usuario'); ?> </label>
                 <input type="text" class="form-control" name="usuario" value="<?= set_value('usuario', isset($usuario) ? $usuario : '') ?>" placeholder="Introduce el usuario">
             </div>

         </div>
         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fas fa-unlock-alt"></i> Contraseña <?= form_error('contraseña'); ?>
                 </label>
                 <input type="password" class="form-control" name="contraseña" value="<?= set_value('contraseña') ?>" placeholder="Introduce la contraseña">
             </div>
         </div>
         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fas fa-at"></i> Correo <?= form_error('correo'); ?> </label>
                 <input type="text" class="form-control" name="correo" value="<?= set_value('correo', isset($correo) ? $correo : '') ?>" placeholder="Introduce el correo">
             </div>
         </div>

     </div>

     <div class="row">

         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fas fa-signature"></i> Nombre <?= form_error('nombre'); ?></label>
                 <input type="text" class="form-control" name="nombre" value="<?= set_value('nombre',  isset($nombre) ? $nombre : '') ?>" placeholder="Introduce el nombre">
             </div>
         </div>
         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fas fa-signature"></i> Apellidos <?= form_error('apellidos'); ?>
                 </label>
                 <input type="text" class="form-control" name="apellidos" value="<?= set_value('apellidos',  isset($apellidos) ? $apellidos : '') ?>" placeholder="Introduce los apellidos">
             </div>
         </div>
         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fas fa-fingerprint"></i> Dni <?= form_error('dni'); ?></label>
                 <input type="text" class="form-control" name="dni" value="<?= set_value('dni',  isset($dni) ? $dni : '') ?>" placeholder=" ej: 48927745W">
             </div>
         </div>


     </div>

     <div class="row">

         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fas fa-map-marked-alt"></i> Direccion
                     <?= form_error('direccion'); ?></label>
                 <input type="text" class="form-control" name="direccion" value="<?= set_value('direccion',  isset($direccion) ? $direccion : '') ?>" placeholder="Introduce la direccion">
             </div>
         </div>
         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fab fa-cuttlefish"></i> Codigo postal
                     <?= form_error('codigoPostal'); ?> </label>
                 <input type="text" class="form-control" name="codigoPostal" value="<?= set_value('codigoPostal',  isset($codigoPostal) ? $codigoPostal : '') ?>" placeholder="Introduce el codigo postal">
             </div>
         </div>
         <div class="col-4">
             <div class="form-group">
                 <label> <i class="fas fa-city"></i> Provincias </label> <br>

                 <!-- Genera el select con las provincias de España -->
                 <?= crearSelect("provincia", $provincias, set_value('provincia',  isset($provincia) ? $provincia : '')) ?>

             </div>

         </div>

     </div>

     <div class="text-center">
         <button type="submit" class="btn btn-success"> Actualizar </button>
     </div>
     <?= form_close() ?>
 </div>