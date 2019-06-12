<?php

/**
 * Procesa y gestiona las peticiones de los clientes y administradores, sobre los pedidos realizados
 * y la linea de pedido.
 * @author Jose Luis  
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Creo una pedido
     *
     * @param array $datos
     * @return void
     */
    public function crear($datos)
    {
        return ($this->db->insert("pedidos", $datos)) ? $this->db->insert_id() : false;
    }

    /**
     * Añade los productos al pedido
     *
     * @param array $items
     * @return void
     */
    public function insertarProductosEnLineaDePedido($items)
    {
        return $this->db->insert_batch("lineaDePedido", $items);
    }

    /**
     * Muestra todos los pedidos que ha realizado el cliente
     */
    public function realizados($id)
    {
        return $this->db
            ->select("idPedido, fecha, estado")
            ->from("pedidos")
            ->where(array("idUsuario" => $id, "cancelar" => 0))
            ->get()
            ->result_array();
    }

    /**
     * Me devuelve todos los articulos que pertenecen a una factura concreta.
     *
     * @param int $idPedido
     * @return Array asociativo con los productos.
     */
    public function dameLineaPedido($id)
    {
        return $this->db
            ->select("lineaDePedido.idProducto, productos.nombre, productos.precio, lineaDePedido.precio AS lpPrecio, cantidad, iva, idItem, descuento")
            ->from("lineaDePedido")
            ->join("productos", "productos.idProducto=lineaDePedido.idProducto")
            ->where(array("idPedido" => $id))
            ->get()
            ->result_array();
    }


    /**
     * Cancela un pedido
     *
     * @param String $id identificador unico del pedido.
     * @return boolean
     */
    public function cancelar($id)
    {
        return $this->db->update('pedidos', array("cancelar" => 1), array("idPedido" => $id));
    }

    /**
     * Me da todos los pedidos que se hayan realizado, de todos los clientes.
     *
     * @return void
     */
    public function dameTodos()
    {
        return $this->db->get("pedidos")->result_array();
    }

    /**
     * Cambia el estado de un pedido, por parte del administrador.
     *
     * @param int $estado 1 = procesando, 2 = pendiente y 3 recibido.
     * @param int $id identificador del pedido, su idPedido
     * @return void
     */
    public function cambiarEstado($estado, $id)
    {
        return $this->db->update('pedidos', array("estado" => $estado), array("idPedido" => $id));
    }

    /**
     * Me da los datos de un pedido
     *
     * @param String $id unico del pedido.
     * @return void
     */
    public function dameUnPedido($id)
    {
        return $this->db->get_where("pedidos", array('idPedido' => $id))->row_array();
    }
}
