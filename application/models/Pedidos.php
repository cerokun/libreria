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
        return ($this->db->insert_batch("lineaDePedido", $items)) ? true : false;
    }


    public function realizados($id)
    {
        return $this->db
            ->select("idPedido, fecha, estado")
            ->from("pedidos")
            ->where(array("idUsuario" => $id, "cancelado" => 0))
            ->get()
            ->result_array();
    }
}
