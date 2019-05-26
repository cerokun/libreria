<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PeticionesCarrito extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Productos');
        $this->load->library("Carrito");
    }
    /**
     * Obtengo la clave primara del producto.
     *
     * @return void
     */
    public function addCarrito()
    {
        $id = $this->input->post("idProducto");
        echo "id: $id";
      
        // Compruebo si este producto ya se encuentra almacenando en el carrito
        if ($this->carrito->siExiste($id)) {
            echo "Ya existia";
            $this->carrito->incrementarCantidad($id, 1);

        } else {
            // Solicito los datos del producto
            echo "Nuevo";
            $libro = $this->Productos->damePorSuId($id);
            $this->carrito->añadir($id, $libro);
            $this->carrito->incrementarCantidad($id, 1);
        }
       

       // $this->carrito->eliminar($id);

        echo "<pre>";
        print_r( $this->carrito->dameTodosLosProductos() );
        echo "</pre>";
 
    }
}// Final clase
