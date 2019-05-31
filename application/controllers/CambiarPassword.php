<?php
defined('BASEPATH') or exit('No direct script access allowed');


class CambiarPassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
    }


    /**
     * Muestra el formulario para cambiar la contraseña, en el caso de que, los parametros
     * correo y token en,viados desde el correo del usuario, lo enviamos al formulario inicial
     * solicitandole otra vez el coreo a donde quiere que le enviemos la informacion necesaria
     * para poder cambiar de contraseña.
     *
     * @return void
     */
    public function formulario()
    {
        // Obtengo los parametros desde la url
        $datos = $this->uri->uri_to_assoc(3);

        if ($this->usuario->buscar($datos)) {

            // Compruebo que no esten vacios
            if (empty($datos["correo"]) or empty($datos["token"])) {
                // Al no llegarnos los parametros, envio al usuario de nuevo inicial, para restarar las contraseña.
                $this->load->view('formularioOlvidePassword', array("error" => "no hemos recibido los parametros necesarios, correo o token"));
            } else {
                // Array con el correo y el token que nos envia el usuario al hacer click sobre e enlace que le enviamos a su correo electronico.
                $datos = array(
                    "correo" => $datos["correo"],
                    "token" => $datos["token"]
                );
                // Creo la sesion
                $this->session->set_userdata("password", $datos);
                // Muestro el formulario donde el usuario podra introducir su nueva contraseña.
                $this->load->view('formularioCambiarPassword');
            }
        } else {
            $this->load->view('formularioOlvidePassword', array("error" => "El correo y el token original no coinciden, han sido modificados deliberadamente o ha caducado el token."));
        }
    }


    /**
     * Cambia la contraseña que olvido el usuario por una nueva.
     *
     * @return void
     */
    public function actualizar()
    {
        // Obtengo las contraseñas que acaba de introducir el usuario.
        $password1 = $this->input->post("password1");

        // Obtengo el valor de los campos del formulario restablece password, los campos ocultos token y correo.
        $correo = $this->input->post("correo");
        $token =  $this->input->post("token");

        // Array con los datos
        $datos = array(
            "baja" => 0,
            "correo" => $correo,
            "token" => $token
        );
        // Establezco las reglas.
        $this->form_validation->set_rules('password1', '1º Password', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', '2º Password', 'required|matches[password1]');
        // Mensajes para las reglas.
        $this->form_validation->set_message('required', 'El %s esta vacio, escribe algo.');
        $this->form_validation->set_message('matches', "Las contraseñas no coinciden.");

        // valido que la contraseña introducida sea valida.
        if ($this->form_validation->run()) {

            // Compruebo que el token y el correo del usuario que solicito el cambio de contraseña, sean los mismos y nos se haya modificado dichos datos desde el cliente.
            if ($this->usuario->buscar($datos)) {

                // Columnas de la tabla usuario que quiero actualizar.
                $columnas = array(
                    "contraseña" => md5($password1), // Nueva contraseña encriptada
                    "token" => "0" // Reseteo el valor a cero.
                );
                // Actualizo la contraseña
                if ($this->usuario->restablecePassword($columnas, $datos)) {
                    // Muestro el formulario de login y muestro un mensaje de que todo ha salido bien, ya puede identificarse con su nueva contraseña.
                    $this->load->view("formularioLogin", array("usuarioLogueado" => "¡Acabas de actualizar la contraseña!"));
                } else { // No se ha podido actualizar la contraseña.
                    $this->load->view('formularioCambiarPassword', array("error" => "No se ha podido actualizar la contraseña."));
                }
            } else { // Se ha perdido el valor de los parametros ocultos, el coreo y el token sinn valor.
                $this->load->view('formularioOlvidePassword', array("error" => "El correo y el token original no coinciden, han sido modificados deliberadamente o ha caducado el token."));
            }
        } else { // Las contraseñas no son iguales.
            $this->load->view('formularioCambiarPassword');
        }
    }
} // Final clase
