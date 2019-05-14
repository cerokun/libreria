<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('ComprobarLogin');
    }

    /**
     *  Compruba el formulario, que los datos sean correctos, de ser asi, hace una consulta a la base de datos,
     *  mediante el modelo 'ComprobarLogin' el cual, acabo de instanciar en el controlador de esta clase.
     */
    public function comprobar()
    {

        // Establezco las reglas de validacion, sobre los campos del formulario de login.
        $this->form_validation->set_rules('correo', 'correo', 'required|trim|valid_email');
        $this->form_validation->set_rules('contraseña', 'contraseña', 'required|md5|trim');
        // Establezco el mensaje que aparecera en caso de cumplirse alguna de las anteriores reglas de validacion.
        $this->form_validation->set_message('required', 'El campo %s es requerido.');

        // Si los datos del formulario son correctos
        if ($this->form_validation->run()) {

            // Obtengo los valores de los campos usuario y contraseña, del formulario login, los almaceno en un array asociativo.
            $data = array(
                "correo" => $this->input->post("correo"),
                "contraseña" => $this->input->post("contraseña")
            );


            // Hago uso del modelo, para hacer una consulta a la base de datos, necesito saber, si existe el usuario.
            $resultado = $this->ComprobarLogin->buscar($data);

            // Si ha habido resultados, quiere decir, que si encontro el usuario.
            if ($resultado) {
                echo "logeado";
                $this->crearSesionUsuarioLogeado($resultado); // Invoco al metodo encargado de creear una sesion.
            } else { // Si no se ha encontrado el usuario.
                echo "<li> El login es incorrecto. </li>";
                $this->load->view("login");
            }
        } else { // El formulario, no ha pasado las validaciones de sus campos.
            $this->load->view("login");
        }
    }




    /**
     * Crea una sesion para el usuario logeado
     * @param  Array $resultado de la consulta a la base de datos, son los datos del usaurio.
     */
    public function crearSesionUsuarioLogeado($usuario)
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
        redirect('Principal');
    }
}

// Final clase
