<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PeticionesCarrito extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("carrito");
        $this->load->model('productos');
    }
    /**
     * Obtengo la clave primara del producto.
     *
     * @return void
     */
    public function add()
    {
        // Obtengo la clave primaria del libro.
        $id = $this->input->post("idProducto");

        // Compruebo si producto ya estaba en el carrito.
        if ($this->carrito->siElProductoYaEstaEnElCarrito($id) and $this->carrito->siHayStock($id)) {

            if ($this->carrito->incrementarCantidad($id)) {
                $datos = array(
                    "estado" => "true",
                    "total" => $this->carrito->numeroTotalProductos(),
                    "stock" => $this->carrito->dameElStockDeEsteProducto($id)
                );
                echo json_encode($datos);
            }

            // El producto es nuevo, lo añado al carrito.
        } else {
            // Solicito los datos del producto
            $libro = $this->productos->damePorSuId($id);
            $libro[0]["cantidad"] = 1;
            if ($this->carrito->añadir($id, $libro)) {

                $datos = array(
                    "estado" => "true",
                    "total" => $this->carrito->numeroTotalProductos(),
                    "stock" => $this->carrito->dameElStockDeEsteProducto($id)
                );

                echo json_encode($datos);
            }
        }
    }

    public function eliminar()
    {
        $id = $this->input->post("idProducto");
        $this->carrito->eliminar($id);
        $this->listar();
    }

    public function vaciar()
    {
        $this->carrito->destroy();
        $this->listar();
    }

    public function listar()
    {
        $datos["libros"] = $this->carrito->dameTodosLosProductos();
        $this->load->view("mostrarProductosCarrito", $datos);
    }
}
