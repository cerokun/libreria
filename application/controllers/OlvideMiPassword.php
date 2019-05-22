<?php
defined('BASEPATH') or exit('No direct script access allowed');

require "vendor/phpmailer/phpmailer/class.phpmailer.php";
require "vendor/phpmailer/phpmailer/class.smtp.php";

class OlvideMiPassword extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->load->model('usuario');
        $this->load->model("correo");
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
        $this->form_validation->set_rules('correo', 'correo', 'required|valid_email|callback_exists_email');
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

    public function exists_email($correo)
    {

        $condiciones = array(
            "baja" => 0,
            "correo" => $correo
        );

        if ($this->usuario->buscar($condiciones)) {
            return true;
        } else {
            return false;
        }
    }



    public function enviarCorreo()
    {
        // Comprueba que el correo sea valido
        if ($this->validar()) {

            // Obtengo el correo introducido.
            $correo = $this->input->post("correo");
            // Genero un token, combinando el correo con la fecha y ahora del sistema.
            $token = $this->generarToken($correo);

            // Guardo en la base de datos, el token generado para el usuario.
            if ($this->usuario->guardarToken($correo, $token)) {
                // Trabajando dede el servidor ieslamarisma.net Esta ruta sera la que le pasare como enlace por correo al usuario.
                $servidor = "<H2> Restablece la contraseña desde servidor</H2>
                            <a href='https://ieslamarisma.net/proyectos/2019/joseluiscortes/libreria/index.php/CambiarPassword/formulario/correo/$correo/token/$token'> aqui en sel servidor </a>";
                // Trabajando desde localhost, desde local, esta rara la url que me enviare para cambiar la contraseña por correo.
                $local = "<H2> Restablece la contraseña desde local </H2>
                            <a href='http://localhost/libreria/index.php/cambiarPassword/formulario/correo/$correo/token/$token'> aqui en local </a>";

                // Compruebo si el correo se ha enviado correctamente al usuario.
                if ($this->correo->enviar($correo, "Restablece password", $local)) {
                    // Muestro la vista y le paso como parametro el mensaje que se mostrar al usuario.
                    $this->load->view("correoEnviadoSatisfactoriamente", array("correo" => $correo));
                } else {
                    $dato["error"] = "No se ha podido enviar el correo";
                    $this->load->view('formularioOlvidePassword', $dato);
                }
            } else {
                $dato["error"] = "No se ha podido generar el token de seguridad";
                $this->load->view('formularioOlvidePassword', $dato);
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
