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
            background-image: url("<?= base_url() . 'Assets/img/pagina/fondoLogin.jpg' ?>");
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
    <div class="moda" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <h3> Recuperar la contraseña </h3>
                </div>
                <div class="modal-body" style="padding:40px 50px;">

                    <?php if (form_error("correo")) : ?>
                        <div class="alert alert-danger text-center">
                            <strong> ¡Atención! </strong> <?= form_error("correo")  ?>
                        </div>
                    <?php endif ?>

                    <?= form_open("RecuperaPassword/cuenta") ?>

                    <div class="form-group">
                        <label> <i class="fas fa-at"></i> Correo </label>
                        <input type="text" class="form-control" name="correo" value="<?= set_value('correo') ?>" placeholder="Introduce el correo electronico...">
                    </div>

                    <div class="text-center">
                        <a class="btn btn-dark" role="button" href="<?= site_url('Login/mostrarFormulario') ?>"><i class="fas fa-undo"></i> Regresar ventana login </a>
                        <button type="submit" class="btn btn-success"> Enviar </button>
                    </div>

                    </form>
                </div>
                <div class="modal-footer" id="pie">


                </div>
            </div>

        </div>
    </div>
</body>

</html>