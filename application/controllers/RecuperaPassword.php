<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RecuperaPassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->load->model('OlvidePassword');
        $this->load->model('usuario');
    }

    public function index()
    {
        $this->load->view('formularioOlvidePassword');
    }


    /**
     * Valida el correo.
     *
     * @return void
     */
    public function validar()
    {
        // Estado de la validacion, supongamos que la validacion no es correcta.
        $estado = false;
        // Quiero validar estos campos, segun diferentes tipos de validaciones.
        $this->form_validation->set_rules('correo', 'correo', 'required|valid_email|callback_exists_email|trim');
        // El usuario no ha escrito el correo.
        $this->form_validation->set_message('required', 'introduce el correo, campo vacio.');
        // El correo introducido, no es valido, no cumple el formato.
        $this->form_validation->set_message('valid_email', 'el correo, no cumple un formato valido.');
        // El correo introducido, no se encuentra en la base de datos.
        $this->form_validation->set_message('exists_email', 'el correo, no existe.');

        // Si ha superado las validaciones
        if ($this->form_validation->run()) {
            $estado = true; // Cabmio el estado.
        }
        return $estado;
    }

    public function exists_email($valor)
    {

        if ($this->OlvidePassword->buscarCorreo($valor)) {
            return true;
        } else {
            return false;
        }
    }

    public function cuenta()
    {

        if ($this->validar()) {
            // Obtengo el correo introducido.
            $correo = $this->input->post("correo");
            $token = $this->generarToken($correo);

            if ($this->usuario->guardarToken($correo, $token)) {
                echo "token actualizado";
            }
        } else {
            $this->load->view('formularioOlvidePassword');
        }
    }


    public function generarToken($valor)
    {
        $fechaActual = date('Y-m-d H:i:s');
        return md5($fechaActual . $valor);
    }
} // Final clase
