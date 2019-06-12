<?php

/**
 * Procesa las peticiones basicas sobre la tabla categorias
 * @author  Jose Luis  
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    /**
     * Me da todas las categorias que sean visibles.
     *
     * @return void
     */
    public function dameTodas()
    {
        return $this->db->get_where("categorias", array("visible" => 1))->result_array();
    }

    /**
     * Añade nuevas categorias
     *
     * @param array $datos
     * @return void
     */
    public function insertar($datos)
    {
        return $this->db->insert_batch("categorias", $datos);
    }

    /**
     * Me da todas las categorias, incluidas las que se han
     * marcado como no visibles por parte del administrador
     *
     * @return void
     */
    public function dameTodasIncluidasLasInvisibles()
    {
        return $this->db->get("categorias")->result_array();
    }
}
