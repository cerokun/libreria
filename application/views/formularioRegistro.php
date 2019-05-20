<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Login </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        body {
            background-image: url("<?= base_url() . 'assets/img/pagina/fondoLogin.jpg' ?>");
            background-repeat: no-repeat;
        }

        h3 {
            color: white;
        }

        .modal-footer,
        .modal-header {
            background-color: black;
        }
    </style>
    </style>
</head>

<body>

    <div class="moda" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header justify-content-center" style="padding:35px 50px;">
                    <h3> Formulario de registro </h3>
                </div>
                <div class="modal-body" style="padding:40px 50px;">

                    <?php if ($estoyRegistrado) : ?>
                        <div class="alert alert-success">
                            <p> <strong> ¡Información! </strong> Acabas de registrarte. </p>
                        </div>
                    <?php endif ?>

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger">
                            <p> <strong> ¡Atención! </strong> Se han encontrado <strong> <?= count($this->form_validation->error_array())  ?> </strong>
                                errores revise los datos del formulario e intentelo de nuevo. </p>
                        </div>
                    <?php endif ?>


                    <?= form_open("Registrar/usuario") ?>

                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label> <i class="far fa-user"></i> Usuario <?= form_error('usuario'); ?> </label>
                                <input type="text" class="form-control" name="usuario" value="<?= set_value('usuario') ?>" placeholder="Introduce el usuario">
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
                                <input type="text" class="form-control" name="correo" value="<?= set_value('correo') ?>" placeholder="Introduce el correo">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label> <i class="fas fa-signature"></i> Nombre <?= form_error('nombre'); ?></label>
                                <input type="text" class="form-control" name="nombre" value="<?= set_value('nombre') ?>" placeholder="Introduce el nombre">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label> <i class="fas fa-signature"></i> Apellidos <?= form_error('apellidos'); ?>
                                </label>
                                <input type="text" class="form-control" name="apellidos" value="<?= set_value('apellidos') ?>" placeholder="Introduce los apellidos">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label> <i class="fas fa-fingerprint"></i> Dni <?= form_error('dni'); ?></label>
                                <input type="text" class="form-control" name="dni" value="<?= set_value('dni') ?>" placeholder=" ej: 48927745W">
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label> <i class="fas fa-map-marked-alt"></i> Direccion
                                    <?= form_error('direccion'); ?></label>
                                <input type="text" class="form-control" name="direccion" value="<?= set_value('direccion') ?>" placeholder="Introduce la direccion">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label> <i class="fab fa-cuttlefish"></i> Codigo postal
                                    <?= form_error('codigoPostal'); ?> </label>
                                <input type="text" class="form-control" name="codigoPostal" value="<?= set_value('codigoPostal') ?>" placeholder="Introduce el codigo postal">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label> <i class="fas fa-city"></i> Provincias </label> <br>

                                <!-- Genera el select con las provincias de España -->
                                <?= crearSelect("provincia", $provincias, set_value('provincia')) ?>

                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                        <br>
                        <a class="btn btn-dark" role="button" href="<?= site_url('Login/mostrarFormulario') ?>"><i class="fas fa-undo"></i> Regresar ventana login </a>
                        <button type="submit" class="btn btn-success"> Registrate </button>

                    </div>

                    </form>

                </div>
                <div class="modal-footer"> </div>

            </div>

        </div>
    </div>

</body>

</html>