$(document).ready(function(){
  
    $("#categorias").change( categorias );
    $( document).on( "click", ".addCarrito", addCarrito  );

});

 

function addCarrito() {

      // Obtengo el valor del atributo value del option seleccionado.
    var id = $(this).attr("id");
  
    // Peticion ajax.
    $.ajax({

        // la URL para la petición, concateno la site_url() con el controlador y metodo al que queiro llamar.
        url :  site_url + 'PeticionesCarrito/addCarrito/',

        // la información a enviar   
        data : { idProducto : id },

        // especifica si será una petición POST o GET
        type : 'POST',

        // el tipo de información que se espera de respuesta
        dataType : 'html',

        success: function(respuesta) {
          //  $("#contenedor").replaceWith( respuesta );
           
        }
       
    });


}

/**
 * Muestra los libros
 */
function categorias() {

    // Obtengo el valor del atributo value del option seleccionado.
    var id = $("#categorias").val();
  
    // Peticion ajax.
    $.ajax({

        // la URL para la petición, concateno la site_url() con el controlador y metodo al que queiro llamar.
        url :  site_url + 'Principal/productosPorCategoria/',

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