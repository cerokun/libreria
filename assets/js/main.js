$(document).ready(function(){
    // Cargo los eventos.
    $( document).on( "change", "#categorias", categorias );
    $( document).on( "click", ".addCarrito",  addCarrito  );
    $( document).on( "click", "#vaciarCarrito", vaciarCarrito  ); 
    $( document).on( "click", "#menuCarrito", listar );
    $( document).on( "click", ".eliminaEsteProductoDelCarrito", eliminaEsteProductoDelCarrito);
    $( document).on( "change", ".estados", estados );
});

/**
 * Actualiza estado pedido
 */
function estados() {

    // Obtengo el idPedido
    var idPedido = $(this).attr('id');
    var estado = $(this).val();
     
    var parametros = {
        "idPedido": idPedido,
        "estado": estado
    };

    // Peticion ajax.
    $.ajax({

        // la URL para la petición, concateno la site_url() con el controlador y metodo al que queiro llamar.
        url :  site_url + 'Pedidos_C/cambiarEstado/',
 
        // especifica si será una petición POST o GET
        type : 'POST',
       
        // la información a enviar   
        data : parametros,

           // el tipo de información que se espera de respuesta
        dataType : 'json',

        success: function(respuesta) {
             if ( respuesta["actualizado"] == "si") {
                 $("#mensajePedidoActualizado").css("display", "block");             
             } else {
                 $("#mensajePedidoNoActualizado").css("display", "block");                         
             }

             setTimeout(function(){   $("#mensajePedidoActualizado").fadeOut(3000) }, 3000);
        }
       
    });

     
}

 function eliminaEsteProductoDelCarrito() {
   
    var id = $(this).attr("id");

    // Peticion ajax.
    $.ajax({

        // la URL para la petición, concateno la site_url() con el controlador y metodo al que queiro llamar.
        url :  site_url + 'PeticionesCarrito/eliminar/',
 
        // especifica si será una petición POST o GET
        type : 'POST',
       
        // la información a enviar   
        data : { idProducto : id },

           // el tipo de información que se espera de respuesta
        dataType : 'html',

        success: function(respuesta) {
             $("#contenedor").replaceWith( respuesta );
        }
       
    });


 }


function vaciarCarrito() {


    // Peticion ajax.
    $.ajax({

        // la URL para la petición, concateno la site_url() con el controlador y metodo al que queiro llamar.
        url :  site_url + 'PeticionesCarrito/vaciar/',
 
        // especifica si será una petición POST o GET
        type : 'POST',
  
           // el tipo de información que se espera de respuesta
        dataType : 'html',

        success: function(respuesta) {
             $("#contenedor").replaceWith( respuesta );
        }
       
    });


}



function addCarrito() {

      // Obtengo el valor del atributo value del option seleccionado.
    var id = $(this).attr("id");
  
    // Peticion ajax.
    $.ajax({

        // la URL para la petición, concateno la site_url() con el controlador y metodo al que queiro llamar.
        url :  site_url + 'PeticionesCarrito/add/',

        // la información a enviar   
        data : { idProducto : id },

        // especifica si será una petición POST o GET
        type : 'POST',
 
         // el tipo de información que se espera de respuesta
        dataType : 'json',

        success: function(respuesta) {
                  
             if (respuesta["estado"] === "true" ) {
                $("#numeroDeProductos").text( respuesta["total"] );
             }
             else if ( respuesta["estado"] === "false") {
                 // Mensaje que mostrare al cliente.
                $("#avisoDelCarrito").text( respuesta["aviso"] );
                // Muestro la ventana de alerta que estaba oculta.
                 $("#ventanaAlertCarrito").css("display", "block");                             
                // Desactivo el boton añadir de dicho producto.
                $("button#"+id).attr('disabled', true);
                // Oculto la ventan tras unos segundos
                setTimeout(function(){  $("#ventanaAlertCarrito").fadeOut(3000) }, 6000);

             }
           
        }
       
    });

   
}

 function listar() {

    // Peticion ajax.
    $.ajax({

        // la URL para la petición, concateno la site_url() con el controlador y metodo al que queiro llamar.
        url :  site_url + 'PeticionesCarrito/listar/',

        // especifica si será una petición POST o GET
        type : 'GET',
 
         // el tipo de información que se espera de respuesta
        dataType : 'html',

        success: function(respuesta) {
             $("#contenedor").replaceWith( respuesta );
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