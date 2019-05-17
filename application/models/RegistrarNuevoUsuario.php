<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RegistrarNuevoUsuario extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Inserta un nuevo usuario
     * @param type $columnas
     * @return type array con todos los valoes del formulario
     */
    public function insertar($columnas)
    {
        return $this->db->insert('usuarios', $columnas);
    }
}
