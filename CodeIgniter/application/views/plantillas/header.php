 <!DOCTYPE html>
 <html lang="en">

 <head>

     <title> Libreria </title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Boostrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

     <!-- jQuery library -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

     <!-- Popper JS -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

     <!-- Boostrap js -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
     <!-- Mis estilos -->
     <link rel="stylesheet" href="../Assets/css/header.css" />
     <link rel="stylesheet" href="../Assets/css/nav.css" />
     <link rel="stylesheet" href="../Assets/css/general.css" />
     <link rel="stylesheet" href="../Assets/css/footer.css" />

 </head>

 <body>

     <header>
         <!-- Imagen cabecera -->
         <img src="../Assets/img/pagina/cabecera.jpg">
         <!-- Tipo de usuario -->
         <h3 id="tipo"> Cliente o Administrador</h3>
         <!-- Nombre del usuario -->
         <h4 id="nombre"> ¡Bienvenido nombre usuario! </h4>
         <!-- Hora a la que se ha conectado -->
         <h5 id="hora"><span style="color:white"> Has iniciado</span> sesion a las 20:00 </h5>
         <!-- Boton para identificarse como usuario -->
         <a href="#"> <img src="../Assets/img/pagina/identificate.png" width="85px" title="Cerrar la sesion" id="identificate"> </a>
         <div class="input-group col-md-5 mx-auto" id="buscador">
             <!-- Las categorias -->
             <select class="btn btn-primary" id="categorias">
                 <option value="0"> Categorias </option>

                 <?php foreach ($categorias as $fila) : ?>
                     <option value="<?= $fila["idCategoria"] ?>"> <?= $fila["nombre"] ?> </option>
                 <?php endforeach ?>

             </select>
             <!-- Buscador -->
             <input class="form-control py-2" type="search" placeholder="Busca por nombre, ISBN, categoría…" id="buscar">
             <span class="input-group-append">
                 <button type="button" class="btn btn-success"> Buscar </button>
             </span>
         </div>
     </header>