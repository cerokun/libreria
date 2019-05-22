<?php
defined('BASEPATH') or exit('No direct script access allowed');


class CambiarPassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<ul><li>', '</li></ul>');
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
        // Compruebo que no esten vacios
        if (empty($datos["correo"]) or empty($datos["token"])) {
            $this->load->view('formularioOlvidePassword', array("error" => "no hemos recibido los parametros necesarios, correo o token"));
        } else {
            $this->load->view('formularioCambiarPassword', $datos);
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
        $password2 = $this->input->post("password2");

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
        $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]');
        // Mensajes para las reglas.
        $this->form_validation->set_message('required', 'El campo  %s esta vacio, escribe algo.');
        $this->form_validation->set_message('matches', "Las contraseñas no coinciden.");

        if ($this->form_validation->run()) {

            echo "VALIDADO TODO";

            // Compruebo que el token y el correo del usuario que solicito el cambio de contraseña, sean los mismos y nos se haya modificado dichos datos desde el cliente.
            if ($this->usuario->buscar($datos)) {

                echo "Existe un usuario con dicho correo y token, actualizo";

                // Columnas de la tabla usuario que quiero actualizar.
                $columnas = array(
                    "contraseña" => md5($password1), // Nueva contraseña encriptada
                    "token" => "0" // Reseteo el valor a cero.
                );
                // Actualizo la contraseña
                if ($this->usuario->restablecePassword($columnas, $datos)) {
                    echo "acabas de actualizar <br>";
                    $datos["mensaje"] = "¡Acabas de actualizar la contraseña!";
                    // Muestro el formulario de login y muestro un mensaje de que todo ha salido bien, ya puede identificarse con su nueva contraseña.
                    $this->load->view("formularioLogin", $datos);
                } else { // No se ha podido actualizar la contraseña.
                    echo "no has podido actualizar <br>";
                    $datos["error"] = "No se ha podido actualizar la contraseña.";
                    $this->load->view('formularioCambiarPassword', $datos);
                }
            } else { // Se ha perdido el valor de los parametros ocultos, el coreo y el token sinn valor.
                $datos["error"] = "El correo y el token original no coinciden, han sido modificados deliberadamente.";
                $this->load->view('formularioOlvidePassword', $datos["error"]);
            }
        } else { // Las contraseñas no son iguales.
            echo "las contraseñas no coincidens <br>";
            $datos["error"] = "Las contraseñas no coinciden, no se tomaran en cuenta los campos vacios.";
            $this->load->view('formularioCambiarPassword', $datos);
        }
    }
} // Final clase
