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
        // Obtengo el id del producto que queire añadir al carrito
        $id = $this->input->post("idProducto");

        // Solicito los datos del producto
        $libro = $this->Productos->damePorSuId($id);

        echo "<pre>";
        print_r($libro);
        echo "</pre>";
    }
}// Final clase
