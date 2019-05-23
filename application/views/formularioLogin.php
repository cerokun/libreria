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
</head>

<body>

    <!-- Modal -->
    <div class="modal-dialog" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header justify-content-center" style="padding:35px 50px;">
                    <h3> Iniciar sesión </h3>
                </div>
                <div class="modal-body" style="padding:40px 50px;">

                    <?php if (isset($mensaje)) : ?>
                        <div class="alert alert-success">
                            <p class="text-center"> <strong> <?= $mensaje ?> </strong> </p>
                        </div>
                    <?php endif ?>

                    <?php if (isset($usuarioNoExiste)) : ?>
                        <div class="alert alert-danger">
                            <p class="text-center"> <strong> <?= $usuarioNoExiste ?> </strong> </p>
                        </div>
                    <?php endif ?>

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger">
                            <strong>
                                <ul> <?= validation_errors(); ?> </ul>
                            </strong>
                        </div>
                    <?php endif ?>

                    <?= form_open("Login/usuario") ?>

                    <div class="form-group">
                        <label> <i class="fas fa-at"></i> Correo </label>
                        <input type="text" class="form-control" name="correo" value="<?= set_value('correo') ?>" placeholder="Introduce el correo electronico...">
                    </div>
                    <div class="form-group">
                        <label> <i class="fas fa-unlock-alt"></i> Contraseña </label>
                        <input type="password" class="form-control" name="contraseña" placeholder="Introduce la contraseña...">
                    </div>

                    <div class="text-center">
                        <a class="btn btn-dark" role="button" href="<?= site_url('Principal') ?>"><i class="fas fa-undo"></i> Regresar al menu principal </a>
                        <button type="submit" class="btn btn-success"> Login </button>
                    </div>

                    </form>
                </div>
                <div class="modal-footer" id="pie">
                    <a class="text-success" href="<?= site_url('Registrar/mostrarFormulario') ?>"> Si aun no tienes cuenta, registrate </a>
                    <a class="text-warning" href="<?= site_url('OlvideMiPassword') ?>"> ¿Has olvidado tu contraseña? </a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>