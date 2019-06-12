<?php

/**
 * Gesiona y precoes las peticioens basicas sobre los usuarios.
 * @author Jose Luis
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Obtengo los datos personales del usuario
     *
     * @param array $data condiciones
     * @return void
     */
    public function dameDatosPersonales($data)
    {
        return $this->db->get_where("usuarios", $data)->row_array();
    }

    /**
     * Obtengo los datos del cliente
     *
     * @param int $id
     * @return void
     */
    public function dameDatosPersonalesCliente($id)
    {
        return $this->db
            ->select("idUsuario, nombre, apellidos, dni, direccion, correo, codigoPostal, provincia")
            ->from("usuarios")
            ->where("idUsuario", $id)
            ->get()
            ->row_array();
    }

    /**
     * Actualiza los datos del usuario.
     * @param type $columnas
     * @return type array con todos los valoes del formulario
     */
    public function actualizar($columnas)
    {
        $this->db->where('idUsuario', $columnas["idUsuario"]);
        return $this->db->update('usuarios', $columnas);
    }

    /**
     * Guarda el token generado para el usuario, que ha solicitado
     * el cambiar la contraseña por que la ha olvidado y quiere restituir
     * la contraseña antigua por una nueva.
     *
     * @param String $correo del cliente
     * @param String $token token para dicho cliente
     * @return void
     */
    public function guardarToken($correo, $token)
    {
        $this->db->where('correo', $correo);
        return $this->db->update('usuarios', array("token" => $token));
    }

    /**
     * Busca los dato de un usuario
     *
     * @param [type] $condiciones
     * @return void
     */
    public function buscar($condiciones)
    {
        return $this->db->get_where("usuarios", $condiciones)->row_array();
    }

    /**
     * Cambia la contraseña
     *
     * @param array $columnas
     * @param array $condiciones
     * @return void
     */
    public function restablecePassword($columnas, $condiciones)
    {
        return $this->db->update('usuarios', $columnas, $condiciones);
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
