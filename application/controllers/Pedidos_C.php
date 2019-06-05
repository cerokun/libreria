<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Pedidos_C extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("carrito");
        $this->load->library("Factura");
        $this->load->helper("formulario");
        $this->load->model('categorias');
        $this->load->model('productos');
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

            // Obtengo el subtotal, precio por cantidad, sin aplicar ni el descuento ni el iva.
            $precioSinDescuentoYSinIva = ($libro[0]["precio"] * $libro[0]["cantidad"]);
            // Calculo el total descuento.
            $descuento = ($precioSinDescuentoYSinIva * $libro[0]["descuento"]) / 100;
            // Aplico el descuento al precio.
            $precionConDescuento = $precioSinDescuentoYSinIva - $descuento;
            // Calculo el iva del precio ya con su descuento.
            $iva = ($precionConDescuento * $libro[0]["iva"]) / 100;
            // Precio final
            $precio = $precionConDescuento + $iva;

            // Guardo en un array, los stock de los productos ya actualizados.
            $stocks[] = array(
                "idProducto" => $libro[0]["idProducto"],
                "stock" =>  $libro[0]["stock"]
            );
            // Guardo en un array, todos los productos del carrito de compra.
            $items[] = array(
                "precio" =>  $precio, // Calculo el precio total con el descuento aplicado y el iva.
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
        $id = $this->session->userdata['usuario']['idUsuario'];
        // 2º Obtengo todas las facturas que pudiera tener este usuario
        $datos["pedidos"] = $this->pedidos->realizados($id);
        // Obtengo las categorias
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        // Le paaso las categorias a la vista
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        // Paso todos los pedidos a la vista
        $this->load->view('mostrarPedidos', $datos);
        $this->load->view("plantillas/footer");
    }



    public function ver()
    {

        // 1º Obtengo el id del cliente
        $idPedido =  $this->uri->segment(3);
        // 2º Obtengo todos los productos pertenecientes a dicha factura.
        $datos["lineaDePedido"] = $this->pedidos->dameLineaPedido($idPedido);
        // Obtengo las categorias
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        // Le paaso las categorias a la vista
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        // Paso todos los pedidos a la vista
        $this->load->view('mostrarLineaDePedido', $datos);
        $this->load->view("plantillas/footer");
    }


    public function eliminar()
    {

        // 1º Obtengo el id del cliente
        $idPedido =  $this->uri->segment(3);
        // Elimino el pedido
        $this->pedidos->cancelar($idPedido);
        // Muestro la lista actualizada
        $this->listar();
    }

    /**
     * Muestra todos los pedidos, menu para el administrador.
     *
     * @return void
     */
    public function muestraFormularioCambiarEstado()
    {

        // 2º Obtengo todas las facturas que pudiera tener este usuario
        $datos["pedidos"] = $this->pedidos->dameTodos();
        // Obtengo las categorias
        $misCategorias["categorias"] = $this->categorias->dameTodas();
        // Le paaso las categorias a la vista
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");

        // Estados posibles
        $datos["opciones"] = array(
            1 => "Pendiente",
            2 => "Procesando",
            3 => "Recibido"
        );

        // Paso todos los pedidos a la vista
        $this->load->view('cambiarEstadoPedidos', $datos);
        $this->load->view("plantillas/footer");
    }

    /**
     * Cambia el estado de cualquier pedido.
     *
     * @return void
     */
    public function cambiarEstado()
    {
        // Obtengo el idPedido y el estado del pedido, valores enviados desde Ajax      
        $id = $this->input->post("idPedido");
        $estado = $this->input->post("estado");

        // Peticion al modelo para cambiar el estado del pedido.
        if ($this->pedidos->cambiarEstado($estado, $id)) {
            echo  json_encode(array("actualizado" => "si"));
        } else {
            echo json_encode(array("actualizado" => "no"));
        }
    }

    public function factura()
    {


        // Obtengo la clave primara del cliente, almacenada en la sesion.
        $idUsuario = $this->session->userdata['usuario']['idUsuario'];
        // Obtengo el identificador de pedido.
        $idPedido =  $this->uri->segment(3);;
        // Obtengo los datos del pedido y los datos basicos del cliente.
        $datos = $this->pedidos->dameUnPedido($idPedido);
        // Obtengo todos los productos de ese pedido.
        $datos2 = $this->pedidos->dameLineaPedido($idPedido);

        $factura = new Factura();
        $factura->AliasNbPages();
        $factura->AddPage();
        $factura->cabecera($datos);
        $columnas = array("Codigo", "Producto", "Precio", "Cantidad", "Iva", "Importe iva", "Total");
        $factura->generarTabla($columnas, $datos2);
        $factura->Output();
    }
}
