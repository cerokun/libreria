<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos_C extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('Categorias');
        $this->load->model('usuario');
        $this->load->model("pedidos");
    }


    /**
     * Crea un nuevo pedido.
     *
     * @return void
     */
    public function nuevo()
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

            // Guardo en un array, los stock de los productos ya actualizados.
            $stocks[] = array(
                "idProducto" => $libro[0]["idProducto"],
                "stock" =>  $libro[0]["stock"] - $libro[0]["cantidad"]
            );
            // Guardo en un array, todos los productos del carrito de compra.
            $items[] = array(
                "precio" => $libro[0]["precio"],
                "cantidad" =>  $libro[0]["cantidad"],
                "idPedido" => $idPedido,
                "idProducto" => $libro[0]["idProducto"]
            );
        }


        // Inserto los items en la tabla linea de pedido.
        if ($this->pedidos->insertarProductosEnLineaDePedido($items) and  $this->productos->actualizarStock($stocks)) {
            $this->carrito->destroy();
            echo "PEDIDO REALIZADO";
        } else {
            echo "ERROR";
        }
    }

    public function listar()
    {

        // 1º Obtengo el id del cliente
        $idUsuario = $this->session->userdata['usuario']['idUsuario'];
        // 2º Obtengo todas las facturas que pudiera tener este usuario
        $datos["pedidos"] = $this->pedidos->realizados($idUsuario);
        // Obtengo las categorias
        $misCategorias["categorias"] = $this->Categorias->dameTodas();
        // Le paaso las categorias a la vista
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        // Paso todos los pedidos a la vista
        $this->load->view('mostrarPedidos', $datos);
        $this->load->view("plantillas/footer");
    }
}// Final clase