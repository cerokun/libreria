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
            background-image: url("../../Assets/img/pagina/fondo1.jpg");
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <!-- Modal -->
    <div class="moda" id="myModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <h3> Login </h3>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <?= form_open("Login/comprobar") ?>

                    <div class="form-group">
                        <label> <i class="fas fa-at"></i> Correo <?= form_error("correo") ?> </label>
                        <input type="text" class="form-control" name="correo" value="<?= set_value('correo') ?>" placeholder="Introduce el correo electronico...">
                    </div>
                    <div class="form-group">
                        <label> <i class="fas fa-unlock-alt"></i> Contraseña <?= form_error("contraseña") ?></label>
                        <input type="password" class="form-control" name="contraseña" placeholder="Introduce la contraseña...">
                    </div>

                    <div class="text-center">
                        <a class="btn btn-dark" role="button" href="<?= site_url('Principal') ?>"><i class="fas fa-undo"></i> Regresar al menu principal </a>
                        <button type="submit" class="btn btn-success"> Login </button>
                    </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <a href="<?= site_url('Registrar/mostrarFormulario') ?>"> ¿Si aun no tienes cuenta... ? registrate </a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>