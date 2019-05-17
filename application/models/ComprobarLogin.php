<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ComprobarLogin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function buscar($data)
    {
        return $this->db->get_where("usuarios", $data)->row_array();
    }
}
