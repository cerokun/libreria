<?php

defined('BASEPATH') or exit('No direct script access allowed');

class OlvidePassword extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function buscarCorreo($correo)
    {
        $this->db->where('baja', 0);
        return $this->db->get_where("usuarios", array("correo" => $correo))->row_array();
    }

    
    
}
