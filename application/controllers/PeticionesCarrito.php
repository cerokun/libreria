<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PeticionesCarrito extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Productos');
        $this->load->library("carrito");
    }
    /**
     * Obtengo la clave primara del producto.
     *
     * @return void
     */
    public function add()
    {
        $id = $this->input->post("idProducto");

        // Compruebo si este producto ya se encuentra almacenando en el carrito
        if ($this->carrito->siExiste($id)) {
            if ($this->carrito->incrementarCantidad($id)) {
                $datos = array("estado" => "true", "total" => $this->carrito->numeroTotalProductos());
                echo json_encode($datos);
            }
        } else {
            // Solicito los datos del producto
            $libro = $this->Productos->damePorSuId($id);
            $libro[0]["cantidad"] = 1;
            if ($this->carrito->añadir($id, $libro)) {
                $datos = array("estado" => "true",  "total" => $this->carrito->numeroTotalProductos());
            }
        }
    }// Final clase
}