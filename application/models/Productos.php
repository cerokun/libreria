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
    public function destacados($quieroMostrarPorPagina, $desde)
    {
        return $this->db->get_where('productos', array('visible' => 1), $quieroMostrarPorPagina, $desde)->result_array();
    }



    /**
     * Me da todos los productos visibles que pertenezcan a una determinada
     * categoria
     *
     * @param [type] $id
     * @return void
     */
    public function dameProductosPorIdCategoria($id, $quieroMostrarPorPagina, $desde)
    {

        return $this->db->get_where('productos', array('visible' => 1, "idCategoria" => $id), $quieroMostrarPorPagina, $desde)->result_array();
        //  return $this->db->get_where("productos", array("idCategoria" => $id, "visible" => 1))->result_array();
    }

    /**
     * Me dice el numero de productos destacados.
     *
     * @return void
     */
    public function num_rows()
    {
        return $this->db->get_where("productos", array("visible" => 1))->num_rows();
    }

    /**
     * Me dice el numero de productos destacados.
     *
     * @return void
     */
    public function num_rows_per_category($id)
    {
        return $this->db->get_where("productos", array("visible" => 1,  "idCategoria" => $id))->num_rows();
    }

    public function dameProductosPorPagina($limit, $offset)
    {
        return $this->db->get_where('productos', array('visible' => 1), $limit, $offset)->result_array();
    }
}
