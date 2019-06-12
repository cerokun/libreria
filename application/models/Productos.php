<?php

/**
 * Procesa y gestiona los productos, todas las operaciones basicas
 */

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
        // Obtengo la fecha actual
        $hoy = date("Y-m-d");
        // Aqui guardare los datos que devolvere a la vista.
        $datos = array();
        // Solicito todos los libros que sean visibles.
        $resultados = $this->db->get_where('productos', array('visible' => 1), $quieroMostrarPorPagina, $desde)->result_array();
        // Recorro cada libro
        foreach ($resultados as $libro) {
            // Si el libro esta destacado o la fecha se encuentra dentro dentro del intervalo, hago lo siguiente.
            if ($libro["destacado"] == 1 or $libro["desde"] < $hoy and $libro["hasta"] >= $hoy) {
                $datos[] = $libro; // Guardo el libro 
            }
        }

        return $datos;
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

    /**
     * Añade nuevos productos a la base de datos.
     *
     * @param array $datos
     * @return void
     */
    public function insertar($datos)
    {
        return $this->db->insert_batch("productos", $datos);
    }

    /**
     * Me da todas los productos, incluidas las que se han
     * marcado como no visibles por parte del administrador
     *
     * @return void
     */
    public function dameTodasIncluidasLasInvisibles()
    {
        return $this->db->get("productos")->result_array();
    }
}
