<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Correo enviado </title>
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

        .jumbotron {
            margin-top: 18%;

        }
    </style>

</head>

<body>

   

        <div class="jumbotron">
            <p class="display-4"> <i class="fas fa-mail-bulk" style="color:darkgreen"></i>¡Correo enviado!</p>
            <p class="lead"> A la siguiente dirección: <strong style="color:darkmagenta"> <?= $correo ?> </strong> el <?= date("d/m/Y") ?> a las <?= date('h:i:s A') ?> horas. </p>
            <hr class="my-4">
            <p> <i class="fas fa-info-circle" style="color:orange"></i> Acabamos de enviarle un correo electrónico a la dirección indicada, en breve recibirá un mensaje en su bandeja de entrada, haga click sobre el enlace que le enviamos y siga atentamente las instrucciones que le indiquemos, una vez haya cambiado la contraseña, vuelva a acceder a esta ventana login e identifiquese.</p>
          
        </div>

</body>

</html>