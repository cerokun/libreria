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
                    echo json_encode($datos);
                }
                else {
                    echo "no se pudo incrementar la cantidad del producto que ya estaba en el carrito";
                }
            } else {
                echo "NO HAY STOCK SUFICIENTE";
            }
        } // El producto no esta en el carrito.
        else {

            // Compruebo el stock del producto.
            if ($this->productos->siHayStock($id)) {
                // Obtengo el libro.
                $libro = $this->productos->damePorSuId($id);
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
                    echo json_encode($datos);
                }
                else {
                    echo "algo salio mal, nose ha podido añadir un nuevo producto al carrto";
                }
            }
            else {
                echo "El producto no estaba en el carrtio y no tiene stock, no lo guardo.";
            }
        }


        /*
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
        */
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
