$(document).ready(function(){
  
    $("#categorias").change( categorias );

});

function categorias() {

    // Obtengo el valor del atributo value del option seleccionado.
    var id = $("#categorias").val();
   
    alert("peticion ajax categoria " + id );
    // Peticion ajax.
    $.ajax({

        // la URL para la petición
        url : 'http://localhost/libreria/index.php/Principal/productosPorCategoria',

        // la información a enviar   
        data : { idCategoria : id },

        // especifica si será una petición POST o GET
        type : 'POST',

        // el tipo de información que se espera de respuesta
        dataType : 'html',

        success: function(respuesta) {
            $("#contenedor").replaceWith( respuesta );
           
        }
       
    });

}