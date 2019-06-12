<?php

/**
 * Doy de baja la cuenta del cliente, no la elimino, sino que la 
 * deshabilito, pongon el valor del campo 'baja' = 1 de la tabla usuarios
 * @author Jose Luis 
 */

defined('BASEPATH') or exit('No direct script access allowed');

class BajaCuenta extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Doy de baja la cuenta del usuario.
     *
     * @param [type] $id
     * @return void
     */
    public function usuario($id)
    {
        // Identificador unico del usuraio
        $this->db->where('idUsuario', $id);
        // Actualiza el campo baja de la tabla usuarios y pongo valor 1, como que ha quedado desactivada la cuenta.
        $this->db->update('usuarios',  array('baja' => 1));
        // Destruyo la sesion actual
        $this->session->sess_destroy("usuario");
        // Cerramos y nos vamos
        redirect('Principal');
    }
}
