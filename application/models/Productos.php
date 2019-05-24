<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function destacados()
    {
        return $this->db->get("productos")->result_array();
    }

    public function categorias()
    {
        return $this->db->get("categorias")->result_array();
    }


    public function dameProductosPorIdCategoria($id)
    {
        return $this->db->get_where("productos", array("idCategoria" => $id))->result_array();
    }
}
