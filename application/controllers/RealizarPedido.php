<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RealizarPedido extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
        $this->load->model("pedidos");
        $this->load->library("carrito");
    }

    public function index()
    {

        // 1º Obtengo el id del cliente
        $id = $this->session->userdata['usuario']['idUsuario'];
        // 2º Obtengo los datos personales del cliente.
        $usuario = $this->usuario->dameDatosPersonalesCliente($id);
        // 3º Creo un pedido nuevo y obtengo la clave primaria del pedido, osea el idPedido.
        $idPedido = $this->pedidos->crear($usuario);
        // 4º Obtengo los productos almacenados en el carrito de compra.
        $listaProductos = $this->carrito->dameTodosLosProductos();


        // Recorro la lista de productos
        foreach ($listaProductos as $libro) {

            $item = array(
                "idProducto" => $libro[0]["idProducto"],
                "precio" => $libro[0]["precio"],
                "cantidad" =>  $libro[0]["cantidad"],
                "idPedido" => $idPedido
            );

            // Inserto los items en la tabla linea de pedido.
            $this->pedidos->insertarProductosEnLineaDePedido($item);
            $this->carrito->destroy();
        }
    }
}// Final clase
