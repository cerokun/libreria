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
     * Guardo el libro en el carrito de compra.
     *
     * @return void
     */
    public function add()
    {
        // Obtengo la clave primaria del libro.
        $id = $this->input->post("idProducto");

        // Esta el producto en el carrito ?
        if ($this->carrito->siElProductoYaEstaEnElCarrito($id)) {
            // Compruebo si hay stock suficiente.
            if ($this->carrito->siHayStock($id)) {
                // Incremento la cantidad del producto.
                if ($this->carrito->incrementarCantidad($id)) {
                    // Datos a enviar
                    $datos = array(
                        "estado" => "true",
                        "total" => $this->carrito->numeroTotalProductos(),
                        "stock" => $this->carrito->dameElStockDeEsteProducto($id)
                    );
                } else {
                    $datos = array(
                        "estado" => "false",
                        "aviso" => "Algo salio mal a la hora de guardarlo en el carrito."
                    );
                }
            } else {
                $datos = array(
                    "estado" => "false",
                    "aviso" => "Acabas de alcanzar el limite disponible para este articulo, el stock esta a cero."
                );
            }
        } // El producto no esta en el carrito.
        else {

            // Compruebo el stock del producto.
            if ($this->productos->siHayStock($id)) {
                // Obtengo el libro.
                $libro = $this->productos->damePorSuId($id);


                // Esto es el precio sin descuento y sin iva.
                $precio =  $libro[0]["precio"];
                // Descuento
                $descuento = ($precio * $libro[0]["descuento"]) / 100;
                // Aplico el descuento al precio sin iva.
                $precionConDescuento = ($precio - $descuento);
                // Calculo el iva.
                $impuesto = ($precionConDescuento * $libro[0]["iva"]) / 100;
                // Aplico el impuesto, iva
                $precioFinal = $precionConDescuento + $impuesto;


                $libro[0]["precioUnitario"] = $precio;
                $libro[0]["precio"] = $precioFinal;
                // Añado una nueva variable al array, para controlar la cantidad de cada producto añadido al carro.
                $libro[0]["cantidad"] = 1;
                // Guarda el producto en el carrito.
                if ($this->carrito->añadir($id, $libro)) {
                    // Datos a enviar tras la peticion ajax, mediante json.
                    $datos = array(
                        "estado" => "true", // Todo salio bien,
                        "total" => $this->carrito->numeroTotalProductos(), // Total productos añadidos al carrito.
                        "stock" => $this->carrito->dameElStockDeEsteProducto($id) // Me dice el stock del producto que acabo de añadir.
                    );
                    // Envio los datos.
                } else {
                    $datos = array(
                        "estado" => "false",
                        "aviso" => "Lo setimos, pero algo salio mal, a la hora de guardar el nuevo producto en el carrito de compra."
                    );
                }
            } else {
                $datos = array(
                    "estado" => "false",
                    "aviso" => "Lo sentimos, no se ha podido añadir, este producto nuevo al carrito de compra, su stock esta a cero."
                );
            }
        }
        // Envio la respuesta.
        echo json_encode($datos);
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
