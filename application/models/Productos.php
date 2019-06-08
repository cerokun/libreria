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
         
        $hoy = date('Y-m-d');

        return $this->db
            ->from("productos")
            ->where("destacado=", 1)
            ->limit($quieroMostrarPorPagina, $desde)
            ->get()
            ->result_array();
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

    public function damePorSuId($id)
    {
        return $this->db->get_where('productos', array('visible' => 1, "idProducto" => $id))->result_array();
    }

    public function actualizarStock($items)
    {
        return ($this->db->update_batch("productos", $items, "idProducto")) ? true : false;
    }

    /**
     * Me dice el stock que tiene l producto.
     *
     * @param int $id clave primara del producto
     * @return int valor del stock.
     */
    public function siHayStock($id)
    {
        $this->db->select('stock');
        $this->db->from('productos');
        $this->db->where('idProducto', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }
}
