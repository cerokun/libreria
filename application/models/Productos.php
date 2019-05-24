<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Me da todos los productos destacados y por rango de fechas,
     * tengo que mirar como se hace, como hacer la subconsulta.
     *
     * @return void
     */
    public function destacados()
    {
        return $this->db->get_where("productos", array("visible" => 1))->result_array();
    }



    /**
     * Me da todos los productos visibles que pertenezcan a una determinada
     * categoria
     *
     * @param [type] $id
     * @return void
     */
    public function dameProductosPorIdCategoria($id)
    {
        return $this->db->get_where("productos", array("idCategoria" => $id, "visible" => 1))->result_array();
    }
}
