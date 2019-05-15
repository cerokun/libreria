<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); // Invoco al constructor del padre.
        $this->load->library('form_validation'); // Cargo la libreria, para validar formularios.
        $this->load->model('ComprobarLogin'); // Modelo que utilizare para comprobar el login.
    }

    /**
     * Valida el formulario de login.
     *
     * @return void
     */
    public function validar()
    {
        // Estado de la validacion, supongamos que la validacion no es correcta.
        $estado = false;
        // Quiero validar estos campos, segun diferentes tipos de validaciones.
        $this->form_validation->set_rules('correo', 'correo', 'required|trim|valid_email');
        $this->form_validation->set_rules('contraseña', 'contraseña', 'required|md5|trim');
        // Mensajes de error que se mostrara, por cada validacion.
        $this->form_validation->set_message('required', 'El campo %s es requerido.');

        // Si ha superado las validaciones
        if ($this->form_validation->run()) {
            $estado = true; // Cabmio el estado.
        }
        return $estado;
    }

    /**
     * Comprueba si existe el usuario.
     *
     * @return void
     */
    public function comprobar()
    {

        if ($this->validar()) {

            // Obtengo los valores del formulario.
            $data = array(
                "correo" => $this->input->post("correo"),
                "contraseña" => $this->input->post("contraseña")
            );

            // Compruebo si existe el usuario
            if ($this->ComprobarLogin->buscar($data)) {
                // Guardo los datos del usuario.
                $usuario = $this->ComprobarLogin->buscar($data);
                // Creo una sesion para dicho usuario.
                $this->crearSesion($usuario);
            } else { // Sino existe el usuario 
                //vuelvo a mostrar el formulario de login.
                $this->load->view("formularioLogin");
            }
        } else { // El formulario, no ha pasado las validaciones de sus campos.
            $this->load->view("formularioLogin");
        }
    }

    /**
     * Crea una sesion, para el usuario que se acaba de identificar.
     *
     * @param Array $usuario datos personales.
     * @return void
     */
    public function crearSesion($usuario)
    {

        // Datos que voy almacenar en la sesion
        $datos = array(
            'idUsuario' => $usuario["idUsuario"],
            'usuario' => $usuario["usuario"],
            'nombre' => $usuario["nombre"],
            'apellidos' => $usuario["apellidos"],
            'tipo' => $usuario["tipo"],
            'logeado' => TRUE
        );

        // Creo la sesion
        $this->session->set_userdata("usuario", $datos);
        // Redirecciono al usuario a la pagina principal.
        redirect('Principal');
    }

    /**
     * Muestra el formulario de login.
     * @return void
     */
    public function mostrarFormulario()
    {
        $this->load->view("formularioLogin");
    }

    
}// Final clase
