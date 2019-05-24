<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModificarDatos extends CI_Controller
{

    private $datos;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("provincias");
        $this->load->helper("dni");
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
        $this->load->model('Categorias');
        $this->load->model('usuario');
    }

    public function index()
    {
        $misCategorias["categorias"] = $this->Categorias->dameTodas();
        $this->load->view("plantillas/header", $misCategorias);
        $this->load->view("plantillas/nav");
        // Obtengo el identificador del usuario, que guarde en una sesion en el mismo momento que se logeo en el sistema.
        $dato["idUsuario"] = $this->session->userdata['usuario']['idUsuario'];
        // Solicito a la tabla usuarios, los datos de dicho usuario.
        $this->datos = $this->usuario->dameDatosPersonales($dato);
        // Obtengo las provincias
        $this->datos["provincias"] = dameTodasLasProvincias();
        // Paso los datos a la vista.
        $this->load->view("formularioActualizar", $this->datos);
        $this->load->view("plantillas/footer");
    }

    public function validar()
    {
        // Supongamos que los datos introducidos en el formulario, no superan las validaciones.
        $estado = false;

        // 1º Establezco las reglas de validacion.
        $this->form_validation->set_rules('usuario', 'usuario', 'required|trim');
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
        $this->form_validation->set_message("valid_dni", "incorrecto");
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

            // Obtengo los campos del formulario.
            $columnas = array(
                "idUsuario" => $this->session->userdata['usuario']['idUsuario'],
                "usuario" => $this->input->post("usuario"),
                "correo" => $this->input->post("correo"),
                "nombre" => $this->input->post("nombre"),
                "apellidos" => $this->input->post("apellidos"),
                "dni" => $this->input->post("dni"),
                "direccion" => $this->input->post("direccion"),
                "provincia" => $this->input->post("provincia"),
                "codigoPostal" => $this->input->post("codigoPostal")
            );

            if (!empty($this->input->post("contraseña"))) {
                $columnas["contraseña"] = md5($this->input->post("contraseña"));
            }

            if ($this->usuario->actualizar($columnas)) {
                // Actualizo unicamente el nombre, por que es el unico dato que muestro al usuario en el menu principal, en la bienvenida + nombre.
                $this->session->userdata['usuario']['nombre'] = $columnas["nombre"];
                $this->load->view("plantillas/header");
                $this->load->view("plantillas/nav");
                $this->datos["provincias"] = dameTodasLasProvincias();
                $this->datos["actualizado"] = "Acabas de actualizar";
                $this->load->view("formularioActualizar", $this->datos);
                $this->load->view("plantillas/footer");
            }
        } else { // El formulario, no ha pasado las validaciones de sus campos.
            $this->mostrarFormulario();
        }
    } // End method comprobar()


    public function mostrarFormulario()
    {
        $this->load->view("plantillas/header");
        $this->load->view("plantillas/nav");
        $this->datos["provincias"] = dameTodasLasProvincias();
        $this->load->view("formularioActualizar", $this->datos);
        $this->load->view("plantillas/footer");
    }
}
