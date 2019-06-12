<?php

/**
 * Muestra el resumen de los productos que va a comprar el cliente.
 * @author Jose Luis  
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Resumen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("carrito");
        $this->load->model("usuario");
    }


    public function pedido()
    {
        // Obtengo el id del cliente
        $id = $this->session->userdata['usuario']['idUsuario'];
        // Obtengo los datos personales del usuario.
        $datos["usuario"] = $this->usuario->dameDatosPersonalesCliente($id);
        // Obtengo todos los productos del carrito.
        $datos["libros"] = $this->carrito->dameTodosLosProductos();
        // Cargo boostrap, estilos css y mis propias funciones javascript.
        $this->load->view("plantillas/head");
        // Muestro la vista y le paso como parametro los datos en forma de array asociativo.
        $this->load->view('mostrarResumenPedido', $datos);
    }
} // Final clase
