<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function dameDatosPersonales($data)
    {
        return $this->db->get_where("usuarios", $data)->row_array();
    }

    /**
     * Actualiza los datos del usuario.
     * @param type $columnas
     * @return type array con todos los valoes del formulario
     */
    public function actualizar($columnas, $id)
    {
        $this->db->where('idUsuario', $columnas["idUsuario"]);
        return $this->db->update('usuarios', $columnas);
    }
}
