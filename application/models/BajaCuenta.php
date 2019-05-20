<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BajaCuenta extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function usuario($id)
    {

        $this->db->where('idUsuario', $id);
        $this->db->update('usuarios',  array('baja' => 1));
        $this->session->sess_destroy("usuario");
        redirect('Principal');
    }
}
