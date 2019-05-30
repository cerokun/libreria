<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function crear($datos)
    {
        return ($this->db->insert("pedidos", $datos)) ? $this->db->insert_id() : false;
    }

    public function insertarProductosEnLineaDePedido($items)
    {
        return $this->db->insert_batch("lineaDePedido", $items);
    }


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
        return $this->db->get_where("lineaDePedido", array('idPedido' => $id))->result_array();
    }

    public function cancelar($id)
    {
        return $this->db->update('pedidos', array("cancelar" => 1), array("idPedido" => $id));
    }

    public function dameTodos()
    {
        return $this->db->get("pedidos")->result_array();
    }

    public function cambiarEstado($estado, $id)
    {
        return $this->db->update('pedidos', array("estado" => $estado), array("idPedido" => $id));
    }
}
