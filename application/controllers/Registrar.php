<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("provincias");
        $this->load->helper("dni");
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
        $this->load->model('registrarNuevoUsuario');
    }

    public function validar()
    {
        // Supongamos que los datos introducidos en el formulario, no superan las validaciones.
        $estado = false;

        // 1º Establezco las reglas de validacion.
        $this->form_validation->set_rules('usuario', 'usuario', 'required|trim');
        $this->form_validation->set_rules('contraseña', 'contraseña', 'required|trim');
        $this->form_validation->set_rules('correo', 'correo', 'required|valid_email');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|trim');
        $this->form_validation->set_rules('apellidos', 'apellidos', 'required|trim');
        $this->form_validation->set_rules('dni', 'dni', 'required|valid_dni');
        $this->form_validation->set_rules('direccion', 'lugar der residencia', 'required|trim');
        $this->form_validation->set_rules('codigoPostal', 'codigo postal', 'required|exact_length[5]|numeric');
        $this->form_validation->set_rules("provincia", "provincia", "required");

        // 2º Establezco los mensajes que apareceran por cada regla de validacion.
        $this->form_validation->set_message('required', 'requerido.');
        $this->form_validation->set_message('valid_email', 'incorrecto');
        $this->form_validation->set_message("comprobarDni", "incorrecto");
        $this->form_validation->set_message("numeric", "solo numeros");
        $this->form_validation->set_message("exact_length", "incorrecto");

        // 3º Compruebo si los datos son correctos.
        if ($this->form_validation->run()) {
            // Cambio su estado, todo ok.
            $estado = true;
        }

        return $estado;
    } // End method validar()

    /**
     * Registra a un nuevo usuario.
     */
    public function usuario()
    {

        if ($this->validar()) {

            // Almaceno los campos del formulario en un array asociativo.
            $columnas = array(
                "usuario" => $this->input->post("usuario"),
                "contraseña" => md5($this->input->post("contraseña")), // Encripto la contraseña
                "correo" => $this->input->post("correo"),
                "nombre" => $this->input->post("nombre"),
                "apellidos" => $this->input->post("apellidos"),
                "dni" => $this->input->post("dni"),
                "direccion" => $this->input->post("direccion"),
                "provincia" => $this->input->post("provincia"),
                "codigoPostal" => $this->input->post("codigoPostal"),
                "tipo" => "cliente"
            );

            if ($this->registrarNuevoUsuario->insertar($columnas)) {
                $this->mostrarFormulario(true);
            }
        } else { // El formulario, no ha pasado las validaciones de sus campos.
            $this->mostrarFormulario();
        }
    } // End method comprobar()


    public function mostrarFormulario($estoyRegistrado = false)
    {
        $datos["estoyRegistrado"] = $estoyRegistrado;
        $datos["provincias"] = dameTodasLasProvincias();
        $this->load->view("formularioRegistro", $datos);
    }
}
