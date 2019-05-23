<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function dameTodos()
    {
        $condiciones = array(
            "visible" => 1
        );
        return $this->db->get_where("productos", $condiciones)->result_array();
    }
}
