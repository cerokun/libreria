<?php

/**
 * Comprueba el login
 * @author Jose Luis 
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Comprueba si existe el usuario
     *
     * @param array $data con los datos del usuario que tiene que buscar.
     * @return array con los datos del usuario.
     */
    public function buscar($data)
    {
        return $this->db->get_where("usuarios", $data)->row_array();
    }
}
