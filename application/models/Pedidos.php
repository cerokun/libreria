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
        return ($this->db->insert("lineaDePedido", $items)) ? true : false;
    }
}
