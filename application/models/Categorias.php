<?php

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
}
